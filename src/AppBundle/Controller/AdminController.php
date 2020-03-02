<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Usuario;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/admin.html.twig', array(
            'active_menu' => '1'
        ));
    }

    /**
     * @Route("/listado-cursos", name="listado-cursos")
     */
    public function listadoCursosAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/listado-cursos.html.twig', array(
            'active_menu' => '1'
        ));
    }

    /**
     * @Route("/editar-curso", name="editar-curso")
     */
    public function editarCursoAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/editar-curso.html.twig', array(
            'active_menu' => '1'
        ));
    }

    /**
     * @Route("/listado-publicaciones", name="listado-publicaciones")
     */
    public function listadoPublicacionesAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/listado-publicaciones.html.twig', array(
            'active_menu' => '1'
        ));
    }

    /**
     * @Route("/editar-publicacion", name="editar-publicacion")
     */
    public function editarPublicacionAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/editar-publicacion.html.twig', array(
            'active_menu' => '1'
        ));
    }
}
