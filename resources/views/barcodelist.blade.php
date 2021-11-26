@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($numbers as $filename)
                    <img src="{{"data:image/png;base64," . DNS1D::getBarcodePNG($filename, $code_type,3,50,array(1,1,1), true)}}" />
                      <br>  <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
