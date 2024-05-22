<?php
session_start();
$con=mysqli_connect("localhost","root","","project");

if(isset($_REQUEST['btncreate1']))
{
    $project_name=mysqli_real_escape_string($con,$_REQUEST['project_name']);
    $project_category=$_REQUEST['project_category'];
    $start_date=$_REQUEST['start_date'];
    $end_date=$_REQUEST['end_date'];
    $task_assign_person=$_REQUEST['task_assign_person'];
    $description=mysqli_real_escape_string($con,$_REQUEST['description']);

    $insert="INSERT INTO hr_project (project_name,project_category,`start_date`,end_date,task_assign_person,`description`) values ('$project_name','$project_category','$start_date','$end_date','$task_assign_person','$description')";
    mysqli_query($con,$insert);  
    header("location:eprojects.php");
}

// Fetch Data
$id= $_SESSION['employee_id'];
$result="SELECT * FROM hr_employee where employee_id='$id'";
$query2=mysqli_query($con,$result);
$fetch_data=mysqli_fetch_array($query2);

$name=$fetch_data['employee_name'];

// Check if search query is submitted
if(isset($_POST['search_query'])) {
    $search_query = mysqli_real_escape_string($con, $_POST['search_query']);
    $data = "SELECT * FROM hr_project WHERE task_assign_person='$name' AND (project_name LIKE '%$search_query%' OR project_category LIKE '%$search_query%' OR description LIKE '%$search_query%')";
} else {
    $data = "SELECT * FROM hr_project WHERE task_assign_person='$name'";
}

$data1 = mysqli_query($con, $data);

// Delete Query
if(isset($_REQUEST['delete']))
{
    $id=$_REQUEST['delete'];
    $delete="SELECT * FROM hr_project where project_id='$id'";
    $res=mysqli_query($con,$delete);
    $row=mysqli_fetch_array($res);
    $delete="DELETE FROM hr_project where project_id='$id'";
    mysqli_query($con,$delete);
    header('location:eprojects.php');
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
    
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>
<body  data-mytask="theme-indigo">

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

    <!-- main body area -->
    <div class="main px-lg-4 px-md-4">

        <!-- Body: Body -->
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header p-0 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold py-3 mb-0">Projects</h3>
                            <div class="d-flex py-2 project-tab flex-wrap w-sm-100">
                              <!-- <button type="submit" name="btnproject" class="btn btn-dark w-sm-100" data-bs-toggle="modal" data-bs-target="#createproject"><i class="icofont-plus-circle me-2 fs-6"></i>Create Project</button></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Add Search Box -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="POST" action="eprojects.php">
                    <div class="input-group" style="width: 40%; margin-left:164%">
                        <input type="text" class="form-control" placeholder="Search Project" name="search_query">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Table Data -->
        <div class="row clearfix g-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                            <table id="myProjectTable" class="table table-hover align-middle mb-0 text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th>Project Id</th> -->
                                    <th style="background-color: #222222; color: white;">Project Name</th>
                                    <th style="background-color: #222222; color: white;">Project Category</th>
                                    <th style="background-color: #222222; color: white;">Start Time</th>
                                    <th style="background-color: #222222; color: white;">End Time</th>
                                    <!-- <th>Task Assign Person</th> -->
                                    <th style="background-color: #222222; color: white;">Description</th>
                                    <th style="background-color: #222222; color: white;">Date & Time</th>
                                    <!-- <th colspan="2">Action</th>                   -->
                                </tr>
                            </thead>   
                            <!-- Fetch Data Query -->
                            <?php 
                                while($data2=mysqli_fetch_array($data1))
                                {
                            ?>  
                            <tr>
                                <!-- <td><?php echo $data2['project_id']?></td> -->
                                <td><b><?php echo $data2['project_name']?></b></td>
                                <td><?php echo $data2['project_category']?></td>
                                <td><?php echo $data2['start_date']?></td>
                                <td><?php echo $data2['end_date']?></td>
                                <!-- <td><?php echo $data2['task_assign_person']?></td> -->
                                <td><?php echo $data2['description']?></td>
                                <td><?php echo $data2['date_time']?></td>
                                <!-- <td><a href="epredit.php?edit=<?php echo $data2['project_id']; ?>"><i class="icofont-edit" id="model"></i></a></td>	    
                                <td><a href="eprojects.php?delete=<?php echo $data2['project_id']; ?>" onclick="return confirm ('Are You Sure?')"><i class="icofont-ui-delete"></i></a></td>	                                                 -->
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

    <!-- start: template setting, and more. -->
    <?php
        // Include the Theme
        include 'esetting.php';
    ?>
</div> 

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>

<!-- Jquery Page Js -->
<script src="../js/template.js"></script>

</body>
</html>
