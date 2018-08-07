$(document).ready(function() {

  // Process the form 
  $('#cust_form').submit(function(event){
             
          // Get the form data 
          var formData = {
            'email'    : $('input[name=email]').val(),
            'pass'     : $('input[name=pass]').val()
          };

          //alert(formData['admin_email']);
          var mainHost = document.location.hostname;
          
          $.ajax({
             type     : 'POST', // define the type of HTTP verb to transmit information 
             url      : 'customer_check.php', // The url to transmit information
             data     : formData, // Our data Object 
             dataType : 'json', // Define type of data we expect back from the server 
             encode   : true
          })
           // using the DONE promise callback 
           .done(function(data){
                   
                  if (data.success == true) {
                     // Add the pass class to show green notification 
                    
                    // Clearing off active error messages 
                    $(".notify").removeClass("notification-error").text("");
                    
                    //$(".notify").addClass("notification-pass").text(data.message);
                    
                    // Redirected url 
                    var url = data.session_pass.redirect.url;  
                    
                    // Redirect to url 
                    window.location.assign(url); 

                    //console.log(data.session_pass.redirect.url);

                  } else if (data.success == false){

                    // Add the error class to show red notification
                    if (data.message)
                       $(".notify").removeClass("notification-pass").addClass("notification-error").html(data.message);
                    else if (data.errors.email_invalid)
                       $(".notify").removeClass("notification-pass").addClass("notification-error").html(data.errors.email_invalid);
                    else if (data.errors.password_invalid)
                       $(".notify").removeClass("notification-pass").addClass("notification-error").html(data.errors.password_invalid);
                    
                    //console.log(data.errors);
                  }
           });

       // Preventing default functioning of submitting the form 
       event.preventDefault();

  });
});