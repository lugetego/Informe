<?php

namespace InformeBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use InformeBundle\Entity\Academico;
use InformeBundle\Entity\Informe;
use InformeBundle\Entity\User;
use InformeBundle\Entity\Plan;
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
            $informes = $em->getRepository('InformeBundle:Informe')->findByActivo(2018);
            return $this->render('dash/admin.html.twig', array(
                'informes'=> $informes,
            ));
        }

        elseif ($this->get('security.context')->isGranted('ROLE_TECNICO'))
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $academico = $user->getAcademico();
            $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);
            $enviado = $informe->isEnviado();
            $tecnicos = $em->getRepository('InformeBundle:Tecnico')->findOneByInforme($informe);
            return $this->render('dash/tecnico.html.twig', array(
                'informe'=>$informe,
                'academico'=>$academico,
                'tecnicos'=> $tecnicos,
                'enviado'=>$enviado,
                'user'=>$user,

            ));
        }

        else {
            $user = $this->get('security.context')->getToken()->getUser();
            $academico = $user->getAcademico();

            $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);
            $plan = $em->getRepository('InformeBundle:Plan')->findOneByAnio(2019,$academico);

            $salidas = $em->getRepository('InformeBundle:Salidas')->findSalidas($informe->getId());
            $visitantes = $em->getRepository('InformeBundle:Salidas')->findByVisitantes($informe->getId());

            //$investigaciones = $informe->getInvestigaciones();
            //$estudiantes = $informe->getEstudiantes();
            //$cursos = $informe->getCursos();
            //$proyectos = $informe->getProyectos();
            //$eventos = $informe->getEventos();
            //$salidas = $informe->getSalidas();
            //$planes = $informe->getPlanes();
            //$posdocs = $informe->getPosdocs();
            //$enviado = $informe->isEnviado();

            return $this->render('dash/index.html.twig', array(
                'informe' => $informe,
                'academico' => $academico,
                'plan' => $plan,
                'salidas' => $salidas,
                'visitantes' => $visitantes,
              /*  'investigaciones'=> $investigaciones,
                'estudiantes'=>$estudiantes,
                'cursos'=>$cursos,
                'proyectos'=>$proyectos,
                'eventos'=>$eventos,
                'salidas'=>$salidas,
                'planes'=>$planes,
                'posdocs'=>$posdocs,
                'user'=>$user,
                'enviado'=>$enviado*/

            ));
        }

    }

    /**
     * Lists all actions on Informe .
     *
     * @Route("/consulta/{anio}", name="consulta")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function consultaAction(Informe $informe)
    {
        $em = $this->getDoctrine()->getManager();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            $academicos = $em->getRepository('InformeBundle:Academico')->findAll();
            return $this->render('dash/admin.html.twig', array(
                'academicos'=> $academicos,
            ));
        }

        elseif ($this->get('security.context')->isGranted('ROLE_TECNICO'))
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $academico = $user->getAcademico();
            $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio($informe->getAnio(), $academico);
            $tecnicos = $em->getRepository('InformeBundle:Tecnico')->findOneByInforme($informe);
            $informeAnual = $tecnicos->getInformeAnual();
            $plan= $tecnicos->getPlan();
            $enviado = $informe->isEnviado();

            return $this->render('dash/consulta-tecnico.html.twig', array(
                'academico'=>$academico,
                'tecnicos'=> $tecnicos,
                'plan'=> $plan,
                'enviado'=>$enviado,
                'informe'=> $informe,
                'informeAnual'=>$informeAnual,
                'user'=>$user,

            ));
        }

        else {
            $user = $this->get('security.context')->getToken()->getUser();
            $academico = $user->getAcademico();

            $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio($informe->getAnio(),$academico);
            $plan = $em->getRepository('InformeBundle:Plan')->findOneByAnio($informe->getAnio()+1,$academico);

            //$investigaciones = $informe->getInvestigaciones();
            //$estudiantes = $informe->getEstudiantes();
            //$cursos = $informe->getCursos();
            //$proyectos = $informe->getProyectos();
            //$eventos = $informe->getEventos();
            //$salidas = $informe->getSalidas();
            //$planes = $informe->getPlanes();
            //$posdocs = $informe->getPosdocs();
            //$enviado = $informe->isEnviado();

            return $this->render('dash/consulta.html.twig', array(
                'informe'=>$informe,
                'academico'=> $academico,
                /*  'investigaciones'=> $investigaciones,
                  'estudiantes'=>$estudiantes,
                  'cursos'=>$cursos,
                  'proyectos'=>$proyectos,
                  'eventos'=>$eventos,
                  'salidas'=>$salidas,/**/
                  'plan'=>$plan,/*
                  'posdocs'=>$posdocs,
                  'user'=>$user,
                  'enviado'=>$enviado*/
            ));
        }

    }

    /**
     * Export to PDF
     *
     * @Route("/pdf/{anio}", name="informe_pdf")
     */
    public function pdfAction(Informe $informe)
    {
        $em = $this->getDoctrine()->getManager();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->get('security.context')->getToken()->getUser();
        $academico = $user->getAcademico();
        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio($informe->getAnio(),$academico);
        $salidas = $em->getRepository('InformeBundle:Salidas')->findSalidas($informe->getId());
        $visitas = $em->getRepository('InformeBundle:Salidas')->findByVisitantes($informe->getId());


        $html = $this->renderView('dash/layout-pdf.html.twig', array(
            'academico'=>$academico,
            'informe'=>$informe,
            'salidas'=>$salidas,
            'visitas'=>$visitas,

        ));

        $filename = sprintf('Informe-'.$user.'%s.pdf', $informe->getAnio());

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),

            ]
        );
    }

    /**
     * Export to PDF
     *
     * @Route("/pdfplan/{anio}", name="plan_pdf")
     */
    public function pdfPlanAction(Plan $plan)
    {
        $em = $this->getDoctrine()->getManager();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->get('security.context')->getToken()->getUser();
        $academico = $user->getAcademico();
        $plan = $em->getRepository('InformeBundle:Plan')->findOneByAnio($plan->getAnio(), $academico);

        $html = $this->renderView('dash/layout-pdfplan.html.twig', array(
            'academico'=>$academico,
            'plan'=>$plan,
        ));

        $filename = sprintf('Plan-'.$user.'%s.pdf', $plan->getAnio());

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),

            ]
        );
    }

    /**
     * Export to PDF
     *
     * @Route("/pdftecnico/{anio}", name="informe_pdftecnico")
     */
    public function pdfTecnicoAction(Informe $informe)
    {
        $em = $this->getDoctrine()->getManager();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->get('security.context')->getToken()->getUser();
        $academico = $user->getAcademico();
        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio($informe->getAnio(),$academico);
        $tecnicos = $em->getRepository('InformeBundle:Tecnico')->findOneByInforme($informe);
        $informeAnual=$tecnicos->getInformeAnual();
        $plan=$tecnicos->getPlan();

        $html = $this->renderView('dash/layout-pdftecnico.html.twig', array(
            'informe'=>$informe,
            'informeAnual'=>$informeAnual,
            'plan'=>$plan,
            'academico'=>$academico,
            'tecnicos'=>$tecnicos,
        ));

        $filename = sprintf('Informe-'.$user.'%s.pdf', date('Y-m-d'));

        $pdfOptions = array(
            'footer-right'     => ('Hoja [page] de [toPage]'),
            'footer-font-size'=> 8,
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        );

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html, $pdfOptions),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),

            ]
        );
    }

    /**
     * Export to PDF admin
     *
     * @Route("/pdfadmin/{id}", name="informe_pdfadmin")
     */
    public function pdfAdminAction(Academico $academico)
    {

        $em = $this->getDoctrine()->getManager();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {

            $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);
            $salidas = $em->getRepository('InformeBundle:Salidas')->findSalidas($informe->getId());
            $visitas = $em->getRepository('InformeBundle:Salidas')->findByVisitantes($informe->getId());
            $plan = $em->getRepository('InformeBundle:Plan')->findOneByAnio(2018, $academico);



//            $repository = $this->getDoctrine()->getRepository('InformeBundle:Academico');
//            $academico = $repository->find($id);
//            $investigaciones = $academico->getInvestigaciones();
//            $estudiantes = $academico->getEstudiantes();
//            $cursos = $academico->getCursos();
//            $proyectos = $academico->getProyectos();
//            $eventos = $academico->getEventos();
//            $salidas = $academico->getSalidas();
//            $visitas = $academico->getVisitas();
//            $planes = $academico->getPlanes();
//            $posdocs = $academico->getPosdocs();
//            $tecnicos = $academico->getTecnicos();

            if(in_array('ROLE_TECNICO', $academico->getUser()->getRoles())){

                $tecnicos = $em->getRepository('InformeBundle:Tecnico')->findOneByInforme($informe);
                $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);
                $informeAnual = $tecnicos->getInformeAnual();
                $plan= $tecnicos->getPlan();

                $html = $this->renderView('dash/layout-pdftecnico.html.twig', array(
                    'academico' => $academico,
                    'tecnicos' => $tecnicos,
                    'informe'=>$informe,
                    'plan' => $plan,
                    'informeAnual'=>$informeAnual,
                ));
            }
            else {
                $html = $this->renderView('dash/layout-pdf.html.twig', array(
                    'academico'=>$academico,
                    'salidas'=>$salidas,
                    'visitas'=>$visitas,
                    'informe'=>$informe,
                    'plan'=>$plan,

                ));
            }

            $filename = sprintf('Informe-'.$academico->getUser().'%s.pdf', date('Y-m-d'));

            $pdfOptions = array(
                'footer-right'     => ('Hoja [page] de [toPage]'),
                'footer-font-size'=> 8,
                'margin-top'    => 10,
                'margin-right'  => 10,
                'margin-bottom' => 10,
                'margin-left'   => 10,
            );
        }

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html, $pdfOptions),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),

            ]
        );

    }

    /**
     * Envío informe y plan
     *
     * @Route("/send", name="informe_send")
     */
    public function sendAction()
    {

        $em = $this->getDoctrine()->getManager();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->get('security.context')->getToken()->getUser();
        $academico = $user->getAcademico();

        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);
        $plan = $em->getRepository('InformeBundle:Plan')->findOneByAnio(2019, $academico);


        $informe->setEnviado(true);
        $plan->setEnviado(true);
        $em->persist($informe);
        $em->persist($plan);
        $em->flush();

        // Obtiene correo y msg de la forma de contacto
        $mailer = $this->get('mailer');

        $message = \Swift_Message::newInstance()
            ->setSubject('Informe y plan de trabajo')
            ->setFrom('webmaster@matmor.unam.mx')
            ->setTo(array($user->getEmail() ))
//                ->setTo('gerardo@matmor.unam.mx')
            ->setBcc(array('webmaster@matmor.unam.mx','vorozco@matmor.unam.mx'))
            ->setBody($this->renderView('dash/mail.txt.twig', array('entity' => $informe,'academico'=>$academico)))
        ;
        $mailer->send($message);

        return $this->redirectToRoute('dashboard');

    }

}