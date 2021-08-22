<?php

namespace App\Http\Livewire\Admin\Torre;

use App\Models\Direccion;
use App\Models\Telefono;
use App\Models\Torre;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTorre extends Component
{

    use WithPagination;
    public $search, $totaltorres, $nombre, $dueño, $direccion, $telefono, $mensualidad;
    public $sort = 'id';
    public $direction = 'desc';
    public $torreEdit, $torreID, $nombreEdit, $dueñoEdit, $direccionEdit,$telefonoEdit,$mensualidadEdit;
    public $cant = '5';
    public $open = false;
    public $prueba;

    protected $rules = [
        'nombre' => 'required|min:5|max:50',
        'dueño' => 'required|min:3|max:50',
        'direccion' => 'required|min:3|max:60',
        'telefono' => 'required|digits_between:7,9|numeric',
        'mensualidad' => 'required|numeric',
    ];

    public function mount()
    {
        $this->totaltorres = Torre::count();
    }
    public function order($sort)
    {
        if ($sort == $this->sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
        }
    }
    public function edit(Torre $Torre)
    {
        $this->torreEdit = $Torre;
        $this->torreID = $this->torreEdit->id;
        $this->nombreEdit = $this->torreEdit->nombre;
        $this->dueñoEdit = $this->torreEdit->dueño;
        $this->direccionEdit = $this->torreEdit->direccion[0]->direccion;
        $this->telefonoEdit = $this->torreEdit->telefono[0]->numero;
        $this->mensualidadEdit = $this->torreEdit->mensualidad;
    }
    public function update()
    {
        $this->validate([
            'nombreEdit' => 'required|min:5|max:50',
            'dueñoEdit' => 'required|min:3|max:50',
            'direccionEdit' => 'required|min:5|max:60',
            'telefonoEdit' => 'required|digits_between:7,9|numeric',
            'mensualidadEdit' => 'required|numeric',
        ]);
        if ($this->torreID) {
            $updTorre = Torre::find($this->torreID);
            $updTorre->update([
                'nombre' => $this->nombreEdit,
                'dueño' => $this->dueñoEdit,
                'direccion' => $this->direccionEdit,
                'telefono' => $this->telefonoEdit,
                'mensualidad' => $this->mensualidadEdit,
            ]);
        }
        $Eliminarphone = Telefono::where('telefono_id', $this->torreID)->delete();
        $phone = new Telefono();
        $phone->numero = $this->telefonoEdit;
        $updTorre->telefono()->save($phone);
        $Eliminarphone = Direccion::where('direccion_id', $this->torreID)->delete();
        $directione = new Direccion();
        $directione->direccion = $this->direccionEdit;
        $updTorre->direccion()->save($directione);
        $this->totaltorres = Torre::count();
        $this->emit('cerrarModalEditar');
        $this->emit('alert', 'El servidor se actualizo satisfactoriamente');
    }
    public function save()
    {
        $this->validate();
        $tower =Torre::create([
            'nombre' => $this->nombre,
            'dueño' => $this->dueño,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'mensualidad' => $this->mensualidad,
        ]);
        $phone = new Telefono();
        $phone->numero = $this->telefono;;
        $tower->telefono()->save($phone);
        $directione = new Direccion();
        $directione->direccion = $this->direccion;
        $tower->direccion()->save($directione);
        $this->totaltorres = Torre::count();
        $this->reset(['nombre', 'dueño', 'direccion', 'telefono', 'mensualidad']);
        $this->emit('cerrarModalCrear');
        $this->emit('alert', 'La Torre se creo satisfactoriamente');
    }
    public function render()
    {
        // return view('livewire.admin.torre.show-torre');
        $torres = Torre::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('dueño', 'like', '%' . $this->search . '%')
            ->orwhere('mensualidad', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.torre.show-torre', compact('torres'));
    }
    public function delete($id)
    {
        Torre::where('id', $id)->delete();
        $this->totaltorres = Torre::count();
        
        $Eliminarphone = Telefono::where('telefono_id', $id)->delete();
        $Eliminarphone = Direccion::where('direccion_id', $id)->delete();
        $this->identificador = rand();
        // $servidorEliminar->delete();
    }
}
