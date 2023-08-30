<?php

namespace App\Controller\Proveedores;

use App\App\Proveedores\Create;
use App\App\Proveedores\Delete;
use App\App\Proveedores\Update;
use App\Repository\ProveedorRepository;
use App\Repository\TipoRepository;
use Doctrine\ORM\EntityManagerInterface;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
        $this->proveedorRepository = $proveedorRepository;
        $this->tipoRepository = $tipoRepository;
        $this->em = $em;
    }

    public function lista ()
    {
        $proveedores = $this->proveedorRepository->findAll();

        return $this->render('proveedores/lista.html.twig', ["proveedores" => $proveedores]);
    }


    public function datos (int $id, Request $request)
    {
        $proveedor = $this->proveedorRepository->find($id);
        $tipos     = $this->tipoRepository->findAll();

        return $this->render('proveedores/proveedor.html.twig', ["proveedor" => $proveedor, "tipos" => $tipos]);
    }


    public function nuevo ()
    {
        $tipos = $this->tipoRepository->findAll();

        return $this->render('proveedores/nuevo.html.twig', ["tipos" => $tipos]);
    }

    public function borrado (int $id, request $request)
    {
        return $this->render('proveedores/borrado.html.twig', ["id" => $id]);
    }


    public function crear (Request $request)
    {
        $data = [
            "name" => $request->request->get('name'),
            "email" => $request->request->get('email'),
            "phone" => $request->request->get('phone'),
            "isActive" => $request->request->get('isActive'),
            "type" => $request->request->get('type'),
        ];

        try {
            $proveedor = (new Create($this->proveedorRepository, $this->tipoRepository))
                ->crear($data);
        } catch (\Exception $e) {
            return $this->redirect(
                $this->generateUrl('proveedores_nuevo') . '?error=' . $e->getMessage()
            );
        }

        $request->query->add([ "id" => $proveedor->getId() ]);

        return $this->redirect(
            $this->generateUrl('proveedor',[ 'id' => $proveedor->getId() ])
        );
    }

    public function editar (int $id, Request $request)
    {
        $data = [
            "id" => $id,
            "name" => $request->request->get('name'),
            "email" => $request->request->get('email'),
            "phone" => $request->request->get('phone'),
            "isActive" => $request->request->get('isActive'),
            "type" => $request->request->get('type'),
        ];

        $url = $this->generateUrl('proveedor', ['id' => $id]);

        try {
            (new Update($this->proveedorRepository, $this->tipoRepository, $this->em))
                ->editar($data);
        } catch (\Exception $e) {
            return $this->redirect(
                $url . '?error=' . $e->getMessage()
            );
        }

        return $this->redirect($url);
    }

    public function borrar (int $id, request $request)
    {
        (new Delete($this->proveedorRepository))
            ->borrar($id);

        return $this->redirect(
            $this->generateUrl('proveedores_borrado',[ 'id' => $id ])
        );
    }
}