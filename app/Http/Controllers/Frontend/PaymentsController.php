<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;

class PaymentsController extends Controller
{
    public function index()
    {
        $recentPayments = Payment::where('status', 1)->latest()->take(10)->get();
        $totalDonation  = Payment::where('status', 1)->sum('amount');

        return view('frontend.donor.donation',
            compact('recentPayments','totalDonation'));
    }

    public function store(PaymentRequest $request)
    {
        $finalAmount = $request->filled('custom_amount')
            ? (int) $request->custom_amount
            : (int) $request->amount;

        Payment::create([
            'amount'         => $finalAmount,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'phone'          => $request->phone,
            'status'         => 0,
        ]);

        return back()->with(
            'success',
            'আপনার অনুদান সফলভাবে জমা হয়েছে। যাচাইয়ের পর প্রকাশ করা হবে।'
        );
    }
}
