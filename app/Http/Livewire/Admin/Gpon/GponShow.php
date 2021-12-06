<?php

namespace App\Http\Livewire\Admin\Gpon;

use App\Models\Centrodato;
use App\Models\Estado;
use App\Models\Gpon;
use App\Models\Olt;
use App\Models\Tarjeta;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class GponShow extends Component
{
    use WithPagination;
    public $datacenterid, $datacenterselect, $oltid, $olttarjetarelacionado, $tarjetaid, $tarjetagponrelacionado;
    public $slots, $nombre, $oltnombre, $tarjetanombre;
    public $estado, $search, $estados, $totalcontar, $totaldatacenters;
    public $sort = 'id', $direction = 'desc', $cant = '5';
    public $vermodalcrear = false, $vermodaleditar = false;

    public function mount()
    {
        $this->totaldatacenters = Centrodato::where('estado_id', "=", '1')->get();
        $this->totalcontar = Gpon::count();
        $this->totalolts = Olt::where('estado_id', "=", '1')->get();
        $this->totalestados = Estado::where('nombre', "=", 'Ac
        tivo')->orwhere('nombre', "=", 'Deshabilitado')->get();
    }
    public function activarmodalcrear()
    {
        $this->vermodalcrear = true;
        $this->reset(['nombre', 'slots', 'oltid', 'datacenterselect', 'datacenterid', 'olttarjetarelacionado', 'tarjetaid', 'tarjetagponrelacionado']);
        $this->estado = "1";
    }
    //Si escogemos o cambiamos un nuevo datacenter
    public function generarolts()
    {
        if (is_numeric($this->datacenterid)) {
            $this->datacenterselect = Centrodato::find($this->datacenterid);
            $this->reset('tarjetaid', 'oltid', 'olttarjetarelacionado', 'tarjetagponrelacionado');
            $this->oltid = "";
        } else {
            $this->reset('oltid', 'tarjetaid', 'datacenterid', 'olttarjetarelacionado', 'tarjetagponrelacionado');
        }
    }
    //Cada vez que cambiamos uN OLT o escogemos una
    public function olttarjetarelacion()
    {
        if (is_numeric($this->oltid)) {
            $this->olttarjetarelacionado = Olt::find($this->oltid);
            $this->tarjetaid = "";
        }
    }

    public function tarjetagponrelacion()
    {
        if (is_numeric($this->tarjetaid)) {
            $this->tarjetagponrelacionado = Tarjeta::find($this->tarjetaid);
        }
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:15',
            'datacenterid' => 'required',
            'oltid' => 'required',
            'tarjetaid' => 'required',
            'estado' => 'required',
        ]);
        $NewGpon = Gpon::create([
            'nombre' => $this->nombre,
            'slots' => $this->slots,
            'tarjeta_id' => $this->tarjetaid,
            'estado_id' => $this->estado,
        ]);
        $this->totalcontar = Gpon::count();
        $this->vermodalcrear = false;
        $this->emit('alert', 'El Gpon se creo satisfactoriamente');
    }
    public function cambiarestado($id)
    {
        $actualizarid = Gpon::find($id);
        if ($actualizarid->estado_id == '1') {
            $this->estado_id = '2';
            $actualizarid->update(['estado_id' => $this->estado_id]);
        } else {
            $this->estado_id = '1';
            $actualizarid->update(['estado_id' => $this->estado_id]);
        }
    }
    public function edit(Gpon $gpon)
    {
        $vermodalcrear = false;
        $this->reset(['nombre', 'slots', 'oltid', 'datacenterselect', 'datacenterid', 'olttarjetarelacionado', 'tarjetaid', 'tarjetagponrelacionado', 'tarjetanombre']);
        $this->vermodaleditar = true;
        $this->gponedit     = $gpon;
        $this->datacenterid = $this->gponedit->tarjeta->olt->centrodato->id;
        $this->gponid    = $this->gponedit->id;
        $this->nombre       = $this->gponedit->nombre;
        $this->slots        = $this->gponedit->slots;
        $this->tarjetaid   = $this->gponedit->tarjeta->id;
        $this->tarjetanombre = $this->gponedit->tarjeta->nombre;
        $this->oltid      = $this->gponedit->tarjeta->olt->id;
        $this->oltnombre    = $this->gponedit->tarjeta->olt->nombre;
        $this->estado = $this->gponedit->estado->id;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:5|max:10',
            'slots' => 'required|numeric|min:1|max:15',
            'tarjetaid' => 'required|numeric',
            'datacenterid' => 'required|numeric',
            'oltid' => 'required|numeric',
            'estado' => 'required|numeric',
        ]);
        if ($this->gponid) {
            $updDataCenter = Gpon::find($this->gponid);
            $updDataCenter->update([
                'nombre' => $this->nombre,
                'slots' => $this->slots,
                'tarjeta_id' => $this->tarjetaid,
                'estado_id' => $this->estado,
            ]);
        }
        $this->reset('search');
        $this->vermodaleditar = false;
        $this->emit('alert', 'El Gpon se actualizo satisfactoriamente');
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
        $gpons = DB::table('gpons')
        ->select('gpons.id as id', 'gpons.nombre as nombre','gpons.slots as slots','tarjetas.nombre as tarjetanombre','olts.nombre as oltnombre','centrodatos.nombre as centrodatonombre','estados.nombre as estadonombre','estados.id as estadoid','gpons.id as gponid')
        ->join('tarjetas', 'tarjetas.id', '=', 'gpons.tarjeta_id')
        ->join('olts', 'olts.id', '=', 'tarjetas.olt_id')
        ->join('centrodatos', 'centrodatos.id', '=', 'olts.centrodato_id')
        ->join('estados', 'estados.id', '=', 'gpons.estado_id')
        ->where('gpons.nombre', 'like', '%' . $this->search . '%')
        ->orwhere('gpons.slots', 'like', '%' . $this->search . '%')
        ->orwhere('tarjetas.nombre', 'like', '%' . $this->search . '%')
        ->orwhere('olts.nombre', 'like', '%' . $this->search . '%')
        ->orwhere('centrodatos.nombre', 'like', '%' . $this->search . '%')
        ->orwhere('estados.nombre', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->paginate($this->cant);
        return view('livewire.admin.gpon.gpon-show', compact('gpons'));
    }
}
