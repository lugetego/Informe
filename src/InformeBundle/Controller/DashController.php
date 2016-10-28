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
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

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
            $salidas = $user->getAcademico()->getSalidas();
            $planes = $user->getAcademico()->getPlanes();

            return $this->render('dash/index.html.twig', array(
                'investigaciones'=> $investigaciones,
                'estudiantes'=>$estudiantes,
                'cursos'=>$cursos,
                'proyectos'=>$proyectos,
                'eventos'=>$eventos,
                'salidas'=>$salidas,
                'planes'=>$planes,

            ));

        }

        return array(
            'academicos' => $academicos,
        );

    }
}
