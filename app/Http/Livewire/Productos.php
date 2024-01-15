<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;

class Productos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $Nombre, $Precio, $EsGrupal, $Imagen, $Descripcion;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.productos.view', [
            'productos' => Producto::latest()
						->orWhere('Nombre', 'LIKE', $keyWord)
						->orWhere('Precio', 'LIKE', $keyWord)
						->orWhere('EsGrupal', 'LIKE', $keyWord)
						->orWhere('Imagen', 'LIKE', $keyWord)
						->orWhere('Descripcion', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->Nombre = null;
		$this->Precio = null;
		$this->EsGrupal = null;
		$this->Imagen = null;
		$this->Descripcion = null;
    }

    public function store()
    {
        $this->validate([
		'Nombre' => 'required',
		'Precio' => 'required',
		'EsGrupal' => 'required',
		'Descripcion' => 'required',
        ]);

        Producto::create([ 
			'Nombre' => $this-> Nombre,
			'Precio' => $this-> Precio,
			'EsGrupal' => $this-> EsGrupal,
			'Imagen' => $this-> Imagen,
			'Descripcion' => $this-> Descripcion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Producto Successfully created.');
    }

    public function edit($id)
    {
        $record = Producto::findOrFail($id);

        $this->selected_id = $id; 
		$this->Nombre = $record-> Nombre;
		$this->Precio = $record-> Precio;
		$this->EsGrupal = $record-> EsGrupal;
		$this->Imagen = $record-> Imagen;
		$this->Descripcion = $record-> Descripcion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'Nombre' => 'required',
		'Precio' => 'required',
		'EsGrupal' => 'required',
		'Descripcion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Producto::find($this->selected_id);
            $record->update([ 
			'Nombre' => $this-> Nombre,
			'Precio' => $this-> Precio,
			'EsGrupal' => $this-> EsGrupal,
			'Imagen' => $this-> Imagen,
			'Descripcion' => $this-> Descripcion
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Producto Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Producto::where('id', $id);
            $record->delete();
        }
    }
}
