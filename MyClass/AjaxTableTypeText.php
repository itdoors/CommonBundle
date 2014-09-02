<?php

namespace ITDoors\CommonBundle\MyClass;

use ITDoors\CommonBundle\MyClass\AjaxTableTypeInterface;

/**
 * Class AjaxTableTypeText
 */
class AjaxTableTypeText implements AjaxTableTypeInterface
{

    /**
     * @var string
     */
    private $value;

    /**
     * @var bool
     */
    private $htmlEntities;

    /**
     * @var string
     */
    private $classes;

    /**
     * @return void
     */
    public function render()
    {

    }
}
