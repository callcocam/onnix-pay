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
        Category::factory(5)->create([
            'category_id' => $category->id,
        ]);

        foreach (Category::query()->whereNotNull('category_id')->get() as $category) {
            Rifa::factory(rand(2, 7))->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
