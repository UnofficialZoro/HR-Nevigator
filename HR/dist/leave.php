<?php
    $con=mysqli_connect('localhost','root','','project');

    if(isset($_REQUEST['btnsent']))
    {
        $employee_name=mysqli_real_escape_string($con,$_REQUEST['employee_name']);
        $leave_type=$_REQUEST['leave_type'];
        $start_date=$_REQUEST['start_date'];
        $end_date=$_REQUEST['end_date'];
        $leave_reason=mysqli_real_escape_string($con,$_REQUEST['leave_reason']);

        $insert="INSERT INTO hr_leave (employee_name,leave_type,`start_date`,end_date,leave_reason) values ('$employee_name','$leave_type','$start_date','$end_date','$leave_reason')";
        mysqli_query($con,$insert);
        header("location:leave.php");

    }
    $data="SELECT * FROM hr_leave";
    $data1=mysqli_query($con,$data);

    //leave approve decline query 
    if(isset($_REQUEST['Pending']) and isset($_REQUEST['current_status']))
    {
        $id=$_REQUEST['Pending'];
        $status=$_REQUEST['current_status'];
        if($status=='Pending')
        {
            $update="UPDATE hr_leave set status='Decline' where leave_id='$id'";
            mysqli_query($con,$update) or die(mysqli_error($con));
        }
        else{
            {
                $update="UPDATE hr_leave set status='Approve' where leave_id='$id'";
                mysqli_query($con,$update) or die(mysqli_error($con));
            }
        }
       
        header("location:leave.php");
    }
    //Delete Query
    
    if(isset($_REQUEST['delete']))
    {
        $id=$_REQUEST['delete'];
        $delete="SELECT * FROM hr_leave where leave_id='$id'";
        $res=mysqli_query($con,$delete);
        $row=mysqli_fetch_array($res);
        $delete="DELETE FROM hr_leave where leave_id='$id'";
        mysqli_query($con,$delete);
        header("location:leave.php");
    }
    
    // Search Box Query
    if(isset($_REQUEST['btnsearch'])) {
        $txtsearch = $_REQUEST['txtsearch'];
        $data = "SELECT * FROM hr_leave WHERE employee_name LIKE '%$txtsearch%'";
        $data1 = mysqli_query($con, $data);
    } else {
        $data = "SELECT * FROM hr_leave";
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
        // Include header
        include 'header.php';
    ?>
    <!-- Body: Body -->    
    <form method="POST">   
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Leave Request</h3>
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
                                    <!-- <th>Employee Id</th> -->
                                    <th style="background-color: #222222; color: white;">Action</th>
                                    <th style="background-color: #222222; color: white;">Employee Name</th>
                                    <th style="background-color: #222222; color: white;">Leave Type</th>
                                    <th style="background-color: #222222; color: white;">Leave From</th>
                                    <th style="background-color: #222222; color: white;">Leave To</th>
                                    <th style="background-color: #222222; color: white;">Reason</th>
                                    <th style="background-color: #222222; color: white;">Status</th>
                                </tr>
                            </thead>
                            <?php
                            while($data2=mysqli_fetch_array($data1))
                            {
                            ?>
                            <tr style="text-align: center;">
                                <!-- <td><?php echo $data2['leave_id'] ?></td> -->
                                <td><a href="leedit.php?edit=<?php echo $data2['leave_id']?>"onclick="return confirm ('Are You Sure?')"><i class="icofont-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; 
                                    <a href="leave.php?delete=<?php echo $data2['leave_id']?>"onclick="return confirm ('Are You Sure?')"><i class="icofont-ui-delete"></i></a>
                                </td>
                                <td><b><?php echo $data2['employee_name'] ?></b></td>
                                <td><?php echo $data2['leave_type'] ?></td>
                                <td><?php echo $data2['start_date'] ?></td>
                                <td><?php echo $data2['end_date'] ?></td>
                                <td><?php echo $data2['leave_reason'] ?></td>
                                
                                <td style="background-color: lightgrey;"><b><a href="leave.php?Pending=<?php echo $data2['leave_id'];?>&&current_status=<?php echo $data2['status']; ?>"><?php echo $data2['status']; ?></a></b></td>                                  </tr>
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
        
        <!-- Leave Add-->
        <!-- <div class="modal fade" id="leaveadd" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Leave Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="employeename" class="form-label">Employee Name</label>
                        <select name="employee_name" class="form-select">
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
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Leave type</label>
                        <select name="leave_type" class="form-select">
                            <option style="display: none;">Select Leave Type</option>
                            <option>Medical Leave</option>
                            <option>Casual Leave</option>
                            <option>Maternity Leave</option>
                        </select>
                    </div>
                    <div class="deadline-form">
                        <form>
                            <div class="row g-3 mb-3">
                              <div class="col-sm-6">
                                <label for="datepickerdedass" class="form-label">Leave From Date</label>
                                <input type="date" name="start_date" class="form-control" id="datepickerdedass">
                              </div>
                              <div class="col-sm-6">
                                <label for="datepickerdedoneddsd" class="form-label">Leave to Date</label>
                                <input type="date" name="end_date" class="form-control" id="datepickerdedoneddsd">
                              </div>
                            </div>
                        </form>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea78d" class="form-label">Leave Reason</label>
                        <textarea class="form-control" name="leave_reason" id="exampleFormControlTextarea78d" rows="3"></textarea>
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
    });
</script>
</body>

</html>