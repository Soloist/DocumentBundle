<?php

namespace Soloist\Bundle\DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * File type
 */
class FileType extends AbstractType
{
    /**
     * @{inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('filename', 'file')
        ;
    }

    /**
     * @{inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Soloist\\Bundle\\DocumentBundle\\Entity\\File',
            )
        );
    }

    /**
     * @{inheritDoc}
     */
    public function getName()
    {
        return 'soloist_document_file';
    }
}
