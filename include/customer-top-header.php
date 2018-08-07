 <?php

require_once "configuration/db_connection.php";
require_once "configuration/session.php";
require_once "function/function.php";

?>

 <!--- Admin panel header -->
   <div id="admin-head">
   	<span class="bold-logo">gs<em>hair-Styling & fashion</em></span>

   	   <span class="search">
        <a href="#" class="tooltip-search">
           <input type='text' name='q' class="search-box" placeholder="Convert &pound; ..." id="cost" onkeyup="currency();" />
             <span id="cont-result">
               <table class="result">
                 <thead>
                   <tr>
                     <th>Currency</th><th>Amount</th>
                   </tr>
                 </thead>
                 <tbody>
                     <tr>
                        <td>Dollar</td><td id="dollar">$ 0.00</td>
                     </tr>
                     <tr>
                        <td>Euro</td><td id="euro">&euro; 0.00</td>
                    </tr>
                 </tbody>
               </table>
             </span>
        </a>
    </span>
   	
 

   	<span class="off-icon"><em>User Live: <?php 

          $customerTotal = "SELECT count(*) AS total FROM customer WHERE priority = 0 GROUP BY priority;";
          $executeTotal  = mysqli_query($connection,$customerTotal);
            if (mysqli_affected_rows($connection) == 1) {
                  
                  while ($data = mysqli_fetch_assoc($executeTotal)) {
                     echo number_format($data['total']);
                  }
            }

    ?></em><a href="logout.php" class="tooltip-logout"><i class="material-icons"><!-- Old browser -->highlight_off</i><span>Log out</span></a>
	   </span>
   </div>
   <!-- End of Admin panel header -->
