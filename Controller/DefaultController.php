<?php

namespace Soloist\Bundle\DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Component\HttpFoundation\StreamedResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Soloist\Bundle\DocumentBundle\Entity\Category,
    Soloist\Bundle\DocumentBundle\Entity\Document;

/**
 * Default controller to show documents
 */
class DefaultController extends Controller
{
    /**
     * List categories
     * @return array
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine();
        $categories = $em->getRepository('SoloistDocumentBundle:Category')->findAll();

        return array(
            'categories' => $categories
        );
    }

    /**
     * List documents
     * @param  Category $category
     * @return array
     * @Template()
     * @ParamConverter("category", class="SoloistDocumentBundle:Category")
     */
    public function showCategoryAction(Category $category)
    {
        $documents = $category->getDocuments();

        return array('documents' => $documents);
    }


    /**
     * Download a document
     * @param  Document $document
     * @return Response
     */
    public function downloadAction(Document $document)
    {
        $path = $this->get('soloist.document.manager.document')->getPath($document);

        if (!is_file($path)) {
            throw new $this->createNotFoundException();
        }

        $response = new StreamedResponse();
        $response->headers->set('Content-Type', $file->getMimeType());
        $splFile = SplFileObject($path);

        // 10 ko by iteration
        $sqlFile->setMaxLineLen(10000);

        $response->setCallback(function () use ($file) {
            foreach ($file as $line) {
                echo $line;
                flush();
            }
        });

        return $response;

    }
}
