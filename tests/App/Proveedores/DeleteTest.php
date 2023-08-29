<?php

namespace App\Tests\App\Proveedores;

use App\App\Proveedores\Delete;
use App\Entity\Proveedor;
use App\Repository\ProveedorRepository;
use App\Tests\Entity\Mocks\ProveedorMock;
use App\Tests\Repository\Mocks\ProveedorRepositoryMock;
use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase
{
    protected ProveedorRepository $proveedorRepository;
    protected Proveedor $proveedorEntity;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->proveedorRepository = ProveedorRepositoryMock::getMock();
        $this->proveedorEntity = ProveedorMock::getMock();
    }


    public function testDeleteEmptyException()
    {
        $class = new Delete($this->proveedorRepository);

        $this->expectException("ArgumentCountError");
        /** @noinspection PhpParamsInspection */
        $class->borrar();
    }

    public function testDeleteStringException()
    {
        $class = new Delete($this->proveedorRepository);

        $this->expectException("TypeError");

        /** @noinspection PhpParamsInspection */
        $class->borrar("string");
    }

    public function testDeleteProveedorException()
    {
        $class = new Delete($this->proveedorRepository);

        $this->expectException("TypeError");

        /** @noinspection PhpParamsInspection */
        $class->borrar(ProveedorMock::getMock());
    }

    public function testBorrar()
    {
        $this->proveedorRepository
            ->expects(self::once())
            ->method('remove');

        $class = new Delete($this->proveedorRepository);

        /** @noinspection PhpVoidFunctionResultUsedInspection */
        self::assertNull($class->borrar(1));
    }
}