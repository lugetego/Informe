<?php

namespace InformeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class CursosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'*Nombre del curso o seminario',
                'required'=>false,
            ))
            ->add('tipo', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label'=>'*Tipo',
                'choices'=>array(
                    'Curso'=>'curso',
                    'Seminario'=>'seminario',

                ),
                'placeholder'=>'Seleccionar',
                'required'=>true,
                'choices_as_values' => true,

            ))
            ->add('nivel', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label'=>'*Nivel',
                'choices'=>array(
                    'Licenciatura'=>'licenciatura',
                    'Posgrado'=>'posgrado',

                ),
                'placeholder'=>'Seleccionar',
                'required'=>true,
                'choices_as_values' => true,

            ))
            ->add('horas', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'label'=>'Número de horas',
                'required'=>false,
            ))
            ->add('lugares','Symfony\Component\Form\Extension\Core\Type\ChoiceType', array('choices'  => array(
                'Escuela Nacional de Estudios Superiores (ENES), UNAM Campus Morelia'=>'ENES',
                'Facultad de Ciencias Físico-Matemáticas (FISMAT), UMSNH' => 'FISMAT',
                'Instituto Tecnológico de Morelia (ITM)'=>'ITM',
                'Posgrado Conjunto (PCCM), UNAM-UMSNH'=>'PCCM',
                'Otro'=> 'Otro',

            ),
                // *this line is important*
                'choices_as_values' => true,
                'placeholder' => 'Seleccionar',
                'label'=>'Lugar donde se impartió',
                'mapped'=> false,

            ))
            ->add('lugar','Symfony\Component\Form\Extension\Core\Type\TextType', array('label' => 'Lugar donde se impartió', 'read_only'=> true
            ))

        ;

        $formModifier = function (FormInterface $form, $otro) {

            if ( 'Otro' == $otro) {
                $form->add('lugar', 'Symfony\Component\Form\Extension\Core\Type\TextType', array(
                    'label' => 'Lugar donde se impartió',
                ));
            }

        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getLugar());

            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                // this would be your entity, i.e. SportMeetup

                $data = $event->getData();
                if (isset($data['lugares'])){

                $val = $data['lugares'];
                if ( $val !='Otro') {
                    $data['lugar'] = $val;
                    $event->setData($data);
                }
                    }
                else {
                    $data['lugares']='';
                }
            }
        );

        $builder->get('lugares')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $sport = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!

                $formModifier($event->getForm()->getParent(),$sport);

            }
        );




    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InformeBundle\Entity\Cursos',
            'user' => null,
        ));
    }
}
