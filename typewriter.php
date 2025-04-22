<?php

require './BottlesOfBeerLyrics.php';

$lyrics = new BottlesOfBeerLyrics(99);
echo $lyrics->title();
$lyrics->typewriter($lyrics->sing());
