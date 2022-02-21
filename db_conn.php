<?php
//Connecting to the Database below using PDO

$serverName = "localhost";
$userName = "root";
$pass = "root";
$db_name = "to_do_list";

try{
  $conn = new PDO("mysql:host=$serverName;dbname=$db_name", $userName, $pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  #echo "Connected to Database!";

}catch(PDOException $e){
  echo "Failed to connect to Database! " . $e->getMessage();

}

?>