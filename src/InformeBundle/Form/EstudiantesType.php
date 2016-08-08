<?php

namespace InformeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstudiantesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('programa', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label'=>'*Programa',
                'choices'=>array(
                    'PCCM'=>'pccm',
                    'Licenciatura'=>'licenciatura',
                    'Posgrado externo'=>'externo',
                    'Posdoc'=>'posdoc',
                    ),
                'placeholder'=>'Seleccionar',
                'required'=>true,
                'choices_as_values' => true,


            ))
            ->add('tesis', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*Tesis dirigidas o en proceso',
                'required'=>true,
            ))
            ->add('alumno', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*Nombre del alumno',
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
            'data_class' => 'InformeBundle\Entity\Estudiantes'
        ));
    }
}
