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
    public function indexAction(Request $request, \Swift_Mailer $mailer)
    {
        $newsletter = new Newsletter();
        $formulario = $this->createFormBuilder($newsletter)
            ->add('email', EmailType::class)
            ->add('suscribir', SubmitType::class, ['label' => 'SUSCRIBIR'])
            ->getForm();

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $newsletter = $formulario->getData();

            /*
            Enviamos mail de suscripción al Newsletter
            */
            $message = (new \Swift_Message('Suscripción al Newsletter - IANCA'))
                    ->setFrom(array($this->container->getParameter('mailer_user') => 'IANCA Sender'))
                    ->setTo($this->container->getParameter('mailer_user'))
                    ->setBody(
                        $this->renderView(
                            // app/Resources/views/emails/newsletterSuscribe.html.twig
                            'emails/newsletterSuscribe.html.twig',
                            ['email' => $newsletter->getEmail()]
                        ),
                        'text/html'
                    );
            $mailer->send($message);

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
    public function contactoAction(Request $request, \Swift_Mailer $mailer)
    {
        $contacto = new Contacto();
        $formulario = $this->createForm(ContactoType::class, $contacto);

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $contacto = $formulario->getData();

            /*
            Enviamos mail por contacto
            */
            $message = (new \Swift_Message('Contacto desde el sitio - IANCA'))
                    ->setFrom(array($this->container->getParameter('mailer_user') => 'IANCA Sender'))
                    ->setTo($this->container->getParameter('mailer_user'))
                    ->setBody(
                        $this->renderView(
                            // app/Resources/views/emails/contacto.html.twig
                            'emails/contacto.html.twig',
                            ['nombreApellido' => $contacto->getNombreApellido(),
                            'email' => $contacto->getEmail(),
                            'asunto' => $contacto->getAsunto(),
                            'mensaje' => $contacto->getMensaje()]
                        ),
                        'text/html'
                    );
            $mailer->send($message);

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

    /**
     * @Route("/normativa/{normativa}", name="normativa")
     */
    public function normativaAction(Request $request, $normativa='')
    {
        if ( $normativa == '' ) {
            return $this->render('default/normativa.html.twig', array(
                'active_menu' => '4'
            ));
        } else {
            switch ( $normativa ) {
                case 'estatuto-social':
                    return $this->render('default/normativas/estatuto-social.html.twig', array(
                        'active_menu' => '4'
                    ));
                    break;
                case 'codigo-etica-negociacion':

                    break;
                case 'codigo-etica-terciacion':

                    break;
                case 'codigo-etica-negociacion-crisis':

                    break;
                case 'reglamento-terciacion':

                    break;
                case 'reglamento-negociacion-crisis':

                    break;
                case 'norma-dialogo-mediacion':

                    break;
                case 'registro-negociadores-crisis':

                    break;
                case 'registro-profesional':

                    break;
                case 'criterios-basicos-financiero':

                    break;
                case 'pautas-organizacion-congresos':

                    break;
                case 'reglamento-premios-anuales':

                    break;
                case 'reglamento-asociados':

                    break;
                case 'ley-nacional-mediacion':

                    break;
                case 'decreto-reglamento-ley-mediacion':

                    break;
                case 'ley-mediacion-provincia-ba':

                    break;
                case 'decreto-reglamento-ley-mediacion-ba':

                    break;
                default:

            }
        }

    }
}
