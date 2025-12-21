@extends('backend.layouts.app')

@section('title', isset($faq) ? 'Edit FAQ' : 'Add FAQ')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">{{ isset($faq) ? 'Edit FAQ' : 'Add FAQ' }}</h4>

            <form action="{{ isset($faq) ? route('faq.update', $faq->id) : route('faq.store') }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($faq))
                    @method('PATCH')
                @endif

                <div class="mb-3">
                    <label class="form-label">Question</label>
                    <input type="text" name="question" class="form-control" 
                           value="{{ old('question', $faq->question ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Answer</label>
                    <textarea name="answer" class="form-control" rows="4" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="1" {{ (old('status', $faq->status ?? '') == 1) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ (old('status', $faq->status ?? '') == 0) ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if(isset($faq) && $faq->image)
                        <img src="{{ $faq->image_url }}" class="mt-2" width="100" alt="FAQ Image">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($faq) ? 'Update FAQ' : 'Add FAQ' }}
                </button>
                <a href="{{ route('faq.list') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
