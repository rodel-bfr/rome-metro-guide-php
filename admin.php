<?php
session_start();

include 'connection.php';

$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$is_admin_logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

$page_title_main = 'Admin Login';
$panel_title = 'Admin Login';

$form_data = $_SESSION['form_data'] ?? [];
if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']);

$metro_stations_for_dropdown = [];
if ($is_admin_logged_in) {
    $sql_ms = "SELECT id, metro_station FROM metro_stations ORDER BY metro_station ASC";
    $result_ms = mysqli_query($cnx, $sql_ms);
    if ($result_ms) {
        while ($row_ms = mysqli_fetch_assoc($result_ms)) {
            $metro_stations_for_dropdown[] = $row_ms;
        }
    }
}

$attraction_action = 'login'; // Default if not logged in

if ($is_admin_logged_in) {
    $page_title_main = 'Manage Attractions';
    $attraction_action = $_GET['attraction_action'] ?? 'view';

    // Determine panel title based on attraction_action
    if ($attraction_action === 'view') $panel_title = 'Attractions List';
    elseif ($attraction_action === 'add_form') $panel_title = 'Add New Attraction';
    elseif ($attraction_action === 'edit_form' && isset($_GET['id'])) $panel_title = 'Edit Attraction';
    elseif ($attraction_action === 'confirm_delete' && isset($_GET['id'])) $panel_title = 'Confirm Delete Attraction';
    else { // Fallback to view for unknown actions when logged in
        $attraction_action = 'view';
        $panel_title = 'Attractions List';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($page_title_main); ?> - Rome Tour Guide by Metro</title>
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="admin.php" class="active">Admin</a></li>
                    <?php if ($is_admin_logged_in): ?>
                        <li><a href="logout.php" class="navbar-logout-button">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <div class="page-container">
            <header class="page-header">
                <h1><?php echo htmlspecialchars($page_title_main); ?></h1>
            </header>
            <div class="content-panels-wrapper">
                <div class="panel admin-panel">
                    <div class="panel-header-text">
                            <h2><?php echo htmlspecialchars($panel_title); ?></h2>
                    </div>
                    <div class="panel-content">
                        <?php if ($message): ?>
                            <p class="message <?php echo (strpos(strtolower($message), 'error') !== false || strpos(strtolower($message), 'failed') !== false || strpos(strtolower($message), 'invalid') !== false) ? 'error-message' : 'success-message'; ?>">
                                <?php echo htmlspecialchars($message); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($is_admin_logged_in): ?>
                            <div class="admin-actions-bar admin-tabs-bar">
                                <a href="admin.php?attraction_action=view" class="admin-button view-list-button <?php echo ($attraction_action === 'view' || $attraction_action === 'edit_form' || $attraction_action === 'confirm_delete') ? 'active' : ''; ?>">View Attractions List</a>
                                <a href="admin.php?attraction_action=add_form" class="admin-button add-new-button <?php echo ($attraction_action === 'add_form') ? 'active' : ''; ?>">Add New Attraction</a>
                            </div>
                            <hr class="admin-hr">

                            <?php
                            if ($attraction_action === 'view') {
                                // MODIFIED SQL Query for sorting
                                $sql_attractions_list_query = "SELECT a.id, a.attraction_name, a.attraction_image, ms.metro_station
                                                                FROM attractions a
                                                                LEFT JOIN metro_stations ms ON a.metro_station_id = ms.id
                                                                ORDER BY ms.metro_station ASC, a.attraction_name ASC"; // Changed ORDER BY
                                $result_attractions_list_data = mysqli_query($cnx, $sql_attractions_list_query);

                                if ($result_attractions_list_data && mysqli_num_rows($result_attractions_list_data) > 0) {
                                    echo '<div class="admin-table-wrapper">';
                                    echo '<table class="admin-table">';
                                    // MODIFIED Table Header: Removed ID column
                                    echo '<thead><tr><th>Image</th><th>Attraction Name</th><th>Metro Station</th><th>Actions</th></tr></thead>';
                                    echo '<tbody>';
                                    while ($attraction_item_data = mysqli_fetch_assoc($result_attractions_list_data)) {
                                        echo '<tr>';
                                        // MODIFIED Table Data: Removed ID cell
                                        // echo '<td>' . htmlspecialchars($attraction_item_data['id']) . '</td>'; // ID column removed from display
                                        echo '<td><img src="' . htmlspecialchars($attraction_item_data['attraction_image']) . '" alt="' . htmlspecialchars($attraction_item_data['attraction_name']) . '" class="admin-table-img"></td>';
                                        echo '<td>' . htmlspecialchars($attraction_item_data['attraction_name']) . '</td>';
                                        echo '<td>' . htmlspecialchars($attraction_item_data['metro_station'] ?? 'N/A') . '</td>';
                                        echo '<td>';
                                        echo '<a href="admin.php?attraction_action=edit_form&id=' . $attraction_item_data['id'] . '" class="admin-action-link edit">Edit</a> ';
                                        echo '<a href="admin.php?attraction_action=confirm_delete&id=' . $attraction_item_data['id'] . '" class="admin-action-link delete">Delete</a>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody></table>';
                                    echo '</div>';
                                } else {
                                    echo "<p>No attractions found. You can add one using the button above.</p>";
                                }
                            } elseif ($attraction_action === 'add_form') {
                                ?>
                                <form action="admin_actions.php" method="POST" class="admin-form">
                                    <input type="hidden" name="action" value="add_attraction">
                                    <div class="form-group"><label for="attraction_name_add">Attraction Name:</label><input type="text" id="attraction_name_add" name="attraction_name" required value="<?php echo htmlspecialchars($form_data['attraction_name'] ?? ''); ?>"></div>
                                    <div class="form-group"><label for="attraction_description_add">Description:</label><textarea id="attraction_description_add" name="attraction_description" rows="5" required><?php echo htmlspecialchars($form_data['attraction_description'] ?? ''); ?></textarea></div>
                                    <div class="form-group"><label for="attraction_image_add">Image Path/URL:</label><input type="text" id="attraction_image_add" name="attraction_image" required value="<?php echo htmlspecialchars($form_data['attraction_image'] ?? ''); ?>" placeholder="img/image.jpg or http://..."></div>
                                    <div class="form-group"><label for="metro_station_id_add_attr">Metro Station:</label><select id="metro_station_id_add_attr" name="metro_station_id" required><option value="">-- Select Metro Station --</option><?php foreach ($metro_stations_for_dropdown as $station_item_select): ?><option value="<?php echo $station_item_select['id']; ?>" <?php echo (($form_data['metro_station_id'] ?? '') == $station_item_select['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($station_item_select['metro_station']); ?></option><?php endforeach; ?></select></div>
                                    <div class="form-actions">
                                        <button type="submit" class="admin-button">Add Attraction</button>
                                        <a href="admin.php?attraction_action=view" class="admin-button secondary">Cancel</a>
                                    </div>
                                </form>
                                <?php
                            } elseif ($attraction_action === 'edit_form' && isset($_GET['id'])) {
                                $attraction_id_to_edit = (int)$_GET['id'];
                                $attraction_to_edit_data = null;
                                $stmt_att_fetch_edit = mysqli_prepare($cnx, "SELECT * FROM attractions WHERE id = ?");
                                if ($stmt_att_fetch_edit) { mysqli_stmt_bind_param($stmt_att_fetch_edit, "i", $attraction_id_to_edit); mysqli_stmt_execute($stmt_att_fetch_edit); $result_att_fetch_edit = mysqli_stmt_get_result($stmt_att_fetch_edit); $attraction_to_edit_data = mysqli_fetch_assoc($result_att_fetch_edit); mysqli_stmt_close($stmt_att_fetch_edit); }
                                if ($attraction_to_edit_data) { ?>
                                <form action="admin_actions.php" method="POST" class="admin-form">
                                    <input type="hidden" name="action" value="edit_attraction">
                                    <input type="hidden" name="attraction_id" value="<?php echo $attraction_id_to_edit; ?>">
                                    <div class="form-group"><label for="attraction_name_edit">Attraction Name:</label><input type="text" id="attraction_name_edit" name="attraction_name" required value="<?php echo htmlspecialchars($form_data['attraction_name'] ?? $attraction_to_edit_data['attraction_name']); ?>"></div>
                                    <div class="form-group"><label for="attraction_description_edit">Description:</label><textarea id="attraction_description_edit" name="attraction_description" rows="5" required><?php echo htmlspecialchars($form_data['attraction_description'] ?? $attraction_to_edit_data['attraction_description']); ?></textarea></div>
                                    <div class="form-group"><label for="attraction_image_edit">Image Path/URL:</label><input type="text" id="attraction_image_edit" name="attraction_image" required value="<?php echo htmlspecialchars($form_data['attraction_image'] ?? $attraction_to_edit_data['attraction_image']); ?>"></div>
                                    <div class="form-group"><label for="metro_station_id_edit_attr">Metro Station:</label><select id="metro_station_id_edit_attr" name="metro_station_id" required><option value="">-- Select Metro Station --</option><?php foreach ($metro_stations_for_dropdown as $station_item_select_edit): ?><option value="<?php echo $station_item_select_edit['id']; ?>" <?php echo (($form_data['metro_station_id'] ?? $attraction_to_edit_data['metro_station_id']) == $station_item_select_edit['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($station_item_select_edit['metro_station']); ?></option><?php endforeach; ?></select></div>
                                    <div class="form-actions">
                                        <button type="submit" class="admin-button">Update Attraction</button>
                                        <a href="admin.php?attraction_action=view" class="admin-button secondary">Cancel</a>
                                    </div>
                                </form>
                                <?php } else { echo "<p class='error-message'>Error: Attraction not found for editing.</p>"; echo '<a href="admin.php?attraction_action=view" class="admin-button secondary">&laquo; Back to List</a>'; }
                            } elseif ($attraction_action === 'confirm_delete' && isset($_GET['id'])) {
                                $attraction_id_to_delete = (int)$_GET['id']; $attraction_name_to_delete_display = 'Attraction ID: ' . $attraction_id_to_delete;
                                $stmt_att_confirm_del = mysqli_prepare($cnx, "SELECT attraction_name FROM attractions WHERE id = ?"); if ($stmt_att_confirm_del) { mysqli_stmt_bind_param($stmt_att_confirm_del, "i", $attraction_id_to_delete); mysqli_stmt_execute($stmt_att_confirm_del); $result_att_confirm_del = mysqli_stmt_get_result($stmt_att_confirm_del); if ($attraction_to_delete_data_confirm = mysqli_fetch_assoc($result_att_confirm_del)) { $attraction_name_to_delete_display = htmlspecialchars($attraction_to_delete_data_confirm['attraction_name']); } mysqli_stmt_close($stmt_att_confirm_del); }
                                echo "<p>Are you sure you want to delete the attraction: <strong>" . $attraction_name_to_delete_display . "</strong>? This action cannot be undone.</p>";
                                echo '<form action="admin_actions.php" method="POST" style="display:inline-block; margin-right: 10px;"><input type="hidden" name="action" value="delete_attraction"><input type="hidden" name="attraction_id" value="' . $attraction_id_to_delete . '"><button type="submit" class="admin-button delete-confirm-button">Yes, Delete</button></form>';
                                echo '<a href="admin.php?attraction_action=view" class="admin-button secondary">No, Cancel</a>';
                            }
                            ?>
                        <?php else: ?>
                            <?php
                            $login_error_display = ''; if (isset($_SESSION['login_error'])) { $login_error_display = $_SESSION['login_error']; unset($_SESSION['login_error']); } elseif ($message && (strpos(strtolower($message), 'error') !== false)) { $login_error_display = $message; }
                            if ($login_error_display): ?><p class="error-message"><?php echo htmlspecialchars($login_error_display); ?></p><?php endif; ?>
                            <form action="login_process.php" method="post" class="login-form"><div class="form-group"><label for="username">Username:</label><input type="text" id="username" name="username" required></div><div class="form-group"><label for="password">Password:</label><input type="password" id="password" name="password" required></div><button type="submit" class="admin-button login-button">Login</button></form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <footer class="site-footer">
            <div class="footer-content">
                <p>Created by Francisc Rodel Burai</p>
                <p>Email: <a href="mailto:rodel.f.burai@gmail.com">rodel.f.burai@gmail.com</a></p>
                <p>&copy; <?php echo date("Y"); ?> Rome Metro Guide. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>