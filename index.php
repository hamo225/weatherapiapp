<?php

// declare the variables you will use
$weather = "";
$error = "";
$hotWeather = "";
$coldWeather = "";
$normalWeather = "";
$weatherDescription = "";

// create a background array of all the names of the images you will use
$bg = array('/bg-01.jpg', '/bg-02.jpg', '/bg-03.jpg', '/bg-05.jpg', '/bg-06.jpg', '/bg-07.jpg');
// generate a random number which will be the index of the above array
$i = rand(0, count($bg) - 1);
// create a variable which selects the background array and the each time the page loads a random index number for the background image
$selectedBg = "$bg[$i]";

if ($_GET['city']) {

    // create a variable and use get contents to get json data from the url with the api key of the input city
    $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . $_GET['city'] . "&appid=9eb84fa16fe5fc0386da5f9eb590d243");

    // decode the json contents using json_decode and place them in an array
    $weatherArray = json_decode($urlContents, true);


    if ($weatherArray['cod'] == 200) {

        // create variables for the data you need from the arrays
        $weather = "The weather description in " . $_GET['city'] . " is currently: " . $weatherArray['weather'][0]['description'] . ". \n";
        $tempInCelcius = $weatherArray['main']['temp'] - 273;
        $feelsLike = $weatherArray['main']['feels_like'] - 273;
        $maxTemp = $weatherArray['main']['temp_max'] - 273;
        $humidity = $weatherArray['main']['humidity'];
        $hotWeather = " HOT!";
        $coldWeather = " COLD!";
        $normalWeather = " NORMAL. DONT COMPLAIN!";

        // if statements
        if ($tempInCelcius >= 25) {
            $selectedBg = "/bg-02.jpg";
        } elseif ($tempInCelcius < 10) {
            $selectedBg = "/bg-03.jpg";
        } else {
            $selectedBg = "$bg[$i]";
        }

        // if statements
        if ($tempInCelcius >= 25) {
            $weatherDescription = $hotWeather;
        } elseif ($tempInCelcius < 10) {
            $weatherDescription = $coldWeather;
        } else {
            $weatherDescription = $normalWeather;
        }

        $weather .= " Its gonna be FUCKING" . $weatherDescription . "The temperature is " . $tempInCelcius . "&degC";
        $weather .= " Humidity is " . $humidity . ".";
        $weather .= " Max temp today will be " . $maxTemp . "&degC.";
        $weather .= " But mother earth is fucking with you really cos it feels like " . $feelsLike . "&degC";
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
            /* the background image is the random or specific one as in the php script above */
            background: url(<?php echo $selectedBg; ?>);
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

        a {
            text-decoration: none;
            color: black;
        }

        a:hover {
            color: black;
            text-decoration: none;
        }
    </style>


</head>

<body>

    <div class="container">
        <h1><a href="/index.php"> Whats the Weather now?</a></h1>

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

    <script>
        // on page load both error or weather boxs are reverted to not displaying
        function myfunction() {

            document.getElementById("error").style.display = "none";
            document.getElementById("weather").style.display = "none";

        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>