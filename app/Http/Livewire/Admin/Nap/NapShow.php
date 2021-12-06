<?php

namespace App\Http\Livewire\Admin\Nap;

use App\Models\Centrodato;
use App\Models\Estado;
use App\Models\Gpon;
use App\Models\Nap;
use App\Models\Olt;
use App\Models\Tarjeta;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class NapShow extends Component
{
    use WithPagination;
    //Propiedades para crear nuevo Nap
    public $datacenterid, $oltid, $tarjetaid, $nombre, $slots, $estado, $gponid;
    //Extraer relaciones entre modelos
    public $datacenterselect, $olttarjetarelacionado, $tarjetagponrelacionado, $gponnaprelacionado;
    //Propiedades para editar una Nap
    public $napid, $napedit, $datacenteride, $oltide, $oltnombre, $gponide, $gponnombre, $oltidnuevo, $tarjetaide, $tarjetanombre, $tarjetaidnuevo, $gponidnuevo;
    //Método mount
    public $totalcontar, $totaldatacenters, $totalestados;
    public $sort = 'id', $direction = 'desc', $cant = '5', $search = '';
    public $objprueba;
    public $vermodalcrear = false;
    public $vermodaleditar = false;
    public function mount()
    {
        $this->totalcontar = Nap::count();
        $this->totaldatacenters = Centrodato::where('estado_id', "=", '1')->get();
        $this->totalestados = Estado::where('nombre', "=", 'Activo')->orwhere('nombre', "=", 'Deshabilitado')->get();
    }
    public function activarmodalcrear()
    {
        $this->vermodalcrear = true;
        $this->reset(['nombre', 'slots', 'oltid', 'datacenterselect', 'datacenterid', 'olttarjetarelacionado', 'tarjetaid', 'tarjetagponrelacionado', 'gponnaprelacionado']);
        $this->estado = "1";
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:15',
            'datacenterid' => 'required|numeric',
            'oltid' => 'required|numeric',
            'tarjetaid' => 'required|numeric',
            'gponid' => 'required|numeric',
            'estado' => 'required|numeric',
        ]);

        $NewNap = Nap::create([
            'nombre' => $this->nombre,
            'slots' => $this->slots,
            'gpon_id' => $this->gponid,
            'estado_id' => $this->estado,
        ]);
        $this->totalcontar = Nap::count();
        $this->vermodalcrear = false;
        $this->search= '';
        $this->emit('alert', 'La Caja Nap se creo satisfactoriamente');
    }
    public function edit(Nap $nap)
    {
        $this->reset(['nombre', 'slots', 'oltid', 'datacenterselect', 'datacenterid', 'olttarjetarelacionado', 'tarjetaid', 'tarjetagponrelacionado', 'gponnaprelacionado']);
        $this->vermodaleditar = true;
        $this->napedit     = $nap;
        $this->napid     = $this->napedit->id;
        $this->datacenterid = $this->napedit->gpon->tarjeta->olt->centrodato->id;
        $this->oltid     = $this->napedit->gpon->tarjeta->olt->id;
        $this->oltnombre    = $this->napedit->gpon->tarjeta->olt->nombre;
        $this->tarjetaid   = $this->napedit->gpon->tarjeta->id;
        $this->tarjetanombre = $this->napedit->gpon->tarjeta->nombre;
        $this->gponid    = $this->napedit->gpon->id;
        $this->gponnombre    = $this->napedit->gpon->nombre;
        $this->nombre       = $this->napedit->nombre;
        $this->slots        = $this->napedit->slots;
        $this->estado        = $this->napedit->estado_id;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:5|max:10',
            'slots' => 'required|numeric|min:1|max:15',
            'datacenterid' => 'required|numeric',
            'oltid' => 'required|numeric',
            'tarjetaid' => 'required|numeric',
            'gponid' => 'required|numeric',
            'estado' => 'required|numeric',
        ]);
        if ($this->napid) {
            $updNap = Nap::find($this->napid);
            $updNap->update([
                'nombre' => $this->nombre,
                'slots' => $this->slots,
                'gpon_id' => $this->gponid,
                'estado_id' => $this->estado,
            ]);
        }
        $this->reset('search');
        $this->vermodaleditar = false;
        $this->emit('alert', 'La Caja Nap se actualizo satisfactoriamente');
    }
    public function generarolts()
    {
        if (is_numeric($this->datacenterid)) {
            $this->datacenterselect = Centrodato::find($this->datacenterid);
            $this->oltid = "";
        }
    }
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
            $this->gponid = "";
        }
    }
    public function gponnaprelacion()
    {
        if (is_numeric($this->gponidnuevo)) {
            $this->gponid = $this->gponidnuevo;
        }
        if (is_numeric($this->gponid)) {
            $this->gponnaprelacionado = Gpon::find($this->gponid);
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
    public function resetcampos()
    {
        $this->reset(['nombre', 'slots', 'datacenterid', 'oltid', 'tarjetaid', 'gponid']);
        $this->reset(['gponidnuevo', 'datacenterselect', 'napedit', 'datacenteride', 'oltide', 'oltnombre', 'gponide', 'gponnombre', 'oltidnuevo', 'tarjetaide', 'tarjetanombre', 'tarjetaidnuevo', 'gponidnuevo']);
        $this->estado_id = "1";
    }
    public function cambiarestado($id)
    {
        $actualizarid = Nap::find($id);
        if ($actualizarid->estado_id == '1') {
            $this->estado_id = '2';
            $actualizarid->update(['estado_id' => $this->estado_id]);
        } else {
            $this->estado_id = '1';
            $actualizarid->update(['estado_id' => $this->estado_id]);
        }
    }
    public function render()
    {
        $naps = DB::table('naps')
            ->select('naps.nombre as napnombre' ,'naps.slots as napslot','naps.id as id', 'estados.nombre as estadonombre', 'estados.id as estadoid', 'gpons.nombre as gponnombre', 'gpons.id as gponid', 'tarjetas.nombre as tarjetanombre', 'tarjetas.id as tarjetaid', 'olts.nombre as oltnombre', 'olts.id as oltid', 'centrodatos.nombre as datacenternombre', 'centrodatos.id as datacenterid')
            ->join('estados', 'estados.id', '=', 'naps.estado_id')
            ->join('gpons', 'gpons.id', '=', 'naps.gpon_id')
            ->join('tarjetas', 'tarjetas.id', '=', 'gpons.tarjeta_id')
            ->join('olts', 'olts.id', '=', 'tarjetas.olt_id')
            ->join('centrodatos', 'centrodatos.id', '=', 'olts.centrodato_id')
            ->where('naps.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('naps.slots', 'like', '%' . $this->search . '%')
            ->orwhere('gpons.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('tarjetas.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('olts.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('centrodatos.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('estados.nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.nap.nap-show', compact('naps'));
    }
}
