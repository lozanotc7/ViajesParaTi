<?php

namespace App\Controller\Proveedores;

use App\App\Proveedores\Create;
use App\App\Proveedores\Delete;
use App\App\Proveedores\Update;
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


    public function lista ()
    {
        $proveedores = $this->repository->findAll();

        return $this->render('proveedores/lsita.html.twig', ["proveedores" => $proveedores]);
    }


    public function datos (Request $request)
    {
        $proveedor = ($this->proveedorRepository->find($request->query->get('id')));

        return $this->render('proveedores/proveedor.html.twig', ["proveedor" => $proveedor]);
    }


    public function nuevo ()
    {
        $tipos      = $this->tipoRepository->getAll();

        return $this->render('proveedores/nuevo.html.twig', ["tipos" => $tipos]);
    }

    public function borrado (request $request)
    {
        $id = $request->query->get('id');

        return $this->render('proveedores/borrado.html.twig', ["id" => $id]);
    }


    public function crear (Request $request)
    {
        $data = [
            "name" => $request->request->get('name'),
            "email" => $request->request->get('email'),
            "phone" => $request->request->get('phone'),
            "isActive" => $request->request->get('isActive'),
            "tipo" => $request->request->get('tipo'),
        ];

        $proveedor = (new Create($this->proveedorRepository, $this->tipoRepository))
            ->crear($data);

        return $this->forward(
            'App\Controller\Proveedores\proveedoresController::index',
            [ 'id' => $proveedor->getId() ]
        );
    }

    public function editar (Request $request)
    {
        $data = [
            "id" => $request->query->get('id'),
            "name" => $request->request->get('name'),
            "email" => $request->request->get('email'),
            "phone" => $request->request->get('phone'),
            "isActive" => $request->request->get('isActive'),
            "tipo" => $request->request->get('tipo'),
        ];

        $proveedor = (new Update($this->proveedorRepository, $this->tipoRepository, $this->em))
            ->editar($data);

        return $this->forward(
            'App\Controller\Proveedores\proveedoresController::index',
            [ 'id' => $proveedor->getId() ]
        );
    }

    public function borrar (request $request)
    {
        $id = $request->query->get('id');

        (new Delete($this->proveedorRepository))
            ->borrar($id);

        return $this->forward(
            'App\Controller\Proveedores\proveedoresController::borrado',
            [ 'id' => $id ]
        );
    }
}