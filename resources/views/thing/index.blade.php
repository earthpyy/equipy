@extends('layouts.table')

@section('title', 'Things')

@isset($type)
    @section('sub', $type)
@endisset

@section('header')
    <th>#</th>
    <th>Name</th>
    <th>Type</th>
    <th>Barcode</th>
    <th>Status</th>
    <th>Actions</th>
@endsection

@section('body')
    @foreach($datas as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->type->name }}</td>
            <td>{{ $data->barcode }}</td>
            <td>{!! getThingStatus($data) !!}</td>

            @include('modifiers.full', ['id' => $data->id])
        </tr>
    @endforeach
@endsection