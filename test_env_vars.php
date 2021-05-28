<!DOCTYPE html>
<html>
<body>

<?php

print_r(ini_get_all());

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

