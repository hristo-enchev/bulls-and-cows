<?php

namespace App\Http\Traits;
use Exception;

trait GenereteNumberTrait
{
    private array $numbers  = [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        9 => 9
    ];

    private array $oddPositionNumbers = [4, 5];

    /**
     * Get unique number with applied criterias
     *
     * @param int $length
     * @return int
     */
    public function getSecretNumber(int $length = 4): int
    {
        $valid = false;
        $number = null;

        while (!$valid) {
            $number = $this->genereteNumberArray($length);

            $valid = $this->validateOddNumbers($number);
        }

        return (int) implode('', $number);
    }

    /**
     * Generate a number with non-repeatable numbers and additional criteria between 1 and 10 numbers
     *
     * @param int $length
     * @return array
     */
    private function genereteNumberArray(int $length = 4): array
    {
        if ($length < 1 || $length > 10) {
            throw new Exception('Invalid input');
        }

        $generetedNumber = [];
        $nextToEachInUseIndex = null;
        $numbers = $this->numbers;

        while (count($generetedNumber) < $length) {
            $number = array_rand($numbers, 1);

            switch ($number) {
                case 1:
                case 8:
                    if ($nextToEachInUseIndex !== null) {
                        array_splice($generetedNumber, $nextToEachInUseIndex, 0, $number);
                    } else {
                        $generetedNumber[] = $number;

                        $nextToEachInUseIndex = count($generetedNumber) - 1;
                    }

                    break;
                case 4:
                case 5:
                    if (count($generetedNumber) % 2 === 1) {
                        continue 2;
                    }

                    $generetedNumber[] = $number;

                    break;
                default:
                    $generetedNumber[] = $number;

                    break;
            }

            unset($numbers[$number]);
        }

        return $generetedNumber;
    }

    /**
     * Validate number array for specific index
     *
     * @param array $number
     * @return bool
     */
    private function validateOddNumbers(array $number): bool
    {
        $valid = true;

        foreach ($number as $key => $value) {
            if ($key % 2 === 1 && in_array($value, $this->oddPositionNumbers)) {
                $valid = false;

                break;
            }
        }

        return $valid;
    }
}
