<?php

namespace App\Http\Controllers\Admin;

use App\Models\Antena;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AntenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.admin.antena.index');
    }
}
