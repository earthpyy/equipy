@extends('layouts.table')

@section('title', 'Borrowers')

@section('header')
    <th>#</th>
    <th>Name</th>
    <th>Telephone</th>
@endsection

@section('body')
@foreach($datas as $data)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data->name }}</td>
        <td>{{ substr($data->tel, 0, 3) . '-' . substr($data->tel, 3) }}</td>

        @include('modifiers.full', ['id' => $data->id])
    </tr>
@endforeach
    
@endsection