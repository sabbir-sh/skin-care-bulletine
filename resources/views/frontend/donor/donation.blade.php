@extends('frontend.layouts.app')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
                
                {{-- হেডার --}}
                <div class="card-header border-0 text-center p-4" style="background: linear-gradient(45deg, #dc3545, #ff4d5a);">
                    <h3 class="text-white fw-bold mb-0 mt-2">
                        <i class="fas fa-heartbeat me-2"></i> মানবিক অনুদান
                    </h3>
                    <p class="text-white-50 small mb-0">আপনার সাহায্য অন্যের জীবন বাঁচাতে পারে</p>
                </div>

                <div class="card-body p-3 p-md-5 bg-white">
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 15px;">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row g-4 flex-column-reverse flex-md-row">
                        {{-- বাম পাশ: পেমেন্ট ফর্ম --}}
                        <div class="col-md-7">
                            <form action="{{ route('donor.donation.store') }}" method="POST" id="donationForm">
                                @csrf

                                {{-- পরিমাণ নির্বাচন --}}
                                <div class="mb-4">
                                    <label class="fw-bold mb-3 d-block text-dark small text-uppercase">
                                        <i class="fas fa-hand-holding-usd text-danger me-2"></i> অনুদানের পরিমাণ
                                    </label>
                                    <div class="row g-2 text-center">
                                        @foreach([100 => '১০০', 200 => '২০০', 300 => '৩০০', 500 => '৫০০', 1000 => '১০০০', 2000 => '২০০০'] as $value => $label)
                                            <div class="col-4 col-sm-4">
                                                <input type="radio" class="btn-check" name="amount" id="amt-{{ $value }}" value="{{ $value }}" {{ $value == 200 ? 'checked' : '' }}>
                                                <label class="btn btn-outline-danger w-100 py-2 fw-bold rounded-3 amount-btn" for="amt-{{ $value }}">৳ {{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="input-group mt-3">
                                        <span class="input-group-text bg-light border-end-0 rounded-start-3">৳</span>
                                        <input type="number" name="custom_amount" id="custom_amount" class="form-control border-start-0 rounded-end-3" placeholder="অন্যান্য পরিমাণ লিখুন">
                                    </div>
                                </div>

                                {{-- মেথড নির্বাচন --}}
                                <div class="mb-4">
                                    <label class="fw-bold mb-3 d-block text-dark small text-uppercase">
                                        <i class="fas fa-credit-card text-danger me-2"></i> পেমেন্ট মেথড
                                    </label>
                                    <div class="row g-2">
                                        @foreach(['bkash' => 'bKash', 'nagad' => 'Nagad', 'rocket' => 'Rocket'] as $id => $name)
                                            <div class="col-4">
                                                <input type="radio" class="btn-check" name="payment_method" id="pay-{{ $id }}" value="{{ $id }}" {{ $loop->first ? 'checked' : '' }}>
                                                <label class="btn btn-outline-light border w-100 py-3 rounded-3 text-dark small fw-bold method-btn" for="pay-{{ $id }}">
                                                    {{ $name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- ট্রানজেকশন আইডি ও ফোন --}}
                                <div class="mb-4 bg-light p-3 p-md-4 rounded-4 border border-dashed">
                                    <div class="mb-3">
                                        <label class="small fw-bold text-muted mb-1">Transaction ID</label>
                                        <input type="text" name="transaction_id" class="form-control border-0 shadow-sm py-2" placeholder="Ex: 8N77X8K9" required>
                                    </div>
                                    <div>
                                        <label class="small fw-bold text-muted mb-1">আপনার মোবাইল নম্বর</label>
                                        <input type="text" name="phone" class="form-control border-0 shadow-sm py-2" placeholder="017XXXXXXXX" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-danger w-100 py-3 fw-bold rounded-pill shadow-lg mt-2">
                                    <i class="fas fa-check-circle me-2"></i> অনুদান নিশ্চিত করুন
                                </button>
                            </form>
                        </div>

                        {{-- ডান পাশ: নির্দেশাবলী (মোবাইলে উপরে থাকবে) --}}
                        <div class="col-md-5">
                            {{-- পেমেন্ট নির্দেশাবলী --}}
                            <div class="instruction-box p-3 p-md-4 rounded-4 mb-4" style="background: #fff5f5; border-left: 5px solid #dc3545;">
                                <h6 class="fw-bold mb-3 text-dark"><i class="fas fa-info-circle me-2 text-danger"></i> কিভাবে টাকা পাঠাবেন?</h6>
                                <div class="d-flex justify-content-between align-items-center mb-3 bg-white p-2 px-3 rounded-pill border">
                                    <span class="fw-bold text-danger" id="targetNum">01750512161</span>
                                    <button class="btn btn-sm btn-danger rounded-pill px-3" onclick="copyNumber()">কপি</button>
                                </div>
                                <ul class="list-unstyled small text-muted mb-0 lh-lg">
                                    <li><span class="step-num">১</span> আপনার পেমেন্ট অ্যাপে লগইন করুন</li>
                                    <li><span class="step-num">২</span> <strong>Send Money</strong> অপশনে যান</li>
                                    <li><span class="step-num">৩</span> উপরের নম্বরটি প্রাপক হিসেবে দিন</li>
                                    <li><span class="step-num">৪</span> পরিমাণ দিয়ে পিন ভেরিফাই করুন</li>
                                    <li><span class="step-num">৫</span> প্রাপ্ত <strong>TrxID</strong> বামের ফর্মে দিন</li>
                                </ul>
                            </div>

                            {{-- প্রভাব --}}
                            <div class="impact-box p-3 rounded-4 mb-4 text-white shadow-sm" style="background: linear-gradient(45deg, #2d3436, #000000);">
                                <h6 class="fw-bold mb-2"><i class="fas fa-heart me-2 text-danger"></i> অনুদানের প্রভাব</h6>
                                <p class="small mb-0 opacity-75">আপনার নির্বাচিত পরিমাণ: <br><span class="fs-4 fw-bold text-white">৳ <span id="selected_val">২০০</span></span></p>
                                <hr class="my-2 opacity-25">
                                <p class="small mb-0 fst-italic">"আপনার এই সামান্য দান হতে পারে কারো নতুন জীবনের আশার আলো।"</p>
                            </div>

                            {{-- সহায়তা --}}
                            <div class="help-box p-3 bg-light rounded-4 border">
                                <h6 class="fw-bold mb-2 text-dark" style="font-size: 14px;">
                                    <i class="fas fa-shield-alt text-success me-1"></i> স্বচ্ছতা ও ট্রাস্ট
                                </h6>
                                <p class="mb-0 text-secondary" style="font-size: 12px; text-align: justify; line-height: 1.5;">
                                    <strong class="text-danger">BLOOD FIGHTERS Foundation</strong> একটি অলাভজনক সামাজিক সংগঠন। আপনার টাকা সরাসরি আর্তমানবতার সেবায় ব্যয় করা হয়। যেকোনো প্রয়োজনে কল করুন: <strong>01750512161</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* কাস্টম স্টাইলসমূহ */
    .rounded-4 { border-radius: 15px !important; }
    .btn-check:checked + .amount-btn { background-color: #dc3545 !important; color: #fff !important; transform: scale(1.05); }
    .btn-check:checked + .method-btn { border-color: #dc3545 !important; background: #fff5f5 !important; color: #dc3545 !important; }
    
    .step-num {
        width: 22px; height: 22px; background: #dc3545; color: white; 
        display: inline-flex; align-items: center; justify-content: center; 
        border-radius: 50%; font-size: 11px; margin-right: 8px; font-weight: bold;
    }

    /* মোবাইল রেসপন্সিভ ফিক্স */
    @media (max-width: 768px) {
        .flex-column-reverse {
            display: flex;
            flex-direction: column-reverse !important;
        }
        .card-header h3 { font-size: 1.25rem; }
        .amount-btn { font-size: 14px; padding: 10px 5px !important; }
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #dc3545;
    }
</style>

<script>
    // অ্যামাউন্ট আপডেট করার লজিক
    const amountRadios = document.querySelectorAll('input[name="amount"]');
    const customInput = document.getElementById('custom_amount');
    const displayVal = document.getElementById('selected_val');

    amountRadios.forEach(input => {
        input.addEventListener('change', () => {
            displayVal.innerText = input.value;
            customInput.value = ''; // রেডিও সিলেক্ট করলে কাস্টম ইনপুট খালি হবে
        });
    });

    customInput.addEventListener('input', (e) => {
        if(e.target.value > 0) {
            displayVal.innerText = e.target.value;
            // রেডিও বাটন আনচেক করা (ঐচ্ছিক)
            amountRadios.forEach(r => r.checked = false);
        }
    });

    // নম্বর কপি করার ফাংশন
    function copyNumber() {
        const num = document.getElementById('targetNum').innerText;
        navigator.clipboard.writeText(num).then(() => {
            alert("নম্বরটি কপি করা হয়েছে: " + num);
        });
    }
</script>

@if(session('success'))
<script>
    // সাকসেস মেসেজ মডাল
    document.addEventListener("DOMContentLoaded", function () {
        const modalHtml = `
        <div class="modal fade show" id="successModal" style="display:block; background:rgba(0,0,0,0.6); z-index: 9999;" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered px-3">
                <div class="modal-content border-0 shadow" style="border-radius:20px;">
                    <div class="modal-body text-center p-5">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size:70px;"></i>
                        </div>
                        <h3 class="fw-bold">অসংখ্য ধন্যবাদ!</h3>
                        <p class="text-muted">{{ session('success') }}</p>
                        <button class="btn btn-danger px-5 py-2 rounded-pill fw-bold" onclick="document.getElementById('successModal').remove()">ঠিক আছে</button>
                    </div>
                </div>
            </div>
        </div>`;
        document.body.insertAdjacentHTML('beforeend', modalHtml);
    });
</script>
@endif
@endsection