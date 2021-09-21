<?php

namespace App\Http\Livewire\Admin\Cliente;

use App\Models\Datacenter;
use App\Models\Antena;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Gpon;
use App\Models\Olt;
use App\Models\Plan;
use App\Models\Servicio;
use App\Models\Tarjeta;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCliente extends Component
{
    use WithPagination;
    public $sort = 'id';
    public $direction = 'desc';
    public $tiposervicio, $VerServicio, $condicionAntena;
    public $search, $totalcontar, $totalestados, $totalplanes, $totalantenas, $totaldatacenters;
    //Editar Cliente
    public $EditarCliente, $EditarNombre, $EditarID, $EditarApellido, $EditarDNI, $EditarCorreo,$EditarDireccion,$EditarTelefono;
    //Agregar Servicio
    public $AgregarServicio, $planid, $IDClienteServicio, $NombreClienteServicio, $ApellidoClienteServicio, $estado_id;
    public $condicionantena, $mac, $ip, $frecuencia, $antenaid;
    public $nap_id;
    public $gponrelacionado, $clientegpon, $estado, $plannuevo, $olttarjetarelacionado, $tarjetagponrelacionado, $gponnaprelacionado;
    public $datacenterid, $datacenterselect, $oltid, $tarjetaid, $gponid, $napid;
    //Datos Cliente
    public $nombre, $apellido, $dni, $correo, $direccion, $telefono;
    //Agregar Plan
    public $NombrePlan, $VelocidadDescarga, $VelocidadSubida, $PrecioPlan;
    public $isDisabled = true;
    public $agregarplan;
    public $cant = '5';
    public $open = false;

    protected $rules = [
        'nombre' => 'required|min:5|max:50',
        'apellido' => 'required|min:3|max:50',
        'dni' => 'required|size:8',
        'direccion' => 'required|min:3|max:50',
        'telefono' => 'required|min:7|max:20',
        'correo' => 'nullable|email|min:3|max:30',

    ];

    public function cambiartipodeservicio()
    {
        if ($this->tiposervicio == 'Antena') {
            $this->reset('gponrelacionado', 'clientegpon', 'gponrelacionado', 'datacenterid', 'oltid', 'tarjetaid', 'gponid', 'napid', 'plannuevo');
        } else {
            $this->reset('condicionantena', 'mac', 'ip', 'frecuencia', 'antenaid', 'plannuevo');
        }
    }

    public function naprelacion()
    {
        if (is_numeric($this->napid)) {
            $this->reset('clientegpon');
        } else {
            $this->reset('clientegpon');
        }
    }

    public function gponnaprelacion()
    {
        if (is_numeric($this->gponid)) {
            $this->gponnaprelacionado = Gpon::find($this->gponid);
            $this->reset('napid');
        } else {
            $this->reset('napid');
        }
    }
    public function tarjetagponrelacion()
    {
        if (is_numeric($this->tarjetaid)) {
            $this->tarjetagponrelacionado = Tarjeta::find($this->tarjetaid);
            $this->reset('gponid');
        } else {
            $this->reset('gponid');
        }
    }
    public function olttarjetarelacion()
    {
        if (is_numeric($this->oltid)) {
            $this->olttarjetarelacionado = Olt::find($this->oltid);
            $this->reset('tarjetaid');
        } else {
            $this->reset('tarjetaid');
        }
    }
    public function mount()
    {
        $this->totalcontar = Cliente::count();
        $this->totalplanes = Plan::all();
        $this->totalestados = Estado::all();
        $this->totalantenas = Antena::all();
        $this->totaldatacenters = Datacenter::where('estado_id', "=", '1');
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
        $this->EditarDireccion = $this->EditarCliente->direccion;
        $this->EditarTelefono = $this->EditarCliente->telefono;
        $this->EditarCorreo = $this->EditarCliente->correo;
    }
    public function saveplan()
    {
        $this->validate([
            'NombrePlan' => 'required|min:5|max:50',
            'VelocidadDescarga' => 'required|min:3|max:15',
            'VelocidadSubida' => 'required|min:3|max:15',
            'PrecioPlan' => 'required|numeric',
        ]);
        $estado = 1;
        $NuevoPlan = Plan::create([
            'nombre' => $this->NombrePlan,
            'descarga' => $this->VelocidadDescarga,
            'subida' => $this->VelocidadSubida,
            'precio' => $this->PrecioPlan,
            'estado_id' => $estado,
        ]);

        $this->totalplanes = Plan::all();
        $this->totalcontar = Cliente::count();
        $this->reset(['NombrePlan', 'VelocidadDescarga', 'VelocidadSubida', 'PrecioPlan']);
        $this->emit('cerrarModalCrearPlan');
        $this->emit('alert', 'El Plan se creo satisfactoriamente');
    }
    public function resetearcampos($value)
    {
        if ($value == 'Antena') {
            $this->reset('gponrelacionado', 'clientegpon', 'gponrelacionado', 'datacenterid', 'oltid', 'tarjetaid', 'gponid', 'napid');
        } elseif ($value == 'Fibra') {
            $this->reset('condicionantena', 'mac', 'ip', 'frecuencia', 'antenaid');
        } else {
            $this->reset('condicionantena', 'mac', 'ip', 'frecuencia', 'antenaid');
            $this->reset('gponrelacionado', 'clientegpon', 'gponrelacionado', 'datacenterid', 'oltid', 'tarjetaid', 'gponid', 'napid');
        }
    }
    // AGREGAR SERVICIO POR ANTENA
    public function saveservicioantena()
    {
        $this->validate([
            'tiposervicio' => 'required',
            'condicionantena' => 'required',
            'antenaid' => 'required|numeric',
            'mac' => 'required|size:17',
            'ip' => 'required|ipv4',
            'frecuencia' => 'required|min:4|max:9',
            'estado' => 'required',
            'plannuevo' => 'required',
        ]);
        $nuevoServicio = Servicio::create([
            'tiposervicio' => $this->tiposervicio,
            'condicionAntena' => $this->condicionantena,
            'antena_id' => $this->antenaid,
            'mac' => $this->mac,
            'ip' => $this->ip,
            'frecuencia' => $this->frecuencia,
            'estado_id' => $this->estado,
            'plan_id' => $this->plannuevo,
            'cliente_id' => $this->IDClienteServicio,
        ]);
        $this->emit('cerrarModalCrearServicio');
        $this->emit('alert', 'El Servicio se añadio satisfactoriamente');
    }
    // AGREGAR SERVICIO POR FIBRA
    public function saveserviciofibra()
    {
        $this->validate([
            'tiposervicio' => 'required',
            'napid' => 'required|numeric',
            'clientegpon' => 'required|numeric',
            'estado' => 'required',
            'plannuevo' => 'required',
            'IDClienteServicio' => 'required',
        ]);

        $nuevoServicio = Servicio::create([
            'tiposervicio' => $this->tiposervicio,
            'clientegpon' => $this->clientegpon, // 
            'nap_id' => $this->napid, //
            'estado_id' => $this->estado, //
            'plan_id' => $this->plannuevo, //
            'cliente_id' => $this->IDClienteServicio, //
        ]);
        $this->emit('cerrarModalCrearServicio');
        $this->emit('alert', 'El Servicio se añadio satisfactoriamente');
    }
    public function agregarservicio(Cliente $cliente)
    {
        $this->AgregarServicio = $cliente;
        $this->IDClienteServicio = $this->AgregarServicio->id;
        $this->NombreClienteServicio = $this->AgregarServicio->nombre;
        $this->ApellidoClienteServicio = $this->AgregarServicio->apellido;
        $this->reset('antenaid', 'mac', 'ip', 'frecuencia', 'clientegpon', 'plannuevo');
        $this->reset('tiposervicio', 'datacenterid', 'condicionantena', 'oltid', 'tarjetaid', 'gponid', 'napid');
        $this->estado = '1';
    }
    public function verservicioantena(Cliente $cliente)
    {
        $this->VerServicio = $cliente;
        $this->IDClienteServicio = $this->VerServicio->id;
        $this->NombreClienteServicio = $this->VerServicio->nombre;
        $this->ApellidoClienteServicio = $this->VerServicio->apellido;
        $this->tiposervicio = $this->VerServicio->servicio->tiposervicio;
        // DE ANTENA
        $this->condicionAntena = $this->VerServicio->servicio->condicionAntena;
        $this->mac = $this->VerServicio->servicio->mac;
        $this->ip = $this->VerServicio->servicio->ip;
        $this->frecuencia = $this->VerServicio->servicio->frecuencia;
        $this->antenaid = $this->VerServicio->servicio->antena->nombre;
        //FIN
        $this->planid = $this->VerServicio->servicio->plan->nombre;
        $this->estado_id = $this->VerServicio->servicio->estado->nombre;
    }
    public function verserviciofibra(Cliente $cliente)
    {
        $this->VerServicio = $cliente;
        $this->IDClienteServicio = $this->VerServicio->id;
        $this->NombreClienteServicio = $this->VerServicio->nombre;
        $this->ApellidoClienteServicio = $this->VerServicio->apellido;
        $this->tiposervicio = $this->VerServicio->servicio->tiposervicio;
        // DE FIBRA
        $this->clientegpon = $this->VerServicio->servicio->clientegpon;
        $this->nap_id = $this->VerServicio->servicio->nap->nombre;
        $this->gponid = $this->VerServicio->servicio->nap->gpon->nombre;
        $this->tarjetaid = $this->VerServicio->servicio->nap->gpon->tarjeta->nombre;
        $this->oltid = $this->VerServicio->servicio->nap->gpon->tarjeta->olt->nombre;
        $this->datacenterid = $this->VerServicio->servicio->nap->gpon->tarjeta->olt->datacenter->nombre;
        //FIN
        $this->planid = $this->VerServicio->servicio->plan->nombre;
        $this->estado_id = $this->VerServicio->servicio->estado->nombre;
    }
    public function update()
    {
        $this->validate([
            'EditarNombre' => 'required|min:5|max:50',
            'EditarApellido' => 'required|min:5|max:50',
            'EditarDNI' => 'required|size:8',
            'EditarDireccion' => 'required|min:3|max:50',
            'EditarTelefono' => 'required|min:7|max:20',
            'EditarCorreo' => 'nullable|email|min:3|max:30',
        ]);
        if ($this->EditarID) {
            $updAntena = Cliente::find($this->EditarID);
            $updAntena->update([
                'nombre' => $this->EditarNombre,
                'apellido' => $this->EditarApellido,
                'dni' => $this->EditarDNI,
                'direccion' => $this->EditarDireccion,
                'telefono' => $this->EditarTelefono,
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
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
        ]);

        $this->totalcontar = Cliente::count();
        $this->reset(['nombre', 'apellido', 'dni', 'correo', 'direccion', 'telefono']);
        $this->emit('cerrarModalCrear');
        $this->emit('alert', 'El cliente se creo satisfactoriamente');
    }
    public function generarolts()
    {
        if (isset($this->datacenteride)) {
            $this->datacenterid = $this->datacenteride;
        }
        if (is_numeric($this->datacenterid)) {
            $this->datacenterselect = Datacenter::find($this->datacenterid);
            $this->reset('tarjetaid', 'oltid', 'olttarjetarelacionado', 'tarjetagponrelacionado');
        } else {
            $this->reset('oltid', 'tarjetaid', 'datacenterid', 'olttarjetarelacionado', 'tarjetagponrelacionado');
        }
    }
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
}
