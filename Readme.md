## Table des matières
1. [Informations générales](#informations-générales)
2. [Technologies](#technologies)
3. [Installation](#installation)
5. [Informations supplémentaires](#informations-supplémentaires)
### Informations générales
***
Le projet Curry est développer par [Thomas Jakubowski](https://gitlab.com/T.Jakubowski) et [Baptiste Coquelet](https://gitlab.com/B.CoQueLeT).
Le projet est une application web qui permet de géré des caserne de pompier et des pompier 
## Technologies
***
Une liste des technologies utilisées dans le projet :
* [Bootsrap](https://getbootstrap.com/docs/5.0/getting-started/introduction/): Version 5.0.2
* HTML: Version 5
* CSS: Version 3
* Javascript: Version 11
* PHP: Version 7.4.23
* SQL

## Installation
***

1. Cloner le dépôt
```
$ git clone https://gitlab.com/sco-chartreux/slam21-22/team-1/curry.git
```
2. Intaller la base de données
Pour ce faire vous devez executé un des deux script sql qui se trouve dans le repertoire **../curry/sql/**.
Le script **dump_pompierDataBase_Init.sql** contient un jeu de données par defaut alors que **dump_pompierDataBase_Init_WithoutData.sql** n'en contient pas (il contient uniquement les données necessaire pour se connecté a l'application)

3. Lancer un serveur
```
$ cd ../curry
$ php -S 127.0.0.1:8080 -t html
```

4. Lancer l'application<br/>

Rendez-vous sur l'url suivante dans un navigateur
```
http://127.0.0.1:8080/
```

5. Connexion<br/>

Vous pouvez vous connecté au utilisateur déja crée :

|      Role      | Identifiant | Mot de passe |
|:--------------:|:-----------:|:------------:|
| Administrateur |   PDupond   | fdsf45-%%%DD |
|   Secretaire   |  JMaurelle  |  -_25iidffd4 |
|   Utilisateur  |   EYeager   |  Acdfds78*$d |


## Informations supplémentaires

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




