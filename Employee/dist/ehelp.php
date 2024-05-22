<?php
session_start();
    $con=mysqli_connect('localhost','root','','project');

    $id= $_SESSION['employee_id'];
    $result="SELECT * FROM hr_employee where employee_id='$id'";
    $query2=mysqli_query($con,$result);
    $fetch_data=mysqli_fetch_array($query2);
    $name=$fetch_data['employee_name'];
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">


<!-- Mirrored from pixelwibes.com/template/my-task/html/dist/help.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Dec 2023 06:24:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>:: HR Navigator:: </title>
    <link rel="icon" href="hrmslogo.png" type="image/x-icon"> <!-- Title Icon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>
<body  data-mytask="theme-indigo">

<div id="mytask-layout">
     <!--sidebar -->
    <?php
        // Include the sidebar
        include 'esidebar.php';
    ?>

    <!-- main body area -->
    <div class="main px-lg-4 px-md-4">

    <!-- Body: Header -->
    <?php
        // Include the header
        include 'eheader.php';
    ?>

        <!-- Body: Body -->
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row clearfix">
                   <!-- <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 flex-lg-column"> -->
                        <!-- <div class="sticky-lg-top"> -->
                            <!-- <div class="row row-deck"> -->
                                <!-- <div class="col-12 col-sm-6 col-md-6 col-lg-12 flex-column">
                                    <div class="card mb-3 bg-info-light ">
                                        <div class="card-body d-flex align-items-center justify-content-center flex-column">
                                            <div class="preview-pane text-center">
                                                <svg width="100" fill="currentColor" class="bi bi-chat-text color-defult " viewBox="0 0 16 16">
                                                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                                    <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                                                </svg>
                                                <a href="http://pixelwibes.com/" target="_blank" class="fw-bold fs-6 mt-2 d-flex justify-content-center color-defult ">Chat with us</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="col-12 col-sm-6 col-md-6 col-lg-12 flex-column">
                                    <div class="card mb-3 bg-lightyellow">
                                        <div class="card-body d-flex align-items-center justify-content-center flex-column">
                                            <div class="preview-pane text-center">
                                                <svg width="100" fill="currentColor" class="bi bi-envelope color-defult " viewBox="0 0 16 16">
                                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                                </svg>
                                                <a href="mailto:pixelwibes@gmail.com" class="fw-bold  fs-6 mt-2 d-flex justify-content-center color-defult ">Email us</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            <!-- </div>
                        </div>   
                   </div> -->
                   <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12">
                    <div class="card border-0">
                        <!-- <div class="card-header py-3">
                            <h4 class=" display-6 fw-bold">Help</h4>
                        </div> -->
                        <div class="card-body">
                          <div class="mb-4 overflow-hidden">
                              <!-- <div class="bg-primary py-5 px-4 text-light">
                                  <h4>hrms.com</h4>
                                  <span>Quick Start Guides Help Center</span>
                              </div> -->
                              <div class="p-4">
                                  <p class="fw-bold">HR Navigator guide</p>
                                  <span>1. Employee Information Management: HRMS centralizes employee data, including personal details, contact information, employment history, skills, and qualifications.</span><br><br>
                                  <span>2. Payroll Processing: Automates payroll calculations, tax deductions, and salary disbursements. It helps ensure accurate and timely payment to employees.</span><br><br>
                                  <span>3. Time and Attendance Tracking: Monitors employee attendance, working hours, and time-off requests. It can include features like timesheets, leave management, and overtime tracking.</span><br><br>
                                  <span>4. Recruitment and Applicant Tracking: Assists in the hiring process by managing job postings, applications, and candidate information. Applicant tracking features help streamline recruitment workflows.</span>
                                  <hr>
                                  
                                  <p class="fw-bold">About</p>

                                  <span>Contact Us:<br>+91 8780431900 <br> +91 9512473156</span><br><br>
                                  <span>Email Id:<br>harshjariwala635@gmail.com<br>corpo.aadi@gmail.com</span>

                                  <hr>
                                  <!-- <span class="text-muted">Thanks for choosing <strong class="text-warning">Pixel Wibes</strong> Admin.</span> -->
                              </div>    
                          </div>
                        </div>
                    </div>
                   </div>
                </div><!-- Row End -->
            </div>
        </div>
    </div>

    <!-- start: template setting, and more. -->
    <?php
        include 'esetting.php';
    ?>
</div>


<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>

<!-- Jquery Page Js -->
<script src="../js/template.js"></script>
</body>

<!-- Mirrored from pixelwibes.com/template/my-task/html/dist/help.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Dec 2023 06:24:36 GMT -->
</html>