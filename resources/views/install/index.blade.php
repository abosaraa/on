@extends('layouts.install', ['no_header' => 1])
@section('title', 'Welcome - POS Installation')

@section('content')
<div class="container">
    
    <div class="row">
      <h3 class="text-center">{{ config('app.name', 'POS') }} Installation <small>Step 1 of 3</small></h3>

        <div class="col-md-8 col-md-offset-2">
          {{-- <hr/>
          @include('install.partials.nav', ['active' => 'install']) --}}

          <div class="box box-primary active">
            <!-- /.box-header -->
            <div class="card-body">
             
              
              <a href="{{route('install.details')}}" class="btn btn-primary text-center btn-big mr-5">next step</a>
            </div>
          <!-- /.box-body -->
          </div>

        </div>

    </div>
</div>
@endsection
