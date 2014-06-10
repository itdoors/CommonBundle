<?php

namespace ITDoors\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * DaterangeType
 */
class DaterangeType extends AbstractType
{
    /**
     * {@inheritDoc}
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', 'text', array(
                'attr' => array(
                    'class_outer' => 'input-group  itdoors-daterange',
                    'class' => 'form-control can-be-reseted itdoors-daterange-text',
                    'placeholder' => 'Enter date range'
                )
            ))
            ->add('start', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
                'attr' => array(
                    'class_outer' => 'hidden',
                    'class' => 'itdoors-daterange-start can-be-reseted'
                )
            ))
            ->add('end', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
                'attr' => array(
                    'class_outer' => 'hidden',
                    'class' => 'itdoors-daterange-end can-be-reseted'
                )
            ));
    }

    /**
     * {@inheritDoc}
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'invalid_message' => 'Invalid object',
            'entity' => null,
            'error_bubbling' => false,
            'compound' => true
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'daterange';
    }
}
