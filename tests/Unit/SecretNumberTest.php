<?php

namespace Tests\Unit;

use App\Http\Traits\GenereteNumberTrait;
use PHPUnit\Framework\TestCase;

class SecretNumberTest extends TestCase
{
    use GenereteNumberTrait;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_number()
    {
        for ($i = 0; $i <  1000; $i++) {
            $number = $this->getSecretNumber();

            foreach (str_split($number) as $key => $value) {
                if ($key % 2 === 1 && in_array($value, $this->oddPositionNumbers)) {
                    $this->assertTrue(false);

                    break;
                }
            }
        }

        $this->assertTrue(true);
    }
}
