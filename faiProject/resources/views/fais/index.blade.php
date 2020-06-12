@extends('layouts.app')

@section('content')
@include('layouts.headers.fais.header', [
        'title' => __("The Fai's"),
        'description' => __("This is the Fai's page. You can see all available Fai's you made and his domains"),
        'class' => 'col-lg-9'
    ])    
     <div class="container-fluid mt--7">
        <div class="row">
            <div class="col order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Here is a list of available fais') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
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
    @include('layouts.footers.auth')
@endsection
