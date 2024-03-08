<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

use DateTime as DT;
use Illuminate\Support\Str;

if (!function_exists('get_tenant_id')) {
    function get_tenant_id($tenant = 'tenant_id')
    {
        if (config('tenant.user', false)) {
            $tenantId = data_get(auth()->user(), $tenant);
            return $tenantId;
        }
        $tenantId = \Callcocam\Tenant\Facades\Tenant::getTenantId($tenant);
        return $tenantId;
    }
}

if (!function_exists('get_tenant')) {
    function get_tenant($tenant = 'tenant_id')
    {
        $tenantId = \Callcocam\Tenant\Facades\Tenant::getTenantId($tenant);

        $model = config('tenant.models.tenant', \Callcocam\Tenant\Models\Tenant::class);

        return app($model)->query()->where('id', $tenantId)->first();
    }
}

if (!function_exists('validateDate')) {

    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DT::createFromFormat($format, $date);

        return $d && $d->format($format) === $date;
    }
}

if (!function_exists('data_file')) {
    function data_file($data, $key = null)
    {
        $extension = pathinfo(data_get($data, 'cover'), PATHINFO_EXTENSION);
        $filename = Str::slug(data_get($data, 'name'));
        $filename = sprintf("%s.%s", $filename, $extension);
        $url = sprintf("https://%s%s", data_get($data, 'domain'), data_get($data, 'cover'));
        $bucket =  data_get($data, 'bucket');
        $filename = sprintf("%s/%s", $bucket, $filename);
        if ($key) {
            return  [
                'url' => $url,
                'filename' => $filename,
                'bucket' => $bucket
            ][$key];
        }
        return [
            'url' => $url,
            'filename' => $filename,
            'bucket' => $bucket
        ];
    }
}
