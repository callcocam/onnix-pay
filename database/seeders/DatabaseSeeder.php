<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Rifas\Category;
use App\Models\Rifas\Rifa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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
