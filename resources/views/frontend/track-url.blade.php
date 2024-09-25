@extends('frontend.layouts.app')
@section('content')
@php
if (request('shorten_url')){
    $class = "d-none";
}
else{
    $class = "";
}
@endphp
<div class="container-fluid front-content-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-5 mt-4">
            <h1 class="w-100 text-center form-title">URL Click Counter</h1>
            <div class="card shadow cards text-center {{ $class }}" id="shortForm">
                <div class="card-body">
                    <form method="POST" id="trackUrlForm" class="d-flex" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="input_url" id="url-input" placeholder="Enter here your shortened URL">
                        <div id="formbutton">
                            <input type="submit" value="Track Clicks">
                        </div>  
                    </form>
                    <p class="mt-3">Example: {{ url('/abc123') }}</p>
                </div>
            </div>
            <div class="card cards text-center mt-5" id="resultDiv" {{ $class?'style="display: none"':'' }}>
                <div class="card-body">
                    <h5>Short URL: {{ $short_url }}</h5>
                        <h2 class="dashboard card-title" style="color: #F36D39"><i class="fas fa-mouse fs-20"></i>&nbsp;{{ $click_count }}</h2>
                        <span>Total Click</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#trackUrlForm').on('submit', function (e) {
                e.preventDefault();

                let input_url = $('#url-input').val();

                $.ajax({
                    url: '{{ route("url.trackClicks") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        input_url: input_url 
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#resultDiv').show();
                            $('#resultDiv h5').text('Short URL: ' + response.short_url);
                            $('#resultDiv .card-title').html('<i class="fas fa-mouse fs-20"></i>&nbsp;' + response.click_count);
                        }
                    },
                    error: function (xhr) {
                        var res = xhr.responseJSON;
                        if (res && res.message) {
                            toastr.error(res.message);
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endpush
@endsection
