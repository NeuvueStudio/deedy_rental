@extends('web.layout.home')
@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Category <span></span> {{ $category->name }}

            </div>
            <div class="category-list">
                <ul>
                    @foreach($mainCategories as $cat)
                    <li>
                        <a href="{{ route('catgory.page.index', ['name' => $cat->name]) }}">{{ $cat->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <section class="popular-categories section-padding mb-50">
        <div class="container wow animate__animated animate__fadeIn">
            <div class="sec-title mb-4">
                <h3 style="text-align: center;" class="underline-heading">Choose by {{ $category->name }}</h3>
            </div>

            <div class="row">
                @foreach ($subCategories as $subCategory)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 text-center border-0 shadow-sm">
                            <figure class="img-hover-scale overflow-hidden">
                                <img src="{{ asset($subCategory->category_image) }}" class="card-img-top img-fluid"
                                    alt="{{ $category->name }}" style="height: 300px; object-fit: cover;">
                            </figure>
                            <div class="card-body">
                                <h5 class="card-title">{{ $subCategory->name }}</h5>
                                <div class="mb-10 card-count">
                                    <p>Total ({{ $subCategoriesCount[$subCategory->name] }}) {{ $subCategory->name }}</p>
                                </div>
                                <a href="{{ route('catgory.page.products', ['name' => $category->name, 'subcategory' => $subCategory->name]) }}" class="btn btn-sm btn-primary">View Products</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-padding pb-5 background-color">
        <div class="container">
            <div class="section-title wow animate__animated animate__fadeIn">
                <h3 class="">Popular Products in {{ $category->name }}</h3>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                    <div class="tab-content" id="myTabContent-1">
                        <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                            <div class="carausel-4-columns-cover arrow-center position-relative">
                                <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                    id="carausel-4-columns-arrows"></div>

                                <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                    @forelse ($products as $product)
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img"
                                                            src="{{ asset('upload/product_images') . '/' . $product->image_name }}"
                                                            alt="" />
                                                    </a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Trending</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">{{ $product->category }}</a>
                                                </div>
                                                <h2>
                                                    <a href="shop-product-right.html">{{ $product->product_name }}</a>
                                                </h2>
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 80%"></div>
                                                </div>
                                                <div class="product-price mt-10">
                                                    @if (isset($formattedPrices[$product['id']]))
                                                        <span>{{ $formattedPrices[$product['id']] }}</span>
                                                    @else
                                                        Price not available
                                                    @endif
                                                </div>
                                                <div class="sold mt-15 mb-15">
                                                    <div class="progress mb-5">
                                                        <div class="progress-bar" role="progressbar" style="width: 50%"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="font-xs text-heading">
                                                        Sold: 90/120</span>
                                                </div>
                                                <form method="POST" class="add-to-cart-form" action="{{ route('cart.add') }}">
                                                    @csrf
                                                        <a href="{{ route('shop.product_detail', $product->id) }}" class="btn w-100">Buy Now</a>
                                                        {{-- <button type="submit" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a> --}}
                                                    </form>
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
@endsection
