<?php
    $con=mysqli_connect('localhost','root','','project');
    if(isset($_REQUEST['btnsent']))
    {
        $report_subject = mysqli_real_escape_string($con, $_REQUEST['report_subject']);
        $assign_name = mysqli_real_escape_string($con, $_REQUEST['assign_name']);
        $created_date=$_REQUEST['created_date'];
       
        $insert="INSERT INTO hr_report(report_subject,assign_name,created_date) values ('$report_subject','$assign_name','$created_date')";
        mysqli_query($con,$insert);
        header("location:report.php");

    }
    $data="SELECT * FROM hr_report";
    $data1=mysqli_query($con,$data);
    
    //Delete Query
    
    if(isset($_REQUEST['delete']))
    {
        $id=$_REQUEST['delete'];
        $delete="SELECT * FROM hr_report where report_id='$id'";
        $res=mysqli_query($con,$delete);
        $row=mysqli_fetch_array($res);
        $delete="DELETE FROM hr_report where report_id='$id'";
        mysqli_query($con,$delete);
        header("location:report.php");
    }
    // Search Box Query
    if(isset($_REQUEST['btnsearch'])) {
        $txtsearch = $_REQUEST['txtsearch'];
        $data = "SELECT * FROM hr_report WHERE assign_name LIKE '%$txtsearch%'";
        $data1 = mysqli_query($con, $data);
    } else {
        $data = "SELECT * FROM hr_report";
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
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>
<body  data-mytask="theme-indigo">

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
        <form method="POST">    
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Reports</h3>
                                <!-- <div class="col-auto d-flex w-sm-100">
                                    <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#tickadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Reports</button>
                                </div> -->
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
                <div class="row clearfix g-3">
                  <div class="col-sm-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="background-color: #222222; color: white;">Report Id</th>
                                            <th style="background-color: #222222; color: white;">Subject</th>
                                            <th style="background-color: #222222; color: white;">Assigned Name</th> 
                                            <th style="background-color: #222222; color: white;">Created Date</th> 
                                            <th style="background-color: #222222; color: white;">Actions</th>  
                                        </tr>
                                    </thead>
                                <?php
                                    while($data2=mysqli_fetch_array($data1))
                                    {
                                ?>
                                <tr style="text-align: center;">
                                    <td><?php echo $data2['report_id']?></td>
                                    <td><?php echo $data2['report_subject']?></td>
                                    <td><b><?php echo $data2['assign_name']?></b></td>
                                    <td><?php echo $data2['created_date']?></td>
                                    <td><a href="reedit.php?edit=<?php echo $data2['report_id'] ?>"onclick="return confirm ('Are You Sure?')"><i class="icofont-edit" id="model"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="report.php?delete=<?php echo $data2['report_id']?>" onclick="return confirm ('Are You Sure?')"><i class="icofont-ui-delete"></i></a>
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
        <!-- <div class="modal fade" id="tickadd" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Report Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="sub" class="form-label">Subject</label>
                        <input type="text" name="report_subject" class="form-control" id="sub">
                    </div>
                    <div class="deadline-form">
                        <form>
                            <div class="row g-3 mb-3">
                              <div class="col">
                                    <label for="depone" class="form-label">Assign Name</label>
                                    <select name="assign_name" class="form-select" >
                                        <option style="display: none;">Select Name</option>
                                        <?php
                                            $delete1="SELECT * FROM hr_employee";
                                            $res1=mysqli_query($con,$delete1);
                                            while($fetch=mysqli_fetch_array($res1)){
                                        ?>
                                        <option  value="<?php echo $fetch['employee_name'];?>" ><?php echo $fetch['employee_name'];?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                              <div class="col">
                                <label for="deptwo" class="form-label">Creted Date</label>
                                <input type="date" name="created_date" class="form-control" id="deptwo">
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="submit" name="btnsent" class="btn btn-primary">Sent</button>
                </div>
            </div>
            </div>
        </div>
        </form> -->
        <!-- Edit Tickit-->
        <!-- <div class="modal fade" id="edittickit" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="edittickitLabel"> Tickit Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="sub1" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="sub1" value="punching time not proper">
                    </div>
                    <div class="deadline-form">
                        <form>
                            <div class="row g-3 mb-3">
                              <div class="col">
                                <label for="depone11" class="form-label">Assign Name</label>
                                <input type="text" class="form-control" id="depone11" value="Victor Rampling">
                              </div>
                              <div class="col">
                                <label for="deptwo56" class="form-label">Creted Date</label>
                                <input type="date" class="form-control" id="deptwo56" value="2021-02-25">
                              </div>
                            </div>
                        </form>
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Status</label>
                        <select class="form-select">
                            <option selected>Completed</option>
                            <option value="1">In Progress</option>
                            <option value="2">Wating</option>
                            <option value="3">Decline</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                    <button type="submit" class="btn btn-primary">sent</button>
                </div>
            </div>
            </div>
        </div> -->
    </div>

    <!-- start: template setting, and more. -->
	<?php
        // Include the Theme
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
        .addClass( 'nowrap' )
        .dataTable( {
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });
        $('.deleterow').on('click',function(){
        var tablename = $(this).closest('table').DataTable();  
        tablename
                .row( $(this)
                .parents('tr') )
                .remove()
                .draw();

        } );
    });
</script>
</body>
</html>
