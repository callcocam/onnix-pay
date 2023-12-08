<?php

namespace Database\Factories\Rifas;

use Callcocam\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rifas\Rifa>
 */
class RifaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'tenant_id' =>  Tenant::all()->random()->id, 
            'name' => $name = $this->faker->name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'description' => $this->faker->text, 
            'type' => $this->faker->randomElement(['free', 'paid']), // 'free', 'paid'
            'image' => sprintf('ilustracao/%s.png', $this->faker->randomElement(['1', '2', '3', '4', '5'])),
            'price' => $this->faker->randomFloat(2, 1, 200),
            'quantity' => $this->faker->randomNumber(3),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'draw_date' => $this->faker->date(),
            'draw_time' => $this->faker->time(),
            'draw_local' => $this->faker->text,
            'draw_local_link' => $this->faker->url,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(['published', 'draft', 'published', 'published'])
        ];
    }
}
