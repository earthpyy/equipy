@extends('layouts.request')

@section('title', 'Borrow')
@section('action', url('borrowing'))

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
    <th class="col">Category</th>
    <th class="col-2">Actions</th>
@endsection

@section('script')
@parent
<script src="{{ asset('js/disableAutoFill.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
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

    var i = $('#list tr').size() + 1;

    $(document).on('change keydown paste input', '#barcode', function(){
        if ($('#barcode').val().length == 5) {

            var barcode = $('#barcode').val();
            $('#barcode').val('');

            $.ajax({
                method: "POST",
                url: "{!! url('equipment/detail') !!}",
                data: {
                    "barcode" : barcode,
                    "method" : "borrow"
                },
                dataType: "json",
                success: function(equipment) {
                    var dup = false;
                    if (equipment.length != 0) {
                        $('.equipment').each(function () {
                            if ($(this).text() == equipment.barcode) {
                                dup = true;
                                return;
                            }
                        });
                        if (!dup) {
                            $('#list').append('<tr class="row"><td class="col-1"><input type="hidden" name="equipment[]" value="' + equipment.id + '">' + i + '</td><td class="col equipment">' + equipment.barcode + '</td><td class="col">' + equipment.name + '</td><td class="col">' + equipment.category.name + '</td><td class="col-2"><a class="btn btn-sm btn-danger" id="remove" href="#">Remove</a></td></tr>');  
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