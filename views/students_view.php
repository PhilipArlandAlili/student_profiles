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
    <style>
        .main {
            font-size: 10px;
        }
        .td_butt button {
            width: 47%;
            height: 20px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <?php
    include_once("../db.php");
    include_once("../students.php");

    $db = new Database();
    $connection = $db->getConnection();
    $students = new Students($db);

    $dis_students = $students->getAllWithStudentDetails();
    ?>

    <header id="header" class="header fixed-top d-flex align-items-center">
        <?php include('../includes/header.php') ?>
    </header>
    <aside id="sidebar" class="sidebar">
        <?php include('../includes/sidebar.php') ?>
    </aside>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1> View Students Table</h1>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12" style="background-color: darkgray; border-radius: 20px; width: 100%">
                    <div class="card"
                        style="display: flex; align-items: center; border-radius: 10px; height: 99%; padding: 20px;">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                            </ul>
                        </nav><!-- End Right/End Aligned Pagination -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Student Number</th>
                                    <th>Student ID</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>Birthdate</th>
                                    <th>Contact Number</th>
                                    <th>Street</th>
                                    <th>Town City</th>
                                    <th>Province</th>
                                    <th>Zip Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dis_students as $result): ?>
                                    <tr>
                                    <tr>
                                        <td>
                                            <?php echo $result['student_number']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result['student_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result['full_name']; ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo ($result['gender'] == 1) ? 'M' : 'F'; ?>
                                        </td>
                                        <td>
                                            <?php echo date('M j Y', strtotime($result['birthday'])); ?>
                                        </td>
                                        <td>
                                            <?php echo $result['contact_number']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result['street']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result['town_city']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result['province']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result['zip_code']; ?>
                                        </td>
                                        <td class="td_butt" style="text-align: end;">
                                            <a href="students_edit.php?id=<?php echo $result['ids']; ?>">
                                                <button type="submit" class="btn btn-success rounded-pill"
                                                    style="cursor: pointer;">Edit</button>
                                            </a>
                                            <a href="students_delete.php?id=<?php echo $result['ids']; ?>">
                                                <button type="submit" class="btn btn-danger rounded-pill bi bi-trash"
                                                    style="cursor: pointer;"></button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
            </div>
        </section>
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