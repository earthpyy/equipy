@extends('layouts.table')

@isset($borrower)
@section('title', $borrower->name)
@endisset
@empty($borrower)
@section('title', 'Borrowings')
@endempty

@isset($sub)
    @section('sub', $sub)
@endisset

@section('button')
<a class="btn btn-sm btn-success" href="{{ route('borrowing.borrow', ['borrower' => isset($borrower) ? $borrower : null]) }}">Borrow</a>
@endsection

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
            <td><a href="{{ route('borrowing.show', $data->id) }}">{{ ($datas->perPage() * ($datas->currentPage() - 1)) + $loop->iteration }}</a></td>
            <td>{{ $data->created_at->format('d/m/Y') }}</td>
            <td>{{ $data->promising_date }}</td>
            <td>{{ $data->borrower->name }}</td>
            <td>{{ $data->equipment->count() }}</td>
            <td>{!! getBorrowingStatus($data) !!}</td>

            <td>
                {{--  <a class="btn btn-sm btn-info" href="{{ url('borrowing', [$data->id]) }}">Show</a>  --}}
                <a class="btn btn-sm btn-warning" href="{{ route('borrowing.edit', $data->id) }}">Edit | Return</a>
                <form class="d-inline" action="{{ url('borrowing', [$data->id])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-sm btn-danger" value="Delete"/>
                </form>
            </td>
        </tr>
    @endforeach
@endsection