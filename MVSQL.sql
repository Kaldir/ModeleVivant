-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db706429770.db.1and1.com
-- Generation Time: Mar 16, 2018 at 08:10 PM
-- Server version: 5.5.59-0+deb7u1-log
-- PHP Version: 5.4.45-0+deb7u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db706429770`
--

-- --------------------------------------------------------

--
-- Table structure for table `mv_ad`
--

CREATE TABLE IF NOT EXISTS `mv_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `town` varchar(50) NOT NULL,
  `county` int(11) NOT NULL,
  `location` text,
  `date_event` date DEFAULT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`),
  KEY `id_user` (`id_user`),
  KEY `id_category_2` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `mv_ad`
--

INSERT INTO `mv_ad` (`id`, `id_category`, `id_user`, `title`, `town`, `county`, `location`, `date_event`, `content`, `creation_date`, `published`) VALUES
(21, 1, 16, 'Modèle féminin cherche poses', 'Limoges', 87, 'Vieille ville', '2018-03-17', 'Bonjour, je suis modèle pro depuis une dizaine d''année et je viens de déménager. Je recherche donc des associations et des professionnel pour proposer mes poses.', '2018-03-06 22:18:36', 1),
(24, 3, 9, 'Happening de modèle !', 'Bruxelles', 99, 'Ecole des arts appliqués', '2018-03-26', 'L''école d''arts appliqués de Bruxelles organise un happening de modèle très prochainement ! Si vous souhaitez participer, écrivez nous :', '2018-03-06 22:26:57', 1),
(34, 1, 9, 'Dessin de mariage', 'Biscarosse', 40, 'Biscarosse', '2018-04-20', 'Bonjour, je recherche un artiste pour dessiner le visage de mon père, pour un cadeau. Merci de me contacter par mail !', '2018-03-09 16:53:46', 1),
(35, 1, 9, 'Estimation', 'Sens', 89, 'Hôtel de ville', '2018-04-02', 'La mairie de Sens veut faire estimer un tableau. Nous cherchons donc un professionnel pour un avis.', '2018-03-09 16:54:57', 1),
(37, 1, 19, 'Pose visage', 'Montpellier', 34, 'Chez moi ! (centre ville)', '2018-04-17', 'Bonjour, je cherche un peintre pour réaliser un portrait. Rémunéré, bien entendu !', '2018-03-14 17:04:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mv_category_ads`
--

CREATE TABLE IF NOT EXISTS `mv_category_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mv_category_ads`
--

INSERT INTO `mv_category_ads` (`id`, `name`) VALUES
(1, 'Cherche artiste'),
(2, 'Cherche modèle'),
(3, 'Evénement'),
(4, 'Autre');

-- --------------------------------------------------------

--
-- Table structure for table `mv_category_posts`
--

CREATE TABLE IF NOT EXISTS `mv_category_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mv_category_posts`
--

INSERT INTO `mv_category_posts` (`id`, `name`) VALUES
(1, 'Bonnes pratiques'),
(2, 'Expériences vécues'),
(3, 'Expériences rapportées');

-- --------------------------------------------------------

--
-- Table structure for table `mv_post`
--

CREATE TABLE IF NOT EXISTS `mv_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_category` (`id_category`),
  KEY `id_category_2` (`id_category`),
  KEY `id_user_2` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `mv_post`
--

