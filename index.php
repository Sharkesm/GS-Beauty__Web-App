
<?php

include_once "configuration/session.php";


if(cust_logged_in())
  header("location:customer.php");


?>
<!--





       ****************************                  ************                              **************
     *******************************                 ************                              **************
    ****                        ****                 *************                            ***************
    ****                        ****                 **************                          ******    ******
    ****                        ****                 ******   ******                        ******     ******
    ****                                             ******    ******                      ******      ******
    ****                                             ******     ******                    ******       ******
     ******                                          ******      ******                  ******        ******
      *******                                        ******       ******                ******         ******
        ********                                     ******        ******              ******          ******
            *******                                  ******         ******            ******           ******
               *******                               ******          ******          ******            ******
                   ********                          ******           ******        ******             ******
                      *********                      ******            ******      ******              ******  
                         ********                    ******             ******    ******               ******
                              *******                ******              **************                ******
                              *******                ******               ************                 ******
                              *******                ******                **********                  ******
                              *******                                                                  
                              *******                ******                                            ******
                            *******                  ******                                            ******
                          *******                    ******                                            ******   
                        *******                      ******                                            ******
      *******         *******                        ******                                            ****** 
      *******       *******                          ******                                            ******
      *******     *******                            ******                                            ******
      ******************                             ******                                            ******




    &copy 2015 SM Production 

    **********************************************************************************************************
    **********************************************************************************************************

    System name: GS Beauty System
    Description: 

    GlobalStyling is an international designer hair salon. The company started out from a small 

hairdressing business in London, UK and has built up a clientele of the rich and famous. 

As well as the salon in London, they now also have a French salon in Paris and a salon in 

the USA in New York City. All the salons offer the very best in hair styling to a set of 

sophisticated customers. The salon owner, Heather, has decided that it is time to enter the 

digital age and has asked for your help. You have been commissioned by GlobalStyling to 

produce a web-based application that will enable customers to book appointments in the 

three salons. 

The GlobalStyling appointments system  allows users to create a record for themselves 

and then log in to the system to book an appointment at one of the three salons in London, 

Paris or New York. The system will store personal details of each customer and their email 

address so that they can be sent details of new hair treatments and special offers. 

As the owner, Heather needs the ability to create a list of products (hair stylings and 

treatments) and the prices of these products in local currency (pounds, euros, and dollars). 

There also needs to be the facility to modify or delete products. In addition, she also needs 

to be able to produce a list of appointments at each salon for any given week or on any

given day. 

Customers will need to be able to create an account and log into the system with their 

details. Having done so they will be presented with an interface that allows them to:

 Select a salon to visit from the three in London, Paris and New York.

 View the hair stylings and treatments available at that salon. Prices should be 

presented in local currency.

 Book an appointment for a hair styling or treatment, and receive a confirmation 

email.





















  -->
<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Style-Fashion</title>
<link rel="stylesheet" type="text/css" href="style/main-style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
<script src="javascript/login.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="javascript/cust_validation.js"></script>

</head>

<body>
<!---- Content of the document ---->
<div id="bg-div">



    <!--- Left Div --> 
    <div id="left-div">
    
    	<!--- Image inspired by https://unsplash.com/titi_wanderer -->
      <div>
          <span>Beauty Cares<br><em>Natural and Satifactory Services</em></span>
      </div>
    </div>
    <!--- End of Left Div -->

     <!--- Right Div -->
    <div id="right-div">
          
      <?php 
            // Including top navigation links on the Right Div  
            include_once "include/top-nav.php";  
      ?>

      <div id="form-div">
      	  <span class="min-head">Welcome to GS System<br/><em>Please login</em></span>
          <span class="notify"></span>
      <form id="cust_form" action="customer_check.php" method="POST" onsubmit="return lgValidate(this);">
           
           <table id="login-form">
              <tr>
                 <td><input type="text" name="email" placeholder="Email address" class="txt-round txt-box"/></td>
              </tr>
              <tr>
                 <td><input type="password" name="pass" placeholder="Password" class="txt-round txt-box"/></td>
              </tr>
              <tr>
                 <td><input type="submit" name="sub" value="Login" class="btn-sub sub-round"/></td>
              </tr>
              <tr>
               <td>
                 <p>Surpervised and Code implemented<br/>by: Sarah Awadh<br/>&copy; 2015</p>
               </td>
              </tr>
           </table>
         </form>
      
      </div>
    </div>

   
</div>
<!--- End of bg-div-->
</body>
</html>