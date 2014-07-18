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
class AjaxTable
{
    /**
     * @var string
     */
    protected $patternTable = 'ITDoorsCommonBundle:BaseTable:BaseTable.html.twig';

    /**
     * @var string
     */
    protected $patternTableRow = 'ITDoorsCommonBundle:BaseTable:BaseTableRow.html.twig';

    /**
     * @var AjaxTableColumn[]
     */
    private $data;

    /**
     * @var mixed[]
     */
    private $options;

    /**
     * @var mixed[]
     */
    private $columns;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $holder;

    /**
     * __constructor method
     *
     * @param mixed[] $data
     * @param string  $namespace
     * @param string  $holder
     */
    public function __construct(array $data, $namespace, $holder)
    {
        $this->setData($data);
        //$this->setOptions($options);
        $this->setNamespace($namespace);
        $this->setHolder($holder);
        if (count($data) == 0) {
            //need Exception here (no rows found. Initial array is empty)
        }
        $columns = array_keys($data[0]);
        foreach ($columns as $columnName) {
            $this->columns[] = new AjaxTableColumn($columnName);
        }
/*
        $headers = $this->getTableHeaders();
        $dataPrepared = $this->getTableData();

        return $this->environment->render($this->patternTable, array(
            'headers' => $headers,
            'data' => $dataPrepared,
            'holder' => $this->holder,
            'namespace' => $this->namespace,

        ));
*/
    }

    /**
     * @param string $columnName
     *
     * @return bool|mixed
     */
    public function findColumn($columnName)
    {
        $columns = $this->getColumns();

        if (!count($columns)) {
            //need Exception here (no column exists)
        }

        foreach ($columns as $column) {
            if ($column->getName() == $columnName) {
                return $column;
            }
        }

        return false;
    }

    /**
     * @param string $searchColumn
     * @param string $newColumn
     */
    public function copyColumn($searchColumn, $newColumn)
    {
        $search = $this->findColumn($searchColumn);

        $new = clone $search;
        $new->setName($newColumn);
        $this->columns[] =  $new;
    }

    /**
     * @param string $column
     */
    public function showColumn($column)
    {
        $allColumns = $this->getColumns();
        foreach ($allColumns as $column) {
            $column->setShow(false);
        }

        if (is_array($column)) {
            foreach ($column as $columnShow) {
                $search = $this->findColumn($columnShow);
                $search->setShow(true);
            }
        } else {
            $search = $this->findColumn($column);
            $search->setShow(true);
        }
    }

    /**
     * @param string $column
     */
    public function hideColumn($column)
    {
        $allColumns = $this->getColumns();
        foreach ($allColumns as $column) {
            $column->setShow(true);
        }

        if (is_array($column)) {
            foreach ($column as $columnHide) {
                $search = $this->findColumn($columnHide);
                $search->setShow(false);
            }
        } else {
            $search = $this->findColumn($column);
            $search->setShow(false);
        }
    }

    /**
     * @param string $columnSearch1
     * @param string $columnSearch2
     * @param string $outputColumn
     */
    public function concateColumns($columnSearch1, $columnSearch2, $outputColumn)
    {
        $column1 = $this->findColumn($columnSearch1);
        $column2 = $this->findColumn($columnSearch2);

        //need update
    }
    /**
     * setter for data
     *
     * @param mixed[] $data
     */
    protected function setData($data)
    {
        $this->data = $data;
    }

    /**
     * setter for options
     *
     * @param mixed[] $options
     */
    protected function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * setter for $pattern
     *
     * @param mixed[] $pattern
     */
    protected function setPattern($pattern)
    {
        if ($pattern) {
            $this->patternTable = $pattern;
        }
    }

    /**
     * setter for $holder
     *
     * @param string $holder
     */
    protected function setHolder($holder)
    {
        $this->holder = $holder;
    }

    /**
     * setter for $namespace
     *
     * @param string $namespace
     */
    protected function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * setter for $columns
     *
     * @param string $columns
     */
    protected function setColumns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * @return mixed[]
     */
    protected function getColumns()
    {
        return $this->columns;
    }
}
