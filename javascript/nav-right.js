
$(document).ready(function(){
	
  $(".slide-right").click(function(){
       

       if ($(this).hasClass("left")) {
       
       $(this).removeClass("left").addClass("right");

       $("p.hide-p").each(function(){
       	  $(this).fadeOut(200);
       	  $("#content-right h1").text("");
          
       });

        
       $("#content-right").animate({width: "7%"},300,'linear',function(){
          
          $(".btn-right").text("keyboard_arrow_left");


       });



 
    } else if ($(this).hasClass("right")) {
        
       $(this).removeClass("right").addClass("left");

       $("#content-right").animate({width: "20%"},300,'linear',function(){
          
          $("#content-right h1").text("Shop location");
          $(".btn-right").text("keyboard_arrow_right");

       });

       $("p.hide-p").each(function(){
       	  $(this).fadeIn(300);
       });


    }

  });	

}); 