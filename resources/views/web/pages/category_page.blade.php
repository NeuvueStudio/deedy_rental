@extends('web.layout.home')

@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/web/home" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> {{ $name }} <span></span> {{ $category->name }}

            </div>
        </div>
    </div>
    <section class="section-padding">
        <div class="container">
            <div class="text-left mb-4">
                <h3>{{ $category->name }}s</h3>
                <p>Checkout our huge collection of {{ $category->name }}</p>
            </div>
        </div>
    </section>
    <section class="section-padding container">
        <div class="shop-product-fillter">
            <div class="sort-by-product-area">
                <div class="sort-by-cover mr-10">
                    <div class="sort-by-product-wrap">
                        <div class="sort-by">
                            <span><i class="fi-rs-apps"></i>Materials</span>
                        </div>
                        <div class="sort-by-dropdown-wrap">
                            <span> <i class="fi-rs-angle-small-down"></i></span>
                        </div>
                    </div>
                    <div class="sort-by-dropdown">
                        <ul>
                            @foreach($materials as $material)
                            <li><a href="{{ url()->current() }}?filter={{ urlencode($material->material_name) }}" class="material_filter" data-material="{{ $material->material_name }}">{{ $material->material_name }}</a></li>
                            @endforeach
                            <li><a href="{{ request()->url() }}">All</a></li>
                        </ul>
                    </div>
                </div>
                <div class="sort-by-cover mr-10">
                    <div class="sort-by-product-wrap">
                        <div class="sort-by">
                            <span><i class="fi-rs-apps"></i>Show:</span>
                        </div>
                        <div class="sort-by-dropdown-wrap">
                            <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                        </div>
                    </div>
                    <div class="sort-by-dropdown">
                        <ul>
                            <li><a class="active" href="#">50</a></li>
                            <li><a href="#">100</a></li>
                            <li><a href="#">150</a></li>
                            <li><a href="#">200</a></li>
                            <li><a href="#">All</a></li>
                        </ul>
                    </div>
                </div>
                <div class="sort-by-cover">
                    <div class="sort-by-product-wrap">
                        <div class="sort-by">
                            <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                        </div>
                        <div class="sort-by-dropdown-wrap">
                            <span>
                                Featured <i class="fi-rs-angle-small-down"></i></span>
                        </div>
                    </div>
                    <div class="sort-by-dropdown">
                        <ul>
                            <li><a class="active" href="#">Featured</a></li>
                            <li><a href="#">Price: Low to High</a></li>
                            <li><a href="#">Price: High to Low</a></li>
                            <li><a href="#">Release Date</a></li>
                            <li><a href="#">Avg. Rating</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="container mb-30 section-padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="row product-grid">
                    @include('web.parts.product-loop', ['products' => $products, 'formattedPrices' => $formattedPrices ?? []])
                </div>
                <!--product grid-->
                <!-- Custom pagination (your HTML) -->
                @include('web.parts.paginate', ['products' => $products])
            </div>
        </div>
    </div>
@endsection

