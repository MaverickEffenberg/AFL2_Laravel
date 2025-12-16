@extends('layouts.layout', ['title' => $title])

@php use Illuminate\Support\Str; use Illuminate\Support\Facades\Storage; @endphp

@section('content')
<div class="container py-4">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1>Blog</h1>
		@auth
			@if(auth()->user()->role === 'admin')
				<button class="btn btn-success" data-toggle="collapse" data-target="#createForm">New Post</button>
			@endif
		@endauth
	</div>

	{{-- Flash messages --}}
	@if(session('success'))
		<div class="alert alert-success">{{ session('success') }}</div>
	@endif

	{{-- Create form for admin (collapsible) --}}
	@auth
		@if(auth()->user()->role === 'admin')
			<div id="createForm" class="collapse mb-4">
				<form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>Title</label>
						<input name="title" class="form-control" required value="{{ old('title') }}">
					</div>
					<div class="form-group">
						<input id="content" type="hidden" name="content" value="{{ old('content') }}">
						<trix-editor input="content"></trix-editor>
					</div>
					<div class="form-group">
						<label>Image (optional)</label>
						<input type="file" name="image" class="form-control-file">
					</div>
					<button class="btn btn-primary">Save</button>
				</form>
			</div>
		@endif
	@endauth

	{{-- List posts --}}
	@forelse($blogs as $blog)
		<div class="card mb-3">
				<div class="card-body">
				@if($blog->image_url)
					<img src="{{ asset($blog->image_url) }}" class="img-fluid mb-3" alt="{{ $blog->title }}">
				@elseif(!empty($blog->image))
					<img src="{{ Storage::url($blog->image) }}" class="img-fluid mb-3" alt="{{ $blog->title }}">
				@endif
				<h3>{{ $blog->title }}</h3>
				<p class="text-muted">By {{ optional($blog->user)->name ?? 'Unknown' }} • {{ $blog->created_at->format('M d, Y') }}</p>
				<div class="mb-3">{!! Str::limit(strip_tags($blog->content), 500) !!}</div>

				<a class="btn btn-link" data-toggle="collapse" href="#post-{{ $blog->id }}-full" role="button">Read more</a>

				@auth
					@if(auth()->user()->role === 'admin')
						<button class="btn btn-sm btn-outline-primary ml-2" data-toggle="collapse" data-target="#edit-{{ $blog->id }}">Edit</button>
						<form method="POST" action="{{ route('blogs.destroy', $blog) }}" style="display:inline-block;">
							@csrf
							@method('DELETE')
							<button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
						</form>
					@endif
				@endauth

				<div class="collapse mt-3" id="post-{{ $blog->id }}-full">
					<div class="card card-body">{!! $blog->content !!}</div>
				</div>

				{{-- Edit form (admin) --}}
				@auth
					@if(auth()->user()->role === 'admin')
						<div class="collapse mt-3" id="edit-{{ $blog->id }}">
							<form method="POST" action="{{ route('blogs.update', $blog) }}" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="form-group">
									<label>Title</label>
									<input name="title" class="form-control" required value="{{ old('title', $blog->title) }}">
								</div>
								<div class="form-group">
									<input id="content-{{ $blog->id }}" type="hidden" name="content" value="{{ old('content', $blog->content) }}">
									<trix-editor input="content-{{ $blog->id }}"></trix-editor>
								</div>
								<div class="form-group">
									<label>Image (optional)</label>
									<input type="file" name="image" class="form-control-file">
								</div>
								<button class="btn btn-primary">Update</button>
							</form>
						</div>
					@endif
				@endauth

			</div>
		</div>
	@empty
		<p>No posts yet.</p>
	@endforelse

	{{-- pagination --}}
	<div class="mt-4">{{ $blogs->links() }}</div>

</div>
@endsection
