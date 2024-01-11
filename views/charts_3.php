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

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="../assets/css/style.css" rel="stylesheet">

    <style>
        .main {
            height: 70vh;
            display: flex;
            gap: 30px;
        }

        .content {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        h4 {
            font-weight: 900;
        }

        .card {
            height: 100%;
            width: 100%;
            border-radius: 0 0 40px 40px;
        }
    </style>

</head>


<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <?php include('../includes/header.php') ?>
    </header>
    <aside id="sidebar" class="sidebar">
        <?php include('../includes/sidebar.php') ?>
    </aside>

    <main id="main" class="main">
        <div class="pagetitle">
        </div>

        <div class="card">
            <div class="header" style="background-color: rgba(75, 192, 192, 0.2);">
                <h4 class="title">Student's Birthday Count</h4>
                <h6>(All)</h6>
            </div>
            <div class="content">
                <canvas id="chartBirthday"></canvas>
                <?php
                include_once("../charts.php");

                $db = new Database();
                $connection = $db->getConnection();
                $chart4 = new Charts($db);
                $chartData = $chart4->chart4();
                ?>
            </div>
        </div>
        <div class="card">
            <div class="header" style="background-color: rgba(75, 12, 392, 0.2);">
                <h4 class="title">Student's Birthday Count</h4>
                <h6>(Since 2010)</h6>
            </div>
            <div class="content">
                <canvas id="chartBirthday2"></canvas>
                <?php
                include_once("../charts.php");

                $db = new Database();
                $connection = $db->getConnection();
                $chart5 = new Charts($db);
                $chartData2 = $chart5->chart5();
                ?>
            </div>
        </div>
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

    <script>
        // Extract data from PHP result
        const birthMonths = <?php echo json_encode(array_column($chartData, 'birth_month')); ?>;
        const studentCounts = <?php echo json_encode(array_column($chartData, 'student_count')); ?>;

        // Create chart using Chart.js
        const ctx = document.getElementById('chartBirthday').getContext('2d');
        const birthdayChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: birthMonths,
                datasets: [{
                    label: 'Student Count',
                    data: studentCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        // Extract data from PHP result
        const birthMonths2 = <?php echo json_encode(array_column($chartData2, 'birth_month')); ?>;
        const studentCounts2 = <?php echo json_encode(array_column($chartData2, 'student_count')); ?>;

        // Create chart using Chart.js
        const ctx2 = document.getElementById('chartBirthday2').getContext('2d');
        const birthdayChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: birthMonths2,
                datasets: [{
                    label: 'Student Count',
                    data: studentCounts2,
                    backgroundColor: 'rgba(75, 12, 392, 0.2)',
                    borderColor: 'rgba(75, 12, 392, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>