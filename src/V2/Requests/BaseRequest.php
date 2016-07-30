<?php
/**
 * @author Rizart Dokollari <***REMOVED***>
 * @since 6/4/16
 */

namespace Src\V2\Requests;

use GuzzleHttp\Client;
use Src\V2\Requests\Email\RequestException;

abstract class BaseRequest
{
    const BASE_URI_KEY = 'base_uri';
    /**
     * @var Client
     */
    private $httpClient;
    /**
     * @var array
     */
    protected $config;

    /**
     * BaseRequest constructor.
     * @param $baseUri
     * @param array $config
     */
    public function __construct($baseUri, array $config)
    {
        $this->setHttpClient($baseUri);
        $this->config = $config;
    }

    /**
     * Get the HTTP status code.
     *
     * @return mixed
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param $baseUri
     * @throws RequestException
     */
    public function setHttpClient($baseUri)
    {
        if (!filter_var($baseUri, FILTER_VALIDATE_URL)) {
            throw new RequestException('Invalid base uri.');
        }

        $this->httpClient = new Client(['base_uri' => $baseUri]);
    }
}