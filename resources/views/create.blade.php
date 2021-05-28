@extends('layouts.app')

@section('content')

<form method='POST' action="{{ route('store') }}" enctype="multipart/form-data">
@csrf
    <div class="yohaku">

        <input id="syukkin" name="info" type="radio" value="出勤" checked="checked"><label for="syukkin">出勤</label>
        <input id="huzai" name="info" type="radio" value="不在"><label for="huzai">不在</label>

        <div class="form-bikou">
            <label for="bikou">備考</label><br>
            <input type = "text" name="bikou">
        </div>

        <div class="form-submit">
            <button type="submit">勤怠提出</button>
        </div>
    </div>
</form>

@endsection

