<?php
// Mysqli  ... (FUNCTION , CLASS)
// PDO    (CLASS)

session_start();

$server   = "localhost";
$database = "bloger";
$username = "root";
$password = "";


try {
  $con = mysqli_connect($server, $username, $password, $database);

  if (!$con) {

    throw new Exception('Not Connected ' . mysqli_connect_error());
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

  /*
   CRUD
   C   = CREATE   . 
   R   = READ     . 
   U   = UPDATE   . 
   D   = DELETE   . 
   */