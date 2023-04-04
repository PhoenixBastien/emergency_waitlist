# Emergency Waitlist

## Comment utiliser

Modifiez les informations de connexion à MySQL dans le fichier [global.php](public/global.php). 

Dans votre terminal, à partir du répertoire racine du projet, tapez `cd db`, tapez `mysql -u root -p`, entrez votre mot de passe, tapez `source ./schema.sql` et tapez `source ./seed.sql`.

Encore une fois dans votre terminal, à partir du répertoire racine du projet, tapez `cd public` et `tapez php -S localhost:3306`.

Dans votre navigateur, tapez `localhost:3306` dans la barre de recherche.

Référez-vous au fichier [seed.sql](db/seed.sql) ou au tableau ci-dessous pour vous connecter en tant qu'administrateur ou patient.

|Username|Password|Role|
|:----|:----|:----|
|admin|admin|admin|
|joe|joe|patient|
|sam|sam|patient|
|max|max|patient|
|pho|pho|patient|
|mel|mel|patient|
|jay|jay|patient|
|jon|jon|patient|
|ron|ron|patient|
|don|don|patient|
|ray|ray|patient|
|kev|kev|patient|
|zak|zak|patient|

## Liens

[Design de la base de données](/docs/db.md)<br />
[Schéma de la base de données](/db/schema.sql)<br />
[Exemples de données (SQL)](/db/seed.sql)