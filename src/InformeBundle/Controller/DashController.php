<?php

namespace InformeBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use InformeBundle\Entity\Academico;
use Symfony\Component\HttpFoundation\Response;

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



    /**
     * Export to PDF
     *
     * @Route("/pdf", name="informe_pdf")
     */
    public function pdfAction()
    {

        $em = $this->getDoctrine()->getManager();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

            $user = $this->get('security.context')->getToken()->getUser();
            $investigaciones = $user->getAcademico()->getInvestigaciones();
            $estudiantes = $user->getAcademico()->getEstudiantes();
            $cursos = $user->getAcademico()->getCursos();
            $proyectos = $user->getAcademico()->getProyectos();
            $eventos = $user->getAcademico()->getEventos();
            $salidas = $user->getAcademico()->getSalidas();
            $planes = $user->getAcademico()->getPlanes();






        $html = $this->renderView('dash/layout-pdf.html.twig', array(
            'user'=>$user->getAcademico()->getNombre(),
            'investigaciones'  => $investigaciones,
            'estudiantes'=> $estudiantes,
            'cursos'=>$cursos,
            'proyectos'=>$proyectos,
            'eventos'=>$eventos,
            'salidas'=>$salidas,
            'planes'=>$planes
        ));

        $filename = sprintf('Informe-'.$user.'%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }



}
