<?php
$con = mysqli_connect('localhost', 'root', '', 'project');

if(isset($_REQUEST['btnsend'])) {
    $employee_name = $_REQUEST['employee_name'];
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message']; 

    $insert = "INSERT INTO hr_notification (employee_name,`subject`, `message`) VALUES ('$employee_name','$subject', '$message')";
    mysqli_query($con, $insert);
    header('location:dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for the form */
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            border: 1px solid #ced4da;
            border-radius: 0.5rem;
            padding: 0.5rem;
            width: 100%;
        }
        select {
            border: 1px solid #ced4da;
            border-radius: 0.5rem;
            padding: 0.5rem;
            width: 100%;
            height: auto;
        }
        .btn-primary {
            background-color: darkviolet;
            border-color:darkviolet;
            border-radius: 0.5rem;
        }
        .btn-primary:hover {
            background-color: purple;
            border-color: purple;
        }
        /* .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
        } */
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="sendNotificationForm">
                    <div class="form-group">
                        <label for="recipient">Recipient:</label>
                        <select class="form-control" name="employee_name" id="recipient">
                            <option style="display:none" required>Select Name</option>
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
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" name="subject" class="form-control"  placeholder="Enter notification subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" name="message" rows="3" placeholder="Enter notification message"></textarea required>
                    </div>
                    <button type="submit" name="btnsend" class="btn btn-primary">Send Notification</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
