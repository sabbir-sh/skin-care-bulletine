@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            
            <!-- Contact Form -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title mb-3 text-center">Contact Us</h2>
                        <p class="text-center text-muted mb-4">
                            Feel free to reach out to us. We are here to help you!
                        </p>

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Send Message</button>
                        </form>

                        @if(session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Get in Touch</h5>
                        <p class="mb-2"><strong>Email:</strong> info@example.com</p>
                        <p class="mb-2"><strong>Phone:</strong> +880 01750-512161</p>
                        <p class="mb-2"><strong>Address:</strong> Bangladesh</p>

                        <hr>

                        <h6>Follow Us</h6>
                        <a href="#" class="btn btn-outline-primary btn-sm me-2 mb-2"><i class="lab la-facebook-f"></i> Facebook</a>
                        <a href="#" class="btn btn-outline-info btn-sm me-2 mb-2"><i class="lab la-twitter"></i> Twitter</a>
                        <a href="#" class="btn btn-outline-danger btn-sm me-2 mb-2"><i class="lab la-instagram"></i> Instagram</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
