@extends('layouts.app')
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
  @endpush
