@extends('web.layout.home')

@section('content')
    <section class="home-slider position-relative mb-30">
        <div class="container">
            <div class="home-slide-cover mt-30">
                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                    <div class="single-hero-slider single-animation-wrap"
                        style="background-image: url('{{ asset($banner->meta_value) }}')">
                    </div>
                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
            </div>
        </div>
    </section>

    {{-- <section class="home-slider position-relative mb-50">
        <div class="home-slide-cover">
            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                <div class="single-hero-slider rectangle single-animation-wrap"
                    style="background-image: url('{{ asset($banner->meta_value) }}')">
                </div>
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </div>
    </section> --}}

    <div class="container">
        <div class="sec-title mb-4">
            <h3 style="text-align: center;">Featured Categories</h3>
        </div>
        <div class="row my-2">
            @foreach ($mainCategories->where('status', 'Active') as $category)
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-3">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <figure class="img-hover-scale overflow-hidden">
                            <img src="{{ asset($category->category_image) }}" class="card-img-top img-fluid"
                                alt="{{ $category->name }}" style="height: 300px; object-fit: cover;">
                        </figure>
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <div class="mb-10 card-count">
                                <p>Total ({{ $subCategoriesCount[$category->name] }}) {{ $category->name }}</p>
                            </div>
                            <a href="{{ route('catgory.page.index', ['name' => $category->name]) }}"
                                class="btn btn-sm btn-primary">View Products</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            @foreach ($mainCategories->where('status', '!=', 'Active') as $category)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                    <div class="card h-100 text-center border-0 shadow-sm position-relative" style="pointer-events: none;">
                        <div class="position-relative">
                            <figure class="img-hover-scale overflow-hidden">
                                <img src="{{ asset($category->category_image) }}" class="card-img-top img-fluid"
                                    alt="{{ $category->name }}" style="height: 300px; object-fit: cover;">
                            </figure>
                            <div class="coming_soon_btn">
                                Coming Soon
                            </div>
                        </div>
                        <!-- Ribbon -->

                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <div class="mb-10 card-count">
                                <p>Total ({{ $subCategoriesCount[$category->name] }}) {{ $category->name }}</p>
                            </div>
                            <a href="#" class="btn btn-sm btn-secondary disabled">Coming Soon</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--End category slider-->

    <section class="pb-5 background-color section-padding-custom">
        <div class="container">
            <div class="section-title wow animate__animated animate__fadeIn">
                <h3 class="">Popular Products</h3>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                    <div class="tab-content" id="myTabContent-1">
                        <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                            <div class="carausel-4-columns-cover arrow-center position-relative">
                                <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                    id="carausel-4-columns-arrows"></div>

                                <div class="carausel-4-columns carausel-arrow-center row" id="carausel-4-columns">
                                    @forelse ($products as $product)
                                        <div class="product-cart-wrap col-12 col-sm-4 col-md-4 col-lg-3">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{ route('shop.product_detail', $product->id) }}">
                                                        <img class="default-img"
                                                            src="{{ asset('upload/product_images') . '/' . $product->image_name }}"
                                                            alt="" />
                                                    </a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">New</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap p-4">
                                                <h2 class="product-title-border-bottom">
                                                    <a
                                                        href="{{ route('shop.product_detail', $product->id) }}">{{ $product->product_name }}</a>
                                                </h2>
                                                <div class="product-card-bottom">
                                                    <div class="product-price mt-10">
                                                        @if (isset($formattedPrices[$product['id']]))
                                                            <span>{{ $formattedPrices[$product['id']] }}</span>
                                                        @else
                                                            Price not available
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="product-img-action-wrap">
                                            <p> There is no popular product
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--End tab-content-->
                </div>
                <!--End Col-lg-9-->
            </div>
        </div>
    </section>
    <section class="text-center mt-50 ">
        <h2 class="title style-3 mb-40">What We Provide?</h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 mb-24">
                    <div class="featured-card">
                        <img src="/web/imgs/theme/icons/icon-1.svg" alt="" />
                        <h4>Best Prices & Offers</h4>
                        <p>
                            There are many variations of passages of Lorem Ipsum
                            available, but the majority have suffered alteration in
                            some form
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 mb-24">
                    <div class="featured-card">
                        <img src="/web/imgs/theme/icons/icon-2.svg" alt="" />
                        <h4>Wide Assortment</h4>
                        <p>
                            There are many variations of passages of Lorem Ipsum
                            available, but the majority have suffered alteration in
                            some form
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 mb-24">
                    <div class="featured-card">
                        <img src="/web/imgs/theme/icons/icon-3.svg" alt="" />
                        <h4>Free Delivery</h4>
                        <p>
                            There are many variations of passages of Lorem Ipsum
                            available, but the majority have suffered alteration in
                            some form
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-24">
                    <div class="featured-card">
                        <img src="/web/imgs/theme/icons/icon-4.svg" alt="" />
                        <h4>Easy Returns</h4>
                        <p>
                            There are many variations of passages of Lorem Ipsum
                            available, but the majority have suffered alteration in
                            some form
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-24">
                    <div class="featured-card">
                        <img src="/web/imgs/theme/icons/icon-5.svg" alt="" />
                        <h4>100% Satisfaction</h4>
                        <p>
                            There are many variations of passages of Lorem Ipsum
                            available, but the majority have suffered alteration in
                            some form
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-24">
                    <div class="featured-card">
                        <img src="/web/imgs/theme/icons/icon-6.svg" alt="" />
                        <h4>Great Daily Deal</h4>
                        <p>
                            There are many variations of passages of Lorem Ipsum
                            available, but the majority have suffered alteration in
                            some form
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>
  
@endsection
