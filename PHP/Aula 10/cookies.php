<?php
setcookie("empresa", "", time() + 3600);
echo "cookie criado<br>";

var_dump($_COOKIE);
?>