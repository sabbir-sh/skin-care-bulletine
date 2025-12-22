@extends('backend.layouts.app')

@section('title', isset($faq) ? 'Edit FAQ' : 'Add FAQ')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">
                {{ isset($faq) ? 'Edit FAQ' : 'Add FAQ' }}
            </h3>
            <small class="text-muted">
                {{ isset($faq) ? 'Update existing FAQ information' : 'Create a new FAQ' }}
            </small>
        </div>

        <a href="{{ route('faq.list') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    {{-- Card --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ isset($faq) ? route('faq.update', $faq->id) : route('faq.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($faq))
                    @method('PATCH')
                @endif

                <div class="row g-4">

                    {{-- Question --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Question <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="question"
                               class="form-control"
                               placeholder="Enter FAQ question"
                               value="{{ old('question', $faq->question ?? '') }}"
                               required>
                    </div>

                    {{-- Answer --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Answer <span class="text-danger">*</span>
                        </label>
                        <textarea name="answer"
                                  class="form-control"
                                  rows="5"
                                  placeholder="Write the FAQ answer here..."
                                  required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ old('status', $faq->status ?? 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="0" {{ old('status', $faq->status ?? 1) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                    {{-- Image --}}
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Image</label>
                        <input type="file" name="image" class="form-control">

                        @if(isset($faq) && $faq->image)
                            <div class="mt-3">
                                <small class="text-muted d-block mb-1">Current Image</small>
                                <img src="{{ $faq->image_url }}"
                                     class="rounded border shadow-sm"
                                     width="120"
                                     alt="FAQ Image">
                            </div>
                        @endif
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4 rounded-pill">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ isset($faq) ? 'Update FAQ' : 'Save FAQ' }}
                    </button>

                    <a href="{{ route('faq.list') }}"
                       class="btn btn-outline-secondary rounded-pill px-4">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
