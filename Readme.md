## Table des matières
1. [Informations générales](#informations-générales)
2. [Technologies](#technologies)
3. [Installation](#installation)
5. [FAQs](#faqs)
### Informations générales
***
Le projet Curry est développer par [Thomas Jakubowski](https://gitlab.com/T.Jakubowski) et [Baptiste Coquelet](https://gitlab.com/B.CoQueLeT).
Le projet est une application web qui permet de géré des caserne de pompier et des pompier 
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

1. Cloner le dépôt
```
$ git clone https://gitlab.com/sco-chartreux/slam21-22/team-1/curry.git
```
2. Intaller la base de données
Pour ce faire vous devez executé un des deux script sql qui se trouve dans le repertoire **../curry/sql/**.
Le script **dump_pompierDataBase_Init.sql** contient un jeu de données par defaut alors **dump_pompierDataBase_Init_WithoutData.sql** n'en contient pas(il contient uniquement les données necessaire a se connecté a l'application)
```
../curry/sql/dump_pompierDataBase_Init.sql
../curry/sql/dump_pompierDataBase_Init_WithoutData.sql

```

```
$ cd ../curry
$ php -S 127.0.0.1:8080 -t html
```

## FAQs
***
A list of frequently asked questions
1. **This is a question**
Answer of the first question with _italic words_. 
2. __Second question in bold__ 
To answer this question we use an unordered list:
* First point
* Second Point
* Third point
3. **Third question in bold**
Answer of the third question with *italic words*.
4. **Fourth question in bold**



