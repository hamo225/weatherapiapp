<?php

// include another file
// include("includedFile.php");

// use this to get html content from a website
// echo file_get_contents("http://savelebanesehospitality.com");

// if someone has requested city. if someone has inputed a city and pressed submit
if ($_GET['city']) {

    // this is the page that will be scraped
    $forecastPage = file_get_contents("http://www.completewebdevelopercourse.com/locations/" . $_GET['city']);

    // this will explode the html of the page up to this unique point
    $pageArray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $forecastPage);

    // this will explode the page up to the point and leave a new array of the data we want
    $secondPageArray = explode('</span></span></span>', $pageArray[1]);

    // create a new array for the data
    $weather = $secondPageArray[0];
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