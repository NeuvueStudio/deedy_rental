@extends('admin.layouts.home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Content</h4>
                        <p class="text-muted">Please fill in the details below to create a new Page or Banner. Ensure that all the
                            required fields are completed before submitting the form.</p>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('content.update', $content->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Post Title -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" value="{{ old('post_title', $content->post_title) }}" required>
                    </div>
                </div>

                <!-- Post Slug -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="post_name">Slug (URL)</label>
                        <input type="text" name="post_name" class="form-control" value="{{ old('post_title', $content->post_name) }}">
                    </div>
                </div>

                <!-- Post Type -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="post_type">Type</label>
                        <select name="post_type" class="form-control" required>
                            <option value="page" {{ $content->post_type === 'page' ? 'selected' : '' }}>Page</option>
                            <option value="banner" {{ $content->post_type === 'banner' ? 'selected' : '' }}>Banner</option>
                        </select>
                    </div>
                </div>

                <!-- Post Status -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="post_status">Status</label>
                        <select name="post_status" class="form-control">
                            <option value="published" {{ $content->post_status === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ $content->post_status === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="post_content">Content</label>
                        <textarea id="summernote"></textarea>
                        <input type="hidden" name="post_content" id="descriptionInput" value={{ old('post_content', $content->post_content) }}>
                    </div>
                </div>

                <!-- Meta Fields (Dynamic) -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="banner_image">Banner Image</label>
                        @php
                            $bannerMeta = $content->meta->firstWhere('meta_key', 'banner_image');
                        @endphp
                        <input type="file" class="dropify" name="banner_image"
                        data-default-file="{{ old('banner_image') ? asset(old('banner_image')) : ($bannerMeta ? asset($bannerMeta->meta_value) : '') }}" />
                        {{-- <input type="file" name="meta[banner_image]" class="form-control"> --}}
                    </div>
                </div>

                <!-- Add more meta fields like button_text, seo_title, etc. as needed -->

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update Content</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': 'The file size is too big (1M max).'
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize Summernote
            $('#summernote').summernote({
                height: 300, // Set the height of the editor
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']]
                ]
            });


            var description = $('#descriptionInput').val();

            if(!description.trim())
            {
                return false
            }
            
            $('#summernote').summernote('code', description);

            // Synchronize Summernote content with hidden input field
            $('#summernote').on('summernote.change', function() {
                var content = $('#summernote').summernote('code');
                $('#descriptionInput').val(content);
            });
            
        });
    </script>
@endsection
