/**
 * Trip Manager - Tab Management
 * Version: 1.0.0
 * Handles tab navigation and content switching
 */

window.TripTabs = (function() {
    'use strict';

    // Tab configurations
    const tabConfigs = {
        dashboard: {
            title: '📊 Tổng Quan',
            component: 'TripDashboard',
            description: 'Tổng quan về chuyến đi và thống kê'
        },
        schedule: {
            title: '📅 Lịch Trình',
            component: 'TripSchedule',
            description: 'Lập lịch chi tiết theo ngày giờ'
        },
        timeline: {
            title: '⏱️ Timeline',
            component: 'TripTimeline',
            description: 'Theo dõi tiến độ chuyến đi'
        },
        destinations: {
            title: '📍 Điểm Đến',
            component: 'TripDestinations',
            description: 'Quản lý các điểm đến'
        },
        budget: {
            title: '💰 Ngân Sách',
            component: 'TripBudget',
            description: 'Quản lý ngân sách dự trù'
        },
        expenses: {
            title: '📊 Chi Tiêu',
            component: 'TripExpenses',
            description: 'Theo dõi chi tiêu thực tế'
        },
        bookings: {
            title: '🎫 Vé & Đặt Chỗ',
            component: 'TripBookings',
            description: 'Quản lý vé và booking'
        },
        checklist: {
            title: '✅ Checklist',
            component: 'TripChecklist',
            description: 'Danh sách việc cần làm'
        },
        suggestions: {
            title: '💡 Gợi Ý',
            component: 'TripSuggestions',
            description: 'Gợi ý thông minh'
        },
        reports: {
            title: '📈 Báo Cáo',
            component: 'TripReports',
            description: 'Báo cáo và phân tích'
        },
        setup: {
            title: '⚙️ Thiết Lập',
            component: 'TripSetup',
            description: 'Cài đặt ứng dụng'
        },
        calculator: {
            title: '🧮 Tính Toán',
            component: 'TripCalculator',
            description: 'Máy tính chi tiêu'
        },
        guide: {
            title: '📖 Hướng Dẫn',
            component: null,
            description: 'Hướng dẫn sử dụng ứng dụng'
        },
        faq: {
            title: '❓ FAQ',
            component: null,
            description: 'Câu hỏi thường gặp'
        },
        data: {
            title: '💾 Quản Lý Dữ Liệu',
            component: null,
            description: 'Xuất/nhập và quản lý dữ liệu'
        }
    };

    // Current active tab
    let currentTab = 'dashboard';
    
    // Tab history for navigation
    let tabHistory = ['dashboard'];
    let historyIndex = 0;

    // Tab state storage
    let tabStates = {};

    function init() {
        console.log('TripTabs: Initializing...');
        
        setupTabNavigation();
        loadTabState();
        
        // Set initial tab
        const urlTab = TripUtils.getQueryParam('tab');
        if (urlTab && tabConfigs[urlTab]) {
            switchTab(urlTab, false);
        } else {
            switchTab(currentTab, false);
        }
        
        console.log('TripTabs: Initialized successfully');
    }

    // Setup tab navigation
    function setupTabNavigation() {
        const tabButtons = document.querySelectorAll('.tab-button');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                const tabName = extractTabNameFromButton(button);
                if (tabName) {
                    switchTab(tabName);
                }
            });
        });

        // Setup keyboard navigation
        document.addEventListener('keydown', handleKeyboardNavigation);
    }

    // Extract tab name from button
    function extractTabNameFromButton(button) {
        const onclick = button.getAttribute('onclick');
        if (onclick) {
            const match = onclick.match(/switchTab\(['"]([^'"]+)['"]\)/);
            return match ? match[1] : null;
        }
        return null;
    }

    // Switch to a tab
    function switchTab(tabName, addToHistory = true) {
        const config = tabConfigs[tabName];
        if (!config) {
            console.error(`Tab configuration not found: ${tabName}`);
            return false;
        }

        // Save current tab state
        saveCurrentTabState();

        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });

        // Remove active class from all tab buttons
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active');
        });

        // Show selected tab content
        const tabContent = document.getElementById(tabName);
        if (tabContent) {
            tabContent.classList.add('active');
            
            // Add fade-in animation
            tabContent.style.opacity = '0';
            setTimeout(() => {
                tabContent.style.opacity = '1';
                tabContent.style.transition = 'opacity 0.3s ease';
            }, 10);
        }

        // Activate corresponding tab button
        const activeButton = Array.from(document.querySelectorAll('.tab-button'))
            .find(button => extractTabNameFromButton(button) === tabName);
        
        if (activeButton) {
            activeButton.classList.add('active');
        }

        // Update current tab
        const previousTab = currentTab;
        currentTab = tabName;

        // Add to history
        if (addToHistory && previousTab !== tabName) {
            addToTabHistory(tabName);
        }

        // Update URL
        TripUtils.setQueryParam('tab', tabName);

        // Load tab content
        loadTabContent(tabName);

        // Restore tab state
        restoreTabState(tabName);

        // Update page title
        updatePageTitle(config);

        // Emit tab change event
        TripCore.emit('tabChanged', {
            from: previousTab,
            to: tabName,
            config: config
        });

        console.log(`TripTabs: Switched to ${tabName}`);
        return true;
    }

    // Load tab content
    function loadTabContent(tabName) {
        const config = tabConfigs[tabName];
        if (!config.component) return;

        try {
            // Get component
            const componentPath = config.component.split('.');
            let component = window;
            
            for (const part of componentPath) {
                component = component[part];
            }

            // Initialize component if it has init method
            if (component && typeof component.init === 'function') {
                component.init();
            }

            // Render component if it has render method
            if (component && typeof component.render === 'function') {
                component.render();
            }

            // Update component if it has update method
            if (component && typeof component.update === 'function') {
                component.update();
            }

        } catch (error) {
            console.error(`Error loading tab content for ${tabName}:`, error);
            
            // Show error message in tab
            const tabContent = document.getElementById(tabName);
            if (tabContent) {
                tabContent.innerHTML = `
                    <div class="tab-error">
                        <h3>⚠️ Lỗi Tải Nội Dung</h3>
                        <p>Không thể tải nội dung cho tab ${config.title}.</p>
                        <button class="btn" onclick="TripTabs.switchTab('dashboard')">
                            Về Trang Chính
                        </button>
                    </div>
                `;
            }
        }
    }

    // Add to tab history
    function addToTabHistory(tabName) {
        // Remove any tabs after current position
        tabHistory = tabHistory.slice(0, historyIndex + 1);
        
        // Add new tab
        tabHistory.push(tabName);
        historyIndex = tabHistory.length - 1;
        
        // Limit history size
        if (tabHistory.length > 20) {
            tabHistory = tabHistory.slice(-20);
            historyIndex = tabHistory.length - 1;
        }
    }

    // Navigate back in tab history
    function goBack() {
        if (historyIndex > 0) {
            historyIndex--;
            const previousTab = tabHistory[historyIndex];
            switchTab(previousTab, false);
        }
    }

    // Navigate forward in tab history
    function goForward() {
        if (historyIndex < tabHistory.length - 1) {
            historyIndex++;
            const nextTab = tabHistory[historyIndex];
            switchTab(nextTab, false);
        }
    }

    // Check if can go back
    function canGoBack() {
        return historyIndex > 0;
    }

    // Check if can go forward
    function canGoForward() {
        return historyIndex < tabHistory.length - 1;
    }

    // Handle keyboard navigation
    function handleKeyboardNavigation(event) {
        // Only handle if no input is focused
        if (document.activeElement.tagName === 'INPUT' || 
            document.activeElement.tagName === 'TEXTAREA' ||
            document.activeElement.tagName === 'SELECT') {
            return;
        }

        // Alt + Arrow keys for tab navigation
        if (event.altKey) {
            switch (event.key) {
                case 'ArrowLeft':
                    event.preventDefault();
                    navigateToPreviousTab();
                    break;
                case 'ArrowRight':
                    event.preventDefault();
                    navigateToNextTab();
                    break;
            }
        }

        // Number keys for quick tab access
        if (event.key >= '1' && event.key <= '9' && event.ctrlKey) {
            event.preventDefault();
            const tabIndex = parseInt(event.key) - 1;
            const tabNames = Object.keys(tabConfigs);
            if (tabIndex < tabNames.length) {
                switchTab(tabNames[tabIndex]);
            }
        }

        // Escape key to go to dashboard
        if (event.key === 'Escape' && currentTab !== 'dashboard') {
            switchTab('dashboard');
        }
    }

    // Navigate to previous tab
    function navigateToPreviousTab() {
        const tabNames = Object.keys(tabConfigs);
        const currentIndex = tabNames.indexOf(currentTab);
        const previousIndex = currentIndex > 0 ? currentIndex - 1 : tabNames.length - 1;
        switchTab(tabNames[previousIndex]);
    }

    // Navigate to next tab
    function navigateToNextTab() {
        const tabNames = Object.keys(tabConfigs);
        const currentIndex = tabNames.indexOf(currentTab);
        const nextIndex = currentIndex < tabNames.length - 1 ? currentIndex + 1 : 0;
        switchTab(tabNames[nextIndex]);
    }

    // Save current tab state
    function saveCurrentTabState() {
        const tabContent = document.getElementById(currentTab);
        if (!tabContent) return;

        const state = {
            scrollTop: tabContent.scrollTop,
            timestamp: Date.now()
        };

        // Save form data if exists
        const forms = tabContent.querySelectorAll('form');
        if (forms.length > 0) {
            state.forms = Array.from(forms).map(form => {
                const formData = new FormData(form);
                const data = {};
                for (let [key, value] of formData.entries()) {
                    data[key] = value;
                }
                return {
                    id: form.id,
                    data: data
                };
            });
        }

        tabStates[currentTab] = state;
        saveTabState();
    }

    // Restore tab state
    function restoreTabState(tabName) {
        const state = tabStates[tabName];
        if (!state) return;

        const tabContent = document.getElementById(tabName);
        if (!tabContent) return;

        // Restore scroll position
        setTimeout(() => {
            if (state.scrollTop) {
                tabContent.scrollTop = state.scrollTop;
            }
        }, 100);

        // Restore form data
        if (state.forms) {
            state.forms.forEach(formState => {
                const form = document.getElementById(formState.id);
                if (form) {
                    Object.entries(formState.data).forEach(([key, value]) => {
                        const input = form.querySelector(`[name="${key}"]`);
                        if (input) {
                            input.value = value;
                        }
                    });
                }
            });
        }
    }

    // Save tab state to localStorage
    function saveTabState() {
        try {
            localStorage.setItem('tripTabs_state', JSON.stringify({
                currentTab: currentTab,
                tabHistory: tabHistory,
                historyIndex: historyIndex,
                tabStates: tabStates
            }));
        } catch (error) {
            console.warn('Could not save tab state:', error);
        }
    }

    // Load tab state from localStorage
    function loadTabState() {
        try {
            const saved = localStorage.getItem('tripTabs_state');
            if (saved) {
                const state = JSON.parse(saved);
                
                if (state.currentTab && tabConfigs[state.currentTab]) {
                    currentTab = state.currentTab;
                }
                
                if (state.tabHistory) {
                    tabHistory = state.tabHistory;
                    historyIndex = state.historyIndex || 0;
                }
                
                if (state.tabStates) {
                    tabStates = state.tabStates;
                }
            }
        } catch (error) {
            console.warn('Could not load tab state:', error);
        }
    }

    // Update page title
    function updatePageTitle(config) {
        const baseTitle = 'Quản Lý Chuyến Đi';
        document.title = `${config.title} - ${baseTitle}`;
    }

    // Get current tab
    function getCurrentTab() {
        return currentTab;
    }

    // Get tab configurations
    function getTabConfigs() {
        return TripUtils.deepClone(tabConfigs);
    }

    // Check if tab exists
    function tabExists(tabName) {
        return tabName in tabConfigs;
    }

    // Get tab navigation info
    function getNavigationInfo() {
        return {
            currentTab: currentTab,
            canGoBack: canGoBack(),
            canGoForward: canGoForward(),
            history: [...tabHistory],
            historyIndex: historyIndex
        };
    }

    // Add tab styles
    function addTabStyles() {
        if (document.getElementById('tab-styles')) return;

        const style = document.createElement('style');
        style.id = 'tab-styles';
        style.textContent = `
            .tab-error {
                text-align: center;
                padding: 60px 20px;
                color: #6c757d;
            }

            .tab-error h3 {
                font-size: 24px;
                margin-bottom: 15px;
                color: #e74c3c;
            }

            .tab-error p {
                font-size: 16px;
                margin-bottom: 25px;
                line-height: 1.5;
            }

            .tab-error .btn {
                min-width: 150px;
            }

            /* Tab content animations */
            .tab-content {
                opacity: 0;
                transform: translateY(10px);
                transition: all 0.3s ease;
            }

            .tab-content.active {
                opacity: 1;
                transform: translateY(0);
            }

            /* Loading states */
            .tab-loading {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 60px 20px;
                color: #6c757d;
            }

            .tab-loading .loading {
                margin-right: 10px;
            }

            /* Tab indicators */
            .tab-button.has-updates::after {
                content: '';
                position: absolute;
                top: 8px;
                right: 8px;
                width: 8px;
                height: 8px;
                background: #e74c3c;
                border-radius: 50%;
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% { transform: scale(1); opacity: 1; }
                50% { transform: scale(1.2); opacity: 0.7; }
                100% { transform: scale(1); opacity: 1; }
            }

            /* Responsive tab navigation */
            @media (max-width: 768px) {
                .tabs-nav {
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                }

                .tab-button {
                    flex-shrink: 0;
                    min-width: 120px;
                }
            }
        `;

        document.head.appendChild(style);
    }

    // Initialize styles
    addTabStyles();

    // Public API
    return {
        // Initialization
        init,

        // Navigation
        switchTab,
        goBack,
        goForward,
        navigateToPreviousTab,
        navigateToNextTab,

        // Information
        getCurrentTab,
        getTabConfigs,
        tabExists,
        getNavigationInfo,
        canGoBack,
        canGoForward,

        // State management
        saveCurrentTabState,
        restoreTabState
    };
})();