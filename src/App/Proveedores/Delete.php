<?php

namespace App\App\Proveedores;

use App\Repository\ProveedorRepository;
use App\Repository\TipoRepository;
use Symfony\Component\HttpFoundation\Request;

class Delete
{
    /**
     * @var ProveedorRepository
     */
    private $proveedorRepository;


    public function __construct(
        ProveedorRepository $proveedorRepository
    ) {
        $this->proveedorRepository = $proveedorRepository;
    }

    public function borrar (int $id)
    {
        $proveedor = $this->proveedorRepository->find($id);

        $this->proveedorRepository->remove($proveedor);
    }
}