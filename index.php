<?php

  $cityWeather = "";
  $error = "";

  if (array_key_exists('city', $_GET)) {

    $weatherContent = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&units=metric&appid=52839b7f18de0f3324e5a3fe64bc8bee");

    $contentArray = json_decode($weatherContent, true);

    if($contentArray['cod'] == 200){

      if($_GET['temp'] == 'true'){
        $cityWeather .= "The temperature is ".$contentArray['main']['temp']." &deg;C. ";
      }
      if($_GET['windspeed'] == 'true'){
        $cityWeather .= "The windspeed is ".$contentArray['wind']['speed']." meters/sec. ";
      }
      if($_GET['citylocation'] == 'true'){
        $cityWeather .= "The longitude is ".$contentArray['coord']['lon'];
        $cityWeather .= " and the latitude is ".$contentArray['coord']['lat'].". ";
      }
      if($_GET['pressure'] == 'true'){
        $cityWeather .= "The pressure is ".$contentArray['main']['pressure']."hPa. ";
      }
      if($_GET['humidity'] == 'true'){
        $cityWeather .= "The humidity is ".$contentArray['main']['humidity']."%. ";
      }
      if($_GET['weatherdesc'] == 'true'){
        $cityWeather .= "The weather in ".$_GET['city']." is currently ".$contentArray['weather'][0]['description'].". ";
      }

    }else{
      $error = "Could not find the city. Please try again!";
    }

  }

?>

<!-- Start of HTML -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Whats the weather?</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <style type="text/css">

      html{
        background: url("imgs/bg.jpeg") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }

      body{
        background: none;
      }

      .container{
        text-align: center;
        margin-top: 150px;
        width: 450px;
      }

      input{
        margin: 20px 0;

      }

      #weather{
        margin-top: 15px;
      }

      .checkbox-grid li {
        display: block;
        float: left;
        width: 30%;
      }

    </style>


  </head>
  <body>


    <div class="container">
      <h1>Whats the weather?</h1>

      <form>
        <div class="form-group">
          <label for="city">Enter the name of a city</label>
          <input type="text" class="form-control" name="city" id="city" placeholder="Eg. Toronto, Ottawa" value="<?php if (array_key_exists('city', $_GET)) { echo $_GET['city']; }?>">
        </div>

        <ul class="checkbox-grid">
          <li><input type="checkbox" name="temp" value="true">Temperature</input></li>
          <li><input type="checkbox" name="windspeed" value="true">Wind Speed</input></li>
          <li><input type="checkbox" name="citylocation" value="true">City Location</input></li>
          <li><input type="checkbox" name="pressure" value="true">Pressure</input></li>
          <li><input type="checkbox" name="humidity" value="true">Humidity</input></li>
          <li><input type="checkbox" name="weatherdesc" value="true">Description</input></li>
        </ul>

        <button type="submit" class="btn btn-primary">Get Weather</button>
      </form>

      <div id="weather">
        <?php

          if ($cityWeather){

            echo '<div class="alert alert-info" role="alert">'.$cityWeather.'</div>';


          }
          else if ($error){

            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';

          }

        ?>
      </div>

    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>
