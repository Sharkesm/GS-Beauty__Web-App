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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="javascript/currency_converter.js"></script>
<script src="javascript/nav-right.js"></script>
<script type="text/javascript" src="javascript/appointment_validation.js"></script>
<link   rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="data/jquery-timepicker-1.3.2/jquery.timepicker.js"></script>
<link type="text/css" rel="stylesheet" href="data/jquery-timepicker-1.3.2/jquery.timepicker.css">
<script type="text/javascript">
  
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd"});
     $('input.timepicker').timepicker({ timeFormat: 'h:mm:ss' });

 });


</script>

</head>

<body>
<!---- Content of the document ---->
<div id="bg-div">

<?php include_once "include/customer-top-nav.php"; ?>



<?php include_once "include/content-right.php"; ?>







<div id="content-container">
  <div id="black-bg"></div>
  <div id="content">
      <h2><i class="material-icons">add_circle<!--  assignment_ind --></i> Appointment Session</h2> 
<?php 

      if (isset($_GET['img_src']) && isset($_GET['location']) && isset($_GET['type']) && isset($_GET['product']))
      {
          $img = $_GET['img_src'];
          $location = $_GET['location'];
          $product = $_GET['product'];
          $type = $_GET['type'];
      }
?>
     <div id="image-info3"> <img src="<?php if (isset($img)) 
     { 
      echo 'data/product_pic/'.trim(str_replace("'"," ",$img));
    }?>"/><span>
      <p>
        Product name : <?php   if(isset($product)) { echo trim(str_replace("'", " ",$product)); }?></br/>
        Service Type : <?php   if(isset($type)) { echo trim(str_replace("'", " ",$type)); }?> <br/>
        Location     : <?php   if(isset($location)) { echo trim(str_replace("'", " ",$location)); }?>
      </p>
    </span>     
     </div>

    <span class="notify-c2"></span>

     <form action="appointment_check.php" method="post" id="cust_appointment">
         <table id="pass-form">
                <tbody>
                  <tr>
                    <td>Appoint date </td><td><input type="text" name="date" class="txt-box1" placeholder="YYYY / MM / DD" id="datepicker"/></td>
                  </tr>
                  <tr>
                    <td>Appoint time </td><td><input type="text" name="time" class="txt-box1 timepicker" placeholder="-- : --"/></td>
                  </tr>
                 <tr>
                    <td></td><td><input type="hidden" name="product" value="<?php echo $_GET['id']; ?>"></td>
                  </tr>
                 <tr>
                    <td></td><td><input type="hidden" name="type" value="<?php echo $_GET['typeID']; ?>"></td>
                  </tr>
                 <tr>
                    <td></td><td><input type="hidden" name="store" value="<?php echo $_GET['storeID'];?>"></td>
                  </tr>
                  <tr>
                    <td></td><td><input type="submit" name="Add-product" value='Submit' class="btn-sub1"></td>
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