<?php
$con = mysqli_connect('localhost', 'root', '', 'project');

$id = isset($_REQUEST['edit']) ? $_REQUEST['edit'] : '';
$edit = "SELECT * FROM hr_holiday WHERE holiday_id='$id'";
$edit_executed = mysqli_query($con, $edit);
$edit_fetch = mysqli_fetch_array($edit_executed);

if (isset($_REQUEST['btnedit_update'])) {
    $holiday_day = mysqli_real_escape_string($con, $_REQUEST['holiday_day']);
    $holiday_name = mysqli_real_escape_string($con, $_REQUEST['holiday_name']);
    $holiday_date = mysqli_real_escape_string($con, $_REQUEST['holiday_date']);

    $update = "UPDATE hr_holiday SET holiday_day='$holiday_day', holiday_name='$holiday_name', holiday_date='$holiday_date' WHERE holiday_id='$id'";
    mysqli_query($con, $update);
    header('location:eholidays.php');
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

        input,
        select {
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
        <h2>Edit Holidays</h2>
        <form method="post">

            <label for="holidayDay">Holiday Day:</label>
            <input type="text" name="holiday_day" value="<?php echo htmlspecialchars(@$edit_fetch['holiday_day']); ?>">

            <label for="holidayName">Assigned Name:</label>
            <input type="text" name="holiday_name" value="<?php echo htmlspecialchars(@$edit_fetch['holiday_name']); ?>">

            <label for="holidayDate">Created Date:</label>
            <input type="date" name="holiday_date" value="<?php echo htmlspecialchars(@$edit_fetch['holiday_date']); ?>">

            <button type="submit" name="btnedit_update">Edit Holiday</button>
        </form>
    </div>

</body>

</html>
