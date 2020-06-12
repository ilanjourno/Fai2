@extends('layouts.app')

@section('content')
@include('layouts.headers.destinataires.header', [
        'title' => __("The base page"),
        'description' => __("This is the create base page. You can create a base in order to import your addressees in an organized way"),
        'class' => 'col-lg-11'
    ])    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col order-xl-1">
                <div class="card bg-secondary shadow">
                  @if(session()->has('success'))
                  <div class="card-header">
                      <div class="alert alert-success m-0" role="alert">
                        {{ session()->get('success') }}
                      </div>
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
    @include('layouts.footers.auth')
@endsection
  