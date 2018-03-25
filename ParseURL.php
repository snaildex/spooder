<?php
require ('phpQuery/phpQuery.php');

$url=$_GET["url"];
$keywords=explode("$",$_GET["keys"]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$content = curl_exec ($ch);

$pq = phpQuery::newDocument($content);

foreach($keywords as $key)
{
  echo(str_replace($key,'<b style="color:yellow; background-color:blue">Папавсь</b>',$content));

  /*
  echo('<div class="w3-panel w3-light-gray w3-leftbar w3-border-blue-gray">');
  echo('<h3>'.$key.'</h3>');
  $pq->find(":contains('$key'):has(:not(:contains('$key'))")->append('<b style="color:yellow; background-color:blue">Папавсь</b>');
  echo($pq->html());
  echo('</div>');
  */
}