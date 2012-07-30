<?php

namespace Soloist\Bundle\DocumentBundle\EventListener;

use FrequenceWeb\Bundle\DashboardBundle\Menu\Event\Configure;

/**
 * Dashboard listener: add the bundle to the admin panel
 */
class DashboardListener
{
    public function onConfigureNewMenu(Configure $event)
    {
        $root = $event->getRoot();
        $root->addChild('Document', array(
            'route'           => 'soloist_document_admin_document_new'
        ));
    }

    public function onConfigureTopMenu(Configure $event)
    {
        $root = $event->getRoot();
        $root->addChild('Documents', array('route' => 'soloist_document_admin_category_index'));
    }
}
