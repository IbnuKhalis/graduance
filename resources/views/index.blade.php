@extends('layouts.main')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row gy-5 align-items-center">
                <!-- Left Column: Value Prop & CTAs -->
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <div class="hero-badge mb-3 d-inline-flex align-items-center">
                        <span class="badge-icon"><i class="bi bi-mortarboard-fill"></i></span>
                        <span>Interactive Final Project Guidance System</span>
                    </div>

                    <h1 class="hero-title">Accelerate Your Final Project Journey</h1>

                    <p class="hero-description">
                        Graduance connects students and faculty mentors in one structured workspace to streamline thesis supervision, track draft revisions, and achieve timely graduation.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mt-4 align-items-center">
                        <a href="/register" class="btn-hero-primary scrollto">
                            <span>Get Started Now</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="#how-it-works" class="btn-hero-secondary scrollto">
                            <i class="bi bi-play-circle me-2"></i>
                            <span>How It Works</span>
                        </a>
                    </div>

                    <!-- Trust Signals Bar -->
                    <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top border-subtle">
                        <div class="hero-trust-pill">
                            <i class="bi bi-check-circle-fill text-brand"></i>
                            <span>Real-Time Advisor Feedback</span>
                        </div>
                        <div class="hero-trust-pill">
                            <i class="bi bi-archive-fill text-brand"></i>
                            <span>Versioned Draft Archives</span>
                        </div>
                        <div class="hero-trust-pill">
                            <i class="bi bi-shield-check text-brand"></i>
                            <span>Defense Approval Tracking</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive UI Showcase Mockup -->
                <div class="col-lg-6">
                    <div class="hero-mockup-window">
                        <!-- Window Chrome -->
                        <div class="mockup-window-header">
                            <div class="window-dots">
                                <span class="window-dot red"></span>
                                <span class="window-dot yellow"></span>
                                <span class="window-dot green"></span>
                            </div>
                            <div class="mockup-url-bar">
                                <i class="bi bi-shield-lock-fill text-success me-1"></i> graduance.edu/workspace
                            </div>
                            <div class="d-none d-sm-block">
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 small fw-semibold">
                                    <i class="bi bi-circle-fill text-success me-1" style="font-size: 6px;"></i> Live Workspace
                                </span>
                            </div>
                        </div>

                        <!-- Window Content: Clean, Calm, High-Signal -->
                        <div class="mockup-window-body">
                            <!-- Top Advisee & Supervisor Bar -->
                            <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom border-subtle">
                                <div class="d-flex align-items-center" style="gap: 16px;">
                                    <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center fw-bold text-dark flex-shrink-0" style="width: 42px; height: 42px; font-size: 15px;">
                                        RP
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark d-block" style="font-size: 1rem; line-height: 1.3; margin-bottom: 2px;">Rian Pratama</span>
                                        <span class="text-muted small" style="font-size: 0.85rem;">Informatics · Advisee</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2 small fw-semibold" style="font-size: 0.85rem; display: inline-flex; align-items: center; gap: 8px;">
                                        <i class="bi bi-person-check-fill text-brand fs-6"></i>
                                        <span>Dr. Hendra Kusuma</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Focused Chapter Review Card -->
                            <div class="p-4 bg-white rounded-4 border mb-4 shadow-2xs" style="border-color: #ede5e0 !important;">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="badge rounded-pill px-3 py-1.5 small fw-semibold" style="background: #fdf1ec; color: #c2410c; border: 1px solid #fcebe3;">
                                        Draft Submission v3.2
                                    </span>
                                    <span class="text-muted small d-inline-flex align-items-center gap-1.5"><i class="bi bi-clock"></i> Reviewed Today</span>
                                </div>

                                <h5 class="fw-bold text-dark mb-3" style="font-size: 1.1rem; line-height: 1.4;">
                                    Chapter 3: System Architecture & Methodology
                                </h5>

                                <div class="d-flex align-items-center justify-content-between p-3 rounded-3 mb-3" style="background: #faf8f6; border: 1px solid #ede5e0; gap: 12px;">
                                    <div class="d-flex align-items-center" style="gap: 12px;">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                        <span class="fw-semibold text-dark small" style="font-size: 0.92rem;">Methodology_Revision_v3.pdf</span>
                                    </div>
                                    <span class="text-muted small ms-2">2.4 MB</span>
                                </div>

                                <!-- Supervisor Approval Box -->
                                <div class="rounded-3" style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 18px !important;">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="fw-bold text-success small d-flex align-items-center gap-2">
                                            <i class="bi bi-patch-check-fill fs-6"></i> Approved for Defense
                                        </span>
                                        <span class="text-success small fw-semibold" style="font-size: 0.8rem;">Verified Signature</span>
                                    </div>
                                    <p class="text-dark small mb-0" style="line-height: 1.6; font-size: 0.92rem;">
                                        "Methodology and system validation are complete. You are cleared to schedule final defense."
                                    </p>
                                </div>
                            </div>

                            <!-- Milestone Progress Bar (Visual Delight) -->
                            <div class="px-2 pt-1 pb-1">
                                <div class="d-flex align-items-center justify-content-between mb-2.5 small fw-bold text-dark">
                                    <span style="font-size: 0.92rem;">Thesis Completion</span>
                                    <span style="color: #c2410c; font-size: 0.92rem;">4 of 5 Chapters Approved (80%)</span>
                                </div>
                                <div class="progress" style="height: 10px; border-radius: 50px; background-color: #ede5e0;">
                                    <div class="progress-bar" role="progressbar" style="width: 80%; background: var(--brand-primary); border-radius: 50px;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->

    <!-- ======= Core Capabilities Section ======= -->
    <section id="features" class="py-5" style="background: #ffffff; padding: 100px 0 !important;">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center mb-5 pb-lg-3">
                <span class="section-subheading" style="color: #c2410c; font-weight: 700; letter-spacing: 1px;">CORE CAPABILITIES</span>
                <h2 style="color: #2d2420; font-size: 2.25rem; font-weight: 800; margin-top: 8px;">Everything Needed to Complete Your Thesis</h2>
                <p class="mx-auto" style="color: #4a3e39; font-size: 1.1rem; max-width: 620px; line-height: 1.65;">
                    A focused academic workspace designed to eliminate communication friction between students and faculty mentors.
                </p>
            </div>

            <div class="row g-4 g-lg-4 justify-content-center">
                <!-- Card 1: Structured Guidance Threads -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="capability-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="capability-icon">
                                <i class="bi bi-chat-left-text-fill"></i>
                            </div>
                            <h3 class="capability-title mb-0">Structured Guidance Threads</h3>
                        </div>
                        <p class="capability-desc mb-4">
                            Direct consultation feed with your thesis supervisor, replacing scattered chat apps and lost email chains.
                        </p>
                        <ul class="capability-list list-unstyled mb-0">
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Submit specific chapter questions with contextual background</span>
                            </li>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Receive line-by-line feedback and actionable revision notes</span>
                            </li>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Real-time status indicators (Pending, Revision, Approved)</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Card 2: Advisor & Topic Pairing -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="capability-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="capability-icon">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                            <h3 class="capability-title mb-0">Advisor & Topic Pairing</h3>
                        </div>
                        <p class="capability-desc mb-4">
                            Transparent discovery of faculty-approved research topics matched with qualified supervisors.
                        </p>
                        <ul class="capability-list list-unstyled mb-0">
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Explore departmental research areas and active topics</span>
                            </li>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Transparent student quota allocation per supervisor</span>
                            </li>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>1-click topic registration with automated confirmation</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Card 3: Versioned Revision Archive -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="capability-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="capability-icon">
                                <i class="bi bi-archive-fill"></i>
                            </div>
                            <h3 class="capability-title mb-0">Versioned Revision Archive</h3>
                        </div>
                        <p class="capability-desc mb-4">
                            Complete chronological history of all chapter drafts, supervisor attachments, and revision files.
                        </p>
                        <ul class="capability-list list-unstyled mb-0">
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Permanent repository for all submitted PDF and Word drafts</span>
                            </li>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Side-by-side version logs to trace thesis improvements</span>
                            </li>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>1-click downloadable defense dossier for academic audit</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Card 4: Academic Milestone Roadmap -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="capability-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="capability-icon">
                                <i class="bi bi-trophy-fill"></i>
                            </div>
                            <h3 class="capability-title mb-0">Academic Milestone Roadmap</h3>
                        </div>
                        <p class="capability-desc mb-4">
                            Clear visual progress tracking from initial proposal seminar to final thesis defense approval.
                        </p>
                        <ul class="capability-list list-unstyled mb-0">
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Visual progress milestones across all 5 thesis chapters</span>
                            </li>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Formal digital approval stamps from faculty mentors</span>
                            </li>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Automated defense readiness checklist for timely graduation</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Core Capabilities Section -->

    <!-- ======= How It Works Section ======= -->
    <section id="how-it-works" class="py-5" style="background: #fef8f5; border-top: 1px solid var(--card-border); border-bottom: 1px solid var(--card-border);">
        <div class="container py-4" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <span class="section-subheading">EASY PROCESS</span>
                <h2>How Graduance Works</h2>
                <p>Three straightforward stages from initial topic registration to your final defense</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="journey-step-card">
                        <div class="journey-step-number">01</div>
                        <span class="badge bg-light text-brand border rounded-pill px-3 py-1 small fw-semibold mb-2">Initial Setup</span>
                        <h4 class="journey-step-title">Register & Select Topic</h4>
                        <p class="journey-step-desc">
                            Create your account with your NIM/Student ID, explore verified faculty research topics, and receive your assigned thesis supervisor.
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="journey-step-card">
                        <div class="journey-step-number">02</div>
                        <span class="badge bg-light text-brand border rounded-pill px-3 py-1 small fw-semibold mb-2">Active Guidance</span>
                        <h4 class="journey-step-title">Submit Drafts & Iterate</h4>
                        <p class="journey-step-desc">
                            Upload chapter drafts, attach datasets, and discuss corrections directly in your private supervisor consultation feed with clear feedback.
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="journey-step-card">
                        <div class="journey-step-number">03</div>
                        <span class="badge bg-light text-brand border rounded-pill px-3 py-1 small fw-semibold mb-2">Final Milestone</span>
                        <h4 class="journey-step-title">Get Approved & Graduate</h4>
                        <p class="journey-step-desc">
                            Receive digital approval from your thesis advisor, export your complete revision dossier, and proceed to final defense with confidence.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End How It Works Section -->

    <!-- ======= Role-Based Benefits Section ======= -->
    <!-- ======= Role-Based Benefits Section ======= -->
    <section class="py-5" style="background: #ffffff; padding: 80px 0 !important;">
        <div class="container py-2" data-aos="fade-up">
            <div class="section-title text-center mb-5 pb-lg-2">
                <span class="section-subheading" style="color: #c2410c; font-weight: 700; letter-spacing: 1px;">TAILORED WORKSPACES</span>
                <h2 style="color: #2d2420; font-size: 2.25rem; font-weight: 800; margin-top: 8px;">Built for the Entire Academic Ecosystem</h2>
                <p class="mx-auto" style="color: #4a3e39; font-size: 1.05rem; max-width: 620px; line-height: 1.6;">Empowering students, faculty supervisors, and department administrators with dedicated capabilities.</p>
            </div>

            <div class="row g-4 g-lg-4">
                <!-- Students -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-4 p-xl-4 rounded-4 border bg-white h-100 shadow-xs" style="border: 1px solid #eae3df !important;">
                        <div class="d-flex align-items-center gap-3 mb-3 pb-2 border-bottom border-subtle">
                            <div class="p-3 rounded-3" style="background: #fdf1ec; color: #c2410c;">
                                <i class="bi bi-mortarboard-fill fs-4"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-0" style="font-size: 1.15rem;">For Students</h5>
                        </div>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-3 text-dark small" style="font-size: 0.92rem; line-height: 1.55;">
                            <li class="d-flex align-items-start gap-2.5" style="gap: 10px;">
                                <i class="bi bi-check-circle-fill text-brand mt-1" style="color: #c2410c !important;"></i>
                                <span>Direct chapter submissions with PDF and document attachments</span>
                            </li>
                            <li class="d-flex align-items-start gap-2.5" style="gap: 10px;">
                                <i class="bi bi-check-circle-fill text-brand mt-1" style="color: #c2410c !important;"></i>
                                <span>Real-time consultation feedback and status notifications</span>
                            </li>
                            <li class="d-flex align-items-start gap-2.5" style="gap: 10px;">
                                <i class="bi bi-check-circle-fill text-brand mt-1" style="color: #c2410c !important;"></i>
                                <span>Clear thesis milestone roadmap from proposal to final defense</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Faculty Advisors -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-4 p-xl-4 rounded-4 border bg-white h-100 shadow-xs" style="border: 1px solid #eae3df !important;">
                        <div class="d-flex align-items-center gap-3 mb-3 pb-2 border-bottom border-subtle">
                            <div class="p-3 rounded-3" style="background: #fdf1ec; color: #c2410c;">
                                <i class="bi bi-person-video3 fs-4"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-0" style="font-size: 1.15rem;">For Faculty Advisors</h5>
                        </div>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-3 text-dark small" style="font-size: 0.92rem; line-height: 1.55;">
                            <li class="d-flex align-items-start gap-2.5" style="gap: 10px;">
                                <i class="bi bi-check-circle-fill text-brand mt-1" style="color: #c2410c !important;"></i>
                                <span>One-stop review queue for all assigned student advisees</span>
                            </li>
                            <li class="d-flex align-items-start gap-2.5" style="gap: 10px;">
                                <i class="bi bi-check-circle-fill text-brand mt-1" style="color: #c2410c !important;"></i>
                                <span>1-click defense approval and revision note attachments</span>
                            </li>
                            <li class="d-flex align-items-start gap-2.5" style="gap: 10px;">
                                <i class="bi bi-check-circle-fill text-brand mt-1" style="color: #c2410c !important;"></i>
                                <span>Mass messaging broadcast to send cohort-wide guidance announcements</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Administrators -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-4 p-xl-4 rounded-4 border bg-white h-100 shadow-xs" style="border: 1px solid #eae3df !important;">
                        <div class="d-flex align-items-center gap-3 mb-3 pb-2 border-bottom border-subtle">
                            <div class="p-3 rounded-3" style="background: #fdf1ec; color: #c2410c;">
                                <i class="bi bi-shield-lock-fill fs-4"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-0" style="font-size: 1.15rem;">For Administrators</h5>
                        </div>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-3 text-dark small" style="font-size: 0.92rem; line-height: 1.55;">
                            <li class="d-flex align-items-start gap-2.5" style="gap: 10px;">
                                <i class="bi bi-check-circle-fill text-brand mt-1" style="color: #c2410c !important;"></i>
                                <span>Academic class and cohort management across departments</span>
                            </li>
                            <li class="d-flex align-items-start gap-2.5" style="gap: 10px;">
                                <i class="bi bi-check-circle-fill text-brand mt-1" style="color: #c2410c !important;"></i>
                                <span>Balanced supervisor allocation and topic registration oversight</span>
                            </li>
                            <li class="d-flex align-items-start gap-2.5" style="gap: 10px;">
                                <i class="bi bi-check-circle-fill text-brand mt-1" style="color: #c2410c !important;"></i>
                                <span>Institutional analytics on completion velocity and graduation rates</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= FAQ Section ======= -->
    <section id="faq" class="py-5" style="background: #faf7f5; border-top: 1px solid var(--card-border);">
        <div class="container py-4" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <span class="section-subheading">FREQUENTLY ASKED QUESTIONS</span>
                <h2>Frequently Asked Questions</h2>
                <p>Everything you need to know about the Graduance thesis guidance platform</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="accordion faq-accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                    What document formats are supported for thesis draft uploads?
                                </button>
                            </h2>
                            <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Graduance supports PDF documents, Microsoft Word files (.doc, .docx), research datasets, and presentation decks up to 10MB per submission. PDF is recommended for formatted draft reviews.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                    How do advisors get notified when students submit revisions?
                                </button>
                            </h2>
                            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Advisors see updated badge counts in their dashboard workspace ("Questions To Answer") with direct links to review pending chapters, inspect attachments, and submit feedback.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                    Can I view and download past draft revisions?
                                </button>
                            </h2>
                            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! The Centralized Archive keeps a permanent, chronological record of every draft version submitted, alongside the advisor's corresponding feedback files and approval timestamps.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                                    How does final thesis defense approval work?
                                </button>
                            </h2>
                            <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    When all required chapters are completed to academic standards, the supervisor marks the guidance inquiry as "Approved for Defense". This status is formally logged for academic office verification.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End FAQ Section -->

    <!-- ======= Pre-Footer CTA Banner ======= -->
    <section class="py-5" style="background: #ffffff;">
        <div class="container py-4" data-aos="zoom-in">
            <div class="prefooter-cta-card text-center">
                <h2>Ready to Complete Your Thesis on Time?</h2>
                <p>
                    Join students and faculty advisors using Graduance to streamline final project guidance and achieve confident, on-schedule graduation.
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center align-items-center">
                    <a href="/register" class="btn-hero-primary px-5 py-3 fs-6">
                        <span>Create Your Account</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="/login" class="btn btn-outline-secondary rounded-pill px-4 py-3 fw-semibold">
                        <span>Log In to Workspace</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= Contact Support Section ======= -->
    <section id="contact" class="py-5" style="background: #fef8f5; border-top: 1px solid var(--card-border);">
        <div class="container py-4" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <span class="section-subheading">GET IN TOUCH</span>
                <h2>Campus Support & Helpdesk</h2>
                <p>Have inquiries about final project registration or platform access? Our academic coordination team is here to assist.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info-card h-100 text-center">
                        <div class="contact-icon mx-auto mb-3"><i class="bi bi-geo-alt-fill"></i></div>
                        <h4>Campus Office</h4>
                        <p>Academic Service Center<br>Faculty of Computer Science & Engineering</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-info-card h-100 text-center">
                        <div class="contact-icon mx-auto mb-3"><i class="bi bi-envelope-fill"></i></div>
                        <h4>Email Helpdesk</h4>
                        <p>support@graduance.edu<br>academic-coordination@graduance.edu</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-info-card h-100 text-center">
                        <div class="contact-icon mx-auto mb-3"><i class="bi bi-clock-fill"></i></div>
                        <h4>Service Hours</h4>
                        <p>Monday - Friday: 08:00 - 16:30 WIB<br>Online Guidance: 24/7 Portal Access</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->
@endsection
