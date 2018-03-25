function AppendResult(inner)
{
	var element='<div class="w3-panel w3-light-gray w3-leftbar w3-border-blue-gray">';
	element=element.concat(inner,'</div>');
	$("#result").append(element);
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
    
    $("#result").empty();
	$("#parseLoader").show();
    $.get($query, function(data, status)
	{
		$("#parseLoader").hide();
		$("#result").append(data);
    });
	}
}