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
    $(function () {
        $('#promising_date').datepicker({
            dateFormat: "dd/mm/yy"
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("keypress", ":input:not(textarea)", function(event) {
        return event.keyCode != 13;
    });

    {{--  $(document).ready(function () {
        $('input').disableAutoFill();
    });  --}}

    {{--  var substringMatcher = function() {
        return function findMatches(q, cb) {
            var matches, substringRegex;
      
            // an array that will be populated with substring matches
            matches = [];
      
            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');
        
            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array

            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });
      
            cb(matches);
        };
    };
      
      var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
        'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
        'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
        'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
        'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
        'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
        'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
        'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
        'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
      ];

    $.ajax({
        method: "POST",
        url: "{!! url('borrower/get') !!}",
        data: {},
        dataType: "json",
        success: function(data) {
            //
        }
    });
    
    $('.typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'borrowers',
        source: substringMatcher()
    });  --}}
</script>
@endsection