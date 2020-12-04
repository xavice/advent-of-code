<?php


class Day3 extends Solution
{

    private $tree = '#';
    private $maxCol = 31;

    public function __construct($inputFile)
    {
        parent::__construct($inputFile);
        ini_set('xdebug.max_nesting_level', 1024);
    }

    public function partOne()
    {
        $counter = 0;
        $this->traverse(0, 0, 3, 1, $counter);
        return $counter;
    }

    public function partTwo()
    {
        $counter = 0;
        $this->traverse(0, 0, 3, 1, $counter);
        $product[] = $counter;

        $counter = 0;
        $this->traverse(0, 0, 1, 1, $counter);
        $product[] = $counter;

        $counter = 0;
        $this->traverse(0, 0, 5, 1, $counter);
        $product[] = $counter;

        $counter = 0;
        $this->traverse(0, 0, 7, 1, $counter);
        $product[] = $counter;

        $counter = 0;
        $this->traverse(0, 0, 1, 2, $counter);
        $product[] = $counter;

        return array_product($product);
    }

    private function traverse($currentCol, $currentRow, $traverseRight, $traverseBottom, &$counter) {

        if ($this->checkTree($currentCol,$currentRow) ) {
            $counter++;
        }

        $nextCol = $currentCol + $traverseRight;
        $nextRow = $currentRow + $traverseBottom;

        if (count($this->inputFile) > $nextRow) {
            $this->traverse($nextCol, $nextRow, $traverseRight, $traverseBottom, $counter);
        }
    }

    private function checkTree($currentCol, $currentRow) {
        $currentTiles = $this->inputFile[$currentRow];
        $currentTilePosition = $currentCol % $this->maxCol;
        return $currentTiles[$currentTilePosition] === $this->tree;
    }
}