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
     loginform=document.getElementById("loginform");
     loginform.onsubmit=validateLoginForm;
 }
 });
 
function validateLoginForm(){
    errormsg="";
    error=false;
    
    pswd=document.forms["loginform"]["password"].value;
    splitpswd=pswd.split(/[\W]/);
//    console.log(pswd);
//   
//    for(i=0;i<splitpswd.length;i++){
//         console.log(splitpswd[i]);
//    }
    if(splitpswd.length!==1){
        errormsg=errormsg+" Email Id/Password is not valid<br>";
        error=true;
    }    
    
//    console.log(pswd);
//   
//    for(i=0;i<splitpswd.length;i++){
//         console.log(splitpswd[i]);
//    }   
    
    if(error===true){
        $("#errordiv").html(errormsg);
        return false;
    }
   
    return true;
}