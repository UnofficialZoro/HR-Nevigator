<?php
    session_start();

    $con=mysqli_connect('localhost','root','','project');
    
    $id = $_SESSION['employee_id'];
    $result = "SELECT * FROM hr_employee WHERE employee_id='$id'";
    $query2 = mysqli_query($con, $result);
    $fetch_data = mysqli_fetch_array($query2);

    // Fetch events from the database
    $events_query = mysqli_query($con, "SELECT * FROM hr_calendar");
    $events = array();
    while ($row = mysqli_fetch_assoc($events_query)) {
        $events[] = array(
            'title' => $row['event_name'],
            'start' => $row['start_date'],
            'end' => $row['end_date'],
        );
    }
    $events_json = json_encode($events);
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>:: HR Navigator :: </title>
    <link rel="icon" href="hrmslogo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/plugin/fullcalendar/main.min.css">
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>
<body  data-mytask="theme-indigo">
    <div id="mytask-layout">
        <!-- sidebar -->
        <?php
            include 'esidebar.php';
        ?>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">
            <!-- Body: Header -->
            <?php
                include 'eheader.php';
            ?>

            <!-- Body: Body -->
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row clearfix g-3">
                        <div class="col-lg-12 col-md-12 ">
                            <!-- card: Calendar -->
                            <div class="card">
                                <div class="card-body" id='my_calendar'></div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var calendarEl = document.getElementById('my_calendar');
                                        
                                        var calendar = new FullCalendar.Calendar(calendarEl, {
                                            timeZone: 'UTC',
                                            initialView: 'dayGridMonth',
                                            events: <?php echo $events_json; ?>,
                                            editable: false, // Disable editing
                                            selectable: false // Disable selecting
                                        });
                                        
                                        calendar.render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div><!-- Row End -->
                </div>
            </div>
        </div>

        <!-- Theme setting -->
        <?php
            include 'esetting.php';
        ?>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <script src="assets/plugin/fullcalendar/main.min.js"></script>

    <!-- Jquery Page Js -->
    <script src="../js/template.js"></script>
</body>
</html>
