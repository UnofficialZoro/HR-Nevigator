<?php
  session_start();
  $con=mysqli_connect('localhost','root','','project');
  
  $id = $_REQUEST['edit'];
  $edit = "SELECT * FROM hr_leave WHERE leave_id='$id'";  
  $edit_executed = mysqli_query($con, $edit);
  $edit_fetch = mysqli_fetch_array($edit_executed);

  if(isset($_REQUEST['btnedit_update']))
  {
    $employee_name=mysqli_real_escape_string($con,$_REQUEST['employee_name']);
    $leave_type=$_REQUEST['leave_type'];
    $start_date=$_REQUEST['start_date'];
    $end_date=$_REQUEST['end_date'];
    $leave_reason=mysqli_real_escape_string($con,$_REQUEST['leave_reason']);

    $update="UPDATE hr_leave SET employee_name='$employee_name',leave_type='$leave_type',`start_date`='$start_date',end_date='$start_date',leave_reason='$leave_reason' WHERE leave_id='$id'";
    mysqli_query($con,$update);
    header('location:eleave.php');
  }
    $id= $_SESSION['employee_id'];
    $result="SELECT * FROM hr_employee where employee_id='$id'";
    $query2=mysqli_query($con,$result);
    $fetch_data=mysqli_fetch_array($query2);

    $name=$fetch_data['employee_name'];
    $data="SELECT * FROM hr_leave WHERE employee_name='$name'";
    $data1=mysqli_query($con,$data);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>:: HR Navigator ::</title>
  
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input, select {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    

    button {
      background-color:purple ;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Edit Leave</h2>
    <form  method="post">

      <label for="projectName">Employee Name:</label>
      <select name="employee_name" class="form-select">
        <!-- <option style="display: none;"> Select Name</option> -->
        <?php
            $id = $_SESSION['employee_id'];
            $employeeQuery = "SELECT * FROM hr_employee WHERE employee_id='$id'";
            $employeeResult = mysqli_query($con, $employeeQuery);

            while ($employee = mysqli_fetch_array($employeeResult)) {
                $employeeName = $employee['employee_name'];

            ?>
                <option <?php if (@$edit_fetch['employee_name'] == $employeeName) { ?> selected <?php } ?>>
                    <?php echo $employeeName; ?>
                </option>
            <?php
            }
            ?>
        </select>
      <label for="projectCateogry">Leave Type:</label>
        <select class="form-select" name="leave_type">
            <option style="display: none;">Select Leave Type</option>
            <option <?php if( @$edit_fetch['leave_type']=='Medical Leave' ){?> selected <?php }?>>Medical Leave</option>
            <option <?php if( @$edit_fetch['leave_type']=='Casual Leave' ){?> selected <?php }?>>Casual Leave</option>
            <option <?php if( @$edit_fetch['leave_type']=='Maternity Leave' ){?> selected <?php }?>>Maternity Leave</option>
        </select>

      <label for="startTime">Leave Start Date:</label>
      <input type="date" id="startTime" name="start_date" value="<?php echo @$edit_fetch['start_date']; ?>" >

      <label for="startTime">Leave End Date:</label>
      <input type="date" id="endTime" name="end_date" value="<?php echo @$edit_fetch['end_date']; ?>" >

      <label for="projectDescription">Leave Reason:</label>
      <textarea id="projectDescription" name="leave_reason" rows="3" ><?php echo @$edit_fetch['leave_reason']; ?></textarea><br>

      <button type="submit" name="btnedit_update">Edit Leave</button>
    </form>
  </div>

</body>
</html>