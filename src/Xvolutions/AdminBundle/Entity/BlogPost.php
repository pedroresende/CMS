<?php

namespace Xvolutions\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BlogPost
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BlogPost
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_url", type="integer")
     */
    private $id_url;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     *
     */
    private $tag;

    /**
     * @ORM\ManyToMany(targetEntity="Category")
     *
     */
    private $category;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="id_language", referencedColumnName="id")
     */
    private $id_language;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Section")
     * @ORM\JoinColumn(name="id_section", referencedColumnName="id")
     */
    private $id_section;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->section = new ArrayCollection();
        $this->language = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return BlogPost
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
     * Set URL
     *
     * @param string $id_url
     * @return Url
     */
    public function setIdUrl($id_url)
    {
        $this->id_url = $id_url;

        return $this;
    }

    /**
     * Get URL
     *
     * @return string 
     */
    public function getIdUrl()
    {
        return $this->id_url;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return BlogPost
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return BlogPost
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return BlogPost
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    public function setTag( $tag ) {
        $this->tag = $tag;

        return $this;
    }

    public function getTag() {
        return $this->tag->toArray();
    }

    
    public function setCategory( $category ) {
        $this->category = $category;

        return $this;
    }

    public function getCategory() {
        return $this->category->toArray();
    }

    /**
     * Get id_section
     *
     * @return integer 
     */
    public function getIdsection()
    {
        return $this->id_section;
    }

    /**
     * Set id_section
     *
     * @param integer id_section
     * @return Section ID
     */
    public function setIdsection($id_section)
    {
        $this->id_section = $id_section;

        return $this;
    }

    /**
     * Get id_language
     *
     * @return integer 
     */
    public function getIdlanguage()
    {
        return $this->id_language;
    }

    /**
     * Set id_language
     *
     * @param integer id_language
     * @return Page's Language ID
     */
    public function setIdlanguage($id_language)
    {
        $this->id_language = $id_language;

        return $this;
    }
}
