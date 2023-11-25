<?php

$url = "https://api.openweathermap.org/data/2.5/forecast?lat=23.7104&lon=90.4074&appid=2471bc340f047b455a212540e36efe24&units=metric";

$contents = file_get_contents($url);
$clima = json_decode($contents);


$temperature = number_format($clima->list[0]->main->temp, 1);
$timestamp = $clima->list[0]->dt;
$feelsLike = number_format($clima->list[0]->main->feels_like, 1);
$minTemp = number_format($clima->list[0]->main->temp_min, 1);
$maxTemp = number_format($clima->list[0]->main->temp_max, 1);
$humidity = $clima->list[0]->main->humidity;
$windSpeed = $clima->list[0]->wind->speed;
$windDegree = $clima->list[0]->wind->deg;
$visibility = $clima->list[0]->visibility;
$visiblity = $visibility * 0.001;
$cloud = $clima->list[0]->clouds->all;
$dayTime = date("l, H:i", $timestamp);

$city = $clima->city->name;
$country = $clima->city->country;





$clima = json_decode($contents, true);

if ($clima === null || !isset($clima['list'])) {
    // Handle API response error or missing data
    echo "Error: Unable to fetch weather data.";
} else {
    $minMaxTemps = [];

    foreach ($clima['list'] as $forecast) {
        $date = date('Y-m-d', strtotime($forecast['dt_txt']));
        $temp = $forecast['main']['temp'];

        if (!isset($minMaxTemps[$date])) {
            $minMaxTemps[$date] = [
                'min_temp' => $temp,
                'max_temp' => $temp,
            ];
        } else {
            if ($temp < $minMaxTemps[$date]['min_temp']) {
                $minMaxTemps[$date]['min_temp'] = $temp;
            }
            if ($temp > $minMaxTemps[$date]['max_temp']) {
                $minMaxTemps[$date]['max_temp'] = $temp;
            }
        }
    }

    // Displaying the min and max temps for the first date of each day
    $previousDate = null;
    $i = 0;
    foreach ($clima['list'] as $forecast) {
        $date = date('Y-m-d', strtotime($forecast['dt_txt']));


        if ($date !== $previousDate) {

            $day = date('D', strtotime($date));
            $dayS[$i] = $day;
            $min_tempS[$i] = number_format($minMaxTemps[$date]['min_temp'], 1);
            $max_tempS[$i] = number_format($minMaxTemps[$date]['max_temp'], 1);
            $previousDate = $date;
            $i++;

        }

    }
}















?>
























