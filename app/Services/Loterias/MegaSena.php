<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Loterias;

use Illuminate\Support\Facades\Cache;

class MegaSena extends LoteriasService
{
    protected $http;

    public static function make()
    {
        return new static();
    }

    public function get($concurso = null)
    {
        if ($concurso) {
            return Cache::rememberForever(date('YmdH') . 'megasena' . $concurso, function () use ($concurso) {
                $response = $this->http->get("megasena/{$concurso}");
                return $response->json();
            });
        } else {
            return Cache::rememberForever(date('YmdH') . 'megasena', function () {
                $response = $this->http->get('megasena');
                return $response->json();
            });
        }
    }

    public function getLastContest()
    {
        $response = $this->http->get('megasena');
        return $response->json('numero');
    }
}
