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
        <article class="payrolllist">
            <div class="col-md-8">
                <header><h3>Add Payroll for {{ $user->name }}</h3></header>
                {{ $payrolls->links() }}
                <table class="tg">
                    <col width="200">
                    <col width="200">
                    <col width="80">
                    <tr>
                        <th class="tg-yw4l">Payroll Company</th>
                        <th class="tg-yw4l">Buttons</th>
                    </tr>
                    @foreach($payrolls as $payroll)
                        <article class="userrows">

                            <tr>
                                <td><div data-teamid="{{ $payroll->id }}">{{ $payroll->payrollcompany }}</div></td>
                                <td>
                                    <div class="buttonrow">
                                        <a href="{{route('deletepayroll', ['$payroll_id' => $payroll->id])}}" class="btn
                                        btn-primary">Remove</a>
                                    </div>
                                </td>
                            </tr>

                        </article>
                    @endforeach
                </table>

                {{ $payrolls->links() }}
                <div class="interaction">
                    <a href="#" class="btn btn-primary" id="addpayroll">Add Payroll Company</a>
                </div>
            </div>
        </article>


        @include('modals.new-payroll')
<script>
    $('#addpayroll').on('click', function () {

        $('#newPayrollModal').modal();
    });
</script>
    </div>
@endsection
