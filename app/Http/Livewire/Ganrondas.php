<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ganronda;

class Ganrondas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $idCategorias, $idJugador, $tipoRonda;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.ganrondas.view', [
            'ganrondas' => Ganronda::latest()
						->orWhere('idCategorias', 'LIKE', $keyWord)
						->orWhere('idJugador', 'LIKE', $keyWord)
						->orWhere('tipoRonda', 'LIKE', $keyWord)
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
		$this->idCategorias = null;
		$this->idJugador = null;
		$this->tipoRonda = null;
    }

    public function store()
    {
        $this->validate([
		'idCategorias' => 'required',
		'idJugador' => 'required',
		'tipoRonda' => 'required',
        ]);

        Ganronda::create([ 
			'idCategorias' => $this-> idCategorias,
			'idJugador' => $this-> idJugador,
			'tipoRonda' => $this-> tipoRonda
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Ganronda Successfully created.');
    }

    public function edit($id)
    {
        $record = Ganronda::findOrFail($id);

        $this->selected_id = $id; 
		$this->idCategorias = $record-> idCategorias;
		$this->idJugador = $record-> idJugador;
		$this->tipoRonda = $record-> tipoRonda;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'idCategorias' => 'required',
		'idJugador' => 'required',
		'tipoRonda' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Ganronda::find($this->selected_id);
            $record->update([ 
			'idCategorias' => $this-> idCategorias,
			'idJugador' => $this-> idJugador,
			'tipoRonda' => $this-> tipoRonda
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Ganronda Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Ganronda::where('id', $id);
            $record->delete();
        }
    }
}
