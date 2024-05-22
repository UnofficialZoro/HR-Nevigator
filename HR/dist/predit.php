<?php
    $con = mysqli_connect('localhost', 'root', '', 'project');
    
    $id = $_REQUEST['edit'];
    $edit = "SELECT * FROM hr_project WHERE project_id='$id'";  
    $edit_executed = mysqli_query($con, $edit);
    $edit_fetch = mysqli_fetch_array($edit_executed);
    
    if (isset($_REQUEST['btnedit_update'])) {
        $project_name = mysqli_real_escape_string($con, $_REQUEST['project_name']);
        $project_category = $_REQUEST['project_category'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        $task_assign_person = $_REQUEST['task_assign_person'];
        $description = mysqli_real_escape_string($con, $_REQUEST['description']);
    
        $update = "UPDATE hr_project SET project_name='$project_name', project_category='$project_category', `start_date`='$start_date', end_date='$end_date', task_assign_person='$task_assign_person', `description`='$description' WHERE project_id='$id'";
        mysqli_query($con, $update);
        header('location: projects.php');
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
    <h2>Edit Projects</h2>
    <form  method="post">

      <label for="projectName">Project Name:</label>
      <input type="text" id="projectName" name="project_name" value="<?php echo @$edit_fetch['project_name']; ?>" >

      <label for="projectCateogry">Project Category:</label>
        <select class="form-select" name="project_category" aria-label="Default select Project Category">
            <option style="display: none;">Select Category</option>
                <option <?php if( @$edit_fetch['project_category']=='UI/UX Design' ){?> selected <?php }?>>UI/UX Design</option>
                <option <?php if( @$edit_fetch['project_category']=='Website Design' ){?> selected <?php }?>>Website Design</option>
                <option <?php if( @$edit_fetch['project_category']=='App Development' ){?> selected <?php }?>>App Development</option>
                <option <?php if( @$edit_fetch['project_category']=='Backend Development' ){?> selected <?php }?>>Backend Development</option>
        </select>

      <label for="startTime">Start Time:</label>
      <input type="date" id="startTime" name="start_date" value="<?php echo @$edit_fetch['start_date']; ?>" >

      <label for="endTime">End Time:</label>
      <input type="date" id="endTime" name="end_date" value="<?php echo @$edit_fetch['end_date']; ?>" >

      <label for="taskassignperson">Task Assign Person:</label>
        <select class="form-select" name="task_assign_person">
          <option style="display: none;">Task Assign Person</option>
            <?php
                $employeeQuery = "SELECT * FROM hr_employee";
                $res1 = mysqli_query($con, $employeeQuery);

                while ($fetch = mysqli_fetch_array($res1)) {
                    $employeeName = @$fetch['employee_name']; // Adjust column name accordingly
                ?>
                    <option value="<?php echo $employeeName; ?>" <?php if (@$edit_fetch['task_assign_person'] == $employeeName) { ?> selected <?php } ?>>
                        <?php echo $employeeName; ?>
                    </option>
                <?php
                }
                ?>
        </select>
      <label for="projectDescription">Description:</label>
      <textarea id="projectDescription" name="description" rows="3" ><?php echo @$edit_fetch['description']; ?></textarea><br>

      <button type="submit" name="btnedit_update">Edit Project</button>
    </form>
  </div>

</body>
</html>
