<?php
    $con=mysqli_connect('localhost','root','','project');

    if(isset($_REQUEST['btncreate']))
    {
        $employee_name=$_REQUEST['employee_name'];
        $joining_date=$_REQUEST['join_date'];
        $email_id=$_REQUEST['email_id'];
        $password=$_REQUEST['password'];
        $contact_no=$_REQUEST['contact_no']; 
        $department=$_REQUEST['department'];
        $desgination=$_REQUEST['desgination']; 
        $address=$_REQUEST['address']; 

        $insert="INSERT INTO hr_employee(employee_name, join_date,`password`, email_id, contact_no, department, desgination, `address`) VALUES ('$employee_name','$joining_date','$password','$email_id','$contact_no','$department','$desgination','$address')";
        mysqli_query($con,$insert);
        header("location:members.php");

    }   
    // fetch query
    $data="SELECT * FROM hr_employee";
    $data1=mysqli_query($con,$data);
    
    //Delete query
    if(isset($_REQUEST['delete']))
    {
        $id=$_REQUEST['delete'];
        $delete="SELECT * FROM hr_employee where employee_id='$id'";
        $res=mysqli_query($con,$delete);
        $row=mysqli_fetch_array($res);
        $delete="DELETE FROM hr_employee WHERE employee_id='$id'";
        mysqli_query($con,$delete);
        header("location:members.php");
    } 

?>

<!Doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>:: HR Navigator ::</title>
    <link rel="icon" href="hrmslogo.png" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>
<body  data-mytask="theme-indigo">

