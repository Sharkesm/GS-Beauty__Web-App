<?php


require_once "configuration/db_connection.php";
include_once "configuration/session.php";
require_once("function/function.php"); 


cust_confirm_logged_in();



$oldpass  = (isset($_POST['oldpass'])  && trim($_POST['oldpass']))? $_POST['oldpass'] : "";
$newpass1 = (isset($_POST['newpass1']) && trim($_POST['newpass1']))? $_POST['newpass1'] : "";
$newpass2 = (isset($_POST['newpass2']) && trim($_POST['newpass2']))? $_POST['newpass2'] : "";

$errors   = array();    // Array to hold validation errors 
$data     = array();    // Array to pass back data 
$sessions = array();

       
           $encrypt = new password();
           $oldPass_encrypted  = $encrypt->encrypt_password($oldpass);
           $newpass1_encrypted = $encrypt->encrypt_password($newpass1);
           $newpass2_encrypted = $encrypt->encrypt_password($newpass2);

       
   

if (empty($oldPass_encrypted)) {

     $errors['error'] = "Please enter current password";
     $data['status'] = 'false';
     $data['notification'] = 'notification-error';
     header("location:edit_customer.php?status='".$data['status']."'&notification='".$data['notification']."'&error='".$errors['error']);

} else if (empty($newpass1_encrypted) || empty($newpass2_encrypted)) {
     
     $errors['error'] = "Please enter new password";  
     $data['status'] = 'false';
     $data['notification'] = 'notification-error';
     header("location:edit_customer.php?status='".$data['status']."'&notification='".$data['notification']."'&error='".$errors['error']);

} else if ($newpass1_encrypted != $newpass2_encrypted){

     $errors['error'] = "New password should match";
     $data['status'] = 'false';
     $data['notification'] = 'notification-error';
     header("location:edit_customer.php?status='".$data['status']."'&notification='".$data['notification']."'&error='".$errors['error']);

} else {
  
     

     $selectQuery = "SELECT cust_password FROM customer WHERE cust_id = ".$_SESSION['PHP_CUST_ID'] ." LIMIT 1";
     $executeQuery = mysqli_query($connection, $selectQuery);

     if ($executeQuery) {

      if (mysqli_affected_rows($connection)) {

        while ($field = mysqli_fetch_assoc($executeQuery)) {
          # code...
          $custPass = $field['cust_password'];
        
        }
      
      }
  }
         
         // Check if old password is correct 
     if ($oldPass_encrypted != $custPass) {

     $errors['error'] = "Wrong current password, Try again";  
     $data['status'] = 'false';
     $data['notification'] = 'notification-error';
     header("location:edit_customer.php?status='".$data['status']."'&notification='".$data['notification']."'&error='".$errors['error']);

         
     } else {

     $updateQuery = "UPDATE customer SET cust_password = '". $newpass1_encrypted ."' WHERE priority = 0 AND cust_id = ".$_SESSION['PHP_CUST_ID'] ." LIMIT 1;";
     $executeQuery = mysqli_query($connection, $updateQuery); 

     if ($executeQuery) {

      if (mysqli_affected_rows($connection) == 1) {

            $data['status'] = 'true';
            $data['message'] = 'Successfully updated password';
            $data['notification'] = 'notification-pass';
            header("location:edit_customer.php?status='".$data['status']."'&notification='".$data['notification']."'&message='".$data['message']);
      
      } else {
 
            $data['status'] = 'false';
            $data['message'] = 'Failed to updated password';
            $data['notification'] = 'notification-error';
            header("location:edit_customer.php?status='".$data['status']."'&notification='".$data['notification']."'&message='".$data['message']);
      
         }

     } else {
      
            $data['status'] = 'false';
            $data['message'] = mysqli_error($connection);
            $data['notification'] = 'notification-error';
            header("location:edit_customer.php?status='".$data['status']."'&notification='".$data['notification']."'&message='".$data['message']);
          }
  
  }

       
 }







?>