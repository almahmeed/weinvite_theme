/**
 * Main JavaScript Entry Point
 * WeInvite Events Theme
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

(function($) {
    'use strict';

    /**
     * WeInvite Main App
     */
    const WeInvite = {

        /**
         * Initialize
         */
        init: function() {
            console.log('WeInvite Theme Initialized');
            this.setupEventListeners();
            this.initComponents();
        },

        /**
         * Setup Event Listeners
         */
        setupEventListeners: function() {
            // Mobile menu toggle
            $('.mobile-menu-toggle').on('click', this.toggleMobileMenu.bind(this));

            // Mobile submenu toggle
            $('.mobile-nav-menu .menu-item-has-children > a').on('click', this.toggleMobileSubmenu);

            // Close mobile menu when clicking a link (without submenu)
            $('.mobile-nav-menu a').on('click', function(e) {
                if (!$(this).parent().hasClass('menu-item-has-children')) {
                    WeInvite.closeMobileMenu();
                }
            });

            // Modal triggers
            $('[data-modal-open]').on('click', this.openModal.bind(this));
            $('[data-modal-close]').on('click', this.closeModal.bind(this));
            $('.modal-overlay').on('click', this.closeModal.bind(this));

            // Close modal on ESC key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    WeInvite.closeModal();
                    WeInvite.closeMobileMenu();
                }
            });

            // Smooth scroll for anchor links
            $('a[href^="#"]').on('click', this.smoothScroll);
        },

        /**
         * Initialize Components
         */
        initComponents: function() {
            // Character counters for textareas
            this.initCharCounters();

            // File upload previews
            this.initFileUploads();

            // Form validation (basic)
            this.initFormValidation();
        },

        /**
         * Toggle Mobile Menu
         */
        toggleMobileMenu: function(e) {
            e.preventDefault();
            $('.mobile-menu').toggleClass('is-active');
            $('body').toggleClass('menu-open');
            $(e.currentTarget).toggleClass('is-active');
        },

        /**
         * Close Mobile Menu
         */
        closeMobileMenu: function() {
            $('.mobile-menu').removeClass('is-active');
            $('body').removeClass('menu-open');
            $('.mobile-menu-toggle').removeClass('is-active');
        },

        /**
         * Toggle Mobile Submenu
         */
        toggleMobileSubmenu: function(e) {
            e.preventDefault();
            const $menuItem = $(this).parent();
            const $submenu = $menuItem.find('.sub-menu').first();

            // Toggle current submenu
            $menuItem.toggleClass('submenu-open');
            $submenu.toggleClass('submenu-open');

            // Close other open submenus
            $menuItem.siblings('.menu-item-has-children').removeClass('submenu-open')
                .find('.sub-menu').removeClass('submenu-open');
        },

        /**
         * Open Modal
         */
        openModal: function(e) {
            if (e) e.preventDefault();
            const modalId = $(e.currentTarget).data('modal-open');
            $(`#${modalId}`).addClass('is-active');
            $('body').addClass('modal-open');
        },

        /**
         * Close Modal
         */
        closeModal: function(e) {
            if (e) e.preventDefault();
            $('.modal').removeClass('is-active');
            $('body').removeClass('modal-open');
        },

        /**
         * Smooth Scroll
         */
        smoothScroll: function(e) {
            const href = $(this).attr('href');

            // Check if it's a valid anchor on the same page
            if (href.indexOf('#') === 0 && href.length > 1) {
                const target = $(href);

                if (target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80 // 80px offset for fixed header
                    }, 500);
                }
            }
        },

        /**
         * Initialize Character Counters
         */
        initCharCounters: function() {
            $('textarea[maxlength]').each(function() {
                const $textarea = $(this);
                const maxLength = parseInt($textarea.attr('maxlength'), 10);

                // Create counter element
                const $counter = $('<div class="char-counter"></div>');
                $counter.html(`<span class="current">0</span> / <span class="max">${maxLength}</span>`);
                $textarea.after($counter);

                // Update counter on input
                $textarea.on('input', function() {
                    const currentLength = $(this).val().length;
                    $counter.find('.current').text(currentLength);

                    if (currentLength >= maxLength) {
                        $counter.addClass('text-danger');
                    } else {
                        $counter.removeClass('text-danger');
                    }
                });
            });
        },

        /**
         * Initialize File Uploads
         */
        initFileUploads: function() {
            $('input[type="file"]').on('change', function(e) {
                const file = e.target.files[0];
                const $input = $(this);
                const $label = $input.siblings('label');
                const $preview = $input.siblings('.file-preview');

                if (file) {
                    // Update label text
                    if ($label.length) {
                        $label.find('span').text(file.name);
                    }

                    // Show image preview if it's an image
                    if (file.type.startsWith('image/') && $preview.length) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $preview.html(`<img src="${e.target.result}" alt="Preview">`);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
        },

        /**
         * Initialize Form Validation
         */
        initFormValidation: function() {
            $('form[data-validate]').on('submit', function(e) {
                let isValid = true;

                // Check required fields
                $(this).find('[required]').each(function() {
                    const $field = $(this);
                    if (!$field.val()) {
                        $field.addClass('is-invalid');
                        isValid = false;
                    } else {
                        $field.removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    WeInvite.showNotification('Please fill in all required fields.', 'error');
                }
            });

            // Remove invalid class on input
            $('form [required]').on('input', function() {
                $(this).removeClass('is-invalid');
            });
        },

        /**
         * Show Notification
         */
        showNotification: function(message, type = 'info') {
            // Remove existing notifications
            $('.notification').remove();

            const notification = `
                <div class="notification notification-${type}">
                    <div class="notification-content">
                        ${message}
                    </div>
                    <button class="notification-close" type="button">&times;</button>
                </div>
            `;

            $('body').append(notification);

            // Show notification
            setTimeout(function() {
                $('.notification').addClass('is-visible');
            }, 100);

            // Auto-dismiss after 5 seconds
            setTimeout(function() {
                $('.notification').removeClass('is-visible');
                setTimeout(function() {
                    $('.notification').remove();
                }, 300);
            }, 5000);

            // Close button
            $('.notification-close').on('click', function() {
                $(this).parent().removeClass('is-visible');
                setTimeout(function() {
                    $('.notification').remove();
                }, 300);
            });
        },

        /**
         * Show Loading State
         */
        showLoading: function($button) {
            $button.addClass('btn-loading').prop('disabled', true);
        },

        /**
         * Hide Loading State
         */
        hideLoading: function($button) {
            $button.removeClass('btn-loading').prop('disabled', false);
        }

    };

    // Initialize on document ready
    $(document).ready(function() {
        WeInvite.init();
    });

    // Make WeInvite globally accessible
    window.WeInvite = WeInvite;

})(jQuery);
