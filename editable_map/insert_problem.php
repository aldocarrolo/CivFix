<?php
session_start();

include("database_info.php");

$problem = $_GET['problem'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$city = $_GET['city'];

$connection=mysql_connect ($host, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

$query = sprintf("INSERT INTO markers " .
         " (id, problem, lat, lng, place, id_user, name, lastname) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
         mysql_real_escape_string($problem),
         mysql_real_escape_string($lat),
         mysql_real_escape_string($lng),
         mysql_real_escape_string($city),
         mysql_real_escape_string($_SESSION['id']),
         mysql_real_escape_string($_SESSION['name']),
         mysql_real_escape_string($_SESSION['lastname']));

$result = mysql_query($query);

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

//header("index.php");
?>
