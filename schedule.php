
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

    <?php 
           
            $selectQuery = "SELECT store_id,store_location
                            FROM   store
                            ORDER BY store_location ASC;
                           ";

           $executeQuery = mysqli_query($connection, $selectQuery);

           if ($executeQuery) {
            if (mysqli_affected_rows($connection) >= 1) {
               
                while($data = mysqli_fetch_assoc($executeQuery)) {

                      $location = strtolower($data['store_location']); 
                      $store = $data['store_id'];
      ?>
  
  <span class="dt-tr">
   
   <?php 

             echo '<a href="schedule_list.php?s='.$store.'"><img src="image/';

                       if ($location == 'new york city') {
                         echo "newyork.png"; 
                       } else if ($location == "paris city") {
                         echo "paris.png";
                       } else if ($location == 'london city') {
                         echo "london.png";
                       }
             echo '"/></a>
                   <span class="info-tr">'. ucfirst($location).'</span>
                   </span>';

?>
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

<!--- End of bg-div-->
</body>
</html>
