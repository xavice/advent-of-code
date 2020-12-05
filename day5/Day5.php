<?php


class Day5 extends Solution
{
    private $seatRowsMin = 0;
    private $seatRowsMax = 127;
    private $seatColsMin = 0;
    private $seatColsMax = 7;

    public function __construct($inputFile)
    {
        parent::__construct($inputFile);
    }

    public function partOne()
    {
        $highest = 0;

        foreach ($this->inputFile as $seat) {
            $seatCoords = $this->decodeSeat($seat);
            $result = $seatCoords['row'] * 8 + $seatCoords['col'];
            $highest = $highest < $result ? $result : $highest;
        }

        return $highest;
    }

    public function partTwo()
    {
        $seats = [];
        foreach ($this->inputFile as $seat) {
            $seatCoords = $this->decodeSeat($seat);
            $seats[$seatCoords['row']][] = $seatCoords['col'];
        }

        $return = [];
        foreach ($seats as $row => $cols) {
            if (count($cols) < 8 && $row > 1 && $row !== count($seats)) {
                $return = [
                    'row' => $row,
                    'cols' => $cols,
                ];
            }
        }
        $findMissingCol = range(0, 7);
        foreach ($return['cols'] as $col) {
            if (($key = array_search($col, $findMissingCol)) !== false) {
                unset($findMissingCol[$key]);
            }
        }
        $return['col'] = reset($findMissingCol);
        return $return['row'] * 8 + $return['col'];
    }

    private function decodeSeat($seat)
    {
        $matches = [];
        preg_match('/([F|B]{7})([L|R]{3})/', $seat, $matches);

        $rows = [];
        $cols = [];

        if (isset($matches[1]) && isset($matches[2])) {
            $rows = str_split($matches[1]);
            $cols = str_split($matches[2]);
        }

        $currentRow = $this->getNextNode($this->seatRowsMin, $this->seatRowsMax, $rows);
        $currentCol = $this->getNextNode($this->seatColsMin, $this->seatColsMax, $cols);

        return [
            'row' => $currentRow,
            'col' => $currentCol,
        ];
    }

    private function getNextNode($min, $max, $rows)
    {
        $return = null;
        $direction = array_shift($rows);

        // left
        if ($direction === 'F' || $direction === 'L') {
            $return = $max = floor(($min + $max) / 2);
        }

        //right
        if ($direction === 'B' || $direction === 'R') {
            $return = $min = ceil(($min + $max) / 2);
        }

        if (empty($rows)) {
            return $return;
        }

        return $this->getNextNode($min, $max, $rows);
    }


}