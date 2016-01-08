<?php

namespace ResumeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ResumeBundle\Entity\Texte;
use ResumeBundle\Form\TexteType;

/**
 * Texte controller.
 *
 * @Route("/admin/textes")
 */
class TexteController extends Controller
{
    /**
     * Lists all Texte entities.
     *
     * @Route("/", name="admin_textes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $textes = $em->getRepository('ResumeBundle:Texte')->findAll();

        return $this->render('texte/index.html.twig', array(
            'textes' => $textes,
        ));
    }

    /**
     * Creates a new Texte entity.
     *
     * @Route("/new", name="admin_textes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $texte = new Texte();
        $form = $this->createForm('ResumeBundle\Form\TexteType', $texte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($texte);
            $em->flush();

            return $this->redirectToRoute('admin_textes_show', array('id' => $texte->getId()));
        }

        return $this->render('texte/new.html.twig', array(
            'texte' => $texte,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Texte entity.
     *
     * @Route("/{id}", name="admin_textes_show")
     * @Method("GET")
     */
    public function showAction(Texte $texte)
    {
        $deleteForm = $this->createDeleteForm($texte);

        return $this->render('texte/show.html.twig', array(
            'texte' => $texte,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Texte entity.
     *
     * @Route("/{id}/edit", name="admin_textes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Texte $texte)
    {
        $deleteForm = $this->createDeleteForm($texte);
        $editForm = $this->createForm('ResumeBundle\Form\TexteType', $texte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($texte);
            $em->flush();

            return $this->redirectToRoute('admin_textes_edit', array('id' => $texte->getId()));
        }

        return $this->render('texte/edit.html.twig', array(
            'texte' => $texte,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Texte entity.
     *
     * @Route("/{id}", name="admin_textes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Texte $texte)
    {
        $form = $this->createDeleteForm($texte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($texte);
            $em->flush();
        }

        return $this->redirectToRoute('admin_textes_index');
    }

    /**
     * Creates a form to delete a Texte entity.
     *
     * @param Texte $texte The Texte entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Texte $texte)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_textes_delete', array('id' => $texte->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
