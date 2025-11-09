/**
 * Trip Manager - Notification System
 * Version: 1.0.0
 * Handles notifications, alerts, and smart warnings
 */

window.TripNotifications = (function() {
    'use strict';

    // Notification types
    const TYPES = {
        SUCCESS: 'success',
        WARNING: 'warning',
        ERROR: 'error',
        INFO: 'info',
        BUDGET: 'budget',
        SCHEDULE: 'schedule',
        BOOKING: 'booking'
    };

    // Notification queue
    let notificationQueue = [];
    let isProcessing = false;

    // Smart notification settings
    const smartSettings = {
        budgetWarning: {
            enabled: true,
            thresholds: [50, 75, 90, 100]
        },
        scheduleReminder: {
            enabled: true,
            minutesBefore: [60, 30, 15]
        },
        bookingReminder: {
            enabled: true,
            hoursBefore: [24, 6, 2]
        },
        locationReminder: {
            enabled: true,
            radius: 1000 // meters
        }
    };

    // Persistent notifications storage
    let persistentNotifications = [];

    function init() {
        console.log('TripNotifications: Initializing...');
        
        loadPersistentNotifications();
        setupEventListeners();
        startSmartNotifications();
        
        console.log('TripNotifications: Initialized successfully');
    }

    // Basic notification functions
    function show(message, type = TYPES.INFO, duration = 3000, options = {}) {
        const notification = createNotification(message, type, duration, options);
        
        if (options.persistent) {
            addPersistentNotification(notification);
        }
        
        displayNotification(notification);
        
        return notification.id;
    }

    function showSuccess(message, duration = 3000, options = {}) {
        return show(message, TYPES.SUCCESS, duration, options);
    }

    function showWarning(message, duration = 5000, options = {}) {
        return show(message, TYPES.WARNING, duration, options);
    }

    function showError(message, duration = 7000, options = {}) {
        return show(message, TYPES.ERROR, duration, options);
    }

    function showInfo(message, duration = 3000, options = {}) {
        return show(message, TYPES.INFO, duration, options);
    }

    // Create notification object
    function createNotification(message, type, duration, options) {
        return {
            id: TripUtils.generateId(),
            message: message,
            type: type,
            duration: duration,
            timestamp: TripUtils.getCurrentDateTime(),
            options: {
                dismissible: true,
                sound: false,
                icon: null,
                actions: [],
                persistent: false,
                priority: 'normal',
                ...options
            }
        };
    }

    // Display notification in UI
    function displayNotification(notification) {
        const container = getNotificationContainer();
        const element = createNotificationElement(notification);
        
        container.appendChild(element);
        
        // Animate in
        setTimeout(() => {
            element.classList.add('fade-in');
        }, 10);
        
        // Auto-dismiss if not persistent
        if (notification.duration > 0 && !notification.options.persistent) {
            setTimeout(() => {
                dismissNotification(notification.id);
            }, notification.duration);
        }
        
        // Play sound if enabled
        if (notification.options.sound) {
            playNotificationSound(notification.type);
        }
    }

    // Create notification DOM element
    function createNotificationElement(notification) {
        const element = document.createElement('div');
        element.className = `notification notification-${notification.type}`;
        element.setAttribute('data-notification-id', notification.id);
        
        const icon = getNotificationIcon(notification.type, notification.options.icon);
        const actions = createNotificationActions(notification);
        
        element.innerHTML = `
            <div class="notification-content">
                <div class="notification-icon">${icon}</div>
                <div class="notification-message">${TripUtils.escapeHtml(notification.message)}</div>
                ${notification.options.dismissible ? '<button class="notification-close" onclick="TripNotifications.dismissNotification(\'' + notification.id + '\')">&times;</button>' : ''}
            </div>
            ${actions ? `<div class="notification-actions">${actions}</div>` : ''}
        `;
        
        // Add priority class
        if (notification.options.priority === 'high') {
            element.classList.add('notification-high-priority');
        }
        
        return element;
    }

    // Get notification container
    function getNotificationContainer() {
        let container = document.getElementById('notification-container');
        
        if (!container) {
            container = document.createElement('div');
            container.id = 'notification-container';
            container.className = 'notification-container';
            container.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 10000;
                max-width: 400px;
                pointer-events: none;
            `;
            document.body.appendChild(container);
        }
        
        return container;
    }

    // Get icon for notification type
    function getNotificationIcon(type, customIcon) {
        if (customIcon) return customIcon;
        
        const icons = {
            [TYPES.SUCCESS]: '✅',
            [TYPES.WARNING]: '⚠️',
            [TYPES.ERROR]: '❌',
            [TYPES.INFO]: 'ℹ️',
            [TYPES.BUDGET]: '💰',
            [TYPES.SCHEDULE]: '⏰',
            [TYPES.BOOKING]: '🎫'
        };
        
        return icons[type] || 'ℹ️';
    }

    // Create notification actions
    function createNotificationActions(notification) {
        if (!notification.options.actions || notification.options.actions.length === 0) {
            return '';
        }
        
        return notification.options.actions.map(action => `
            <button class="notification-action" onclick="${action.handler}">
                ${action.label}
            </button>
        `).join('');
    }

    // Dismiss notification
    function dismissNotification(id) {
        const element = document.querySelector(`[data-notification-id="${id}"]`);
        if (element) {
            element.classList.add('fade-out');
            setTimeout(() => {
                element.remove();
            }, 300);
        }
        
        // Remove from persistent notifications
        persistentNotifications = persistentNotifications.filter(n => n.id !== id);
        savePersistentNotifications();
    }

    // Dismiss all notifications
    function dismissAll() {
        const elements = document.querySelectorAll('.notification');
        elements.forEach(element => {
            element.classList.add('fade-out');
            setTimeout(() => {
                element.remove();
            }, 300);
        });
        
        persistentNotifications = [];
        savePersistentNotifications();
    }

    // Smart notification functions
    function startSmartNotifications() {
        // Check budget warnings
        setInterval(checkBudgetWarnings, 30000); // Every 30 seconds
        
        // Check schedule reminders
        setInterval(checkScheduleReminders, 60000); // Every minute
        
        // Check booking reminders
        setInterval(checkBookingReminders, 300000); // Every 5 minutes
        
        // Check location-based reminders
        if (navigator.geolocation && smartSettings.locationReminder.enabled) {
            navigator.geolocation.watchPosition(checkLocationReminders, null, {
                enableHighAccuracy: false,
                timeout: 30000,
                maximumAge: 300000
            });
        }
    }

    // Budget warning checks
    function checkBudgetWarnings() {
        if (!smartSettings.budgetWarning.enabled) return;
        
        const stats = TripCore.getStatistics();
        const { budgetUsed, totalSpent, budgetRemaining } = stats;
        
        smartSettings.budgetWarning.thresholds.forEach(threshold => {
            if (budgetUsed >= threshold && budgetUsed < threshold + 5) {
                const message = getBudgetWarningMessage(threshold, totalSpent, budgetRemaining);
                
                show(message, TYPES.BUDGET, 5000, {
                    priority: threshold >= 90 ? 'high' : 'normal',
                    persistent: threshold >= 100,
                    actions: threshold >= 90 ? [{
                        label: 'Xem Chi Tiết',
                        handler: 'TripTabs.switchTab("budget")'
                    }] : []
                });
            }
        });
    }

    function getBudgetWarningMessage(threshold, totalSpent, budgetRemaining) {
        const formattedSpent = TripUtils.formatMoney(totalSpent);
        const formattedRemaining = TripUtils.formatMoney(budgetRemaining);
        
        if (threshold >= 100) {
            return `🚨 Bạn đã vượt ngân sách! Đã chi: ${formattedSpent}`;
        } else if (threshold >= 90) {
            return `⚠️ Cảnh báo: Đã sử dụng ${threshold}% ngân sách! Còn lại: ${formattedRemaining}`;
        } else if (threshold >= 75) {
            return `💡 Lưu ý: Đã sử dụng ${threshold}% ngân sách. Còn lại: ${formattedRemaining}`;
        } else {
            return `📊 Đã sử dụng ${threshold}% ngân sách. Còn lại: ${formattedRemaining}`;
        }
    }

    // Schedule reminder checks
    function checkScheduleReminders() {
        if (!smartSettings.scheduleReminder.enabled) return;
        
        const tripData = TripCore.getData();
        const now = new Date();
        
        tripData.schedule.forEach(item => {
            if (!item.date || !item.time) return;
            
            const itemDateTime = new Date(`${item.date}T${item.time}`);
            const minutesUntil = Math.round((itemDateTime - now) / (1000 * 60));
            
            smartSettings.scheduleReminder.minutesBefore.forEach(minutes => {
                if (minutesUntil === minutes) {
                    show(
                        `⏰ Nhắc nhở: "${item.title}" sẽ bắt đầu trong ${minutes} phút`,
                        TYPES.SCHEDULE,
                        5000,
                        {
                            priority: minutes <= 15 ? 'high' : 'normal',
                            sound: true,
                            actions: [{
                                label: 'Xem Lịch Trình',
                                handler: 'TripTabs.switchTab("schedule")'
                            }]
                        }
                    );
                }
            });
        });
    }

    // Booking reminder checks
    function checkBookingReminders() {
        if (!smartSettings.bookingReminder.enabled) return;
        
        const tripData = TripCore.getData();
        const now = new Date();
        
        tripData.bookings.forEach(booking => {
            if (!booking.date) return;
            
            const bookingDate = new Date(booking.date);
            const hoursUntil = Math.round((bookingDate - now) / (1000 * 60 * 60));
            
            smartSettings.bookingReminder.hoursBefore.forEach(hours => {
                if (hoursUntil === hours) {
                    show(
                        `🎫 Nhắc nhở: ${booking.type} "${booking.title}" vào ${TripUtils.formatDateTime(booking.date)}`,
                        TYPES.BOOKING,
                        7000,
                        {
                            priority: hours <= 2 ? 'high' : 'normal',
                            sound: hours <= 6,
                            actions: [{
                                label: 'Xem Chi Tiết',
                                handler: 'TripTabs.switchTab("bookings")'
                            }]
                        }
                    );
                }
            });
        });
    }

    // Location-based reminder checks
    function checkLocationReminders(position) {
        if (!smartSettings.locationReminder.enabled) return;
        
        const tripData = TripCore.getData();
        const userLat = position.coords.latitude;
        const userLng = position.coords.longitude;
        
        tripData.destinations.forEach(destination => {
            if (!destination.coordinates || destination.checkedIn) return;
            
            const distance = calculateDistance(
                userLat, userLng,
                destination.coordinates.lat, destination.coordinates.lng
            );
            
            if (distance <= smartSettings.locationReminder.radius) {
                show(
                    `📍 Bạn đang gần ${destination.name}! Có muốn check-in không?`,
                    TYPES.INFO,
                    10000,
                    {
                        priority: 'high',
                        sound: true,
                        actions: [{
                            label: 'Check-in Ngay',
                            handler: `TripTimeline.checkInDestination(${destination.id})`
                        }, {
                            label: 'Xem Chi Tiết',
                            handler: 'TripTabs.switchTab("timeline")'
                        }]
                    }
                );
            }
        });
    }

    // Calculate distance between two coordinates (Haversine formula)
    function calculateDistance(lat1, lng1, lat2, lng2) {
        const R = 6371000; // Earth's radius in meters
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLng = (lng2 - lng1) * Math.PI / 180;
        const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                  Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                  Math.sin(dLng/2) * Math.sin(dLng/2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        return R * c;
    }

    // Event listeners
    function setupEventListeners() {
        // Listen to core events
        TripCore.on('expenseAdded', (expense) => {
            showSuccess(`💳 Đã thêm chi tiêu ${TripUtils.formatMoney(expense.amount)}`);
            checkBudgetWarnings();
        });
        
        TripCore.on('destinationAdded', (destination) => {
            showSuccess(`📍 Đã thêm điểm đến: ${destination.name}`);
        });
        
        TripCore.on('bookingAdded', (booking) => {
            showSuccess(`🎫 Đã thêm booking: ${booking.title}`);
        });
        
        TripCore.on('tripUpdated', () => {
            showInfo('ℹ️ Thông tin chuyến đi đã được cập nhật');
        });
    }

    // Persistent notifications
    function addPersistentNotification(notification) {
        persistentNotifications.push(notification);
        savePersistentNotifications();
    }

    function loadPersistentNotifications() {
        try {
            const saved = localStorage.getItem('tripNotifications_persistent');
            if (saved) {
                persistentNotifications = JSON.parse(saved);
                
                // Display persistent notifications
                persistentNotifications.forEach(notification => {
                    displayNotification(notification);
                });
            }
        } catch (error) {
            console.error('Error loading persistent notifications:', error);
            persistentNotifications = [];
        }
    }

    function savePersistentNotifications() {
        try {
            localStorage.setItem('tripNotifications_persistent', JSON.stringify(persistentNotifications));
        } catch (error) {
            console.error('Error saving persistent notifications:', error);
        }
    }

    // Notification sound
    function playNotificationSound(type) {
        try {
            // Create audio context for notification sounds
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            // Different frequencies for different notification types
            const frequencies = {
                [TYPES.SUCCESS]: 800,
                [TYPES.WARNING]: 600,
                [TYPES.ERROR]: 400,
                [TYPES.INFO]: 1000,
                [TYPES.BUDGET]: 500,
                [TYPES.SCHEDULE]: 900,
                [TYPES.BOOKING]: 700
            };
            
            oscillator.frequency.setValueAtTime(frequencies[type] || 800, audioContext.currentTime);
            gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.2);
            
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.2);
        } catch (error) {
            console.warn('Could not play notification sound:', error);
        }
    }

    // Settings management
    function updateSettings(newSettings) {
        Object.assign(smartSettings, newSettings);
        localStorage.setItem('tripNotifications_settings', JSON.stringify(smartSettings));
    }

    function getSettings() {
        return TripUtils.deepClone(smartSettings);
    }

    // Request permission for browser notifications
    function requestPermission() {
        if ('Notification' in window) {
            return Notification.requestPermission();
        }
        return Promise.resolve('denied');
    }

    // Send browser notification
    function sendBrowserNotification(title, options = {}) {
        if ('Notification' in window && Notification.permission === 'granted') {
            const notification = new Notification(title, {
                icon: '/favicon.ico',
                badge: '/favicon.ico',
                ...options
            });
            
            // Auto-close after 5 seconds
            setTimeout(() => {
                notification.close();
            }, 5000);
            
            return notification;
        }
        return null;
    }

    // Add CSS styles for notifications
    function addNotificationStyles() {
        if (document.getElementById('notification-styles')) return;
        
        const style = document.createElement('style');
        style.id = 'notification-styles';
        style.textContent = `
            .notification-container {
                pointer-events: none;
            }
            
            .notification {
                background: white;
                border-radius: 10px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.2);
                margin-bottom: 10px;
                padding: 15px 20px;
                max-width: 400px;
                pointer-events: auto;
                opacity: 0;
                transform: translateX(100%);
                transition: all 0.3s ease;
                border-left: 5px solid #667eea;
                position: relative;
            }
            
            .notification.fade-in {
                opacity: 1;
                transform: translateX(0);
            }
            
            .notification.fade-out {
                opacity: 0;
                transform: translateX(100%);
            }
            
            .notification-success {
                border-left-color: #28a745;
                background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%);
            }
            
            .notification-warning {
                border-left-color: #ffc107;
                background: linear-gradient(135deg, #fffbf0 0%, #ffffff 100%);
            }
            
            .notification-error {
                border-left-color: #dc3545;
                background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
            }
            
            .notification-info {
                border-left-color: #17a2b8;
                background: linear-gradient(135deg, #f0fbff 0%, #ffffff 100%);
            }
            
            .notification-budget {
                border-left-color: #e67e22;
                background: linear-gradient(135deg, #fff8f0 0%, #ffffff 100%);
            }
            
            .notification-schedule {
                border-left-color: #9b59b6;
                background: linear-gradient(135deg, #f8f5ff 0%, #ffffff 100%);
            }
            
            .notification-booking {
                border-left-color: #e91e63;
                background: linear-gradient(135deg, #fff0f5 0%, #ffffff 100%);
            }
            
            .notification-high-priority {
                animation: pulse 2s infinite;
            }
            
            @keyframes pulse {
                0% { box-shadow: 0 5px 20px rgba(0,0,0,0.2); }
                50% { box-shadow: 0 5px 30px rgba(255,0,0,0.3); }
                100% { box-shadow: 0 5px 20px rgba(0,0,0,0.2); }
            }
            
            .notification-content {
                display: flex;
                align-items: center;
                gap: 12px;
            }
            
            .notification-icon {
                font-size: 20px;
                flex-shrink: 0;
            }
            
            .notification-message {
                flex: 1;
                font-size: 14px;
                color: #333;
                line-height: 1.4;
            }
            
            .notification-close {
                background: none;
                border: none;
                font-size: 20px;
                color: #6c757d;
                cursor: pointer;
                padding: 0;
                width: 24px;
                height: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                flex-shrink: 0;
            }
            
            .notification-close:hover {
                background: #f8f9fa;
                color: #333;
            }
            
            .notification-actions {
                display: flex;
                gap: 10px;
                margin-top: 12px;
                padding-top: 12px;
                border-top: 1px solid #f1f3f4;
            }
            
            .notification-action {
                background: #667eea;
                color: white;
                border: none;
                padding: 6px 12px;
                border-radius: 6px;
                cursor: pointer;
                font-size: 12px;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            
            .notification-action:hover {
                background: #5a6fd8;
                transform: translateY(-1px);
            }
        `;
        
        document.head.appendChild(style);
    }

    // Initialize styles
    addNotificationStyles();

    // Public API
    return {
        // Initialization
        init,
        
        // Basic notifications
        show,
        showSuccess,
        showWarning,
        showError,
        showInfo,
        
        // Management
        dismissNotification,
        dismissAll,
        
        // Settings
        updateSettings,
        getSettings,
        
        // Browser notifications
        requestPermission,
        sendBrowserNotification,
        
        // Constants
        TYPES
    };
})();