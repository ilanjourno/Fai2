@extends('layouts.app')

@section('content')
    <div class="header bg-gradient-danger pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
              <div class="d-flex justify-content-center align-items-center flex-center position-ref full-height">
                <div class="content d-flex justify-content-center flex-column w-50">
                    <a href="/fais">
                        <i class="fas fa-chevron-left text-primary"></i> Return
                    </a>
                    <h1 class="text-center text-white">Here's a list of {{$fai}} domain</h1>
                    <div class="list-group">

                        @foreach ($domains as $domain)
                            <div class="list-group-item list-group-item-action d-flex justify-content-between">
                                <a href="https://{{$domain->domains}} "target="_blank">
                                    {{$domain->domains}}
                                </a>
                                <div>
                                    <i class="fas fa-edit text-primary" role="button" data-toggle="modal" data-target="#edit{{$domain->id}}Modal"></i>
                                    <i class="fas fa-trash ml-2 text-danger" role="button" data-toggle="modal" data-target="#delete{{$domain->id}}Modal"></i>
                                </div>
                            </div>
                            <form action="{{ route('domains.update', $domain->id) }}" method="post">
                            @csrf
                            @method('put')

                                <div class="modal fade" id="edit{{$domain->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="edit{{$domain->id}}ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="edit{{$domain->id}}ModalLabel">Edit {{$domain->domains}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="faiName" value="{{$fai}}">
                                                <input class="form-control" type="text" value="{{$domain->domains}}" name="domains">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('domains.delete', $domain->id) }}" method="post">
                            @csrf
                            @method('delete')

                                <div class="modal fade" id="delete{{$domain->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="delete{{$domain->id}}ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger" id="delete{{$domain->id}}ModalLabel">Delete {{$domain->domains}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-danger">
                                                <input type="hidden" name="faiName" value="{{$fai}}">
                                                WARNING ! You will delete {{$domain->domains}} domain !
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

                    <form action="/fais/{{$fai}}" method="post">
                        @method('delete')
                        @csrf
                        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#deleteFaisModal">
                            Delete {{$fai}}
                        </button>

                        <div class="modal fade" id="deleteFaisModal" tabindex="-1" role="dialog" aria-labelledby="deleteFaisModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="deleteFaisModalLabel">Delete {{$fai}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-danger">
                                        WARNING ! You will delete {{$fai}} fai !
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
