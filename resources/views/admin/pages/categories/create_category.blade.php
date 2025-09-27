@extends('admin.layouts.home')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Category</h4>
                    <p class="text-muted">
                        Please fill in the details below to create a new Category. Ensure that all the required fields are completed before submitting the form.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data"> 
        @csrf
        <div class="row">
            <!-- Main Form -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Category Details</h5>
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

                    <div class="card-body">
                        <!-- Category Name -->
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" placeholder="Enter category name" name="name">
                        </div>

                        <!-- Parent Category -->
                        <div class="form-group">
                            <label>Parent Category</label>
                            <select class="form-control" name="parent_id">
                                <option value="">Select Main Category</option>
                                @foreach($parentCategories as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Category Image -->
                        <div class="form-group">
                            <label>Category Image</label>
                            <input type="file" class="form-control" name="category_image">
                        </div>

                        <!-- Submit -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
