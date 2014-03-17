<?php

namespace ITDoors\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * DaterangeCustomType
 */
class DaterangeCustomType extends AbstractType
{
    /**
     * {@inheritDoc}
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', 'text', array(
                'attr' => array(
                    'class_outer' => 'input-group  itdoors-daterange-custom tooltips',
                    'class' => 'form-control can-be-reseted itdoors-daterange-text ',
                    'placeholder' => 'Enter date range',
                    'data-original-title' => 'Enter date range'
                )
            ));
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'daterange';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'daterangecustom';
    }
}
