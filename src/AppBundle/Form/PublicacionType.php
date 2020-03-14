<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\File;

class PublicacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('obra', TextType::class)
           ->add('descripcion_corta', TextType::class)
           ->add('descripcion_larga', CKEditorType::class, array('config' => array('toolbar' => 'standard')))
           ->add('autores', TextType::class)
           ->add('link', TextType::class)
           ->add('imagen', FileType::class, [
                'label' => 'Imagen (JPG, PNG file)',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,
            ])
           ->add('activo', CheckboxType::class, array('required' => false))

           ->add('guardar', SubmitType::class, ['label' => 'Guardar'])
       ;
    }
}
