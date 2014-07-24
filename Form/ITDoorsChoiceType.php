<?php

namespace ITDoors\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * DaterangeCustomType
 */
class ITDoorsChoiceType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'itdoors_choice';
    }
}
