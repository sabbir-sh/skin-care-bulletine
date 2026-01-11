<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * ইউজারের এই রিকোয়েস্টটি করার অনুমতি আছে কি না।
     */
    public function authorize(): bool
    {
        return true; // আপাতত সবার জন্য উন্মুক্ত রাখতে true করে দিন
    }

    /**
     * ভ্যালিডেশন রুলস।
     */
    public function rules(): array
    {
        return [
            'amount'         => 'required',
            'payment_method' => 'required|string|in:bkash,nagad,rocket,cellfin',
            'phone'          => 'required|string|min:11|max:15',
            'transaction_id' => 'required|string|max:50|unique:payments,transaction_id',
            'custom_amount'  => 'required_if:amount,custom|nullable|numeric|min:10',
        ];
    }

    /**
     * কাস্টম এরর মেসেজ (ঐচ্ছিক)।
     */
    public function messages(): array
    {
        return [
            'amount.required'         => 'অনুগ্রহ করে দানের পরিমাণ নির্বাচন করুন।',
            'payment_method.required' => 'একটি পেমেন্ট পদ্ধতি বাছাই করুন।',
            'phone.required'          => 'যে নম্বর থেকে টাকা পাঠিয়েছেন তা প্রদান করুন।',
            'transaction_id.required' => 'ট্রানজেকশন আইডি (TrxID) প্রদান করা বাধ্যতামূলক।',
            'transaction_id.unique'   => 'এই ট্রানজেকশন আইডিটি ইতিমধ্যে আমাদের সিস্টেমে রয়েছে।',
            'custom_amount.required_if' => 'আপনি কাস্টম পরিমাণ সিলেক্ট করেছেন, তাই টাকার অংক লিখুন।',
        ];
    }
}