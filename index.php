<?php

$weather = "";
$error = "";

if ($_GET['city']) {


    $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . $_GET['city'] . "&appid=9eb84fa16fe5fc0386da5f9eb590d243");


    $weatherArray = json_decode($urlContents, true);

    if ($weatherArray['cod'] == 200) {

        // print_r($weatherArray);

        $weather = "The weather in " . $_GET['city'] . " is " . $weatherArray['weather'][0]['description'] . ". \n";

        // print_r($weather);

        $tempInCelcius = $weatherArray['main']['temp'] - 273;
        $feelsLike = $weatherArray['main']['feels_like'] - 273;
        $maxTemp = $weatherArray['main']['temp_max'] - 273;
        $humidity = $weatherArray['main']['humidity'];

        $weather .= " Its gonna be FUCKING HOT! The temperature is " . $tempInCelcius . "&degC";
        $weather .= " Humidity is " . $humidity . ".";
        $weather .= " Max temp today will be " . $maxTemp . "&degC.";
        $weather .= " But it really feels like " . $feelsLike . "&degC";
    } else {
        $error = "WHAT? ARE YOU FUCKING STUPID? " . $_GET['city'] . " is not a city! Go back to fucking school, learn some shit, then come back and try again.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Genie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <style>
        html {
            background: url("/christophe-ZGQsHzU5Sls-unsplash.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }

        body {
            background: none;
        }

        .container {
            text-align: center;
            margin-top: 100px;
            width: 400px;
        }

        input {
            margin-top: 20px;
        }

        #weather {
            margin-top: 20px;
        }
    </style>


</head>

<body>

    <div class="container">
        <h1>Whats the Weather now?</h1>

        <form action="" method="get">
            <div class="form-group">
                <!-- <label for="city">Enter Name of City:</label> -->
                <input type="text" name="city" id="city" class="form-control" placeholder="Enter Name of City e.g. London, Berlin, Mars..." aria-describedby="helpId">
            </div>
            <button type="submit" class="btn btn-success">Search</button>

        </form>

        <div id="weather" id="error">

            <?php

            if ($weather) {
                echo '<div class="alert alert-success" role="alert">' . $weather . '</div>';
            }


            if ($error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }

            ?>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>