@extends('admin.layouts.home')

@push('styles')
    <style>
        #imagePreviewArea {
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        #imagePreviewArea:hover {
            background-color: #e9ecef;
        }

        #imagePlaceholder {
            text-align: center;
        }

        #imagePreview {
            border-radius: 8px;
        }
    </style>
@endpush

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
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary">
                <i class="ti ti-arrow-left me-1"></i>Back to Products
            </a>
        </div>

        <!-- Card -->
        <div class="card border-0 rounded-0 mt-5">
            <div class="card-header">
                <h5 class="mb-0">Product Details</h5>
            </div>
            <div class="card-body">

                @if (session('success'))
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

                    <div class="row">
                        <!-- Left Column - Image Upload -->
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="upload-area" style="min-height: 400px;">

                                        <!-- Upload Button -->
                                        <div class="mb-3">
                                            <label for="product_image" class="form-label">Product Image <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="product_image" id="product_image"
                                                class="form-control" accept="image/*" required>
                                            <small class="text-muted">JPG, PNG, GIF. Max size 2MB</small>
                                        </div>

                                        <!-- Image Preview Area -->
                                        <div id="imagePreviewArea"
                                            class="border border-2 border-dashed rounded p-3 text-center"
                                            style="min-height: 300px; display: flex; align-items: center; justify-content: center;">

                                            <!-- Placeholder -->
                                            <div id="imagePlaceholder">
                                                <i class="ti ti-photo text-muted mb-2" style="font-size: 64px;"></i>
                                                <p class="text-muted">Image preview will appear here</p>
                                            </div>

                                            <!-- Preview Image -->
                                            <img id="imagePreview" src="" alt="Product Preview"
                                                style="display: none; max-width: 100%; max-height: 280px; object-fit: contain;">

                                        </div>

                                        <!-- Inline Script for immediate execution -->
                                        <script>
                                            (function() {
                                                console.log('Inline script executing...');

                                                function handleImageChange() {
                                                    console.log('Image input changed!');
                                                    const input = document.getElementById('product_image');
                                                    const file = input.files[0];
                                                    const preview = document.getElementById('imagePreview');
                                                    const placeholder = document.getElementById('imagePlaceholder');
                                                    const removeBtn = document.getElementById('removeImage');

                                                    console.log('File:', file);
                                                    console.log('Elements:', {
                                                        preview,
                                                        placeholder,
                                                        removeBtn
                                                    });

                                                    if (file) {
                                                        console.log('Processing file:', file.name);

                                                        if (file.size > 2 * 1024 * 1024) {
                                                            alert('File too large');
                                                            input.value = '';
                                                            return;
                                                        }

                                                        if (!file.type.startsWith('image/')) {
                                                            alert('Not an image file');
                                                            input.value = '';
                                                            return;
                                                        }

                                                        const reader = new FileReader();
                                                        reader.onload = function(e) {
                                                            console.log('File read complete, showing preview');
                                                            preview.src = e.target.result;
                                                            preview.style.display = 'block';
                                                            placeholder.style.display = 'none';
                                                            removeBtn.style.display = 'inline-block';
                                                            console.log('Preview should now be visible');
                                                        };
                                                        reader.readAsDataURL(file);
                                                    } else {
                                                        console.log('No file, hiding preview');
                                                        preview.style.display = 'none';
                                                        placeholder.style.display = 'block';
                                                        removeBtn.style.display = 'none';
                                                    }
                                                }

                                                // Attach event listener immediately
                                                const input = document.getElementById('product_image');
                                                if (input) {
                                                    console.log('Attaching event listener to input');
                                                    input.addEventListener('change', handleImageChange);

                                                    // Also try with onchange as backup
                                                    input.onchange = handleImageChange;

                                                    console.log('Event listeners attached');
                                                } else {
                                                    console.error('Input element not found!');
                                                }

                                                // Remove button handler
                                                const removeBtn = document.getElementById('removeImage');
                                                if (removeBtn) {
                                                    removeBtn.addEventListener('click', function() {
                                                        console.log('Remove clicked');
                                                        input.value = '';
                                                        document.getElementById('imagePreview').style.display = 'none';
                                                        document.getElementById('imagePlaceholder').style.display = 'block';
                                                        removeBtn.style.display = 'none';
                                                    });
                                                }
                                            })();
                                        </script>

                                        <!-- Remove Button -->
                                        <div class="mt-2">
                                            <button type="button" id="removeImage" class="btn btn-outline-danger btn-sm"
                                                style="display: none;">
                                                <i class="ti ti-trash me-1"></i>Remove Image
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Right Column - Form Fields -->
                        <div class="col-md-8">
                            <!-- Vendor Information Row -->
                            <div class="row">
                                <!-- Select Vendor -->
                                <div class="col-md-6 mb-3">
                                    <label for="vendor_id" class="form-label">Select Vendor <span
                                            class="text-danger">*</span></label>
                                    <select name="vendor_id" id="vendor_id" class="form-control" required>
                                        <option value="">Choose Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}" data-code="{{ $vendor->vendor_code }}"
                                                {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                                {{ $vendor->company_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Select Godown -->
                                <div class="col-md-6 mb-3">
                                    <label for="godown_id" class="form-label">Select Godown <span
                                            class="text-danger">*</span></label>
                                    <select name="godown_id" id="godown_id" class="form-control" required>
                                        <option value="">First select a vendor</option>
                                    </select>
                                    <small class="form-text text-muted">
                                        <span id="vendor_info" class="text-info"></span>
                                    </small>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Product Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="product_name" class="form-label">Product name</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control"
                                        value="{{ old('product_name') }}" required>
                                </div>

                                <!-- Select Categories -->
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">Select Categories</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Choose Category</option>
                                        <option value="1" {{ old('category_id') == '1' ? 'selected' : '' }}>
                                            Electronics</option>
                                        <option value="2" {{ old('category_id') == '2' ? 'selected' : '' }}>
                                            Furniture
                                        </option>
                                        <option value="3" {{ old('category_id') == '3' ? 'selected' : '' }}>
                                            Appliances
                                        </option>
                                        <option value="4" {{ old('category_id') == '4' ? 'selected' : '' }}>
                                            Clothing
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Slug -->
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    value="{{ old('slug') }}" required>
                            </div>

                            <!-- Sort Description -->
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Sort Description</label>
                                <textarea name="short_description" id="short_description" class="form-control" rows="5"
                                    placeholder="Enter product description..." required>{{ old('short_description') }}</textarea>
                            </div>

                            <!-- Additional Fields -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="colors" class="form-label">Product Color</label>
                                    <input type="text" name="colors" id="colors" class="form-control"
                                        placeholder="Enter product color" value="{{ old('colors') }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="rent_per_day" class="form-label">Rent per Day (₹)</label>
                                    <input type="number" name="rent_per_day" id="rent_per_day" class="form-control"
                                        step="0.01" min="0" value="{{ old('rent_per_day') }}" required>
                                </div>
                            </div>

                            <!-- Hidden Fields -->
                            <input type="hidden" name="sub_category_id" value="1">
                            <input type="hidden" name="material_id" value="1">
                            <input type="hidden" name="quality_rating" value="5">

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <button type="reset" class="btn btn-secondary px-4">Reset</button>
                                <button type="submit" class="btn btn-primary px-4">Save Product</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            console.log('Document ready - Image upload initialized');

            // Alternative vanilla JS image upload (backup)
            document.getElementById('product_image').addEventListener('change', function(e) {
                console.log('Vanilla JS: File input changed');
                var file = e.target.files[0];
                var preview = document.getElementById('imagePreview');
                var previewContainer = document.getElementById('imagePreviewContainer');
                var placeholder = document.getElementById('uploadPlaceholder');

                if (file) {
                    console.log('Vanilla JS: File selected:', file.name);

                    if (file.size > 2 * 1024 * 1024) {
                        alert('File size must be less than 2MB');
                        e.target.value = '';
                        return;
                    }

                    if (!file.type.match('image.*')) {
                        alert('Please select a valid image file (JPG, PNG, GIF)');
                        e.target.value = '';
                        return;
                    }

                    var reader = new FileReader();
                    reader.onload = function(event) {
                        console.log('Vanilla JS: Setting preview...');
                        preview.src = event.target.result;
                        previewContainer.style.display = 'block';
                        placeholder.style.display = 'none';
                        console.log('Vanilla JS: Preview set');
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewContainer.style.display = 'none';
                    preview.src = '';
                    placeholder.style.display = 'flex';
                }
            });

            // Vendor selection handler - Load godowns based on selected vendor
            $('#vendor_id').on('change', function() {
                var vendorId = $(this).val();
                var selectedOption = $(this).find('option:selected');
                var vendorCode = selectedOption.data('code');
                var vendorName = selectedOption.text();

                // Update vendor info
                if (vendorId) {
                    $('#vendor_info').text('Vendor Code: ' + vendorCode);

                    // Load godowns for selected vendor
                    $.ajax({
                        url: '/get-godowns/' + vendorId,
                        type: 'GET',
                        beforeSend: function() {
                            $('#godown_id').html(
                                '<option value="">Loading godowns...</option>');
                        },
                        success: function(data) {
                            $('#godown_id').empty().append(
                                '<option value="">Choose Godown</option>');

                            if (data.length > 0) {
                                $.each(data, function(key, godown) {
                                    $('#godown_id').append(
                                        '<option value="' + godown.id + '">' +
                                        godown.godown_address +
                                        '</option>'
                                    );
                                });
                            } else {
                                $('#godown_id').append(
                                    '<option value="">No godowns available</option>');
                            }
                        },
                        error: function() {
                            $('#godown_id').html(
                                '<option value="">Error loading godowns</option>');
                            alert('Error loading godowns. Please try again.');
                        }
                    });
                } else {
                    $('#godown_id').html('<option value="">First select a vendor</option>');
                    $('#vendor_info').text('');
                }
            });

            // Image upload is now handled by inline script above

            // Remove image functionality is now handled by inline script above

            // Generate slug from product name
            $('#product_name').on('keyup', function() {
                var productName = $(this).val();
                var slug = productName
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-|-$)/g, '');
                $('#slug').val(slug);
            });



            // Reset form handler
            $('button[type="reset"]').on('click', function() {
                // Reset image
                const input = document.getElementById('product_image');
                const preview = document.getElementById('imagePreview');
                const placeholder = document.getElementById('imagePlaceholder');
                const removeBtn = document.getElementById('removeImage');

                input.value = '';
                preview.src = '';
                preview.style.display = 'none';
                placeholder.style.display = 'block';
                removeBtn.style.display = 'none';

                // Reset other fields
                $('#vendor_info').text('');
                $('#godown_id').html('<option value="">First select a vendor</option>');
            });
        });
    </script>
@endpush
