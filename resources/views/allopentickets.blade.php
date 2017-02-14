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
        {!! $allopentickets_output !!}
    </div>

    <script>
        jQuery(document).ready(function() {

            jQuery("#allopentickets").jqGrid('setGridHeight',jQuery(window).innerHeight()*.69);

        });
    </script>
@endsection
