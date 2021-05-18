@extends('layouts.app')

@section('content')

<a href = " {{ action('App\Http\Controllers\KanriController@create') }} ">勤怠</a>


@foreach($kanris as $kanri) 
<div class = "index">
    

    <div class = "menu">
        <h3>ステータス</h3>
            {{ $kanri -> info }}<br>
    </div>

    <div class = "menu">
        <h3>氏名</h3>
            {{ $kanri -> user -> name }}<br>
    </div>

    <div class = "menu">
        <div>
            <h3>出勤時刻</h3>
        </div>
            {{ $kanri -> created_at }}<br>
    </div>

    <div class = "menu">
        <div>
            <h3>備考</h3>
        </div>
            {{ $kanri -> bikou }}<br>
    </div>

    <div class = "menu">
        <div>
            <h3>コメント</h3>
        </div>
    </div>

</div>

@endforeach 

@endsection