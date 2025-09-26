@extends('admin.layouts.home')
@section('content')

<div class="content pb-0">

    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between gap-2 mb-4 flex-wrap">
        <div>
            <h4 class="mb-1">Add Vendor</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/vendors">Vendors</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Vendor</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="gap-2 d-flex align-items-center flex-wrap">
        <a href="/vendors" class="btn btn-outline-primary"><i class="ti ti-arrow-left me-1"></i>Back to Vendors</a>
    </div>

    <!-- Card -->
    <div class="card border-0 rounded-0 mt-5">
        <div class="card-header">
            <h5 class="mb-0">Vendor Details</h5>
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

            <form method="POST" action="{{ route('vendor.store') }}">
                @csrf

                <!-- Company Info -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="gst_no">GST No</label>
                        <input type="text" name="gst_no" class="form-control" value="{{ old('gst_no') }}" required>
                    </div>
                </div>

                <!-- KYC -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="owner_name">Owner Name</label>
                        <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contact_no">Contact No</label>
                        <input type="tel" name="contact_no" class="form-control" value="{{ old('contact_no') }}" required>
                    </div>
                </div>

                <!-- Alternate Contacts -->
                <h4 class="mt-4">Alternate Contacts</h4>
                <div id="alternate-section">
                    @php
                        $altNames = old('alternate_name', ['']);
                        $altNos = old('alternate_no', ['']);
                    @endphp
                    @foreach($altNames as $index => $altName)
                    <div class="row mb-3 alternate-entry align-items-end">
                        <div class="col-md-5">
                            <input type="text" name="alternate_name[]" class="form-control" placeholder="Alternate Name" value="{{ $altName }}" required>
                        </div>
                        <div class="col-md-5">
                            <input type="tel" name="alternate_no[]" class="form-control" placeholder="Alternate No" value="{{ $altNos[$index] ?? '' }}" required>
                        </div>
                        <div class="col-md-2 text-center">
                            <button type="button" class="btn btn-danger" onclick="removeAlternate(this)">−</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-primary mb-3" onclick="addAlternate()">+ Add Another Alternate Contact</button>

                <!-- Godowns -->
                <h4 class="mt-4">Godown Details</h4>
                <div id="godown-section">
                    @php
                        $godownAddresses = old('godown_address', ['']);
                        $pincodes = old('pincode', ['']);
                        $contactNames = old('contact_name', ['']);
                        $godownMobiles = old('godown_mobile_no', ['']);
                    @endphp
                    @foreach($godownAddresses as $index => $address)
                    <div class="row mb-3 godown-entry align-items-end">
                        <div class="col-md-5">
                            <input type="text" name="godown_address[]" class="form-control" placeholder="Godown Address" value="{{ $address }}" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="pincode[]" class="form-control" placeholder="Pincode" value="{{ $pincodes[$index] ?? '' }}" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="contact_name[]" class="form-control" placeholder="Contact Name" value="{{ $contactNames[$index] ?? '' }}" required>
                        </div>
                        <div class="col-md-2">
                            <input type="tel" name="godown_mobile_no[]" class="form-control" placeholder="Mobile No" value="{{ $godownMobiles[$index] ?? '' }}" required>
                        </div>
                        <div class="col-md-1 text-center">
                            <button type="button" class="btn btn-danger" onclick="removeGodown(this)">−</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-primary mb-3" onclick="addGodown()">+ Add Another Godown</button>

                <!-- Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
function addAlternate() {
    const section = document.getElementById('alternate-section');
    const div = document.createElement('div');
    div.classList.add('row', 'mb-3', 'alternate-entry', 'align-items-end');
    div.innerHTML = `
        <div class="col-md-5">
            <input type="text" name="alternate_name[]" class="form-control" placeholder="Alternate Name" required>
        </div>
        <div class="col-md-5">
            <input type="tel" name="alternate_no[]" class="form-control" placeholder="Alternate No" required>
        </div>
        <div class="col-md-2 text-center">
            <button type="button" class="btn btn-danger" onclick="removeAlternate(this)">−</button>
        </div>`;
    section.appendChild(div);
}

function removeAlternate(button) {
    button.closest('.alternate-entry').remove();
}

function addGodown() {
    const section = document.getElementById('godown-section');
    const div = document.createElement('div');
    div.classList.add('row', 'mb-3', 'godown-entry', 'align-items-end');
    div.innerHTML = `
        <div class="col-md-5">
            <input type="text" name="godown_address[]" class="form-control" placeholder="Godown Address" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="pincode[]" class="form-control" placeholder="Pincode" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="contact_name[]" class="form-control" placeholder="Contact Name" required>
        </div>
        <div class="col-md-2">
            <input type="tel" name="godown_mobile_no[]" class="form-control" placeholder="Mobile No" required>
        </div>
        <div class="col-md-1 text-center">
            <button type="button" class="btn btn-danger" onclick="removeGodown(this)">−</button>
        </div>`;
    section.appendChild(div);
}

function removeGodown(button) {
    button.closest('.godown-entry').remove();
}
</script>

@endsection
