# ************************************************************
# Sequel Ace SQL dump
# Версия 20046
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Хост: localhost (MySQL 5.7.39)
# База данных: oniks
# Время формирования: 2023-05-10 06:37:43 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы admin_ip
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_ip`;

CREATE TABLE `admin_ip` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `admin_ip` WRITE;
/*!40000 ALTER TABLE `admin_ip` DISABLE KEYS */;

INSERT INTO `admin_ip` (`id`, `ip`)
VALUES
	(1,'127.0.0.1, ::1');

/*!40000 ALTER TABLE `admin_ip` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы afisha
# ------------------------------------------------------------

DROP TABLE IF EXISTS `afisha`;

CREATE TABLE `afisha` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `premieres_id` int(11) DEFAULT NULL COMMENT 'id таблица пермьеры',
  `date_show` date DEFAULT NULL COMMENT 'дата показа',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `afisha` WRITE;
/*!40000 ALTER TABLE `afisha` DISABLE KEYS */;

INSERT INTO `afisha` (`id`, `premieres_id`, `date_show`)
VALUES
	(12,7,'2023-03-16');

/*!40000 ALTER TABLE `afisha` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы country
# ------------------------------------------------------------

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` int(10) NOT NULL,
  `iso` char(2) NOT NULL,
  `emoji` char(2) NOT NULL,
  `country_ru` char(100) NOT NULL,
  `country_en` char(100) NOT NULL,
  `name` char(100) NOT NULL,
  `language_ru` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Страны';

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;

