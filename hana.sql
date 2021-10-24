-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 30 avr. 2019 à 14:34
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hana`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `BilanSante` (IN `animaux ` INT(20), IN `typeBilanSante ` INT(20), IN `dateTest` DATE, IN `nom` VARCHAR(20), IN `qtee` INT(20), IN `resultat` INT(20))  NO SQL
if(SELECT stockmedicament.qte FROM stockmedicament WHERE
  stockmedicament.nomMedicament = nom) >  qtee THEN
  UPDATE stockmedicament SET stockmedicament.qte=stockmedicament.qte - qtee
   WHERE stockmedicament.nomMedicament=nom; 
   INSERT INTO bilansante(animaux,typeBilanSante,dateTest,nomMedicament,qteMedic,resultat)
   VALUES (animaux,typeBilanSante,dateTest,nom,qtee,resultat);
   
   END IF$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Procedurevente` (IN `idl` INT(40), IN `dateVente` DATE, IN `herd` VARCHAR(40), IN `poidsVente` INT(40), IN `prixVente` INT(40), IN `transport` VARCHAR(40))  NO SQL
DELETE FROM livestock WHERE livestock.idl = idl$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ProcFood` (IN `idl` INT(40), IN `typef` VARCHAR(40), IN `qtef` INT(40))  NO SQL
IF(SELECT stockfood.qte  FROM stockfood WHERE stockfood.foodtype = typef) > qtef THEN 
    UPDATE stockfood SET stockfood.qte = stockfood.qte - qtef
    WHERE stockfood.foodtype = typef; 
    INSERT INTO food(idl,typefood,qtefood) VALUES(idl,typef,qtef);
END IF$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `bilansante`
--

CREATE TABLE `bilansante` (
  `id` int(40) NOT NULL,
  `animaux` int(40) NOT NULL,
  `typeBilanSante` varchar(40) NOT NULL,
  `dateTest` date NOT NULL,
  `nomMedicament` varchar(40) NOT NULL,
  `qteMedic` int(40) NOT NULL,
  `resultat` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bilansante`
--

INSERT INTO `bilansante` (`id`, `animaux`, `typeBilanSante`, `dateTest`, `nomMedicament`, `qteMedic`, `resultat`) VALUES
(15, 19, 'bill of health', '2019-04-02', 'paneomast', 3, 'positive'),
(14, 20, 'Teeth', '2019-03-05', 'Orbiseall', 2, 'negative');

-- --------------------------------------------------------

--
-- Structure de la table `food`
--

