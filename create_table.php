// Pour créer la table ticket dans une bdd nommée test

CREATE TABLE IF NOT EXISTS `ticket` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`temp_arrivee` datetime,
`description` text NOT NULL,
`severite` varchar(256) NOT NULL,
primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

// Insertion de nouveaux éléments dans la table ticket

INSERT INTO ticket VALUES (1, '2020-7-04', 'Problème de ...', 'urgent');
INSERT INTO ticket VALUES (2, '2019-1-01', 'Problème de ...', 'normal');
INSERT INTO ticket VALUES (3, '2019-2-06', 'Problème de ...','bas');
