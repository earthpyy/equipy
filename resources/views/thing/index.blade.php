@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-0">Things</h1>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-striped table-responsive-sm table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Barcode</th>
                <th>QTY</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($things as $thing)
            <tr>
                <td>{{ $thing->id }}</td>
                <td>{{ $thing->name }}</td>
                <td>{{ $thing->type->name }}</td>
                <td>{{ $thing->barcode }}</td>
                <td>{{ $thing->qty }}</td>

                <td>
                    <a class="btn btn-sm btn-success" href="{{ URL::to('thing/' . $thing->id) }}">Show</a>
                    <a class="btn btn-sm btn-info" href="{{ URL::to('thing/' . $thing->id . '/edit') }}">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $things->links() }}
</div>
@endsection