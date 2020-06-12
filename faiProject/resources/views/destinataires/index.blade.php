{{-- @extends('layouts.app')
@section('content')
    <div class="header bg-gradient-danger pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
              <div class="d-flex justify-content-center align-items-center flex-center position-ref full-height text-center">
                  <div class="content w-50 text-white">
                      <h1 class="text-white">Here's a list of available bases</h1>
                      <h5 class="text-white">Maximum 3 emails are display</h5>
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                </tr>
                            </thead>
                        </table>
                      <div class="btn-group my-3" role="group" aria-label="Basic example">
                          <a class="btn btn-primary text-light" href="/destinataire/create">Create addressesses</a>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')

@stop
@push('scripts')
<script type="text/javascript">
    var data = [
      @foreach ($destinataires as $key => $value)
          {
              "email": "{{ $value->email }}",
          },
      @endforeach

    ]


    $(document).ready(function () {
        $('#example').DataTable({
            "processing": true,
            "info": true,
            "stateSave": true,
            data: data,
            "columns": [
                { "data": "email" },
            ]
        });
    });

  </script>
  @endpush --}}
@extends('layouts.app')


@section('content')
@include('layouts.headers.destinataires.header', [
        'title' => __("The addressees page"),
        'description' => __("This is the addressees page. You can see all available addressees you made sort by base."),
        'class' => 'col-lg-11'
    ])    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-body">
                        <div class="table-responsive overflow-hidden">
                            <table id="user_table" class="table table-bordered table-striped w-100">
                                <thead>
                                <tr>
                                    <th>Base</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="btn-group my-3" role="group">
                            <a class="btn btn-primary text-light" href="/destinataire/create">Create an addressee</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/zf/dt-1.10.21/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="{{asset('js/datatables.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
<script>
    $(document).ready(function(){ 
        $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('destinataire.index') }}",
            },
            columns: [
                {
                    "data": 'name',
                    "name": "bases.name",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/destinataire/' + data + '">' + data + '</a>';
                        }
                        return data;
                    }
                },
                
               
            ]
        });
    });
</script>
@endsection