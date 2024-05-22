<?php
    $con=mysqli_connect('localhost','root','','project');

    if(isset($_REQUEST['btnadd']))
    {
        $holiday_day=$_REQUEST['holiday_day'];
        $holiday_name=$_REQUEST['holiday_name'];
        $holiday_date=$_REQUEST['holiday_date'];

        $insert="INSERT INTO hr_holiday(holiday_day,holiday_name,holiday_date) values ('$holiday_day','$holiday_name','$holiday_date')";
        mysqli_query($con,$insert);
        header("location:holidays.php");
    }
    $data="SELECT * FROM hr_holiday";
    $data1=mysqli_query($con,$data);
    
    //Delete Query
    if(isset($_REQUEST['delete']))
    {
        $id=$_REQUEST['delete'];
        $delete="SELECT * FROM hr_holiday where holiday_id='$id'";
        $res=mysqli_query($con,$delete);
        $row=mysqli_fetch_array($res);
        $delete="DELETE FROM hr_holiday where holiday_id='$id'";
        mysqli_query($con,$delete);
        header("location:holidays.php");
    }
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">


<!-- Mirrored from pixelwibes.com/template/my-task/html/dist/holidays.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Dec 2023 06:24:15 GMT -->
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
                            <h3 class="fw-bold mb-0">Holidays</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#addholiday"><i class="icofont-plus-circle me-2 fs-6"></i>Add Holidays</button>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- Row end  -->
                <div class="row clearfix g-3">
                  <div class="col-sm-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead>
                                        <tr style="text-align:center">
                                            <th style="background-color: #222222; color: white;">Holiday Id</th>
                                            <th style="background-color: #222222; color: white;">Holiday Day</th>
                                            <th style="background-color: #222222; color: white;">Holiday Name</th>
                                            <th style="background-color: #222222; color: white;">Holiday Date</th>
                                            <th colspan="2" style="background-color: #222222; color: white;">Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        while($data2=mysqli_fetch_array($data1))
                                        {
                                    ?>
                                    <tr style="text-align:center">
                                        <td><?php echo $data2['holiday_id'] ?></td>
                                        <td><?php echo $data2['holiday_day']?></td>
                                        <td><b><?php echo $data2['holiday_name']?></b></td>
                                        <td><?php echo $data2['holiday_date']?></td>
                                        <td><a href="hoedit.php?edit=<?php echo $data2['holiday_id']?>"onclick="return confirm ('Are You Sure?')"><i class="icofont-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; 
                                            <a href="holidays.php?delete=<?php echo $data2['holiday_id']?>"onclick="return confirm ('Are You Sure?')"><i class="icofont-ui-delete"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                  </div>
                </div>
                <!-- Row End -->
            </div>
        </div>
        
        <!-- Add Holiday-->
        <div class="modal fade" id="addholiday" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="addholidayLabel"> Add Holidays</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Holiday Day</label>
                        <input type="text" name="holiday_day" class="form-control" id="exampleFormControlInput1" placeholder="Enter Holiday Day">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Holiday Name</label>
                        <input type="text" name="holiday_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Holiday name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput2778" class="form-label">Holiday Date</label>
                        <input type="date" name="holiday_date" class="form-control" id="exampleFormControlInput2778">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="submit" name="btnadd" class="btn btn-primary">Add</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    </form>

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

<!-- Mirrored from pixelwibes.com/template/my-task/html/dist/holidays.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Dec 2023 06:24:15 GMT -->
</html>