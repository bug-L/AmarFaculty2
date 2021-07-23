@extends('layouts.app')

@section('title', 'Admin Home - ')

@section('content')
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

                    You are logged in!<br>
                    <h5>Admin actions:</h5>
                    <ul>
                        <li><a href='/reviews/approve'>Approve Reviews</a></li>
                        <li><a href='/professors/approve'>Approve Professors</a></li>
                        <li><a href='/professors'>View all Professors</a></li>
                        <li><a href='/reviews'>View all Reviews</a></li>
                        <li><a href='/universities'>View all Universities</a></li>
                        <li><a href='/departments'>View all departments</a></li>
                        <li><a href='/universities/create'>Create New University</a></li>
                        <li><a href='/departments/create'>Create New Department</a></li>
                        <li><a href='/professors/masscreation'>Mass Create Professors</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection
