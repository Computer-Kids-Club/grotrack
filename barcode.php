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

$xml = json_decode(file_get_contents("https://world.openfoodfacts.org/api/v0/product/$examplebarcode.json"));
var_dump($xml);
// echo json_encode($xml, JSON_PRETTY_PRINT);

echo "<br><br><br>";
echo $xml->product->_id;
echo "<br>";
echo json_encode($xml->product->_keywords);
echo "<br>";
$image = urldecode($xml->product->image_front_small_url);
// $image = "https://static.openfoodfacts.org/images/products/073/762/806/4502/front_en.6.200.jpg";
echo $image;
$imageData = base64_encode(file_get_contents($image));
echo '<img src="data:image/jpeg;base64,'.$imageData.'">';

// echo $xml;

?> 

</body>
</html>