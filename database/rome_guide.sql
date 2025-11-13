-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 13, 2025 at 11:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rome_guide`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- --------------------------------------------------------

--
-- Table structure for table `attractions`
--

CREATE TABLE `attractions` (
  `id` int(11) NOT NULL,
  `metro_station_id` int(11) NOT NULL,
  `attraction_name` varchar(50) DEFAULT NULL,
  `attraction_image` varchar(25) DEFAULT NULL,
  `attraction_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attractions`
--

INSERT INTO `attractions` (`id`, `metro_station_id`, `attraction_name`, `attraction_image`, `attraction_description`) VALUES
(1, 1, 'Pyramid of Cestius', 'img/piramide.jpg', 'The Pyramid of Cestius is one of Rome’s most surprising ancient monuments — a full-blown Egyptian-style pyramid tucked between traffic and ruins! Built around 18–12 BCE, it was the tomb of Gaius Cestius, a Roman magistrate who was clearly inspired by the Egyptian craze sweeping through Rome after the conquest of Egypt. At 36 meters (about 118 feet) high and made of white Carrara marble, it\'s much sharper and slimmer than the pyramids of Giza.\r\n\r\nUnlike the grand Egyptian pyramids built over decades, this Roman version was finished quickly — in just 330 days — because Roman law at the time limited how long a tomb could take to build. That time pressure is even mentioned on the pyramid itself in an ancient inscription! The burial chamber inside is small and once contained frescoes, though it\'s usually closed to the public and only opened on rare guided tours.\r\n\r\nFor centuries, the pyramid was sealed and forgotten — but it was preserved thanks to Rome’s defensive walls. In the 3rd century, Emperor Aurelian incorporated the pyramid directly into the city\'s walls, accidentally protecting it from looting and collapse. Today, the Pyramid of Cestius stands as a quirky reminder that ancient Romans, too, loved trends — even importing entire architectural styles from abroad!'),
(2, 2, 'Colosseum', 'img/colosseum.jpg', 'The Colosseum, also known as the Flavian Amphitheatre, could hold up to 50,000–80,000 spectators, making it the largest ancient amphitheater ever built. It hosted gladiator battles, animal hunts, and even mock naval battles by flooding the arena! The Romans engineered a complex underground system called the hypogeum that lifted animals and scenery up through trapdoors — like ancient special effects.\r\n\r\nDespite being nearly 2,000 years old, the Colosseum’s design inspired modern stadium architecture. It had numbered entrances, tiered seating based on social class, and even retractable awnings (called velarium) to shade spectators from the sun. Think of it as the world\'s first sports arena with VIP boxes and crowd control!\r\n\r\nWhile it’s now partially ruined due to earthquakes and stone robbers, the Colosseum is one of Rome’s most iconic symbols. In 1749, Pope Benedict XIV declared it sacred because early Christians were believed to have been martyred there — though that’s debated by historians today.'),
(3, 2, 'Forum Romanum', 'img/fromanum.jpg', 'The Forum Romanum was the beating heart of ancient Rome — a bustling public square filled with temples, markets, and political speeches. It was the center of daily life where Romans gathered for everything from court trials to religious festivals. Picture a mix of Wall Street, Times Square, and a church plaza all rolled into one!\r\n\r\nJulius Caesar began reshaping the forum by building his own — the Forum of Caesar — and later emperors like Augustus and Trajan followed suit. Over centuries, layers of history piled up as new rulers added monuments and basilicas. Today, you can still walk through the ruins of the Temple of Saturn, Arch of Septimius Severus, and the House of the Vestal Virgins.\r\n\r\nIn medieval times, the Forum was so buried under debris that locals called it the \"cow field\" (Campo Vaccino). It wasn’t until the 18th and 19th centuries that major excavations revealed the treasure trove of ruins we see today — a time capsule of Rome’s glorious past.'),
(4, 2, 'Piazza Venezia', 'img/pvenetia.webp', 'Piazza Venezia sits at one of Rome’s busiest intersections, right where ancient and modern roads collide. It’s named after Palazzo Venezia, a Renaissance palace that once served as the embassy of the Republic of Venice — and later as Mussolini’s headquarters, where he gave fiery speeches from the balcony.\r\n\r\nThe square is dominated by the massive Altare della Patria (Altar of the Fatherland), also known as the Vittoriano, built in honor of King Victor Emmanuel II, the first king of a unified Italy. Locals often jokingly call it the “wedding cake” or the “typewriter” because of its grand, layered appearance.\r\n\r\nWhile the piazza is a modern traffic hub, it’s also a historic gateway — from here, you can reach the Roman Forum, Via del Corso, and Capitoline Hill. It’s one of those places where you can spin in a circle and see centuries of history in every direction.'),
(5, 3, 'Spanish Steps', 'img/spanish-steps.jpg', 'The Spanish Steps (Italian: Scalinata di Trinità dei Monti) are one of Rome’s most famous and photographed landmarks. Built between 1723 and 1725, the staircase connects the Piazza di Spagna at the bottom to the Trinità dei Monti church at the top. Despite the name, they were funded by a French diplomat — the “Spanish” part comes from the nearby Spanish Embassy to the Holy See.\r\n\r\nThere are exactly 135 steps, and for centuries they\'ve served as a popular meeting spot, especially for artists, poets, and travelers on the Grand Tour. In the 19th century, writers like John Keats and Lord Byron lived nearby — in fact, Keats\' final home is now a museum right next to the steps.\r\n\r\nToday, the steps are a favorite hangout for tourists and locals alike, especially during spring when they\'re beautifully decorated with vibrant azaleas. However, sitting on the steps is now banned, as part of Rome’s effort to preserve historic landmarks — so snap your photos, but stay on your feet!'),
(6, 4, 'Circus Maximus', 'img/circus.jpg', 'The Circus Maximus, an ancient Roman chariot-racing stadium, was a marvel of its time and remains a fascinating piece of history. It wasn\'t just big; it was colossal! Imagine a venue that could reportedly hold over 150,000 spectators, with some estimates soaring as high as 250,000 – that\'s more than many modern super-stadiums. For centuries, this was Rome\'s premier entertainment hub, with its origins stretching back to the 6th century BCE and hosting its last chariot race in 549 AD. That\'s over a thousand years of thundering hooves and roaring crowds!\r\n\r\nWhile famous for its heart-stopping chariot races – often featuring four-horse teams called quadrigas thundering around the long track for seven grueling laps – the Circus Maximus was a multi-purpose venue. It hosted public games, religious festivals, and triumphal processions. Interestingly, before the Colosseum took over as the primary site for such events, it even saw gladiatorial combats and wild animal hunts. Beneath its sprawling stands, there were also shops and workshops, making it a bustling hive of activity even when races weren\'t underway.\r\n\r\nToday, the once grand structure is largely a sprawling public park, its original track buried under centuries of earth. However, visitors can still grasp its immense scale and see remnants of its structure. Two magnificent Egyptian obelisks that once adorned the central barrier (the spina) of the Circus now stand proudly in other famous Roman piazzas: one in Piazza del Popolo and the other in Piazza di San Giovanni in Laterano. The area continues to be a gathering place, sometimes hosting large concerts and public events, a faint echo of its ancient role as Rome\'s greatest entertainment stage.'),
(7, 4, 'Palatine Hill', 'img/palatine.jpg', 'Palatine Hill is steeped in legend as the very birthplace of Rome. It\'s famously where the mythical twin brothers, Romulus and Remus, were said to have been found and suckled by a she-wolf in a cave called the Lupercal. While the she-wolf story is a legend, archaeologists have found evidence of huts dating back to the 9th century BC, around the traditional time of Rome\'s founding, showing that people have lived on this prominent hill for millennia, making it one of the most ancient parts of the city.\r\n\r\nOver time, Palatine Hill became the most desirable neighborhood in ancient Rome. During the Republic, many wealthy Romans built their homes there. Later, it became the exclusive domain of the Roman emperors. Emperor Augustus himself was born on the Palatine and chose to build his palace there, setting a trend for successive rulers. The hill became so synonymous with grand imperial residences that its Latin name, \"Palatium,\" is the origin of our modern word \"palace\"!\r\n\r\nToday, Palatine Hill is a vast open-air museum where you can wander among the impressive ruins of ancient imperial palaces, including the sprawling complexes of emperors like Domitian. You can explore the remains of the House of Augustus and the House of Livia, which still feature remarkably preserved frescoes. The site also offers breathtaking panoramic views over the Roman Forum on one side and the Circus Maximus on the other, truly connecting you to the heart of the ancient world.'),
(8, 5, 'Basilica di Santa Maria Maggiore', 'img/maggiore.jpg', 'This stunning Roman church is one of just four Major Papal Basilicas worldwide and the most important one dedicated to the Virgin Mary in the city. Its founding is linked to a charming legend: a miraculous snowfall in the summer of 352 AD supposedly outlined the church\'s dimensions, leading to its nickname \"Our Lady of the Snows.\"\r\n\r\nInside, visitors are treated to breathtaking artistic treasures. The Basilica boasts extensive 5th-century mosaics along its nave and on the triumphal arch, which are among the most ancient and impressive Christian artworks in Rome. Adding to its splendor, the gilded coffered ceiling is rumored to have been decorated with the first gold brought from the Americas.\r\n\r\nThe Basilica also safeguards precious relics, including wood fragments believed to be from the Holy Crib of Jesus Christ, housed in a crypt beneath the high altar. Remarkably, Santa Maria Maggiore is the only one of Rome\'s major basilicas to have retained the core of its original Early Christian structure, though with beautiful later additions.'),
(9, 6, 'Piazza Repubblica', 'img/reppublica.jpg', 'This grand Roman piazza has a direct link to ancient times, as its distinctive semi-circular shape follows the original outline of the massive exedra (a large, open-air apse) of the ancient Baths of Diocletian, the largest public baths in ancient Rome. For this reason, it was originally called Piazza Esedra, a name still sometimes used by locals. The grand colonnaded buildings that sweep around it were constructed in the late 19th century when Rome became the capital of unified Italy.\r\n\r\nAt the heart of the piazza thunders the magnificent Fontana delle Naiadi (Fountain of the Naiads). Unveiled in its current form in 1901, its four striking bronze sculptures of water nymphs – representing oceans, rivers, lakes, and underground waters – caused quite a scandal at the time due to their nudity! The central figure, Glaucus wrestling a fish, symbolizing humanity\'s triumph over nature, was added a decade later.\r\n\r\nInterestingly, the powerful jets of water that bring the Naiadi Fountain to life are fed by the Acqua Marcia, one of Rome\'s ancient aqueducts, which has been supplying the city with water since 144 BC and still functions today. The sculptor of the provocative naiads, Mario Rutelli, also has a notable family connection to modern Rome – he was the great-grandfather of Francesco Rutelli, who served as the Mayor of Rome in the 1990s.'),
(10, 4, 'Basilica dei Santi Giovanni e Paolo al Celio', 'img/giovanni.jpg', 'This ancient Roman basilica, perched on the Caelian Hill, is dedicated to Saints John and Paul, who were not the apostles but two officials of Constantine\'s daughter, martyred in their own home in the 4th century. The church itself was built over the site of their house as early as 398 AD, making it one of Rome\'s oldest. It\'s known for its serene atmosphere, somewhat hidden away from the main tourist trails.\r\n\r\nOne of the most fascinating aspects of this basilica lies hidden beneath its floors: an extraordinary complex of ancient Roman houses (the \"Case Romane del Celio\"). These incredibly well-preserved rooms, dating from the 1st to the 4th centuries AD, feature original frescoes, mosaics, and even a nymphaeum. Exploring this underground area offers a truly captivating glimpse into daily life in ancient Rome, right below the current church.\r\n\r\nThe Basilica of Santi Giovanni e Paolo also boasts a striking medieval bell tower (campanile) built in the Romanesque style, which is beautifully decorated with colorful ceramic tiles. The church\'s apse features impressive 13th-century frescoes, and its exterior, with a picturesque portico added later, leads to a quiet garden, making it a peaceful retreat with layers of history to discover.'),
(11, 2, 'Trajan\'s Column', 'img/trajan.jpg', 'Trajan\'s Column is a colossal victory monument completed in 113 AD to commemorate Roman Emperor Trajan\'s two successful campaigns in Dacia (modern-day Romania). Standing tall in what was once Trajan\'s Forum, this incredible marble structure is most famous for its continuous spiral frieze that winds 23 times around the shaft, like a giant ancient comic strip carved in stone, detailing the Roman army\'s incredible feats.\r\n\r\nThe intricate bas-relief frieze is a masterpiece of Roman art and a priceless historical document. If you could unroll it, it would stretch for about 200 meters (around 650 feet)! It vividly depicts over 2,500 figures, showcasing scenes of battles, marches, construction projects, and even the enemy, offering invaluable insights into Roman military tactics, equipment, and the Dacian people. Amazingly, Emperor Trajan himself appears multiple times.\r\n\r\nMore than just a story in stone, the column is an engineering marvel. It\'s composed of 20 massive Carrara marble drums, each weighing about 32 tons, and features a hollow interior with a spiral staircase of 185 steps leading to a viewing platform at the top. For centuries, a statue of Trajan crowned the column; though it was lost in the Middle Ages, the column’s base served as the emperor\'s tomb, housing his and his wife\'s ashes in golden urns.'),
(12, 6, 'Basilica di Santa Maria degli Angeli', 'img/maria.jpg', 'This extraordinary basilica boasts a truly unique origin story, as it was ingeniously designed by the legendary Michelangelo Buonarroti. He transformed the vast, ancient ruins of the tepidarium (the main central hall) of the colossal Baths of Diocletian, Rome\'s largest imperial bath complex, into a Christian church in the 16th century. Its unassuming brick exterior, which still resembles ancient Roman walls, cleverly preserves parts of the original bath structure.\r\n\r\nStep inside, and the immense scale of the interior often leaves visitors breathless, a stark contrast to its rugged facade. The basilica houses a remarkable astronomical instrument: a long bronze and marble meridian line set into the floor by Francesco Bianchini in 1702. This scientific marvel was used to accurately track the sun\'s position, verify the Gregorian calendar, and precisely determine the date of Easter.\r\n\r\nWithin its grand spaces, you\'ll find eight massive, original granite columns from the ancient Baths, incorporated seamlessly into Michelangelo\'s design. The church also features impressive artworks, tombs of notable Italian figures like World War I commanders, and striking modern bronze doors by sculptor Igor Mitoraj, depicting the Annunciation and the Resurrection, which were added in 2006.'),
(13, 7, 'Fontana del Tritone', 'img/tritone.jpg', 'This spectacular fountain, found in the center of Piazza Barberini, is one of Gian Lorenzo Bernini\'s most celebrated masterpieces, unveiled in 1643. Commissioned by his great patron Pope Urban VIII Barberini, it features a powerful, muscular Triton – a mythical merman son of Poseidon – dynamically perched on the tails of four dolphins, blowing a jet of water high into the air from a conch shell.\r\n\r\nEvery element of the Triton Fountain is rich with symbolism. The four dolphins supporting the open scallop shell upon which Triton sits not only add to the marine theme but also subtly lift the main figure. Between their tails, you can see the papal tiara with the crossed keys and the heraldic bees of the Barberini family, clearly marking this as a papal commission and a monument to the Pope\'s lineage and power.\r\n\r\nCrafted entirely from travertine stone, the fountain was a revolutionary design for its time, moving away from traditional basin-focused fountains to a more purely sculptural and dynamic composition. It was also a functional piece, designed to celebrate and distribute water from the Acqua Felice aqueduct, which Pope Urban VIII had recently restored, bringing much-needed water to this area of Rome.'),
(14, 7, 'Palazzo del Quirinale', 'img/quirinale.jpg', 'The Quirinale Palace, standing majestically on the highest of Rome\'s seven hills, is the official residence of the President of the Italian Republic. This sprawling complex is not just a home for the head of state but also a symbol of the Italian Republic itself. It\'s one of the largest palaces in the world by area, covering an impressive 110,500 square meters – making it significantly larger than the White House or Buckingham Palace!\r\n\r\nBefore becoming the President\'s home, the Quirinale Palace had a rich and varied history. Originally built in 1583 as a summer residence for Pope Gregory XIII, it served as a papal palace for centuries. After Rome became the capital of unified Italy in 1870, it was transformed into the official residence of the Kings of Italy until the monarchy was abolished in 1946, showcasing layers of Italian history within its walls.\r\n\r\nBeyond its grand facades and stately rooms, the Quirinale Palace boasts beautiful and extensive gardens, offering a tranquil oasis in the heart of bustling Rome. The piazza in front of the palace, Piazza del Quirinale, is itself famous for the impressive Fontana dei Dioscuri, featuring colossal ancient Roman statues of Castor and Pollux, the \"Horse Tamers,\" and an Egyptian obelisk, creating a dramatic entryway to this historic seat of power.'),
(15, 7, 'Pallazo Barberini', 'img/barberini.jpg', 'Palazzo Barberini is a magnificent example of Baroque architecture, built for the powerful Barberini family, most notably Pope Urban VIII, in the 17th century. This grand palace was intended to showcase the family\'s immense wealth and influence, and its construction involved some of the greatest architects of the era, resulting in a truly impressive residence that dominated its surroundings.\r\n\r\nA fascinating aspect of Palazzo Barberini\'s design is that it was a collaborative effort, with contributions from three architectural titans: Carlo Maderno, Francesco Borromini, and Gian Lorenzo Bernini. This \"dream team\" led to some unique features, including two spectacular and distinct grand staircases: a majestic, square-planned one by Bernini and an ingenious oval helicoidal one by Borromini, showcasing their differing artistic visions.\r\n\r\nToday, Palazzo Barberini serves as one of the two seats of the Gallerie Nazionali d\'Arte Antica, Italy\'s National Gallery of Ancient Art. Visitors can wander through its opulent rooms to admire an incredible collection of masterpieces, including works by Raphael, Caravaggio, and Holbein. A highlight is the breathtaking ceiling fresco, \"The Triumph of Divine Providence,\" by Pietro da Cortona in the main salon, a crowning achievement of Baroque illusionistic painting.'),
(16, 7, 'Fontana di Trevi', 'img/trevi.jpg', 'The Trevi Fountain is the largest Baroque fountain in Rome and arguably the most famous fountain in the world, standing an impressive 26.3 meters (86 feet) high and 49.15 meters (161.3 feet) wide. Designed primarily by Nicola Salvi, though completed by Giuseppe Pannini and others after Salvi\'s death, its construction spanned three decades, from 1732 to 1762, against the grand backdrop of Palazzo Poli.\r\n\r\nOne of the most beloved traditions associated with the Trevi Fountain is tossing a coin over your shoulder into its waters. Legend has it that throwing one coin ensures your return to Rome, a second coin leads to a new romance, and a third leads to marriage. This charming custom results in an astonishing amount of money – often over a million euros – being collected from the fountain each year, which is then used to support charitable causes.\r\n\r\nThe dramatic centerpiece of the fountain is the powerful figure of Oceanus, the divine personification of the sea, majestically riding a shell-shaped chariot pulled by sea horses (one wild, one calm, representing the moods of the sea) and guided by Tritons. The fountain itself marks the terminal point of the ancient Acqua Vergine (Aqua Virgo), an aqueduct constructed in 19 BC, which still supplies it with water today.'),
(17, 8, 'Piazza del Popolo', 'img/popolo.jpg', 'Piazza del Popolo, meaning \"People\'s Square,\" has served as a grand ceremonial entrance to Rome since ancient times, as it was the starting point of the Via Flaminia, the main road leading north from the city. Its name might also derive from the poplar trees that once grew near the original church of Santa Maria del Popolo, which stands at the piazza\'s northern edge and houses artistic treasures by Caravaggio and Bernini.\r\n\r\nDominating the center of the vast oval piazza is the impressive Flaminian Obelisk, an authentic Egyptian obelisk dating back to the 13th century BC, brought to Rome by Emperor Augustus. This ancient monolith, one of the tallest and oldest in Rome, originally stood in the Circus Maximus before being moved to its current location in 1589 by architect Domenico Fontana, becoming a pivotal point in the urban redesign of Rome.\r\n\r\nThe piazza\'s current elegant neoclassical layout was designed by architect Giuseppe Valadier in the early 19th century. He created the symmetrical arrangement featuring the famous \"twin churches\" of Santa Maria dei Miracoli and Santa Maria in Montesanto, which guard the entrance to the Via del Corso. The piazza is also beautifully framed by fountains, including the Fountain of Neptune and the Fountain of the Goddess Roma, and offers a stunning vista up towards the Pincio Terrace.'),
(18, 8, 'Villa Borghese', 'img/borghese.jpg', 'Villa Borghese is one of Rome\'s largest and most beloved public parks, originally the private estate of the wealthy Cardinal Scipione Borghese in the 17th century. He transformed a former vineyard into magnificent pleasure gardens surrounding his villa, filling them with art and ancient sculptures. The Italian state acquired the gardens and the villa in 1903, opening them to the public for everyone to enjoy.\r\n\r\nThe gardens are not just about greenery; they are a cultural treasure trove. Within its grounds lies the renowned Galleria Borghese, home to masterpieces by Bernini and Caravaggio. A picturesque man-made lake features a charming ionic temple dedicated to Aesculapius, the god of healing, which you can reach by rowboat, offering a tranquil escape.\r\n\r\nSprawling over 80 hectares (about 197 acres), the Villa Borghese gardens offer a delightful mix of formal Italian garden styles and more naturalistic English landscapes. Visitors can also find Rome\'s Bioparco (zoo), various smaller museums, fountains, numerous sculptures, a replica of Shakespeare\'s Globe Theatre, and enjoy activities like cycling, or simply relaxing by its scenic spots like the Pincio Terrace which offers stunning views over Piazza del Popolo and the city.'),
(19, 9, 'Castel Sant\'Angelo', 'img/angelo.jpg', 'Castel Sant\'Angelo\'s imposing cylindrical structure wasn\'t originally built as a castle. It was first constructed between 135 and 139 AD as a mausoleum for the Roman Emperor Hadrian and his family. Its massive circular design and strategic location along the Tiber River made it an easily defensible structure, setting the stage for its future military and papal roles.\r\n\r\nOver its nearly two-thousand-year history, Castel Sant\'Angelo has undergone incredible transformations. From an imperial tomb, it evolved into a fortified papal residence, a formidable fortress, a notorious prison (housing figures like Giordano Bruno and Benvenuto Cellini), and even military barracks. A fortified corridor, the \"Passetto di Borgo,\" famously connects it directly to Vatican City, serving as an escape route for Popes in times of danger.\r\n\r\nThe castle gets its current name from a legendary event. In 590 AD, during a devastating plague, Pope Gregory the Great reportedly saw a vision of the Archangel Michael sheathing his sword atop the mausoleum, signifying the end of the pestilence. To commemorate this, a chapel was built, and later, the bronze statue of the angel that now crowns the fortress was added, giving it the name \"Castle of the Holy Angel.\"'),
(20, 9, 'Piazza Navona', 'img/navona.jpg', 'Piazza Navona boasts one of the most unique shapes for a Roman piazza – a long, elegant oval. This distinctive form isn\'t a coincidence; it perfectly preserves the outline of the ancient Stadium of Domitian, built in the 1st century AD, where Romans gathered to watch athletic contests (agones). In fact, the piazza\'s name is believed to have evolved from \"in agone\" to \"navone\" and finally \"Navona.\"\r\n\r\nThe piazza is a true masterpiece of Baroque art, famously adorned with three magnificent fountains. The central and most spectacular is Gian Lorenzo Bernini\'s Fontana dei Quattro Fiumi (Fountain of the Four Rivers), representing the Nile, Ganges, Danube, and Río de la Plata. The dynamic sculptures and towering obelisk create an unforgettable centerpiece, showcasing Bernini\'s theatrical genius.\r\n\r\nFacing Bernini\'s fountain is the impressive church of Sant\'Agnese in Agone, designed by his rival Francesco Borromini, adding to the piazza\'s dramatic architectural ensemble. For centuries, Piazza Navona was also known for a peculiar summer tradition: from the 17th to the 19th century, the piazza would be deliberately flooded on weekends, and aristocrats would splash around in their carriages for amusement. Today, it\'s a lively hub filled with street artists, portraitists, cafes, and a vibrant atmosphere.'),
(21, 9, 'Pantheon', 'img/pantheon.jpg', 'The Pantheon is one of the best-preserved ancient Roman buildings, standing for nearly two thousand years. Originally built as a temple to all Roman gods by Marcus Agrippa around 27 BC, the structure we see today was largely rebuilt by Emperor Hadrian around 126 AD. Its most breathtaking feature is its massive, unreinforced concrete dome with a central opening called the oculus, which remains the largest of its kind ever built and is open to the sky.\r\n\r\nThis architectural marvel has survived so intact largely because it was converted into a Christian church in 609 AD, dedicated to St. Mary and the Martyrs (Santa Maria ad Martyres). This consecration saved it from the abandonment and pillaging that befell many other ancient Roman structures. Rain and light still dramatically enter through the oculus, moving across the vast interior throughout the day, creating a unique and spiritual atmosphere.\r\n\r\nThe Pantheon is not only a church but also a prestigious burial site. Among the famous figures interred here are the Renaissance master painter Raphael, whose tomb is a significant draw for art lovers, and two Italian kings, Vittorio Emanuele II and Umberto I. The engineering of its dome, with its decreasing thickness and use of lighter aggregate materials towards the top, showcases the incredible ingenuity of Roman builders.'),
(22, 10, 'Vatican Museums', 'img/museum.jpg', 'The Vatican Museums, a world-renowned complex within Vatican City, trace their origins back to Pope Julius II in the early 16th century, who exhibited a collection of classical sculptures. Today, they have grown into one of the largest museum complexes globally, with a visitor route that can stretch for an astounding 7 kilometers (about 4.3 miles), showcasing an immense array of art and artifacts gathered over centuries.\r\n\r\nVisitors can immerse themselves in masterpieces such as the Raphael Rooms, a suite of four rooms painted with stunning frescoes by Raphael and his workshop, depicting historical and religious scenes with incredible artistry. Another major highlight is the Pio-Clementino Museum, celebrated for its exceptional collection of ancient Greek and Roman sculptures, including iconic works like the \"Laocoön and His Sons.\"\r\n\r\nAn architectural marvel within the Vatican Museums is the famous double spiral staircase designed by Giuseppe Momo in 1932, which serves as a grand exit and is one of the most photographed staircases worldwide; it was inspired by an earlier original Bramante Staircase from 1505. The sheer volume of the collections is also staggering, with tens of thousands of works on display and many more in storage.'),
(23, 10, 'Sistine Chapel', 'img/sistine.jpeg', 'he Sistine Chapel, located within the Apostolic Palace in Vatican City, is renowned worldwide, yet its primary function is deeply significant: it\'s the official site where new popes are elected during a papal conclave. Built between 1473 and 1481 under the commission of Pope Sixtus IV, after whom it is named (\"Cappella Sistina\" in Italian), its relatively plain exterior gives little hint of the artistic wonders held within.\r\n\r\nMichelangelo\'s breathtaking ceiling frescoes are the chapel\'s most famous feature, a monumental task he undertook between 1508 and 1512. Working on scaffolding high above the chapel floor, he painted nine central scenes from the Book of Genesis, including the iconic \"Creation of Adam.\" This vast work covers over 500 square meters and features more than 300 figures, revolutionizing the course of Western art.\r\n\r\nYears later, between 1536 and 1541, Michelangelo returned to the Sistine Chapel to paint another masterpiece, \"The Last Judgment,\" on the entire altar wall. This powerful and dramatic fresco depicts the second coming of Christ and the fate of souls. While Michelangelo\'s works dominate, the chapel\'s side walls are also adorned with beautiful frescoes by earlier Renaissance masters like Botticelli, Perugino, and Ghirlandaio, depicting scenes from the lives of Moses and Christ.'),
(24, 10, 'Basilica di San Pietro', 'img/peter.jpg', 'St. Peter\'s Basilica is one of the most revered shrines in Christianity, believed to be built upon the burial site of Saint Peter, one of Jesus\'s apostles and the first Pope. This sacred location has drawn pilgrims for centuries, making the basilica a spiritual heart for Roman Catholics worldwide. The current magnificent structure replaced an earlier basilica built by Emperor Constantine in the 4th century.\r\n\r\nThe sheer scale of St. Peter\'s Basilica is awe-inspiring; it\'s one of the largest churches in the world. Its construction spanned over a century, involving many of Italy\'s greatest Renaissance and Baroque architects, including Bramante, Raphael, and most notably Michelangelo, who designed its iconic dome. Carlo Maderno later extended the nave and designed the grand facade, while Gian Lorenzo Bernini created the magnificent St. Peter\'s Square and many stunning interior features.\r\n\r\nInside, the basilica houses countless artistic masterpieces. Among the most famous is Michelangelo\'s \"Pietà,\" a stunning sculpture depicting Mary holding the body of Christ, carved when he was only in his early twenties. Bernini\'s colossal bronze baldachin over the main altar and his \"Cathedra Petri\" (Throne of St. Peter) in the apse are other breathtaking highlights. The basilica is also the principal venue for major papal liturgies and ceremonies.'),
(25, 11, 'Termini', 'img/termini.jpg', 'Roma Termini is not just a train station; it\'s an enormous transportation artery and a city within a city. It\'s the largest railway station in Italy and one of the busiest in all of Europe, handling hundreds of thousands of passengers every day. Its name, \"Termini,\" comes from its proximity to the ancient Baths of Diocletian – \"thermae\" in Latin – a massive Roman public bath complex whose ruins are still visible nearby.\r\n\r\nThe station is renowned for its distinctive modernist architecture, especially its massive, curving concrete roof of the main passenger hall, nicknamed \"the Dinosaur\" by many Romans due to its shape. While initial designs began before World War II, the current iconic structure was largely completed in the post-war era, with the final design for the front building realized by architects Eugenio Montuori and Leo Calini, inaugurated for the 1950 Jubilee.\r\n\r\nBeyond serving national and international train lines, Termini is a critical interchange for Rome\'s public transport, with two metro lines (A and B) crossing beneath it and a major bus station just outside. The station complex also houses a vast underground shopping mall with hundreds of shops, restaurants, and services, making it a bustling commercial center as well as a gateway to and from the Eternal City.');

-- --------------------------------------------------------

--
-- Table structure for table `metro_lines`
--

CREATE TABLE `metro_lines` (
  `id` int(11) NOT NULL,
  `metro_line` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metro_lines`
