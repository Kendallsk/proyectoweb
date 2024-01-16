<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validacionpago extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'validacionpagos';

    protected $fillable = ['idjugador','activo','descripcion'];
	
}
