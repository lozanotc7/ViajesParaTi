<?php

namespace App\Tests\Entity;

use App\Entity\Tipo;
use PHPUnit\Framework\TestCase;

class TipoTest extends TestCase
{

    public function testSetNameEmptyException()
    {
        $tipo = new Tipo();

        self::expectException("TypeError");
        /** @noinspection PhpParamsInspection */
        $tipo->setName();
    }

    public function testSetNameObjectException()
    {
        $tipo = new Tipo();

        self::expectException("TypeError");
        /** @noinspection PhpParamsInspection */
        $tipo->setName(new Tipo());
    }
}
