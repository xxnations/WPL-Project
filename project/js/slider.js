 var newstitle=['India',
			  'World',
			  'Politics',
			  'Business',
			  'Humour'];
 
/*   var intervalId="";
  var 	item_html="";
  var title="";
  var newtitleheader = "";
  var newsdescription = "";
  var newslist ="";
  var sliderdiv="";
  var newscontainer=""; */
$(document).ready(function(){
 
   sliderdiv=$("#sliderdiv");
   newscontainer=$("#newscontainer");

  if(sliderdiv.length!==0)
  {
  slideNews();
  }
	  		
		function slideNews()
		{
		  newscontainer.html("<h4 id='newtitleheader'></h4><div id='newsdescription'><ul id='newslist'/></div>");
		  newtitleheader = document.getElementById("newtitleheader");
		  newsdescription = document.getElementById("newsdescription");
		  newslist =document.getElementById("newslist");
		  item_html="";
		  title=newstitle[0];
		  
		  $('#rssdata').ready(function () {
		 
         $.ajax({
	    
        url: 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=8&q=https%3A%2F%2Fnews.google.com%2Fnews%2Fsection%3Fq%3D'+title+'%26output%3Drss',
        dataType: 'jsonp',
        success: function (data) {
		    $(data.responseData.feed.entries).each(function (index, entry) {
                item_html = item_html+'<li><a target="_blank" href="' + entry.link + '">' + entry.title + '</a></li>';
                });
				
			newtitleheader.innerHTML =""+title+"";
			newslist.innerHTML = item_html;
			newscontainer.fadeIn(500).delay(11000).fadeOut(500);
			
        },
        error: function () {
		alert("Error");
		}

    });
});
	 	          len =newstitle.length;
		          num=1;
				  intervalId=setInterval(function(){
					num++;
					item_html="";
					if(num >= len)
					{
					num=0;
					}
					title=newstitle[num];
			
		  $('#rssdata').ready(function () {
    $.ajax({
	
        url: 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=8&q=https%3A%2F%2Fnews.google.com%2Fnews%2Fsection%3Fq%3D'+title+'%26output%3Drss',
        dataType: 'jsonp',
        success: function (data) {
            $(data.responseData.feed.entries).each(function (index, entry) {
                item_html = item_html+'<li><a target="_blank" href="' + entry.link + '">' + entry.title + '</a></li>';
            	});
			newtitleheader.innerHTML =title;
			newslist.innerHTML = item_html;
			newscontainer.fadeIn(500).delay(11000).fadeOut(500);
			
        },
        error: function () {
		alert("Error");
		}

    });
});
	  			
					}, 5*1000);
		}
		
		
		function getClass(str)
		{
		var temp=str.substr(str.lastIndexOf("/")+1,str.length);
		temp.substr(0,temp.lastIndexOf(".")).toUpperCase();
		return str;
		}
				})
				;
				
				function startSlide()
		{
		intervalId=setInterval(function(){
					num++;
					item_html="";
					if(num >= len)
					{
					num=0;
					}
					title=newstitle[num];
			
		  $('#rssdata').ready(function () {
    $.ajax({
	
        url: 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=8&q=https%3A%2F%2Fnews.google.com%2Fnews%2Fsection%3Fq%3D'+title+'%26output%3Drss',
        dataType: 'jsonp',
        success: function (data) {
            $(data.responseData.feed.entries).each(function (index, entry) {
                item_html = item_html+'<li><a target="_blank" href="' + entry.link + '">' + entry.title + '</a></li>';
            	});
			newtitleheader.innerHTML =title;
			newslist.innerHTML = item_html;
			newscontainer.fadeIn(500).delay(11000).fadeOut(500);
			
        },
        error: function () {
		alert("Error");
		}

    });
});
	  			
					}, 5*1000);
		}
		
				function next()
		{
		clearInterval(intervalId);
		console.log(num);
		item_html="";
		
		if(++num >= len)
					{
					num=0;
					}
					title=newstitle[num];
					
		  $('#rssdata').ready(function () {
    $.ajax({
	url: 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=8&q=https%3A%2F%2Fnews.google.com%2Fnews%2Fsection%3Fq%3D'+title+'%26output%3Drss',
        dataType: 'jsonp',
        success: function (data) {
            $(data.responseData.feed.entries).each(function (index, entry) {
                item_html = item_html+'<li><a target="_blank" href="' + entry.link + '">' + entry.title + '</a></li>';
        		});
			
			newtitleheader.innerHTML =title;
			newslist.innerHTML = item_html;
			newscontainer.fadeIn(500).delay(11000);
			startSlide();
        },
        error: function () {
		alert("Error");
		}

    });
});
		}
		
		function prev()
		{
		clearInterval(intervalId);
		
		
		item_html="";
		
		if(num<= 0)
					{
					num=len-1;
					}
					else{
					num--;
					}
					title=newstitle[num];
					console.log(title);
		  $('#rssdata').ready(function () {
    $.ajax({
	url: 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=8&q=https%3A%2F%2Fnews.google.com%2Fnews%2Fsection%3Fq%3D'+title+'%26output%3Drss',
        dataType: 'jsonp',
        success: function (data) {
            $(data.responseData.feed.entries).each(function (index, entry) {
                item_html = item_html+'<li><a target="_blank" href="' + entry.link + '">' + entry.title + '</a></li>';
        		});
			
			newtitleheader.innerHTML =title;
			newslist.innerHTML = item_html;
			newscontainer.fadeIn(500).delay(11000);
			startSlide();
        },
        error: function () {
		alert("Error");
		}

    });
});
		}