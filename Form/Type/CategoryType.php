<?php

namespace Soloist\Bundle\DocumentBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

/**
 * Category type
 */
class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => 'Soloist\\Bundle\\DocumentBundle\\Entity\\Category',
        ));
    }

    public function getName()
    {
        return 'soloist_document_category';
    }
}
