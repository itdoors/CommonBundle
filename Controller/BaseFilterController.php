<?php

namespace ITDoors\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * BaseFilterController
 *
 * @author Pavel Pecheny <ppecheny@gmail.com>
 *
 */
class BaseFilterController extends Controller
{
    protected $filterNamespace = 'base.sales.filters';
    protected $filterFormName = 'baseSalesFilterForm';
    protected $baseRoute = 'lists_sales_base_index';

    /**
     * Executes filter clear action
     *
     * @return string
     */
    public function filterClearAction()
    {
        $this->clearFilters();

        return $this->redirect($this->generateUrl($this->baseRoute));
    }

    /**
     * Processes filters for view
     *
     * @return Form
     */
    public function processFilters()
    {
        $filterForm = $this->createForm($this->filterFormName);

        $filterForm->bind($this->getFilters());

        return $filterForm;
    }

    /**
     * Executes filter action
     *
     * @return string
     */
    public function filterAction()
    {
        $filters = $this->get('request')->request->get($this->filterFormName);

        if (!isset($filters['reset'])) {
            $this->setFilters($filters);
        } else {
            $this->clearFilters();
        }

        return $this->redirect($this->generateUrl($this->baseRoute));
    }

    /**
     * Sets filter to the session
     *
     * @param mixed[] $filters
     * @param string  $filterNamespace
     */
    public function setFilters($filters, $filterNamespace = '')
    {
        /** @var Session $session */
        $session = $this->get('session');

        $filterNamespace = $filterNamespace ? $filterNamespace : $this->filterNamespace;

        $session->set($filterNamespace, $filters);
    }

    /**
     * Gets filters from session
     *
     * @param string $filterNamespace
     *
     * @return mixed[]
     */
    public function getFilters($filterNamespace = '')
    {
        /** @var Session $session */
        $session = $this->get('session');

        $filterNamespace = $filterNamespace ? $filterNamespace : $this->filterNamespace;

        return $session->get($filterNamespace);
    }

    /**
     * Clears session data
     */
    public function clearFilters()
    {
        $this->setFilters(array());
    }

    /**
     * Adds record to session
     *
     * @param string $key
     * @param string $value
     */
    public function addToFilters($key, $value)
    {
        $filters = $this->getFilters();

        $filters[$key] = $value;

        $this->setFilters($filters);
    }

    /**
     * Removes record from session by key
     *
     * @param string $key
     */
    public function removeFromFilters($key)
    {
        $filters = $this->getFilters();

        if (isset($filters[$key])) {
            unset($filters[$key]);
        }

        $this->setFilters($filters);
    }

    /**
     * Retruns filter value by key
     *
     * @param string $key
     * @param string $default
     *
     * @return mixed
     */
    public function getFilterValueByKey($key, $default = null)
    {
        $filters = $this->getFilters();

        if (isset($filters[$key])) {
            return $filters[$key];
        }

        return $default;
    }
}