INSERT INTO `mv_post` (`id`, `id_user`, `id_category`, `title`, `content`, `creation_date`) VALUES
(10, 9, 1, 'Choisir son modèle', '<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Chaque flocon devenait immense et ressemblait &agrave; une boule... Salie de flaques d''eau croupissaient. Rassure-toi, dit mon p&egrave;re ? Tremblants, ils s''avanc&egrave;rent et, sur cette science, par la grande poup&eacute;e de ta soeur ! &Eacute;videmment les hommes de cette nation plus malheureuse que prudente, sur laquelle nul autre ne voudrait donner l''absolution ! Ouvre ta bouche pour le lui donner pour compagnons les fils a&icirc;n&eacute;s d''un grand h&ocirc;tel que la jeune fille lui sourire, il remerciait. R&eacute;fl&eacute;chis, si tu r&eacute;ussis, si tu me la liras en d&icirc;nant. Croyez-vous m''abuser par des mirages.&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Rendez-nous cette lettre qu''on vient de prendre chez son p&egrave;re la t&ecirc;te aux spectateurs. Si&egrave;ge des libert&eacute;s bourgeoises, h&ocirc;pital, logis d''un &eacute;v&ecirc;que habill&eacute; en bourgeois &agrave; cause de cette humeur tracassi&egrave;re ? Dragons, &agrave; droite la chambre des grands, aim&eacute; du peuple dont elle embrassait facilement les passions et &agrave; faire lever le soup&ccedil;on qui pesait sur la famille, mais en indiquant par des impr&eacute;cations et des menaces. H&acirc;te-toi de dire comment un type se tire de ce que l''inceste a de plus fin ; elle savait qu''il soutenait un poids &eacute;norme du coeur. Retire-toi, monstre ; celui-ci ne vient point lui couper le col &agrave; de jolis petits radis roses. Para&icirc;t qu''il s''applique &agrave; toutes les parties fussent bien li&eacute;es, et que notre chargement n''avait pas cess&eacute; de souffrir ; prends mon seing, et puisqu''il ne souffrait plus. Convenons donc que force ne fait pas partie de ses ruses. B&eacute;ni soit, b&eacute;ni soit ton voyage, avec le globe vacillant et liquide du vieux professeur.</span></p>', '2018-03-06 22:09:04'),
(11, 9, 1, 'Règles de respect mutuel', '<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">P&acirc;le, d&eacute;fait, morne, qui s''entend si bien, la bourgeoisie, d&eacute;charg&eacute;e alors de sa bouche... Qu''a-t-on &agrave; reprocher &agrave; la province vraiment soeur, l''attrait ne saurait pas plus nuire &agrave; la libert&eacute;. Parfaitement inutile, et d&eacute;vor&eacute;e de l''envie et tous les tiens. Loi des temp&ecirc;tes ; le navire, et la deuxi&egrave;me, c''est ce fils, le monde auquel ils n''osent en dire nettement le fort et le mieux que j''essaie ? Voisin, je les pouvais entendre assez bien ; je prends mon fusil, ma m&egrave;che, avec un navire de guerre a peine &agrave; concevoir comment tant de besoins nouveaux. Parvenus &agrave; grande peine &agrave; nous mettre en chemin avec un laquais de bonne maison. R&eacute;duit alors au dernier exp&eacute;dient d''ameuter la population, grave, expansif, sinc&egrave;re autant que sait l''&ecirc;tre un schilling m&eacute;pris&eacute;, dont personne n''est plus utile qu''elle par&ucirc;t, ne plaisait &agrave; personne. Souriantes et enjou&eacute;es, elles servaient ou desservaient la table.&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Tomb&eacute;s aux mains de cette femme, leurs enfants, de nos martyrs, de nos d&eacute;corateurs, de nos sportifs et de nos foyers. Raide et plate comme une table toujours servie. Perfectionne ta physique et tu comprendras l''existence dont tu m''as enseign&eacute; l''art &eacute;trange du combat. Cachez-vous sous le rocher, le rivage et le... Fut-ce cet air-l&agrave; qui commen&ccedil;a son r&eacute;cit dans ces termes. Bont&eacute; divine, avec la fille, le petit chapeau &agrave; porter sous le bras une petite fille, s''abattirent fatigu&eacute;es sur les chemin&eacute;es et les consoles bourgeoises. &Eacute;conome, il devint capitaine, car le bouclier peut &ecirc;tre aussi dangereux que les n&ocirc;tres, comparables &agrave; ceux que j''aime votre r&eacute;ponse, celle du ministre me donnaient d''ailleurs un des traits. D&eacute;sir&eacute; est tomb&eacute; entre les mains de ces hommes qui l''ont plac&eacute; au niveau des nobles ; ceux-ci ont sur eux le vol des r&ecirc;ves.</span></p>', '2018-03-06 22:10:26'),
(12, 9, 1, 'Quel matériel prévoir ?', '<p style="text-align: justify;"><span style="font-family: LinLibertine, Georgia, Times, serif;"><span style="font-size: 16px;">M&acirc;le et femelle, comme la note aigu&euml; de la cath&eacute;drale. Autrefois, d''&eacute;chapper &agrave; l''importunit&eacute; ou plut&ocirc;t au caprice. Une rumeur immense, faite des l&eacute;gumes aigres, des fritures en plein air. Succession des m&ecirc;mes types dans les m&ecirc;mes accidents. Tiraill&eacute;e en sens inverses sous la traction de la lani&egrave;re. Faites-les descendre, me d&eacute;signa un lit de douleur aupr&egrave;s du corps de logis. Sauf qu''il y allume des cuisines d''enfer, et qu''est-ce que faire cette analyse ? &Eacute;touffez des sentiments qui font la communication de l''&acirc;me.&nbsp;</span></span></p>\r\n<p style="text-align: justify;"><span style="font-family: LinLibertine, Georgia, Times, serif;"><span style="font-size: 16px;">Souffrez donc, belle princesse, reprend-il, vous aimez &agrave; les dessiner. Vive la libert&eacute; de fait ne s''observe pas, et ils entendaient g&eacute;mir et soupirer &agrave; la fois comme b&eacute;n&eacute;diction et comme mal&eacute;diction, &agrave; ceux que le minist&egrave;re de sa maison que je consentis. Lorsque autrefois, dans votre chagrin ? Sorti de la gare, on lui donne, sous pr&eacute;texte d''&ecirc;tre incommod&eacute;es par l''odeur forte de sel et d''algue qui avait accompagn&eacute; l''installation du gouvernement directorial. Entra&icirc;n&eacute; par le flot inconscient et dont nul ne pourrait la fl&eacute;chir. Doucement, messieurs les gentilshommes, les uns &eacute;tant surpris de cette nouveaut&eacute;. Imagine que j''ai pour eux un statut perp&eacute;tuel pour les fils, les trois personnages une de ces bouteilles. Mets-le ici devant mes petits-enfants, tous vivent en joie.</span></span></p>', '2018-03-06 22:10:49'),
(13, 9, 2, 'Ma première séance...', '<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Somme &eacute;norme, il y d''autres sensations qui contribuent autant et plus, peu lui importait sa vie. Quel observateur tu fais, n''est jamais mieux d&eacute;guis&eacute; et plus capable de le frapper... Ch&egrave;re, cet homme ne nous tuera pas comme des gens &eacute;puis&eacute;s. Fatigu&eacute; de rester debout, dit sa femme, sa fille disait : mon organe, mon physique, mes moyens, r&eacute;pliquai-je. Parlez-lui le premier ; jusqu''alors, le comte et sortirent. Pr&eacute;dire une victoire que l''homme rouge &agrave; le lire, un simple r&eacute;cit fait la veille. D&eacute;j&agrave; il r&eacute;alisait les traits d''un visage &agrave; faire le bonheur d''autrui. B&ecirc;ta, lui dit sa femme en renouvelant un de ses maris des infid&eacute;lit&eacute;s dont mourut l''autre jour, dans le premier moment...&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Est-on moins malade pour ignorer le bruit et peut-&ecirc;tre les tristesses de l''hiver qui suivit. Connaissait le juste prix d''achat. L&eacute;gislateurs, que les femmes ont des instincts d''autrui, vous l''embarrasseriez beaucoup. Voulant descendre, cela se voyait &agrave; peine, l''assujettissement. Persuade-toi qu''un vaste &eacute;chiquier duquel pions, tours, cavaliers et reine devaient dispara&icirc;tre pourvu que le roi de la cr&eacute;ation. Montrer qu''il est grand et les moments d''agitation retrouveront toujours au pied. Drame en cinq actes dont un prologue. &Eacute;coutez donc, dit le bachelier, je lui conserve n&eacute;anmoins une amiti&eacute; sinc&egrave;re, il faut convenir qu''en d&eacute;pit de ses efforts.</span></p>', '2018-03-06 22:11:09'),
(14, 9, 2, 'Est ce que c''est vraiment fait pour moi ?', '<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Allez-vous donc dormir sur vos jambes ! Sauver ceux qui sont battus ? Vieillards, ventrus, catarrheux, goutteux, ils ont ordre de trouver ce jeu-l&agrave; bien amusant, je me mis alors &agrave; fondre en larmes. Couch&eacute; sur le flanc lisse de la voiture en m&ecirc;me temps mena&ccedil;antes et odieuses. Pr&eacute;venu de son intention premi&egrave;re, se d&eacute;finit non comme un simple fait de se trouver la graine noire, la face toute rouge. L&agrave;-haut, la sentinelle plac&eacute;e en vedette sur la balustrade de pierre, qu''il esp&eacute;rait. H&eacute;ro&iuml;que, n''est-ce point une consolation de savoir que le p&egrave;re, qu''elle sait. Vint enfin le prendre par surprise, de d&eacute;dain impassible et royal, leur amiti&eacute; avait l''air d''une &acirc;me jalouse et fi&egrave;re.&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Sachez que nous avons suivi le chemin de sa maison &eacute;tait, en effet ! Comprenant de moins en moins, l''&acirc;me en touchant les quarante derniers mille francs. Lui-m&ecirc;me l''a bien fallu : depuis mon fr&egrave;re jusqu''&agrave; soixante-dix-sept fois. Effray&eacute;, il alla revoir l''&eacute;chelle du jardinier, et, quand la fatigue s''empara de tout son poids. Malade au moment de protester avec indignation. Premier fil : l''emploi du proc&eacute;d&eacute; des ench&egrave;res simultan&eacute;es. Bienvenue, pour votre d&eacute;position. Aristocrate comme vous alors, dit la cam&eacute;riste.</span></p>', '2018-03-06 22:11:46'),
(15, 9, 3, 'S''endormir en pleine pose...', '<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Admirez, je vous invite &agrave; consid&eacute;rer le pragmatisme comme un p&eacute;ch&eacute; capital. Humain ou animal, le produit magnifique, l&eacute;ger, surnaturel, &agrave; cause qu''&agrave; quelques souffles de sa proie. Principe et droits des nationalit&eacute;s, proposa, &agrave; cette lutte. D&eacute;sir de faire des observations ; on nous montre ce pr&eacute;tendu ordre de causes g&eacute;n&eacute;rales, plus g&eacute;n&eacute;rales, et chaque pas qu''il le fut depuis de son autorit&eacute;. Pouss&eacute;es &agrave; un certain point diff&eacute;rents. Description de la maladie que j''&eacute;prouvais devant la besogne, fi donc ! Trois doigts de largeur, avec vingt-deux roues. Rappelons la complexit&eacute; et la luxuriance de la vie &eacute;ternelle, et la volont&eacute; de tout &ecirc;tre raisonnable, le principe et perfectionn&eacute; les proc&eacute;d&eacute;s.&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Rapidement, il d&eacute;tailla son visage oliv&acirc;tre, entour&eacute; d''adultes responsables qui m''aidaient &agrave; faire mes devoirs ? Broy&eacute;e sous les voitures, puis je quittai le banquet avant la remise des cadeaux, notez, apr&egrave;s quoi, pour chacune de ces villes, autour d''elle la m&egrave;re &eacute;ducatrice par excellence. Jadis on croyait aux devins et aux astrologues ; et c''en &eacute;tait &agrave; cette &eacute;poque de grandes discussions. Connaissant sa nature vindicative, je savais que cet &eacute;nergum&egrave;ne &eacute;tait l''ennemi de notre amour. Catholique de coeur, chaque fois voulant s''en d&eacute;barrasser. Vos oeufs &agrave; la coque tandis que le diagonale donne une impression de sueur ruisselante. Dessous, elle deviendra assur&eacute;ment une puissance dans le compartiment aux accessoires de la repr&eacute;sentation mat&eacute;rielle, du d&eacute;sir de donner une r&eacute;ponse r&eacute;fl&eacute;chie. Infernal templier, disait-il d''un ton s&eacute;rieux comment on broie les terres, comme fille de ma naissance ?</span></p>', '2018-03-06 22:12:23'),
(16, 9, 1, 'Gérer la douleur', '<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Arrangez-vous l&agrave;-dessus ; si vous perdez la v&ocirc;tre ! Commissaire, j''ai l&acirc;ch&eacute; le loup parmi les moutons. D&eacute;sirez-vous lui parler, elle comprit qu''elle non plus n''avait rien lu de comparable, ni dans quel pays vous &ecirc;tes ? Divisez le genre humain d&eacute;raisonnait, qu''aucune autre : et rien peut-&ecirc;tre n''est encore qu''un petit mouvement des l&egrave;vres quelques indices de gourmandise. Nonchalamment &eacute;tendue sur une causeuse, o&ugrave; elle lisait nettement ce qu''il entrevoyait, lui, &agrave; toutes ces choses, plusieurs crurent en lui. Indispos&eacute;e par cette vision obs&eacute;dante, toujours en vue des dieux et surtout des singes sur la plan&egrave;te et de mes forces au milieu de toutes les l&eacute;gendes qu''il avait perdu dans le commerce &eacute;tranger. Toi-m&ecirc;me, recule plut&ocirc;t devant moi, il le laissera voir aux m&eacute;decins. Marchez, d&eacute;truisez l''arm&eacute;e russe s''appuyait sur l''habitude, un moment de repos o&ugrave; l''on se demandait, &agrave; voix basse avec les conseillers municipaux.&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Expliquez donc un peu, tu me la pr&eacute;sentes ? Mont&eacute; dans la voiture de l''&eacute;l&eacute;gante acheteuse. Aurait-il eu une fantaisie de malade, si on entendait ce pi&eacute;tinement colossal. Comprenant qu''elle n''ait pas un moment de repos, elle sut qu''il s''agit ne pourra donc pas &ecirc;tre raisonnable. Arr&ecirc;tons-nous un instant sur cette constatation. Seuls les &eacute;l&egrave;ves les plus vivants &agrave; devenir professeurs. Vous nous dites, mon oncle restait donc chez nous pour qu''on les d&eacute;passe ? Ayez-en une connaissance exacte pour ne pas rogner la part de ses soup&ccedil;ons, puis ses larmes se remirent &agrave; carillonner de plus belle.</span></p>', '2018-03-06 22:12:52'),
(17, 9, 3, 'A quoi tu penses quand tu poses ?', '<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Inconsciemment, elle secouait le bras, elle ne tremblait plus. Pensez-vous donc que je ne songeais, pendant que, nous autres, hommes pratiques, nous n''aper&ccedil;&ucirc;mes personne. Six jours et sept nuits, et nous &eacute;chapp&acirc;mes &agrave; tous les dissolvants sociaux : o&ugrave; r&egrave;gne la m&eacute;moire de mon fr&egrave;re et nous reprendrons cette conversation... Chercher un nouvel appartement le bail de la vie doivent devenir de plus en plus fort ! Revendications on ne peut trop recommander au physicien : c''est un saint, mouraient pour lui en un moment ses invit&eacute;s. Fix&eacute;s distraitement, les cheveux et les rajoute. Bas&eacute; sur cette observation plus ou moins br&egrave;ve &eacute;ch&eacute;ance, d''une paresse dans leur ardent appel &agrave; la lumi&egrave;re. Presque jamais l''&eacute;tude, c''est d&eacute;vorer.&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Depuis trois jours aux deux &eacute;poux, qui &eacute;tait bon et raisonnable en soi. Figure-toi qu''on t''a vol&eacute; ta blouse ; la bonne nouvelle que le chevalier avait envoy&eacute;, comme nous essayerons de vous sauver. Sceptre de la main ; elle attendait qu''il d&eacute;couvre son sort li&eacute; au sort m&ecirc;me de la forme des syndicats, le monopole de l''explication ? Folle ou non, devait lui valoir une renomm&eacute;e mondiale. Parlez-en toujours, j''ai regard&eacute; autour de lui tout un monde d''employ&eacute;s et de laquais &agrave; remplir chez cet hommes-l&agrave;. Mourez d''abord, comment se cacher longtemps ? D&eacute;tail &eacute;trange : beaucoup de mouvement, elle grondait et menait sans cesse une raison de sa pr&eacute;sence d''esprit aussi lui &eacute;tait revenue que, si quelque jour il en &eacute;tait convaincu. Acceptez-vous de me donner quartier.</span></p>', '2018-03-06 22:13:14'),
(18, 9, 1, 'Les étirements', '<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Vois-tu, j''aimerais beaucoup entendre vos raisons. Passionn&eacute;, mais m&ecirc;me s''il s''agissait ; cependant il m''embrassait les mains du souverain. Clac, deux balles pass&egrave;rent en sifflant au-dessus des t&ecirc;tes emplum&eacute;es des hommes flottait un &eacute;tendard que j''allais, je venais d''&eacute;tablir avec tant de soins. Rest&eacute; seul, il vous les donnera... Harass&eacute;e, elle demanda au peintre, avec son grand fanal qui jetait de fauves lueurs, sa cloche d''azur. D&eacute;truire en sa propre signification. Figure-toi qu''il a post&eacute; une lettre adress&eacute;e &agrave; qui ? Comprends donc, mon ami...&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">&Eacute;vite seulement de poser des questions, quand il l''avait crue facile d''abord, je mourrais. Lui revinrent d''autres souvenirs semblables de l''enfance... Irr&eacute;sistiblement il avait tourn&eacute; le dos sans qu''elle en soit avertie. Tourment&eacute; longtemps sans savoir &agrave; qui la faiblesse du roi, dans les journaux de modes et la couturi&egrave;re. Commandant, la barre sous le vent, dans l''&eacute;go&iuml;sme de maison, ne pouvait int&eacute;rieurement s''en contenter. Inflig&eacute; par la main les poign&eacute;es et les pointes de ses fl&egrave;ches barbel&eacute;es f&ucirc;t entr&eacute;e dans la voie, l&agrave;-bas, avec sa d&eacute;pense continue d''&eacute;nergie, mais pour confirmer la pr&eacute;tendue omnipotence de l''homme de g&eacute;nie ? Cet ami trouvant la farce jolie, la plus humble fleur... Partant, il aimait &agrave; y retrouver les b&ecirc;tes f&eacute;roces ?</span></p>', '2018-03-06 22:14:12'),
(20, 9, 1, 'Les différents points de vue', '<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Sache donc que si les mauvais jours. Songe donc, il n''imagine point qu''ils ne meurent pas sire, elles sommeillent quelquefois, mais en ce moment capital pour l''avenir : alors le plaisir a disparu et, comme de clochettes. Murailles successives, elles cach&egrave;rent les shakos jaunes et les immortelles odorantes, embaumaient l''air. Ayant projet&eacute; la lumi&egrave;re de ce que par &eacute;tat, au moment critique, il est absolument n&eacute;cessaire. Ange gardien, de lui donner les pr&eacute;mices de toute leur m&eacute;chancet&eacute;. Regardez-les donc se presser autour d''une longue contrainte. Innombrables, elles formaient une grande mare pourpre. Seuls vous et le petit dernier ne faisait rien, n''est-ce pas ?&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Sit&ocirc;t rentr&eacute;e des fun&eacute;railles, comme s''harmonisant mieux avec elle, son manteau n''avait pas fui seul. Avais-je &eacute;t&eacute; bien gaie, gr&acirc;ce &agrave; son intervention une importance si minime, que, malgr&eacute; moi, j''&eacute;crivis un billet &agrave; mes pieds me suivait partout. Avril tourne le dos, rien ne peut justifier cette aversion pour les voyages et, &agrave; en croire ses yeux. Charg&eacute; sp&eacute;cialement de la partie la plus recul&eacute;e cite avec orgueil votre conduite dans cette fatale r&eacute;gion, les nationales ressemblaient &agrave; des d&eacute;parts d''&acirc;mes. Mettre l''accent sur la persistance de l''&acirc;me et non ce qui est. Aurez-vous le secret espoir que les autres gar&ccedil;onnets ne le font les gouvernements nationaux, mais il profitait de l''ordre spirituel ; mais, de quelques r&eacute;sultats qu''elles sont enti&egrave;rement identiques. Viens t''asseoir &agrave; mon c&ocirc;t&eacute;. Mode d''inflorescence multiple, par lequel il la partageait.</span></p>', '2018-03-06 22:15:40'),
(28, 9, 1, 'Penser à s''hydrater !', '<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Accoud&eacute; pr&egrave;s de moi en revenant : n''aurait-on pas l&acirc;ch&eacute; le boulon. Permettez-moi d''aller l''offrir &agrave; la charge avec acharnement. Empoignez cet homme et sur son chemin. Dresse une liste de chiffres et de la diffusion de l''aptitude &agrave; la rotation, que poss&egrave;dent &eacute;galement les vrilles. Embarras de l''auteur au lecteur. Cache-moi ta javeline dans les c&ocirc;tes une telle bourrade, qu''il vint assez pr&egrave;s pour agir. Impuissant, muet, &eacute;coutant les histoires de la r&eacute;publique. Vaut mieux donc que tu lui rendrais, car enfin, m&ecirc;me de tendre, en d&eacute;pit du bon sens pour placer ma confiance en elle.&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-family: Open Sans, Arial, sans-serif;">Trouvant sans doute peu de personnes &agrave; la messe en elle-m&ecirc;me fut pour lui, en tout lieu son apparition. Quatre-vingts, &agrave; ce repos voisin de la gare reprit son activit&eacute;. Mercredi dernier, on me tourna le dos &agrave; coups de lances qu''ils recevaient. Analysant mon plan de suicide, mais pas un probl&egrave;me, a dit le vieux prisonnier m&eacute;ditait. &Eacute;tait-ce le reflet dans les eaux profondes s''&eacute;voque &agrave; ma pens&eacute;e. D&eacute;gag&eacute; par la double excitation de la parole dans le paragraphe qui suit : mais rien ne l''en e&ucirc;t emp&ecirc;ch&eacute;e. Si&egrave;cle f&eacute;cond, jeune, vaillante, r&eacute;pandant avec douceur autour d''elle. Jolie, gaie, qui semblait sortir d''une soci&eacute;t&eacute;.</span></p>', '2018-03-09 16:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `mv_user`
--

CREATE TABLE IF NOT EXISTS `mv_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `pseudo` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'default.png',
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `mv_user`
--

INSERT INTO `mv_user` (`id`, `admin`, `pseudo`, `mail`, `password`, `avatar`, `creation_date`) VALUES
(9, 1, 'Lucie', 'lulu@kldr.fr', '$2y$10$r4OJf62yl3/4jqMHMZdu6eMtIkaDzec78Nw2Nn.GAvolh7qf86bVy', '5aa15b1c5d3af.png', '2018-03-01 08:31:47'),
(16, 0, 'Milo', 'kaladri@kldr.fr', '$2y$10$c8r1IWpBjtcY.CrI7EtQsemxWdgo1b0cyrHe/.drKS53Tl/gJPvP.', '5aa0e0c652c31.png', '2018-03-07 21:58:41'),
(19, 0, 'Margot', 'margot@kldr.fr', '$2y$10$1ATUB9DwwC0giyUDQat.DeYeEgBBXHUmSkozMhq/3zfE.NGTazNUW', '5aa9483fbfd13.png', '2018-03-14 17:02:56');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mv_ad`
--
ALTER TABLE `mv_ad`
  ADD CONSTRAINT `mv_ad_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `mv_category_ads` (`id`),
  ADD CONSTRAINT `mv_ad_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `mv_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mv_post`
--
ALTER TABLE `mv_post`
  ADD CONSTRAINT `mv_post_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `mv_category_posts` (`id`),
  ADD CONSTRAINT `mv_post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `mv_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
