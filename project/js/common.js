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
     addtocartbuttons=document.getElementsByClassName('addtocartbutton');
     $.each(addtocartbuttons,function(){this.onclick=addToCart});
     
 }
 
 function addToCart()
 {
     item=this.name.split(":");
     console.log(item[0]+" "+item[1]);
     id=item[0];
     topic=item[1];
     $.ajax( 
             {
        type: "post",
        cache: false,
        url: "processcart.php",
        data: {id:topic,id:topic},
        datatype : "json",
                    success: function(data) {
                        console.log("output"+data);
                    }
            }   
   )
  .done(function(msg) {
   
  })
  .fail(function() {
    alert( "error" );
  });
 }
});
