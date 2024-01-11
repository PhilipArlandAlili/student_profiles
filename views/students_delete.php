<?php
include_once("../db.php");
include_once("../students.php");
include_once("../student_details.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id']; // Retrieve the 'id' from the URL

    // Instantiate the Database and Student classes
    $db = new Database();
    $students = new Students($db);
    $database = new Database();
    $student_details = new StudentDetails($database);

    // Call the delete method to delete the student record
    if ($students->delete($id) && $student_details->delete($id)) {
        echo "Record deleted from StudentDetails successfully.";
        header("Location: students_view.php");
    } else {
        echo "Failed to delete the record from StudentDetails.";
        // Log or display detailed error information
    }
}

$db = new Database();
$connection = $db->getConnection();
$students = new Students($db);

// Get the current page or set it to 1 if not set
$dis_students = $students->getAllWithStudentDetails();
?>