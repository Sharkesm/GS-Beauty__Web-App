<?php

require_once "configuration/db_connection.php";
include_once "configuration/session.php";

cust_confirm_logged_in();




$date    = (isset($_POST['date']) && trim($_POST['date']))? $_POST['date'] : "";
$time    = (isset($_POST['time']) && trim($_POST['time']))? $_POST['time'] : "";
$product = (isset($_POST['product']) && trim($_POST['product']))? $_POST['product'] : "";
$type    = (isset($_POST['type']) && trim($_POST['type']))? $_POST['type'] : "";
$store   = (isset($_POST['store']) && trim($_POST['store']))? $_POST['store'] : "";


  $errors   = array();    // Array to hold validation errors 
  $data     = array();    // Array to pass back data 
 

$date_format = str_replace("/", "-",$date);
$dateDB = date("Y-m-d",strtotime($date_format));
$timeDB = date("H:m:s",strtotime($time));

  


if (empty($date)){
	$data['status'] = false;
	$errors['invalid_date'] = "Please enter valid date";
}

else if (empty($time)) {
	$data['status'] = false;
	$errors['invalid_time'] = "Please enter valid time";
}

else if (empty($product) || empty($type) || empty($store)){
	     $data['status'] = false;
         $errors['service_unavaible'] = "Service unavailable, Please try again later";
}


    if (!empty($errors)) {
     // if there are items in our errors array, return those errors
  	$data['status']   = false;
  	$data['errors']    = $errors;

  } else {

$insertQuery  = "INSERT INTO appointment ";
$insertQuery .= "VALUES (". $_SESSION['PHP_CUST_ID'] .",". $product .",". $type .",". $store .",'". $dateDB."', '". $timeDB ."')";
$executeQuery = mysqli_query($connection, $insertQuery);

  if ($executeQuery) {
	
	  if(mysqli_affected_rows($connection) >= 1) {
       
         

         // Selecting a customer query 

        $selectEmail = "SELECT cust_name, cust_email from customer WHERE cust_id = ". $_SESSION['PHP_CUST_ID']; 
        $executeQuery = mysqli_query($connection,$selectEmail); 

        if ($executeQuery) {
           while($v = mysqli_fetch_assoc($executeQuery)) {
               

        $data['status'] = true;
        $data['message'] = 'Successfully created appointment';
        
              $to = $v['cust_email']; 
              $subject = "Order Product and Service";
              $message = "Hellow ".$v['cust_name'].",\n You have ordered some products and Treatment. Thank you very much"; 
               

               // Mail a customer 
              mail($to, $subject, $message);
     	
           }
        }

	} else {
		  $data['status'] = false;
	  	  $data['message'] ="Please try again later, Service unavailable";
	  }
   } else {
	      $data['status'] = false;
	      $data['message'] = "Error occoured - service unavailable";
    }

}



echo json_encode($data)
















?>