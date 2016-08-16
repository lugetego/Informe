<?php

namespace InformeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use InformeBundle\Entity\Eventos;
use InformeBundle\Form\EventosType;

/**
 * Eventos controller.
 *
 * @Route("/eventos")
 */
class EventosController extends Controller
{
    /**
     * Lists all Eventos entities.
     *
     * @Route("/", name="eventos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $eventos = $em->getRepository('InformeBundle:Eventos')->findAll();

        return $this->render('eventos/index.html.twig', array(
            'eventos' => $eventos,
        ));
    }

    /**
     * Creates a new Eventos entity.
     *
     * @Route("/new", name="eventos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();

        $evento = new Eventos();
        $form = $this->createForm('InformeBundle\Form\EventosType', $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $evento->setAcademico($user->getAcademico());
            $em->persist($evento);
            $em->flush();

            return $this->redirectToRoute('eventos_show', array('id' => $evento->getId()));
        }

        return $this->render('eventos/new.html.twig', array(
            'evento' => $evento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Eventos entity.
     *
     * @Route("/{id}", name="eventos_show")
     * @Method("GET")
     */
    public function showAction(Eventos $evento)
    {
        $deleteForm = $this->createDeleteForm($evento);

        return $this->render('eventos/show.html.twig', array(
            'evento' => $evento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Eventos entity.
     *
     * @Route("/{id}/edit", name="eventos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Eventos $evento)
    {
        $deleteForm = $this->createDeleteForm($evento);
        $editForm = $this->createForm('InformeBundle\Form\EventosType', $evento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evento);
            $em->flush();

            return $this->redirectToRoute('eventos_show', array('id' => $evento->getId()));
        }

        return $this->render('eventos/edit.html.twig', array(
            'evento' => $evento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Eventos entity.
     *
     * @Route("/{id}", name="eventos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Eventos $evento)
    {
        $form = $this->createDeleteForm($evento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evento);
            $em->flush();
        }

        return $this->redirectToRoute('eventos_index');
    }

    /**
     * Creates a form to delete a Eventos entity.
     *
     * @param Eventos $evento The Eventos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Eventos $evento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eventos_delete', array('id' => $evento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
