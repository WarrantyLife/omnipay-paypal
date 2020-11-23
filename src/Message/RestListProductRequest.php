<?php
/**
 * PayPal REST List Products Request
 */

namespace Omnipay\PayPal\Message;


class RestListProductRequest extends AbstractRestRequest
{
    /**
     *
     * Get the request page
     *
     * @return integer
     */

    public function getPage()
    {
        return $this->getParameter('page');
    }


    /**
     * Set the request page
     *
     * @param integer $value
     * @return AbstractRestRequest provides a fluent interface.
     */
    public function setPage($value)
    {
        return $this->setParameter('page', $value);
    }

    /**
     * Get the request page size
     *
     * @return string
     */
    public function getPageSize()
    {
        return $this->getParameter('pageSize');
    }

    /**
     * Set the request page size
     *
     * @param string $value
     * @return AbstractRestRequest provides a fluent interface.
     */
    public function setPageSize($value)
    {
        return $this->setParameter('pageSize', $value);
    }

    /**
     * Get the request total required
     *
     * @return string
     */
    public function getTotalRequired()
    {
        return $this->getParameter('totalRequired');
    }

    /**
     * Set the request total required
     *
     * @param string $value
     * @return AbstractRestRequest provides a fluent interface.
     */
    public function setTotalRequired($value)
    {
        return $this->setParameter('totalRequired', $value);
    }




    public function getData()
    {
        return array(
            'page'             => $this->getPage(),
            'page_size'       => $this->getPageSize(),
            'total_required'        => $this->getTotalRequired()
        );
    }

    /**
     * Get HTTP Method.
     *
     * The HTTP method for list plans requests must be GET.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'GET';
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/catalogs/products';
    }
}
