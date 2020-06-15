@extends('layouts.app')
@section('content')
@include('layouts.headers.destinataires.header', [
        'title' => __("Export repoussoir"),
        'description' => __("Ceci est la page des emails. Tu peux voir tous les emails disponible dans une base"),
        'class' => 'col-lg-11'
    ])    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" id='myForm'>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="file">Choisir son fichier</label>
                                <input type="file" class="form-control-file" id="file" name="file" required>
                            </div>
                            <button type="button" class='btn btn-primary d-flex align-items-center justify-content-center' id='sendButton'><i class="fa fa-spinner fa-spin" id="loader" style="display:none;margin-right:8px;"></i>Export</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')

@endsection
@section('js')
<script src="http://cdn.jsdelivr.net/g/filesaver.js"></script>
<script src="{{asset('js/sha.js')}}"></script>
@endsection