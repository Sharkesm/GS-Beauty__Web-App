<?php
require_once "configuration/db_connection.php";
include_once "configuration/session.php";


confirm_logged_in();



  $errors   = array();    // Array to hold validation errors 
  $data     = array();    // Array to pass back data 
  $data['notification'] = 'notification-error';


  // Assigning form values into variables and perform conditioning 


  $type    = (isset($_POST['pro_type']) && (trim($_POST['pro_type']) != ""))? $_POST['pro_type'] : "";
  $pname = (isset($_POST['pname']) && (trim($_POST['pname']) != ""))? $_POST['pname'] : "";
  $store    = (isset($_POST['store']) && (trim($_POST['store']) != ""))? $_POST['store'] : "";
  $cost = (isset($_POST['cost']) && (trim($_POST['cost']) != ""))? $_POST['cost'] : "";

  
  // Validate the variables =================================
     // If any if these variables don't exist, add an error to our $error array 

 // Empty fields checking 
   if (empty($type))
       $errors[] = "Please select the Product type";
   else if (empty($pname)) 
       $errors[] = "Please enter the Product name";
   else if (empty($store))
       $errors[] = "Please select the Store";
   else if (empty($cost))
       $errors[] = "Please enter the Price amount";
  
// Numeric checking
  if (!is_numeric($cost))
      $errors[] = "Please enter valid digits";



// Return a response ========================================
   // If there are any errors in our errors array, return a success boolean of false 

  if (!empty($errors)) {
     // if there are items in our errors array, return those errors
    $data['status']   = 'false';
    $data['errors']    = $errors;
    
    header("location:add_product.php?status='". $data['status'] ."'&notification='". $data['notification'] ."'&errors='". $data['errors'][0] ."'");

  }  else {
     
    if (isset($_FILES['profile_pic'])) {
       // checking the image format either PNG, JPEG or GIF
       if (($_FILES['profile_pic']['type'] == "image/png") || ($_FILES['profile_pic']['type'] == "image/jpeg") || ($_FILES['profile_pic']['type'] == "image/gif")) {
                        
              if ($_FILES['profile_pic']['size'] < 8048576) { 
                  // equivalent to 8mb 
                           // creating randomly file's
                              $chars  = "abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTVUWXYZ0123456789";
                              $rand_dir_name = substr(str_shuffle($chars), 0, 15);
                              mkdir ("data/product_pic/$rand_dir_name");
     
     // checking if the image in directory exists
     if (file_exists("data/product_pic/$rand_dir_name/".$_FILES['profile_pic']['name'])){   
         
         $data['message'] = $_FILES['profile_pic']['name']. " already exists";
    } // end if file exists echo message
     else {
          
           $profile_pic_name = $_FILES['profile_pic']['name'];
        

            // Add product 
           $addProductQuery = "INSERT INTO product (type_id,pro_name,pro_cost,pro_img,status) VALUES ($type,'$pname','$cost','$rand_dir_name/$profile_pic_name',1);";
           $addProduct = mysqli_query($connection,$addProductQuery); 
           

           if (mysqli_affected_rows($connection) > 0) 
           {

              $proID = mysqli_insert_id($connection); 
              $_SESSION['product_id'] = $proID;

              $addToStoreQuery = "INSERT INTO product_store VALUES (". $proID .",$type,$store);";
              $addToStore =  mysqli_query($connection,$addToStoreQuery);
            
              if (mysqli_affected_rows($connection) > 0) 
              { 
                
               move_uploaded_file($_FILES['profile_pic']['tmp_name'],"data/product_pic/$rand_dir_name/".$_FILES['profile_pic']['name']);
           //echo "Moved and Stored into : user_data/profile_pics/$rand_dir_name/".$_FILES['profile_pic']['name'];
            
              $data['status'] = 'true';
              $data['message'] = "Successfully product uploaded";
              $_SESSION['status_data_img'] = str_shuffle(hash("sha512", $rand_dir_name));
 
               header("location:add_product.php?active=". $_SESSION['product_id']."&notification='notification-pass'&status='".$data['status']."'&status_data_img='".$_SESSION['status_data_img']."'&message='".$data['message']."'");

               // end if profile image is updated 

              } else 
              {
                echo "Failed to insert into product store";
              }

           }  else {
            echo "Failed to insert product";
           }       


    }    // end if transfering image from temprorary files to server
}   // end if profile pic size is within 8mb size limit
     else { 
      
      $data['status'] = 'false';
      $data['message'] = "Sorry image size is too large";
      $_SESSION['status_data_img'] = str_shuffle(hash("sha512", $rand_dir_name));
       
     header("location:add_product.php?active=". $_SESSION['product_id']."&notification='notification-error'&status='".$data['status']."'&status_data_img='".$_SESSION['status_data_img']."'&error='".$data['message']."'");
    
   }
     } // end if profile pic format matches
     else { 
      
      $data['status'] = 'false';
      $data['message'] = "Invalid image format";
      $_SESSION['status_data_img'] = str_shuffle(hash("sha512", $rand_dir_name));
       

      header("location:add_product.php?active=". $_SESSION['product_id']."&notification='notification-error'&status='".$data['status']."'&status_data_img='".$_SESSION['status_data_img']."'&error='".$data['message']."'");
     
      }
   
  } else {
      $data['status'] = 'false';
      $data['message'] = "Please upload a product image";
      $_SESSION['status_data_img'] = str_shuffle(hash("sha512", $rand_dir_name));
       

      header("location:add_product.php?active=". $_SESSION['product_id']."&notification='notification-error'&status='".$data['status']."'&status_data_img='".$_SESSION['status_data_img']."'&error='".$data['message']."'");
     
     
  }


}




?>