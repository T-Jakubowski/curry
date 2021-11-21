## Table des matières
1. [General informations](#general-informations)
2. [Technologies](#technologies)
3. [Installation](#installation)
5. [Additional Information](#additional-Information)
### General informations
***
The Curry project is developed by [Thomas Jakubowski](https://gitlab.com/T.Jakubowski) and [Baptiste Coquelet](https://gitlab.com/B.CoQueLeT).
The project is a web application that allows to manage fire stations and firefighters
## Technologies
***
A list of technologies used within the project:
* [Bootsrap](https://getbootstrap.com/docs/5.0/getting-started/introduction/): Version 5.0.2
* HTML: Version 5
* CSS: Version 3
* Javascript: Version 11
* PHP: Version 7.4.23
* SQL

## Installation
***

1. Clone the repository
```
$ git clone https://gitlab.com/sco-chartreux/slam21-22/team-1/curry.git
```
2. Install the database
Pour ce faire vous devez executé un des deux script sql qui se trouve dans le repertoire **../curry/sql/**.
Le script **dump_pompierDataBase_Init.sql** contient un jeu de données par defaut alors que **dump_pompierDataBase_Init_WithoutData.sql** n'en contient pas (il contient uniquement les données necessaire pour se connecté a l'application)

3. Start a server
```
$ cd ../curry
$ php -S 127.0.0.1:8080 -t html
```

4. Launch the application<br/>

Go to the following url in a browser
```
http://127.0.0.1:8080/
```

5. Lancer l'application<br/>

Rendez-vous sur l'url suivante dans un navigateur
```
http://127.0.0.1:8080/
```

6. Connexion<br/>

Vous pouvez vous connecté au utilisateur déja crée :

|      Role      | Identifiant | Mot de passe |
|:--------------:|:-----------:|:------------:|
| Administrateur |   PDupond   | fdsf45-%%%DD |
|   Secretaire   |  JMaurelle  |  -_25iidffd4 |
|   Utilisateur  |   EYeager   |  Acdfds78*$d |


## Additional Information

1. Permission<br/>

Les permision des roles son décomposé comme ceci :
```
      P  I D U S
0 0 0 0	 0 0 0 0

P = Gestion des roles et users
I = Insertion de pompiers et casernes
D = Suppression de pompiers et casernes
U = Mise a jour de pompiers et casernes
S = Affichage de pompiers et casernes
```




