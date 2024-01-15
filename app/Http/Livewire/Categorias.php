<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoria;

class Categorias extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombreJuego, $precioInscripcion, $descripcion;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.categorias.view', [
            'categorias' => Categoria::latest()
						->orWhere('nombreJuego', 'LIKE', $keyWord)
						->orWhere('precioInscripcion', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
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
		$this->nombreJuego = null;
		$this->precioInscripcion = null;
		$this->descripcion = null;
    }

    public function store()
    {
        $this->validate([
		'nombreJuego' => 'required',
		'precioInscripcion' => 'required',
		'descripcion' => 'required',
        ]);

        Categoria::create([ 
			'nombreJuego' => $this-> nombreJuego,
			'precioInscripcion' => $this-> precioInscripcion,
			'descripcion' => $this-> descripcion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Categoria Successfully created.');
    }

    public function edit($id)
    {
        $record = Categoria::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombreJuego = $record-> nombreJuego;
		$this->precioInscripcion = $record-> precioInscripcion;
		$this->descripcion = $record-> descripcion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombreJuego' => 'required',
		'precioInscripcion' => 'required',
		'descripcion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Categoria::find($this->selected_id);
            $record->update([ 
			'nombreJuego' => $this-> nombreJuego,
			'precioInscripcion' => $this-> precioInscripcion,
			'descripcion' => $this-> descripcion
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Categoria Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Categoria::where('id', $id);
            $record->delete();
        }
    }
}
