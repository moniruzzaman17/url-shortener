@extends('frontend.layouts.app')
@section('content')
<div class="navbar-wrapper w-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex flex-column">
                <img src="{{ asset('images/logo.png') }}" class="w-100" alt=""> 
                <span class="text-center fs-14">URL Shortener</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse justify-content-end text-center" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="" class="btn btn-outline-success"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</a>
                    </li>
                    <li class="nav-item ms-md-2 mt-2 mt-md-0">
                        <a href="" class="btn btn-outline-success"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>
</div>
@endsection
