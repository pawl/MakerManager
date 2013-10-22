--
-- Table structure for table `tbl_badges`
--

DROP TABLE IF EXISTS `tbl_badges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_badges` (
  `whmcs_user_id` int(12) NOT NULL DEFAULT '0',
  `badge` int(32) NOT NULL,
  `status` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  PRIMARY KEY (`whmcs_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
