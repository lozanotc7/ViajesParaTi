<?php

namespace App\Tests\Entity;

use App\Entity\Proveedor;
use PHPUnit\Framework\TestCase;

class ProveedorTest extends TestCase
{
    public function testSetEmailException()
    {
        $this->expectException("Exception");

        (new Proveedor())
            ->setEmail("notAnEmail");
    }

    public function testSetPhoneException()
    {
        $this->expectException("Exception");

        (new Proveedor())
            ->setPhone("notANumber");
    }

    public function testSetEmailAndPhone()
    {
        $email = 'aaa@bbbb.com';
        $phone = '654987321';

        $proveedor = (new Proveedor())
            ->setEmail($email)
            ->setPhone($phone);

        self::assertEquals($email, $proveedor->getEmail());
        self::assertEquals($phone, $proveedor->getPhone());
    }
}
