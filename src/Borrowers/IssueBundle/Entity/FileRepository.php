<?php

namespace Borrowers\IssueBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FileRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FileRepository extends EntityRepository
{
    public function findRecentFiles()
    {  
       return $this->getEntityManager()
               ->createQuery('SELECT f from BorrowersIssueBundle:File f ORDER BY f.created DESC')
               ->setMaxResults(25)->getResult();
    } 
}