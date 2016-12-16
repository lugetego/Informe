<?php

namespace InformeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use InformeBundle\Entity\Posdoc;
use InformeBundle\Form\PosdocType;

/**
 * Posdoc controller.
 *
 * @Route("posdoc")
 */
class PosdocController extends Controller
{
    /**
     * Lists all posdoc entities.
     *
     * @Route("/", name="posdoc_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $posdocs = $em->getRepository('InformeBundle:Posdoc')->findAll();

        //return $this->render('posdoc/index.html.twig', array(
          //  'posdocs' => $posdocs,
        //));
    }

    /**
     * Creates a new posdoc entity.
     *
     * @Route("/new", name="posdoc_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();

        $posdoc = new Posdoc();
        $form = $this->createForm('InformeBundle\Form\PosdocType', $posdoc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $posdoc->setAcademico($user->getAcademico());
            $em->persist($posdoc);
            $em->flush($posdoc);

            //return $this->redirectToRoute('posdoc_show', array('id' => $posdoc->getId()));
            return $this->redirectToRoute('estudiantes_index');
        }

        return $this->render('posdoc/new.html.twig', array(
            'posdoc' => $posdoc,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a posdoc entity.
     *
     * @Route("/{id}", name="posdoc_show")
     * @Method("GET")
     */
    public function showAction(Posdoc $posdoc)
    {
        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();
        $enviado = $user->getAcademico()->isEnviado();

        $deleteForm = $this->createDeleteForm($posdoc);

        // check for "view" access: calls all voters
        $this->denyAccessUnlessGranted('view', $posdoc);

        return $this->render('posdoc/show.html.twig', array(
            'posdoc' => $posdoc,
            'enviado'=>$enviado,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing posdoc entity.
     *
     * @Route("/{id}/edit", name="posdoc_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Posdoc $posdoc)
    {
        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();

        $deleteForm = $this->createDeleteForm($posdoc);
        $editForm = $this->createForm('InformeBundle\Form\PosdocType', $posdoc);

        $this->denyAccessUnlessGranted('edit', $posdoc);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('posdoc_edit', array('id' => $posdoc->getId()));
            return $this->redirectToRoute('estudiantes_index');

        }

        return $this->render('posdoc/edit.html.twig', array(
            'id'=>$posdoc->getId(),
            'posdoc' => $posdoc,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a posdoc entity.
     *
     * @Route("/{id}", name="posdoc_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Posdoc $posdoc)
    {
        $form = $this->createDeleteForm($posdoc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($posdoc);
            $em->flush($posdoc);
        }

        return $this->redirectToRoute('estudiantes_index');
    }

    /**
     * Creates a form to delete a posdoc entity.
     *
     * @param Posdoc $posdoc The posdoc entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Posdoc $posdoc)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('posdoc_delete', array('id' => $posdoc->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
