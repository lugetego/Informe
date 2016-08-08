<?php

namespace InformeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CursosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('informacion', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'Información',
                'required'=>false,
            ))            ->add('tipo', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label'=>'*Tipo',
                'choices'=>array(
                    'Curso'=>'curso',
                    'Seminario'=>'seminario',

                ),
                'placeholder'=>'Seleccionar',
                'required'=>true,
                'choices_as_values' => true,


            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InformeBundle\Entity\Cursos',
            'user' => null,
        ));
    }
}
