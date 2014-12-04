/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function()
{
    addEvent();
    initializePriceSort();
    initializeAlphabeticalSort();
    
    
 function addEvent()
 {
     addtocartbuttons=document.getElementsByClassName('addtocartbutton');
     topicbox=document.getElementsByClassName('topicbox');
     addtocartbuttonsnormal=document.getElementsByClassName('addtocartbuttonnormal');
     removefromcartbutton=document.getElementsByClassName('removefromcartbutton');
     pricespan=document.getElementsByClassName('pricespan');
     pertopicprice=document.getElementsByClassName('pertopicprice');
     checkoutbutton=document.getElementById('checkoutbutton');
     emailid=document.getElementById('emailid');
     searchbar=document.getElementById('searchbar');
     price=document.getElementById('price');
     alphabetically=document.getElementById('alphabetically');
     body=document.getElementById('body');
     topicssubscribedtable=document.getElementById('topicssubscribedtable');
     topicssubscribedspan=document.getElementById('topicssubscribedspan');
     pricetopayspan=document.getElementById('pricetopay');
     paybutton=document.getElementById('paybutton');
     errordiv=document.getElementById('errordiv');
   
        
   if(topicssubscribedspan!==null)
        {
      topicssubscribedspan.onclick=showtopicssubscribedtable;
  }
    if(topicssubscribedtable!==null)
        {
      
      $(topicssubscribedtable).hide();
  }
  
     if(topicbox.length!==0)
  {
     
   $.each(topicbox,function(){
       
       this.onmouseenter=function()
       {
           id="#"+this.id+"button";
           $(id).show();
       }
       
       this.onmouseleave=function()
       {
           id="#"+this.id+"button";
           $(id).hide();
           
       }
  });
  }
  
  
  
  
     if(addtocartbuttons.length!==0)
  {
    $.each(addtocartbuttons,function(){
        //console.log("#"+this.id.split(":")[1]+"button");
        $("#"+this.id.split(":")[1]+"button").hide();
        
    });
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
            emailid.oninput=validateEmail;
        }
        
         if(searchbar!==null)
        {
            searchbar.oninput=search;
        }
        
        if(price!==null)
        {
            price.onclick=sortPrice;
        }
        
        if(alphabetically!==null)
        {
            alphabetically.onclick=sortAlphabetically;
        }
        
        
        
     }
 
 

 function initializePriceSort()
 {
     //Sorted List
           pricelist=new Array(); 
           pricesortOrder=0;
      $.each($("#listoftopics").children(),function(){
          //console.log($(this).children("[id=span"+this.id+"]").children("[id=pricespan]").text());
       pricelist[$(this).children("[id=span"+this.id+"]").children("[id=pricespan]").text()+","+this.id]=this;
          
      });
 }
 
 function initializeAlphabeticalSort()
 {
     //Sorted List
           alist=new Array(); 
           aplabeticalsortOrder=0;
      $.each($("#listoftopics").children(),function(){
       //console.log(this.id);
       alist[this.id]=this;
          
          
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
     pricetopay=0;
     pricetopay=parseInt($(pricetopayspan).html());
     pricetoremove=parseInt(this.id.split(":")[2]);
     //console.log(pricetoremove);
     if(pricetopay>0)
     {
         pricetopay=pricetopay-pricetoremove;
         if(pricetopay<=0)
         {
             $(paybutton).prop("disabled",true);
             $(checkoutbutton).prop("disabled",true);
         }
         else
         {
             $(paybutton).prop("disabled",false);
         }
         
     }
     else
     {
         $(paybutton).prop("disabled",true);
         $(checkoutbutton).prop("disabled",true);
         
     }
     $(pricetopayspan).empty().html(pricetopay);
    //console.log(pricetopay);
    $('#paymentdiv').show();
    
    
    
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
    
    //$('#paymentdiv').show();
    pricetopay=0;
    $.each(pertopicprice,function()
    {
        pricetopay=pricetopay+parseInt($(this).text());
    }
            );
    $(pricetopayspan).html(pricetopay);
    if(pricetopay<=0)
    {
     $(paybutton).prop("disabled",true);
     $(checkoutbutton).prop("disabled",true);
     
    }
    else
    {
        $(paybutton).prop("disabled",false);
    }
    //console.log(pricetopay*10);
    $('#paymentdiv').show();
    return false;
}

function validateEmail()
{
    email=this.value;
    if(email.length>6)
    {
    datax="{\"emailid\":\""+email+"\"}";
    $.ajax( 
             {
        type: "post",
        cache: false,
        url: "ajaxrequest.php?v=email&emailid="+email,
        data: JSON.parse(datax),
        
                    success: function(emailexists) {
                              registerbutton=document.getElementById("registerbutton");
                              loginbutton=document.getElementById("loginbutton");
                               //console.log(emailexists.trim());
                                if(emailexists.trim()==="t")
                                {
                                    if(registerbutton!==null)
                                    {
                                     //console.log("Invalid Email");
                                     registerbutton.disabled=true;
                                    $(errordiv).html("<span id=\"emailerror\">Email Already Exists<\span>");
                                    }
                                    else
                                    {
                                         $("#emailerror").empty();
                                          loginbutton.disabled=false;
                                    }
                                }
                                else
                                {
                                    if(registerbutton!==null)
                                    {
                                    //console.log("Valid Email");
                                    $("#emailerror").empty();
                                    registerbutton.disabled=false;
                                    }
                                    else
                                        
                            {
                                loginbutton.disabled=true;
                                $(errordiv).html("<span id=\"emailerror\">Email Does not exist<\span>");
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
}

function search()
{
    $.each($("#listoftopics").children(),function(){
        $('#'+this.id).show();
          });
    
    q=this.value;
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

function sortPrice()
{
    sortedList=new Array();  
     mapKeys = Object.keys(pricelist);
if(pricesortOrder===0)
{
    pricesortOrder=1;
}
else
{
    pricesortOrder=0;
}

if(pricesortOrder===0)
{
mapKeys.sort();
}
else
{
 mapKeys.sort().reverse();
}

mapKeys.forEach(function(key) {
  //  console.log("Processing ", key);
    sortedList[key]=pricelist[key];
});
       for(x in sortedList)
       {
        $('#listoftopics').prepend(sortedList[x]).show();
       }
    
}

function sortAlphabetically()
{
    //console.log("Alpha Sort");
        sortedList=new Array();  
     mapKeys = Object.keys(alist);
if(aplabeticalsortOrder===0)
{
    aplabeticalsortOrder=1;
}
else
{
    aplabeticalsortOrder=0;
}

if(aplabeticalsortOrder===0)
{
mapKeys.sort();
}
else
{
 mapKeys.sort().reverse();
}

mapKeys.forEach(function(key) {
  //  console.log("Processing ", key);
    sortedList[key]=alist[key];
});
       for(x in sortedList)
       {
        $('#listoftopics').prepend(sortedList[x]).show();
       }
}
function showtopicssubscribedtable()
{
   $(topicssubscribedtable).show(); 
}


});

