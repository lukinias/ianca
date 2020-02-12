<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Curso;

class CursoController extends Controller
{
    /**
     * @Route("/cursos", name="cursos")
     */
     public function cursosAction(Request $request)
     {
         $cursoRepository = $this->getDoctrine()->getRepository(Curso::class);
         $cursos = $cursoRepository->findByActivo(1, array('nombre' => 'ASC'));

         return $this->render('curso/cursos.html.twig', array(
             'active_menu' => '2',
             'cursosArray' => $cursos
         ));
     }
}
