<?php
namespace PhpKatas\Test;

use PhpKatas\StringCalculator;
use PHPUnit\Framework\TestCase;

/**
 * @author: Jose Manuel Orts
 * @date: 09/09/2018
 */
class StringCalculatorTest extends TestCase
{
    /**
     * @var StringCalculator
    */
    public $sut;

    protected function setUp()
    {
        parent::setUp();
        $this->sut = new StringCalculator();
    }


    public function testShouldBeCreated()
    {
        self::assertInstanceOf(StringCalculator::class, $this->sut);
    }

    public function testShouldReturnZero()
    {
        $expectedSum = 0;

        static::assertEquals($expectedSum, $this->sut->add(''));
    }

    public function testShouldReturnInvocationParameter()
    {
        $number = '18';
        $expectedSum = $number;

        static::assertEquals($expectedSum, $this->sut->add($number));
    }

    public function testShouldReturnSumOfTwoInvocationParameters()
    {
        $numberA = '8';
        $numberB = '10';
        $expectedSum = (int) $numberA + (int) $numberB;

        static::assertEquals($expectedSum, $this->sut->add("{$numberA};{$numberB}"));
    }

    /**
     * @dataProvider differentAmountOfNumbersAndDelimitersProvider
    */
    public function testShouldReturnSumOfAllNumbersInString($numbersString, $expectedSum)
    {

        static::assertEquals($expectedSum, $this->sut->add($numbersString));
    }

    public function testShouldReturnSumOfAllNumberInAStringUnderstandingNewLines()
    {
        $numberA = '2000';
        $numberB = '10';
        $numberC = '8';
        $expectedSum = (int) $numberA + (int) $numberB + (int) $numberC;

        static::assertEquals($expectedSum, $this->sut->add("{$numberA}\n {$numberB}; {$numberC}"));
    }

    /**
     * @dataProvider  nonValidInputsProvider
    */
    public function testShouldReturnZeroBecauseNewLineAndNoNumber($expectedSum, $nonValidInput)
    {
        static::assertEquals($expectedSum, $this->sut->add($nonValidInput));
    }

    public function testShouldChangeDelimiter()
    {
        $numberA = '2000';
        $numberB = '10';
        $numberC = '8';
        $expectedSum = (int) $numberA + (int) $numberB + (int) $numberC;

        static::assertEquals($expectedSum, $this->sut->add(",\n{$numberA}\n {$numberB}, {$numberC}"));
    }

    public function testShouldThrowAnExceptionNegativeNumberInString()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Negatives not allowed: -2');

        $this->sut->add(",\n1\n 2, -2");
    }

    public function testShouldThrowAnExceptionNegativeNumbersInString()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Negatives not allowed: -4, -2, -5');

        $this->sut->add(",\n1\n -4, -2\n5,-5");
    }


    public function differentAmountOfNumbersAndDelimitersProvider()
    {
        return [
            ['10; 10; 10', 30],
            [",\n2,2,2,2,2", 10],
            [",\n8,8,8,8,8,8,8,8,8", 72],
            [",\n8 , 8,8\n 8,8,8,8,8,8,2\n3 ,4,5,6", 92],
            [":\n8 : 8:8\n 8:5:6", 43],
            ["+\n8 + 8+8\n 8+5+6", 43]
        ];
    }

    public function nonValidInputsProvider()
    {
        return [
            [0, "2 ;\n"],
            [0, "2;\n4"],
            [0, "2 ;\n;9"],
        ];
    }
}
