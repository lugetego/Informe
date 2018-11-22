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
            ->add('tipo', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label'=>'*Tipo',
                'placeholder'=>'Seleccionar',
                'choices'=>array(
                    'Licencia'=>'Licencia',
                    'Comisión'=>'Comisión',
                    'Visitante'=>'Visitante',
            )))
            ->add('pais', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*País',
                'required'=>true,
            ))
            ->add('ciudad', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*Ciudad',
                'required'=>true,
            ))
            ->add('estado', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*Estado',
                'required'=>true,
            ))
            ->add('universidad', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*Universidad',
                'required'=>true,
            ))
            ->add('profesor', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'Profesor',
                'required'=>false,
            ))
            ->add('actividad', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label'=>'Actividad',
                'required'=>false,
            ))
            ->add('propositos','Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'choices'   =>  $this->getPropositoChoice(),
                'multiple'=>true,
                'required'=>false,
                'label'=>'Propósitos del viaje'
            ))
            ->add('proyecto', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'Proyecto',
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

            ))
            ->add('fin','Symfony\Component\Form\Extension\Core\Type\DateType',array(
                'placeholder' => array(
                    'year' => 'Año',
                    'month' => 'Mes',
                    'day' => 'Día'),
                'years'=> range(2018,2018),
                'label'=>'*Fin',
                'required'=>true,
            ))
            ->add('trabajo', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'Trabajo',
                'required'=>false,
            ))
            ->add('observaciones', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',array(
                'label'=>'Observaciones',
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
            'data_class' => 'InformeBundle\Entity\Salidas'
        ));
    }

    /**
     * @return array
     */
    private function getPropositoChoice()
    {
        return array(
            'Coloquio'=>'Coloquio',
            'Conferencia'=>'Conferencia',
            'Congreso'=>'Congreso',
            'Curso'=>'Curso',
            'Distinción'=>'Distinción',
            'Feria'=>'Feria',
            'Investigación'=>'Investigación',
            'Jornadas'=>'Jornadas',
            'Mesa redonda'=>'Mesa redonda',
            'Reunión de trabajo'=>'Reunión de trabajo',
            'Taller'=>'Taller',
            'Seminario'=>'Seminario',
            'Sinodal'=>'Sinodal'
        );
    }
}