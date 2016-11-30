<?php

namespace InformeBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use InformeBundle\Entity\Academico;
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
            $academicos = $em->getRepository('InformeBundle:Academico')->findAll();
        }
        else {
            $user = $this->get('security.context')->getToken()->getUser();
            $academico = $user->getAcademico();
            $investigaciones = $academico->getInvestigaciones();
            $estudiantes = $academico->getEstudiantes();
            $cursos = $academico->getCursos();
            $proyectos = $academico->getProyectos();
            $eventos = $academico->getEventos();
            $salidas = $academico->getSalidas();
            $planes = $academico->getPlanes();
            $posdocs = $academico->getPosdocs();
            $enviado = $academico->isEnviado();


            return $this->render('dash/index.html.twig', array(
                'academico'=> $academico,
                'investigaciones'=> $investigaciones,
                'estudiantes'=>$estudiantes,
                'cursos'=>$cursos,
                'proyectos'=>$proyectos,
                'eventos'=>$eventos,
                'salidas'=>$salidas,
                'planes'=>$planes,
                'posdocs'=>$posdocs,
                'user'=>$user,
                'enviado'=>$enviado

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

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->get('security.context')->getToken()->getUser();
        $academico = $user->getAcademico();
        $investigaciones = $user->getAcademico()->getInvestigaciones();
        $estudiantes = $user->getAcademico()->getEstudiantes();
        $cursos = $user->getAcademico()->getCursos();
        $proyectos = $user->getAcademico()->getProyectos();
        $eventos = $user->getAcademico()->getEventos();
        $salidas = $user->getAcademico()->getSalidas();
        $planes = $user->getAcademico()->getPlanes();
        $posdocs= $user->getAcademico()->getPosdocs();

        $html = $this->renderView('dash/layout-pdf.html.twig', array(
            'academico'=>$academico,
            'investigaciones'  => $investigaciones,
            'estudiantes'=> $estudiantes,
            'cursos'=>$cursos,
            'proyectos'=>$proyectos,
            'eventos'=>$eventos,
            'salidas'=>$salidas,
            'planes'=>$planes,
            'posdocs'=>$posdocs
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


    /**
     * Envío informe y plan
     *
     * @Route("/send", name="informe_send")
     */
    public function sendAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->get('security.context')->getToken()->getUser();
        $id = $user->getAcademico()->getId();

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('InformeBundle:Academico')->find($id);
        $entity->setEnviado(true);
        $em->persist($entity);
        $em->flush();

        // Obtiene correo y msg de la forma de contacto
        $mailer = $this->get('mailer');

        $message = \Swift_Message::newInstance()
            ->setSubject('Informe y plan de trabajo')
            ->setFrom('webmaster@matmor.unam.mx')
            ->setTo(array($user->getEmail() ))
            ->setBcc(array('gerardo@matmor.unam.mx'))
            ->setBody($this->renderView('dash/mail.txt.twig', array('entity' => $entity)))
        ;
        $mailer->send($message);

        return $this->redirectToRoute('dashboard');


    }

}
