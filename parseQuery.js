
$(document).ready(function () {
        $('#result').on('load', function () {
            $('#parseLoader').hide();
        });
    });

function ParseQuery()
{
	var keywords=$(".keywordInput").val().replace(/\s/g,'');
    if(keywords)
    {
    $("#result").attr('src',"about:blank");
    $("#parseLoader").show();
    $query="ParseUrl.php?url="+$("#urlInput").val()+"&keys="+keywords;
   	$("#result").attr('src',$query);
	}
}