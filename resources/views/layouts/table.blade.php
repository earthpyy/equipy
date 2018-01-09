@extends('layouts.app')

@section('content')
    @include('layouts.title')

    @yield('info')

    <table class="table table-striped table-responsive-sm table-sm">
        <thead>
            <tr>
                @yield('header')
            </tr>
        </thead>
        <tbody>
            @yield('body')
        </tbody>
    </table>

    {{ $datas->links('vendor.pagination.bootstrap-4') }}
@endsection