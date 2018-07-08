<?php include '../classes/Adminlogin.php'; ?>

<?php

$adminLogin = new Adminlogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminUser = $_POST['admin_user'];
    $adminPass = md5($_POST['admin_password']);

    $loginCheck = $adminLogin->admin_login($adminUser, $adminPass);
}

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
    <style>
        #content {
           margin-top: 80px;
        }
        body {
            font-family: 'Dosis', sans-serif;
        }
    </style>



</head>
<body>
<div class="container">
    <section id="content" class="col-sm-5 col-sm-offset-3 jumbotron">
        <form action="login.php" method="post">
            <h3 class="well text-center">Admin Login</h3>
            <span style="color: red; font-size: 18px;">
                <?php
                if (isset($loginCheck)) {
                    echo "<div class='alert alert-danger'>$loginCheck</div>";
                }
                ?>
            </span>
            <div class="form-group">
                <input type="text" placeholder="Username"  name="admin_user" class="form-control"/>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password"  name="admin_password" class="form-control"/>
            </div>
            <div class="form-group">
                <input type="submit" value="Log in" class="btn btn-success"/>
            </div>
        </form><!-- form -->
    </section><!-- content -->
</div><!-- container -->

<!-- Latest compiled and minified JavaScript -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>