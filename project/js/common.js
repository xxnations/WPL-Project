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
     //console.log(item[0]+" "+item[1]);
     pid=item[0];
     topic=item[1];
     datax="{\""+pid+"\":\""+topic+"\"}";
     console.log(datax);
     $.ajax( 
             {
        type: "post",
        cache: false,
        url: "processcart.php",
        data: JSON.parse(datax),
        datatype : "jsonp",
                    success: function(data) {
                              
                                console.log("Cart Items = "+JSON.parse(data)["size"]);
                        $("#shoppingcartdiv").hide().html("Cart Items = "+((JSON.parse(data)["size"])-1)).fadeIn("fast");
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
