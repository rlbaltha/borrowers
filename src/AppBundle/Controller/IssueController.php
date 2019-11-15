<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * @Template("AppBundle:Issue:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issues = $em->getRepository('AppBundle:Issue')->listIssues();

        return array('issues' => $issues);
    }

    /**
     * Finds and displays a Issue entity.
     *
     * @Route("/issue/{id}/show", name="issue_show")
     * @Template("AppBundle:Issue:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->find($id);

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
     * @Template("AppBundle:Issue:toc.html.twig")
     */
    public function tocAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        return array('issue' => $issue,);
    }
    
    
    /**
     * Lists all archived Issue entities.
     *
     * @Route("/archive", name="issue_archive")
     * @Template("AppBundle:Issue:archive.html.twig")
     */
    public function archiveAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issues = $em->getRepository('AppBundle:Issue')->listArchive();

        return array('issues' => $issues);
    }
    
    /**
     * Show About page.
     *
     * @Route("/about", name="issue_about")
     * @Template("AppBundle:Issue:about.html.twig")
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
     * @Template("AppBundle:Issue:toc.html.twig")
     */
    public function currentAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->findCurrentIssue();

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        return array('issue' => $issue,);
    }
    
    /**
     * Finds and displays a Issue entity.
     *
     * @Route("/previous", name="issue_previous")
     * @Template("AppBundle:Issue:toc.html.twig")
     */
    public function previousAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->findPreviousIssue();

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }

        return array('issue' => $issue,);
    }    

    /**
     * Displays a form to create a new Issue entity.
     *
     * @Route("/issue/new", name="issue_new")
     * @Template("AppBundle:Issue:new.html.twig")
     */
    public function newAction()
    {
        $issue = new Issue();
        $form   = $this->createForm(IssueType::class, $issue);

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
     * @Template("AppBundle:Issue:new.html.twig")
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

        return array(
            'issue' => $issue,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Issue entity.
     *
     * @Route("/issue/{id}/edit", name="issue_edit")
     * @Template("AppBundle:Issue:edit.html.twig")
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
     * @Template("AppBundle:Issue:edit.html.twig")
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
