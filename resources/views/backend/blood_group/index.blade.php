@extends('backend.layouts.app')

@section('content')
<div class="row">

    {{-- ================= FORM ================= --}}
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">
                    {{ isset($editItem) ? 'Edit Blood Group' : 'Add Blood Group' }}
                </h5>
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ isset($editItem)
                            ? route('blood-group.update', $editItem->id)
                            : route('blood-group.store') }}">

                    @csrf
                    @isset($editItem)
                        @method('PATCH')
                    @endisset

                    {{-- Blood Group --}}
                    <div class="mb-3">
                        <label class="form-label">Blood Group <span class="text-danger">*</span></label>
                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $editItem->name ?? '') }}"
                               placeholder="A+, O-, AB+"
                               required>

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $editItem->title ?? '') }}"
                               placeholder="Optional title">

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description"
                                  rows="3"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Short description">{{ old('description', $editItem->description ?? '') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1"
                                {{ old('status', $editItem->status ?? 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="0"
                                {{ old('status', $editItem->status ?? 1) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                    {{-- Button --}}
                    <button class="btn btn-primary w-100">
                        {{ isset($editItem) ? 'Update Blood Group' : 'Save Blood Group' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= LIST ================= --}}
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Blood Group List</h5>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th width="140">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bloodGroups as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->title ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $item->status ? 'success' : 'danger' }}">
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('blood-group.edit', $item->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('blood-group.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure to delete?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No blood groups found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
