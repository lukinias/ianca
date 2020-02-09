<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array(
            'active_menu' => '1'
        ));
    }

    /**
     * @Route("/contacto", name="contacto")
     */
    public function contactoAction(Request $request)
    {
        return $this->render('default/contacto.html.twig', array(
            'active_menu' => '7'
        ));
    }

    /**
     * @Route("/clausulas-compromisorias", name="clausulas-compromisorias")
     */
    public function clausulasCompromisoriasAction(Request $request)
    {
        return $this->render('default/clausulas-compromisorias.html.twig', array(
            'active_menu' => '6'
        ));
    }

    /**
     * @Route("/registro-mediadores-conciliadores", name="registro-mediadores-conciliadores")
     */
    public function registroMediadoresConciliadoresAction(Request $request)
    {
        return $this->render('default/registro-mediadores-conciliadores.html.twig', array(
            'active_menu' => '6'
        ));
    }

    /**
     * @Route("/registro-arbitros", name="registro-arbitros")
     */
    public function registroArbitrosAction(Request $request)
    {
        return $this->render('default/registro-arbitros.html.twig', array(
            'active_menu' => '6'
        ));
    }

    /**
     * @Route("/resolucion-480", name="resolucion-480")
     */
    public function resolucion480Action(Request $request)
    {
        return $this->render('default/resolucion-480.html.twig', array(
            'active_menu' => '6'
        ));
    }

    /**
     * @Route("/registro-profesional", name="registro-profesional")
     */
    public function registrorPofesionalAction(Request $request)
    {
        return $this->render('default/registro-profesional.html.twig', array(
            'active_menu' => '6'
        ));
    }
}
