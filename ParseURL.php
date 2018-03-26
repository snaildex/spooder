<?php
require ('phpQuery/phpQuery.php');

$url=$_GET["url"];
$keywords=explode("$",$_GET["keys"]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$content = curl_exec ($ch);
$iter = 0;
$new_array = array();
$string_navigation = '<ul style="position: fixed; width:200px; background: gray; top: 0; left: 0;">';
foreach($keywords as $key)
{
  $string_navigation .= sprintf('<li><a href="#">%s</a></li>', $key);
  $new_array[] = "<b class='popavs' data-key='$key' style='color:yellow; background-color:blue'>$key</b>";

}
$string_navigation .= "</ul>";
$content = str_replace($keywords, $new_array, $content) . $string_navigation;
$pq = phpQuery::newDocument($content);
$pq->find("script, link")->remove();
echo($pq->html());