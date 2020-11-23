<?php
/**
 * PayPal REST Create Subscription Request
 */

namespace Omnipay\PayPal\Message;

/**
 * PayPal REST Create Subscription Request
 *
 * Use this call to create a billing agreement for the buyer. The response
 * for this call includes these HATEOAS links: an approval_url link and an
 * execute link. Each returned link includes the token for the agreement.
 *
 * For PayPal payments:
 *
 * * After successfully creating the agreement, direct the user to the
 *   approval_url on the PayPal site so that the user can approve the agreement.
 * * Call the execute link to execute the billing agreement.
 *
 * Note: Billing agreements for credit card payments execute automatically
 * when created. There is no need for the user to approve the agreement or
 * to execute the agreement.
 *
 * ### Request Data
 *
 * Pass the agreement details in the body of a POST call, including the
 * following agreement object properties:
 *
 * * name (string). Required.
 * * description (string). Required.
 * * start_date (string). Format yyyy-MM-dd z, as defined in ISO8601. Required.
 * * agreement_details (array)
 * * payer (array). Required
 * * shipping_address (array).  Should be provided if it is different to the
 *   default address.
 * * override_merchant_preferences (array).
 * * override_charge_models (array).
 * * plan (array). Required.
 *
 * ### Example
 *
 * <code>
 *   // Create a gateway for the PayPal REST Gateway
 *   // (routes to GatewayFactory::create)
 *   $gateway = Omnipay::create('PayPal_Rest');
 *
 *   // Initialise the gateway
 *   $gateway->initialize(array(
 *       'clientId' => 'MyPayPalClientId',
 *       'secret'   => 'MyPayPalSecret',
 *       'testMode' => true, // Or false when you are ready for live transactions
 *   ));
 *
 *   // Do a create plan transaction on the gateway
 *   $transaction = $gateway->createPlan(array(
 *       'name'                     => 'Test Plan',
 *       'description'              => 'A plan created for testing',
 *       'type'                     => $gateway::BILLING_PLAN_TYPE_FIXED,
 *       'paymentDefinitions'       => [
 *           [
 *               'name'                 => 'Monthly Payments for 12 months',
 *               'type'                 => $gateway::PAYMENT_TRIAL,
 *               'frequency'            => $gateway::BILLING_PLAN_FREQUENCY_MONTH,
 *               'frequency_interval'   => 1,
 *               'cycles'               => 12,
 *               'amount'               => ['value' => 10.00, 'currency' => 'USD'],
 *           ],
 *       ],
 *   ));
 *   $response = $transaction->send();
 *   if ($response->isSuccessful()) {
 *       echo "Create Plan transaction was successful!\n";
 *       $plan_id = $response->getTransactionReference();
 *       echo "Plan reference = " . $plan_id . "\n";
 *   }
 *
 *   // Do a create subscription transaction on the gateway
 *   $transaction = $gateway->createSubscription(array(
 *       'name'                     => 'Test Subscription',
 *       'description'              => 'A subscription created for testing',
 *       'startDate'                => new \DateTime(), // now
 *       'planId'                   => $plan_id,
 *       'payerDetails              => ['payment_method' => 'paypal'],
 *   ));
 *   $response = $transaction->send();
 *   if ($response->isSuccessful()) {
 *       echo "Create Subscription transaction was successful!\n";
 *       if ($response->isRedirect()) {
 *           echo "Response is a redirect\n";
 *           echo "Redirect URL = " . $response->getRedirectUrl();
 *           $subscription_id = $response->getTransactionReference();
 *           echo "Subscription reference = " . $subscription_id;
 *       }
 *   }
 * </code>
 *
 * ### Request Sample
 *
 * This is from the PayPal web site:
 *
 * <code>
 * curl -v POST https://api.sandbox.paypal.com/v1/payments/billing-agreements \
 *     -H 'Content-Type:application/json' \
 *     -H 'Authorization: Bearer <Access-Token>' \
 *     -d '{
 *         "name": "T-Shirt of the Month Club Agreement",
 *         "description": "Agreement for T-Shirt of the Month Club Plan",
 *         "start_date": "2015-02-19T00:37:04Z",
 *         "plan": {
 *             "id": "P-94458432VR012762KRWBZEUA"
 *         },
 *         "payer": {
 *             "payment_method": "paypal"
 *         },
 *         "shipping_address": {
 *             "line1": "111 First Street",
 *             "city": "Saratoga",
 *             "state": "CA",
 *             "postal_code": "95070",
 *             "country_code": "US"
 *         }
 *     }'
 * }'
 * </code>
 *
 * ### Response Sample
 *
 * This is from the PayPal web site:
 *
 * <code>
 * {
 *     "name": "T-Shirt of the Month Club Agreement",
 *     "description": "Agreement for T-Shirt of the Month Club Plan",
 *     "plan": {
 *         "id": "P-94458432VR012762KRWBZEUA",
 *         "state": "ACTIVE",
 *         "name": "T-Shirt of the Month Club Plan",
 *         "description": "Template creation.",
 *         "type": "FIXED",
 *         "payment_definitions": [
 *             {
 *                 "id": "PD-50606817NF8063316RWBZEUA",
 *                 "name": "Regular Payments",
 *                 "type": "REGULAR",
 *                 "frequency": "Month",
 *                 "amount": {
 *                     "currency": "USD",
 *                     "value": "100"
 *                 },
 *                 "charge_models": [
 *                     {
 *                         "id": "CHM-92S85978TN737850VRWBZEUA",
 *                         "type": "TAX",
 *                         "amount": {
 *                             "currency": "USD",
 *                             "value": "12"
 *                         }
 *                     },
 *                     {
 *                         "id": "CHM-55M5618301871492MRWBZEUA",
 *                         "type": "SHIPPING",
 *                         "amount": {
 *                             "currency": "USD",
 *                             "value": "10"
 *                         }
 *                     }
 *                 ],
 *                 "cycles": "12",
 *                 "frequency_interval": "2"
 *             }
 *         ],
 *         "merchant_preferences": {
 *             "setup_fee": {
 *                 "currency": "USD",
 *                 "value": "1"
 *             },
 *             "max_fail_attempts": "0",
 *             "return_url": "http://www.return.com",
 *             "cancel_url": "http://www.cancel.com",
 *             "auto_bill_amount": "YES",
 *             "initial_fail_amount_action": "CONTINUE"
 *         }
 *     },
 *     "links": [
 *         {
 * "href": "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=EC-0JP008296V451950C",
 * "rel": "approval_url",
 * "method": "REDIRECT"
 *         },
 *         {
 * "href": "https://api.sandbox.paypal.com/v1/payments/billing-agreements/EC-0JP008296V451950C/agreement-execute",
 * "rel": "execute",
 * "method": "POST"
 *         }
 *     ],
 *     "start_date": "2015-02-19T00:37:04Z"
 * }
 * </code>
 *
 * ### Known Issues
 *
 * PayPal subscription payments cannot be refunded. PayPal is working on this functionality
 * for their future API release.  In order to refund a PayPal subscription payment, you will
 * need to use the PayPal web interface to refund it manually.
 *
 * @link https://developer.paypal.com/docs/api/#create-an-agreement
 * @see RestCreatePlanRequest
 * @see Omnipay\PayPal\RestGateway
 */
