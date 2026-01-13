<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    public function index()
    {
        return view('backend.payments.index');
    }

    public function datatable(Request $request)
    {
        $payments = Payment::latest();

        return DataTables::of($payments)
            ->addColumn('date', fn($p) => $p->created_at->format('d/m/Y'))

            ->addColumn(
                'method',
                fn($p) =>
                '<span class="badge bg-secondary text-uppercase">' . $p->payment_method . '</span>'
            )

            ->addColumn(
                'phone',
                fn($p) =>
                '<strong>' . $p->phone . '</strong>'
            )

            ->addColumn(
                'trx',
                fn($p) =>
                '<code class="text-danger fw-bold">' . $p->transaction_id . '</code>'
            )

            ->addColumn(
                'amount',
                fn($p) =>
                '৳ ' . number_format($p->amount)
            )

            ->addColumn('status', function ($p) {
                return $p->status == 0
                    ? '<span class="badge bg-warning">Pending</span>'
                    : '<span class="badge bg-success">Verified</span>';
            })

            ->addColumn('action', function ($p) {

                $approveBtn = '';
                if ($p->status == 0) {
                    $approveBtn = '
                        <form method="POST" action="' . route('payment.approve', $p->id) . '" class="d-inline">
                            ' . csrf_field() . method_field('PATCH') . '
                            <button
                                type="submit"
                                class="action-btn action-approve"
                                data-bs-toggle="tooltip"
                                title="Approve Payment"
                                onclick="return confirm(\'Approve this payment?\')">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>';
                                }

                                $deleteBtn = '
                    <form method="POST" action="' . route('payment.destroy', $p->id) . '" class="d-inline">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button
                            type="submit"
                            class="action-btn action-delete"
                            data-bs-toggle="tooltip"
                            title="Delete Payment"
                            onclick="return confirm(\'Delete this payment?\')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>';

                return '<div class="d-flex justify-content-center gap-2">' . $approveBtn . $deleteBtn . '</div>';
            })


            ->rawColumns(['method', 'trx', 'status', 'action', 'phone'])
            ->make(true);
    }

    public function approve($id)
    {
        Payment::findOrFail($id)->update(['status' => 1]);
        return back()->with('success', 'পেমেন্ট ভেরিফাই করা হয়েছে');
    }

    public function destroy($id)
    {
        Payment::findOrFail($id)->delete();
        return back()->with('success', 'পেমেন্ট ডিলিট করা হয়েছে');
    }
}
