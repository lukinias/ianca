<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Publicacion;

class PublicacionController extends Controller
{
    /**
     * @Route("/publicaciones", name="publicaciones")
     */
     public function publicacionesAction(Request $request)
     {
         $publicacionRepository = $this->getDoctrine()->getRepository(Publicacion::class);
         $publicaciones = $publicacionRepository->findByActivo(1, array('obra' => 'ASC'));

         return $this->render('publicacion/publicaciones.html.twig', array(
             'active_menu' => '5',
             'ruta_imagen' => $this->getParameter('publicaciones_imagenes_directory'),
             'publicacionesArray' => $publicaciones
         ));
     }

     /**
      * @Route("/publicacion/{id}", name="publicacion")
      */
      public function publicacionAction(Request $request, $id=null)
      {
          if ( $id != null ) {
              $publicacionRepository = $this->getDoctrine()->getRepository(Publicacion::class);
              $publicacion = $publicacionRepository->find($id);

              return $this->render('publicacion/publicacion.html.twig', array(
                  'active_menu' => '5',
                  'ruta_imagen' => $this->getParameter('publicaciones_imagenes_directory'),
                  'publicacion' => $publicacion
              ));
          } else {
              return $this->redirectToRoute('publicaciones');
          }
      }
}
