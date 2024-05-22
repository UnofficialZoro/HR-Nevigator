<?php
session_start();
    $con = mysqli_connect('localhost', 'root', '', 'project');
    
    $id = $_REQUEST['edit'];
    $edit = "SELECT * FROM hr_task WHERE task_id='$id'";  
    $edit_executed = mysqli_query($con, $edit);
    $edit_fetch = mysqli_fetch_array($edit_executed);
    
    if (isset($_REQUEST['btnedit_update'])) {
        $task_name = mysqli_real_escape_string($con, $_REQUEST['task_name']);
        $task_category = $_REQUEST['task_category'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        $task_assign_person = $_REQUEST['task_assign_person'];
        $task_priority = $_REQUEST['task_priority'];
        $description = mysqli_real_escape_string($con, $_REQUEST['description']);
    
        $update = "UPDATE hr_task SET task_name='$task_name', task_category='$task_category', start_date='$start_date', end_date='$end_date', task_assign_person='$task_assign_person', task_priority='$task_priority', description='$description' WHERE task_id='$id'";
        mysqli_query($con, $update);
        header("location:etask.php");
    }
    $id= $_SESSION['employee_id'];
    $result="SELECT * FROM hr_employee where employee_id='$id'";
    $query2=mysqli_query($con,$result);
    $fetch_data=mysqli_fetch_array($query2);

    $name=$fetch_data['employee_name'];
    $data="SELECT * FROM hr_task WHERE task_assign_person='$name'";
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
    <h2>Edit Tasks</h2>
    <form  method="post">

      <label for="taskName">Task Name:</label>
        <select class="form-select" name="task_name" >
            <option style="display: none;">Task Name Select</option>
            <option <?php if( @$edit_fetch['task_name']=='Jariwala Project'){?> selected <?php }?>>Jariwala Project</option>
            <option <?php if( @$edit_fetch['task_name']=='Box of Crayons'){?> selected <?php }?>>Box of Crayons</option>
            <option <?php if( @$edit_fetch['task_name']=='Gob Geeklords'){?> selected <?php }?>>Gob Geeklords</option>
            <option <?php if( @$edit_fetch['task_name']=='Java'){?> selected <?php }?>>Java</option>
            <option <?php if( @$edit_fetch['task_name']=='Practice to Perfect'){?> selected <?php }?>>Practice to Perfect</option>
            <option <?php if( @$edit_fetch['task_name']=='Rhinestone'){?> selected <?php }?>>Rhinestone</option>
            <option <?php if( @$edit_fetch['task_name']=='Social Geek Made'){?> selected <?php }?>>Social Geek Made</option>
      </select>

      <label for="projectCateogry">Task Category:</label>
      <select class="form-select" name="task_category">
            <option style="display:none">Select Category</option>
            <option <?php if( @$edit_fetch['task_category']=='UI/UX Design'){?> selected <?php }?>>UI/UX Design</option>
            <option <?php if( @$edit_fetch['task_category']=='Website Design'){?> selected <?php }?>>Website Design</option>
            <option <?php if( @$edit_fetch['task_category']=='App Development'){?> selected <?php }?>>App Development</option>
            <option <?php if( @$edit_fetch['task_category']=='Backend Development'){?> selected <?php }?>>Backend Development</option>
        </select>
      <label for="startTime">Start Time:</label>
      <input type="date" id="startTime" name="start_date" value="<?php echo @$edit_fetch['start_date']; ?>" >

      <label for="endTime">End Time:</label>
      <input type="date" id="endTime" name="end_date" value="<?php echo @$edit_fetch['end_date']; ?>" >

      <label for="taskassignperson">Task Assign Person:</label>
        <select name="task_assign_person" class="form-select" >
            <!-- <option style="display: none;">Select Name</option> -->
            <?php
            $id=$_SESSION['employee_id'];
            $employeeQuery = "SELECT * FROM hr_employee WHERE employee_id='$id'";
            $employeeResult = mysqli_query($con, $employeeQuery);

            while ($employee = mysqli_fetch_array($employeeResult)) {
                $employeeName = $employee['employee_name'];

            ?>
                <option <?php if (@$edit_fetch['task_assign_person'] == $employeeName) { ?> selected <?php } ?>>
                    <?php echo $employeeName; ?>
                </option>
            <?php
            }
            ?>
          </select>
        <label for="taskPriority">Task Priority:</label>
        <select name="task_priority" class="form-select">
            <option style="display: none;">Select Priority</option>
            <option <?php if( @$edit_fetch['task_priority']=='Lowest'){?> selected <?php }?>>Lowest</option>
            <option <?php if( @$edit_fetch['task_priority']=='Low'){?> selected <?php }?>>Low</option>
            <option <?php if( @$edit_fetch['task_priority']=='Medium'){?> selected <?php }?>>Medium</option>
            <option <?php if( @$edit_fetch['task_priority']=='Highest'){?> selected <?php }?>>Highest</option>
        </select>
      <label for="projectDescription">Description:</label>
      <textarea id="projectDescription" name="description" rows="3" ><?php echo @$edit_fetch['description']; ?></textarea><br>

      <button type="submit" name="btnedit_update">Edit Task</button>
    </form>
  </div>

</body>
</html>
