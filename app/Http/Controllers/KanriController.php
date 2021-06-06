<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kanri;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;

class KanriController extends Controller
{
    public function index(Request $request){    
        $kanris = Kanri::sortable()->paginate(10);
        return view('index', compact('kanris')); 
    }

    public function create()
    {
        if(Kanri::where('user_id', Auth::id())->whereDate('created_at',Carbon::today())->doesntExist()){
            $infos = Kanri::$infos;
            return view('create', compact('infos'));
        }else{
            return redirect('/')->with('flash_message', '本日の勤怠は提出済です！');
        }        
    }

    public function store(Request $request)
    {
        $kanri = new Kanri();
        $kanri->bikou = $request->bikou;
        $kanri->user_id = auth()->user()->id;
        $kanri->info = $request->info;
        $request->session()->regenerateToken();
        $kanri->save();
        return redirect('/');
    }

    public function edit($id)
    {
        $kanri = Kanri::find($id);
        if($kanri->user_id == Auth::id()){
            return view('edit', compact('kanri'));
        }else{
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        $kanri = Kanri::find($id);
        if($kanri->user_id == Auth::id()){
            $kanri->info = $request->info;
            if($request->info == null){
                return redirect(route('edit',['id'=>$id,]))->with('flash_message', '確認にチェックを入れてください！');
            }else{
                $kanri->save();
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    public function show(Request $request, $id)
    {
        $kanris = Kanri::where('user_id', $id)->sortable()->paginate(10);
        if($id == Auth::id()){
            return view('show', compact('kanris'));
        }else{
            return redirect('/');
        }
    }

}

//予備 $kanris = Kanri::sortable('user_id', $id)->paginate(10);



