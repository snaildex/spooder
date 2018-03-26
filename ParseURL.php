<?php
require ('phpQuery/phpQuery.php');

$url=$_GET["url"];
$keywords=explode("$",$_GET["keys"]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$content = curl_exec ($ch);

foreach($keywords as $key)
{
  $pq = phpQuery::newDocument(str_replace($key, "<b style='color:yellow; background-color:blue'>$key</b>", $content));
  $pq->find("script, link")->remove();
  echo($pq->html());
}