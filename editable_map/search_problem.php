<?php

include("database_info.php");

$q = $_GET['id'];

$con = mysqli_connect($host,$username,$password,$database);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"my_civfix");

//$sql="SELECT * FROM markers WHERE place like '".$q."%' ORDER BY place";
$sql = "SELECT * FROM `markers` WHERE MATCH (`place`) AGAINST('".$q."')";
$result = mysqli_query($con,$sql);

echo "<div style='padding:2px'></div>";
while($row = mysqli_fetch_array($result)) 
{
    echo "<div id='search-problem-div' onclick='zoomAt(" . $row['lat'] . ", " . $row['lng'] . ")'>";
    echo "<b>" . $row['place'] . "</b> (". $row['lat'] . ", " . $row['lng'] . ")<br>";
    echo "problema: " . $row['problem'] . "</div>";
}
echo "<div style='padding:2px'></div>";
mysqli_close($con);
?>

