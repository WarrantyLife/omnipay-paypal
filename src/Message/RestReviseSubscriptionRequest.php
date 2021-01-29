<?php
/**
 * PayPal REST Revise Subscription Request
 */

namespace Omnipay\PayPal\Message;

/**
 * PayPal REST Revise Subscription Request

 * ### Response
 *
 * Returns the HTTP status of 200 if the call is successful.
 *
 * @link https://developer.paypal.com/docs/api/subscriptions/v1/#subscriptions_revise
 * @see RestReviseSubscriptionRequest
 * @see Omnipay\PayPal\RestGateway
 */
class RestReviseSubscriptionRequest extends AbstractRestRequest
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

    /**
     * Get the quantity
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->getParameter('quantity');
    }

    /**
     * Set the quantity
     *
     * @param string $value
     * @return RestReviseSubscriptionRequest provides a fluent interface.
     */
    public function setQuantity($value)
    {
        return $this->setParameter('quantity', $value);
    }

    /**
     * Get the application context
     *
     * @return string
     */
    public function getApplicationContext()
    {
        return $this->getParameter('application_context');
    }

    /**
     * Set the application context
     *
     * @param string $value
     * @return RestCreateSubscriptionRequest provides a fluent interface.
     */
    public function setApplicationContext($value)
    {
        return $this->setParameter('application_context', $value);
    }

    public function getData()
    {
        $this->validate('subscriptionId');
        $data = [
            'quantity' => $this->getQuantity()
        ];

        if($this->getApplicationContext()) {
            $data['application_context'] = $this->getApplicationContext();
        }


        return $data;
    }

    /**
     * Get transaction endpoint.
     *
     * Subscriptions are managed using the //billing/subscriptions resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/billing/subscriptions/' . $this->getSubscriptionId() . '/revise';
    }

}
