@extends('layouts.form')

@section('title', $equipment->name)
@section('action', url('equipment', [$equipment->id]))

@section('info-header', 'Info')

@section('info-body')
    {{ method_field('PUT') }}
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="barcode">Barcode</label>
            <input type="text" class="form-control" name="barcode" id="barcode" value="{{ $equipment->barcode }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $equipment->name }}">
        </div>
        <div class="form-group col-md-6">
            <label for="category">Category</label>
            <select class="form-control" name="category" id="category">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $equipment->category_id == $category->id ? 'selected="selected"' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" value="{{ $equipment->description }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status"  {{ $equipment->status == 'OUTOFSTOCK' ? 'disabled' : '' }}>
                <option value="AVAILABLE" {{ $equipment->status == 'AVAILABLE' ? 'selected="selected"' : '' }}>AVAILABLE</option>
                <option value="OUTOFSTOCK" disabled {{ $equipment->status == 'OUTOFSTOCK' ? 'selected="selected"' : '' }}>OUT OF STOCK</option>
                <option value="DEFECTIVE" {{ $equipment->status == 'DEFECTIVE' ? 'selected="selected"' : '' }}>DEFECTIVE</option>
            </select>
        </div>
    </div>
@endsection