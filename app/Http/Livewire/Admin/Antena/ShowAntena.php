<?php

namespace App\Http\Livewire\Admin\Antena;

use App\Models\Antena;
use App\Models\Servidor;
use App\Models\TipoAntena;
use App\Models\Torre;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAntena extends Component
{

    use WithPagination;
    public $search, $totalcontar, $nombre, $ip, $mac, $frecuencia, $canal, $marca, $servidor, $torre, $tipoantena;
    public $sort = 'id';
    public $direction = 'desc';
    public $EditarAntena, $EditarID, $EditarNombre, $EditarIP, $EditarMac, $EditarFrecuencia, $EditarCanal;
    public $EditarMarca, $EditarServidor, $EditarTorre, $EditarTipoAntena;
    public $EditarServidorID, $EditarTorreID, $EditarTipoAntenaID;
    public $servidores, $torres, $tipoantenas;
    public $crearnuevotipoantena;
    public $cant = '5';
    public $open = false;

    protected $rules = [
        'nombre' => 'required|min:5|max:50',
        'ip' => 'required|ipv4',
        'mac' => 'required|size:17',
        'frecuencia' => 'required|min:4|max:9',
        'canal' => 'required|min:1|max:6',
        'marca' => 'required|min:2|max:30',
        'servidor' => 'required',
        'torre' => 'required',
        'tipoantena' => 'required',
    ];

    public function mount()
    {
        $this->totalcontar = Antena::count();
        $this->servidores = Servidor::all();
        $this->torres = Torre::all();
        $this->tipoantenas = TipoAntena::all();
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
    public function edit(Antena $antena)
    {
        $this->EditarAntena = $antena;
        $this->EditarID = $this->EditarAntena->id;
        $this->EditarNombre = $this->EditarAntena->nombre;
        $this->EditarIP = $this->EditarAntena->ip;
        $this->EditarMac = $this->EditarAntena->mac;
        $this->EditarFrecuencia = $this->EditarAntena->frecuencia;
        $this->EditarCanal = $this->EditarAntena->canal;
        $this->EditarMarca = $this->EditarAntena->marca;
        $this->EditarServidorID = $this->EditarAntena->servidor->id;
        $this->EditarServidor = $this->EditarAntena->servidor->nombre;
        $this->EditarTorreID = $this->EditarAntena->torre->id;
        $this->EditarTorre = $this->EditarAntena->torre->nombre;
        $this->EditarTipoAntenaID = $this->EditarAntena->tipoantena->id;
        $this->EditarTipoAntena = $this->EditarAntena->tipoantena->nombre;
    }
    
    public function update()
    {
        $this->validate([
            'EditarNombre' => 'required|min:5|max:50',
            'EditarIP' => 'required|ipv4',
            'EditarMac' => 'required|size:17',
            'EditarFrecuencia' => 'required|min:4|max:9',
            'EditarCanal' => 'required|min:1|max:6',
            'EditarMarca' => 'required|min:2|max:30',
            'EditarServidor' => 'required',
            'EditarServidorID' => 'required',
            'EditarTorre' => 'required',
            'EditarTorreID' => 'required',
            'EditarTipoAntena' => 'required',
            'EditarTipoAntenaID' => 'required',
        ]);
        if ($this->EditarID) {
            $updAntena = Antena::find($this->EditarID);
            $updAntena->update([
                'nombre' => $this->EditarNombre,
                'ip' => $this->EditarIP,
                'mac' => $this->EditarMac,
                'frecuencia' => $this->EditarFrecuencia,
                'canal' => $this->EditarCanal,
                'marca' => $this->EditarMarca,
                'torre_id' => $this->EditarTorreID,
                'servidor_id' => $this->EditarServidorID,
                'tipoantena_id' => $this->EditarTipoAntenaID,
            ]);
        }
        $this->totaltorres = Torre::count();
        $this->emit('cerrarModalEditar');
        $this->emit('alert', 'La Antena se actualizo satisfactoriamente');
    }
    public function save()
    {
        $this->validate();
        $tower = Antena::create([
            'nombre' => $this->nombre,
            'ip' => $this->ip,
            'mac' => $this->mac,
            'frecuencia' => $this->frecuencia,
            'canal' => $this->canal,
            'marca' => $this->marca,
            'torre_id' => $this->torre,
            'servidor_id' => $this->servidor,
            'tipoantena_id' => $this->tipoantena,
        ]);
        
        $this->totalcontar = Antena::count();
        $this->reset(['nombre', 'ip', 'mac', 'frecuencia', 'canal', 'marca', 'torre', 'servidor', 'tipoantena']);
        $this->emit('cerrarModalCrear');
        $this->emit('alert', 'La Torre se creo satisfactoriamente');
    }
    public function savetipoantena()
    {
        $this->validate([
            'crearnuevotipoantena' => 'required|min:5|max:30',
        ]);
        $newTipoAntena = TipoAntena::create([
            'nombre' => $this->crearnuevotipoantena,
        ]);
        
        $this->tipoantenas = TipoAntena::all();
        $this->totalcontar = Antena::count();
        $this->emit('cerrarModalCrearTipoAntena');
        $this->emit('alert', 'El Tipo de Antena se creo satisfactoriamente');
    }
    public function render()
    {
        // return view('livewire.admin.torre.show-torre');
        $antenas = Antena::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('ip', 'like', '%' . $this->search . '%')
            ->orwhere('mac', 'like', '%' . $this->search . '%')
            ->orwhere('frecuencia', 'like', '%' . $this->search . '%')
            ->orwhere('canal', 'like', '%' . $this->search . '%')
            ->orwhere('marca', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.antena.show-antena', compact('antenas'));
    }
    public function delete($id)
    {
        Antena::where('id', $id)->delete();
        $this->totalcontar = Antena::count();

        // $Eliminarphone = Telefono::where('telefono_id', $id)->delete();
        // $Eliminarphone = Direccion::where('direccion_id', $id)->delete();
        $this->identificador = rand();
        // $servidorEliminar->delete();
    }
}
