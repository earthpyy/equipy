@extends('layouts.table')

@section('title', 'Types')

@section('button')
    <a class="btn btn-sm btn-success" href="{{ route('type.create') }}">New</a>
@endsection

@section('header')
    <th>#</th>
    <th>Name</th>
    <th>Amount</th>
    <th>Actions</th>
@endsection

@section('body')
@foreach($datas as $data)
    <tr>
        <td>{{ ($datas->perPage() * ($datas->currentPage() - 1)) + $loop->iteration }}</td>
        <td><a href="{{ url('type', [$data->id]) }}">{{ $data->name }}</td>
        <td>{{ $data->things->count() }}</td>

        <td>
            {{--  <a class="btn btn-sm btn-info" href="{{ url('type', [$data->id]) }}">Show</a>  --}}
            <a class="btn btn-sm btn-warning" href="{{ route('type.edit', ['id' => $data->id]) }}">Edit</a>
            <form class="d-inline" action="{{url('type', [$data->id])}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="submit" class="btn btn-sm btn-danger" value="Delete"/>
            </form>
        </td>
    </tr>
@endforeach
@endsection