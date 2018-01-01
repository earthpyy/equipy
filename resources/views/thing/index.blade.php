@extends('layouts.table')

@section('title', 'Things')

@isset($type)
    @section('sub', $type)
@endisset

@section('button')
    <a class="btn btn-sm btn-success" href="{{ route('thing.create') }}">New</a>
@endsection

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
            <td><a href="{{ url('thing', [$data->id]) }}">{{ $data->name }}</a></td>
            <td>{{ $data->type->name }}</td>
            <td>{{ $data->barcode }}</td>
            <td>{!! getThingStatus($data) !!}</td>

            <td>
                {{--  <a class="btn btn-sm btn-info" href="{{ url('thing/' . $data->id) }}">Show</a>  --}}
                <a class="btn btn-sm btn-warning" href="{{ route('thing.edit', ['id' => $data->id]) }}">Edit</a>
                <form class="d-inline" action="{{url('thing', [$data->id])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-sm btn-danger" value="Delete"/>
                </form>
            </td>
        </tr>
    @endforeach
@endsection