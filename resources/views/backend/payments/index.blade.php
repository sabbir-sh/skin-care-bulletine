@extends('backend.layouts.app')

@section('title', 'Payment List')

@section('content')
<div class="container-fluid" style="padding: 25px 40px; background-color: #f9f9f9; min-height: 100vh;">

    {{-- Header --}}
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <h2 style="font-weight:800;color:#111;letter-spacing:-1px;font-size:32px;">
                Donation Payment Management
            </h2>
            <p style="color:#666;font-size:15px;">
                Review, verify and manage all donation payments.
            </p>
        </div>
    </div>

    {{-- Card --}}
    <div class="card border-0 shadow-sm"
        style="border-radius:20px;overflow:hidden;border:1px solid #eee;background:#fff;">
        {{-- Table --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="paymentTable"
                    class="table table-hover align-middle w-100"
                    style="margin:0;border-collapse:separate;">
                    <thead style="background:#fcfcfc;">
                        <tr style="border-bottom:2px solid #f0f0f0;">
                            <th class="ps-4">Date</th>
                            <th>Method</th>
                            <th>Phone</th>
                            <th>Trx ID</th>
                            <th>Amount</th>
                            <th width="100">Status</th>
                            <th class="pe-4 text-center" width="160">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- AJAX --}}
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
    $('#paymentTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("payment.datatable") }}',
        columns: [
            { data: 'date', name: 'created_at', className: 'ps-4 fw-bold text-muted' },
            { data: 'method', orderable:false, searchable:false },
            { data: 'phone', name: 'phone', className: 'fw-bold text-dark' },
            { data: 'trx', name: 'transaction_id' },
            { data: 'amount', name: 'amount' },
            { data: 'status', orderable:false },
            { data: 'action', orderable:false, searchable:false, className: 'text-center pe-4' },
        ],
        lengthMenu: [10, 25, 50, 100],
        pageLength: 10,
        language: {
            search: "",
            searchPlaceholder: "Search payment...",
            processing: '<div class="spinner-border text-warning"></div>'
        },
        drawCallback: function () {
            $('#paymentTable tbody tr td').css({
                paddingTop: '22px',
                paddingBottom: '22px',
                borderBottom: '1px solid #f8f8f8',
                fontSize: '15px',
                color: '#444'
            });

            $('.pagination').css('padding', '25px');
            $('.page-link').css({
                border: 'none',
                margin: '0 4px',
                borderRadius: '8px',
                fontWeight: '600'
            });
        }
    });

    $('.dataTables_filter input').css({
        border: '1px solid #ddd',
        borderRadius: '10px',
        padding: '8px 15px',
        width: '300px',
        background: '#fdfdfd'
    });

    $('.dataTables_length, .dataTables_filter').css('padding', '25px');
});
</script>
@endpush
