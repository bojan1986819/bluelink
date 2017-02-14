@extends('layouts.app')
@section('navbar-elements')
    <a class="btn btn-primary" href="{{ route('mytickets') }}" style="margin:8px 0 0 200px;">Close</a>
@endsection
@section('content')
    @include('includes.message-block')
<style>
    .container{
        width: 100%;
    }
</style>
    <div class="container">
        <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;border-color:#999;}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}
            .tg .tg-yw4l{vertical-align:top}
            .interaction{margin-top:20px;}
        </style>
        <form action="{{ route('postreassign') }}" method="post" style="width: 50%; align-content: center;" id="reassign">
            <div class="form-group {{ $errors->has('ticketid') ? 'has-error' : '' }}">
                <input class="form-control" type="hidden" name="ticketid" id="ticketid" value="{{
                                $ticket->id }}">
            </div>
            <div class="form-group">
                <label>Ticket</label>
                {{$ticket->id}}
            </div>
            <div class="form-group {{ $errors->has('team') ? 'has-error' : '' }}">
                <label for="team">Team</label>
                <select class="form-control" type="team" name="team" id="team" value="{{ Request::old
                                ('team') }}">
                    @foreach($ddteams as $ddteam)
                        <option value="{{$ddteam->team}}">{{$ddteam->team}}</option>
                    @endforeach
                </select>
            </div>
            <a class="btn btn-primay" href="{{ route('mytickets') }}">Cancel</>
            <button type="submit" class="btn btn-primary">Reassign</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>

    <script>
        $("#reassign").on("submit", function(){
            return confirm("Do you want to reassign?");
        });
    </script>
@endsection
