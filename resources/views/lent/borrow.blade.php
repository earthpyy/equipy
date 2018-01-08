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
@parent
{{--  <script src="{{ asset('js/typeahead.js') }}"></script>  --}}

<script type="text/javascript">
    var i = $('#list tr').size() + 1;

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
</script>
@endsection