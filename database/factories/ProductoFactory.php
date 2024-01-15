<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
			'Nombre' => $this->faker->name,
			'Precio' => $this->faker->name,
			'EsGrupal' => $this->faker->name,
			'Imagen' => $this->faker->name,
			'Descripcion' => $this->faker->name,
        ];
    }
}
