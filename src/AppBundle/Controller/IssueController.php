<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Issue;
use AppBundle\Form\IssueType;

/**
 * Issue controller.
 */
class IssueController extends Controller
{
    /**
     * Lists all Issue entities.
     *
     * @Route("/issue/", name="issue")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issues = $em->getRepository('AppBundle:Issue')->listIssues();

        return $this->render('@App/Issue/index.html.twig', array(
            'issues' => $issues
        ));
    }

    /**
     * Finds and displays a Issue entity.
     *
     * @Route("/issue/{id}/show", name="issue_show")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('@App/Issue/show.html.twig', array(
            'issue'      => $issue,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Finds and displays a Issue entity.
     *
     * @Route("/{id}/toc", name="issue_toc")
     */
    public function tocAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        return $this->render('@App/Issue/toc.html.twig', array(
            'issue' => $issue
        ));
    }
    
    
    /**
     * Lists all archived Issue entities.
     *
     * @Route("/archive", name="issue_archive")
     */
    public function archiveAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issues = $em->getRepository('AppBundle:Issue')->listArchive();

        return $this->render('@App/Issue/archive.html.twig', array(
            'issues' => $issues
        ));
    }
    
    /**
     * Show About page.
     *
     * @Route("/about", name="issue_about")
     */
    public function aboutAction()
    {
        $about = '';

        return $this->render('@App/Issue/about.html.twig', array(
            'about' => $about
        ));
    }    
    
  
    /**
     * Finds and displays a Issue entity.
     *
     * @Route("/current", name="issue_current")
     */
    public function currentAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->findCurrentIssue();

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        return $this->render('@App/Issue/toc.html.twig', array(
            'issue' => $issue,
        ));
    }
    
    /**
     * Finds and displays a Issue entity.
     *
     * @Route("/previous", name="issue_previous")
     */
    public function previousAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->findPreviousIssue();

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }
        return $this->render('@App/Issue/toc.html.twig', array(
            'issue' => $issue,
        ));
    }    

    /**
     * Displays a form to create a new Issue entity.
     *
     * @Route("/issue/new", name="issue_new")

     */
    public function newAction()
    {
        $issue = new Issue();
        $form   = $this->createForm(IssueType::class, $issue);

        return $this->render('@App/Issue/new.html.twig', array(
            'issue' => $issue,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Issue entity.
     *
     * @Route("/issue/create", name="issue_create")
     */
    public function createAction(Request $request)
    {
        $issue  = new Issue();
        $form    = $this->createForm(IssueType::class, $issue);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($issue);
            $em->flush();

            return $this->redirect($this->generateUrl('issue_show', array('id' => $issue->getId())));
            
        }

        return $this->render('@App/Issue/new.html.twig', array(
            'issue' => $issue,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Issue entity.
     *
     * @Route("/issue/{id}/edit", name="issue_edit")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        $editForm = $this->createForm(IssueType::class, $issue);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('@App/Issue/edit.html.twig', array(
            'issue'      => $issue,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Issue entity.
     *
     * @Route("/issue/{id}/update", name="issue_update")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        $editForm   = $this->createForm(IssueType::class, $issue);
        $deleteForm = $this->createDeleteForm($id);


        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($issue);
            $em->flush();

            return $this->redirect($this->generateUrl('issue_show', array('id' => $id)));
        }

        return $this->render('@App/Issue/edit.html.twig', array(
            'issue'      => $issue,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Issue entity.
     *
     * @Route("/issue/{id}/delete", name="issue_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $issue = $em->getRepository('AppBundle:Issue')->find($id);

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
            ->add('id', HiddenType::class)
            ->getForm()
        ;
    }
}
