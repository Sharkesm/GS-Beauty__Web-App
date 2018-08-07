
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




<?php 

          $selectQuery  = "SELECT cust_name FROM customer WHERE cust_id = ". $_SESSION['PHP_CUST_ID']; 
          $executeQuery = mysqli_query($connection, $selectQuery); 

            if ($executeQuery) {
              if (mysqli_affected_rows($connection) == 1) {
                while ($data = mysqli_fetch_assoc($executeQuery)) {
                   # code...
                   $fullName = $data['cust_name']; 
                 } 
              }
            }
?>


<div id="content-container">
  <div id="search-bg"></div>
  <div id="content">
     <h1>Welcome <?php echo $fullName; ?></h1>
     <p>GS Style system is the leading online hairdressing professional products store in London. The best place to get the best deals on hair & beauty products. We ship worldwide. 

Our aim is to achieve convenience of online shopping for bargain hunters, and time-occupied shoppers alike. 

Our professional hair care products range from Kérastase, L'Oreal, Nioxin, Redken, Schwarzkopf, Shiseido, Arimino, WAHL, Andis and many more. We offer 100% genuine products.</p>
  <p>The general shelf life for any unopend hair care products are at its best condition before 36 months of production date. But some products can be lasted for more than that; if the container are properly sealed and unopened. However the shelf life of the product will drop to 50% once the product has been opened.

Store your product in a cool and dry place and close or seal the bottle properly after use to avoid any opportunity for contamination.</p>
  </div>
</div>



</div>

<!--- End of bg-div-->
</body>
</html>