CREATE TABLE `food` (
  `id` int(40) NOT NULL,
  `idl` int(40) NOT NULL,
  `typefood` varchar(40) NOT NULL,
  `qtefood` int(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `food`
--

INSERT INTO `food` (`id`, `idl`, `typefood`, `qtefood`) VALUES
(1, 16, 'cereales', 7),
(3, 18, 'cereales', 3);

-- --------------------------------------------------------

--
-- Structure de la table `herd`
--

CREATE TABLE `herd` (
  `id` int(11) NOT NULL,
  `herd` varchar(40) DEFAULT NULL,
  `id_animal` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `herd`
--

INSERT INTO `herd` (`id`, `herd`, `id_animal`) VALUES
(24, 'sokLhed', 0),
(23, 'soukSebt', 0);

-- --------------------------------------------------------

--
-- Structure de la table `livestock`
--

CREATE TABLE `livestock` (
  `idl` int(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `Troupeau` varchar(30) NOT NULL,
  `sexe` varchar(30) NOT NULL,
  `ID` varchar(30) NOT NULL,
  `DateNaissance` date DEFAULT NULL,
  `PoidsNaissance` varchar(30) DEFAULT NULL,
  `dateAchat` date NOT NULL,
  `PrixAchat` varchar(30) DEFAULT '0',
  `PoidsAchat` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livestock`
--

INSERT INTO `livestock` (`idl`, `type`, `Troupeau`, `sexe`, `ID`, `DateNaissance`, `PoidsNaissance`, `dateAchat`, `PrixAchat`, `PoidsAchat`) VALUES
(25, 'boucheriee', 'soukSebt', 'Feminin', '1', '2019-03-05', '10kg', '0000-00-00', '', '0'),
(26, 'huitjours', 'soukSebt', 'Masculin', '2', '0000-00-00', '', '2019-02-05', '5000DH', '60kg'),
(27, 'huitjours', 'soukSebt', 'Masculin', '3', '2019-04-21', '15Kg', '0000-00-00', '', ''),
(29, 'souslamere', 'soukSebt', 'Feminin', '5', '2019-01-11', '14Kg', '0000-00-00', '', ''),
(31, 'Ã©levage', 'soukSebt', 'Masculin', '7', '0000-00-00', '', '2018-11-12', '4500DH', '70kg'),
(32, 'boucheriee', 'sokLhed', 'Masculin', '8', '0000-00-00', '', '2018-08-09', '5000DH', '50Kg');

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE `prestation` (
  `id` int(20) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `Troupeau` varchar(20) DEFAULT NULL,
  `dateAchat` date NOT NULL DEFAULT '0000-00-00',
  `PrixAchat` varchar(20) NOT NULL DEFAULT '0',
  `PoidsAchat` int(20) NOT NULL DEFAULT '0',
  `idl` int(20) NOT NULL DEFAULT '0',
  `dateVente` date NOT NULL DEFAULT '0000-00-00',
  `herd` varchar(20) DEFAULT NULL,
  `poidVente` int(20) NOT NULL DEFAULT '0',
  `prixVente` varchar(20) NOT NULL DEFAULT '0',
  `transport` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `prestation`
--

INSERT INTO `prestation` (`id`, `type`, `Troupeau`, `dateAchat`, `PrixAchat`, `PoidsAchat`, `idl`, `dateVente`, `herd`, `poidVente`, `prixVente`, `transport`) VALUES
(1, NULL, NULL, '0000-00-00', '0', 0, 17, '2019-03-23', 'sokelhed', 30, '400', 'camiom'),
(2, 'huitjours', 'sokelhed', '2019-02-03', '300', 24, 0, '0000-00-00', NULL, 0, '0', NULL),
(3, 'boucheriee', 'sokelhed', '0000-00-00', '0', 0, 0, '0000-00-00', NULL, 0, '0', NULL),
(4, 'huitjours', 'sokelhed', '0000-00-00', '0', 0, 0, '0000-00-00', NULL, 0, '0', NULL),
(5, NULL, NULL, '0000-00-00', '0', 0, 18, '2019-04-09', 'soksebty', 45, '200', 'camiom'),
(6, 'boucheriee', 'soukSebt', '0000-00-00', '', 0, 0, '0000-00-00', NULL, 0, '0', NULL),
(7, 'huitjours', 'soukSebt', '2019-02-05', '5000DH', 60, 0, '0000-00-00', NULL, 0, '0', NULL),
(8, 'huitjours', 'soukSebt', '0000-00-00', '', 0, 0, '0000-00-00', NULL, 0, '0', NULL),
(9, 'boucheriee', 'sokLhed', '2019-06-11', '7000DH', 100, 0, '0000-00-00', NULL, 0, '0', NULL),
(10, 'souslamere', 'soukSebt', '0000-00-00', '', 0, 0, '0000-00-00', NULL, 0, '0', NULL),
(11, 'boucheriee', 'sokLhed', '2017-12-18', '8000DH', 100, 0, '0000-00-00', NULL, 0, '0', NULL),
(12, 'Ã©levage', 'soukSebt', '2018-11-12', '4500DH', 70, 0, '0000-00-00', NULL, 0, '0', NULL),
(13, 'boucheriee', 'sokLhed', '2018-08-09', '5000DH', 50, 0, '0000-00-00', NULL, 0, '0', NULL),
(14, NULL, NULL, '0000-00-00', '0', 0, 30, '2019-04-05', 'soukSebt', 110, '10000DH', 'camion'),
(15, NULL, NULL, '0000-00-00', '0', 0, 28, '2019-03-19', 'sokLhed', 130, '8500DH', 'pikup');

-- --------------------------------------------------------

--
-- Structure de la table `stockfood`
--

CREATE TABLE `stockfood` (
  `id` int(40) NOT NULL,
  `foodtype` varchar(40) NOT NULL,
  `qte` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stockfood`
--

INSERT INTO `stockfood` (`id`, `foodtype`, `qte`) VALUES
(7, 'cereales', '27'),
(6, 'foin', '20'),
(5, 'berbe', '45'),
(8, 'tournesol', '31');

-- --------------------------------------------------------

--
-- Structure de la table `stockmedicament`
--

CREATE TABLE `stockmedicament` (
  `id` int(40) NOT NULL,
  `nomMedicament` varchar(40) NOT NULL,
  `datePerime` date NOT NULL,
  `qte` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stockmedicament`
--

INSERT INTO `stockmedicament` (`id`, `nomMedicament`, `datePerime`, `qte`) VALUES
(9, 'Orbiseall', '2020-04-21', 45),
(13, 'paneomast', '2020-10-04', 42),
(12, 'Mastitif', '2020-11-23', 97);

-- --------------------------------------------------------

--
-- Structure de la table `transport`
--

CREATE TABLE `transport` (
  `id` int(40) NOT NULL,
  `type` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `transport`
--

INSERT INTO `transport` (`id`, `type`) VALUES
(18, 'camion'),
(19, 'pikup');

-- --------------------------------------------------------

--
-- Structure de la table `typeliv`
--

CREATE TABLE `typeliv` (
  `id` int(40) NOT NULL,
  `type` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typeliv`
--

INSERT INTO `typeliv` (`id`, `type`) VALUES
(18, 'souslamere'),
(16, 'boucheriee'),
(15, 'huitjours'),
(14, 'élevage');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(30) NOT NULL,
  `login` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `vaccine`
--

CREATE TABLE `vaccine` (
  `id` int(40) NOT NULL,
  `animaux` int(40) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(40) NOT NULL,
  `veterinaire` varchar(40) NOT NULL,
  `transport` varchar(40) NOT NULL,
  `PrixTrans` varchar(20) NOT NULL,
  `id_vetenaire` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vaccine`
--

INSERT INTO `vaccine` (`id`, `animaux`, `date`, `note`, `veterinaire`, `transport`, `PrixTrans`, `id_vetenaire`) VALUES
(20, 1, '2019-04-05', 'manque de nourriture', 'Dr.Buhami', 'pikup', '100DH', 0),
(19, 2, '2019-04-05', 'IL vomit ', 'Dr.Buhami', 'camion', '300DH', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `id` int(40) NOT NULL,
  `idl` int(40) NOT NULL,
  `dateVente` date NOT NULL,
  `herd` varchar(40) NOT NULL,
  `poidVente` varchar(40) NOT NULL,
  `prixVente` varchar(40) NOT NULL,
  `transport` varchar(40) NOT NULL,
  `id_herd` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`id`, `idl`, `dateVente`, `herd`, `poidVente`, `prixVente`, `transport`, `id_herd`) VALUES
(16, 1, '2019-03-19', 'sokLhed', '130', '8600DH', 'camion', 0),
(15, 1, '2019-04-05', 'sokLhed', '110', '10000DH', 'camion', 0);

-- --------------------------------------------------------

--
-- Structure de la table `veterinaire`
--

CREATE TABLE `veterinaire` (
  `id` int(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `Specialite` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `veterinaire`
--

INSERT INTO `veterinaire` (`id`, `name`, `Specialite`) VALUES
(1, 'Dr.Buhami', ''),
(2, 'Dr.Ahmed', 'veaux');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bilansante`
--
ALTER TABLE `bilansante`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `herd`
--
ALTER TABLE `herd`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livestock`
--
ALTER TABLE `livestock`
  ADD PRIMARY KEY (`idl`);

--
-- Index pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stockfood`
--
ALTER TABLE `stockfood`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stockmedicament`
--
ALTER TABLE `stockmedicament`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeliv`
--
ALTER TABLE `typeliv`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `veterinaire`
--
ALTER TABLE `veterinaire`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bilansante`
--
ALTER TABLE `bilansante`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `herd`
--
ALTER TABLE `herd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `livestock`
--
ALTER TABLE `livestock`
  MODIFY `idl` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `prestation`
--
ALTER TABLE `prestation`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `stockfood`
--
ALTER TABLE `stockfood`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `stockmedicament`
--
ALTER TABLE `stockmedicament`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `transport`
--
ALTER TABLE `transport`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `typeliv`
--
ALTER TABLE `typeliv`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `vaccine`
--
ALTER TABLE `vaccine`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `vente`
--
ALTER TABLE `vente`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `veterinaire`
--
ALTER TABLE `veterinaire`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
