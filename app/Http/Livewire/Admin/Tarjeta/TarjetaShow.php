<?php

namespace App\Http\Livewire\Admin\Tarjeta;

use App\Models\Centrodato;
use App\Models\Estado;
use App\Models\Olt;
use App\Models\Tarjeta;
use Livewire\Component;

class TarjetaShow extends Component
{
    public $oltidnuevo,$datacenterid, $datacenteride, $oltid, $oltide, $tarjetaid, $tarjetaedit, $nombre, $slots, $estados, $estado_id;
    public $search, $totalcontar, $totaldatacenters, $selectolt, $datacenterselect, $olttarjetarelacionado, $totalolts;
    public $oltnombre, $datacenternombre;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';

    public function mount()
    {
        //Sirven para crear un nuevo
        $this->totaldatacenters = Centrodato::where('estado_id', "=", '1')->get();
        $this->totalolts = Olt::where('estado_id', "=", '1')->get();
        //Finn
        $this->estados = Estado::where('nombre', "=", 'Activo')->orwhere('nombre', "=", 'Deshabilitado')->get();
    }
    public function generarolts()
    {
        if (is_numeric($this->datacenteride)) {
            $this->datacenterselect = Centrodato::find($this->datacenteride);
            $this->reset('olttarjetarelacionado', 'oltidnuevo','oltide');
        } else {
            $this->reset( 'datacenterid', 'olttarjetarelacionado');
        }
        if (is_numeric($this->datacenterid)) {
            $this->datacenterselect = Centrodato::find($this->datacenterid);
            $this->reset('olttarjetarelacionado', 'oltidnuevo','oltide');
        } else {
            $this->reset('datacenterid', 'olttarjetarelacionado');
        }
    }

    public function olttarjetarelacion()
    {
        if (is_numeric($this->oltidnuevo)) {
            $this->olttarjetarelacionado = Olt::find($this->oltidnuevo);
        }
        if (is_numeric($this->oltid)) {
            $this->olttarjetarelacionado = Olt::find($this->oltid);
        }
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:15',
            'oltid' => 'required',
            'estado_id' => 'required',
            'datacenteride' => 'required|numeric',
        ]);

        $NewTarjeta = Tarjeta::create([
            'nombre' => $this->nombre,
            'slots' => $this->slots,
            'olt_id' => $this->oltid,
            'estado_id' => $this->estado_id,
        ]);
        $this->totalcontar = Tarjeta::count();
        $this->reset(['nombre', 'slots']);
        $this->emit('cerrarModalCrear');
        $this->emit('alert', 'La Tarjeta se creo satisfactoriamente');
    }

    public function edit(Tarjeta $tarjeta)
    {
        $this->reset(['nombre', 'slots', 'oltid', 'oltidnuevo', 'datacenterselect', 'datacenterid']);
        $this->tarjetaedit = $tarjeta;
        $this->tarjetaid = $this->tarjetaedit->id;
        $this->nombre = $this->tarjetaedit->nombre;
        $this->slots = $this->tarjetaedit->slots;
        $this->oltide = $this->tarjetaedit->olt->id;
        $this->oltnombre = $this->tarjetaedit->olt->nombre;
        $this->datacenteride = $this->tarjetaedit->olt->centrodato->id;
        $this->datacenternombre = $this->tarjetaedit->olt->centrodato->nombre;
    }
    public function update()
    {
        if (is_numeric($this->oltidnuevo)) {
            $this->oltide=$this->oltidnuevo;
        }
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:15',
            'oltide' => 'required',
        ]);

        if ($this->tarjetaid) {
            $updDataCenter = Tarjeta::find($this->tarjetaid);
            $updDataCenter->update([
                'nombre' => $this->nombre,
                'slots' => $this->slots,
                'olt_id' => $this->oltide,
            ]);
        }
        $this->reset(['nombre', 'slots', 'oltid', 'oltide']);
        $this->emit('cerrarModalEditar');
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
    public function resetcampos()
    {
        $this->reset(['nombre', 'slots', 'oltid', 'datacenterselect', 'datacenteride']);

        $this->estado_id = "1";
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

        $tarjetas = Tarjeta::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('slots', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.tarjeta.tarjeta-show', compact('tarjetas'));
    }
}
