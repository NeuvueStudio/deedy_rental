@extends('admin.layouts.home')

@section('styles')
    <!-- Additional styles if needed -->
@endsection

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

        <!-- Card -->
        <div class="card border-0 rounded-1">
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
                <form>
                    <div class="row">
                        <div class="col-sm-4">
                            <div id="my-dropzone" class="dropzone"></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="vendor-dropdown" class="form-label">Choose a Vendor:</label>
                                        <select id="vendor-dropdown" name="vendor_id" class="form-select">
                                            <option value="">Select a vendor...</option>
                                            @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->id }}">{{ $vendor->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="godown-dropdown" class="form-label">Choose a Godown:</label>
                                        <select id="godown-dropdown" name="godown_id" class="form-select" disabled>
                                            <option value="">Select a vendor first...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Select2 for vendor dropdown
            $('#vendor-dropdown').select2({
                placeholder: 'Select a vendor...',
                allowClear: true,
                width: '100%'
            });

            // Initialize Select2 for godown dropdown
            $('#godown-dropdown').select2({
                placeholder: 'Select a godown...',
                allowClear: true,
                width: '100%'
            });

            // Handle vendor selection change
            $('#vendor-dropdown').on('change', function() {
                const vendorId = $(this).val();
                const godownDropdown = $('#godown-dropdown');

                console.log('Vendor selected:', vendorId); // Debug log

                // Clear godown dropdown and show loading
                godownDropdown.empty().append('<option value="">Loading...</option>');
                godownDropdown.prop('disabled', true);
                godownDropdown.trigger('change.select2'); // Update Select2

                if (vendorId) {
                    console.log('Fetching godowns for vendor:', vendorId); // Debug log

                    // Fetch godowns for selected vendor
                    $.ajax({
                        url: `/get-godowns/${vendorId}`,
                        type: 'GET',
                        success: function(response) {
                            console.log('Godowns response:', response); // Debug log

                            // Clear loading option
                            godownDropdown.empty();

                            if (response.godowns && response.godowns.length > 0) {
                                // Add default option
                                godownDropdown.append(
                                    '<option value="">Select a godown...</option>');

                                // Add godown options
                                $.each(response.godowns, function(index, godown) {
                                    godownDropdown.append(
                                        `<option value="${godown.id}">${godown.godown_address} - ${godown.contact_name}</option>`
                                    );
                                });

                                // Enable dropdown
                                godownDropdown.prop('disabled', false);
                                console.log('Godown dropdown enabled with', response.godowns
                                    .length, 'options'); // Debug log
                            } else {
                                // No godowns found
                                godownDropdown.append(
                                    '<option value="">No godowns available</option>');
                                console.log('No godowns found for vendor'); // Debug log
                            }

                            // Update Select2 after adding options
                            godownDropdown.trigger('change.select2');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching godowns:', error);
                            console.error('XHR:', xhr.responseText); // More detailed error
                            godownDropdown.empty().append(
                                '<option value="">Error loading godowns</option>');
                            godownDropdown.trigger('change.select2');
                        }
                    });
                } else {
                    // No vendor selected, reset godown dropdown
                    godownDropdown.empty().append('<option value="">Select a vendor first...</option>');
                    godownDropdown.prop('disabled', true);
                    godownDropdown.trigger('change.select2');
                    console.log('Vendor cleared, godown dropdown reset'); // Debug log
                }
            });
        });
    </script>
@endsection
