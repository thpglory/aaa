/**
 * Trip Manager - Dashboard Management
 * Version: 1.0.0
 * Handles dashboard display, statistics, and overview
 */

window.TripDashboard = (function() {
    'use strict';

    // Dashboard cards configuration
    const dashboardCards = {
        budget: {
            title: 'Ngân Sách',
            icon: '💰',
            getValue: () => {
                const stats = TripCore.getStatistics();
                return TripUtils.formatMoney(stats.totalSpent);
            },
            getSubtitle: () => {
                const tripInfo = TripCore.getTripInfo();
                return `Dự trù: ${TripUtils.formatMoney(tripInfo.plannedBudget)}`;
            },
            getProgress: () => {
                const stats = TripCore.getStatistics();
                return Math.min(stats.budgetUsed, 100);
            },
            getProgressText: () => {
                const stats = TripCore.getStatistics();
                return `${stats.budgetUsed.toFixed(1)}% đã sử dụng`;
            },
            getColor: () => {
                const stats = TripCore.getStatistics();
                if (stats.budgetUsed >= 100) return '#e74c3c';
                if (stats.budgetUsed >= 80) return '#f39c12';
                return '#667eea';
            },
            onClick: () => TripTabs.switchTab('budget')
        },
        destinations: {
            title: 'Điểm Đến',
            icon: '📍',
            getValue: () => {
                const stats = TripCore.getStatistics();
                return stats.destinationsCount;
            },
            getSubtitle: () => 'địa điểm',
            getProgress: () => {
                const stats = TripCore.getStatistics();
                return stats.progressPercentage;
            },
            getProgressText: () => {
                const stats = TripCore.getStatistics();
                return `${stats.progressPercentage.toFixed(0)}% hoàn thành`;
            },
            getColor: () => '#2ecc71',
            onClick: () => TripTabs.switchTab('destinations')
        },
        expenses: {
            title: 'Chi Tiêu',
            icon: '📊',
            getValue: () => {
                const stats = TripCore.getStatistics();
                return stats.expensesCount;
            },
            getSubtitle: () => 'giao dịch',
            getProgress: () => {
                const stats = TripCore.getStatistics();
                return Math.min(stats.expensesCount * 2, 100);
            },
            getProgressText: () => {
                const stats = TripCore.getStatistics();
                return TripUtils.formatMoney(stats.totalSpent);
            },
            getColor: () => '#e67e22',
            onClick: () => TripTabs.switchTab('expenses')
        },
        timeline: {
            title: 'Tiến Độ',
            icon: '⏰',
            getValue: () => {
                const tripInfo = TripCore.getTripInfo();
                const stats = TripCore.getStatistics();
                if (tripInfo.totalDays > 0) {
                    const today = new Date();
                    const startDate = new Date(tripInfo.startDate);
                    const endDate = new Date(tripInfo.endDate);
                    
                    if (today < startDate) {
                        return Math.ceil((startDate - today) / (1000 * 60 * 60 * 24));
                    } else if (today > endDate) {
                        return 0;
                    } else {
                        return Math.ceil((endDate - today) / (1000 * 60 * 60 * 24));
                    }
                }
                return 0;
            },
            getSubtitle: () => {
                const tripInfo = TripCore.getTripInfo();
                if (tripInfo.totalDays > 0) {
                    const today = new Date();
                    const startDate = new Date(tripInfo.startDate);
                    const endDate = new Date(tripInfo.endDate);
                    
                    if (today < startDate) {
                        return 'ngày nữa bắt đầu';
                    } else if (today > endDate) {
                        return 'đã kết thúc';
                    } else {
                        return 'ngày còn lại';
                    }
                }
                return 'chưa lên lịch';
            },
            getProgress: () => {
                const tripInfo = TripCore.getTripInfo();
                if (tripInfo.totalDays > 0) {
                    const today = new Date();
                    const startDate = new Date(tripInfo.startDate);
                    const endDate = new Date(tripInfo.endDate);
                    
                    if (today < startDate) {
                        return 0;
                    } else if (today > endDate) {
                        return 100;
                    } else {
                        const totalDays = tripInfo.totalDays;
                        const passedDays = Math.ceil((today - startDate) / (1000 * 60 * 60 * 24));
                        return (passedDays / totalDays) * 100;
                    }
                }
                return 0;
            },
            getProgressText: () => {
                const tripInfo = TripCore.getTripInfo();
                if (tripInfo.totalDays > 0) {
                    const today = new Date();
                    const startDate = new Date(tripInfo.startDate);
                    const endDate = new Date(tripInfo.endDate);
                    
                    if (today < startDate) {
                        return 'Chuẩn bị';
                    } else if (today > endDate) {
                        return 'Hoàn thành';
                    } else {
                        return 'Đang diễn ra';
                    }
                }
                return 'Chưa lên lịch';
            },
            getColor: () => '#9b59b6',
            onClick: () => TripTabs.switchTab('timeline')
        }
    };

    // Quick actions configuration
    const quickActions = {
        addExpense: {
            title: 'Thêm Chi Tiêu',
            icon: '💳',
            color: '#e74c3c',
            action: () => TripModals.openModal('quickExpenseModal')
        },
        addDestination: {
            title: 'Thêm Điểm Đến',
            icon: '📍',
            color: '#2ecc71',
            action: () => TripModals.openModal('destinationModal')
        },
        viewSchedule: {
            title: 'Xem Lịch Trình',
            icon: '📅',
            color: '#3498db',
            action: () => TripTabs.switchTab('schedule')
        },
        calculator: {
            title: 'Máy Tính',
            icon: '🧮',
            color: '#9b59b6',
            action: () => TripTabs.switchTab('calculator')
        },
        exportData: {
            title: 'Xuất Dữ Liệu',
            icon: '💾',
            color: '#34495e',
            action: () => exportData()
        },
        viewReports: {
            title: 'Báo Cáo',
            icon: '📈',
            color: '#f39c12',
            action: () => TripTabs.switchTab('reports')
        }
    };

    // Update intervals
    let updateInterval;

    function init() {
        console.log('TripDashboard: Initializing...');
        
        render();
        startAutoUpdate();
        setupEventListeners();
        
        console.log('TripDashboard: Initialized successfully');
    }

    // Render dashboard
    function render() {
        renderDashboardCards();
        renderQuickActions();
        renderExpenseCategories();
        renderRecentActivity();
        renderUpcomingEvents();
        renderWeatherWidget();
        renderInsights();
    }

    // Update dashboard
    function update() {
        renderDashboardCards();
        renderExpenseCategories();
        renderRecentActivity();
        renderUpcomingEvents();
        renderInsights();
        updateHeader();
    }

    // Render dashboard cards
    function renderDashboardCards() {
        const container = TripUtils.getElement('dashboardGrid');
        if (!container) return;

        container.innerHTML = '';

        Object.entries(dashboardCards).forEach(([key, card]) => {
            try {
                const cardElement = createDashboardCard(key, card);
                container.appendChild(cardElement);
            } catch (error) {
                console.error(`Error rendering dashboard card ${key}:`, error);
            }
        });
    }

    // Create dashboard card element
    function createDashboardCard(key, card) {
        const value = card.getValue();
        const subtitle = card.getSubtitle();
        const progress = card.getProgress();
        const progressText = card.getProgressText();
        const color = card.getColor();

        const cardDiv = TripUtils.createElement('div', {
            className: 'dashboard-card fade-in',
            style: `border-left-color: ${color}; cursor: pointer;`
        });

        cardDiv.innerHTML = `
            <div class="card-header">
                <span class="card-title">${card.title}</span>
                <span class="card-icon">${card.icon}</span>
            </div>
            <div class="card-value" style="color: ${color};">${value}</div>
            <div class="card-subtitle">${subtitle}</div>
            <div class="progress-container">
                <div class="progress-bar" style="width: ${progress}%; background: ${color};"></div>
            </div>
            <div class="progress-text">${progressText}</div>
        `;

        // Add click handler
        cardDiv.addEventListener('click', () => {
            if (card.onClick) {
                card.onClick();
            }
        });

        return cardDiv;
    }

    // Render quick actions
    function renderQuickActions() {
        const container = TripUtils.getElement('quickActions');
        if (!container) return;

        container.innerHTML = '';

        Object.entries(quickActions).forEach(([key, action]) => {
            const actionElement = createQuickActionElement(key, action);
            container.appendChild(actionElement);
        });
    }

    // Create quick action element
    function createQuickActionElement(key, action) {
        const actionDiv = TripUtils.createElement('button', {
            className: 'quick-action-btn',
            style: `background: linear-gradient(135deg, ${action.color} 0%, ${adjustColor(action.color, -20)} 100%);`
        });

        actionDiv.innerHTML = `
            <span class="quick-action-icon">${action.icon}</span>
            ${action.title}
        `;

        actionDiv.addEventListener('click', () => {
            if (action.action) {
                action.action();
            }
        });

        return actionDiv;
    }

    // Render expense categories
    function renderExpenseCategories() {
        const container = TripUtils.getElement('categoryGrid');
        if (!container) return;

        container.innerHTML = '';

        const categories = TripCore.getExpenseCategories();
        const categoryTotals = TripCore.getSpentByCategory();
        const totalSpent = TripCore.getStatistics().totalSpent;
        const plannedBudget = TripCore.getTripInfo().plannedBudget;

        Object.entries(categories).forEach(([key, category]) => {
            const total = categoryTotals[key] || 0;
            const percentage = plannedBudget > 0 ? (total / plannedBudget * 100) : 0;
            const categoryElement = createCategoryElement(key, category, total, percentage);
            container.appendChild(categoryElement);
        });
    }

    // Create category element
    function createCategoryElement(key, category, total, percentage) {
        const categoryDiv = TripUtils.createElement('div', {
            className: 'category-card fade-in'
        });

        categoryDiv.innerHTML = `
            <div class="category-icon">${category.icon}</div>
            <div class="category-name">${category.name.replace(category.icon + ' ', '')}</div>
            <div class="category-amount">${TripUtils.formatMoney(total)}</div>
            <div class="progress-container">
                <div class="progress-bar" style="width: ${Math.min(percentage, 100)}%; background: ${category.color};"></div>
            </div>
            <div class="progress-text">${percentage.toFixed(1)}% ngân sách</div>
        `;

        categoryDiv.addEventListener('click', () => {
            TripTabs.switchTab('expenses');
            // TODO: Filter by category
        });

        return categoryDiv;
    }

    // Render recent activity
    function renderRecentActivity() {
        const tripData = TripCore.getData();
        const recentExpenses = tripData.expenses
            .sort((a, b) => new Date(b.date) - new Date(a.date))
            .slice(0, 5);

        // Show in a widget or notification if needed
        if (recentExpenses.length > 0) {
            console.log('Recent expenses:', recentExpenses);
        }
    }

    // Render upcoming events
    function renderUpcomingEvents() {
        const stats = TripCore.getStatistics();
        const upcomingBookings = stats.upcomingBookings.slice(0, 3);

        if (upcomingBookings.length > 0) {
            // Show upcoming bookings notification
            console.log('Upcoming bookings:', upcomingBookings);
        }
    }

    // Render weather widget (placeholder)
    function renderWeatherWidget() {
        // TODO: Integrate with weather API
        console.log('Weather widget placeholder');
    }

    // Render insights and recommendations
    function renderInsights() {
        const insights = generateInsights();
        
        if (insights.length > 0) {
            displayInsights(insights);
        }
    }

    // Generate insights based on data
    function generateInsights() {
        const insights = [];
        const stats = TripCore.getStatistics();
        const tripInfo = TripCore.getTripInfo();

        // Budget insights
        if (stats.budgetUsed > 80) {
            insights.push({
                type: 'warning',
                title: 'Cảnh báo ngân sách',
                message: `Bạn đã sử dụng ${stats.budgetUsed.toFixed(1)}% ngân sách. Hãy cân nhắc chi tiêu.`,
                action: () => TripTabs.switchTab('budget')
            });
        }

        // Spending insights
        const topCategory = stats.topExpenseCategory;
        if (topCategory && topCategory.percentage > 40) {
            insights.push({
                type: 'info',
                title: 'Phân tích chi tiêu',
                message: `${topCategory.percentage.toFixed(1)}% ngân sách dành cho ${TripCore.getExpenseCategories()[topCategory.category].name}`,
                action: () => TripTabs.switchTab('expenses')
            });
        }

        // Timeline insights
        if (stats.destinationsCount > 0 && stats.progressPercentage < 30) {
            insights.push({
                type: 'suggestion',
                title: 'Tiến độ chuyến đi',
                message: 'Bạn có thể bắt đầu check-in các điểm đến để theo dõi hành trình.',
                action: () => TripTabs.switchTab('timeline')
            });
        }

        // Trip preparation insights
        if (tripInfo.startDate) {
            const daysUntilTrip = TripUtils.daysBetween(TripUtils.getCurrentDate(), tripInfo.startDate);
            if (daysUntilTrip > 0 && daysUntilTrip <= 7) {
                insights.push({
                    type: 'reminder',
                    title: 'Chuẩn bị chuyến đi',
                    message: `Còn ${daysUntilTrip} ngày nữa. Hãy kiểm tra checklist chuẩn bị.`,
                    action: () => TripTabs.switchTab('checklist')
                });
            }
        }

        return insights;
    }

    // Display insights
    function displayInsights(insights) {
        // For now, just log insights
        // In future, can show as notifications or in a dedicated widget
        insights.forEach(insight => {
            console.log(`Insight [${insight.type}]: ${insight.title} - ${insight.message}`);
        });
    }

    // Update header statistics
    function updateHeader() {
        const stats = TripCore.getStatistics();
        const tripInfo = TripCore.getTripInfo();

        const headerBudget = TripUtils.getElement('headerBudget');
        const headerSpent = TripUtils.getElement('headerSpent');
        const headerDays = TripUtils.getElement('headerDays');

        if (headerBudget) {
            headerBudget.textContent = TripUtils.formatMoney(tripInfo.plannedBudget);
        }

        if (headerSpent) {
            headerSpent.textContent = TripUtils.formatMoney(stats.totalSpent);
        }

        if (headerDays) {
            headerDays.textContent = tripInfo.totalDays;
        }

        // Update trip title
        const tripTitle = TripUtils.getElement('tripTitle');
        if (tripTitle) {
            tripTitle.textContent = `🌍 ${tripInfo.name}`;
        }
    }

    // Export data functionality
    function exportData() {
        const success = TripCore.exportData();
        if (success) {
            TripNotifications.showSuccess('Đã xuất dữ liệu thành công!');
        } else {
            TripNotifications.showError('Có lỗi khi xuất dữ liệu!');
        }
    }

    // Adjust color brightness
    function adjustColor(color, amount) {
        // Simple color adjustment (this is a basic implementation)
        const usePound = color[0] === '#';
        const col = usePound ? color.slice(1) : color;
        
        const num = parseInt(col, 16);
        let r = (num >> 16) + amount;
        let g = (num >> 8 & 0x00FF) + amount;
        let b = (num & 0x0000FF) + amount;
        
        r = r > 255 ? 255 : r < 0 ? 0 : r;
        g = g > 255 ? 255 : g < 0 ? 0 : g;
        b = b > 255 ? 255 : b < 0 ? 0 : b;
        
        return (usePound ? '#' : '') + (r << 16 | g << 8 | b).toString(16).padStart(6, '0');
    }

    // Start auto-update
    function startAutoUpdate() {
        // Update dashboard every 30 seconds
        updateInterval = setInterval(() => {
            update();
        }, 30000);
    }

    // Stop auto-update
    function stopAutoUpdate() {
        if (updateInterval) {
            clearInterval(updateInterval);
            updateInterval = null;
        }
    }

    // Setup event listeners
    function setupEventListeners() {
        // Listen to core data changes
        TripCore.on('dataChanged', () => {
            update();
        });

        TripCore.on('expenseAdded', () => {
            update();
        });

        TripCore.on('destinationAdded', () => {
            update();
        });

        TripCore.on('tripUpdated', () => {
            update();
        });

        // Listen to tab changes
        TripCore.on('tabChanged', (event) => {
            if (event.to === 'dashboard') {
                update();
            }
        });
    }

    // Cleanup
    function cleanup() {
        stopAutoUpdate();
    }

    // Public API
    return {
        // Initialization
        init,
        render,
        update,
        cleanup,

        // Actions
        exportData,

        // Configuration
        dashboardCards,
        quickActions
    };
})();