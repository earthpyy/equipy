@extends('layouts.form')

@section('title', $borrower->name)
@section('action', url('borrower', [$borrower->id]))

@section('info-header', 'Info')

@section('info-body')
    {{ method_field('PUT') }}
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $borrower->name }}">
        </div>
        <div class="form-group col-md-6">
            <label for="telephone">Telephone</label>
            <input type="text" class="form-control" name="telephone" id="telephone" value="{{ $borrower->getOriginal('tel') }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="student_id">Student ID</label>
            <input type="text" class="form-control" name="student_id" id="student_id" value="{{ $borrower->getOriginal('student_id') }}">
        </div>
    </div>
@endsection