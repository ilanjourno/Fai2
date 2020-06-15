@extends('layouts.app')
<script src="{{asset('js/destinataires.js')}}"></script>

@section('content')
@include('layouts.headers.destinataires.header', [
        'title' => __('Les emails'),
        'description' => __("Bienvenue sur la page de création de mails. Tu peux importer un fichier valide de mails dans une base"),
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
                        <form action="{{route('liste.upload')}}" method="post" class="form-horizontal" enctype="multipart/form-data" id='myForm'>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Choisi ta base</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="base" required>
                                    @foreach ($bases as $base)
                                        <option>{{$base->name}}</option>
                                    @endforeach
                                </select>
                                <small> <a href="{{route('base.create')}}">Créer une base</a></small>
                            </div>
                            <div class="form-group">
                                <label for="file">Choisir son fichier</label>
                                <input type="file" class="form-control-file" id="file" name="file" required>
                            </div>
                            <button type="button" class='btn btn-primary d-flex align-items-center justify-content-center' id='sendButton'><i class="fa fa-spinner fa-spin" id="loader" style="display:none;margin-right:8px;"></i>Envoyer</button>
                            <button type="submit" class="d-none" id='submitButton'></button>
                            <div class="progress mt-4" style="height: 20px;">
                                <div class="progress-bar progress-bar-striped" id='progress-bar' role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @include('layouts.footers.auth')
@endsection

  