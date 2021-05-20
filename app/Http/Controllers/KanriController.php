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

    public function destroy($id)
    {
        
        $kanri = Kanri::findOrFail($id);
        $kanri->delete();

        return redirect('/');
    }

    public function edit($id)
    {
        $kanri = Kanri::find($id);
        return view('edit', compact('kanri'));
    }

    public function update(Request $request, $id)
    {
        $kanri = Kanri::find($id);
        $kanri->bikou = $request->bikou;
        $kanri->info = $request->info;

        $kanri->save();

        return redirect('/');
    }

}



