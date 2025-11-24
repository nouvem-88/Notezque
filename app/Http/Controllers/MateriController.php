<?php

namespace App\Http\Controllers;

use App\Models\KontenStatis;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index(){
        $kontenStatis = KontenStatis::pluck('value', 'key');
        return view('pages.materi', compact('kontenStatis'));
    }
}
