<?php

namespace App\App\Proveedores;

use App\Entity\Proveedor;
use App\Repository\ProveedorRepository;
use App\Repository\TipoRepository;

class Create
{
    /**
     * @var ProveedorRepository
     */
    private $proveedorRepository;
    /**
     * @var TipoRepository
     */
    private $tipoRepository;


    public function __construct(
        ProveedorRepository $proveedorRepository,
        TipoRepository $tipoRepository
    ) {
        $this->proveedorRepository = $proveedorRepository;
        $this->tipoRepository      = $tipoRepository;
    }

    public function crear (array $data): Proveedor
    {
        $tipo      = $this->tipoRepository->find($data['type']);
        $proveedor = (new Proveedor())
            ->setName($data['name'] )
            ->setEmail($data['email'] )
            ->setPhone($data['phone'] )
            ->setIsActive($data['isActive'] )
            ->setCreated(new \DateTime() )
            ->setUpdated(new \DateTime() )
            ->setTipo($tipo);

        $this->proveedorRepository->add($proveedor);

        return $proveedor;
    }
}