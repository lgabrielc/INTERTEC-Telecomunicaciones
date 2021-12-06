<?php
namespace App\Http\Livewire\Admin\Datacenter;
use App\Models\Centrodato;
use App\Models\Estado;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class DatacenterShow extends Component
{
    use WithPagination;
    public $datacenterid, $nombre, $ubicacion, $direccion, $encargado, $DataCenterEdit;
    public $search, $totaldatacenters, $totalestados, $estado='1';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';
    public $vermodalcrear=false;
    public $vermodaleditar=false;

    public function mount()
    {
        $this->totaldatacenters = Centrodato::count();
        $this->totalestados = Estado::where('nombre',"=" ,'Activo')->orwhere('nombre',"=" ,'Deshabilitado')->get();
    }
    public function activarmodalcrear()
    {
        $this->vermodalcrear=true;
        $this->reset(['nombre', 'ubicacion', 'direccion', 'encargado', 'estado']);
        $this->estado = "1";
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'ubicacion' => 'required|min:3|max:100',
            'direccion' => 'required|min:3|max:100',
            'encargado' => 'nullable',
            'estado' => 'required',
        ]);
        $NewDatacenter = Centrodato::create([
            'nombre' => $this->nombre,
            'ubicacion' => $this->ubicacion,
            'direccion' => $this->direccion,
            'encargado' => $this->encargado,
            'estado_id' => $this->estado,
        ]);
        $this->totaldatacenters = Centrodato::count();
        $this->reset(['nombre', 'ubicacion', 'direccion', 'encargado', 'estado']);
        $this->vermodalcrear=false;
        $this->emit('alert', 'El DataCenter se creo satisfactoriamente');
    }

    public function edit(Centrodato $dataCenter)
    {
        $this->vermodaleditar=true;
        $this->DataCenterEdit = $dataCenter;
        $this->datacenterid = $this->DataCenterEdit->id;
        $this->nombre = $this->DataCenterEdit->nombre;
        $this->ubicacion = $this->DataCenterEdit->ubicacion;
        $this->direccion = $this->DataCenterEdit->direccion;
        $this->encargado = $this->DataCenterEdit->encargado;
        $this->estado = $this->DataCenterEdit->estado_id;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'ubicacion' => 'required|min:3|max:100',
            'direccion' => 'required|min:3|max:100',
            'encargado' => 'nullable',
            'estado' => 'required',
        ]);
        if ($this->datacenterid) {
            $updDataCenter = Centrodato::find($this->datacenterid);
            $updDataCenter->update([
                'nombre' => $this->nombre,
                'ubicacion' => $this->ubicacion,
                'direccion' => $this->direccion,
                'encargado' => $this->encargado,
                'estado_id' => $this->estado,
            ]);
            $this->reset(['nombre', 'ubicacion', 'direccion', 'encargado']);
        }
        $this->vermodaleditar=false;
        $this->emit('alert', 'El DataCenter se actualizo satisfactoriamente');
    }
    public function cambiarestado(Centrodato $datacenter)
    {
        $estadodatacenter = $datacenter->estado_id;
        if ($estadodatacenter == '1') {
            Centrodato::where('id', $datacenter->id)->update(['estado_id' => '2']);
        }else{
            Centrodato::where('id', $datacenter->id)->update(['estado_id' => '1']);
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
        $datacenters = DB::Table('centrodatos')
        ->select('centrodatos.id as id','centrodatos.nombre as nombre','centrodatos.ubicacion as ubicacion','centrodatos.direccion as direccion','centrodatos.encargado as encargado','estados.nombre as estadonombre','estados.id as estadoid')
        ->join('estados', 'centrodatos.estado_id', '=', 'estados.id')
        ->where('centrodatos.nombre', 'like', '%' . $this->search . '%')
        ->orwhere('centrodatos.ubicacion', 'like', '%' . $this->search . '%')
        ->orwhere('centrodatos.direccion', 'like', '%' . $this->search . '%')
        ->orwhere('centrodatos.encargado', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->paginate($this->cant);
        return view('livewire.admin.datacenter.datacenter-show', compact('datacenters'));
    }
}
