@extends('layouts.app')

@section('content')

    @if (session('flash_message'))
        <div class="flash_message">
            {{ session('flash_message') }}
        </div>
    @endif

    <div class = "top_btn">
        <div class = "top_btn_l">
            @if(Auth::user())
                <a href="/kanris/show/{{Auth::id()}}" class="btn btn-primary">提出勤怠一覧</a>
            @endif
        </div>

        <div class = "top_btn_r">    
            <a href = "{{action('App\Http\Controllers\KanriController@create')}}" class="btn btn-warning">勤怠入力</a> 
        </div>
    </div><br>

    <div class = "top_index">
        <div class = "top_left">
            <h3>検索フォーム</h3><br>
            <form method='POST' action="{{ route('index') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-info">
                <label for="info">ステータス</label><br>
                <input id="syukkin" name="info" type="radio" value="出勤"><label for="syukkin">出勤</label>
                <input id="huzai" name="info" type="radio" value="不在"><label for="huzai">不在</label>
                <input id="taikin" name="info" type="radio" value="退勤"><label for="taikin">退勤</label>
            </div>

            <div class="form-name">
                氏名<br>
                <select name="name" style="width:70%">
                    <option></option>
                    @foreach($kanris->unique("user_id") as $kanri) 
                        <option value = "{{$kanri -> user_id}}">{{$kanri -> user -> name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-created_at">
                出勤日時<br>
                <input type = "text" name="created_at" style="width:70%">
            </div>

            <div class="form-updated_at">
                退勤日時<br>
                <input type = "text" name="updated_at" style="width:70%">
            </div>

            <div class="form-bikou">
                備考<br>
                <input type = "text" name="bikou" style="width:70%">
            </div>

            <div class="form-submit">
                <button type="submit">検索</button>
            </div>
            </form>
        </div>

        <div class = "top_right">
            <table class = "table">
                <tr>
                    <th class = "clom-color">ステータス</th>
                    <th class = "clom-color">氏名</th>
                    <th class = "clom-color">出勤日時</th>
                    <th class = "clom-color">退勤日時</th>
                    <th class = "clom-color">備考</th>
                    <th></th>
                </tr>
            </table>

            @foreach($kanris as $kanri) 

            <table class = "table">
            <tr>
                @if($kanri -> info == "出勤")
                    <td><font color="lightgreen">{{$kanri -> info}}</font></td>
                @elseif($kanri -> info == "退勤")
                    <td><font color="red">{{$kanri -> info}}</font></td>
                @else
                    <td>{{$kanri -> info}}</td>
                @endif
                    <td>{{$kanri -> user -> name}}</td>

                @if($kanri -> info == "不在")
                    <td>---</td>
                @else
                    <td>{{$kanri -> created_at}}</td>
                @endif

                @if($kanri-> info == "不在")
                    <td>---</td>
                @elseif($kanri -> created_at == $kanri -> updated_at)
                    <td>未提出</td>
                @else
                    <td>{{$kanri -> updated_at}}</td>
                @endif
                <td>{{$kanri -> bikou}}</td>
        
                @if (Auth::id() == $kanri->user_id)
                <td>
                    <div class = "button">
                        @if($kanri -> created_at < $kanri -> updated_at || $kanri -> info == "不在")
                            
                        @else
                            <a href="/kanris/edit/{{$kanri->id}}" class="btn btn-primary btn-sm">退勤</a>
                        @endunless

                    </div>
                </td>
            </tr>
            @else
            <td></td>
            @endif
            </table>

            @endforeach 
            {{ $kanris->appends(request()->input())->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
