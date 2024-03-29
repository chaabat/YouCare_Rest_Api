<?php

namespace Database\Factories;

use App\Models\Annonce;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnonceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Annonce::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre' => $this->faker->sentence,
            'date' => $this->faker->date,
            'description' => $this->faker->paragraph,
            'localisation' => $this->faker->city,
            'competence' => $this->faker->words(3, true),
            'type_id' => $this->faker->numberBetween(1,3), 
        ];
    }
}
