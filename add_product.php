
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
<script type="text/javascript">

  function updateForm(form)
  {
    returnValue = true; 

    var box = form.getElementsByClassName("under_border"); 

        for (var i = 0; i < box.length; i++)
        {
            if (box[i].value.length == 0)
            {
              alert("Please fill in the Form");
              box[i].focus();
              box[i].style.backgroundColor = "rgba(241, 196, 15,.2)"; 
              returnValue = false;
              break;
            } else if (isNaN(box[3].value)) 
            {
              alert("Please enter cost in digits only"); 
              box[3].focus();
              box[3].style.backgroundColor = "rgba(241, 196, 15,.2)"; 
              returnValue = false;
              break;
            } else if (isNaN(box[3].value)) 
            {
              alert("Please enter cost in digits only"); 
              box[3].focus();
              box[3].style.backgroundColor = "rgba(241, 196, 15,.2)"; 
              returnValue = false;
              break;
            }
        }

        return returnValue;
  }




</script>
</head>

<body>
<!---- Content of the document ---->
<div id="bg-div1">

<?php include_once "include/admin-top-nav.php"; ?>


<?php include_once "include/content-left.php"; ?>

<div id="content-container1">

 <div id="min-update1">
     <section id="form-update" class="ls-form">
      <strong class="tb4">Add Service</strong>
     

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


      <form id="updatePass" method="post" action="add_product_check.php" onsubmit="return updateForm(this);" enctype="multipart/form-data">
      <table id="update-tbl">
        <tr>
           <td><input type="text" name="pname" placeholder="Service name" class="under_border"></td>
        </tr>
         <tr>
           <td>
              <select name="pro_type" class="select under_border">
                              <option value="">Select service</option>
                               <?php
                                
                                    $querySelect = "SELECT * FROM product_type";    
                                    // Execute checkUserQuery Query 
                                    if ($executeQuery =  mysqli_query($connection, $querySelect)) {

                                       if(mysqli_affected_rows($connection) > 0) {
                                         
                                          while ($data = mysqli_fetch_assoc($executeQuery)) {
                                          $option  = "<option value=". $data['type_id'] .">";
                                          $option .= $data['type_name'];
                                          $option .= "</option>";
                                          echo $option; 
                                        }
                                      } 
                                    }
                                    

                                  ?>
                                   </select>
           </td>
        </tr>
        <tr>
           <td>
                 <select name="store" class="select under_border">
                           <option value="">Select Store</option>
                               <?php
                                
                                    $querySelect = "SELECT * FROM store";    
                                    // Execute checkUserQuery Query 
                                    if ($executeQuery =  mysqli_query($connection, $querySelect)) {

                                       if(mysqli_affected_rows($connection) > 0) {
                                         
                                          while ($data = mysqli_fetch_assoc($executeQuery)) {
                                          $option  = "<option value=". $data['store_id'] .">";
                                          $option .= $data['store_location'];
                                          $option .= "</option>";
                                          echo $option; 
                                        }
                                      } 
                                    }
                                    

                                  ?>
                                   </select>
           </td>
        </tr>
        <tr>
           <td><input type="text" name="cost" placeholder="Product cost" class="under_border"></td>
        </tr>
          <tr>
           <td><input type="submit" id="submit" name="sub" value="Add product" class="btn-sub2"></td>
        </tr>
     
      </table>
     </section>

     <section id="form-update" class="rs1-form">
      <span class="min-img1">
       <img src="image/file.png"/>
      </span>
      <table id="update-tbl" class="up-tb">
        <tr>
           <td>Source upload</td>
        </tr>
        <tr>
           <td>
              <input type="file" class="upload" name="profile_pic"/>
       </td>
        </tr>
         
      </table>
    </form>
   
     </section>
 </div>





</div>
</div>

<!--- End of bg-div-->
</body>
</html>
