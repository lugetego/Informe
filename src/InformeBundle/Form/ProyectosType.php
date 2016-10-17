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
            ->add('tipos', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label'=>'*Programa',
                'choices'=>array(
                    'CONACYT'=>'CONACYT',
                    'PAEP'=>'PAEP',
                    'PAPIME'=>'PAPIME',
                    'PAPIIT'=>'PAPIIT',
                    'Otro'=>'Otro'
                ),
                // *this line is important*
                'choices_as_values' => true,
                'placeholder' => 'Seleccionar',
                'label'=>'Tipo de programa',
                'mapped'=> false,

            ))
            ->add('tipo','Symfony\Component\Form\Extension\Core\Type\TextType', array('label' => 'Otro tipo de programa', 'read_only'=> true

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
