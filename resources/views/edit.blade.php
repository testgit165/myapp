@extends('layouts.app')

@section('content')

    @if(session('flash_message'))
        <div class="flash_message">
            {{ session('flash_message') }}
        </div>
    @endif

<form method='POST' action="{{ route('update',$kanri->id) }}" enctype="multipart/form-data">
@csrf
    <div class="yohaku">
            退勤処理を行います。よろしいですか？<br>
            <input id="taikin" name="info" type="radio" value="退勤"><label for="taikin">確認</label>

        <div class="form-submit">
            <button type="submit">勤怠提出</button>
        </div>  
    </div>
</form>

@endsection