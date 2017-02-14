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

    .urgent-row{
        background-color: red;
        color: yellow;
        !important;
    }
    /* fix for freeze column div position */
    .ui-jqgrid .editable {margin: 0px !important;}

</style>
    <div class="container">
        {!! $teamfollowups_output !!}
    </div>
    <script>
        jQuery(document).ready(function() {

            jQuery("#teamfollowups").jqGrid('setGridHeight',jQuery(window).innerHeight()*.69);

        });
    </script>
@endsection
