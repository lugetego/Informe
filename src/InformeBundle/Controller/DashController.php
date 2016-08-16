<?php

namespace InformeBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use InformeBundle\Entity\Academico;



/**
 * Dash controller.
 *
 * @Route("/dash")
 */
class DashController extends Controller
{

    /**
     * Lists all actions on Informe .
     *
     * @Route("/", name="dashboard")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {

            $academicos = $em->getRepository('InformeBundle:Academico')->findAll();




        }
        else {
            $user = $this->get('security.context')->getToken()->getUser();
            $investigaciones = $user->getAcademico()->getInvestigaciones();
            $estudiantes = $user->getAcademico()->getEstudiantes();
            $cursos = $user->getAcademico()->getCursos();
            $proyectos = $user->getAcademico()->getProyectos();
            $eventos = $user->getAcademico()->getEventos();

            $academico = $user->getAcademico()->getId();


            //$solicitudes = $em->getRepository('CcmSiaBundle:Solicitud')->findSolicitudesByAcademico($academico->getId());
            //$academico = $user->getId();
            //$academicos = $em->getRepository('CcmSiaBundle:Academico')->findByUser($academico);
            // $proyectos = $em->getRepository('CcmSiaBundle:Proyecto')->findByAcademico($academico);


            return $this->render('dash/index.html.twig', array(
                'investigaciones'=> $investigaciones,
                'estudiantes'=>$estudiantes,
                'cursos'=>$cursos,
                'proyectos'=>$proyectos,
                'eventos'=>$eventos,

            ));


            /* return $this->redirect(
                $this->generateUrl('academico_show',array('id' => $academico)
                )); */

        }


        return array(
            'academicos' => $academicos,
        );


    }

}
