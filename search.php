<?php
session_start();
require 'config.php';

if (session_id() == '' || !isset($_SESSION) || !isset($_SESSION['user']) || $_SESSION['user'] == '') {
        header("HTTP/1.1 401 Unauthorized");
        exit;
}

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

$data = array(
  'hostel'      => $queries['h'],
  'search'      => $queries['term'],
  'secret'      => $sso_secret,
);

$options = array(
  'http' => array(
    'method'  => 'POST',
    'content' => json_encode( $data ),
    'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
    )
);

$url = 'https://gymkhana.iitb.ac.in/sso/internal/api/searchhostel/';
$context  = stream_context_create( $options );
$result = file_get_contents( $url, false, $context );

header('Content-type:application/json;charset=utf-8');
echo $result;
?>
