<?php

namespace Soloist\Bundle\DocumentBundle\Controller;

use FrequenceWeb\Bundle\DashboardBundle\Controller\ORMCrudController;

use Soloist\Bundle\DocumentBundle\Entity\Category,
    Soloist\Bundle\DocumentBundle\Form\Type\CategoryType;

class AdminCategoryController extends ORMCrudController
{
    /**
     * @return array
     */
    protected function getParams()
    {
        return array(
            'display'      => array(
                'id'          => array('label' => 'N°'),
                'name'       => array('label' => 'Nom'),
                'description' => array(
                    'label' => 'Description',
                    'type'  => 'longtext'
                )
            ),
            'prefix'       => 'soloist_document_admin_category',
            'singular'     => 'catégorie',
            'plural'       => 'catégories',
            'form_type'      => new CategoryType,
            'class'          => new Category,
            'object_actions' => array(
                'manage_documents' => array(
                    'label' => 'Documents',
                    'route' => 'soloist_blog_admin_document',
                )
            ),
            'repository'     => 'SoloistDocumentBundle:Category',
        );
    }
}
