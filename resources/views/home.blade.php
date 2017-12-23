@extends('layouts.app')

@section('content')
<div class="my-auto">
  <h1 class="mb-0">{{ config('app.name', 'Laravel') }}
    <span class="text-primary">MS</span>
  </h1>
  <div class="subheading mb-5">Written by
    <a href="https://github.com/earthpyy">@earthpyy</a>
  </div>
  <p class="mb-5">I am experienced in leveraging agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</p>
</div>
<!-- <div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          You are logged in!
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
