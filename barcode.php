<!DOCTYPE html>
<html>
<body>

<?php
echo "<h2>PHP is Fun!</h2>";
echo "Hello world!<br>";
echo "I'm about to learn PHP!<br>";
echo "This ", "string ", "was ", "made ", "with multiple parameters.<br>";

$examplebarcode = "737628064502";
$handsani = "067153948160";
$granola = "060383046019";

$xml = file_get_contents("https://world.openfoodfacts.org/api/v0/product/$granola.json");
echo $xml;

?> 

</body>
</html>