@extends('layouts.app')

@section('content')
    @include('includes.message-block')
    <style>
        .small-button-box{
            width: 4.3cm;
            height: 2.7cm;
            border: solid 1pt black;
        }

        #all{
            background-color: #a7da4e;
            color: #fff200;
            position: absolute;
            top: 8cm;
            left: 0.6cm;
        }

        #me{
            background-color: #fff200;
            color: black;
            position: absolute;
            top: 8cm;
            left: 6.4cm;
        }

        #team{
            background-color: #cf7b79;
            color: #fff200;
            position: absolute;
            top: 8cm;
            left: 12cm;
        }

        #admin{
            background-color: #00b7ef;
            color: #fff200;
            position: absolute;
            top: 6.2cm;
            left: 18cm;
            width: 12cm;
            height: 2.4cm;
        }
        
        .first-row{
            font: 20px calibri, arial;
            font-weight: bold;
            border-bottom: solid 2pt;
            height: 30px;
            text-align: center;
        }

        .btn-info{
            border-radius: 6px;
            width: 3cm;
            height: 0.8cm;
            font: 12px calibri, arial;
            color: white;
            background-color: #8FB1D5 !important;
        }

        .big{
            width: 6.3cm;
            margin-right: 16px;
        }

        #main-title img{
            width: 25cm;
        }

        #cut-off-warnings{
            position: absolute;
            top: 9cm;
            left: 18cm;
            width: 12cm;
            height: 2.4cm;
        }

        #two-middle-buttons{
            position: absolute;
            top: 11cm;
            left: 1.6cm;
        }

        #warnings1{
            position: absolute;
            top: 12.6cm;
            left: 0.6cm;
            width: 16cm;
            height: 2.4cm;
        }

        #warnings2{
            position: absolute;
            top: 12.6cm;
            left: 17cm;
            width: 16cm;
            height: 2.4cm;
        }

        .container{
            width: 100%;
        }
    </style>

    <div class="container">
        <div id="main-title">
            <img src="{{ URL::to('/images/bluelinktitle.gif') }}">
            @if(Auth::user() -> isAdmin())
                <a class="btn btn-info" href="{{ route('clear') }}">Clear Database</a>
            @endif
        </div>

        <table id="all" class="small-button-box">
            <tr>
                <td class="first-row">ALL</td>
            </tr>
            <tr>
                <td align="center">
                    <a class="btn btn-info" href="{{ route('allopentickets') }}">All Open Tickets</a>
                </td>
            </tr>
        </table>

        <table id="me" class="small-button-box">
            <tr>
                <td class="first-row">ME</td>
            </tr>
            <tr>
                <td align="center">
                    <a class="btn btn-info" href="{{ route('mytickets') }}">My Tickets</a>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <a class="btn btn-info" href="{{ route('myfollowups') }}">My Follow Ups</a>
                </td>
            </tr>
        </table>

        <table id="team" class="small-button-box">
            <tr>
                <td class="first-row">MY TEAM</td>
            </tr>
            <tr>
                <td align="center">
                    <a class="btn btn-info" href="{{ route('teamtickets') }}">Team Tickets</a>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <a class="btn btn-info" href="{{ route('teamfollowups') }}">Team Follow Ups</a>
                </td>
            </tr>
        </table>
        @if(Auth::user() -> isAdmin())
        <table id="admin" class="small-button-box">
            <tr>
                <td class="first-row">ADMIN</td>
            </tr>
            <tr>
                <td align="center">
                    <a class="btn btn-info" href="{{ route('alltickets') }}">All Tickets</a>
                    <a class="btn btn-info" href="{{ route('users') }}">Manage Users</a>
                    <a class="btn btn-info" href="{{ route('cutoffs') }}">Update Cut Offs</a>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                        <input type="file" class="btn btn-primary" name="import_file[]" style="display: inline-block;" multiple/>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <button class="btn btn-info" style="display: inline-block;">Import Data</button>
		            </form>
                </td>
            </tr>
        </table>

        <div id="cut-off-warnings">
            <h4 style="font-weight: bold; margin: 0px 0px 2px 0px">CutOff Warnings:</h4>
            <div style="width:12cm; height:3cm; overflow: auto; border: thin solid;">
                @include('includes.cutoffs')
            </div>
        </div>
        @endif
        <div id="two-middle-buttons">
            <a class="btn btn-info big" href="{{ route('comptickets') }}">Archive of Completed Tickets</a>
            <a class="btn btn-info big" href="{{ route('inprotickets') }}">All In Progress Tickets</a>
        </div>

        <div id="warnings1">
            <h4 style="font-weight: bold; margin: 0px 0px 2px 0px">Warnings:</h4>
            <div style="width:100%;">
                {!! $cutoffswithin2days_output !!}
            </div>
        </div>

        <div id="warnings2">
            <h4 style="font-weight: bold; margin: 0px 0px 2px 0px">Warnings:</h4>
            <div style="width:100%;">
                {!! $nottouchedsince2days_output !!}
            </div>
        </div>


    </div>
@endsection
