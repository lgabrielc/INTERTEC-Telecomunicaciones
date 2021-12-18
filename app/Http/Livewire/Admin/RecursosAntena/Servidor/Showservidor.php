<?php

namespace App\Http\Livewire\Admin\RecursosAntena\Servidor;

use Livewire\Component;
use App\Models\Estado;
use App\Models\Servidor;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class Showservidor extends Component

{
    use WithPagination;
    public $search, $totalservidores, $nombre, $ipEntrada, $ipSalida, $totalestados,$servidorid;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';
    public $open = false;
    public $vermodaleditar = false;
    public $vermodalcrear = false;
    public $estado=1;

    public function mount()
    {
        $this->totalservidores = Servidor::count();
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
    public function activarmodalcrear(){
        $this->reset('nombre', 'ipEntrada', 'ipSalida', 'estado');
        $this->vermodalcrear = true;
    }
    public function edit(Servidor $servidor)
    {
        $this->vermodaleditar = true;
        $this->servidorEdit = $servidor;
        $this->servidorid = $this->servidorEdit->id;
        $this->nombre = $this->servidorEdit->nombre;
        $this->ipEntrada = $this->servidorEdit->ipEntrada;
        $this->ipSalida = $this->servidorEdit->ipSalida;
        $this->estado = $this->servidorEdit->estado_id;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:5|max:30',
            'ipEntrada' => 'required|ipv4',
            'ipSalida' => 'required|ipv4',
            'estado' => 'required|numeric',
        ]);
        if ($this->servidorid) {
            $updServidor = Servidor::find($this->servidorid);
            $updServidor->update([
                'nombre' => $this->nombre,
                'ipEntrada' => $this->ipEntrada,
                'ipSalida' => $this->ipSalida,
                'estado_id' => $this->estado,
            ]);
        }
        $this->totalservidores = Servidor::count();
        $this->vermodaleditar = false;
        $this->emit('alert', 'El servidor se actualizo satisfactoriamente');
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:5|max:30',
            'ipEntrada' => 'required|ipv4',
            'ipSalida' => 'required|ipv4',
            'estado' => 'required',
        ]);
        Servidor::create([
            'nombre' => $this->nombre,
            'ipEntrada' => $this->ipEntrada,
            'ipSalida' => $this->ipSalida,
            'estado_id' => $this->estado,
        ]);
        $this->totalservidores = Servidor::count();
        $this->reset(['nombre', 'ipEntrada', 'ipSalida']);
        $this->vermodalcrear = false;
        $this->emit('alert', 'El servidor se creo satisfactoriamente');
    }
    public function cambiarestado(Servidor $servidor)
    {
        $estadoservidor = $servidor->estado_id;
        if ($estadoservidor == '1') {
            Servidor::where('id', $servidor->id)->update(['estado_id' => '2']);
        } else {
            Servidor::where('id', $servidor->id)->update(['estado_id' => '1']);
        }
    }
    public function render()
    {
        $servidores = DB::table('servidores')
            ->select('servidores.id as id', 'servidores.nombre as nombre', 'servidores.ipEntrada as ipEntrada', 'servidores.ipSalida as ipSalida', 'estados.nombre as estadonombre', 'estados.id as estadoid')
            ->join('estados', 'servidores.estado_id', '=', 'estados.id')
            ->where('servidores.nombre', 'like', '%' . $this->search . '%')
            ->orwhere('servidores.ipEntrada', 'like', '%' . $this->search . '%')
            ->orwhere('servidores.ipSalida', 'like', '%' . $this->search . '%')
            ->orwhere('estados.nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.recursos-antena.servidor.showservidor', compact('servidores'));
    }
}
