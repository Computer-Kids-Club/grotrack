<!DOCTYPE html>
<html>
<body>

<?php


echo "here ->";

$gro_env = ini_get("GRO_ENV");
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

