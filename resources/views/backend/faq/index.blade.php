@extends('backend.layouts.app')

@section('title', 'FAQ List')

@section('content')
    {{-- Main Wrapper: Full Width --}}
    <div class="container-fluid" style="padding: 25px 40px; background-color: #f9f9f9; min-height: 100vh;">

        {{-- 1. Header Section --}}
        <div class="row align-items-center" style="margin-bottom: 30px;">
            <div class="col-md-7">
                <h2 style="font-weight: 800; color: #111; letter-spacing: -1px; margin-bottom: 8px; font-size: 32px;">
                    FAQ Management
                </h2>
                <p style="color: #666; font-size: 15px; margin-bottom: 0; font-weight: 400;">
                    Organize and manage frequently asked questions for your users.
                </p>
            </div>
            <div class="col-md-5 text-md-end">
                <a href="{{ route('faq.create') }}" class="btn btn-success shadow-sm" 
                   style="border-radius: 12px; padding: 12px 30px; font-weight: 600; font-size: 15px; border: none; transition: 0.3s; background-color: #198754;">
                    <i class="fas fa-plus-circle me-2"></i> Add New FAQ
                </a>
            </div>
        </div>

        {{-- 2. Content Card Section --}}
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden; border: 1px solid #eee !important; background: #fff;">
            
            {{-- Card Header --}}
            <div class="card-header bg-white border-0" style="padding: 24px; border-bottom: 1px solid #f0f0f0 !important;">
                <div class="d-flex align-items-center">
                    <div style="background: #e8f5e9; padding: 12px; border-radius: 14px; margin-right: 18px;">
                        <i class="fas fa-question-circle" style="color: #2e7d32; font-size: 22px;"></i>
                    </div>
                    <div>
                        <h5 style="margin-bottom: 0; font-weight: 700; color: #333; font-size: 18px;">FAQ Directory</h5>
                        <small class="text-muted">Total questions and answers listed</small>
                    </div>
                </div>
            </div>

            {{-- 3. Table Section --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="faqTable" class="table table-hover align-middle w-100" style="margin: 0; border-collapse: separate;">
                        <thead style="background-color: #fcfcfc;">
                            <tr style="border-bottom: 2px solid #f0f0f0;">
                                <th class="ps-4" style="color: #999; font-size: 12px; text-uppercase; font-weight: 700; letter-spacing: 1px; padding: 15px 10px;">SL</th>
                                <th style="color: #999; font-size: 12px; text-uppercase; font-weight: 700; letter-spacing: 1px; padding: 15px 10px;">Image</th>
                                <th style="color: #999; font-size: 12px; text-uppercase; font-weight: 700; letter-spacing: 1px; padding: 15px 10px;">Question</th>
                                <th style="color: #999; font-size: 12px; text-uppercase; font-weight: 700; letter-spacing: 1px; padding: 15px 10px;">Answer Summary</th>
                                <th style="color: #999; font-size: 12px; text-uppercase; font-weight: 700; letter-spacing: 1px; padding: 15px 10px;" width="100">Status</th>
                                <th class="pe-4 text-center" style="color: #999; font-size: 12px; text-uppercase; font-weight: 700; letter-spacing: 1px; padding: 15px 10px;" width="160">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="border-top: none;">
                            {{-- AJAX Content --}}
                        </tbody>
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
    var table = $('#faqTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("faq.datatable") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'ps-4 fw-bold text-muted' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'question', name: 'question', className: 'fw-bold text-dark' },
            { data: 'answer', name: 'answer' },
            { data: 'status', name: 'status' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center pe-4' },
        ],
        responsive: true,
        autoWidth: false,
        lengthMenu: [10, 25, 50, 100],
        pageLength: 10,
        language: {
            search: "",
            searchPlaceholder: "Search FAQ...",
            processing: '<div class="spinner-border text-success" role="status"></div>'
        },
        "drawCallback": function(settings) {
            $('#faqTable tbody tr td').css({
                'padding-top': '24px',
                'padding-bottom': '24px',
                'border-bottom': '1px solid #f8f8f8',
                'font-size': '15px',
                'color': '#444'
            });
            
            $('.pagination').css('padding', '25px');
            $('.page-link').css({
                'border': 'none',
                'margin': '0 4px',
                'border-radius': '8px',
                'font-weight': '600'
            });
            
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    });

    $('.dataTables_filter input').css({
        'border': '1px solid #ddd',
        'border-radius': '10px',
        'padding': '8px 15px',
        'width': '300px',
        'background': '#fdfdfd',
        'outline': 'none'
    });

    $('.dataTables_length, .dataTables_filter').css('padding', '25px');
});
</script>
@endpush