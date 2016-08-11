<?php

namespace InformeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProyectosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label'=>'*Programa',
                'choices'=>array(
                    'CONACYT'=>'conacyt',
                    'PAEP'=>'paep',
                    'PAPIME'=>'papime',
                    'PAPIIT'=>'papiit',
                    'Otro'=>'otro'
                ),
                'placeholder'=>'Seleccionar',
                'required'=>true,
                'choices_as_values' => true,


            ))
            ->add('nombre', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*Nombre del proyecto',
                'required'=>true,
            ))
            ->add('numero', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*Número del proyecto',
                'required'=>true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InformeBundle\Entity\Proyectos'
        ));
    }
}
