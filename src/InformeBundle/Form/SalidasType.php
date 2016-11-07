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
                'choices'=>array(
                    'licencia'=>'Licencia',
                    'comision'=>'Comisión',
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
            ->add('actividad', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'Actividad',
                'required'=>false,
            ))
            ->add('propositos','choice',array(
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
                'years'=> range(2015,2015),
                'label'=>'*Inicio',
                'required'=>true,

            ))
            ->add('fin','Symfony\Component\Form\Extension\Core\Type\DateType',array(
                'placeholder' => array(
                    'year' => 'Año',
                    'month' => 'Mes',
                    'day' => 'Día'),
                'years'=> range(2015,2015),
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
            'Asamblea' => 'Asamblea',
            'Asesoría' => 'Asesoría',
            'Capacitación' => 'Capacitación',
            'Cátedra' => 'Cátedra',
            'Ceremonia' => 'Ceremonia',
            'Colaboración' => 'Colaboración',
            'Coloquio' => 'Coloquio',
            'Comité' => 'Comité',
            'Concurso' => 'Concurso',
            'Conferencia' => 'Conferencia',
            'Congreso' => 'Congreso',
            'Conmemoración' => 'Conmemoración',
            'Consultoría' => 'Consultoría',
            'Convención' => 'Convención',
            'Convenio' => 'Convenio',
            'Coordinación' => 'Coordinación',
            'Curso' => 'Curso',
            'Curso-Taller' => 'Curso-Taller',
            'Demostración' => 'Demostración',
            'Dictamen' => 'Dictamen',
            'Diplomado' => 'Diplomado',
            'Encuentro' => 'Encuentro',
            'Entrevista' => 'Entrevista',
            'Estancia' => 'Estancia',
            'Estudio' => 'Estudio',
            'Evaluación' => 'Evaluación',
            'Examen' => 'Examen',
            'Exposición' => 'Exposición',
            'Feria' => 'Feria',
            'Feria-Posgrado' => 'Feria-Posgrado',
            'Foro' => 'Foro',
            'Homenaje' => 'Homenaje',
            'Inauguración' => 'Inauguración',
            'Instalación' => 'Instalación',
            'Intercambio' => 'Intercambio',
            'Investigación' => 'Investigación',
            'Jornadas' => 'Jornadas',
            'Jurado' => 'Jurado',
            'Mesa redonda' => 'Mesa redonda',
            'Minicongreso' => 'Minicongreso',
            'Minicurso' => 'Minicurso',
            'Minisimposio' => 'Minisimposio',
            'Olimpiada' => 'Olimpiada',
            'Organización' => 'Organización',
            'Panel' => 'Panel',
            'Plática' => 'Plática',
            'Ponencia' => 'Ponencia',
            'Premiación' => 'Premiación',
            'Presentación' => 'Presentación',
            'Proyecto' => 'Proyecto',
            'Reconocimiento' => 'Reconocimiento',
            'Reunión' => 'Reunión',
            'Revisión' => 'Revisión',
            'Seminario' => 'Seminario',
            'Simposio' => 'Simposio',
            'Sinodal' => 'Sinodal',
            'Supervisión' => 'Supervisión',
            'Taller' => 'Taller',
            'Trabajo' => 'Trabajo',
            'Trabajo de campo' => 'Trabajo de campo',
            'Vinculación' => 'Vinculación',
            'Visita' => 'Visita',
        );
    }
}
