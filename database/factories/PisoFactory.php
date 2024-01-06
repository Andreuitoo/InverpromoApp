<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PisoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha' => $this->faker->date(),
            'ref' => $this->faker->word(),
            'tipo_piso' => $this->faker->word(),
            'zona' => $this->faker->word(),
            'precio' => $this->faker->randomNumber(),
            'num_hab' => $this->faker->randomNumber(),
            'muebles' => $this->faker->word(),
            'descripcion' => $this->faker->text(),
            'telefono' => $this->faker->randomNumber(),
            'propietario' => $this->faker->word(),
        ];
    }
}
