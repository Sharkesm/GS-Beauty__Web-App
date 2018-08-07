<?php

require_once "configuration/db_connection.php";
include_once "configuration/session.php";


cust_confirm_logged_in();


?>


<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>GS Portal Login Page</title>
<link rel="stylesheet" type="text/css" href="style/main-style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="javascript/nav-animation.js"></script>
<script type="text/javascript" src="currency_converter.js"></script>

</head>

<body>
<!---- Content of the document ---->
<div id="bg-img-panel">
   
      
  <?php include_once'include/customer-top-header.php'; ?>


<div id="work-container">
  
   <!-- Start of Working Space -->
   <div id="admin-work-space">
   	  
      <!-- Mini link -->
   <?php include_once 'include/mini-link.php'; ?>



     <div class="min-detail max-bound">
      <span class="tab-info tab-blue">
         <span class="count-icon"><i class="material-icons ">info<!--  assignment_ind --></i></span>
         <span class="count-info"><i>1</i></span>
         <span class="info-bottom  tab-dark-blue"><i class="tab-mini-info">Active user</i></span>
      </span>
      </div>

      <div class="max-detail max-bound">
         <span class="note"><i class="material-icons">add_circle<!--  assignment_ind --></i> Edit password</span>
        
         <div id="add_product">
        <?php 
             
             if(isset($_GET['error']) && isset($_GET['status']) && isset($_GET['notification'])) {
                  
                  $data = str_replace("'"," ",$_GET['error']);
                  $notification = $_GET['notification']; 

             } else if (isset($_GET['message'])) {

                  $data =  str_replace("'"," ",$_GET['message']);
                  $notification = $_GET['notification'];
             }
        ?>

                <i class=<?php  if (isset($notification) && isset($data)) {
           echo $notification . ">" . $data;
        } 

        ?></i>
        <form action="customer_edit_info_check.php" method="post">
            <table class="add_product">
              <tbody>
                  <tr>
                      <td>Current password</td><td><input type="password" name="oldpass" class="text-box-2" /></td>
                  </tr>
                  <tr>
                    <td>New password</td><td><input type="password" name="newpass1" class="text-box-2" /></td>
                  </tr>
                  <tr>
                    <td>Confirm new password</td><td><input type="password" name="newpass2" class="text-box-2" /></td>
                  </tr>
                 <tr>
                    <td></td><td><input type="submit" name="Add-product" class="sub-box"></td>
                  </tr>
              </tbody>
            </table>
         </form>
         </div>

          <section id="appointer2-div">
            <header>Alter Instructions</header>

            <p><strong>Tips for creating passwords</strong></p><p>A password is a string of characters used to access information or a computer. Passphrases are typically longer than passwords, for added security, and contain multiple words that create a phrase. Passwords and passphrases help prevent unauthorized people from accessing files, programs, and other resources. When you create a password or passphrase, you should make it strong, which means it's difficult to guess or crack</p>
            <p></p>
            </section>


      </div>

 </div> 
<!-- End of Work container -->  
  
</div>

</body>
</html>