class RestCreateSubscriptionRequest extends AbstractRestRequest
{

    /**
     * Get the plan ID
     *
     * @return string
     */
    public function getPlanId()
    {
        return $this->getParameter('plan_id');
    }

    /**
     * Set the plan ID
     *
     * @param string $value
     * @return RestCreateSubscriptionRequest provides a fluent interface.
     */
    public function setPlanId($value)
    {
        return $this->setParameter('plan_id', $value);
    }

    /**
     * Get the agreement start date
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->getParameter('start_time');
    }

    /**
     * Set the agreement start date
     *
     * @param \DateTime $value
     * @return RestCreateSubscriptionRequest provides a fluent interface.
     */
    public function setStartTime(\DateTime $value)
    {
        return $this->setParameter('start_time', $value);
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
     * @return RestCreateSubscriptionRequest provides a fluent interface.
     */
    public function setQuantity($value)
    {
        return $this->setParameter('quantity', $value);
    }

    /**
     * Get the subscriber
     *
     * @return string
     */
    public function getSubscriber()
    {
        return $this->getParameter('subscriber');
    }

    /**
     * Set the subscriber
     *
     * @param string $value
     * @return RestCreateSubscriptionRequest provides a fluent interface.
     */
    public function setSubscriber($value)
    {
        return $this->setParameter('subscriber', $value);
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
        $this->validate('plan_id', 'start_time', 'subscriber', 'application_context');
        $data = [
            'plan_id'             => $this->getPlanId(),
            'start_time'          => $this->getStartTime()->format('c'),
            'quantity'            => $this->getQuantity(),
            'subscriber'          => $this->getSubscriber(),
            'application_context' => $this->getApplicationContext()
        ];

        return $data;
    }

    /**
     * Get transaction endpoint.
     *
     * Subscriptions are created using the /billing-agreements resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/billing/subscriptions';
    }

    protected function createResponse($data, $statusCode)
    {
        return $this->response = new RestAuthorizeResponse($this, $data, $statusCode);
    }
}
