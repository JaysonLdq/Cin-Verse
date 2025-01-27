/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.6.2-MariaDB, for debian-linux-gnu (aarch64)
--
-- Host: localhost    Database: symfony
-- ------------------------------------------------------
-- Server version	11.6.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `acting`
--

DROP TABLE IF EXISTS `acting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) DEFAULT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_270B0577BE04EA9` (`job_id`),
  CONSTRAINT `FK_270B0577BE04EA9` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acting`
--

LOCK TABLES `acting` WRITE;
/*!40000 ALTER TABLE `acting` DISABLE KEYS */;
INSERT INTO `acting` VALUES
(1,1,'Joe','Goldberg','joe.png');
/*!40000 ALTER TABLE `acting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `age`
--

DROP TABLE IF EXISTS `age`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `age` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `age`
--

LOCK TABLES `age` WRITE;
/*!40000 ALTER TABLE `age` DISABLE KEYS */;
INSERT INTO `age` VALUES
(1,'Tous publics'),
(2,'Déconseillé aux moins de 10 ans'),
(3,'Déconseillé aux moins de 12 ans'),
(4,'Déconseillé aux moins de 16 ans'),
(5,'Déconseillé aux moins de 18 ans');
/*!40000 ALTER TABLE `age` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES
('DoctrineMigrations\\Version20250120125500','2025-01-20 12:55:19',53),
('DoctrineMigrations\\Version20250121145108','2025-01-21 14:51:18',27);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `episode`
--

DROP TABLE IF EXISTS `episode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `episode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saison_id` int(11) DEFAULT NULL,
  `label` varchar(160) NOT NULL,
  `ordre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DDAA1CDAF965414C` (`saison_id`),
  CONSTRAINT `FK_DDAA1CDAF965414C` FOREIGN KEY (`saison_id`) REFERENCES `saison` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `episode`
--

LOCK TABLES `episode` WRITE;
/*!40000 ALTER TABLE `episode` DISABLE KEYS */;
INSERT INTO `episode` VALUES
(1,1,'Mon dieu ',1),
(2,2,'Haaaaa',1),
(3,3,'Mon dieu ',1),
(4,1,'Haaaaa',2),
(5,1,'Hello, You',1);
/*!40000 ALTER TABLE `episode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_serie`
--

DROP TABLE IF EXISTS `film_serie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_serie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `age_id` int(11) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `description` longtext NOT NULL,
  `release_date` datetime NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `language` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_33566D64CC80CD12` (`age_id`),
  CONSTRAINT `FK_33566D64CC80CD12` FOREIGN KEY (`age_id`) REFERENCES `age` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_serie`
--

LOCK TABLES `film_serie` WRITE;
/*!40000 ALTER TABLE `film_serie` DISABLE KEYS */;
INSERT INTO `film_serie` VALUES
(1,5,'You','Joe Goldberg, un charmant et obsessionnel gérant de librairie à New York. Lorsqu\'il rencontre Guinevere Beck, une écrivaine en herbe, il développe une fascination intense pour elle. Utilisant les réseaux sociaux et la technologie, Joe traque Beck et élimine discrètement les obstacles qui pourraient entraver leur relation.','2025-01-20 13:56:00','You.png',120,'français, anglais, espagnol, italien, allemand, chinois, japonais'),
(2,4,'Squid Game','Ruiné et prêt à tout, Gi-hun accepte de participer à un jeu mystérieux. Mais dès la première épreuve, la promesse d\'argent facile fait place à l\'horreur.','2025-01-20 13:56:53','squidGame.png',120,'français, anglais, espagnol, italien, allemand, chinois, japonais'),
(3,2,'Men in black','L\'agent K fait partie des \"Men in Black\", une organisation ultra-secrète qui régule la présence extraterrestre sur Terre. Lorsqu\'il recrute l\'agent J, un policier impulsif mais brillant, ce dernier découvre un monde caché où des aliens vivent parmi les humains en toute discrétion.','2025-01-20 13:56:53','menInBlack.png',120,'français, anglais, espagnol, italien, allemand, chinois, japonais'),
(4,1,'Iron Man','Tony Stark, un brillant et excentrique ingénieur et industriel, est capturé par des terroristes après un accident en Afghanistan. Lors de sa captivité, il est contraint de construire une arme de destruction massive pour ses ravisseurs. Mais au lieu de cela, il crée une armure de haute technologie pour s\'échapper. À son retour, il décide de transformer son entreprise et de l\'utiliser pour protéger le monde en utilisant sa nouvelle invention. Cependant, un ancien partenaire, Obadiah Stane, tente de prendre le contrôle de Stark Industries et de ses technologies. Tony doit alors enfiler son armure d\'Iron Man pour affronter des menaces plus dangereuses et sauver le monde.','2025-01-20 13:56:53','ironMan.png',120,'français, anglais, espagnol, italien, allemand, chinois, japonais'),
(5,2,'One piece','Rejoignez Luffy, un jeune pirate au corps élastique, dans sa quête épique pour devenir le roi des pirates ! Avec son équipage de choc, les Chapeaux de Paille, il part à la recherche du légendaire trésor, le One Piece, caché quelque part dans la vaste et dangereuse Grand Line. Ensemble, ils affrontent des ennemis redoutables, découvrent des îles mystérieuses et forment des liens indestructibles. Entre action palpitante, humour, et des personnages attachants, embarquez dans une aventure épique pleine de mystères et de rêves à accomplir. Un voyage qui pourrait bien changer le destin du monde entier !','2025-01-20 13:56:53','Op.png',120,'français, anglais, espagnol, italien, allemand, chinois, japonais'),
(6,NULL,'Breaking Bad','Walter White, 50 ans, est professeur de chimie dans un lycée du Nouveau-Mexique. Pour réunir de l\'argent afin de subvenir aux besoins de sa famille, Walter met ses connaissances en chimie à profit pour fabriquer et vendre du crystal meth.','2025-01-26 02:39:00','Breaking-Bad-2-6795965b3da2e.jpg',678,'Anglais, Français');
/*!40000 ALTER TABLE `film_serie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_serie_acting`
--

DROP TABLE IF EXISTS `film_serie_acting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_serie_acting` (
  `film_serie_id` int(11) NOT NULL,
  `acting_id` int(11) NOT NULL,
  PRIMARY KEY (`film_serie_id`,`acting_id`),
  KEY `IDX_4066FBA27BC447D4` (`film_serie_id`),
  KEY `IDX_4066FBA2DD5A960F` (`acting_id`),
  CONSTRAINT `FK_4066FBA27BC447D4` FOREIGN KEY (`film_serie_id`) REFERENCES `film_serie` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4066FBA2DD5A960F` FOREIGN KEY (`acting_id`) REFERENCES `acting` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_serie_acting`
--

LOCK TABLES `film_serie_acting` WRITE;
/*!40000 ALTER TABLE `film_serie_acting` DISABLE KEYS */;
/*!40000 ALTER TABLE `film_serie_acting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_serie_genre`
--

DROP TABLE IF EXISTS `film_serie_genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_serie_genre` (
  `film_serie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`film_serie_id`,`genre_id`),
  KEY `IDX_33E42A637BC447D4` (`film_serie_id`),
  KEY `IDX_33E42A634296D31F` (`genre_id`),
  CONSTRAINT `FK_33E42A634296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_33E42A637BC447D4` FOREIGN KEY (`film_serie_id`) REFERENCES `film_serie` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_serie_genre`
--

LOCK TABLES `film_serie_genre` WRITE;
/*!40000 ALTER TABLE `film_serie_genre` DISABLE KEYS */;
INSERT INTO `film_serie_genre` VALUES
(1,4),
(2,2),
(3,3),
(4,4);
/*!40000 ALTER TABLE `film_serie_genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES
(1,'Action'),
(2,'Aventure'),
(3,'Comédie'),
(4,'Drame'),
(5,'Fantastique'),
(6,'Horreur'),
(7,'Science-fiction'),
(8,'Thriller'),
(9,'Film'),
(10,'Serie');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES
(1,'Acteur'),
(2,'Réalisateur');
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iuser_id` int(11) DEFAULT NULL,
  `film_serie_id` int(11) DEFAULT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CFBDFA1490846812` (`iuser_id`),
  KEY `IDX_CFBDFA147BC447D4` (`film_serie_id`),
  CONSTRAINT `FK_CFBDFA147BC447D4` FOREIGN KEY (`film_serie_id`) REFERENCES `film_serie` (`id`),
  CONSTRAINT `FK_CFBDFA1490846812` FOREIGN KEY (`iuser_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
INSERT INTO `note` VALUES
(1,NULL,NULL,15),
(2,NULL,NULL,19),
(3,NULL,NULL,19),
(4,NULL,NULL,15),
(5,NULL,NULL,11);
/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saison`
--

DROP TABLE IF EXISTS `saison`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  `description` longtext NOT NULL,
  `film_serie_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C0D0D5867BC447D4` (`film_serie_id`),
  CONSTRAINT `FK_C0D0D5867BC447D4` FOREIGN KEY (`film_serie_id`) REFERENCES `film_serie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saison`
--

LOCK TABLES `saison` WRITE;
/*!40000 ALTER TABLE `saison` DISABLE KEYS */;
INSERT INTO `saison` VALUES
(1,'Saison 1 ','Joe Goldberg, un libraire intelligent mais obsédé qui développe une fascination dangereuse pour une jeune femme nommée Guinevere Beck, qu\'il rencontre par hasard dans la librairie où il travaille à New York. Joe est un personnage complexe : charmant et cultivé, mais avec une tendance obsessionnelle et manipulatrice.  Tout commence lorsqu\'il devient obsédé par Beck après l\'avoir rencontrée dans la librairie. Il commence à la suivre sur les réseaux sociaux, à observer ses déplacements et à interférer avec sa vie de manière insidieuse pour se rapprocher d\'elle. À travers une série de manipulations, de mensonges et d\'actes violents, Joe élimine les obstacles qui se dressent entre lui et Beck, y compris ses amis, ses ex-partenaires et toute personne qui pourrait mettre en péril sa relation avec elle.',NULL),
(2,'Saison 1 ','Joe Goldberg, un libraire intelligent mais obsédé qui développe une fascination dangereuse pour une jeune femme nommée Guinevere Beck, qu\'il rencontre par hasard dans la librairie où il travaille à New York. Joe est un personnage complexe : charmant et cultivé, mais avec une tendance obsessionnelle et manipulatrice.  Tout commence lorsqu\'il devient obsédé par Beck après l\'avoir rencontrée dans la librairie. Il commence à la suivre sur les réseaux sociaux, à observer ses déplacements et à interférer avec sa vie de manière insidieuse pour se rapprocher d\'elle. À travers une série de manipulations, de mensonges et d\'actes violents, Joe élimine les obstacles qui se dressent entre lui et Beck, y compris ses amis, ses ex-partenaires et toute personne qui pourrait mettre en péril sa relation avec elle.',NULL),
(3,'Saison 2 ','Joe Goldberg, qui, après les événements tragiques de la saison 1, quitte New York pour commencer une nouvelle vie à Los Angeles sous un nouveau nom, Will Bettelheim. Désireux de fuir son passé sanglant et ses erreurs, Joe cherche à reconstruire sa vie, espérant cette fois-ci ne pas se laisser emporter par ses obsessions.',NULL),
(4,'Saison 1 ','Joe Goldberg, un libraire intelligent mais obsédé qui développe une fascination dangereuse pour une jeune femme nommée Guinevere Beck, qu\'il rencontre par hasard dans la librairie où il travaille à New York. Joe est un personnage complexe : charmant et cultivé, mais avec une tendance obsessionnelle et manipulatrice.  Tout commence lorsqu\'il devient obsédé par Beck après l\'avoir rencontrée dans la librairie. Il commence à la suivre sur les réseaux sociaux, à observer ses déplacements et à interférer avec sa vie de manière insidieuse pour se rapprocher d\'elle. À travers une série de manipulations, de mensonges et d\'actes violents, Joe élimine les obstacles qui se dressent entre lui et Beck, y compris ses amis, ses ex-partenaires et toute personne qui pourrait mettre en péril sa relation avec elle.',NULL),
(5,'Saison 2 ','Joe Goldberg, qui, après les événements tragiques de la saison 1, quitte New York pour commencer une nouvelle vie à Los Angeles sous un nouveau nom, Will Bettelheim. Désireux de fuir son passé sanglant et ses erreurs, Joe cherche à reconstruire sa vie, espérant cette fois-ci ne pas se laisser emporter par ses obsessions.',NULL),
(6,'Saison 3 ','Joe Goldberg et Love Quinn, qui se sont désormais installés dans la banlieue de Madrazo, une petite ville californienne. Après avoir quitté Los Angeles à la fin de la saison 2, Joe et Love commencent une nouvelle vie sous de nouveaux noms, espérant enterrer définitivement leurs sombres secrets et démarrer une famille. Ils ont même un enfant, un petit garçon nommé Henry.',NULL);
/*!40000 ALTER TABLE `saison` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `username` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'admin@admin.com','[\"ROLE_ADMIN\"]','$2y$13$14rUHiYKYK30KxeyIhh.uuJNoxlhenNS42uX9vdOGd.DUBjaUKMpq','admin'),
(2,'user@user.com','[\"ROLE_USER\"]','$2y$13$YO6shXGmcAT9xZurshDcTeHfwFlh1dQfNqvDhq7k1kHb69pFzNS2C','user'),
(3,'test@test.com','[\"ROLE_USER\"]','$2y$13$RvUYciu8lpq5RbmzXmb1MeYd6MTD5h6IrTqHkGx7Pkd.nNaYqfO9e','toto'),
(5,'test1@test.com','[\"ROLE_USER\"]','$2y$13$ABEBGwPn0N8aaymIWL7Cm.Y9pu/GP.4W/Bw2FSjyLJ9KLNwVYj6iC','toto');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-01-27  8:16:21
