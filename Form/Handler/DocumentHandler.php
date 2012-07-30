<?php

namespace Soloist\Bundle\DocumentBundle\Form\Handler;

use Soloist\Bundle\DocumentBundle\Entity\Document,
    Soloist\Bundle\DocumentBundle\Form\Type\DocumentType;

use Doctrine\ORM\EntityManager,
    Symfony\Component\Form\FormFactory,
    Symfony\Component\Form\Form,
    Symfony\Component\HttpFoundation\Request;

/**
 * Handle a document submisison
 */
class DocumentHandler
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \Symfony\Component\Form\FormFactory
     */
    protected $formFactory;

    /**
     * Path to the upload dir
     * @var string
     */
    protected $absolutePath;

    /**
     * Construct the handler
     * @param EntityManager $em
     * @param FormFactory   $formFactory
     * @param string        $absolutePath
     */
    public function __construct(EntityManager $em, FormFactory $formFactory, $absolutePath)
    {
        $this->em           = $em;
        $this->formFactory  = $formFactory;
        $this->absolutePath = $absolutePath;
    }

    /**
     * Get the document form
     * @return Form
     */
    public function getForm()
    {
        return $this->formFactory->create(new DocumentType, new Document);
    }

    /**
     * Create a document
     * @param  Form    $form
     * @param  Request $request
     * @return boolean
     */
    public function create(Form $form, Request $request)
    {
        $form->bindRequest($request);
        $doc = $form->getData();

        if ($form->isValid()) {
            // Getting the file
            $file = $doc->getFilename();

            if (!empty($file)) {

                $this->processUpload($file, $doc);
            }

            $this->em->persist($doc);
            $this->em->flush();

            return true;
        }

        return false;
    }

    /**
     * Update a document
     * @param  Form    $form
     * @param  Request $request
     * @return boolean
     */
    public function update(Form $form, Request $request)
    {
        $doc = $form->getData();
        $oldFile = $doc->getFilename();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $file = $doc->getFilename();

            if (!empty($file)) {
                if (is_file($path = $this->abdolutePath . '/' . $oldFile)) {
                    unset ($path);
                }
                $this->processUpload($file, $doc);
            }

            $this->em->flush();

            return true;
        }
        return false;
    }

    /**
     * Process the upload
     * @param  File $file
     * @param  Document $doc
     */
    public function processUpload($file, $doc)
    {
        $name = uniqid()
            . $this->sanitize($file->getClientOriginalName())
            . '.' .$file->guessExtension();
        $file->move($this->absolutePath, $name);
        $doc->setFilename($name);
    }

    /**
     * Return a sanitized filename
     *
     * @param string $name
     *
     * @return string
     */
    private function sanitize($name)
    {
        return preg_replace(
            '([^_a-zA-Z0-9])',
            '_',
            str_replace(
                array('doc', 'docx', 'pdf', 'odt'),
                '',
                strtolower($name)
            )
        );
    }

}

