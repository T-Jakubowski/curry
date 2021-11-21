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

To do this you must run one of the two sql scripts located in the **../curry/sql/** directory.
The **dump_pompierDataBase_Init.sql** script contains a default dataset while **dump_pompierDataBase_Init_WithoutData.sql** does not (it only contains the data needed to connect to the application) 

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

5. Log in<br/>

You can connect to the user already created:

|      Role      |   Username  |   Password   |
|:--------------:|:-----------:|:------------:|
| Administrateur |   PDupond   | fdsf45-%%%DD |
|   Secretaire   |  JMaurelle  |  -_25iidffd4 |
|   Utilisateur  |   EYeager   |  Acdfds78*$d |


## Additional Information

1.  <br/>

Role permissions are done like this:
```
      P  I D U S
0 0 0 0	 0 0 0 0

P = Managing roles and users
I = Insertion of firefighters and fire stations
D = Deletion of firefighters and fire stations
U = Update of firefighters and fire stations
S = Display of firefighters and fire stations
```




