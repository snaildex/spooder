
function resizeIframe(obj) 
{
	var body = obj.contentWindow.document.body,
    html = obj.contentWindow.document.documentElement;
	var height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );
    obj.parentElement.style.height = height;
}

function ParseQuery()
{
	var keywords="";
    var keys=[];
    $(".keywordInput").each(function(input){
    	if($(this).val())
    	{
    		keywords=keywords.concat($(this).val(),"$");
    		keys.push($(this).val());
    	}
    });
    if(keywords)
    {
    
    keywords = keywords.slice(0, -1);
    $query="ParseUrl.php?url="+$("#urlInput").val()+"&keys="+keywords;
   	$("#result").attr('src',$query);
	
	}
}