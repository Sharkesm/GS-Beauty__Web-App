<?php 

require_once("configuration/constants.php");

// Establishing mysql server connection 
$connection = @mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD); 

// Check connection conditon 
if (!$connection) {  // If connection failed throw error 
  
  die("Mysql sevrver connection failed: ". mysqli_connect_error());

} else { // Select Database 

       
  $db_conn = @mysqli_select_db($connection,"globalstyle_db") ;
  if(!$db_conn) { // Check DB connected 

  	$db_create = @mysqli_query($connection,"CREATE DATABASE globalstyle_db"); 

  	   if ($db_create) {
              
              // Selecting Database since it exist 
           $db_connect = @mysqli_select_db($connection,"globalstyle_db"); 
             
             if ($db_connect) {
              
         //    echo "Good to deploy tables ";
             	 // Deploy database tables
$customer = @mysqli_query($connection,"

CREATE TABLE `customer` (
 cust_id int(6) AUTO_INCREMENT PRIMARY KEY,
  `cust_name` varchar(50) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `cust_password` varchar(150) NOT NULL,
  `priority` int(1) NOT NULL DEFAULT '0'
); "); 

 if ($customer) {

$customer_data = mysqli_query($connection, "
INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_email`, `cust_password`, `priority`) VALUES 
(1, 'admin', 'admin@admin.com', '3ee7d6abc8001e7d792c414644e938fa08faa2c50ece1a01939506e6dbdf4d7e91f24a2cd33f74bb82ec34ac3353c69bf94793d9df6f8a980db5853d6bff132e', 1),
(18, 'test system', 'test@test.com', 'dc8334e9842f64bc51c3ecbcbed360830bcb69a8', 0);
");


  if ($customer_data) {

     $product_type = mysqli_query($connection, "
     CREATE TABLE IF NOT EXISTS `product_type` (
     `type_id` int(6) AUTO_INCREMENT PRIMARY KEY,
     `type_name` varchar(50) NOT NULL
     );
     ");


        if($product_type) {  

 
            $product_type_data = mysqli_query($connection, "

             INSERT INTO `product_type` (`type_id`, `type_name`) VALUES (1, 'Hair style'), (2, 'Treatment');");


            if ($product_type_data) {


                 $store = mysqli_query($connection, "

                          CREATE TABLE IF NOT EXISTS `store` (
                          `store_id` int(6) AUTO_INCREMENT PRIMARY KEY,
                          `store_location` varchar(50) NOT NULL,
                          `open_hour` time NOT NULL
                           ); 
                          "); 
                       

                       if ($store) {

                           $store_data = mysqli_query($connection, "

                           INSERT INTO `store` (`store_id`, `store_location`, `open_hour`) VALUES
                           (1, 'London City', '09:00:00'),(2, 'Paris City', '09:30:00'),(3, 'New york city', '09:40:00');
                           "); 
                               

                               if ($store_data) {

                                   $product = mysqli_query($connection, "

                                    CREATE TABLE IF NOT EXISTS `product` (
                                    `pro_id` int(6) AUTO_INCREMENT,
                                    `type_id` int(6) NOT NULL DEFAULT '0',
                                    `pro_name` varchar(50) NOT NULL,
                                    `pro_cost` int(6) NOT NULL,
                                    `pro_img` varchar(100) NOT NULL,
                                    `status` int(1) NOT NULL DEFAULT '1',
                                     CONSTRAINT pk_PRODUCT PRIMARY KEY (pro_id,type_id),
                                     CONSTRAINT fk_typeID FOREIGN KEY (type_id) REFERENCES PRODUCT_TYPE(type_id)    
                                     );
                                     "); 


                                       if ($product) {

                                           $product_store = mysqli_query($connection, "
                                            CREATE TABLE IF NOT EXISTS `product_store` (
                                            `pro_id` int(6) NOT NULL DEFAULT '0',
                                            `type_id` int(6) NOT NULL DEFAULT '0',
                                            `store_id` int(6) NOT NULL DEFAULT '0',
                                             CONSTRAINT pk_PRODUCT_STORE PRIMARY KEY (pro_id,type_id,store_id),
                                             CONSTRAINT fk_STORE FOREIGN KEY (store_id) REFERENCES STORE(store_id),
                                             CONSTRAINT fk_PRODUCT FOREIGN KEY (pro_id,type_id) REFERENCES PRODUCT(pro_id,type_id) 
                                             );
                                             "); 

                                              
                                              if ($product_store) {
                                       
                                                  $appointment = mysqli_query($connection, "
                                                  CREATE TABLE IF NOT EXISTS `appointment` (
                                                  `cust_id` int(6) NOT NULL DEFAULT '0',
                                                  `pro_id` int(6) NOT NULL DEFAULT '0',
                                                  `type_id` int(6) NOT NULL DEFAULT '0',
                                                  `store_id` int(6) NOT NULL DEFAULT '0',
                                                  `appoint_date` date NOT NULL DEFAULT '0000-00-00',
                                                  `appoint_time` time NOT NULL DEFAULT '00:00:00',
                                                   CONSTRAINT pk_APPOINTMENT PRIMARY KEY (cust_id,pro_id,type_id,store_id,appoint_date,appoint_time),
                                                   CONSTRAINT fk_CUSTOMER FOREIGN KEY (cust_id) REFERENCES CUSTOMER(cust_id),
                                                   CONSTRAINT fk_PRODUCT_STORE FOREIGN KEY (pro_id,type_id,store_id) REFERENCES PRODUCT_STORE(pro_id,type_id,store_id)
                                                   );
                                                   ");
                                                        
                                                        if ($appointment) {

         	                                                header("location:index.php"); 

                                                        } else {

            die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Failed to deploy table: ".mysqli_error($connection));

         }
        
 
                                               }else {

            die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Failed to deploy table: ".mysqli_error($connection));

         }
        
                                             }else {

            die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Failed to deploy table: ".mysqli_error($connection));

         }
        
                                           }else {

            die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Failed to deploy table: ".mysqli_error($connection));

         }
        
                                          }else {

            die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Failed to deploy table: ".mysqli_error($connection));

         }
        
                                       }else {

            die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Failed to deploy table: ".mysqli_error($connection));

         }
        
                                     } else {

            die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Failed to deploy table: ".mysqli_error($connection));

         }
        
                                  }else {

            die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Failed to deploy table: ".mysqli_error($connection));

         }
        
                                }else {

            die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Failed to deploy table: ".mysqli_error($connection));

         }
           


      
          
           } else 
             {
                 die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Database not available : ".mysqli_error($connection));

             }
           
  	   } else {
          
          die ("<strong>Error no: ".mysqli_errno($connection)."</strong><br/>Failed to Create Database: ".mysqli_error($connection));

        }
  
  } else {

        header("location:index.php"); 
         	                                                
     }

}



?>