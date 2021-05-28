<!DOCTYPE html>
<html>
<body>

<?php

$url = 'https://world.openfoodfacts.org/api/v0/product/737628064502.json';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo '<br>';
var_dump($result);

echo '<br>';
//var_dump($httpcode);

?>  

</body>
</html>


<php?

