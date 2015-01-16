<?php
session_start();
$ar = session_get_cookie_params();
echo "Lifetime: ".$ar['lifetime']."<br/>";
echo "Path: ".$ar['path']."<br/>";
echo "Cache Expire: ".session_cache_expire()."<br/>";
echo "Cache Limiter: ".session_cache_limiter();
phpinfo();
?>