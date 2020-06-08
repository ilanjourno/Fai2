@extends('layouts.app')

@section('content')
    <div class="header bg-gradient-danger pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
              <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">Create a new list</div>
                    @if(session()->has('success'))
                      <div class="alert alert-success m-0" role="alert">
                        {{ session()->get('success') }}
                      </div>
                    @endif
                    <div class="card-body">
                      <form method="POST" action="/fais">
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="basename">Base name</label>
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
        </div>
    </div>
  @include('layouts.footers.auth')
@endsection
