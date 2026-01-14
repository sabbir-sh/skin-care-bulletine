<section class="row justify-content-center py-5">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg p-4 p-md-5 rounded-4" style="border-radius: 25px;">
                        <h2 class="text-center fw-bold mb-5">সাধারণ জিজ্ঞাসা (FAQ)</h2>
                        <div class="accordion accordion-flush" id="faqAccordion">
                            @foreach($faqs as $faq)
                                <div class="accordion-item mb-3"
                                    style="border: 1px solid #eee; border-radius: 12px; overflow: hidden;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fs-5 fw-bold py-3" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body fs-6" style="line-height: 1.8; color: #555;">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>