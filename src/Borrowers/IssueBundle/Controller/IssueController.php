<?php

namespace Borrowers\IssueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Borrowers\IssueBundle\Entity\Issue;
use Borrowers\IssueBundle\Form\IssueType;

/**
 * Issue controller.
 *
 * @Route("/issue")
 */
class IssueController extends Controller
{
    /**
     * Lists all Issue entities.
     *
     * @Route("/", name="issue")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $issues = $em->getRepository('BorrowersIssueBundle:Issue')->findAll();

        return array('issues' => $issues);
    }

    /**
     * Finds and displays a Issue entity.
     *
     * @Route("/{id}/show", name="issue_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $issue = $em->getRepository('BorrowersIssueBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'issue'      => $issue,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Issue entity.
     *
     * @Route("/new", name="issue_new")
     * @Template()
     */
    public function newAction()
    {
        $issue = new Issue();
        $form   = $this->createForm(new IssueType(), $issue);

        return array(
            'issue' => $issue,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Issue entity.
     *
     * @Route("/create", name="issue_create")
     * @Method("post")
     * @Template("BorrowersIssueBundle:Issue:new.html.twig")
     */
    public function createAction()
    {
        $issue  = new Issue();
        $request = $this->getRequest();
        $form    = $this->createForm(new IssueType(), $issue);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($issue);
            $em->flush();

            return $this->redirect($this->generateUrl('issue_show', array('id' => $issue->getId())));
            
        }

        return array(
            'issue' => $issue,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Issue entity.
     *
     * @Route("/{id}/edit", name="issue_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $issue = $em->getRepository('BorrowersIssueBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        $editForm = $this->createForm(new IssueType(), $issue);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'issue'      => $issue,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Issue entity.
     *
     * @Route("/{id}/update", name="issue_update")
     * @Method("post")
     * @Template("BorrowersIssueBundle:Issue:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $issue = $em->getRepository('BorrowersIssueBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        $editForm   = $this->createForm(new IssueType(), $issue);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($issue);
            $em->flush();

            return $this->redirect($this->generateUrl('issue_show', array('id' => $id)));
        }

        return array(
            'issue'      => $issue,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Issue entity.
     *
     * @Route("/{id}/delete", name="issue_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $issue = $em->getRepository('BorrowersIssueBundle:Issue')->find($id);

            if (!$issue) {
                throw $this->createNotFoundException('Unable to find Issue entity.');
            }

            $em->remove($issue);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('issue'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