INSERT INTO `country` (`id`, `iso`, `emoji`, `country_ru`, `country_en`, `name`, `language_ru`)
VALUES
	(1,'AU','🇦🇺','Австралия','Australia','Australia','английский'),
	(2,'AT','🇦🇹','Австрия','Austria','Österreich','немецкий'),
	(3,'AZ','🇦🇿','Азербайджан','Azerbaijan','Azərbaycan','азербайджанский'),
	(6,'AL','🇦🇱','Албания','Albania','Shqipëria','албанский'),
	(7,'DZ','🇩🇿','Алжир','Algeria','الجزائر','арабский'),
	(9,'AI','🇦🇮','Ангилья','Anguilla','Anguilla','английский'),
	(10,'AO','🇦🇴','Ангола','Angola','Angola','португальский'),
	(11,'AD','🇦🇩','Андорра','Andorra','Andorra','каталонский'),
	(14,'AR','🇦🇷','Аргентина','Argentina','Argentina','испанский'),
	(15,'AM','🇦🇲','Армения','Armenia','Հայաստան','армянский'),
	(16,'AW','🇦🇼','Аруба','Aruba','Aruba','нидерландский'),
	(17,'AF','🇦🇫','Афганистан','Afghanistan','افغانستان','пушту'),
	(18,'BS','🇧🇸','Багамские Острова','Bahamas','The Bahamas','английский'),
	(19,'BD','🇧🇩','Бангладеш','Bangladesh','বাংলাদেশ','бенгальский'),
	(20,'BB','🇧🇧','Барбадос','Barbados','Barbados','английский'),
	(21,'BH','🇧🇭','Бахрейн','Bahrain','البحرين‎‎‎‎‎‎','арабский'),
	(22,'BZ','🇧🇿','Белиз','Belize','Belize','английский'),
	(23,'BY','🇧🇾','Белоруссия','Belarus','Беларусь','белорусский'),
	(24,'BE','🇧🇪','Бельгия','Belgium','Belgique','французский'),
	(25,'BJ','🇧🇯','Бенин','Benin','Bénin','французский'),
	(26,'BM','🇧🇲','Бермудские Острова','Bermuda','Bermuda','английский'),
	(27,'BG','🇧🇬','Болгария','Bulgaria','България','болгарский'),
	(28,'BO','🇧🇴','Боливия','Bolivia','Bolivia','испанский'),
	(29,'BQ','🇧🇶','Бонайре, Синт-Эстатиус и Саба','Bonaire, Sint Eustatius and Saba','Bonaire, Sint Eustatius en Saba','нидерландский'),
	(30,'BA','🇧🇦','Босния и Герцеговина','Bosnia and Herzegovina','Босна и Херцеговина','сербский'),
	(31,'BW','🇧🇼','Ботсвана','Botswana','Botswana','английский'),
	(32,'BR','🇧🇷','Бразилия','Brazil','Brasil','португальский'),
	(34,'BN','🇧🇳','Бруней','Brunei Darussalam','بروني','малайский'),
	(35,'BF','🇧🇫','Буркина-Фасо','Burkina Faso','Burkina Faso','французский'),
	(36,'BI','🇧🇮','Бурунди','Burundi','Burundi','рунди'),
	(37,'BT','🇧🇹','Бутан','Bhutan','འབྲུག་ཡུལ','дзонг-кэ'),
	(38,'VU','🇻🇺','Вануату','Vanuatu','Vanuatu','бислама'),
	(39,'VA','🇻🇦','Ватикан','Vatican City','Civitas Vaticana','латинский'),
	(40,'GB','🇬🇧','Великобритания','United Kingdom','United Kingdom','английский'),
	(41,'HU','🇭🇺','Венгрия','Hungary','Magyarország','венгерский'),
	(42,'VE','🇻🇪','Венесуэла','Venezuela','Venezuela','испанский'),
	(45,'TL','🇹🇱','Восточный Тимор','Timor-Leste','Timor Lorosa’e','тетум'),
	(46,'VN','🇻🇳','Вьетнам','Viet Nam','Việt Nam','вьетнамский'),
	(47,'GA','🇬🇦','Габон','Gabon','Gabon','французский'),
	(48,'HT','🇭🇹','Гаити','Haiti','Haïti','французский'),
	(49,'GY','🇬🇾','Гайана','Guyana','Guyana','английский'),
	(50,'GM','🇬🇲','Гамбия','Gambia','The Gambia','английский'),
	(51,'GH','🇬🇭','Гана','Ghana','Ghana','английский'),
	(52,'GP','🇬🇵','Гваделупа','Guadeloupe','Guadeloupe','французский'),
	(53,'GT','🇬🇹','Гватемала','Guatemala','Guatemala','испанский'),
	(54,'GN','🇬🇳','Гвинея','Guinea','Guinée','французский'),
	(55,'GW','🇬🇼','Гвинея-Бисау','Guinea-Bissau','Guiné-Bissau','португальский'),
	(56,'DE','🇩🇪','Германия','Germany','Deutschland','немецкий'),
	(57,'GG','🇬🇬','Гернси','Guernsey','Guernsey','английский'),
	(58,'GI','🇬🇮','Гибралтар','Gibraltar','Gibraltar','английский'),
	(59,'HN','🇭🇳','Гондурас','Honduras','Honduras','испанский'),
	(60,'HK','🇭🇰','Гонконг','Hong Kong','香港','китайский'),
	(61,'GD','🇬🇩','Гренада','Grenada','Grenada','английский'),
	(62,'GL','🇬🇱','Гренландия','Greenland','Kalaallit Nunaat','гренландский'),
	(63,'GR','🇬🇷','Греция','Greece','Ελλάδα','греческий'),
	(64,'GE','🇬🇪','Грузия','Georgia','საქართველო','грузинский'),
	(65,'GU','🇬🇺','Гуам','Guam','Guam','английский'),
	(66,'DK','🇩🇰','Дания','Denmark','Danmark','датский'),
	(67,'JE','🇯🇪','Джерси','Jersey','Jersey','английский'),
	(68,'DJ','🇩🇯','Джибути','Djibouti','جيبوتي','арабский'),
	(69,'DM','🇩🇲','Доминика','Dominica','Dominica','английский'),
	(70,'DO','🇩🇴','Доминиканская Республика','Dominican Republic','República Dominicana','испанский'),
	(72,'EG','🇪🇬','Египет','Egypt','مصر','арабский'),
	(73,'ZM','🇿🇲','Замбия','Zambia','Zambia','английский'),
	(75,'ZW','🇿🇼','Зимбабве','Zimbabwe','Zimbabwe','английский'),
	(76,'IL','🇮🇱','Израиль','Israel','‏יִשְׂרָאֵל','иврит'),
	(77,'IN','🇮🇳','Индия','India','भारत, हिंदुस्तान','хинди'),
	(78,'ID','🇮🇩','Индонезия','Indonesia','Indonesia','индонезийский'),
	(79,'JO','🇯🇴','Иордания','Jordan','الأردن','арабский'),
	(80,'IQ','🇮🇶','Ирак','Iraq','الْعِرَاق','арабский'),
	(81,'IR','🇮🇷','Иран','Iran','ایران','фарси'),
	(82,'IE','🇮🇪','Ирландия','Ireland','Éire','ирландский'),
	(83,'IS','🇮🇸','Исландия','Iceland','Ísland','исландский'),
	(84,'ES','🇪🇸','Испания','Spain','España','испанский'),
	(85,'IT','🇮🇹','Италия','Italy','Italia','итальянский'),
	(86,'YE','🇾🇪','Йемен','Yemen','ٱلْيَمَن','арабский'),
	(87,'CV','🇨🇻','Кабо-Верде','Cape Verde','Cabo Verde','португальский'),
	(88,'KZ','🇰🇿','Казахстан','Kazakhstan','Қазақстан','казахский'),
	(89,'KH','🇰🇭','Камбоджа','Cambodia','កម្ពុជា','кхмерский'),
	(90,'CM','🇨🇲','Камерун','Cameroon','Cameroun','французский'),
	(91,'CA','🇨🇦','Канада','Canada','Canada','английский'),
	(93,'QA','🇶🇦','Катар','Qatar','قطر','арабский'),
	(94,'KE','🇰🇪','Кения','Kenya','Kenya','английский'),
	(95,'CY','🇨🇾','Кипр','Cyprus','Κύπρος','греческий'),
	(96,'KG','🇰🇬','Киргизия','Kyrgyzstan','Кыргызстан','кыргызский'),
	(97,'KI','🇰🇮','Кирибати','Kiribati','Kiribati','английский'),
	(98,'TW','🇹🇼','Китай','Taiwan','中国','китайский'),
	(99,'CO','🇨🇴','Колумбия','Colombia','Colombia','испанский'),
	(100,'KM','🇰🇲','Коморы','Comoros','Komori','коморский'),
	(101,'CD','🇨🇩','Демократическая Республика Конго','Congo','République Démocratique du Congo','французский'),
	(102,'CG','🇨🇬','Республика Конго','Congo','Congo','французский'),
	(103,'KP','🇰🇵','КНДР','North Korea','조선 / 朝鮮; 북조선 / 北朝鮮','корейский'),
	(104,'KR','🇰🇷','Республика Корея','South Korea','한국 / 韓國; 남한, 南韓','корейский'),
	(106,'CR','🇨🇷','Коста-Рика','Costa Rica','Costa Rica','испанский'),
	(107,'CI','🇨🇮','Кот-д’Ивуар','Côte D’Ivoire','Côte d’Ivoire','французский'),
	(108,'CU','🇨🇺','Куба','Cuba','Cuba','испанский'),
	(109,'KW','🇰🇼','Кувейт','Kuwait','الكويت','арабский'),
	(110,'CW','🇨🇼','Кюрасао','Curaçao','Land Curaçao','нидерландский'),
	(111,'LA','🇱🇦','Лаос','Lao People’s Democratic Republic','ລາວ','лаосский'),
	(112,'LV','🇱🇻','Латвия','Latvia','Latvija','латышский'),
	(113,'LS','🇱🇸','Лесото','Lesotho','Lesotho','сесото'),
	(114,'LR','🇱🇷','Либерия','Liberia','Liberia','английский'),
	(115,'LB','🇱🇧','Ливан','Lebanon','لُبْنَان','арабский'),
	(116,'LY','🇱🇾','Ливия','Libya','ليبيا','арабский'),
	(117,'LT','🇱🇹','Литва','Lithuania','Lietuva','литовский'),
	(118,'LI','🇱🇮','Лихтенштейн','Liechtenstein','Liechtenstein','немецкий'),
	(120,'LU','🇱🇺','Люксембург','Luxembourg','Lëtzebuerg','люксембургский'),
	(121,'MU','🇲🇺','Маврикий','Mauritius','Mauritius','английский'),
	(122,'MR','🇲🇷','Мавритания','Mauritania','موريتانيا','арабский'),
	(123,'MG','🇲🇬','Мадагаскар','Madagascar','Madagasikara','малагасийский'),
	(125,'YT','🇾🇹','Майотта','Mayotte','Mayotte','французский'),
	(126,'MW','🇲🇼','Малави','Malawi','Malawi','английский'),
	(127,'MY','🇲🇾','Малайзия','Malaysia','Malaysia','малайский'),
	(128,'ML','🇲🇱','Мали','Mali','Mali','французский'),
	(129,'MV','🇲🇻','Мальдивы','Maldives','ހިވެދި ގުޖޭއްރާ','дивехи'),
	(130,'MT','🇲🇹','Мальта','Malta','Malta','мальтийский'),
	(131,'MA','🇲🇦','Марокко','Morocco','المغرب','арабский'),
	(132,'MQ','🇲🇶','Мартиника','Martinique','Martinique','французский'),
	(133,'MH','🇲🇭','Маршалловы Острова','Marshall Islands','Marshall Islands','английский'),
	(134,'MX','🇲🇽','Мексика','Mexico','México','испанский'),
	(135,'MZ','🇲🇿','Мозамбик','Mozambique','Moçambique','португальский'),
	(136,'MD','🇲🇩','Молдавия','Moldova','Moldova','молдавский'),
	(137,'MC','🇲🇨','Монако','Monaco','Monaco','французский'),
	(138,'MN','🇲🇳','Монголия','Mongolia','Монгол Улс','монгольский'),
	(139,'MS','🇲🇸','Монтсеррат','Montserrat','Montserrat','английский'),
	(140,'MM','🇲🇲','Мьянма','Myanmar','မြန်မာ','бирманский'),
	(141,'NA','🇳🇦','Намибия','Namibia','Namibia','английский'),
	(142,'NR','🇳🇷','Науру','Nauru','Naoero','науруанский'),
	(143,'NP','🇳🇵','Непал','Nepal','नेपाल','непальский'),
	(144,'NE','🇳🇪','Нигер','Niger','Niger','французский'),
	(145,'NG','🇳🇬','Нигерия','Nigeria','Nigeria','английский'),
	(146,'NL','🇳🇱','Нидерланды','Netherlands','Nederland','нидерландский'),
	(147,'NI','🇳🇮','Никарагуа','Nicaragua','Nicaragua','испанский'),
	(148,'NU','🇳🇺','Ниуэ','Niue','Niue','английский'),
	(149,'NZ','🇳🇿','Новая Зеландия','New Zealand','New Zealand','английский'),
	(150,'NC','🇳🇨','Новая Каледония','New Caledonia','Nouvelle-Calédonie','французский'),
	(151,'NO','🇳🇴','Норвегия','Norway','Norge','букмол'),
	(152,'AE','🇦🇪','ОАЭ','United Arab Emirates','الإمارات','арабский'),
	(153,'OM','🇴🇲','Оман','Oman','عُمان','арабский'),
	(154,'KY','🇰🇾','Острова Кайман','Cayman Islands','Cayman Islands','английский'),
	(155,'CK','🇨🇰','Острова Кука','Cook Islands','Cook Islands','английский'),
	(156,'PN','🇵🇳','Острова Питкэрн','Pitcairn','Pitcairn Islands','английский'),
	(158,'NF','🇳🇫','Остров Норфолк','Norfolk Island','Norfolk Island','английский'),
	(159,'CX','🇨🇽','Остров Рождества','Christmas Island','Christmas Island','английский'),
	(160,'PK','🇵🇰','Пакистан','Pakistan','پاکستان','урду'),
	(161,'PW','🇵🇼','Палау','Palau','Palau','английский'),
	(163,'PA','🇵🇦','Панама','Panama','Panamá','испанский'),
	(164,'PG','🇵🇬','Папуа — Новая Гвинея','Papua New Guinea','Papua New Guinea','английский'),
	(165,'PY','🇵🇾','Парагвай','Paraguay','Paraguay','испанский'),
	(166,'PE','🇵🇪','Перу','Peru','Perú','испанский'),
	(167,'PL','🇵🇱','Польша','Poland','Polska','польский'),
	(168,'PT','🇵🇹','Португалия','Portugal','Portugal','португальский'),
	(170,'PR','🇵🇷','Пуэрто-Рико','Puerto Rico','Puerto Rico','испанский'),
	(171,'RE','🇷🇪','Реюньон','Réunion','Réunion','французский'),
	(172,'RU','🇷🇺','Россия','Russia','Россия','русский'),
	(173,'RW','🇷🇼','Руанда','Rwanda','Rwanda','руанда'),
	(174,'RO','🇷🇴','Румыния','Romania','România','румынский'),
	(175,'SV','🇸🇻','Сальвадор','El Salvador','El Salvador','испанский'),
	(176,'WS','🇼🇸','Самоа','Samoa','Samoa','английский'),
	(177,'SM','🇸🇲','Сан-Марино','San Marino','San Marino','итальянский'),
	(178,'ST','🇸🇹','Сан-Томе и Принсипи','Sao Tome and Principe','São Tomé and Príncipe','португальский'),
	(179,'SA','🇸🇦','Саудовская Аравия','Saudi Arabia','ٱلسُّعُوْدِيَّة العربيّة','арабский'),
	(180,'MK','🇲🇰','Северная Македония','Macedonia','Северна Македонија','македонский'),
	(181,'MP','🇲🇵','Северные Марианские Острова','Northern Mariana Islands','Northern Mariana Islands','английский'),
	(183,'SC','🇸🇨','Сейшельские Острова','Seychelles','Sesel','сейшельский креольский'),
	(184,'SN','🇸🇳','Сенегал','Senegal','Sénégal','французский'),
	(185,'BL','🇧🇱','Сен-Бартелеми','Saint Barthélemy','Saint-Barthélemy','французский'),
	(186,'MF','🇲🇫','Сен-Мартен','Saint Martin (French Part)','Saint-Martin','французский'),
	(187,'PM','🇵🇲','Сен-Пьер и Микелон','Saint Pierre and Miquelon','Saint-Pierre et Miquelon','французский'),
	(188,'VC','🇻🇨','Сент-Винсент и Гренадины','Saint Vincent and The Grenadines','Saint Vincent and the Grenadines','английский'),
	(189,'KN','🇰🇳','Сент-Китс и Невис','Saint Kitts and Nevis','Saint Kitts and Nevis','английский'),
	(190,'LC','🇱🇨','Сент-Люсия','Saint Lucia','Saint Lucia','английский'),
	(191,'RS','🇷🇸','Сербия','Serbia','Србија','сербский'),
	(192,'SG','🇸🇬','Сингапур','Singapore','Singapura','малайский'),
	(193,'SX','🇸🇽','Синт-Мартен','Sint Maarten (Dutch Part)','Sint Maarten','нидерландский'),
	(194,'SY','🇸🇾','Сирия','Syrian Arab Republic','سُورِيَة','арабский'),
	(195,'SK','🇸🇰','Словакия','Slovakia','Slovensko','словацкий'),
	(196,'SI','🇸🇮','Словения','Slovenia','Slovenija','словенский'),
	(197,'US','🇺🇸','США','United States','United States of America','английский'),
	(198,'SB','🇸🇧','Соломоновы Острова','Solomon Islands','Solomon Islands','английский'),
	(199,'SO','🇸🇴','Сомали','Somalia','Soomaaliya','сомалийский'),
	(201,'SD','🇸🇩','Судан','Sudan','السودان','арабский'),
	(202,'SR','🇸🇷','Суринам','Suriname','Suriname','нидерландский'),
	(203,'SL','🇸🇱','Сьерра-Леоне','Sierra Leone','Sierra Leone','английский'),
	(204,'TJ','🇹🇯','Таджикистан','Tajikistan','Тоҷикистон','таджикский'),
	(205,'TH','🇹🇭','Таиланд','Thailand','เมืองไทย; ประเทศไทย; ราชอาณาจักรไทย','тайский'),
	(207,'TZ','🇹🇿','Танзания','Tanzania','Tanzania','английский'),
	(208,'TC','🇹🇨','Теркс и Кайкос','Turks and Caicos Islands','Turks and Caicos Islands','английский'),
	(209,'TG','🇹🇬','Того','Togo','Togo','французский'),
	(210,'TK','🇹🇰','Токелау','Tokelau','Tokelau','английский'),
	(211,'TO','🇹🇴','Тонга','Tonga','Tonga','тонга'),
	(212,'TT','🇹🇹','Тринидад и Тобаго','Trinidad and Tobago','Trinidad and Tobago','английский'),
	(213,'TV','🇹🇻','Тувалу','Tuvalu','Tuvalu','английский'),
	(214,'TN','🇹🇳','Тунис','Tunisia','تونس ','арабский'),
	(215,'TM','🇹🇲','Туркмения','Turkmenistan','Türkmenistan','туркменский'),
	(216,'TR','🇹🇷','Турция','Turkey','Türkiye','турецкий'),
	(217,'UG','🇺🇬','Уганда','Uganda','Uganda','английский'),
	(218,'UZ','🇺🇿','Узбекистан','Uzbekistan','Oʻzbekiston','узбекский'),
	(219,'UA','🇺🇦','Украина','Ukraine','Україна','украинский'),
	(220,'WF','🇼🇫','Уоллис и Футуна','Wallis and Futuna','Wallis-et-Futuna','французский'),
	(221,'UY','🇺🇾','Уругвай','Uruguay','Uruguay','испанский'),
	(223,'FM','🇫🇲','Микронезия','Micronesia','Micronesia','английский'),
	(224,'FJ','🇫🇯','Фиджи','Fiji','Fiji','английский'),
	(225,'PH','🇵🇭','Филиппины','Philippines','Pilipinas','филиппинский'),
	(226,'FI','🇫🇮','Финляндия','Finland','Suomi','финский'),
	(227,'FK','🇫🇰','Фолклендские острова','Falkland Islands (Malvinas)','Falkland Islands','английский'),
	(228,'FR','🇫🇷','Франция','France','France','французский'),
	(229,'GF','🇬🇫','Гвиана','French Guiana','Guyane Française','французский'),
	(230,'PF','🇵🇫','Французская Полинезия','French Polynesia','Polynésie française','французский'),
	(232,'HR','🇭🇷','Хорватия','Croatia','Hrvatska','хорватский'),
	(233,'CF','🇨🇫','ЦАР','Central African Republic','République Centrafricaine','французский'),
	(234,'TD','🇹🇩','Чад','Chad','Tchad','французский'),
	(235,'ME','🇲🇪','Черногория','Montenegro','Црна Гора / Crna Gora','черногорский'),
	(236,'CZ','🇨🇿','Чехия','Czech Republic','Česko','чешский'),
	(237,'CL','🇨🇱','Чили','Chile','Chile','испанский'),
	(238,'CH','🇨🇭','Швейцария','Switzerland','Schweiz','немецкий'),
	(239,'SE','🇸🇪','Швеция','Sweden','Sverige','шведский'),
	(240,'SJ','🇸🇯','Шпицберген','Svalbard and Jan Mayen','Svalbard','норвежский'),
	(241,'LK','🇱🇰','Шри-Ланка','Sri Lanka','ශ්‍රී ලංකාව','сингальский'),
	(242,'EC','🇪🇨','Эквадор','Ecuador','Ecuador','испанский'),
	(243,'GQ','🇬🇶','Экваториальная Гвинея','Equatorial Guinea','Guinea Ecuatorial','испанский'),
	(244,'ER','🇪🇷','Эритрея','Eritrea','إرتريا','арабский'),
	(245,'SZ','🇸🇿','Эсватини','Swaziland','Eswatini','английский'),
	(246,'EE','🇪🇪','Эстония','Estonia','Eesti','эстонский'),
	(247,'ET','🇪🇹','Эфиопия','Ethiopia','ኢትዮጵያ','амхарский'),
	(249,'ZA','🇿🇦','ЮАР','South Africa','South Africa','английский'),
	(250,'SS','🇸🇸','Южный Судан','South Sudan','South Sudan','английский'),
	(251,'JM','🇯🇲','Ямайка','Jamaica','Jamaica','английский'),
	(252,'JP','🇯🇵','Япония','Japan','日本','японский');

