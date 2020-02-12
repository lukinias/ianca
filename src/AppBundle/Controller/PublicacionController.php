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
             'publicacionesArray' => $publicaciones
         ));
     }
}
