-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 10 Mars 2022 à 10:17
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
-- Structure de la table `codes_clubs`
--

CREATE TABLE `codes_clubs` (
  `Nom-du-club` varchar(30) DEFAULT NULL,
  `Code-du-club` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `codes_clubs`
--

INSERT INTO `codes_clubs` (`Nom-du-club`, `Code-du-club`) VALUES
('JUDO AVENTURE PASSION 63', 2090),
('ECOLE DE JUDO CLERMONT JEUNES', 9990),
('AS MONTFERRANDAISE', 2053),
('AL CROIX DE NEYRAT', 2084),
('ASS. ARVERNE DE KYUDO', 11328),
('CLERMONT UNIV.CLUB', 2055),
('A S MONTFERRANDAISE', 2052),
('STADE CLERMONTOIS', 2056),
('CLERMONT AUVERGNE JUDO', 2116),
('AMICALE LAIQUE BEAUMONT JUDO', 7043),
('AMICALE LAIQUE DALLET JUDO', 2115),
('FOYER RURAL DE BLANZAT JUDO', 8262),
('AMICALE LAIQUE DE MEZEL JUDO', 8828),
('F.A.L. BEAUREGARD L EVEQUE', 2105),
('FLEPP DE COURPIERE', 2075),
('ESPERANCE CEYRATOISE JUDO', 2087),
('UNION JUDO 63  VAL D ARTIERE', 8588),
('AMICALE LAIQUE DE NOTRE PAYS', 2099),
('E.A.M. ROYAT -JUDO-', 2079),
('JC DE CHATEL-GUYON', 2093),
('JUDO BILLOM', 10989),
('DOME RHONE JUDO', 11431),
('JUDO CLUB AUBIEROIS', 2114),
('ASS FAMILLES RURALES DE LEZOUX', 10910),
('JUDO CLUB MOZACOIS', 2071),
('J.C.RIOMOIS', 2062),
('JUDO-CLUB-D-PUYS', 9444),
('TATAMI GIBALDIPONTIN', 2085),
('J C VICOMTOIS', 2072),
('ECOLE JUDO PUY GUILLAUME', 2098),
('JUDO CLUB THIERNOIS', 2063),
('JUDO CLUB RANDAN', 2117),
('AMICALE LAIQUE CHAMPEIX', 8850),
('JUDO CLUB ST GERMINOIS', 2080),
('JUDO JUJITSU CLUB MARINGUES', 11378),
('ARTS MARTIAUX GAZELEC GERZAT', 11686),
('BUDO CLUB GERZATOIS', 2070),
('GAZELEC J.CLERMONT FRD', 2081),
('FFJEP JUDO LEMPDES', 2069),
('JUDO JUJITSU CLUB DE PONTAUMUR', 11473),
('AS BANQUE DE FRANCE', 2067),
('J.C.CHAMALIEROIS', 2073),
('JUDO CLUB MANZATOIS', 2104),
('JC ARDOISIEN', 2068),
('JUDO CLUB CASTELPONTIN', 2097),
('JUDO CLUB COMBRONDE', 2083),
('ARTS MARTIAUX SAUXILLANGES', 9987),
('JUDO TAISO US ISSOIRE', 2060),
('AULNAT SPORTIF JUDO', 2050),
('JUDO CLUB DE SAYAT', 6458),
('JUDO CLUB VOLVICOIS', 2103),
('FLEP ROMAGNAT JUDO', 2064),
('J.C.BASSIN CHATEAU', 2051),
('AMICALE LAIQUE CUNLHAT JUDO', 8539),
('JUDO CLUB AMBERT', 2077),
('JUDO CLUB BESSARD', 2108),
('JC ST CLEMENT DE VALORGUE', 11082),
('CENTRE LOISIRS LE CENDRE', 2096),
('JUDO CLUB ORCETOIS', 2089),
('J C ELOYSIEN', 2061),
('JUDO CLUB ENNEZAT', 2058),
('JUDO CLUB DES MARTRES DE VEYRE', 2074),
('COURNON JUDO', 7922),
('F.R. ORCINES JUDO', 6837),
('JUDO CLUB D AYDAT', 10055);

-- --------------------------------------------------------

--
-- Structure de la table `demande_inscription`
--

CREATE TABLE `demande_inscription` (
  `ID` int(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `Nom_club` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `points` int(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `participants`
--

INSERT INTO `participants` (`idParticipant`, `Nom`, `Prenom`, `Sexe`, `Age`, `Taille`, `Poids`, `Ceinture`, `Nom_club`, `points`) VALUES
(8, 'Alonso', 'Dorian', 'Homme', 19, 177, 78, 'marron', '', 5),
(9, 'PAULHE', 'Guillaume', 'Homme', 19, 195, 90, 'blanche', '', 4),
(10, 'Faucher', 'Noa', 'Homme', 20, 170, 69, '', '', 0),
(11, 'Albrecht', 'Sebastien', 'Homme', 19, 180, 81, '', '', 0),
(12, 'Ipek', 'Hasan', 'Homme', 19, 175, 62, '', '', 0),
(13, 'Faucher', 'Gabriel', 'Homme', 19, 175, 70, '', '', 0),
(19, 'Guillaume', 'PAULHE', 'Homme', 19, 195, 85, '', '', 0),
(20, 'Test', 'Testt', 'Homme', 18, 185, 80, '', 'CENTRE LOISIRS LE CENDRE', 0),
(24, 'test ceinture', 'test', 'Homme', 19, 190, 90, 'blanche et jaune', 'CENTRE LOISIRS LE CENDRE', 0),
(25, 'testt', 'testttt', 'Homme', 18, 180, 80, 'orange', '', 0),
(26, 'ZEEEBI', 'a', 'Homme', 15, 195, 60, 'marron', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idUser` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `Nom_club` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUser`, `Nom`, `Prenom`, `email`, `password`, `Role`, `Nom_club`) VALUES
(4, '', '', 'zebiad@gmail.com', 'ad069c33bd5f279df2d021bbfe5220fd346e24b9a6b29ad20bd0cf2f61e2aedf', 'Administrateur', ''),
(20, 'terry', 'gollow', 'zebi@gmail.com', 'ad069c33bd5f279df2d021bbfe5220fd346e24b9a6b29ad20bd0cf2f61e2aedf', 'Entraineur', 'CENTRE LOISIRS LE CENDRE'),
(21, 'sfsd', 'fsfsd', 'test@gmail.Com', 'bdfaddd44f000699e66e01f7a9dd53a89d2588d25b07cd351cb8f58899b7facc', 'Entraineur', 'CENTRE LOISIRS LE CENDRE');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `demande_inscription`
--
ALTER TABLE `demande_inscription`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`idParticipant`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `demande_inscription`
--
ALTER TABLE `demande_inscription`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `participants`
--
ALTER TABLE `participants`
  MODIFY `idParticipant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
