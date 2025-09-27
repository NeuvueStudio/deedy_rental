@extends('admin.layouts.home')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>
                    <p class="text-muted">Please fill in the details below to edit a Category. Ensure that all the required fields are completed before submitting the form.</p>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>There were some problems with your input:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Main Form -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Category Details</h5>
                    </div>
                    <div class="card-body">
                        <!-- Category Name -->
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" placeholder="Enter category name" name="name" value="{{ old('name', $category->name) }}">
                        </div>

                        <!-- Parent Category -->
                        <div class="form-group">
                            <label>Parent Category</label>
                            <select class="form-control select2" data-toggle="select2" name="parent_id">
                                <option value="">Select Category</option>
                                @foreach($parentCategories as $parent)
                                    <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category Image</label>
                            <input type="file" class="dropify" name="category_image" data-allowed-file-extensions="jpg jpeg png gif" data-default-file="{{ asset($category->category_image) }}"/>
                        </div>
                        <!-- Submit -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
