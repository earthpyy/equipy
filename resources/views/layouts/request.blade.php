@extends('layouts.app')

@section('content')
@include('layouts.title')

@include('layouts.alert')

<form method="POST" action="@yield('action')">
    {{ csrf_field() }}

    @include('layouts.info')

    <div class="card">
        <div class="card-header">
            Equipment
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="barcode" placeholder="Barcode">
                </div>
            </div>
            <table class="table table-striped table-responsive-sm table-sm">
                <thead>
                    <tr class="row">
                        @yield('table-header')
                    </tr>
                </thead>
                <tbody id="list">
                    @yield('table-body')
                </tbody>
            </table>
        </div>
    </div>
    <br>

    <input type="submit" class="btn btn-primary" value="Submit!">
</form>
@endsection

@section('style')
<link href="{{ asset('css/typeahead.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('#promising_date').datepicker({
            dateFormat: "dd/mm/yy"
        });
    });

    $(document).on("keypress", ":input:not(textarea)", function(event) {
        return event.keyCode != 13;
    });
</script>
@endsection