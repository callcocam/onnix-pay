<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Mp;

use Illuminate\Support\Facades\Http;

/** Mercado Pago configuration class. */
class MercadoPagoConfig
{

    /** @var string Mercado Pago Base URL */
    public static string $BASE_URL = "https://api.mercadopago.com";

    /** @var string Class constant for local runtime enviroment */
    public const LOCAL = 'local';

    /** @var string Class constant for server runtime enviroment */
    public const SERVER = 'server';

    /** @var string Actual enviroment the user is running at. Default is SERVER */
    private   string $runtime_enviroment = self::SERVER;

    /** @var string access token */
    private   string $access_token = "";
 
    private  $http_client;

    public function __construct()
    {
        $this->access_token = config('services.mercadopago.token');
    }

    public static function make()
    {
        return new static();
    }

    /**
     * Set the runtime enviroment.
     * @param string $runtime_enviroment runtime enviroment to be set.
     */

    public function setRuntimeEnviroment(string $runtime_enviroment): self
    {
        $this->runtime_enviroment = $runtime_enviroment;

        if ($this->runtime_enviroment === self::LOCAL) {
            self::$BASE_URL = "https://api.mercadopago.com";
        }
        return $this;
    }

    /**
     * Get the runtime enviroment.
     * @return string runtime enviroment.
     */
    public function getRuntimeEnviroment(): string
    {
        return $this->runtime_enviroment;
    }

    /**
     * Set the access token.
     * @param string $access_token access token to be set.
     */
    public function setAccessToken(string $access_token): self
    {
        $this->access_token = $access_token;
        return $this;
    }

    /**
     * Get the access token.
     * @return string access token.
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

  
    public function setHttpClient($http_client): self
    {
        $this->http_client = $http_client;
        return $this;
    }
    public function getHttpClient()
    {
        if ($this->http_client === null) {
            $this->http_client = Http::baseUrl(self::$BASE_URL)->contentType('application/json');
        } else {
            $this->http_client->baseUrl(self::$BASE_URL)->contentType('application/json');
        }
        if ($this->access_token)
            $this->http_client->withToken($this->access_token);

        return $this->http_client;
    }
}
