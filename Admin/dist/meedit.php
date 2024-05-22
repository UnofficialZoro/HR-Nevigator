<?php
    $con=mysqli_connect('localhost','root','','project');
    
    $id = $_REQUEST['edit'];
    $edit = "SELECT * FROM hr_employee WHERE employee_id='$id'";  
    $edit_executed = mysqli_query($con, $edit);
    $edit_fetch = mysqli_fetch_array($edit_executed);

    if(isset($_REQUEST['btnedit_update']))
    {
        $employee_name=$_REQUEST['employee_name'];
        $join_date=$_REQUEST['join_date'];
        $email_id=$_REQUEST['email_id'];
        $password=$_REQUEST['password'];
        $contact_no=$_REQUEST['contact_no']; 
        $department=$_REQUEST['department'];
        $desgination=$_REQUEST['desgination']; 
        $address=$_REQUEST['address']; 

        $update="UPDATE hr_employee SET employee_name='$employee_name',join_date='$join_date',email_id='$email_id',`password`='$password',contact_no='$contact_no',department='$department',desgination='$desgination',`address`='$address' WHERE employee_id='$id'";
        mysqli_query($con,$update);
        header('location:members.php');
    }
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

    input, select, textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: purple;
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
    <h2>Edit Members</h2>
    <form method="post">

      <label for="empName">Employee Name:</label>
      <input type="text" id="empName" name="employee_name" value="<?php echo @$edit_fetch['employee_name']; ?>">

      <label for="joinDate">Join Date:</label>
      <input type="date" name="join_date" value="<?php echo @$edit_fetch['join_date']; ?>">

      <label for="emailId">Email Id:</label>
      <input type="email" name="email_id" value="<?php echo @$edit_fetch['email_id']; ?>">

      <label for="password">Password:</label>
      <input type="text" name="password" value="<?php echo @$edit_fetch['password']; ?>">

      <label for="contactNo">Mobile No:</label>
      <input type="text" name="contact_no" value="<?php echo @$edit_fetch['contact_no']; ?>">

      <div class="row g-3 mb-3">
        <div class="col">
            <label  class="form-label">Department</label>
            <select class="form-select" name="department" aria-label="Default select Department">
                <option style="display: none;">Select Department</option>
                <option <?php if( @$edit_fetch['department']=='Web Development' ){?> selected <?php }?>>Web Development</option>
                <option <?php if( @$edit_fetch['department']=='It Management' ){?> selected <?php }?>>IT Management</option>
                <option <?php if( @$edit_fetch['department']=='Marketing' ){?> selected <?php }?>>Marketing</option>
            </select>
        </div>
        <div class="col">
            <label  class="form-label">Designation</label>
            <select class="form-select" name="desgination" aria-label="Default select Designation">
                <option style="display: none;">Select Designation</option>
                <option <?php if( @$edit_fetch['desgination']=='UI/UX Design' ){?> selected <?php }?>>UI/UX Design</option>
                <option <?php if( @$edit_fetch['desgination']=='Website Design' ){?> selected <?php }?>>Website Design</option>
                <option <?php if( @$edit_fetch['desgination']=='App Development' ){?> selected <?php }?>>App Development</option>
                <option <?php if( @$edit_fetch['desgination']=='Backend Development' ){?> selected <?php }?>>Backend Development</option>
            </select>
        </div>
      </div>

      <label for="projectAddress">Address:</label>
      <textarea id="projectAddress" name="address" rows="3"><?php echo @$edit_fetch['address']; ?></textarea><br>

      <button type="submit" name="btnedit_update">Edit Member</button>
    </form>
  </div>

</body>
</html>
