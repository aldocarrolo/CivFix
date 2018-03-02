<?php  

include("database_info.php");

$dbh = mysql_connect($host, $username, $password) or die("Unable to connect to MySQL");  
$selected = mysql_select_db("my_civfix") or die("Could not select first_test");  
$query = "SELECT * FROM markers";  
$result=mysql_query($query) or die("problema");
$outArray = array(); 

if ($result) 
{
  while ($row = mysql_fetch_assoc($result))
  {
    $outArray[] = $row;
  }
}

echo json_encode(($outArray));
?> 
