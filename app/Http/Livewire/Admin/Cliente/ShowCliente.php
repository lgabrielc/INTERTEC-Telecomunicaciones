<?php

namespace App\Http\Livewire\Admin\Cliente;

use App\Models\Cliente;
use App\Models\Estado;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCliente extends Component
{


    use WithPagination;
    public $sort = 'id';
    public $direction = 'desc';
    public $search, $totalcontar, $totalestados;
    public $EditarCliente, $EditarNombre, $EditarID, $EditarApellido, $EditarDNI, $EditarCorreo;
    public $nombre, $apellido, $dni, $correo;
    public $fechainicio;
    public $fechavencimiento;
    public $fechacorte;
    public $cant = '5';
    public $open = false;

    protected $rules = [
        'nombre' => 'required|min:5|max:50',
        'apellido' => 'required|min:3|max:50',
        'dni' => 'required|size:8',
        'correo' => 'required|email|min:3|max:30',
    ];

    public function mount()
    {
        $this->totalcontar = Cliente::count();
        $this->fechainicio = date('Y-m-d');
        $this->fechavencimiento = date("Y-m-d",strtotime($this->fechainicio."+ 1 month"));
        $this->fechacorte = date("Y-m-d",strtotime($this->fechavencimiento."+ 3 days"));
        $this->totalestados = Estado::all();
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
    public function edit(Cliente $cliente)
    {
        $this->EditarCliente = $cliente;
        $this->EditarID = $this->EditarCliente->id;
        $this->EditarNombre = $this->EditarCliente->nombre;
        $this->EditarApellido = $this->EditarCliente->apellido;
        $this->EditarDNI = $this->EditarCliente->dni;
        $this->EditarCorreo = $this->EditarCliente->correo;
    }
    public function agregarservicio(Cliente $cliente)
    {
        $this->EditarCliente = $cliente;
    }
    public function verservicio(Cliente $cliente)
    {
        $this->EditarCliente = $cliente;
    }
    public function update()
    {
        $this->validate([
            'EditarNombre' => 'required|min:5|max:50',
            'EditarApellido' => 'required|min:5|max:50',
            'EditarDNI' => 'required|size:8',
            'EditarCorreo' => 'required|email|min:3|max:30',
        ]);
        if ($this->EditarID) {
            $updAntena = Cliente::find($this->EditarID);
            $updAntena->update([
                'nombre' => $this->EditarNombre,
                'apellido' => $this->EditarApellido,
                'dni' => $this->EditarDNI,
                'correo' => $this->EditarCorreo,
            ]);
        }
        $this->totalcontar = Cliente::count();
        $this->emit('cerrarModalEditar');
        $this->emit('alert', 'El Cliente se actualizo satisfactoriamente');
    }
    public function save()
    {
        $this->validate();
        $tower = Cliente::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'dni' => $this->dni,
            'correo' => $this->correo,
        ]);

        $this->totalcontar = Cliente::count();
        $this->reset(['nombre', 'apellido', 'dni', 'correo']);
        $this->emit('cerrarModalCrear');
        $this->emit('alert', 'El cliente se creo satisfactoriamente');
    }
    // public function savetipoantena()
    // {
    //     $this->validate([
    //         'crearnuevotipoantena' => 'required|min:5|max:30',
    //     ]);
    //     $newTipoAntena = TipoAntena::create([
    //         'nombre' => $this->crearnuevotipoantena,
    //     ]);

    //     $this->tipoantenas = TipoAntena::all();
    //     $this->totalcontar = Antena::count();
    //     $this->emit('cerrarModalCrearTipoAntena');
    //     $this->emit('alert', 'El Tipo de Antena se creo satisfactoriamente');
    // }
    public function render()
    {
        $clientes = Cliente::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('apellido', 'like', '%' . $this->search . '%')
            ->orwhere('dni', 'like', '%' . $this->search . '%')
            ->orwhere('correo', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.cliente.show-cliente', compact('clientes'));
    }

    public function delete($id)
    {
        Cliente::where('id', $id)->delete();
        $this->totalcontar = Cliente::count();

        // $Eliminarphone = Telefono::where('telefono_id', $id)->delete();
        // $Eliminarphone = Direccion::where('direccion_id', $id)->delete();
        $this->identificador = rand();
        // $servidorEliminar->delete();
    }
}
