@extends('layouts.app')

@section('content')

<a href = " {{ action('App\Http\Controllers\KanriController@create') }} " class="btn btn-warning">勤怠入力</a><br>

<div class = "yohaku">
<table class = "table">
    <tr>
        <th class = "clom-color">ステータス</th>
        <th class = "clom-color">名前</th>
        <th class = "clom-color">出勤時刻</th>
        <th class = "clom-color">備考</th>
        <th></th>
    </tr>
</table>

@foreach($kanris as $kanri) 

    <table class = "table">
        <tr>
            <td>    {{ $kanri -> info }}</td>
            <td>    {{ $kanri -> user -> name }}</td>
            <td>    {{ $kanri -> created_at }}</td>
            <td>    {{ $kanri -> bikou }}</td>
       
        @if ( Auth::id()  == $kanri->user_id)
            <td>
                <div class = "button">
                    <form method="post" action="{{ route('delete',$kanri->id) }}">
                    @csrf
                    <input type="submit" value="削除">
                    </form>

                    <a href="/kanris/edit/{{$kanri->id}}" class="btn btn-primary btn-sm">編集</a>
                </div>
            </td>
        </tr>
    </table>
    @else
    <td></td>
    @endif
</div>

@endforeach 

@endsection