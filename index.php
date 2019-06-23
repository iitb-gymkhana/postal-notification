<?php
session_start();
require 'config.php';

if (session_id() == '' || !isset($_SESSION) || !isset($_SESSION['user']) || $_SESSION['user'] == '') {
        header("location:login.php");
        exit;
}

$user = $_SESSION['user'];

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
if ($queries['success'] == "1") {
        $success = true;
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
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title> Postal Notification System </title>

    <style>
        body { overflow-y: scroll; }
        .main {
          margin: 0 auto;
          max-width: 700px;
        }
        .sel-mail {
          font-size: 1.3em;
        }
        .float-right {
          float: right;
        }
    </style>

  </head>

  <body>
  <div class="main">

    <h3> Postal Notification System </h3>

    <div class="row">
      <div class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <select id="hostel" onchange="selectHostel()">
<?php
	foreach ($hostels as &$h) {
              if ($h->code && $h->hallmgr == $user) {
                      echo "<option selected value=\"$h->code\">$h->name</option>";
              } else {
                      echo "<option value=\"$h->code\">$h->name</option>";
              }
	}
?>
            </select>
            <label>Hostel</label>
          </div>

          <div class="input-field col s12">
            <i class="material-icons prefix">search</i>
            <input placeholder="Name or room number" type="text" id="search" class="autocomplete" disabled>
            <label for="autocomplete-input">Search</label>
          </div>

          <form action="mail.php" method="post" id="sform">
            <div class="input-field col s12">
              <input placeholder="Extra Information" id="comments" type="text" name="comments">
              <label for="comments">Comments</label>
            </div>
            <input style="display: none" id="form-email" type="text" name="email">
          </form>

          <div class="col s12">
            <span class="sel-mail">--</span>
          </div>

          <div class="col s12">
            <div class="float-right">
              <a class="waves-effect waves-light btn x-send disabled" onclick="send()">Send <i class="material-icons right">send</i></a>
            </div>
          </div>

          <div class="col s12" style="margin-top: 10px;">
            <div class="float-right">
              <a class="waves-effect waves-light btn" href="logout.php">Logout <?php echo $user; ?> </a>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>

    <script>
      var semail = '';
      $(document).ready(function(){
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems, {});

	if ($('#hostel').val()) { selectHostel(); }

        $('input.autocomplete').autocomplete({
            source: function (request, response) {
                $.get("search.php", {
                    h: $('#hostel').val(),
                    term: request.term
                }, function (data) {
                    response(data.map(m => {
                       return {
                           "label": m.room + ' - ' + m.name,
                           "username": m.username
                       }
                    }) );
                });
            },
            minLength: 2,
            select: function( event, ui ) {
               selectEmail(ui.item.username);
            },
        }); 

<?php if ($success) {
      echo " 
        var href = window.location.href;
        var url  = href.split('?suc');
        history.pushState(null, null, url[0]);
        M.toast({html: 'Mail has been sent successfully!'})
      ";
} ?>
      });

      function selectEmail(ldapid) {
          semail = ldapid + '@iitb.ac.in';
          $('.sel-mail').html(semail);
          $('#form-email').val(semail);
          $('.x-send').removeClass('disabled');
      }

      function selectHostel() {
          $('#search').prop('disabled', false);
      }

      function send() {
          document.getElementById('sform').submit();
      }

    </script>

  </body>
</html>

