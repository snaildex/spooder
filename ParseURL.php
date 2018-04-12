<?php
require ('phpQuery/phpQuery.php');
set_time_limit ( 60 );
$url=$_GET["url"];
$keys=$_GET['keys'];
$host=parse_url($url,PHP_URL_HOST);
$scheme=parse_url($url, PHP_URL_SCHEME);
$basePath=$scheme."://".$host;
$keywords=explode(";",$keys);

error_reporting(E_ALL ^ E_WARNING);

$useragent = "Opera/9.80 (J2ME/MIDP; Opera Mini/4.2.14912/870; U; id) Presto/2.4.15";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_USERAGENT, $useragent); // set user agent
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_PROXY, '95.37.192.219:1080');
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
$content = html_entity_decode(curl_exec ($ch));
curl_close($ch);
$insertions = array();

foreach($keywords as $key)
  $insertions[] = "<b class='popavs_$key' style='color:yellow; background-color:blue'>$key</b>";

$pq = phpQuery::newDocument(str_ireplace($keywords, $insertions, $content));

$pq->find("link")->each(function($obj)use($basePath){
  $href=pq($obj)->attr("href");
  {if(stream_is_local($href))
    if($href[0]!=='/')
      $href='/'.$href;
    pq($obj)->attr("href",$basePath.$href);
  }
 });
$pq->find("img")->each(function($obj)use($basePath){
  $href=pq($obj)->attr("src");
  if(stream_is_local($href))
  {
    if($href[0]!=='/')
      $href='/'.$href;
    pq($obj)->attr("src",$basePath.$href);
  }
 });
$pq->find("a")->each(function($obj)use($basePath,$keys){
  $href=pq($obj)->attr("href");
  if(stream_is_local($href))
  {
    if($href[0]!=='/')
      $href='/'.$href;
    $href=$basePath.$href;
  }
  pq($obj)->attr("href","ParseURL.php?url=$href&keys=$keys");
  pq($obj)->attr("target","result");
 });
$pq->find("script")->remove();

function validate($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

foreach($keywords as $key)
{
  $skey=validate($key);
  $list="$skey: ";
  $num = 0;
  $pq->find(".popavs_$key")->each(function($obj) use($key, &$num, &$list){ 
    $id=$key."_".$num;
    pq($obj)->attr('id',$id); 
    $num++;
    $list=$list."<a href='#$id'>[$num]</a>"; 
  });
  $list=$list."<br><br>";
  $pq->find("body")->prepend($list);
}

echo($pq->html());
