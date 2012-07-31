<?php

namespace Soloist\Bundle\DocumentBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerAware;
use Soloist\Bundle\DocumentBundle\Entity\Document;
/**
 * Document manager
 */
class Document extends ContainerAware
{
    public function getPath(Document $file)
    {
        $path = $this->container->getParameter('kernel.root_dir');
        $path .= '/' . $this->container->getParameter('soloist_document_upload_dir');
        $path .= '/' . $document->getFilename();

        return $path;
    }
}
