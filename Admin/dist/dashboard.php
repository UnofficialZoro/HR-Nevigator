<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>:: HR Navigator :: </title>
    <link rel="icon" href="hrmslogo.png" type="image/x-icon"> <!-- Title Icon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>

<body  data-mytask="theme-indigo">
<span class="loader"></span>
<div id="mytask-layout">
    
    <!--sidebar -->
        <?php
            // Include the sidebar
            include 'sidebar.php';
        ?>
    <!-- main body area -->
    <div class="main px-lg-4 px-md-4">

        <!-- Body: Header -->
        <?php
            // Include the header
            include 'header.php';
        ?>

    </div>
    <!-- start: template setting, and more. -->
	<?php
        // Include the Theme
        include 'setting.php';
    ?>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>

<!-- Plugin Js-->
<script src="assets/bundles/apexcharts.bundle.js"></script>

<!-- Jquery Page Js -->
<script src="../js/template.js"></script>
<script src="../js/page/hr.js"></script>


</body>

</html> 