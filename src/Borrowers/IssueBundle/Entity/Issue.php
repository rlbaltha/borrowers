<?php

namespace Borrowers\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Borrowers\IssueBundle\Entity\Issue
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Borrowers\IssueBundle\Entity\IssueRepository")
 */
class Issue
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
     * @var string $issue
     *
     * @ORM\Column(name="issue", type="string", length=255, nullable=true)
     */
    private $issue;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer $display
     *
     * @ORM\Column(name="display", type="integer", nullable=true)
     */
    private $display;

    /**
     * @var string $subtitle
     *
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
     */
    private $subtitle;

    /**
     * @var string $editors
     *
     * @ORM\Column(name="editors", type="string", length=255, nullable=true)
     */
    private $editors;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Section", mappedBy="issue")
     * @ORM\OrderBy({"sortorder" = "ASC"})
     */
    protected $sections;   
    
    /**
     * @ORM\OneToMany(targetEntity="File", mappedBy="issue")
     */
    protected $files;     
    
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

    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->files = new ArrayCollection();
    } 

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
     * Set issue
     *
     * @param string $issue
     * @return Issue
     */
    public function setIssue($issue)
    {
        $this->issue = $issue;
        return $this;
    }

    /**
     * Get issue
     *
     * @return string 
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Issue
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
     * @return Issue
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
     * Set display
     *
     * @param integer $display
     * @return Issue
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
     * Set subtitle
     *
     * @param string $subtitle
     * @return Issue
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set editors
     *
     * @param string $editors
     * @return Issue
     */
    public function setEditors($editors)
    {
        $this->editors = $editors;
        return $this;
    }

    /**
     * Get editors
     *
     * @return string 
     */
    public function getEditors()
    {
        return $this->editors;
    }
    
    /**
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
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
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
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
     * Add sections
     *
     * @param Borrowers\IssueBundle\Entity\Section $sections
     * @return Issue
     */
    public function addSection(\Borrowers\IssueBundle\Entity\Section $sections)
    {
        $this->sections[] = $sections;
        return $this;
    }

    /**
     * Remove sections
     *
     * @param <variableType$sections
     */
    public function removeSection(\Borrowers\IssueBundle\Entity\Section $sections)
    {
        $this->sections->removeElement($sections);
    }

    /**
     * Get sections
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Add files
     *
     * @param Borrowers\IssueBundle\Entity\File $files
     * @return Issue
     */
    public function addFile(\Borrowers\IssueBundle\Entity\File $files)
    {
        $this->files[] = $files;
        return $this;
    }

    /**
     * Remove files
     *
     * @param <variableType$files
     */
    public function removeFile(\Borrowers\IssueBundle\Entity\File $files)
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