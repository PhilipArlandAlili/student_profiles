<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Students Profile</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    include_once("../db.php"); // Include the Database class file
    include_once("../students.php"); // Include the Student class file
    include_once("../town_city.php");
    include_once("../student_details.php");
    include_once("../province.php");


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = [
            'student_number' => $_POST['student_number'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'middle_name' => $_POST['middle_name'],
            'gender' => $_POST['gender'],
            'birthday' => $_POST['birthday'],
        ];

        // Instantiate the Database and Students classes
        $database = new Database();
        $students = new Students($database);
        $studentId = $students->create($data);

        if ($studentId) {
            // Student record successfully created
            $studentData = [
                'id' => $studentId,
                'student_number' => $_POST['student_number'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'middle_name' => $_POST['middle_name'],
                'gender' => $_POST['gender'],
                'birthday' => $_POST['birthday'],
            ];
            // Instantiate the StudentDetails class
    

            $studentDetailsData = [
                'student_id' => $studentId,
                'contact_number' => $_POST['contact_number'],
                'street' => $_POST['street'],
                'town_city' => $_POST['town_city'],
                'province' => $_POST['province'],
                'zip_code' => $_POST['zip_code'],
            ];

            // Instantiate the Database and Student classes
            $studentDetails = new StudentDetails($database);
            $studentDetails_id = $studentDetails->create($studentDetailsData);

            if ($studentDetails_id) {
                header("Location: students_view.php");
            }
        }
    }
    ?>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <?php include('../includes/header.php') ?>
    </header>
    <aside id="sidebar" class="sidebar">
        <?php include('../includes/sidebar.php') ?>
    </aside>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Add Student Table</h1>
        </div>
        <div class="card" style="width: 100%">
            <div class="card-body">
                <h5 class="card-title">Add Student Name</h5>
                <form class="row g-3 needs-validation" method="post" novalidate>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Student Number</label>
                        <input type="text" class="form-control" id="validationCustom01"
                            placeholder="E.g. 2022-00000001..." name="student_number" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="validationCustom01" placeholder="E.g. Wyatt..."
                            name="first_name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="E.g. Jerde..."
                            name="last_name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="E.g. Hodkiewicz..."
                            name="middle_name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom04" class="form-label">Gender</label>
                        <select class="form-select" id="validationCustom04" name="gender" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a gender.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom05" class="form-label">Birthdate</label>
                        <input type="date" class="form-control" id="validationCustom05" name="birthday" required>
                        <div class="invalid-feedback">
                            Please provide a valid birthdate.
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="validationCustom01" placeholder="E.g. 1, 2, 3..."
                            name="student_id" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div> -->
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="validationCustom01"
                            placeholder="E.g. 09123456789..." name="contact_number" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Street</label>
                        <input type="text" class="form-control" id="validationCustom02"
                            placeholder="E.g. 714 Jevon Mission..." name="street" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Town / City</label>
                        <select type="text" class="form-control" id="validationCustom02" placeholder="E.g. 167..."
                            name="town_city" required>
                            <?php
                            $database = new Database();
                            $towns = new Town($database);
                            $results = $towns->displayAll();
                            // echo print_r($results);
                            foreach ($results as $result) {
                                echo '<option value="' . $result['id'] . '">' . $result['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Province</label>
                        <select type="text" class="form-control" id="validationCustom02" placeholder="E.g. 927..."
                            name="province" required>
                            <?php
                            $database = new Database();
                            $province = new Province($database);
                            $results = $province->getAll();
                            // echo print_r($results);
                            foreach ($results as $result) {
                                echo '<option value="' . $result['id'] . '">' . $result['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="E.g. 39041..."
                            name="zip_code" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </form>
    </main>



    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->
    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>

</html>