<?php

require './BottlesOfBeerLyrics.php';

$lyrics = new BottlesOfBeerLyrics(99);
echo $lyrics->title();
//Options: 'slow' 0.1 sec, 'normal' 0.05 sec, 'fast' 0.015 sec
$lyrics->typewriter($lyrics->sing(), 'fast');
