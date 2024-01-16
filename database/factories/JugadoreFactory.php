<?php

namespace Database\Factories;

use App\Models\Jugadore;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JugadoreFactory extends Factory
{
    protected $model = Jugadore::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'apellido' => $this->faker->name,
			'evidencia_pago' => $this->faker->name,
        ];
    }
}
