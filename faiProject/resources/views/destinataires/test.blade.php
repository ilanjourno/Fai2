@extends('layouts.app')

@section('content')
@include('layouts.headers.destinataires.header', [
        'title' => __("The addressees page"),
        'description' => __("This is the create addressees page. You can import many addressees with a file who got millions emails address"),
        'class' => 'col-lg-11'
    ])    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-body">
                        <div class="alert alert-success" role="alert" id="alert" style='display:none'>
                            Your file is load successfully
                        </div>
                        <form action="{{route('liste.upload')}}" method="post" class="form-horizontal" enctype="multipart/form-data" id='myForm'>
                            {{ csrf_field() }}
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @include('layouts.footers.auth')
@endsection

  