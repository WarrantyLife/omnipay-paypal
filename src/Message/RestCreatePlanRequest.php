<?php
/**
 * PayPal REST Create Plan Request
 */

namespace Omnipay\PayPal\Message;

/**
 * @see Omnipay\PayPal\RestGateway
 */
class RestCreatePlanRequest extends AbstractRestRequest
{


    /**
     * Set the product ID
     *
     * @param $value
     * @return RestCreatePlanRequest
     */
    public function setProductId($value)
    {
        return $this->setParameter('product_id', $value);
    }

    /**
     * Get the product ID
     *
     * @return string
     */
    public function getProductId()
    {
        return $this->getParameter('product_id');
    }

    /**
     * Get the plan name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getParameter('name');
    }

    /**
     * Set the plan name
     *
     * @param string $value
     * @return RestCreatePlanRequest provides a fluent interface.
     */
    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    /**
     * Get the plan status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getParameter('status');
    }

    /**
     * Set the plan status
     *
     * @param string $value
     * @return RestCreatePlanRequest provides a fluent interface.
     */
    public function setStatus($value)
    {
        return $this->setParameter('status', $value);
    }

    /**
     * Get the plan billing_cycles
     *
     * @return string
     */
    public function getBillingCycles()
    {
        return $this->getParameter('billing_cycles');
    }

    /**
     * Set the plan billing cycles
     *
     * @param string $value
     * @return RestCreatePlanRequest provides a fluent interface.
     */
    public function setBillingCycles($value)
    {
        return $this->setParameter('billing_cycles', $value);
    }


    /**
     * Get the plan payment preferences
     *
     * See the class documentation and the PayPal REST API documentation for
     * a description of the array elements.
     *
     * @return array
     */
    public function getPaymentPreferences()
    {
        return $this->getParameter('payment_preferences');
    }

    /**
     * Set the plan payment preferences
     *
     * See the class documentation and the PayPal REST API documentation for
     * a description of the array elements.
     *
     * @param array $value
     * @return RestCreatePlanRequest provides a fluent interface.
     */
    public function setPaymentPreferences(array $value)
    {
        return $this->setParameter('payment_preferences', $value);
    }

    /**
     * Get if the plan can use quantities for a subscription
     *
     * @return string
     */
    public function getQuantitySupported()
    {
        return $this->getParameter('quantity_supported');
    }

    /**
     * Set if the plan can use quantities for a subscription
     *
     * @param string $value
     * @return RestCreatePlanRequest provides a fluent interface.
     */
    public function setQuantitySupported($value)
    {
        return $this->setParameter('quantity_supported', $value);
    }

    public function getData()
    {
        $this->validate('product_id', 'name', 'billing_cycles', 'payment_preferences');
        $data = array(
            'product_id'            => $this->getProductId(),
            'name'                  => $this->getName(),
            'description'           => $this->getDescription(),
            'status'                => $this->getStatus(),
            'billing_cycles'        => $this->getBillingCycles(),
            'payment_preferences'   => $this->getPaymentPreferences(),
            'quantity_supported'    => $this->getQuantitySupported()
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
        return parent::getEndpoint() . '/billing/plans';
    }
}
