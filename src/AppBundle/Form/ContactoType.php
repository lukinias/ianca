<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('nombreApellido', TextType::class)
           ->add('email', EmailType::class)
           ->add('asunto', TextType::class)
           ->add('mensaje', TextareaType::class)
           ->add('enviar', SubmitType::class, ['label' => 'Enviar'])
       ;
    }
}
