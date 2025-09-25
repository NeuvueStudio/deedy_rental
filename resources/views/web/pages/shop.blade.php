@extends('web.layout.home')

@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/web/home" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop <span></span>
            </div>
        </div>
    </div>
    <section class="section-padding">
        <div class="container">
            <div class="text-left mb-4">
                <h3>Shop</h3>
                <p>Checkout our huge collection of products</p>
            </div>
        </div>
    </section>
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-sm-12">
                <div class="row product-grid">
                    @include('web.parts.product-loop', ['products' => $products, 'formattedPrices' => $formattedPrices ?? []])
                </div>
                <!--product grid-->
                <!-- Custom pagination (your HTML) -->
                @include('web.parts.paginate', ['products' => $products])
                <!--product grid-->
            </div>
        </div>
    </div>
@endsection
