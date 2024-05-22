<?php
    // Establish database connection
    $con = mysqli_connect('localhost', 'root', '', 'project');

    // Fetch data from the salaryslip table
    $data = "SELECT * FROM salaryslip";
    $data1 = mysqli_query($con, $data);

?>

<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>:: HR Navigator ::</title>
    <link rel="icon" href="hrmslogo.png" type="image/x-icon"> <!-- Favicon-->
    <!-- Project CSS file -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>

<body data-mytask="theme-indigo">
    <div id="mytask-layout">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- Main body area -->
        <div class="main px-lg-4 px-md-4">
            <!-- Header -->
            <?php include 'header.php'; ?>
            <!-- Body -->
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Salaryslip</h3>
                                <a href="upload.php" class="btn btn-dark btn-set-task w-sm-100">
                                    <i class="icofont-plus-circle me-2 fs-6"></i>Create Salaryslip
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix g-3">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th style="background-color: #222222; color: white;">Slip Id</th>
                                                <th style="background-color: #222222; color: white;">Employee Name</th>
                                                <th style="background-color: #222222; color: white;">Position</th>
                                                <th style="background-color: #222222; color: white;">Salary</th>
                                                <th style="background-color: #222222; color: white;">Bonus</th>
                                                <th style="background-color: #222222; color: white;">Slip Date</th>
                                                <th style="background-color: #222222; color: white;">Working Hours</th>
                                                <!-- <th style="background-color: #222222; color: white;">Action</th> -->
                                            </tr>
                                        </thead>
                                        <?php
                                            while ($data2 = mysqli_fetch_array($data1)) {
                                        ?>
                                            <tr style="text-align: center;">
                                                <td><?php echo $data2['slip_id']; ?></td>
                                                <td><b><?php echo $data2['employee_name']; ?></b></td>
                                                <td><?php echo $data2['position']; ?></td>
                                                <td><?php echo $data2['salary']; ?></td>
                                                <td><?php echo $data2['bonus']; ?></td>
                                                <td><?php echo $data2['slip_date']; ?></td>
                                                <td><?php echo $data2['working_hours']; ?></td>
                                                <!-- <td>
                                                    <a href="#?upload_id=<?php echo $data2['slip_id'] ?>" class="btn btn-primary">Upload PDF</a>
                                                </td> -->

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start: template setting, and more. -->
                    <?php include 'setting.php'; ?>
                </div>
                <!-- Jquery Core Js -->
                <script src="assets/bundles/libscripts.bundle.js"></script>
                <!-- Plugin Js -->
                <script src="assets/bundles/invoice.bundle.js"></script>
                <!-- Jquery Page Js -->
                <script src="../js/template.js"></script>
</body>

</html>
