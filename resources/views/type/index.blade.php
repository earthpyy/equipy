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

        <td>
            <a class="btn btn-sm btn-success" href="{{ url('type/' . $data->id) }}">Show</a>
            {{--  <a class="btn btn-sm btn-info" href="{{ url('type/' . $data->id . '/edit') }}">Edit</a>  --}}
        </td>
    </tr>
@endforeach
    
@endsection