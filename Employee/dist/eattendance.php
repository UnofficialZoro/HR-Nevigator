<?php
    session_start();
    $con=mysqli_connect('localhost','root','','project');
    date_default_timezone_set("Asia/Kolkata");
    if(isset($_REQUEST['punch_in']))
    {
        $employee_name=$_REQUEST['employee_name'];
        $punch_in=date("Y-m-d H:i:s");
    
        $insert = "INSERT INTO `hr_attendence` (`employee_name`, `punch_in`) VALUES ('$employee_name', '$punch_in')";
    
        $query= mysqli_query($con,$insert);
        if(!$query) {
            die("Error: " . mysqli_error($con));
        } else {
            header("location:eattendance.php");
        }
    }

    // Punch out query 
    if(isset($_REQUEST['punch_out']))
    { 
        $id=$_REQUEST['attendence_id'];
        $punch_out=date("Y-m-d H:i:s");
        
        // Calculate the total production time
        $data="SELECT * FROM hr_attendence WHERE attendence_id='$id'";
        $data_query=mysqli_query($con,$data); 
        $data2=mysqli_fetch_array($data_query);
        $punch_in_time = strtotime($data2['punch_in']);
        $punch_out_time = strtotime($punch_out);
        $total_production_seconds = $punch_out_time - $punch_in_time;
        $hours = floor($total_production_seconds / 3600);
        $minutes = floor(($total_production_seconds / 60) % 60);
        $seconds = $total_production_seconds % 60;
        $total_production_time = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    
        // Update the hr_attendence table with the calculated total production time and punch_out time
        $update="UPDATE hr_attendence SET punch_out='$punch_out', total_production='$total_production_time' WHERE attendence_id='$id'";
        $query1=mysqli_query($con,$update);
    
        header("location:eattendance.php");
    }
    
    
    if(isset($_REQUEST['punch_out_all']))
    {
        $punch_out_all = date("Y-m-d H:i:s");
        
        // Update all attendance records with the punch_out_all time
        $update_all = "UPDATE hr_attendence SET punch_out='$punch_out_all'";
        $query_all = mysqli_query($con, $update_all);
        header("location:eattendance.php");
    }
    
    $data="SELECT * FROM hr_attendence";
    $data1=mysqli_query($con,$data);   
    
    // Fetch Name and Email Id

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
    <link rel="icon" href="hrmslogo.png" type="image/x-icon">
    <!-- Title Icon-->
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
                // Include the sidebar
                include 'eheader.php';
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
                    </div>
                    <!-- Row end -->
                    <div class="row align-item-center row-deck g-3 mb-3">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 d-flex justify-content-center" style="margin-left: 31%;">
                        <div class="card">
                            <div class="card-header py-3">
                                <h6 class="mb-0 fw-bold text-center">Today Time Utilisation</h6>
                            </div>
                            <div class="card-body d-flex flex-column align-items-center">
                                <!-- Digital Clock -->
                                <div id="digital-clock" class="fw-bold fs-4"></div>
                                <!-- End of Digital Clock -->
                                <div class="timesheet-info d-flex align-items-center justify-content-between flex-wrap">
                                    <form method="POST">
                                        <div class="intime d-flex align-items-center mt-2 justify-content-center w-100">
                                            <button type="submit" name="punch_in" class="btn btn-dark"><i class="icofont-foot-print me-2"></i>Punch In</button>
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
                            </div>
                        </div>
                    </div>

                        <!--Row end-->
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
                                                    <th style="background-color: #222222; color: white;">Action</th>
                                                </tr>
                                            </thead>
                                            <?php while($data2=mysqli_fetch_array($data1)) { ?> 
                                            <tr>
                                                <td><?php echo $data2['attendance_date'] ?></td>
                                                <td><?php echo $fetch_data['employee_name'] ?></td>
                                                <td><?php echo $data2['punch_in'] ?></td>
                                                <td><?php echo $data2['punch_out'] ?></td>
                                                <td>
                                                    <?php
                                                        // Calculate the total production time only when punch_out is not empty
                                                        if(!empty($data2['punch_out'])) {
                                                            $punch_in_time = strtotime($data2['punch_in']);
                                                            $punch_out_time = strtotime($data2['punch_out']);
                                                            $total_production_seconds = $punch_out_time - $punch_in_time;
                                                            $hours = floor($total_production_seconds / 3600);
                                                            $minutes = floor(($total_production_seconds / 60) % 60);
                                                            $seconds = $total_production_seconds % 60;
                                                            echo sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <form method="POST">
                                                        <input type="hidden" name="attendence_id" value="<?php echo $data2['attendence_id'] ?>">
                                                        <?php
                                                            // Check if punch_out is already recorded
                                                            if(empty($data2['punch_out'])) {
                                                        ?>
                                                        <button type="submit" name="punch_out" class="btn btn-dark"><i class="icofont-foot-print me-2"></i>Punch Out</button>
                                                        <?php } else { ?>
                                                        <button type="button" class="btn btn-dark" disabled><i class="icofont-foot-print me-2"></i>Punch Out</button>
                                                        <?php } ?>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php } ?>                  
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </form> -->

    <!-- start: template setting, and more. -->
    <?php
        // Include the Theme
        include 'esetting.php';
    ?>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <script src="assets/bundles/apexcharts.bundle.js"></script>
    <!-- <script src="assets/bundles/dataTables.bundle.js"></script> -->

    <!-- Jquery Page Js -->
    <script src="../js/template.js"></script>

    <!-- JavaScript code to update the digital clock -->
    <script>
        // Function to update the digital clock
        function updateDigitalClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('digital-clock').textContent = hours + ":" + minutes + ":" + seconds;
        }

        // Call the function initially
        updateDigitalClock();

        // Update the clock every second
        setInterval(updateDigitalClock, 1000);
    </script>
</body>

</html>
