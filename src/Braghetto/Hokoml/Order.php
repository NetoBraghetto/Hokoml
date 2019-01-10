<?php
namespace Braghetto\Hokoml;

/**
* Order
*/

class Order implements AppRefreshableInterface
{

    /**
     * The http client.
     *
     * @var \Braghetto\Hokoml\HttpClientInterface
     */
    private $http;

    /**
     * An App instance.
     *
     * @var \Braghetto\Hokoml\AppInterface
     */
    private $app;

    /**
     * Create a new \Braghetto\Hokoml\Product instance.
     *
     * @param \Braghetto\Hokoml\HttpClientInterface $http_client
     * @param \Braghetto\Hokoml\AppInterface $app
     * @return void
     */
    public function __construct(HttpClientInterface $http_client, AppInterface $app)
    {
        $this->http = $http_client;
        $this->app = $app;
    }

    /**
     * Retrive an order by id.
     *
     * @param string $id
     * @return array with body and http_code keys.
     */
    public function find($id)
    {
        return $this->http->get($this->app->getApiUrl("/orders/$id"), ['access_token' => $this->app->getAccessToken()]);
    }

    /**
     * Retrive orders form seller.
     *
     * @param array $filters
     * @return array with body and http_code keys.
     */
    public function get(array $filters = [])
    {
        $qs = ['access_token' => $this->app->getAccessToken(), 'seller' => $this->app->getSellerId()];
        $qs = array_merge($filters, $qs);
        return $this->http->get($this->app->getApiUrl('/orders/search'), $qs);
    }

    /**
     * Retrive paid orders form seller.
     *
     * @return array with body and http_code keys.
     */
    public function paid()
    {
        return $this->get([
            'order.status' => 'paid'
        ]);
    }

    /**
     * Retrive confirmed orders form seller.
     *
     * @return array with body and http_code keys.
     */
    public function confirmed()
    {
        return $this->get([
            'order.status' => 'confirmed'
        ]);
    }

    /**
     * Retrive payment_required orders form seller.
     *
     * @return array with body and http_code keys.
     */
    public function paymentRequired()
    {
        return $this->get([
            'order.status' => 'payment_required'
        ]);
    }

    /**
     * Retrive payment_in_process orders form seller.
     *
     * @return array with body and http_code keys.
     */
    public function inProcess()
    {
        return $this->get([
            'order.status' => 'payment_in_process'
        ]);
    }

    /**
     * Retrive partially_paid orders form seller.
     *
     * @return array with body and http_code keys.
     */
    public function partiallyPaid()
    {
        return $this->get([
            'order.status' => 'partially_paid'
        ]);
    }

    /**
     * Retrive cancelled orders form seller.
     *
     * @return array with body and http_code keys.
     */
    public function cancelled()
    {
        return $this->get([
            'order.status' => 'cancelled'
        ]);
    }

    /**
     * Retrive invalid orders form seller.
     *
     * @return array with body and http_code keys.
     */
    public function invalid()
    {
        return $this->get([
            'order.status' => 'invalid'
        ]);
    }

    /**
     * Retrive recent orders form seller.
     *
     * @return array with body and http_code keys.
     */
    public function recent()
    {
        return $this->http->get($this->app->getApiUrl('/orders/search/recent'), [
            'access_token' => $this->app->getAccessToken(),
            'seller' => $this->app->getSellerId(),
        ]);
    }

    /**
     * Retrive archived orders form seller.
     *
     * @return array with body and http_code keys.
     */
    public function archived()
    {
        return $this->http->get($this->app->getApiUrl('/orders/search/archived'), [
            'access_token' => $this->app->getAccessToken(),
            'seller' => $this->app->getSellerId(),
        ]);
    }

    /**
     * Retrive pending orders form seller.
     *
     * @return array with body and http_code keys.
     */
    public function pending()
    {
        return $this->http->get($this->app->getApiUrl('/orders/search/pending'), [
            'access_token' => $this->app->getAccessToken(),
            'seller' => $this->app->getSellerId(),
        ]);
    }

