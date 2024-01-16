<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Validacionpago;

class Validacionpagos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $idjugador, $activo, $descripcion;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.validacionpagos.view', [
            'validacionpagos' => Validacionpago::latest()
						->orWhere('idjugador', 'LIKE', $keyWord)
						->orWhere('activo', 'LIKE', $keyWord)
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
		$this->idjugador = null;
		$this->activo = null;
		$this->descripcion = null;
    }

    public function store()
    {
        $this->validate([
		'idjugador' => 'required',
		'activo' => 'required',
		'descripcion' => 'required',
        ]);

        Validacionpago::create([ 
			'idjugador' => $this-> idjugador,
			'activo' => $this-> activo,
			'descripcion' => $this-> descripcion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Validacionpago Successfully created.');
    }

    public function edit($id)
    {
        $record = Validacionpago::findOrFail($id);

        $this->selected_id = $id; 
		$this->idjugador = $record-> idjugador;
		$this->activo = $record-> activo;
		$this->descripcion = $record-> descripcion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'idjugador' => 'required',
		'activo' => 'required',
		'descripcion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Validacionpago::find($this->selected_id);
            $record->update([ 
			'idjugador' => $this-> idjugador,
			'activo' => $this-> activo,
			'descripcion' => $this-> descripcion
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Validacionpago Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Validacionpago::where('id', $id);
            $record->delete();
        }
    }
}
