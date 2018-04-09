<?php

$curl = curl_init($_GET["url"]);
$useragent = "Opera/9.80 (J2ME/MIDP; Opera Mini/4.2.14912/870; U; id) Presto/2.4.15";
curl_setopt ($curl, CURLOPT_USERAGENT, $useragent); // set user agent
curl_setopt($curl, CURLOPT_PROXY, '95.37.192.219:1080');
curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
curl_setopt($curl, CURLOPT_NOBODY, true);
$result = curl_exec($curl);
if ($result !== false) 
{
  $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
  if ($statusCode == 404) 
  {
    echo "n";
  }
  else
  {
     echo "y";
  } 
}
else
{
  echo "n";
}
curl_close($curl);