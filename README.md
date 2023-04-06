# Emergency Waitlist

## Comment utiliser

### Connexion à la base de données MySQL

i. Remplacez le mot de passe MySQL dans le fichier [global.php](public/global.php) par le vôtre.

ii. Dans votre terminal, à partir du répertoire racine du projet, tapez `cd db` tapez `mysql -u root -p` et entrez votre mot de passe pour vous connecter à MySQL.

iii. Tapez `source ./schema.sql` et tapez `source ./seed.sql` pour créer la base de données.

### Lancement du serveur PHP

Dans votre terminal, à partir du répertoire racine du projet, tapez `cd public` et `tapez php -S localhost:3306` pour lancer le serveur PHP.

### Lancement de l'application

Dans votre navigateur, tapez `localhost:3306` dans la barre de recherche.

### Informations de connexion

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
