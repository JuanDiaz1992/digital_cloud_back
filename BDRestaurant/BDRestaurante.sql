-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: gestion_restaurante_php
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchaseValue` int DEFAULT NULL,
  `reason` varchar(50) NOT NULL,
  `observations` text,
  `idProfile_user` int DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idProfile_user` (`idProfile_user`),
  CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`idProfile_user`) REFERENCES `profile_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bills`
--

LOCK TABLES `bills` WRITE;
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
INSERT INTO `bills` VALUES (2,200000,'expenses_for_employee','Gastos médicos',52,'2023-07-26 02:56:07'),(3,500000,'investment','Se compraron mesas y sillas',15,'2023-07-26 03:02:52'),(4,350000,'personal_expenses','Se pagó un prestamo',15,'2023-07-26 03:03:19'),(5,3000,'other','Tintos',15,'2023-07-26 03:03:50'),(7,3000,'other','Tintos',15,'2023-07-28 02:43:35'),(8,30000,'expenses_for_employee','Empleado con problemas económicos ',15,'2023-07-28 02:45:48'),(9,5000,'other','Tintos',15,'2023-08-06 01:11:09'),(12,90000,'personal_expenses','Cámaras para la casa',15,'2023-08-06 04:30:37'),(13,5000,'other','Tintos',15,'2023-08-09 05:20:09');
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business`
--

DROP TABLE IF EXISTS `business`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `business` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_business` varchar(50) NOT NULL,
  `document_business` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `Description` text,
  `office_hours` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `number_phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business`
--

LOCK TABLES `business` WRITE;
/*!40000 ALTER TABLE `business` DISABLE KEYS */;
INSERT INTO `business` VALUES (1,'Restaurante Casandra','43830348','files/images/business_profile/Restaurante_Casandra/logo.png','Restaurante de comida tipica al mejor precio','De 7am a 4pm','Carrera 7#9-70 Barrio Villa Vicencio','3125739690'),(2,'Restaurante Casandra','43830348','files/images/business_profile/Restaurante_Casandra/logo.png','Restaurante de comida tipica al mejor precio','De 7am a 4pm','Carrera 7#9-70 Barrio Villa Vicencio','3125739690'),(3,'Restaurante Casandra','43830348','files/images/business_profile/Restaurante_Casandra/logo.png','Restaurante de comida tipica al mejor precio','De 7am a 4pm','Carrera 7#9-70 Barrio Villa Vicencio','3125739690');
/*!40000 ALTER TABLE `business` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buys`
--

DROP TABLE IF EXISTS `buys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchaseValue` int DEFAULT NULL,
  `reason` varchar(50) NOT NULL,
  `observations` text,
  `idProfile_user` int DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idProfile_user` (`idProfile_user`),
  CONSTRAINT `buys_ibfk_1` FOREIGN KEY (`idProfile_user`) REFERENCES `profile_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buys`
--

LOCK TABLES `buys` WRITE;
/*!40000 ALTER TABLE `buys` DISABLE KEYS */;
INSERT INTO `buys` VALUES (1,5000,'vegetables','Cositas varias',52,'2023-07-26 02:22:14'),(2,100000,'meet','Carne de res, carne de cerdo, chicharrón, chorizos, recortes de pollo',52,'2023-07-26 02:26:35'),(6,2000,'other','Tintos',15,'2023-07-26 05:53:37'),(7,50000,'vegetables','Verduras varias',15,'2023-07-28 00:24:35'),(8,150000,'meet','Carne para sudar, chicharrón, recortes de pollo, higado',15,'2023-07-28 00:30:10'),(9,50000,'cheeseMaker','Desechables',15,'2023-07-28 02:44:02'),(10,10000,'other','Arepas',15,'2023-07-28 02:44:15'),(11,30000,'meet','Pollo',15,'2023-07-28 02:44:29'),(12,20000,'other','Elementos de aseo',15,'2023-07-28 02:44:48'),(15,150000,'meet','Carne de cerdo, carne de res y recortes de pollo',15,'2023-08-06 01:13:09'),(16,50000,'other','Desechables ',15,'2023-08-06 04:18:11'),(18,3000,'cheeseMaker','Queso',15,'2023-08-09 04:01:25');
/*!40000 ALTER TABLE `buys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items_menu`
--

DROP TABLE IF EXISTS `items_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `price` int DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `menu_item_type` varchar(155) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idProfile_user` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idProfile_user` (`idProfile_user`),
  CONSTRAINT `items_menu_ibfk_1` FOREIGN KEY (`idProfile_user`) REFERENCES `profile_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items_menu`
--

LOCK TABLES `items_menu` WRITE;
/*!40000 ALTER TABLE `items_menu` DISABLE KEYS */;
INSERT INTO `items_menu` VALUES (2,'Mini paisa','Bandeja con chicharron,\n chorizo, huevo y aguacata',13000,'files/images/business_profile/Restaurante_Casandra/logo.png','especialities','2023-08-09 02:22:44',15),(4,'Sancocho de pollo','Sancocho grande y bandeja con arroz, ensalada, banano y la presa de pollo del sancocho',11000,'files/images/business_profile/Restaurante_Casandra/logo.png','especialities','2023-08-09 02:22:44',15);
/*!40000 ALTER TABLE `items_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_user`
--

DROP TABLE IF EXISTS `profile_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type_user` varchar(50) NOT NULL,
  `id_negocio` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuarios_negocio` (`id_negocio`),
  CONSTRAINT `fk_usuarios_negocio` FOREIGN KEY (`id_negocio`) REFERENCES `business` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_user`
--

LOCK TABLES `profile_user` WRITE;
/*!40000 ALTER TABLE `profile_user` DISABLE KEYS */;
INSERT INTO `profile_user` VALUES (15,'Admin','$2y$10$Ist28p6.JTw4R8iky7p4FOUq28IP73vwOCc8I04nZEJu4bA7ZScV6','Juan Diaz','files/user_profile/Admin/278091583_10223983323065818_8927820569779141776_n.jpg','Admin',1),(50,'pepinillo','$2y$10$4EQaqpX8U6olpgjyEf6Pw.SGFrvUiihMYjXHpv4wbGGXpSWeZmEhm','Pepinillo Perez','files/user_profile/pepinillo/IMG-20200310-WA0024.jpg','Waiter',1),(52,'sandraV','$2y$10$aeLcb2VOo6BvVUEUf1LQpOW5MQbwG1ArKEHfktlDQAQpak9khS4Ju','Sandra Valencia','files/user_profile/sandraV/IMG-20191117-WA0006.jpg','Admin',1),(54,'pepitop','$2y$10$Ep8jqq5BNuaBld5cDaINjeRJJkQSKD8DBllE4/Y0dBhwEP2L5l5dG','Pepito Perez','files/user_profile/pepitop/IMG-20191116-WA0014.jpg','Waiter',1),(69,'jrodriguez','$2y$10$n8a/WCclEEJGEuS2loGP6.bnbwGhUMNWlJPkgVCF.1AsobRAeNhxS','Jazmin Rodriguez','files/images/sin_imagen.webp','Chef',1);
/*!40000 ALTER TABLE `profile_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-09 22:58:59
