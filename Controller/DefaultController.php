<?php

namespace Soloist\Bundle\DocumentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;

use Soloist\Bundle\DocumentBundle\Entity\Category,
    Soloist\Bundle\DocumentBundle\Entity\Document,
    Soloist\Bundle\DocumentBundle\Entity\File;

/**
 * Default controller to show documents
 */
class DefaultController extends Controller
{
    /**
     * List categories
     *
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $categories = $this->getDoctrine()->getRepository('SoloistDocumentBundle:Category')->findAll();

        return array('categories' => $categories);
    }

    /**
     * List documents
     *
     * @Template()
     *
     * @param  Category $category
     *
     * @return array
     */
    public function showCategoryAction(Category $category)
    {
        return array('category' => $category);
    }

    /**
     * List files
     *
     * @Template()
     *
     * @param  Document $category
     *
     * @return array
     */
    public function showDocumentAction(Document $document)
    {
        return array('document' => $document);
    }


    /**
     * Download a document
     *
     * @param   Document $document
     * @throws  \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return StreamedResponse
     */
    public function downloadAction(File $file)
    {
        $path = $this->get('soloist.document.manager.file')->getPath($file);

        if (!is_file($path)) {
            throw $this->createNotFoundException('Document file not found : '.$path);
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);

        $response = new StreamedResponse();
        $response->headers->set('Content-Type', $finfo->file($path));
        $response->headers->set('Content-Length', filesize($path));
        $response->headers->set('Content-Disposition', 'attachment; filename=' . basename($path));
        $file = new \SplFileObject($path);

        // 10 ko by iteration
        $file->setMaxLineLen(10000);

        $response->setCallback(function () use ($file) {
            foreach ($file as $line) {
                echo $line;
                flush();
            }
        });

        return $response;
    }
}
