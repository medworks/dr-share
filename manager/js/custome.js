$(document).ready(function(){

//*****************active menu

    var href=window.location.href.substr(window.location.href.lastIndexOf("/")+1);
    $("ul.mainNav li a").each(function(){
		if($(this).attr("href") == href || $(this).attr("href") == '' ){
		  $(this).addClass("active");
			  $(this).parents("ul.mainNav li").addClass("active");
		}
     });

//*****************textarea animate

    $(document).ready(function(){
	    $('textarea.animatedTextArea').autosize();    
	});

});