/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function()
{
    var listoftopics=new Array();
    addEvent();
    
 function addEvent()
 {
     addtocartbuttons=document.getElementsByClassName('addtocartbutton');
     addtocartbuttonsnormal=document.getElementsByClassName('addtocartbuttonnormal');
     removefromcartbutton=document.getElementsByClassName('removefromcartbutton');
     
        $.each(addtocartbuttons,function(){this.onclick=addToCart});
        $.each(removefromcartbutton,function(){this.onclick=removeFromCart});
     
 }
 
 function addToCart()
 {
     item=this.name.split(":");
     pid=item[0];
     topic=item[1];
     datax="{\""+pid+"\":\""+topic+"\"}";
     var addtocartbutton=this;
     $.ajax( 
             {
        type: "post",
        cache: false,
        url: "processcart.php?o=a",
        data: JSON.parse(datax),
        
                    success: function(data) {
                              
                                //console.log("Cart Items = "+data);
                        $("#shoppingcartdiv").hide().html("<a href=\"viewcart.php\">Cart Items = "+((JSON.parse(data)["size"])-1)).fadeIn("fast")+"</a>";
                        $(addtocartbutton).fadeOut("fast").html("Added to Cart").fadeIn("fast").prop("disabled",true);
                    }
            }   
   )
   .fail(function() {
    alert( "error" );
  });
 }
 
  function removeFromCart()
 {
     item=this.name.split(":");
     pid=item[0];
     topic=item[1];
     datax="{\""+pid+"\":\""+topic+"\"}";
     var addtocartbutton=this;
     $.ajax( 
             {
        type: "post",
        cache: false,
        url: "processcart.php?o=r",
        data: JSON.parse(datax),
        
                    success: function(data) {
                              
                                //console.log("Cart Items = "+data);
                        $("#shoppingcartdiv").hide().html("<a href=\"viewcart.php\">Cart Items = "+((JSON.parse(data)["size"])-1)).fadeIn("fast")+"</a>";
                        $(addtocartbutton).fadeOut("fast").html("Removed from Cart").fadeIn("fast").prop("disabled",true);
                    }
            }   
   )
   .fail(function() {
    alert( "error" );
  });
 }
 
 $('#listoftopics :checkbox').click(function() {
    var $this = $(this);
    // $this will contain a reference to the checkbox   
    item=this.name.split(":");
    if ($this.is(':checked')) {
        console.log(item[0]);
        listoftopics[item[0]]=item[1];
        
    } else {
        delete listoftopics[item[0]];
    }
    for(i in listoftopics   )
    {
        console.log(i+" - "+listoftopics[i]);
    }
});

});

