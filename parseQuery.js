
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