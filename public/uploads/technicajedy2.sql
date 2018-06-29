-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 04 Avril 2017 à 05:17
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `technicajedy`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_actualites`
--

CREATE TABLE IF NOT EXISTS `t_actualites` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_date` varchar(9) NOT NULL,
  `c_titre` varchar(30) NOT NULL,
  `c_text` varchar(500) NOT NULL,
  `c_lien` varchar(200) NOT NULL,
  `c_img1` varchar(200) NOT NULL,
  `c_img2` varchar(200) NOT NULL,
  `c_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `t_actualites`
--

INSERT INTO `t_actualites` (`c_id`, `c_date`, `c_titre`, `c_text`, `c_lien`, `c_img1`, `c_img2`, `c_active`) VALUES
(3, '08/07/201', 'rrrfrfrf', 'rfrfrfsz<qfqrferf', '', '', '', 1),
(4, '06/07/201', 'aaaazzz', 'aaazzzz', '', '', '', 0),
(5, '12/12/201', 'yolo', 'plpllpllp', '', '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_marques`
--

CREATE TABLE IF NOT EXISTS `t_marques` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_marque` varchar(30) NOT NULL,
  `c_description` varchar(500) NOT NULL,
  `c_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Contenu de la table `t_marques`
--

INSERT INTO `t_marques` (`c_id`, `c_marque`, `c_description`, `c_active`) VALUES
(2, 'Audi', 'Audi est un constructeur généraliste d’automobiles allemand, filiale du groupe Volkswagen appelé VAG qui détient la marque à 99,55 %. Le nom officiel de l’entreprise est Audi AG et son siège social se situe à Ingolstadt en Bavière', 1),
(3, 'MPW', 'BMW', 1),
(12, 'Ford', 'Ford', 1),
(14, 'Honda', 'Honda', 1),
(22, 'Mercedes', 'Mercedes', 1),
(25, 'Nisann', 'Nisann', 1),
(36, 'Smart', 'Smart', 1),
(39, 'Toyota', 'Toyota', 1),
(41, 'Volkswagen', 'Volkswagen', 1),
(43, 'Porsche', 'Porsche', 1),
(44, 'Lamborghini', 'Lamborghini', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_occasions`
--

CREATE TABLE IF NOT EXISTS `t_occasions` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id_marque` int(11) NOT NULL,
  `c_model` varchar(30) NOT NULL,
  `c_kilometrage` decimal(10,0) NOT NULL,
  `c_annee` int(11) NOT NULL,
  `c_energie` varchar(20) NOT NULL,
  `c_prmain` varchar(20) NOT NULL,
  `c_puissance` varchar(20) NOT NULL,
  `c_boite` int(11) NOT NULL,
  `c_prix` decimal(10,0) NOT NULL,
  `c_garantie` varchar(20) NOT NULL,
  `c_img1` varchar(200) DEFAULT NULL,
  `c_img2` varchar(200) DEFAULT NULL,
  `c_img3` varchar(200) DEFAULT NULL,
  `c_img4` varchar(200) DEFAULT NULL,
  `c_img5` varchar(200) DEFAULT NULL,
  `c_img6` varchar(200) DEFAULT NULL,
  `c_description` varchar(200) NOT NULL,
  `c_categorie` varchar(100) NOT NULL,
  `c_active` tinyint(1) NOT NULL,
  `c_vendu` tinyint(1) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `t_occasions`
--

INSERT INTO `t_occasions` (`c_id`, `c_id_marque`, `c_model`, `c_kilometrage`, `c_annee`, `c_energie`, `c_prmain`, `c_puissance`, `c_boite`, `c_prix`, `c_garantie`, `c_img1`, `c_img2`, `c_img3`, `c_img4`, `c_img5`, `c_img6`, `c_description`, `c_categorie`, `c_active`, `c_vendu`) VALUES
(2, 44, 'rrgf', '101011', 1010, 'GPL', '0', '8000 chevaux', 0, '2000', 'eee cfccf', '', '', '', '', '', '', 'ezffez ezf ezfez ezf ez f<div>&nbsp;</div><div>&nbsp;</div><div>e</div><div>e</div><div>fz</div><div>fez</div><div>fez</div><div>ezf</div><div>ezf</div><div>ez</div><div>f</div>', '', 1, 1),
(3, 12, 'fordxxx', '16000', 58, '0', '0', 'dzdzdzdzd', 0, '18000', '3 ans', '', '', '', '', '', '', '', '0', 0, 1),
(4, 12, '56', '20000', 1551, 'Diesel', '1', '555', 0, '55000', '2 ans', '14613624001377208_704153039635217_796566082_n.jpg', '1461362400capture.png', '', '', '', '', 'lalalla azer<div>entrer</div><div><br></div><div>space enter</div>', '', 1, 1),
(5, 2, '555', '6265', 22, 'Biocarburants', '0', 'ookoko', 0, '23000', '3 ans', '1461362400tangi.jpg', '14613624001377208_704153039635217_796566082_n.jpg', '', '', '', '', 'pppp<div>ooo</div><div>iii</div><div><br></div><div>oooo</div>', '', 1, 1),
(6, 14, '55', '55', 5, 'Diesel', '0', '55', 0, '55', '5', '14613624001377208_704153039635217_796566082_n.jpg', '', '', '', '', '', '55<div>55</div><div>55</div><div><span class="Apple-tab-span" style="white-space:pre">	</span></div><div>55<span class="Apple-tab-span" style="white-space:pre">	</span></div>', '', 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
