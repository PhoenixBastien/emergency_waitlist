# Emergency Waitlist

## Comment utiliser

### Création de la base de données MySQL

Dans votre terminal, allez dans le répertoire db, tapez `mysql -u root -p` et entrez le mot de passe de l'utilisateur root. Ensuite, tapez `source ./schema.sql` et tapez `source ./seed.sql`.

### Lancement du serveur PHP

Dans votre terminal, allez dans le répertoire public et `tapez php -S localhost:3306`.

### Lancement de l'application

Au besoin, remplacez la valeur de `PASSWORD` dans [db_config.php](public/db_config.php) par le mot de passe de l'utilisateur root. Dans votre navigateur, tapez `localhost:3306` dans la barre de recherche.

### Informations de connexion

Consultez le fichier [seed.sql](db/seed.sql) ou le tableau ci-dessous pour vous connecter en tant qu'administrateur ou patient.

|Nom d'utilisateur|Mot de passe|Rôle|
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
