@extends('layouts.app')

@section('content')
    <div class="header bg-gradient-danger pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
              <div class="d-flex justify-content-center align-items-center flex-center position-ref full-height text-center">
                  <div class="content w-50 text-white">
                      <h1 class="text-white">Here's a list of available bases</h1>
                      <h5 class="text-white">Maximum 3 emails are display</h5>
                      <table border='1' class="w-100">
                          <thead>
                              <th>Base</th>
                              <th>Emails</th>
                          </thead>
                          <tbody>
                              @foreach ($bases as $base)
                                  <tr>
                                      <td>
                                      <a href='/destinataire/{{$base->name}}'>{{ $base->name }}</a>
                                      </td>
                                      <td>
                                          @foreach ($destinataires->where('listes.base_id', $base->id)->get('destinataires.email')->take(3)->toArray() as $emails)
                                            {{$loop->first ? '' : ', '}}
                                              @foreach ($emails as $email)
                                                  {{$email}}
                                              @endforeach
                                          @endforeach
                                      </td>

                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                      <div class="btn-group my-3" role="group" aria-label="Basic example">
                          <a class="btn btn-primary text-light" href="/liste">Create a list</a>
                          <a class="btn btn-primary text-light" href="/base/create">Create a base</a>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
@endsection
