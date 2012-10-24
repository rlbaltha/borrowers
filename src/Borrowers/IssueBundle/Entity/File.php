<?php

namespace Borrowers\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Borrowers\IssueBundle\Entity\File
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Borrowers\IssueBundle\Entity\FileRepository")
 */
class File
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;    

    /**
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    
    /**
     * @var integer $display
     *
     * @ORM\Column(name="display", type="integer", nullable=true)
     */
    private $display=0;    
    
    /**
     * @ORM\ManyToOne(targetEntity="Issue", inversedBy="file")
     * @ORM\JoinColumn(name="issue_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $issue; 
    
    /**
     * @var integer $sortorder
     * @ORM\Column(name="sortorder", type="integer", nullable=true)
     */
    private $sortorder = 1;    

    /**
     * @var integer $courseid
     *
     * @ORM\Column(name="courseid", type="integer", nullable=true)
     */
    private $courseid;

    /**
     * @var integer $projectid
     *
     * @ORM\Column(name="projectid", type="integer", nullable=true)
     */
    private $projectid;

    /**
     * @var integer $stageid
     *
     * @ORM\Column(name="stageid", type="integer", nullable=true)
     */
    private $stageid;

    /**
     * @var integer $userid
     *
     * @ORM\Column(name="userid", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var integer $essayid
     *
     * @ORM\Column(name="essayid", type="integer", nullable=true)
     */
    private $essayid;
    
    /**
    * @ORM\ManyToOne(targetEntity="Borrowers\UserBundle\Entity\User", inversedBy="file")
    */
    protected $user;    
    
    /**
    * @ORM\ManyToMany(targetEntity="Borrowers\IssueBundle\Entity\Author", inversedBy="file")
    */
    protected $authors;      

    /**
    * @ORM\Column(type="datetime", nullable=true)
    * @Gedmo\Timestampable(on="create")
    */
    protected $created;
    
    
    /**
    * @ORM\Column(type="datetime", nullable=true)
    * @Gedmo\Timestampable(on="update")
    */
    protected $updated;  
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return File
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return File
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set display
     *
     * @param integer $display
     * @return File
     */
    public function setDisplay($display)
    {
        $this->display = $display;
        return $this;
    }

    /**
     * Get display
     *
     * @return integer 
     */
    public function getDisplay()
    {
        return $this->display;
    }    

    /**
     * Set courseid
     *
     * @param integer $courseid
     * @return File
     */
    public function setCourseid($courseid)
    {
        $this->courseid = $courseid;
        return $this;
    }

    /**
     * Get courseid
     *
     * @return integer 
     */
    public function getCourseid()
    {
        return $this->courseid;
    }

    /**
     * Set projectid
     *
     * @param integer $projectid
     * @return File
     */
    public function setProjectid($projectid)
    {
        $this->projectid = $projectid;
        return $this;
    }

    /**
     * Get projectid
     *
     * @return integer 
     */
    public function getProjectid()
    {
        return $this->projectid;
    }

    /**
     * Set stageid
     *
     * @param integer $stageid
     * @return File
     */
    public function setStageid($stageid)
    {
        $this->stageid = $stageid;
        return $this;
    }

    /**
     * Get stageid
     *
     * @return integer 
     */
    public function getStageid()
    {
        return $this->stageid;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return File
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
        return $this;
    }

    /**
     * Get userid
     *
     * @return integer 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set essayid
     *
     * @param integer $essayid
     * @return File
     */
    public function setEssayid($essayid)
    {
        $this->essayid = $essayid;
        return $this;
    }

    /**
     * Get essayid
     *
     * @return integer 
     */
    public function getEssayid()
    {
        return $this->essayid;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return File
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     * @return File
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set user
     *
     * @param Borrowers\UserBundle\Entity\User $user
     * @return File
     */
    public function setUser(\Borrowers\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Borrowers\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set issue
     *
     * @param Borrowers\IssueBundle\Entity\Issue $issue
     * @return File
     */
    public function setIssue(\Borrowers\IssueBundle\Entity\Issue $issue = null)
    {
        $this->issue = $issue;
        return $this;
    }

    /**
     * Get issue
     *
     * @return Borrowers\IssueBundle\Entity\Issue 
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * Set sortorder
     *
     * @param integer $sortorder
     * @return File
     */
    public function setSortorder($sortorder)
    {
        $this->sortorder = $sortorder;
        return $this;
    }

    /**
     * Get sortorder
     *
     * @return integer 
     */
    public function getSortorder()
    {
        return $this->sortorder;
    }
    
    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/../../'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'borrowers_docs/uploads/files';
    }  
    
    public function upload()
    {
    // the file property can be empty if the field is not required
    if (null === $this->file) {
        return;
    }

    // we use the original file name here but you should
    // sanitize it at least to avoid any security issues

    // move takes the target directory and then the target filename to move to
    $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

    // set the path property to the filename where you'ved saved the file
    $this->path = 'uploads/files/'.$this->file->getClientOriginalName();
    
    // set the name property to the filename where you'ved saved the file
    $this->name = $this->file->getClientOriginalName();    

    // clean up the file property as you won't need it anymore
    $this->file = null;
    }     
    
    public function __construct()
    {
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add authors
     *
     * @param Borrowers\IssueBundle\Entity\Author $authors
     * @return File
     */
    public function addAuthor(\Borrowers\IssueBundle\Entity\Author $authors)
    {
        $this->authors[] = $authors;
        return $this;
    }

    /**
     * Remove authors
     *
     * @param <variableType$authors
     */
    public function removeAuthor(\Borrowers\IssueBundle\Entity\Author $authors)
    {
        $this->authors->removeElement($authors);
    }

    /**
     * Get authors
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAuthors()
    {
        return $this->authors;
    }
    
    /**
     * Return the extention of the file.
     * 
     * @return string
     */
    public function getExt()
    {
        $filename = $this->getPath(); 
        return pathinfo($filename, PATHINFO_EXTENSION);
    }    
       
}