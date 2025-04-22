<?php

require './bottles_of_beer_lyrics_printer.php';

$singer = new BottlesOfBeerLyrics(start: 99, end: 0);
print $singer->title();
print $singer->sing($start, $end);
