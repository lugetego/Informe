<?php

namespace InformeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TecnicoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('informe', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label'=>'Informe de actividades',
                'required'=>false,
            ))
            ->add('plan', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label'=>'Plan de trabajo',
                'required'=>false,
            ))
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InformeBundle\Entity\Tecnico'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'informebundle_tecnico';
    }


}