/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы genre
# ------------------------------------------------------------

DROP TABLE IF EXISTS `genre`;

CREATE TABLE `genre` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Жанры кино';

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;

INSERT INTO `genre` (`id`, `name`)
VALUES
	(1,'аниме'),
	(2,'биографический'),
	(3,'боевик'),
	(4,'вестерн'),
	(5,'военный'),
	(6,'детектив'),
	(7,'детский'),
	(8,'документальный'),
	(9,'драма'),
	(10,'исторический'),
	(11,'кинокомикс'),
	(12,'комедия'),
	(13,'концерт'),
	(14,'короткометражный'),
	(15,'криминал'),
	(16,'мелодрама'),
	(17,'мистика'),
	(18,'музыка'),
	(19,'мультфильм'),
	(20,'мюзикл'),
	(21,'научный'),
	(22,'нуар'),
	(23,'приключения'),
	(24,'реалити-шоу'),
	(25,'семейный'),
	(26,'спорт'),
	(27,'ток-шоу'),
	(28,'триллер'),
	(29,'ужасы'),
	(30,'фантастика'),
	(31,'фэнтези'),
	(32,'эротика');

/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы premieres
# ------------------------------------------------------------

DROP TABLE IF EXISTS `premieres`;

CREATE TABLE `premieres` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL COMMENT 'название премьеры',
  `poster` char(50) DEFAULT NULL COMMENT 'изображения постера',
  `year_release` char(4) DEFAULT NULL COMMENT 'выход в прокат (год)',
  `country_id` char(20) DEFAULT NULL COMMENT 'id таблицы country стран',
  `genre_id` char(20) DEFAULT NULL COMMENT 'id таблицы genre жанр',
  `actors` varchar(500) DEFAULT NULL COMMENT 'актеры',
  `age_restrictions` tinyint(2) DEFAULT NULL COMMENT 'возрастные ограничения',
  `director` char(255) DEFAULT NULL COMMENT 'режиссёр',
  `description` varchar(5000) DEFAULT NULL COMMENT 'описание',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Премьеры';

