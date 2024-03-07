<?php

namespace App\Console\Commands;

use App\Core\Helpers\Helpers;
use App\Models\Contest;
use App\Models\User;
use App\Services\Loterias\MegaSena;
use Callcocam\Acl\Models\Role;
use Callcocam\Tenant\Models\Tenant;
use Illuminate\Console\Command;

class UpdateContestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-contest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = MegaSena::make()->get();

        $date = Helpers::date_carbom_format(data_get($data, 'dataProximoConcurso'));
        $numero = data_get($data, 'numeroConcursoProximo', 0);


        $description = [];
        $status = 'published'; 
        if (!Contest::where('number', data_get($data, 'numero'))->exists()) {
            $numero = data_get($data, 'numero');
            $date = Helpers::date_carbom_format(data_get($data, 'dataApuracao'));
            $description = data_get($data, 'listaDezenas');
            $status = 'concluded';

            $tenant = Tenant::query()->where('domain', request()->getHost())->first();
            $user  =  User::query()
                ->where('tenant_id', $tenant->id)
            ->roles()->first();

            Contest::create([
                'tenant_id' => $tenant->id,
                'user_id' => $user ?  $user->id : null,
                'name' => sprintf('Concurso %s - %s', $numero, $date->format('d/m/Y')),
                'number' => $numero,
                'drawn_at' => $date,
                'description' => $description,
                'status' => $status
            ]);
        }
        $this->info(sprintf('Concurso %s - %s', $numero, $date->format('d/m/Y')));
    }
}
