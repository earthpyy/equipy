@extends('layouts.request')

@section('title', 'Borrow')

@section('info-header', 'Borrower\'s Info')

@section('info-body')
    <form method="POST" action="">
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group col-md-6">
                <label for="student_id">Student ID</label>
                <input type="text" class="form-control" id="student_id" placeholder="Optional">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tel">Telephone</label>
                <input type="text" class="form-control" id="tel">
            </div>
            {{--  <div class="form-group col-md-6">
                <label for="student_id">Student ID (optional)</label>
                <input type="text" class="form-control" id="student_id" placeholder="xxxxxxxxxx">
            </div>  --}}
        </div>
    </form>
@endsection

@section('table-header')
    <th>#</th>
    <th>Barcode</th>
    <th>Name</th>
    <th>Type</th>
    <th>Actions</th>
@endsection