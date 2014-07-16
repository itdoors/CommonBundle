<?php

namespace ITDoors\CommonBundle\MyClass;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * AjaxTable
 *
 * This class to create ajax table
 */
namespace ITDoors\CommonBundle\MyClass;


class AjaxTableColumn {

    private $name;

    private $header;

    private $type;

    private $show;

    private $condition;


    public function __construct($name) {
        $this->setName($name);
        $this->setHeader($name);
        $this->setType('text');
        $this->setShow(true);
    }

    protected function setName($name) {
        $this->name = $name;
    }

    protected function getName() {
        return $this->name;
    }

    protected function setHeader($header) {
        $this->header = $header;
    }

    protected function getHeader() {
        return $this->header;
    }

    protected function setType($type) {
        $type = ucfirst(strtolower($type));
        $className = 'ITDoors\CommonBundle\MyClass\AjaxTableType'.$type;
        $newType =  new $className;
        $this->type = $newType;
    }

    protected function getType() {
        return $this->type;
    }

    protected function setCondition($condition) {
        $this->condition = $condition;
    }

    protected function getCondition() {
        return $this->condition;
    }

    protected function setShow($show) {
        $this->show = $show;
    }

    protected function getShow() {
        return $this->show;
    }
} 