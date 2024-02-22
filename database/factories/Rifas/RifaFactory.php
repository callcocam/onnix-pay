<?php

namespace Database\Factories\Rifas;

use Callcocam\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Laravel\Prompts\text;

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
        $endDays = rand(11, 150);
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'tenant_id' =>  Tenant::all()->random()->id, 
            'name' => $name = $this->faker->name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'description' => $this->faker->text, 
            'type' =>  'paid',
            'image' => sprintf('ilustracao/%s.png', $this->faker->randomElement(['1', '2', '3', '4', '5'])),
            'preview' => $this->faker->text,
            'code' => $this->IniciasNomes($name),
            'gallery' => json_encode([
                sprintf('ilustracao/%s.png', $this->faker->randomElement(['1', '2', '3', '4', '5'])),
                sprintf('ilustracao/%s.png', $this->faker->randomElement(['1', '2', '3', '4', '5'])),
                sprintf('ilustracao/%s.png', $this->faker->randomElement(['1', '2', '3', '4', '5'])),
                sprintf('ilustracao/%s.png', $this->faker->randomElement(['1', '2', '3', '4', '5'])),
                sprintf('ilustracao/%s.png', $this->faker->randomElement(['1', '2', '3', '4', '5'])),
            ]),
            'price' => $this->faker->randomFloat(2, 1, 10),
            'quantity' => 6,
            'total' => $this->faker->randomFloat(2, 1000, 10000),
            'start_date' => now()->subDays(rand(11, 150)),
            'end_date' => now()->addDays($endDays), 
            'draw_local' => $this->faker->name,
            'draw_local_link' => route('sorteio'),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(['draft', 'published'])
        ];
    }

    protected function IniciasNomes($String)
    {
        if (empty($String)) {
            return '';
        }
        $Nome = preg_split("/((de|da|do|dos|das|e|as|As|a|o|£|ou|é|&|o|os)?)[\s,_-]+/", $String);
        $Iniciais = "";
        foreach ($Nome as $N) {
            if (strlen($N) > 0) {
                $Iniciais .= $N[0];
            }
        }
        return sprintf("%s-%s", $Iniciais, rand(1, 99));
    }
}
