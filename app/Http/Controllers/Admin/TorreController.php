<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Torre;
use App\Models\Telefono;
use App\Models\Direccion;

use function GuzzleHttp\Promise\all;

class TorreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.admin.torre.index');
    }

}
