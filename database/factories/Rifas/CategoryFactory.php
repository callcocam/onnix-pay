<?php

namespace Database\Factories\Rifas;

use Callcocam\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rifas\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' =>  Tenant::all()->random()->id,
            'name' => $name = $this->faker->name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'description' => $this->faker->text,
            'status' => $this->faker->boolean ? 'published' : 'draft',
            'image' => sprintf('ilustracao/category-%s.png', $this->faker->randomElement(['1', '2', '3', '4', '5'])),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
