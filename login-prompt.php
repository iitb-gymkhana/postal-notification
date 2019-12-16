<?php
require 'config.php';

if (isset($_SESSION) && isset($_SESSION['user']) && $_SESSION['user'] != '') {
        header("location:index.php");
        exit;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/jquery-ui.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/jquery-ui.theme.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/common.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title> Postal Notification System </title>

    <style>
        #sso-root {
            padding: 10px;
        }
    </style>
  </head>

  <body>
  <div class="main">

    <h3> Postal Notification System </h3>

    <a class="waves-effect waves-light btn" href="login.php">Login with SSO </a>

  </body>
</html>

