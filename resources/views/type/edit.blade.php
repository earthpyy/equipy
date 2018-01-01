@extends('layouts.form')

@section('title', 'Type')
@section('sub', 'ID: ' . $type->id)
@section('action', url('type', [$type->id]))

@section('info-header', 'Info')

@section('info-body')
    {{ method_field('PUT') }}
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="barcode">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $type->name }}">
        </div>
    </div>
@endsection