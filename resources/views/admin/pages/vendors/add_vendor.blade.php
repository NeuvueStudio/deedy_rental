@extends('admin.layouts.home')
@section('content')


    <!-- Start Content -->
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
        <!-- End Page Header -->
        <div class="card border-0 rounded-0 mt-5">
            <div class="card-header d-flex align-items-center justify-content-between gap-2 flex-wrap">
                <h5 class="mb-0">Vendor Details</h5>
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form>
                    
                </form>
            </div>
        </div>

       

    </div>
    <!-- End Content -->
@endsection