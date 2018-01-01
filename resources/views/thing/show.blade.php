@extends('layouts.view')

@section('title', 'Thing')
@section('sub', 'ID: ' . $thing->id)

@section('info-header', 'Info')

@section('info-body')
    <div class="row">
        <div class="col-4 font-weight-bold">Barcode</div>
        <div class="col-8">{{ $thing->barcode }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Name</div>
        <div class="col-8">{{ $thing->name }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Type</div>
        <div class="col-8">{{ $thing->type->name }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Description</div>
        <div class="col-8">{{ $thing->description }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Status</div>
        <div class="col-8">{!! getThingStatus($thing) !!}</div>
    </div>
@endsection