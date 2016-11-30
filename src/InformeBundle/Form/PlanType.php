<?php

namespace InformeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('investigacion', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label'=>'Actividades de investigación',
                'required'=>false,
            ))
            ->add('estudiantes')
            ->add('posdocs')
            ->add('cursos')
            ->add('proyectos')
            ->add('eventos')
            ->add('salidas')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InformeBundle\Entity\Plan'
        ));
    }
}