<?php

namespace App\Http\Livewire\Admin\Olt;

use App\Models\Centrodato;
use App\Models\Estado;
use App\Models\Olt;
use Livewire\Component;
use Livewire\WithPagination;


class OltShow extends Component
{
    use WithPagination;
    public $datacenterid, $datacenteride, $OltEdit, $oltid, $nombre, $slots, $marca, $modelo;
    public $search, $totalcontar, $totaldatacenters, $dataoltrelacionado, $estado_id, $estados;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';

    public function mount()
    {
        $this->totalcontar = Olt::count();
        $this->totaldatacenters = Centrodato::where('estado_id', "=", '1')->get();
        $this->estados = Estado::where('nombre', "=", 'Activo')->orwhere('nombre', "=", 'Deshabilitado')->get();
    }
    public function save()
    {
        if ($this->nombre) {
            # code...
        }
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:7',
            'marca' => 'required|min:3|max:50',
            'modelo' => 'required|min:3|max:50',
            'datacenterid' => 'required',
            'estado_id' => 'required',
        ]);

        $NewOlt = Olt::create([
            'nombre' => $this->nombre,
            'slots' => $this->slots,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'datacenter_id' => $this->datacenterid,
            'estado_id' => $this->estado_id,
        ]);
        $this->totalcontar = Olt::count();
        $this->reset(['nombre', 'slots', 'marca', 'modelo']);
        $this->emit('cerrarModalCrear');
        $this->emit('alert', 'El Olt se creo satisfactoriamente');
    }
    public function dataoltrelacionado()
    {
        $dataCenter = Centrodato::find($this->datacenterid);
        $this->dataoltrelacionado = $dataCenter;
    }
    public function cambiarestado($id)
    {

        $actualizarolt = Olt::find($id);
        if ($actualizarolt->estado_id == '1') {
            $this->estado_id = '2';
            $actualizarolt->update(['estado_id' => $this->estado_id]);
        } else {
            $this->estado_id = '1';
            $actualizarolt->update(['estado_id' => $this->estado_id]);
        }
    }
    public function edit(Olt $olt)
    {
        $this->OltEdit = $olt;
        $this->oltid = $this->OltEdit->id;
        $this->nombre = $this->OltEdit->nombre;
        $this->slots = $this->OltEdit->slots;
        $this->marca = $this->OltEdit->marca;
        $this->modelo = $this->OltEdit->modelo;
        $this->datacenteride = $this->OltEdit->datacenter->id;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:7',
            'marca' => 'required|min:3|max:50',
            'modelo' => 'required|min:3|max:50',
            'datacenteride' => 'required',
        ]);

        if ($this->oltid) {
            $updDataCenter = Olt::find($this->oltid);
            $updDataCenter->update([
                'nombre' => $this->nombre,
                'slots' => $this->slots,
                'marca' => $this->marca,
                'modelo' => $this->modelo,
                'datacenter_id' => $this->datacenteride,
            ]);
        }
        $this->reset(['nombre', 'slots', 'marca', 'modelo']);
        $this->emit('cerrarModalEditar');
        $this->emit('alert', 'El Olt se actualizo satisfactoriamente');
    }
    public function delete($id)
    {
        Olt::where('id', $id)->delete();
        $this->totalcontar = Olt::count();
        $this->reset('search');
    }
    public function resetcampos()
    {
        $this->reset(['nombre', 'slots', 'marca', 'modelo', 'datacenterid']);
        $this->estado_id = '1';
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
    public function render()
    {
        $olts = Olt::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('slots', 'like', '%' . $this->search . '%')
            ->orwhere('modelo', 'like', '%' . $this->search . '%')
            ->orwhere('marca', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.olt.olt-show', compact('olts'));
    }
}
