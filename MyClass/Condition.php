<?php

namespace ITDoors\CommonBundle\MyClass;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use ITDoors\CommonBundle\MyClass\AjaxTableColumn;

/**
 * Condition
 *
 * This class has to create conditions
 */
class Condition
{
    private $columnAffected;

    private $conditionSign;

    private $value;

    private $columnCompared;

    private $columnResult;

    private $changes;

}