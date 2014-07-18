<?php

namespace ITDoors\CommonBundle\MyClass;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

namespace ITDoors\CommonBundle\MyClass;

/**
 * AjaxTable
 *
 * This class to create ajax table
 */
class AjaxTableColumn
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $header;

    /**
     * @var string
     */
    private $type;

    /**
     * @var bool
     */
    private $show;

    /**
     * @var string
     */
    private $condition;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
        $this->setHeader($name);
        $this->setType('text');
        $this->setShow(true);
    }

    /**
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    protected function getName()
    {
        return $this->name;
    }

    /**
     * @param string $header
     */
    protected function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return $this->header;
    }

    /**
     * @param string $type
     */
    protected function setType($type)
    {
        $type = ucfirst(strtolower($type));
        $className = 'ITDoors\CommonBundle\MyClass\AjaxTableType'.$type;
        $newType =  new $className;
        $this->type = $newType;
    }

    /**
     * @return string
     */
    protected function getType()
    {
        return $this->type;
    }

    /**
     * @param string $condition
     */
    protected function setCondition($condition)
    {
        $this->condition = $condition;
    }

    /**
     * @return string
     */
    protected function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param bool $show
     */
    protected function setShow($show)
    {
        $this->show = $show;
    }

    /**
     * @return bool
     */
    protected function getShow()
    {
        return $this->show;
    }
}