LOCK TABLES `premieres` WRITE;
/*!40000 ALTER TABLE `premieres` DISABLE KEYS */;

INSERT INTO `premieres` (`id`, `title`, `poster`, `year_release`, `country_id`, `genre_id`, `actors`, `age_restrictions`, `director`, `description`)
VALUES
	(7,'Крушение','1675019103.jpg','2023','40,197','3,28','Джерард Батлер, Даниэлла Пинеда, Майк Колтер, Тони Голдуин, Лилли Круг, Ивэн Дэйн Тейлор, Келли Гейл, Тара Вествуд, Реми Аделеке, Пол Бен-Виктор',16,'Жан-Франсуа Рише','Пилоту Броуди Торрансу удаётся успешно посадить повреждённый штормом самолёт на враждебной территории. Вскоре выясняется, что уцелевшим угрожают воинствующие пираты, которые хотят захватить самолёт и его пассажиров в заложники. Пока идут поиски пропавшего самолёта, Броуди должен защитить своих пассажиров, пока не прибудет помощь.'),
	(8,'Затерянный город','1675019825.jpeg','2022','197','3,12,16,23','Сандра Буллок, Ченнинг Татум, Дэниэл Рэдклифф, Да&#039;Вин Джой Рэндольф, Оскар Нуньес, Патти Харрисон, Брэд Питт, Рэймонд Ли, Томас Форбс-Джонсон, Эктор Анибал',12,'Аарон Ни, Адам Ни','Блистательная затворница Лоретта Сейдж пишет популярные любовно-приключенческие романы. События в них непременно разворачиваются в экзотических местах, а главный герой - красавчик и мечта героинь Дэш, которого в жизни воплощает модель с обложки Алан. Во время турне-презентации нового бестселлера Лоретту похищает эксцентричный миллиардер, уверенный, что она сможет привести его к сокровищам древнего затерянного города из ее последней книги. Алан решает доказать, что может быть героем в реальной жизни, а не только на страницах книг, и отправляется Лоретте на выручку. Так странная парочка ввязывается в эпичное приключение в самом сердце джунглей и должна действовать сообща, если хочет пережить дикие испытания и найти сокровище, пока оно не затерялось навсегда.'),
	(9,'Мстители: Финал','1675020145.jpeg','2019','197','3,9,23,30','Роберт Дауни мл., Крис Эванс, Марк Руффало, Крис Хемсворт, Скарлетт Йоханссон, Джереми Реннер, Дон Чидл, Пол Радд, Бри Ларсон, Карен Гиллан',16,'Энтони Руссо, Джо Руссо','После сокрушительного удара Разрушителя ряды Мстителей поредели. Соколиный Глаз, потеряв любимую семью, исчез в неизвестном направлении. На краю Галактики в безнадежно испорченном звездолете Старк готовился к смерти, когда его неожиданно спасла Капитан Марвел. Пережитое привело к депрессии. Тони отказался от дальнейшей борьбы и в сопровождении возлюбленной Пеппер Потс отправился на лечение. Оставшиеся супергерои решили пойти до конца. Но прибыв на Титан II, поняли, что опоздали. Танос уничтожил Камни Бесконечности, расщепив их на атомы. В порыве гнева Тор убил обессиленного врага. Возможность одержать реванш и исправить содеянное им зло появилась лишь спустя долгих 5 лет. Из микромира вернулся Человек-паук и поведал друзьям об удивительном свойстве квантового пространства: его можно использовать для перемещения во времени. Для осуществления задуманного плана предотвращения случившегося на Земле апокалипсиса необходимо было собрать прежнюю команду и создать специальное устройство. Несмотря на отказ сотрудничать, Железный человек все же разработал хрононавигатор. Но дефицит частиц Пим давал героям шанс только на один скачок в прошлое.'),
	(10,'Дом Gucci','1675020870.jpeg','2021','91,197','9,15,28','Леди Гага, Адам Драйвер, Джаред Лето, Джереми Айронс, Джек Хьюстон, Сальма Хайек, Аль Пачино, Мадалина Генея, Камилль Коттен, Рив Карни',16,'Ридли Скотт','Фамилия Гуччи звучала так сладко, так соблазнительно. Синоним роскоши, стиля, власти. Но она же была их проклятьем. Шокирующая история любви, предательства, падения и мести, которая привела к жестокому убийству в одной из самых знаменитых модных империй мира.'),
	(11,'Монстры на каникулах: Трансформания','1675021016.jpeg','2022','197','19','Брайан Халл, Энди Сэмберг, Селена Гомес, Кэтрин Хан, Стив Бушеми, Дэвид Спейд, Кигэн-Майкл Ки, Эшер Блинкофф, Брэд Эбрелл, Фрэн Дрешер',6,'Дерек Драймон, Дженнифер Клуска','Все смешалось в отеле «Трансильвания»: таинственное изобретение Ван Хельсинга, «монстрифицирующий луч», ломается и случайно превращает Дракулу и его приятелей в людей, а Джонни - наоборот, в монстра. Лишенные своих способностей и привычного облика Драк с друзьями и Джонни, с неожиданным удовольствием раскрывающий свою монстрическую сущность, отправляются в кругосветное путешествие на поиски средства от трансформании. И, конечно, им не обойтись без помощи Мэвис, пока не стало слишком поздно и они не свели друг друга с ума.'),
	(12,'Как отделаться от парня за 10 дней','1675850372.jpg','2003','56,197','12,16','Кейт Хадсон, Мэттью МакКонахи, Кэтрин Хан, Энни Пэррис, Адам Голдберг, Томас Леннон, Майкл Мишель, Шалом Харлоу',12,'Роберт Эванс, Линда Обст, Кристин Форсит-Питерс','Журналистка Энди Андерсон решает написать статью на тему: «Типичные ошибки, которыми женщины отталкивают от себя мужчин». Она планирует найти парня, завязать знакомство, а потом своим поведением добиться, чтобы тот её бросил. Редактор даёт ей на это 10 дней. На беду Энди ее выбор пал на молодого рекламного агента Бенджамина Бэрри, который сам как раз заключил со своим боссом пари, что он сможет влюбить в себя девушку за 10 дней. Может ли такое странное знакомство, основанное на авантюре и замешанное на лжи, привести к взаимности?');

