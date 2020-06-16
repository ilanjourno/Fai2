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
                        <div class="alert alert-success" role="alert" id="alert" style='display:none'>
                            Ton fichier a correctement été télécharger
                        </div>
                        <form action="" method="post" enctype="multipart/form-data" id='myForm'>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="file">Choisir son fichier</label>
                                <input type="file" class="form-control-file" id="file" name="file" required>
                            </div>
                            <div class="form-group d-flex">
                                <i class="fa fa-spinner fa-spin" id='loader' style="display:none;margin-right:8px;"></i>
                                <button type="button" class='btn btn-primary align-items-center justify-content-center' id='hashButton' style='display:none'></button>
                                <button type="button" class='btn btn-primary d-flex align-items-center justify-content-center' id='emailsButton'></i>Emails</button>
                            </div>
                            <div class="progress mt-4" style="height: 20px;">
                                <div class="progress-bar progress-bar-striped" id='progress-bar' role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="http://cdn.jsdelivr.net/g/filesaver.js"></script>
<script src="{{asset('js/sha.js')}}"></script>
@endsection