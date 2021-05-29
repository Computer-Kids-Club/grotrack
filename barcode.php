<!DOCTYPE html>
<html>
<title>GroTrack</title>
<head>
    <link rel="stylesheet" href="coolertable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">

</head>
<body>

<?php include 'header.php';?>

<!-- // $examplebarcode = "737628064502";
// $granola = "060383046019";
// $tuna = "8004030044005";
$cheerios =  -->

<!-- <a class="button" id="startButton">Click To Start Scanning Barcode</a> -->
<?php
$barcode = 0;
if (!isset($_GET['bc']) && !isset($_POST['submitBarcode'])) {
?>

    <button type="button" id="startButton">Scan Barcode</button>
    <button type="button" id="resetButton">Reset</button>
    <br>

    <form action="barcode.php" method="post">
    Barcode: <input type="text" name="barcode"><br>
    <input type="submit" name="submitBarcode" value="Enter">
    </form>

    <div>
        <canvas id="canvas" width="600" height="400" style="border: 1px solid gray"></canvas>
    </div>

    <div id="sourceSelectPanel" style="display:none">
        <label for="sourceSelect">Change video source:</label>
        <select id="sourceSelect" style="max-width:400px">
        </select>
    </div>

    <label>Result:</label>
    <pre><code id="result"></code></pre>

    <hr>
        <select></select>
        <hr>
        <ul></ul>
 
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/qrcodelib.js"></script>
    <script type="text/javascript" src="js/webcodecamjquery.js"></script>
    <script type="text/javascript">
        var count = 0;
        var arg = {
            resultFunction: function(result) {
                count++;
                if(count % 3 == 0) {
                    window.location.href="barcode.php?bc="+result.code
                }
                $('body').append($('<li>' + result.format + ': ' + result.code + '</li>'));
            }
        };
        var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
        decoder.buildSelectMenu("select");
    decoder.play();
        
        /*  Without visible select menu
            decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
        */
        $('select').on('change', function(){
            decoder.stop().play();
        });
    </script>

<?php
} else {
    // echo "hi";
    // $barcode = $_POST["barcode"];
    // $barcode = "8004030044005";
    if(isset($_GET['bc'])) $barcode = $_GET["bc"];
    else $barcode = $_POST['barcode'];
        // echo $barcode;

    // echo $barcode;

    // echo "$barcode       $barcode2";
    // $barcode = <code id="result"></code>;
    $xml = file_get_contents("https://world.openfoodfacts.org/api/v0/product/$barcode.json");
    $xml = json_decode($xml);
    // var_dump($xml);

    $name = ucwords($xml->product->product_name);
    echo "<h2>$name</h2>";
    $image = urldecode($xml->product->image_front_small_url);
    $imageData = base64_encode(file_get_contents($image));
    ?>
    <div class="center">
    <?php
    echo '<p style="float: left;"><img src="data:image/jpeg;base64,'.$imageData.'" width=300vw></p>';
    // echo "<br>";

    // for searching later
    // $keywords = json_encode($xml->product->_keywords);

    $nutrients = $xml->product->nutriments;
    // echo $nutrients[0];
    // echo "<br><br>";
    ?>
    <section class="performance-facts">
  <header class="performance-facts__header">
    <h1 class="performance-facts__title">Nutrition Facts</h1>
  </header>
  <table class="performance-facts__table">
    <!-- <thead> -->
      <!-- <tr>
        <th colspan="3" class="small-info">
          Amount Per Serving
        </th>
      </tr> -->
    <!-- </thead> -->
    <tbody>
      <!-- <tr> -->
        <!-- <th colspan="2"> -->
          <b>Calories </b>
            <?php
            echo "<b>", $nutrients->{'energy-kcal'}, "<b>";
            unset($nutrients->{'energy-kcal'});
            ?>
      <tr class="thick-row">
        <td colspan="3" class="small-info">
        </td>
      </tr>
                                    <!-- <tr>
                                        <th colspan="2">
                                        <b>Total Fat</b>
                                        14g
                                        </th>
                                    </tr> -->
      <!-- <tr> -->
        <!-- <td class="blank-cell">
        </td>
        <th>
          Saturated Fat
          9g
        </th>
        <td>
          <b>22%</b>
        </td>
      </tr>
      <tr>
        <td class="blank-cell">
        </td>
        <th>
          Trans Fat
          0g
        </th>
        <td>
        </td> -->
      <!-- </tr> -->
                                                    <!-- <tr>
                                                        <th colspan="2">
                                                        <b>Cholesterol</b>
                                                        55mg
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">
                                                        <b>Sodium</b>
                                                        40mg
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">
                                                        <b>Total Carbohydrate</b>
                                                        17g
                                                        </th>
                                                    </tr> -->
      <!-- <tr> -->
        <!-- <td class="blank-cell">
        </td>
        <th>
          Dietary Fiber
          1g
        </th>
        <td>
          <b>4%</b>
        </td>
      </tr>
      <tr>
        <td class="blank-cell">
        </td>
        <th>
          Sugars
          14g
        </th>
        <td>
        </td> -->
      <!-- </tr> -->
      <!-- <tr class="thick-end"> -->
                                                    <!-- <th colspan="2">
                                                    <b>Protein</b>
                                                    3g
                                                    </th> -->
    <!-- </tbody>
  </table> -->

<!-- </section> -->
    <?php
    $prevKey = "";
    $prevValue = 0;
    $unit = "";
    foreach($nutrients as $key => $value) {
        if(strpos($key, "nova") === false && strpos($key, "_100g") === false && (strpos($key, "_value") !== false || strpos($key, "_unit") !== false) && $key != "energy-kj" &&
        strpos($key, "nutrition") === false && strpos($key, "_serving") === false && strpos($key, "energy") === false) {
            // if(strpos($key, "_unit") !== false) {
                // if($prev != "energy-kcal")echo $value;
            // } else {
                // echo "<br>";
                // if($key == "energy-kcal") echo "Calories ", $value;
                // if(round($value, 1) != 0) {
                if(strpos($prevKey, "_unit") !== false) {
                    $unit = $prevValue;
                } else {
                    $unit = "";
                }

                if(strpos($key, "_value") !== false) {
                ?>

                <tr>
                    <th colspan="2">
                        <b><?php echo ucwords(str_replace("_value", "", $key)) ?></b>
                        <?php echo round($value, 1), $unit; ?>
                    </th>
                </tr>
                <?php
                }
                
                // echo ucwords($key), " ", $value;
                $prevKey = $key;
                $prevValue = $value;
            // }
        }
    }

    ?>
            </tbody>
        </table>
    </section>
</div>
    <?php

    echo "<br><br>";
    $ingredients = json_encode($xml->product->ingredients_text_en);
    $ingredients = str_replace(['"',"'"], "", $ingredients);
    if(!is_null($ingredients)) echo "Ingredients: $ingredients";
    echo "<br>";
}

?>
<br>
<label for="quantity">Quantity:</label>
<input type="number" id="quantity" name="quantity" min="1">
<br>
<label for="expiration">Expiration Date:</label>
<input type="date" id="expiration" name="expiration">
<br>
<form action="barcode.php" method="post">
    <input type="submit" name="submitAdd" value="Enter">
</form>

<form action="https://grotrack.co/barcode.php">
    <input type="submit" value="Go Back" />
</form>

<?php
if(isset($_POST["submitAdd"])) {
    $host = "localhost:3306";
    $conn = new mysqli($host, "groperson", "gropassword", "groceries");
    // $query = "SELECT id, name, amount, exp_date FROM groceries;";
    $quantity = $_POST['quantity'];
    $expr_date = date('Y-m-d', strtotime($_POST['expiration']));
    $uuid = "GRO-60b2b1d74df73";
    // $uuid = $session_uuid;

    $idQuery = "SELECT id FROM users WHERE uuid='$uuid'";
    $results = $conn -> query($idQuery);
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];

    $query = "INSERT INTO groceries VALUES (NULL, '$barcode', '$name', '$quantity', '$expr_date', '$id')";
    $results = $conn -> query($query);
}
?>

</body>
</html>