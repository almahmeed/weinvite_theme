<?php
/**
 * Template Name: About Page
 * Template Post Type: page
 *
 * About page with company story, mission, team, etc.
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main about-page">

    <!-- Page Hero -->
    <section class="hero hero-page">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">About WeInvite</h1>
                <p class="hero-description text-lg">
                    Making event management simple, accessible, and enjoyable for everyone
                </p>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="section section-our-story">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="story-content">
                        <h2 class="section-title">Our Story</h2>
                        <p class="text-lg">
                            WeInvite was born from a simple frustration: planning events shouldn't be
                            so complicated. As event hosts ourselves, we struggled with outdated tools,
                            complicated RSVP tracking, and the endless back-and-forth with guests.
                        </p>
                        <p>
                            We knew there had to be a better way. So in 2024, we set out to create
                            the event management platform we wished existed - one that's simple,
                            beautiful, and actually enjoyable to use.
                        </p>
                        <p>
                            Today, WeInvite helps thousands of users create memorable events with
                            ease. From intimate birthday parties to large corporate gatherings,
                            we're proud to be part of celebrations around the world.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="story-image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about-story.jpg'); ?>"
                             alt="Our Story"
                             class="img-fluid rounded shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values Section -->
    <section class="section section-mission bg-secondary">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Our Mission & Values</h2>
                <p class="section-subtitle">What drives us every day</p>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="value-card text-center">
                        <div class="value-icon">🎯</div>
                        <h3 class="h4">Simplicity</h3>
                        <p>
                            We believe great tools should be simple to use. No complicated
                            interfaces, no steep learning curves.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="value-card text-center">
                        <div class="value-icon">🤝</div>
                        <h3 class="h4">Accessibility</h3>
                        <p>
                            Event management should be accessible to everyone, regardless
                            of technical skill or budget.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="value-card text-center">
                        <div class="value-icon">🛡️</div>
                        <h3 class="h4">Safety First</h3>
                        <p>
                            We prioritize user safety and privacy, especially for events
                            involving children and families.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="value-card text-center">
                        <div class="value-icon">💡</div>
                        <h3 class="h4">Innovation</h3>
                        <p>
                            We continuously evolve and improve, listening to our users
                            and staying ahead of the curve.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section section-team">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Meet the Team</h2>
                <p class="section-subtitle">The people behind WeInvite</p>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="team-member text-center">
                        <div class="team-avatar">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/team-1.jpg'); ?>"
                                 alt="Team Member"
                                 class="img-fluid rounded-circle">
                        </div>
                        <h4 class="team-name">Alex Johnson</h4>
                        <p class="team-role">Founder & CEO</p>
                        <div class="team-social">
                            <a href="#" class="social-link">LinkedIn</a>
                            <a href="#" class="social-link">Twitter</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="team-member text-center">
                        <div class="team-avatar">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/team-2.jpg'); ?>"
                                 alt="Team Member"
                                 class="img-fluid rounded-circle">
                        </div>
                        <h4 class="team-name">Sarah Martinez</h4>
                        <p class="team-role">Head of Product</p>
                        <div class="team-social">
                            <a href="#" class="social-link">LinkedIn</a>
                            <a href="#" class="social-link">Twitter</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="team-member text-center">
                        <div class="team-avatar">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/team-3.jpg'); ?>"
                                 alt="Team Member"
                                 class="img-fluid rounded-circle">
                        </div>
                        <h4 class="team-name">David Chen</h4>
                        <p class="team-role">Lead Engineer</p>
                        <div class="team-social">
                            <a href="#" class="social-link">LinkedIn</a>
                            <a href="#" class="social-link">Twitter</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="team-member text-center">
                        <div class="team-avatar">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/team-4.jpg'); ?>"
                                 alt="Team Member"
                                 class="img-fluid rounded-circle">
                        </div>
                        <h4 class="team-name">Emily Taylor</h4>
                        <p class="team-role">Customer Success</p>
                        <div class="team-social">
                            <a href="#" class="social-link">LinkedIn</a>
                            <a href="#" class="social-link">Twitter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section section-stats bg-secondary">
        <div class="container">
            <div class="row text-center">
                <div class="col-6 col-md-3">
                    <div class="stat-box">
                        <div class="stat-value">10,000+</div>
                        <div class="stat-label">Events Created</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-box">
                        <div class="stat-value">50,000+</div>
                        <div class="stat-label">Active Users</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-box">
                        <div class="stat-value">500K+</div>
                        <div class="stat-label">Invitations Sent</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-box">
                        <div class="stat-value">98%</div>
                        <div class="stat-label">Satisfaction Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="section section-contact-info">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Get in Touch</h2>
                <p class="section-subtitle">We'd love to hear from you</p>
            </div>

            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="contact-info-card text-center">
                        <div class="contact-icon">📧</div>
                        <h4>Email Us</h4>
                        <p>
                            <a href="mailto:hello@weinvite.com">hello@weinvite.com</a><br>
                            <a href="mailto:support@weinvite.com">support@weinvite.com</a>
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="contact-info-card text-center">
                        <div class="contact-icon">💬</div>
                        <h4>Live Chat</h4>
                        <p>
                            Available Monday-Friday<br>
                            9:00 AM - 6:00 PM EST
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="contact-info-card text-center">
                        <div class="contact-icon">📱</div>
                        <h4>Social Media</h4>
                        <p>
                            <a href="#">Facebook</a> •
                            <a href="#">Twitter</a> •
                            <a href="#">Instagram</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary btn-lg">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
