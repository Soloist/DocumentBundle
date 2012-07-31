<?php

namespace Soloist\Bundle\DocumentBundle\Controller;

use FrequenceWeb\Bundle\DashboardBundle\Controller\ORMCrudController;

use Soloist\Bundle\DocumentBundle\Form\Handler\FileHandler,
    Soloist\Bundle\DocumentBundle\Entity\Document,
    Soloist\Bundle\DocumentBundle\Form\Type\DocumentType,
    Soloist\Bundle\DocumentBundle\Form\Type\FileType;

use Soloist\Bundle\DocumentBundle\Entity\Category;

class AdminDocumentController extends ORMCrudController
{
    /**
     * @return array
     */
    protected function getParams()
    {
        return array(
            'display'      => array(
                'id'          => array('label' => 'N°'),
                'title'       => array('label' => 'Titre'),
                'category'    => array(
                    'label' => 'Catégorie'
                ),
                'description' => array(
                    'label' => 'Description',
                    'type'  => 'longtext'
                ),
                'createdAt'   => array(
                    'label' => 'Date de création',
                    'type'  => 'date'
                ),
                'updatedAt' => array(
                    'label' => 'Dernière mise à jour',
                    'type' => 'date'
                ),
            ),
            'prefix'       => 'soloist_document_admin_document',
            'singular'     => 'document',
            'plural'       => 'documents',
            'form_type'      => new DocumentType,
            'class'          => new Document,
            'object_actions' => array(
                'manage_files' => array(
                    'label' => 'Gérer les fichiers',
                    'route' => 'soloist_document_admin_file',
                )
            ),
            'repository'     => 'SoloistDocumentBundle:Document',
        );
    }


    public function listByCategoryAction(Category $category)
    {
        $documents = $category->getDocuments();

        return $this->render('FrequenceWebDashboardBundle:Crud:index.html.twig', array(
            'objects'       => $documents,
            'currentSort'   => null
        ));
    }

    public function manageFileAction(Document $document)
    {
        $handler = new FileHandler(
            $this->getDoctrine()->getEntityManager(),
            $this->get('form.factory'),
            $this->get('soloist.document.manager.file')->getPartialPath(),
            $document
        );
        $form = $handler->getForm();

        return $this->render('SoloistDocumentBundle:Admin:manage_files.html.twig', array(
            'form'      => $form->createView(),
            'document'  => $document
        ));
    }

    public function createFileAction(Document $document)
    {
        $handler = new FileHandler(
            $this->getDoctrine()->getEntityManager(),
            $this->get('form.factory'),
            $this->get('soloist.document.manager.file')->getPartialPath(),
            $document
        );
        $form = $handler->getForm();

        if ($handler->create($form, $this->get('request'))) {
            $this->setMessageSuccess('Le fichier a bien été ajouté.');

            return $this->redirect($this->generateUrl('soloist_document_admin_file', array('id' => $document->getId())));
        }

        return $this->render('SoloistDocumentBundle:Admin:manage_files.html.twig', array(
            'form'      => $form->createView(),
            'document'  => $document
        ));
    }

    public function deleteFileAction(File $file)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $filename = $file->getFilename();
        $document = $file->getDocument();
        $em->remove($file);

        if (!empty($filename)) {
            $path = $this->getAbsoluteUploadDir() . $filename;

            if (is_file($path)) {
                unlink($path);
            }
        }

        $em->flush();

        return $this->redirect($this->generateUrl(
            'soloist_document_admin_document_index',
            array('id' => $document->getId())
        ));
    }

    public function setMessageSuccess($message)
    {
        $this->get('session')->getFlashBag()->add('success', $message);
    }
}
