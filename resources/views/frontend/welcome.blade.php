@extends('frontend.layouts.app')
@section('content')
<div class="container-fluid front-content-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-5 mt-4">
            <h1 class="w-100 text-center form-title">STEADfast URL Shortener</h1>
            <div class="card shadow cards text-center" id="shortForm">
                <div class="card-body">
                    <h5 class="card-title">Paste the URL to be shortened</h5>
                    <form method="POST" id="shortenedForm" class="d-flex" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="input_url" id="url-input" placeholder="Enter the link here">
                        <div id="formbutton">
                            <input type="submit" value="Shorten URL">
                        </div>  
                    </form>
                    <p class="mt-3">STEADfast URL Shortener is a free tool to shorten URLs and generate short links</p>
                </div>
            </div>

            <div class="card shadow cards text-center" id="successDiv" style="display: none">
                <div class="card-body">
                    <h2 class="card-title">Here is your shortened URL</h2>
                    <div method="POST" id="shortenedForm" class="d-flex" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="input_url" id="shortURL">
                        <div id="formbutton">
                            <input type="submit" id="copyResult" value="Copy URL">
                        </div>  
                    </div>
                    <p class="mt-3"><strong>Your Long URL: </strong> <span id="longURL"></span></p>
                </div>
            </div>

            @guest
            <div class="card cards mt-5 text-center">
                <div class="card-body">
                    <h2 class="card-title">Want More Features? Become a member!</h2>
                    <a href="{{ route('register') }}" class="createAccountBtn">Create Account</a>
                </div>
            </div>
            @endguest

            @auth
                @include('frontend.partials.dashboard')
            @endauth
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('#shortenedForm').on('submit', function (e) {
            e.preventDefault();
            let input_url = $('#url-input').val();
            $.ajax({
                url: '{{ route("url.shorten") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    input_url: input_url
                },
                success: function (response) {
                    if (response.success) {
                        $('#shortForm').hide();
                        $('#successDiv').show();
                        $('#shortURL').val(response.short_url);
                        $('#longURL').text(response.long_url);
                        refreshClickHistory();
                        toastr.success('URL shortened successfully!');
                    } else {
                        toastr.error('Failed to shorten the URL.');
                    }
                },
                error: function (xhr) {
                    var res = xhr.responseJSON;
                    if (!res.success && res.errors) {
                        $.each(res.errors, function(field, messages) {
                            $('#' + field + 'Error').text(messages[0]);
                            toastr.error(messages[0]);
                        });
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
        });

        $('#copyResult').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation(); 
            let shortURL = $('#shortURL').val();
            navigator.clipboard.writeText(shortURL).then(function () {
                toastr.success('Short URL copied to clipboard!');
            }).catch(function (error) {
                toastr.error('Failed to copy URL.');
            });
        });

        $('#copyUrl').on('click', function (e) {
            e.preventDefault();
            let url = $(this).attr('data');
            navigator.clipboard.writeText(url).then(function () {
                toastr.success('Short URL copied to clipboard!');
            }).catch(function (error) {
                toastr.error('Failed to copy URL.');
            });
        });
    });
    
    // Delete URL
    $(document).on('click', '#deleteUrl', function (e) {
        e.preventDefault();
        e.stopPropagation(); 
        let urlId = $(this).attr('data');

        if (confirm('Are you sure you want to delete this URL?')) {
            $.ajax({
                url: '{{ route("url.delete", '') }}/' + urlId,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        refreshClickHistory();
                    }
                },
                error: function (xhr) {
                    toastr.error('Error deleting the URL. Please try again.');
                }
            });
        }
    });

    // Regenerate URL
    $(document).on('click', '#regenerateUrl', function (e) {
        e.preventDefault();
        e.stopPropagation(); 
        let urlId = $(this).attr('data');

        $.ajax({
            url: '{{ route("url.regenerate", '') }}/' + urlId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    toastr.success('URL regenerated successfully!');
                    refreshClickHistory();
                }
            },
            error: function (xhr) {
                toastr.error('Error regenerating the URL. Please try again.');
            }
        });
    });

    function refreshClickHistory() {
        jQuery.ajax({
            url: window.location.href,
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                jQuery('#clickHistory').html(jQuery(response).find('#clickHistory').html());
            }
        });
    }
</script>
@endpush
@endsection
