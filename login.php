<?php
session_start();

include("php/dbconnect.php");

$error = '';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];



    $username_search = "SELECT * FROM admin WHERE username='$username'";
    $query = mysqli_query($conn, $username_search);
    $username_count = mysqli_num_rows($query);


    if ($username_count) {
        $username_pass = mysqli_fetch_assoc($query);
        $db_password = $username_pass['password'];
        $_SESSION['username'] = $username_pass['username'];
        $pass_decode = password_verify($password, $db_password);



        if ($pass_decode) {
            echo '<script type="text/javascript">window.location="index.php"; </script>';
        } else {
            $error = 'Invalid username or password';
        }
    } else {
        $error = 'Invalid username or password';
    }
}
?>






<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Academy Management System</title>
    <link rel="icon" type="image/png" href="./logo/logo.png" />
    <!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        @font-face {
            font-family: Poppins;
            src: url("fonts/Poppins-Regular.ttf");
        }

        html * {
            font-family: "Poppins", sans-serif;

        }

        body {
            background-color: #3A1444;
        }

        .myhead {
            margin-top: 0px;
            margin-bottom: 0px;
            text-align: center;
            color: white;
        }

        .logo img {
            max-width: 50%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .transparent {}

        .btn {
            width: 75px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 ">
                <div class="logo">
                    <img src="logo/logo.png" alt="logo">
                </div>
            </div>
        </div>
        <div class="row ">

            <div class="col-md-6 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                <div class="panel-body " style="margin-top:70px;">
                    <h3 class="myhead">Rainbow Academy management System</h3>
                    <form role="form" action="login.php" method="post">
                        <hr />
                        <?php
                        if ($error != '') {
                            echo '<h5 class="text-danger text-center">' . $error . '</h5>';
                        }
                        ?>


                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Username " name="username" required />
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Password" name="password" required />
                        </div>



                        <button class="btn btn-info" style="border-radius:0%" type="submit" name="login">Login</button>
                        <input type="button" onclick="window.location.href='student/index.php'" value="Switch Student Login" style="background-color:green; color:white; height:30px;">
                    </form>
                </div>

            </div>


        </div>
    </div>

</body>

</html>