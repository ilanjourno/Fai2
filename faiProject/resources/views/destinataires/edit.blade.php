@extends('layouts.app')

@section('content')
    <div class="header bg-gradient-danger pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="d-flex justify-content-center align-items-center flex-center position-ref full-height">
                    <div class="content d-flex justify-content-center flex-column w-50">
                        <a href="/destinataire">
                            <i class="fas fa-chevron-left text-white"></i> Return
                        </a>
                        <h1 class="text-white text-center">Here's a list of {{$baseName}}</h1>
                        <div class="list-group">
                        
                            @foreach ($destinataires as $destinataire)
                            
                                <div class="list-group-item list-group-item-action d-flex justify-content-between">
                                   
                                        {{$destinataire->email}}
                                    
                                    <div>
                                        <i class="fas fa-edit text-primary" role="button" data-toggle="modal" data-target="#edit{{$destinataire->id}}Modal"></i> 
                                        <i class="fas fa-trash ml-2 text-danger" role="button" data-toggle="modal" data-target="#delete{{$destinataire->id}}Modal"></i>
                                    </div>
                                </div>
                                <form action="/destinataire/{{$destinataire->id}}" method="post">
                                @method('put')
                                @csrf
                                    <div class="modal fade" id="edit{{$destinataire->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="edit{{$destinataire->id}}ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="edit{{$destinataire->id}}ModalLabel">Edit {{$destinataire->email}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="destiName" value="{{$baseName}}">
                                                    <input class="form-control" type="text" value="{{$destinataire->email}}" name="email">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="/destinataire/{{$destinataire->id}}" method="post">
                                @method('delete')
                                @csrf
                                    <div class="modal fade" id="delete{{$destinataire->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="delete{{$destinataire->id}}ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger" id="delete{{$destinataire->id}}ModalLabel">Delete {{$destinataire->email}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-danger">
                                                    <input type="hidden" name="destiname" value="{{$baseName}}">
                                                    WARNING ! You will delete {{$destinataire->email}} domain !
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                                  
                        <form action="{{route('base.delete', $baseName)}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#deleteBaseModalLabel">
                                Delete {{$baseName}}
                            </button>
            
                            <div type="button" class="modal fade" id="deleteBaseModalLabel" tabindex="-1" role="dialog" aria-labelledby="deleteBaseModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger" id="deleteBaseModalLabel">Delete {{$baseName}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-danger">
                                            WARNING ! You will delete {{$baseName}} fai !
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  @include('layouts.footers.auth')
@endsection
