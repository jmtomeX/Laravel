@extends('layouts.intranet')

@section('section_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! 
                    <p>Role User: @if (Auth::user()->hasRole('admin')) Yes @else No @endif</p>
                    <p>Role User: @if (Auth::user()->hasRole('user')) Yes @else No @endif</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
