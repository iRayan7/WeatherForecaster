<?php

    $error ='';
    $weather = '';

    if(isset($_GET['city'])){
        
        $openWeatherApi = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=c14bd4ab9ea2cc1762e71ac09685517f");
        
        $weatherArray = json_decode($openWeatherApi,true);
        if($weatherArray['cod'] == 200){
            $weather = "The Weather in ".$_GET['city']." is '".$weatherArray['weather'][0]['description']."'.";

            $tempInCelcius = $weatherArray['main']['temp'] - 273;

            $weather .= "The temperature is ".round($tempInCelcius)."&deg;C and the wind speed is ".$weatherArray['wind']['speed']."m/s .";
        } else {
            $error = "couldn't find this city name, please try again.";
        }
    }

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>weather Forecaster</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="index.css">
    </head>

    <body>
        <div class="container" id="main">
            <h1>What Is The weather?</h1>
            <p>Enter the name of a city:</p>
            <form method="get">
                <div class="form-group" method="get">
                    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. Riyadh, London" value="<?php if(isset($_GET['city'])) echo $_GET['city']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div id="message">
                <?php
                if($weather != ''){
                    echo "<div class='alert alert-success' role='alert'>".$weather."</div>";
                }
                if($error != ''){
                    echo "<div class='alert alert-danger' role='alert'>".$error."</div>";
                }
            ?>
            </div>
        </div>


        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>

    </html>
