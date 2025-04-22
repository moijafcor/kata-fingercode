<?php

/**
 * @see https://www.99-bottles-of-beer.net/lyrics.html
 */
class BottlesOfBeerLyrics
{
    /**
     * The maximum number of bottles to honour the song's lyrics.
     */
    const MAX_BOTTLES = 99;

    /**
     * The minimum number of bottles to honour the song's lyrics.
     */
    const MIN_BOTTLES = 0;

    /**
     * The start number of bottles; no bigger than MAX_BOTTLES.
     */
    private int $start;

    /**
     * The end number of bottles; no smaller than MIN_BOTTLES.
     */
    private int $end;

    /**
     * You can set the start and end number of bottles, just for fun!
     * The default is 99 to 0.
     *
     * @param integer $start
     * @param integer $end
     * @throws InvalidArgumentException
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

    /**
     * Title of the song.
     *
     * @return string
     */
    public function title(): string
    {
        if ($this->start === self::MAX_BOTTLES && $this->end === self::MIN_BOTTLES) {
            return 'Lyrics to "99 Bottles of Beer on the Wall"' . "\n\n";
        } else {
            return "$this->start Bottles of Beer on the Wall" . "\n\n";
        }
    }

    /**
     * Generates the lyrics for the song.
     *
     * @return string
     */
    private function verses(): string
    {
        $verses = [];
        for ($i = $this->start; $i >= $this->end; $i--) {
            if ($i === $this->end) {
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

    /**
     * Generates the string for the number of bottles.
     *
     * @param integer $number
     * @return string
     */
    private function bottles($number): string
    {
        if ($number === 0) {
            return 'No more bottles';
        } elseif ($number === 1) {
            return '1 bottle';
        } else {
            return "$number bottles";
        }
    }

    /**
     * Generates the string "of beer".
     *
     * @return string
     */
    private function ofBeer(): string
    {
        return 'of beer';
    }

    /**
     * Generates the string "Take one down and pass it around".
     *
     * @return string
     */
    private function takeOneDown(): string
    {
        return 'Take one down and pass it around';
    }

    /**
     * Prints out the song lyrics.
     *
     * @return string
     */
    public function sing(): string
    {
        return $this->verses();
    }

    /**
     * Simulates a typewriter effect when printing the song.
     *
     * @param string $text
     * @param int $speed Base delay in microseconds between characters (default: 50_000 = 0.05s)
     * @return void
     */
    public function typewriter(string $text, int $speed = 50000): void
    {
        foreach (str_split($text) as $char) {
            echo $char;
            usleep($this->delayForCharacter($char, $speed));
        }
    }

    /**
     * Calculates delay based on character.
     * Adds more pause for periods, commas, newlines, etc.
     *
     * @param string $char
     * @param int $base
     * @return int
     */
    private function delayForCharacter(string $char, int $base): int
    {
        return match ($char) {
            '.', '!', '?' => $base * 12,
            ',', ';', ':' => $base * 6,
            "\n" => $base * 8,
            default => $base,
        };
    }
}
