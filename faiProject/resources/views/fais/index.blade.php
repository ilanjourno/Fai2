@extends('layouts.app')

@section('content')
    <div class="header bg-gradient-danger pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="d-flex justify-content-center align-items-center flex-center position-ref full-height">
                    <div class="content d-flex justify-content-center aign-items-center flex-column text-white text-center">
                        <h1 class="text-white">Here's a list of available fais</h1>
                        <h5 class="text-white">Maximum 3 fais are display</h5>
                        <table border='1' class="w-100">
                            <thead>
                                <th>Name</th>
                                <th>Domains</th>
                            </thead>
                            <tbody>
                                @foreach ($fais as $fai)
                                    <tr>
                                        <td>
                                            <a href='/fais/{{$fai->name}}'>
                                                {{ $fai->name }}
                                            </a>
                                        </td>
                                        <td>
                                            @foreach ($domains->where("fais_id", $fai->id)->take(3) as $domain)
                                                {{$loop->first ? '' : ', '}}
                                                {{$domain->domains}}
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="btn-group my-3" role="group">
                            <a class="btn btn-primary text-light" href="/fais/create">Create an Fai</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
@endsection
