
var keywordField='<input class="keywordInput w3-input w3-border w3-round-large w3-section w3-light-gray " type="text">';

function AddKeywordField()
{
	$("#addKeywordBtn").before(keywordField);
}

var ajax=null;

function CheckURL()
{
	$("#urlOK").hide();
   	$("#urlError").hide();
   	$("#urlLoader").show();
    
    if(ajax!=null)
    	ajax.abort();
    ajax=$.get("CheckUrl.php?url="+$("#urlInput").val(), function(data, status)
	{
		ajax=null;
		$("#urlLoader").hide();
        if(data=="y")
        $("#urlOK").show();
    	else
    	$("#urlError").show();
    });

}