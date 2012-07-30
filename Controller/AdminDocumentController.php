<?php

namespace Soloist\Bundle\DocumentBundle\Controller;

use FrequenceWeb\Bundle\DashboardBundle\Controller\ORMCrudController;

use Soloist\Bundle\DocumentBundle\Form\Handler\DocumentHandler,
    Soloist\Bundle\DocumentBundle\Entity\Document,
    Soloist\Bundle\DocumentBundle\Form\Type\DocumentType;

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
            'repository'     => 'SoloistDocumentBundle:Document',
        );
    }

    /**
     * @return \FrequenceWeb\Bundle\DashboardBundle\Crud\Form\Handler
     */
    protected function getFormHandler()
    {
        return new DocumentHandler(
            $this->getDoctrine()->getEntityManager(),
            $this->get('form.factory'),
            $this->container->getParameter('kernel.root_dir') . '/..' . $this->container->getParameter('soloist_document_upload_dir')
        );
    }
}
