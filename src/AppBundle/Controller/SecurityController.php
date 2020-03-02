<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Usuario;
use AppBundle\Form\LoginType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{

    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        $usuario = new Usuario();
        $formulario = $this->createForm(LoginType::class, $usuario);

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'active_menu'   => '1',
            'formulario'    => $formulario->createView(),
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}
