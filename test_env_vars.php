<!DOCTYPE html>
<html>
<body>

<?php

echo 'display_errors = ' . ini_get('display_errors') . "\n";
echo 'register_globals = ' . ini_get('register_globals') . "\n";
echo 'post_max_size = ' . ini_get('post_max_size') . "\n";
echo 'post_max_size+1 = ' . (ini_get('post_max_size')+1) . "\n";
echo 'post_max_size in bytes = ' . return_bytes(ini_get('post_max_size'));

echo "<br>here ->";

$gro_env = ini_get("grotrack.env");
echo $gro_env;

echo "<- after here<br>";

var_dump($_ENV);
echo "<br>";
var_dump($_SERVER);
echo "<br>";

phpinfo();

?>  

</body>
</html>


<php?

