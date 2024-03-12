-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 16, 2024 at 12:59 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doled`
--

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `contenu` text NOT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `nom_cat` varchar(60) NOT NULL,
  `descriptif_cat` text NOT NULL,
  `image_cat` varchar(255) NOT NULL,
  `sous_cat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `nom_cat`, `descriptif_cat`, `image_cat`, `sous_cat`) VALUES
(1, 'Ampoules et luminaires', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.\r\n\r\nVivamus vehicula ex non blandit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas aliquam ligula at neque malesuada auctor. Morbi sit amet quam in urna tempor tincidunt. Vestibulum rutrum feugiat dolor, et gravida elit mattis at. Duis ac lectus cursus, semper orci quis, porttitor leo. Proin venenatis, sem sit amet egestas iaculis, magna felis porttitor justo, efficitur tincidunt ipsum arcu eget ante. Aenean varius, purus vulputate efficitur ultricies, mauris neque blandit magna, quis finibus augue urna at nunc. Sed in eleifend lorem, in elementum urna. Donec interdum, orci id porttitor lacinia, ante diam vulputate felis, eget faucibus dui odio sed dui. Ut eleifend ligula at consectetur pellentesque. Fusce justo eros, egestas a nisl et, ultrices euismod diam. Nullam bibendum quis ipsum eu sodales. Donec mauris elit, pharetra at est id, accumsan aliquet libero. Mauris id tincidunt quam, nec laoreet leo. Donec a laoreet leo, nec aliquet justo.', './ressources/imageCat1.jpg', NULL),
(2, 'Prises et interrupteurs', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.\r\n\r\nVivamus vehicula ex non blandit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas aliquam ligula at neque malesuada auctor. Morbi sit amet quam in urna tempor tincidunt. Vestibulum rutrum feugiat dolor, et gravida elit mattis at. Duis ac lectus cursus, semper orci quis, porttitor leo. Proin venenatis, sem sit amet egestas iaculis, magna felis porttitor justo, efficitur tincidunt ipsum arcu eget ante. Aenean varius, purus vulputate efficitur ultricies, mauris neque blandit magna, quis finibus augue urna at nunc. Sed in eleifend lorem, in elementum urna. Donec interdum, orci id porttitor lacinia, ante diam vulputate felis, eget faucibus dui odio sed dui. Ut eleifend ligula at consectetur pellentesque. Fusce justo eros, egestas a nisl et, ultrices euismod diam. Nullam bibendum quis ipsum eu sodales. Donec mauris elit, pharetra at est id, accumsan aliquet libero. Mauris id tincidunt quam, nec laoreet leo. Donec a laoreet leo, nec aliquet justo.', './ressources/imageCat2.jpg', NULL),
(3, 'Ampoules LED', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.\r\n\r\nVivamus vehicula ex non blandit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas aliquam ligula at neque malesuada auctor. Morbi sit amet quam in urna tempor tincidunt. Vestibulum rutrum feugiat dolor, et gravida elit mattis at. Duis ac lectus cursus, semper orci quis, porttitor leo. Proin venenatis, sem sit amet egestas iaculis, magna felis porttitor justo, efficitur tincidunt ipsum arcu eget ante. Aenean varius, purus vulputate efficitur ultricies, mauris neque blandit magna, quis finibus augue urna at nunc. Sed in eleifend lorem, in elementum urna. Donec interdum, orci id porttitor lacinia, ante diam vulputate felis, eget faucibus dui odio sed dui. Ut eleifend ligula at consectetur pellentesque. Fusce justo eros, egestas a nisl et, ultrices euismod diam. Nullam bibendum quis ipsum eu sodales. Donec mauris elit, pharetra at est id, accumsan aliquet libero. Mauris id tincidunt quam, nec laoreet leo. Donec a laoreet leo, nec aliquet justo.', './ressources/imageCat1.jpg', 1),
(14, 'Câblage', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.\r\n\r\nVivamus vehicula ex non blandit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas aliquam ligula at neque malesuada auctor. Morbi sit amet quam in urna tempor tincidunt. Vestibulum rutrum feugiat dolor, et gravida elit mattis at. Duis ac lectus cursus, semper orci quis, porttitor leo. Proin venenatis, sem sit amet egestas iaculis, magna felis porttitor justo, efficitur tincidunt ipsum arcu eget ante. Aenean varius, purus vulputate efficitur ultricies, mauris neque blandit magna, quis finibus augue urna at nunc. Sed in eleifend lorem, in elementum urna. Donec interdum, orci id porttitor lacinia, ante diam vulputate felis, eget faucibus dui odio sed dui. Ut eleifend ligula at consectetur pellentesque. Fusce justo eros, egestas a nisl et, ultrices euismod diam. Nullam bibendum quis ipsum eu sodales. Donec mauris elit, pharetra at est id, accumsan aliquet libero. Mauris id tincidunt quam, nec laoreet leo. Donec a laoreet leo, nec aliquet justo.', './ressources/imageCat3.jpg', NULL),
(15, 'Appareillage ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.\r\n\r\nVivamus vehicula ex non blandit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas aliquam ligula at neque malesuada auctor. Morbi sit amet quam in urna tempor tincidunt. Vestibulum rutrum feugiat dolor, et gravida elit mattis at. Duis ac lectus cursus, semper orci quis, porttitor leo. Proin venenatis, sem sit amet egestas iaculis, magna felis porttitor justo, efficitur tincidunt ipsum arcu eget ante. Aenean varius, purus vulputate efficitur ultricies, mauris neque blandit magna, quis finibus augue urna at nunc. Sed in eleifend lorem, in elementum urna. Donec interdum, orci id porttitor lacinia, ante diam vulputate felis, eget faucibus dui odio sed dui. Ut eleifend ligula at consectetur pellentesque. Fusce justo eros, egestas a nisl et, ultrices euismod diam. Nullam bibendum quis ipsum eu sodales. Donec mauris elit, pharetra at est id, accumsan aliquet libero. Mauris id tincidunt quam, nec laoreet leo. Donec a laoreet leo, nec aliquet justo.', './ressources/imageCat4.jpg', NULL),
(16, 'Appareils de protection', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.\r\n\r\nVivamus vehicula ex non blandit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas aliquam ligula at neque malesuada auctor. Morbi sit amet quam in urna tempor tincidunt. Vestibulum rutrum feugiat dolor, et gravida elit mattis at. Duis ac lectus cursus, semper orci quis, porttitor leo. Proin venenatis, sem sit amet egestas iaculis, magna felis porttitor justo, efficitur tincidunt ipsum arcu eget ante. Aenean varius, purus vulputate efficitur ultricies, mauris neque blandit magna, quis finibus augue urna at nunc. Sed in eleifend lorem, in elementum urna. Donec interdum, orci id porttitor lacinia, ante diam vulputate felis, eget faucibus dui odio sed dui. Ut eleifend ligula at consectetur pellentesque. Fusce justo eros, egestas a nisl et, ultrices euismod diam. Nullam bibendum quis ipsum eu sodales. Donec mauris elit, pharetra at est id, accumsan aliquet libero. Mauris id tincidunt quam, nec laoreet leo. Donec a laoreet leo, nec aliquet justo.', './ressources/imageCat5.jpg', NULL),
(17, 'Outils', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.\r\n\r\nVivamus vehicula ex non blandit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas aliquam ligula at neque malesuada auctor. Morbi sit amet quam in urna tempor tincidunt. Vestibulum rutrum feugiat dolor, et gravida elit mattis at. Duis ac lectus cursus, semper orci quis, porttitor leo. Proin venenatis, sem sit amet egestas iaculis, magna felis porttitor justo, efficitur tincidunt ipsum arcu eget ante. Aenean varius, purus vulputate efficitur ultricies, mauris neque blandit magna, quis finibus augue urna at nunc. Sed in eleifend lorem, in elementum urna. Donec interdum, orci id porttitor lacinia, ante diam vulputate felis, eget faucibus dui odio sed dui. Ut eleifend ligula at consectetur pellentesque. Fusce justo eros, egestas a nisl et, ultrices euismod diam. Nullam bibendum quis ipsum eu sodales. Donec mauris elit, pharetra at est id, accumsan aliquet libero. Mauris id tincidunt quam, nec laoreet leo. Donec a laoreet leo, nec aliquet justo.', './ressources/imageCat6.jpg', NULL),
(18, 'Equipement de distribution', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.\r\n\r\nVivamus vehicula ex non blandit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas aliquam ligula at neque malesuada auctor. Morbi sit amet quam in urna tempor tincidunt. Vestibulum rutrum feugiat dolor, et gravida elit mattis at. Duis ac lectus cursus, semper orci quis, porttitor leo. Proin venenatis, sem sit amet egestas iaculis, magna felis porttitor justo, efficitur tincidunt ipsum arcu eget ante. Aenean varius, purus vulputate efficitur ultricies, mauris neque blandit magna, quis finibus augue urna at nunc. Sed in eleifend lorem, in elementum urna. Donec interdum, orci id porttitor lacinia, ante diam vulputate felis, eget faucibus dui odio sed dui. Ut eleifend ligula at consectetur pellentesque. Fusce justo eros, egestas a nisl et, ultrices euismod diam. Nullam bibendum quis ipsum eu sodales. Donec mauris elit, pharetra at est id, accumsan aliquet libero. Mauris id tincidunt quam, nec laoreet leo. Donec a laoreet leo, nec aliquet justo.', './ressources/imageCat7.jpg', NULL),
(19, 'Accessoires du système modulaire', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.\r\n\r\nVivamus vehicula ex non blandit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas aliquam ligula at neque malesuada auctor. Morbi sit amet quam in urna tempor tincidunt. Vestibulum rutrum feugiat dolor, et gravida elit mattis at. Duis ac lectus cursus, semper orci quis, porttitor leo. Proin venenatis, sem sit amet egestas iaculis, magna felis porttitor justo, efficitur tincidunt ipsum arcu eget ante. Aenean varius, purus vulputate efficitur ultricies, mauris neque blandit magna, quis finibus augue urna at nunc. Sed in eleifend lorem, in elementum urna. Donec interdum, orci id porttitor lacinia, ante diam vulputate felis, eget faucibus dui odio sed dui. Ut eleifend ligula at consectetur pellentesque. Fusce justo eros, egestas a nisl et, ultrices euismod diam. Nullam bibendum quis ipsum eu sodales. Donec mauris elit, pharetra at est id, accumsan aliquet libero. Mauris id tincidunt quam, nec laoreet leo. Donec a laoreet leo, nec aliquet justo.', './ressources/imageCat8.jpg', NULL),
(20, 'Souscat1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.\r\n\r\nVivamus vehicula ex non blandit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas aliquam ligula at neque malesuada auctor. Morbi sit amet quam in urna tempor tincidunt. Vestibulum rutrum feugiat dolor, et gravida elit mattis at. Duis ac lectus cursus, semper orci quis, porttitor leo. Proin venenatis, sem sit amet egestas iaculis, magna felis porttitor justo, efficitur tincidunt ipsum arcu eget ante. Aenean varius, purus vulputate efficitur ultricies, mauris neque blandit magna, quis finibus augue urna at nunc. Sed in eleifend lorem, in elementum urna. Donec interdum, orci id porttitor lacinia, ante diam vulputate felis, eget faucibus dui odio sed dui. Ut eleifend ligula at consectetur pellentesque. Fusce justo eros, egestas a nisl et, ultrices euismod diam. Nullam bibendum quis ipsum eu sodales. Donec mauris elit, pharetra at est id, accumsan aliquet libero. Mauris id tincidunt quam, nec laoreet leo. Donec a laoreet leo, nec aliquet justo.', './ressources/imageCat1.jpg', 18),
(21, 'Souscat2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.\r\n\r\nVivamus vehicula ex non blandit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas aliquam ligula at neque malesuada auctor. Morbi sit amet quam in urna tempor tincidunt. Vestibulum rutrum feugiat dolor, et gravida elit mattis at. Duis ac lectus cursus, semper orci quis, porttitor leo. Proin venenatis, sem sit amet egestas iaculis, magna felis porttitor justo, efficitur tincidunt ipsum arcu eget ante. Aenean varius, purus vulputate efficitur ultricies, mauris neque blandit magna, quis finibus augue urna at nunc. Sed in eleifend lorem, in elementum urna. Donec interdum, orci id porttitor lacinia, ante diam vulputate felis, eget faucibus dui odio sed dui. Ut eleifend ligula at consectetur pellentesque. Fusce justo eros, egestas a nisl et, ultrices euismod diam. Nullam bibendum quis ipsum eu sodales. Donec mauris elit, pharetra at est id, accumsan aliquet libero. Mauris id tincidunt quam, nec laoreet leo. Donec a laoreet leo, nec aliquet justo.', './ressources/imageCat2.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `marque`
--

CREATE TABLE `marque` (
  `id_marque` int(11) NOT NULL,
  `nom_marque` varchar(30) NOT NULL,
  `origine` varchar(30) NOT NULL,
  `informations` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marque`
--

INSERT INTO `marque` (`id_marque`, `nom_marque`, `origine`, `informations`) VALUES
(1, 'Ingelec', 'Maroc', 'Ingelec est une société marocaine opérant dans le domaine de l\'appareillage électrique. Fondée en 1975, elle appartient au Groupe Sekkat.'),
(2, 'Schneider Electric', 'France', 'Schneider Electric SE (Societas Europaea) est une société multinationale française, créée en 1836 sous le nom de Schneider et Cie avant d\'être rebaptisée Schneider Electric en mai 1999. Elle est spécialiste et leader mondial des solutions numériques d\'énergie et des automatisations pour l\'efficacité énergétique et la durabilité. Ses solutions et ses produits sont destinés aux maisons, aux bâtiments, aux centres de données, aux infrastructures et aux industries, en combinant les technologies énergétiques, l’automatique temps réel, des logiciels et services.'),
(3, 'Legrand', 'France', 'egrand est un groupe industriel français historiquement implanté à Limoges dans le Limousin et un des leaders mondiaux des produits électroniques et systèmes pour les installations électriques.'),
(4, 'Ingelec', 'Maroc', 'Ingelec est une société marocaine opérant dans le domaine de l\'appareillage électrique. Fondée en 1975, elle appartient au Groupe Sekkat.'),
(5, 'Schneider Electric', 'France', 'Schneider Electric SE (Societas Europaea) est une société multinationale française, créée en 1836 sous le nom de Schneider et Cie avant d\'être rebaptisée Schneider Electric en mai 1999. Elle est spécialiste et leader mondial des solutions numériques d\'énergie et des automatisations pour l\'efficacité énergétique et la durabilité. Ses solutions et ses produits sont destinés aux maisons, aux bâtiments, aux centres de données, aux infrastructures et aux industries, en combinant les technologies énergétiques, l’automatique temps réel, des logiciels et services.'),
(6, 'Legrand', 'France', 'egrand est un groupe industriel français historiquement implanté à Limoges dans le Limousin et un des leaders mondiaux des produits électroniques et systèmes pour les installations électriques.'),
(7, 'Ingelec', 'Maroc', 'Ingelec est une société marocaine opérant dans le domaine de l\'appareillage électrique. Fondée en 1975, elle appartient au Groupe Sekkat.'),
(8, 'Schneider Electric', 'France', 'Schneider Electric SE (Societas Europaea) est une société multinationale française, créée en 1836 sous le nom de Schneider et Cie avant d\'être rebaptisée Schneider Electric en mai 1999. Elle est spécialiste et leader mondial des solutions numériques d\'énergie et des automatisations pour l\'efficacité énergétique et la durabilité. Ses solutions et ses produits sont destinés aux maisons, aux bâtiments, aux centres de données, aux infrastructures et aux industries, en combinant les technologies énergétiques, l’automatique temps réel, des logiciels et services.'),
(9, 'Legrand', 'France', 'egrand est un groupe industriel français historiquement implanté à Limoges dans le Limousin et un des leaders mondiaux des produits électroniques et systèmes pour les installations électriques.'),
(10, 'Centrale ', 'France', 'bla bla');

-- --------------------------------------------------------

--
-- Table structure for table `mots_cles`
--

CREATE TABLE `mots_cles` (
  `mot_cle` varchar(30) NOT NULL,
  `id_produit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `image_prod` varchar(255) NOT NULL,
  `num_serie` varchar(255) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `descriptif_produit` text NOT NULL,
  `datasheet` text NOT NULL,
  `id_cat` int(11) DEFAULT NULL,
  `id_marque` int(11) DEFAULT NULL,
  `promotion` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_produit`, `designation`, `image_prod`, `num_serie`, `prix_unitaire`, `descriptif_produit`, `datasheet`, `id_cat`, `id_marque`, `promotion`) VALUES
(9, 'Prise', './ressources/image1.jpg', 'NS-001', 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae massa nec massa scelerisque fermentum nec id urna. Sed lacinia luctus aliquet. Morbi sed blandit arcu, in viverra arcu. Morbi interdum metus urna, in venenatis quam vestibulum a. Nunc in placerat ligula. Pellentesque eu pretium felis. Etiam odio urna, viverra vitae semper et, pulvinar commodo tortor. Fusce bibendum metus eget diam finibus, imperdiet imperdiet enim vestibulum. Donec ut mollis magna, at semper ligula.\r\n\r\nIn hac habitasse platea dictumst. Etiam porttitor fringilla ligula, quis auctor lacus malesuada at. Cras vel elementum tortor. In in tellus elit. Donec vitae gravida est. Etiam pharetra ipsum ut iaculis tristique. Donec ut ipsum magna. Donec tempor massa nec magna ultricies, at rhoncus augue congue. In non lorem lobortis, sodales eros eu, sagittis nulla. Cras quis blandit tellus, sit amet vestibulum augue.\r\n\r\nNulla dolor tortor, commodo id tincidunt vel, viverra sed odio. Donec tristique purus at aliquam mattis. Donec semper urna sed tincidunt placerat. Donec eu egestas mi. Vestibulum rutrum tellus vitae arcu facilisis, feugiat euismod lacus feugiat. Vivamus ut ullamcorper ipsum. Etiam iaculis ac neque sed feugiat.\r\n\r\nNam ut dapibus odio. Cras venenatis ipsum eget erat commodo iaculis. In egestas quis sapien at rutrum. Ut condimentum ipsum magna. Donec nulla dolor, ultricies a venenatis vel, pellentesque ultricies augue. Ut tempor sem id ex dictum viverra. Ut ultricies augue ac sollicitudin pretium. Pellentesque ut mollis est. Aliquam condimentum lobortis ex, pharetra euismod nisl mollis non. Curabitur pellentesque vel metus eget eleifend. Nunc feugiat lectus vitae dapibus cursus. Morbi at tempor ligula, at aliquam nulla.\r\n\r\nSed iaculis nisi eget nibh placerat pharetra. Aenean fringilla felis eget sem pellentesque, quis faucibus enim ultricies. Vivamus nec nisi mollis odio semper blandit. Fusce ullamcorper tortor mi, vel tincidunt sapien commodo non. Vivamus sagittis tellus pellentesque metus cursus mattis. Suspendisse bibendum commodo lacus ac sollicitudin. Proin condimentum sapien purus, vitae tempor nibh fermentum iaculis. Duis at nibh quis magna iaculis viverra.', 'Datasheet1.pdf', 1, 1, NULL),
(10, 'Produit 2', './ressources/image2.jpg', 'NS-002', 200, 'Descriptif du produit 2', 'Datasheet2.pdf', 1, 2, NULL),
(11, 'Produit 3', './ressources/image3.jpg', 'NS-003', 300, 'Descriptif du produit 3', 'Datasheet3.pdf', 1, 3, NULL),
(12, 'Produit 4', './ressources/image4.jpg', 'NS-004', 400, 'Descriptif du produit 4', 'Datasheet4.pdf', 1, 3, NULL),
(13, 'Produit 5', './ressources/image5.jpg', 'NS-005', 500, 'Descriptif du produit 5', 'Datasheet5.pdf', 1, 2, NULL),
(14, 'Produit 6', './ressources/image6.jpg', 'NS-006', 600, 'Descriptif du produit 6', 'Datasheet6.pdf', 1, 3, NULL),
(18, 'Prise 2', './ressources/image6.jpg', 'NS_099', 234000, 'Bah c\'est une prise connard', 'Datasheet.pdf', 1, 1, NULL),
(19, 'Prise améliorée', './ressources/image8.jpg', 'NS_094', 2300, 'Bah c\'est une prise', 'Datasheet67.pdf', 1, 5, NULL),
(20, 'Chargeur', './ressources/image3.jpg', 'DS-N722', 234, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis cursus lacus, a luctus tellus elementum eget. Mauris placerat, diam at dictum molestie, nunc tellus scelerisque purus, id imperdiet quam ipsum non quam. Donec sed erat eget risus placerat iaculis. Morbi eu elementum augue. Nulla sem quam, commodo rutrum tellus quis, suscipit rhoncus sapien. Integer ut ex vel leo posuere suscipit. Sed laoreet velit tristique nisl tincidunt bibendum. Nam in iaculis dolor. Morbi sed mi eget libero malesuada iaculis.', 'https://www.google.com/search?q=pitbull&oq=pitbul&gs_lcrp=EgZjaHJvbWUqDwgAEAAYQxjjAhiABBiKBTIPCAAQABhDGOMCGIAEGIoFMg8IARAuGEMY1AIYgAQYigUyBggCEEUYOTIPCAMQLhhDGNQCGIAEGIoFMgcIBBAAGIAEMgcIBRAAGIAEMgcIBhAuGIAEMgcIBxAAGIAEMgcICBAAGIAEMgcICRAuGIAEqAIAsAIA&sourceid=chrome&ie=UTF-8', 1, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `nom_role` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `nom_role`, `description`) VALUES
(1, 'employe', 'Employe chez Doled'),
(2, 'client', 'client'),
(3, 'patron', 'Gérant de Doled');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `quantite` int(11) NOT NULL,
  `quantite_min` int(11) NOT NULL,
  `id_produit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`quantite`, `quantite_min`, `id_produit`) VALUES
(34, 5, 9),
(2, 10, 10),
(0, 20, 11),
(23, 10, 12),
(34, 5, 14),
(0, 20, 13),
(0, 0, 18),
(90, 0, 19);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  `num_telephone` varchar(20) NOT NULL,
  `points_fidelite` int(11) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `id_role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nom`, `prenom`, `adresse`, `mail`, `num_telephone`, `points_fidelite`, `passwd`, `id_role`) VALUES
(1, 'duval', 'Marie', '1à chemin de la maison', 'marieddddi@gmail.com', '7677', 10, 'azertyuiop1234@', 2),
(2, 'cc', 'cc', NULL, 'cc@fmail.com', '22222', 0, 'aa', 2),
(3, 'Boukhizzou', 'Ines', NULL, 'boukhizzou4@gmail.com', '761927341', 0, '$2y$10$ZxU4larmqZN40iRbnA5FC.eiAanXbp2W0TouUAEJZMxHx2.noprSS', 2),
(4, 'huret', 'martial', 'bla bla 20 bla ', 'martial@gmail.com', '99999', 34, 'Dooled', 1),
(5, 'Toto', 'Tata', NULL, 'toto@gmail.com', '0761927341', 0, '$2y$10$gM2OnksNZwF.g5L8zTtSa.RBGx7MGzg0MbwrlX.EoQdGzcrQIqxTS', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`),
  ADD KEY `sous_cat` (`sous_cat`);

--
-- Indexes for table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id_marque`);

--
-- Indexes for table `mots_cles`
--
ALTER TABLE `mots_cles`
  ADD PRIMARY KEY (`mot_cle`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_marque` (`id_marque`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD KEY `id_produit` (`id_produit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `marque`
--
ALTER TABLE `marque`
  MODIFY `id_marque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_ibfk_1` FOREIGN KEY (`sous_cat`) REFERENCES `categorie` (`id_cat`);

--
-- Constraints for table `mots_cles`
--
ALTER TABLE `mots_cles`
  ADD CONSTRAINT `mots_cles_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id_marque`),
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
