<?php
/**
 * PayPal REST Fetch Subscription Detail Request
 */

namespace Omnipay\PayPal\Message;

/**
 * PayPal REST Fetch Plan Request

 */

class RestFetchSubscriptionRequest extends AbstractRestRequest
{
    /**
     *
     * Get the subscription ID
     *
     * @return string
     */
    public function getSubscriptionId()
    {
        return $this->getParameter('subscriptionId');
    }

    /**
     * Set the plan ID
     *
     * @param string $value
     * @return RestFetchSubscriptionRequest provides a fluent interface.
     */
    public function setSubscriptionId($value)
    {
        return $this->setParameter('subscriptionId', $value);
    }

    public function getData()
    {
        $this->validate('subscriptionId');
        return array();
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
        return parent::getEndpoint() . '/billing/subscriptions/' . $this->getSubscriptionId();
    }
}
