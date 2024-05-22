<?php
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'project');

    if (isset($_REQUEST['btnsent'])) {
        $report_subject = mysqli_real_escape_string($con, $_REQUEST['report_subject']);
        $assign_name = mysqli_real_escape_string($con, $_REQUEST['assign_name']);
        $created_date = $_REQUEST['created_date'];
       
        $insert = "INSERT INTO hr_report(report_subject, assign_name, created_date) VALUES ('$report_subject', '$assign_name', '$created_date')";
        mysqli_query($con, $insert);
        header("location:ereport.php");
    }

    $id = $_SESSION['employee_id'];
    $result = "SELECT * FROM hr_employee WHERE employee_id='$id'";
    $query2 = mysqli_query($con, $result);
    $fetch_data = mysqli_fetch_array($query2);

    $name = $fetch_data['employee_name'];
    
    // Search Box Query 
    if (isset($_POST['search_query'])) {
        $search_query = mysqli_real_escape_string($con, $_POST['search_query']);
        $data = "SELECT * FROM hr_report WHERE assign_name='$name' AND (report_subject LIKE '%$search_query%')";
    } else {
        $data = "SELECT * FROM hr_report WHERE assign_name='$name'";
    }
    
    $data1 = mysqli_query($con, $data);

    // Delete Query
    if (isset($_REQUEST['delete'])) {
        $id = $_REQUEST['delete'];
        $delete = "DELETE FROM hr_report WHERE report_id='$id'";
        mysqli_query($con, $delete);
        header("location:ereport.php");
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
        <form method="POST">    
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Reports</h3>
                                <div class="col-auto d-flex w-sm-100">
                                    <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#tickadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Reports</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group" style="width: 40%; margin-left:164%">
                                <input type="text" class="form-control" placeholder="Search Reason" name="search_query">
                                <button class="btn btn-primary" type="submit">Search</button>
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
                                                <th style="background-color: #222222; color: white;">Reason</th>
                                                <th style="background-color: #222222; color: white;">Created Date</th> 
                                                <th style="background-color: #222222; color: white;">Actions</th>  
                                            </tr>
                                        </thead>
                                    <?php
                                        while($data2 = mysqli_fetch_array($data1)) {
                                    ?>
                                        <tr style="text-align: center;">
                                            <td style="width: 25%;"><b><?php echo $data2['report_subject']?></b></td>
                                            <td><?php echo $data2['created_date']?></td>
                                            <td>
                                                <a href="ereedit.php?edit=<?php echo $data2['report_id'] ?>" onclick="return confirm ('Are You Sure?')"><i class="icofont-edit" id="model"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="ereport.php?delete=<?php echo $data2['report_id']?>" onclick="return confirm ('Are You Sure?')"><i class="icofont-ui-delete"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row End -->
                </div>
            </div>
            
            <!-- Add Tickit-->
            <div class="modal fade" id="tickadd" tabindex="-1"  aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Report Add</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="sub" class="form-label">Reason</label>
                                <input type="text" name="report_subject" class="form-control" id="sub">
                            </div>
                            <div class="deadline-form">
                                <div class="row g-3 mb-3">
                                    <div class="col">
                                        <label for="depone" class="form-label">Assign Name</label>
                                        <select name="assign_name" class="form-select" >
                                            <?php
                                                $id= $_SESSION['employee_id'];
                                                $delete1="SELECT * FROM hr_employee WHERE employee_id='$id'";
                                                $res1=mysqli_query($con,$delete1);
                                                while($fetch=mysqli_fetch_array($res1)){
                                            ?>
                                            <option value="<?php echo $fetch['employee_name'];?>" ><?php echo $fetch['employee_name'];?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="deptwo" class="form-label">Created Date</label>
                                        <input type="date" name="created_date" class="form-control" id="deptwo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                            <button type="submit" name="btnsent" class="btn btn-primary">Sent</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- start: template setting, and more. -->
    <?php
        // Include the Theme
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
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });
        $('.deleterow').on('click', function() {
            var tablename = $(this).closest('table').DataTable();  
            tablename
            .row($(this).parents('tr'))
            .remove()
            .draw();
        });
    });
</script>
</body>
</html>
