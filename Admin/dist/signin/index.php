<?php
    session_start();
    $con = mysqli_connect("localhost", "root", "", "project");
    if(@$_SESSION['email']!='')
    {
        header("location:index1.php");
    }
    if (isset($_REQUEST['btnlogin'])) {
        $email = $_REQUEST['email_id'];
        $password = $_REQUEST['password'];
        $select = "SELECT * FROM `hr_admin` WHERE email_id='$email' AND `password`='$password'";
        $select1 = mysqli_query($con, $select);
        
        if (mysqli_num_rows($select1) > 0) {
            $select2 = mysqli_fetch_array($select1);
            $_SESSION['admin_id'] = $select2['admin_id'];
            $_SESSION['email'] = $email;
            if(isset($_POST['remember']))
            {
                setcookie('email_id',$_POST['email_id'],time()+(60*60*48));
                setcookie('password',$_POST['password'],time()+(60*60*48));
            }
            header("location:index1.php");
            
        }
    }
?>

<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>:: HR Navigator :: Sign In</title>
    <link rel="icon" href="../hrmslogo.png" type="image/x-icon"> <!-- Title Icon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="../assets/css/my-task.style.min.css">
    <style>
        .login-failed {
            color: white;
            font-size:larger;
            text-align: center;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 10px;
        }
    </style>
</head>

<body data-mytask="theme-indigo">
    <div id="mytask-layout">
        <div class="main p-2 py-3 p-xl-5 ">
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">
                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                            <div style="max-width: 25rem;">
                                <div class="text-center mb-5">
                                    <svg  width="4rem" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                        <!-- ... SVG paths ... -->
                                    </svg>
                                </div>
                                <div class="mb-5">
                                    <h2 class="color-900 text-center"> HR Navigator </h2>
                                </div>
                                <div class="">
                                    <img src="../assets/images/login-img.svg" alt="login-img">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-5 card border-0 bg-dark text-light" style="max-width: 32rem;">
                                <!-- Form -->
                                <form class="row g-1 p-3 p-md-4" method="POST">
                                    <div class="col-12 text-center mb-1 mb-lg-5">
                                        <h1>Sign in</h1>
                                        <!-- <span>Free access to our dashboard.</span> -->
                                        <?php
                                            if (isset($_REQUEST['btnlogin']) && mysqli_num_rows($select1) <= 0) {
                                                echo '<div class="login-failed">Login Failed</div>';
                                            }
                                        ?>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Email address</label>
                                            <input type="email" name="email_id" class="form-control form-control-lg" placeholder="name@example.com">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <div class="form-label">
                                                <span class="d-flex justify-content-between align-items-center">
                                                    Password
                                                    <a class="text-secondary" href="forgotpass.php">Forgot Password?</a>
                                                </span>
                                            </div>
                                            <input type="password" name="password" class="form-control form-control-lg" placeholder="***************">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="remember" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                       <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" name="btnlogin">Sign In</button>
                                    </div>
                                    <!-- <div class="col-12 text-center mt-4">
                                        <span class="text-muted">Don't have an account yet? <a href="signup.php" class="text-secondary">Sign up here</a></span>
                                    </div> -->
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                    </div> <!-- End Row -->
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="../assets/bundles/libscripts.bundle.js"></script>
</body>
</html>
