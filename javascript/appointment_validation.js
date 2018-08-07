$(document).ready(function() {

	// Process the form 
	$('#cust_appointment').submit(function(event){
             
          // Get the form data 
          var formData = {
          	'date'    : $('input[name=date]').val(),
          	'time'    : $('input[name=time]').val(),
            'product' : $('input[name=product]').val(),
            'type'    : $('input[name=type]').val(),
            'store'   : $('input[name=store]').val()
          };

          //alert(formData['admin_email']);
          var mainHost = document.location.hostname;
          
          $.ajax({
             type     : 'POST', // define the type of HTTP verb to transmit information 
             url      : 'appointment_check.php', // The url to transmit information
             data     : formData, // Our data Object 
             dataType : 'json', // Define type of data we expect back from the server 
             encode   : true,
             beforeSend : function(html) 
             {   

                 $(".notify-c2").removeClass("notification-error notification-pass").addClass("notificationWait").text("Please wait while processing...");
                
             }
          })
           // using the DONE promise callback 
           .done(function(data){
                   
                  if (data.status == true) {
                      
                      if (data.message) {
                         
                         $(".notify-c2").removeClass("notification-error notificationWait").addClass("notification-pass").text(data.message);
                         $("[input[name=date]").val("");
                         $("[input[name=time]").val("");
                        }       
                   

                    //console.log(data);   
                  } else if (data.status == false){

                    if (data.message) 
                       $(".notify-c2").removeClass("notification-pass notificationWait").addClass("notification-error").text(data.message);

                    else if (data.errors.invalid_date)
                       $(".notify-c2").removeClass("notification-pass notificationWait").addClass("notification-error").text(data.errors.invalid_date);

                    else if (data.errors.invalid_time)
                       $(".notify-c2").removeClass("notification-pass notificationWait").addClass("notification-error").text(data.errors.invalid_time);

                    else if (data.errors.service_unavaible)
                       $(".notify-c2").removeClass("notification-pass notificationWait").addClass("notification-error").text(data.errors.service_unavaible);
                      
                      
                      

                   // console.log(data);
                  }
           });

       // Preventing default functioning of submitting the form 
       event.preventDefault();

	});
});