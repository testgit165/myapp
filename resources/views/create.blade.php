@extends('layouts.app')

@section('content')

<form method='POST' action="{{ route('store') }}" enctype="multipart/form-data">
@csrf
    <div class="form">
        <div class="form-bikou">
            <label for="bikou">備考</label> 
            <input type = "text" name="bikou">
        </div>
            <label>
            <input name="info" type="radio" value="出勤" checked="checked">出勤
            </label>

            <label>
            <input name="info" type="radio" value="退勤">退勤
            </label>

            <label>
            <input name="info" type="radio" value="不在">不在
            </label>

        <div class="form-submit">
            <button type="submit">勤怠提出</button>
        </div>
    </div>
</form>

@endsection

