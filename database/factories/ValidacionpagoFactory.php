<?php

namespace Database\Factories;

use App\Models\Validacionpago;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ValidacionpagoFactory extends Factory
{
    protected $model = Validacionpago::class;

    public function definition()
    {
        return [
			'idjugador' => $this->faker->name,
			'activo' => $this->faker->name,
			'descripcion' => $this->faker->name,
        ];
    }
}
