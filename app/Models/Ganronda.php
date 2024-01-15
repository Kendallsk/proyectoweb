<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ganronda extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'ganrondas';

    protected $fillable = ['idCategorias','idJugador','tipoRonda'];
	
}
