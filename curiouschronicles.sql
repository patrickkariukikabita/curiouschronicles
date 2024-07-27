-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 149.56.96.102:3306
-- Generation Time: Feb 16, 2024 at 12:24 AM
-- Server version: 8.0.36
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sociolme_curiouschronicles`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `category_randid` varchar(50) NOT NULL,
  `publishstatus` enum('true','false') DEFAULT 'true',
  `article_randid` varchar(30) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_cover` varchar(100) NOT NULL,
  `modified_date` timestamp NULL DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `title`, `content`, `category_randid`, `publishstatus`, `article_randid`, `date`, `article_cover`, `modified_date`, `slug`) VALUES
(3, 'The World\'s Most Poisonous Plants.', '<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">*Imagine strolling through a lush forest or a vibrant garden, admiring the beauty of nature. The vibrant colors, the fragrant scents, the gentle rustling of leaves &ndash; it\'s a serene experience. But hidden among the greenery are plants that hold deadly secrets. While they may look inviting or even innocuous, a single touch or taste could lead to dire consequences. Nature, in all its splendor, also has its dark side. In this article, we\'ll unveil some of the world\'s most poisonous plants &ndash; botanical wonders that are as dangerous as they are beautiful. Read on, but remember: looks can be deceiving.*</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\"><strong>1. Oleander (Nerium oleander)</strong></p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">The Oleander, with its delicate pink and white blossoms, paints a picture of innocence. However, lurking beneath this facade of beauty are potent chemical compounds, namely <strong>Oleandrin</strong> and <strong>Neriin</strong>. These compounds are found throughout the plant, but it\'s the leaves that pack the most potent punch.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">In many parts of the world, Oleander decorates gardens and roadsides, its vibrant flowers catching the eye of many a passerby. But caution is advised. Even a single leaf, if ingested, can spell doom. The plant\'s toxins can lead to nausea, vomiting, abdominal pain, and in severe cases, fatal heart complications.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">There\'s a chilling tale of a group of campers who, unknowingly, used Oleander branches to skewer their marshmallows. The evening that should have been filled with joy and laughter turned tragic as they fell ill, a stark reminder of the plant\'s deadly nature. Interestingly, in ancient times, Oleander was a symbol of love and romance. However, given its lethal nature, it\'s ironic that something so beautiful could harbor such danger. Always remember: Not everything that glitters is gold, and not every flower in the garden is your friend.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>2. Rosary Pea (Abrus precatorius)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">The Rosary Pea, with its striking red seeds adorned with a single black spot, is more than just a pretty face. Each seed contains a highly potent toxin called <strong>Abrin</strong>. When ingested, even in minuscule amounts, abrin can inhibit protein synthesis within cells, leading to cell death.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Originating from tropical areas, the Rosary Pea has been used for making rosary beads, hence its name. But the beauty of these beads comes with a deadly price. Once ingested, the toxin can cause severe nausea, vomiting, abdominal pain, and can lead to organ failure and death within just a few days. The danger isn\'t just limited to ingestion; there have been instances where bead makers accidentally pricked their fingers while working with these seeds, leading to severe poisoning.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Historically, the seeds\' vibrant colors made them a popular choice for ornamental purposes. Yet, their captivating appearance masks a lethal nature. It\'s a stark reminder that nature\'s most beautiful creations can sometimes be its most dangerous.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>3. Death Cap Mushroom (Amanita phalloides)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">The Death Cap Mushroom, with its pale, unassuming appearance, is a silent killer that lurks in forests and woodlands. Its primary toxin, <strong>&alpha;-amanitin</strong>, wreaks havoc on the liver and kidneys. When consumed, this toxin directly interferes with the RNA polymerase in liver cells, preventing them from performing their essential functions.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Foragers, especially those inexperienced in mushroom identification, might mistake the Death Cap for an edible variety. Within 6 to 12 hours of consumption, symptoms such as severe abdominal pain, vomiting, and diarrhea manifest. As the toxin progresses, it can lead to liver and kidney failure, often proving fatal if not treated promptly.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">There\'s a saying among mushroom foragers: \"There are old mushroom hunters, and there are bold mushroom hunters, but there are no old, bold mushroom hunters.\" The Death Cap stands as a testament to this adage, reminding us of the importance of knowledge and caution when venturing into the wild.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>4. Hemlock (Conium maculatum)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Hemlock, with its tall, green stalks and white flower clusters, might seem like just another harmless plant in the meadow. However, it\'s anything but. This plant contains a potent neurotoxin called <strong>coniine</strong>. When introduced to the human body, coniine disrupts the central nervous system, leading to muscle paralysis and eventually respiratory failure.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Historically, Hemlock gained notoriety in ancient Greece. It\'s believed to be the poison that was used to execute the philosopher Socrates. After consuming a potion made from Hemlock, he experienced a gradual paralysis, starting from his feet and moving upwards, until it reached his heart.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Today, cases of Hemlock poisoning are often accidental. Its resemblance to other edible plants like parsley or wild carrot can lead to tragic mix-ups. The initial symptoms might seem mild, with nausea and dizziness, but as the toxin takes hold, the victim can experience severe convulsions and respiratory distress.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">It\'s a chilling reminder that nature, while bountiful and nurturing, also holds elements of danger. Hemlock stands as a symbol of the thin line between life and death that exists in the wild.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>5. Belladonna (Atropa belladonna)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Belladonna, also known as \"Deadly Nightshade,\" is a plant of contradictions. Its name means \"beautiful lady\" in Italian, a nod to its historical use as a cosmetic to dilate women\'s pupils, a look that was once considered attractive. However, the beauty of Belladonna is deceptive. It contains powerful compounds like <strong>atropine</strong>, <strong>scopolamine</strong>, and <strong>hyoscyamine</strong>.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">When ingested, these compounds can cause a range of symptoms. Atropine, for instance, can lead to dry mouth, blurred vision, hallucinations, seizures, and even death. The berries of the Belladonna plant, which look enticingly juicy and sweet, are especially dangerous. Just a handful can be lethal to an adult, and even fewer can be fatal for a child.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">There\'s a harrowing account of a family who, during a picnic, mistook Belladonna berries for blueberries. The family was soon plagued with hallucinations, rapid heartbeats, and loss of voice. Thankfully, they received medical attention in time, but the incident serves as a stark reminder of the plant\'s treacherous nature.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Belladonna\'s allure and danger coexist, teaching us that in nature, beauty and peril often walk hand in hand.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>6. White Snakeroot (Ageratina altissima)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">White Snakeroot, with its fluffy white flowers, seems like a gentle addition to any woodland. However, lurking within is a toxin named <strong>tremetol</strong>. When consumed, either directly by eating the plant or indirectly by consuming the milk or meat of an animal that has eaten the plant, tremetol can lead to a condition called \"milk sickness.\"</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">In the early 19th century, many settlers in the American Midwest fell ill after consuming milk from cows that had grazed on White Snakeroot. The symptoms included severe intestinal discomfort, tremors, and even death. Notably, it\'s believed that Abraham Lincoln\'s mother died from milk sickness caused by White Snakeroot.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Today, with better knowledge of the plant and its effects, such incidents are rare. But the legacy of White Snakeroot serves as a cautionary tale about the hidden dangers that can reside in even the most unassuming of plants.</p>\r\n<hr size=\"1\">\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>7. Foxglove (Digitalis purpurea)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Foxglove, with its tall spike of purple-pink bell-shaped flowers, is a sight to behold in gardens and wild meadows. But within this plant lies a compound called <strong>digitoxin</strong>. When ingested, digitoxin affects the heart\'s ability to pump blood, leading to symptoms like nausea, dizziness, irregular heart rhythms, and in severe cases, death.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Interestingly, while Foxglove can be a killer, it\'s also a lifesaver. The same compounds that can be toxic in large doses are used in small, controlled amounts to make medicines for heart conditions. It\'s a prime example of the duality of nature, where the line between poison and remedy can be incredibly thin.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Historically, there have been cases of people mistaking Foxglove for other harmless plants, leading to accidental poisonings. It\'s a reminder that while nature offers us many gifts, it also demands our respect and caution.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>Nature\'s Double-Edged Sword</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">As we\'ve journeyed through the world of these perilous plants, it\'s evident that nature is a realm of contrasts. It offers beauty that captivates our senses, yet hidden within are dangers that can swiftly take away the very breath of life. These plants serve as a poignant reminder that nature is not just a passive backdrop to our lives, but a dynamic force, teeming with mysteries and lessons. It teaches us respect, caution, and the value of knowledge. So, the next time you\'re out exploring the great outdoors, remember to tread with care, for in the dance of nature, every step matters.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>', '16983357001203967478', 'false', 'WbNZGcqzBMUBXledMWoG', '2023-10-27 10:21:37', '../articles_cover/WbNZGcqzBMUBXledMWoG.jpeg', NULL, '3-the-world-s-most-poisonous-plants'),
(4, 'Nature\'s Double-edged Sword.', '<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">**The World\'s Most Poisonous Plants**</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">*Imagine strolling through a lush forest or a vibrant garden, admiring the beauty of nature. The vibrant colors, the fragrant scents, the gentle rustling of leaves &ndash; it\'s a serene experience. But hidden among the greenery are plants that hold deadly secrets. While they may look inviting or even innocuous, a single touch or taste could lead to dire consequences. Nature, in all its splendor, also has its dark side. In this article, we\'ll unveil some of the world\'s most poisonous plants &ndash; botanical wonders that are as dangerous as they are beautiful. Read on, but remember: looks can be deceiving.*</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\"><strong>1. Oleander (Nerium oleander)</strong></p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">The Oleander, with its delicate pink and white blossoms, paints a picture of innocence. However, lurking beneath this facade of beauty are potent chemical compounds, namely <strong>Oleandrin</strong> and <strong>Neriin</strong>. These compounds are found throughout the plant, but it\'s the leaves that pack the most potent punch.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">In many parts of the world, Oleander decorates gardens and roadsides, its vibrant flowers catching the eye of many a passerby. But caution is advised. Even a single leaf, if ingested, can spell doom. The plant\'s toxins can lead to nausea, vomiting, abdominal pain, and in severe cases, fatal heart complications.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">There\'s a chilling tale of a group of campers who, unknowingly, used Oleander branches to skewer their marshmallows. The evening that should have been filled with joy and laughter turned tragic as they fell ill, a stark reminder of the plant\'s deadly nature. Interestingly, in ancient times, Oleander was a symbol of love and romance. However, given its lethal nature, it\'s ironic that something so beautiful could harbor such danger. Always remember: Not everything that glitters is gold, and not every flower in the garden is your friend.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>2. Rosary Pea (Abrus precatorius)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">The Rosary Pea, with its striking red seeds adorned with a single black spot, is more than just a pretty face. Each seed contains a highly potent toxin called <strong>Abrin</strong>. When ingested, even in minuscule amounts, abrin can inhibit protein synthesis within cells, leading to cell death.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Originating from tropical areas, the Rosary Pea has been used for making rosary beads, hence its name. But the beauty of these beads comes with a deadly price. Once ingested, the toxin can cause severe nausea, vomiting, abdominal pain, and can lead to organ failure and death within just a few days. The danger isn\'t just limited to ingestion; there have been instances where bead makers accidentally pricked their fingers while working with these seeds, leading to severe poisoning.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Historically, the seeds\' vibrant colors made them a popular choice for ornamental purposes. Yet, their captivating appearance masks a lethal nature. It\'s a stark reminder that nature\'s most beautiful creations can sometimes be its most dangerous.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>3. Death Cap Mushroom (Amanita phalloides)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">The Death Cap Mushroom, with its pale, unassuming appearance, is a silent killer that lurks in forests and woodlands. Its primary toxin, <strong>&alpha;-amanitin</strong>, wreaks havoc on the liver and kidneys. When consumed, this toxin directly interferes with the RNA polymerase in liver cells, preventing them from performing their essential functions.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Foragers, especially those inexperienced in mushroom identification, might mistake the Death Cap for an edible variety. Within 6 to 12 hours of consumption, symptoms such as severe abdominal pain, vomiting, and diarrhea manifest. As the toxin progresses, it can lead to liver and kidney failure, often proving fatal if not treated promptly.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">There\'s a saying among mushroom foragers: \"There are old mushroom hunters, and there are bold mushroom hunters, but there are no old, bold mushroom hunters.\" The Death Cap stands as a testament to this adage, reminding us of the importance of knowledge and caution when venturing into the wild.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>4. Hemlock (Conium maculatum)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Hemlock, with its tall, green stalks and white flower clusters, might seem like just another harmless plant in the meadow. However, it\'s anything but. This plant contains a potent neurotoxin called <strong>coniine</strong>. When introduced to the human body, coniine disrupts the central nervous system, leading to muscle paralysis and eventually respiratory failure.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Historically, Hemlock gained notoriety in ancient Greece. It\'s believed to be the poison that was used to execute the philosopher Socrates. After consuming a potion made from Hemlock, he experienced a gradual paralysis, starting from his feet and moving upwards, until it reached his heart.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Today, cases of Hemlock poisoning are often accidental. Its resemblance to other edible plants like parsley or wild carrot can lead to tragic mix-ups. The initial symptoms might seem mild, with nausea and dizziness, but as the toxin takes hold, the victim can experience severe convulsions and respiratory distress.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">It\'s a chilling reminder that nature, while bountiful and nurturing, also holds elements of danger. Hemlock stands as a symbol of the thin line between life and death that exists in the wild.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>5. Belladonna (Atropa belladonna)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Belladonna, also known as \"Deadly Nightshade,\" is a plant of contradictions. Its name means \"beautiful lady\" in Italian, a nod to its historical use as a cosmetic to dilate women\'s pupils, a look that was once considered attractive. However, the beauty of Belladonna is deceptive. It contains powerful compounds like <strong>atropine</strong>, <strong>scopolamine</strong>, and <strong>hyoscyamine</strong>.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">When ingested, these compounds can cause a range of symptoms. Atropine, for instance, can lead to dry mouth, blurred vision, hallucinations, seizures, and even death. The berries of the Belladonna plant, which look enticingly juicy and sweet, are especially dangerous. Just a handful can be lethal to an adult, and even fewer can be fatal for a child.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">There\'s a harrowing account of a family who, during a picnic, mistook Belladonna berries for blueberries. The family was soon plagued with hallucinations, rapid heartbeats, and loss of voice. Thankfully, they received medical attention in time, but the incident serves as a stark reminder of the plant\'s treacherous nature.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Belladonna\'s allure and danger coexist, teaching us that in nature, beauty and peril often walk hand in hand.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>6. White Snakeroot (Ageratina altissima)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">White Snakeroot, with its fluffy white flowers, seems like a gentle addition to any woodland. However, lurking within is a toxin named <strong>tremetol</strong>. When consumed, either directly by eating the plant or indirectly by consuming the milk or meat of an animal that has eaten the plant, tremetol can lead to a condition called \"milk sickness.\"</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">In the early 19th century, many settlers in the American Midwest fell ill after consuming milk from cows that had grazed on White Snakeroot. The symptoms included severe intestinal discomfort, tremors, and even death. Notably, it\'s believed that Abraham Lincoln\'s mother died from milk sickness caused by White Snakeroot.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Today, with better knowledge of the plant and its effects, such incidents are rare. But the legacy of White Snakeroot serves as a cautionary tale about the hidden dangers that can reside in even the most unassuming of plants.</p>\r\n<hr size=\"1\">\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>7. Foxglove (Digitalis purpurea)</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Foxglove, with its tall spike of purple-pink bell-shaped flowers, is a sight to behold in gardens and wild meadows. But within this plant lies a compound called <strong>digitoxin</strong>. When ingested, digitoxin affects the heart\'s ability to pump blood, leading to symptoms like nausea, dizziness, irregular heart rhythms, and in severe cases, death.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Interestingly, while Foxglove can be a killer, it\'s also a lifesaver. The same compounds that can be toxic in large doses are used in small, controlled amounts to make medicines for heart conditions. It\'s a prime example of the duality of nature, where the line between poison and remedy can be incredibly thin.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">Historically, there have been cases of people mistaking Foxglove for other harmless plants, leading to accidental poisonings. It\'s a reminder that while nature offers us many gifts, it also demands our respect and caution.</p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\"><strong>Nature\'s Double-Edged Sword</strong></p>\r\n<p class=\"western\" style=\"line-height: 115%;\" align=\"left\">As we\'ve journeyed through the world of these perilous plants, it\'s evident that nature is a realm of contrasts. It offers beauty that captivates our senses, yet hidden within are dangers that can swiftly take away the very breath of life. These plants serve as a poignant reminder that nature is not just a passive backdrop to our lives, but a dynamic force, teeming with mysteries and lessons. It teaches us respect, caution, and the value of knowledge. So, the next time you\'re out exploring the great outdoors, remember to tread with care, for in the dance of nature, every step matters.</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" style=\"line-height: 100%; margin-bottom: 0in;\" align=\"left\">&nbsp;</p>', '16983357001203967478', 'false', 'QDKcgMEASSNnxnu8f1fU', '2023-10-27 20:24:09', '../articles_cover/QDKcgMEASSNnxnu8f1fU.jpeg', NULL, '4-nature-s-double-edged-sword');
INSERT INTO `articles` (`article_id`, `title`, `content`, `category_randid`, `publishstatus`, `article_randid`, `date`, `article_cover`, `modified_date`, `slug`) VALUES
(6, 'Embracing The Opportunities In The AI Era.', '<p style=\"line-height: 150%;\">In an age where technology is not just an enabler but a catalyst of change, the surge of Artificial Intelligence (AI) stands out as a transformative force reshaping our world. AI, once a realm of science fiction, has swiftly become a tangible and influential part of our daily lives. This rapid evolution presents an unprecedented opportunity for entrepreneurs, technologists, and businesses to tap into a market that\'s not only burgeoning but also redefining the very essence of how we work, live, and interact.</p>\r\n<p style=\"line-height: 150%;\">The AI revolution transcends traditional boundaries, offering a plethora of avenues for innovation and profit. From self-driving cars and intelligent virtual assistants to sophisticated data analysis tools and automated customer service, AI is carving a niche in virtually every industry. This ubiquity of AI opens up a vast landscape for those looking to monetize these technological advancements. Whether you are a seasoned developer, a budding entrepreneur, or a visionary investor, the potential to earn from AI is immense and varied.</p>\r\n<p style=\"line-height: 150%;\">However, diving into the AI domain requires more than just understanding the technology; it demands an insight into market needs, consumer behavior, and the foresight to anticipate where the world of AI is heading. The key lies in identifying unique problems that AI can solve or areas where it can add significant value. This could range from developing bespoke AI solutions tailored to specific industry needs, to offering consultancy for businesses looking to integrate AI into their operations, or even creating informative content that demystifies AI for the general public.</p>\r\n<p style=\"line-height: 150%;\">As we embark on this journey through the blog, we will uncover various strategies and avenues through which you can capitalize on the AI boom. We will explore the intricacies of developing and selling AI solutions, the nuances of providing consulting services, the art of content creation focused on AI, and the savvy world of investing in AI startups. Each of these paths offers a unique way to not just participate in but also profit from the AI era, paving the way for financial success in a rapidly evolving digital landscape.</p>\r\n<h1 class=\"western\" style=\"line-height: 150%;\">&nbsp;</h1>\r\n<h1 class=\"western\" style=\"line-height: 150%;\">Developing and Selling AI Solutions.</h1>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Identifying Niche Markets.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">The journey into AI entrepreneurship begins with identifying niche markets where AI can have a significant impact. Emerging markets for AI are often hidden in plain sight, nestled within common challenges or inefficiencies across various industries. To spot these opportunities, one must stay informed about the latest AI trends and advancements, and more importantly, understand the unique problems faced by different sectors. Networking with industry professionals, attending tech conferences, and conducting market research can provide valuable insights into potential niches. For instance, healthcare, finance, and customer service are currently ripe for AI-driven innovations. The key is to identify areas where AI can solve problems more effectively than traditional methods.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">A great example of identifying a niche market for AI applications is in the field of precision agriculture. This sector has increasingly turned to AI to optimize farming practices, leading to increased efficiency and sustainability. By leveraging AI for data analysis, farmers can make more informed decisions about planting, watering, and harvesting. An AI solution in this space might include image recognition technology to monitor crop health or machine learning algorithms to predict optimal planting patterns and irrigation schedules.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Building a Skilled Team.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">The backbone of any AI venture is its team. Assembling a team with the right mix of skills is crucial. This team should ideally comprise AI specialists, data scientists, software developers, and project managers. Each member should bring a unique skill set, such as machine learning expertise, data processing, software development, and industry-specific knowledge. Recruiting can be done through tech job boards, AI-focused academic programs, or through professional networking platforms. Building a culture of continuous learning and innovation within the team will ensure that your projects remain at the cutting edge of AI development.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">To develop such a solution, a team with a blend of AI expertise and agricultural knowledge is essential. This team would ideally include AI developers proficient in machine learning and image recognition, data scientists skilled in analyzing agricultural data, and professionals with experience in farming practices and crop management. Such a diverse team ensures that the AI solution is not only technically sound but also practically applicable in the agricultural context.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Creating AI Products.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Developing an AI product requires a deep understanding of both the technology and the market it serves. Begin by defining the problem your AI solution aims to solve and design your product around this. This phase should involve prototyping, testing, and iterating based on feedback. Ensure that your AI solution not only addresses the problem effectively but is also user-friendly and easily integrable into existing systems. Utilize agile development methodologies to adapt quickly to any technological or market changes.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">The product could be an AI-powered crop management system that integrates with existing agricultural machinery and software. It would use sensors and drones to collect data on soil health, crop growth, and weather patterns. The AI component would analyze this data to provide actionable insights to farmers, such as when to plant certain crops, how to optimize water usage, and when to harvest for maximum yield.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Marketing and Sales Strategies.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Successfully marketing and selling AI solutions involves communicating the value and potential impact of your product to your target market. This requires a deep understanding of your customer segments and the specific benefits your AI solution offers them. Employ digital marketing strategies such as content marketing, social media campaigns, and email marketing to reach your audience. Participating in industry events and webinars can also help in building brand awareness. Tailoring your sales approach to each customer&rsquo;s specific needs and demonstrating measurable ROI from your solution can significantly increase your chances of success.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">For marketing, the focus should be on demonstrating the tangible benefits of the AI system in increasing crop yields and reducing costs. The product could be marketed directly to agribusiness companies and small-scale farmers through agricultural trade shows, online marketing campaigns, and partnerships with agricultural equipment suppliers. Sales strategies might include offering free trials, demonstrating ROI through case studies, and providing scalable solutions that cater to both large and small farming operations.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<h1 class=\"western\" style=\"line-height: 150%;\">Providing Consulting Services for AI Integration.</h1>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Acquiring Expertise in Different Industries\' Needs for AI Integration.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">To offer valuable AI consulting services, it\'s essential to have a deep understanding of the unique needs and challenges of different industries. This expertise isn\'t just about knowing AI technologies but also about comprehending industry-specific processes and pain points. Continuous learning and staying updated with industry trends are crucial. One effective approach is to specialize in one or two industries initially, such as healthcare, finance, or retail, and gradually expand your expertise. Engaging with industry professionals, attending specialized conferences, and participating in industry-specific online forums can provide deeper insights and keep you abreast of emerging trends and needs.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Example, specialize in the logistics sector, gaining insights into challenges like route optimization, inventory management, and supply chain efficiency.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Assisting Companies in Identifying Areas Where They Can Benefit from Using AI.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Many companies are aware of AI\'s potential but often struggle to identify how it can be applied effectively in their operations. As an AI consultant, your role is to conduct thorough assessments of a company\'s processes and identify areas where AI can add value. This involves understanding their workflow, challenges, and goals. You should be able to articulate how AI can solve specific problems, improve efficiency, or create new opportunities for the business. Developing case studies or having demonstrative projects can greatly aid in illustrating the potential benefits of AI integration to your clients.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">This could include, assisting logistics companies in pinpointing areas ripe for AI integration, such as predictive analytics for demand forecasting, autonomous vehicle routing, or AI-driven inventory tracking.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Offering Guidance on Selecting the Right AI Technologies and Vendors.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">With the vast array of AI technologies and tools available, companies often need help in choosing the right solution that aligns with their business objectives and technical capabilities. As a consultant, you should provide unbiased advice on selecting the most suitable AI technologies and vendors. This requires staying up-to-date with the latest AI developments and maintaining a network of reliable AI technology providers. Your guidance should consider factors like scalability, integration capabilities, support, and cost-effectiveness. Advise on selecting AI technologies that streamline logistics operations, focusing on solutions that integrate seamlessly with existing systems and offer tangible ROI.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Developing Implementation Plans and Training Employees on Using AI Systems.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Implementing AI solutions successfully requires a well-structured plan that considers the technical and human aspects. As an AI consultant, you should assist companies in developing implementation strategies that are feasible, efficient, and minimally disruptive. This includes outlining the technical requirements, setting realistic timelines, and anticipating potential challenges during integration. Additionally, training the company\'s employees on how to use these new AI systems is crucial for successful adoption. Your role includes creating training programs and materials that help employees understand and effectively utilize AI tools in their daily tasks.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">An example of this is creating comprehensive implementation strategies for AI solutions in logistics, including customizing AI tools to fit unique operational needs and training staff for effective adoption and usage.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<h1 class=\"western\" style=\"line-height: 150%;\">Creating Content about the Impact of AI.</h1>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Creating a Blog or Website Dedicated to Discussing Various Aspects of Artificial Intelligence.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Establishing a digital presence dedicated to AI is a strategic way to delve into the realm of content creation. A blog or website can serve as a platform to explore and dissect various facets of AI, from emerging technologies and their applications to ethical considerations and industry trends. To start, choose a domain name that resonates with the AI theme and create a user-friendly, visually appealing site. Your content should cater to both AI novices and experts, offering insights, analyses, and updates on AI developments. Regularly updating your blog with quality content will help in building a loyal audience and establishing your site as a go-to resource for AI information.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">A good example, is starting a blog dedicated to AI\'s role in transforming the financial industry, covering topics like AI in algorithmic trading, fraud detection, and customer service automation.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Writing Articles or Whitepapers that Explore How Different Industries are Affected by and Benefit from Adopting AI Technologies.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Deep-dive articles and whitepapers are excellent mediums to showcase your expertise in AI. By focusing on how AI impacts various industries, you can attract a diverse readership ranging from industry professionals to tech enthusiasts. Research and write about real-world applications of AI, case studies, and the transformational potential of AI in sectors like healthcare, finance, education, and more. Such content not only educates your audience but also positions you as a thought leader in the AI space. Ensure that your articles are well-researched, factually accurate, and provide value to your readers. Produce well-researched articles and whitepapers on how AI is revolutionizing financial practices, risk management, and personalized banking services.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Collaborating with Technology Publications or Magazines to Contribute AI-Related Content.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Partnering with established technology publications or magazines can significantly expand your reach and credibility. Pitch story ideas or articles that align with their content strategy and offer a unique perspective on AI. This collaboration can be in the form of guest posts, opinion pieces, or regular columns. Such partnerships not only provide you with a broader platform to share your insights but also help in networking with other AI professionals and enthusiasts.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Monetizing Your Content Through Sponsored Posts, Affiliate Marketing, or Paid Subscriptions.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Once your AI content platform gains traction, monetization becomes a viable option. You can explore sponsored posts where companies pay you to write about their AI products or services. Ensure that sponsored content is transparent and maintains the quality and integrity of your site. Affiliate marketing is another route, where you can earn commissions by promoting AI-related products or tools. Additionally, if your content is highly specialized and in-demand, you might consider a paid subscription model, offering exclusive content, reports, or newsletters to subscribers. Remember, the key to successful monetization is to maintain a balance between providing value to your audience and generating revenue. One way of doing this is generating revenue through sponsored content partnerships with fintech companies or financial institutions that are embracing AI, ensuring content authenticity and relevance to the audience.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<h1 class=\"western\" style=\"line-height: 150%;\">Investing in AI Startups.</h1>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Researching and Identifying Promising AI Startups.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Investing in AI startups requires a keen eye for innovation and potential. To identify promising startups, immerse yourself in the AI ecosystem. This involves keeping up with the latest AI trends, attending AI-focused events, and networking within the AI community. Pay attention to startups that are addressing unmet needs in the market or those applying AI in novel ways. Evaluate their market potential, the uniqueness of their technology, and the strength of their team. Online platforms dedicated to startup investments can also be valuable resources for discovering emerging AI companies.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Assessing the Potential for Growth and Profitability of an AI Startup.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Before investing, conduct a thorough assessment of the startup\'s potential for growth and profitability. Look at their business model, revenue streams, and scalability of their AI solution. Analyze their market size, competition, and the startup\'s position within the market. It&rsquo;s also crucial to understand their customer acquisition strategy and the long-term viability of their product or service. Financial projections, past performance, and the team&rsquo;s track record can provide insights into the startup&rsquo;s growth potential.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Providing Financial Support Through Investments or Venture Capital Funding.</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Once a promising startup is identified, decide on the mode of investment. This could be through direct investment, joining a funding round, or participating in venture capital funds specializing in AI. Each investment type has its own risks and benefits, so consider your financial goals and risk appetite. When providing financial support, it&rsquo;s also important to understand the terms of the investment, including equity stakes, voting rights, and exit strategies.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\"><strong>Collaborating with Startups to Help Them Scale and Succeed in the Market</strong></p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">Investment is more than just financial support; it&rsquo;s also about contributing to the startup\'s success. This can involve offering mentorship, sharing industry contacts, or providing strategic guidance. Collaborate with the startup team to help them refine their product, expand their market reach, and navigate challenges. Your experience and network can be invaluable assets to a growing AI startup, and active involvement can significantly increase the chances of a successful outcome for your investment.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<h1 class=\"western\" style=\"line-height: 150%;\">Conclusion.</h1>\r\n<h2 class=\"western\" style=\"line-height: 150%;\">Seizing the Opportunities in the AI Era for Financial Success.</h2>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">As we navigate through the intricacies and potentials of earning money in the era of AI, it becomes evident that the opportunities are as vast as they are dynamic. The AI landscape is continuously evolving, opening doors to innovative ways of generating income and contributing to technological progress. Whether it\'s through developing and selling AI solutions, providing expert consulting services, creating impactful content, or investing in promising AI startups, the avenues to engage with and profit from AI are diverse and accessible.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">The journey to capitalizing on AI requires a combination of technical know-how, market understanding, strategic thinking, and a willingness to adapt and learn continuously. For developers and entrepreneurs, the challenge lies in identifying niche markets and crafting AI solutions that meet specific needs. Consultants play a crucial role in bridging the gap between AI potential and practical business applications, while content creators contribute to the AI discourse, educating and informing a broader audience. Investors, on the other hand, fuel innovation by supporting the startups that are shaping the future of AI.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">What stands out across all these paths is the importance of innovation, ethical considerations, and the pursuit of adding real value through AI. As we embrace these opportunities, it is crucial to remember that with great power comes great responsibility. The ethical implications of AI should always be at the forefront, ensuring that while we seek financial success, we also contribute positively to society and the advancement of technology.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">In conclusion, the era of AI presents a unique and exciting opportunity for financial success and professional growth. By staying informed, embracing continuous learning, and keeping a keen eye on emerging trends and ethical considerations, anyone can become a part of and benefit from the AI revolution. The future is AI-driven, and the time to be part of this transformative journey is now. Let\'s embrace the era of AI, unlocking its potential for innovation, growth, and prosperity.</p>\r\n<p style=\"line-height: 150%; margin-bottom: 0in;\">&nbsp;</p>', '1698439648945802490', 'true', 'Uf5m3IYw5cYSXX5pNPQh', '2023-12-11 09:28:44', '../articles_cover/Uf5m3IYw5cYSXX5pNPQh.png', '2023-12-11 09:35:37', '6-embracing-the-opportunities-in-the-ai-era');

