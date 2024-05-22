<?php
    $con=mysqli_connect('localhost','root','','project');

    $id = $_REQUEST['edit'];
    $edit = "SELECT * FROM hr_report WHERE report_id='$id'";  
    $edit_executed = mysqli_query($con, $edit);
    $edit_fetch = mysqli_fetch_array($edit_executed);

    if (isset($_REQUEST['btnedit_update'])) {
        $report_subject = mysqli_real_escape_string($con, $_REQUEST['report_subject']);
        $assign_name = mysqli_real_escape_string($con, $_REQUEST['assign_name']);
        $created_date=$_REQUEST['created_date'];

        $update="UPDATE hr_report SET report_subject='$report_subject',assign_name='$assign_name',created_date='$created_date' WHERE report_id='$id' ";
        mysqli_query($con,$update);
        header('location:report.php');
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
    <h2>Edit Reports</h2>
    <form  method="post">

      <label for="subjectName">Subject:</label>
      <input type="text" id="subject" name="report_subject" value="<?php echo @$edit_fetch['report_subject']; ?>">

      <label for="projectCategory">Assigned Name:</label>
      <select name="assign_name" class="form-select">
        <option style="display: none;">Select Name</option>
        <?php
          $employeeQuery = "SELECT * FROM hr_employee";
          $employeeResult = mysqli_query($con, $employeeQuery);

          while ($employee = mysqli_fetch_array($employeeResult)) {
              $employeeName = $employee['employee_name'];

          ?>
              <option <?php if (@$edit_fetch['assign_name'] == $employeeName) { ?> selected <?php } ?>>
                  <?php echo $employeeName; ?>
              </option>
          <?php
          }
          ?>
</select>

      </select>      
      <label for="startTime">Created Date:</label>
      <input type="date" id="startTime" name="created_date" value="<?php echo @$edit_fetch['created_date']; ?>" >

      <button type="submit" name="btnedit_update">Edit Report</button>
    </form>
  </div>

</body>
</html>
