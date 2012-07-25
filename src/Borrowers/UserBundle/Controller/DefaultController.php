<?php

namespace Borrowers\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    
     /**
     * Create Users
      * for importing for migration
     *
     * @Route("/createusers", name="import_createusers")
     * * @Template("BorrowersUserBundle:Default:index.html.twig")
     */
    
   /** public function createusersAction()
    {

          $em = $this->getDoctrine()->getEntityManager();
          $dql1 = "SELECT i FROM BorrowersIssueBundle:Import i WHERE i.pw!=''";
          $oldusers = $em->createQuery($dql1)->getResult();  
          $userManager = $this->get('fos_user.user_manager');

          foreach ($oldusers as $item) {
          $newItem = $userManager->createUser();

          //$newItem->setId($item->getObjId());
          // FOSUserBundle required fields
          $newItem->setUsername($item->getUsername());
          $newItem->setUserid($item->getId());
          $newItem->setLastname($item->getLastname());
          $newItem->setFirstname($item->getFirstname());
          $newItem->setEmail($item->getEmail());
          $newItem->setPlainPassword($item->getPw()); // get original password
          $newItem->setEnabled(true);

          $userManager->updateUser($newItem, true);

        };
        return $this->redirect($this->generateUrl('directory'));
        
    }     
    */
    
}
