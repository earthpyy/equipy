@extends('layouts.app')

@section('content')
    @include('layouts.title')

    <form method="POST" action="@yield('action')">
        {{ csrf_field() }}

        @include('layouts.info')

        <div class="card">
            <div class="card-header">
                Things
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="barcode" placeholder="Barcode">
                    </div>
                </div>
                <table class="table table-striped table-responsive-sm table-sm">
                    <thead>
                        <tr>
                            @yield('table-header')
                        </tr>
                    </thead>
                    <tbody id="list">
                        @yield('table-body')
                    </tbody>
                </table>
            </div>
        </div>

        <input type="submit" value="Submit!">
    </form>
@endsection