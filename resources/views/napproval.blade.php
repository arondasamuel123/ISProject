@extends('layouts.app')

@section('content')
<div class="container">
        {{ csrf_field() }}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Approval</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Please wait as your account is approved. You will recieve an email once you have been approved.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
