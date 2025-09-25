@extends('web.layout.home')

@section('content')

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="https://deedy.in" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Shop
            <span></span> Cart
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container py-4">
    <h1 class="heading-2 mb-10">Your Cart</h1>
    <div class="row g-4">
        <!-- Left Section: Cart Items -->
        <div class="col-lg-8">
            <h6 class="mb-3">Regular Rentals</h6>
            @php $subtotal = 0; @endphp
			
            @forelse ($items as $item)
                @php
                    $product = optional($item->product);
                    $itemSubtotal = $item->price * $item->quantity;
                    $subtotal += $itemSubtotal;
                @endphp

                <div class="card p-4 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('upload/product_images/' . $product->image_name) }}"
                             width="64" class="me-3" alt="{{ $product->product_name ?? 'Product' }}">
                        <div>
                            <div><strong>{{ $item->product->product_name ?? 'Unknown Product' }}</strong></div>
                            <div><strong>{{ $item->product->category ?? 'N/A' }}</strong></div>
                        </div>

                        <div class="ms-auto text-end">
                            <div class="input-group input-group-sm">
                                <button class="btn btn-outline-secondary">-</button>
                                <input type="text" class="form-control text-center" value="{{ $item->quantity }}">
                                <button class="btn btn-outline-secondary">+</button>
                            </div>
                        </div>

                        <div class="ms-auto text-end">
                            <small>₹{{ number_format($item->price, 2) }}</small><br>
                        </div>

                        <div class="ms-auto text-end">
                            <small style="font-weight: 600;">₹{{ number_format($itemSubtotal, 2) }}</small><br>
                        </div>
                    </div>
                    <div class="text-muted mt-2">
                        <i class="bi bi-truck"></i> Delivery in 2-4 days post KYC
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">Your cart is empty.</div>
            @endforelse
        </div>

        <!-- Right Section: Order Summary -->
        <div class="col-lg-4">
            <div class="card p-4">
                <h5 class="mb-3">Order Summary</h5>
                <ul class="list-unstyled">
                    <li>Sub Total <span class="float-end text-muted">₹{{ number_format($subtotal, 2) }}</span></li>
                    <li>Delivery + Packaging Charges <span class="float-end">₹0.00</span></li>
                    <li class="fw-bold mt-2">Total Payable <span class="float-end">₹{{ number_format($subtotal, 2) }}</span></li>
                </ul>

                <!-- Coupon Input -->
                <div class="input-group mt-3">
                    <input type="text" class="form-control" placeholder="Enter the coupon code">
                    <button class="btn btn-outline-secondary" type="button">Apply</button>
                </div>

                <div class="alert alert-light border mt-2">
                    Kindly contact with <strong>our team</strong> to place <strong>bulk</strong> orders on selective months.
                </div>

                <form method="POST" action="{{ route('checkout.place') }}">
                    @csrf

                    <label for="user_name">Your Name</label>
                    <input type="text" class="form-control" name="user_name" required>

                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" name="user_mobile" required>
                    
                    <input type="submit" class="btn btn-danger w-100 mt-3"
                           value="₹{{ number_format($subtotal, 2) }} - Proceed">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
