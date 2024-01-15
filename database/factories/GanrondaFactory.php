<?php

namespace Database\Factories;

use App\Models\Ganronda;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GanrondaFactory extends Factory
{
    protected $model = Ganronda::class;

    public function definition()
    {
        return [
			'idCategorias' => $this->faker->name,
			'idJugador' => $this->faker->name,
			'tipoRonda' => $this->faker->name,
        ];
    }
}
