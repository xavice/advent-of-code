<?php


abstract class Solution
{
    protected $inputFile;

    public function __construct($inputFile)
    {
        $this->inputFile =  file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    public function partOne() {}
    public function partTwo() {}

}