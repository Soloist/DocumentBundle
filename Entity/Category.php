<?php

namespace Soloist\Bundle\DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FrequenceWeb\Bundle\DashboardBundle\Crud\CrudableInterface;

/**
 * Soloist\Bundle\DocumentBundle\Entity\Category
 */
class Category implements CrudableInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var text $description
     */
    protected $description;

    /**
     * Documents
     * @var Document
     */
    protected $documents;

    /**
     * @var string $slug
     */
    protected $slug;


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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return Category
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
     * Get Documents
     * @return ArrayCollection
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Add a document to a category
     * @param Document $document
     */
    public function addDocument(Document $document)
    {
        $this->documents[] = $document;
        $document->setCategory($this);

        return $this;
    }

    /**
     * Return the category as string
     * @return string
     */
    public function __toString()
    {
        return $this->name;
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
