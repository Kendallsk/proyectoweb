<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Jugadore;

class Jugadores extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $apellido, $evidencia_pago;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.jugadores.view', [
            'jugadores' => Jugadore::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('apellido', 'LIKE', $keyWord)
						->orWhere('evidencia_pago', 'LIKE', $keyWord)
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
		$this->nombre = null;
		$this->apellido = null;
		$this->evidencia_pago = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'apellido' => 'required',
		'evidencia_pago' => 'required',
        ]);

        Jugadore::create([ 
			'nombre' => $this-> nombre,
			'apellido' => $this-> apellido,
			'evidencia_pago' => $this-> evidencia_pago
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Jugadore Successfully created.');
    }

    public function edit($id)
    {
        $record = Jugadore::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->apellido = $record-> apellido;
		$this->evidencia_pago = $record-> evidencia_pago;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'apellido' => 'required',
		'evidencia_pago' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Jugadore::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'apellido' => $this-> apellido,
			'evidencia_pago' => $this-> evidencia_pago
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Jugadore Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Jugadore::where('id', $id);
            $record->delete();
        }
    }
}
