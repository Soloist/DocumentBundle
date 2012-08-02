<?php

namespace Soloist\Bundle\DocumentBundle\EventListener;

use Soloist\Bundle\CoreBundle\Event\RequestAction;
use Doctrine\ORM\EntityManager;

class SoloistCoreListener
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function onRequestAction(RequestAction $event)
    {
        foreach ($this->em->getRepository('SoloistDocumentBundle:Category')->findAll() as $category) {
            $event->addAction(
                'Catégorie-document : '.$category->getName(),
                'SoloistDocumentBundle:Default:showCategory',
                json_encode(array(
                    'slug'  => $category->getSlug(),
                    'route' => 'soloist_document_show_category'
                ))
            );
        }
    }
}
