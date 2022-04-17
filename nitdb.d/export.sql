-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: level
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `bbs`
--

DROP TABLE IF EXISTS `bbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bbs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `face` int NOT NULL,
  `face_image` varchar(100) NOT NULL,
  `salary` int NOT NULL,
  `age` int NOT NULL,
  `hight` int NOT NULL,
  `weight` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `face2` int DEFAULT NULL,
  `salary2` int DEFAULT NULL,
  `age2` int DEFAULT NULL,
  `hight2` int DEFAULT NULL,
  `weight2` int DEFAULT NULL,
  `update_day` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bbs`
--

LOCK TABLES `bbs` WRITE;
/*!40000 ALTER TABLE `bbs` DISABLE KEYS */;
INSERT INTO `bbs` VALUES (1,'朝田真奈',54,'asadamana.jpeg',250,27,158,50,NULL,NULL,78,-5,4,30,0,'2022-04-15'),(2,'西山香恋',87,'nisiyamakarenn24.jpeg',240,22,165,45,NULL,NULL,140,-6,-1,30,-10,'2022-04-15'),(3,'田中秋保',-1,'tanakaakiho.jpeg',320,53,150,62,NULL,NULL,2,2,30,30,23,'2022-04-15'),(4,'カール',15,'carru.jpeg',500,54,160,65,NULL,NULL,23,20,31,30,16,'2022-04-15'),(5,'萌野梨々香',16,'moenoririka46.jpeg',360,46,158,56,NULL,NULL,27,6,23,30,7,'2022-04-15'),(6,'白木佳奈',51,'sirakikana.jpeg',420,36,158,46,NULL,NULL,77,12,13,30,-5,'2022-04-15'),(7,'大子目美里',25,'oogomemisato40.jpeg',470,40,156,42,NULL,NULL,38,17,17,30,-8,'2022-04-15'),(8,'南花子',34,'minamihanako54.jpeg',330,54,163,60,NULL,NULL,50,3,31,30,8,'2022-04-15'),(9,'中野美穂',36,'nakanomiho.jpeg',450,39,166,57,NULL,NULL,54,15,16,30,2,'2022-04-15'),(10,'西倉真紀子',29,'nisikuramakiko.jpeg',550,48,162,60,NULL,NULL,44,25,25,30,9,'2022-04-15'),(11,'彩栄子',82,'saieiko.jpeg',420,21,164,46,NULL,NULL,125,12,-2,30,-9,'2022-04-15'),(12,'小倉ここ',25,'ogurakoko.jpeg',310,24,157,44,NULL,NULL,36,1,1,30,-6,'2022-04-15'),(13,'乾楓',69,'Inuikaede.jpeg',280,27,165,56,NULL,NULL,105,-2,4,30,2,'2022-04-15'),(14,'狩野彩芽',31,'kanouayame.jpeg',430,28,162,48,NULL,NULL,47,13,5,30,-5,'2022-04-15'),(15,'香椎花',63,'kasiihana.jpeg',380,26,159,49,NULL,NULL,95,8,3,30,-2,'2022-04-15'),(16,'花巻瞳',30,'hanamakihitomi.jpeg',280,22,156,50,NULL,NULL,45,-2,-1,30,2,'2022-04-15'),(17,'海野友奈',21,'uminotomona.jpeg',310,25,162,55,NULL,NULL,33,1,2,30,3,'2022-04-15'),(18,'佐藤裕香',76,'satouyuuka.jpeg',260,26,166,56,NULL,NULL,114,-4,3,30,1,'2022-04-15'),(19,'賀来詩織',85,'kakusiori.jpeg',300,23,163,45,NULL,NULL,132,0,0,30,-9,'2022-04-15'),(20,'百沢菜津子',86,'momosawanatuko.jpeg',260,22,158,48,NULL,NULL,128,-4,-1,30,-2,'2022-04-15'),(21,'小林エリー',74,'kobayasiery.jpeg',430,27,160,55,NULL,NULL,111,13,4,30,4,'2022-04-15'),(22,'浦添優',42,'urazoeyuu.jpeg',360,27,155,48,NULL,NULL,63,6,4,30,0,'2022-04-15'),(23,'篠原ひな',50,'sinoharahina.jpeg',380,26,162,52,NULL,NULL,75,8,3,30,-1,'2022-04-15'),(24,'工藤小百合',48,'kudousayuri.jpeg',440,28,161,55,NULL,NULL,72,14,5,30,4,'2022-04-15'),(25,'佐伯菜穂子',75,'saekinahoko.jpeg',360,28,159,43,NULL,NULL,110,6,5,30,-9,'2022-04-15'),(26,'古賀美奈子',7,'Kogaminako.jpeg',280,26,160,72,NULL,NULL,12,-2,3,30,24,'2022-04-15'),(27,'天乃美紀',74,'amanomiki.jpeg',520,27,159,42,NULL,NULL,113,22,4,30,-10,'2022-04-15'),(28,'逸見ナナ',26,'hennminana.jpeg',240,28,158,53,NULL,NULL,41,-6,5,30,4,'2022-04-15'),(29,'福岡紗子',20,'hukuokasaeko.jpeg',380,27,160,48,NULL,NULL,30,8,4,30,-4,'2022-04-15'),(30,'新島萌',54,'niijimamoe.jpeg',360,25,157,50,NULL,NULL,81,6,2,30,1,'2022-04-15'),(31,'村田美江',3,'muratayosie.jpeg',380,33,160,98,NULL,NULL,5,8,10,30,55,'2022-04-15'),(32,'石井めろん',4,'isiimeronn.jpeg',240,22,154,70,NULL,NULL,3,-6,-1,30,29,'2022-04-15'),(33,'泉川莉奈',65,'izumikawarina.jpeg',450,26,166,56,NULL,NULL,96,15,3,30,1,'2022-04-15'),(34,'都久美',43,'miyakokumi.jpeg',380,28,158,40,NULL,NULL,65,8,5,30,-12,'2022-04-15'),(35,'遠藤桃子',11,'endoumomoko.jpeg',280,30,158,73,NULL,NULL,15,-2,7,30,28,'2022-04-15'),(36,'大森桜',87,'oomorisakura.jpeg',320,26,158,43,NULL,NULL,134,2,3,30,-8,'2022-04-15'),(37,'真木愛華',61,'makiaika.jpeg',340,24,163,55,NULL,NULL,90,4,1,30,2,'2022-04-15'),(38,'梅田陽',70,'umedayou.jpeg',340,24,158,46,NULL,NULL,108,4,1,30,-5,'2022-04-15'),(39,'小野凛',56,'onorinn.jpeg',420,26,158,52,NULL,NULL,83,12,3,30,2,'2022-04-15'),(40,'石川優',86,'isikawayuu.jpeg',580,26,166,48,NULL,NULL,135,28,3,30,-8,'2022-04-15'),(41,'佐々木史乃',46,'sasakihumino.jpeg',620,34,156,44,NULL,NULL,69,32,11,30,-6,'2022-04-15'),(42,'矢吹恋',59,'yabukiren.jpeg',200,20,162,50,NULL,NULL,89,-10,-3,30,-3,'2022-04-15'),(43,'屋部聡美',51,'yabesatomi.jpeg',420,26,158,50,NULL,NULL,80,12,3,30,0,'2022-04-15'),(44,'奥村美緒',21,'okumuramio.jpeg',300,24,159,68,NULL,NULL,32,0,1,30,21,'2022-04-15'),(45,'花本來未',107,'hanamotokumi.jpeg',250,24,156,40,NULL,NULL,146,-5,1,30,-11,'2022-04-15'),(46,'新堂由紀',67,'sindouyuki.jpeg',550,20,157,45,NULL,NULL,102,25,-3,30,-5,'2022-04-15'),(47,'金井望美',18,'kanainozomi.jpeg',340,32,153,60,NULL,NULL,24,4,9,30,17,'2022-04-15'),(48,'近藤恵美',6,'kondouemi31.jpeg',480,31,160,80,NULL,NULL,6,18,8,30,34,'2022-04-15'),(49,'今井英玲奈',23,'imaierena.jpeg',450,27,153,45,NULL,NULL,35,15,4,30,-2,'2022-04-15'),(50,'仲真元子',4,'nakamamotoko.jpeg',600,55,160,47,NULL,NULL,8,30,32,30,-5,'2022-04-15'),(51,'井本彩',22,'imotosayaka.jpeg',520,27,159,49,NULL,NULL,33,22,4,30,-2,'2022-04-15'),(52,'武藤優里香',19,'mutouyurika.jpeg',530,29,162,48,NULL,NULL,30,23,6,30,-5,'2022-04-15'),(53,'丸山佳奈',39,'maruyamakana.jpeg',600,29,153,38,NULL,NULL,59,30,6,30,-11,'2022-04-15'),(54,'佐山ひなこ',48,'sayamahinako.jpeg',630,29,163,39,NULL,NULL,71,33,6,30,-16,'2022-04-15'),(55,'大森素子',33,'oomorimotoko.jpeg',440,27,160,48,NULL,NULL,48,14,4,30,-4,'2022-04-15'),(56,'新井優',39,'araiyu32.jpeg',550,32,163,42,NULL,NULL,60,25,9,30,-13,'2022-04-15'),(57,'江藤美香',44,'etoumika30.jpeg',480,30,161,48,NULL,NULL,68,18,7,30,-4,'2022-04-15'),(58,'華田美咲',55,'hanadamisaki24.jpeg',470,24,163,40,NULL,NULL,84,17,1,30,-15,'2022-04-15'),(59,'久本亜美',9,'hisamotoami28.jpeg',390,28,162,79,NULL,NULL,14,9,5,30,30,'2022-04-15'),(60,'半田美奈',79,'hanndamina25.jpeg',400,25,155,42,NULL,NULL,120,10,2,30,-8,'2022-04-15'),(61,'本間由依',34,'honnmayui.jpeg',600,28,165,40,NULL,NULL,51,30,5,30,-16,'2022-04-15'),(62,'五十嵐由美',62,'igarasiyumi23.jpeg',350,23,160,37,NULL,NULL,93,5,0,30,-17,'2022-04-15'),(63,'飯島真帆',26,'iijimamaho28.jpeg',530,26,163,45,NULL,NULL,39,23,3,30,-9,'2022-04-15'),(64,'飯塚ことり',28,'iizukakotori25.jpeg',440,25,168,50,NULL,NULL,42,14,2,30,-7,'2022-04-15'),(65,'加賀優菜',107,'kagayuuna32.jpeg',800,32,172,50,NULL,NULL,147,50,9,30,-9,'2022-04-15'),(66,'春日菜月',37,'kasuganatuki26.jpeg',450,26,164,55,NULL,NULL,56,15,3,30,1,'2022-04-15'),(67,'河本風香',45,'kawamotohuuka28.jpeg',430,28,161,45,NULL,NULL,66,13,5,30,-8,'2022-04-15'),(68,'川瀬なな',27,'kawasenana.jpeg',400,27,158,50,NULL,NULL,45,10,4,30,0,'2022-04-15'),(69,'木梨みさき',43,'kinasimisaki23.jpeg',320,23,169,43,NULL,NULL,65,2,0,30,-15,'2022-04-15'),(70,'岸裕美子',87,'kisiyumiko28.jpeg',800,28,165,40,NULL,NULL,141,50,5,30,-16,'2022-04-15'),(71,'北見里佳子',28,'kitamirikako35.jpeg',480,35,158,60,NULL,NULL,41,18,12,30,12,'2022-04-15'),(72,'橘田咲',24,'kittasaki23.jpeg',380,23,163,37,NULL,NULL,36,8,0,30,-18,'2022-04-15'),(73,'小暮梨々香',84,'kogureririka22.jpeg',350,22,158,45,NULL,NULL,126,5,-1,30,-6,'2022-04-15'),(74,'吉田幸',38,'yosidasati26.jpeg',430,26,160,43,NULL,NULL,57,13,3,30,-10,'2022-04-15'),(75,'久保田梨奈',70,'kubotarina.jpeg',630,34,158,40,NULL,NULL,104,33,11,30,-12,'2022-04-15'),(76,'熊野花',10,'kumanohana35.jpeg',400,35,165,73,NULL,NULL,17,10,12,30,20,'2022-04-15'),(77,'牧恵美',87,'makiemi32.jpeg',650,32,168,50,NULL,NULL,138,35,9,30,-7,'2022-04-15'),(78,'町田裕香',87,'matidayuka26.jpeg',500,26,164,48,NULL,NULL,129,20,3,30,-6,'2022-04-15'),(79,'野沢晶',42,'nozawaaki23.jpeg',360,23,163,52,NULL,NULL,62,6,0,30,-1,'2022-04-15'),(80,'小野花音',56,'onokanon21.jpeg',700,21,162,43,NULL,NULL,86,40,-2,30,-11,'2022-04-15'),(81,'大森ゆり',30,'oomoriyuri24.jpeg',500,24,168,42,NULL,NULL,44,20,1,30,-15,'2022-04-15'),(82,'ローラ',106,'rorra20.jpeg',320,20,164,45,NULL,NULL,149,2,-3,30,-10,'2022-04-15'),(83,'佐藤紗枝',20,'satousae22.jpeg',400,22,158,55,NULL,NULL,29,10,-1,30,6,'2022-04-15'),(84,'白石悠',44,'siraisiyuu34.jpeg',500,34,159,54,NULL,NULL,68,20,11,30,4,'2022-04-15'),(85,'鈴木美乃',32,'suzukiyosino23.jpeg',400,23,162,53,NULL,NULL,51,10,0,30,1,'2022-04-15'),(86,'高木紗英',44,'takagisae24.jpeg',420,24,158,50,NULL,NULL,66,12,1,30,0,'2022-04-15'),(87,'高瀬菜々子',31,'takasenanako24.jpeg',400,24,160,53,NULL,NULL,44,10,1,30,2,'2022-04-15'),(88,'田中志保',78,'tanakasiho30.jpeg',550,30,174,50,NULL,NULL,116,25,7,30,-10,'2022-04-15'),(98,'bbb',50,'1439531531625aa93185a9d6.83562571.jpeg',500,28,180,73,'bbb','$2y$10$w/FpSO5HMEPAm/3zX8JkUuMl1B9mVIMUGAmXkjPIr60jPt6IHenu6',75,20,5,30,5,'2022-04-16');
/*!40000 ALTER TABLE `bbs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mbbs`
--

DROP TABLE IF EXISTS `mbbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mbbs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `face` int NOT NULL,
  `mface_image` varchar(100) NOT NULL,
  `salary` int NOT NULL,
  `age` int NOT NULL,
  `hight` int NOT NULL,
  `weight` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `face2` int DEFAULT NULL,
  `salary2` int DEFAULT NULL,
  `age2` int DEFAULT NULL,
  `hight2` int DEFAULT NULL,
  `weight2` int DEFAULT NULL,
  `update_day` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mbbs`
--

LOCK TABLES `mbbs` WRITE;
/*!40000 ALTER TABLE `mbbs` DISABLE KEYS */;
INSERT INTO `mbbs` VALUES (1,'江崎健',87,'ezakiken.jpeg',650,29,177,55,NULL,NULL,131,35,1,27,-5,'2022-04-15'),(2,'奥田昇太',24,'okudashouta.jpeg',450,26,177,82,NULL,NULL,38,15,2,27,12,'2022-04-15'),(3,'近藤優希',51,'kondouyuuki.jpeg',380,24,183,75,NULL,NULL,78,8,4,33,5,'2022-04-15'),(4,'東幹斗',86,'higasimikito.jpeg',450,25,182,62,NULL,NULL,129,15,3,32,-3,'2022-04-15'),(5,'川津翔太',52,'kawatushouta.jpeg',400,24,175,70,NULL,NULL,75,10,4,25,6,'2022-04-15'),(6,'柳啓介',62,'ryuukeisuke.jpeg',770,32,176,77,NULL,NULL,90,47,4,26,10,'2022-04-15'),(7,'佐久間和樹',58,'sakumakazuki.jpeg',450,30,174,70,NULL,NULL,83,15,2,24,6,'2022-04-15'),(8,'佐藤裕樹',69,'satouyuuki.jpeg',650,34,176,58,NULL,NULL,104,35,6,26,-3,'2022-04-15'),(9,'澁谷拓弘',64,'sibuyatakuhiro.jpeg',440,29,179,75,NULL,NULL,95,14,1,29,7,'2022-04-15'),(10,'新垣翔',58,'singakishou.jpeg',400,25,168,55,NULL,NULL,87,10,3,18,-1,'2022-04-15'),(11,'田中幸樹',52,'tanakakouki.jpeg',420,26,172,66,NULL,NULL,83,12,2,22,5,'2022-04-15'),(12,'田中達也',35,'tanakatatsuya.jpeg',320,23,169,60,NULL,NULL,51,2,5,19,2,'2022-04-15'),(13,'安達拓也',22,'adachitakuya.jpeg',680,37,170,70,NULL,NULL,36,38,9,20,8,'2022-04-15'),(14,'アダム・ベン',45,'adamuben.jpeg',450,32,185,87,NULL,NULL,69,15,4,35,11,'2022-04-15'),(15,'網戸健',13,'ajitoken.jpeg',480,34,165,62,NULL,NULL,21,18,6,15,6,'2022-04-15'),(16,'天野良',33,'amanoryou.jpeg',330,25,165,59,NULL,NULL,51,3,3,15,3,'2022-04-15'),(17,'甘野武',64,'amanotakeshi.jpeg',400,25,179,70,NULL,NULL,95,10,3,29,4,'2022-04-15'),(18,'青木雅史',15,'aokimasashi.jpeg',400,27,168,68,NULL,NULL,23,10,1,18,8,'2022-04-15'),(19,'朝野空',93,'asanosora.jpeg',3000,24,177,55,NULL,NULL,137,100,4,27,-5,'2022-04-15'),(20,'出川康太',62,'degawakouta.jpeg',400,25,175,70,NULL,NULL,92,10,3,25,6,'2022-04-15'),(21,'土井健志',66,'doitakasi.jpeg',580,28,179,70,NULL,NULL,102,28,0,29,4,'2022-04-15'),(22,'遠藤久夫',4,'endohisao.jpeg',450,42,167,80,NULL,NULL,6,15,14,17,17,'2022-04-15'),(23,'遠藤登紀夫',60,'endotokio.jpeg',380,27,178,73,NULL,NULL,89,8,1,28,6,'2022-04-15'),(24,'円堂智',31,'endousatosi.jpeg',560,36,173,75,NULL,NULL,50,26,8,23,10,'2022-04-15'),(25,'藤井弘',45,'fujiihiroshi.jpeg',2500,35,178,68,NULL,NULL,68,100,7,28,3,'2022-04-15'),(26,'後藤裕樹',28,'gotouyuuki.jpeg',1500,34,182,84,NULL,NULL,42,100,6,32,11,'2022-04-15'),(27,'橋本元太',62,'hashimotogennta.jpeg',480,28,183,80,NULL,NULL,93,18,0,33,8,'2022-04-15'),(28,'橋下浩二',34,'hashimotokouji.jpeg',470,33,168,66,NULL,NULL,48,17,5,18,7,'2022-04-15'),(29,'林忠司',29,'hayashitadashu.jpeg',430,27,178,75,NULL,NULL,41,13,1,28,7,'2022-04-15'),(30,'林俊次',29,'hayashitoshitsugu.jpeg',600,37,174,60,NULL,NULL,44,30,9,24,0,'2022-04-15'),(31,'本間悠介',58,'honnmayuusuke.jpeg',350,24,174,65,NULL,NULL,90,5,4,24,3,'2022-04-15'),(32,'星和也',60,'hoshikazuya.jpeg',560,27,179,63,NULL,NULL,95,26,1,29,-1,'2022-04-15'),(33,'星野智樹',19,'hoshinotomoki.jpeg',430,26,173,63,NULL,NULL,27,13,2,23,2,'2022-04-15'),(34,'深田秀',38,'hukadashuu.jpeg',430,27,183,59,NULL,NULL,59,13,1,33,-5,'2022-04-15'),(35,'福山慎吾',95,'hukuyamashingo.jpeg',350,26,176,66,NULL,NULL,143,5,2,26,3,'2022-04-15'),(36,'福山太郎',9,'hukuyamatarou.jpeg',400,27,173,82,NULL,NULL,17,10,1,23,15,'2022-04-15'),(37,'古川拓也',52,'hurukawatakuya.jpeg',420,26,175,63,NULL,NULL,77,12,2,25,1,'2022-04-15'),(38,'井上剛',42,'inouegou.jpeg',630,29,177,70,NULL,NULL,60,33,1,27,5,'2022-04-15'),(39,'吉澤公',100,'yosizawakou.jpeg',500,27,183,72,NULL,NULL,150,20,1,33,3,'2022-04-15'),(40,'石井俊哉',66,'ishiishunnya.jpeg',480,26,185,69,NULL,NULL,98,18,2,35,0,'2022-04-15'),(41,'石綿哲史',49,'isiwatatetusi.jpeg',790,36,175,70,NULL,NULL,75,49,8,25,6,'2022-04-15'),(42,'岩渕凛',53,'iwabutirin.jpeg',400,25,173,52,NULL,NULL,80,10,3,23,-5,'2022-04-15'),(43,'神野優希',37,'jinnnoyuuki.jpeg',370,22,174,63,NULL,NULL,68,7,6,24,2,'2022-04-15'),(44,'加賀美聡',48,'kagamisatosi.jpeg',420,23,167,63,NULL,NULL,72,12,5,17,5,'2022-04-15'),(45,'亀山大樹',39,'kameyamataiki.jpeg',380,27,174,70,NULL,NULL,59,8,1,24,6,'2022-04-15'),(46,'金井浩輔',73,'kanaikousuke.jpeg',400,24,174,59,NULL,NULL,108,10,4,24,-1,'2022-04-15'),(47,'加藤倫',84,'katourin.jpeg',380,24,177,68,NULL,NULL,126,8,4,27,3,'2022-04-15'),(48,'鹿山正樹',83,'kayamamasaki.jpeg',490,26,174,63,NULL,NULL,125,19,2,24,2,'2022-04-15'),(49,'木部真也',55,'kibesinnya.jpeg',380,23,170,60,NULL,NULL,83,8,5,20,2,'2022-04-15'),(50,'木村誠也',38,'kimuraseiya.jpeg',450,24,176,59,NULL,NULL,57,15,4,26,-2,'2022-04-15'),(51,'小林智司',64,'kobayasisatosi.jpeg',420,26,182,62,NULL,NULL,96,12,2,32,-3,'2022-04-15'),(52,'古河淳',1,'kogaatusi.jpeg',600,59,170,55,NULL,NULL,0,30,31,20,-2,'2022-04-15'),(53,'小久保崇史',53,'kokubotakahumi.jpeg',480,25,173,64,NULL,NULL,81,18,3,23,3,'2022-04-15'),(54,'木崎綾人',93,'kizakiayato.jpeg',620,27,182,68,NULL,NULL,141,32,1,32,1,'2022-04-15'),(55,'久保裕太',56,'kuboyuuta.jpeg',370,23,176,66,NULL,NULL,86,7,5,26,3,'2022-04-15'),(56,'工藤涼太',88,'kudouryouta.jpeg',470,32,177,60,NULL,NULL,134,17,4,27,-2,'2022-04-15'),(57,'桑田真琴',56,'kuwatamakoto.jpeg',490,25,168,60,NULL,NULL,83,19,3,18,3,'2022-04-15'),(58,'前田翔',58,'maedashou.jpeg',420,26,173,62,NULL,NULL,87,12,2,23,1,'2022-04-15'),(59,'松本弘樹',77,'matsumotohiroki.jpeg',1300,29,180,70,NULL,NULL,114,100,1,30,3,'2022-04-15'),(60,'松本孝',14,'matsumotokou.jpeg',500,28,174,80,NULL,NULL,18,20,0,24,13,'2022-04-15'),(61,'真山幸樹',23,'mayamakouki.jpeg',380,29,168,61,NULL,NULL,33,8,1,18,3,'2022-04-15'),(62,'南研',17,'minamiken.jpeg',2800,36,174,76,NULL,NULL,27,100,8,24,10,'2022-04-15'),(63,'三浦和也',75,'miurakazuya.jpeg',350,23,177,58,NULL,NULL,113,5,5,27,-3,'2022-04-15'),(64,'宮本有紀',18,'miyamotoyuuki.jpeg',970,26,180,83,NULL,NULL,24,67,2,30,11,'2022-04-15'),(65,'本島健太',72,'motojimakennta.jpeg',550,28,173,57,NULL,NULL,110,25,0,23,-2,'2022-04-15'),(66,'村田健吾',30,'muratakengo.jpeg',420,27,186,93,NULL,NULL,45,12,1,36,14,'2022-04-15'),(67,'中居良太',36,'nakairyouta.jpeg',2200,38,173,59,NULL,NULL,53,100,10,23,-1,'2022-04-15'),(68,'中村昴',48,'nakamurasubaru.jpeg',890,33,182,60,NULL,NULL,71,59,5,32,-4,'2022-04-15'),(69,'中野宏太',42,'nakanokouta.jpeg',400,23,170,60,NULL,NULL,65,10,5,20,2,'2022-04-15'),(70,'成田公也',85,'naritakimiya.jpeg',880,27,180,70,NULL,NULL,128,58,1,30,3,'2022-04-15'),(71,'西山元輝',54,'nisiyamamotoki.jpeg',430,24,168,60,NULL,NULL,68,13,4,18,3,'2022-04-15'),(72,'野沢大輔',69,'nozawadaisuke.jpeg',440,25,176,65,NULL,NULL,101,14,3,26,2,'2022-04-15'),(73,'小田敬',19,'odatakasi.jpeg',770,36,167,58,NULL,NULL,29,47,8,17,2,'2022-04-15'),(74,'尾形太朗',2,'ogatatarou.jpeg',660,37,165,70,NULL,NULL,5,36,9,15,11,'2022-04-15'),(75,'荻野一馬',79,'oginoitiva.jpeg',480,26,183,63,NULL,NULL,119,18,2,33,-2,'2022-04-15'),(76,'小野陽太',55,'onoyouta.jpeg',330,22,170,58,NULL,NULL,83,3,6,20,0,'2022-04-15'),(77,'大森俊',46,'oomorishun.jpeg',1300,34,168,68,NULL,NULL,69,100,6,18,8,'2022-04-15'),(78,'小澤健史',52,'ozawatakeshi.jpeg',520,29,170,60,NULL,NULL,80,22,1,20,2,'2022-04-15'),(79,'柳啓介',54,'ryuukeisuke.jpeg',670,33,180,73,NULL,NULL,78,37,5,30,5,'2022-04-15'),(139,'aaa',50,'1682289583625b5917c780d5.07782941.jpeg',500,28,180,73,'aaa','$2y$10$RcReHSSQ72kbNe9NH1aJY.eDfhuYMf4y7y2QUIoyunc02VrEOaVQO',75,20,1,30,5,'2022-04-17');
/*!40000 ALTER TABLE `mbbs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-17  0:31:03
