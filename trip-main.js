/**
 * Trip Manager - Main Application Controller
 * Version: 1.0.0
 * Initializes and coordinates all application modules
 */

window.TripMain = (function() {
    'use strict';

    // Application state
    let appState = {
        initialized: false,
        modules: {},
        errors: [],
        performance: {
            startTime: Date.now(),
            loadTime: 0,
            initTime: 0
        }
    };

    // Utility modules (no initialization needed)
    const utilityModules = ['TripUtils'];
    
    // Module initialization order (dependencies matter)
    const initializationOrder = [
        'TripCore', 
        'TripNotifications',
        'TripModals',
        'TripTabs',
        'TripDashboard',
        'TripExpenses',
        'TripDestinations',
        'TripTimeline',
        'TripBudget',
        'TripSchedule',
        'TripBookings',
        'TripChecklist',
        'TripSuggestions',
        'TripReports',
        'TripCalculator'
    ];

    // Application configuration
    const config = {
        version: '1.0.0',
        name: 'Trip Manager',
        author: 'Trip Manager Team',
        autoSave: true,
        autoSaveInterval: 30000, // 30 seconds
        backupInterval: 300000, // 5 minutes
        maxErrors: 10,
        enableAnalytics: false,
        enableServiceWorker: false
    };

    // Error handler
    function handleError(error, context = 'Unknown') {
        console.error(`[${context}] Error:`, error);
        
        appState.errors.push({
            error: error.message || error,
            context: context,
            timestamp: new Date().toISOString(),
            stack: error.stack
        });

        // Keep only recent errors
        if (appState.errors.length > config.maxErrors) {
            appState.errors = appState.errors.slice(-config.maxErrors);
        }

        // Show user-friendly error message
        if (window.TripNotifications) {
            TripNotifications.showError(`Lỗi trong ${context}: ${error.message || 'Có lỗi xảy ra'}`);
        }
    }

    // Global error handler
    function setupGlobalErrorHandling() {
        window.addEventListener('error', (event) => {
            handleError(event.error, 'Global Error');
        });

        window.addEventListener('unhandledrejection', (event) => {
            handleError(event.reason, 'Unhandled Promise');
            event.preventDefault();
        });
    }

    // Check utility modules (no init needed)
    function checkUtilityModules() {
        console.log('🔧 Checking utility modules...');
        
        for (const moduleName of utilityModules) {
            if (window[moduleName]) {
                appState.modules[moduleName] = {
                    initialized: true,
                    initTime: 0,
                    version: window[moduleName].version || 'unknown',
                    type: 'utility'
                };
                console.log(`✅ ${moduleName} loaded (utility)`);
            } else {
                console.error(`❌ ${moduleName} not found`);
                throw new Error(`Required utility module ${moduleName} not found`);
            }
        }
    }

    // Check if module exists and has init method
    function isModuleReady(moduleName) {
        const module = window[moduleName];
        return module && typeof module.init === 'function';
    }

    // Initialize single module
    function initializeModule(moduleName) {
        try {
            if (!isModuleReady(moduleName)) {
                throw new Error(`Module ${moduleName} not found or missing init method`);
            }

            console.log(`Initializing ${moduleName}...`);
            
            const startTime = performance.now();
            window[moduleName].init();
            const endTime = performance.now();
            
            appState.modules[moduleName] = {
                initialized: true,
                initTime: endTime - startTime,
                version: window[moduleName].version || 'unknown'
            };
            
            console.log(`✅ ${moduleName} initialized in ${(endTime - startTime).toFixed(2)}ms`);
            
        } catch (error) {
            appState.modules[moduleName] = {
                initialized: false,
                error: error.message
            };
            handleError(error, moduleName);
            throw error;
        }
    }

    // Initialize all modules
    async function initializeModules() {
        console.log('🚀 Starting module initialization...');
        
        // Check utility modules first
        checkUtilityModules();
        
        for (const moduleName of initializationOrder) {
            try {
                await initializeModule(moduleName);
                
                // Small delay to prevent blocking UI
                if (initializationOrder.indexOf(moduleName) % 3 === 0) {
                    await new Promise(resolve => setTimeout(resolve, 10));
                }
                
            } catch (error) {
                console.error(`❌ Failed to initialize ${moduleName}:`, error);
                
                // Continue with other modules for non-critical failures
                if (['TripCore'].includes(moduleName)) {
                    throw error; // Critical modules must succeed
                }
            }
        }
        
        console.log('✨ Module initialization completed');
    }

    // Setup auto-save
    function setupAutoSave() {
        if (!config.autoSave || !window.TripCore) return;

        setInterval(() => {
            try {
                if (typeof TripCore.saveData === 'function') {
                    TripCore.saveData();
                    console.log('💾 Auto-save completed');
                }
            } catch (error) {
                handleError(error, 'Auto-save');
            }
        }, config.autoSaveInterval);

        // Save on page unload
        window.addEventListener('beforeunload', () => {
            try {
                if (typeof TripCore.saveData === 'function') {
                    TripCore.saveData();
                }
            } catch (error) {
                console.error('Error saving on unload:', error);
            }
        });
    }

    // Setup auto-backup
    function setupAutoBackup() {
        if (!window.TripCore) return;

        setInterval(() => {
            try {
                if (typeof TripCore.createBackup === 'function') {
                    TripCore.createBackup();
                    console.log('🔄 Auto-backup completed');
                }
            } catch (error) {
                handleError(error, 'Auto-backup');
            }
        }, config.backupInterval);
    }

    // Setup performance monitoring
    function setupPerformanceMonitoring() {
        // Memory usage warning
        if ('memory' in performance) {
            setInterval(() => {
                const memory = performance.memory;
                const usedMB = memory.usedJSHeapSize / 1048576;
                const limitMB = memory.jsHeapSizeLimit / 1048576;
                
                if (usedMB > limitMB * 0.8) {
                    console.warn(`⚠️ High memory usage: ${usedMB.toFixed(1)}MB / ${limitMB.toFixed(1)}MB`);
                }
            }, 60000); // Check every minute
        }

        // Page visibility handling
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                console.log('📱 App hidden - reducing activity');
            } else {
                console.log('📱 App visible - resuming activity');
                // Refresh data when app becomes visible
                if (window.TripDashboard && typeof TripDashboard.update === 'function') {
                    TripDashboard.update();
                }
            }
        });
    }

    // Setup responsive design helpers
    function setupResponsiveHelpers() {
        let resizeTimeout;
        
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                // Trigger resize events for modules that need it
                const event = new CustomEvent('tripResize', {
                    detail: {
                        width: window.innerWidth,
                        height: window.innerHeight,
                        isMobile: window.innerWidth <= 768
                    }
                });
                window.dispatchEvent(event);
            }, 250);
        });

        // Initial mobile detection
        const isMobile = window.innerWidth <= 768;
        document.body.classList.toggle('mobile', isMobile);
        document.body.classList.toggle('desktop', !isMobile);
    }

    // Setup keyboard shortcuts
    function setupKeyboardShortcuts() {
        document.addEventListener('keydown', (event) => {
            // Skip if user is typing in input
            if (['INPUT', 'TEXTAREA', 'SELECT'].includes(event.target.tagName)) {
                return;
            }

            // Global shortcuts
            if (event.ctrlKey || event.metaKey) {
                switch (event.key) {
                    case 's':
                        event.preventDefault();
                        if (window.TripCore && typeof TripCore.saveData === 'function') {
                            TripCore.saveData();
                            TripNotifications?.showSuccess('💾 Đã lưu dữ liệu');
                        }
                        break;
                        
                    case 'e':
                        event.preventDefault();
                        if (window.TripCore && typeof TripCore.exportData === 'function') {
                            TripCore.exportData();
                        }
                        break;

                    case 'n':
                        event.preventDefault();
                        if (window.TripModals) {
                            TripModals.openModal('quickExpenseModal');
                        }
                        break;
                }
            }

            // Tab shortcuts (Alt + number)
            if (event.altKey && !isNaN(event.key)) {
                event.preventDefault();
                const tabNumber = parseInt(event.key);
                const tabs = ['dashboard', 'schedule', 'timeline', 'destinations', 'budget', 'expenses', 'bookings', 'checklist', 'suggestions', 'reports'];
                
                if (tabNumber > 0 && tabNumber <= tabs.length && window.TripTabs) {
                    TripTabs.switchTab(tabs[tabNumber - 1]);
                }
            }
        });
    }

    // Setup analytics (placeholder)
    function setupAnalytics() {
        if (!config.enableAnalytics) return;

        // Track page views, user interactions, etc.
        console.log('📊 Analytics setup (placeholder)');
    }

    // Setup service worker (placeholder)
    function setupServiceWorker() {
        if (!config.enableServiceWorker || !('serviceWorker' in navigator)) return;

        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('🔧 Service Worker registered:', registration);
            })
            .catch(error => {
                console.log('❌ Service Worker registration failed:', error);
            });
    }

    // Initialize application
    async function init() {
        try {
            if (appState.initialized) {
                console.warn('⚠️ App already initialized');
                return;
            }

            const initStartTime = performance.now();
            
            console.log(`🌟 Initializing ${config.name} v${config.version}...`);

            // Setup global error handling first
            setupGlobalErrorHandling();

            // Initialize modules
            await initializeModules();

            // Setup additional features
            setupAutoSave();
            setupAutoBackup();
            setupPerformanceMonitoring();
            setupResponsiveHelpers();
            setupKeyboardShortcuts();
            setupAnalytics();
            setupServiceWorker();

            // Mark as initialized
            appState.initialized = true;
            appState.performance.initTime = performance.now() - initStartTime;
            appState.performance.loadTime = Date.now() - appState.performance.startTime;

            // Show success message
            console.log(`✅ ${config.name} initialized successfully in ${appState.performance.initTime.toFixed(2)}ms`);
            
            if (window.TripNotifications) {
                TripNotifications.showSuccess(`🎉 Ứng dụng đã sẵn sàng! Phiên bản ${config.version}`);
            }

            // Load initial data
            await loadInitialData();

            // Emit initialization complete event
            window.dispatchEvent(new CustomEvent('tripInitialized', {
                detail: {
                    version: config.version,
                    initTime: appState.performance.initTime,
                    modules: Object.keys(appState.modules)
                }
            }));

        } catch (error) {
            handleError(error, 'Initialization');
            showInitializationError(error);
        }
    }

    // Load initial data
    async function loadInitialData() {
        try {
            // Check if first time user
            const hasData = localStorage.getItem('tripData_v1');
            
            if (!hasData) {
                await showWelcomeMessage();
            } else {
                // Load existing data
                if (window.TripCore && typeof TripCore.loadData === 'function') {
                    TripCore.loadData();
                }
            }

            // Update dashboard
            if (window.TripDashboard && typeof TripDashboard.update === 'function') {
                TripDashboard.update();
            }

        } catch (error) {
            handleError(error, 'Load Initial Data');
        }
    }

    // Show welcome message for new users
    async function showWelcomeMessage() {
        if (!window.TripNotifications) return;

        TripNotifications.show(
            `🌟 Chào mừng bạn đến với Trip Manager!
            
            Đây là ứng dụng quản lý chuyến đi thông minh giúp bạn:
            • 📊 Theo dõi chi tiêu và ngân sách
            • 📍 Quản lý điểm đến và lịch trình  
            • ✅ Chuẩn bị checklist đầy đủ
            • 💡 Nhận gợi ý thông minh
            
            Hãy bắt đầu bằng cách thiết lập thông tin chuyến đi!`,
            TripNotifications.TYPES.INFO,
            0,
            {
                persistent: true,
                priority: 'high',
                actions: [
                    {
                        label: 'Thiết lập ngay',
                        handler: 'TripTabs.switchTab("setup"); TripNotifications.dismissAll();'
                    },
                    {
                        label: 'Khám phá',
                        handler: 'TripNotifications.dismissAll();'
                    }
                ]
            }
        );
    }

    // Show initialization error
    function showInitializationError(error) {
        const errorContainer = document.createElement('div');
        errorContainer.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            text-align: center;
            z-index: 10000;
            max-width: 400px;
            width: 90%;
        `;

        errorContainer.innerHTML = `
            <h2 style="color: #e74c3c; margin-bottom: 15px;">⚠️ Lỗi Khởi Tạo</h2>
            <p style="color: #6c757d; margin-bottom: 20px;">
                Không thể khởi tạo ứng dụng. Vui lòng thử lại.
            </p>
            <p style="font-size: 12px; color: #999; margin-bottom: 20px;">
                Lỗi: ${error.message}
            </p>
            <button onclick="location.reload()" style="
                background: #667eea;
                color: white;
                border: none;
                padding: 12px 24px;
                border-radius: 8px;
                cursor: pointer;
                font-weight: 600;
            ">
                🔄 Tải Lại Trang
            </button>
        `;

        document.body.appendChild(errorContainer);
    }

    // Get app status
    function getStatus() {
        return {
            initialized: appState.initialized,
            version: config.version,
            modules: appState.modules,
            errors: appState.errors,
            performance: appState.performance,
            memory: 'memory' in performance ? {
                used: Math.round(performance.memory.usedJSHeapSize / 1048576),
                total: Math.round(performance.memory.totalJSHeapSize / 1048576),
                limit: Math.round(performance.memory.jsHeapSizeLimit / 1048576)
            } : null
        };
    }

    // Restart app
    function restart() {
        appState.initialized = false;
        location.reload();
    }

    // Show debug info
    function showDebugInfo() {
        const status = getStatus();
        const debugInfo = `
            🔧 DEBUG INFO
            
            Version: ${status.version}
            Initialized: ${status.initialized}
            Init Time: ${status.performance.initTime?.toFixed(2)}ms
            Load Time: ${status.performance.loadTime}ms
            
            📦 MODULES (${Object.keys(status.modules).length})
            ${Object.entries(status.modules).map(([name, info]) => 
                `${info.initialized ? '✅' : '❌'} ${name} (${info.initTime?.toFixed(2) || 'N/A'}ms)`
            ).join('\n')}
            
            ${status.memory ? `💾 MEMORY
            Used: ${status.memory.used}MB
            Total: ${status.memory.total}MB
            Limit: ${status.memory.limit}MB` : ''}
            
            ${status.errors.length > 0 ? `❌ ERRORS (${status.errors.length})
            ${status.errors.slice(-3).map(err => `${err.context}: ${err.error}`).join('\n')}` : '✅ No errors'}
        `;

        console.log(debugInfo);
        
        if (window.TripNotifications) {
            TripNotifications.show(debugInfo.replace(/\n/g, '<br>'), TripNotifications.TYPES.INFO, 10000, {
                persistent: true
            });
        }
    }

    // Export app data
    function exportAppData() {
        try {
            const appData = {
                version: config.version,
                timestamp: new Date().toISOString(),
                tripData: window.TripCore ? TripCore.getData() : null,
                settings: window.TripCore ? TripCore.getSettings() : null,
                status: getStatus()
            };

            const dataStr = JSON.stringify(appData, null, 2);
            const filename = `trip_manager_export_${new Date().toISOString().split('T')[0]}.json`;
            
            if (window.TripUtils) {
                TripUtils.downloadFile(dataStr, filename, 'application/json');
                TripNotifications?.showSuccess('📤 Đã xuất dữ liệu ứng dụng');
            }

        } catch (error) {
            handleError(error, 'Export App Data');
        }
    }

    // Public API
    return {
        // Core functions
        init,
        restart,
        
        // Status and debugging
        getStatus,
        showDebugInfo,
        exportAppData,
        
        // Configuration
        config,
        
        // Utilities
        handleError,
        isModuleReady
    };
})();

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        TripMain.init().catch(console.error);
    });
} else {
    // DOM already loaded
    TripMain.init().catch(console.error);
}