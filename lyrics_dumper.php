<?php

require './BottlesOfBeerLyrics.php';

$singer = new BottlesOfBeerLyrics(start: 99, end: 0);
print $singer->title();
print $singer->sing();
