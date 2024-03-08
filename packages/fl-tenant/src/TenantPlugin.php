<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Tenant;

use Filament\Contracts\Plugin;
use Filament\Panel;

class TenantPlugin implements Plugin
{
    protected $userAdminResources = false;

    public function __construct($userAdminResources = false)
    {
        $this->userAdminResources = $userAdminResources;
    }

    public function getId(): string
    {
        return 'tenant';
    }

    public function register(Panel $panel): void
    {

        if ($this->userAdminResources) {

            $panel->pages([
                Pages\Settings::class,
            ]);
        } else {
            $panel->resources([
                Resources\TenantResource::class,
            ]);
        }
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
