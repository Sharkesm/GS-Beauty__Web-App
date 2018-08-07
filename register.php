
<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Style-Fashion</title>
<link rel="stylesheet" type="text/css" href="style/main-style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
<script src="javascript/registration.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="javascript/registration-validation.js"></script>
</head>

<body>
<!---- Content of the document ---->
<div id="bg-div">



    <!--- Left Div --> 
    <div id="left-div2">
    </div>
    <!--- End of Left Div -->

     <!--- Right Div -->
    <div id="right-div">
      
       <?php 
            // Including top navigation links on the Right Div  
            include_once "include/top-nav.php";  
      ?>

      <div id="form-div">
      	  <span class="min-head">Welcome to GS System<br/><em>Please register with us</em></span>
          <span class="notify"></span>
      <form id="registration-form" action="register_check.php" method="post" onsubmit="return regValidate(this);">
    
           <table id="login-form">
              <tr>
                 <td><input type="text" name="cname" placeholder="Customer name" class="txt-round txt-box"/></td>
              </tr>
              <tr>
                 <td><input type="text" name="email" placeholder="Email address" class="txt-round txt-box"/></td>
              </tr>
              <tr>
                 <td><input type="password" name="pass1" placeholder="Password" class="txt-round txt-box"/></td>
              </tr>
              <tr>
                 <td><input type="password" name="pass2" placeholder="Confirm password" class="txt-round txt-box"/></td>
              </tr>
              <tr>
                 <td><input type="submit" name="sub" value="Register now" class="btn-sub sub-round"/></td>
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