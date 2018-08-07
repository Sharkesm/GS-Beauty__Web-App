
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
  <span class="bl-sp">Help with Action<br/><em>Conduct instructions below if having troubles</em>
   </span>
<div id="txtHint">
  <span>
   <ul id="help">
     <li>Navigation link
       <ul>
          <li><p>On the left side of the System a navigation bar is placed and fully supported with all the link required and icons representing a cetain page to aid you navigate through out the System. Also on top banner as well three links will enable you to perform different task. </p></li>
       </ul>
     </li>
     <li>Currency exchange rate 
       <ul>
          <li><p> As we all know the benefit of knowing daily currency exchange rates the System provides you with such functionality to use located on top banner. A litte input circle with Blue border besides enables you to make quick sorting of exchange rates.</p></li>
       </ul>
     </li>
     <li>Logging out 
       <ul>
          <li><p> Feeling a bit too much for the day! Well the system enables you to log out and your information will be secured for the next long day as well as all updated information will be updated. </p></li>
       </ul>
     </li>
     <li>Programmer
       <ul>
          <li><p>Sarah Awadh</p> <br/>
          </li>
       </ul>
     </li>
     <li>
      <!---

        SERVING YOU RIGHT AIN'T A PROBLEM 

        HALLA ! 2015 

        GS BEAUTY SYSTEM &COPY 2015 SM PROUDCITON COMING SOON
    -->
     	&copy; 2015 SM production
     </li>
   </ul>
  </span>
</div>

</div>





</div>
</div>

<!--- End of bg-div-->
</body>
</html>
