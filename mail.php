<?php
        session_start();

        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'config.php';
        require '../connect.php';
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        if (session_id() == '' || !isset($_SESSION) || !isset($_SESSION['user']) || $_SESSION['user'] == '') {
                header("location:login.php");
                exit;
        }

        $user = $_SESSION["user"];
        $email = $_POST["email"];
        $comments = $_POST["comments"];
        
        // Log in database
        $query = mysqli_query($con, "INSERT into postal_notification(sender,recipient,comments)VALUES('$user','$email','$comments')") or die(mysqli_error($con));

        // Send email
        $subject = "Postal Notification";
        $body = "This is to inform you that a post/mail package is available for collection for you. ";
        $body .= "You may pick up the same from your hostel's hall manager's office.\n\n";

        if ($comments) {
                $body .= "Comments:\n$comments\n\n";
        }

        $body .= "----------------\nThis email was generated just for you by postal notification system\n----------------";

        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->IsSMTP();
        
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp-auth.iitb.ac.in";
        $mail->Port = 25;
        $mail->IsHTML(false);
        $mail->Username = $smtp_user;
        $mail->Password = $smtp_pass;
        $mail->SetFrom("$user@iitb.ac.in", "Hall Manager");

        $mail->addAddress($email);

        $mail->Subject = $subject;
        $mail->Body = $body;

        if(!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
                echo "Message has been sent";
                header("location:index.php?success=1");
        }
?>
