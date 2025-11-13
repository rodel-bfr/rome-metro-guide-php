<?php
session_start();
include 'connection.php'; // $cnx should be established here

// Function to close the database connection
function close_database_connection() {
    global $cnx; // Make $cnx available within this function
    // Check if $cnx is a valid, open mysqli connection before trying to close
    if ($cnx instanceof mysqli && $cnx->thread_id) {
        mysqli_close($cnx);
        // For debugging, you could output a comment:
        // echo "";
    }
}

// Register the function to be called on script shutdown
register_shutdown_function('close_database_connection');

// Ensure only logged-in admins can access this
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    $_SESSION['message'] = "Error: Access denied. Please log in.";
    header("Location: admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    // --- ATTRACTION ACTIONS ---
    if ($action === 'add_attraction') {
        $attraction_name = trim($_POST['attraction_name'] ?? '');
        $attraction_description = trim($_POST['attraction_description'] ?? '');
        $attraction_image = trim($_POST['attraction_image'] ?? '');
        $metro_station_id = (int)($_POST['metro_station_id'] ?? 0);

        if (empty($attraction_name) || empty($attraction_description) || empty($attraction_image) || $metro_station_id <= 0) {
            $_SESSION['message'] = "Error: All fields are required for adding an attraction.";
            $_SESSION['form_data'] = $_POST; 
            header("Location: admin.php?attraction_action=add_form");
            exit;
        }

        $sql_insert_attr = "INSERT INTO attractions (attraction_name, attraction_description, attraction_image, metro_station_id) VALUES (?, ?, ?, ?)";
        $stmt_insert_attr = mysqli_prepare($cnx, $sql_insert_attr);
        if ($stmt_insert_attr) {
            mysqli_stmt_bind_param($stmt_insert_attr, "sssi", $attraction_name, $attraction_description, $attraction_image, $metro_station_id);
            if (mysqli_stmt_execute($stmt_insert_attr)) {
                $_SESSION['message'] = "Attraction '" . htmlspecialchars($attraction_name) . "' added successfully.";
                unset($_SESSION['form_data']);
            } else {
                $_SESSION['message'] = "Error adding attraction: " . mysqli_stmt_error($stmt_insert_attr);
                $_SESSION['form_data'] = $_POST;
                header("Location: admin.php?attraction_action=add_form");
                exit;
            }
            mysqli_stmt_close($stmt_insert_attr);
        } else {
            $_SESSION['message'] = "Error preparing insert statement for attraction: " . mysqli_error($cnx);
            $_SESSION['form_data'] = $_POST;
            header("Location: admin.php?attraction_action=add_form");
            exit;
        }
        header("Location: admin.php?attraction_action=view");
        exit;

    } elseif ($action === 'edit_attraction') {
        $attraction_id = (int)($_POST['attraction_id'] ?? 0);
        $attraction_name = trim($_POST['attraction_name'] ?? '');
        $attraction_description = trim($_POST['attraction_description'] ?? '');
        $attraction_image = trim($_POST['attraction_image'] ?? '');
        $metro_station_id = (int)($_POST['metro_station_id'] ?? 0);

        if ($attraction_id <= 0) {
            $_SESSION['message'] = "Error: Invalid Attraction ID.";
            header("Location: admin.php?attraction_action=view");
            exit;
        }
        if (empty($attraction_name) || empty($attraction_description) || empty($attraction_image) || $metro_station_id <= 0) {
            $_SESSION['message'] = "Error: All fields are required for editing an attraction.";
            $_SESSION['form_data'] = $_POST; 
            header("Location: admin.php?attraction_action=edit_form&id=" . $attraction_id);
            exit;
        }
        
        $sql_update_attr = "UPDATE attractions SET attraction_name = ?, attraction_description = ?, attraction_image = ?, metro_station_id = ? WHERE id = ?";
        $stmt_update_attr = mysqli_prepare($cnx, $sql_update_attr);
        if ($stmt_update_attr) {
            mysqli_stmt_bind_param($stmt_update_attr, "sssii", $attraction_name, $attraction_description, $attraction_image, $metro_station_id, $attraction_id);
            if (mysqli_stmt_execute($stmt_update_attr)) {
                $_SESSION['message'] = "Attraction '" . htmlspecialchars($attraction_name) . "' updated successfully.";
                unset($_SESSION['form_data']);
            } else {
                $_SESSION['message'] = "Error updating attraction: " . mysqli_stmt_error($stmt_update_attr);
                $_SESSION['form_data'] = $_POST;
                header("Location: admin.php?attraction_action=edit_form&id=" . $attraction_id);
                exit;
            }
            mysqli_stmt_close($stmt_update_attr);
        } else {
            $_SESSION['message'] = "Error preparing update statement for attraction: " . mysqli_error($cnx);
            $_SESSION['form_data'] = $_POST;
            header("Location: admin.php?attraction_action=edit_form&id=" . $attraction_id);
            exit;
        }
        header("Location: admin.php?attraction_action=view");
        exit;

    } elseif ($action === 'delete_attraction') {
        if (isset($_POST['attraction_id'])) {
            $attraction_id = (int)$_POST['attraction_id'];
            $attraction_name_deleted = "ID: $attraction_id";

            // Fetch the name for a more user-friendly message (good practice)
            $stmt_fetch_name_attr = mysqli_prepare($cnx, "SELECT attraction_name FROM attractions WHERE id = ?");
            if($stmt_fetch_name_attr) { 
                mysqli_stmt_bind_param($stmt_fetch_name_attr, "i", $attraction_id); 
                mysqli_stmt_execute($stmt_fetch_name_attr); 
                $result_fetch_name_attr = mysqli_stmt_get_result($stmt_fetch_name_attr); 
                if($data_fetch_name_attr = mysqli_fetch_assoc($result_fetch_name_attr)) { 
                    $attraction_name_deleted = htmlspecialchars($data_fetch_name_attr['attraction_name']); 
                } 
                mysqli_stmt_close($stmt_fetch_name_attr); 
            }

            $sql_delete_attr = "DELETE FROM attractions WHERE id = ?";
            $stmt_delete_attr = mysqli_prepare($cnx, $sql_delete_attr);
            if ($stmt_delete_attr) {
                mysqli_stmt_bind_param($stmt_delete_attr, "i", $attraction_id);
                if (mysqli_stmt_execute($stmt_delete_attr)) {
                    $_SESSION['message'] = "Attraction '$attraction_name_deleted' deleted successfully.";
                } else {
                    $_SESSION['message'] = "Error deleting attraction: " . mysqli_stmt_error($stmt_delete_attr);
                }
                mysqli_stmt_close($stmt_delete_attr);
            } else {
                $_SESSION['message'] = "Error preparing delete statement for attraction: " . mysqli_error($cnx);
            }
        } else {
            $_SESSION['message'] = "Error: Attraction ID not provided for deletion.";
        }
        header("Location: admin.php?attraction_action=view");
        exit;
    } else {
        $_SESSION['message'] = "Error: Unknown action requested.";
        header("Location: admin.php?attraction_action=view"); // Default redirect for unknown POST actions
        exit;
    }
} else {
    $_SESSION['message'] = "Error: Invalid action or request method.";
    header("Location: admin.php");
    exit;
}

// No longer need mysqli_close($cnx); here as it's handled by register_shutdown_function
?>