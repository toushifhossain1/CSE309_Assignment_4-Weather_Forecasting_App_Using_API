<?php

$url = "https://api.openweathermap.org/data/2.5/forecast?lat=23.7104&lon=90.4074&appid=2471bc340f047b455a212540e36efe24&units=metric";

$contents = file_get_contents($url);
$clima = json_decode($contents);


$temperature = $clima->list[0]->main->temp;
$timestamp = $clima->list[0]->dt;
$feelsLike = $clima->list[0]->main->feels_like;
$minTemp = $clima->list[0]->main->temp_min;
$maxTemp = $clima->list[0]->main->temp_max;

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
            $min_tempS[$i] = $minMaxTemps[$date]['min_temp'];
            $max_tempS[$i] = $minMaxTemps[$date]['max_temp'];
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
                                <?php echo $min_tempS[1]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $max_tempS[1]; ?>
                            </p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem;" id="side-top-card">
                        <div class="card-body">

                            <p class="card-text">
                                <?php echo $dayS[2]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $min_tempS[2]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $max_tempS[2]; ?>
                            </p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem;" id="side-top-card">
                        <div class="card-body">

                            <p class="card-text">
                                <?php echo $dayS[3]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $min_tempS[3]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $max_tempS[3]; ?>
                            </p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem;" id="side-top-card">
                        <div class="card-body">

                            <p class="card-text">
                                <?php echo $dayS[4]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $min_tempS[4]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $max_tempS[4]; ?>
                            </p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem;" id="side-top-card">
                        <div class="card-body">

                            <p class="card-text">
                                <?php echo $dayS[5]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $min_tempS[5]; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $max_tempS[5]; ?>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div id="Highlights">
                <div id="Heading">
                    <b>Today's Highlights</b>
                </div>
                <div id="TodayHighlights">
                    <div class="card" style="width: calc(50% - 2%);">
                        <div class="card-body">
                            <p class="card-text">Day</p>
                            <p class="card-text">Min</p>
                            <p class="card-text">Max</p>
                        </div>
                    </div>
                    <div class="card" style="width: calc(50% - 2%);">
                        <div class="card-body">
                            <p class="card-text">Day</p>
                            <p class="card-text">Min</p>
                            <p class="card-text">Max</p>
                        </div>
                    </div>
                    <div class="card" style="width: calc(50% - 2%);">
                        <div class="card-body">
                            <p class="card-text">Day</p>
                            <p class="card-text">Min</p>
                            <p class="card-text">Max</p>
                        </div>
                    </div>
                    <div class="card" style="width: calc(50% - 2%);">
                        <div class="card-body">
                            <p class="card-text">Day</p>
                            <p class="card-text">Min</p>
                            <p class="card-text">Max</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>


    </div>

</body>

</html>