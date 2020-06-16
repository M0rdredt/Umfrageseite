<!--AUTHOR: Willi Hertel-->
<?php
//für header() gibt direkt Pfad zu php-Datei
function uriString($file){
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
$uri = 'https://';
} else {
$uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];
$uri = 'Location: '.$uri.$file;
return $uri;
}