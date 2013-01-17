<?php

namespace Soloist\Bundle\DocumentBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Soloist\Bundle\CoreBundle\Event\RequestAction;

class SoloistCoreListener
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param RequestAction $event
     */
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
