/**
 * API Client Module
 * WeInvite Events Theme
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

const WeInviteAPI = {

    /**
     * Base API URL
     */
    baseUrl: null,

    /**
     * Initialize
     */
    init: function() {
        console.log('API Client Initializing...');

        if (typeof weinviteData !== 'undefined' && weinviteData.apiUrl) {
            this.baseUrl = weinviteData.apiUrl;
            console.log('API Base URL:', this.baseUrl);
        } else {
            console.error('API URL not configured');
        }
    },

    /**
     * Make API Request
     */
    request: async function(endpoint, options = {}) {
        try {
            // Get ID token from WeInviteAuth
            let idToken = null;
            if (typeof WeInviteAuth !== 'undefined' && WeInviteAuth.getCurrentIdToken) {
                idToken = await WeInviteAuth.getCurrentIdToken();
            }

            // Prepare headers
            const headers = {
                'Content-Type': 'application/json',
                ...options.headers
            };

            if (idToken) {
                headers['Authorization'] = `Bearer ${idToken}`;
            }

            // Prepare request options
            const requestOptions = {
                method: options.method || 'GET',
                headers: headers,
                ...options
            };

            // Add body for POST/PUT requests
            if (options.body && typeof options.body === 'object') {
                requestOptions.body = JSON.stringify({
                    ...options.body,
                    idToken: idToken // WordPress plugin expects idToken in body
                });
            }

            // Make request
            const response = await fetch(`${this.baseUrl}${endpoint}`, requestOptions);

            // Parse response
            const data = await response.json();

            // Check for errors
            if (!response.ok || !data.success) {
                throw new Error(data.message || 'API request failed');
            }

            return data;

        } catch (error) {
            console.error('API Error:', error);
            throw error;
        }
    },

    /**
     * GET Request
     */
    get: function(endpoint, params = {}) {
        const queryString = new URLSearchParams(params).toString();
        const url = queryString ? `${endpoint}?${queryString}` : endpoint;
        return this.request(url, { method: 'GET' });
    },

    /**
     * POST Request
     */
    post: function(endpoint, data = {}) {
        return this.request(endpoint, {
            method: 'POST',
            body: data
        });
    },

    /**
     * PUT Request
     */
    put: function(endpoint, data = {}) {
        return this.request(endpoint, {
            method: 'PUT',
            body: data
        });
    },

    /**
     * DELETE Request
     */
    delete: function(endpoint) {
        return this.request(endpoint, { method: 'DELETE' });
    },

    // ========== Specific API Methods ==========

    /**
     * Get User Stats
     */
    getUserStats: function() {
        return this.get('/user-stats');
    },

    /**
     * Get User Events
     */
    getUserEvents: function(params = {}) {
        return this.get('/events', params);
    },

    /**
     * Get Event Details
     */
    getEventDetails: function(eventId) {
        return this.get(`/events/${eventId}`);
    },

    /**
     * Create Event
     */
    createEvent: function(eventData) {
        return this.post('/events', eventData);
    },

    /**
     * Update Event
     */
    updateEvent: function(eventId, eventData) {
        return this.put(`/events/${eventId}`, eventData);
    },

    /**
     * Delete Event
     */
    deleteEvent: function(eventId) {
        return this.delete(`/events/${eventId}`);
    },

    /**
     * Get User Invitations
     */
    getUserInvitations: function() {
        return this.get('/invitations');
    },

    /**
     * Update RSVP
     */
    updateRSVP: function(invitationId, status) {
        return this.post('/rsvp', {
            invitation_id: invitationId,
            status: status
        });
    },

    /**
     * Get Credit Packages
     */
    getCreditPackages: function() {
        return this.get('/credit-packages');
    },

    /**
     * Purchase Credits
     */
    purchaseCredits: function(packageId, paymentData) {
        return this.post('/purchase-credits', {
            package_id: packageId,
            payment_data: paymentData
        });
    },

    /**
     * Get Credit Balance
     */
    getCreditBalance: function() {
        return this.get('/user-credits');
    },

    /**
     * Calculate Credits
     */
    calculateCredits: function(operation, params) {
        return this.post('/calculate-credits', {
            operation: operation,
            ...params
        });
    },

    /**
     * Send Invitations
     */
    sendInvitations: function(eventId, invitations) {
        return this.post('/send-invitations', {
            event_id: eventId,
            invitations: invitations
        });
    },

    /**
     * Get Event Statistics
     */
    getEventStats: function(eventId) {
        return this.get(`/event-stats/${eventId}`);
    }

};

// Initialize on document ready
document.addEventListener('DOMContentLoaded', function() {
    WeInviteAPI.init();
});

// Make globally accessible
window.WeInviteAPI = WeInviteAPI;

// Export for webpack
export default WeInviteAPI;
