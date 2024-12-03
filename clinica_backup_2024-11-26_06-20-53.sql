-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: clinica
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador` (
  `idAdministrador` int NOT NULL AUTO_INCREMENT COMMENT 'llave primaria de la tabla administrador',
  `Usuario` varchar(45) NOT NULL COMMENT 'Nombre de usuarios para poder iniciar sesion en la plataforma',
  `Contrasenia` varchar(45) NOT NULL COMMENT 'Contrasenia para poder iniciar sesion',
  PRIMARY KEY (`idAdministrador`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'adminGiovanni','choco');
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrera` (
  `idCarrera` int NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla carrera',
  `Nombre` varchar(45) NOT NULL COMMENT 'Nombre de la carrera',
  `Clave` varchar(45) NOT NULL COMMENT 'Siglas de la carrera',
  PRIMARY KEY (`idCarrera`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` VALUES (1,'Ingeniería en Tecnologías de la Información','ITI'),(2,'Ingeniería en Biotecnología','IBT'),(3,'Ingeniería Ambiental y Sustentabilidad','IAS'),(4,'Ingeniería en Tecnología Ambiental','ITA'),(5,'Ingeniería en Sistemas Electrónicos','ISE'),(6,'Ingeniería Industrial','INN'),(7,'Licenciatura en Administración','LAD'),(8,'Ingeniería Financiera','IFI');
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cita` (
  `idCita` int NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla cita',
  `Doctor_idDoctor` int NOT NULL COMMENT 'Llave foranea de la tabla doctor',
  `Paciente_idPaciente` int NOT NULL COMMENT 'Llave foranea de la tabla paciente',
  `Fecha_Cita` date NOT NULL COMMENT 'Fecha programada para la cita medica',
  `Hora` time NOT NULL COMMENT 'Hora programada para la cita',
  `Estado_Cita` varchar(45) NOT NULL COMMENT 'Estado en la cual se encuentra la cita (Cancelada,Pendiente,Aceptada o Terminada)',
  `motivo_cancelacion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idCita`,`Doctor_idDoctor`,`Paciente_idPaciente`),
  KEY `fk_Cita_Doctor_idx` (`Doctor_idDoctor`),
  KEY `fk_Cita_Paciente1_idx` (`Paciente_idPaciente`),
  CONSTRAINT `fk_Cita_Doctor` FOREIGN KEY (`Doctor_idDoctor`) REFERENCES `doctor` (`idDoctor`),
  CONSTRAINT `fk_Cita_Paciente1` FOREIGN KEY (`Paciente_idPaciente`) REFERENCES `paciente` (`idPaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` VALUES (7,20,8,'2024-11-12','17:40:00','Atendida',NULL),(8,20,8,'2024-11-11','15:00:00','Atendida',NULL),(9,20,8,'2024-11-13','16:40:00','Atendida',NULL),(10,20,8,'2024-11-13','17:40:00','Cancelada',NULL),(12,20,8,'2024-11-14','15:00:00','Atendida',NULL),(13,21,8,'2024-11-13','10:40:00','Pendiente',NULL),(14,20,9,'2024-11-14','15:20:00','Cancelada',NULL),(15,20,10,'2024-11-18','15:00:00','Cancelada',NULL),(38,20,9,'2024-11-26','15:00:00','Atendida',NULL),(39,20,9,'2024-11-26','15:20:00','Atendida',NULL),(40,29,9,'2024-11-26','10:00:00','Cancelada paciente',NULL),(41,29,9,'2024-11-26','10:20:00','Cancelada paciente','tengo que ir a urgencias'),(42,29,9,'2024-11-26','10:40:00','Cancelada paciente',NULL),(43,29,9,'2024-11-26','11:00:00','Atendida',NULL),(44,29,9,'2024-11-26','11:20:00','Pendiente',NULL);
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cita_has_cuestionario`
--

DROP TABLE IF EXISTS `cita_has_cuestionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cita_has_cuestionario` (
  `Cita_idCita` int NOT NULL COMMENT 'Llave foranea de la tabla cita',
  `Cuestionario_idCuestionario` int NOT NULL COMMENT 'Llave cuestionario de la tabla cita',
  PRIMARY KEY (`Cita_idCita`,`Cuestionario_idCuestionario`),
  KEY `fk_Cita_has_Cuestionario_Cuestionario1_idx` (`Cuestionario_idCuestionario`),
  KEY `fk_Cita_has_Cuestionario_Cita1_idx` (`Cita_idCita`),
  CONSTRAINT `fk_Cita_has_Cuestionario_Cita1` FOREIGN KEY (`Cita_idCita`) REFERENCES `cita` (`idCita`),
  CONSTRAINT `fk_Cita_has_Cuestionario_Cuestionario1` FOREIGN KEY (`Cuestionario_idCuestionario`) REFERENCES `cuestionario` (`idCuestionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita_has_cuestionario`
--

LOCK TABLES `cita_has_cuestionario` WRITE;
/*!40000 ALTER TABLE `cita_has_cuestionario` DISABLE KEYS */;
INSERT INTO `cita_has_cuestionario` VALUES (7,7),(8,8),(9,9),(10,10),(12,12),(13,13),(14,14),(15,15),(38,35),(39,36),(40,37),(41,38),(42,39),(43,40),(44,41);
/*!40000 ALTER TABLE `cita_has_cuestionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuestionario`
--

DROP TABLE IF EXISTS `cuestionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuestionario` (
  `idCuestionario` int NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla cuestionario',
  `Sintomas` varchar(45) NOT NULL COMMENT 'Sintomas que presenta actualmente el paciente',
  `Alergias` varchar(45) NOT NULL COMMENT 'Alergias que contiene el paciente',
  `Medicamentos_Actuales` varchar(45) NOT NULL COMMENT 'Medicamentos que actual consume el paciente',
  `Historial_Medico` varchar(45) NOT NULL COMMENT 'Historial de enfermedades del paciente',
  `Lugar_Dolor` varchar(45) NOT NULL COMMENT 'Parte del cuerpo donde siente dolor',
  PRIMARY KEY (`idCuestionario`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuestionario`
--

LOCK TABLES `cuestionario` WRITE;
/*!40000 ALTER TABLE `cuestionario` DISABLE KEYS */;
INSERT INTO `cuestionario` VALUES (4,'1','2','3','4','5'),(5,'1','2','3','4','5'),(6,'Tos','Si a la penicilina','Parecetamol','ninguna','garganta'),(7,'Tos','Si a la penicilina','Parecetamol','ninguna','garganta'),(8,'Tos','Si a la penicilina','Parecetamol','ninguna','garganta y pecho'),(9,'Dolor de cabeza','No','Ninguno','Diabetes','En la cabeza'),(10,'1','2','3','4','5'),(11,'8','9','7','6','5'),(12,'12','14','15','16','17'),(13,'Tos','No','NO','NO','No'),(14,'SI','SI','SI','SI','SI'),(15,'SI','SIS','IS','SI','SI'),(16,'sida','si','no','pene','culo'),(17,'Tos','Ninguna','Ninguna','Ninguan','Garganta'),(18,'si','si','s','is','i'),(20,'SI','SI','SI','SI','SI'),(21,'SI','SI','SI','SI','SI'),(22,'SI','SI','SI','SI','SI'),(23,'SI','SI','SI','SI','SI'),(24,'SI','SI','SI','SI','SI'),(25,'SI','SI','SI','SI','SI'),(27,'SIU','SIU','SIU','SIU','SIU'),(35,'UPE','UPE','UPE','UPE','UPE'),(36,'SI','SI','SI','SI','SI'),(37,'SI','S','I','SI','SI'),(38,'SI','SI','SI','SI','SI'),(39,'NO','NO','NO','NO','NO'),(40,'SI','SI','SI','SI','SI'),(41,'SI','SI','SI','SI','SI');
/*!40000 ALTER TABLE `cuestionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor` (
  `idDoctor` int NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla doctor',
  `Nombre` varchar(45) NOT NULL COMMENT 'Nombre de la persona',
  `A_Paterno` varchar(45) NOT NULL COMMENT 'Apellido paterno de la persona',
  `A_Materno` varchar(45) DEFAULT NULL COMMENT 'Apellido materno de la persona',
  `Genero` varchar(45) NOT NULL COMMENT 'Genero de la persona',
  `Cedula` varchar(45) NOT NULL COMMENT 'Numero de cedula profesional del doctor',
  `Usuario` varchar(45) NOT NULL COMMENT 'Nombre de usuario del doctor para iniciar sesion en la plataforma',
  `Contrasenia` varchar(45) NOT NULL COMMENT 'contrasenia para acceder a la plataforma',
  `Especialidad` varchar(45) NOT NULL COMMENT 'Especialidad que estudio el doctor',
  `Telefono` varchar(45) NOT NULL COMMENT 'Numero de telefono del doctor',
  `Horario_Atencion_I` time NOT NULL COMMENT 'Horario de inicio de atencion del doctor\n',
  `Horario_Atencion_F` time NOT NULL COMMENT 'Hora final en la cual termina de atender el doctor',
  `Fecha_Ingreso` date NOT NULL COMMENT 'Fecha de ingreso del doctor a la universidad como doctor',
  `Email` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`idDoctor`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (20,'Elias','Gordillo','Aram','Femenino','jaksdjk','Elias','elias','Enfermero','78787','15:00:00','18:00:00','2024-07-19',NULL),(21,'Giovanni','Vicera','Ortega','Masculino','VOGO22','Gio','SIU123','Enfermero','7774637291','10:00:00','18:00:00','2024-11-13',NULL),(23,'David','Rodriguez','Teran','Masculino','RTDO','david','123','Enfermero','77745698','15:00:00','21:00:00','2024-11-19',NULL),(27,'KEVIN','MISAEL','ROJAS','Masculino','CRUZ','RCKO','SIU123','ENFERMERO','12341','10:00:00','15:00:00','2024-11-24',NULL),(29,'Isais','Garcia','Mendoza','Masculino','vogo13123','isaias','SIU123','Enfermero','123151','10:00:00','18:00:00','2004-06-10','viog_dan@hotmail.com');
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamento`
--

DROP TABLE IF EXISTS `medicamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicamento` (
  `idMedicamento` int NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla medicamento',
  `Nombre` varchar(45) NOT NULL COMMENT 'Nombre del medicamento',
  `Descripcion` varchar(45) NOT NULL COMMENT 'Descripcion del medicamento',
  `Concentracion` varchar(45) NOT NULL COMMENT 'Cantidad que contiene el frasco o la presentacion del medicamento',
  `Fecha_Caducidad` date NOT NULL COMMENT 'Fecha en la cual ya no es recomendable el uso del medicamento',
  PRIMARY KEY (`idMedicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamento`
--

LOCK TABLES `medicamento` WRITE;
/*!40000 ALTER TABLE `medicamento` DISABLE KEYS */;
INSERT INTO `medicamento` VALUES (1,'Ninguno','Ninguno','Ninguno','2000-01-01'),(2,'Paracetamol','Analgésico y antipirético','500mg','2024-12-31'),(3,'Ibuprofeno2','Antiinflamatorio no esteroideo','200mg','2026-11-30'),(4,'Amoxicilina','Antibiótico de amplio espectro','250mg','2025-01-15'),(5,'Loratadina','Antihistamínico','10mg','2024-05-20'),(6,'Metformina','Antidiabético','850mg','2023-09-10'),(12,'Penicilina','si','si','2026-11-25');
/*!40000 ALTER TABLE `medicamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente` (
  `idPaciente` int NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla paciente',
  `Nombre` varchar(45) NOT NULL COMMENT 'Nombre del paciente',
  `A_Paterno` varchar(45) NOT NULL COMMENT 'Apellido paterno del paciente',
  `A_Materno` varchar(45) DEFAULT NULL COMMENT 'Apellido materno del paciente',
  `Genero` varchar(45) NOT NULL COMMENT 'Genero del paciente',
  `Matricula` varchar(45) NOT NULL COMMENT 'Matricula de la universidad del paciente que tambien sirve para iniciar sesion en la pagina',
  `Contrasenia` varchar(45) NOT NULL COMMENT 'Contrasenia del paciente para iniciar sesion en la plataforma',
  `Fecha_Nacimiento` date NOT NULL COMMENT 'Fecha de nacimiento del paciente',
  `Estado_Civil` varchar(45) DEFAULT NULL COMMENT 'Estado civil del paciente ',
  `Carrera_idCarrera` int NOT NULL COMMENT 'Llave foranea de la tabla carrera',
  PRIMARY KEY (`idPaciente`),
  KEY `fk_Paciente_Carrera1_idx` (`Carrera_idCarrera`),
  CONSTRAINT `fk_Paciente_Carrera1` FOREIGN KEY (`Carrera_idCarrera`) REFERENCES `carrera` (`idCarrera`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (8,'Anayeli','Guzman','Trinidad','Masculino','GTAO123','SIU123','2024-10-02','Soltero(a)',1),(9,'Joan1','Rosas1','Sanchez11','Masculino1','VOGO220141','SIU1234','2004-01-02','Soltero(a)',1),(10,'NayeMarra2','Guzman','Trinidad','Masculino','GTAO220386','123','2024-11-08','Soltero(a)',1);
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescripcion`
--

DROP TABLE IF EXISTS `prescripcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prescripcion` (
  `Horario` varchar(45) NOT NULL COMMENT 'Horario en la cual se tiene que administrar el medicamento',
  `Dosis` varchar(45) NOT NULL COMMENT 'Cantidad que se tiene que suministrar del medicamento',
  `Receta_idReceta` int NOT NULL COMMENT 'Llave foranea de la tabla receta',
  `Medicamento_idMedicamento` int NOT NULL COMMENT 'Llave foranea de la tabla medicamento',
  KEY `fk_Medicamento_has_Receta_Receta1_idx` (`Receta_idReceta`),
  KEY `fk_Prescripcion_Medicamento1_idx` (`Medicamento_idMedicamento`),
  CONSTRAINT `fk_Medicamento_has_Receta_Receta1` FOREIGN KEY (`Receta_idReceta`) REFERENCES `receta` (`idReceta`),
  CONSTRAINT `fk_Prescripcion_Medicamento1` FOREIGN KEY (`Medicamento_idMedicamento`) REFERENCES `medicamento` (`idMedicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescripcion`
--

LOCK TABLES `prescripcion` WRITE;
/*!40000 ALTER TABLE `prescripcion` DISABLE KEYS */;
INSERT INTO `prescripcion` VALUES ('siu','siu',4,2),('Ninguna','Ninguna',9,1),('cada 8 horas','2 ',10,3),('a','a',13,2),('Cada 8 horas','2',14,2),('Ninguno','Ninguno',15,1);
/*!40000 ALTER TABLE `prescripcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receta`
--

DROP TABLE IF EXISTS `receta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receta` (
  `idReceta` int NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla receta',
  `Recomendacion_Doctor` varchar(45) NOT NULL COMMENT 'Recomendaciones que el doctor sugiere al paciente',
  `Fecha_Emision` date NOT NULL COMMENT 'Fecha en la que se genero la receta',
  `Nota_Doctor` varchar(45) NOT NULL COMMENT 'Notas adicionales del doctor',
  `Tension_Arterial` varchar(45) NOT NULL COMMENT 'Nivel de Tension Arterial del paciente',
  `Frecuencia_Cardiaca` varchar(45) NOT NULL COMMENT 'Nivel de frecuencia cardiaca del paciente',
  `Frecuencia_Respiratoria` varchar(45) NOT NULL COMMENT 'Nivel de frecuencia respiratoria del paciente',
  `Temperatura` varchar(45) NOT NULL COMMENT 'Temparuta que presenta el paciente',
  `Diagnostico` varchar(45) NOT NULL COMMENT 'Diagnostico final de la enfermedad que tiene el paciente',
  `Cita_idCita` int NOT NULL COMMENT 'Llave foranea de la tabla cita',
  PRIMARY KEY (`idReceta`,`Cita_idCita`),
  KEY `fk_Receta_Cita1_idx` (`Cita_idCita`),
  CONSTRAINT `fk_Receta_Cita1` FOREIGN KEY (`Cita_idCita`) REFERENCES `cita` (`idCita`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receta`
--

LOCK TABLES `receta` WRITE;
/*!40000 ALTER TABLE `receta` DISABLE KEYS */;
INSERT INTO `receta` VALUES (4,'siu','2024-11-16','siu','siu','siu1231','siu','sius','iuis',14),(9,'1','2024-11-17','1','1','11','1','1','1',9),(10,'No bañarse','2024-11-19','Cita en 2 dias','90','120/80','90','38','Resfriado',12),(13,'1001','2024-11-24','10','10','10','10','10','10',38),(14,'Descanso','2024-11-25','Bajo de peso','90','120/80','90','36','Tos',39),(15,'SI','2024-11-25','SI','SI','SO','SI','S','SI',43);
/*!40000 ALTER TABLE `receta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-25 23:20:53
