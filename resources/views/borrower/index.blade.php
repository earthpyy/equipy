@extends('layouts.table')

@section('title', 'Borrowers')

@section('header')
    <th>#</th>
    <th>Name</th>
    <th>Student ID</th>
    <th>Telephone</th>
    <th>Actions</th>
@endsection

@section('body')
@foreach($datas as $data)
    <tr>
        <td>{{ ($datas->perPage() * ($datas->currentPage() - 1)) + $loop->iteration }}</td>
        <td>{{ $data->name }}</td>
        <td>{{ $data->student_id }}</td>
        <td>{{ $data->tel }}</td>

        <td>
            <a class="btn btn-sm btn-info" href="{{ url('lent/borrower', [$data->id]) }}">Show</a>
            {{--  <a class="btn btn-sm btn-warning" href="{{ route('borrower.edit', ['id' => $data->id]) }}">Edit</a>  --}}
        </td>
    </tr>
@endforeach
    
@endsection