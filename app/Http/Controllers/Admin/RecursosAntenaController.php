<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecursosAntenaController extends Controller
{
    public function servidor()
    {
        return view('livewire.admin.recursos-antena.servidor.index');

    }
    public function torre()
    {
        return view('livewire.admin.recursos-antena.torre.index');

    }
    public function antena()
    {
        return view('livewire.admin.recursos-antena.antena.index');

    }
}
