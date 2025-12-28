@extends('backend.layouts.app')

@section('title', 'Donor List')

@section('content')
    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div>
                <h3 class="fw-bold mb-0">Donor List</h3>
            </div>

            <a href="{{ route('donor.create') }}" class="btn btn-success rounded-pill px-4">
                <i class="bi bi-plus-circle me-1"></i> Add Donor
            </a>
        </div>

        {{-- Card --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-3">

                <div class="table-responsive">
                    <table id="donorTable" class="table table-hover align-middle table-striped table-bordered mb-0 w-100">
                        <thead class="table-light">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Blood Group</th>
                                <th>District</th>
                                <th>Upazila</th>
                                <th>Status</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function () {
            $('#donorTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("donor.datatable") }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'blood_group', name: 'bloodGroup.name' },
                    { data: 'district', name: 'district' },
                    { data: 'upazila', name: 'upazila' },
                    { data: 'status', name: 'status', orderable: true, searchable: true },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                responsive: true,
                autoWidth: false,
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10,
                language: {
                    processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                },
                drawCallback: function () {
                    // Enable Bootstrap tooltip after table redraw
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script>
@endpush