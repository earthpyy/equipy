@extends('layouts.app')

@section('content')
<div class="my-auto">
  <h1 class="mb-0">Equipy
    <span class="text-primary">MS</span>
  </h1>
  <div class="subheading mb-5">Written by
    <a href="https://github.com/earthpyy">@earthpyy</a>
  </div>
  <p class="mb-5">I am experienced in leveraging agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</p>
  <ul class="list-inline list-social-icons mb-0">
    <li class="list-inline-item">
      <a href="#">
        <span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
        </span>
      </a>
    </li>
    <li class="list-inline-item">
      <a href="#">
        <span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
        </span>
      </a>
    </li>
    <li class="list-inline-item">
      <a href="#">
        <span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
        </span>
      </a>
    </li>
    <li class="list-inline-item">
      <a href="#">
        <span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-github fa-stack-1x fa-inverse"></i>
        </span>
      </a>
    </li>
  </ul>
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
