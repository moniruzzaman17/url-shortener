<div id="clickHistory">
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
    @if ($userUrls->count())
    <div class="row m-auto justify-content-center mt-2 mb-4 w-100">
        @forelse($userUrls as $url)
            <div class="col-6 col-md-3">
                <div class="card cards mt-4 text-center clickCard" data-bs-toggle="tooltip" data-created-at="{{ $url->created_at->format('d M Y h:i A') }}"  data-bs-placement="top" title="{{ $url->original_url }}" short-url="{{ url($url->short_url) }}">
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
            $(document).on('click', '.clickCard', function (e) {
                e.preventDefault();
                let originalUrl = $(this).attr('title');
                let shortUrl = $(this).attr('short-url');
                let createdAt = $(this).data('created-at');
                Swal.fire({
                    title: 'URL Information',
                    html: `
                        <p><strong>Original URL:</strong> <a href="${originalUrl}" target="_blank">${originalUrl}</a></p>
                        <p><strong>Shortened URL:</strong> <a href="${shortUrl}" target="_blank">${shortUrl}</a></p>
                        <p><strong>Created At:</strong> ${createdAt}</p>
                    `,
                    icon: 'info',
                    showCloseButton: true,
                    showConfirmButton: false
                });
            });
        });
    </script>
@endpush