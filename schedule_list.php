
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
  <span class="bl-sp">Store Available<br/><em>Serving customers right requires better processing</em>
<!-- <form action="hair_search.php" method="get">
  <input type="text" name="q" placeholder="> Search service here...." onkeyup="" class="st-s">
</form> -->
  </span>

  <table id="recordstore">
  <tr>
  <th>Customer Name</th><th>Email</th><th>Service</th><th>Service Type</th><th>Appoint Date</th><th>Appoint Time</th>
  </tr>
<?php 

       if (isset($_GET['s'])) 
       {
              
    $store = htmlentities($_GET['s']);
    $store = htmlspecialchars($store); 

$selectQuery = "SELECT cust_name,cust_email,pro_name,type_name,appoint_date,appoint_time
FROM product_store ps 
NATURAL JOIN store s
NATURAL JOIN product p
NATURAL JOIN product_type pt
NATURAL JOIN customer c
NATURAL JOIN appointment a 
WHERE 
a.store_id = $store 
ORDER BY appoint_date desc;"; 


  $executeQuery = mysqli_query($connection,$selectQuery); 

           if ($executeQuery){

          if (mysqli_affected_rows($connection) >= 1) {
               
                while($data = mysqli_fetch_assoc($executeQuery)) {
                   echo "<tr>"; 
                   echo "<td>".$data['cust_name'].'</td><td>'.$data['cust_email'].'</td><td>'.$data['pro_name'].'</td><td>'.$data['type_name'].'</td><td>'.$data['appoint_date'].'</td><td>'.$data['appoint_time'].'</td>';
                   echo "</tr>";
                }
           } else {

              echo "
           <tr><td colspan=6 style='text-align: center;'><span class='notify-c notification-error'>Sorry no records updated yet!</span></td></tr>";

           }
       }
    }

?>
</table>

</div>





</div>
</div>

<!--- End of bg-div-->
</body>
</html>
