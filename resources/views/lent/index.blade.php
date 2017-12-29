@extends('layouts.table')

@section('title', 'Lents')

@isset($borrower)
    @section('sub', $borrower)
@endisset

@section('header')
    <th>#</th>
    <th>Date</th>
    <th>Promising Date</th>
    <th>Borrower</th>
    <th>QTY</th>
    <th>Status</th>
    <th>Actions</th>
@endsection

@section('body')
    @foreach($datas as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->created_at->format('d/m/Y') }}</td>
            <td>{{ $data->promising_date->format('d/m/Y') }}</td>
            <td>{{ $data->borrower->name }}</td>
            <td>{{ $data->things->count() }}</td>
            <td>{!! getLentStatus($data) !!}</td>

            @include('modifiers.full', ['id' => $data->id])
        </tr>
    @endforeach
@endsection