@extends('layouts.app')

@section('title', 'Community - Maro Adventure')

@section('content')
<div class="bg-light pb-5" style="min-height: 100vh; padding-top: 100px;">
    <div class="container py-4">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                @include('dashboard.partials.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="ps-lg-4">
                    
                    <!-- Header Section -->
                    <div class="mb-4">
                        <h2 class="fw-bold mb-1" style="color: var(--color-dark);">Community</h2>
                        <p class="text-muted">Bagikan cerita dan temukan inspirasi dari pendaki lain.</p>
                    </div>

                    <!-- Create Post -->
                    <div class="card border-0 shadow-sm rounded-4 mb-5">
                        <div class="card-body p-4">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                                    {{ $errors->first() }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ route('dashboard.community.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 48px; height: 48px; font-size: 1.5rem; font-weight: bold;">
                                        {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'U' }}
                                    </div>
                                    <div class="flex-grow-1">
                                        <textarea class="form-control border-0 bg-light rounded-4 px-4 py-3 w-100" rows="3" placeholder="Bagikan cerita petualanganmu..." style="resize: none;" name="story" id="postStory"></textarea>
                                        
                                        <!-- Image Preview Container -->
                                        <div id="imagePreviewContainer" class="mt-3 position-relative d-none" style="width: fit-content;">
                                            <img id="postImagePreview" src="" alt="Preview" class="img-fluid rounded-3" style="max-height: 200px;">
                                            <button type="button" id="removeImageBtn" class="btn btn-danger btn-sm position-absolute rounded-circle shadow d-flex align-items-center justify-content-center" style="top: -10px; right: -10px; width: 28px; height: 28px; padding: 0;"><i class="bi bi-x"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-2">
                                    <div>
                                        <label for="postImage" class="btn btn-light text-primary fw-medium rounded-pill px-3 py-2 cursor-pointer mb-0" style="cursor: pointer;">
                                            <i class="bi bi-image me-1"></i> Tambah Foto
                                        </label>
                                        <input type="file" id="postImage" name="image" accept="image/*" class="d-none">
                                    </div>
                                    <button type="submit" class="btn btn-dark fw-medium px-4 rounded-pill">Posting Cerita</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Posts Grid -->
                    <div class="row g-4" id="postsContainer">
                        @forelse($posts as $post)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold mb-0">{{ $post->user->name }} <span class="fw-normal text-muted small ms-2">{{ $post->created_at->format('d M Y') }}</span></h6>
                                    @if($post->content)
                                        <p class="mt-2 mb-3 text-dark">{!! nl2br(e($post->content)) !!}</p>
                                    @endif
                                    
                                    @if($post->image)
                                        <div class="rounded-3 overflow-hidden mb-3" style="height: 200px;">
                                            <img src="{{ Storage::url($post->image) }}" class="w-100 h-100" style="object-fit: cover;" alt="Post Image">
                                        </div>
                                    @endif

                                    <div class="d-flex align-items-center text-muted small gap-4 mt-auto pt-3">
                                        <div class="cursor-pointer d-flex align-items-center gap-1"><i class="bi bi-heart"></i> 0 Likes</div>
                                        <div class="cursor-pointer d-flex align-items-center gap-1"><i class="bi bi-chat"></i> 0 Comments</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center text-muted py-5">
                            <i class="bi bi-chat-square-text display-4 d-block mb-3"></i>
                            <p>Belum ada cerita yang dibagikan. Jadilah yang pertama!</p>
                        </div>
                        @endforelse
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
    .cursor-pointer {
        cursor: pointer;
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const postImageInput = document.getElementById('postImage');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const postImagePreview = document.getElementById('postImagePreview');
    const removeImageBtn = document.getElementById('removeImageBtn');

    if (postImageInput) {
        postImageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    postImagePreview.src = e.target.result;
                    imagePreviewContainer.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    }

    if (removeImageBtn) {
        removeImageBtn.addEventListener('click', function() {
            postImageInput.value = '';
            imagePreviewContainer.classList.add('d-none');
            postImagePreview.src = '';
        });
    }
});
</script>
@endpush


@endsection
