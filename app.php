<?php

spl_autoload_register(function($className) {
    $file = 'class' . DIRECTORY_SEPARATOR . $className . '.php';
    if (file_exists($file)) {
        include $file;
    }
    for ($i = 1; $i <= 24; $i++) {
        $file = 'day' . $i . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($file)) {
            include $file;
        }
    }
});

if (isset($argv[1]) && class_exists($argv[1])) {
    $input = $argv[1] . DIRECTORY_SEPARATOR . "input.txt";
    $solution = new $argv[1]($input);
    echo 'Part 1: ' . $solution->partOne() . PHP_EOL;
    echo 'Part 2: ' . $solution->partTwo();
} else {
    echo 'Valid day required as an argument.';
}

