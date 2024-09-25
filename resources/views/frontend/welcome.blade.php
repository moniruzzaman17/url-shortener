@extends('frontend.layouts.app')
@section('content')
<div class="container-fluid front-content-wrapper">
  <div class="row justify-content-center">
        <div class="col-md-5 mt-4">
            <h1 class="w-100 text-center form-title">STEADfast URL Shortener</h1>
            <div class="card shadow cards text-center">
                <div class="card-body">
                    <h2 class="card-title">Paste the URL to be shortened</h2>
                    <form action="" class="d-flex">
                        <input type="text" id="url-input" placeholder="Enter the link here">
                        <div id="formbutton">
                            <input type="submit" value="Shorten URL">
                        </div>  
                    </form>
                    <p class="mt-3">STEADfast URL Shortener is a free tool to shorten URLs and generate short links</p>
                <div class="info-wrapper">
                    
                </div>
                </div>
            </div>
            <div class="card cards mt-5 text-center">
                <div class="card-body">
                    <h2 class="card-title">Want More Features? Become a member!</h2>
                    <a href="{{ route('register') }}" class="createAccountBtn">Create Account</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
