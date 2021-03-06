<?php

namespace InformeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use InformeBundle\Entity\Academico;
use InformeBundle\Form\AcademicoType;

/**
 * Academico controller.
 *
 * @Route("/academico")
 */
class AcademicoController extends Controller
{
    /**
     * Lists all Academico entities.
     *
     * @Route("/", name="academico_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $academicos = $em->getRepository('InformeBundle:Academico')->findAll();

        return $this->render('academico/index.html.twig', array(
            'academicos' => $academicos,
        ));
    }

    /**
     * Creates a new Academico entity.
     *
     * @Route("/new", name="academico_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $academico = new Academico();
        $form = $this->createForm('InformeBundle\Form\AcademicoType', $academico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($academico);
            $em->flush();

            return $this->redirectToRoute('academico_show', array('id' => $academico->getId()));
        }

        return $this->render('academico/new.html.twig', array(
            'academico' => $academico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Academico entity.
     *
     * @Route("/{id}", name="academico_show")
     * @Method("GET")
     */
    public function showAction(Academico $academico)
    {
        $deleteForm = $this->createDeleteForm($academico);

        return $this->render('academico/show.html.twig', array(
            'academico' => $academico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Academico entity.
     *
     * @Route("/{id}/edit", name="academico_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Academico $academico)
    {
        $deleteForm = $this->createDeleteForm($academico);
        $editForm = $this->createForm('InformeBundle\Form\AcademicoType', $academico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($academico);
            $em->flush();

            //return $this->redirectToRoute('academico_edit', array('id' => $academico->getId()));
            return $this->redirectToRoute('academico_index');

        }

        return $this->render('academico/edit.html.twig', array(
            'academico' => $academico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Academico entity.
     *
     * @Route("/{id}/admin", name="academico_admin")
     * @Method({"GET", "POST"})
     */
    public function adminAction(Request $request, Academico $academico)
    {
        $deleteForm = $this->createDeleteForm($academico);
        $editForm = $this->createForm('InformeBundle\Form\AcademicoType', $academico);
        $editForm->remove('nombre');
        $editForm->remove('apellido');
        $editForm->remove('nacimiento');
        $editForm->remove('rfc');
        $editForm->remove('user');
//        $editForm->add('aprobado', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
//            'label'=>'Dictamen',
//            'choices'=>array(
//                'Aprobado'=>'Aprobado',
//                'Aprobado con observaciones'=>'Aprobado con observaciones',
//                'No aprobado'=>'No aprobado',
//            ),
//            'placeholder'=>'Seleccionar',
//            'required'=>true,
//            'choices_as_values' => true,
//        ));


        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($academico);
            $em->flush();

            //return $this->redirectToRoute('academico_edit', array('id' => $academico->getId()));
            return $this->redirectToRoute('dashboard');

        }

        return $this->render('academico/dictamen.html.twig', array(
            'academico' => $academico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Academico entity.
     *
     * @Route("/{id}", name="academico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Academico $academico)
    {
        $form = $this->createDeleteForm($academico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($academico);
            $em->flush();
        }

        return $this->redirectToRoute('academico_index');
    }

    /**
     * Creates a form to delete a Academico entity.
     *
     * @param Academico $academico The Academico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Academico $academico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('academico_delete', array('id' => $academico->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
