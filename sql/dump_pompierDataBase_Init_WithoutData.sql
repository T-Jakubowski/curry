-- MariaDB dump 10.19  Distrib 10.5.11-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: pompiers
-- ------------------------------------------------------
-- Server version	10.5.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- base structure
--

DROP DATABASE IF EXISTS `pompiers`;
CREATE DATABASE pompiers CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE pompiers;

--
-- user structure
--
CREATE USER 'pompiers_db'@'%';
ALTER USER 'pompiers_db'@'%' IDENTIFIED BY '123456';


GRANT Alter ON pompiers.* TO 'pompiers_db'@'%';
GRANT Create ON pompiers.* TO 'pompiers_db'@'%';
GRANT Create view ON pompiers.* TO 'pompiers_db'@'%';
GRANT Delete ON pompiers.* TO 'pompiers_db'@'%';
GRANT Delete history ON pompiers.* TO 'pompiers_db'@'%';
GRANT Drop ON pompiers.* TO 'pompiers_db'@'%';
GRANT Grant option ON pompiers.* TO 'pompiers_db'@'%';
GRANT Index ON pompiers.* TO 'pompiers_db'@'%';
GRANT Insert ON pompiers.* TO 'pompiers_db'@'%';
GRANT References ON pompiers.* TO 'pompiers_db'@'%';
GRANT Select ON pompiers.* TO 'pompiers_db'@'%';
GRANT Show view ON pompiers.* TO 'pompiers_db'@'%';
GRANT Trigger ON pompiers.* TO 'pompiers_db'@'%';
GRANT Update ON pompiers.* TO 'pompiers_db'@'%';



--
-- Table structure for table `casernes`
--

DROP TABLE IF EXISTS `casernes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `casernes` (
  `NumCaserne` int(11) NOT NULL,
  `Adresse` varchar(30) DEFAULT NULL,
  `CP` varchar(5) DEFAULT NULL,
  `Ville` varchar(10) DEFAULT NULL,
  `CodeTypeC` int(11) DEFAULT NULL,
  PRIMARY KEY (`NumCaserne`),
  KEY `FK_typeC` (`CodeTypeC`),
  CONSTRAINT `FK_typeC` FOREIGN KEY (`CodeTypeC`) REFERENCES `typecasernes` (`CodeTypeC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grades` (
  `CodeGrade` varchar(2) NOT NULL,
  `NomGrade` varchar(15) DEFAULT NULL,
  `CoefIndem` int(11) DEFAULT NULL,
  PRIMARY KEY (`CodeGrade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `interventions`
--

