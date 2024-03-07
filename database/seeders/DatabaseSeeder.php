<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Rifas\Category;
use App\Models\Rifas\Rifa;
use Callcocam\Tenant\Models\Tenant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tenant::query()->forceDelete();

        Tenant::query()->create([
            'name' => 'Rifa',
            'email' => 'contato@afortunadodasorte.com',
            'domain' => request()->getHost(),
            'status' => 'published',
        ]);

        // \App\Models\User::factory(10)->create();

        $user =   \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super-admin@afortunadosdasorte.com',
        ]);

        $role = $user->roles()->create([
            'name' => 'super-admin',
            'slug' => 'super-admin',
            'description' => 'Super Admin',
            'special' => 'all-access',
        ]);

        $role->users()->attach($user->id);

        $role = $user->roles()->create([
            'name' => 'admin',
            'slug' => 'admin',
            'description' => 'Admin',
            'special' => null,
        ]);

        $user =   \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@afortunadosdasorte.com',
        ]);

        $role->users()->attach($user->id);

        $user =   \App\Models\User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@afortunadosdasorte.com',
        ]);

        $role->users()->attach($user->id);

        $user =   \App\Models\User::factory()->create([
            'name' => 'John Doe Junior',
            'email' => 'johndoejunior@afortunadosdasorte.com'
        ]);

        $role->users()->attach($user->id);


        Rifa::query()->forceDelete();
        Category::query()->forceDelete();
        $categories =   Category::factory(1)->create();
        $category = $categories->first();

        $categorias = [
            'Automotivos',
            'Motocicletas',
            'Eletrônicos',
            'Eletrodomésticos',
            'Móveis',
            'Decoração',
            'Moda',
            'Esportes',
            'Brinquedos',
            'Games',
            'Livros',
            'Colecionáveis',
            'Imóveis',
            'Serviços'
        ];

        $rifas = [];

        foreach ($categorias as $categoria) {
            $newCategory =  Category::factory()->create([
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
                case 'Móveis':
                    $rifas[] = new CategoriaModel($newCategory->id, 'Conjunto Sofisticado', 'Transforme sua casa com um conjunto de móveis sofisticados e elegantes, proporcionando conforto e estilo.');
                    break;
                case 'Decoração':
                    $rifas[] = new CategoriaModel($newCategory->id, 'Arte nas Paredes', 'Adicione arte e personalidade à sua casa com uma seleção exclusiva de itens de decoração.');
                    break;
                case 'Moda':
                    $rifas[] = new CategoriaModel($newCategory->id, 'Guarda-Roupa Fashion', 'Renove seu guarda-roupa com peças da última moda, expressando seu estilo único.');
                    break;
                case 'Esportes':
                    $rifas[] = new CategoriaModel($newCategory->id, 'Kit Esportivo Premium', 'Desfrute de uma vida ativa com um kit esportivo premium, ideal para diversas atividades físicas.');
                    break;
                case 'Brinquedos':
                    $rifas[] = new CategoriaModel($newCategory->id, 'Diversão Infinita', 'Proporcione momentos de diversão infinita com uma seleção de brinquedos educativos e criativos.');
                    break;
                case 'Games':
                    $rifas[] = new CategoriaModel($newCategory->id, 'Console de Última Geração', 'Experimente a próxima geração de entretenimento com um console de jogos de última geração.');
                    break;
                case 'Livros':
                    $rifas[] = new CategoriaModel($newCategory->id, 'Biblioteca Pessoal', 'Monte sua própria biblioteca pessoal com uma coleção de livros dos mais variados gêneros.');
                    break;
                case 'Colecionáveis':
                    $rifas[] = new CategoriaModel($newCategory->id, 'Item Exclusivo', 'Adicione um item exclusivo à sua coleção, tornando-a ainda mais especial.');
                    break;
                case 'Imóveis':
                    $rifas[] = new CategoriaModel($newCategory->id, 'Casa dos Sonhos', 'Tenha a chance de ganhar a casa dos seus sonhos, proporcionando conforto e felicidade.');
                    break;
                case 'Serviços':
                    $rifas[] = new CategoriaModel($newCategory->id, 'Pacote de Serviços VIP', 'Desfrute de um pacote de serviços VIP, proporcionando comodidade e praticidade em sua vida.');
                    break;
            }
        }



        Category::factory(5)->create([
            'category_id' => $category->id,
        ]);

        foreach ($rifas as $rifa) {
            Rifa::factory()->create([
                'category_id' => $rifa->rifa->category,
                'name' => $rifa->rifa->nome,
                'slug' => \Illuminate\Support\Str::slug($rifa->rifa->nome),
                'description' => $rifa->rifa->descricao,
            ]);
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
