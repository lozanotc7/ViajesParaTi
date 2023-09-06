<?php

namespace App\Tests\App\ValueObjects;

use App\App\ValueObjects\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testValidEmails()
    {
        self::assertInstanceOf(Email::class,  new Email('aaaa@aaaaaa.com'));
        self::assertInstanceOf(Email::class,  new Email('bbbb.3333.bbbb@bbbbbb.com'));
        self::assertInstanceOf(Email::class,  new Email('cccc@cccccc.cccc.com'));
    }

    public function testNeedAtException()
    {
        $this->expectException('Exception');
        new Email('aaaaa.aaaaa.com');
    }

    public function testNeedOnlyOneAtException()
    {
        $this->expectException('Exception');
        new Email('aaaaa@aaaaa@aaaaa.com');
    }

    public function testNeedDomainException()
    {
        $this->expectException('Exception');
        new Email('aaaaa.@aaaaa');
    }
    public function testNeedNameException()
    {
        $this->expectException('Exception');
        new Email('@aaaaa.aaaaa.com');
    }

    public function testName()
    {
        $email = new Email('aaaaa@aaaaa.com');
        self::assertEquals('aaaaa', $email->getName());
    }

    public function testDomain()
    {
        $email = new Email('AAAA@aaaaa.com');
        self::assertEquals('aaaaa.com', $email->getDomain());
    }

    public function testAsString()
    {
        $email = new Email('AAAA@aaaaa.com');
        self::assertEquals('aaaa@aaaaa.com', "$email");
    }
}
