@extends('layouts.request')

@section('title', 'Borrow')
@section('action', url('lent'));

@section('info-header', 'Borrower\'s Info')

@section('info-body')
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" required>
        </div>
        <div class="form-group col-md-6">
            <label for="student_id">Student ID</label>
            <input type="text" class="form-control" id="student_id" placeholder="Optional">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="tel">Telephone</label>
            <input type="text" class="form-control" id="tel" required>
        </div>
    </div>
@endsection

@section('table-header')
    <th>#</th>
    <th>Barcode</th>
    <th>Name</th>
    <th>Type</th>
    <th>Actions</th>
@endsection

@section('script')
<script type="text/javascript">
    var i = $('#list tr').size() + 1;

    $(document).on('change keydown paste input', '#barcode', function(){
        if ($('#barcode').val().length == 13) {

            var barcode = $('#barcode').val();
            $('#barcode').val('');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
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
                            $('#list').append('<tr><td><input type="hidden" name="things[]" value="' + thing.id + '">' + i + '</td><td class="things">' + thing.barcode + '</td><td>' + thing.name + '</td><td>' + thing.type.name + '</td><td><a class="btn btn-sm btn-danger" id="remove" href="#">Remove</a></td></tr>');  
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