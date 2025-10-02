@extends('admin.layouts.home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8 d-block justify-content-center">
                                <h4 class="card-title">Contents</h4>
                                <p class="card-subtitle mb-4">
                                    Manage all Contents here. You can set titles, images, links, and additional custom fields 
                                    such as button text and animation using meta fields.
                                </p>
                            </div>
                            <div class="col-lg-4 d-block">
                                <div class="text-lg-right mt-3 mt-lg-0">
                                    <a href="{{ route('content.create_banner') }}" class="btn btn-danger"><i
                                            class="mdi mdi-plus-circle mr-1"></i> Add Content</a>
                                </div>
                            </div><!-- end col-->
                        </div> <!-- end row -->
                        
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable-buttons" class="table table-striped nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Post Title</th>
                                            <th>Post Name</th>
                                            <th>Post Type</th>
                                            <th>Post Status</th>
                                            <th>Post Date</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($contents as $content)
                                            <tr>
                                                <td>{{ $content->id }}</td>
                                                <td>{{ $content->post_title }}</td>
                                                <td>{{ $content->post_name }}</td>
                                                <td>{{ $content->post_type }}</td>
                                                <td>{{ $content->post_status }}</td>
                                                <td>{{ $content->post_date }}</td>
                                                <td>{{ $content->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <a href="{{ route('content.edit', $content->id) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('content.destroy', $content->id) }}"
                                                        method="POST" style="display:inline-block;"
                                                        onsubmit="return confirm('Delete this category?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No contents found.</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
