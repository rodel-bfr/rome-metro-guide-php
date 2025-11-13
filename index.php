<?php
// Include all the PHP logic and data fetching
include 'index_logic.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rome Tour Guide by Metro<?php echo $is_station_selected_for_title ? ' - ' . htmlspecialchars($selected_station_name_for_title) : ''; ?></title>
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="page-scroll-wrapper">
        <nav class="main-navbar">
            <div class="navbar-container">
                <a href="index.php" class="navbar-brand">Rome by Metro</a>
                <input type="checkbox" id="navbar-toggle-checkbox" class="navbar-toggle-checkbox">
                <label for="navbar-toggle-checkbox" class="navbar-toggle-label">
                    <span class="hamburger-icon"></span>
                </label>
                <ul class="navbar-links">
                    <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' && !isset($_GET['station_id']) && !isset($_GET['attraction_action']) ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="admin.php">Admin</a></li>
                </ul>
            </div>
        </nav>

        <div class="page-container">
            <header class="page-header">
                <h1>Explore Rome's Wonders via Metro</h1>
            </header>
            <div class="content-panels-wrapper">
                <div class="panel panel-chooser" style="background-image: url('img/metro.jpg');">
                    <div class="panel-header-text">
                        <h2>Plan Your Trip</h2>
                        <p>Choose your starting metro station for your city break. This guide is perfect for one or two days of exploration in Rome using the metro.</p>
                    </div>
                    <div class="panel-content">
                        <?php // ---- START OF SIMPLIFIED STATION CHOOSER ---- ?>
                        <div class="simplified-station-chooser">
                            <?php if (empty($line_a_stations) && empty($termini_station) && empty($line_b_stations)): ?>
                                <p class="no-stations-message">No metro stations available to display.</p>
                            <?php else: ?>
                                <?php if (!empty($line_a_stations)): ?>
                                <div class="station-line-section">
                                    <h3 class="line-heading line-a-heading">Line A</h3>
                                    <div class="station-list">
                                        <?php foreach ($line_a_stations as $station_item): ?>
                                            <?php $is_active = ($current_selected_station_id == $station_item['id']); ?>
                                            <a href="index.php?station_id=<?php echo $station_item['id']; ?>"
                                                class="simple-station-button line-a <?php echo $is_active ? 'active-station-link' : ''; ?>">
                                                <?php echo htmlspecialchars($station_item['metro_station']); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($termini_station): ?>
                                <div class="station-line-section">
                                    <h3 class="line-heading termini-heading">Termini</h3>
                                    <div class="station-list">
                                        <?php $is_active = ($current_selected_station_id == $termini_station['id']); ?>
                                        <a href="index.php?station_id=<?php echo $termini_station['id']; ?>"
                                            class="simple-station-button termini <?php echo $is_active ? 'active-station-link' : ''; ?>">
                                            <?php echo htmlspecialchars($termini_station['metro_station']); ?>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if (!empty($line_b_stations)): ?>
                                <div class="station-line-section">
                                    <h3 class="line-heading line-b-heading">Line B</h3>
                                    <div class="station-list">
                                        <?php foreach ($line_b_stations as $station_item): ?>
                                            <?php $is_active = ($current_selected_station_id == $station_item['id']); ?>
                                            <a href="index.php?station_id=<?php echo $station_item['id']; ?>"
                                                class="simple-station-button line-b <?php echo $is_active ? 'active-station-link' : ''; ?>">
                                                <?php echo htmlspecialchars($station_item['metro_station']); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php // ---- END OF SIMPLIFIED STATION CHOOSER ---- ?>
                    </div>
                </div>
                <div class="panel panel-attractions-info <?php echo isset($current_selected_station_id) ? 'attractions-active' : ''; ?>">
                    <?php if (!isset($current_selected_station_id)): ?>
                        <div class="site-info-box" style="background-image: url('img/rome.webp');">
                            <div class="site-info-content">
                                <h2>Welcome to Your Rome Metro Adventure!</h2>
                                <p>This guide is your perfect companion for planning a 1 or 2-day city break in captivating Rome.</p>
                                <p>Discover the "Eternal City" with ease using the metro – the most convenient and cost-efficient way to visit Rome's incredible array of museums, historical sites, and hidden gems.</p>
                                <p><strong>To start, select a metro station from the interactive panel.</strong></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <h2 class="attractions-title">Attractions near <?php echo htmlspecialchars($selected_station_name_for_title); ?></h2>
                        <?php if ($num_attractions > 0): ?>
                            <div class="carousel-wrapper">
                                <section class="carousel <?php if ($num_attractions <= 1) echo 'single-slide'; ?>" aria-label="Attraction Gallery">
                                    <ol class="carousel__viewport">
                                        <?php foreach ($attractions as $index_att => $attraction_item): ?>
                                        <?php
                                        $slide_id_num = $index_att + 1;
                                        $prev_slide_id_num = ($index_att === 0) ? $num_attractions : $slide_id_num - 1;
                                        $next_slide_id_num = ($index_att === $num_attractions - 1) ? 1 : $slide_id_num + 1;
                                        ?>
                                        <li id="carousel__slide<?php echo $slide_id_num; ?>" tabindex="0" class="carousel__slide">
                                            <div class="attraction-slide-content" style="background-image: url('<?php echo htmlspecialchars($attraction_item['attraction_image']); ?>');">
                                                <input type="checkbox" id="toggle-attraction-<?php echo $attraction_item['id']; ?>-s<?php echo $index_att; ?>" class="facts-toggle" />
                                                <div class="facts-slider">
                                                    <label class="facts-header" for="toggle-attraction-<?php echo $attraction_item['id']; ?>-s<?php echo $index_att; ?>">
                                                        <h3><?php echo htmlspecialchars($attraction_item['attraction_name']); ?></h3>
                                                        <img src="img/caret.svg" alt="Toggle details" class="caret-icon" />
                                                    </label>
                                                    <div class="facts-text">
                                                        <?php echo nl2br(htmlspecialchars($attraction_item['attraction_description'])); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="carousel__snapper"></div>
                                            <?php if ($num_attractions > 1): ?>
                                            <a href="#carousel__slide<?php echo $prev_slide_id_num; ?>" class="carousel__prev" aria-label="Previous slide"></a>
                                            <a href="#carousel__slide<?php echo $next_slide_id_num; ?>" class="carousel__next" aria-label="Next slide"></a>
                                            <?php endif; ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ol>
                                    <?php if ($num_attractions > 1): ?>
                                    <aside class="carousel__navigation">
                                        <ol class="carousel__navigation-list">
                                            <?php foreach ($attractions as $index_nav => $attraction_nav_item): ?>
                                            <li class="carousel__navigation-item">
                                                <a href="#carousel__slide<?php echo $index_nav + 1; ?>" class="carousel__navigation-button" aria-label="Go to slide <?php echo $index_nav + 1; ?>"></a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ol>
                                    </aside>
                                    <?php endif; ?>
                                </section>
                            </div>
                        <?php else: ?>
                            <p class="no-attractions-message">No attractions found for <?php echo htmlspecialchars($selected_station_name_for_title); ?>. Try selecting another station!</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <footer class="site-footer">
            <div class="footer-content">
                <p>Created by Francisc Rodel Burai</p>
                <p>Email: <a href="mailto:rodel.f.burai@gmail.com">rodel.f.burai@gmail.com</a></p>
                <p>&copy; <?php echo date("Y"); ?> Rome Tour Guide by Metro. All rights reserved.</p>
            </div>
        </footer>
    </div>
<?php
if (isset($cnx) && $cnx instanceof mysqli) {
    mysqli_close($cnx);
}
?>
</body>
</html>