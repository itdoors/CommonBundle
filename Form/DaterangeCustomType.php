<?php

namespace ITDoors\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * DaterangeCustomType
 */
class DaterangeCustomType extends AbstractType
{
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

    public function getParent()
    {
        return 'daterange';
    }

    public function getName()
    {
        return 'daterangecustom';
    }
}