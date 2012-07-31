<?php

namespace Soloist\Bundle\DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FrequenceWeb\Bundle\DashboardBundle\Crud\CrudableInterface;

/**
 * Soloist\Bundle\DocumentBundle\Entity\Document
 */
class Document implements CrudableInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var text $description
     */
    protected $description;

    /**
     * Creation date
     * @var DateTime
     */
    protected $createdAt;

    /**
     * Update date
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * Category of the document
     * @var Soloist\Bundle\DocumentBundle\Entity\Category
     */
    protected $category;

    /**
     * @var ArrayCollection
     */
    protected $files;

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
     * @return Document
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
     * @param text $description
     * @return Document
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return text
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get files
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Set the filename
     * @param $filename
     */
    public function addFile($file)
    {
        $this->files->add($file);
        $file->setDocument($this);

        return $this;
    }

    /**
     * Set created date
     * @param \DateTime $date
     */
    public function setCreatedAt(\DateTime $date)
    {
        $this->createdAt = $date;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set update date
     * @param \DateTime $date
     */
    public function setUpdatedAt(\DateTime $date)
    {
        $this->UpdatedAt = $date;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the category
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the category
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Crudable
     * @return array
     */
    public function getRouteParams()
    {
        return array(
            'id' => $this->id
        );
    }
}
