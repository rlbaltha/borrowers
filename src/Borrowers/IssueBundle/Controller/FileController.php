<?php

namespace Borrowers\IssueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Borrowers\IssueBundle\Entity\File;
use Borrowers\IssueBundle\Form\FileType;
use Borrowers\IssueBundle\Form\UploadType;

/**
 * File controller.
 *
 * @Route("/file")
 */
class FileController extends Controller
{
    /**
     * Lists all File entities.
     *
     * @Route("/", name="file")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BorrowersIssueBundle:File')->findRecentFiles();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a File entity.
     *
     * @Route("/{id}/show", name="file_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BorrowersIssueBundle:File')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new File entity.
     *
     * @Route("/new", name="file_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new File();
        $form   = $this->createForm(new FileType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new File entity.
     *
     * @Route("/create", name="file_create")
     * @Method("post")
     * @Template("BorrowersIssueBundle:File:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new File();
        $request = $this->getRequest();
        $form    = $this->createForm(new FileType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('file_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing File entity.
     *
     * @Route("/{id}/edit", name="file_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BorrowersIssueBundle:File')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $editForm = $this->createForm(new FileType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing File entity.
     *
     * @Route("/{id}/update", name="file_update")
     * @Method("post")
     * @Template("BorrowersIssueBundle:File:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BorrowersIssueBundle:File')->find($id);
        $issue = $entity->getIssue()->getId();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $editForm   = $this->createForm(new FileType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

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
     * Deletes a File entity.
     *
     * @Route("/{id}/delete", name="file_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BorrowersIssueBundle:File')->find($id);
            $issue = $entity->getIssue()->getId();

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find File entity.');
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
    
    
    /**
     * Finds and displays a File entity.
     *
     * @Route("/{id}/display", name="file_display")
     * @Template()
     */
    public function displayAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $file = $em->getRepository('BorrowersIssueBundle:File')->find($id);
        $path = '/var/lib/borrowers_docs/'.$file->getPath();

        if (!$file) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

                $xp = new \XsltProcessor();
                
                $xsl = new \DomDocument;
                $xsl->load('bundles/borrowershome/xsl/main.xsl');             
                $xp->importStylesheet($xsl);
                
                $xml_doc = new \DomDocument;
                $xml_doc->load($path);
                
                if ($html = $xp->transformToXML($xml_doc)) {
                } else {
                 trigger_error('XSL transformation failed.', E_USER_ERROR);
                }
          
		$response = new Response();		
		$response->setStatusCode(200);
                $response->headers->set('Content-Type', 'text/html');
		$response->setContent( $html );
                return $response;

    }
    
    /**
     * Uploads a file with a Document entity.
     *
     * @Route("/{issueid}/{sectionid}/upload", name="file_upload")
     * @Template()
     */  
    public function uploadAction($issueid, $sectionid)
    {
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        
        $em = $this->getDoctrine()->getEntityManager();
        $issue = $em->getRepository('BorrowersIssueBundle:Issue')->find($issueid);
        $section = $em->getRepository('BorrowersIssueBundle:Section')->find($sectionid);
        $options = array('issueid' => $issueid);
        $file = new File();
        $file->setIssue($issue);
        $file->setUser($user);
                
        $form = $this->createForm(new UploadType($options), $file);
        $section->addFile($file);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bindRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $file->upload();
                $em->persist($file);
                $em->flush();
    
                return $this->redirect($this->generateUrl('issue_show', array('id' => $issueid)));
            }
        }

    return array('form' => $form->createView());
}

}
