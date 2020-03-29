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
use AppBundle\Entity\Usuario;
use AppBundle\Form\LoginType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
            */

            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletter);
            $em->flush();

            $this->addFlash('success', 'Gracias por suscribirse al newsletter! Pronto recibirá novedades.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/index.html.twig', array(
            'active_menu' => '1',
            'formulario'    => $formulario->createView()
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
            */

            $em = $this->getDoctrine()->getManager();
            $em->persist($contacto);
            $em->flush();

            $this->addFlash('success', 'Gracias por contactarnos! Su consulta será respondida a la brevedad.');

            return $this->redirectToRoute('contacto');
        }

        return $this->render('default/contacto.html.twig', array(
            'active_menu'   => '7',
            'formulario'    => $formulario->createView()
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
        return $this->render('default/registro/mediadores-conciliadores.html.twig', array(
            'active_menu' => '6'
        ));
    }

    /**
     * @Route("/registro-arbitros", name="registro-arbitros")
     */
    public function registroArbitrosAction(Request $request)
    {
        return $this->render('default/registro/arbitros.html.twig', array(
            'active_menu' => '6'
        ));
    }

    /**
     * @Route("/registro-profesional", name="registro-profesional")
     */
    public function registrorPofesionalAction(Request $request)
    {
        return $this->render('default/registro/profesional.html.twig', array(
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
                    return $this->render('default/normativas/codigo-etica-negociacion.html.twig', array(
                        'active_menu' => '4'
                    ));
                    break;
                case 'codigo-etica-terciacion':
                    return $this->render('default/normativas/codigo-etica-terciacion.html.twig', array(
                        'active_menu' => '4'
                    ));
                    break;
                case 'codigo-etica-negociacion-crisis':
                    return $this->render('default/normativas/codigo-etica-negociacion-crisis.html.twig', array(
                        'active_menu' => '4'
                    ));
                    break;
                case 'reglamento-terciacion':
                    return $this->render('default/normativas/reglamento-terciacion.html.twig', array(
                        'active_menu' => '4'
                    ));
                    break;
                case 'reglamento-negociacion-crisis':
                    return $this->render('default/normativas/reglamento-negociacion-crisis.html.twig', array(
                        'active_menu' => '4'
                    ));
                    break;
                case 'norma-dialogo-mediacion':
                    return $this->render('default/normativas/norma-dialogo-mediacion.html.twig', array(
                        'active_menu' => '4'
                    ));
                    break;
                case 'registro-negociadores-crisis':
                    return $this->render('default/normativas/registro-negociadores-crisis.html.twig', array(
                        'active_menu' => '4'
                    ));
                break;
                    break;
                case 'registro-profesional':
                    return $this->render('default/normativas/registro-profesional.html.twig', array(
                        'active_menu' => '4'
                    ));
                    break;
                    /*
                case 'criterios-basicos-financiero':

                    break;
                    */
                case 'pautas-organizacion-congresos':
                    return $this->render('default/normativas/pautas-organizacion-congresos.html.twig', array(
                        'active_menu' => '4'
                    ));
                    break;
                case 'reglamento-premios-anuales':
                    return $this->render('default/normativas/reglamento-premios-anuales.html.twig', array(
                        'active_menu' => '4'
                    ));
                    break;
                case 'reglamento-asociados':
                    return $this->render('default/normativas/reglamento-asociados.html.twig', array(
                        'active_menu' => '4'
                    ));
                    break;
                default:
                    return $this->render('default/normativa.html.twig', array(
                        'active_menu' => '4'
                    ));
            }
        }
    }

    /**
     * @Route("/poder-adquisitivo", name="poder-adquisitivo")
     */
    public function poderAdquisitivoAction(Request $request)
    {
        return $this->render('default/poder-adquisitivo.html.twig', array(
            'active_menu' => '1'
        ));
    }

    /**
     * @Route("/registros-profesionales", name="registros-profesionales")
     */
    public function registrosProfesionalesAction(Request $request)
    {
        return $this->render('default/registros-profesionales.html.twig', array(
            'active_menu' => '1'
        ));
    }

    /**
     * @Route("/faq/{tematica}", name="faq")
     */
    public function faqAction(Request $request, $tematica='')
    {
        if ( $tematica == '' ) {
            return $this->render('default/faq.html.twig', array(
                'active_menu' => '1'
            ));
        } else {
            switch ( $tematica ) {
                case 'negociacion':
                    return $this->render('default/faq/negociacion.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'mediacion-conciliacion':
                    return $this->render('default/faq/mediacion-conciliacion.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'terciacion-institucional-preventiva':
                    return $this->render('default/faq/terciacion-institucional-preventiva.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'arbitraje':
                    return $this->render('default/faq/arbitraje.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'usura':
                    return $this->render('default/faq/usura.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'consumo-y-uso':
                    return $this->render('default/faq/consumo-y-uso.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'probation':
                    return $this->render('default/faq/probation.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'liquidaciones':
                    return $this->render('default/faq/liquidaciones.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'seguridad-personal-ante-el-delito':
                    return $this->render('default/faq/seguridad-personal-ante-el-delito.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                default:
                    return $this->render('default/faq.html.twig', array(
                        'active_menu' => '1'
                    ));
            }
        }
    }

    /**
     * @Route("/que-es/{tematica}", name="que-es")
     */
    public function queEsAction(Request $request, $tematica='')
    {
        if ( $tematica == '' ) {
            return $this->render('default/que-es.html.twig', array(
                'active_menu' => '1'
            ));
        } else {
            switch ( $tematica ) {
                case 'arbitraje':
                    return $this->render('default/que-es/arbitraje.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'mediacion':
                    return $this->render('default/que-es/mediacion.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'negociacion':
                    return $this->render('default/que-es/negociacion.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'terciacion-institucional-preventiva':
                    return $this->render('default/que-es/terciacion-institucional-preventiva.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'usura':
                    return $this->render('default/que-es/usura.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'defensa-consumidor':
                    return $this->render('default/que-es/defensa-consumidor.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'probation':
                    return $this->render('default/que-es/probation.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'seguridad-personal-ante-el-delito':
                    return $this->render('default/que-es/seguridad-personal-ante-el-delito.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'inflacion-poder-adquisitivo-del-dinero':
                    return $this->render('default/que-es/inflacion-poder-adquisitivo-del-dinero.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                case 'liquidaciones':
                    return $this->render('default/que-es/liquidaciones.html.twig', array(
                        'active_menu' => '1'
                    ));
                    break;
                default:
                    return $this->render('default/que-es.html.twig', array(
                        'active_menu' => '1'
                    ));
            }
        }
    }
}
