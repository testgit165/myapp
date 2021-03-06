@extends('layouts.app')

@section('content')

    <div class = "yohaku">
        {{Auth::user()->name}}さんの勤怠一覧ページです<br><br><br>
        <table class = "table">
            <tr>
                <th class = "clom-color">ステータス</th>
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
                    <td><font color = "lightgreen">{{ $kanri -> info }}</font></td>
                @elseif($kanri -> info == "退勤")
                    <td><font color = "red">{{ $kanri -> info }}</font></td>
                @else
                    <td>{{ $kanri -> info }}</td>
                @endif

                @if($kanri -> info == "不在")
                    <td>---</td>
                @else
                    <td>{{ $kanri -> created_at }}</td>
                @endif

                @if($kanri -> info == "不在")
                    <td>---</td>
                @elseif($kanri -> created_at == $kanri -> updated_at)
                    <td>未提出</td>
                @else
                    <td>{{ $kanri -> updated_at }}</td>
                @endif
                <td>{{ $kanri -> bikou }}</td>
        
        @if( Auth::id() == $kanri->user_id)
                <td>
                    <div class = "button">
                        @if($kanri -> created_at < $kanri -> updated_at || $kanri -> info == "不在")
                            
                        @else
                            <a href = "/kanris/edit/{{$kanri->id}}" class = "btn btn-primary btn-sm">退勤</a>
                        @endunless

                    </div>
                </td>
            </tr>
        @else
        <td></td>
        @endif
        </table>

        @endforeach         
        {{ $kanris->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
@endsection

