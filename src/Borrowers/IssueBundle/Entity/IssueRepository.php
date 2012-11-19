<?php

namespace Borrowers\IssueBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * IssueRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IssueRepository extends EntityRepository
{
    public function listIssues()
    {
        $repostitory = $this->getEntityManager()->getRepository('BorrowersIssueBundle:Issue');
        $query = $repostitory->createQueryBuilder('i')
                ->orderBy('i.issue','DESC')
                ->getQuery();
        return  $query->getResult();
    }
    
    public function listArchive()
    {
        $repostitory = $this->getEntityManager()->getRepository('BorrowersIssueBundle:Issue');
        $query = $repostitory->createQueryBuilder('i')
                ->orderBy('i.issue','ASC')
                ->where("i.display >= :display")
                ->setParameter('display', 1)
                ->getQuery();
        return  $query->getResult();
    }    
 
    public function findCurrentIssue()
    {
        $repostitory = $this->getEntityManager()->getRepository('BorrowersIssueBundle:Issue');
        $query = $repostitory->createQueryBuilder('i')
                ->where("i.display = :display")
                ->setParameter('display', 3)
                ->getQuery();
        return  $query->getOneOrNullResult();
    }
    
    public function findPreviousIssue()
    {
        $repostitory = $this->getEntityManager()->getRepository('BorrowersIssueBundle:Issue');
        $query = $repostitory->createQueryBuilder('i')
                ->where("i.display = :display")
                ->setParameter('display', 2)
                ->getQuery();
        return  $query->getOneOrNullResult();
    } 

}