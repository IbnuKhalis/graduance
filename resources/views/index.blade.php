@extends('layouts.main')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <div class="hero-badge mb-3 d-inline-flex align-items-center">
                        <span class="badge-icon"><i class="bi bi-mortarboard-fill"></i></span>
                        <span class="badge-text">Interactive Final Project Guidance System</span>
                    </div>
                    <h1 class="hero-title">Accelerate Your Final Project Journey</h1>
                    <p class="hero-description">
                        Graduance connects students and faculty mentors in one seamless platform to streamline thesis supervision, track progress, and achieve timely graduation.
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-3 align-items-center">
                        <a href="/register" class="btn-hero-primary scrollto">
                            <span>Get Started Now</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="#how-it-works" class="btn-hero-secondary scrollto">
                            <i class="bi bi-play-circle me-1"></i>
                            <span>How It Works</span>
                        </a>
                    </div>

                    <!-- Quick Stats Bar -->
                    <div class="hero-stats-row row mt-5 pt-3 g-3 border-top">
                        <div class="col-4">
                            <div class="stat-item">
                                <h3 class="stat-number">500+</h3>
                                <p class="stat-label">Guided Students</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-item">
                                <h3 class="stat-number">50+</h3>
                                <p class="stat-label">Expert Mentors</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-item">
                                <h3 class="stat-number">98%</h3>
                                <p class="stat-label">On-Time Graduation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2 text-center hero-img-wrapper">
                    <div class="hero-image-card">
                        <img src="assets/img/hero.svg" class="img-fluid animated hero-illustration" alt="Graduation Guidance Illustration" width="460" height="320">
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title text-center">
                <span class="section-subheading">WHAT WE OFFER</span>
                <h2>Our Comprehensive Services</h2>
                <p>Designed specifically to optimize final project management for every role</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box service-card w-100">
                        <div class="icon-wrapper mb-4">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <h4 class="service-title">Student Guidance Portal</h4>
                        <p class="description">
                            Submit project drafts, track feedback from your supervisor, and get quick responses to your thesis inquiries in real time.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-box service-card w-100">
                        <div class="icon-wrapper mb-4">
                            <i class="bi bi-person-video3"></i>
                        </div>
                        <h4 class="service-title">Faculty Mentoring Suite</h4>
                        <p class="description">
                            Empower lecturers and thesis supervisors to review submissions efficiently, leave structured feedback, and monitor mentored students.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box service-card w-100">
                        <div class="icon-wrapper mb-4">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <h4 class="service-title">Admin & Statistical Analytics</h4>
                        <p class="description">
                            Full administrative control over user accounts, class assignments, and insightful progress analytics to ensure smooth institutional workflow.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= How It Works Section ======= -->
    <section id="how-it-works" class="how-it-works py-5">
        <div class="container" data-aos="fade-up">

            <div class="section-title text-center">
                <span class="section-subheading">EASY WORKFLOW</span>
                <h2>How Graduance Works</h2>
                <p>3 simple steps to complete your thesis with confidence</p>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="step-card">
                        <div class="step-badge">1</div>
                        <h4 class="step-title mt-3">Register & Connect</h4>
                        <p class="step-desc">Create your account and pair with assigned thesis advisors and academic departments.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-card">
                        <div class="step-badge">2</div>
                        <h4 class="step-title mt-3">Submit Drafts & Q&A</h4>
                        <p class="step-desc">Upload project updates, ask detailed questions, and receive timely guidance.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-card">
                        <div class="step-badge">3</div>
                        <h4 class="step-title mt-3">Track & Graduate</h4>
                        <p class="step-desc">Monitor your completion roadmap and get approved for final defense smoothly.</p>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End How It Works Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title text-center">
                <span class="section-subheading">GET IN TOUCH</span>
                <h2>Contact Our Support Team</h2>
                <p>Have questions about the platform? Reach out to us anytime.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="info contact-info-card w-100">
                        <div class="contact-item address d-flex align-items-start mb-4">
                            <div class="contact-icon me-3"><i class="bi bi-geo-alt-fill"></i></div>
                            <div>
                                <h4>Location:</h4>
                                <p>Campus Academic Center, Bldg A-108, NY 535022</p>
                            </div>
                        </div>

                        <div class="contact-item email d-flex align-items-start mb-4">
                            <div class="contact-icon me-3"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <h4>Email:</h4>
                                <p>support@graduance.edu</p>
                            </div>
                        </div>

                        <div class="contact-item phone d-flex align-items-start mb-4">
                            <div class="contact-icon me-3"><i class="bi bi-telephone-fill"></i></div>
                            <div>
                                <h4>Call Us:</h4>
                                <p>+1 (558) 955-4885</p>
                            </div>
                        </div>

                        <div class="map-container rounded overflow-hidden mt-3">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                                frameborder="0" style="border:0; width: 100%; height: 230px;" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <form action="#" method="post" role="form" class="php-email-form contact-form-card w-100">
                        <div class="row g-3">
                            <div class="form-group col-md-6">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" name="name" class="form-control custom-input" id="name" placeholder="John Doe" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" class="form-control custom-input" name="email" id="email" placeholder="john@example.com" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control custom-input" name="subject" id="subject" placeholder="Guidance Inquiry" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control custom-input" name="message" rows="6" placeholder="Write your message here..." required></textarea>
                            </div>
                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn-send-message">
                                    <span>Send Message</span>
                                    <i class="bi bi-send-fill ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section><!-- End Contact Us Section -->
@endsection
