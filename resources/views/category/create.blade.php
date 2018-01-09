@extends('layouts.form')

@section('title', 'New Category')
@section('action', url('category'))

@section('info-header', 'Info')

@section('info-body')
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="barcode">Name</label>
            <input type="text" class="form-control" name="name" id="name" autofocus>
        </div>
    </div>
@endsection