@extends('backend.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold text-dark mb-0"><i class="fas fa-money-check-alt text-danger me-2"></i> অনুদান ম্যানেজমেন্ট</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>তারিখ</th>
                            <th>মেথড</th>
                            <th>ফোন নম্বর</th>
                            <th>TrxID</th>
                            <th>পরিমাণ</th>
                            <th>স্ট্যাটাস</th>
                            <th class="text-center">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr>
                            <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-secondary text-uppercase">{{ $payment->payment_method }}</span>
                            </td>
                            <td class="fw-bold">{{ $payment->phone }}</td>
                            <td><code class="text-danger fw-bold">{{ $payment->transaction_id }}</code></td>
                            <td class="fw-bold">৳ {{ number_format($payment->amount) }}</td>
                            <td>
                                @if($payment->status == 0)
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-success">Verified</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Approve Button (Only if pending) --}}
                                    @if($payment->status == 0)
                                    <form action="{{ route('payment.approve', $payment->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm" onclick="return confirm('আপনি কি নিশ্চিত যে এই পেমেন্টটি ভেরিফাইড?')">
                                            <i class="fas fa-check me-1"></i> Approve
                                        </button>
                                    </form>
                                    @endif

                                    {{-- Delete Button --}}
                                    <form action="{{ route('payment.destroy', $payment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm" onclick="return confirm('আপনি কি এটি মুছে ফেলতে চান?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">কোনো পেমেন্ট রেকর্ড পাওয়া যায়নি।</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection