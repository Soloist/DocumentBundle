<?php

namespace Soloist\Bundle\DocumentBundle\Manager;

use Soloist\Bundle\DocumentBundle\Entity\File as FileEntity;

/**
 * File manager
 */
class File
{
    /**
     * The base path from the bundle config
     *
     * @var string
     */
    protected $basePath;

    /**
     * Constructor, take the upload basePath as parameter
     *
     * @param $basePath
     */
    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * Returns the computed path for a file
     *
     * @param  FileEntity $file
     * @return string
     */
    public function getPath(FileEntity $file)
    {
        return $this->basePath . '/' . $file->getFilename();
    }

    /**
     * Returns the basepath
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }
}
