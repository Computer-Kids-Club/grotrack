<!DOCTYPE html>
<html>
<body>

<?php
$examplebarcode = "737628064502";
$handsani = "067153948160";
$granola = "060383046019";
$tuna = "8004030044005";

$xml = json_decode(file_get_contents("https://world.openfoodfacts.org/api/v0/product/$tuna.json"));
// var_dump($xml);

$name = ucwords($xml->product->product_name);
echo "<h2>$name</h2>";
$image = urldecode($xml->product->image_front_small_url);
$imageData = base64_encode(file_get_contents($image));
echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
echo "<br>";
$keywords = json_encode($xml->product->_keywords);
// echo $keywords;
$nutrients = json_encode($xml->product->nutriments);
echo "Nutritional Facts: $nutrients";

$ingredients = json_encode($xml->product->ingredients_text_en);
echo "<br><br>";
$ingredients = str_replace(['"',"'"], "", $ingredients);
echo "Ingredients: $ingredients";



// echo "<br><br><br>";

// echo "<br>";
// echo json_encode($xml->product->_keywords);
// echo "<br>";

// echo $xml;

?> 

</body>
</html>