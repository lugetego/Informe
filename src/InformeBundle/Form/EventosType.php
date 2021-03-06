<?php

namespace InformeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventosType extends AbstractType
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
            ->add('tipo', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label'=>'*Tipo',
                'choices'=>array(
                    'Coloquio'=>'Coloquio',
                    'Congreso'=>'Congreso',
                    'Conferencia'=>'Conferencia',
                    'Curso'=>'Curso',
                    'Encuentro'=>'Encuentro',
                    'Escuela'=>'Escuela',
                    'Feria'=>'Feria',
                    'Jornadas'=>'Jornadas',
                    'Seminario'=>'Seminario',
                    'Taller'=>'Taller',
                ),
                'placeholder'=>'Seleccionar',
                'required'=>true,
                'choices_as_values' => true,
            ))
            ->add('organizador', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'=>array(
                    true=>'Si ',
                    false=>'No '),
                'expanded'=>true,
                'required'=>true,
                'label'=>'*Organizador',
                'choices_as_values' => false,
            ))
            ->add('nacional', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'=>array(
                    true=>'Si ',
                    false=>'No '),
                'expanded'=>true,
                'required'=>true,
                'label'=>'*Alcance nacional',
                'choices_as_values' => false,
            ))
            ->add('divulgacion', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'=>array(
                    true=>'Si ',
                    false=>'No '),
                'expanded'=>true,
                'required'=>true,
                'label'=>'*Divulgación',
                'choices_as_values' => false,
            ))
            ->add('invitacion', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'=>array(
                    true=>'Si ',
                    false=>'No '),
                'expanded'=>true,
                'required'=>true,
                'label'=>'*Invitacion',
                'choices_as_values' => false,
            ))
            ->add('pais', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*País',
                'required'=>true,
            ))
            ->add('institucion', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*Institución',
                'required'=>true,
            ))
            ->add('platica', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'Plática',
                'required'=>false,
            ))
            ->add('actividad', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'Actividad',
                'required'=>false,
            ))
            ->add('inicio','Symfony\Component\Form\Extension\Core\Type\DateType',array(
                'placeholder' => array(
                    'year' => 'Año',
                    'month' => 'Mes',
                    'day' => 'Día'),
                'years'=> range(2018,2018),
                'label'=>'*Inicio',
                'required'=>true,
                'data' => new \DateTime('01-01-2018'),

            ))
            ->add('fin','Symfony\Component\Form\Extension\Core\Type\DateType',array(
                'placeholder' => array(
                    'year' => 'Año',
                    'month' => 'Mes',
                    'day' => 'Día'),
                'years'=> range(2018,2018),
                'label'=>'*Fin',
                'required'=>true,
                'data' => new \DateTime('01-01-2018'),



            ))
            ->add('informacion', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label'=>'Información',
                'required'=>false,

            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InformeBundle\Entity\Eventos'
        ));
    }
}