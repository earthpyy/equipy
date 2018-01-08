@extends('layouts.table')

@section('title', 'Lent')
@section('sub', 'ID: ' . $lent->id)

@php
    $datas = $lent->things()->orderBy('type_id')->paginate(10);
@endphp

@section('info-header', 'Info')

@section('info-body')
    <div class="row">
        <div class="col-4 font-weight-bold">Date</div>
        <div class="col-8">{{ $lent->created_at->format('d/m/Y H:i') }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Promising date</div>
        <div class="col-8">{{ $lent->promising_date }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Borrower</div>
        <div class="col-8">{{ $lent->borrower->name }}</div>
    </div>
    @if($lent->borrower->student_id != '-')
    <div class="row">
        <div class="col-4 font-weight-bold">Student ID</div>
        <div class="col-8">{{ $lent->borrower->student_id }}</div>
    </div>
    @endif
    <div class="row">
        <div class="col-4 font-weight-bold">Telephone</div>
        <div class="col-8">{{ $lent->borrower->tel }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Status</div>
        <div class="col-8">{!! getLentStatus($lent) !!}</div>
    </div>
    @if($lent->completed_date != null)
    <div class="row">
        <div class="col-4 font-weight-bold">Completed Date</div>
        <div class="col-8">{{ $lent->completed_date }}</div>
    </div>
    @endif
    <div class="row">
        <div class="col-4 font-weight-bold">Approver</div>
        <div class="col-8">{{ $lent->approver->name }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Note</div>
        <div class="col-8">{{ $lent->note }}</div>
    </div>
@endsection

@section('info')
    @include('layouts.info')
@endsection

@section('header')
    <th>#</th>
    <th>Thing</th>
    <th>Status</th>
    <th>Return Date</th>
@endsection

@section('body')
    @foreach($datas as $i => $thing)
        @if($i == 0 || $datas[$i - 1]->type != $thing->type)
        <tr>
            <th colspan="4">{{ $thing->type->name }}</th>
        </tr>
        @endif
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $thing->name }}</td>
            <td>{!! getLentThingStatus($thing) !!}</td>
            <td>{{ ($thing->pivot->return_date == null ? '-' : $thing->pivot->return_date) }}</td>
        </td>
        </tr>
    @endforeach
@endsection