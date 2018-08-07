
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

<div id="content2">
  <span class="bl-sp">Hair Style Services<br/><em>Our hair stylists are fashion focused.</em>
 <!-- <form action="request_suggest.php" method="get">
  <input type="text" name="qh" placeholder="> Search service here...." onKeyUp="showHint(this.value);" class="st-s">
</form>-->
  </span>
<div id="txtHint">
   <?php 
           
            $selectQuery = "SELECT p.pro_id, p.pro_img, p.pro_cost, p.pro_name, s.store_location 
                           FROM   product_type pt 
                           LEFT  JOIN product p ON p.type_id = pt.type_id 
                           RIGHT JOIN product_store ps ON ps.pro_id = p. pro_id 
                           RIGHT JOIN store s ON s.store_id = ps.store_id 
                           WHERE p.type_id = 1
                           AND   p.status=1
                           ORDER BY p.pro_id DESC;
                           ";

           $executeQuery = mysqli_query($connection, $selectQuery);

           if ($executeQuery) {
            if (mysqli_affected_rows($connection) >= 1) {
               
                while($data = mysqli_fetch_assoc($executeQuery)) {

                    $proID = $data['pro_id'];
                    $img   = $data['pro_img'];
                    $cost  = $data['pro_cost'];
                    $name  = $data['pro_name'];
                    $location = $data['store_location']; 
      ?>

  <span id="hide" class="dt-tr">
    <a href=""><img src="data/product_pic/<?php echo $img; ?>"></a>
    <span class="info-tr"><?php echo $name."    &euro;".$cost;?></span>
  </span>


  <?php 

   } 

   } else 
   {
     echo "<table id='help-error'>
           <tr><td><span class='notify-c notification-error'>Sorry no records updated yet!</span></td></tr></table>";
   }
}
?>
</div>

</div>





</div>
</div>

<!--- End of bg-div-->
</body>
</html>
