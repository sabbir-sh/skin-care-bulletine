<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // সব পেমেন্টের তালিকা দেখানো
    public function index()
    {
        $payments = Payment::latest()->paginate(15);
        return view('backend.payments.index', compact('payments'));
    }

    // পেমেন্ট এপ্রুভ করা (PATCH)
    public function approve($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update(['status' => 1]); // ১ মানে Verified/Approved

        return redirect()->back()->with('success', 'পেমেন্টটি সফলভাবে ভেরিফাই করা হয়েছে।');
    }

    // পেমেন্ট ডিলিট করা (DELETE)
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->back()->with('success', 'পেমেন্ট রেকর্ডটি মুছে ফেলা হয়েছে।');
    }
}