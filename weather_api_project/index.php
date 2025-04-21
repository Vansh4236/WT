<?php
    include 'config.php';

    $weatherData = null;
    $error = "";
    $city = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $city = trim($_POST['city']);
        if (!empty($city)) {
            $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid=" . "0a1ec0382c347d70d85ec44207c81237" . "&units=metric";
            $response = file_get_contents($url);
            if ($response) {
                $weatherData = json_decode($response, true);
            }
        }
        else{
            $error = "City is required";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>WeatherData</title>
        <link rel = "stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <form method="POST">
                <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>">
                <button type="submit">Get Weather</button>
            </form>

            <h2> Weather Data : </h2>
            <?php if($weatherData) ?>
                <h3>Weather in <?php echo $weatherData['name']; ?></h3>
                <p>Temperature: <?php echo $weatherData['main']['temp']; ?>°C</p>
                <p>Weather: <?php echo $weatherData['weather'][0]['description']; ?></p>
                <p>Humidity: <?php echo $weatherData['main']['humidity']; ?>%</p>
            
            <php if($error) ?>
                <?php 
                    echo $error;
                ?>
        </div>
    </body>
</html>