<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div id="Container">

        <div id="Sidebar">

            <div id="STop">

                <div class="card" style="width: 18rem;" id="side-top-card">
                    <div class="card-body">

                        <div id="top_image"><img src="img/top_left.png" alt="" width="50%"></div>
                        <br>
                        <p class="card-text" id="Today_temp">
                            <?php echo $temperature; ?> °C
                        </p>
                        <p class="card-text" id="Today_daytime">
                            <?php echo $dayTime; ?>
                        </p>

                    </div>
                </div>
            </div>
            <div id="SMid">
                <div class="card" style="width: 18rem;" id="side-top-card">
                    <div class="card-body">

                        <p class="card-text">Feels like:
                            <?php echo $feelsLike; ?> °C
                        </p>
                        <p class="card-text"> Min:
                            <?php echo $minTemp; ?> °C
                        </p>
                        <p class="card-text"> Max:
                            <?php echo $maxTemp; ?> °C
                        </p>

                    </div>
                </div>
            </div>
            <div id="SLow">
                <div class="card" style="width: 18rem;" id="side-top-card">
                    <div class="card-body">

                        <p class="card-text">
                            <?php echo $city . ", " . $country; ?>
                        </p>

                    </div>
                </div>
            </div>
        </div>

        <div id="RightBody">
            <div id="Week">
                <div id="Nav">
                    <p id="week"><b><u>Week</u></b></p>
                    <p id="temp"><b>°C</b></p>
                </div>
                <div id="WeekDayTepms">
                    <div class="card" style="width: 18rem;" id="side-top-card">
                        <div class="card-body">

                            <p class="card-text">
                                <?php echo $dayS[1]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $min_tempS[1]; ?> °C
                            </p>
                            <p class="card-text">
                                <?php echo $max_tempS[1]; ?> °C
                            </p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem;" id="side-top-card">
                        <div class="card-body">

                            <p class="card-text">
                                <?php echo $dayS[2]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $min_tempS[2]; ?> °C
                            </p>
                            <p class="card-text">
                                <?php echo $max_tempS[2]; ?> °C
                            </p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem;" id="side-top-card">
                        <div class="card-body">

                            <p class="card-text">
                                <?php echo $dayS[3]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $min_tempS[3]; ?> °C
                            </p>
                            <p class="card-text">
                                <?php echo $max_tempS[3]; ?> °C
                            </p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem;" id="side-top-card">
                        <div class="card-body">

                            <p class="card-text">
                                <?php echo $dayS[4]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $min_tempS[4]; ?> °C
                            </p>
                            <p class="card-text">
                                <?php echo $max_tempS[4]; ?> °C
                            </p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem;" id="side-top-card">
                        <div class="card-body">

                            <p class="card-text">
                                <?php echo $dayS[5]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $min_tempS[5]; ?> °C
                            </p>
                            <p class="card-text">
                                <?php echo $max_tempS[5]; ?> °C
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div id="Highlights">
                <br>
                <div id="Heading">
                    <b><u>Today's Highlights</u></b>
                </div>
                <div id="TodayHighlights">
                    <div class="card" style="width: calc(50% - 2%);">
                        <div class="card-body">
                            <p class="card-text">
                            <h5 style="text-align: center;"><u>Humidity</u>
                            </h5>
                            </p>

                            <p class="card-text">
                            <h4 style="text-align: center;">
                                <?php echo $humidity; ?>%
                            </h4>
                            </p>
                            <p class="card-text">
                            <div class="progress" role="progressbar" aria-label="Humidity example"
                                aria-valuenow="<?php echo $humidity; ?>" aria-valuemin="0" aria-valuemax="100">

                                <div class="progress-bar <?php echo $colorClass; ?> text-bg-warning"
                                    style="width: <?php echo $humidity; ?>%; <?php echo ($humidity > 50) ? 'background-color: red; color: black;' : 'background-color: greenyellow; color: black;'; ?>">
                                    <?php echo $humidity; ?>%
                                </div>
                            </div>

                            </p>
                        </div>
                    </div>
                    <div class="card" style="width: calc(50% - 2%);">
                        <div class="card-body">
                            <p class="card-text">
                            <h5 style="text-align: center;"><u>Wind Speed</u></h5>
                            </p>
                            <p class="card-text">
                                <h4 style="text-align: center;"><?php echo $windSpeed; ?> km/h
                                </h4>
                               
                            </p>
                            <br>
                            <p class="card-text"><iconify-icon icon="codicon:compass"></iconify-icon>
                                <?php echo $windDegree; ?>°
                            </p>
                        </div>
                    </div>
                    <div class="card" style="width: calc(50% - 2%);">
                        <div class="card-body">
                            <p class="card-text">
                            <h5 style="text-align: center;"><u>Visiblity</u></h5>
                            </p>
                            <p class="card-text">
                                <h4 style="text-align: center;"><?php echo $visiblity; ?> km
                                </h4>
                                
                            </p>
                            <p class="card-text">
                            <div class="progress" role="progressbar" aria-label="Visiblity example"
                                aria-valuenow="<?php echo $visibility; ?>" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar <?php echo $colorClass; ?> text-bg-warning"
                                    style="width: <?php echo $visiblity * 10; ?>%; <?php echo ($visiblity * 10 > 50) ? 'background-color: greenyellow; color: black;' : 'background-color: red; color: black;'; ?>">
                                    <?php echo $visiblity * 10; ?>%
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>
                    <div class="card" style="width: calc(50% - 2%);">
                        <div class="card-body">
                            <p class="card-text">
                            <h5 style="text-align: center;"><u>Cloud</u></h5>
                            </p>
                            <p class="card-text">
                            <h5 style="text-align: center;">
                                <?php echo $cloud; ?>%
                            </h5>
                            </p>
                            <p class="card-text">
                            <div class="progress" role="progressbar" aria-label="Cloud example"
                                aria-valuenow="<?php echo $cloud; ?>" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar <?php echo $colorClass; ?> text-bg-warning"
                                    style="width: <?php echo $cloud; ?>%; <?php echo ($cloud < 20) ? 'background-color: white ;color: black;' : (($cloud >= 20 && $cloud <= 70) ? 'background-color: lightblue; color: black;' : 'background-color: #6a6d6d; color: black;') ?>">
                                    <?php echo $cloud; ?>%
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>


    </div>

</body>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

</html>