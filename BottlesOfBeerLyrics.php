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

    private function verse($number)
    {
        return $this->verseWithNumber($number);
    }

    private function verses($start, $end)
    {
        $verses = [];
        for ($i = $start; $i >= $end; $i--) {
            $verses[] = $this->verseWithNumber($i);
        }
        return implode("\n", $verses);
    }

    private function verseWithNumber($number)
    {
        return sprintf(
            "%s %s on the wall, %s %s.\n%s %s.\n",
            $this->bottles($number),
            $this->ofBeer(),
            $this->bottles($number),
            $this->takeOneDown(),
            $this->bottles($number - 1),
            $this->ofBeer()
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
        return $this->verses($this->start, $this->end);
    }
}
