@extends('layouts.app')
@section('js')
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  <!-- Latest compiled and minified JavaScript -->
  @endsection
@section('content')
@include('layouts.headers.destinataires.header', [
        'title' => __("Exporter une base"),
        'description' => __(""),
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
                          <label for="exampleFormControlSelect1">Base à exporter</label>
                          <select class="form-control" id="exampleFormControlSelect1" name="base" required>
                              @foreach ($bases as $base)
                                  <option>{{$base->name}}</option>
                              @endforeach
                          </select>
                      </div>
                      <p>Exclure une base de l'exportaition</p>



                      <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <label class="text-white mb-3 lead">Where do you live?</label>
                            <!-- Multiselect dropdown -->
                            <select multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="selectpicker w-100">
                                <option>United Kingdom</option>
                                <option>United States</option>
                                <option>France</option>
                                <option>Germany</option>
                                <option>Italy</option>
                            </select><!-- End -->
                        </div>
                    </div>
                      <p>Exclure un FAI de l'exportaition</p>
                      <button type="button" class="btn btn-success"><i style="font-size: 25px" class="fas fa-plus-square"></i></button>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i>&nbsp;&nbsp;&nbsp;Exporter</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    @include('layouts.footers.auth')
@endsection
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">

</script>
<script src="{{asset('js/export.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
