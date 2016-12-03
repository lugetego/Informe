<?php

namespace InformeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PosdocType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*Nombre',
                'required'=>true,
            ))
            ->add('inicio','Symfony\Component\Form\Extension\Core\Type\DateType',array(
                'placeholder' => array(
                    'year' => 'Año',
                    'month' => 'Mes',
                    'day' => 'Día'),
                'years'=> range(2012,2016),
                'label'=>'*Fecha de inicio',
                'required'=>true,

            ))
            ->add('fin','Symfony\Component\Form\Extension\Core\Type\DateType',array(
                'placeholder' => array(
                    'year' => 'Año',
                    'month' => 'Mes',
                    'day' => 'Día'),
                'years'=> range(2016,2018),
                'label'=>'*Fecha de término',
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
            'data_class' => 'InformeBundle\Entity\Posdoc'
        ));
    }


}