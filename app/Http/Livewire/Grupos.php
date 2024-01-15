<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Grupo;

class Grupos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $NombreGrupo, $idCategoria;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.grupos.view', [
            'grupos' => Grupo::latest()
						->orWhere('NombreGrupo', 'LIKE', $keyWord)
						->orWhere('idCategoria', 'LIKE', $keyWord)
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
		$this->NombreGrupo = null;
		$this->idCategoria = null;
    }

    public function store()
    {
        $this->validate([
		'NombreGrupo' => 'required',
		'idCategoria' => 'required',
        ]);

        Grupo::create([ 
			'NombreGrupo' => $this-> NombreGrupo,
			'idCategoria' => $this-> idCategoria
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Grupo Successfully created.');
    }

    public function edit($id)
    {
        $record = Grupo::findOrFail($id);

        $this->selected_id = $id; 
		$this->NombreGrupo = $record-> NombreGrupo;
		$this->idCategoria = $record-> idCategoria;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'NombreGrupo' => 'required',
		'idCategoria' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Grupo::find($this->selected_id);
            $record->update([ 
			'NombreGrupo' => $this-> NombreGrupo,
			'idCategoria' => $this-> idCategoria
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Grupo Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Grupo::where('id', $id);
            $record->delete();
        }
    }
}
