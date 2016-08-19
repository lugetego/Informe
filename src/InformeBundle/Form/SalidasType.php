<?php

namespace InformeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalidasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo')
            ->add('pais')
            ->add('ciudad')
            ->add('estado')
            ->add('universidad')
            ->add('profesor')
            ->add('actividad')
            ->add('proposito')
            ->add('proyecto')
            ->add('inicio', 'date')
            ->add('fin', 'date')
            ->add('trabajo')
            ->add('observaciones')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InformeBundle\Entity\Salidas'
        ));
    }
}
