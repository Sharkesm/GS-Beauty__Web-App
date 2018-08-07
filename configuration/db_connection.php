<?php
/*
* File: db_connection.php
* Purpose: Establishing mysql server connection 
* Created: 11/08/2015
* Last Update : 11/08/2015
*/
require_once("constants.php");

// Establishing mysql server connection 
$connection = @mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD); 


// Check connection conditon 
if (!$connection) {  // If connection failed throw error 
  
  die("Mysql sevrver connection failed: ". mysqli_connect_error());

} else { // Select Database 
  
  $db_conn = @mysqli_select_db($connection,DB_NAME) ;
  if(!$db_conn) { // Check DB connected 

  	die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Database not available : ".mysqli_error($connection)); 	
  } 
  
}










?>