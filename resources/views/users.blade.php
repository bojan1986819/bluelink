@extends('layouts.app')
@section('navbar-elements')
    <a class="btn btn-primary" href="{{ route('home') }}" style="margin:8px 0 0 200px;">Close</a>
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
        <article class="userlist">
            <div class="col-md-8">
                <header><h3>Manage Users</h3></header>
                {{ $users->links() }}
                <table class="tg">
                    <col width="200">
                    <col width="200">
                    <col width="80">
                    <tr>
                        <th class="tg-yw4l">Name</th>
                        <th class="tg-yw4l">Email</th>
                        <th class="tg-yw4l">Admin</th>
                        <th class="tg-yw4l">Buttons</th>
                    </tr>
                    @foreach($users as $user)
                        <article class="userrows">

                            <tr>
                                <td><div data-userid="{{ $user->id }}">{{ $user->name }}</div></td>
                                <td>{{ $user->email }}</td>
                                <td align="center">
                                    @if ($user->admin  == 1)
                                        yes
                                    @else
                                        no
                                    @endif
                                </td>
                                <td>
                                    <div class="buttonrow">
                                        <a href="{{ route('deleteuser', ['user_id' => $user->id]) }}" class="btn btn-primary">Remove</a> |
                                        <a href="{{ route('userteam', ['user_id' => $user->id]) }}" class="btn btn-primary"
                                           id="editbtn">Edit Teams</a>|
                                        <a href="{{ route('userpayroll', ['user_id' => $user->id]) }}" class="btn
                                        btn-primary"
                                           id="editbtn">Edit Payrolls</a>
                                    </div>
                                </td>
                            </tr>

                        </article>
                    @endforeach
                </table>

                {{ $users->links() }}
                <div class="interaction">
                    <a href="{{ route('adduser') }}" class="btn btn-primary">Add User</a>
                </div>
            </div>
        </article>



    </div>
@endsection
