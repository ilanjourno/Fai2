@extends('layouts.app')

@section('content')
@include('layouts.headers.fais.header', [
        'title' => __("The Fai's"),
        'description' => __("This is create Fai page. You can create an Fai and his domains. To create many domains you juste have to put comma between them"),
        'class' => 'col-lg-9'
    ])    
     <div class="container-fluid mt--7">
        <div class="row">
            <div class="col order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Create your Fai !') }}</h3>
                        </div>
                        @if(session()->has('success'))
                          <div class="alert alert-success m-0" role="alert">
                            {{ session()->get('success') }}
                          </div>
                        @endif
                    </div>
                    <div class="card-body">
                      <form method="POST" action="/fais">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="basename">Fai name</label>
                          <input type="text" class="form-control" id="basename" aria-describedby="baseHelp" name='name'>
                        </div>
                        <div class="form-group">
                            <label for="domain">Domains (seperate domains by a comma)</label>
                            <input type="text" class="form-control" id="domain" name="domains" aria-describedby="domainHelp">
                            <small id="domainHelp" class="form-text text-muted">You just have to make ',' between each domain to create many domains</small>
                        </div>
                        <button type="submit" class='btn btn-primary'>Create list</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    @include('layouts.footers.auth')
@endsection