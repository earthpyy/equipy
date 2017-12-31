@extends('layouts.app')

@section('content')
    @include('layouts.title')

    @include('layouts.alert')

    <form method="POST" action="@yield('action')">
        {{ csrf_field() }}

        @include('layouts.info')

        <input type="submit" class="btn btn-primary" value="Submit!">
    </form>
@endsection