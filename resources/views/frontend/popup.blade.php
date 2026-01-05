{{-- HOME PAGE POPUP --}}
<div class="modal fade" id="homePopup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 pulse-animation"
             style="border-radius:25px; overflow:hidden; box-shadow: 0 25px 50px rgba(0,0,0,0.2);">

            {{-- টপ প্রগ্রেস বার (১০ সেকেন্ডের কাউন্টডাউন ভিজ্যুয়াল) --}}
            <div style="height: 5px; background: #eee; width: 100%;">
                <div id="popupProgress" style="height: 100%; background: #dc3545; width: 100%; transition: width 10s linear;"></div>
            </div>

            {{-- Header with Animated Icon --}}
            <div style="background:linear-gradient(135deg,#dc3545,#ff4d5a); padding:30px 20px; text-align:center; color:#fff; position: relative;">
                <div class="heart-icon">
                    <i class="fas fa-heartbeat" style="font-size: 50px;"></i>
                </div>
                <h4 style="margin-top:15px; font-weight:800; letter-spacing: 1px;">
                    জরুরি রক্তদান আহ্বান
                </h4>
            </div>

            {{-- Body --}}
            <div class="modal-body text-center" style="padding:35px 25px;">
                <h5 style="font-weight:700; color:#333; margin-bottom: 15px;">আপনি কি রক্তদাতা হতে আগ্রহী?</h5>
                <p style="font-size:15px; color:#666; line-height: 1.6;">
                    আপনার সামান্য রক্তদান, একটি পরিবারের মুখে হাসি ফোটাতে পারে। আজই আমাদের যোদ্ধা হিসেবে যুক্ত হোন।
                </p>

                <div style="margin-top: 25px;">
                    <a href="{{ url('/be-a-fighter-register') }}"
                       class="btn btn-danger w-100 fw-bold mb-3 shadow-lg"
                       style="border-radius:15px; padding: 12px; font-size: 17px; background: #dc3545; border:none;">
                       <i class="fas fa-user-plus me-2"></i> নিবন্ধন করুন
                    </a>

                    <button type="button"
                            class="btn btn-link w-100 text-muted text-decoration-none small"
                            data-bs-dismiss="modal">
                        এখন নয়, পরে দেখব
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* পপআপ আসার এনিমেশন */
    .pulse-animation {
        animation: popupEntrance 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes popupEntrance {
        from { opacity: 0; transform: scale(0.8); }
        to { opacity: 1; transform: scale(1); }
    }

    /* হার্টবিট এনিমেশন */
    .heart-icon i {
        display: inline-block;
        animation: heartBeat 1.5s infinite;
    }

    @keyframes heartBeat {
        0% { transform: scale(1); }
        15% { transform: scale(1.3); }
        30% { transform: scale(1); }
        45% { transform: scale(1.15); }
        60% { transform: scale(1); }
    }

    /* পপআপ ভ্যানিশ হওয়ার স্মুথ এনিমেশন */
    .modal.fade-out .modal-dialog {
        transform: scale(0.9);
        opacity: 0;
        transition: all 0.5s ease;
    }
</style>

{{-- Logic: Auto Show, Auto Progress, and Auto Hide --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Only on homepage (/)
    if (window.location.pathname === "/") {
        const popupElement = document.getElementById('homePopup');
        const progressBar = document.getElementById('popupProgress');
        
        let popup = new bootstrap.Modal(popupElement);
        popup.show();

        // ১. প্রগ্রেস বার শুরু করা (১০ সেকেন্ড)
        setTimeout(() => {
            progressBar.style.width = "0%";
        }, 100);

        // ২. ১০ সেকেন্ড পর অটো বন্ধ হওয়া
        setTimeout(() => {
            // সুন্দরভাবে ভ্যানিশ করার জন্য ক্লাস যোগ করা
            popupElement.classList.add('fade-out');
            
            setTimeout(() => {
                popup.hide();
            }, 500); // এনিমেশন শেষ হওয়ার পর হাইড
        }, 10000); // ১০,০০০ মিলিসেকেন্ড = ১০ সেকেন্ড
    }
});
</script>