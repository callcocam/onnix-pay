<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Onixpay;

use Illuminate\Support\Facades\Http;

abstract class OnnixPayService
{
    use AuthService;

    protected  $http;

    protected $username;

    protected $password;

    protected $bearer;


    public function __construct()
    {

        $this->username = config('onnixpay.api_public_key');

        $this->password = config('onnixpay.api_private_key');

        $this->bearer = base64_encode(config('onnixpay.api_public_key') . ':' . config('onnixpay.api_private_key'));

        $this->login();

        $this->http =  Http::acceptJson()
        ->contentType('application/json')  
        ->withToken($this->getBearer())   
        ->baseUrl(config('onnixpay.api_url', 'https://onnixpay.com/api/'));

  
    }

    public static function make()
    {
        return new static();
    }

    public function getHttp()
    {
        return $this->http;
    }

    public function setHttp($http)
    {
        $this->http = $http;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getBearer()
    {
        return $this->bearer;
    }

    public function setBearer($bearer)
    {
        $this->bearer = $bearer;
        return $this;
    }
}
