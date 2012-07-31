<?php

namespace Soloist\Bundle\DocumentBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerAware;
use Soloist\Bundle\DocumentBundle\Entity\File as FileBase;

/**
 * File manager
 */
class File extends ContainerAware
{
    public function getPath(FileBase $file)
    {
        $path = $this->container->getParameter('kernel.root_dir');
        $path .= '/..' . $this->container->getParameter('soloist_document_upload_dir');
        $path .= '/' . $file->getFilename();

        return $path;
    }

    public function getPartialPath()
    {
        $path = $this->container->getParameter('kernel.root_dir');
        $path .= '/..' . $this->container->getParameter('soloist_document_upload_dir');

        return $path;
    }
}
