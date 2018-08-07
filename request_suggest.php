<?php 

require_once "configuration/db_connection.php";
include_once "configuration/session.php";


confirm_logged_in();

     
     if (isset($_POST['q'])) 
     {

         
         $data = trim($_POST['qh']);
                  $selectQuery = "SELECT p.pro_id, p.pro_img, p.pro_cost, p.pro_name, s.store_location 
                           FROM   product_type pt 
                           LEFT  JOIN product p ON p.type_id = pt.type_id 
                           RIGHT JOIN product_store ps ON ps.pro_id = p. pro_id 
                           RIGHT JOIN store s ON s.store_id = ps.store_id 
                           WHERE p.type_id = 1 
                           AND   p.status = 1
                           AND   p.pro_name LIKE '%$data' 
                           ORDER BY p.pro_id DESC;
                           ";

           $executeQuery = mysqli_query($connection, $selectQuery);

           if ($executeQuery) {
            if (mysqli_affected_rows($connection) >= 1) {
             
                 $response = new array(); 

                while($data = mysqli_fetch_assoc($executeQuery)) {

                    $proID = $data['pro_id'];
                    $img   = $data['pro_img'];
                    $cost  = $data['pro_cost'];
                    $name  = $data['pro_name'];
                    $location = $data['store_location']; 
                    

                    $response[] = '<span id="hide" class="dt-tr">
                                 <a href=""><img src="data/product_pic/'.$img.'"></a>
                                 <span class="info-tr">'.$name.'"    &euro;"'.$cost'</span>
                                 </span>'; 

                              

                    }

                       echo $response; 
                 } else 
   {
     echo "<p style='color:red'>No uploads yet!</p>";
   }
             }	  
     
     } else {

           
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
            
            $response = new array(); 

                while($data = mysqli_fetch_assoc($executeQuery)) {

                    $proID = $data['pro_id'];
                    $img   = $data['pro_img'];
                    $cost  = $data['pro_cost'];
                    $name  = $data['pro_name'];
                    $location = $data['store_location']; 
    

  $response[] = '<span id="hide" class="dt-tr">
    <a href=""><img src="data/product_pic/'.$img.'"></a>
    <span class="info-tr">'. $name ."    &euro;".$cost.'</span>
  </span>';  


    

       }

          echo $response; 
     } else {
     echo "<p style='color:red'>No uploads yet!</p>";
   }
  
  }
}

   


?>