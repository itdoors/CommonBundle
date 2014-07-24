<?php

namespace ITDoors\CommonBundle\Services;

use Symfony\Component\DependencyInjection\Container;

/**
 * Class BaseService
 */
class BaseService
{
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Returns yes/no choices
     *
     * @return mixed[]
     */
    public function getYesNoChoices()
    {
        return array(
            'No' => $this->container->get('translator')->trans("No", array(), 'messages'),
            'Yes' => $this->container->get('translator')->trans("Yes", array(), 'messages')
        );
    }

    /**
     * Returns numbers from - to choices
     *
     * @param int $from
     * @param int $to
     *
     * @return mixed[]
     */
    public function getNumberChoices($from, $to)
    {
        $result = array();

        for ($i = $from; $i <= $to; $i++) {
            $result[$i] = $i;
        }

        return $result;
    }
}
