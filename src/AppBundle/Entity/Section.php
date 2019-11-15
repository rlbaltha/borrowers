<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\Section
 *
 * @ORM\Table(name="section")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SectionRepository")
 */
class Section
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer $sortorder
     * @ORM\Column(name="sortorder", type="integer", nullable=true)
     */
    private $sortorder;
    
    /**
    * @ORM\ManyToMany(targetEntity="File")
    * @ORM\OrderBy({"sortorder" = "ASC"})
    */
    protected $files;     

    /**
     * @ORM\ManyToOne(targetEntity="Issue", inversedBy="sections")
     * @ORM\JoinColumn(name="issue_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $issue; 
    
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
     * Set title
     *
     * @param string $title
     * @return Section
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
     * Set description
     *
     * @param string $description
     * @return Section
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sortorder
     *
     * @param integer $sortorder
     * @return Section
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

    /**
     * Set issue
     *
     * @param AppBundle\Entity\Issue $issue
     * @return Section
     */
    public function setIssue(\AppBundle\Entity\Issue $issue = null)
    {
        $this->issue = $issue;
        return $this;
    }

    /**
     * Get issue
     *
     * @return AppBundle\Entity\Issue 
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return Section
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
     * @return Section
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
    public function __construct()
    {
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add files
     *
     * @param AppBundle\Entity\File $files
     * @return Section
     */
    public function addFile(\AppBundle\Entity\File $files)
    {
        $this->files[] = $files;
        return $this;
    }

    /**
     * Remove files
     *
     * @param <variableType$files
     */
    public function removeFile(\AppBundle\Entity\File $files)
    {
        $this->files->removeElement($files);
    }

    /**
     * Get files
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFiles()
    {
        return $this->files;
    }
}