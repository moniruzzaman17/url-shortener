<div class="div row m-auto justify-content-center mt-4 w-100">
    <h5 class="w-100 text-center">Hello! <strong>{{ Auth::user()->name }}</strong>, Welcome to STEADfast URL Shortener</h5>
    <div class="col-6 col-md-6">
        <div class="card cards mt-4 text-center">
            <div class="card-body">
                <h2 class="dashboard card-title" style="color: #F36D39"><i class="fas fa-link fs-20"></i>&nbsp;{{  Auth::user()->urls->count() }}</h2>
                <span>Total Url</span>
            </div>
        </div>
    </div>
</div>
<div id="clickHistory">
    @if ($userUrls->count())
    <div class="row m-auto justify-content-center mt-2 mb-4 w-100">
        @forelse($userUrls as $url)
            <div class="col-6 col-md-3">
                <div class="card cards mt-4 text-center clickCard" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $url->original_url }}" short-url="{{ url($url->short_url) }}">
                    <div class="card-body">
                        <h2 class="dashboard card-title" style="color: #F36D39">{{ $url->click_count }}&nbsp;<i class="fas fa-mouse fs-20"></i></h2>
                        <sup>{{ $url->short_url }}</sup>
                    </div>
                    <a href="javascript:void(0)" id="deleteUrl" data="{{ $url->id }}"><i class="fas fa-times text-danger"></i></a>
                    <a href="javascript:void(0)" id="regenerateUrl" data="{{ $url->id }}"><i class="fas fa-redo-alt text-success"></i></a>
                    <a href="javascript:void(0)" id="copyUrl" data="{{ url($url->short_url) }}"><i class="fas fa-copy text-info"></i></a>
                </div>
            </div>
            @empty
            <p class="mt-5 text-center">No shortened URLs available.</p>
        @endforelse
    </div>
    @if($userUrls->count() == 6)
    <a href="" class="btn w-100 mt-3 mb-4" style="background-color: #F36D39; color: #fff"> See More</a>   
    @endif
    @endif
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            // SweetAlert for displaying URL info when clicking on a card
            $(document).on('click', '.clickCard', function (e) {
                e.preventDefault();

                // Get the original and short URLs from the clicked card
                let originalUrl = $(this).attr('title');  // The original URL from the tooltip
                let shortUrl = $(this).attr('short-url');  // The short URL from the <sup> tag

                // Show SweetAlert with the URL information
                Swal.fire({
                    title: 'URL Information',
                    html: `<p><strong>Original URL:</strong> <a href="${originalUrl}" target="_blank">${originalUrl}</a></p>
                        <p><strong>Shortened URL:</strong> <a href="${shortUrl}" target="_blank">${shortUrl}</a></p>`,
                    icon: 'info',
                    showCloseButton: true,
                    showConfirmButton: false
                });
            });
        });
    </script>
@endpush