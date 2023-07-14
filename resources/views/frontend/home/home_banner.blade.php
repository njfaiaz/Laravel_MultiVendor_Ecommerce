@php
    $banner = App\Models\Banner::orderBy('banner_title','ASC')->limit(3)->get();
@endphp

<section class="banners mb-25">
    <div class="container">
        <div class="row">
            @foreach ($banner as $banner)
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <img src="{{ asset($banner->banner_image) }}" alt="" />
                        <div class="banner-text">
                            <h4>
                                {{ $banner->banner_title }}
                            </h4>
                            <a href="{{ $banner->banner_url }}" class="btn btn-xs">Shop Now <i
                                    class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
