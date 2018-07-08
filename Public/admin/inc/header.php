<?php
$filePath = realpath(dirname(__FILE__));
//session_start();
//if (!isset($_SESSION['admin_login'])) {
//    header("Location:/mobilemarket/login.php");
//}
include $filePath.'/../lib/Session.php';
//Session::check_session();
?>
<?php
 // header("Cache-Control: no-cache, must-revalidate");
 // header("Pragma: no-cache"); 
 // header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
 // header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="resources/css/bootstrap.min.css" media="screen" />
<!--    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" />-->
<!--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" media="screen" />-->

    <!-- Custom CSS -->
    <link href="resources/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="resources/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>
