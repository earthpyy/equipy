@extends('layouts.table')

@section('title', 'Lent')
@section('sub', 'ID: ' . $lent->id)

@php
    $datas = $lent->things()->paginate(10);
@endphp

@section('info')
    <div class="card">
        <div class="card-header">
            Info
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 font-weight-bold">Date</div>
                <div class="col-8">{{ $lent->created_at }}</div>
            </div>
            <div class="row">
                <div class="col-4 font-weight-bold">Promising date</div>
                <div class="col-8">{{ $lent->promising_date }}</div>
            </div>
            <div class="row">
                <div class="col-4 font-weight-bold">Status</div>
                <div class="col-8">{!! getLentStatus($lent) !!}</div>
            </div>
            @if($lent->return_date != null)
            <div class="row">
                <div class="col-4 font-weight-bold">Return Date</div>
                <div class="col-8">{{ $lent->return_date }}</div>
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
        </div>
    </div>
    <br>
@endsection

@section('header')
    <th>#</th>
    <th>Thing</th>
    <th>QTY</th>
@endsection

@section('body')
    @foreach($datas as $thing)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $thing->name }}</td>
            <td>{{ $thing->pivot->qty }}</td>
            </td>
        </tr>
    @endforeach
@endsection