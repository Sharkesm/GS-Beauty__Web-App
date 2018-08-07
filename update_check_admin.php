<?php


 require_once "configuration/db_connection.php";
 include_once "configuration/session.php";

confirm_logged_in();



$oldpass  = (isset($_POST['oldpass'])  && trim($_POST['oldpass']))? $_POST['oldpass'] : "";
$newpass1 = (isset($_POST['newpass1']) && trim($_POST['newpass1']))? $_POST['newpass1'] : "";
$newpass2 = (isset($_POST['newpass2']) && trim($_POST['newpass2']))? $_POST['newpass2'] : "";

$errors   = array();    // Array to hold validation errors 
$data     = array();    // Array to pass back data 
$sessions = array();

       // Random key 
       $salt   = hash("sha512","33WVKERVJEJ2#323RO923ROWPE@F34RM2RK$23P092303EWFK23LR2K3LI3*!@*2O");
       $pepper = hash("sha512","rllvkl23&*kWFLWFK34LK2P1O2E-*2L3EKF/&@FR34,F.34FO34;FO34PO.kwfker"); 

       
       $sessions['oldpass']         = hash("sha512",$oldpass); // Assign decrypted password into a variable 
       $sessions['salt']            = $salt; // Setting salt 
       $sessions['pepper']          = $pepper; // Setting pepper  
       $sessions['login_string']    = hash("sha512",$sessions['salt'] . $sessions['oldpass'] . $sessions['pepper']); // Encrypting password and assign into variable 
       $sessions['encrypted_pass']  = hash("sha512",$sessions['oldpass']); // Encrypting password and assign into variable 
       
       
       $sessions['password1']       = hash("sha512",$newpass1); // Assign decrypted password into a variable 
       $sessions['salt']            = $salt; // Setting salt 
       $sessions['pepper']          = $pepper; // Setting pepper  
       $sessions['login_string1']   = hash("sha512",$sessions['salt'] . $sessions['password1'] . $sessions['pepper']); // Encrypting password and assign into variable 
       $sessions['encrypted_pass1'] = hash("sha512",$sessions['password1']); // Encrypting password and assign into variable 
       

       $sessions['password2']       = hash("sha512",$newpass2); // Assign decrypted password into a variable 
       $sessions['login_string2']   = hash("sha512",$sessions['salt'] . $sessions['password2'] . $sessions['pepper']); // Encrypting password and assign into variable 
       $sessions['encrypted_pass2'] = hash("sha512",$sessions['password2']); // Encrypting password and assign into variable 
      
       $sessions['user_browser']    = $_SERVER['HTTP_USER_AGENT']; // Get the user agent string of the user 
       $sessions['brower_key']      = str_shuffle("93834KJDK#$$J#KJ$F#FIlerkf3lfk!IWmlkfl3@&^&#kljl#fkl#k3498fWKJFEKRV"); // Shuffling browser key for security issues  
       $sessions['hashed_browserString']   = substr(str_shuffle(hash("sha512",$sessions['brower_key'] . $sessions['user_browser'])),0,50);  // 128 Characters (shuffled string) 

       
   

if (empty($oldpass)) {

	   $errors['error'] = "Please enter current password";
	   $data['status'] = 'false';
     $data['notification'] = 'notification-error';
  	 header("location:admin_edit.php?status='".$data['status']."'&notification='".$data['notification']."'&error='".$errors['error']."'&active_string='".$sessions['hashed_browserString']."'");

} else if (empty($newpass1) || empty($newpass2)) {
     
     $errors['error'] = "Please enter new password";	
	   $data['status'] = 'false';
     $data['notification'] = 'notification-error';
  	 header("location:admin_edit.php?status='".$data['status']."'&notification='".$data['notification']."'&error='".$errors['error']."'&active_string='".$sessions['hashed_browserString']."'");

} else if ($sessions['encrypted_pass1'] != $sessions['encrypted_pass2']){

	   $errors['error'] = "New password should match";
	   $data['status'] = 'false';
     $data['notification'] = 'notification-error';
  	 header("location:admin_edit.php?status='".$data['status']."'&notification='".$data['notification']."'&error='".$errors['error']."'&active_string='".$sessions['hashed_browserString']."'");

} else {
  
     

     $selectQuery = "SELECT cust_password FROM customer WHERE cust_id = ". $_SESSION['PHP_ADMIN_ID'] ." AND priority = 1 LIMIT 1";
     $executeQuery = mysqli_query($connection, $selectQuery);

     if ($executeQuery) {

     	if (mysqli_affected_rows($connection)) {

     		while ($field = mysqli_fetch_assoc($executeQuery)) {
     			# code...
     			$adminPass = $field['cust_password'];
     		}
     	}
     }
     
     if ($sessions['encrypted_pass'] != $adminPass) {

     $errors['error'] = "Incorrect current password";	
	   $data['status'] = 'false';
     $data['notification'] = 'notification-error';
  	 header("location:admin_edit.php?status='".$data['status']."'&notification='".$data['notification']."'&error='".$errors['error']."'&active_string='".$sessions['hashed_browserString']."'");

         
     } else {

     $updateQuery = "UPDATE customer SET cust_password = '".$sessions['encrypted_pass1']."' WHERE priority = 1 LIMIT 1;";
     $executeQuery = mysqli_query($connection, $updateQuery); 

     if ($executeQuery) {

     	if (mysqli_affected_rows($connection) == 1) {

     		$data['status'] = 'true';
            $data['message'] = 'Successfully updated password';
            $data['notification'] = 'notification-pass';
            header("location:admin_edit.php?status='".$data['status']."'&message='".$data['message']."'&notification='".$data['notification']."'&active_string='". $sessions['hashed_browserString']."'");
     	
     	} else {
 
       		$data['status'] = 'false';
            $data['message'] = 'Failed to updated password';
            $data['notification'] = 'notification-error';
            header("location:admin_edit.php?status='".$data['status']."'&message='".$data['message']."'&notification='".$data['notification']."'&active_string='". $sessions['hashed_browserString']."'");
 
     	}

     } else {

     	    $data['status'] = 'false';
            $data['message'] = mysqli_error($connection);
            $data['notification'] = 'notification-error';
            header("location:admin_edit.php?status='".$data['status']."'&message='".$data['message']."'&notification='".$data['notification']."'&active_string='". $sessions['hashed_browserString']."'");
     }
  
  }

       
 }







?>