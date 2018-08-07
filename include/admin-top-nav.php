<div id="top-banner1">
  <span class="bold-logo">GS<em>Beauty System</em></span>


 <span class="search">
        <a href="#" class="tooltip-search">
           <input type='text' name='q' class="search-box" placeholder="&pound;&nbsp;&nbsp;&nbsp;Currency" id="cost" onkeyup="currency();" />
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
                    <tr>
                      <!-- 
                        -- Using sharkes monken registered APIs to request for service 
                        -- Please do not violate the rules of Using external services from my Account  
                      --> 
                       <td colspan=2><em>Authorised and purchased online service requesting APIs from external Application.</em></td>
                    </tr>
                 </tbody>
               </table>
             </span>
        </a>
    </span> 


      <span class="off-icon">
          <em><a href="admin_edit.php">Edit profile</a></em><em>User Live: 
        <?php 

          $customerTotal = "SELECT count(*) AS total FROM customer WHERE priority = 0 GROUP BY priority;";
          $executeTotal  = mysqli_query($connection,$customerTotal);
            if (mysqli_affected_rows($connection) == 1) {
                  
                  while ($data = mysqli_fetch_assoc($executeTotal)) {
                     echo number_format($data['total']);
                  }
            }

    ?>
  </em><a href="logout.php" title="Log out" class="tooltip-logout"><i class="material-icons">&#xE8C6;</i></a>
     </span>



</div>
