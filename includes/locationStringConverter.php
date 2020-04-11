<!--AUTHOR: Willi Hertel-->
<?php
//for header function directly gives path for given file
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