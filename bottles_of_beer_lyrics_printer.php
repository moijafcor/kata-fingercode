<?php


class BottlesOfBeerLyrics
{
    const MAX_BOTTLES = 99;
    const MIN_BOTTLES = 0;

    public function sing($start, $end = self::MIN_BOTTLES)
    {
        if ($start < self::MIN_BOTTLES || $start > self::MAX_BOTTLES) {
            throw new InvalidArgumentException("Start number must be between " . self::MIN_BOTTLES . " and " . self::MAX_BOTTLES);
        }
        if ($end < self::MIN_BOTTLES || $end > self::MAX_BOTTLES) {
            throw new InvalidArgumentException("End number must be between " . self::MIN_BOTTLES . " and " . self::MAX_BOTTLES);
        }

        return $this->verses($start, $end);
    }

    public function verse($number)
    {
        return $this->verseWithNumber($number);
    }

    public function verses($start, $end)
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
            $this->onTheWall(),
            $this->bottles($number),
            $this->takeOneDown(),
            $this->bottles($number - 1),
            $this->onTheWall()
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

    private function onTheWall()
    {
        return 'of beer';
    }

    private function takeOneDown()
    {
        return 'Take one down and pass it around';
    }
}
