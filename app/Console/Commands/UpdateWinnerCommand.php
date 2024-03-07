<?php

namespace App\Console\Commands;

use App\Models\Contest;
use App\Models\Rifas\Rifa;
use App\Models\User;
use App\Models\Winner;
use Callcocam\Tenant\Models\Tenant;
use Illuminate\Console\Command;

class UpdateWinnerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-winner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica se existe um ganhador e atualiza o status da rifa';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $tenant = Tenant::query()->where('domain', request()->getHost())->first();
        $user  =  User::query()
            ->where('tenant_id', $tenant->id)
            ->roles()->first();
        $rifas = Rifa::query()
            ->where('status', 'published')
            ->where('end_date', '<=', now())
            ->get();
        $contest = Contest::query()
            ->where('status', 'published')
            ->where('drawn_at', '<=', now())
            ->orderBy('drawn_at', 'desc')
            ->first();
        foreach ($rifas as $rifa) {
            if ($sales = $rifa->salesPay) {
                foreach ($sales as $sale) {
                    if ($sale->winner()->exists())
                        continue;
                    $this->info('Rifa: ' . $rifa->name . ' - Sale: ' . $sale->id);
                    if ($numbers = $sale->numbers->pluck('number')->toArray()) {
                        $sortes = $contest->description;
                        foreach ($sortes as $sorte) {
                            if (in_array($sorte, $numbers)) {
                                $this->info('O número ' . $sorte . ' foi sorteado');
                                Winner::query()
                                    ->create([
                                        'tenant_id' => $tenant->id,
                                        'user_id' => $sale->user_id,
                                        'sale_id' => $sale->id,
                                        'rifa_id' => $rifa->id,
                                        'delivery_at' => now()->addDays(7)->format('Y-m-d H:i:s'),
                                        'status' => 'published',
                                        'description' => "Parabéns você é o ganhador da rifa {$rifa->name}"
                                    ]);
                                $rifa->update([
                                    'contest_id' =>  $contest->id,
                                ]);
                                $sale->numbers()->where('number', $sorte)->update(['status' => 'winner']);
                            }
                        }
                    }
                }
            }
        }

        $this->info('The command was successful!');
    }
}
