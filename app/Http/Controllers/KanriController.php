<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kanri;
use Illuminate\Support\Facades\Auth;




class KanriController extends Controller
{
    public function index(){
        
        $kanris = Kanri::all();
         return view('index', compact('kanris')); 
    }

    public function create()
    {
        $infos = Kanri::$infos;
        return view('create', compact('infos'));
    }

    public function store(Request $request)
    {
        $kanri = new Kanri();
        $kanri->bikou = $request->bikou;
        $kanri->user_id = auth()->user()->id;
        $kanri->info = $request->info;

        $kanri->save();

        return redirect('/');
    }









}



