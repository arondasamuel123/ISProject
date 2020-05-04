@extends('layouts.app')

@section('content')
<div class="container">
        {{ csrf_field() }}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">PAYMENT COMPLETE</div>
                 
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Thank you for using Student Gigs. Your payment has been made.

                    <br>
                    <br>
                    <a href="/gigs" class="btn btn-success">Click here to create another gig</a> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection