@extends('layouts.table')

@section('title', 'Borrowing')

@php
    $datas = $borrowing->equipment()->orderBy('category_id')->paginate(10);
@endphp

@section('info-header', 'Info')

@section('info-body')
    <div class="row">
        <div class="col-4 font-weight-bold">Date</div>
        <div class="col-8">{{ $borrowing->created_at->format('d/m/Y H:i') }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Promising date</div>
        <div class="col-8">{{ $borrowing->promising_date }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Borrower</div>
        <div class="col-8">{{ $borrowing->borrower->name }}</div>
    </div>
    @if($borrowing->borrower->student_id != '-')
    <div class="row">
        <div class="col-4 font-weight-bold">Student ID</div>
        <div class="col-8">{{ $borrowing->borrower->student_id }}</div>
    </div>
    @endif
    <div class="row">
        <div class="col-4 font-weight-bold">Telephone</div>
        <div class="col-8">{{ $borrowing->borrower->tel }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Status</div>
        <div class="col-8">{!! getBorrowingStatus($borrowing) !!}</div>
    </div>
    @if($borrowing->completed_date != null)
    <div class="row">
        <div class="col-4 font-weight-bold">Completed Date</div>
        <div class="col-8">{{ $borrowing->completed_date }}</div>
    </div>
    @endif
    <div class="row">
        <div class="col-4 font-weight-bold">Approver</div>
        <div class="col-8">{{ $borrowing->approver->name }}</div>
    </div>
    <div class="row">
        <div class="col-4 font-weight-bold">Note</div>
        <div class="col-8">{{ $borrowing->note }}</div>
    </div>
@endsection

@section('info')
    @include('layouts.info')
@endsection

@section('header')
    <th>#</th>
    <th>Equipment</th>
    <th>Status</th>
    <th>Return Date</th>
@endsection

@section('body')
    @foreach($datas as $i => $equipment)
        @if($i == 0 || $datas[$i - 1]->category != $equipment->category)
        <tr>
            <th colspan="4">{{ $equipment->category->name }}</th>
        </tr>
        @endif
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $equipment->name }}</td>
            <td>{!! getBorrowingEquipmentStatus($equipment) !!}</td>
            <td>{{ ($equipment->pivot->return_date == null ? '-' : $equipment->pivot->return_date) }}</td>
        </td>
        </tr>
    @endforeach
@endsection