<?php
    session_start();
    $con=mysqli_connect('localhost','root','','project');
    date_default_timezone_set("Asia/calcutta");
    if(isset($_REQUEST['punch_in']))
    {
        $punch_in=date("Y-m-d H:i:s");
        // $punch_out=date("Y-m-d H:i:s");

        $insert="INSERT INTO `hr_attendence`(punch_in) VALUES ('$punch_in')";
        $query= mysqli_query($con,$insert);
        header("location:attendance.php");
    }
    if(isset($_REQUEST['punch_out']))
    { 
        $punch_out=date("Y-m-d H:i:s");
    
        $update="UPDATE hr_attendence SET punch_out='$punch_out' WHERE attendence_id ";
        $query1=mysqli_query($con,$update);   
        header("location:attendance.php");
    }
    $data="SELECT * FROM hr_attendence";
    $data1=mysqli_query($con,$data);
    
    // Search Query
    if(isset($_REQUEST['btnsearch'])) {
        $txtsearch = $_REQUEST['txtsearch'];
        $data = "SELECT * FROM hr_attendence WHERE attendence_id";
        $data1 = mysqli_query($con, $data);
    } else {
        $data = "SELECT * FROM hr_attendence";
        $data1 = mysqli_query($con, $data);
    }
    $id= $_SESSION['employee_id'];
    $result="SELECT * FROM hr_employee where employee_id='$id'";
    $query2=mysqli_query($con,$result);
    $fetch_data=mysqli_fetch_array($query2);   
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
                // Include the sidebar
                include 'header.php';
            ?>
            <!-- Body: Body -->                 
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center g-3 mb-3">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap" style="margin-left: 38%;">
                                <h3 class="fw-bold mb-0">Employees View</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <!-- <div class="row align-item-center row-deck g-3 mb-3">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12" style="margin-left: 30%;">
                            <div class="card">
                                <div class="card-header py-3">
                                    <h6 class="mb-0 fw-bold " style="text-align: center;">Today Time Utilisation</h6>
                                </div>
                                
                                <div class="card-body">
                                    <div class="timesheet-info d-flex align-items-center justify-content-between flex-wrap">
                                    <form method="POST"> 
                                        <div class="intime d-flex align-items-center mt-2">
                                            <button type="submit" name="punch_in"  class="btn btn-dark w-sm-100"><i class="icofont-foot-print me-2"></i>Punch In</button>
                                        </div>
                                        </form>
                                        <form method="POST"> 
                                        <div class="outtime mt-2 w-sm-100">
                                            <button type="submit" name="punch_out"  class="btn btn-dark w-sm-100"><i class="icofont-foot-print me-2"></i>Punch Out</button>
                                        </div>
                                        </form>
                                    </div><br><br>
                                    <div id="apex-circle-chart"></div>
                                    <div class="timesheet-info d-flex align-items-center justify-content-around flex-wrap">
                                        <div class="intime d-flex align-items-center">
                                            <i class="icofont-lunch fs-3 color-lavender-purple"></i>
                                            <span class="fw-bold ms-1">Break: 1:00 Hr</span>
                                        </div>
                                    </div>
                                </div> -->
                    
                            <!-- </div>
                    </div> -->
                    <!--Row end-->  
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
                            <div class="card">
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0 text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="background-color: #222222; color: white;">Date</th>
                                                <th style="background-color: #222222; color: white;">Employee Name</th>
                                                <th style="background-color: #222222; color: white;">Puchin Time</th>
                                                <th style="background-color: #222222; color: white;">Puchout Time</th>
                                                <th style="background-color: #222222; color: white;">Total Production</th>
                                            </tr>
                                        </thead> 
                                        <?php
                                            while($data2=mysqli_fetch_array($data1))
                                            {                                      
                                        ?> 
                                        <tr>
                                            <td><?php echo $data2['attendance_date'] ?></td>
                                            <td><?php echo $fetch_data['employee_name'] ?></td>
                                            <td><?php echo $data2['punch_in'] ?></td>
                                            <td><?php echo $data2['punch_out'] ?></td>
                                            <td><?php echo $data2['total_production'] ?></td> 
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
        </div>
    <!-- </form> -->

    <!-- start: template setting, and more. -->
        <?php
            // Include the Theme
            include 'setting.php';
        ?>
    
    <!-- Jquery Core Js -->  
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <script src="assets/bundles/apexcharts.bundle.js"></script>
    <!-- <script src="assets/bundles/dataTables.bundle.js"></script> -->

    <!-- Jquery Page Js -->
    <script src="../js/template.js"></script>
    <!-- <script>
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
   
    // employees circle
    $(document).ready(function() {
        var options = {
            chart: {
                height: 250,
                type: 'radialBar',
            },
            colors: ['var(--chart-color1)'],
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '70%',
                    }
                }
            },
            series: [8], // Placeholder value, replace with your actual working hours
            labels: ['Working Hours'],
        }
        var chart = new ApexCharts(
            document.querySelector("#apex-circle-chart"),
            options
        );
        chart.render();
    });
    </script> -->

    </body>
</html>