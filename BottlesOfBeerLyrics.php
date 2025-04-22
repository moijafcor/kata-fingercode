<?php

/**
 * @see https://www.99-bottles-of-beer.net/lyrics.html
 */
class BottlesOfBeerLyrics
{
    const MAX_BOTTLES = 99;
    const MIN_BOTTLES = 0;

    private $start;
    private $end;

    /**
     * You can set the start and end number of bottles, just for fun.
     * The default is 99 to 0.
     *
     * @param integer $start
     * @param integer $end
     */
    public function __construct(int $start, int $end = self::MIN_BOTTLES)
    {
        if ($start < self::MIN_BOTTLES || $start > self::MAX_BOTTLES) {
            throw new InvalidArgumentException("Start number must be between " . self::MIN_BOTTLES . " and " . self::MAX_BOTTLES);
        }
        if ($end < self::MIN_BOTTLES || $end > self::MAX_BOTTLES) {
            throw new InvalidArgumentException("End number must be between " . self::MIN_BOTTLES . " and " . self::MAX_BOTTLES);
        }
        $this->start = $start;
        $this->end = $end;
    }

    public function title()
    {
        return 'Lyrics to "99 Bottles of beer on the wall"' . "\n\n";
    }

    private function verses()
    {
        $verses = [];
        for ($i = $this->start; $i >= $this->end; $i--) {
            if ($i === 0) {
                $verses[] = $this->verseOutOfBeer();
                continue;
            }
            $verses[] = $this->verseWithNumber($i);
        }
        return implode("\n", $verses);
    }

    /**
     * Generates the verse for a given number of bottles.
     * 
     * " 99 bottles of beer on the wall, 99 bottles of beer.
     * " Take one down and pass it around, 98 bottles of beer on the wall.
     * ...
     * " No more bottles of beer on the wall, no more bottles of beer.
     * " Go to the store and buy some more, 99 bottles of beer on the wall.
     *
     * @param integer $number
     * @return string
     */
    private function verseWithNumber(int $number): string
    {
        return sprintf(
            "%s %s on the wall, %s." . "\n" .  "%s %s %s.\n",
            $this->bottles($number),
            $this->ofBeer(),
            $this->bottles($number),
            $this->takeOneDown(),
            $this->bottles($number - 1),
            $this->ofBeer()
        );
    }

    /**
     * Generates the verse for the last bottle.
     * 
     * " No more bottles of beer on the wall, no more bottles of beer.
     * " Go to the store and buy some more, 99 bottles of beer on the wall.
     *
     * @return string
     */
    private function verseOutOfBeer(): string
    {
        return sprintf(
            "No more bottles of beer on the wall, no more bottles of beer." . "\n" .
                "Go to the store and buy some more, %s bottles of beer on the wall.\n",
            $this->start
        );
    }

    private function bottles($number)
    {
        if ($number === 0) {
            return 'No more bottles';
        } elseif ($number === 1) {
            return '1 bottle';
        } else {
            return "$number bottles";
        }
    }

    private function ofBeer()
    {
        return 'of beer';
    }

    private function takeOneDown()
    {
        return 'Take one down and pass it around';
    }

    public function sing()
    {
        return $this->verses();
    }
}
