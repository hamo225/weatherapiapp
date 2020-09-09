<?php

// if someone has requested city. if someone has inputed a city and pressed submit
if ($_GET['city']) {

    // test with echo that the file_get contents will display the information we want
    // echo

    // getting the contents of the input address for the api call for any city depending on what the user input into the get form. 
    file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . $_GET['city'] . "&appid=9eb84fa16fe5fc0386da5f9eb590d243");


    // this is in json format and we need it in an array to extract the data
    // json_decode will extract the data from json format and put it into an array format called weatherarray
    //  which we then can further take out info that we need to display to the user
    $weatherArray =  json_decode($urlContents, true);

    // we put the whole code block inside an if statement. 
    // We know that code 202 is for successfull searches so anything 
    // else we put it to come up an error message that city cannot be found.

    if ($weatherArray['code'] == 202) {

        // need weather by city location
        // can look at the parameters for the information on the api documentation site


        // here we create the variable weather to include - the weather paramters from the weather array. 
        $weather = "The weather in " . $_GET['city'] . " is currently '" . $weatherArray['weather'][0]['description'] . "'.";

        // we add the temperature in celcius . intval will make it a whole number value
        $temperatureInCelcius = intval($weatherArray['main']['temp'] - 273);

        // we append the weather variable to include the temperature for the location
        $weather .= " The temperature is " . $temperatureInCelcius . "&deg;c";

        $windSpeed = $weatherArray['wind']['speed'];

        $weather .= " The wind speed is " . $windSpeed . "mp/s";
    } else {
        $error = "Could not find city - please try again";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Scraper</title>
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
            width: 450px;
        }

        input {
            margin: 20px;
        }

        #weather {
            margin-top: 20px;
        }
    </style>


</head>



<body>

    <div class="container">
        <h1>Whats the Weather</h1>

        <form action="" method="get">
            <div class="form-group">
                <label for="city">Enter Name of City:</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="e.g. London, Berlin" aria-describedby="helpId">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

        <div id="weather">
            <?php

            if ($weather) {

                echo '<div class= "alert alert-success" role= "alert">' . $weather . '</div>';
            }


            ?>

        </div>

    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>