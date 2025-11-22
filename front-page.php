<?php
/**
 * Landing Page Template
 * WeInvite Events Theme
 *
 * This is the homepage/landing page for WeInvite Events.
 * Displays the main marketing content with hero, features, how it works, etc.
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main landing-page">

    <!-- Hero Section -->
    <section class="hero hero-landing">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title">
                            Create Memorable Events,<br>
                            <span class="text-gradient">Effortlessly</span>
                        </h1>
                        <p class="hero-description text-lg">
                            Send beautiful digital invitations, manage RSVPs, and track your events with ease.
                            Perfect for weddings, parties, corporate events, and more.
                        </p>
                        <div class="hero-actions">
                            <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-primary btn-lg">
                                Get Started Free
                            </a>
                            <a href="#features" class="btn btn-outline-primary btn-lg">
                                Learn More
                            </a>
                        </div>
                        <div class="hero-stats">
                            <div class="stat-item">
                                <div class="stat-value">10K+</div>
                                <div class="stat-label">Events Created</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">50K+</div>
                                <div class="stat-label">Happy Users</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">98%</div>
                                <div class="stat-label">Satisfaction Rate</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="hero-image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-illustration.png'); ?>"
                             alt="WeInvite Event Management"
                             class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section section-features">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Everything You Need to Host Amazing Events</h2>
                <p class="section-subtitle">Powerful features designed to make event management simple and enjoyable</p>
            </div>

            <div class="card-grid">
                <!-- Feature 1: Digital Invitations -->
                <div class="card card-elevated">
                    <div class="card-body">
                        <div class="feature-icon">
                            <span class="icon">📧</span>
                        </div>
                        <h3 class="h4">Beautiful Digital Invitations</h3>
                        <p>Create stunning invitations with customizable templates. Send via SMS, email, or share links instantly.</p>
                    </div>
                </div>

                <!-- Feature 2: RSVP Management -->
                <div class="card card-elevated">
                    <div class="card-body">
                        <div class="feature-icon">
                            <span class="icon">✓</span>
                        </div>
                        <h3 class="h4">Smart RSVP Tracking</h3>
                        <p>Track responses in real-time. Know exactly who's attending, who declined, and who hasn't responded yet.</p>
                    </div>
                </div>

                <!-- Feature 3: Guest Management -->
                <div class="card card-elevated">
                    <div class="card-body">
                        <div class="feature-icon">
                            <span class="icon">👥</span>
                        </div>
                        <h3 class="h4">Easy Guest Management</h3>
                        <p>Import contacts, organize guest lists, and manage plus-ones. Keep everything organized in one place.</p>
                    </div>
                </div>

                <!-- Feature 4: Guardian Approvals -->
                <div class="card card-elevated">
                    <div class="card-body">
                        <div class="feature-icon">
                            <span class="icon">🛡️</span>
                        </div>
                        <h3 class="h4">Guardian Approval System</h3>
                        <p>For events with minors, parents can approve attendance before RSVPs are confirmed. Safety first!</p>
                    </div>
                </div>

                <!-- Feature 5: Real-time Updates -->
                <div class="card card-elevated">
                    <div class="card-body">
                        <div class="feature-icon">
                            <span class="icon">🔔</span>
                        </div>
                        <h3 class="h4">Real-time Notifications</h3>
                        <p>Get instant updates when guests respond, event details change, or important milestones occur.</p>
                    </div>
                </div>

                <!-- Feature 6: Analytics -->
                <div class="card card-elevated">
                    <div class="card-body">
                        <div class="feature-icon">
                            <span class="icon">📊</span>
                        </div>
                        <h3 class="h4">Event Analytics</h3>
                        <p>View detailed statistics about your events, guest engagement, and response rates at a glance.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="<?php echo esc_url(home_url('/features')); ?>" class="btn btn-primary btn-lg">
                    Explore All Features
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="section section-how-it-works bg-secondary">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">How It Works</h2>
                <p class="section-subtitle">Get your event up and running in 3 simple steps</p>
            </div>

            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="step-item text-center">
                        <div class="step-number">1</div>
                        <h3 class="h4">Create Your Event</h3>
                        <p>Fill in event details, upload a cover photo, and customize your invitation template.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="step-item text-center">
                        <div class="step-number">2</div>
                        <h3 class="h4">Invite Your Guests</h3>
                        <p>Import contacts or enter manually. Send invitations via SMS, email, or shareable link.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="step-item text-center">
                        <div class="step-number">3</div>
                        <h3 class="h4">Track & Manage</h3>
                        <p>Monitor RSVPs in real-time, send updates, and manage your guest list effortlessly.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-primary btn-lg">
                    Start Your First Event
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section section-testimonials">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">What Our Users Say</h2>
                <p class="section-subtitle">Join thousands of happy event hosts</p>
            </div>

            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card card-elevated">
                        <div class="card-body">
                            <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                            <p class="testimonial-text">
                                "WeInvite made planning my wedding reception so much easier! The RSVP tracking
                                was perfect and saved us hours of phone calls."
                            </p>
                            <div class="testimonial-author">
                                <strong>Sarah Johnson</strong>
                                <small>Wedding Host</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card card-elevated">
                        <div class="card-body">
                            <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                            <p class="testimonial-text">
                                "As a parent, I love the guardian approval feature. I always know which
                                events my kids are attending. Great peace of mind!"
                            </p>
                            <div class="testimonial-author">
                                <strong>Michael Chen</strong>
                                <small>Parent & Guardian</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card card-elevated">
                        <div class="card-body">
                            <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                            <p class="testimonial-text">
                                "Perfect for our corporate events. Professional invitations, easy guest
                                management, and great analytics. Highly recommend!"
                            </p>
                            <div class="testimonial-author">
                                <strong>Emily Rodriguez</strong>
                                <small>Event Coordinator</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Preview Section -->
    <section class="section section-pricing-preview bg-secondary">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Simple, Transparent Pricing</h2>
                <p class="section-subtitle">Pay only for what you use with our credit-based system</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-4">
                    <div class="package-card">
                        <div class="package-header">
                            <h3 class="package-name">Starter Pack</h3>
                            <div class="package-price">
                                <span class="currency">$</span>9.99
                            </div>
                            <div class="package-credits">100 Credits</div>
                        </div>
                        <div class="package-body">
                            <ul class="package-features">
                                <li>Perfect for small events</li>
                                <li>~20 guests per event</li>
                                <li>Digital invitations</li>
                                <li>RSVP tracking</li>
                                <li>Basic analytics</li>
                            </ul>
                            <div class="package-cta">
                                <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-outline-primary btn-block">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="package-card package-popular">
                        <div class="package-header">
                            <h3 class="package-name">Popular Pack</h3>
                            <div class="package-price">
                                <span class="currency">$</span>24.99
                            </div>
                            <div class="package-credits">300 Credits</div>
                        </div>
                        <div class="package-body">
                            <ul class="package-features">
                                <li>Great for medium events</li>
                                <li>~60 guests per event</li>
                                <li>All starter features</li>
                                <li>Priority support</li>
                                <li>Advanced analytics</li>
                            </ul>
                            <div class="package-cta">
                                <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-primary btn-block">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="package-card">
                        <div class="package-header">
                            <h3 class="package-name">Pro Pack</h3>
                            <div class="package-price">
                                <span class="currency">$</span>49.99
                            </div>
                            <div class="package-credits">700 Credits</div>
                        </div>
                        <div class="package-body">
                            <ul class="package-features">
                                <li>Ideal for large events</li>
                                <li>~140 guests per event</li>
                                <li>All popular features</li>
                                <li>Premium support</li>
                                <li>Best value per credit</li>
                            </ul>
                            <div class="package-cta">
                                <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-outline-primary btn-block">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="<?php echo esc_url(home_url('/pricing')); ?>" class="btn btn-link">
                    View Full Pricing Details →
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section section-cta">
        <div class="container">
            <div class="cta-box text-center">
                <h2 class="h1">Ready to Create Your First Event?</h2>
                <p class="text-lg">
                    Join thousands of users who trust WeInvite for their event management needs.
                    Start free, no credit card required.
                </p>
                <div class="cta-actions">
                    <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-primary btn-lg">
                        Get Started Free
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline-primary btn-lg">
                        Contact Sales
                    </a>
                </div>
                <p class="text-sm text-secondary mt-3">
                    No credit card required • Free to sign up • Cancel anytime
                </p>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
