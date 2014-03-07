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
use Borrowers\IssueBundle\Form\UploadMmType;

/**
 * File controller.
 *
 */
class FileController extends Controller
{
    /**
     * Lists all File entities.
     *
     * @Route("/file/", name="file")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BorrowersIssueBundle:File')->findRecentFiles();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a File entity.
     *
     * @Route("/{id}/show", name="file_show", schemes="http")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $file = $em->getRepository('BorrowersIssueBundle:File')->find($id);
        $path = __DIR__.'/../../../../borrowers_docs/'.$file->getPath();

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

        return array(
            'html'      => $html,
      );
    }

    /**
     * Displays a form to create a new File entity.
     *
     * @Route("/file/new", name="file_new")
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
     * @Route("/file/create", name="file_create")
     * @Method("post")
     * @Template("BorrowersIssueBundle:File:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new File();
        $request = $this->getRequest();
        $form    = $this->createForm(new FileType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
     * @Route("/file/{id}/edit", name="file_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

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
     * @Route("/file/{id}/update", name="file_update")
     * @Method("post")
     * @Template("BorrowersIssueBundle:File:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BorrowersIssueBundle:File')->find($id);
        $issue = $entity->getIssue()->getId();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $editForm   = $this->createForm(new FileType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->submit($request);

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
     * @Route("/file/{id}/delete", name="file_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
     * Displays a form to create a new File entity.
     *
     * @Route("/cocoon/borrowers/request ", name="reroute")
     */
    public function rerouteAction()
    {
       $request = $this->getRequest();
       $id = $request->query->get('id');
       return $this->redirect($this->generateUrl('file_display', array('id' => $id)));
    }
    
    
    /**
     * Finds and displays an XSL transformation of a File entity.
     *
     * @Route("/{id}/display", name="file_display")
     * @Template()
     */
    public function displayAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $file = $em->getRepository('BorrowersIssueBundle:File')->find($id);
        $path = __DIR__.'/../../../../borrowers_docs/'.$file->getPath();

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
     * Finds and displays an XSL transformation of a File entity.
     *fop -r -xml /var/lib/borrowers_docs/3009/13424621370831_kk.xml -xsl docs2fo2.xsl  -pdf /home/rlbaltha/pdf1.pdf
     * @Route("/{id}/pdf", name="file_pdf")
     * @Template()
     */
    public function pdfAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $file = $em->getRepository('BorrowersIssueBundle:File')->find($id);
        $xmlpath =  __DIR__.'/../../../../borrowers_docs/'.$file->getPath();
        $xslpath = __DIR__.'/../../../../src/Borrowers/HomeBundle/Resources/public/xsl/pdf.xsl';
        $pdfpath = __DIR__.'/../../../../borrowers_docs/pdftemp.pdf';
        
        $result = $this->get("goetas.fop")->convertToPdf($xmlpath, $pdfpath, $xslpath);
        
