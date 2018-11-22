<?php

namespace InformeBundle\Controller;

use InformeBundle\Entity\Tecnico;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tecnico controller.
 *
 * @Route("tecnico")
 */
class TecnicoController extends Controller
{
    /**
     * Lists all tecnico entities.
     *
     * @Route("/", name="tecnico_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tecnicos = $em->getRepository('InformeBundle:Tecnico')->findAll();

        return $this->render('tecnico/index.html.twig', array(
            'tecnicos' => $tecnicos,
        ));
    }

    /**
     * Creates a new tecnico entity.
     *
     * @Route("/new", name="tecnico_new")
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

        $tecnico = new Tecnico();
        $form = $this->createForm('InformeBundle\Form\TecnicoType', $tecnico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $tecnico->setAcademico($academico);
            $em->persist($tecnico);
            $em->flush($tecnico);

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('tecnico/new.html.twig', array(
            'tecnico' => $tecnico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tecnico entity.
     *
     * @Route("/{id}", name="tecnico_show")
     * @Method("GET")
     */
    public function showAction(Tecnico $tecnico)
    {

        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();
        $academico = $user->getAcademico();

        $em = $this->getDoctrine()->getManager();
        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);
        $enviado = $informe->isEnviado();
        $tecnicos = $em->getRepository('InformeBundle:Tecnico')->findOneByInforme($informe);




        $deleteForm = $this->createDeleteForm($tecnico);

        // check for "view" access: calls all voters
        $this->denyAccessUnlessGranted('view', $tecnico);

        return $this->render('tecnico/show.html.twig', array(
            'academico'=>$academico,
            'tecnicos' => $tecnicos,
            'enviado'=>$enviado,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tecnico entity.
     *
     * @Route("/{id}/edit", name="tecnico_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tecnico $tecnico)
    {
        $this->denyAccessUnlessGranted('edit', $tecnico);
        $em = $this->getDoctrine()->getManager();


        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();
        $academico = $user->getAcademico();
        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);

        $enviado = $informe->isEnviado();


        $deleteForm = $this->createDeleteForm($tecnico);
        $editForm = $this->createForm('InformeBundle\Form\TecnicoType', $tecnico);
        $this->denyAccessUnlessGranted('edit', $tecnico);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tecnico_edit', array('id' => $tecnico->getId()));
        }

        return $this->render('tecnico/edit.html.twig', array(
            'tecnico' => $tecnico,
            'enviado' => $enviado,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tecnico entity.
     *
     * @Route("/{id}", name="tecnico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tecnico $tecnico)
    {
        $form = $this->createDeleteForm($tecnico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tecnico);
            $em->flush($tecnico);
        }

        return $this->redirectToRoute('tecnico_index');
    }

    /**
     * Creates a form to delete a tecnico entity.
     *
     * @param Tecnico $tecnico The tecnico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tecnico $tecnico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tecnico_delete', array('id' => $tecnico->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
