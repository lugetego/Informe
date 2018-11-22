<?php

namespace InformeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use InformeBundle\Entity\Salidas;
use InformeBundle\Form\SalidasType;

/**
 * Salidas controller.
 *
 * @Route("/salidas")
 */
class SalidasController extends Controller
{
    /**
     * Lists all Salidas entities.
     *
     * @Route("/", name="salidas_index")
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

        $salidas = $em->getRepository('InformeBundle:Salidas')->findSalidas($informe->getId());

        $enviado = $informe->isEnviado();

        return $this->render('salidas/index.html.twig', array(
            'salidas' => $salidas,
            'enviado'=>$enviado,
            'titulo' => 'Licencias, comisiones',
        ));
    }

    /**
     * Lists all Salidas entities.
     *
     * @Route("/visitas", name="visitas_index")
     * @Method("GET")
     */
    public function visitasAction()
    {

        $em = $this->getDoctrine()->getManager();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->get('security.context')->getToken()->getUser();
        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $user->getAcademico());

        $visitantes = $em->getRepository('InformeBundle:Salidas')->findByVisitantes($informe->getId());

        $enviado = $informe->isEnviado();


        return $this->render('salidas/index.html.twig', array(
            'salidas' => $visitantes,
            'enviado'=>$enviado,
            'titulo' => 'Visitantes',
        ));

    }

    /**
     * Creates a new Salidas entity.
     *
     * @Route("/new", name="salidas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();
        $academico = $user->getAcademico();

        $em = $this->getDoctrine()->getManager();
        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);

        $salida = new Salidas();
        $form = $this->createForm('InformeBundle\Form\SalidasType', $salida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $salida->setInforme($informe);
            $em->persist($salida);
            $em->flush();

            if ($salida->getTipo() == 'Visitante') {
                return $this->redirectToRoute('visitas_index');
            }
            else {
                //return $this->redirectToRoute('salidas_show', array('id' => $salida->getId()));
                return $this->redirectToRoute('salidas_index');
            }

        }

        return $this->render('salidas/new.html.twig', array(
            'salida' => $salida,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Salidas entity.
     *
     * @Route("/{id}", name="salidas_show")
     * @Method("GET")
     */
    public function showAction(Salidas $salida)
    {
        $securityContext = $this->container->get('security.token_storage');
        $user = $securityContext->getToken()->getUser();
        $academico = $user->getAcademico();

        $em = $this->getDoctrine()->getManager();
        $informe = $em->getRepository('InformeBundle:Informe')->findOneByAnio(2018, $academico);
        $enviado = $informe->isEnviado();

        $deleteForm = $this->createDeleteForm($salida);

        // check for "view" access: calls all voters
        $this->denyAccessUnlessGranted('view', $salida);


        return $this->render('salidas/show.html.twig', array(
            'salida' => $salida,
            'enviado'=>$enviado,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Salidas entity.
     *
     * @Route("/{id}/edit", name="salidas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Salidas $salida)
    {
        $deleteForm = $this->createDeleteForm($salida);
        $this->denyAccessUnlessGranted('edit', $salida);
        $editForm = $this->createForm('InformeBundle\Form\SalidasType', $salida);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salida);
            $em->flush();

            if ($salida->getTipo() == 'Visitante') {
                return $this->redirectToRoute('visitas_index');
            }
            else {
                //return $this->redirectToRoute('salidas_show', array('id' => $salida->getId()));
                return $this->redirectToRoute('salidas_index');
            }

        }

        return $this->render('salidas/edit.html.twig', array(
            'id'=>$salida->getId(),
            'salida' => $salida,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Salidas entity.
     *
     * @Route("/{id}", name="salidas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Salidas $salida)
    {
        $form = $this->createDeleteForm($salida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($salida);
            $em->flush();
        }

        return $this->redirectToRoute('salidas_index');
    }

    /**
     * Creates a form to delete a Salidas entity.
     *
     * @param Salidas $salida The Salidas entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Salidas $salida)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('salidas_delete', array('id' => $salida->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
