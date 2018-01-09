@extends('layouts.table')

@isset($category)
@section('title', $category->name)
@endisset
@empty($category)
@section('title', 'Equipment')
@endempty

@isset($sub)
@section('sub', $sub)
@endisset

@section('button')
    <a class="btn btn-sm btn-success" href="{{ route('equipment.create') }}">New</a>
@endsection

@section('header')
    <th>#</th>
    <th>Name</th>
    <th>Category</th>
    <th>Barcode</th>
    <th>Status</th>
    <th>Actions</th>
@endsection

@section('body')
    @foreach($datas as $data)
        <tr>
            <td>{{ ($datas->perPage() * ($datas->currentPage() - 1)) + $loop->iteration }}</td>
            <td><a href="{{ route('equipment.show', $data->id) }}">{{ $data->name }}</a></td>
            <td>{{ $data->category->name }}</td>
            <td>{{ $data->barcode }}</td>
            <td>{!! getEquipmentStatus($data) !!}</td>

            <td>
                {{--  <a class="btn btn-sm btn-info" href="{{ url('equipment/' . $data->id) }}">Show</a>  --}}
                <a class="btn btn-sm btn-warning" href="{{ route('equipment.edit', $data->id) }}">Edit</a>
                <form class="d-inline" action="{{url('equipment', [$data->id])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-sm btn-danger" value="Delete"/>
                </form>
            </td>
        </tr>
    @endforeach
@endsection