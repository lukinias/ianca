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
         try {
             $cursoRepository = $this->getDoctrine()->getRepository(Curso::class);
             $cursos = $cursoRepository->findByActivo(1, array('nombre' => 'ASC'));
         } catch (\Exception $e) {
             die($e->getMessage());
         }

         return $this->render('curso/cursos.html.twig', array(
             'active_menu' => '2',
             'cursosArray' => $cursos
         ));
     }

     /**
      * @Route("/curso/{id}", name="curso")
      */
      public function cursoAction(Request $request, $id=null)
      {
          if ( $id != null ) {
              $cursoRepository = $this->getDoctrine()->getRepository(Curso::class);
              $curso = $cursoRepository->find($id);

              return $this->render('curso/curso.html.twig', array(
                  'active_menu' => '2',
                  'curso' => $curso
              ));
          } else {
              return $this->redirectToRoute('cursos');
          }
      }
}
