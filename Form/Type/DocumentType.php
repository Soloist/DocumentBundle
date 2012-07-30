<?php

namespace Soloist\Bundle\DocumentBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

/**
 * Document type
 */
class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('category')
            ->add('filename', 'file')
        ;
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Soloist\\Bundle\\DocumentBundle\\Entity\\Document',
        );
    }

    public function getName()
    {
        return 'soloist_document_document';
    }
}
