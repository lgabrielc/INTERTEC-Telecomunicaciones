<?php

namespace App\Http\Livewire\Admin\RecursosFibra\Olt;

use Livewire\Component;
use App\Models\Centrodato;
use App\Models\Estado;
use App\Models\Olt;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Showolt extends Component
{
    use WithPagination;
    public $datacenterid, $datacenteride, $OltEdit, $oltid, $nombre, $slots, $marca, $modelo;
    public $search, $totalcontar, $totaldatacenters, $dataoltrelacionado, $estado_id, $estados;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';
    public $vermodalcrear = false;
    public $vermodaleditar = false;

    public function mount()
    {
        $this->totalcontar = Olt::count();
        $this->totaldatacenters = Centrodato::where('estado_id', "=", '1')->get();
        $this->totalestados = Estado::where('nombre', "=", 'Activo')->orwhere('nombre', "=", 'Deshabilitado')->get();
    }
    public function activarmodalcrear()
    {
        $this->vermodalcrear = true;
        $this->reset(['nombre', 'slots', 'marca', 'modelo', 'datacenterid', 'datacenteride']);
        $this->estado = "1";
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
            'estado' => 'required',
        ]);

        $NewOlt = Olt::create([
            'nombre' => $this->nombre,
            'slots' => $this->slots,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'centrodato_id' => $this->datacenterid,
            'estado_id' => $this->estado,
        ]);
        $this->totalcontar = Olt::count();
        $this->reset(['nombre', 'slots', 'marca', 'modelo', 'datacenterid']);
        $this->vermodalcrear = false;
        $this->emit('alert', 'El Olt se creo satisfactoriamente');
    }
    public function dataoltrelacionado()
    {
        if (is_numeric($this->datacenteride)) {
            $dataCenter = Centrodato::find($this->datacenteride);
            $this->dataoltrelacionado = $dataCenter;
        } else {
            $dataCenter = Centrodato::find($this->datacenterid);
            $this->dataoltrelacionado = $dataCenter;
        }
    }
    public function cambiarestado(Olt $olt)
    {
        $estadoacambiar = $olt->estado_id;
        if ($estadoacambiar == '1') {
            Olt::where('id', $olt->id)->update(['estado_id' => '2']);
        } else {
            Olt::where('id', $olt->id)->update(['estado_id' => '1']);
        }
    }
    public function edit(Olt $olt)
    {
        $this->reset(['nombre', 'slots', 'marca', 'modelo', 'dataoltrelacionado', 'datacenterid', 'datacenteride']);
        $this->vermodaleditar = true;
        $this->OltEdit = $olt;
        $this->oltid = $this->OltEdit->id;
        $this->nombre = $this->OltEdit->nombre;
        $this->slots = $this->OltEdit->slots;
        $this->marca = $this->OltEdit->marca;
        $this->modelo = $this->OltEdit->modelo;
        $this->datacenteride = $this->OltEdit->centrodato->id;
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
                'centrodato_id' => $this->datacenteride,
            ]);
        }
        $this->vermodaleditar = false;
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
        $olts = DB::table('olts')
            ->select('olts.id as id', 'olts.nombre as nombre', 'olts.slots as slots', 'olts.modelo as modelo', 'olts.marca as marca', 'centrodatos.nombre as centrodatonombre', 'estados.nombre as estadonombre', 'estados.id as estadoid')
            ->join('centrodatos', 'centrodatos.id', '=', 'olts.centrodato_id')
            ->join('estados', 'estados.id', '=', 'olts.estado_id')
            ->where('olts.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('olts.slots', 'like', '%' . $this->search . '%')
            ->orwhere('olts.modelo', 'like', '%' . $this->search . '%')
            ->orwhere('olts.marca', 'like', '%' . $this->search . '%')
            ->orwhere('centrodatos.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('estados.nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.recursos-fibra.olt.showolt', compact('olts'));
    }
}
