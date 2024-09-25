<div id="clickHistory">
    @if ($userUrls->count())
    <div class="row m-auto justify-content-center mt-4 w-100">
        @forelse($userUrls as $url)
            <div class="col-sm-6 col-md-4">
                <div class="card cards mt-4 text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $url->original_url }}">
                    <div class="card-body">
                        <h2 class="dashboard card-title" style="color: #F36D39">{{ $url->click_count }}&nbsp;<i class="fas fa-mouse fs-20"></i></h2>
                        <sup>{{ $url->short_url }}</sup>
                    </div>
                </div>
            </div>
            @empty
            <p class="mt-5 text-center">No shortened URLs available.</p>
        @endforelse
    </div>
    {{ $userUrls->count() }}
    @if($userUrls->count() > 6)
    <a href="" class="btn w-100 mt-3 mb-4" style="background-color: #F36D39; color: #fff"> See More</a>   
    @endif
    @endif
</div>