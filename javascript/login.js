/**
* 
* LOGIN FORM VALIDATION 
* Created: 11/10/2015
* Last Modified: 11/10/2015
**/

function lgValidate(form) {

    var returnValue = true;
    var errMsg = "";
    
    
    errMsg += validateEmail(form.email.value);
    errMsg += validatePassword(form.pass.value);
    

    function validatePassword(field1) {
        

        if (field1.length < 6 && field1.length != "") {
        
          return "Password too short!.\n";

         } else if (field1.trim().length == "") {

          return "Password can not be empty.\n";
         }

        return "";

    }



    function validateEmail (field1) {
         
         if (field1.trim().length == "") {
             return "No Email was entered.\n";
         }
           else if (!((field1.indexOf(".") > 0) && (field1.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field1)) {
               return "The Email address is invalid.\n";
           }
        return "";
    }


    
 if (errMsg.trim() != ""){
    returnValue = false;
      alert(errMsg);
 } 

  return returnValue;




}