<html>
    <header>
        <title>Weather App</title>
        <link rel="stylesheet" href="style.css">
    </header>
    <body>
        <h1>Weather App By Aymane</h1>
        <div>
            <form method="POST">
                <label for="city">Choose a city </label>
                <select id="city" name="city">
                    <option value="">Choose a city</option>
                    <option value="London">London</option>
                    <option value="Berlin">Berlin</option>
                    <option value="Paris">Paris</option>
                    <option value="Rome">Rome</option>
                </select>
                <button type="submit" name="getTemp">Get Temperature</button>
            </form>
        </div>
        <div class="result">
            <?php
            if(isset($_POST['getTemp'])){
                $city = $_POST['city'];
                $apiKey = '';
                $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
                $response = curl_exec($ch);
                curl_close($ch);

                if(isset($response)){
                    $data = json_decode($response, true);
                
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        echo 'JSON decode error: ' . json_last_error_msg();
                    } else {
                        if (isset($data)) {
                            $temp = $data['main']['temp'];
                            $description = $data['weather'][0]['description'];
                            echo "<p>The temperature is {$temp}°C with $description.</p>";
                            echo '☀️';
                        } else {
                            die("Error decoding data.");
                        }
                    }
                }else{
                    die("No response has been received");
                }    
            }
        ?>
        </div>
    </body>
</html>
