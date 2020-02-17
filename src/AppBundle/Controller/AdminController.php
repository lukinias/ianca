<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Usuario;

class AdminController extends Controller
{
    /**
     * @Route("/listado-cursos", name="listado-cursos")
     */
    public function listadoCursosAction(Request $request)
    {
        return $this->render('admin/listado-cursos.html.twig', array(
            //'active_menu' => '7'
        ));
    }

    /**
     * @Route("/editar-curso", name="editar-curso")
     */
    public function editarCursoAction(Request $request)
    {
        return $this->render('admin/editar-curso.html.twig', array(
            //'active_menu' => '7'
        ));
    }
}
