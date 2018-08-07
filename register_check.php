<?php
// Configuration includes 
 require_once("configuration/db_connection.php"); 
 require_once("function/function.php");   

  $errors   = array();    // Array to hold validation errors 
  $data     = array();    // Array to pass back data 

  
  // Assigning form values into variables and perform conditioning 

  $customer_name     = (isset($_POST['cname']))? $_POST['cname'] : "";
  $register_email    = (isset($_POST['email']))? $_POST['email'] : "";
  $register_password = (isset($_POST['pass1']))? $_POST['pass1'] : "";
  $confirm_password  = (isset($_POST['pass2']))? $_POST['pass2'] : ""; 

// 
  if (empty($customer_name)) 
  	  $errors['name_invalid'] = '<i class="material-icons">&#xE001;</i><strong>Warning</strong> please enter your <strong>full name</strong>';

 // Email checking 
   if (empty($register_email))
       $errors['email_invalid'] = "<i class='material-icons'>&#xE001;</i><strong>Warning</strong> please enter your <strong>email</strong>";
   else if (!preg_match("/^[0-9a-z]+(([\.\-_])[0-9a-z]+)*@[0-9a-z]+(([\.\-])[0-9a-z-]+)*\.[a-z]{2,}$/i", $register_email))
  	   $errors['email_invalid'] = "<i class='material-icons'>&#xE8B2;</i>Email entered is invalid";
  
// Password checking 
  if ((empty($register_password)) || (empty($confirm_password))) 
  	  $errors['password_invalid'] = "<i class='material-icons'>&#xE001;</i><strong>Oh snap!</strong> please enter your <strong>password</strong>";
  else if ($register_password != $confirm_password)
      $errors['password_invalid'] = "<i class='material-icons'>&#xE8B2;</i><strong>Oh snap!</strong> password do not <strong>match</strong>";
  


// Return a response ========================================
   // If there are any errors in our errors array, return a success boolean of false 
  if (!empty($errors)) {
  	// if there are items in our errors array, return those errors
  	$data['success']   = false;
  	$data['errors']    = $errors;

  } else {
     
     	// If there are no errors process our form, then return a messsage 
    		
         // Show a message of success and provide success variable 
    $encrypt = new password();
    $encryptPass = $encrypt->encrypt_password($register_password);


  	$registerUserQuery  = "INSERT INTO customer(cust_name,cust_email,cust_password) ";
    $registerUserQuery .= "VALUES('". $customer_name ."','". $register_email ."','". $encryptPass ."')";

  	// Execute checkUserQuery Query 
 if ($executeQuery =  mysqli_query($connection, $registerUserQuery)) {

  	if(mysqli_affected_rows($connection) == 1) {
  
  		 $data['success'] = true;
  		 $data['message'] = "<i class='material-icons'>&#xE86C;</i><strong>Well done!</strong> your registration was <strong>Successfully</strong> done";
  		
  		
  	} else {
  		// Show a message of failure and provide fail variable 
  		$data['success'] = false;
  		$data['message'] = "<i class='material-icons'>&#xE8B2;</i><strong>Oh snap!</strong> registration was <strong>not Successfully</strong>";
  		//$data['attribute'] = "{'email': ". $email . ",'password':" . $password ."}";
  	}  
  } else {
       // Show a message of failure and provide fail variable 
  	   $data['success'] = false;
  	   $data['message'] = "Database failed to execute query - (User Query)";
   }

}


// Returning back Data in JSON format 
echo json_encode($data);




?>