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
      <h2><i class="material-icons">&#xE896;</i> Appointment Details</h2>
      <em style="font-family: 'Work Sans', sans-serif; font-style: normal">Grand total : <?php 
           
           $selectQuery = '
SELECT SUM(pro_cost) AS total
FROM appointment a
NATURAL JOIN product_store ps
NATURAL JOIN product p
RIGHT JOIN customer c ON a.cust_id = c.cust_id 
WHERE 
c.cust_id = '.$_SESSION['PHP_CUST_ID'].'
GROUP BY c.cust_id
'; 


            $executeQuery = mysqli_query($connection, $selectQuery); 

            if ($executeQuery) {
               if (mysqli_num_rows($executeQuery) > 0) {
                 while ($data = mysqli_fetch_assoc($executeQuery)) {
                     
                     if ($data['total'] != null){
                       echo '&euro; '. number_format($data['total']);
                     } else {
                  echo "&euro; 0";
                   }
                 } 
                } 
            }


      ?></em>
  <table class="list-tbl">
        <thead>
          <tr>
            <th>Service</th><th>Service Type</th><th>Location</th><th>Cost</th><th>Appointment Date</th><th>Appointment Time</th>
          </tr>
        </thead>
        <tbody>
         <?PHP 
            
            $selectQuery  = "SELECT c.cust_name, p.pro_name, pt.type_name, s.store_location, p.pro_cost, ap.appoint_date, ap.appoint_time ";
            $selectQuery .= "FROM product_type pt 
                             RIGHT JOIN product p ON p.type_id = pt.type_id 
                             RIGHT JOIN product_store ps ON ps.pro_id = p.pro_id 
                             LEFT JOIN store s ON s.store_id = ps.store_id
                             RIGHT JOIN appointment ap ON ap.pro_id = ps.pro_id 
                             LEFT JOIN customer c ON c.cust_id = ap.cust_id 
                             WHERE 
                               ap.cust_id = ".$_SESSION['PHP_CUST_ID'];
            $selectQuery .= " ORDER BY ap.appoint_date desc, ap.appoint_time desc;";

            $executeQuery = mysqli_query($connection, $selectQuery); 

            if ($executeQuery) {
               if (mysqli_num_rows($executeQuery) >= 1) {
                 while ($data = mysqli_fetch_assoc($executeQuery)) {
                   # code...
                   echo "<tr>";
                   echo "<td>".$data["pro_name"]."</td><td>".$data["type_name"]."</td><td>".$data["store_location"]."</td><td>&pound; ". $data['pro_cost'] ."</td><td>".$data["appoint_date"]."</td><td>".$data["appoint_time"]."</td>";
                   echo "</tr>";
                 }
               } else {
                 echo "<tr>";
                 echo "<td colspan= '7' style='color:red; text-align: center; background-color: rgba(200,200,200,.2)'>No records found</td>";
                 echo "</tr>";
               }
            }

        ?>

        </tbody>
      </table>     

  </div>
</div>



</div>

<!--- End of bg-div-->
</body>
</html>