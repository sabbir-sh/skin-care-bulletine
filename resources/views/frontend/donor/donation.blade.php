@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
                
                {{-- হেডার --}}
                <div class="card-header border-0 text-center p-4" style="background: linear-gradient(45deg, #dc3545, #ff4d5a);">
                    <h3 class="text-white fw-bold mb-0 mt-2">
                        <i class="fas fa-heartbeat me-2"></i> মানবিক অনুদান
                    </h3>
                    <p class="text-white-50 small mb-0">আপনার সাহায্য অন্যের জীবন বাঁচাতে পারে</p>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    
                    {{-- সাকসেস/এরর মেসেজ --}}
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px;">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 15px;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row g-4">
                        {{-- বাম পাশ: পেমেন্ট ফর্ম --}}
                        <div class="col-md-7">
                            <form action="{{ route('donor.donation.store') }}" method="POST">
                                @csrf

                                {{-- পরিমাণ নির্বাচন --}}
                                <div class="mb-4">
                                    <label class="fw-bold mb-3 d-block text-dark small text-uppercase">
                                        <i class="fas fa-hand-holding-usd text-danger me-2"></i> অনুদানের পরিমাণ
                                    </label>
                                    <div class="row g-2 text-center">
                                        @foreach([100 => '১০০', 200 => '২০০', 300 => '৩০০', 400 => '৪০০', 500 => '৫০০', 1000 => '১০০০'] as $value => $label)
                                            <div class="col-6 col-sm-3 col-md-6">
                                                <input type="radio" class="btn-check" name="amount" id="amt-{{ $value }}" value="{{ $value }}" {{ $value == 200 ? 'checked' : '' }}>
                                                <label class="btn btn-outline-danger w-100 py-2 fw-bold rounded-3" for="amt-{{ $value }}">৳ {{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="number" name="custom_amount" id="custom_amount" class="form-control mt-3 rounded-3" placeholder="অন্যান্য পরিমাণ (ঐচ্ছিক)">
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
                                                <label class="btn btn-outline-light border w-100 py-3 rounded-3 text-dark small fw-bold" for="pay-{{ $id }}">{{ $name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- ট্রানজেকশন আইডি ও ফোন --}}
                                <div class="mb-4 bg-light p-3 rounded-4 border border-dashed">
                                    <input type="text" name="transaction_id" class="form-control mb-3 border-0 shadow-sm" placeholder="Transaction ID (TrxID)" required>
                                    <input type="text" name="phone" class="form-control border-0 shadow-sm" placeholder="আপনার ফোন নম্বর (০১৭XXXXXXXX)" required>
                                </div>

                                <button type="submit" class="btn btn-danger w-100 py-3 fw-bold rounded-pill shadow">
                                    <i class="fas fa-check-circle me-2"></i> অনুদান নিশ্চিত করুন
                                </button>
                            </form>
                        </div>

                        {{-- ডান পাশ: নির্দেশাবলী ও তথ্য --}}
                        <div class="col-md-5">
                            {{-- পেমেন্ট নির্দেশাবলী --}}
                            <div class="instruction-box p-3 rounded-4 mb-4" style="background: #fff5f5; border-left: 4px solid #dc3545;">
                                <h6 class="fw-bold mb-3 text-dark"><i class="fas fa-cog me-2"></i> পেমেন্ট নির্দেশাবলী</h6>
                                <div class="d-flex justify-content-between align-items-center mb-3 bg-white p-2 rounded-3 border">
                                    <span class="small fw-bold text-danger">01750512161</span>
                                    <button class="btn btn-sm btn-danger py-0 px-2" onclick="copyNumber()">কপি</button>
                                </div>
                                <ul class="list-unstyled small text-muted mb-0">
                                    <li class="mb-2"><span class="badge bg-danger me-1">1</span> অ্যাপ খুলুন</li>
                                    <li class="mb-2"><span class="badge bg-danger me-1">2</span> <strong>Send Money</strong> নির্বাচন করুন</li>
                                    <li class="mb-2"><span class="badge bg-danger me-1">3</span> এই নম্বরটি লিখুন</li>
                                    <li class="mb-2"><span class="badge bg-danger me-1">4</span> পরিমাণ ও পিন দিন</li>
                                    <li><span class="badge bg-danger me-1">5</span> TrxID টি বাম পাশের ফর্মে দিন</li>
                                </ul>
                            </div>

                            {{-- প্রভাব --}}
                            <div class="impact-box p-3 rounded-4 mb-4 text-white" style="background: linear-gradient(45deg, #474747, #2b2b2b);">
                                <h6 class="fw-bold mb-2"><i class="fas fa-heart me-2"></i> আপনার দানের প্রভাব</h6>
                                <p class="small mb-0 opacity-75">নির্বাচিত পরিমাণ: ৳ <span id="selected_val">২০০</span></p>
                                <hr class="my-2 opacity-25">
                                <p class="small mb-0" style="font-size: 11px;">👉 আপনার এই অনুদান একজন মানুষের জীবন বাঁচাতে ভূমিকা রাখতে পারে।</p>
                            </div>

                            {{-- সহায়তা --}}
                            <div class="help-box small">
                                <h6 class="fw-bold mb-2 text-dark">📞 সহায়তা প্রয়োজন?</h6>
                                <p class="mb-1 text-muted">📱 +880 1750512161</p>
                                <p class="mb-3 text-muted">📧 sabbirhasan.web@gmial.com</p>
                                
                                <div class="p-3 bg-light rounded-4 border">
                                    <h6 class="fw-bold mb-2 text-dark" style="font-size: 13px;">
                                        <i class="fas fa-shield-alt text-success me-1"></i> স্বচ্ছতা ও আস্থা
                                    </h6>
                                    <p class="mb-2 text-muted" style="font-size: 12px; line-height: 1.6;">
                                        <strong class="text-danger">BLOOD FIGHTERS Foundation</strong> একটি সম্পূর্ণ অলাভজনক (Non-Profit) উদ্যোগ।
                                    </p>
                                    <p class="mb-0 text-secondary" style="font-size: 11px; text-align: justify;">
                                        আপনার প্রদানকৃত সকল অনুদান আমাদের এলাকার অসহায়, দরিদ্র এবং হতদরিদ্র মানুষের চিকিৎসা ও সেবামূলক কার্যক্রমে ব্যয় করা হবে। আর্তমানবতার সেবায় আপনার এই অবদান আমাদের শক্তি।
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rounded-4 { border-radius: 15px !important; }
    .btn-check:checked + .btn-outline-danger { background-color: #dc3545; color: #fff; }
    .btn-check:checked + .btn-outline-light { border-color: #dc3545 !important; background: #fff5f5 !important; color: #dc3545 !important; }
    .instruction-box .badge { width: 18px; height: 18px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 10px; }
</style>

<script>
    // অ্যামাউন্ট ডিসপ্লে চেঞ্জ করার জন্য
    document.querySelectorAll('input[name="amount"]').forEach(input => {
        input.addEventListener('change', () => {
            document.getElementById('selected_val').innerText = input.value;
        });
    });

    document.getElementById('custom_amount').addEventListener('input', (e) => {
        if(e.target.value > 0) {
            document.getElementById('selected_val').innerText = e.target.value;
        }
    });

    function copyNumber() {
        navigator.clipboard.writeText("01750512161");
        alert("নম্বর কপি করা হয়েছে!");
    }
</script>
@endsection