@extends('layouts.form')

@section('title', 'Thing')
@section('sub', 'ID: ' . $thing->id)
@section('action', url('thing', [$thing->id]))

@section('info-header', 'Info')

@section('info-body')
    {{ method_field('PUT') }}
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="barcode">Barcode</label>
            <input type="text" class="form-control" name="barcode" id="barcode" value="{{ $thing->barcode }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $thing->name }}">
        </div>
        <div class="form-group col-md-6">
            <label for="type">Type</label>
            <select class="form-control" name="type" id="type">
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ $thing->type_id == $type->id ? 'selected="selected"' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" value="{{ $thing->description }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status"  {{ $thing->status == 'OUTOFSTOCK' ? 'disabled' : '' }}>
                <option value="AVAILABLE" {{ $thing->status == 'AVAILABLE' ? 'selected="selected"' : '' }}>AVAILABLE</option>
                <option value="OUTOFSTOCK" disabled {{ $thing->status == 'OUTOFSTOCK' ? 'selected="selected"' : '' }}>OUT OF STOCK</option>
                <option value="DEFECTIVE" {{ $thing->status == 'DEFECTIVE' ? 'selected="selected"' : '' }}>DEFECTIVE</option>
            </select>
        </div>
    </div>
@endsection