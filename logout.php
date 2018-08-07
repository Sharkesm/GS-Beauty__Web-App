<?php

require_once "configuration/session.php";


    $_SESSION=array();

  if (isset($_COOKIE[session_name()])){
	setcookie(session_name(),'',time()-45000);
	header("location:index.php");

}

    session_destroy();

	
?>