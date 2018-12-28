<?php
namespace Braghetto\Hokoml;

/**
* Question
*/

class Question implements AppRefreshableInterface
{
    /**
     * The api base url.
     *
     * @var string
     */
    private $api_url;

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
        $this->api_url = $this->app->getApiUrl();
    }

    /**
     * Retrive a question by id.
     *
     * @param string $id
     * @return array with body and http_code keys.
     */
    public function find($id)
    {
        return $this->http->get($this->api_url . '/questions/' . $id, ['access_token' => $this->app->getAccessToken()]);
    }

    /**
     * Ask a question to a product.
     *
     * @param string $product_id
     * @param string $question
     * @return array with body and http_code keys.
     */
    public function ask($product_id, $question)
    {
        return $this->http->post($this->app->getApiUrl("/questions/{$product_id}"), ['access_token' => $this->app->getAccessToken()], [
            'text' => $question,
            'item_id' => $product_id
        ]);
    }

    /**
     * Answer a question.
     *
     * @param string $question_id
     * @param string $answer
     * @return array with body and http_code keys.
     */
    public function answer($question_id, $answer)
    {
        return $this->http->post($this->api_url . '/answers', ['access_token' => $this->app->getAccessToken()], [
            'text' => $answer,
            'question_id' => $question_id
        ]);
    }

    /**
     * List all questions from a product.
     *
     * @param string $product_id
     * @param array $filters
     * @param string $sort
     * @return array with body and http_code keys.
     */
    public function fromProduct($product_id, array $filters = [], $sort = null)
    {
        $qs = ['access_token' => $this->app->getAccessToken(), 'item_id' => $product_id];
        $qs = $qs + $filters;
        if (isset($sort)) {
            $qs['sort'] = $sort;
        }
        return $this->http->get($this->api_url . '/questions/search', $qs);
    }

    /**
     * Block a user.
     *
     * @param string $user_id
     * @return array with body and http_code keys.
     */
    public function blockUser($user_id)
    {
        return $this->http->post($this->api_url . '/users/' . $this->app->getSellerId() . '/questions_blacklist', ['access_token' => $this->app->getAccessToken()], [
            'user_id' => $user_id
        ]);
    }

    /**
     * Unblock a user.
     *
     * @param string $user_id
     * @return array with body and http_code keys.
     */
    public function unblockUser($user_id)
    {
        return $this->http->delete($this->api_url . '/users/' . $this->app->getSellerId() . '/questions_blacklist/' . $user_id, [
            'access_token' => $this->app->getAccessToken()
        ]);
    }

    /**
     * Get a list of blocked users.
     *
     * @return array with body and http_code keys.
     */
    public function blockedUsers()
    {
        return $this->http->get($this->api_url . '/users/' . $this->app->getSellerId() . '/questions_blacklist', [
            'access_token' => $this->app->getAccessToken()
        ]);
    }

    /**
     * Get a list of received questions.
     *
     * @param array $filters
     * @param string $sort
     * @return array with body and http_code keys.
     */
    public function received(array $filters = [], $sort = null)
    {
        $qs = ['access_token' => $this->app->getAccessToken()];
        $qs = $qs + $filters;
        if (isset($sort)) {
            $qs['sort'] = $sort;
        }
        return $this->http->get($this->api_url . '/my/received_questions/search', $qs);
    }

    /**
     * Get a list of unanswered received questions.
     *
     * @return array with body and http_code keys.
     */
    public function unansweredReceived()
    {
        return $this->received([
            'status' => 'unanswered'
        ]);
    }

    /**
     * List all unanswered questions from a product.
     *
     * @param string $product_id
     * @return array with body and http_code keys.
     */
    public function unansweredFromProduct($product_id)
    {
        return $this->fromProduct($product_id, [
            'status' => 'unanswered'
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
