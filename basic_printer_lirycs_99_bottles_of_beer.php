<?php

for ($bottles = 99; $bottles >= 0; $bottles--) {
    if ($bottles > 1) {
        echo "$bottles bottles of beer on the wall, $bottles bottles of beer.\n";
        $next = $bottles - 1;
        echo "Take one down and pass it around, $next " . ($next === 1 ? "bottle" : "bottles") . " of beer on the wall.\n\n";
    } elseif ($bottles === 1) {
        echo "1 bottle of beer on the wall, 1 bottle of beer.\n";
        echo "Take one down and pass it around, no more bottles of beer on the wall.\n\n";
    } else {
        echo "No more bottles of beer on the wall, no more bottles of beer.\n";
        echo "Go to the store and buy some more, 99 bottles of beer on the wall.\n";
    }
}
