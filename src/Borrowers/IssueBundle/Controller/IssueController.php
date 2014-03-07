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
 */
class IssueController extends Controller
{
    /**
     * Lists all Issue entities.
     *
     * @Route("/issue/", name="issue")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issues = $em->getRepository('BorrowersIssueBundle:Issue')->listIssues();

        return array('issues' => $issues);
    }

    /**
     * Finds and displays a Issue entity.
     *
     * @Route("/issue/{id}/show", name="issue_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

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
     * Finds and displays a Issue entity.
     *
     * @Route("/{id}/toc", name="issue_toc")
     * @Template()
     */
    public function tocAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('BorrowersIssueBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        return array('issue' => $issue,);
    }
    
    
    /**
     * Lists all archived Issue entities.
     *
     * @Route("/archive", name="issue_archive")
     * @Template()
     */
    public function archiveAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issues = $em->getRepository('BorrowersIssueBundle:Issue')->listArchive();

        return array('issues' => $issues);
    }
    
    /**
     * Show About page.
     *
     * @Route("/about", name="issue_about")
     * @Template()
     */
    public function aboutAction()
    {
        $about = '';
        return array('about' => $about);
    }    
    
  
    /**
     * Finds and displays a Issue entity.
     *
     * @Route("/current", name="issue_current")
     * @Template("BorrowersIssueBundle:Issue:toc.html.twig")
     */
    public function currentAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('BorrowersIssueBundle:Issue')->findCurrentIssue();

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        return array('issue' => $issue,);
    }
    
    /**
     * Finds and displays a Issue entity.
     *
     * @Route("/previous", name="issue_previous")
     * @Template("BorrowersIssueBundle:Issue:toc.html.twig")
     */
    public function previousAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('BorrowersIssueBundle:Issue')->findPreviousIssue();

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        return array('issue' => $issue,);
    }    

    /**
     * Displays a form to create a new Issue entity.
     *
     * @Route("/issue/new", name="issue_new")
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
     * @Route("/issue/create", name="issue_create")
     * @Method("post")
     * @Template("BorrowersIssueBundle:Issue:new.html.twig")
     */
    public function createAction()
    {
        $issue  = new Issue();
        $request = $this->getRequest();
        $form    = $this->createForm(new IssueType(), $issue);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
     * @Route("/issue/{id}/edit", name="issue_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

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
     * @Route("/issue/{id}/update", name="issue_update")
     * @Method("post")
     * @Template("BorrowersIssueBundle:Issue:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('BorrowersIssueBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        $editForm   = $this->createForm(new IssueType(), $issue);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->submit($request);

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
     * @Route("/issue/{id}/delete", name="issue_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
