/**
 * Firebase Authentication Module
 * WeInvite Events Theme
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

const WeInviteAuth = {

    /**
     * Firebase Configuration
     */
    firebaseConfig: null,
    firebaseApp: null,

    /**
     * Initialize Firebase
     */
    init: function() {
        console.log('Firebase Auth Module Initializing...');

        // Firebase config from wp_localize_script
        if (typeof weinviteData !== 'undefined' && weinviteData.firebaseConfig) {
            this.firebaseConfig = weinviteData.firebaseConfig;

            // Initialize Firebase
            if (typeof firebase !== 'undefined') {
                this.firebaseApp = firebase.initializeApp(this.firebaseConfig);

                // Monitor auth state
                firebase.auth().onAuthStateChanged(this.onAuthStateChanged.bind(this));

                console.log('Firebase initialized successfully');
            } else {
                console.error('Firebase SDK not loaded');
            }
        } else {
            console.error('Firebase configuration not found');
        }
    },

    /**
     * Authentication State Changed
     */
    onAuthStateChanged: function(user) {
        if (user) {
            console.log('User signed in:', user.phoneNumber);
            this.onUserSignedIn(user);
        } else {
            console.log('User signed out');
            this.onUserSignedOut();
        }
    },

    /**
     * User Signed In
     */
    onUserSignedIn: async function(user) {
        try {
            // Get ID token
            const idToken = await user.getIdToken();

            // Store in sessionStorage
            sessionStorage.setItem('idToken', idToken);
            sessionStorage.setItem('phoneNumber', user.phoneNumber);

            // Authenticate with WordPress backend
            await this.authenticateWithBackend(idToken, user.phoneNumber);

            // Update UI
            this.updateUI(true, user);
        } catch (error) {
            console.error('Error during sign-in process:', error);
        }
    },

    /**
     * User Signed Out
     */
    onUserSignedOut: function() {
        // Clear session
        sessionStorage.removeItem('idToken');
        sessionStorage.removeItem('phoneNumber');
        sessionStorage.removeItem('userData');

        // Update UI
        this.updateUI(false);

        // Redirect to login if on protected page
        if (this.isProtectedPage()) {
            window.location.href = weinviteData.loginUrl;
        }
    },

    /**
     * Authenticate with Backend
     */
    authenticateWithBackend: async function(idToken, phoneNumber) {
        try {
            const response = await fetch(weinviteData.apiUrl + '/auth-firebase', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    idToken: idToken,
                    phone: phoneNumber.replace(/\D/g, '') // Remove non-digits
                })
            });

            const data = await response.json();

            if (data.success) {
                // Store user data
                sessionStorage.setItem('userData', JSON.stringify(data.user));

                // Dispatch custom event
                const event = new CustomEvent('weinvite:auth:success', {
                    detail: { user: data.user }
                });
                document.dispatchEvent(event);

                console.log('Backend authentication successful');
            } else {
                console.error('Backend authentication failed:', data);
            }
        } catch (error) {
            console.error('Backend authentication error:', error);
        }
    },

    /**
     * Sign In with Phone Number
     */
    signInWithPhone: async function(phoneNumber, appVerifier) {
        try {
            const confirmationResult = await firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier);
            return confirmationResult;
        } catch (error) {
            console.error('Sign in error:', error);
            throw error;
        }
    },

    /**
     * Verify OTP Code
     */
    verifyCode: async function(confirmationResult, code) {
        try {
            const result = await confirmationResult.confirm(code);
            return result.user;
        } catch (error) {
            console.error('Verification error:', error);
            throw error;
        }
    },

    /**
     * Sign Out
     */
    signOut: async function() {
        try {
            await firebase.auth().signOut();
            sessionStorage.clear();
            window.location.href = weinviteData.loginUrl;
        } catch (error) {
            console.error('Sign out error:', error);
        }
    },

    /**
     * Get Current ID Token
     */
    getCurrentIdToken: async function() {
        const user = firebase.auth().currentUser;
        if (user) {
            return await user.getIdToken();
        }
        return sessionStorage.getItem('idToken');
    },

    /**
     * Get Current User
     */
    getCurrentUser: function() {
        return firebase.auth().currentUser;
    },

    /**
     * Update UI Based on Auth State
     */
    updateUI: function(isSignedIn, user = null) {
        if (isSignedIn) {
            // Show authenticated elements
            $('.auth-required').show();
            $('.auth-hidden').hide();

            // Update user info
            if (user) {
                $('.user-name').text(user.displayName || user.phoneNumber);
                $('.user-phone').text(user.phoneNumber);
            }

            // Load user data from session if available
            const userData = sessionStorage.getItem('userData');
            if (userData) {
                const user = JSON.parse(userData);
                $('.user-name').text(user.name || user.phone);

                // Update credit balance if available
                if (user.credits !== undefined) {
                    $('.credit-amount').text(user.credits);
                }
            }
        } else {
            // Show unauthenticated elements
            $('.auth-required').hide();
            $('.auth-hidden').show();
        }
    },

    /**
     * Check if Current Page is Protected
     */
    isProtectedPage: function() {
        const protectedPaths = ['/dashboard', '/profile', '/my-events', '/create-event'];
        const currentPath = window.location.pathname;
        return protectedPaths.some(path => currentPath.includes(path));
    }

};

// Initialize on document ready
document.addEventListener('DOMContentLoaded', function() {
    WeInviteAuth.init();
});

// Make globally accessible
window.WeInviteAuth = WeInviteAuth;

// Export for webpack
export default WeInviteAuth;
