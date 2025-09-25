<header class="header-area header-style-1 header-height-2">
   <!--  <div class="mobile-promotion">
        <span>Grand opening, <strong>up to 15%</strong> off all items. Only
            <strong>3 days</strong> left</span>
    </div> -->

    <div class="header-middle d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-1">
                    <div class="logo p-2 ps-0 text-center">
                        <a href="https://deedy.in/"><img src="/web/imgs/deedylogo.png" alt="logo" /></a>
                    </div>
                </div>

                <div class="col-10 col-md-10 align-self-center">
                    <div class="header-right d-flex">
                        <div class="search-popup w-100">
                            <form action="{{ route('shop.index') }}" method="GET">
                                {{-- <select class="select-active" name="category">
                                    <option>All Categories</option>
                                    @foreach ($mainCategories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select> --}}
                                <input  class="border-0 form-control" type="text" placeholder="Search for items..." value="{{ request('search') }}"
                                    name="search" id="searchInput" autocomplete="off" />
                                {{-- <button type="submit" class="btn-brand"><i class="fi-rs-search"></i></button> --}}
                            </form>
                        </div>
                    </div>
                </div>
              
                <div class="col-2 col-md-1 align-self-center">
                    <!-- <div class="header-action-right"> -->
                            <div class="header-action-2">
                              <!--   <div class="header-action-icon-2">
                                    {{-- <a href="shop-compare.html">
                                        <img class="svgInject" alt="Deedy"
                                            src="/web/imgs/theme/icons/icon-compare.svg" />
                                        <span class="pro-count blue">3</span>
                                    </a>
                                    <a href="shop-compare.html"><span class="lable ml-0">Compare</span></a> --}}
                                </div>
                                <div class="header-action-icon-2">
                                    {{-- <a href="shop-wishlist.html">
                                        <img class="svgInject" alt="Deedy" src="/web/imgs/theme/icons/icon-heart.svg" />
                                        <span class="pro-count blue">6</span>
                                    </a>
                                    <a href="shop-wishlist.html"><span class="lable">Wishlist</span></a> --}}
                                </div> -->
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{ route('cart.view') }}">
                                        <img alt="Deedy" src="/web/imgs/theme/icons/icon-cart.svg" />
                                        <span class="pro-count blue">{{ count($items ?? []) }}</span>
                                    </a>
                                    <a href="{{ route('cart.view') }}"><span class="lable">Cart</span></a>

                                    <div class="cart-dropdown-wrap cart-dropdown-hm2" style="width: 400px;">
                                       @php $subtotal = 0; @endphp
                                        @if (count($items ?? []) > 0)
                                            <ul style="max-height: 300px; overflow-y: auto;">
                                                @foreach ($items as $item)
                                                    @php
                                                        $itemSubtotal = $item->price * $item->quantity; 
                    									$subtotal += $itemSubtotal;
                									@endphp
                                              
                                                    <li class="d-flex align-items-start mb-2">
                                                        <div class="shopping-cart-img" style="flex-shrink: 0;">
                                                            <a
                                                                href="{{ route('shop.product_detail', $item->product->id) }}">
                                                                <img alt="{{ $item->product->product_name }}"
                                                                    src="{{ asset('upload/product_images/' . $item->product->image_name) }}"
                                                                    style="width: 70px; height: 70px; object-fit: cover; border-radius: 4px;" />
                                                            </a>
                                                        </div>
                                                        <div class="shopping-cart-title ms-3">
                                                            <h6 class="mb-1" style="font-size: 14px; font-weight: 600;">
                                                                <a
                                                                    href="{{ route('shop.product_detail', $item->product->id) }}">
                                                                    {{ $item->product->product_name }}
                                                                </a>
                                                            </h6>
                                                            <p style="font-size: 13px;">
                                                                <span>{{ $item->quantity }} × ₹{{  number_format($item->price, 2) }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="shopping-cart-delete ms-auto">
                                                            <a href="javascript:void(0);" data-id="{{ $item->id }}" class="remove-cart-item"><i class="fi-rs-cross-small"></i></a>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-center my-3">Your cart is empty.</p>
                                        @endif

                                        <div class="shopping-cart-footer pt-3 mt-3">
                                            <div class="shopping-cart-total d-flex justify-content-between">
                                                <h4>Total</h4>
                                              
                                                <h4>₹{{ number_format($subtotal, 2) }}</h4>
                                            </div>
                                            <div class="shopping-cart-button mt-3">
                                                <a href="{{ route('cart.view') }}" class="w-100 text-center">View
                                                    Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="header-action-icon-2">
                                    <a href="page-account.html">
                                        <img class="svgInject" alt="Deedy" src="/web/imgs/theme/icons/icon-user.svg" />
                                    </a>
                                    <a href="page-account.html"><span class="lable ml-0">Sign In</span></a>
                                </div> --}}
                            </div>
                        <!-- </div> -->
                </div>
            </div>

                        <!-- Popup Search bar -->
                        <div class="row col-12 mt-md-0 mt-2">
                            <div id="searchPopup" style="display: none;">
                                <!-- <div class="card shadow rounded p-3" style="position: absolute; top: 80px; left:12%; z-index: 999; width: 900px"> -->
                                <div class="card shadow rounded p-3 position-absolute z-1">
                                    <div>
                                        <h5 class="mb-20">Popular Searches</h5>
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            @foreach ($popularSearch as $popular)
                                                <span class="badge bg-light text-dark popular_search" style="cursor:pointer;"
                                                    data-query="{{ $popular }}">{{ $popular }}</span>
                                            @endforeach
                                            <!-- Add more -->
                                        </div>
                                    </div>

                                    <div>
                                        <h5 class="mb-20">Recent Searches</h5>
                                        <div class="d-flex flex-wrap gap-2 mb-3" id="recentSearchContainer">
                                            <!-- Add more -->
                                        </div>
                                    </div>

                                    <h5 class="mt-3 mb-25">Top Selling Products</h5>
                                    <div class="row product-grid">
                                        @forelse($productsForHeader as $product)
                                            <div class="col-sm-4 col-12">
                                                <div class="product-cart-wrap mb-30">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom product-header-list">
                                                            <a href="{{ route('shop.product_detail', $product->id) }}">
                                                                <img class="default-img"
                                                                    src="{{ asset('upload/product_images') . '/' . $product->image_name }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="product-badges product-badges-position product-badges-mrg">
                                                            <span class="hot">Hot</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <div class="product-category">
                                                            <a href="shop-grid-right.html">{{ $product->category }}</a>
                                                        </div>
                                                        <h2><a
                                                                href="{{ route('shop.product_detail', $product->id) }}">{{ $product->product_name }}</a>
                                                        </h2>
                                                        <div class="product-rate-cover">
                                                            <div class="product-rate d-inline-block">
                                                                <div class="product-rating" style="width: 90%"></div>
                                                            </div>
                                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                        </div>
                                                        <div class="product-card-bottom">
                                                            <div class="product-price">
                                                                @if (isset($productFormattedPrices[$product['id']]))
                                                                    <span>{{ $productFormattedPrices[$product['id']] }}</span>
                                                                @else
                                                                    Price not available
                                                                @endif
                                                            </div>
                                                            <div class="add-cart">
                                                                <a class="add" href="shop-cart.html"><i
                                                                        class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p>No products found for "{{ $search }}".</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Popup Search bar -->
        </div>
    </div>
</header>


