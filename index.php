<?php

$url = "https://api.openweathermap.org/data/2.5/forecast?lat=23.7104&lon=90.4074&appid=2471bc340f047b455a212540e36efe24&units=metric";

$contents = file_get_contents($url);
$clima = json_decode($contents);

?>