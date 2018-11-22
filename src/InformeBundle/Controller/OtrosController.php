<?php

namespace InformeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use InformeBundle\Entity\Otros;
use InformeBundle\Form\OtrosType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


/**
 * Otros controller.
 *
 * @Route("/otros")
 */
class OtrosController extends Controller
{
    /**
     * Lists all Otros entities.
     *
     * @Route("/", name="otros_index")
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

        $otros = $informe->getotros();
        $enviado = $informe->isEnviado();


        return $this->render('otros/index.html.twig', array(
            'otros' => $otros,
            'enviado'=>$enviado,
        ));

    }

    /**
     * Creates a new Otros entity.
     *
     * @Route("/new", name="otros_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();
        $academico = $user->getAcademico();

        $em = $this->getDoctrine()->getManager();
        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);

        $otro = new Otros();
        $form = $this->createForm('InformeBundle\Form\OtrosType', $otro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $otro->setInforme($informe);
            $em->persist($otro);
            $em->flush();

            return $this->redirectToRoute('otros_index');
            //return $this->redirectToRoute('dashboard');
        }

        return $this->render('otros/new.html.twig', array(
            'otro' => $otro,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Otros entity.
     *
     * @Route("/{id}", name="otros_show")
     * @Method("GET")
     */
    public function showAction(Otros $otro)
    {
        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();
        $academico = $user->getAcademico();

        $em = $this->getDoctrine()->getManager();

        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);

        $enviado = $informe->isEnviado();


        $deleteForm = $this->createDeleteForm($otro);

        // check for "view" access: calls all voters
        $this->denyAccessUnlessGranted('view', $otro);

        return $this->render('otros/show.html.twig', array(
            'otro' => $otro,
            'enviado'=>$enviado,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Estudiantes entity.
     *
     * @Route("/{id}/edit", name="otros_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Otros $otro)
    {
        $deleteForm = $this->createDeleteForm($otro);
        $editForm = $this->createForm('InformeBundle\Form\OtrosType', $otro);
        $this->denyAccessUnlessGranted('edit', $otro);

        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($otro);
            $em->flush();

            //return $this->redirectToRoute('estudiantes_show', array('id' => $estudiante->getId()));
            return $this->redirectToRoute('otros_index');

        }

        return $this->render('otros/edit.html.twig', array(
            'id'=>$otro->getId(),
            'otro' => $otro,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Otros entity.
     *
     * @Route("/{id}", name="otros_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Otros $otro)
    {
        $form = $this->createDeleteForm($otro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($otro);
            $em->flush();
        }

        return $this->redirectToRoute('otros_index');
    }

    /**
     * Creates a form to delete a Otros entity.
     *
     * @param Otros $estudiante The Otros entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Otros $otros)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('otros_delete', array('id' => $otros->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
