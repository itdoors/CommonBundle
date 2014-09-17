<?php
namespace ITDoors\CommonBundle\MyClass;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use ITDoors\CommonBundle\MyClass\AjaxTableColumn;

/**
 * AjaxTable
 *
 * This class to create ajax table
 */
interface AjaxTableTypeInterface
{
    /**
     * @return mixed
     */
    public function render();
}
