<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Rifas\Category;
use App\Models\Rifas\Rifa;
use Callcocam\Acl\Models\Role;
use Callcocam\Tenant\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tenant::query()->forceDelete();

        $tenants[] = Tenant::query()->create([
            'name' => 'Afortunado da Sorte',
            'email' => 'contato@afortunadodasorte.com',
            'domain' => request()->getHost(),
            'status' => 'published',
        ]);

        $tenants[] = Tenant::query()->create([
            'name' => 'Rifas',
            'email' => 'contato@rifas.com',
            'domain' => sprintf('rifas.%s', request()->getHost()),
            'status' => 'published',
        ]);

        // \App\Models\User::factory(10)->create();


        foreach ($tenants as $tenant) {

            DB::table('abouts')->insert([
                'id' => (string) strtolower(Str::ulid()),
                'tenant_id' => $tenant->id,
                'name' => 'Sobre Nós',
                'slug' => 'sobre-nos',
                'description' => 'Num recanto discreto, onde a esperança dança ao ritmo das cartas e a sorte se entrelaça com o destino, ergue-se a nossa casa de apostas, um refúgio para os que buscam desafios e a emoção palpável das apostas. Somos mais do que um simples estabelecimento de jogos; somos os artífices de experiências únicas, onde a coragem é recompensada e a fortuna se torna uma aliada.

                Ao cruzar as portas da nossa casa de apostas, adentra-se um universo onde o inesperado é tecido pelos fios da ousadia e da intuição. O clima vibrante contagia cada ambiente, enquanto os olhares astutos buscam na roleta da fortuna as respostas para seus destinos. Nas mesas de cartas, estratégias se entrelaçam com a astúcia, e o barulho dos dados ecoa como a sinfonia da sorte sendo desenhada.
                
                No coração deste espaço, reside o No Afortunado, uma entidade mitológica que personifica a sorte em sua forma mais imprevisível. Representado em murais e artefatos, o No Afortunado é o guardião da imprevisibilidade, desafiando jogadores a decifrarem os enigmas do acaso e a enfrentarem os caprichos da fortuna.
                
                Cada aposta feita em nossa casa é um pacto com o No Afortunado, uma dança entre a coragem e o mistério. A sorte, como uma dama volúvel, sorri para alguns enquanto prega peças em outros. Contudo, é na imprevisibilidade que encontramos a verdadeira magia do jogo, onde cada vitória é uma celebração e cada derrota, uma lição.
                
                Nossa casa de apostas é mais do que um local de entretenimento; é um espaço onde as histórias se entrelaçam com as cartas, e o destino é selado com o girar da roleta. Somos testemunhas e protagonistas de jornadas únicas, onde o No Afortunado guia os destinos com um toque de mistério.
                
                Assim, convidamos a todos que desejam desafiar a sorte a se juntarem a nós neste enclave de emoções intensas. Que cada aposta seja uma jornada, e cada giro da roleta, uma oportunidade de dançar com o imprevisível. Na nossa casa de apostas, o No Afortunado é o anfitrião, e a sorte, uma parceira inconstante que transforma cada instante numa experiência única.',
                'status' => 'published',
            ]);
            $user =   \App\Models\User::factory()->create([
                'tenant_id' => $tenant->id,
                'name' => 'Super Admin',
                'email' => sprintf('super-admin@%s', $tenant->domain),
            ]);
            if ($role = Role::query()->where('slug', 'super-admin')->first()) {
                $role->users()->attach($user->id);
            } else {
                $role = Role::query()->create([
                    'name' => 'super-admin',
                    'slug' => 'super-admin',
                    'description' => 'Super Admin',
                    'special' => 'all-access',
                ]);
                $role->users()->attach($user->id);
            }

            $userAddmin =   \App\Models\User::factory()->create([
                'tenant_id' => $tenant->id,
                'name' => 'Admin',
                'email' => sprintf('admin@%s', $tenant->domain),
            ]);

            if ($role = Role::query()->where('slug', 'admin')->first()) {
                $role->users()->attach($userAddmin->id);
            } else {
                $role = Role::query()->create([
                    'name' => 'admin',
                    'slug' => 'admin',
                    'description' => 'Admin',
                    'special' => null,
                ]);
                $role->users()->attach($userAddmin->id);
            }
            $role = Role::query()->where('slug', 'user')->first();
            if (!$role) {
                $role = Role::query()->create([
                    'name' => 'user',
                    'slug' => 'user',
                    'description' => 'User',
                    'special' => null,
                ]);
            }

            $user =   \App\Models\User::factory()->create([
                'tenant_id' => $tenant->id,
                'name' => 'John Doe',
                'email' => sprintf('johndoe@%s', $tenant->domain),
            ]);

            $role->users()->attach($user->id);

            $user =   \App\Models\User::factory()->create([
                'tenant_id' => $tenant->id,
                'name' => 'Jane Doe',
                'email' => sprintf('janedoe@%s', $tenant->domain),
            ]);

            $role->users()->attach($user->id);

            $user =   \App\Models\User::factory()->create([
                'tenant_id' => $tenant->id,
                'name' => 'John Doe Junior',
                'email' => sprintf('johndoejunior@%s', $tenant->domain),
            ]);

            $role->users()->attach($user->id);             

            $categorias = [
                'Automotivos',
                'Motocicletas',
                'Eletrônicos',
                'Eletrodomésticos',
                'Imóveis',
            ];

            $rifas = [];

            foreach ($categorias as $categoria) {
                $newCategory =  Category::factory()->create([
                    'tenant_id' => $tenant->id,
                    'user_id' => $userAddmin->id,
                    'name' => $categoria,
                    'slug' => \Illuminate\Support\Str::slug($categoria),
                ]);
                switch ($categoria) {
                    case 'Automotivos':
                        $rifas[] = new CategoriaModel($newCategory->id, 'Carro dos Sonhos', 'Concorra a um carro incrível que vai transformar sua experiência de direção.');
                        break;
                    case 'Motocicletas':
                        $rifas[] = new CategoriaModel($newCategory->id, 'Moto Radical', 'Ganhe uma moto potente e radical, perfeita para aventuras emocionantes nas estradas.');
                        break;
                    case 'Eletrônicos':
                        $rifas[] = new CategoriaModel($newCategory->id, 'Gadget Futurista', 'Tenha em suas mãos o mais recente gadget tecnológico, proporcionando inovação e praticidade.');
                        break;
                    case 'Eletrodomésticos':
                        $rifas[] = new CategoriaModel($newCategory->id, 'Cozinha Inteligente', 'Renove sua cozinha com os mais modernos eletrodomésticos inteligentes, tornando sua vida mais fácil.');
                        break;
                    case 'Imóveis':
                        $rifas[] = new CategoriaModel($newCategory->id, 'Casa dos Sonhos', 'Tenha a chance de ganhar a casa dos seus sonhos, proporcionando conforto e felicidade.');
                        break;
                }
            }

            foreach ($rifas as $rifa) {
                Rifa::factory()->create([
                    'tenant_id' => $tenant->id,
                    'user_id' => $userAddmin->id,
                    'category_id' => $rifa->rifa->category,
                    'name' => $rifa->rifa->nome,
                    'slug' => \Illuminate\Support\Str::slug($rifa->rifa->nome),
                    'description' => $rifa->rifa->descricao,
                ]);
            }
            $this->command->info('Tenant ' . $tenant->name . ' created');
        }
    }
}


class RifaModel
{
    public $category;
    public $nome;
    public $descricao;

    public function __construct($category, $nome, $descricao)
    {
        $this->category = $category;
        $this->nome = $nome;
        $this->descricao = $descricao;
    }
}

class CategoriaModel
{
    public $rifa;

    public function __construct($category, $nomeRifa, $descricaoRifa)
    {
        $this->rifa = new RifaModel($category, $nomeRifa, $descricaoRifa);
    }
}
