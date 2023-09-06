<?php

namespace App\Tests\App\ValueObjects;

use App\App\ValueObjects\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    public function test_is_a_telephone()
    {
        self::assertInstanceOf(Phone::class, new Phone('+44123 456789'));
        self::assertInstanceOf(Phone::class, new Phone('0034923456789'));
        self::assertInstanceOf(Phone::class, new Phone('912456789'));
        self::assertInstanceOf(Phone::class, new Phone('612456789'));
        self::assertInstanceOf(Phone::class, new Phone('712456789'));
        self::assertInstanceOf(Phone::class, new Phone('611 11 11 11'));
    }

    public function testNoLettersException()
    {
        $this->expectException('Exception');
        new Phone('0034asdf931654987');
    }

    public function testInvoke()
    {
        $Phone = new Phone('+34987654321');

        self::assertEquals('+34987654321', $Phone());
    }

    public function testToStringWithoutSpaces()
    {
        $Phone = new Phone('9 8 7 6 5 4 3 2 1');

        self::assertEquals('987654321', "{$Phone}");
    }

}
