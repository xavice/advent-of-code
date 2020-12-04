<?php


class Day4 extends Solution
{
    /**
     * @var array
     */
    private $passports;

    public function __construct($inputFile)
    {
        $handle = fopen($inputFile, 'r');
        $passports = array();
        $currentPassport = '';
        while (!feof($handle)) {
            $line = fgets($handle);
            if (trim($line) == '') {
                if ($currentPassport) {
                    $passports[] = $this->mapPassportParams(trim($currentPassport));
                    $currentPassport = '';
                }
            } else {
                $currentPassport .= trim($line) . ' ';
            }
        }
        fclose($handle);

        // if is anything left
        if ($currentPassport) {
            $passports[] = $currentPassport;
        }
        $this->passports = $passports;
    }

    public function partOne()
    {
        $validPassports = 0;
        foreach ($this->passports as $currentPassport) {
            if ($this->validatePassport($currentPassport, false)) {
                $validPassports++;
            }
        }

        return $validPassports;
    }

    public function partTwo()
    {
        $validPassports = 0;
        foreach ($this->passports as $currentPassport) {
            if ($this->validatePassport($currentPassport)) {
                $validPassports++;
            }
        }

        return $validPassports;
    }

    private function mapPassportParams($string) {
        $params = array();
        $explode = explode(' ', $string);
        foreach ($explode as &$item) {
            list($key, $value) = explode(':', $item);
            $params[$key] = $value;
        }
        return $params;
    }

    private function validatePassport($passport, $validaRules = true) {
        $required = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];

        foreach ($required as $reqParam) {
            if (!isset($passport[$reqParam]) || ($validaRules && ((isset($passport[$reqParam]) && !$this->validateParam($reqParam, $passport[$reqParam]))))) {
                return false;
            }
        }
        return true;
    }

    private function validateParam($param, $value) {

        $valid = false;

        switch ($param) {
            case 'byr':
                $valid = (strlen($value) === 4) && (1920 <= $value && $value <= 2002);
                break;
            case 'iyr':
                $valid = (strlen($value) === 4) && (2010 <= $value && $value <= 2020);
                break;
            case 'eyr':
                $valid = (strlen($value) === 4) && (2020 <= $value && $value <= 2030);
                break;
            case 'hgt':
                if (strpos($value, 'cm') !== false && (150 <= $value && $value <= 193)) {
                    $valid = true;
                }
                if (strpos($value, 'in') !== false && (59 <= $value && $value <= 76)) {
                    $valid = true;
                }
                break;
            case 'hcl':
                $matches = [];
                preg_match('/^#(?:[0-9a-fA-F]{3}){1,2}$/', $value, $matches);
                $valid = !empty($matches);
                break;
            case 'ecl':
                $hairColors = ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'];
                $valid = in_array($value, $hairColors);
                break;
            case 'pid':
                $valid = strlen($value) === 9 && is_numeric($value);
                break;
        }

        return $valid;
    }
}