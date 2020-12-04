<?php


class Day2 extends Solution
{
    public function partOne()
    {
        $validPassCount = 0;

        foreach ($this->inputFile as $line) {
            $explode = explode(' ', $line);
            $range = $explode[0];
            $rangeExplode = explode('-', $range);
            $min = $rangeExplode[0];
            $max = $rangeExplode[1];
            $char = rtrim($explode[1], ':');
            $pass = $explode[2];

            $charOccurrences = substr_count($pass, $char);
            if (($min <= $charOccurrences) && ($charOccurrences <= $max)) {
                $validPassCount++;
            }
        }
        return $validPassCount;
    }

    public function partTwo()
    {
        $validPassCount = 0;
        foreach ($this->inputFile as $line) {
            $explode = explode(' ', $line);
            $positions = $explode[0];
            $positionExplode = explode('-', $positions);
            $pos1 = --$positionExplode[0];
            $pos2 = --$positionExplode[1];
            $char = rtrim($explode[1], ':');
            $pass = $explode[2];

            $passArray = str_split($pass);

            if ($passArray[$pos1] === $char xor $passArray[$pos2] === $char) {
                $validPassCount++;
            }
        }
        return $validPassCount;
    }
}