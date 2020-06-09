@extends('layouts.app')
<script type="text/javascript" src="{{asset('js')}}/destinataires.js"></script>
@section('content')

    <div class="header bg-gradient-danger pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="alert alert-success" role="alert" id="alert" style='display:none'>
                    Your file is load successfully
                </div>
              <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">Create a new list</div>
                    <div class="card-body">
                        <form action="/liste/upload" method="post" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Choose you base</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="base">
                                    @foreach ($bases as $base)
                                        <option>{{$base->name}}</option>
                                    @endforeach
                                </select>
                                <small> <a href="{{route('base.create')}}">Create a base</a></small>
                            </div>
                            <div class="form-group">
                                <label for="file">Choose your file</label>
                                <input type="file" class="form-control-file" id="file" name="file">
                            </div>
                            <button type="submit" class='btn btn-primary d-flex align-items-center justify-content-center' id='sendButton'><i class="fa fa-spinner fa-spin" id="loader" style="display:none;margin-right:8px;"></i>Send</button>
                        </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
@endsection
