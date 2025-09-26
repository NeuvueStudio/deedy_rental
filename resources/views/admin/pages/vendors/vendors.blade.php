@extends('admin.layouts.home')
@section('content')
<!-- Start Content -->
<div class="content pb-0">

    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between gap-2 mb-4 flex-wrap">
        <div>
            <h4 class="mb-1">Vendors<span class="badge badge-soft-primary ms-2">{{ $vendors->count() }}</span></h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vendors</li>
                </ol>
            </nav>
        </div>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="gap-2 d-flex align-items-center flex-wrap">
            <div class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle btn btn-outline-light px-2 shadow"
                    data-bs-toggle="dropdown"><i class="ti ti-package-export me-2"></i>Export</a>
                <div class="dropdown-menu dropdown-menu-end">
                    <ul>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-pdf me-1"></i>Export as PDF</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-xls me-1"></i>Export as Excel </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Header -->

    <!-- card start -->
    <div class="card border-0 rounded-0">
        <div class="card-header d-flex align-items-center justify-content-between gap-2 flex-wrap">
            <div class="input-icon input-icon-start position-relative">
                <span class="input-icon-addon text-dark"><i class="ti ti-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
            </div>
        </div>
        <div class="card-body">
            <!-- Vendors List -->
            <div class="table-responsive table-nowrap">
                <table class="table table-nowrap data" id="data">
                    <thead class="table-light">
                        <tr>
                            <th>Vendor ID</th>
                            <th>Company Name</th>
                            <th>Owner Name</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $vendor)
                        <tr>
                            <td>{{ $vendor->vendor_code }}</td>
                            <td>{{ $vendor->company_name }}</td>
                            <td>{{ $vendor->owner_name }}</td>
                            <td>{{ $vendor->contact_no }}</td>
                            <td>
                                <button class="btn btn-info btn-sm show-details" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#vendorDetailsModal"
                                        data-vendor-id="{{ $vendor->id }}"
                                        data-vendor-code="{{ $vendor->vendor_code }}"
                                        data-company-name="{{ $vendor->company_name }}"
                                        data-owner-name="{{ $vendor->owner_name }}"
                                        data-phone="{{ $vendor->contact_no }}"
                                        data-contacts='@json($vendor->alternateContacts)'
                                        data-godowns='@json($vendor->godowns)'>
                                    Show Details
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- card end -->

    <!-- Vendor Details Modal -->
    <div class="modal fade" id="vendorDetailsModal" tabindex="-1" aria-labelledby="vendorDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorDetailsModalLabel">Vendor Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Basic Vendor Information -->
                    <div id="basicInfoSection" class="mb-4">
                        <h6>Basic Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Vendor ID:</strong> <span id="modalVendorCode"></span>
                            </div>
                            <div class="col-md-6">
                                <strong>Company Name:</strong> <span id="modalCompanyName"></span>
                            </div>
                            <div class="col-md-6">
                                <strong>Owner Name:</strong> <span id="modalOwnerName"></span>
                            </div>
                            <div class="col-md-6">
                                <strong>Phone:</strong> <span id="modalPhone"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Alternate Contacts Section -->
                    <div id="alternateContactsSection" class="mb-4">
                        <h6>Alternate Contacts</h6>
                        <div id="contactsList">No alternate contacts available.</div>
                    </div>

                    <!-- Godowns Section -->
                    <div id="godownsSection">
                        <h6>Godowns</h6>
                        <div id="godownsList">No godowns available.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Content -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const showButtons = document.querySelectorAll('.show-details');
    
    showButtons.forEach(button => {
        button.addEventListener('click', function() {
            const vendorId = this.getAttribute('data-vendor-id');
            const vendorCode = this.getAttribute('data-vendor-code') || 'N/A';
            const companyName = this.getAttribute('data-company-name') || 'N/A';
            const ownerName = this.getAttribute('data-owner-name') || 'N/A';
            const phone = this.getAttribute('data-phone') || 'N/A';
            const contactsData = JSON.parse(this.getAttribute('data-contacts') || '[]');
            const godownsData = JSON.parse(this.getAttribute('data-godowns') || '[]');

            // Populate Basic Information
            document.getElementById('modalVendorCode').textContent = vendorCode;
            document.getElementById('modalCompanyName').textContent = companyName;
            document.getElementById('modalOwnerName').textContent = ownerName;
            document.getElementById('modalPhone').textContent = phone;

            // Update modal title
            document.getElementById('vendorDetailsModalLabel').textContent = `Vendor Details (Vendor Code: ${vendorCode})`;
            // Populate Alternate Contacts
            const contactsList = document.getElementById('contactsList');
            if (contactsData.length > 0) {
                contactsList.innerHTML = contactsData.map(contact => 
                    `<div class="mb-2 p-2 border rounded"><strong>${contact.alternate_name || 'N/A'}</strong> - ${contact.alternate_no || 'N/A'}</div>`
                ).join('');
            } else {
                contactsList.innerHTML = '<div class="text-muted">No alternate contacts available.</div>';
            }

            // Populate Godowns
            const godownsList = document.getElementById('godownsList');
            if (godownsData.length > 0) {
                godownsList.innerHTML = godownsData.map(godown => 
                    `<div class="mb-2 p-2 border rounded"><strong>${godown.godown_address || 'N/A'}</strong> (${godown.contact_name || 'N/A'} - ${godown.godown_mobile_no || 'N/A'})</div>`
                ).join('');
            } else {
                godownsList.innerHTML = '<div class="text-muted">No godowns available.</div>';
            }
        });
    });
});
</script>

@endsection