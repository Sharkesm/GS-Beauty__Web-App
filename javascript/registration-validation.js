$(document).ready(function() {

  // Process the form 
  $('#registration-form').submit(function(event){

       // Get the form data 
          var formData = {
            'cname'    : $('input[name=cname]').val(),
            'email'    : $('input[name=email]').val(),
            'pass1'    : $('input[name=pass1]').val(),
            'pass2'    : $('input[name=pass2]').val()
          };

          $.ajax({
             type     : 'POST', // define the type of HTTP verb to transmit information 
             url      : 'register_check.php', // The url to transmit information
             data     : formData, // Our data Object 
             dataType : 'json', // Define type of data we expect back from the server 
             encode   : true
          })

          // using the DONE promise callback 
           .done(function(data){
                   
                if (data.success == true) {
                     // Add the pass class to show green notification 
                     $(".notify").removeClass("notification-error").addClass("notification-pass").html(data.message);
                     //console.log(data);


                  } else if (data.success == false){
                    // Add the error class to show red notification
                    
                    if (data.errors.name_invalid) 
                      $(".notify").removeClass("notification-pass").addClass("notification-error").html(data.errors.name_invalid);
                   else if (data.errors.email_invalid)
                      $(".notify").removeClass("notification-pass").addClass("notification-error").html(data.errors.email_invalid);
                   else if (data.errors.password_invalid)
                      $(".notify").removeClass("notification-pass").addClass("notification-error").html(data.errors.password_invalid);
                   else if (data.message)
                      $(".notify").removeClass("notification-pass").addClass("notification-error").html(data.message);
                   
                   
                   
                    /*
                              
                    console.log(data.errors);
                    console.log(data.message);
                    */
               
                    }
                    
                  
           });

       // Preventing default functioning of submitting the form 
       event.preventDefault();
    });

});