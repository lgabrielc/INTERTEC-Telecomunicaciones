<?php

namespace Database\Factories;

use App\Models\Servidor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServidorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Servidor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'nombre' => $this->faker->name(),
            'ipEntrada' => $this->faker->ipv4(),
            'ipSalida' => $this->faker->ipv4(),
        ];
    }
}
