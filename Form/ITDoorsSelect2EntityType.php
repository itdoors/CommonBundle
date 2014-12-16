<?php

namespace ITDoors\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;

/**
 * ITDoorsSelect2EntityType
 */
class ITDoorsSelect2EntityType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'itdoors_select2_entity';
    }
}
