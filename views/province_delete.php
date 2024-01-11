<?php
include_once("../db.php");
include_once("../province.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id']; // Retrieve the 'id' from the URL

    // Instantiate the Database and Student classes
    $db = new Database();
    $province = new Province($db);

    // Call the delete method to delete the student record
    if ($province->delete($id)) {
        echo "Record deleted successfully.";
        header("Location: province_view.php");
    } else {
        echo "Failed to delete the record.";
    }
}

$db = new Database();
$connection = $db->getConnection();
$province = new Province($db);
?>