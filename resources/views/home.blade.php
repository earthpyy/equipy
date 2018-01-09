@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="mx-auto">
        <h1>
            {{ config('app.name', 'Laravel') }}
            <span class="text-primary">MS</span>
        </h1>
        <div class="subheading mb-5 text-right">
            Written by
            <a href="https://github.com/earthpyy">@earthpyy</a>
        </div>
    </div>
</div>
<div class="row">
    <p class="mb-5 mx-auto">This is DEMO version, so it's buggy!</p>
</div>
@endsection
