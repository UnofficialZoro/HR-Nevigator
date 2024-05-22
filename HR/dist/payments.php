<?php
$con = mysqli_connect('localhost', 'root', '', 'project');

if (isset($_REQUEST['btncreate'])) {
    $employee_name = $_REQUEST['employee_name'];
    $income = $_REQUEST['income'];
    $payment_date = $_REQUEST['payment_date'];

    $insert = "INSERT INTO hr_payments (employee_name,income,payment_date) VALUES ('$employee_name','$income','$payment_date')";
    mysqli_query($con, $insert);
    header('location:payments.php');
}

$data = "SELECT * FROM hr_payments";
$data1 = mysqli_query($con, $data);

// Paid and pending amount button query
if (isset($_REQUEST['Pending']) and isset($_REQUEST['current_status'])) {
    $id = $_REQUEST['Pending'];
    $status = $_REQUEST['current_status'];
    if ($status == 'Pending') {
        $update = "UPDATE hr_payments SET status='Paid' WHERE salary_id='$id'";
        mysqli_query($con, $update) or die(mysqli_error($con));
    }

    header("location:payments.php");
}

// Search Box Query
if (isset($_REQUEST['btnsearch'])) {
    $txtsearch = $_REQUEST['txtsearch'];
    $data = "SELECT * FROM hr_payments WHERE employee_name LIKE '%$txtsearch%'";
    $data1 = mysqli_query($con, $data);
} else {
    $data = "SELECT * FROM hr_payments";
    $data1 = mysqli_query($con, $data);
}

?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>:: HR Navigator ::</title>
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
        include 'sidebar.php';
        ?>
        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">
            <!-- Body: Header -->
            <?php
            // Include the header
            include 'header.php';
            ?>
            <!-- Body: Body -->
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Payments</h3>
                                <div class="col-auto d-flex w-sm-100">
                                    <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#createtask"><i class="icofont-plus-circle me-2 fs-6"></i>Insert Data</button>
                                </div>
                            </div>
                        </div> <!-- Row end  -->
                        <form method="POST">
                            <div class="modal fade" id="createtask" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title  fw-bold" id="createprojectlLabel">Insert Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Employee Name</label>
                                                <select class="form-select" name="employee_name">
                                                    <option style="display: none;">Employee Name Select</option>
                                                    <?php
                                                    $delete1 = "SELECT * FROM hr_employee";
                                                    $res1 = mysqli_query($con, $delete1);
                                                    while ($fetch = mysqli_fetch_array($res1)) {
                                                    ?>
                                                        <option value="<?php echo $fetch['employee_name']; ?>"><?php echo $fetch['employee_name']; ?></option>
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
                        </form>
                        <div class="row py-3" style="margin-left:50%;">
                            <div class="col-md-6 offset-md-6">
                                <form method="POST" class="d-flex">
                                    <input type="text" class="form-control me-2" name="txtsearch" placeholder="Search...">
                                    <button type="submit" class="btn btn-primary" name="btnsearch">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="row g-3" style="text-align: center;">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="background-color: #222222; color: white;">Action</th>
                                                    <th style="background-color: #222222; color: white;">Employee Name</th>
                                                    <th style="background-color: #222222; color: white;">Salary</th>
                                                    <th style="background-color: #222222; color: white;">Salary Date</th>
                                                    <th style="background-color: #222222; color: white;">status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($data2 = mysqli_fetch_array($data1)) {
                                                ?>
                                                    <tr>
                                                        <td><a href="paedit.php?edit=<?php echo $data2['salary_id']; ?>" onclick="return confirm('Are You Sure?')"><i class="icofont-edit"></i></a></td>
                                                        <td><b><?php echo $data2['employee_name'] ?></b></td>
                                                        <td><b><?php echo $data2['income'] ?></b></td>
                                                        <td><?php echo $data2['payment_date'] ?></td>
                                                        <td style="background-color: <?php echo ($data2['status'] == 'Pending') ? '#FFD700' : 'limegreen'; ?>; color: black;">
                                                            <b><a href="payments.php?Pending=<?php echo $data2['salary_id']; ?>&current_status=<?php echo $data2['status']; ?>"><?php echo $data2['status']; ?></a></b>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
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
            include 'setting.php';
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