<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Contacto;
use AppBundle\Entity\Newsletter;
use AppBundle\Form\ContactoType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $newsletter = new Newsletter();
        $formulario = $this->createFormBuilder($newsletter)
            ->add('email', EmailType::class)
            ->add('suscribir', SubmitType::class, ['label' => 'SUSCRIBIR'])
            ->getForm();

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $contacto = $formulario->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletter);
            $em->flush();

            $this->addFlash('success', 'Gracias por suscribirse al newsletter! Pronto recibirá novedades.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/index.html.twig', array(
            'active_menu' => '1',
            'formulario'    => $formulario->createView(),
        ));
    }

    /**
     * @Route("/contacto", name="contacto")
     */
    public function contactoAction(Request $request)
    {
        $contacto = new Contacto();
        $formulario = $this->createForm(ContactoType::class, $contacto);

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $contacto = $formulario->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($contacto);
            $em->flush();

            $this->addFlash('success', 'Gracias por contactarnos! Su consulta será respondida a la brevedad.');

            return $this->redirectToRoute('contacto');
        }

        return $this->render('default/contacto.html.twig', array(
            'active_menu'   => '7',
            'formulario'    => $formulario->createView(),
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

    /**
     * @Route("/quienes-somos", name="quienes-somos")
     */
    public function quienesSomosAction(Request $request)
    {
        return $this->render('default/quienes-somos.html.twig', array(
            'active_menu' => '3'
        ));
    }
}
