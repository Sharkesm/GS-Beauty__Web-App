<?php

require_once "configuration/db_connection.php";
include_once "configuration/session.php";


cust_confirm_logged_in();



?>


<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Style-Fashion</title>
<link rel="stylesheet" type="text/css" href="style/main-style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
<script src="javascript/login.js"></script>
<script src="javascript/currency_converter.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="javascript/nav-right.js"></script>
</head>

<body>
<!---- Content of the document ---->
<div id="bg-div">

<?php include_once "include/customer-top-nav.php"; ?>



<?php include_once "include/content-right.php"; ?>







<div id="content-container">
  <div id="black-bg"></div>
  <div id="content">
      <h2><i class="material-icons">add_circle<!--  assignment_ind --></i> Edit Password Details</h2>

      <p><strong>Tips for creating passwords</strong></p><p>A password is a string of characters used to access information or a computer. Passphrases are typically longer than passwords, for added security, and contain multiple words that create a phrase. Passwords and passphrases help prevent unauthorized people from accessing files, programs, and other resources. When you create a password or passphrase, you should make it strong, which means it's difficult to guess or crack.</p>
              <?php 
             
             if(isset($_GET['error']) && isset($_GET['status']) && isset($_GET['notification'])) {
                  
                  $data = str_replace("'"," ",$_GET['error']);
                  $notification = $_GET['notification']; 

             } else if (isset($_GET['message'])) {

                  $data =  str_replace("'"," ",$_GET['message']);
                  $notification = $_GET['notification'];
             }
        ?>

       <span class=
        
        <?php  if (isset($notification) && isset($data)) {
           echo "'notify-c ". str_replace("'", "",$notification) ."'";
        

        ?>><?php echo $data; } ?></span>

            
     <form action="customer_edit_info_check.php" method="post">
            <table id="pass-form">
              <tbody>
             
                  <tr>
                      <td>Current password</td><td><input type="password" name="oldpass" class="txt-box1 " /></td>
                  </tr>
                  <tr>
                    <td>New password</td><td><input type="password" name="newpass1" class="txt-box1" /></td>
                  </tr>
                  <tr>
                    <td>Confirm new password</td><td><input type="password" name="newpass2" class="txt-box1 " /></td>
                  </tr>
                 <tr>
                    <td></td><td><input type="submit" name="Add-product" class="btn-sub1 "></td>
                  </tr>
              </tbody>
            </table>
         </form>

  </div>
</div>



</div>

<!--- End of bg-div-->
</body>
</html>