        return new Response(
        file_get_contents( $pdfpath ),
        200,
        array(
        'Content-Type'          => 'application/pdf',
        'Content-Disposition'   => 'attachment; filename="borrowers.pdf"'
         )
         );
    }

    
    
    
    
    /**
     * Uploads a file with a Document entity.
     *
     * @Route("/file/{issueid}/{sectionid}/upload", name="file_upload")
     * @Template()
     */  
    public function uploadAction($issueid, $sectionid)
    {
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $issue = $em->getRepository('BorrowersIssueBundle:Issue')->find($issueid);
        $section = $em->getRepository('BorrowersIssueBundle:Section')->find($sectionid);
        $subdir = $issue->getIssue();
        $options = array('issueid' => $issueid);
        $file = new File();
        $file->setIssue($issue);
        $file->setUser($user);
        $file->setFileType(0); 
                
        $form = $this->createForm(new UploadType($options), $file);
        $section->addFile($file);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->submit($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $file->upload();
                $em->persist($file);
                $em->flush();
    
                return $this->redirect($this->generateUrl('issue_show', array('id' => $issueid)));
            }
        }

    return array('form' => $form->createView());
}

    /**
     * Uploads a file with a Document entity.
     *
     * @Route("/file/{issueid}/{sectionid}/upload_mm", name="file_upload_mm")
     * @Template("BorrowersIssueBundle:File:upload.html.twig")
     */  
    public function uploadMmAction($issueid, $sectionid)
    {
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $issue = $em->getRepository('BorrowersIssueBundle:Issue')->find($issueid);
        $section = $em->getRepository('BorrowersIssueBundle:Section')->find($sectionid);
        $options = array('issueid' => $issueid);
        $file = new File();
        $file->setIssue($issue);
        $file->setSortorder(1);
        $file->setUser($user);
        $file->setFileType(1);        
                
        $form = $this->createForm(new UploadMmType($options), $file);
        $section->addFile($file);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->submit($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $file->upload();
                $em->persist($file);
                $em->flush();
    
                return $this->redirect($this->generateUrl('issue_show', array('id' => $issueid)));
            }
        }

    return array('form' => $form->createView());
}


    /**
     * Finds and download a File.
     *
     * @Route("/{id}/download", name="file_download")
     * 
     */     
    public function downloadAction($id)
	{
        
        $em = $this->getDoctrine()->getManager();

        $file = $em->getRepository('BorrowersIssueBundle:File')->find($id);
        $path = __DIR__.'/../../../../borrowers_docs/'.$file->getPath();
        $ext = $file->getExt();
        $filename = $filename = 'attachment; filename="'.$id.'.'.$ext.'"';;
             
        return new Response(
        file_get_contents( $path ),
        200,
        array(
        'Content-Type'          => 'application/force-download',
        'Content-Disposition'   => $filename
         )
         );
	} 
        
        
    /**
     * Finds and displays a File.
     *
     * @Route("/{id}/view_content", name="file_view_content")
     * @Route("/media/{id}/{filename}", name="file_url")
     *    *
     */     
    public function viewContentAction($id)
	{
        
        $em = $this->getDoctrine()->getManager();

        $file = $em->getRepository('BorrowersIssueBundle:File')->find($id);
        $name = $file->getTitle();
        $path = __DIR__.'/../../../../borrowers_docs/'.$file->getPath();
        $ext = $file->getExt();
        $filename = $name.'.'.$ext;
		
		$response = new Response();
		
		$response->setStatusCode(200);
                switch ($ext) {
                      case "png":
                      $response->headers->set('Content-Type', 'image/png');
                      $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;
                      case "gif":
                      $response->headers->set('Content-Type', 'image/gif');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;
                      case "jpg":
                      $response->headers->set('Content-Type', 'image/jpeg');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;
                      case "mp3":
                      $response->headers->set('Content-Type', 'audio/mpeg');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;
                      case "mp4":
                      $response->headers->set('Content-Type', 'video/mp4');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;
                      case "odt":
                      $response->headers->set('Content-Type', 'application/vnd.oasis.opendocument.text');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;
                      case "ods":
                      $response->headers->set('Content-Type', 'application/vnd.oasis.opendocument.spreadsheet');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;
                      case "odp":
                      $response->headers->set('Content-Type', 'application/vnd.oasis.opendocument.presentation');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;
                      case "doc":
                      $response->headers->set('Content-Type', 'application/msword');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;
                      case "ppt":
                      $response->headers->set('Content-Type', 'application/mspowerpoint');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;
                      case "xls":
                      $response->headers->set('Content-Type', 'application/x-msexcel');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;                  
                      case "pdf":
                      $response->headers->set('Content-Type', 'application/pdf');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;
                      case "xml":
                      $response->headers->set('Content-Type', 'text/plain');
                          $response->headers->set('Content-Disposition', 'filename="'.$filename.'"');
                      break;                  
                      default:
                      $response->headers->set('Content-Type', 'application/force-download');    
                      }                    
                      
		$response->setContent( file_get_contents( $path ));
		
		$response->send();
                
                
                
		
		return $response;
	}         

}
