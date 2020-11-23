<?php
/**
 * PayPal REST Create Product Request
 */

namespace Omnipay\PayPal\Message;

 /**
 * @see Omnipay\PayPal\RestGateway
 */
class RestCreateProductRequest extends AbstractRestRequest
{

    /**
     * Set the product ID
     *
     * @param $value
     * @return RestCreateProductRequest
     */
    public function setId($value)
    {
        return $this->setParameter('id', $value);
    }

    /**
     * Get the product ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getParameter('id');
    }

    /**
     * Get the product name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getParameter('name');
    }

    /**
     * Set the product name
     *
     * @param string $value
     * @return RestCreateProductRequest provides a fluent interface.
     */
    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    /**
     * Get the plan type
     *
     * @return string
     */
    public function getType()
    {
        return $this->getParameter('type');
    }

    /**
     * Set the plan type
     *
     * @param string $value RestGateway::PRODUCT_TYPE_PHYSICAL
     *                      or RestGateway::PRODUCT_TYPE_DIGITAL
     *                      or RestGateway::PRODUCT_TYPE_SERVICE
     * @return RestCreateProductRequest provides a fluent interface.
     */
    public function setType($value)
    {
        return $this->setParameter('type', $value);
    }


    public function getData()
    {
        $this->validate('name', 'type');
        $data = array(
            'id'                    => $this->getId(),
            'name'                  => $this->getName(),
            'description'           => $this->getDescription(),
            'type'                  => $this->getType()
        );

        return $data;
    }

    /**
     * Get transaction endpoint.
     *
     * Billing plans are created using the /billing-plans resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/catalogs/products';
    }
}
