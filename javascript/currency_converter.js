 /**
   WARNING : DO NOT USE THE ACCESS KEY INAPPROPRIATE THIS MIGHT LEAD TO SUSPENSION OF MY ACCOUNT FROM THE COMPANY 
 **/
          
 // Set endpoint and access key 
 endpoint = 'live';
 access_key = 'c0d83rjk3n4rn34rkn34rn2KFLKRLEfdda4c9';
 currencies = 'GBP,EUR';

 // get the most recent exchange rates via the "live" endpoint: 
 var dollar; 
 var euro; 


 function currency() {
 
     var cost = document.getElementById("cost").value;
                document.getElementById("cont-result").style.display = 'block';

        if (cost == "") { // Checking if the input is empty and not diplay result 

           document.getElementById("cont-result").style.display = 'none';
        } 

        else { // Retrieve currency api service 
            
            if (isNaN(cost)) {
                      
                     var  xDollar = document.getElementById("dollar");
                     var  xEuro = document.getElementById("euro");
                          xDollar.innerHTML = "<em style='color:red;'>Number required</em>";
                          xEuro.innerHTML = "<em style='color:red;'>Number required</em>";
                        
            } else {
 $.ajax({
    

       url      : 'https://currency-api.appspot.com/api/GBP/USD.jsonp',
       dataType : 'jsonp',
       data     : {amount: '1.00'},
       success  : function(response) {
           
           if (response.success) {
                dollar = parseFloat(response.rate).toFixed(2);
                var fDOllar = parseFloat(dollar * cost).toFixed(2); 
                 document.getElementById("dollar").innerHTML = '$ ' + fDOllar;
            }
       }   
 }); 



 $.ajax({
    

       url      : 'https://currency-api.appspot.com/api/GBP/EUR.jsonp',
       dataType : 'jsonp',
       data     : {amount: '1.00'},
       success  : function(response) {
           
           if (response.success)  {
              euro = parseFloat(response.rate).toFixed(2);
              var fEuro = parseFloat(euro * cost).toFixed(2);
              document.getElementById("euro").innerHTML = '&euro; ' + fEuro;     
                }
 
             }   
    
         }); 

        }

  }

}



 