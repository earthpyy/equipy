@extends('layouts.request')

@section('title', 'Borrow')
@section('action', url('lent'))

@section('info-header', 'Info')

@section('info-body')
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ isset($borrower) ? $borrower->name : '' }}">
        </div>
        <div class="form-group col-md-6">
            <label for="telephone">Telephone</label>
            <input type="text" class="form-control" name="telephone" id="telephone" value="{{ isset($borrower) ? $borrower->getOriginal('tel') : '' }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="student_id">Student ID</label>
            <input type="text" class="form-control" name="student_id" id="student_id" placeholder="Optional" value="{{ isset($borrower) ? $borrower->getOriginal('student_id') : '' }}">
        </div>
        <div class="form-group col-md-6">
            <label for="promising_date">Promising Date</label>
            <input type="text" class="form-control" name="promising_date" id="promising_date">
        </div>
    </div>
@endsection

@section('table-header')
    <th class="col-1">#</th>
    <th class="col">Barcode</th>
    <th class="col">Name</th>
    <th class="col">Type</th>
    <th class="col-2">Actions</th>
@endsection

@section('script')
<script src="{{ asset('js/typeahead.js') }}"></script>

<script type="text/javascript">
    var i = $('#list tr').size() + 1;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("keypress", ":input:not(textarea)", function(event) {
        return event.keyCode != 13;
    });

    $(document).on('change keydown paste input', '#barcode', function(){
        if ($('#barcode').val().length == 5) {

            var barcode = $('#barcode').val();
            $('#barcode').val('');

            $.ajax({
                method: "POST",
                url: "{!! url('thing/detail') !!}",
                data: {
                    "barcode" : barcode,
                    "method" : "borrow"
                },
                dataType: "json",
                success: function(thing) {
                    var dup = false;
                    if (thing.length != 0) {
                        $('.things').each(function () {
                            if ($(this).text() == thing.barcode) {
                                dup = true;
                                return;
                            }
                        });
                        if (!dup) {
                            $('#list').append('<tr class="row"><td class="col-1"><input type="hidden" name="things[]" value="' + thing.id + '">' + i + '</td><td class="col things">' + thing.barcode + '</td><td class="col">' + thing.name + '</td><td class="col">' + thing.type.name + '</td><td class="col-2"><a class="btn btn-sm btn-danger" id="remove" href="#">Remove</a></td></tr>');  
                            i++;
                        } else {
                            alert('This equipment is already in list!');
                        }
                    }
                },
                error: function(msg) {
                    alert(msg.responseText);
                }
            })
        }
    });

    //Remove button
    $(document).on('click', '#remove', function() {
        $(this).closest('tr').remove();
        i--;
        return false;
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