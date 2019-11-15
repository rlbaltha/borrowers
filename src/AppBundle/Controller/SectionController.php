<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Section;
use AppBundle\Form\SectionType;

/**
 * Section controller.
 *
 * @Route("/section")
 */
class SectionController extends Controller
{
    /**
     * Lists all Section entities.
     *
     * @Route("/", name="section")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Section')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Section entity.
     *
     * @Route("/{id}/show", name="section_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Section')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Section entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Section entity.
     *
     * @Route("/{issue_id}/new", name="section_new")
     * @Template()
     */
    public function newAction($issue_id)
    {

        
        $entity = new Section();
        $form   = $this->createForm(SectionType::class, $entity);

        return array(
            'issue_id' => $issue_id,
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Section entity.
     *
     * @Route("/{issue_id}/create", name="section_create")
     * @Method("post")
     * @Template("AppBundle:Section:new.html.twig")
     */
    public function createAction(Request $request, $issue_id)
    {
        $em = $this->getDoctrine()->getManager();
        $issue = $em->getRepository('AppBundle:Issue')->find($issue_id);
        $entity  = new Section();
        $entity->setIssue($issue);

        $form    = $this->createForm(SectionType::class, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('issue_show', array('id' => $issue_id)));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Section entity.
     *
     * @Route("/{id}/edit", name="section_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Section')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Section entity.');
        }

        $editForm = $this->createForm(SectionType::class, $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Section entity.
     *
     * @Route("/{id}/update", name="section_update")
     * @Method("post")
     * @Template("AppBundle:Section:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Section')->find($id);
        $issue = $entity->getIssue()->getId();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Section entity.');
        }

        $editForm   = $this->createForm(SectionType::class, $entity);
        $deleteForm = $this->createDeleteForm($id);

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('issue_show', array('id' => $issue)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Section entity.
     *
     * @Route("/{id}/delete", name="section_delete")
     * @Method("post")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Section')->find($id);
            $issue = $entity->getIssue()->getId();

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Section entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('issue_show', array('id' => $issue)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
