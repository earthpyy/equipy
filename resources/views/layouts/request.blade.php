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
<script src="{{ asset('js/disableAutoFill.js') }}"></script>

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

        var borrowers = [];
        $.ajax({
            method: "POST",
            url: "{!! url('borrower/get') !!}",
            dataType: "json",
            async: false,
            success: function(vals) {
                vals.forEach(function (val) {
                    var borrower = {
                        "label" : val.name,
                        "telephone" : val.tel,
                        "student_id" : val.student_id
                    };
                    borrowers.push(borrower);
                });
            }
        });

        $("#name").autocomplete({
            minLength: 0,
            source: borrowers,
            focus: function(event, ui) {
                $(this).val(ui.item.label);
                return false;
            },
            select: function(event, ui) {
                $(this).val(ui.item.label);
                $("#telephone" ).val(ui.item.telephone.split('-').join(''));
                $("#student_id").val(ui.item.student_id.split('-').join(''));
        
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
            .append("<div>" + item.label + "<br>" + item.student_id + "</div>")
            .appendTo(ul);
        };

        $('#name').each(function () {
            $(this).disableAutoFill();
        });
    });

    $(document).on("keypress", ":input:not(textarea)", function(event) {
        return event.keyCode != 13;
    });
</script>
@endsection