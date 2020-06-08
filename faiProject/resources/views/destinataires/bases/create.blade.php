@extends('layouts.app')

@section('content')
    <div class="header bg-gradient-danger pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
              <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">Create a new base</div>
                    @if(session()->has('success'))
                      <div class="alert alert-success m-0" role="alert">
                        {{ session()->get('success') }}
                      </div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('base.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label for="basename">Base name</label>
                              <input type="text" class="form-control" id="basename" aria-describedby="baseHelp" name='name'>
                              <small id="baseHelp" class="form-text text-muted">It is better not to use space but to use '_'</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
@endsection
