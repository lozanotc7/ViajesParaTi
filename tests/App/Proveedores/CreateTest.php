<?php

namespace App\Tests\App\Proveedores;

use App\App\Proveedores\Create;
use App\Tests\Mocks\Entity\TipoMock;
use App\Tests\Mocks\Repository\ProveedorRepositoryMock;
use App\Tests\Mocks\Repository\TipoRepositoryMock;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    protected
        $tipoEntity,
        $tipoRepository,
        $proveedorRepository;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->tipoEntity          = TipoMock::getMock();
        $this->tipoRepository      = TipoRepositoryMock::getMock($this->tipoEntity);
        $this->proveedorRepository = ProveedorRepositoryMock::getMock();
    }


    public function testCrearEmptyException()
    {
        $class = new Create(
            $this->proveedorRepository,
            $this->tipoRepository
        );

        $this->expectException("ArgumentCountError");
        /** @noinspection PhpParamsInspection */
        $class->crear();
    }

    public function testCrear()
    {
        $class = new Create(
            $this->proveedorRepository,
            $this->tipoRepository
        );

        $proveedor = $class->crear([
            'name' => "aaaa",
            'email' => "bbbb@ccc.com",
            'phone' => "654987321",
            'isActive' => true,
            'type' => $this->tipoEntity,
        ]);

        $this->assertInstanceOf("App\Entity\Proveedor", $proveedor);
    }
}