--

INSERT INTO `metro_lines` (`id`, `metro_line`) VALUES
(1, 'A'),
(4, 'AB'),
(2, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `metro_stations`
--

CREATE TABLE `metro_stations` (
  `id` int(11) NOT NULL,
  `metro_line_id` int(11) NOT NULL,
  `metro_station` varchar(25) NOT NULL,
  `display_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metro_stations`
--

INSERT INTO `metro_stations` (`id`, `metro_line_id`, `metro_station`, `display_order`) VALUES
(1, 2, 'Piramide', 11),
(2, 2, 'Colosseo', 9),
(3, 1, 'Spagna', 4),
(4, 2, 'Circo Massimo', 10),
(5, 2, 'Cavour', 8),
(6, 1, 'Repubblica', 6),
(7, 1, 'Barberini', 5),
(8, 1, 'Flaminio', 3),
(9, 1, 'Lepanto', 2),
(10, 1, 'Ottaviano', 1),
(11, 4, 'Termini', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `attractions`
--
ALTER TABLE `attractions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `metro_station_id` (`metro_station_id`);

--
-- Indexes for table `metro_lines`
--
ALTER TABLE `metro_lines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `metro_line` (`metro_line`);

--
-- Indexes for table `metro_stations`
--
ALTER TABLE `metro_stations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `metro_line_id` (`metro_line_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attractions`
--
ALTER TABLE `attractions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `metro_lines`
--
ALTER TABLE `metro_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `metro_stations`
--
ALTER TABLE `metro_stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attractions`
--
ALTER TABLE `attractions`
  ADD CONSTRAINT `attractions_ibfk_1` FOREIGN KEY (`metro_station_id`) REFERENCES `metro_stations` (`id`);

--
-- Constraints for table `metro_stations`
--
ALTER TABLE `metro_stations`
  ADD CONSTRAINT `metro_stations_ibfk_1` FOREIGN KEY (`metro_line_id`) REFERENCES `metro_lines` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
