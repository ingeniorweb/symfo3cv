<?php

namespace ResumeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ResumeBundle\Entity\Experience;
use ResumeBundle\Form\ExperienceType;

/**
 * Experience controller.
 *
 * @Route("/admin/experiences")
 */
class ExperienceController extends Controller
{
    /**
     * Lists all Experience entities.
     *
     * @Route("/", name="admin_experiences_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $experiences = $em->getRepository('ResumeBundle:Experience')->findAll();

        return $this->render('experience/index.html.twig', array(
            'experiences' => $experiences,
        ));
    }

    /**
     * Creates a new Experience entity.
     *
     * @Route("/new", name="admin_experiences_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $experience = new Experience();
        $form = $this->createForm('ResumeBundle\Form\ExperienceType', $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush();

            return $this->redirectToRoute('admin_experiences_show', array('id' => $experience->getId()));
        }

        return $this->render('experience/new.html.twig', array(
            'experience' => $experience,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Experience entity.
     *
     * @Route("/{id}", name="admin_experiences_show")
     * @Method("GET")
     */
    public function showAction(Experience $experience)
    {
        $deleteForm = $this->createDeleteForm($experience);

        return $this->render('experience/show.html.twig', array(
            'experience' => $experience,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Experience entity.
     *
     * @Route("/{id}/edit", name="admin_experiences_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Experience $experience)
    {
        $deleteForm = $this->createDeleteForm($experience);
        $editForm = $this->createForm('ResumeBundle\Form\ExperienceType', $experience);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush();

            return $this->redirectToRoute('admin_experiences_edit', array('id' => $experience->getId()));
        }

        return $this->render('experience/edit.html.twig', array(
            'experience' => $experience,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Experience entity.
     *
     * @Route("/{id}", name="admin_experiences_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Experience $experience)
    {
        $form = $this->createDeleteForm($experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($experience);
            $em->flush();
        }

        return $this->redirectToRoute('admin_experiences_index');
    }

    /**
     * Creates a form to delete a Experience entity.
     *
     * @param Experience $experience The Experience entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Experience $experience)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_experiences_delete', array('id' => $experience->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
