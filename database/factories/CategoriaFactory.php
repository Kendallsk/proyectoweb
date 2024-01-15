<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition()
    {
        return [
			'nombreJuego' => $this->faker->name,
			'precioInscripcion' => $this->faker->name,
			'descripcion' => $this->faker->name,
        ];
    }
}