-- --------------------------------------------------------

--
-- Table structure for table `article_author`
--

CREATE TABLE `article_author` (
  `article_randid` varchar(50) DEFAULT NULL,
  `author_randid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article_author`
--

INSERT INTO `article_author` (`article_randid`, `author_randid`) VALUES
('GkEWvfyQiobwqGwOZs08', 'rzzcoOhSOdznxvF'),
('yQDurEoNCSfJursyhJ94', 'rzzcoOhSOdznxvF'),
('03mLCvjKzKDzzrIYSNlq', 'rzzcoOhSOdznxvF'),
('ZBEPABkHWloqcNlRifTY', 'rzzcoOhSOdznxvF'),
('KuoFQQCzbrwfQYKqUMXR', 'rzzcoOhSOdznxvF'),
('WbNZGcqzBMUBXledMWoG', 'rzzcoOhSOdznxvF'),
('QDKcgMEASSNnxnu8f1fU', 'rzzcoOhSOdznxvF'),
('8VIXJgWFaRMOHNqFu5x2', 'rzzcoOhSOdznxvF'),
('Uf5m3IYw5cYSXX5pNPQh', 'rzzcoOhSOdznxvF');

-- --------------------------------------------------------

--
-- Table structure for table `article_views`
--

CREATE TABLE `article_views` (
  `view_id` int NOT NULL,
  `article_randid` varchar(50) NOT NULL,
  `views` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article_views`
--

INSERT INTO `article_views` (`view_id`, `article_randid`, `views`) VALUES
(21, 'WbNZGcqzBMUBXledMWoG', 1),
(22, '8VIXJgWFaRMOHNqFu5x2', 4),
(23, 'Uf5m3IYw5cYSXX5pNPQh', 70);

-- --------------------------------------------------------

--
-- Table structure for table `AuthorCookies`
--

CREATE TABLE `AuthorCookies` (
  `author_randid` varchar(60) DEFAULT NULL,
  `AuthToken0` varchar(60) DEFAULT NULL,
  `AuthToken1` varchar(100) DEFAULT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `AuthorCookies`
--

INSERT INTO `AuthorCookies` (`author_randid`, `AuthToken0`, `AuthToken1`, `timestamp`) VALUES
('GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'C88FqndzyYf1iA37qfWYa6vFK8fVqINDgtm7JwrHvqE2iaozFENnQYvOnX1G0phuMX9i3rl78EiJhSGp1rsQCe7yBz', '2023-06-21 13:06:39'),
('GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'C88FqndzyYf1iA37qfWYa6vFK8fVqINDgtm7JwrHvqE2iaozFENnQYvOnX1G0phuMX9i3rl78EiJhSGp1rsQCe7yBz', '2023-06-21 13:06:39'),
('GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'VuW0bsKPaFQHmEvpHnPSJAJDkPVvnkvAS5w2ZP9DOLX9wO6j8MmJgwYKAdUpBYv3cAxMBXOJG8vpPV9yHksdN5PuTN', '2023-06-21 13:12:01'),
('GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'llYP5eKgtaDPnW7UCSWwm2PCSvqAKB10lmJMv8MiyvaTAUXUxCfIVgNwHJAn3R3Xi1J14EqxIQghXkdm9C82BuypYt', '2023-06-21 13:20:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'DC8QeBe4HzoDBofKxAtV3ohSc646wsWojcZEejPbjh1lyxiD3jc6Q9YOQyak65RsMLfxJJE3zovkOeA6obSYPEW1ME', '2023-06-21 19:37:28'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', 'wrQ5snHmq8fzysUQBCFy2Whuj0HslAAatu655hkWKbjCZokC1LuexY3U2X5x2qA4qm8WbTiSFdCNn1lXWv4JKIueYe', '2023-06-21 21:05:04'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('rLmBuQjrhjlVuCZAoHFT8IXkfzkaRiHX4S7HWaLM3nyLHc3qka', 'rLmBuQjrhjlVuCZAoHFT8IXkfzkaRiHX4S7HWaLM3nyLHc3qka', '0KbQGJvbBof5uFnRHUsvbjG7SFLI6thSEilMF6YO5dlHrEoWdguOlQ8BzdkjdXQAZoMd6ScSuncXmk1EgB3XyBojtN', '2023-06-29 22:36:48'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('jCnTd8fga3QoXRhSkTbzpehb7LyUcaLO3so0HtP5ZIcAb8fB4s', 'jCnTd8fga3QoXRhSkTbzpehb7LyUcaLO3so0HtP5ZIcAb8fB4s', 'qik7ko5Mj1g8rWcvJwH78VgQJZj7IY6Fc3p9ajSBufODYYGznM6MN2naUvK6EhW8npNeMp3A3aguGJoedX29IYSyBc', '2023-07-09 17:56:48'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('NwAWCjTufC', 'NwAWCjTufC', '3xYOlbKG1p55kBbKhhSDNsAu9qxEYsYC0VCDpR6xbApyPGhu1qtdNMs5GxbqsWyYI929dxgqkA7ot1UwRVs8JPkA3U', '2023-07-14 19:35:26'),
('NwAWCjTufC', 'NwAWCjTufC', '3xYOlbKG1p55kBbKhhSDNsAu9qxEYsYC0VCDpR6xbApyPGhu1qtdNMs5GxbqsWyYI929dxgqkA7ot1UwRVs8JPkA3U', '2023-07-14 19:35:26'),
('NwAWCjTufC', 'NwAWCjTufC', '3xYOlbKG1p55kBbKhhSDNsAu9qxEYsYC0VCDpR6xbApyPGhu1qtdNMs5GxbqsWyYI929dxgqkA7ot1UwRVs8JPkA3U', '2023-07-14 19:35:26'),
('NwAWCjTufC', 'NwAWCjTufC', '4jBUIK5o8j5Khu9qseB8qkhUCYbpbSYYLzZMKLJFSx3XGHp4iRGMBdg3zfsGPbhMWdvdljKkkHTHqXoG0GIXDwTOjl', '2023-07-14 21:06:37'),
('NwAWCjTufC', 'NwAWCjTufC', 'a54HZJ6T5ebcDOIwKaf9M6XeHkingHrKXozRrwPFyj7RNvnhhdWp99F9I8FPGOJ7k7n6WNWKvpx5PICJFHjY9TF37r', '2023-07-15 12:41:11'),
('NwAWCjTufC', 'NwAWCjTufC', 'wCi9Z5LtgBGfpmhK1uoRzOo4zLEfIXQMoxguvl5qjqjWje4LKIhRoDcLIbCzBvEeFEuXwTatrYb343eQUWv2Hz3HdD', '2023-07-15 12:42:16'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('rzzcoOhSOdznxvF', 'rzzcoOhSOdznxvF', 'fHcEKWDLFdMwJQ1pPyyaTRNugmiHnp7872CqFMd5pGFpM7sHTF0HMCgSBUUSj45z4lcJiUjiDTE4E8eoH3dkkLnhQE', '2023-12-11 09:24:19'),
('rzzcoOhSOdznxvF', 'rzzcoOhSOdznxvF', 'fHcEKWDLFdMwJQ1pPyyaTRNugmiHnp7872CqFMd5pGFpM7sHTF0HMCgSBUUSj45z4lcJiUjiDTE4E8eoH3dkkLnhQE', '2023-12-11 09:24:19'),
('rzzcoOhSOdznxvF', 'rzzcoOhSOdznxvF', 'fHcEKWDLFdMwJQ1pPyyaTRNugmiHnp7872CqFMd5pGFpM7sHTF0HMCgSBUUSj45z4lcJiUjiDTE4E8eoH3dkkLnhQE', '2023-12-11 09:24:19'),
('rzzcoOhSOdznxvF', 'rzzcoOhSOdznxvF', 'fHcEKWDLFdMwJQ1pPyyaTRNugmiHnp7872CqFMd5pGFpM7sHTF0HMCgSBUUSj45z4lcJiUjiDTE4E8eoH3dkkLnhQE', '2023-12-11 09:24:19'),
('RWZmxf39Kz0Hifl', 'RWZmxf39Kz0Hifl', 'YjjRsoBnAFUfw7Kt8rlu5lxidb3tJMhEdWUCbojQKVS4f1E7Xqibzz1uakQQ7FBbX8rdZVZXAg501F9lU67myYx9Kp', '2023-07-25 12:33:52'),
('rzzcoOhSOdznxvF', 'rzzcoOhSOdznxvF', 'fHcEKWDLFdMwJQ1pPyyaTRNugmiHnp7872CqFMd5pGFpM7sHTF0HMCgSBUUSj45z4lcJiUjiDTE4E8eoH3dkkLnhQE', '2023-12-11 09:24:19'),
('rzzcoOhSOdznxvF', 'rzzcoOhSOdznxvF', 'fHcEKWDLFdMwJQ1pPyyaTRNugmiHnp7872CqFMd5pGFpM7sHTF0HMCgSBUUSj45z4lcJiUjiDTE4E8eoH3dkkLnhQE', '2023-12-11 09:24:19'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZVqR6QQw4AYWt7M6zYvLazOqHn4OfCJuda9qAnrjausLMWGUQjxVOmRBBeK7kh460WlBIIxhTzepBVYQjTZBHESo8R', '2023-07-29 14:10:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'uT1rKt0JBe0npJb6Z4j2Z4qdymZn5lBnbmrl0wRQ0IMJwEynqMwaFSLsii5fgkXsL0RxY5Fux7l6MCYqUSvHKB8MtE', '2023-09-12 19:22:42'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'UtzymvJDQ23Gc3OZ0fx9atjiZDgCfLnYev4HbAVNR8lax7tQSrxPbyXhiBb1QgFgNcY8foiuaDtDddlF7uzPwkWTTO', '2023-09-12 19:32:44'),
('OVLuIBHkbpwSE5R', 'OVLuIBHkbpwSE5R', 'GvtgontKGNboyCLN0liYWGcMmhzZSkw8BMdd2eh7EL9LtTuD2hG7EZlQ1mmNsjl73WLN5XNGkWRAfL4jDrEFCyNRlR', '2023-09-18 16:20:42'),
('5T4dz1zsjWibfge', '5T4dz1zsjWibfge', 'sNGavvJdm9JihKQuG47yiT893gnZ86XKLStlRIfYKf5Boeaz7YHVjwgdWqZbFJC5V6HAVJq8Grf5GuyXR1Bcu8yOSS', '2023-09-18 16:56:26'),
('5T4dz1zsjWibfge', '5T4dz1zsjWibfge', 'qnr7sUuX6dQPGsHj58fZ3h8bEzwvvQ0OWq9M3iTTvejyeSWTUGbVr7UuCJO98pKVqfvUD2Tv1jeGddLSOSduPtY9vp', '2023-09-18 23:08:32'),
(NULL, NULL, 'lGfhnuCC1M2E4BGQmcbQeQVXNXhnTbnXI4eZAdtWKfIsYQa0LjHlhtMohYo6ahhwb5sNBSsFyQkvUPzKzK9etpwqty', '2023-09-19 19:36:10'),
(NULL, NULL, 'aEq2WuvOAcGCKaxFpV4y3UsaPSppL1ni0W2sHecaqow0JtRn5YdL0EmIABw68atfPEucPhZZC1mhE2fAJeCr1OAwST', '2023-09-19 19:39:10'),
('NDIa4oqjLo2CM3P', 'NDIa4oqjLo2CM3P', 'V4gixNLvgNGySizZez8AZDeVY60rLwdsBgudR9Gb4lJSMvjb6vxgkdbeLHJ5HJ7FdSWFNd22QqliHI3t7gvhc65E1A', '2023-09-20 13:10:09'),
('NDIa4oqjLo2CM3P', 'NDIa4oqjLo2CM3P', 'yyJDRWtybqHVBstYSoAujYwJKnjK2PYA4l24udpPT6vJHrGHWT0YJJdKjs9ss6aRL2qSWjnTYdsVTyw9DHQzRZZe6h', '2023-09-20 13:55:47'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'akYxG4ifHTQ9vqEJ2jlBFr9RQUNDVqDt21jS4SLKpy7W7LejHAP3SF0Y1CwQdGlqZkN0hiRuPB9qkHiiWJLUlLI49R', '2023-09-20 13:56:41'),
('NDIa4oqjLo2CM3P', 'NDIa4oqjLo2CM3P', 'cTNR3nJ6rELO3oGfKvzjZIkP0bwEAa8yLrs7Ure57AmHOrSlgGbgFfPPBzcibbC48EzSSifpOcHMr1jBSFTlUr7npN', '2023-09-20 15:11:15'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'ZDPfROMoDgtNmU6tGKQTXZYatZG2mIVafpF5UjbWN0nLpCdZ9DEBl4ukdxBgY2B5laIynJwQMs108Qzpx0lwksRVva', '2023-09-20 15:12:06'),
(NULL, NULL, 'IDexZtnLbfo0Qs2qi0yom7Lo8RndVYVGWoTMvlIvHTD1fgcvBD7ANnK9j3rY5cEjg4iu56AojTzEMYchkXXWeqpd80', '2023-09-20 15:22:27'),
(NULL, NULL, 'rbi7rJsmoMKga1808JPaeWAq5lgwkjRnDd9H0LdnlIAbTD0NkdlLhplVLLalGKgDKzUs0NA5DSxnileDLujQsAIYu4', '2023-09-20 15:28:48'),
('H0CiJyKwt7563hX', 'H0CiJyKwt7563hX', 'qSKGqq0UT699zIIqMaozuLJsAjdviUJXFzsPzOkWSrfnQP1qfHoWwg8nlvld0aMD4q1NI7aXFko0gp91jOjV5omq3x', '2023-09-20 19:00:27'),
('rzzcoOhSOdznxvF', 'rzzcoOhSOdznxvF', 'fHcEKWDLFdMwJQ1pPyyaTRNugmiHnp7872CqFMd5pGFpM7sHTF0HMCgSBUUSj45z4lcJiUjiDTE4E8eoH3dkkLnhQE', '2023-12-11 09:24:19'),
('H0CiJyKwt7563hX', 'H0CiJyKwt7563hX', 'lctrmDxFqUVKFAlCDdxxyR5ZSvxKElRzXnT2SMFu1wM9nYnZwg4JalgL812SWE4fpcJ26JxMZ0ReaLZiVm44c5tvmY', '2023-09-21 09:10:32'),
('H0CiJyKwt7563hX', 'H0CiJyKwt7563hX', 'YyHH6UEZAfYc64z785R7y5XNF72TztduwyofSu7T6TLdk8i15cCxTrxZuwlo2fsFRNoWscXgrVEfrJPQHQFqT6407D', '2023-09-21 09:10:57'),
('rzzcoOhSOdznxvF', 'rzzcoOhSOdznxvF', 'fHcEKWDLFdMwJQ1pPyyaTRNugmiHnp7872CqFMd5pGFpM7sHTF0HMCgSBUUSj45z4lcJiUjiDTE4E8eoH3dkkLnhQE', '2023-12-11 09:24:19'),
(NULL, NULL, 'jLRAzLQDMrPlbTksy6HYnnC1Ubdkbc7YSq2HhQeLGJMYRl5QmPwlBiml9viIf7anKdWzfYbTmF7zJTbZW7cL32QeoK', '2023-10-02 17:58:33'),
('H0CiJyKwt7563hX', 'H0CiJyKwt7563hX', 'bfpNlLBFXGMK4mBU2wfImKPRMK85FUWrebI8v5aIxT1wli2C6D1o4mSJDCyMVAEpWL4mdk7qM5nBb7VnMh24Y6UEmz', '2023-10-17 16:55:19'),
('rzzcoOhSOdznxvF', 'rzzcoOhSOdznxvF', 'fHcEKWDLFdMwJQ1pPyyaTRNugmiHnp7872CqFMd5pGFpM7sHTF0HMCgSBUUSj45z4lcJiUjiDTE4E8eoH3dkkLnhQE', '2023-12-11 09:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `AuthorLogin`
--

CREATE TABLE `AuthorLogin` (
  `author_randid` varchar(60) DEFAULT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `AuthorLogin`
--

INSERT INTO `AuthorLogin` (`author_randid`, `timestamp`) VALUES
('GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', '2023-06-21 13:12:01'),
('GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', '2023-06-21 13:20:30'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-21 13:25:25'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-21 16:06:46'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-21 19:36:52'),
('GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', '2023-06-21 19:37:28'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-21 19:39:20'),
('GFWsv3BSBSPJ3RGbK7hi31Rvy5rhzM9ppRKhAbmdeZwS5dqRAX', '2023-06-21 21:05:04'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-21 21:05:35'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-22 01:41:19'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-22 15:29:36'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-24 13:42:28'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-29 16:11:13'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-29 16:13:39'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-29 16:40:03'),
(NULL, '2023-06-29 21:14:10'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-29 22:20:22'),
('rLmBuQjrhjlVuCZAoHFT8IXkfzkaRiHX4S7HWaLM3nyLHc3qka', '2023-06-29 22:36:48'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-29 22:51:11'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-30 17:17:05'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-30 20:31:18'),
(NULL, '2023-07-07 09:45:08'),
('jCnTd8fga3QoXRhSkTbzpehb7LyUcaLO3so0HtP5ZIcAb8fB4s', '2023-07-09 17:56:48'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-07-10 19:09:05'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-07-10 19:09:54'),
(NULL, '2023-07-13 10:54:37'),
(NULL, '2023-07-13 11:03:07'),
(NULL, '2023-07-13 11:10:24'),
(NULL, '2023-07-13 11:12:48'),
(NULL, '2023-07-13 11:23:58'),
(NULL, '2023-07-13 11:46:02'),
(NULL, '2023-07-13 11:51:46'),
(NULL, '2023-07-14 10:21:05'),
(NULL, '2023-07-14 10:24:00'),
('NwAWCjTufC', '2023-07-14 12:54:36'),
('NwAWCjTufC', '2023-07-14 13:22:31'),
(NULL, '2023-07-14 13:42:03'),
('NwAWCjTufC', '2023-07-14 13:44:45'),
('NwAWCjTufC', '2023-07-14 21:06:37'),
('NwAWCjTufC', '2023-07-15 12:41:11'),
('NwAWCjTufC', '2023-07-15 12:42:16'),
(NULL, '2023-07-15 13:40:01'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-07-15 13:44:35'),
(NULL, '2023-07-15 14:05:38'),
('rzzcoOhSOdznxvF', '2023-07-15 14:06:11'),
('rzzcoOhSOdznxvF', '2023-07-18 05:57:36'),
(NULL, '2023-07-19 12:02:45'),
('rzzcoOhSOdznxvF', '2023-07-19 13:35:49'),
('rzzcoOhSOdznxvF', '2023-07-25 12:31:25'),
('RWZmxf39Kz0Hifl', '2023-07-25 12:33:52'),
('rzzcoOhSOdznxvF', '2023-07-25 12:34:36'),
('rzzcoOhSOdznxvF', '2023-07-25 13:10:22'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-07-25 13:18:23'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-09-12 19:22:42'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-09-12 19:32:44'),
(NULL, '2023-09-18 15:06:47'),
('OVLuIBHkbpwSE5R', '2023-09-18 15:10:23'),
(NULL, '2023-09-18 15:29:45'),
(NULL, '2023-09-18 15:55:48'),
('5T4dz1zsjWibfge', '2023-09-18 16:03:19'),
(NULL, '2023-09-18 16:22:44'),
('5T4dz1zsjWibfge', '2023-09-18 23:08:32'),
(NULL, '2023-09-19 19:05:19'),
(NULL, '2023-09-19 19:15:09'),
(NULL, '2023-09-19 19:36:10'),
(NULL, '2023-09-19 19:39:10'),
('NDIa4oqjLo2CM3P', '2023-09-20 13:10:09'),
('NDIa4oqjLo2CM3P', '2023-09-20 13:55:47'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-09-20 13:56:41'),
('NDIa4oqjLo2CM3P', '2023-09-20 15:11:15'),
('sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-09-20 15:12:06'),
(NULL, '2023-09-20 15:22:27'),
(NULL, '2023-09-20 15:28:48'),
('H0CiJyKwt7563hX', '2023-09-20 15:29:40'),
('rzzcoOhSOdznxvF', '2023-09-20 19:01:28'),
('H0CiJyKwt7563hX', '2023-09-21 09:10:32'),
('H0CiJyKwt7563hX', '2023-09-21 09:10:57'),
(NULL, '2023-09-29 16:51:03'),
('rzzcoOhSOdznxvF', '2023-10-02 11:50:49'),
(NULL, '2023-10-02 17:58:33'),
('H0CiJyKwt7563hX', '2023-10-17 16:55:19'),
('rzzcoOhSOdznxvF', '2023-10-23 22:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `author_randid` varchar(50) DEFAULT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IP_address` varchar(30) DEFAULT NULL,
  `active_status` enum('yes','no') NOT NULL DEFAULT 'no',
  `slug` varchar(100) DEFAULT NULL,
  `join_method` enum('google','email') NOT NULL DEFAULT 'email'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `full_name`, `email`, `password`, `phone_number`, `author_randid`, `join_date`, `IP_address`, `active_status`, `slug`, `join_method`) VALUES
(8, 'Patois Protagonist', 'patoisprotagonist@gmail.com', '$2y$10$T/60F00MHLJ/KHsAZinJou5Ap8J9Riu/TSeQODIF0Kes2GFPNw03K', NULL, 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', '2023-06-20 12:53:05', '127.0.0.1', 'yes', '8-patois-protagonist', 'email'),
(10, 'patrick kariuki', 'dreadnaughtthegreat@gmail.com', '$2y$10$T/60F00MHLJ/KHsAZinJou5Ap8J9Riu/TSeQODIF0Kes2GFPNw03K', NULL, 'rLmBuQjrhjlVuCZAoHFT8IXkfzkaRiHX4S7HWaLM3nyLHc3qka', '2023-06-29 18:14:10', '127.0.0.1', 'no', '10-patrick-kariuki', 'email'),
(23, 'Patrick Kabita', 'patrickkariuki13@gmail.com', '$2y$10$T/60F00MHLJ/KHsAZinJou5Ap8J9Riu/TSeQODIF0Kes2GFPNw03K', NULL, 'rzzcoOhSOdznxvF', '2023-07-15 14:05:38', '102.212.236.186', 'yes', '23-dreadnaught', 'email'),
(24, 'kinyua munyui', 'munyui@gmail.com', '$2y$10$eeSEtzOuKIhoDL5cMLxKv.qbN.YGF7aTAQPaFalQ69W4QR9Gtvf/y', NULL, 'RWZmxf39Kz0Hifl', '2023-07-19 12:02:44', '102.212.236.186', 'no', '24-kinyua-munyui', 'email'),
(28, 'John Walter', 'johnwaltz72@gmail.com', '$2y$10$cY5.8GsDRUy/5l08QxU62Oxz5seye6usmYqsBlCfU1Kz.QlHgYere', NULL, 'Y5HOY64sVdCkz61', '2023-09-18 16:22:22', '105.160.58.135', 'yes', '28-john-walter', 'email'),
(34, 'Patrick Kariuki', 'patrickkariuki13@gmail.com', NULL, NULL, 'H0CiJyKwt7563hX', '2023-09-20 15:28:48', '102.212.236.183', 'yes', '34-patrick-kariuki', 'google'),
(35, 'Jackline Wawira', 'jackiem2262k@gmail.com', '$2y$10$.m.fYOoUm6FYLEHkbRlAI.9aTlPDRZ63AIIy0cpk4t305PkMTiT8e', NULL, 'RHQn49mZb5SV9tD', '2023-09-29 16:51:02', '102.217.157.227', 'yes', '35-jackline-wawira', 'email'),
(36, 'Dreadnaught', 'patoisprotagonist@gmail.com', NULL, NULL, '4drFafm6xgcin7n', '2023-10-02 17:58:33', '102.212.236.183', 'yes', '36-dreadnaught', 'google');

-- --------------------------------------------------------

--
-- Table structure for table `author_views`
--

CREATE TABLE `author_views` (
  `view_id` int NOT NULL,
  `author_randid` varchar(50) DEFAULT NULL,
  `views` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `author_views`
--

INSERT INTO `author_views` (`view_id`, `author_randid`, `views`) VALUES
(7, NULL, 1),
(8, NULL, 1),
(9, NULL, 1),
(10, NULL, 1),
(11, 'rzzcoOhSOdznxvF', 223),
(12, NULL, 1),
(13, NULL, 1),
(14, NULL, 1),
(15, NULL, 1),
(16, NULL, 1),
(17, NULL, 1),
(18, NULL, 1),
(19, NULL, 1),
(20, NULL, 1),
(21, NULL, 1),
(22, NULL, 1),
(23, NULL, 1),
(24, NULL, 1),
(25, NULL, 1),
(26, NULL, 1),
(27, NULL, 1),
(28, NULL, 1),
(29, NULL, 1),
(30, NULL, 1),
(31, NULL, 1),
(32, NULL, 1),
(33, NULL, 1),
(34, NULL, 1),
(35, NULL, 1),
(36, NULL, 1),
(37, NULL, 1),
(38, NULL, 1),
(39, NULL, 1),
(40, NULL, 1),
(41, NULL, 1),
(42, NULL, 1),
(43, NULL, 1),
(44, NULL, 1),
(45, NULL, 1),
(46, NULL, 1),
(47, NULL, 1),
(48, NULL, 1),
(49, NULL, 1),
(50, NULL, 1),
(51, NULL, 1),
(52, NULL, 1),
(53, NULL, 1),
(54, NULL, 1),
(55, NULL, 1),
(56, NULL, 1),
(57, NULL, 1),
(58, NULL, 1),
(59, NULL, 1),
(60, NULL, 1),
(61, NULL, 1),
(62, NULL, 1),
(63, NULL, 1),
(64, NULL, 1),
(65, NULL, 1),
(66, NULL, 1),
(67, NULL, 1),
(68, NULL, 1),
(69, NULL, 1),
(70, NULL, 1),
(71, NULL, 1),
(72, NULL, 1),
(73, NULL, 1),
(74, NULL, 1),
(75, NULL, 1),
(76, NULL, 1),
(77, NULL, 1),
(78, NULL, 1),
(79, NULL, 1),
(80, NULL, 1),
(81, NULL, 1),
(82, NULL, 1),
(83, NULL, 1),
(84, NULL, 1),
(85, NULL, 1),
(86, NULL, 1),
(87, NULL, 1),
(88, NULL, 1),
(89, NULL, 1),
(90, NULL, 1),
(91, NULL, 1),
(92, NULL, 1),
(93, NULL, 1),
(94, NULL, 1),
(95, NULL, 1),
(96, NULL, 1),
(97, NULL, 1),
(98, NULL, 1),
(99, NULL, 1),
(100, NULL, 1),
(101, NULL, 1),
(102, NULL, 1),
(103, NULL, 1),
(104, NULL, 1),
(105, NULL, 1),
(106, NULL, 1),
(107, NULL, 1),
(108, NULL, 1),
(109, NULL, 1),
(110, NULL, 1),
(111, NULL, 1),
(112, NULL, 1),
(113, NULL, 1),
(114, NULL, 1),
(115, NULL, 1),
(116, NULL, 1),
(117, NULL, 1),
(118, NULL, 1),
(119, NULL, 1),
(120, NULL, 1),
(121, NULL, 1),
(122, NULL, 1),
(123, NULL, 1),
(124, NULL, 1),
(125, NULL, 1),
(126, NULL, 1),
(127, NULL, 1),
(128, NULL, 1),
(129, NULL, 1),
(130, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` text,
  `description` text,
  `image_path` text,
  `category_randid` varchar(50) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`, `image_path`, `category_randid`, `slug`) VALUES
(13, 'Natural World', 'Learn about the wonders of the natural world, from its biodiversity to its geological formations.', '../cat_images/natural world.jpeg', '16983357001203967478', 'natural-world'),
(14, 'Technology', 'Articles on techology revolution and its impact on our world.', '../cat_images/ai webpg.webp', '1698439648945802490', 'technology');

-- --------------------------------------------------------

--
-- Table structure for table `category_views`
--

CREATE TABLE `category_views` (
  `view_id` int NOT NULL,
  `views` int DEFAULT NULL,
  `category_randid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category_views`
--

INSERT INTO `category_views` (`view_id`, `views`, `category_randid`) VALUES
(7, 175, '16983357001203967478'),
(8, 198, '1698439648945802490'),
(9, 1, 'c');

-- --------------------------------------------------------

--
-- Table structure for table `email_verification_tokens`
--

CREATE TABLE `email_verification_tokens` (
  `verification_id` int NOT NULL,
  `author_randid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email_token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `email_verification_tokens`
--

INSERT INTO `email_verification_tokens` (`verification_id`, `author_randid`, `email_token`) VALUES
(2, 'rzzcoOhSOdznxvF', '2Q2NVCy1SqXM76oLoOHy4i1WJ20o41h0Sn7B0ic0'),
(4, 'RWZmxf39Kz0Hifl', '1icKSeqiAl1KfJ9Sae9gmLylPraD6rEEKUg5E7vs'),
(5, 'sWl3TZ9E8H8AinbuVR7g', 'yffrOGdE5OeYCJUXyAOhWwSplK2EQLQ7D5YEBVOq'),
(6, 'sWl3TZ9E8H8AinbuVR7gzVFMAW11h2PX8Fi5VRU20Iii1c7Xg4', 'pWuzW7p9jUaMeyTN9LMwBD0E2pvXoqoTlGSearIx'),
(7, '', ''),
(8, 'OVLuIBHkbpwSE5R', '4YHd9gIOzdeV2BZi8R8ywpvrzQSjJm5EUDWFCzql'),
(9, '', ''),
(10, 'Oa24YV30UaJltCT', 'LKA15a8TEpgKWIZlLFBkN9Wckr34tKkuMR52W0SW'),
(11, '5T4dz1zsjWibfge', 'hY3Li3PbfWhthOnufWCTDONdFWPmtCP4vxZznWpt'),
(12, 'Y5HOY64sVdCkz61', '2TiG69tnSjTx5sbQmKwkWAlDEAgqDQ7Mje0pzMtU'),
(13, '8y7ouyBhd5inYzI', 'Qnjht5zEXYWdmQmd5USDFbExFvhdJzs1lef5hKJt'),
(14, 'RHQn49mZb5SV9tD', 'RkVv8hfNtqM5Yn9MAvv4foaCSORJFVhgI1aPxwTO');

-- --------------------------------------------------------

--
-- Table structure for table `mailing_list`
--

CREATE TABLE `mailing_list` (
  `email_id` int NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mailing_list`
--

INSERT INTO `mailing_list` (`email_id`, `email`) VALUES
(3, 'dreadreadnaughtthegreat@gmail.com'),
(1, 'patrickkariuki13@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `idx_title` (`title`);
ALTER TABLE `articles` ADD FULLTEXT KEY `idx_content` (`content`);

--
-- Indexes for table `article_views`
--
ALTER TABLE `article_views`
  ADD PRIMARY KEY (`view_id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_fullname` (`full_name`),
  ADD KEY `idx_authorrandid` (`author_randid`);

--
-- Indexes for table `author_views`
--
ALTER TABLE `author_views`
  ADD PRIMARY KEY (`view_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `idx_category_randid` (`category_randid`);

--
-- Indexes for table `category_views`
--
ALTER TABLE `category_views`
  ADD PRIMARY KEY (`view_id`);

--
-- Indexes for table `email_verification_tokens`
--
ALTER TABLE `email_verification_tokens`
  ADD PRIMARY KEY (`verification_id`);

--
-- Indexes for table `mailing_list`
--
ALTER TABLE `mailing_list`
  ADD PRIMARY KEY (`email_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `article_views`
--
ALTER TABLE `article_views`
  MODIFY `view_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `author_views`
--
ALTER TABLE `author_views`
  MODIFY `view_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category_views`
--
ALTER TABLE `category_views`
  MODIFY `view_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `email_verification_tokens`
--
ALTER TABLE `email_verification_tokens`
  MODIFY `verification_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mailing_list`
--
ALTER TABLE `mailing_list`
  MODIFY `email_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
