<!DOCTYPE html>
<html>

<title>GroTrack</title>

<body>

<h1>GroTrack</h1>

<!-- <form action="barcode.php" method="post">
Barcode: <input type="text" name="barcode"><br>
<input type="submit" name="submitBarcode" value="Enter">
</form> -->

<!-- <a class="button" id="startButton">Click To Start Scanning Barcode</a> -->
<button type="button" id="startButton">Scan Barcode</button>
<button type="button" id="resetButton">Reset</button>
<br>
<!-- <a class="button" id="resetButton">Reset Barcode</a> -->

<div>
    <video id="video" width="600" height="400" style="border: 1px solid gray"></video>
</div>




<div id="sourceSelectPanel" style="display:none">
    <label for="sourceSelect">Change video source:</label>
    <select id="sourceSelect" style="max-width:400px">
    </select>
</div>

<label>Result:</label>
<pre><code id="result"></code></pre>
<!-- <input type="submit" name="enterBarcode" value="Enter"> -->
<button type="button" name="enterBarcode">Enter</button>

<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
    <script type="text/javascript">
        window.addEventListener('load', function () {
            let selectedDeviceId;
            const codeReader = new ZXing.BrowserBarcodeReader()
            console.log('ZXing code reader initialized')
            codeReader.getVideoInputDevices()
                .then((videoInputDevices) => {
                    const sourceSelect = document.getElementById('sourceSelect')
                    selectedDeviceId = videoInputDevices[0].deviceId
                    if (videoInputDevices.length > 1) {
                        videoInputDevices.forEach((element) => {
                            const sourceOption = document.createElement('option')
                            sourceOption.text = element.label
                            sourceOption.value = element.deviceId
                            sourceSelect.appendChild(sourceOption)
                        })

                        sourceSelect.onchange = () => {
                            selectedDeviceId = sourceSelect.value;
                        }

                        const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                        sourceSelectPanel.style.display = 'block'
                    }

                    document.getElementById('startButton').addEventListener('click', () => {
                        codeReader.decodeOnceFromVideoDevice(selectedDeviceId, 'video').then((result) => {
                            console.log(result)
                            // document.getElementById('result').textContent = result.text
                            window.location.href="barcode.php?barcode="+result.text
                        }).catch((err) => {
                            console.error(err)
                            document.getElementById('result').textContent = err
                        })
                        console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
                    })

                    document.getElementById('resetButton').addEventListener('click', () => {
                        document.getElementById('result').textContent = '';
                        codeReader.reset();
                        console.log('Reset.')
                    })

                })
                .catch((err) => {
                    console.error(err)
                })
        })
    </script>

<?php
$examplebarcode = "737628064502";
$handsani = "067153948160";
$granola = "060383046019";
$tuna = "8004030044005";

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if (isset($_POST['submitBarcode'])) {
    if (isset($_POST['enterBarcode'])) {
        echo "hi";
        // $barcode = $_POST["barcode"];
        // $barcode = "8004030044005";
        $barcode = $_GET["barcode"];
        // $barcode = <code id="result"></code>;
        $xml = json_decode(file_get_contents("https://world.openfoodfacts.org/api/v0/product/$barcode.json"));
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
    } else {
        echo "2";
        // Assume btnSubmit
    }
// }




// echo "<br><br><br>";

// echo "<br>";
// echo json_encode($xml->product->_keywords);
// echo "<br>";

// echo $xml;

?> 

</body>
</html>