
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

  <div id="header-center">
    <h1>Manage and manipulate Information</h1>
    <p>GS Beauty System allows you to share large </br>number of services to the world.</p>
  </div> 

 <div id="content1">
 
 <div id ="pmin-content"> 

   <div id="min-content1">
     <span class="min-image"><img src="image/hair2.png"></span>
     <span class="min-desc">
        <strong class="mintxt-center">Hair Style Service</strong> 
        <p>Just like you artfully apply makeup to your face to define your features, you can sculpt your face with strategically placed highlights and lowlights.</p> 
     </span>
     </div>

     <div id="min-content2">
     <span class="min-image"><img src="image/treat.png"></span>
     <span class="min-desc">
        <strong class="mintxt-center">Treatment Service</strong> 
        <p>Our skin therapists are professionally educated on cutting edge technology and techniques to deliver the most results driven treatments. </p> 
     </span>
     </div>

     <div id="min-info">
         <span class="min-ad">
        <table id="tb1">
        	<legend class="tb1">Top Customers</legend>
           <?php 

            $selectQuery  = "SELECT c.cust_name, c.cust_email, COUNT(ap.cust_id) AS appoint ";
             $selectQuery .= "FROM appointment ap ";
             $selectQuery .= "LEFT JOIN customer c ON c.cust_id = ap.cust_id 
                              GROUP BY ap.cust_id
                              ORDER BY appoint DESC
                              LIMIT 3;";

             $executeQuery = mysqli_query($connection, $selectQuery); 


             if($executeQuery) {
               if(mysqli_affected_rows($connection) >= 1) {

                echo '  <tr>
             <td>Name</td><td>Email</td><td>Total</td>
          </tr>
           <tr>
              <td><!---rf--></td>
           </tr>
           <tr>
              <td><!---rf--></td>
           </tr>
        ';
                  while ($data = mysqli_fetch_assoc($executeQuery)) {
                    # code...
                    $name    = $data['cust_name'];
                    $email   = $data['cust_email'];
                    $appoint = $data['appoint'];

                    echo "<tr>";
                    echo "<td>". ucfirst($name) ."</td><td>". $email ."</td><td>". $appoint ."</td>";
                    echo "</tr>";
                  }
               } else {

                   echo "<tr>";
                       echo "<td colspan='2' style='color: rgba(80,80,80,.7);'><i class='material-icons'>info<!--  assignment_ind --></i>No records found</td>";
                       echo "</tr>";
               }
             }
          ?>
        </table>
        </span>

         <span class="min-ad">
        <table id="tb2">
        	<legend  class="tb2">Top Services</legend>
     
           <?php 
              
              $selectQuery  = "SELECT p.pro_name, COUNT(ap.pro_id) AS total ";
              $selectQuery .= "FROM product_store ps ";
              $selectQuery .= "LEFT  JOIN product p ON p.pro_id = ps.pro_id 
                               RIGHT JOIN appointment ap ON ap.pro_id = ps.pro_id 
                               WHERE 
                               p.status = 1
                               GROUP BY ps.pro_id
                               ORDER BY total DESC
                               LIMIT 3;"; 

              $executeQuery = mysqli_query($connection, $selectQuery); 

               if ($executeQuery) {
                  if (mysqli_affected_rows($connection) >= 1) {

                echo '     <tr>
             <td>Service</td><td>Total sales</td>
          </tr>
           <tr>
              <td><!---rf--></td>
           </tr>
           <tr>
              <td><!---rf--></td>
           </tr>';
                    while ($data = mysqli_fetch_assoc($executeQuery)) {
                      # code...
                        $proName = $data['pro_name'];
                        $total   = $data['total'];

                        echo "<tr>";
                        echo "<td>". $proName ."</td><td>". $total ."</td>";
                        echo "</tr>";

                    } 
                  } else {
                        echo "<tr>";
                       echo "<td colspan='2' style='color: rgba(80,80,80,.7);'><i class='material-icons'>info<!--  assignment_ind --></i>No records found</td>";
                       echo "</tr>";
                      }
               } 


            ?>
        </table>
        </span>


              <span class="min-ad">
        <table id="tb3">
           <legend class="tb3">Annual</legend>
   
          <?php 
         
         $selectQuery = "SELECT type_name, SUM(pro_cost) AS total
FROM product_store ps
NATURAL JOIN product_type pt 
NATURAL JOIN product p
NATURAL JOIN appointment a
GROUP BY pt.type_id ASC;"; 

 $executeQuery = mysqli_query($connection, $selectQuery); 

               if ($executeQuery) {
                  if (mysqli_affected_rows($connection) >= 1) {

                    echo '         <tr>
             <td>Service</td><td>Total sales</td>
          </tr>
           <tr>
              <td><!---rf--></td>
           </tr>
           <tr>
              <td><!---rf--></td>
           </tr>';
                    while ($data = mysqli_fetch_assoc($executeQuery)) {
                      # code...
                        $proName = $data['type_name'];
                        $total   = $data['total'];

                        echo "<tr>";
                        echo "<td>". $proName ."</td><td>&euro; ". $total ."</td>";
                        echo "</tr>";

                    } 
                  } else {
                       echo "<tr>";
                       echo "<td colspan='2' style='color: rgba(80,80,80,.7);'><i class='material-icons'>info<!--  assignment_ind --></i>No records found</td>";
                       echo "</tr>";
                      }
               } 



          ?>
        </table>
        </span>
     </div>
 </div>
 </div>



</div>
</div>

<!--- End of bg-div-->
</body>
</html>
