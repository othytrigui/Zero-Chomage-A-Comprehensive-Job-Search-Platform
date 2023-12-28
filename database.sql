-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 24 mars 2022 à 23:27
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `myproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `bookmarked`
--

CREATE TABLE `bookmarked` (
  `id_job` int(11) DEFAULT NULL,
  `id_candidat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `bookmarked`
--

INSERT INTO `bookmarked` (`id_job`, `id_candidat`) VALUES
(102, 47),
(103, 48);

-- --------------------------------------------------------

--
-- Structure de la table `candidatures`
--

CREATE TABLE `candidatures` (
  `id_job` int(11) DEFAULT NULL,
  `id_candidat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `candidatures`
--

INSERT INTO `candidatures` (`id_job`, `id_candidat`) VALUES
(102, 47),
(103, 48);

-- --------------------------------------------------------

--
-- Structure de la table `candidat_infos`
--

CREATE TABLE `candidat_infos` (
  `candidat_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `linkedin` varchar(200) DEFAULT NULL,
  `a_propos` varchar(500) DEFAULT NULL,
  `profil_pic` varchar(500) DEFAULT NULL,
  `cv` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `candidat_infos`
--

INSERT INTO `candidat_infos` (`candidat_id`, `full_name`, `username`, `phone`, `birthday`, `adresse`, `facebook`, `twitter`, `linkedin`, `a_propos`, `profil_pic`, `cv`) VALUES
(47, 'Othmane Trigui', 'othytrigui', '0690391318', '2001-07-26', 'Al youssr 2, berrechid', 'facebook', 'twitter', 'linkedin', 'Étudiant à l\'ecole superieure de technologie de Fkih Ben Saleh, dans la fillière Genie Informatique', '257233544_283655866981168_5966551914562555392_n.jpg', 'TP_1.pdf'),
(48, 'Mouhcine Hakim', 'mhakim', '0622222222', '2002-11-07', 'Tadla, beni mellal', '', '', '', '', '235691220_2043648222456176_3377768276162996744_n.jpg', 'Modalités du financement du projet.docx');

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `ville` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cities`
--

INSERT INTO `cities` (`id`, `ville`) VALUES
(1, 'Aïn Harrouda'),
(2, 'Ben Yakhlef'),
(3, 'Bouskoura'),
(4, 'Casablanca'),
(5, 'Médiouna'),
(6, 'Mohammadia'),
(7, 'Tit Mellil'),
(8, 'Ben Yakhlef'),
(9, 'Bejaâd'),
(10, 'Ben Ahmed'),
(11, 'Benslimane'),
(12, 'Berrechid'),
(13, 'Boujniba'),
(14, 'Boulanouare'),
(15, 'Bouznika'),
(16, 'Deroua'),
(17, 'El Borouj'),
(18, 'El Gara'),
(19, 'Guisser'),
(20, 'Hattane'),
(21, 'Khouribga'),
(22, 'Loulad'),
(23, 'Oued Zem'),
(24, 'Oulad Abbou'),
(25, 'Oulad H\'Riz Sahel'),
(26, 'Oulad M\'rah'),
(27, 'Oulad Saïd'),
(28, 'Oulad Sidi Ben Daoud'),
(29, 'Ras El Aïn'),
(30, 'Settat'),
(31, 'Sidi Rahhal Chataï'),
(32, 'Soualem'),
(33, 'Azemmour'),
(34, 'Bir Jdid'),
(35, 'Bouguedra'),
(36, 'Echemmaia'),
(37, 'El Jadida'),
(38, 'Hrara'),
(39, 'Ighoud'),
(40, 'Jamâat Shaim'),
(41, 'Jorf Lasfar'),
(42, 'Khemis Zemamra'),
(43, 'Laaounate'),
(44, 'Moulay Abdallah'),
(45, 'Oualidia'),
(46, 'Oulad Amrane'),
(47, 'Oulad Frej'),
(48, 'Oulad Ghadbane'),
(49, 'Safi'),
(50, 'Sebt El Maârif'),
(51, 'Sebt Gzoula'),
(52, 'Sidi Ahmed'),
(53, 'Sidi Ali Ban Hamdouche'),
(54, 'Sidi Bennour'),
(55, 'Sidi Bouzid'),
(56, 'Sidi Smaïl'),
(57, 'Youssoufia'),
(58, 'Fès'),
(59, 'Aïn Cheggag'),
(60, 'Bhalil'),
(61, 'Boulemane'),
(62, 'El Menzel'),
(63, 'Guigou'),
(64, 'Imouzzer Kandar'),
(65, 'Imouzzer Marmoucha'),
(66, 'Missour'),
(67, 'Moulay Yaâcoub'),
(68, 'Ouled Tayeb'),
(69, 'Outat El Haj'),
(70, 'Ribate El Kheir'),
(71, 'Séfrou'),
(72, 'Skhinate'),
(73, 'Tafajight'),
(74, 'Arbaoua'),
(75, 'Aïn Dorij'),
(76, 'Dar Gueddari'),
(77, 'Had Kourt'),
(78, 'Jorf El Melha'),
(79, 'Kénitra'),
(80, 'Khenichet'),
(81, 'Lalla Mimouna'),
(82, 'Mechra Bel Ksiri'),
(83, 'Mehdia'),
(84, 'Moulay Bousselham'),
(85, 'Sidi Allal Tazi'),
(86, 'Sidi Kacem'),
(87, 'Sidi Slimane'),
(88, 'Sidi Taibi'),
(89, 'Sidi Yahya El Gharb'),
(90, 'Souk El Arbaa'),
(91, 'Akka'),
(92, 'Assa'),
(93, 'Bouizakarne'),
(94, 'El Ouatia'),
(95, 'Es-Semara'),
(96, 'Fam El Hisn'),
(97, 'Foum Zguid'),
(98, 'Guelmim'),
(99, 'Taghjijt'),
(100, 'Tan-Tan'),
(101, 'Tata'),
(102, 'Zag'),
(103, 'Marrakech'),
(104, 'Ait Daoud'),
(115, 'Amizmiz'),
(116, 'Assahrij'),
(117, 'Aït Ourir'),
(118, 'Ben Guerir'),
(119, 'Chichaoua'),
(120, 'El Hanchane'),
(121, 'El Kelaâ des Sraghna'),
(122, 'Essaouira'),
(123, 'Fraïta'),
(124, 'Ghmate'),
(125, 'Ighounane'),
(126, 'Imintanoute'),
(127, 'Kattara'),
(128, 'Lalla Takerkoust'),
(129, 'Loudaya'),
(130, 'Lâattaouia'),
(131, 'Moulay Brahim'),
(132, 'Mzouda'),
(133, 'Ounagha'),
(134, 'Sid L\'Mokhtar'),
(135, 'Sid Zouin'),
(136, 'Sidi Abdallah Ghiat'),
(137, 'Sidi Bou Othmane'),
(138, 'Sidi Rahhal'),
(139, 'Skhour Rehamna'),
(140, 'Smimou'),
(141, 'Tafetachte'),
(142, 'Tahannaout'),
(143, 'Talmest'),
(144, 'Tamallalt'),
(145, 'Tamanar'),
(146, 'Tamansourt'),
(147, 'Tameslouht'),
(148, 'Tanalt'),
(149, 'Zeubelemok'),
(150, 'Meknès‎'),
(151, 'Khénifra'),
(152, 'Agourai'),
(153, 'Ain Taoujdate'),
(154, 'MyAliCherif'),
(155, 'Rissani'),
(156, 'Amalou Ighriben'),
(157, 'Aoufous'),
(158, 'Arfoud'),
(159, 'Azrou'),
(160, 'Aïn Jemaa'),
(161, 'Aïn Karma'),
(162, 'Aïn Leuh'),
(163, 'Aït Boubidmane'),
(164, 'Aït Ishaq'),
(165, 'Boudnib'),
(166, 'Boufakrane'),
(167, 'Boumia'),
(168, 'El Hajeb'),
(169, 'Elkbab'),
(170, 'Er-Rich'),
(171, 'Errachidia'),
(172, 'Gardmit'),
(173, 'Goulmima'),
(174, 'Gourrama'),
(175, 'Had Bouhssoussen'),
(176, 'Haj Kaddour'),
(177, 'Ifrane'),
(178, 'Itzer'),
(179, 'Jorf'),
(180, 'Kehf Nsour'),
(181, 'Kerrouchen'),
(182, 'M\'haya'),
(183, 'M\'rirt'),
(184, 'Midelt'),
(185, 'Moulay Ali Cherif'),
(186, 'Moulay Bouazza'),
(187, 'Moulay Idriss Zerhoun'),
(188, 'Moussaoua'),
(189, 'N\'Zalat Bni Amar'),
(190, 'Ouaoumana'),
(191, 'Oued Ifrane'),
(192, 'Sabaa Aiyoun'),
(193, 'Sebt Jahjouh'),
(194, 'Sidi Addi'),
(195, 'Tichoute'),
(196, 'Tighassaline'),
(197, 'Tighza'),
(198, 'Timahdite'),
(199, 'Tinejdad'),
(200, 'Tizguite'),
(201, 'Toulal'),
(202, 'Tounfite'),
(203, 'Zaouia d\'Ifrane'),
(204, 'Zaïda'),
(205, 'Ahfir'),
(206, 'Aklim'),
(207, 'Al Aroui'),
(208, 'Aïn Bni Mathar'),
(209, 'Aïn Erreggada'),
(210, 'Ben Taïeb'),
(211, 'Berkane'),
(212, 'Bni Ansar'),
(213, 'Bni Chiker'),
(214, 'Bni Drar'),
(215, 'Bni Tadjite'),
(216, 'Bouanane'),
(217, 'Bouarfa'),
(218, 'Bouhdila'),
(219, 'Dar El Kebdani'),
(220, 'Debdou'),
(221, 'Douar Kannine'),
(222, 'Driouch'),
(223, 'El Aïoun Sidi Mellouk'),
(224, 'Farkhana'),
(225, 'Figuig'),
(226, 'Ihddaden'),
(227, 'Jaâdar'),
(228, 'Jerada'),
(229, 'Kariat Arekmane'),
(230, 'Kassita'),
(231, 'Kerouna'),
(232, 'Laâtamna'),
(233, 'Madagh'),
(234, 'Midar'),
(235, 'Nador'),
(236, 'Naima'),
(237, 'Oued Heimer'),
(238, 'Oujda'),
(239, 'Ras El Ma'),
(240, 'Saïdia'),
(241, 'Selouane'),
(242, 'Sidi Boubker'),
(243, 'Sidi Slimane Echcharaa'),
(244, 'Talsint'),
(245, 'Taourirt'),
(246, 'Tendrara'),
(247, 'Tiztoutine'),
(248, 'Touima'),
(249, 'Touissit'),
(250, 'Zaïo'),
(251, 'Zeghanghane'),
(252, 'Rabat'),
(253, 'Salé'),
(254, 'Ain El Aouda'),
(255, 'Harhoura'),
(256, 'Khémisset'),
(257, 'Oulmès'),
(258, 'Rommani'),
(259, 'Sidi Allal El Bahraoui'),
(260, 'Sidi Bouknadel'),
(261, 'Skhirate'),
(262, 'Tamesna'),
(263, 'Témara'),
(264, 'Tiddas'),
(265, 'Tiflet'),
(266, 'Touarga'),
(267, 'Agadir'),
(268, 'Agdz'),
(269, 'Agni Izimmer'),
(270, 'Aït Melloul'),
(271, 'Alnif'),
(272, 'Anzi'),
(273, 'Aoulouz'),
(274, 'Aourir'),
(275, 'Arazane'),
(276, 'Aït Baha'),
(277, 'Aït Iaâza'),
(278, 'Aït Yalla'),
(279, 'Ben Sergao'),
(280, 'Biougra'),
(281, 'Boumalne-Dadès'),
(282, 'Dcheira El Jihadia'),
(283, 'Drargua'),
(284, 'El Guerdane'),
(285, 'Harte Lyamine'),
(286, 'Ida Ougnidif'),
(287, 'Ifri'),
(288, 'Igdamen'),
(289, 'Ighil n\'Oumgoun'),
(290, 'Imassine'),
(291, 'Inezgane'),
(292, 'Irherm'),
(293, 'Kelaat-M\'Gouna'),
(294, 'Lakhsas'),
(295, 'Lakhsass'),
(296, 'Lqliâa'),
(297, 'M\'semrir'),
(298, 'Massa (Maroc)'),
(299, 'Megousse'),
(300, 'Ouarzazate'),
(301, 'Oulad Berhil'),
(302, 'Oulad Teïma'),
(303, 'Sarghine'),
(304, 'Sidi Ifni'),
(305, 'Skoura'),
(306, 'Tabounte'),
(307, 'Tafraout'),
(308, 'Taghzout'),
(309, 'Tagzen'),
(310, 'Taliouine'),
(311, 'Tamegroute'),
(312, 'Tamraght'),
(313, 'Tanoumrite Nkob Zagora'),
(314, 'Taourirt ait zaghar'),
(315, 'Taroudannt'),
(316, 'Temsia'),
(317, 'Tifnit'),
(318, 'Tisgdal'),
(319, 'Tiznit'),
(320, 'Toundoute'),
(321, 'Zagora'),
(322, 'Afourar'),
(323, 'Aghbala'),
(324, 'Azilal'),
(325, 'Aït Majden'),
(326, 'Beni Ayat'),
(327, 'Béni Mellal'),
(328, 'Bin elouidane'),
(329, 'Bradia'),
(330, 'Bzou'),
(331, 'Dar Oulad Zidouh'),
(332, 'Demnate'),
(333, 'Dra\'a'),
(334, 'El Ksiba'),
(335, 'Foum Jamaa'),
(336, 'Fquih Ben Salah'),
(337, 'Kasba Tadla'),
(338, 'Ouaouizeght'),
(339, 'Oulad Ayad'),
(340, 'Oulad M\'Barek'),
(341, 'Oulad Yaich'),
(342, 'Sidi Jaber'),
(343, 'Souk Sebt Oulad Nemma'),
(344, 'Zaouïat Cheikh'),
(345, 'Tanger‎'),
(346, 'Tétouan‎'),
(347, 'Akchour'),
(348, 'Assilah'),
(349, 'Bab Berred'),
(350, 'Bab Taza'),
(351, 'Brikcha'),
(352, 'Chefchaouen'),
(353, 'Dar Bni Karrich'),
(354, 'Dar Chaoui'),
(355, 'Fnideq'),
(356, 'Gueznaia'),
(357, 'Jebha'),
(358, 'Karia'),
(359, 'Khémis Sahel'),
(360, 'Ksar El Kébir'),
(361, 'Larache'),
(362, 'M\'diq'),
(363, 'Martil'),
(364, 'Moqrisset'),
(365, 'Oued Laou'),
(366, 'Oued Rmel'),
(367, 'Ouazzane'),
(368, 'Point Cires'),
(369, 'Sidi Lyamani'),
(371, 'Zinat'),
(372, 'Ajdir‎'),
(373, 'Aknoul‎'),
(374, 'Al Hoceïma‎'),
(375, 'Aït Hichem‎'),
(376, 'Bni Bouayach‎'),
(377, 'Bni Hadifa‎'),
(378, 'Ghafsai‎'),
(379, 'Guercif‎'),
(380, 'Imzouren‎'),
(381, 'Inahnahen‎'),
(382, 'Issaguen (Ketama)‎'),
(383, 'Karia (El Jadida)‎'),
(384, 'Karia Ba Mohamed‎'),
(385, 'Oued Amlil‎'),
(386, 'Oulad Zbair‎'),
(387, 'Tahla‎'),
(388, 'Tala Tazegwaght‎'),
(389, 'Tamassint‎'),
(390, 'Taounate‎'),
(391, 'Targuist‎'),
(392, 'Taza‎'),
(393, 'Taïnaste‎'),
(394, 'Thar Es-Souk‎'),
(395, 'Tissa‎'),
(396, 'Tizi Ouasli‎'),
(397, 'Laayoune‎'),
(398, 'El Marsa‎'),
(399, 'Tarfaya‎'),
(400, 'Boujdour‎'),
(401, 'Awsard'),
(402, 'Oued-Eddahab'),
(403, 'Stehat'),
(404, 'Aït Attab');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise_infos`
--

CREATE TABLE `entreprise_infos` (
  `entreprise_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `categorie` varchar(100) DEFAULT NULL,
  `a_propos` varchar(400) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `entreprise_infos`
--

INSERT INTO `entreprise_infos` (`entreprise_id`, `name`, `username`, `phone`, `adresse`, `categorie`, `a_propos`, `logo`) VALUES
(37, 'Centrale', 'centrale', '0690391318', 'Hay Tighnari, Route nationale N11 de Casablanca commune de Fkih Ben Salah, Boite Postale 336', 'Produit alimentaire', 'Centrale Danone, filiale marocaine de la multinationale française Danone, est une société spécialisée dans les produits laitiers. Son siège social est à Casablanca.', 'Logo-Centrale-Danone.png'),
(46, 'AXA', 'axa', '0611111111', 'Rabat', 'Centre d\'appel', 'AXA Services Maroc est le centre d\'expertise en relation client au Maroc des sociétés : AXA France, AXA Direct France et AXA Assistance\r\n\r\nPrésents à Rabat depuis mai 2004, nous sommes à ce jour 2 900 collaborateurs.', 'logoaxa.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `titre` varchar(200) DEFAULT NULL,
  `poste` varchar(200) DEFAULT NULL,
  `localite` varchar(100) DEFAULT NULL,
  `type_contrat` varchar(200) DEFAULT NULL,
  `duree` varchar(100) DEFAULT NULL,
  `study_level` varchar(100) DEFAULT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `salaire` varchar(100) DEFAULT NULL,
  `datefin` date DEFAULT NULL,
  `descriptif` mediumtext DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `id_entreprise` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `jobs`
--

INSERT INTO `jobs` (`id`, `titre`, `poste`, `localite`, `type_contrat`, `duree`, `study_level`, `experience`, `salaire`, `datefin`, `descriptif`, `status`, `publish_date`, `id_entreprise`) VALUES
(102, 'Chargé de développement informatique .net (Junior)', 'Developpeur', 'Rabat', 'CDI', 'Temps-partiel', 'Bac +3', 'De 1 à 3 ans', '8000', '2022-07-26', '<p><strong>Poste :</strong></p>\r\n<p>Dans le cadre de ses projets de d&eacute;veloppement, la Fondation Marocaine pour la Promotion de l&rsquo;enseignement pr&eacute;Scolaire cr&eacute;e des unit&eacute;s pr&eacute;scolaires, pour le profit de ses nombreux partenaires notamment la FM6, l&rsquo;INDH, la DGCL ainsi que d\'autres institutions publiques et priv&eacute;s.</p>\r\n<p>Pour renforcer son &eacute;quipe centrale, la Fondation Marocaine pour la Promotion de l&rsquo;enseignement pr&eacute;Scolaire, lance un appel &agrave; candidature pour le recrutement de deux (2) charg&eacute;s de d&eacute;veloppement informatique .net (Junior)</p>\r\n<p>Il s&rsquo;agit d&rsquo;un poste &agrave; plein temps.</p>\r\n<p>Poste &agrave; pourvoir en CDI.</p>\r\n<p>Ce poste est rattach&eacute; au Chef de Division Syst&egrave;mes d\'Information et Transformation Digitale.</p>\r\n<p>Crit&egrave;res indispensables: Connaissance obligatoire des technologies : asp.net (webfrom et mvc), sql server, bootstrap, jquery, transact-sql...</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Missions :</strong></p>\r\n<p style=\"padding-left: 40px;\">D&eacute;veloppement des diff&eacute;rents interfaces, modules et tableaux de bord.</p>\r\n<p style=\"padding-left: 40px;\">Conception de bases de donn&eacute;es</p>\r\n<p style=\"padding-left: 40px;\">Tests unitaires</p>\r\n<p style=\"padding-left: 40px;\">R&eacute;ception des besoins</p>\r\n<p style=\"padding-left: 40px;\">Extraction des donn&eacute;es et reporting</p>\r\n<p style=\"padding-left: 40px;\">Elaboration de la documentation technique et des modes op&eacute;ratoires</p>\r\n<p style=\"padding-left: 40px;\">Assurer la formation aux utilisateurs</p>\r\n<p style=\"padding-left: 40px;\">Assurer la maintenance &eacute;volutive et corrective des applications ;</p>\r\n<p style=\"padding-left: 40px;\">D&eacute;velopper les fonctionnalit&eacute;s en charge ;</p>\r\n<p style=\"padding-left: 40px;\">Faire le compte-rendu de son activit&eacute; dans l\'outil de suivi de projet ;</p>\r\n<p style=\"padding-left: 40px;\">Travailler en &eacute;troite collaboration avec l\'ensemble des services.&nbsp;&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Profil recherch&eacute; :</strong></p>\r\n<p style=\"padding-left: 40px;\">Titulaire d&rsquo;un dipl&ocirc;me bac+2 ou bac+3 et se Justifie de 2 ans d\'experience au minimum; ou titulaire d&rsquo;un dipl&ocirc;me bac+5 et se Justifie d\'un (1) an d\'experience au minimum.</p>\r\n<p style=\"padding-left: 40px;\">Capacit&eacute; d&rsquo;organisation et de planification.</p>\r\n<p style=\"padding-left: 40px;\">Titulaire d\'une formation en D&eacute;veloppement Informatique</p>\r\n<p style=\"padding-left: 40px;\">Exp&eacute;rience confirm&eacute;e dans le d&eacute;veloppement de 2 ans minimum</p>\r\n<p style=\"padding-left: 40px;\">Expert en framework .NET (C#, VB.net, asp.net webform)</p>\r\n<p style=\"padding-left: 40px;\">Maitrise des bases de donn&eacute;es sous SQL Server et Transact-sql.</p>\r\n<p style=\"padding-left: 40px;\">bootstrap, jquery,</p>\r\n<p style=\"padding-left: 40px;\">M&eacute;thodique, rigoureux, autonome</p>\r\n<p style=\"padding-left: 40px;\">Exp&eacute;riment&eacute; les processus de gestion de projet en m&eacute;thodologie AGILE (Scrum).</p>\r\n<p style=\"padding-left: 40px;\">Excellentes qualit&eacute;s relationnelles, de fortes capacit&eacute;s d\'&eacute;coute et d\'un bon esprit d\'&eacute;quipe</p>\r\n<p>&nbsp;</p>\r\n<p>La s&eacute;lection sera faite sur la base d\'un test technique et un entretien oral.</p>', 'En cours de validation', '2022-01-26', 37),
(103, 'Stages PFE 2022 Ingénieurs informatique', 'Stagiaire', 'Casablanca', 'Stage', 'Temps-partiel', 'Bac +5 ou plus', 'Débutant', '500', '2022-05-20', '<p><strong>Poste :</strong></p>\r\n<p>Dans le cadre de notre campagne de stages PFE 2022, nous sommes &agrave; la recherche de stagiaires s&eacute;rieux, motiv&eacute;s et ambitieux ayant un esprit d\'&eacute;quipe pour participer &agrave; des projets li&eacute;s au domaine informatique au sein d&rsquo;une &eacute;quipe jeune et dynamique.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Profil recherch&eacute; :</strong></p>\r\n<p>Actuellement &eacute;tudiant en derni&egrave;re ann&eacute;e d&rsquo;une &eacute;cole d&rsquo;ing&eacute;nieurs, fili&egrave;re informatique, et &agrave; la recherche d\'un stage PFE pour une dur&eacute;e de 6 mois. Disposant des connaissances n&eacute;cessaires en informatique acquises &agrave; travers des stages et dot&eacute; d&rsquo;une bonne culture technologique et d&rsquo;un tr&egrave;s bon niveau en fran&ccedil;ais &agrave; l&rsquo;&eacute;crit et &agrave; l&rsquo;oral.</p>\r\n<p style=\"padding-left: 40px;\">&ndash; Une capacit&eacute; d&rsquo;&eacute;coute et de communication, adoss&eacute;e &agrave; une solide force de conviction.</p>\r\n<p style=\"padding-left: 40px;\">&ndash; La cr&eacute;ativit&eacute;, la r&eacute;activit&eacute;, et le sens de l&rsquo;organisation et d&rsquo;analyse.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Dur&eacute;e:</strong></p>\r\n<p style=\"padding-left: 40px;\">6 mois</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Avantages:</strong></p>\r\n<p style=\"padding-left: 40px;\">Une r&eacute;mun&eacute;ration attractive plus d&rsquo;autres avantages.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Autres:</strong></p>\r\n<p style=\"padding-left: 40px;\">Possibilit&eacute; de signer un contrat &agrave; la fin du stage en fonction des performances du stagiaire</p>', 'En cours de validation', '2022-01-27', 46),
(104, 'Chef de Département Parc Informatique (H/F)', 'Responsable', 'Skhirat', 'CDI', 'Temps-plein', 'Bac +5 ou plus', 'De 5 à 10 ans', '12000', '2022-08-11', '<p><strong>Poste :</strong></p>\r\n<p style=\"padding-left: 40px;\">Affect&eacute;(e) &agrave; la direction de l\'organisation et des syst&egrave;mes d\'informations, votre r&ocirc;le et de mettre en place les moyens techniques et organisationnelles permettant de :&nbsp;</p>\r\n<p style=\"padding-left: 40px;\">Mettre &agrave; disposition de chaque utilisateur un poste de travail offrant les pr&eacute;requis n&eacute;cessaires aux applications qu&rsquo;il utilise</p>\r\n<p style=\"padding-left: 40px;\">Garantir,la conformit&eacute; des postes de travail aux besoins.</p>\r\n<p style=\"padding-left: 40px;\">Garantir une bonne exp&eacute;rience d&rsquo;utilisation aux diff&eacute;rents utilisateurs</p>\r\n<p style=\"padding-left: 40px;\">Garantir la stricte ad&eacute;quation aux besoins des diff&eacute;rents postes de travail</p>\r\n<p style=\"padding-left: 40px;\">Garantir la s&eacute;curit&eacute; des diff&eacute;rents postes de travail conform&eacute;ment aux r&eacute;f&eacute;rentiels adopt&eacute;s par l&rsquo;entreprise</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Profil recherch&eacute; :</strong></p>\r\n<p style=\"padding-left: 40px;\">De formation Bac+5 en Informatique, vous justifiez d\'une exp&eacute;rience probante de plus de 7ans dans un poste similaire, dans laquelle vous avez d&eacute;velopp&eacute; les comp&eacute;tences suivantes :</p>\r\n<p style=\"padding-left: 80px;\">Orientation r&eacute;sultats,</p>\r\n<p style=\"padding-left: 80px;\">Capacit&eacute; d\'analyse &amp; de synth&egrave;se</p>\r\n<p style=\"padding-left: 80px;\">Capacit&eacute; de prise d\'initiative et de r&eacute;activit&eacute;.</p>\r\n<p style=\"padding-left: 80px;\">Etre force de proposition.</p>', 'En cours de validation', '2022-01-27', 37);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `account_type` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `account_type`, `email`, `password`) VALUES
(37, 'Entreprise', 'entreprise@gmail.com', '1234'),
(39, 'Admin', 'admin@gmail.com', '1234'),
(46, 'Entreprise', 'test@gmail.com', '1234azer'),
(47, 'Candidat', 'candidat@gmail.com', '1234azer'),
(48, 'Candidat', 'othytrigui@gmail.com', '1234azer');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bookmarked`
--
ALTER TABLE `bookmarked`
  ADD KEY `id_job` (`id_job`),
  ADD KEY `id_candidat` (`id_candidat`);

--
-- Index pour la table `candidatures`
--
ALTER TABLE `candidatures`
  ADD KEY `id_job` (`id_job`),
  ADD KEY `id_candidat` (`id_candidat`);

--
-- Index pour la table `candidat_infos`
--
ALTER TABLE `candidat_infos`
  ADD PRIMARY KEY (`candidat_id`);

--
-- Index pour la table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entreprise_infos`
--
ALTER TABLE `entreprise_infos`
  ADD PRIMARY KEY (`entreprise_id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_entreprise` (`id_entreprise`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bookmarked`
--
ALTER TABLE `bookmarked`
  ADD CONSTRAINT `bookmarked_ibfk_1` FOREIGN KEY (`id_job`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `bookmarked_ibfk_2` FOREIGN KEY (`id_candidat`) REFERENCES `candidat_infos` (`candidat_id`);

--
-- Contraintes pour la table `candidatures`
--
ALTER TABLE `candidatures`
  ADD CONSTRAINT `candidatures_ibfk_1` FOREIGN KEY (`id_job`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `candidatures_ibfk_2` FOREIGN KEY (`id_candidat`) REFERENCES `candidat_infos` (`candidat_id`);

--
-- Contraintes pour la table `candidat_infos`
--
ALTER TABLE `candidat_infos`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`candidat_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `entreprise_infos`
--
ALTER TABLE `entreprise_infos`
  ADD CONSTRAINT `fk` FOREIGN KEY (`entreprise_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise_infos` (`entreprise_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
