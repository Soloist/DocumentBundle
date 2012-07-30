<?php

namespace Soloist\Bundle\DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * List documents
     * @return array
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine();
        $categories = $em->getRepository('SoloistDocumentBundle:Category');

        return array(
            'categories' => $categories
        );
    }


    /**
     * Download a document
     * @param  Document $document
     * @return Response
     */
    public function downloadAction(Document $document)
    {
        $path = $this->container->getParameter('kernel.root_dir');
        $path .= '/' . $this->container->getParameter('soloist_document_upload_dir');
        $path .= '/' . $document->getFilename();

        if (!is_file($path)) {
            throw new $this->createNotFoundException();
        }

        $response = new StreamedResponse();
        $response->headers->set('Content-Type', $file->getMimeType());

        $response->setCallback(function () use ($path) {
            echo readfile($path);
            flush();
        });

        return $response;

    }
}
