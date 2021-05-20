@extends('layouts.app')

@section('content')

<form method='POST' action="{{ route('update',$kanri->id) }}" enctype="multipart/form-data">
@csrf
    <div class="yohaku">

        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input value="出勤" type="radio" class="btn-check" name="info" id="btnradio1" autocomplete="off" checked="checked">
            <label class="btn btn-outline-primary" for="btnradio1">出勤</label>

            <input value="退勤" type="radio" class="btn-check" name="info" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">退勤</label>

            <input value="不在" type="radio" class="btn-check" name="info" id="btnradio3" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio3">不在</label>
        </div>

        <div class="form-bikou">
            <label for="bikou">備考</label><br>
            <input type = "text" name="bikou">
        </div>

        <div class="form-submit">
            <button type="submit">編集</button>
        </div>
    </div>
</form>

@endsection

