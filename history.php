<?php
        session_start();

        require 'config.php';
        require '../connect.php';

        if (session_id() == '' || !isset($_SESSION) || !isset($_SESSION['user']) || $_SESSION['user'] == '') {
                header("location:login.php");
                exit;
        }

        $user = $_SESSION["user"];
        
        // Get database
        $sql = "SELECT * FROM postal_notification WHERE sender='$user' ORDER BY time DESC";
        $result = $con->query($sql);

        if ($result->num_rows <= 0) {
                echo "0 results";
                exit;
        }
?>

<html>
<head>
        <title> Postal Notification System </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <style>
                .container {
                        overflow-x: auto;
                }

                table {
                        font-family: arial, sans-serif;
                        border-collapse: collapse;
                        width: 700px;
                        margin: 0 auto;
                }

                td, th {
                        border: 1px solid #dddddd;
                        text-align: center;
                        padding: 8px;
                }

        </style>
</head>

<body>

<h2> History for <?php echo $user; ?> </h2>
<div class="container">
<table>
<tr><th> Timestamp (UTC) </th> <th> Email </th> <th> Comments </th></tr>
<?php
        while($row = $result->fetch_assoc()) {
                echo "<tr> <td>" . $row["time"] . "</td><td>" . $row["recipient"] . " </td><td> " . $row["comments"] . "</td> </tr>";
        }
?>

</table>
</div>
</body>
</html>

<?php 
        $con->close();
?>
