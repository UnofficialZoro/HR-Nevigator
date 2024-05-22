<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'project');

if (isset($_REQUEST['btncreate'])) {
    $employee_name = $_REQUEST['employee_name'];
    $income = $_REQUEST['income'];
    $payment_date = $_REQUEST['payment_date'];

    $insert = "INSERT INTO hr_payments (employee_name,income,payment_date) VALUES ('$employee_name','$income','$payment_date')";
    mysqli_query($con, $insert);
    header('location:epayments.php');
}
$id = $_SESSION['employee_id'];
$result = "SELECT * FROM hr_employee WHERE employee_id='$id'";
$query2 = mysqli_query($con, $result);
$fetch_data = mysqli_fetch_array($query2);

$name = $fetch_data['employee_name'];
$data = "SELECT * FROM hr_payments WHERE employee_name='$name' ";
$data1 = mysqli_query($con, $data);

// Paid and pending amount button query
if (isset($_REQUEST['Pending']) and isset($_REQUEST['current_status'])) {
    $id = $_REQUEST['Pending'];
    $status = $_REQUEST['current_status'];
    if ($status == 'Pending') {
        $update = "update hr_payments set status='Paid' where salary_id='$id'";
        mysqli_query($con, $update) or die(mysqli_error($con));
    }

    header("location:epayments.php");
}

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">


<!-- Mirrored from pixelwibes.com/template/my-task/html/dist/payments.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Dec 2023 06:24:15 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>:: HR Navigator::</title>
    <link rel="icon" href="hrmslogo.png" type="image/x-icon"> <!-- Title Icon-->
    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/nestable/jquery-nestable.css" />
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>

<body data-mytask="theme-indigo">

    <div id="mytask-layout">

        <!-- sidebar -->
        <?php
        // Include the sidebar
        include 'esidebar.php';
        ?>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <?php
            // Include the header
            include 'eheader.php';
            ?>

            <!-- Body: Body -->
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Payments</h3>
                                <div class="col-auto d-flex w-sm-100">
                                    <!-- <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#createtask"><i class="icofont-plus-circle me-2 fs-6"></i>Insert Data</button> -->
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <!-- <form method="POST">
        <div class="modal fade" id="createtask" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel">Insert Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label  class="form-label">Employee Name</label>
                        <select class="form-select" name="employee_name">
                            <option style="display: none;">Employee Name Select</option>
                            <?php
                            $delete1 = "SELECT * FROM hr_employee";
                            $res1 = mysqli_query($con, $delete1);
                            while ($fetch = mysqli_fetch_array($res1)) {
                            ?>
                                <option  value="<?php echo $fetch['employee_name']; ?>" ><?php echo $fetch['employee_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="employeename" class="form-label">Salary</label>
                        <input type="text" name="income" class="form-control" id="sub">
                    </div>
                    <div class="deadline-form mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="datepickerded" class="form-label">Payments Date</label>
                                <input type="date" class="form-control" name="payment_date" id="datepickerded">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="submit" name="btncreate" class="btn btn-primary">Create</button>
                </div>
            </div>
            </div>
        </div>
        </div>
    </form> -->
                    <div class="row g-3" style="text-align: center;">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <!-- <th>Salary Id</th> -->
                                                <!-- <th>Employee Name</th> -->
                                                <th style="background-color: #222222; color: white;">Salary</th>
                                                <th style="background-color: #222222; color: white;">Salary Date</th>
                                                <th style="background-color: #222222; color: white;">status</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($data2 = mysqli_fetch_array($data1)) {
                                        ?>
                                            <tr>
                                                <!-- <td><?php echo $data2['salary_id'] ?></td> -->
                                                <!-- <td><?php echo $data2['employee_name'] ?></td> -->
                                                <td><b><?php echo $data2['income'] ?></b></td>
                                                <td><?php echo $data2['payment_date'] ?></td>
                                                <td style="background-color: <?php echo ($data2['status'] == 'Pending') ? '#FFD700' : 'limegreen'; ?>; color: black;">
                                                    <b><?php echo $data2['status']; ?></b>
                                                </td>
                                            </tr>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- start: template setting, and more. -->
        <?php
        //include theme 
        include 'esetting.php';
        ?>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <!-- <script src="assets/bundles/dataTables.bundle.js"></script> -->

    <!-- Jquery Page Js -->
    <script src="../js/template.js"></script>
    <script>
        // project data table
        $(document).ready(function() {
            $('#myProjectTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }]
                });
        });
    </script>
</body>

</html>