<?php
        session_start();

        require 'config.php';
        require '../connect.php';

        if (session_id() == '' || !isset($_SESSION) || !isset($_SESSION['user']) || $_SESSION['user'] == '') {
                header("location:login.php");
                exit;
        }

        $user = $_SESSION["user"];
        $email = $_POST["email"];
        $comments = $_POST["comments"];
        
        echo $email."\n".$comments;

        $query = mysqli_query($con, "INSERT into postal_notification(sender,recipient,comments)VALUES('$user','$email','$comments')") or die(mysqli_error($con));
?>
