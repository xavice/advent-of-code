<?php


class Day1 extends Solution
{
    public function partOne()
    {
        $pair = $this->findPairsForNumberFromArray(2020);
        return array_product($pair);
    }

    public function partTwo()
    {
        foreach ($this->inputFile as $item) {
            $semiResult = 2020 - $item;
            $results = $this->findPairsForNumberFromArray($semiResult);
            if ($results) {
                $results[] = $item;
                return array_product($results);
            }
        }
    }

    private function findPairsForNumberFromArray($needle) {
        foreach ($this->inputFile as $item) {
            $need = $needle - $item;
            if (in_array($need, $this->inputFile)) {
                return [
                    $need,
                    $item
                ];
            }
        }
        return false;
    }
}