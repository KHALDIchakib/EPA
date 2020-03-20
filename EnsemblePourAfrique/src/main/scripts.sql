

DROP TABLE IF EXISTS `message`;
DROP TABLE IF EXISTS `compte`;
DROP TABLE IF EXISTS `theme`;


CREATE TABLE `compte` (
  `compte_id` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `numeroPhone` varchar(256) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`compte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `theme` (
  `theme_id` int(20) NOT NULL AUTO_INCREMENT,
  `nom_theme` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `message` (
  `message_id` int(20) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) ,
  `text` varchar(256) ,
  `theme_id` int(20),
  `compte_id` int(20),
	`compte_response_id` int(20),
	`date` date,
  PRIMARY KEY (`message_id`),
  FOREIGN KEY (compte_id) REFERENCES compte(compte_id),
  FOREIGN KEY (compte_response_id) REFERENCES compte(compte_id),
  FOREIGN KEY (theme_id) REFERENCES theme(theme_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `theme` (`theme_id`, `nom_theme`) VALUES
(1, 'EMPLOI'),
(2, 'VEHICULES'),
(3, 'IMMOBILIER'),
(4, 'MAISON'),
(5, 'VACANCES'),
(6, 'MULTIMEDIA'),
(7, 'LOISIRS'),
(8, 'MATERIEL PROFESSIONNEL'),
(9, 'SERVICES'),
(10, 'AUTRES');

