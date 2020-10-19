<?php

$proxy = getRandomProxy();
$url = urlDecode($_GET['url']);
if (strlen($url) < 12 )
{
$url = "https://www.youtube.com/embed/".$url."?controls=0&amp;start=".rand(4,8);
}

$viewer = "https://criminal.ml/webapp/proxy/viewer.php?url=";

if (hasParam('loads'))
{
$loads = $_GET['loads'];
}
else
{
$loads = 0;
}

if(hasParam('submit'))
{

$result = proxy($proxy, $viewer.urlEncode($url));

echo ($loads+1).' Total <br>1 New View From '.$proxy.'<br>'.$url."<br>".$result.'<br>
<script type="text/JavaScript">
setTimeout(function(){

window.location.href="index.php?url='.urlEncode($url).'&submit=true&loads='.($loads+1).'";

}, 2000);

</script>';
exit;
}

function getRandomProxy()
{
  $proxies = file('https://api.proxyscrape.com/?request=getproxies&proxytype=http&timeout=8000&country=all&ssl=yes&anonymity=transparent');
 return trim($proxies[array_rand($proxies,1)]);
}
function getRandomAgent()
{
  $bits = file('useragents.txt');
 return trim($bits[array_rand($bits,1)]);
}

function proxy($proxy, $url){
$url = ($url);
$agent = getRandomAgent();
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_REFERER, "https://www.youtube.com");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT_MS, 10000);
curl_setopt($ch, CURLOPT_USERAGENT,  $agent);
curl_setopt($ch, CURLOPT_HEADER, 0);
$page = curl_exec($ch);
curl_close($ch);
if (strlen($page) > 50)
{
   $hit = true;
}
return $page;
}


function hasParam($param) 
{
   return array_key_exists($param, $_REQUEST);
}

?>

<html>
  <head>
    <title>Youtube Viewer</title>
  </head>
  <body>
  </body>

      • Enable Auto Play in Your Browser<br>
      • Enter only the Video ID<br>
      • Close the Tab to Stop Loading<br>
      • Leave Tab Open to Keep Getting Views<br><br>

      <form action="" method="GET">
      YouTube ID: <input type="text" name="url">
      <br>
      <button type="submit" name="submit" value="true">START</button>
      </form>
</body>
</html>
