@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
               
               
                         <div class=" row">
                             <a class="btn btn-primary btn-lg btn-block" href="{{route('SeparateFolder.Show')}}">File Manager </a> 
                         </div>
                        
                          <div class="row "style="padding-top:20px">
                              <a class="btn btn-primary btn-lg btn-block" href="#">User Manager</a> 
                          </div>
                    </div>      
            </div>
        </div>
    </div>
</div>
@endsection
