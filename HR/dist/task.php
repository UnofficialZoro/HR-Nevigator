<?php
    $con=mysqli_connect('localhost','root','','project');

    if (isset($_REQUEST['btncreate'])) {
        $task_name =mysqli_real_escape_string($con, $_REQUEST['task_name']);
        $task_category = $_REQUEST['task_category'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        $task_assign_person = $_REQUEST['task_assign_person'];
        $task_priority = $_REQUEST['task_priority'];
        $description = mysqli_real_escape_string($con,$_REQUEST['description']);

        $insert = "INSERT INTO hr_task (task_name, task_category, `start_date`, end_date, task_assign_person, task_priority, `description`) VALUES ('$task_name', '$task_category', '$start_date', '$end_date', '$task_assign_person', '$task_priority', '$description')";
        mysqli_query($con, $insert);
        header("location:task.php");
    }

    // Data in localhost
   
    $data="SELECT * FROM hr_task";
    $data1=mysqli_query($con,$data);
    
    //Delete Query

    if(isset($_REQUEST['delete']))
    {
        $id=$_REQUEST['delete'];
        $delete="SELECT * FROM hr_task where task_id='$id'";
        $res=mysqli_query($con,$delete);
        $row=mysqli_fetch_array($res);
        $delete="DELETE FROM hr_task where task_id='$id'";
        mysqli_query($con,$delete);
        header("location:task.php");
    }

        // Search button
    if(isset($_REQUEST['btnsearch'])) {
        $txtsearch = $_REQUEST['txtsearch'];
        $data = "SELECT * FROM hr_task WHERE task_assign_person LIKE '%$txtsearch%'";
        $data1 = mysqli_query($con, $data);
    } else {
        $data = "SELECT * FROM hr_task";
        $data1 = mysqli_query($con, $data);
}
?>
<!Doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>:: HR Navigator ::</title>
    <link rel="icon" href="hrmslogo.png" type="image/x-icon"> <!-- Title Icon-->
    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/nestable/jquery-nestable.css"/>
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
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Task Management</h3>
                            
                            <div class="col-auto d-flex w-sm-100">
                                <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#createtask"><i class="icofont-plus-circle me-2 fs-6"></i>Create Task</button>
                            </div>
                        </div>
                    </div>
                </div> 

        <!-- Create task-->
        <form method="POST">
        <div class="modal fade" id="createtask" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Create Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label  class="form-label">Task Name</label>
                        <input type="text" name="task_name" class="form-control" id="exampleFormControlInput877" placeholder="Task Name">

                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Project Name:</label>
                        <select class="form-select" name="task_category" aria-label="Default select Project Category">
                            <option style="display: none;">Select Project Name</option>
                            <?php
                                    $delete1="SELECT * FROM hr_project";
                                    $res1=mysqli_query($con,$delete1);
                                    while($fetch=mysqli_fetch_array($res1)){
                                ?>
                                <option  value="<?php echo $fetch['project_name'];?>" ><?php echo $fetch['project_name'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="deadline-form mb-3">
                        <form>
                            <div class="row">
                              <div class="col">
                                <label for="datepickerded" class="form-label">Task Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="datepickerded">
                              </div>
                              <div class="col">
                                <label for="datepickerdedone" class="form-label">Task End Date</label>
                                <input type="date" class="form-control" name="end_date" id="datepickerdedone">
                              </div>
                            </div>
                        </form>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm">
                            <label  class="form-label">Task Assign Person</label>
                            <select name="task_assign_person" class="form-select" >
                                <option style="display: none;">Select Task Person Name</option>
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
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm">
                            <label  class="form-label">Task Priority</label>
                            <select name="task_priority" class="form-select" aria-label="Default select Priority">
                                <option style="display: none;">Select Priority</option>
                                <option>Lowest</option>
                                <option>Low</option>
                                <option>Medium</option>
                                <option>Highest</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea786" class="form-label">Description (optional)</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea786" rows="3" placeholder="Add any extra details about the request"></textarea>
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

    <div class="row clearfix g-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table id="myProjectTable" class="table table-hover align-middle mb-0 text-center" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>Task Id</th> -->
                                <th style="background-color: #222222; color: white;">Task Name</th>
                                <th style="background-color: #222222; color: white;">Task Category</th>
                                <th style="background-color: #222222; color: white;">Start Time</th>
                                <th style="background-color: #222222; color: white;">End Time</th>
                                <th style="background-color: #222222; color: white;">Task Assign Person</th>
                                <th style="background-color: #222222; color: white;">Task Priority</th>
                                <th style="background-color: #222222; color: white;">Description</th>
                                <th style="background-color: #222222; color: white;">Date & Time</th>
                                <th colspan="2" style="background-color: #222222; color: white;">Action</th>                  
                            </tr>
                        </thead>    
                        <?php 
                            while($data2=mysqli_fetch_array($data1))
                            {
                        ?>
                        
                        <tr>
                            <!-- <td><?php echo $data2['task_id']?></td> -->
                            <td><?php echo $data2['task_name']?></td>
                            <td><?php echo $data2['task_category']?></td>
                            <td><?php echo $data2['start_date']?></td>
                            <td><?php echo $data2['end_date']?></td>
                            <td><b><?php echo $data2['task_assign_person']?></b></td>
                            <td><?php echo $data2['task_priority']?></td>
                            <td><?php echo $data2['description']?></td>
                            <td><?php echo $data2['date_time']?></td>
                            <td><a href="taedit.php?edit=<?php echo $data2['task_id']; ?>"onclick="return confirm ('Are You Sure?')"><i class="icofont-edit"></i></a></td>	    
                            <td><a href="task.php?delete=<?php echo $data2['task_id']; ?>" onclick="return confirm ('Are You Sure?')"><i class="icofont-ui-delete"></i></a></td>

                        </tr>

                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- start: template setting, and more. -->
	<?php
        // Include the Theme
        include 'setting.php';
    ?>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>

<!-- <script src="assets/bundles/dataTables.bundle.js"></script> -->

<!-- Plugin Js-->
<script src="assets/bundles/nestable.bundle.js"></script>



<!-- Jquery Page Js -->
<script src="../js/template.js"></script>
<script src="../js/page/task.js"></script>

</body>

<!-- Mirrored from pixelwibes.com/template/my-task/html/dist/task.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Dec 2023 06:24:12 GMT -->
</html>
