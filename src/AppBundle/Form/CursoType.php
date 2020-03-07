<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CursoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('nombre', TextType::class)
           ->add('horas', IntegerType::class)
           ->add('descripcion', CKEditorType::class, array('config' => array('toolbar' => 'standard')))
           ->add('mjn', IntegerType::class)
           ->add('mecaba', IntegerType::class)
           ->add('activo', CheckboxType::class, array('required' => false))
           ->add('cuidi', IntegerType::class)

           ->add('guardar', SubmitType::class, ['label' => 'Guardar'])
       ;
    }
}
