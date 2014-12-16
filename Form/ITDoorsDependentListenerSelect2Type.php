<?php

namespace ITDoors\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;

/**
 * ITDoorsDependentListenerSelect2Type
 */
class ITDoorsDependentListenerSelect2Type extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'hidden';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'itdoors_dependent_listener_select2';
    }
}
