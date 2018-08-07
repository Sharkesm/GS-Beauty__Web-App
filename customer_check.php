<?php

 require_once "configuration/db_connection.php";
 include_once "configuration/session.php";
 require_once("function/function.php"); 


if (cust_logged_in()) {
  header("location:". $_SESSION['cust_redirect_page']);
} else {

// Global variables 

  $errors   = array();    // Array to hold validation errors 
  $data     = array();    // Array to pass back data 
  $field    = array();    // Array to store fields value
  $sessions = array();    // Array to hold session properties  
  $secured_url  = array();  // Array to hold secured url properties
  

  // Assigning form values into variables and perform conditioning 

  $email    = (isset($_POST['email']))? $_POST['email'] : "";
  $password = (isset($_POST['pass']))? $_POST['pass'] : "";
   
  // Validate the variables =================================
     // If any if these variables don't exist, add an error to our $error array 

 // Email checking 
   if (trim($email) == "")
       $errors['email_invalid'] = "<i class='material-icons'>&#xE002;</i><strong>Please</strong> enter your <strong>email</strong>";

   else if (!preg_match("/^[0-9a-z]+(([\.\-_])[0-9a-z]+)*@[0-9a-z]+(([\.\-])[0-9a-z-]+)*\.[a-z]{2,}$/i", $email))
            $errors['email_invalid'] = "<i class='material-icons'>&#xE002;</i><strong>Warning</strong> email entered is <strong>invalid</strong>";
  
// Password checking
  if (empty($password))
  	  $errors['password_invalid'] = "<i class='material-icons'>&#xE002;</i><strong>Please</strong> enter your <strong>password</strong>";




// Return a response ========================================
   // If there are any errors in our errors array, return a success boolean of false 

  if (!empty($errors)) {
     // if there are items in our errors array, return those errors
  	$data['success']   = false;
  	$data['errors']    = $errors;

  }  else {
    

  	       $encrypt = new password();
           $pass_encrypted  = $encrypt->encrypt_password($password);
      

  $checkUserQuery = "SELECT cust_id,cust_email,cust_password
                       FROM customer
                       WHERE cust_email = '". $email ."'
                       AND cust_password = '". $pass_encrypted ."'
                       AND priority = 0 LIMIT 1;";
  
  
    // If there are no errors process our form, then return a messsage 
       $salt   = hash("sha512","33WVKERVJEJ2#323RO923ROWPE@F34RM2RK$23P092303EWFK23LR2K3LI3*!@*2O");
       $pepper = hash("sha512","rllvkl23&*kWFLWFK34LK2P1O2E-*2L3EKF/&@FR34,F.34FO34;FO34PO.kwfker"); 

       $sessions['password']        = hash("sha512",$password); // Assign decrypted password into a variable 
       $sessions['salt']            = $salt; // Setting salt 
       $sessions['pepper']          = $pepper; // Setting pepper  
       $sessions['login_string']    = hash("sha512",$sessions['salt'] . $sessions['password'] . $sessions['pepper']); // Encrypting password and assign into variable 
       $sessions['encrypted_pass']  = hash("sha512",$sessions['password']); // Encrypting password and assign into variable 
       
      

    $checkAdminUserQuery  = "SELECT cust_id,cust_email,cust_password ";
    $checkAdminUserQuery .= "FROM customer ";
    $checkAdminUserQuery .= "WHERE cust_email = '". $email ."' ";
    $checkAdminUserQuery .= "AND cust_password = '". $sessions['encrypted_pass'] ."' ";
    $checkAdminUserQuery .= "AND priority = 1 LIMIT 1";
  
  




  	// Execute checkUserQuery Query - checking for customers

 if ($executeQuery =  mysqli_query($connection, $checkUserQuery)) {

  	if(mysqli_affected_rows($connection) == 1) {
  		
      while ($userData = mysqli_fetch_assoc($executeQuery)) {
       
      
      // Adding values into session 

       $_SESSION['PHP_CUST_ID']   = $userData['cust_id'];
       //$_SESSION['login_string']   = hash("sha512",$salt . $password . $pepper); 

     
      // Assigning values into session properties 
       
       $sessions['user_mail']      = $userData['cust_email'];
       $sessions['user_browser']   = $_SERVER['HTTP_USER_AGENT']; // Get the user agent string of the user 
       $sessions['brower_key']     = str_shuffle("f34lf3;kfFWEFFERGEGEV232EKl#fkl#k3498fWKJFEKRV"); // Shuffling browser key for security issues  
       $sessions['hashed_browserString']   = str_shuffle(hash("sha512",$sessions['brower_key'] . $sessions['user_browser']));  // 128 Characters (shuffled string) 

       
       // Redirect link 
       $redirect_url['url_page'] = str_replace("customer_check", "customer",$_SERVER['PHP_SELF']);  // Changing active link to redirect link 
       $secured_url['url']   = $redirect_url['url_page']. "?activeID=". $userData['cust_id'] ."&type='A'&uBrowser='". $sessions['hashed_browserString'] ."'"; // Complete link
       

       // Assigning redirect into session
       $_SESSION['cust_redirect_page'] = $secured_url['url'];
       $_SESSION['cust_browserString'] = "'". $sessions['hashed_browserString'] . "'"; // Key browser complete value


       // Show a message of success and provide success variable 
       $data['success'] = true;
       $data['message'] = "Success! - User found ";
       $sessions['redirect']  = $secured_url; // Adding secured url property into session object   
       $data['session_pass']  = $sessions;  // Adding session property into data JSON object 
       
          
      }
  	

    } else {
  		

  // Execute checkUserQuery Query - Checking for Admin 

 if ($executeQuery =  mysqli_query($connection, $checkAdminUserQuery)) {

    if(mysqli_affected_rows($connection) == 1) {
      
      while ($userData = mysqli_fetch_assoc($executeQuery)) {
       
      
     
      // Adding values into session 
       $data['success'] = true;
       $data['message'] = "Success! - User found";
       
       $_SESSION['PHP_ADMIN_ID']   = $userData['cust_id'];
       //$_SESSION['login_string']   = hash("sha512",$salt . $password . $pepper); 

     
      // Assigning values into session properties 
       
       $sessions['user_mail']      = $userData['cust_email'];
       $sessions['user_browser']   = $_SERVER['HTTP_USER_AGENT']; // Get the user agent string of the user 
       $sessions['brower_key']     = str_shuffle("efeWKFJERFWEFFERGEGWWFG@&^&#kljl#fkl#k3498fWKJFEKRV"); // Shuffling browser key for security issues  
       $sessions['hashed_browserString']   = str_shuffle(hash("sha512",$sessions['brower_key'] . $sessions['user_browser']));  // 128 Characters (shuffled string) 

       
       // Redirect link 
       $redirect_url['url_page'] = str_replace("customer_check", "admin_panel",$_SERVER['PHP_SELF']);  // Changing active link to redirect link 
       $secured_url['url']   = $redirect_url['url_page']. "?activeID=". $userData['cust_id'] ."&type='A'&uBrowser='". $sessions['hashed_browserString'] ."'"; // Complete link
       

       // Assigning redirect into session
       $_SESSION['redirect_page'] = $secured_url['url'];
       $_SESSION['browserString'] = "'". $sessions['hashed_browserString'] . "'"; // Key browser complete value


       // Show a message of success and provide success variable 
       $sessions['redirect']  = $secured_url; // Adding secured url property into session object   
       $data['session_pass']  = $sessions;  // Adding session property into data JSON object 
       

          
      }
    

    } else {
      // Show a message of failure and provide fail variable 
      $data['success'] = false;
      $data['message'] = "<i class='material-icons'>&#xE002;</i><strong>Username</strong> or <strong>Password</strong> entered is <strong>incorrect</strong>";
      //$data['attribute'] = "{'email': ". $email . ",'password':" . $password ."}";
    }  
  } else {
       // Show a message of failure and provide fail variable 
       $data['success'] = false;
       $data['message'] = "Database failed to execute query - (User Query)";
      }

  	}  
  

  } else {
       // Show a message of failure and provide fail variable 
  	   $data['success'] = false;
  	   $data['message'] = "Database failed to execute query - (User Query)";
   }


 }


// Returning back Data in JSON format 
echo json_encode($data);
}








?>