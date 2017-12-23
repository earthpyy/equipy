@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-0">@yield('title') <small>@yield('sub')</small></h2>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-striped table-responsive-sm table-sm">
        <thead>
            <tr>
                @yield('header')

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @yield('body')
        </tbody>
    </table>

    {{ $datas->links() }}
</div>
@endsection