/*!40000 ALTER TABLE `premieres` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы theatres
# ------------------------------------------------------------

DROP TABLE IF EXISTS `theatres`;

CREATE TABLE `theatres` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) DEFAULT NULL COMMENT 'имя кинотеатра',
  `city` char(20) DEFAULT NULL COMMENT 'город',
  `address` char(50) DEFAULT NULL COMMENT 'адрес',
  `phone` char(11) DEFAULT NULL COMMENT 'телефон',
  `halls_name` char(100) DEFAULT NULL COMMENT 'название залов',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Кинотеатры';

LOCK TABLES `theatres` WRITE;
/*!40000 ALTER TABLE `theatres` DISABLE KEYS */;

INSERT INTO `theatres` (`id`, `name`, `city`, `address`, `phone`, `halls_name`)
VALUES
	(3,'Золотое кольцо Донецк','Донецк','пл. Коммунаров, 2','79493815151',NULL),
	(4,'имени Артёма','Торез','ул. Ильича, 6а','79493655875','Лазурный, Рубежный');

/*!40000 ALTER TABLE `theatres` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы theatres_date_show
# ------------------------------------------------------------

DROP TABLE IF EXISTS `theatres_date_show`;

CREATE TABLE `theatres_date_show` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `afisha_id` int(11) DEFAULT NULL COMMENT 'id таблица афиша',
  `theatres_id` int(11) DEFAULT NULL COMMENT 'id таблица кинотеатры',
  `date_show` date DEFAULT NULL COMMENT 'дата показа',
  `time_show` char(255) DEFAULT NULL COMMENT 'время показа',
  `min_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'минимальная цена билета',
  `halls` char(20) DEFAULT NULL COMMENT 'имя зала',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Дамп таблицы users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) DEFAULT NULL COMMENT 'имя',
  `surname` char(30) DEFAULT NULL COMMENT 'фамилия',
  `password` char(64) DEFAULT NULL COMMENT 'пароль',
  `email` char(50) DEFAULT NULL COMMENT 'электронная почта',
  `avatar` char(32) DEFAULT 'default.jpg' COMMENT 'аватар',
  `phone` char(11) DEFAULT NULL COMMENT 'телефон',
  `ip` char(15) DEFAULT NULL COMMENT 'сетевой адрес',
  `theatres_id` int(11) NOT NULL DEFAULT '0' COMMENT 'id кинотеатра',
  `dateReg` date DEFAULT NULL COMMENT 'дата регистрации',
  `isBlock` tinyint(11) NOT NULL DEFAULT '0' COMMENT 'блокировка',
  `access` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'доступ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `surname`, `password`, `email`, `avatar`, `phone`, `ip`, `theatres_id`, `dateReg`, `isBlock`, `access`)
VALUES
	(1,'Виталий','Простынкин','9447662b0e9664c65a84a726a0e0efdb47f7fea8f60d38d8b552f181ec36d562','artquant@yandex.ru','default.jpg','79493655875','::1',4,'2023-03-14',0,9),
	(4,'Дмитрий','Будёнов','7e65967ba452048f763d29bec96e6dc954f613f45f8d80c4a3d93b2b6b4790cb','zacar@mail.ru','default.jpg','79493115577',NULL,4,'2023-04-06',0,2),
	(5,'Александр','Топорулов','7e65967ba452048f763d29bec96e6dc954f613f45f8d80c4a3d93b2b6b4790cb','test2@mail.ru','default.jpg','79493610300',NULL,3,'2023-03-06',0,2);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
