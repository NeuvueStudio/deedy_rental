@extends('admin.layouts.home')

@section('content')
<div class="container my-5">
    <div class="vendor-card p-4 border rounded shadow">
        <h3 class="mb-4 text-center fw-bold">Product Registration</h3>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Vendor Selection -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Select Vendor</label>
                    <select name="vendor_id" id="vendor_id" class="form-control" required>
                        <option value="">Choose Vendor</option>
                        @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}" data-code="{{ $vendor->vendor_code }}">
                            {{ $vendor->company_name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Vendor Code</label>
                    <input type="text" id="vendor_code" class="form-control" readonly>
                </div>
                <div class="col-md-4">
    <label>Total Godown</label>
    <input type="text" id="total_godown" class="form-control" readonly value="0">
</div>

            </div>

            <!-- Category -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Choose Category</option>
                        <option value="1">Electronics</option>
                        <option value="2">Furniture</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Sub-Category</label>
                    <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                        <option value="">Choose Sub-Category</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Made by Material</label>
                    <select name="material_id" id="material_id" class="form-control" required>
                        <option value="">Choose Material</option>
                    </select>
                </div>
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label>Product Image</label>
                <input type="file" name="product_image" id="product_image" class="form-control" accept="image/*" required>
                <img id="imagePreview" src="" alt="Image Preview">
            </div>

            <!-- Choose Colour -->
            <div class="mb-3">
                <label>Choose Colour</label>
                <div id="color-container" class="d-flex" style="gap: 15px; flex-wrap: wrap;"></div>
            </div>

            <!-- Quality Rating -->
            <div class="mb-3">
                <label>Quality Rating (1-10 Stars)</label>
                <div class="star-rating">
                    @for($i=10; $i>=1; $i--)
                    <input type="radio" id="star{{ $i }}" name="quality_rating" value="{{ $i }}">
                    <label for="star{{ $i }}">★</label>
                    @endfor
                </div>
            </div>

            <!-- Rent + Godown -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Rent of the Day</label>
                    <input type="number" name="rent_per_day" class="form-control" step="0.01" min="0" required>
                </div>

                <div class="col-md-6">
                    <label>Godown</label>
                    <select name="godown_id" id="godown_id" class="form-control" required>
                        <option value="">Choose Godown</option>
                    </select>
                </div>

            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <button type="reset" class="vendor-btn-cancel">Cancel</button>
                <button type="submit" class="vendor-btn-submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#vendor_id').on('change', function() {
            var vendorId = $(this).val();
            if (vendorId) {
                $.ajax({
                    url: '/get-godowns/' + vendorId,
                    type: 'GET',
                    success: function(data) {
                        $('#godown_id').empty().append('<option value="">Choose Godown</option>');
                        $.each(data, function(key, godown) {
                            $('#godown_id').append(
                                '<option value="' + godown.id + '">' + godown.godown_address + '</option>'
                            );
                        });
                    }
                });
            } else {
                $('#godown_id').empty().append('<option value="">Choose Godown</option>');
            }
        });
    });
</script>


@endsection