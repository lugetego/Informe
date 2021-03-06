<?php

namespace InformeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use InformeBundle\Entity\Investigacion;
use InformeBundle\Entity\User;
use InformeBundle\Entity\Academico;
use InformeBundle\Form\InvestigacionType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use InformeBundle\Security\InvesVoter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


/**
 * Investigacion controller.
 *
 * @Route("/investigacion")
 */
class InvestigacionController extends Controller
{
    /**
     * Lists all Investigacion entities.
     *
     * @Route("/", name="investigacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->get('security.context')->getToken()->getUser();
        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $user->getAcademico());
        $investigaciones = $informe->getInvestigaciones();
        $enviado = $informe->isEnviado();

        return $this->render('investigacion/index.html.twig', array(
            'investigaciones' => $investigaciones,
            'enviado'=>$enviado,
        ));
    }

    /**
     * Creates a new Investigacion entity.
     *
     * @Route("/new", name="investigacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();
        $academico = $user->getAcademico();

        $em = $this->getDoctrine()->getManager();
        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);

        $investigacion = new Investigacion();
        $form = $this->createForm('InformeBundle\Form\InvestigacionType', $investigacion, array('user'=>$user));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $investigacion->setInforme($informe);
            $em->persist($investigacion);
            $em->flush();

            return $this->redirectToRoute('investigacion_index');
           // return $this->redirectToRoute('dashboard');
        }

        return $this->render('investigacion/new.html.twig', array(
            'investigacion' => $investigacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Investigacion entity.
     *
     * @Route("/{id}", name="investigacion_show")
     * @Method("GET")
     */
    public function showAction(Investigacion $investigacion)
    {

        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();
        $academico = $user->getAcademico();

        $em = $this->getDoctrine()->getManager();
        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);
        $enviado = $informe->isEnviado();

        $deleteForm = $this->createDeleteForm($investigacion);

        // check for "view" access: calls all voters
        $this->denyAccessUnlessGranted('view', $investigacion);

        return $this->render('investigacion/show.html.twig', array(
            'investigacion' => $investigacion,
            'enviado'=>$enviado,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Investigacion entity.
     *
     * @Route("/{id}/edit", name="investigacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Investigacion $investigacion)
    {
        $em = $this->getDoctrine()->getManager();

        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();
        $academico = $user->getAcademico();

        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);
        $deleteForm = $this->createDeleteForm($investigacion);
        $this->denyAccessUnlessGranted('edit', $investigacion);
        $editForm = $this->createForm('InformeBundle\Form\InvestigacionType', $investigacion, array('user'=>$user));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($investigacion);
            $em->flush();

            //return $this->redirectToRoute('investigacion_show', array('id' => $investigacion->getId()));

            return $this->redirectToRoute('investigacion_index');

        }

        return $this->render('investigacion/edit.html.twig', array(
            'id'=>$investigacion->getId(),
            'investigacion' => $investigacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Investigacion entity.
     *
     * @Route("/{id}", name="investigacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Investigacion $investigacion)
    {
        $form = $this->createDeleteForm($investigacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($investigacion);
            $em->flush();
        }

        return $this->redirectToRoute('dashboard');
    }

    /**
     * Creates a form to delete a Investigacion entity.
     *
     * @param Investigacion $investigacion The Investigacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Investigacion $investigacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('investigacion_delete', array('id' => $investigacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
