<?php

/**
 * Rendering table twig extension
 *
 * @author Denys Lishchenko silence4r4@mail.ru
 */

namespace ITDoors\CommonBundle\Twig;

/**
 * BaseTableExtension class
 *
 * Twig extension
 */
class BaseTableExtension extends \Twig_Extension
{

    /**
     * @var \Twig_Environment
     */
    protected $environment;

    /**
     * @var string
     */
    protected $patternTable = 'ITDoorsCommonBundle:BaseTable:BaseTable.html.twig';

    /**
     * @var string
     */
    protected $patternTableRow = 'ITDoorsCommonBundle:BaseTable:BaseTableRow.html.twig';

    /**
     * @var mixed[]
     */
    private $data;

    /**
     * @var mixed[]
     */
    private $options;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $holder;

    /**
     * {@inheritDoc}
     */
    public function initRuntime (\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }
    /**
     * getName of extension
     *
     * @return string
     */
    public function getName ()
    {
        return 'base_table';
    }
    /**
     * {@inheritDoc}
     */
    public function getFunctions ()
    {
        return array (
            'base_table_render' => new \Twig_Function_Method($this, 'render', array ('is_safe' => array ('html')))
        );
    }
    /**
     * render the table due to the data and options
     *
     * @param mixed[] $data
     * @param mixed[] $options
     * @param string  $namespace
     * @param string  $holder
     *
     * @return Response
     */
    public function render (array $data, array $options = array (), $namespace = '', $holder = '')
    {
        $this->setData($data);
        $this->setOptions($options);
        $this->setNamespace($namespace);
        $this->setHolder($holder);
        $headers = $this->getTableHeaders();
        $dataPrepared = $this->getTableData();

        return $this->environment->render($this->patternTable, array (
                'headers' => $headers,
                'data' => $dataPrepared,
                'holder' => $this->holder,
                'namespace' => $this->namespace,
        ));
    }
    /**
     * prepares data for the table
     *
     * @return mixed[]
     */
    public function getTableData ()
    {
        $data = $this->data;
        $i = 0;
        $dataPrepared = array ();
        foreach ($data as $keyRow => $dataRow) {
            foreach ($dataRow as $keyItem => $item) {
                if (!$this->checkToShow($keyItem)) {
                    continue;
                }

                $dataPrepared[$keyRow][$keyItem] = array (
                    'type' => 'text',
                    'editable' => false,
                    'class' => '',
                    'value' => $item
                );
                if (!empty($this->options[$keyItem])) {
                    if (isset($this->options[$keyItem]['type'])) {
                        $dataPrepared[$keyRow][$keyItem]['type'] = $this->options[$keyItem]['type'];
                        $tempType = $this->options[$keyItem]['type'];
                        if ($tempType == 'checkbox') {
                            // if type checkbox
                            $dataPrepared[$keyRow][$keyItem]['param']['checked'] = false;
                            if (
                                    isset($this->options[$keyItem]['param']['checked'])
                                    &&
                                    $this->options[$keyItem]['param']['checked'] === true
                                ) {
                                $dataPrepared[$keyRow][$keyItem]['param']['checked'] = true;
                            } elseif (
                                        isset($this->options[$keyItem]['param']['checked'])
                                        &&
                                        $this->options[$keyItem]['param']['checked'] == 'value'
                                    ) {
                                $tempvalue = false;
                                if ($dataPrepared[$keyRow][$keyItem]['value']) {
                                    $tempvalue = true;
                                }
                                $dataPrepared[$keyRow][$keyItem]['param']['checked'] = $tempvalue;
                            }
                            // we need to create name
                            if (
                                    isset($this->options[$keyItem]['param']['pattern'])
                                    &&
                                    isset($data[$keyRow][$this->options[$keyItem]['param']['index']])
                                ) {
                                $dataPrepared[$keyRow][$keyItem]['param']['name']
                                    = $this->options[$keyItem]['param']['pattern'] .
                                    $data[$keyRow][$this->options[$keyItem]['param']['index']];
                            } else {
                                $dataPrepared[$keyRow][$keyItem]['param']['name']
                                    = $keyItem . $dataPrepared[$keyRow][$keyItem]['value'];
                            }
                        } elseif ($tempType == 'link') {
                            $pattern = '';
                            $index = '';
                            $target = '_self';
                            if (isset($this->options[$keyItem]['param']['pattern'])) {
                                $pattern = $this->options[$keyItem]['param']['pattern'];
                            }
                            if (
                                    isset($data[$keyRow][$this->options[$keyItem]['param']['index']])
                                    &&
                                    isset($this->options[$keyItem]['param']['index'])
                                ) {
                                $index = $data[$keyRow][$this->options[$keyItem]['param']['index']];
                            }
                            if (isset($this->options[$keyItem]['param']['target'])) {
                                $target = $this->options[$keyItem]['param']['target'];
                            }
                            $dataPrepared[$keyRow][$keyItem]['param']['href'] = $pattern . $index;
                            $dataPrepared[$keyRow][$keyItem]['param']['target'] = $target;
                        }
                    }
                    if (isset($this->options[$keyItem]['editable'])) {
                        $dataPrepared[$keyRow][$keyItem]['editable'] = $this->options[$keyItem]['editable'];
                    }
                    if (isset($this->options[$keyItem]['param']['class'])) {
                        $dataPrepared[$keyRow][$keyItem]['class'] = $this->options[$keyItem]['param']['class'];
                    }
                }
            }
        }

        return $dataPrepared;
    }
    /**
     * validate the options
     *
     * @return boolean
     */
    public function prepareTableOptions ()
    {
        $options = array ();
        if (!empty($this->options) && isset($this->options['table_max_width'])) {
            //need to finish
        }

        return true;
    }
    /**
     * create array of table headers
     *
     * @return mixed[]
     */
    public function getTableHeaders ()
    {
        $headers = array ();
        if (empty($this->options)) {
            $headers['value'] = array_keys($this->data[0]);
            $headers['real'] = array_keys($this->data[0]);
            ;
        } else {
            $i = 0;
            foreach (array_keys($this->data[0]) as $key) {
                if (!$this->checkToShow($key)) {
                    continue;
                }
                if (array_key_exists($key, $this->options) && array_key_exists('header', $this->options[$key])) {
                    $headers[$i]['value'] = $this->options[$key]['header'];
                } else {
                    $headers[$i]['value'] = $key;
                }
                $headers[$i]['real'] = $key;

                $headers[$i]['ordering'] = false;
                if (
                        array_key_exists($key, $this->options)
                        &&
                        array_key_exists('ordering', $this->options[$key]['param'])
                    ) {
                    if ($this->options[$key]['param']['ordering']) {
                        $headers[$i]['ordering'] = $this->options[$key]['param']['ordering'];
                    }
                }
                $i++;
            }
        }

        return $headers;
    }
    /**
     * check to show field or hide it due to options
     *
     * @param string $key
     *
     * @return boolean
     */
    protected function checkToShow ($key)
    {
        if (isset($this->options['show'])) {
            if (is_array($this->options['show']) && !in_array($key, $this->options['show'])) {
                return false;
            }
        } elseif (isset($this->options['hide'])) {
            if (is_array($this->options['hide']) && in_array($key, $this->options['hide'])) {
                return false;
            }
        }

        return true;
    }
    /**
     * setter for data
     *
     * @param mixed[] $data
     */
    protected function setData ($data)
    {
        $this->data = $data;
    }
    /**
     * setter for options
     *
     * @param mixed[] $options
     */
    protected function setOptions ($options)
    {
        $this->options = $options;
    }
    /**
     * setter for $pattern
     *
     * @param mixed[] $pattern
     */
    protected function setPattern ($pattern)
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
    protected function setHolder ($holder)
    {
        $this->holder = $holder;
    }
    /**
     * setter for $namespace
     *
     * @param string $namespace
     */
    protected function setNamespace ($namespace)
    {
        $this->namespace = $namespace;
    }
}
