<?php
$url = urlDecode($_GET['url']);

if (strlen($url) < 12 )
{
$url = "https://www.youtube.com/embed/".$url."?controls=0&start=".rand(4,8);

}

echo '<br>
<iframe width="560" height="315" src="'.$url.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen autoplay muted></iframe>';
?>