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
    protected  $http;

    protected $username;

    protected $password;

    protected $bearer;

    public function __construct()
    {

        $this->username = config('onnixpay.api_public_key');

        $this->password = config('onnixpay.api_private_key');

        $this->bearer = base64_encode(config('onnixpay.api_public_key').':'.config('onnixpay.api_private_key'));
 

        $this->http =  Http::acceptJson()->baseUrl(config('onnixpay.api_url', 'https://onnixpay.com/api/v1/'));
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
}