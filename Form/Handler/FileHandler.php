<?php

namespace Soloist\Bundle\DocumentBundle\Form\Handler;

use Soloist\Bundle\DocumentBundle\Entity\File,
    Soloist\Bundle\DocumentBundle\Form\Type\FileType;

use Doctrine\ORM\EntityManager,
    Symfony\Component\Form\FormFactory,
    Symfony\Component\Form\Form,
    Symfony\Component\HttpFoundation\Request;

/**
 * Handle a File submisison
 */
class FileHandler
{
    /**
     * @var \filetrine\ORM\EntityManager
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
     * Document
     * @var Document
     */
    protected $document;

    /**
     * Construct the handler
     * @param EntityManager $em
     * @param FormFactory   $formFactory
     * @param string        $absolutePath
     */
    public function __construct(EntityManager $em, FormFactory $formFactory, $absolutePath, $document)
    {
        $this->em           = $em;
        $this->formFactory  = $formFactory;
        $this->absolutePath = $absolutePath;
        $this->document     = $document;
    }

    /**
     * Get the File form
     * @return Form
     */
    public function getForm()
    {
        return $this->formFactory->create(new FileType, new File);
    }

    /**
     * Create a File
     * @param  Form    $form
     * @param  Request $request
     * @return boolean
     */
    public function create(Form $form, Request $request)
    {
        $form->bindRequest($request);
        $fileBase = $form->getData();

        if ($form->isValid()) {
            // Getting the file
            $file = $fileBase->getFilename();

            if (!empty($file)) {

                $this->processUpload($fileBase, $file);
            }
            $fileBase->setDocument($this->document);

            $this->em->persist($fileBase);
            $this->em->flush();

            return true;
        }

        return false;
    }

    /**
     * Update a File
     * @param  Form    $form
     * @param  Request $request
     * @return boolean
     */
    public function update(Form $form, Request $request)
    {
        $fileBase = $form->getData();
        $oldFile = $file->getFilename();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $file = $fileBase->getFilename();

            if (!empty($file)) {
                if (is_file($path = $this->abdolutePath . '/' . $oldFile)) {
                    unset ($path);
                }
                $this->processUpload($fileBase, $file);
            }

            $this->em->flush();

            return true;
        }
        return false;
    }

    /**
     * Process the upload
     * @param  File $fileBase
     * @param  File $file
     */
    public function processUpload($fileBase, $file)
    {
        $name = uniqid()
            . $this->sanitize($file->getClientOriginalName())
            . '.' .$file->guessExtension();
        $file->move($this->absolutePath, $name);
        $fileBase->setFilename($name);
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

