<?php session_start(); ?>
<?php include 'includes/functions.php'; ?>

<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/theme.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />

</head>
<body>
<div >
    <div class="row" style="margin-top: 150px;">
        <div class="col-lg-4 col-lg-offset-4">
            <div class="panel panel-default">
                <div class="panel-body text-center" style="height: 700px">
                    <br />
                    <br />
                    <div class="text-center">
                        <img src="img/njit_logo_red.png">
                    </div>
                    <br>
                    <div class="text-center" style="color: #CC2229">
                        <h4>Architecture Library Reservation System</h4>
                        <h4><b>ADMIN LOGIN</b></h4>
                    </div>
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />


                    <form action="" method="POST">

                        <div class="text-center">
                            <div class="input-group" style="width: 400px; margin-left: auto; margin-right: auto;">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input name="username" class="form-control input-lg" type="text" placeholder="Username">
                            </div>
                            <br />
                            <div class="input-group" style="width: 400px;  margin-left: auto; margin-right: auto;">
                                <div class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </div>
                                <input name="password" class="form-control input-lg" type="password" placeholder="Password">
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />
                        <br />

                        <input type="submit" class="btn btn-primary" style="width: 400px; " value="Login">



                    </form>


                    <?php

                    if ($_SERVER['REQUEST_METHOD'] == "POST"){
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        if (db_checklogin($username, $password)){
                            $_SESSION['loggedIn'] = true;
                            $_SESSION['username'] = $username;
                            echo "<script>location.href='admin.php'; </script>";
                        }
                        else{
                            echo "<br><div class='alert alert-danger'><i class='fa fa-exclamation-triangle'></i> Incorrect username/password. Please try again</div>";
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="js/bootstrap.min.js"></script>
</body>


</html>