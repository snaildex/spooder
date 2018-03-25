<?php

$curl = curl_init($_GET["url"]);
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