/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function()
{
    
    addEvent();
    
 function addEvent()
 {
     registerform=document.getElementById("registrationform");
     registerform.onsubmit=validateRegisterForm;
 }
 });
 
function validateRegisterForm(){
    errormsg="";
    error=false;
    
//    pswd=document.forms["registrationform"]["password"].value;
//    splitpswd=pswd.split(/[\W]/);
    
////    if(true){
////       errormsg=errormsg+"Invalid password<br>";
////        error=true; 
////    }
    
    
    fn=document.forms["registrationform"]["firstname"].value;
    splitfn=fn.split(/[0-9]+/);
    if(splitfn.length!==1){
        errormsg=errormsg+"Invalid firstname<br>";
        error=true; 
    }
    else{
           splitfn1=splitfn[0].search(/[\W]/);
    if(splitfn1!==-1){
        errormsg=errormsg+"Invalid firstname<br>";
        error=true; 
    }
    }
    
    ln=document.forms["registrationform"]["lastname"].value;
    splitln=ln.split(/[0-9]+/);
    if(splitln.length!==1){
       errormsg=errormsg+"Invalid lastname<br>";
        error=true; 
    }
    else{
           splitln1=splitln[0].search(/[\W]/);
    if(splitln1!==-1){
       errormsg=errormsg+"Invalid lastname<br>";
        error=true; 
    }    
    }
    
    pswd=document.forms["registrationform"]["password"].value;
    splitpswd=pswd.split(/[\W]/);
//    console.log(pswd);
//   
//    for(i=0;i<splitpswd.length;i++){
//         console.log(splitpswd[i]);
//    }
    if(splitpswd.length!==1){
        errormsg=errormsg+"Invalid password (Enter only alphanumeric characters)<br>";
        error=true;
    }    
    
    repswd=document.forms["registrationform"]["repassword"].value;
//    console.log(pswd);
//   
//    for(i=0;i<splitpswd.length;i++){
//         console.log(splitpswd[i]);
//    }
    if(repswd!==pswd){
        errormsg=errormsg+"Passwords do not match<br>";
        error=true;
    }   
    
    if(error===true){
        $("#errordiv").html(errormsg);
        return false;
    }
   
    return true;
}