<?php

namespace App\Http\Livewire\Admin\RecursosAntena\Torre;

use App\Models\Estado;
use App\Models\Torre;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Showtorre extends Component
{
    use WithPagination;
    public $search, $totaltorres, $nombre, $dueño, $direccion, $telefono, $mensualidad, $totalestados, $estado = '1', $estados;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';
    public $vermodaleditar = false;
    public $vermodalcrear = false;

    public function activarmodalcrear()
    {
        $this->reset(['nombre', 'dueño', 'direccion', 'telefono', 'mensualidad', 'estado']);
        $this->vermodalcrear = true;
        $this->estado = "1";
    }
    public function cambiarestado($id)
    {
        $actualizarid = Torre::find($id);
        if ($actualizarid->estado_id == '1') {
            $this->estado_id = '2';
            $actualizarid->update(['estado_id' => $this->estado_id]);
        } else {
            $this->estado_id = '1';
            $actualizarid->update(['estado_id' => $this->estado_id]);
        }
    }
    public function mount()
    {
        $this->totaltorres = Torre::count();
        $this->totalestados = Estado::where('nombre', "=", 'Activo')->orwhere('nombre', "=", 'Deshabilitado')->get();
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
        $this->reset(['nombre', 'dueño', 'direccion', 'telefono', 'mensualidad', 'estado']);
        $this->vermodaleditar = true;
        $this->torreEdit    = $Torre;
        $this->torreID      = $this->torreEdit->id;
        $this->nombre       = $this->torreEdit->nombre;
        $this->dueño        = $this->torreEdit->dueño;
        $this->direccion    = $this->torreEdit->direccion;
        $this->telefono     = $this->torreEdit->telefono;
        $this->mensualidad  = $this->torreEdit->mensualidad;
        $this->estado      = $this->torreEdit->estado_id;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:5|max:50',
            'dueño' => 'required|min:3|max:50',
            'direccion' => 'required|min:5|max:60',
            'telefono' => 'required|digits_between:7,9|numeric',
            'mensualidad' => 'required|numeric',
            'estado' => 'required|numeric',
        ]);
        if ($this->torreID) {
            $updTorre = Torre::find($this->torreID);
            $updTorre->update([
                'nombre' => $this->nombre,
                'dueño' => $this->dueño,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'mensualidad' => $this->mensualidad,
                'estado_id' => $this->estado,
            ]);
        }
        $this->vermodaleditar = false;
        $this->emit('alert', 'El servidor se actualizo satisfactoriamente');
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:5|max:50',
            'dueño' => 'required|min:3|max:50',
            'direccion' => 'required|min:3|max:60',
            'telefono' => 'required|digits_between:7,9|numeric',
            'mensualidad' => 'required|numeric',
            'estado' => 'required|numeric'
        ]);
        Torre::create([
            'nombre' => $this->nombre,
            'dueño' => $this->dueño,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'mensualidad' => $this->mensualidad,
            'estado_id' => $this->estado
        ]);
        $this->totaltorres = Torre::count();
        $this->vermodalcrear = false;
        $this->emit('alert', 'La Torre se creo satisfactoriamente');
    }
    public function render()
    {
        $torres = DB::table('torres')
            ->select('torres.id as id', 'torres.nombre as nombre', 'torres.dueño as dueño', 'torres.mensualidad as mensualidad', 'torres.telefono as telefono', 'torres.direccion as direccion', 'estados.nombre as estadonombre', 'estados.id as estadoid')
            ->join('estados', 'torres.estado_id', '=', 'estados.id')
            ->where('torres.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('torres.dueño', 'like', '%' . $this->search . '%')
            ->orwhere('torres.direccion', 'like', '%' . $this->search . '%')
            ->orwhere('torres.telefono', 'like', '%' . $this->search . '%')
            ->orwhere('torres.mensualidad', 'like', '%' . $this->search . '%')
            ->orwhere('estados.nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.recursos-antena.torre.showtorre', compact('torres'));
    }
}