@extends('layouts.table')

@section('title', 'Categories')

@section('button')
<a class="btn btn-sm btn-success" href="{{ route('category.create') }}">New</a>
@endsection

@section('header')
<th>#</th>
<th>Name</th>
<th>Available</th>
<th>Out of stock</th>
<th>Defective</th>
<th>Actions</th>
@endsection

@section('body')
@foreach($datas as $data)
<tr>
    <td>{{ ($datas->perPage() * ($datas->currentPage() - 1)) + $loop->iteration }}</td>
    <td><a href="{{ route('category.show', $data->id) }}">{{ $data->name }}</td>
    <td>{{ $data->equipment()->available()->count() }}</td>
    <td>{{ $data->equipment()->outOfStock()->count() }}</td>
    <td>{{ $data->equipment()->defective()->count() }}</td>

    <td>
        {{--  <a class="btn btn-sm btn-info" href="{{ url('category', [$data->id]) }}">Show</a>  --}}
        <a class="btn btn-sm btn-warning" href="{{ route('category.edit', $data->id) }}">Edit</a>
        <form class="d-inline" action="{{url('category', [$data->id])}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" class="btn btn-sm btn-danger" value="Delete"/>
        </form>
    </td>
</tr>
@endforeach
@endsection