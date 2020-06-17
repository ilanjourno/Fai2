@extends('layouts.app')
@section('js')
  <link rel="stylesheet" type="text/css" href="{{asset('semantic/semantic.min.css')}}">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="{{asset('semantic/semantic.min.js')}}"></script>
  <script src="http://cdn.jsdelivr.net/g/filesaver.js"></script>
  <style media="screen">
    .selection{
      margin: 10px 0;
    }
  </style>

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
                    <form action="{{route('base.export')}}" method="post" id="sendExport" class="form-horizontal" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                          <label for="exampleFormControlSelect1">Base à exporter</label>

                            <select class="ui fluid dropdown" id="exampleFormControlSelect1" name="base" required>
                                @foreach ($bases as $base)
                                    <option value="{{$base->id}}">{{$base->name}}</option>
                                @endforeach
                            </select>

                      </div>
                      <div class="custom-control custom-checkbox" style="margin:5px 0;">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="banBase">
                        <label class="custom-control-label" for="customCheck1">Exclure une base de l'exportaition</label>
                      </div>



                      <div class="baseselect">

                        <select name="skills" multiple="" id="select1" name="blacklistbase" class="ui fluid dropdown">
                          @foreach ($bases as $base)
                              <option value="{{$base->id}}">{{$base->name}}</option>
                          @endforeach
                        </select>

                      </div>

                      <div class="custom-control custom-checkbox" style="margin:5px 0;">
                        <input type="checkbox" class="custom-control-input" id="customCheck2"  name="banFAI">
                        <label class="custom-control-label" for="customCheck2">Exclure un FAI de l'exportaition</label>
                      </div>

                      <div class="faiselect">
                        <select name="skills" multiple="" id="select2" name="blacklistfai" class="ui fluid dropdown">
                          @foreach ($fais as $fais)
                              <option value="{{$fais->id}}">{{$fais->name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <button type="submit" style="margin-top:10px;" class="btn btn-primary"><i class="fas fa-download"></i>&nbsp;&nbsp;&nbsp;Exporter</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
          $('#select1').dropdown();
          $('#select2').dropdown();
          $('#exampleFormControlSelect1').dropdown();
          $('.baseselect').fadeOut();
          $('.faiselect').fadeOut();
          $('#customCheck1').click(function() {
            if (document.querySelector('#customCheck1').checked){
              $('.baseselect').fadeIn("slow")
            } else {
              $('.baseselect').fadeOut("slow");
            }
          })
          $('#customCheck2').click(function() {
            if (document.querySelector('#customCheck2').checked){
              $('.faiselect').fadeIn("slow")
            } else {
              $('.faiselect').fadeOut("slow");
            }
          })
          function getSelectValues(select) {
            var result = [];
            var options = select && select.options;
            var opt;

            for (var i=0, iLen=options.length; i<iLen; i++) {
              opt = options[i];

              if (opt.selected) {
                result.push(opt.value || opt.text);
              }
            }
            return result;
          }
          document.querySelector('#sendExport').addEventListener('submit', (ev) => {
            ev.preventDefault();
            console.log('send');
            const data = {
              baseName: document.querySelector('#exampleFormControlSelect1').value,
              baseBlacklistEnabled: document.querySelector('#customCheck1').checked,
              baseBlacklist: getSelectValues(document.querySelector('#select1')),
              FaiBlacklistEnabled: document.querySelector('#customCheck2').checked,
              FaiBlacklist: getSelectValues(document.querySelector('#select2')),
            };
            fetch('{{route("base.export")}}', {
              method: 'POST',
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
              body: JSON.stringify(data),
            })
            .then( (res) =>  {
                res.text()
                .then( (json) =>  {
                  console.log(JSON.parse(json));
                    var data = JSON.parse(json)
                    var content = "";
                    switch (data[0]) {
                      case 'direct':
                        content = JSON.stringify(data[1]).replace(/"|\[|\]/g, '').replace(/,/g, '\n')
                        break;
                      case "banBase":

                        break;
                      default:

                    }
                    console.log(content);
                    var blob = new Blob([content], {type: "text/plain;charset=utf-8"});
                    saveAs(blob, 'file.txt');
                })
            });
          })
        </script>
    @include('layouts.footers.auth')
@endsection
