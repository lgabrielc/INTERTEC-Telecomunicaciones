<?php

namespace App\Http\Livewire\Admin\Antena;

use App\Models\Antena;
use App\Models\Estado;
use App\Models\Servidor;
use App\Models\TipoAntena;
use App\Models\Torre;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class ShowAntena extends Component
{
    use WithPagination;
    public $estado, $totalestados, $search, $totalcontar, $nombre, $ip, $mac, $frecuencia, $canal, $marca, $servidor, $torre, $tipoantena;
    public $totalservidores, $totaltorres, $tipoantenas;
    public $cant = '5', $sort = 'id', $direction = 'desc';
    public $vermodalcrear = false, $vermodaleditar = false;

    public function mount()
    {
        $this->totalcontar = Antena::count();
        $this->totalservidores = Servidor::where('estado_id', "=", '1')->get();
        $this->totaltorres = Torre::where('estado_id', "=", '1')->get();
        $this->tipoantenas = TipoAntena::where('estado_id', "=", '1')->get();
        $this->totalestados = Estado::where('nombre', "=", 'Activo')->orwhere('nombre', "=", 'Deshabilitado')->get();
    }
    public function activarmodalcrear()
    {
        $this->vermodalcrear = true;
        $this->reset(['nombre', 'ip', 'mac', 'frecuencia', 'canal', 'marca', 'servidor', 'torre', 'tipoantena']);
        $this->estado = "1";
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:5|max:50',
            'ip' => 'required|ipv4',
            'mac' => 'required|size:17',
            'frecuencia' => 'required|min:4|max:9',
            'canal' => 'required|min:1|max:6',
            'marca' => 'required|min:2|max:30',
            'servidor' => 'required|numeric',
            'torre' => 'required|numeric',
            'tipoantena' => 'required|numeric',
            'estado' => 'required|numeric',
        ]);
        Antena::create([
            'nombre' => $this->nombre,
            'ip' => $this->ip,
            'mac' => $this->mac,
            'frecuencia' => $this->frecuencia,
            'canal' => $this->canal,
            'marca' => $this->marca,
            'torre_id' => $this->torre,
            'servidor_id' => $this->servidor,
            'tipoantena_id' => $this->tipoantena,
            'estado_id' => $this->estado,
        ]);
        $this->totalcontar = Antena::count();
        $this->vermodalcrear = false;
        $this->emit('alert', 'La Antena se creo satisfactoriamente');
    }
    public function edit(Antena $antena)
    {
        $this->reset(['nombre', 'ip', 'mac', 'frecuencia', 'canal', 'marca', 'servidor', 'torre', 'tipoantena']);
        $this->vermodaleditar = true;
        $this->EditarAntena = $antena;
        $this->EditarID = $this->EditarAntena->id;
        $this->nombre = $this->EditarAntena->nombre;
        $this->ip = $this->EditarAntena->ip;
        $this->mac = $this->EditarAntena->mac;
        $this->frecuencia = $this->EditarAntena->frecuencia;
        $this->canal = $this->EditarAntena->canal;
        $this->marca = $this->EditarAntena->marca;
        $this->servidor = $this->EditarAntena->servidor->id;
        $this->torre = $this->EditarAntena->torre->id;
        $this->tipoantena = $this->EditarAntena->tipoantena->id;
        $this->estado = $this->EditarAntena->estado->id;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:5|max:50',
            'ip' => 'required|ipv4',
            'mac' => 'required|size:17',
            'frecuencia' => 'required|min:4|max:9',
            'canal' => 'required|min:1|max:6',
            'marca' => 'required|min:2|max:30',
            'servidor' => 'required|numeric',
            'torre' => 'required|numeric',
            'tipoantena' => 'required|numeric',
            'estado' => 'required|numeric',
        ]);
        if ($this->EditarID) {
            $updAntena = Antena::find($this->EditarID);
            $updAntena->update([
                'nombre' => $this->nombre,
                'ip' => $this->ip,
                'mac' => $this->mac,
                'frecuencia' => $this->frecuencia,
                'canal' => $this->canal,
                'marca' => $this->marca,
                'torre_id' => $this->torre,
                'servidor_id' => $this->servidor,
                'tipoantena_id' => $this->tipoantena,
                'estado_id' => $this->estado,
            ]);
        }
        $this->vermodaleditar = false;
        $this->emit('alert', 'La Antena se actualizo satisfactoriamente');
    }
    public function cambiarestado($id)
    {
        $actualizarid = Antena::find($id);
        if ($actualizarid->estado_id == '1') {
            $this->estado_id = '2';
            $actualizarid->update(['estado_id' => $this->estado_id]);
        } else {
            $this->estado_id = '1';
            $actualizarid->update(['estado_id' => $this->estado_id]);
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
    public function delete($id)
    {
        Antena::where('id', $id)->delete();
        $this->totalcontar = Antena::count();
    }
    public function render()
    {
        $antenas = DB::table('antenas')
            ->select('antenas.id as id', 'antenas.nombre as nombre', 'antenas.ip as ip', 'antenas.mac as mac', 'antenas.frecuencia as frecuencia', 'antenas.canal as canal', 'antenas.marca as marca', 'servidores.nombre as servidornombre', 'torres.nombre as torrenombre', 'tipoantena.nombre as tipoantenanombre', 'estados.id as estadoid', 'estados.nombre as estado')
            ->join('servidores', 'antenas.servidor_id', '=', 'servidores.id')
            ->join('torres', 'antenas.torre_id', '=', 'torres.id')
            ->join('tipoantena', 'antenas.tipoantena_id', '=', 'tipoantena.id')
            ->join('estados', 'antenas.estado_id', '=', 'estados.id')
            ->where('antenas.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('antenas.ip', 'like', '%' . $this->search . '%')
            ->orwhere('antenas.mac', 'like', '%' . $this->search . '%')
            ->orwhere('antenas.frecuencia', 'like', '%' . $this->search . '%')
            ->orwhere('antenas.canal', 'like', '%' . $this->search . '%')
            ->orwhere('antenas.marca', 'like', '%' . $this->search . '%')
            ->orwhere('servidores.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('torres.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('tipoantena.nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.antena.show-antena', compact('antenas'));
    }
}
