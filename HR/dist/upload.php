<?php
    $con=mysqli_connect('localhost','root','','project');
    
    if(isset($_REQUEST['btnsubmit']))
    {
        $employee_name=$_REQUEST['employee_name'];
        $position=$_REQUEST['position'];
        $salary=$_REQUEST['salary'];
        $bonus=$_REQUEST['bonus'];
        $working_hours=$_REQUEST['working_hours'];
        $slip_date=$_REQUEST['slip_date'];

        $insert="INSERT INTO salaryslip (employee_name,position,salary,bonus,working_hours,slip_date) VALUES ('$employee_name','$position','$salary','$bonus','$working_hours','$slip_date')";
        mysqli_query($con,$insert);
        header('location:salaryslip.php');
    }
    $data="SELECT * FROM salaryslip";
    $data1=mysqli_query($con,$data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Salary and Working Hours Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: auto;
    }

    input[type="text"],
    input[type="number"],
    select {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: purple;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }
    input[name="bonus"] {
    margin-bottom: 15px; /* Add margin bottom to create a gap */
    }

</style>
</head>
<body>
    <form>
        <h2>Employee Information</h2>
        <label class="form-label">Employee Name</label>
        <select class="form-select" name="employee_name">
            <option style="display: none;">Employee Name Select</option>
            <!-- How many employee query -->
            <?php
            $delete1 = "SELECT * FROM hr_employee";
            $res1 = mysqli_query($con, $delete1);
            while ($fetch = mysqli_fetch_array($res1)) {
            ?>
                <option value="<?php echo $fetch['employee_name']; ?>"><?php echo $fetch['employee_name']; ?></option>
            <?php
            }
            ?>
        </select>

        <label for="position">Position:</label>
        <select class="form-select" name="position" aria-label="Default select Project Category">
            <option style="display: none">Select Position</option>
            <option >App Development</option>
            <option >Backend Development</option>
            <option>Cloud Consultant</option>
            <option>Cloud Engineer</option>
            <option>Database Administrator</option>
            <option>Data Architect</option>
            <option >Website Design</option>
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
        <h2>Salary Details</h2>
        <label for="base_salary">Base Salary:</label>
        <input type="number" name="salary" required>

        <label for="bonus">Bonus:</label>
        <input type="number" name="bonus">

        <label for="salaryslip date">Salaryslip Date:</label><br><br>
        <input type="date" name="slip_date">

        <h2>Working Hours</h2>
        <label for="monday_hours">Work Hours:</label>
        <input type="number" name="working_hours">

        <!-- Add similar fields for other weekdays and weekends -->

        <input type="submit" value="Submit" name="btnsubmit">
    </form>
</body>
</html>
