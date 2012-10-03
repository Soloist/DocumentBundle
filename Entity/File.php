<?php

namespace Soloist\Bundle\DocumentBundle\Entity;

class File
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * Filename
     * @var string
     */
    protected $filename;

    /**
     * Name
     * @var string
     */
    protected $name;

    /**
     * Document
     * @var Document
     */
    protected $document;

    /**
<<<<<<< Updated upstream
     * Meta data
     * @var string
     */
    protected $metadata;

    /**
=======
>>>>>>> Stashed changes
     * Creation date
     * @var \DateTime
     */
    protected $createdAt;
    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get filename
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filename
     * @param string $filename
     * @return  File
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

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
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     * @param string $name
     * @return  File
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get document
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set name
     * @param Document $document
     * @return  File
     */
    public function setDocument(Document $document)
    {
        $this->document = $document;

        return $this;
    }


    public function getPath($path='')
    {
        return $path . '/' . $this->filename;
    }
}