    /**
     * Retrive orders form customer.
     *
     * @param string $customer_id
     * @param array $filters
     * @return array with body and http_code keys.
     */
    public function getFromCustomer($customer_id, array $filters = [])
    {
        $qs = ['access_token' => $this->app->getAccessToken(), 'buyer' => $customer_id];
        $qs = array_merge($filters, $qs);
        return $this->http->get($this->app->getApiUrl('/orders/search'), $qs);
    }

    /**
     * Retrive paid orders form customer.
     *
     * @param string $customer_id
     * @return array with body and http_code keys.
     */
    public function paidFromCustomer($customer_id)
    {
        return $this->getFromCustomer($customer_id, [
            'order.status' => 'paid'
        ]);
    }

    /**
     * Retrive confirmed orders form customer.
     *
     * @param string $customer_id
     * @return array with body and http_code keys.
     */
    public function confirmedFromCustomer($customer_id)
    {
        return $this->getFromCustomer($customer_id, [
            'order.status' => 'confirmed'
        ]);
    }

    /**
     * Retrive payment_required orders form customer.
     *
     * @param string $customer_id
     * @return array with body and http_code keys.
     */
    public function paymentRequiredFromCustomer($customer_id)
    {
        return $this->getFromCustomer($customer_id, [
            'order.status' => 'payment_required'
        ]);
    }

    /**
     * Retrive payment_in_process orders form customer.
     *
     * @param string $customer_id
     * @return array with body and http_code keys.
     */
    public function inProcessFromCustomer($customer_id)
    {
        return $this->getFromCustomer($customer_id, [
            'order.status' => 'payment_in_process'
        ]);
    }

    /**
     * Retrive partially_paid orders form customer.
     *
     * @param string $customer_id
     * @return array with body and http_code keys.
     */
    public function partiallyPaidFromCustomer($customer_id)
    {
        return $this->getFromCustomer($customer_id, [
            'order.status' => 'partially_paid'
        ]);
    }

    /**
     * Retrive cancelled orders form customer.
     *
     * @param string $customer_id
     * @return array with body and http_code keys.
     */
    public function cancelledFromCustomer($customer_id)
    {
        return $this->getFromCustomer($customer_id, [
            'order.status' => 'cancelled'
        ]);
    }

    /**
     * Retrive invalid orders form customer.
     *
     * @param string $customer_id
     * @return array with body and http_code keys.
     */
    public function invalidFromCustomer($customer_id)
    {
        return $this->getFromCustomer($customer_id, [
            'order.status' => 'invalid'
        ]);
    }

    /**
     * Retrive recent orders form customer.
     *
     * @param string $customer_id
     * @return array with body and http_code keys.
     */
    public function recentFromCustomer($customer_id)
    {
        return $this->http->get($this->app->getApiUrl('/orders/search/recent'), [
            'access_token' => $this->app->getAccessToken(),
            'buyer' => $customer_id,
        ]);
    }

    /**
     * Retrive archived orders form customer.
     *
     * @param string $customer_id
     * @return array with body and http_code keys.
     */
    public function archivedFromCustomer($customer_id)
    {
        return $this->http->get($this->app->getApiUrl('/orders/search/archived'), [
            'access_token' => $this->app->getAccessToken(),
            'buyer' => $customer_id,
        ]);
    }

    /**
     * Retrive pending orders form customer.
     *
     * @param string $customer_id
     * @return array with body and http_code keys.
     */
    public function pendingFromCustomer($customer_id)
    {
        return $this->http->get($this->app->getApiUrl('/orders/search/pending'), [
            'access_token' => $this->app->getAccessToken(),
            'buyer' => $customer_id,
        ]);
    }

    /**
     * Refresh the App instance.
     *
     * @return void
     */
    public function refreshApp($app)
    {
        $this->app = $app;
    }
}
