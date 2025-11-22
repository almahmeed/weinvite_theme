<?php
/**
 * Template Name: FAQ Page
 * Template Post Type: page
 *
 * Frequently Asked Questions page with collapsible accordion.
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main faq-page">

    <!-- Page Hero -->
    <section class="hero hero-page">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">Frequently Asked Questions</h1>
                <p class="hero-description text-lg">
                    Find answers to common questions about WeInvite
                </p>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section section-faq">
        <div class="container">

            <!-- Search Box -->
            <div class="row justify-content-center mb-5">
                <div class="col-12 col-md-8 col-lg-6">
                    <form class="search-form" id="faq-search">
                        <input type="search"
                               class="form-control search-input"
                               placeholder="Search FAQs..."
                               id="faq-search-input">
                        <span class="search-icon">🔍</span>
                    </form>
                </div>
            </div>

            <!-- FAQ Categories -->
            <div class="row">
                <div class="col-12">

                    <!-- Category: Getting Started -->
                    <div class="faq-category">
                        <h2 class="faq-category-title">Getting Started</h2>

                        <div class="faq-accordion">
                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-1">
                                    How do I create my first event?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-1" class="faq-answer collapse">
                                    <p>
                                        Creating your first event is easy! After signing up and logging in:
                                    </p>
                                    <ol>
                                        <li>Click the "Create Event" button in your dashboard</li>
                                        <li>Fill in your event details (name, date, location, description)</li>
                                        <li>Upload a cover photo (optional)</li>
                                        <li>Choose your invitation template</li>
                                        <li>Add your guest list</li>
                                        <li>Review and send invitations!</li>
                                    </ol>
                                    <p>
                                        The whole process takes just a few minutes. You can always edit
                                        event details later.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-2">
                                    Do I need a credit card to sign up?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-2" class="faq-answer collapse">
                                    <p>
                                        No! Signing up for WeInvite is completely free and doesn't require
                                        a credit card. You can create your account, explore the platform,
                                        and see how everything works before purchasing any credits.
                                    </p>
                                    <p>
                                        You'll only need to purchase credits when you're ready to send
                                        invitations for your event.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-3">
                                    How long does it take to set up an event?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-3" class="faq-answer collapse">
                                    <p>
                                        Most users complete their event setup in 5-10 minutes. This includes
                                        filling in event details, uploading a photo, adding guests, and
                                        customizing the invitation.
                                    </p>
                                    <p>
                                        If you have your guest list ready, the process is even faster!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category: Credits & Billing -->
                    <div class="faq-category">
                        <h2 class="faq-category-title">Credits & Billing</h2>

                        <div class="faq-accordion">
                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-4">
                                    How does the credit system work?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-4" class="faq-answer collapse">
                                    <p>
                                        WeInvite uses a simple credit-based system. Here's how it works:
                                    </p>
                                    <ul>
                                        <li>Create Event: 10 credits</li>
                                        <li>Send Invitation: 5 credits per guest</li>
                                        <li>Send Reminder: 2 credits per guest</li>
                                        <li>Update Notification: 3 credits per guest</li>
                                    </ul>
                                    <p>
                                        You purchase credits in packages (starting at $9.99 for 100 credits),
                                        and use them as needed. Credits never expire!
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-5">
                                    Do credits expire?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-5" class="faq-answer collapse">
                                    <p>
                                        No! Credits never expire. Purchase them once and use them whenever
                                        you need, whether that's today or a year from now. Your credit
                                        balance carries forward indefinitely.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-6">
                                    What happens if I run out of credits during an event?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-6" class="faq-answer collapse">
                                    <p>
                                        You can purchase additional credits at any time! Your event won't
                                        be affected - simply buy more credits and continue managing your
                                        event without any interruption.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-7">
                                    Can I get a refund?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-7" class="faq-answer collapse">
                                    <p>
                                        Yes! We offer a 30-day money-back guarantee on all credit packages.
                                        If you're not satisfied for any reason, contact us within 30 days
                                        for a full refund of unused credits.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category: Events & Invitations -->
                    <div class="faq-category">
                        <h2 class="faq-category-title">Events & Invitations</h2>

                        <div class="faq-accordion">
                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-8">
                                    How do I send invitations to my guests?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-8" class="faq-answer collapse">
                                    <p>
                                        You can send invitations three ways:
                                    </p>
                                    <ul>
                                        <li><strong>SMS:</strong> Send invitations directly via text message</li>
                                        <li><strong>Email:</strong> Send beautifully formatted email invitations</li>
                                        <li><strong>Link:</strong> Generate a shareable link to post on social media or send via messaging apps</li>
                                    </ul>
                                    <p>
                                        You can use any combination of these methods for different guests.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-9">
                                    Can I edit my event after sending invitations?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-9" class="faq-answer collapse">
                                    <p>
                                        Yes! You can edit most event details even after sending invitations.
                                        When you make changes, you'll have the option to notify guests about
                                        the updates (which uses 3 credits per guest).
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-10">
                                    Can guests bring plus-ones?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-10" class="faq-answer collapse">
                                    <p>
                                        Yes! When creating your event, you can enable the "Allow Plus-Ones"
                                        option. Guests will then be able to indicate if they're bringing
                                        additional people when they RSVP.
                                    </p>
                                    <p>
                                        You can also set a maximum number of plus-ones per guest.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-11">
                                    How do I track RSVPs?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-11" class="faq-answer collapse">
                                    <p>
                                        Your event dashboard shows real-time RSVP status for all guests.
                                        You'll see:
                                    </p>
                                    <ul>
                                        <li>Who's attending (green)</li>
                                        <li>Who declined (red)</li>
                                        <li>Who hasn't responded yet (gray)</li>
                                    </ul>
                                    <p>
                                        You can also view detailed analytics, export the guest list,
                                        and send reminders to people who haven't responded.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category: Guardian Approval -->
                    <div class="faq-category">
                        <h2 class="faq-category-title">Guardian Approval System</h2>

                        <div class="faq-accordion">
                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-12">
                                    What is the Guardian Approval system?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-12" class="faq-answer collapse">
                                    <p>
                                        The Guardian Approval system is a safety feature for events involving
                                        minors (under 18). When enabled, children can't RSVP to events without
                                        their parent or guardian approving first.
                                    </p>
                                    <p>
                                        This ensures parents always know what events their children are
                                        attending and can make informed decisions about their safety.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-13">
                                    How do I set up guardian approval?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-13" class="faq-answer collapse">
                                    <p>
                                        When creating an event, simply check the "Require Guardian Approval"
                                        option. Any invitations sent to users under 18 will automatically
                                        require parent/guardian approval before the RSVP is confirmed.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-14">
                                    How do parents approve invitations?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-14" class="faq-answer collapse">
                                    <p>
                                        Parents receive a notification when their child receives an invitation.
                                        They can:
                                    </p>
                                    <ol>
                                        <li>View the complete event details</li>
                                        <li>See who's hosting the event</li>
                                        <li>Review other attendees (if visible)</li>
                                        <li>Approve or decline the invitation</li>
                                    </ol>
                                    <p>
                                        The approval process is quick and can be done from any device.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category: Account & Security -->
                    <div class="faq-category">
                        <h2 class="faq-category-title">Account & Security</h2>

                        <div class="faq-accordion">
                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-15">
                                    How do I reset my password?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-15" class="faq-answer collapse">
                                    <p>
                                        WeInvite uses phone-based authentication, so there's no password
                                        to remember! You log in using your phone number and receive a
                                        one-time code via SMS each time you sign in.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-16">
                                    Is my data secure?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-16" class="faq-answer collapse">
                                    <p>
                                        Absolutely! We take security very seriously:
                                    </p>
                                    <ul>
                                        <li>All data is encrypted in transit and at rest</li>
                                        <li>We use industry-standard Firebase authentication</li>
                                        <li>Your payment information is processed by secure, PCI-compliant payment processors</li>
                                        <li>We never share your personal information with third parties</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-question" type="button" data-toggle="collapse" data-target="#faq-17">
                                    Can I delete my account?
                                    <span class="faq-icon">+</span>
                                </button>
                                <div id="faq-17" class="faq-answer collapse">
                                    <p>
                                        Yes. You can delete your account at any time from your account
                                        settings. Please note that:
                                    </p>
                                    <ul>
                                        <li>All your events will be cancelled</li>
                                        <li>Your data will be permanently deleted within 30 days</li>
                                        <li>Unused credits are non-refundable upon account deletion</li>
                                    </ul>
                                    <p>
                                        If you have concerns or issues, please contact support first -
                                        we're happy to help!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- Still Have Questions Section -->
    <section class="section section-contact-cta bg-secondary">
        <div class="container">
            <div class="text-center">
                <h2 class="h3 mb-3">Still Have Questions?</h2>
                <p class="mb-4">Can't find the answer you're looking for? We're here to help!</p>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary btn-lg">
                    Contact Support
                </a>
            </div>
        </div>
    </section>

</main>

<script>
// FAQ Accordion functionality
(function() {
    const faqButtons = document.querySelectorAll('.faq-question');

    faqButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const target = document.querySelector(targetId);
            const icon = this.querySelector('.faq-icon');

            // Toggle collapse
            if (target.classList.contains('show')) {
                target.classList.remove('show');
                icon.textContent = '+';
                this.setAttribute('aria-expanded', 'false');
            } else {
                target.classList.add('show');
                icon.textContent = '−';
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // FAQ Search functionality
    const searchInput = document.getElementById('faq-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(function(item) {
                const question = item.querySelector('.faq-question').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();

                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
})();
</script>

<?php
get_footer();
