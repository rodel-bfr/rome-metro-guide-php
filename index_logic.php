<?php
session_start();

/* Dev only error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);*/

include 'connection.php';

// Fetch all metro stations for the selection list, ordered by display_order
$sql_stations_data = "SELECT id, metro_station, metro_line_id FROM metro_stations ORDER BY display_order ASC";
$result_stations_data = mysqli_query($cnx, $sql_stations_data);
$metro_stations_list = [];
if ($result_stations_data) {
    $metro_stations_list = mysqli_fetch_all($result_stations_data, MYSQLI_ASSOC);
} else {
    error_log("Failed to fetch metro stations: " . mysqli_error($cnx));
}

// Group stations for the new layout
$line_a_stations = [];
$termini_station = null;
$line_b_stations = [];

foreach ($metro_stations_list as $station) {
    if ($station['metro_line_id'] == '1') { // Line A (e.g., Ottaviano to Barberini)
        $line_a_stations[] = $station;
    } elseif ($station['metro_line_id'] == '4') { // Termini
        $termini_station = $station;
    } elseif ($station['metro_line_id'] == '2') { // Line B (e.g., Cavour to Piramide)
        $line_b_stations[] = $station;
    }
    // Add other conditions if you have more lines/groups
}


$attractions = [];
$selected_station_name_for_title = 'All Stations';
$current_selected_station_id = null;
$num_attractions = 0;
$is_station_selected_for_title = false;

if (isset($_GET['station_id']) && is_numeric($_GET['station_id'])) {
    $current_selected_station_id = (int)$_GET['station_id'];

    $sql_selected_station_name_query = "SELECT metro_station FROM metro_stations WHERE id = ?";
    $stmt_station_name = mysqli_prepare($cnx, $sql_selected_station_name_query);

    if ($stmt_station_name) {
        mysqli_stmt_bind_param($stmt_station_name, "i", $current_selected_station_id);
        mysqli_stmt_execute($stmt_station_name);
        $result_station_name = mysqli_stmt_get_result($stmt_station_name);
        $selected_station_data = mysqli_fetch_assoc($result_station_name);
        if ($selected_station_data) {
            $selected_station_name_for_title = $selected_station_data['metro_station'];
            $is_station_selected_for_title = true;
        } else {
            $selected_station_name_for_title = 'Unknown Station';
        }
        mysqli_stmt_close($stmt_station_name);
    } else {
        error_log("Failed to prepare statement for station name: " . mysqli_error($cnx));
    }

    $sql_attractions_query = "SELECT id, attraction_name, attraction_description, attraction_image FROM attractions WHERE metro_station_id = ?";
    $stmt_attractions = mysqli_prepare($cnx, $sql_attractions_query);
    if ($stmt_attractions) {
        mysqli_stmt_bind_param($stmt_attractions, "i", $current_selected_station_id);
        mysqli_stmt_execute($stmt_attractions);
        $result_attractions_data = mysqli_stmt_get_result($stmt_attractions);
        $attractions = mysqli_fetch_all($result_attractions_data, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt_attractions);

        if (!empty($attractions)) {
            $num_attractions = count($attractions);
        }
    } else {
        error_log("Failed to prepare statement for attractions: " . mysqli_error($cnx));
    }
}
?>