<div id="mytask-layout">

    <!-- sidebar -->
    <?php
        // Include The Sidebar
        include 'sidebar.php';
    ?>
            
    <!-- main body area -->
    <div class="main px-lg-4 px-md-4">

        <!-- Body: Header -->
        <?php
        // Include The Header
        include 'header.php';
    ?>

        <!-- Body: Body -->
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="card border-0 mb-4 no-bg">
                            <div class="card-header py-3 px-0 d-sm-flex align-items-center  justify-content-between border-bottom">
                                <h3 class=" fw-bold flex-fill mb-0 mt-sm-0">Employee</h3>
                                <button type="button" class="btn btn-dark me-1 mt-1 w-sm-100" data-bs-toggle="modal" data-bs-target="#createemp"><i class="icofont-plus-circle me-2 fs-6"></i>Add Employee</button>
                                <!-- <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle mt-1  w-sm-100" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        Status
                                    </button>
                                    <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item" href="#">All</a></li>
                                    <li><a class="dropdown-item" href="#">Task Assign Members</a></li>
                                    <li><a class="dropdown-item" href="#">Not Assign Members</a></li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
            </div>
        </div>
        <div class="row clearfix g-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                            <table id="myProjectTable" class="table table-hover align-middle mb-0 text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="background-color: #222222; color: white;">Employee Id</th>
                                    <th style="background-color: #222222; color: white;">Employee Name</th>
                                    <th style="background-color: #222222; color: white;">Join Date</th>
                                    <th style="background-color: #222222; color: white;">Email Id</th>
                                    <th style="background-color: #222222; color: white;">Password</th>
                                    <th style="background-color: #222222; color: white;">Mobile No</th>
                                    <th style="background-color: #222222; color: white;">Department</th>
                                    <th style="background-color: #222222; color: white;">Desgination</th>
                                    <th style="background-color: #222222; color: white;">Address</th>
                                    <th colspan="2" style="background-color: #222222; color: white;">Action</th>                  
                                </tr>
                            </thead>   
                            <!-- Fetch Data Query -->
                            <?php
                                while($data2=mysqli_fetch_array($data1))
                                {
                            ?>
                            <tr>
                                <td><?php echo $data2['employee_id'] ?></td>
                                <td><?php echo $data2['employee_name'] ?></td>
                                <td><?php echo $data2['join_date'] ?></td>
                                <td><?php echo $data2['email_id'] ?></td>
                                <td><?php echo $data2['password'] ?></td>
                                <td><?php echo $data2['contact_no'] ?></td>
                                <td><?php echo $data2['department'] ?></td>
                                <td><?php echo $data2['desgination'] ?></td>
                                <td><?php echo $data2['address'] ?></td>
                                <td><a href="meedit.php?edit=<?php echo $data2['employee_id']; ?>"onclick="return confirm ('Are You Sure?')"><i class="icofont-edit" id="model"></i></a></td>
                                <td><a href="members.php?delete=<?php echo $data2['employee_id']; ?>"onclick="return confirm ('Are You Sure?')"><i class="icofont-ui-delete"></i></a></td>
                            </tr>
                            <?php
                                }                            
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Employee-->
        <form method="POST">
        <div class="modal fade" id="createemp" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Add Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput877" class="form-label">Employee Name</label>
                            <input type="text" name="employee_name" class="form-control" id="exampleFormControlInput877" placeholder="Employee Name">
                        </div>
                        <div class="deadline-form">
                            
                                <div class="row g-3 mb-3">
                                    <div class="col-sm-6">
                                        <label for="exampleFormControlInput2778" class="form-label">Joining Date</label>
                                        <input type="date" name="join_date" class="form-control" id="exampleFormControlInput2778">
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="exampleFormControlInput277" class="form-label">Password</label>
                                    <input type="Password" name="password" class="form-control" id="exampleFormControlInput277" placeholder="Password">
                                </div>
                                </div> 
                                <div class="row g-3 mb-3">
                                    <div class="col">
                                        <label for="exampleFormControlInput477" class="form-label">Email ID</label>
                                        <input type="email" name="email_id" class="form-control" id="exampleFormControlInput477" placeholder="Email Id">
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlInput777" class="form-label">Mobile No</label>
                                        <input type="text" name="contact_no" class="form-control" id="exampleFormControlInput777" placeholder="Mobile No">
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col">
                                        <label  class="form-label">Department</label>
                                        <select class="form-select" name="department" aria-label="Default select Project Category">
                                            <option style="display: none;">Select Deapartment</option>
                                            <option>Web Development</option>
                                            <option>It Management</option>
                                            <option>Marketing</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label  class="form-label">Designation</label>
                                        <select class="form-select" name="desgination" aria-label="Default select Project Category">
                                        <option style="display:none">Select Designation</option>
                                        <option>UI/UX Design</option>
                                        <option>Website Design</option>
                                        <option>App Development</option>
                                        <option>Backend Development</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="mb-3">          
                            <label for="exampleFormControlTextarea78" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="exampleFormControlTextarea78" rows="3" placeholder="Add any extra details of your address"></textarea>
                        </div> 
                        <!-- <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>Project Permission</th>
                                        <th class="text-center">Read</th>
                                        <th class="text-center">Write</th>
                                        <th class="text-center">Create</th>
                                        <th class="text-center">Delete</th>
                                        <th class="text-center">Import</th>
                                        <th class="text-center">Export</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Projects</td>
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" checked>
                                        </td>
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2" checked>
                                        </td>
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3" checked>
                                        </td>
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4" checked>
                                        </td>
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5" checked>
                                        </td>
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault6" checked>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="fw-bold">Tasks</td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault7" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault8" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault9" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault10" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault11" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault12" checked>
                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="fw-bold">Chat</td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault13" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault14" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault15" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault16" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault17" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault18" checked>
                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="fw-bold">Estimates</td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault19" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault20" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault21" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault22" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault23" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault24" checked>
                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="fw-bold">Invoices</td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault25" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault26">
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault27" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault28">
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault29" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault30" checked>
                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="fw-bold">Timing Sheets</td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault31" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault32" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault33" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault34" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault35" checked>
                        
                                        </td>
                                        <td class="text-center">
                        
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault36" checked>
                        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        <button type="submit" name="btncreate" class="btn btn-primary">Create</button>
                    </div> 
                </div>  
            </div>
        </div>
    </div>
    </form>
    <!-- start: template setting, and more. -->
	<?php
        include 'setting.php';
    ?>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>


<!-- Jquery Page Js -->
<script src="../js/template.js"></script>
</body>
</html>