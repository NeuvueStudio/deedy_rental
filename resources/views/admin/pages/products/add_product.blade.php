@extends('admin.layouts.home')
@section('content')

<div class="content pb-0">

    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between gap-2 mb-4 flex-wrap">
        <div>
            <h4 class="mb-1">Add Product</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="gap-2 d-flex align-items-center flex-wrap">
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary"><i class="ti ti-arrow-left me-1"></i>Back to Products</a>
    </div>

    <!-- Card -->
    <div class="card border-0 rounded-0 mt-5">
        <div class="card-header">
            <h5 class="mb-0">Product Details</h5>
        </div>
        <div class="card-body">
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Vendor Information -->
                <h6 class="mb-3 text-muted">Vendor Information</h6>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="vendor_id" class="form-label">Select Vendor <span class="text-danger">*</span></label>
                        <select name="vendor_id" id="vendor_id" class="form-control" required>
                            <option value="">Choose Vendor</option>
                            @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}" data-code="{{ $vendor->vendor_code }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                {{ $vendor->company_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="vendor_code" class="form-label">Vendor Code</label>
                        <input type="text" id="vendor_code" class="form-control" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="total_godown" class="form-label">Total Godowns</label>
                        <input type="text" id="total_godown" class="form-control" readonly value="0">
                    </div>
                </div>

                <!-- Product Classification -->
                <h6 class="mb-3 text-muted">Product Classification</h6>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Choose Category</option>
                            <option value="1" {{ old('category_id') == '1' ? 'selected' : '' }}>Electronics</option>
                            <option value="2" {{ old('category_id') == '2' ? 'selected' : '' }}>Furniture</option>
                            <option value="3" {{ old('category_id') == '3' ? 'selected' : '' }}>Appliances</option>
                            <option value="4" {{ old('category_id') == '4' ? 'selected' : '' }}>Clothing</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="sub_category_id" class="form-label">Sub-Category <span class="text-danger">*</span></label>
                        <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                            <option value="">Choose Sub-Category</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="material_id" class="form-label">Material <span class="text-danger">*</span></label>
                        <select name="material_id" id="material_id" class="form-control" required>
                            <option value="">Choose Material</option>
                            <option value="1" {{ old('material_id') == '1' ? 'selected' : '' }}>Wood</option>
                            <option value="2" {{ old('material_id') == '2' ? 'selected' : '' }}>Metal</option>
                            <option value="3" {{ old('material_id') == '3' ? 'selected' : '' }}>Plastic</option>
                            <option value="4" {{ old('material_id') == '4' ? 'selected' : '' }}>Glass</option>
                            <option value="5" {{ old('material_id') == '5' ? 'selected' : '' }}>Fabric</option>
                        </select>
                    </div>
                </div>

                <!-- Product Media -->
                <h6 class="mb-3 text-muted">Product Media</h6>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="product_image" class="form-label">Product Image <span class="text-danger">*</span></label>
                        <input type="file" name="product_image" id="product_image" class="form-control" accept="image/*" required>
                        <small class="form-text text-muted">Upload product image (JPEG, PNG, JPG - Max: 2MB)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Image Preview</label>
                        <div class="border rounded p-3 text-center" style="min-height: 120px;">
                            <img id="imagePreview" src="" alt="Image Preview" class="img-fluid rounded" style="max-height: 100px; display: none;">
                            <div id="imagePlaceholder" class="text-muted">
                                <i class="ti ti-photo fs-1"></i><br>
                                No image selected
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Attributes -->
                <h6 class="mb-3 text-muted">Product Attributes</h6>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Available Colors <span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="colors[]" value="Red" id="colorRed" {{ in_array('Red', old('colors', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="colorRed">Red</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="colors[]" value="Blue" id="colorBlue" {{ in_array('Blue', old('colors', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="colorBlue">Blue</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="colors[]" value="Green" id="colorGreen" {{ in_array('Green', old('colors', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="colorGreen">Green</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="colors[]" value="Black" id="colorBlack" {{ in_array('Black', old('colors', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="colorBlack">Black</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="colors[]" value="White" id="colorWhite" {{ in_array('White', old('colors', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="colorWhite">White</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="colors[]" value="Yellow" id="colorYellow" {{ in_array('Yellow', old('colors', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="colorYellow">Yellow</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="quality_rating" class="form-label">Quality Rating <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center gap-2">
                            <select name="quality_rating" id="quality_rating" class="form-control" required>
                                <option value="">Select Rating</option>
                                @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('quality_rating') == $i ? 'selected' : '' }}>
                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                </option>
                                @endfor
                            </select>
                        </div>
                        <small class="form-text text-muted">Rate the product quality from 1 to 5 stars</small>
                    </div>
                </div>

                <!-- Pricing & Storage -->
                <h6 class="mb-3 text-muted">Pricing & Storage</h6>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="rent_per_day" class="form-label">Rent per Day (₹) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" name="rent_per_day" id="rent_per_day" class="form-control" step="0.01" min="0" value="{{ old('rent_per_day') }}" required>
                        </div>
                        <small class="form-text text-muted">Enter the daily rental price</small>
                    </div>
                    <div class="col-md-6">
                        <label for="godown_id" class="form-label">Storage Godown <span class="text-danger">*</span></label>
                        <select name="godown_id" id="godown_id" class="form-control" required>
                            <option value="">Choose Godown</option>
                        </select>
                        <small class="form-text text-muted">Select where the product will be stored</small>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-secondary">Reset Form</button>
                    <button type="submit" class="btn btn-success">Add Product</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    
    // Vendor selection handler
    $('#vendor_id').on('change', function() {
        var vendorId = $(this).val();
        var selectedOption = $(this).find('option:selected');
        var vendorCode = selectedOption.data('code');
        
        // Update vendor code field
        $('#vendor_code').val(vendorCode || '');
        
        if (vendorId) {
            // Fetch godowns for selected vendor
            $.ajax({
                url: '/get-godowns/' + vendorId,
                type: 'GET',
                success: function(data) {
                    $('#godown_id').empty().append('<option value="">Choose Godown</option>');
                    $('#total_godown').val(data.length);
                    
                    $.each(data, function(key, godown) {
                        $('#godown_id').append(
                            '<option value="' + godown.id + '">' + 
                            godown.godown_address + 
                            '</option>'
                        );
                    });
                },
                error: function() {
                    alert('Error loading godowns. Please try again.');
                }
            });
        } else {
            $('#godown_id').empty().append('<option value="">Choose Godown</option>');
            $('#total_godown').val('0');
        }
    });

    // Category change handler for sub-categories
    $('#category_id').on('change', function() {
        var categoryId = $(this).val();
        var subCategorySelect = $('#sub_category_id');
        
        subCategorySelect.empty().append('<option value="">Choose Sub-Category</option>');
        
        // Add sub-categories based on category
        if (categoryId == '1') { // Electronics
            subCategorySelect.append('<option value="1">Mobile Phones</option>');
            subCategorySelect.append('<option value="2">Laptops</option>');
            subCategorySelect.append('<option value="3">Cameras</option>');
            subCategorySelect.append('<option value="4">Audio Systems</option>');
        } else if (categoryId == '2') { // Furniture
            subCategorySelect.append('<option value="5">Chairs</option>');
            subCategorySelect.append('<option value="6">Tables</option>');
            subCategorySelect.append('<option value="7">Sofas</option>');
            subCategorySelect.append('<option value="8">Beds</option>');
        } else if (categoryId == '3') { // Appliances
            subCategorySelect.append('<option value="9">Kitchen Appliances</option>');
            subCategorySelect.append('<option value="10">Cleaning Appliances</option>');
            subCategorySelect.append('<option value="11">Air Conditioners</option>');
        } else if (categoryId == '4') { // Clothing
            subCategorySelect.append('<option value="12">Formal Wear</option>');
            subCategorySelect.append('<option value="13">Casual Wear</option>');
            subCategorySelect.append('<option value="14">Traditional Wear</option>');
        }
    });

    // Image preview functionality
    $('#product_image').on('change', function() {
        var file = this.files[0];
        var preview = $('#imagePreview');
        var placeholder = $('#imagePlaceholder');
        
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.attr('src', e.target.result).show();
                placeholder.hide();
            };
            reader.readAsDataURL(file);
        } else {
            preview.hide().attr('src', '');
            placeholder.show();
        }
    });

    // Form validation
    $('form').on('submit', function(e) {
        var colors = $('input[name="colors[]"]:checked').length;
        if (colors === 0) {
            e.preventDefault();
            alert('Please select at least one color for the product.');
            return false;
        }
    });

    // Reset form handler
    $('button[type="reset"]').on('click', function() {
        $('#imagePreview').hide().attr('src', '');
        $('#imagePlaceholder').show();
        $('#vendor_code').val('');
        $('#total_godown').val('0');
        $('#godown_id').empty().append('<option value="">Choose Godown</option>');
        $('#sub_category_id').empty().append('<option value="">Choose Sub-Category</option>');
    });
});
</script>
@endpush