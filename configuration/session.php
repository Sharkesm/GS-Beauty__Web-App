
<?php 

session_start(); 

function logged_in(){ 

$session = "";

if(isset( $_SESSION['PHP_ADMIN_ID'] )) {
	$session = $_SESSION['PHP_ADMIN_ID'];
}

return $session;
}

function confirm_logged_in(){
if(!logged_in()){
    header("location:index.php");
   }
}



function cust_logged_in(){ 

$session = "";

if(isset( $_SESSION['PHP_CUST_ID'] )) {
	$session = $_SESSION['PHP_CUST_ID'];
}

return $session;
}



function cust_confirm_logged_in(){
if(!cust_logged_in()){
    header("location:index.php");
   }
}


?>