<?php

namespace ITDoors\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;

/**
 * ITDoorsDependentListenerSelect2ToSelect2Type
 */
class ITDoorsDependentListenerSelect2ToSelect2Type extends AbstractType
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
        return 'itdoors_dependent_listener_select2_to_select2';
    }
}
