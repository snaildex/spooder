<?php
require ('phpQuery/phpQuery.php');

$url=$_GET["url"];
$keywords=explode("$",$_GET["keys"]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$content = curl_exec ($ch);
$insertions = array();

foreach($keywords as $key)
  $insertions[] = "<b class='popavs_$key' style='color:yellow; background-color:blue'>$key</b>";

$pq = phpQuery::newDocument(str_replace($keywords, $insertions, $content));
$pq->find("script, link")->remove();

foreach($keywords as $key)
{
  $num = 0;
  $pq->find(".popavs_$key")->each(function($obj) use($key, $num){ pq($obj)->attr('id',$key."_".$num); $num++; });
}

echo($pq->html());