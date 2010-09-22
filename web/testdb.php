<?php

// $hostname="74.54.18.146";
$hostname="gator320.hostgator.com";
$username="sguarauz_nido";
$password="nidonido";
$dbname="sguarauz_nido";
$usertable="subjects";
$yourfield = "name";

mysql_connect($hostname,$username, $password) or die ("<html>errore!</html>");
mysql_select_db($dbname);

# Check If Record Exists

$query = "SELECT * FROM $usertable";

$result = mysql_query($query);

if($result)
{
while($row = mysql_fetch_array($result))
{
$name = $row["$yourfield"];
echo "Name: ".$name."<br>";
}
}
?> 