DROP TABLE IF EXISTS `interventions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interventions` (
  `DateInter` date NOT NULL,
  `NumInter` int(11) NOT NULL,
  `TypeInter` varchar(10) DEFAULT NULL,
  `DureeInter` int(11) DEFAULT NULL,
  `EtatInter` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`DateInter`,`NumInter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `pompier_intervention`
--

DROP TABLE IF EXISTS `pompier_intervention`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pompier_intervention` (
  `DateInter` date NOT NULL,
  `NumInter` int(11) NOT NULL,
  `Matricule` varchar(7) NOT NULL,
  PRIMARY KEY (`DateInter`,`NumInter`,`Matricule`),
  KEY `FK_Pompier3` (`Matricule`),
  CONSTRAINT `FK_Inter` FOREIGN KEY (`DateInter`, `NumInter`) REFERENCES `interventions` (`DateInter`, `NumInter`),
  CONSTRAINT `FK_Pompier3` FOREIGN KEY (`Matricule`) REFERENCES `pompiers` (`Matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `pompier_qualification`
--

DROP TABLE IF EXISTS `pompier_qualification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pompier_qualification` (
  `Matricule` varchar(7) NOT NULL,
  `CodeQualif` varchar(5) NOT NULL,
  `DateObtention` date DEFAULT NULL,
  `DateRecyclage` date DEFAULT NULL,
  PRIMARY KEY (`Matricule`,`CodeQualif`),
  KEY `FK_Qualif1` (`CodeQualif`),
  CONSTRAINT `FK_Pompier1` FOREIGN KEY (`Matricule`) REFERENCES `pompiers` (`Matricule`),
  CONSTRAINT `FK_Qualif1` FOREIGN KEY (`CodeQualif`) REFERENCES `qualifications` (`CodeQualif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `pompiers`
--

DROP TABLE IF EXISTS `pompiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pompiers` (
  `Matricule` varchar(7) NOT NULL,
  `Prenom` varchar(10) DEFAULT NULL,
  `Nom` varchar(20) DEFAULT NULL,
  `ChefAgret` varchar(1) DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `NumCaserne` int(11) DEFAULT NULL,
  `CodeGrade` varchar(2) DEFAULT NULL,
  `matriculeRespo` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`Matricule`),
  KEY `FK_Caserne1` (`NumCaserne`),
  KEY `FK_Grade1` (`CodeGrade`),
  CONSTRAINT `FK_Caserne1` FOREIGN KEY (`NumCaserne`) REFERENCES `casernes` (`NumCaserne`),
  CONSTRAINT `FK_Grade1` FOREIGN KEY (`CodeGrade`) REFERENCES `grades` (`CodeGrade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `pompiers_dispos`
--

DROP TABLE IF EXISTS `pompiers_dispos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pompiers_dispos` (
  `Matricule` varchar(7) NOT NULL,
  `jjmmaaaa` date NOT NULL,
  `hhmm` int(11) NOT NULL,
  PRIMARY KEY (`Matricule`,`jjmmaaaa`,`hhmm`),
  CONSTRAINT `FK_Pompier2` FOREIGN KEY (`Matricule`) REFERENCES `pompiers` (`Matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `prerequis`
--

DROP TABLE IF EXISTS `prerequis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prerequis` (
  `CodeQualifConcerne` varchar(5) NOT NULL,
  `CodeQualifAAvoir` varchar(5) NOT NULL,
  PRIMARY KEY (`CodeQualifConcerne`,`CodeQualifAAvoir`),
  KEY `FK_Qualif4` (`CodeQualifAAvoir`),
  CONSTRAINT `FK_Qualif3` FOREIGN KEY (`CodeQualifConcerne`) REFERENCES `qualifications` (`CodeQualif`),
  CONSTRAINT `FK_Qualif4` FOREIGN KEY (`CodeQualifAAvoir`) REFERENCES `qualifications` (`CodeQualif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `qualification_typevehicule`
--

DROP TABLE IF EXISTS `qualification_typevehicule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qualification_typevehicule` (
  `CodeTypeV` varchar(5) NOT NULL,
  `CodeQualif` varchar(5) NOT NULL,
  `Obligatoire` varchar(1) DEFAULT NULL,
  `Nb` int(11) DEFAULT NULL,
  PRIMARY KEY (`CodeTypeV`,`CodeQualif`),
  KEY `FK_Qualif2` (`CodeQualif`),
  CONSTRAINT `FK_Qualif2` FOREIGN KEY (`CodeQualif`) REFERENCES `qualifications` (`CodeQualif`),
  CONSTRAINT `FK_TypeV2` FOREIGN KEY (`CodeTypeV`) REFERENCES `typevehicules` (`CodeTypeV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `qualifications`
--

DROP TABLE IF EXISTS `qualifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qualifications` (
  `CodeQualif` varchar(5) NOT NULL,
  `NomQualif` varchar(15) DEFAULT NULL,
  `validite` int(11) DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `NbParticipants` int(11) DEFAULT NULL,
  PRIMARY KEY (`CodeQualif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `typecasernes`
--

DROP TABLE IF EXISTS `typecasernes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typecasernes` (
  `CodeTypeC` int(11) NOT NULL,
  `NomType` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`CodeTypeC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `typevehicules`
--

DROP TABLE IF EXISTS `typevehicules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typevehicules` (
  `CodeTypeV` varchar(5) NOT NULL,
  `NomV` varchar(20) DEFAULT NULL,
  `NbMinPompiers` int(11) DEFAULT NULL,
  `KmRevision` int(11) DEFAULT NULL,
  PRIMARY KEY (`CodeTypeV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `vehicule_intervention`
--

DROP TABLE IF EXISTS `vehicule_intervention`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicule_intervention` (
  `NumCaserne` int(11) NOT NULL,
  `NumVehicule` int(11) NOT NULL,
  `DateInter` date NOT NULL,
  `NumInter` int(11) NOT NULL,
  `DureeService` int(11) DEFAULT NULL,
  PRIMARY KEY (`NumCaserne`,`NumVehicule`,`DateInter`,`NumInter`),
  KEY `FK_Inter2` (`DateInter`,`NumInter`),
  CONSTRAINT `FK_Inter2` FOREIGN KEY (`DateInter`, `NumInter`) REFERENCES `interventions` (`DateInter`, `NumInter`),
  CONSTRAINT `FK_Vehicules` FOREIGN KEY (`NumCaserne`, `NumVehicule`) REFERENCES `vehicules` (`NumCaserne`, `NumVehicule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `vehicules`
--

DROP TABLE IF EXISTS `vehicules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicules` (
  `NumCaserne` int(11) NOT NULL,
  `NumVehicule` int(11) NOT NULL,
  `DateAchat` date DEFAULT NULL,
  `NbKm` int(11) DEFAULT NULL,
  `KmDerniereRev` int(11) DEFAULT NULL,
  `CodeTypeV` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`NumCaserne`,`NumVehicule`),
  KEY `FK_TypeV1` (`CodeTypeV`),
  CONSTRAINT `FK_TypeV1` FOREIGN KEY (`CodeTypeV`) REFERENCES `typevehicules` (`CodeTypeV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
create table role (
    Id INT NOT NULL AUTO_INCREMENT,
    Role varchar(20),
    Permission binary(8),
    primary key (Id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
insert into role (Role, Permission) values ('Admin',"00011111");
insert into role (Role, Permission) values ('Responsable',"00001111");
insert into role (Role, Permission) values ('Utilisateur',"00000001");
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
Create table user(
	Identifiant varchar(20) PRIMARY KEY NOT NULL,
	Prenom varchar(20),
	Nom varchar(20),
	IdRole int,
	password varchar(65),
	foreign key (IdRole) references role(Id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
insert into user (Identifiant, IdRole, Prenom, Nom, Password) values ('PDupond', 1, 'Paul', 'Dupond', '116fd3797ad35cb658e211b0a4489ca7614c51a028699dd1020f408767ae12a1');
insert into user (Identifiant, IdRole, Prenom, Nom, Password) values ('JMaurelle', 2, 'Jean', 'Maurelle', '069dc5ec79a138946d96ac4f03ead5a75dd7abccf2ff1ff9fe5036c53756bc0a');
insert into user (Identifiant, IdRole, Prenom, Nom, Password) values ('EYeager', 3, 'eren', 'yeager', '9599500373a5d2f5512097dc406b086231c1454f1f327c1c6febced3c9a025e0');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
