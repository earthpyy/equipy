<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h2 class="mb-0">@yield('title') <small>@yield('sub')</small></h2>
        </div>
        <div class="col-5 align-self-end d-inline-block" style="text-align: right;">
            @yield('button')
        </div>
    </div>
</div>

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif