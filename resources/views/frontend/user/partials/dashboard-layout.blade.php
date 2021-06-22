@extends('frontend.layouts.app')
@section('css')
    
@endsection
@section('js')
    
@endsection
@section('body')
      <main>
    <div class="dashboard">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="db-main">
              @yield('dashboard-body')
             
            </div>
          </div>
          @include('frontend.user.partials.dashboard-sidebar')

          <div class="col-md-8">

          </div>


        </div>
      </div>
    </div>
  </main>
@endsection