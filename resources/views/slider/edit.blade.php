@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
        <h1 class="text-4xl text-gray-900">Edit Slider</h1>

            <div class="card mt-4">
                <div class="card-body">

                    <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $slider->title }}" name="title" required>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="caption" class="form-label">Caption</label>
                            <input type="text" class="form-control @error('caption') is-invalid @enderror" id="caption" value="{{ $slider->caption }}" name="caption" required>
                            @error('caption')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Slider Image <small>(optional)</small> </label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" accept=".jpg, .jpeg, .png., .webp">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" aria-label="Select status" id="status" name="status">
                                <option selected disabled>- Choose -</option>
                                <option value="approve" {{ $slider->status == 'approve' ? 'selected' : '' }}>Approve</option>
                                <option value="reject" {{ $slider->status == 'reject' ? 'selected' : '' }}>Reject</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('slider.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection