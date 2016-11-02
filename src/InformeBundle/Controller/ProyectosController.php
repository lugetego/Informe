<?php

namespace InformeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use InformeBundle\Entity\Proyectos;
use InformeBundle\Form\ProyectosType;

/**
 * Proyectos controller.
 *
 * @Route("/proyectos")
 */
class ProyectosController extends Controller
{
    /**
     * Lists all Proyectos entities.
     *
     * @Route("/", name="proyectos_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->get('security.context')->getToken()->getUser();
        $proyectos = $user->getAcademico()->getProyectos();

        return $this->render('proyectos/index.html.twig', array(
            'proyectos' => $proyectos,
        ));
    }

    /**
     * Creates a new Proyectos entity.
     *
     * @Route("/new", name="proyectos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();

        $proyecto = new Proyectos();
        $form = $this->createForm('InformeBundle\Form\ProyectosType', $proyecto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $proyecto->setAcademico($user->getAcademico());
            $em->persist($proyecto);
            $em->flush();

            //return $this->redirectToRoute('proyectos_show', array('id' => $proyecto->getId()));
            return $this->redirectToRoute('proyectos_index');

        }

        return $this->render('proyectos/new.html.twig', array(
            'proyecto' => $proyecto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Proyectos entity.
     *
     * @Route("/{id}", name="proyectos_show")
     * @Method("GET")
     */
    public function showAction(Proyectos $proyecto)
    {
        $deleteForm = $this->createDeleteForm($proyecto);

        // check for "view" access: calls all voters
        $this->denyAccessUnlessGranted('view', $proyecto);

        return $this->render('proyectos/show.html.twig', array(
            'proyecto' => $proyecto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Proyectos entity.
     *
     * @Route("/{id}/edit", name="proyectos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Proyectos $proyecto)
    {
        $deleteForm = $this->createDeleteForm($proyecto);
        $this->denyAccessUnlessGranted('edit', $proyecto);

        $editForm = $this->createForm('InformeBundle\Form\ProyectosType', $proyecto);

        $editForm->remove('tipos');
        $editForm->remove('tipo');


        $editForm->add('tipo','Symfony\Component\Form\Extension\Core\Type\TextType', array('label' => 'Tipo de programa'));

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proyecto);
            $em->flush();

            //return $this->redirectToRoute('proyectos_show', array('id' => $proyecto->getId()));
            return $this->redirectToRoute('proyectos_index');

        }

        return $this->render('proyectos/edit.html.twig', array(
            'id'=>$proyecto->getId(),
            'proyecto' => $proyecto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Proyectos entity.
     *
     * @Route("/{id}", name="proyectos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Proyectos $proyecto)
    {
        $form = $this->createDeleteForm($proyecto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($proyecto);
            $em->flush();
        }

        return $this->redirectToRoute('proyectos_index');
    }

    /**
     * Creates a form to delete a Proyectos entity.
     *
     * @param Proyectos $proyecto The Proyectos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Proyectos $proyecto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proyectos_delete', array('id' => $proyecto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
