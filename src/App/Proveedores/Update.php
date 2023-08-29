<?php

namespace App\App\Proveedores;

use App\Entity\Proveedor;
use App\Repository\ProveedorRepository;
use App\Repository\TipoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class Update
{
    /**
     * @var ProveedorRepository
     */
    private $proveedorRepository;
    /**
     * @var TipoRepository
     */
    private $tipoRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;


    public function __construct(
        ProveedorRepository $proveedorRepository,
        TipoRepository $tipoRepository,
        EntityManagerInterface $em
    ) {
        $this->proveedorRepository = $proveedorRepository;
        $this->tipoRepository      = $tipoRepository;
        $this->em                  = $em;
    }

    public function editar (array $data): Proveedor
    {
        $tipo      = $this->tipoRepository->find($data['tipo']);
        $proveedor = ($this->proveedorRepository->find($data['id']))
            ->setName($data['name'] )
            ->setEmail($data['email'] )
            ->setPhone($data['phone'] )
            ->setIsActive($data['isActive'] )
            ->setUpdated(new \DateTime() )
            ->setTipo($tipo);

        $this->em->flush();

        return $proveedor;
    }
}