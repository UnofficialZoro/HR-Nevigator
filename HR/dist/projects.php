<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "project");

// Data Insert in localhost
if(isset($_REQUEST['btncreate1'])) {
    // Escape user inputs to prevent SQL injection
    $project_name = mysqli_real_escape_string($con, $_REQUEST['project_name']);
    $project_category = $_REQUEST['project_category'];
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];
    $task_assign_person = $_REQUEST['task_assign_person'];
    $description = mysqli_real_escape_string($con, $_REQUEST['description']);

    // Insert data into hr_project table
    $insert = "INSERT INTO hr_project (project_name, project_category, `start_date`, end_date, task_assign_person, `description`) VALUES ('$project_name', '$project_category', '$start_date', '$end_date', '$task_assign_person', '$description')";
    mysqli_query($con, $insert);
    header("location:projects.php");
}

// Fetch Data
$data = "SELECT * FROM hr_project";
$data1 = mysqli_query($con, $data);

// Delete Query
if(isset($_REQUEST['delete'])) {
    $id = $_REQUEST['delete'];
    $delete = "DELETE FROM hr_project WHERE project_id='$id'";
    mysqli_query($con, $delete);
    header('location:projects.php');
}

// Search button
if(isset($_REQUEST['btnsearch'])) {
    $txtsearch = $_REQUEST['txtsearch'];
    $data = "SELECT * FROM hr_project WHERE task_assign_person LIKE '%$txtsearch%'";
    $data1 = mysqli_query($con, $data);
} else {
    $data = "SELECT * FROM hr_project";
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
    
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>
<body  data-mytask="theme-indigo">

<div id="mytask-layout">
    
    <!-- sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- main body area -->
    <div class="main px-lg-4 px-md-4">
        <!-- Body: Header -->
        <?php include 'header.php'; ?>

        <!-- Body: Body -->
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header p-0 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold py-3 mb-0">Projects</h3>
                            <div class="d-flex py-2 project-tab flex-wrap w-sm-100">
                                <a href="projects_category.php">
                                    <button type="submit" name="btncategory" class="btn btn-dark w-sm-100" data-bs-toggle="modal">
                                        <i class="icofont-plus-circle me-2 fs-6"></i>Add Category
                                    </button>
                                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" name="btnproject" class="btn btn-dark w-sm-100" data-bs-toggle="modal" data-bs-target="#createproject">
                                    <i class="icofont-plus-circle me-2 fs-6"></i>Create Project
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Project modal -->
        <form method="post">
        <div class="modal fade" id="createproject" tabindex="-1"  aria-hidden="true" id="model">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Create Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput77" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput77" name="project_name" placeholder="Explain what the Project Name">
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Project Category</label>
                        <select class="form-select" name="project_category" aria-label="Default select Project Category">
                            <option style="display: none">Select Category</option>
                            <?php
                                    $delete1="SELECT * FROM project_category";
                                    $res1=mysqli_query($con,$delete1);
                                    while($fetch=mysqli_fetch_array($res1)){
                                ?>
                                <option  value="<?php echo $fetch['category'];?>" ><?php echo $fetch['category'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="deadline-form">
                        <form>
                            <div class="row g-3 mb-3">
                              <div class="col">
                                <label for="datepickerded" class="form-label">Project Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="datepickerded">
                              </div>
                              <div class="col">
                                <label for="datepickerdedone" class="form-label">Project End Date</label>
                                <input type="date" class="form-control" name="end_date" id="datepickerdedone">
                              </div>
                            </div>
                            <div class="row g-3 mb-3">
                               
                                <div class="col-sm-12">
                                    <label for="formFileMultipleone" class="form-label">Task Assign Person</label>
                                    <select class="form-select" name="task_assign_person">
                                        <option style="display: none;">Task Assign Person</option>
                                    <?php
                                        $employeeQuery = "SELECT * FROM hr_employee";
                                        $res1 = mysqli_query($con, $employeeQuery);

                                        while ($fetch = mysqli_fetch_array($res1)) {
                                            $employeeName = @$fetch['employee_name']; 
                                        ?>
                                            <option value="<?php echo $employeeName; ?>" <?php if (@$edit_fetch['employee_name'] == $employeeName) { ?> selected <?php } ?>>
                                                <?php echo $employeeName; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea78" class="form-label">Description (optional)</label>
                        <textarea class="form-control" id="exampleFormControlTextarea78" rows="3" name="description" placeholder="Add any extra details about the request"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="submit" name="btncreate1" class="btn btn-primary">Submit</button>
                </div>
            </div>
            </div>
        </div>
    </form>    

    <!-- Search form -->
    <div class="row py-3" style="margin-left:50%;">
        <div class="col-md-6 offset-md-6">
            <form method="POST" class="d-flex">
                <input type="text" class="form-control me-2" name="txtsearch" placeholder="Search...">
                <button type="submit" class="btn btn-primary" name="btnsearch">Search</button>
            </form>
        </div>
    </div>

    <!-- Table to display project data -->
<div class="row clearfix g-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <table id="myProjectTable" class="table table-hover align-middle mb-0 text-center" style="width:100%">
                    <!-- Table headers -->
                    <thead>
                        <tr>
                            <th style="background-color: #222222; color: white;">Project Name</th>
                            <th style="background-color: #222222; color: white;">Project Category</th>
                            <th style="background-color: #222222; color: white;">Start Time</th>
                            <th style="background-color: #222222; color: white;">End Time</th>
                            <th style="background-color: #222222; color: white;">Task Assign Person</th>
                            <th style="background-color: #222222; color: white;">Description</th>
                            <th style="background-color: #222222; color: white;">Date & Time</th>
                            <th colspan="2" style="background-color: #222222; color: white;">Action</th>                  
                        </tr>
                    </thead>   
                    <!-- Fetch Data Query -->
                    <?php 
                        while($data2=mysqli_fetch_array($data1)) {
                    ?>  
                        <tr>
                            <td><b><?php echo $data2['project_name']?></b></td>
                            <td><?php echo $data2['project_category']?></td>
                            <td><?php echo $data2['start_date']?></td>
                            <td><?php echo $data2['end_date']?></td>
                            <td><b><?php echo $data2['task_assign_person']?></b></td>
                            <td><?php echo $data2['description']?></td>
                            <td><?php echo $data2['date_time']?></td>
                            <td>
                                <a href="predit.php?edit=<?php echo $data2['project_id']; ?>" onclick="return confirm ('Are You Sure?')">
                                    <i class="icofont-edit" id="model"></i>
                                </a>
                            </td>
                            <td>
                                <a href="projects.php?delete=<?php echo $data2['project_id']; ?>" onclick="return confirm ('Are You Sure?')">
                                    <i class="icofont-ui-delete"></i>
                                </a>
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


<!-- Include template settings -->
<?php include 'setting.php'; ?>
</div> 

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>

<!-- Jquery Page Js -->
<script src="../js/template.js"></script>

</body>
</html>
