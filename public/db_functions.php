<?php
function sort_appts($mysqli)
{
    // Select patients from user table
    $query = "SELECT *, 
              (severity * 10 + TIMEDIFF(NOW(), arrival_time) / 60 * 0.1) AS priority_val 
              FROM user WHERE user_role = 'patient' ORDER BY priority_val DESC;";
    // Execute above query
    $result = mysqli_query($mysqli, $query);
    // Convert mysqli_result to array
    $patients = $result->fetch_all(MYSQLI_ASSOC);
    // Iterate patient row
    foreach ($patients as $patient) {
        // Desired time is nearest round hour
        $appt_time = new DateTime(date('Y-m-d H:i:s', round(strtotime($patient['arrival_time']) / 3600) * 3600));
        // Check if time is taken
        while (mysqli_query($mysqli, "SELECT * FROM user WHERE user_role = 'patient' 
        AND appt_time = '{$appt_time->format('Y-m-d H:i:s')}'
        AND user_id != {$patient['user_id']}")->num_rows !== 0) {
            // Increment by 1 hour if taken
            $appt_time->add(new DateInterval('PT1H'));
        }
        // Add appointment time
        $query = "UPDATE user SET appt_time = TIMESTAMP'{$appt_time->format('Y-m-d H:i:s')}' WHERE user_id = {$patient['user_id']}";
        mysqli_execute_query($mysqli, $query);
    }
}
function get_patients($mysqli)
{
    $query = "SELECT * FROM user WHERE user_role = 'patient' ORDER BY appt_time ASC";
    $result = mysqli_query($mysqli, $query);
    $patients = $result->fetch_all(MYSQLI_ASSOC);
    return $patients;
}
function get_appt_time($mysqli, $user_id)
{
    $query = "SELECT appt_time FROM user WHERE user_id = {$user_id}";
    $result = mysqli_query($mysqli, $query);
    $appt_time = $result->fetch_object()->appt_time;
    return new DateTime($appt_time);
}
?>