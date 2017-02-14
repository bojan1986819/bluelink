@extends('layouts.app')
@section('navbar-elements')
    <a class="btn btn-primary" href="{{ route('users') }}" style="margin:8px 0 0 200px;">Close</a>
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
        <article class="teamlist">
            <div class="col-md-8">
                <header><h3>Add Team for {{ $user->name }}</h3></header>
                {{ $teams->links() }}
                <table class="tg">
                    <col width="200">
                    <col width="200">
                    <col width="80">
                    <tr>
                        <th class="tg-yw4l">Team</th>
                        <th class="tg-yw4l">Buttons</th>
                    </tr>
                    @foreach($teams as $team)
                        <article class="userrows">

                            <tr>
                                <td><div data-teamid="{{ $team->id }}">{{ $team->team }}</div></td>
                                <td>
                                    <div class="buttonrow">
                                        <a href="{{route('deleteteam', ['team_id' => $team->id])}}" class="btn
                                        btn-primary">Remove</a>
                                    </div>
                                </td>
                            </tr>

                        </article>
                    @endforeach
                </table>

                {{ $teams->links() }}
                <div class="interaction">
                    <a href="#" class="btn btn-primary" id="addteam">Add Team</a>
                </div>
            </div>
        </article>


        @include('modals.new-team')
<script>
    $('#addteam').on('click', function () {

        $('#newTeamModal').modal();
    });
</script>
    </div>
@endsection
