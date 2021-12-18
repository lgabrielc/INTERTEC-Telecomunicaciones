<?php

namespace App\Http\Livewire\Admin\Cliente;

use App\Models\Antena;
use App\Models\Cliente;
use App\Models\Centrodato;
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
    public $totalcontar, $totalplanes, $totalestados, $totaldatacenters, $oltnombre, $tarjetanombre, $napnombre, $gponnombre;
    public $clienteid, $nombre, $apellido, $dni, $direccion, $telefono, $correo, $tiposervicio, $planusado;
    public $datacenterid, $oltid, $tarjetaid, $gponid, $napid, $gponrelacionado, $datacenterselect, $olttarjetarelacionado, $tarjetagponrelacionado, $gponnaprelacionado;
    public $condicionantena, $clientegpon, $clientegpon2, $mac, $ip, $plan, $frecuencia, $antenaid, $antena, $checkbx, $servicioid, $EditarID, $planid;
    public $descarga, $subida, $precio, $estado, $disabled2 = 1;
    public $sort = 'id', $search = '', $direction = 'desc', $cant = '5', $isDisabled = 'disabled';
    public $vermodalcrearcliente = false, $vermodaleditar = false, $vermodalcrearplan = false, $vermodaleditarcliente = false, $vermodalcrearservicio = false,
        $vermodalantena = false, $vermodalfibra = false, $vermodalmigrarantena = false, $vermodalmigrarfibras = false, $vermodalmigracion = false, $vermodaleditarplan = false, $vermodaleditarservicio = false;
    public $fechainicio, $fechavencimiento, $fechacorte;
    public function mount()
    {
        $this->totalcontar = Cliente::count();
        $this->totalcontarservicios = Servicio::count();
        $this->totalplanes = Plan::where('estado_id', "=", '1')->get();
        $this->totaldeplanes = Plan::all();
        $this->totalestados = Estado::where('nombre', "=", 'Activo')->orwhere('nombre', "=", 'Deshabilitado')->get();
        $this->totalantenas = Antena::where('estado_id', "=", '1')->get();
        $this->totaldatacenters = Centrodato::where('estado_id', "=", '1')->get();
    }
    public function disablear()
    {
        if ($this->isDisabled == 'enabled') {
            //sin editar
            $this->isDisabled = 'disabled';
            $this->disabled2 = 1;
        } else {
            //Quiero editar
            $this->isDisabled = 'enabled';
            $this->disabled2 = 0;
        }
    }
    public function activarmodalcrearcliente()
    {
        $this->reset(['nombre', 'apellido', 'dni', 'direccion', 'telefono', 'estado', 'correo']);
        $this->vermodalcrearcliente = true;
    }
    public function activarmodalcrearplan()
    {
        $this->reset(['nombre', 'descarga', 'subida', 'precio', 'estado']);
        $this->estado = '1';
        $this->vermodalcrearplan = true;
    }
    public function activarmodaleditarplan()
    {
        $this->reset('isDisabled', 'planid', 'nombre', 'descarga', 'subida', 'precio', 'estado', 'planusado');
        $this->vermodaleditarplan = true;
        $this->plan = "";
        $this->isDisabled = 'disabled';
        $this->disabled2 = 1;
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:5|max:50',
            'apellido' => 'required|min:3|max:50',
            'dni' => 'required|size:8',
            'direccion' => 'required|min:3|max:60',
            'telefono' => 'required|min:7|max:29',
            'correo' => 'nullable|email|min:3|max:30',
        ]);
        Cliente::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'dni' => $this->dni,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
        ]);
        $this->totalcontar = Cliente::count();
        $this->vermodalcrearcliente = false;
        $this->emit('alert', 'El cliente se creo satisfactoriamente');
    }
    public function cambiartipodeservicio()
    {
        if ($this->tiposervicio == 'Antena') {
            $this->reset('gponrelacionado', 'clientegpon', 'gponrelacionado', 'datacenterid', 'oltid', 'tarjetaid', 'gponid', 'napid');
        } else {
            $this->reset('condicionantena', 'mac', 'ip', 'frecuencia', 'antenaid', 'plan');
        }
    }
    public function gponnaprelacion()
    {
        if (is_numeric($this->gponid)) {
            $this->gponnaprelacionado = Gpon::find($this->gponid);
            $this->napid = "";
        } else {
            $this->reset('napid');
        }
    }
    public function tarjetagponrelacion()
    {
        if (is_numeric($this->tarjetaid)) {
            $this->tarjetagponrelacionado = Tarjeta::find($this->tarjetaid);
            $this->gponid = "";
        } else {
            $this->reset('gponid');
        }
    }
    public function olttarjetarelacion()
    {
        if (is_numeric($this->oltid)) {
            $this->olttarjetarelacionado = Olt::find($this->oltid);
            $this->tarjetaid = "";
        } else {
            $this->reset('tarjetaid');
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
    public function changedatavencimiento()
    {
        $this->fechacorte = date("Y-m-d", strtotime($this->fechavencimiento . "+ 3 days"));
    }
    public function activarmodalcrearservicio(Cliente $cliente)
    {
        $this->vermodalfibra = false;
        $this->reset('gponrelacionado', 'clientegpon', 'gponrelacionado', 'datacenterid', 'oltid', 'tarjetaid', 'gponid', 'napid');
        $this->reset('condicionantena', 'mac', 'ip', 'frecuencia', 'antenaid');
        $this->fechainicio = date('Y-m-d');
        $this->fechavencimiento = date('Y-m-d');
        $this->fechacorte = date("Y-m-d", strtotime($this->fechavencimiento . "+ 3 days"));
        $this->tiposervicio = "";
        $this->condicionantena = "";
        $this->plan = "";
        $this->estado = '1';
        $this->vermodalcrearservicio = true;
        $this->AgregarServicio = $cliente;
        $this->clienteid = $this->AgregarServicio->id;
        $this->nombre = $this->AgregarServicio->nombre;
        $this->apellido = $this->AgregarServicio->apellido;
    }
    public function edit(Cliente $cliente)
    {
        $this->reset(['nombre', 'apellido', 'dni', 'direccion', 'telefono', 'estado']);
        $this->vermodaleditarcliente = true;
        $this->EditarCliente = $cliente;
        $this->EditarID = $this->EditarCliente->id;
        $this->nombre = $this->EditarCliente->nombre;
        $this->apellido = $this->EditarCliente->apellido;
        $this->dni = $this->EditarCliente->dni;
        $this->direccion = $this->EditarCliente->direccion;
        $this->telefono = $this->EditarCliente->telefono;
        $this->correo = $this->EditarCliente->correo;
    }
    public function saveplan()
    {
        $this->precio=number_format($this->precio,2);
        $this->validate([
            'nombre' => 'required|min:5|max:50',
            'descarga' => 'required|min:3|max:15',
            'subida' => 'required|min:3|max:15',
            'precio' => 'required|numeric',
        ]);
        Plan::create([
            'nombre' => $this->nombre,
            'descarga' => $this->descarga,
            'subida' => $this->subida,
            'precio' => $this->precio,
            'estado_id' => $this->estado,
        ]);
        $this->totalplanes = Plan::where('estado_id', "=", '1')->get();
        $this->reset(['nombre', 'descarga', 'subida', 'precio', 'estado']);
        $this->vermodalcrearplan = false;
        $this->emit('alert', 'El Plan se creo satisfactoriamente');
    }
    public function updateplan()
    {
        $this->precio=number_format($this->precio,2);
        $this->validate([
            'plan' => 'required|numeric',
            'descarga' => 'required|min:3|max:15',
            'nombre' => 'required|min:3|max:30',
            'subida' => 'required|min:3|max:15',
            'precio' => 'required|numeric',
            'estado' => 'required|numeric'
        ]);
        if ($this->plan) {
            $updAntena = Plan::find($this->plan);
            $updAntena->update([
                'nombre' => $this->nombre,
                'descarga' => $this->descarga,
                'subida' => $this->subida,
                'precio' => $this->precio,
                'estado_id' => $this->estado,
            ]);
        }
        $this->vermodaleditarplan = false;
        $this->reset(['plan', 'descarga', 'subida', 'precio', 'estado', 'nombre']);
        $this->emit('alert', 'El Plan se actualizo satisfactoriamente');
    }
    public function changeplanselect()
    {
        if ($this->plan && is_numeric($this->plan)) {
            $this->planid = Plan::find($this->plan);
            $this->nombre = $this->planid->nombre;
            $this->descarga = $this->planid->descarga;
            $this->subida = $this->planid->subida;
            $this->precio = $this->planid->precio;
            $this->estado = $this->planid->estado->id;
            $this->isDisabled = 'enabled';
            $this->disabled2 = 0;
            $this->planusado = Servicio::where('plan_id', $this->plan)->count();
        } elseif ($this->plan == '') {
            $this->reset(['descarga', 'subida', 'precio', 'estado', 'nombre', 'planusado', 'planid']);
            $this->isDisabled = 'disabled';
            $this->disabled2 = 1;
        }
    }
    public function saveservicioantena()
    {
        $this->validate(
            [
                'fechainicio' => 'required|date',
                'fechavencimiento' => 'required|date',
                'fechacorte' => 'required|date',
                'tiposervicio' => 'required',
                'condicionantena' => 'required',
                'antenaid' => 'required|numeric',
                'mac' => 'required|size:17',
                'ip' => 'required|ipv4',
                'frecuencia' => 'required|min:4|max:9',
                'plan' => 'required|numeric',
                'estado' => 'required|numeric'
            ],
            [
                'condicionantena.required' => 'Por favor seleccione una opcion',
                'antenaid.required' => 'Por favor seleccione una opcion',
                'mac.required' => 'El campo Mac es obligatorio',
                'ip.required' => 'El campo IP es obligatorio',
                'frecuencia.required' => 'El campo Frecuencia es obligatorio',
                'plan.required' => 'El campo Plan es obligatorio',
                'estado.required' => 'El estado es necesario',
            ]
        );
        Servicio::create([
            'fechainicio' => $this->fechainicio,
            'fechavencimiento' => $this->fechavencimiento,
            'fechacorte' => $this->fechacorte,
            'tiposervicio' => $this->tiposervicio,
            'condicionAntena' => $this->condicionantena,
            'antena_id' => $this->antenaid,
            'mac' => $this->mac,
            'ip' => $this->ip,
            'frecuencia' => $this->frecuencia,
            'estado_id' => $this->estado,
            'plan_id' => $this->plan,
            'cliente_id' => $this->clienteid,
        ]);
        $this->totalcontarservicios = Servicio::count();

        $this->vermodalcrearservicio = false;
        $this->reset(['tiposervicio', 'condicionantena', 'antenaid', 'mac', 'ip', 'frecuencia', 'estado', 'plan']);
        $this->emit('alert', 'El Servicio ha sido actualizado con éxito satisfactoriamente');
    }
    // AGREGAR SERVICIO POR FIBRA
    public function saveserviciofibra()
    {
        $this->validate(
            [
                'fechainicio' => 'required|date',
                'fechavencimiento' => 'required|date',
                'fechacorte' => 'required|date',
                'datacenterid' => 'required|numeric',
                'oltid' => 'required|numeric',
                'tarjetaid' => 'required|numeric',
                'gponid' => 'required|numeric',
                'napid' => 'required|numeric',
                'tiposervicio' => 'required',
                'clientegpon' => 'required|numeric|unique:servicios',
                'plan' => 'required|numeric',
                'estado' => 'required|numeric',
                'clienteid' => 'required|numeric'
            ],
            [
                'datacenterid.required' => 'Por favor seleccione una opcion',
                'oltid.required' => 'Por favor seleccione una opcion',
                'tarjetaid.required' => 'Por favor seleccione una opcion',
                'gponid.required' => 'Por favor seleccione una opcion',
                'napid.required' => 'Por favor seleccione una opcion',
                'clientegpon.required' => 'El numero de cliente es obligatorio',
                'clientegpon.numeric' => 'El numero de cliente debe ser numérico',
                'clientegpon.unique' => 'El numero de cliente ya está en uso',
                'plan.required' => 'Por favor seleccione una opcion'
            ]
        );
        if ($this->clienteid) {
            Servicio::create([
                'fechainicio' => $this->fechainicio,
                'fechavencimiento' => $this->fechavencimiento,
                'fechacorte' => $this->fechacorte,
                'tiposervicio' => $this->tiposervicio,
                'clientegpon' => $this->clientegpon,
                'nap_id' => $this->napid,
                'plan_id' => $this->plan,
                'estado_id' => $this->estado,
                'cliente_id' => $this->clienteid,
            ]);
        }
        $this->totalcontarservicios = Servicio::count();
        $this->vermodalcrearservicio = false;
        $this->reset(['tiposervicio', 'napid', 'clientegpon', 'estado', 'plan', 'clienteid']);
        $this->emit('alert', 'El Servicio se actualizo satisfactoriamente');
    }
    public function updateservicioantena()
    {
        $this->validate([
            'tiposervicio' => 'required',
            'condicionantena' => 'required',
            'antena' => 'required|numeric',
            'mac' => 'required|size:17',
            'ip' => 'required|ipv4',
            'frecuencia' => 'required|min:4|max:9',
            'plan' => 'required|numeric',
            'estado' => 'required|numeric',
            'clienteid' => 'required|numeric'
        ]);
        if ($this->servicioid) {
            $updAntena = Servicio::find($this->servicioid);
            $updAntena->update([
                'tiposervicio' => $this->tiposervicio,
                'condicionAntena' => $this->condicionantena,
                'antena_id' => $this->antena,
                'mac' => $this->mac,
                'ip' => $this->ip,
                'frecuencia' => $this->frecuencia,
                'estado_id' => $this->estado,
                'plan_id' => $this->plan,
                'cliente_id' => $this->clienteid,
            ]);
        }
        $this->vermodalantena = false;
        $this->emit('alert', 'El Servicio se actualizó satisfactoriamente');
    }
    public function updateserviciofibra()
    {
        if ($this->clientegpon != $this->clientegpon2) {
            $this->validate(
                [
                    'clientegpon' => 'required|numeric|unique:servicios',
                ],
                [
                    'clientegpon.required' => 'El numero de cliente es obligatorio',
                    'clientegpon.numeric' => 'El numero de cliente debe ser numérico',
                    'clientegpon.unique' => 'El numero de cliente ya está en uso',
                ]
            );
        }
        $this->validate(
            [
                'datacenterid' => 'required|numeric',
                'oltid' => 'required|numeric',
                'tarjetaid' => 'required|numeric',
                'gponid' => 'required|numeric',
                'tiposervicio' => 'required',
                'clientegpon' => 'required|numeric',
                'napid' => 'required|numeric',
                'planid' => 'required|numeric',
                'estado' => 'required|numeric',
                'clienteid' => 'required|numeric'
            ],
            [
                'datacenterid.required' => 'Por favor seleccione una opcion',
                'oltid.required' => 'Por favor seleccione una opcion',
                'tarjetaid.required' => 'Por favor seleccione una opcion',
                'gponid.required' => 'Por favor seleccione una opcion',
                'napid.required' => 'Por favor seleccione una opcion',
                'clientegpon.required' => 'El numero de cliente es obligatorio',
                'plan.required' => 'Por favor seleccione una opcion'
            ]
        );
        if ($this->servicioid) {
            $updfibra = Servicio::find($this->servicioid);
            $updfibra->update([
                'tiposervicio' => $this->tiposervicio,
                'clientegpon' => $this->clientegpon,
                'nap_id' => $this->napid,
                'plan_id' => $this->planid,
                'estado_id' => $this->estado,
                'cliente_id' => $this->clienteid,
            ]);
        }
        $this->vermodalfibra = false;
        $this->emit('alert', 'El Servicio se actualizó satisfactoriamente');
    }
    public function verservicioantena(Cliente $cliente)
    {
        $this->isDisabled = 'disabled';
        $this->disabled2 = 1;
        $this->reset(['checkbx', 'tiposervicio', 'condicionantena', 'antenaid', 'mac', 'ip', 'frecuencia', 'estado', 'plan']);
        $this->vermodalantena = true;
        $this->VerServicio = $cliente;
        $this->clienteid = $cliente->id;
        $this->servicioid = $this->VerServicio->servicio->id;
        $this->nombre = $this->VerServicio->nombre;
        $this->apellido = $this->VerServicio->apellido;
        $this->tiposervicio = $this->VerServicio->servicio->tiposervicio;
        // DE ANTENA
        $this->condicionantena = $this->VerServicio->servicio->condicionAntena;
        $this->mac = $this->VerServicio->servicio->mac;
        $this->ip = $this->VerServicio->servicio->ip;
        $this->frecuencia = $this->VerServicio->servicio->frecuencia;
        $this->antena = $this->VerServicio->servicio->antena_id;
        //FIN
        $this->plan = $this->VerServicio->servicio->plan_id;
        $this->estado = $this->VerServicio->servicio->estado_id;
    }
    public function verserviciofibra(Cliente $cliente)
    {
        $this->reset('datacenterselect', 'olttarjetarelacionado', 'checkbx', 'isDisabled', 'disabled2', 'tarjetagponrelacionado', 'gponnaprelacionado');
        $this->vermodalcrearservicio = false;
        $this->vermodalfibra = true;
        $this->VerServicio = $cliente;
        $this->clienteid = $this->VerServicio->id;
        $this->servicioid = $this->VerServicio->servicio->id;
        $this->nombre = $this->VerServicio->nombre;
        $this->apellido = $this->VerServicio->apellido;
        $this->tiposervicio = $this->VerServicio->servicio->tiposervicio;
        $this->datacenterid = $this->VerServicio->servicio->nap->gpon->tarjeta->olt->centrodato->id;
        $this->oltnombre = $this->VerServicio->servicio->nap->gpon->tarjeta->olt->nombre;
        $this->oltid = $this->VerServicio->servicio->nap->gpon->tarjeta->olt->id;
        $this->tarjetanombre = $this->VerServicio->servicio->nap->gpon->tarjeta->nombre;
        $this->tarjetaid = $this->VerServicio->servicio->nap->gpon->tarjeta->id;
        $this->gponnombre = $this->VerServicio->servicio->nap->gpon->nombre;
        $this->gponid = $this->VerServicio->servicio->nap->gpon->id;
        $this->napnombre = $this->VerServicio->servicio->nap->nombre;
        $this->napid = $this->VerServicio->servicio->nap->id;
        // DE FIBRA
        $this->clientegpon = $this->VerServicio->servicio->clientegpon;
        $this->clientegpon2 = $this->VerServicio->servicio->clientegpon;
        //FIN
        $this->planid = $this->VerServicio->servicio->plan->id;
        $this->estado = $this->VerServicio->servicio->estado->id;
    }
    public function migracionantena(Cliente $cliente)
    {
        $this->vermodalmigrarantena = true;
        $this->client = $cliente;
        $this->clienteid = $this->client->id;
        $this->servicioid = $this->client->servicio->id;
    }
    public function migracionfibra(Cliente $cliente)
    {
        $this->vermodalmigrarfibra = true;
        $this->client = $cliente;
        $this->clienteid = $this->client->id;
        $this->servicioid = $this->client->servicio->id;
    }
    public function vermigracion(Cliente $cliente)
    {
        $this->reset(
            'tarjetaid',
            'telefono',
            'tarjetanombre',
            'oltnombre',
            'oltid',
            'napnombre',
            'napid',
            'gponnombre',
            'gponid',
            'dni',
            'direccion',
            'correo',
            'clientegpon2',
            'clientegpon',
            'EditarID',
            'antena',
            'frecuencia',
            'ip',
            'mac',
            'clientegpon',
            'datacenterid',
            'datacenterselect',
            'olttarjetarelacionado',
            'tarjetagponrelacionado',
            'gponnaprelacionado',
            'vermodalfibra',
            'vermodalantena'
        );
        $this->vermodalmigracion = true;
        $this->condicionantena = "";
        $this->antenaid = "";
        $this->client = $cliente;
        $this->clienteid = $this->client->id;
        $this->servicioid = $this->client->servicio->id;
        $this->nombre = $this->client->nombre;
        $this->apellido = $this->client->apellido;
        $this->estado = $this->client->servicio->estado->id;
        $this->plan = $this->client->servicio->plan->id;
        $this->tiposervicio = $this->client->servicio->tiposervicio;
        if ($this->tiposervicio == 'Antena') {
            $this->tiposervicio = 'Fibra';
        } else {
            $this->tiposervicio = 'Antena';
        }
    }
    public function savemigrarfibra()
    {
        $this->reset('condicionantena', 'mac', 'ip', 'frecuencia', 'antena');
        $this->validate(
            [
                'datacenterid' => 'required|numeric',
                'oltid' => 'required|numeric',
                'tarjetaid' => 'required|numeric',
                'gponid' => 'required|numeric',
                'napid' => 'required|numeric',
                'tiposervicio' => 'required',
                'clientegpon' => 'required|numeric|unique:servicios',
                'plan' => 'required|numeric',
                'estado' => 'required|numeric',
                'clienteid' => 'required|numeric',
                'condicionantena' => 'nullable',
                'mac' => 'nullable',
                'ip' => 'nullable',
                'frecuencia' => 'nullable',
                'antena' => 'nullable'
            ],
            [
                'datacenterid.required' => 'Por favor seleccione una opcion',
                'oltid.required' => 'Por favor seleccione una opcion',
                'tarjetaid.required' => 'Por favor seleccione una opcion',
                'gponid.required' => 'Por favor seleccione una opcion',
                'napid.required' => 'Por favor seleccione una opcion',
                'clientegpon.required' => 'El numero de cliente es obligatorio',
                'clientegpon.numeric' => 'El numero de cliente debe ser numérico',
                'clientegpon.unique' => 'El numero de cliente ya está en uso',
                'plan.required' => 'Por favor seleccione una opcion'
            ]
        );
        if ($this->servicioid) {
            $updfibra = Servicio::find($this->servicioid);
            $updfibra->update([
                'condicionAntena' => $this->condicionantena,
                'mac' => $this->mac,
                'ip' => $this->ip,
                'frecuencia' => $this->frecuencia,
                'antena_id' => $this->antena,
                'tiposervicio' => $this->tiposervicio,
                'clientegpon' => $this->clientegpon,
                'nap_id' => $this->napid,
                'plan_id' => $this->plan,
                'estado_id' => $this->estado,
                'cliente_id' => $this->clienteid,
            ]);
        }
        $this->vermodalmigracion = false;
        $this->emit('alert', 'El Servicio ha migrado satisfactoriamente');
    }
    public function savemigrarantena()
    {
        $this->reset('clientegpon', 'napid');
        $this->validate([
            'tiposervicio' => 'required',
            'condicionantena' => 'required',
            'antenaid' => 'required|numeric',
            'mac' => 'required|size:17',
            'ip' => 'required|ipv4',
            'frecuencia' => 'required|min:4|max:9',
            'plan' => 'required|numeric',
            'estado' => 'required|numeric',
            'clienteid' => 'required|numeric',
            'clientegpon' => 'nullable',
            'napid' => 'nullable'
        ]);
        if ($this->servicioid) {
            $updAntena = Servicio::find($this->servicioid);
            $updAntena->update([
                'tiposervicio' => $this->tiposervicio,
                'condicionAntena' => $this->condicionantena,
                'antena_id' => $this->antenaid,
                'mac' => $this->mac,
                'ip' => $this->ip,
                'frecuencia' => $this->frecuencia,
                'estado_id' => $this->estado,
                'plan_id' => $this->plan,
                'cliente_id' => $this->clienteid,
                'clientegpon' => $this->clientegpon,
                'nap_id' => $this->napid
            ]);
        }
        $this->vermodalmigracion = false;
        $this->emit('alert', 'El Servicio ha migrado satisfactoriamente');
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:5|max:50',
            'apellido' => 'required|min:3|max:50',
            'dni' => 'required|size:8',
            'direccion' => 'required|min:3|max:60',
            'telefono' => 'required|min:7|max:29',
            'correo' => 'nullable|email|min:3|max:30',
        ]);
        if ($this->EditarID) {
            $updAntena = Cliente::find($this->EditarID);
            $updAntena->update([
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'dni' => $this->dni,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'correo' => $this->correo,
            ]);
        }
        $this->vermodaleditarcliente = false;
        $this->reset(['nombre', 'apellido', 'dni', 'direccion', 'telefono', 'estado']);
        $this->emit('alert', 'El Cliente se actualizo satisfactoriamente');
    }

    public function generarolts()
    {
        if (is_numeric($this->datacenterid)) {
            $this->datacenterselect = Centrodato::find($this->datacenterid);
            $this->reset('tarjetaid', 'olttarjetarelacionado', 'tarjetagponrelacionado');
            $this->oltid = "";
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
