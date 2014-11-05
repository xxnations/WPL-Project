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
     checkoutbutton=document.getElementById('checkoutbutton');
     emailid=document.getElementById('emailid');
     searchbar=document.getElementById('searchbar');
     
     if(addtocartbuttons.length!==0)
  {
  $.each(addtocartbuttons,function(){this.onclick=addToCart});
  }
  
     if(removefromcartbutton.length!==0)
  {
   $.each(removefromcartbutton,function(){this.onclick=removeFromCart});
  }
        if(checkoutbutton!==null)
        {
            checkoutbutton.onclick=checkout;
        }
         if(emailid!==null)
        {
            emailid.onchange=validateEmail;
        }
        
         if(searchbar!==null)
        {
            searchbar.oninput=search;
        }
        
        //Getting the listoftags
        $.ajax( 
             {
        type: "post",
        cache: false,
        url: "ajaxrequest.php?v=listoftopics",
                            success: function(data) {
                                listoftopics=data.split(",");
                              
                          }
                      }   
   )
   .fail(function() {
    
   });
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
  
  return false;
 }
 
function checkout()
{
    console.log("Clicked Checkout");
    $('#paymentdiv').show();
    return false;
}

function validateEmail()
{
    email=this.value;
    datax="{\"emailid\":\""+email+"\"}";
    $.ajax( 
             {
        type: "post",
        cache: false,
        url: "ajaxrequest.php?v=email",
        data: JSON.parse(datax),
        
                    success: function(emailexists) {
                              registerbutton=document.getElementById("registerbutton");
                              loginbutton=document.getElementById("loginbutton");
                               console.log(emailexists.trim());
                                if(emailexists.trim()==="t")
                                {
                                    if(registerbutton!==null)
                                    {
                                     console.log("Invalid Email");
                                     registerbutton.disabled=true;
                                    }
                                    else
                                    {
                                        
                                          loginbutton.disabled=false;
                                    }
                                }
                                else
                                {
                                    if(registerbutton!==null)
                                    {
                                    console.log("Valid Email");
                                    registerbutton.disabled=false;
                                    }
                                    else
                                        
                            {
                                loginbutton.disabled=true;
                            }
                                }
                        //$("#shoppingcartdiv").hide().html("<a href=\"viewcart.php\">Cart Items = "+((JSON.parse(data)["size"])-1)).fadeIn("fast")+"</a>";
                        //$(addtocartbutton).fadeOut("fast").html("Removed from Cart").fadeIn("fast").prop("disabled",true);
                        
                    }
            }   
   )
   .fail(function() {
    alert( "error" );
   });
}

function search()
{
    console.log(this.value);
    $.each($("#listoftopics").children(),function(){
        $('#'+this.id).show();
          });
    
    if(this.value.length>1)
    {
        q=this.value;
    }
    else
    {
     q=this.value;
    }
        //console.log($("[id^=x"+this.value+"]"));
      $.each($("#listoftopics").children(),function(){
          //console.log(q+"--"+this.id);
          if((this.id).indexOf(q)>-1)
          {
              //$("[id^="+q+"]").show();
               $("[id="+this.id+"]").show();
          }
          else
          {
               $("[id="+this.id+"]").hide();
              //$(this).hide();
          }
      });
      
     //$("#listoftopics").prepend($("[id^=x"+this.value+"]"));
//      $( "#searchbar" ).autocomplete({
//      source: listoftopics
//    });
    
    
}
});

