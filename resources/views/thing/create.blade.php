@extends('layouts.form')

@section('title', 'New Thing')
@section('action', url('thing'))

@section('info-header', 'Info')

@section('info-body')
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="barcode">Barcode</label>
            <input type="text" class="form-control" name="barcode" id="barcode" autofocus>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group col-md-6">
            <label for="type">Type</label>
            <select class="form-control" name="type" id="type">
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option value="AVAILABLE">AVAILABLE</option>
                <option value="OUTOFSTOCK" disabled>OUT OF STOCK</option>
                <option value="DEFECTIVE">DEFECTIVE</option>
            </select>
        </div>
    </div>
@endsection