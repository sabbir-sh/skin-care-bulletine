            <style>
                @keyframes float {
                    0% {
                        transform: translateY(0px);
                    }

                    50% {
                        transform: translateY(-10px);
                    }

                    100% {
                        transform: translateY(0px);
                    }
                }

                .floating-card {
                    animation: float 4s ease-in-out infinite;
                }

                .counter-card {
                    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                    border: 1px solid rgba(0, 0, 0, 0.05);
                }

                .counter-card:hover {
                    transform: translateY(-15px) scale(1.02);
                    box-shadow: 0 20px 40px rgba(220, 53, 69, 0.1) !important;
                }

                .icon-circle {
                    transition: all 0.5s ease;
                }

                .counter-card:hover .icon-circle {
                    transform: rotateY(180deg);
                }
            </style>

            <section class="py-5" style="background: linear-gradient(to bottom, #ffffff, #fcfcfc);">
                <div class="container">
                    <div class="row g-4 justify-content-center">

                        <div class="col-6 col-md-3 floating-card">
                            <div class="counter-card text-center p-4 shadow-sm bg-white h-100" style="border-radius: 30px;">
                                <div class="icon-circle mb-3 mx-auto"
                                    style="width: 80px; height: 80px; background: #fff5f5; border-radius: 25px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-users fa-2x text-danger"></i>
                                </div>
                                <h2 class="counter-value fw-black mb-1" data-target="{{ $total_donors }}"
                                    style="color: #2d3436; font-size: 2.8rem; letter-spacing: -1px;">0</h2>
                                <p class="text-uppercase small fw-bold text-muted mb-0" style="letter-spacing: 1px;">Total
                                    Donors</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 floating-card" style="animation-delay: 0.5s;">
                            <div class="counter-card text-center p-4 shadow-sm bg-white h-100" style="border-radius: 30px;">
                                <div class="icon-circle mb-3 mx-auto"
                                    style="width: 80px; height: 80px; background: #f1fcf6; border-radius: 25px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-heartbeat fa-2x text-success"></i>
                                </div>
                                <h2 class="counter-value fw-black mb-1" data-target="{{ $available_donors }}"
                                    style="color: #2d3436; font-size: 2.8rem; letter-spacing: -1px;">0</h2>
                                <p class="text-uppercase small fw-bold text-muted mb-0" style="letter-spacing: 1px;">
                                    Available Now</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 floating-card" style="animation-delay: 1s;">
                            <div class="counter-card text-center p-4 shadow-sm bg-white h-100" style="border-radius: 30px;">
                                <div class="icon-circle mb-3 mx-auto"
                                    style="width: 80px; height: 80px; background: #fffdf2; border-radius: 25px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-droplet fa-2x text-warning"></i>
                                </div>
                                <h2 class="counter-value fw-black mb-1" data-target="{{ $total_groups }}"
                                    style="color: #2d3436; font-size: 2.8rem; letter-spacing: -1px;">0</h2>
                                <p class="text-uppercase small fw-bold text-muted mb-0" style="letter-spacing: 1px;">Blood
                                    Groups</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <a href="tel:01750512161" class="text-decoration-none d-block h-100">
                                <div class="counter-card text-center p-4 shadow-lg bg-danger text-white h-100 position-relative overflow-hidden"
                                    style="border-radius: 30px; background: linear-gradient(45deg, #d63031, #ff7675);">
                                    <div class="position-absolute" style="top: -20px; right: -20px; opacity: 0.1;">
                                        <i class="fas fa-phone-alt fa-6x"></i>
                                    </div>
                                    <div class="mb-3 mx-auto pulse-red"
                                        style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 25px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-headset fa-2x text-white"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1">Emergency</h4>
                                    <p class="small mb-3 text-white-50">Available 24/7</p>
                                    <span class="badge bg-white text-danger fw-bolder py-2 px-3 rounded-pill shadow-sm"
                                        style="font-size: 1rem;">
                                        <i class="fas fa-phone-volume me-2"></i>01750512161
                                    </span>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </section>