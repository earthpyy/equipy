@extends('layouts.table')

@section('title', 'Lents')

@isset($borrower)
    @section('sub', $borrower)
@endisset

@section('header')
    <th>#</th>
    <th>Date</th>
    <th>Promising Date</th>
    <th>Borrower</th>
    <th>QTY</th>
    <th>Status</th>
@endsection

@section('body')
    @foreach($datas as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->created_at->format('d/m/Y') }}</td>
            <td>{{ $data->promising_date->format('d/m/Y') }}</td>
            <td>{{ $data->borrower->name }}</td>
            <td>{{ $data->things->sum(function ($thing) {
                    return $thing->pivot->qty;
                }) }}</td>
            @if($data->return_date == null)
                @if($data->promising_date < date('Y-m-d H:i:s'))
                    <td class="text-danger">Overdue</td>
                @else
                    <td class="text-warning">Not return</td>
                @endif
            @else
                @if($data->promising_date < $data->return_date)
                    <td class="text-info">Late returned</td>
                @else
                    <td class="text-success">Returned</td>
                @endif
            @endif

            @include('modifiers.full', ['id' => $data->id])
        </tr>
    @endforeach
@endsection