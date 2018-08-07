<?php

require_once "configuration/db_connection.php";
include_once "configuration/session.php";


cust_confirm_logged_in();

if (!isset($_GET['activeID']) && trim($_GET['activeID']) == "") {
  header("location: customer.php");
} else {
             $currency; 

             $activeID = $_GET['activeID'];
             $storeName = str_replace("'", " ",$_GET['store']);
             // Checking ID for currency exchange 
           if ($activeID) {
               $currency = "&pound;";
             }
}


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


      <div class='max-detail'>

      <h2><i class="material-icons">&#xE896;</i> Store Details</h2>      
      
      <?php 
           
           $selectQuery = "SELECT ps.pro_id,ps.type_id,ps.store_id,p.pro_img, p.pro_cost, p.pro_name, s.store_location, pt.type_name
                           FROM product_type pt 
                           LEFT JOIN product p ON p.type_id = pt.type_id 
                           RIGHT JOIN product_store ps ON ps.pro_id = p. pro_id 
                           RIGHT JOIN store s ON s.store_id = ps.store_id 
                           WHERE pS.store_id = $activeID 
                           AND p.status = 1
                           ORDER BY p.pro_id DESC;";
           
           $executeQuery = mysqli_query($connection, $selectQuery);

           if ($executeQuery) {
            if (mysqli_affected_rows($connection) >= 1) {
               
                while($data = mysqli_fetch_assoc($executeQuery)) {
                    $type = $data['type_name'];
                    $pro_id  = $data['pro_id'];
                    $type_id = $data['type_id'];
                    $store_id = $data['store_id'];
                    $img  = $data['pro_img'];
                    $cost = $data['pro_cost'];
                    $name = $data['pro_name'];
                    $location = $data['store_location']; 

                    $string_info = str_shuffle(hash("sha512",$type.$pro_id.$type_id.$store_id.$img.$cost.$name.$location));
                    $_SESSION['appoint_string'] = "'". $string_info . "'";
      ?>
     
    <!--    <span class="img-div">
        <img src="image/No_image_available.png"/>
        <span class="info-bottom-2  tab-light-blue"><em><a href="">Sprite</a></em></span>
        </span>-->
<span class="img-div">
         <a href="appointment_customer.php?string_info='<?php echo $string_info; ?>'&id=<?php echo $pro_id; ?>&typeID=<?php echo $data['type_id']; ?>&storeID=<?php echo $store_id; ?>&type='<?php echo $type; ?>'&product='<?php echo $name; ?>'&cost=<?php echo $cost; ?>&img_src='<?php echo $img; ?>'&location='<?php echo $location; ?>'"><img src="data/product_pic/<?php echo $img; ?>" alt="product image"/></a>
         <span class="info-bottom-2"><em><?php echo $name." ( $currency ".$cost." )"; ?><br/><?php echo $location; ?></em></span>
       </span>

        <?php 
            
                    }
                } else {

                    echo "<p style='text-align: center; color: red;'>No products available </p>";
                }
            }


        ?>
        
      </div>  
       
       




</div>

<!--- End of bg-div-->
</body>
</html>