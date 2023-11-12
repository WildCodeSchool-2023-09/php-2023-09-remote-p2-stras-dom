-- phpMyAdmin SQL Dump

-- version 4.5.4.1deb2ubuntu2

-- http://www.phpmyadmin.net

--

-- Client :  localhost

-- Généré le :  Jeu 26 Octobre 2017 à 13:53

-- Version du serveur :  5.7.19-0ubuntu0.16.04.1

-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */

;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */

;

/*!40101 SET NAMES utf8mb4 */

;

--

-- Base de données :  `simple-mvc`

--

-- --------------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `service` (
        `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(45) NOT NULL,
        `description` LONGTEXT NULL,
        `price` INT NOT NULL,
        `image` VARCHAR(100) NOT NULL
    );

INSERT INTO
    `service` (
        `name`,
        `description`,
        `price`,
        `image`
    )
VALUES (
        'Livraison de courses',
        'Que vous ne puissiez pas sortir ou que vous manquiez de temps, sont autant de raisons pour 
  avoir recours à quelqu’un qui fasse les courses à votre place. Si vous avez des difficultés à vous déplacer, 
  mais appréciez beaucoup sortir, une personne peut vous accompagner.',
        100,
        '/assets/images/course.jpeg'
    ), (
        'Travaux de petit bricolage',
        'Confiez-Nous réalise pour vous tous vos petits travaux de bricolage d\'entretien et de rénovation.
  Simplifiez-vous la vie, Confiez-Nous s\'organise en fonction de vos besoins,
  pour des missions à domicile ponctuelles ou régulières.',
        150,
        '/assets/images/bricolage.jpg'
    ), (
        'Petits travaux de jardinage',
        'Vous désirez un jardin bien entretenu, créer un massif de fleurs... 
  Plus de problèmes pour la tonte, le débroussaillage, la taille des haies et des rosiers, 
  l\'élagage des arbustes, pour désherber vos massifs ou potagers ou pour ramasser les feuilles l\'automne.
  Votre jardin sera toujours impeccable et notre intervenant saura le mettre en valeur.',
        90,
        '/assets/images/jardinage.jpeg'
    );

CREATE TABLE
    IF NOT EXISTS `user` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `firstname` VARCHAR(100) NOT NULL,
        `lastname` VARCHAR(100) NOT NULL,
        `email` VARCHAR(255) NOT NULL,
        `password` varchar(255) DEFAULT NULL,
        `adresse` TEXT NOT NULL,
        `isAdmin` BOOLEAN DEFAULT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `email_UNIQUE` (`email`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE
    IF NOT EXISTS `reservation` (
        `date` DATETIME NOT NULL,
        `is_disponible` BOOLEAN NOT NULL,
        `user_id` INT,
        `service_id` INT,
        CONSTRAINT `fk_reservation_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `fk_reservation_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO
    `reservation` (`date`, `is_disponible`)
VALUES ('2023-11-15 08:00:00', true), ('2023-11-16 10:30:00', true), ('2023-11-17 14:45:00', true), ('2023-11-18 16:20:00', true), ('2023-11-19 09:15:00', true);

--

-- Structure de la table `item`

--

CREATE TABLE
    `item` (
        `id` int(11) UNSIGNED NOT NULL,
        `title` varchar(255) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Contenu de la table `item`

--

INSERT INTO
    `item` (`id`, `title`)
VALUES (1, 'Stuff'), (2, 'Doodads');

--

-- Index pour les tables exportées

--

--

-- Index pour la table `item`

--

ALTER TABLE `item` ADD PRIMARY KEY (`id`);

--

-- AUTO_INCREMENT pour les tables exportées

--

--

-- AUTO_INCREMENT pour la table `item`

--

ALTER TABLE
    `item` MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

DROP TABLE IF EXISTS `user`;

/*!40101 SET @saved_cs_client     = @@character_set_client */

;

/*!50503 SET character_set_client = utf8mb4 */

/*!40101 SET character_set_client = @saved_cs_client */

;

--

-- Dumping data for table `user`

--

LOCK TABLES `user` WRITE;

/*!40000 ALTER TABLE `user` DISABLE KEYS */

;

INSERT INTO `user`
VALUES (
        1,
        'Vincent',
        'admin',
        'admin@admin.com',
        '$2y$10$3yG3wiy.m1c3XMiSd6MESu1YzE37dh5vv.DzZyycunzYfqiF42esq',
        '9 rue de Paris 75000 Paris',
        true
    );

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;