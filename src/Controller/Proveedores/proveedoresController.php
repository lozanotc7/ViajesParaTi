<?php

namespace App\Controller\Proveedores;

use App\App\Proveedores\createProveedor;
use App\Entity\Proveedor;
use App\Repository\ProveedorRepository;
use App\Repository\TipoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class proveedoresController extends AbstractController
{
    protected
        $proveedorRepository,
        $tipoRepository,
        $em;

    public function __construct(
        ProveedorRepository $proveedorRepository,
        TipoRepository $tipoRepository,
        EntityManagerInterface $em
    ) {
        $this->repository = $proveedorRepository;
        $this->tipoRepository = $tipoRepository;
        $this->em = $em;
    }

    public function nuevo (Request $request)
    {
        $tipo      = $this->getTipoFromRequest($request);
        $proveedor = (new Proveedor())
            ->setName($request->request->get('name') )
            ->setEmail($request->request->get('email') )
            ->setPhone($request->request->get('phone') )
            ->setIsActive($request->request->get('isActive') )
            ->setTipo($tipo);

        $this->proveedorRepository->add($proveedor);

        return $this->render('proveedores/proveedor.html.twig', ["proveedor" => $proveedor]);
    }

    public function editar (Request $request)
    {
        $tipo      = $this->getTipoFromRequest($request);
        $proveedor = ($this->proveedorRepository->find($request->request->get('id')))
            ->setName($request->request->get('name') )
            ->setEmail($request->request->get('email') )
            ->setPhone($request->request->get('phone') )
            ->setIsActive($request->request->get('isActive') )
            ->setTipo($tipo);

        $this->em->flush();

        return $this->render('proveedores/proveedor.html.twig', ["proveedor" => $proveedor]);
    }

    public function borrar (request $request)
    {
        $id        = $request->request->get('id');
        $proveedor = ($this->proveedorRepository->find($id));

        $this->proveedorRepository->remove($proveedor);

        return $this->render('proveedores/borrado.html.twig', ["id" => $id]);
    }

    public function lista ()
    {
        $proveedores = $this->repository->findAll();

        return $this->render('proveedores/lsita.html.twig', ["proveedores" => $proveedores]);
    }

    protected function getTipoFromRequest(Request $request)
    {
        return $this->tipoRepository->find($request->request->get('tipo'));
    }
}