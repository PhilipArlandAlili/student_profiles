<?php
include_once("../db.php");
include_once("../town_city.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id']; // Retrieve the 'id' from the URL

    // Instantiate the Database and Student classes
    $db = new Database();
    $town = new Town($db);

    // Call the delete method to delete the student record
    if ($town->delete($id)) {
        echo "Record deleted successfully.";
        header("Location: town_city_view.php");
    } else {
        echo "Failed to delete the record.";
    }
}

$db = new Database();
$connection = $db->getConnection();
$town = new Town($db);
?>