<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadore extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'jugadores';

    protected $fillable = ['nombre','apellido','evidencia_pago'];
	
}
