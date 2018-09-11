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

    public function testShouldReturnEmptyString()
    {
        static::assertEmpty($this->sut->add(""));
    }
}
