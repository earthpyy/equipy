@extends('layouts.table')

@section('title', 'Types')

@section('header')
    <th>#</th>
    <th>Name</th>
    <th>Amount</th>
    <th>Actions</th>
@endsection

@section('body')
@foreach($datas as $data)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data->name }}</td>
        <td>{{ $data->things->count() }}</td>

        @include('modifiers.full', ['id' => $data->id])
    </tr>
@endforeach
    
@endsection