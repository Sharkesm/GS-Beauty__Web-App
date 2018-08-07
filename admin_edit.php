
<?php

require_once "configuration/db_connection.php";
include_once "configuration/session.php";


confirm_logged_in();



?>

<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Style-Fashion</title>
<link rel="stylesheet" type="text/css" href="style/main-style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
<script src="javascript/currency_converter.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="javascript/nav-right.js"></script>
</head>

<body>
<!---- Content of the document ---->
<div id="bg-div1">

<?php include_once "include/admin-top-nav.php"; ?>


<?php include_once "include/content-left.php"; ?>

<div id="content-container1">

 <div id="min-update">
     <section id="form-update" class="ls-form">
      <strong class="tb4">Account Setting</strong>
     

     <?php 
             
       if(isset($_GET['error']) && isset($_GET['status']) && isset($_GET['notification']) && isset($_GET['active_string'])) {
                  
                  $data = str_replace("'"," ",$_GET['error']);
                  $notification = str_replace("'"," ", $_GET['notification']);

            $s =  str_replace("'"," ",$_GET['status']);

             if ($s == true) 
             {
                $sign = "&#xE000;";
             } else 
             {
                $sign = "&#xE86C;";
             }

             } else if (isset($_GET['message'])) {

                  $data =  str_replace("'"," ",$_GET['message']);
                  $notification = str_replace("'"," ", $_GET['notification']);

            $s =  str_replace("'"," ",$_GET['status']);

             if ($s == true) 
             {
                $sign = "&#xE000;";
             } else 
             {
                $sign = "&#xE86C;";
             }
             }
    
             

        ?>



      <span class="notify1<?php echo $notification; ?>"><i class="material-icons"><?php  if (isset($sign)){ echo $sign; } ?></i> <?php  if (isset($data)) {echo $data; } ?></span>


      <form id="updatePass" method="post" action="update_check_admin.php">
      <table id="update-tbl">
        <tr>
           <td><input type="password" name="oldpass" placeholder="Current password" class="under_border"></td>
        </tr>
        <tr>
           <td><input type="password" name="newpass1" placeholder="New password" class="under_border"></td>
        </tr>
        <tr>
           <td><input type="password" name="newpass2" placeholder="Confirm password" class="under_border"></td>
        </tr>
        <tr>
           <td><input type="submit" name="sub" value="Change password" class="btn-sub2"></td>
        </tr>
      </table>
    </form>
     </section>

     <section id="form-update" class="rs-form">
      <span class="min-img">
       <img src="image/avatar.png"/>
      </span>
      <table id="update-tbl" class="up-tb">
        <tr>
           <td>User</td>
        </tr>
        <tr>
           <td><span class="nb">
            <?php 
              
              $adminQuery = "SELECT cust_name FROM customer WHERE priority = 1"; 

              if ($execute = mysqli_query($connection,$adminQuery))
              {
                 while($data = mysqli_fetch_assoc($execute)){
                   echo $data['cust_name'];
                 }
              }

           ?></span></td>
        </tr>
        <tr>
           <td></td>
        </tr>
      </table>
     </section>
 </div>





</div>
</div>

<!--- End of bg-div-->
</body>
</html>
