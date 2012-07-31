<?php

namespace Soloist\Bundle\DocumentBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

/**
 * File type
 */
class FileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('filename', 'file')
        ;
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Soloist\\Bundle\\DocumentBundle\\Entity\\File',
        );
    }

    public function getName()
    {
        return 'soloist_document_file';
    }
}
