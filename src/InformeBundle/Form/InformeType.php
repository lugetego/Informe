<?php

namespace InformeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InformeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enviado', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'=>array(
                    true=>'Si ',
                    false=>'No '),
                'expanded'=>true,
                'required'=>true,
                'label'=>'Enviado',
                'choices_as_values' => false,
            ))
            ->add('dictamen', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label'=>'Dictamen',
                'choices'=>array(
                    'Aprobado'=>'Aprobado',
                    'Aprobado con observaciones'=>'Aprobado con observaciones',
                    'No aprobado'=>'No aprobado',
                ),
                'placeholder'=>'Seleccionar',
                'required'=>false,
                'choices_as_values' => true,
            ))
            ->add('observaciones', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label'=>'Observaciones',
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
            'data_class' => 'InformeBundle\Entity\Informe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'informebundle_informe';
    }


}
