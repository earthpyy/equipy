@extends('layouts.app')

@section('content')
    @include('layouts.title')

    @include('layouts.alert')

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
                        <tr class="row">
                            @yield('table-header')
                        </tr>
                    </thead>
                    <tbody id="list">
                        @yield('table-body')
                    </tbody>
                </table>
            </div>
        </div>
        <br>

        <input type="submit" class="btn btn-primary" value="Submit!">
    </form>
@endsection