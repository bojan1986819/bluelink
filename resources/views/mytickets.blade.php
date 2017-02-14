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
        {!! $mytickets_output !!}
    </div>
    <script>
        jQuery(document).ready(function() {

            jQuery('#mytickets').jqGrid('navButtonAdd', '#mytickets_pager',
                {
                    'caption'      : 'Set Completed',
                    'buttonicon'   : 'ui-icon-pencil',
                    'onClickButton': function()
                    {
                        fx_bulk_update("set-completed");
                    },
                    'position': 'last'
                });

            jQuery("#mytickets").jqGrid('setGridHeight',jQuery(window).innerHeight()*.69);

        });
    </script>
@endsection
