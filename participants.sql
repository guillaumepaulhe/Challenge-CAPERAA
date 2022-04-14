-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 14 Avril 2022 à 09:55
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `caperaa`
--

-- --------------------------------------------------------

--
-- Structure de la table `participants`
--

CREATE TABLE `participants` (
  `idParticipant` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Sexe` varchar(5) NOT NULL,
  `Age` int(255) NOT NULL,
  `Taille` int(255) NOT NULL,
  `Poids` int(255) NOT NULL,
  `Ceinture` varchar(255) NOT NULL,
  `Nom_club` varchar(255) NOT NULL,
  `points` int(255) DEFAULT '0',
  `Poule` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `participants`
--

INSERT INTO `participants` (`idParticipant`, `Nom`, `Prenom`, `Sexe`, `Age`, `Taille`, `Poids`, `Ceinture`, `Nom_club`, `points`, `Poule`) VALUES
(26, 'Dupont', 'Titouan', 'Homme', 8, 127, 35, 'blanche', 'JUDO CLUB DES MARTRES DE VEYRE', 5, ''),
(27, 'Garot', 'Virgil', 'Homme', 9, 134, 40, 'blanche et jaune', 'AMICALE LAIQUE BEAUMONT JUDO', 3, ''),
(28, 'Célaire', 'Jacques', 'Homme', 10, 139, 45, 'jaune et orange', 'JUDO CLUB DES MARTRES DE VEYRE', 7, ''),
(30, 'Aules', 'Ethan', 'Homme', 7, 122, 35, 'orange', 'JUDO CLUB DES MARTRES DE VEYRE', 4, ''),
(31, 'Boud', 'Alban', 'Homme', 11, 140, 45, 'jaune', 'AMICALE LAIQUE BEAUMONT JUDO', 9, ''),
(32, 'Culet', 'Rolland', 'Homme', 9, 117, 32, 'jaune et orange', 'JUDO CLUB DES MARTRES DE VEYRE', 6, ''),
(33, 'Javelle', 'Aude', 'Femme', 10, 136, 43, 'jaune', 'AMICALE LAIQUE BEAUMONT JUDO', 2, ''),
(34, 'Manssoif', 'Gérard', 'Homme', 7, 115, 32, 'verte', 'JUDO CLUB DES MARTRES DE VEYRE', 4, ''),
(36, 'Ricot', 'Léa', 'Femme', 8, 115, 28, 'marron', 'AMICALE LAIQUE BEAUMONT JUDO', 2, ''),
(38, 'Michaud', 'Olivier', 'Homme', 9, 137, 55, 'orange', 'CENTRE LOISIRS LE CENDRE', 4, ''),
(39, 'Polant', 'Maxime', 'Homme', 7, 127, 26, 'verte', 'CENTRE LOISIRS LE CENDRE', 0, ''),
(40, 'Puino', 'Louis', 'Homme', 10, 155, 53, 'verte', 'CENTRE LOISIRS LE CENDRE', 0, ''),
(41, 'Dauna', 'Marine', 'Femme', 9, 127, 25, 'jaune', 'CENTRE LOISIRS LE CENDRE', 0, ''),
(42, 'Nom', 'Prenom', 'Sexe', 0, 0, 0, 'Ceinture', 'Nom_club', 0, ''),
(43, 'valleix', 'andrea', 'Homme', 11, 0, 41, 'orange et vert', 'JudoClub Vicomtois', 0, ''),
(44, 'amblard', 'jules', 'Homme', 10, 0, 39, 'orange et vert', 'JudoClub Vicomtois', 0, ''),
(45, 'perron', 'valentin', 'Homme', 10, 0, 47, 'orange et vert', 'JudoClub Vicomtois', 0, ''),
(46, 'BRUSTEL', 'Jannelle', 'Femme', 11, 0, 52, 'bleu', 'AL Beaumont judo', 0, ''),
(47, 'DECELLE', 'Constance', 'Femme', 11, 0, 37, 'bleu', 'AL Beaumont judo', 0, ''),
(48, 'JEANNIN', 'Camille', 'Femme', 10, 0, 39, 'vert', 'AL Beaumont judo', 0, ''),
(49, 'DE CONTRERAS', 'Jules', 'Homme', 11, 0, 57, 'marron', 'AL Beaumont judo', 0, ''),
(50, 'HENTZ', 'Louis', 'Homme', 10, 0, 65, 'vert et bleu', 'AL Beaumont judo', 0, ''),
(51, 'HAYMA', 'Huguo', 'Homme', 11, 0, 41, 'bleu', 'AL Beaumont judo', 0, ''),
(52, 'HONORE', 'Guillaume', 'Homme', 11, 0, 32, 'vert et bleu', 'AL Beaumont judo', 0, ''),
(53, 'ROUVEURE', 'Mathis', 'Homme', 11, 0, 48, 'bleu', 'AL Beaumont judo', 0, ''),
(54, 'PAGES', 'Blandine', 'Femme', 11, 0, 43, 'jaune et orange', 'Arts Martiaux Sauxillanges', 0, ''),
(55, 'PAGES', 'Florian', 'Homme', 10, 0, 38, 'jaune et orange', 'Arts Martiaux Sauxillanges', 0, ''),
(56, 'RODDIER', 'Axelle', 'Femme', 11, 0, 42, 'jaune et orange', 'Arts Martiaux Sauxillanges', 0, ''),
(57, 'BEAUFORT', 'Nicolas', 'Homme', 11, 0, 41, 'vert', 'le samourai issoire', 0, ''),
(58, 'Dubost ?', 'Cosme', 'Homme', 10, 0, 32, 'orange', 'asm', 0, ''),
(59, 'Pires ?', 'Enzo', 'Homme', 10, 0, 28, 'orange', 'asm', 0, ''),
(60, 'Desbuissons', 'Karl', 'Homme', 11, 0, 36, 'vert', 'asm', 0, ''),
(61, 'Sarre', 'Gregory', 'Homme', 11, 0, 32, 'orange', 'asm', 0, ''),
(62, 'Madeore', 'Brieuc', 'Homme', 10, 0, 35, 'orange et vert', 'asm', 0, ''),
(63, 'Barraud', 'Gaspard', 'Homme', 10, 0, 32, 'orange', 'asm', 0, ''),
(64, 'ROMMERSBACH', 'DUSTIN', 'Homme', 11, 0, 29, 'jaune et orange', 'judo club orcet', 0, ''),
(65, 'fouquet', 'pertusa', 'Homme', 10, 0, 43, 'jaune et orange', 'JC Bessard', 0, ''),
(66, 'martins', 'thibault', 'Homme', 11, 0, 33, 'vert', 'JC Bessard', 0, ''),
(67, 'meyer', 'camille', 'Femme', 10, 0, 44, 'orange et vert', 'JC Bessard', 0, ''),
(68, 'dufragne', 'ambre', 'Femme', 11, 0, 36, 'vert', 'JC Bessard', 0, ''),
(69, 'tereygeol', 'margot', 'Femme', 11, 0, 38, 'orange', 'JC Bessard', 0, ''),
(70, 'marino', 'gaspard', 'Homme', 10, 0, 70, 'jaune et orange', 'JC Bessard', 0, ''),
(71, 'bagay', 'ronan', 'Homme', 11, 0, 47, 'vert', 'JC Bessard', 0, ''),
(72, 'falgoux', 'martiale', 'Homme', 10, 0, 41, 'orange et vert', 'JC Bessard', 0, ''),
(73, 'THOMAS', 'MATHIS', 'Homme', 10, 0, 38, 'vert', 'judo club orcet', 0, ''),
(74, 'VIGOUROUX', 'MATEO', 'Homme', 10, 0, 34, 'orange', 'judo club orcet', 0, ''),
(75, 'thiers', 'eloi', 'Homme', 11, 0, 43, 'jaune et orange', 'JC Castelpontin', 0, ''),
(76, 'charnier', 'paul louis', 'Homme', 11, 0, 55, 'vert', 'JC Castelpontin', 0, ''),
(77, 'ferreira', 'claire', 'Femme', 10, 0, 30, 'orange', 'JC Castelpontin', 0, ''),
(78, 'PORTRAT', 'MATTEO', 'Homme', 10, 0, 42, 'orange', 'judo club orcet', 0, ''),
(79, 'BALESTRA', 'NOAH', 'Homme', 10, 0, 47, 'orange', 'judo club orcet', 0, ''),
(80, 'raynaud', 'lucie', 'Femme', 10, 0, 30, 'orange', 'judo club gazelec', 0, ''),
(81, 'loxq', 'kireg', 'Homme', 10, 0, 27, 'jaune', 'judo club gazelec', 0, ''),
(82, 'DELAFONT', 'Matthieu', 'Homme', 10, 0, 32, 'orange et vert', 'Judo Club les Martres de Veyre', 0, ''),
(83, 'JACQUEMET', 'Elouan', 'Homme', 10, 0, 49, 'orange', 'JUDO CLUB CHAMALIEROIS', 0, ''),
(84, 'CHANAL', 'Paco', 'Homme', 10, 0, 27, 'jaune et orange', 'JUDO CLUB CHAMALIEROIS', 0, ''),
(85, 'MALCLES', 'Alexis', 'Homme', 10, 0, 35, 'orange', 'JUDO CLUB CHAMALIEROIS', 0, ''),
(86, 'ALLOUIN', 'ENZO', 'Homme', 10, 0, 33, 'orange et vert', 'JUDO CLUB DES PUYS', 0, ''),
(87, 'CHOUVY', 'BAPTISTE', 'Homme', 10, 0, 30, 'orange et vert', 'JUDO CLUB DES PUYS', 0, ''),
(88, 'RIFFAUT', 'PAULINE', 'Femme', 10, 0, 40, 'orange et vert', 'JUDO CLUB DES PUYS', 0, ''),
(89, 'RIERA', 'MELANIE', 'Femme', 10, 0, 39, 'orange', 'JUDO CLUB DES PUYS', 0, ''),
(90, 'PANAUD', 'BASTIEN', 'Homme', 10, 0, 35, 'bleu', 'JUDO CLUB DES PUYS', 0, ''),
(91, 'MARTIN', 'PIERRE', 'Homme', 10, 0, 52, 'vert et bleu', 'JUDO CLUB DES PUYS', 0, ''),
(92, 'TROMPAT', 'MATHIS', 'Homme', 10, 0, 33, 'vert', 'JUDO CLUB DES PUYS', 0, ''),
(93, 'MEDINA', 'ZOE', 'Femme', 10, 0, 32, 'vert', 'JUDO CLUB DES PUYS', 0, ''),
(94, 'DANIEL', 'MATHYS', 'Homme', 11, 0, 36, 'jaune', 'ALLIANCE LEMPDES MEZEL', 0, ''),
(95, 'LAROCHE', 'BASTIEN', 'Homme', 11, 0, 33, 'orange et vert', 'ALLIANCE LEMPDES MEZEL', 0, ''),
(96, 'MARGERIT', 'LOUIS', 'Homme', 11, 0, 32, 'jaune et orange', 'ALLIANCE LEMPDES MEZEL', 0, ''),
(97, 'CROZE', 'GAELLE', 'Femme', 10, 0, 32, 'vert', 'FLEPP COURPIERE', 0, ''),
(98, 'COLLAS', 'THIBAUT', 'Homme', 10, 0, 38, 'vert', 'FLEPP COURPIERE', 0, ''),
(99, 'OULABBI', 'WALLID', 'Homme', 11, 0, 55, 'bleu', 'FLEPP COURPIERE', 0, ''),
(100, 'PRIVAT', 'ANNABELLE', 'Femme', 11, 0, 63, 'bleu', 'FLEPP COURPIERE', 0, ''),
(101, 'LOMBARDY', 'ENOLA', 'Femme', 10, 0, 40, 'vert', 'FLEPP COURPIERE', 0, ''),
(102, 'GONZALEZ', 'NATHAN', 'Homme', 10, 0, 34, 'vert', 'FLEPP COURPIERE', 0, ''),
(103, 'ALEXANDRE', 'FRANCOIS', 'Homme', 11, 0, 46, 'bleu', 'FLEPP COURPIERE', 0, ''),
(104, 'OYNO', 'HESTRIE', 'Femme', 11, 0, 55, 'bleu', 'FLEPP COURPIERE', 0, ''),
(105, 'PHILIPPOT', 'MANON', 'Femme', 11, 0, 44, 'orange et vert', 'JUDO CLUB DU BASSIN BRASSAC', 0, ''),
(106, 'BOS', 'EWEN', 'Homme', 11, 0, 32, 'jaune et orange', 'JUDO CLUB DU BASSIN BRASSAC', 0, ''),
(107, 'REVILLON', 'MATHIEU', 'Homme', 11, 0, 34, 'vert', 'JUDO CLUB DU BASSIN BRASSAC', 0, ''),
(108, 'BRUNEL COURAGE', 'Matthieu', 'Homme', 10, 0, 39, 'jaune et orange', 'JUDO CLUB CHAMALIEROIS', 0, ''),
(109, 'GAIGNOUX', 'EVAN', 'Homme', 11, 0, 51, 'vert', 'JUDO CLUB ST GERMINOIS', 0, ''),
(110, 'Lanez', 'romain', 'Homme', 10, 0, 38, 'orange et vert', 'Aydat', 0, ''),
(111, 'GERARD', 'MAXIME', 'Homme', 10, 0, 39, 'orange et vert', 'judo club orcet', 0, ''),
(112, 'Besson verdier', 'Maxence', 'Homme', 11, 0, 45, 'vert', 'MLC Billom', 0, ''),
(113, 'Mile', 'Flavien', 'Homme', 11, 0, 36, 'vert', 'MLC Billom', 0, ''),
(114, 'Pottiez', 'Quentin', 'Homme', 10, 0, 43, 'vert', 'MLC Billom', 0, ''),
(115, 'Delaire', 'Mathias', 'Homme', 10, 0, 35, 'vert', 'MLC Billom', 0, ''),
(116, 'Lacas', 'Mahé', 'Homme', 10, 0, 31, 'vert', 'MLC Billom', 0, ''),
(117, 'Vergne', 'Anicet', 'Homme', 10, 0, 29, 'orange et vert', 'MLC Billom', 0, ''),
(118, 'Bernadac', 'Jules', 'Homme', 10, 0, 44, 'orange', 'MLC Billom', 0, ''),
(119, 'Rouby', 'Lenny', 'Femme', 10, 0, 30, 'orange et vert', 'MLC Billom', 0, ''),
(120, 'bagay', 'ronan', 'Homme', 11, 0, 49, 'vert', 'JC Bessard', 0, ''),
(121, 'dufragne', 'ambre', 'Femme', 11, 0, 36, 'vert', 'JC Bessard', 0, ''),
(122, 'terreygeol', 'margot', 'Femme', 11, 0, 38, 'orange', 'JC Bessard', 0, ''),
(123, 'Martins', 'thibault', 'Homme', 11, 0, 34, 'vert', 'JC Bessard', 0, ''),
(124, 'Meyer', 'camille', 'Femme', 11, 0, 44, 'orange et vert', 'JC Bessard', 0, ''),
(125, 'Marino', 'gaspard', 'Homme', 11, 0, 70, 'jaune et orange', 'JC Bessard', 0, ''),
(126, 'Fouquet', 'lucas', 'Homme', 11, 0, 43, 'jaune et orange', 'JC Bessard', 0, ''),
(127, 'Rival', 'cristopher', 'Homme', 11, 0, 43, 'orange', 'JC Bessard', 0, ''),
(128, 'BENMANSSOUR', 'NOAH', 'Homme', 10, 0, 30, 'orange et vert', 'ALLIANCE LEMPDES MEZEL', 0, ''),
(129, 'avit', 'lilou', 'Femme', 11, 0, 35, 'vert', 'JC Castelpontin', 0, ''),
(130, 'test', 'test', 'Homme', 19, 180, 80, 'blanche', 'CENTRE LOISIRS LE CENDRE', 0, ''),
(137, 'efz', 'css', 'Homme', 10, 157, 35, 'verte et bleue', 'CENTRE LOISIRS LE CENDRE', 0, ''),
(138, 'dgvbxf', 'fdxgbbfd', 'Homme', 9, 136, 42, 'marron', 'CENTRE LOISIRS LE CENDRE', 0, ''),
(139, 'fhdnb', 'fgcn', 'Homme', 8, 132, 29, 'verte et bleue', 'CENTRE LOISIRS LE CENDRE', 0, ''),
(140, 'qsdq', 'sdqsd', 'Homme', 10, 10, 10, 'marron', 'CENTRE LOISIRS LE CENDRE', 0, '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`idParticipant`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `participants`
--
ALTER TABLE `participants`
  MODIFY `idParticipant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
