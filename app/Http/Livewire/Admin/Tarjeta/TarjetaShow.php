<?php

namespace App\Http\Livewire\Admin\Tarjeta;

use App\Models\Centrodato;
use App\Models\Estado;
use App\Models\Olt;
use App\Models\Tarjeta;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class TarjetaShow extends Component
{
    use WithPagination;
    public $oltidnuevo, $datacenterid, $datacenteride, $oltid, $oltide, $tarjetaid, $tarjetaedit, $nombre, $slots, $estados, $estado;
    public $search, $totalcontar, $totaldatacenters, $selectolt, $datacenterselect, $olttarjetarelacionado, $totalolts;
    public $oltnombre, $datacenternombre;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';
    public $vermodalcrear = false;
    public $vermodaleditar = false;

    public function mount()
    {
        //Sirven para crear un nuevo
        $this->totalcontar = Tarjeta::count();
        $this->totaldatacenters = Centrodato::where('estado_id', "=", '1')->get();
        $this->totalolts = Olt::where('estado_id', "=", '1')->get();
        //Finn
        $this->totalestados = Estado::where('nombre', "=", 'Activo')->orwhere('nombre', "=", 'Deshabilitado')->get();
    }
    public function activarmodalcrear()
    {
        $this->vermodalcrear = true;
        $this->reset(['nombre', 'slots', 'oltid', 'datacenterselect', 'datacenterid']);
        $this->estado = "1";
    }
    public function generarolts()
    {
        if (is_numeric($this->datacenteride)) {
            $this->datacenterselect = Centrodato::find($this->datacenteride);
            $this->reset('olttarjetarelacionado', 'oltide');
        } else {
            $this->reset('olttarjetarelacionado');
        }
        if (is_numeric($this->datacenterid)) {
            $this->datacenterselect = Centrodato::find($this->datacenterid);
            $this->reset('olttarjetarelacionado');
            $this->oltid="";
        } else {
            $this->reset('datacenterid', 'olttarjetarelacionado');
        }
    }

    public function olttarjetarelacion()
    {
        if (is_numeric($this->oltid)) {
            $this->olttarjetarelacionado = Olt::find($this->oltid);
        }
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:15',
            'oltid' => 'required|numeric',
            'estado' => 'required',
            'datacenterid' => 'required|numeric',
        ]);

        Tarjeta::create([
            'nombre' => $this->nombre,
            'slots' => $this->slots,
            'olt_id' => $this->oltid,
            'estado_id' => $this->estado,
        ]);
        $this->totalcontar = Tarjeta::count();
        $this->reset(['nombre', 'slots']);
        $this->vermodalcrear = false;
        $this->emit('alert', 'La Tarjeta se creo satisfactoriamente');
    }

    public function edit(Tarjeta $tarjeta)
    {
        $this->reset(['nombre', 'slots', 'oltid','datacenterselect', 'datacenterid','olttarjetarelacionado']);
        $this->vermodaleditar = true;
        $this->tarjetaedit = $tarjeta;
        $this->tarjetaid = $this->tarjetaedit->id;
        $this->nombre = $this->tarjetaedit->nombre;
        $this->slots = $this->tarjetaedit->slots;
        $this->oltid = $this->tarjetaedit->olt->id;
        $this->oltnombre = $this->tarjetaedit->olt->nombre;
        $this->datacenterid = $this->tarjetaedit->olt->centrodato->id;
        $this->datacenternombre = $this->tarjetaedit->olt->centrodato->nombre;
        $this->estado = $this->tarjetaedit->estado_id;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:15',
            'oltid' => 'required|numeric',
            'estado' => 'required|numeric',
        ]);

        if ($this->tarjetaid) {
            $updDataCenter = Tarjeta::find($this->tarjetaid);
            $updDataCenter->update([
                'nombre' => $this->nombre,
                'slots' => $this->slots,
                'olt_id' => $this->oltid,
                'estado_id' => $this->estado,
            ]);
        }
        $this->vermodaleditar = false;
        $this->emit('alert', 'La Tarjeta se actualizo satisfactoriamente');
    }
    public function delete($id)
    {
        Tarjeta::where('id', $id)->delete();
        $this->totalcontar = Tarjeta::count();
    }
    public function cambiarestado($id)
    {
        $actualizartarjeta = Tarjeta::find($id);
        if ($actualizartarjeta->estado_id == '1') {
            $this->estado_id = '2';
            $actualizartarjeta->update(['estado_id' => $this->estado_id]);
        } else {
            $this->estado_id = '1';
            $actualizartarjeta->update(['estado_id' => $this->estado_id]);
        }
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
        $tarjetas = DB::Table('tarjetas')
        ->select('tarjetas.id as id','tarjetas.nombre as nombre','tarjetas.slots as slots','olts.nombre as oltnombre','centrodatos.nombre as centrodatonombre','estados.nombre as estadonombre','estados.id as estadoid')
        ->join('olts', 'tarjetas.olt_id', '=', 'olts.id')
        ->join('centrodatos', 'olts.centrodato_id', '=', 'centrodatos.id')
        ->join('estados', 'tarjetas.estado_id', '=', 'estados.id')
        ->where('tarjetas.nombre', 'like', '%' . $this->search . '%')
        ->orwhere('tarjetas.slots', 'like', '%' . $this->search . '%')
        ->orwhere('olts.nombre', 'like', '%' . $this->search . '%')
        ->orwhere('centrodatos.nombre', 'like', '%' . $this->search . '%')
        ->orwhere('estados.nombre', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->paginate($this->cant);
        return view('livewire.admin.tarjeta.tarjeta-show', compact('tarjetas'));
    }
}
