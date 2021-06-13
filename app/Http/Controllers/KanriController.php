<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kanri;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class KanriController extends Controller
{
    public function index(Request $request)
    {   
        if(($request->info || $request->name || $request->created_at || $request->updated_at || $request->bikou) == null){
            $kanris = Kanri::orderBy('created_at', 'desc')->paginate(10); 
        }else{

            $validator = $request->validate([       
                'created_at' => 'regex:/^[0-9]+$/ | nullable',
                'updated_at' => 'regex:/^[0-9]+$/ | nullable',
            ]);

            $query = Kanri::query();
            
            if(!empty($request->info)){
                $query->where('info', $request->info);
            }
            
            if(!empty($request->name)){
                $query->where('user_id', $request->name);
            }
    
            if(!empty($request->created_at)){
                $query->where('created_at', 'like', '%' . $request->created_at . '%');
            }

            if(!empty($request->updated_at)){
                $query->where('updated_at', 'like', '%' . $request->updated_at . '%');
            }

            if(!empty($request->bikou)){
                $query->where('bikou', 'like', '%' . $request->bikou . '%');
            }
            $kanris = $query->orderBy('id', 'desc')->paginate(10);
        }
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
        $kanris = Kanri::orderBy('created_at', 'desc')->paginate(10);
        if($id == Auth::id()){
            return view('show', compact('kanris'));
        }else{
            return redirect('/');
        }
    }

    public function search()
    {
        return view('search');
    }

}



