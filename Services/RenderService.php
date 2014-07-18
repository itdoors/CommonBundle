<?php

namespace ITDoors\CommonBundle\Services;

use Symfony\Component\DependencyInjection\Container;

/**
 * Class RenderService
 */
class RenderService
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
     * @param string  $template
     * @param mixed[] $info
     *
     * @return array
     */
    public function renderByInfo($template, $info)
    {
        $templateEngine = $this->container->get('templating');

        $renderedView = $templateEngine->renderView($template, $info);

        return $renderedView;
    }
}
