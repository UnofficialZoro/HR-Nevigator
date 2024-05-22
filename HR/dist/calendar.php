<?php
    // Establish database connection
    $con = mysqli_connect('localhost', 'root', '', 'project');
    
    // Check if form is submitted
    if (isset($_REQUEST['btncreate'])) {
        // Retrieve data from the form
        $event_name = $_REQUEST['event_name'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];

        // Insert the event into the database
        $insert = "INSERT INTO hr_calendar (event_name, start_date, end_date) VALUES ('$event_name', '$start_date', '$end_date')";
        mysqli_query($con, $insert);
        header('location:calendar.php');
    }

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
    <title>:: HR Navigator ::</title>
    <link rel="icon" href="hrmslogo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/plugin/fullcalendar/main.min.css">
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>
<body data-mytask="theme-indigo">
    <div id="mytask-layout">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main body area -->
        <div class="main px-lg-4 px-md-4">
            <!-- Header -->
            <?php include 'header.php'; ?>

            <!-- Body -->
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row clearfix g-3">
                        <div class="col-lg-12 col-md-12">
                            <div class="mb-4" style="margin-left: 88%;">
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addEventModal"><i class="icofont-plus-circle me-2 fs-6"></i>Create Event</button>
                            </div>
                            <!-- Calendar Card -->
                            <div class="card">
                                <div class="card-body" id='my_calendar'></div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var calendarEl = document.getElementById('my_calendar');
                                        
                                        var calendar = new FullCalendar.Calendar(calendarEl, {
                                            timeZone: 'UTC',
                                            initialView: 'dayGridMonth',
                                            editable: true,
                                            selectable: true,
                                            events: <?php echo $events_json; ?>,
                                            select: function(info) {
                                                // Open modal for adding events
                                                // Set info.start and info.end as the selected date range
                                                // Handle event creation with these dates
                                                // For example:
                                                $('#addEventModal').modal('show');
                                                $('#datepickerded').val(info.startStr);
                                                $('#datepickerdedone').val(info.endStr);
                                            }
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

        <!-- Add Event Modal -->
        <div class="modal fade" id="addEventModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="eventaddLabel">Add Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addEventForm" method="POST">
                            <div class="mb-3">
                                <label for="exampleFormControlInput99" class="form-label">Event Name</label>
                                <input type="text" name="event_name" class="form-control" id="exampleFormControlInput99">
                            </div>
                            <div class="deadline-form">
                                <div class="row g-3 mb-3">
                                    <div class="col">
                                        <label for="datepickerded" class="form-label">Event Start Date</label>
                                        <input type="date" name="start_date" class="form-control" id="datepickerded">
                                    </div>
                                    <div class="col">
                                        <label for="datepickerdedone" class="form-label">Event End Date</label>
                                        <input type="date" name="end_date" class="form-control" id="datepickerdedone">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="addEventForm" name="btncreate" class="btn btn-primary">Create Event</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Theme setting -->
        <?php include 'setting.php'; ?>
    </div>

    <!-- Core Scripts -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- FullCalendar Plugin -->
    <script src="assets/plugin/fullcalendar/main.min.js"></script>

    <!-- Template JS -->
    <script src="../js/template.js"></script>
</body>
</html>
