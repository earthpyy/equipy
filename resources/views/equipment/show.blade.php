@extends('layouts.view')

@section('title', 'Equipment')
@section('sub', 'ID: ' . $equipment->id)

@section('info-header', 'Info')

@section('info-body')
    <div class="row">
        <div class="col-4 font-weight-bold">Barcode</div>
        <div class="col-8">{{ $equipment->barcode }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Name</div>
        <div class="col-8">{{ $equipment->name }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Category</div>
        <div class="col-8">{{ $equipment->category->name }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Description</div>
        <div class="col-8">{{ $equipment->description }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Status</div>
        <div class="col-8">{!! getEquipmentStatus($equipment) !!}</div>
    </div>
@endsection