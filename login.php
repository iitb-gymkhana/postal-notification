<?php
session_start();
require 'config.php';
require 'common.php';

function ldap2hostel($host, $ldap) {
	foreach ($host as &$h) {
                if ($h->hallmgr == $ldap) {
                       return $h;
                }
        }
}

if(isset($_POST['username']) && isset($_POST['password'])){
        $user = $_POST["username"];
        $pass = $_POST["password"];
	$auth = ldap_auth($user, $pass);
        if ($auth != 'NONE') {
                if (ldap2hostel($hostels, $user)) {
                        $_SESSION['user'] = $user;
                        header("location:index.php");
                        exit;
                } else {
                        $unauth = true;
                }
        } else {
                $fail = true;
        }
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
  </head>

  <body>
  <div class="main">

    <h3> Postal Notification System </h3>
<br/>
	<form action="" method="post" id="lform">
          <input type="submit" style="position: absolute; left: -9999px"/>

          <div class="input-field col s12">
            <input id="username" type="text" name="username">
            <label for="username">LDAP ID</label>
          </div>

          <div class="input-field col s12">
            <input id="password" type="password" name="password">
            <label for="password">Password</label>
          </div>

          <div class="col s12">
            <div class="float-right">
              <a class="waves-effect waves-light btn x-send" href="javascript:{}" onclick="document.getElementById('lform').submit();">
                Login <i class="material-icons right">send</i>
              </a>
            </div>
          </div>
         </form>
        </div>
      </div>
    </div>


  </div>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function(){
            <?php if($fail) echo "M.toast({html: 'Invalid Login! Please try again!'})" ?>
            <?php if($unauth) echo "M.toast({html: 'You are not authorized to access this page!'})" ?>
        });
    </script>

  </body>
</html>

