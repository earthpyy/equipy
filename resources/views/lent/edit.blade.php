@extends('layouts.request')

@section('title', 'Edit/Return')
@section('action', url('lent', [$lent->id]))

@php
$datas = $lent->things()->orderBy('type_id')->get();
@endphp

@section('info-header', 'Info')

@section('info-body')
{{ method_field('PUT') }}
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $lent->borrower->name }}">
    </div>
    <div class="form-group col-md-6">
        <label for="telephone">Telephone</label>
        <input type="text" class="form-control" name="telephone" id="telephone" value="{{ $lent->borrower->getOriginal('tel') }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="student_id">Student ID</label>
        <input type="text" class="form-control" name="student_id" id="student_id" value="{{ $lent->borrower->getOriginal('student_id') }}">
    </div>
    <div class="form-group col-md-6">
        <label for="promising_date">Promising Date</label>
        <input type="text" class="form-control" name="promising_date" id="promising_date" value="{{ $lent->promising_date }}">
    </div>
</div>
@endsection

@section('table-header')
<th class="col-1">#</th>
<th class="col">Barcode</th>
<th class="col">Name</th>
<th class="col">Status</th>
<th class="col-2">Actions</th>
@endsection

@section('table-body')
@foreach($datas as $i => $thing)
@if($i == 0 || $datas[$i - 1]->type != $thing->type)
<tr class="row">
    <th colspan="5">{{ $thing->type->name }}</th>
</tr>
@endif
<tr class="row">
    <td class="col-1">{{ $loop->iteration }}</td>
    <td class="col">{{ $thing->barcode }}</td>
    <td class="col">{{ $thing->name }}</td>
    <td class="col">{!! getLentThingStatus($thing) !!}</td>
    
    <td class="col-2">
        <input type="hidden" name="things[{{ $thing->id }}]" value="{{ $thing->pivot->status }}">
        @if($thing->pivot->status == 'NOTRETURN')
        <a class="btn btn-sm btn-success return-btn" href="#">Return</a>
        {{--  @elseif($thing->pivot->status == 'RETURNED')  --}}
        {{--  <a class="btn btn-sm btn-warning defective-btn" href="#">Defective</a>  --}}
        @endif
    </td>
</tr>
@endforeach
@endsection

@push('script')
<script type="text/javascript">
    $(document).on('click', 'a.return-btn', function() {
        var input = $(this).closest('td').find('input');
        var status = $(this).closest('td').prev('td');
        if (input.val() == 'NOTRETURN') {
            input.val('WILLRETURNED');
            status.html('<div class="text-success">Will returned</div>');
            $(this).addClass('btn-danger').removeClass('btn-success');
            $(this).text('Undo');

            // adding defective button
            $(this).after('<a class="btn btn-sm btn-warning defective-btn" href="#">Defective</a>');
            {{--  $(this).closest('td').add('a').addClass('btn btn-sm btn-warning defective-btn').text('Defective');  --}}
        } else if (input.val() == 'WILLRETURNED' || input.val() == 'WILLDEFECTIVE') {
            input.val('NOTRETURN');
            status.html('<div class="text-danger">Not return</div>');
            $(this).addClass('btn-success').removeClass('btn-danger');
            $(this).text('Return');

            // removing defective button
            $(this).closest('td').find('a.defective-btn').remove();
        }
        return false;
    });

    $(document).on('click', 'a.defective-btn', function() {
        var input = $(this).closest('td').find('input');
        var status = $(this).closest('td').prev('td');
        if (input.val() == 'RETURNED' || input.val() == 'WILLRETURNED') {
            input.val('WILLDEFECTIVE');
            status.html('<div class="text-warning">Will defective</div>');
            $(this).text('Undo');
        } else if (input.val() == 'WILLDEFECTIVE') {
            input.val('WILLRETURNED');
            status.html('<div class="text-success">Will returned</div>');
            $(this).text('Defective');
        }
        return false;
    });

    var i = $('#list tr').size() + 1;

    $(document).on('change keydown paste input', '#barcode', function(){
        if ($('#barcode').val().length == 5) {

            var barcode = $('#barcode').val();
            $('#barcode').val('');

            var found = false;
            $("table tr td:nth-child(2)").each(function () {
                if ($(this).text() == barcode) {
                    found = true;
                    var input = $(this).closest('tr').find('td input');
                    if (input.val() == 'NOTRETURN') {
                        input.siblings('a.return-btn').click();
                    } else {
                        alert('This equipment is not in \'Not Return\' status!');
                    }
                }
            });
            if (!found) {
                alert('Barcode not found in list!');
            }
        }
    });
</script>
@endpush