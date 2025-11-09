/**
 * Trip Manager - Budget Management
 * Version: 1.0.0
 * Handles budget planning, tracking, and analysis
 */

window.TripBudget = (function() {
    'use strict';

    // Budget categories with default allocations
    const budgetCategories = {
        transportation: {
            name: '🚗 Di chuyển',
            icon: '🚗',
            color: '#3498db',
            defaultPercentage: 25,
            subcategories: ['flight', 'train', 'bus', 'taxi']
        },
        accommodation: {
            name: '🏨 Lưu trú',
            icon: '🏨',
            color: '#2ecc71',
            defaultPercentage: 30,
            subcategories: ['hotel']
        },
        food: {
            name: '🍽️ Ăn uống',
            icon: '🍽️',
            color: '#e67e22',
            defaultPercentage: 20,
            subcategories: ['food']
        },
        activities: {
            name: '🎡 Hoạt động',
            icon: '🎡',
            color: '#9b59b6',
            defaultPercentage: 15,
            subcategories: ['attraction', 'entertainment']
        },
        shopping: {
            name: '🛍️ Mua sắm',
            icon: '🛍️',
            color: '#e91e63',
            defaultPercentage: 10,
            subcategories: ['shopping']
        }
    };

    // Budget tracking data
    let budgetData = {
        totalBudget: 0,
        categoryBudgets: {},
        dailyBudget: 0,
        reserveFund: 0,
        currencyRates: {}
    };

    // Budget alerts
    let budgetAlerts = {
        enabled: true,
        thresholds: [50, 75, 90, 100],
        lastAlerts: {}
    };

    function init() {
        console.log('TripBudget: Initializing...');
        
        loadBudgetData();
        render();
        setupEventListeners();
        
        console.log('TripBudget: Initialized successfully');
    }

    // Render budget tab
    function render() {
        renderBudgetOverview();
        renderBudgetPlanning();
        renderBudgetTracking();
        renderBudgetAnalysis();
        renderBudgetTools();
    }

    // Update budget display
    function update() {
        loadBudgetData();
        renderBudgetOverview();
        renderBudgetTracking();
        renderBudgetAnalysis();
        checkBudgetAlerts();
    }

    // Load budget data
    function loadBudgetData() {
        const tripData = TripCore.getData();
        const tripInfo = TripCore.getTripInfo();
        
        budgetData.totalBudget = tripInfo.plannedBudget || 0;
        
        // Initialize category budgets if not exists
        if (!budgetData.categoryBudgets || Object.keys(budgetData.categoryBudgets).length === 0) {
            initializeCategoryBudgets();
        }
        
        // Calculate daily budget
        if (tripInfo.totalDays > 0) {
            budgetData.dailyBudget = budgetData.totalBudget / tripInfo.totalDays;
        }
    }

    // Initialize category budgets with default percentages
    function initializeCategoryBudgets() {
        budgetData.categoryBudgets = {};
        
        Object.entries(budgetCategories).forEach(([key, category]) => {
            budgetData.categoryBudgets[key] = {
                allocated: Math.round(budgetData.totalBudget * category.defaultPercentage / 100),
                spent: 0,
                percentage: category.defaultPercentage
            };
        });
        
        saveBudgetData();
    }

    // Render budget overview
    function renderBudgetOverview() {
        const container = TripUtils.getElement('budgetContainer');
        if (!container) return;

        const stats = calculateBudgetStats();
        const tripInfo = TripCore.getTripInfo();
        
        container.innerHTML = `
            <div class="budget-overview">
                <div class="budget-summary-cards">
                    <div class="budget-card total-budget">
                        <div class="budget-card-header">
                            <h3>💰 Tổng Ngân Sách</h3>
                            <button class="btn btn-small" onclick="TripBudget.editTotalBudget()">✏️ Sửa</button>
                        </div>
                        <div class="budget-amount">${TripUtils.formatMoney(budgetData.totalBudget)}</div>
                        <div class="budget-subtitle">Cho ${tripInfo.totalDays} ngày</div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: ${Math.min(stats.usagePercentage, 100)}%; background: ${getBudgetColor(stats.usagePercentage)};"></div>
                        </div>
                        <div class="progress-text">${stats.usagePercentage.toFixed(1)}% đã sử dụng</div>
                    </div>

                    <div class="budget-card remaining-budget">
                        <div class="budget-card-header">
                            <h3>💸 Còn Lại</h3>
                            <span class="budget-trend ${stats.remaining >= 0 ? 'positive' : 'negative'}">
                                ${stats.remaining >= 0 ? '📈' : '📉'}
                            </span>
                        </div>
                        <div class="budget-amount ${stats.remaining < 0 ? 'negative' : ''}">${TripUtils.formatMoney(stats.remaining)}</div>
                        <div class="budget-subtitle">${stats.remaining < 0 ? 'Vượt ngân sách' : 'Trong tầm kiểm soát'}</div>
                    </div>

                    <div class="budget-card daily-budget">
                        <div class="budget-card-header">
                            <h3>📅 Ngân Sách Hàng Ngày</h3>
                        </div>
                        <div class="budget-amount">${TripUtils.formatMoney(budgetData.dailyBudget)}</div>
                        <div class="budget-subtitle">Trung bình mỗi ngày</div>
                        <div class="daily-usage">
                            <small>Hôm nay: ${TripUtils.formatMoney(stats.todaySpent)}</small>
                        </div>
                    </div>

                    <div class="budget-card average-spending">
                        <div class="budget-card-header">
                            <h3>📊 Chi Tiêu Trung Bình</h3>
                        </div>
                        <div class="budget-amount">${TripUtils.formatMoney(stats.averageDaily)}</div>
                        <div class="budget-subtitle">Mỗi ngày đã đi</div>
                        <div class="spending-trend ${stats.trendDirection}">
                            ${stats.trendDirection === 'up' ? '📈 Tăng' : stats.trendDirection === 'down' ? '📉 Giảm' : '➡️ Ổn định'}
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Render budget planning
    function renderBudgetPlanning() {
        const container = TripUtils.getElement('budgetContainer');
        if (!container) return;

        const planningSection = `
            <div class="budget-planning">
                <h3>📋 Phân Bổ Ngân Sách Theo Danh Mục</h3>
                <div class="category-budgets">
                    ${Object.entries(budgetCategories).map(([key, category]) => 
                        renderCategoryBudget(key, category)
                    ).join('')}
                </div>
                
                <div class="budget-tools">
                    <button class="btn" onclick="TripBudget.autoAllocateBudget()">🎯 Phân Bổ Tự Động</button>
                    <button class="btn btn-secondary" onclick="TripBudget.resetBudgetAllocation()">🔄 Đặt Lại</button>
                    <button class="btn btn-secondary" onclick="TripBudget.saveBudgetTemplate()">💾 Lưu Mẫu</button>
                </div>
            </div>
        `;

        container.innerHTML += planningSection;
    }

    // Render category budget
    function renderCategoryBudget(key, category) {
        const budget = budgetData.categoryBudgets[key] || { allocated: 0, spent: 0, percentage: 0 };
        const spentPercentage = budget.allocated > 0 ? (budget.spent / budget.allocated * 100) : 0;
        const remaining = budget.allocated - budget.spent;
        
        return `
            <div class="category-budget-item" data-category="${key}">
                <div class="category-budget-header">
                    <div class="category-info">
                        <span class="category-icon" style="color: ${category.color};">${category.icon}</span>
                        <span class="category-name">${category.name.replace(category.icon + ' ', '')}</span>
                    </div>
                    <div class="category-budget-amount">${TripUtils.formatMoney(budget.allocated)}</div>
                </div>
                
                <div class="category-budget-details">
                    <div class="budget-allocation">
                        <label>Phân bổ (%):</label>
                        <input type="number" 
                               class="form-control budget-percentage" 
                               value="${budget.percentage}" 
                               min="0" 
                               max="100" 
                               onchange="TripBudget.updateCategoryPercentage('${key}', this.value)">
                    </div>
                    
                    <div class="budget-progress">
                        <div class="progress-container">
                            <div class="progress-bar" 
                                 style="width: ${Math.min(spentPercentage, 100)}%; background: ${category.color};"></div>
                        </div>
                        <div class="progress-details">
                            <span>Đã chi: ${TripUtils.formatMoney(budget.spent)}</span>
                            <span class="${remaining >= 0 ? '' : 'negative'}">
                                Còn lại: ${TripUtils.formatMoney(remaining)}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Render budget tracking
    function renderBudgetTracking() {
        const container = TripUtils.getElement('budgetContainer');
        if (!container) return;

        const trackingSection = `
            <div class="budget-tracking">
                <h3>📈 Theo Dõi Chi Tiêu</h3>
                <div class="tracking-charts">
                    ${renderSpendingChart()}
                    ${renderCategoryComparison()}
                    ${renderDailySpendingTrend()}
                </div>
            </div>
        `;

        container.innerHTML += trackingSection;
    }

    // Render spending chart (placeholder)
    function renderSpendingChart() {
        return `
            <div class="chart-container">
                <h4>Chi Tiêu vs Ngân Sách</h4>
                <div class="chart-placeholder">
                    <canvas id="budgetChart" width="400" height="200"></canvas>
                </div>
            </div>
        `;
    }

    // Render category comparison
    function renderCategoryComparison() {
        const categories = Object.entries(budgetData.categoryBudgets).map(([key, budget]) => {
            const category = budgetCategories[key];
            return {
                name: category.name,
                allocated: budget.allocated,
                spent: budget.spent,
                color: category.color
            };
        });

        return `
            <div class="category-comparison">
                <h4>So Sánh Theo Danh Mục</h4>
                <div class="comparison-bars">
                    ${categories.map(cat => `
                        <div class="comparison-item">
                            <div class="comparison-label">${cat.name}</div>
                            <div class="comparison-bar">
                                <div class="allocated-bar" style="width: 100%; background: ${cat.color}30;"></div>
                                <div class="spent-bar" style="width: ${cat.allocated > 0 ? (cat.spent / cat.allocated * 100) : 0}%; background: ${cat.color};"></div>
                            </div>
                            <div class="comparison-values">
                                <span>${TripUtils.formatMoney(cat.spent)}</span>
                                <span>/${TripUtils.formatMoney(cat.allocated)}</span>
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
    }

    // Render daily spending trend
    function renderDailySpendingTrend() {
        return `
            <div class="daily-trend">
                <h4>Xu Hướng Chi Tiêu Hàng Ngày</h4>
                <div class="trend-placeholder">
                    <p>Biểu đồ xu hướng chi tiêu theo ngày sẽ được hiển thị ở đây</p>
                </div>
            </div>
        `;
    }

    // Render budget analysis
    function renderBudgetAnalysis() {
        const container = TripUtils.getElement('budgetContainer');
        if (!container) return;

        const insights = generateBudgetInsights();
        
        const analysisSection = `
            <div class="budget-analysis">
                <h3>🔍 Phân Tích & Khuyến Nghị</h3>
                <div class="budget-insights">
                    ${insights.map(insight => `
                        <div class="insight-card ${insight.type}">
                            <div class="insight-icon">${insight.icon}</div>
                            <div class="insight-content">
                                <h4>${insight.title}</h4>
                                <p>${insight.message}</p>
                                ${insight.action ? `<button class="btn btn-small" onclick="${insight.action}">${insight.actionLabel}</button>` : ''}
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;

        container.innerHTML += analysisSection;
    }

    // Render budget tools
    function renderBudgetTools() {
        const container = TripUtils.getElement('budgetContainer');
        if (!container) return;

        const toolsSection = `
            <div class="budget-tools-section">
                <h3>🛠️ Công Cụ Ngân Sách</h3>
                <div class="tools-grid">
                    <div class="tool-card">
                        <h4>💱 Quy Đổi Tiền Tệ</h4>
                        <div class="currency-converter">
                            <input type="number" id="currencyAmount" placeholder="Số tiền" class="form-control">
                            <select id="fromCurrency" class="form-control">
                                <option value="VND">VNĐ</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                            </select>
                            <span>→</span>
                            <select id="toCurrency" class="form-control">
                                <option value="USD">USD</option>
                                <option value="VND">VNĐ</option>
                                <option value="EUR">EUR</option>
                            </select>
                            <button class="btn btn-small" onclick="TripBudget.convertCurrency()">Quy đổi</button>
                        </div>
                        <div id="conversionResult"></div>
                    </div>

                    <div class="tool-card">
                        <h4>📊 Dự Báo Ngân Sách</h4>
                        <p>Dự báo chi tiêu dựa trên xu hướng hiện tại</p>
                        <button class="btn" onclick="TripBudget.forecastBudget()">Tính Dự Báo</button>
                        <div id="forecastResult"></div>
                    </div>

                    <div class="tool-card">
                        <h4>💾 Xuất Báo Cáo</h4>
                        <p>Xuất báo cáo ngân sách chi tiết</p>
                        <button class="btn" onclick="TripBudget.exportBudgetReport()">Xuất Excel</button>
                    </div>
                </div>
            </div>
        `;

        container.innerHTML += toolsSection;
    }

    // Calculate budget statistics
    function calculateBudgetStats() {
        const tripData = TripCore.getData();
        const totalSpent = TripCore.getStatistics().totalSpent;
        const remaining = budgetData.totalBudget - totalSpent;
        const usagePercentage = budgetData.totalBudget > 0 ? (totalSpent / budgetData.totalBudget * 100) : 0;

        // Calculate today's spending
        const today = TripUtils.getCurrentDate();
        const todaySpent = tripData.expenses
            .filter(exp => exp.date && exp.date.startsWith(today))
            .reduce((sum, exp) => sum + exp.amount, 0);

        // Calculate average daily spending
        const tripInfo = TripCore.getTripInfo();
        let averageDaily = 0;
        let trendDirection = 'stable';

        if (tripInfo.startDate) {
            const startDate = new Date(tripInfo.startDate);
            const today = new Date();
            const daysPassed = Math.max(1, Math.ceil((today - startDate) / (1000 * 60 * 60 * 24)));
            averageDaily = totalSpent / daysPassed;

            // Simple trend calculation
            if (averageDaily > budgetData.dailyBudget * 1.1) {
                trendDirection = 'up';
            } else if (averageDaily < budgetData.dailyBudget * 0.9) {
                trendDirection = 'down';
            }
        }

        // Update category spending
        Object.keys(budgetData.categoryBudgets).forEach(categoryKey => {
            const category = budgetCategories[categoryKey];
            const categorySpent = tripData.expenses
                .filter(exp => category.subcategories.includes(exp.category))
                .reduce((sum, exp) => sum + exp.amount, 0);
            
            budgetData.categoryBudgets[categoryKey].spent = categorySpent;
        });

        return {
            totalSpent,
            remaining,
            usagePercentage,
            todaySpent,
            averageDaily,
            trendDirection
        };
    }

    // Generate budget insights
    function generateBudgetInsights() {
        const insights = [];
        const stats = calculateBudgetStats();
        const tripInfo = TripCore.getTripInfo();

        // Budget usage insights
        if (stats.usagePercentage > 100) {
            insights.push({
                type: 'danger',
                icon: '🚨',
                title: 'Vượt ngân sách',
                message: `Bạn đã vượt ngân sách ${(stats.usagePercentage - 100).toFixed(1)}%. Cần kiểm soát chi tiêu.`,
                action: 'TripBudget.showBudgetReduction()',
                actionLabel: 'Xem gợi ý'
            });
        } else if (stats.usagePercentage > 90) {
            insights.push({
                type: 'warning',
                icon: '⚠️',
                title: 'Gần hết ngân sách',
                message: 'Chỉ còn lại dưới 10% ngân sách. Hãy cân nhắc chi tiêu.',
                action: 'TripBudget.showSavingTips()',
                actionLabel: 'Mẹo tiết kiệm'
            });
        }

        // Spending trend insights
        if (stats.trendDirection === 'up') {
            insights.push({
                type: 'warning',
                icon: '📈',
                title: 'Chi tiêu tăng cao',
                message: `Chi tiêu trung bình ${TripUtils.formatMoney(stats.averageDaily)}/ngày cao hơn dự kiến.`,
                action: 'TripBudget.analyzeTrend()',
                actionLabel: 'Phân tích'
            });
        } else if (stats.trendDirection === 'down') {
            insights.push({
                type: 'success',
                icon: '📉',
                title: 'Chi tiêu tiết kiệm',
                message: 'Bạn đang chi tiêu dưới mức dự kiến. Tuyệt vời!',
            });
        }

        // Category insights
        Object.entries(budgetData.categoryBudgets).forEach(([key, budget]) => {
            const category = budgetCategories[key];
            const usagePercent = budget.allocated > 0 ? (budget.spent / budget.allocated * 100) : 0;
            
            if (usagePercent > 120) {
                insights.push({
                    type: 'warning',
                    icon: category.icon,
                    title: `${category.name} vượt ngân sách`,
                    message: `Đã chi ${usagePercent.toFixed(1)}% ngân sách dành cho ${category.name.toLowerCase()}.`
                });
            }
        });

        // Time-based insights
        if (tripInfo.totalDays > 0) {
            const today = new Date();
            const startDate = new Date(tripInfo.startDate);
            const endDate = new Date(tripInfo.endDate);
            
            if (today >= startDate && today <= endDate) {
                const daysPassed = Math.ceil((today - startDate) / (1000 * 60 * 60 * 24));
                const progressPercent = (daysPassed / tripInfo.totalDays) * 100;
                
                if (stats.usagePercentage > progressPercent + 20) {
                    insights.push({
                        type: 'info',
                        icon: '⏰',
                        title: 'Chi tiêu nhanh hơn dự kiến',
                        message: `Đã chi ${stats.usagePercentage.toFixed(1)}% ngân sách trong ${progressPercent.toFixed(1)}% thời gian chuyến đi.`
                    });
                }
            }
        }

        return insights;
    }

    // Edit total budget
    function editTotalBudget() {
        const currentBudget = budgetData.totalBudget;
        const newBudget = prompt('Nhập ngân sách tổng (VNĐ):', currentBudget);
        
        if (newBudget !== null && !isNaN(newBudget) && parseFloat(newBudget) >= 0) {
            const budgetAmount = parseFloat(newBudget);
            
            // Update trip data
            const tripData = TripCore.getData();
            tripData.plannedBudget = budgetAmount;
            TripCore.saveData();
            
            // Update local budget data
            budgetData.totalBudget = budgetAmount;
            
            // Recalculate category allocations
            updateCategoryAllocations();
            
            update();
            TripNotifications.showSuccess('Đã cập nhật ngân sách!');
        }
    }

    // Update category percentage
    function updateCategoryPercentage(categoryKey, percentage) {
        const percent = parseFloat(percentage) || 0;
        
        if (percent < 0 || percent > 100) {
            TripNotifications.showWarning('Phần trăm phải từ 0 đến 100!');
            return;
        }
        
        budgetData.categoryBudgets[categoryKey].percentage = percent;
        budgetData.categoryBudgets[categoryKey].allocated = Math.round(budgetData.totalBudget * percent / 100);
        
        saveBudgetData();
        update();
    }

    // Auto allocate budget
    function autoAllocateBudget() {
        Object.entries(budgetCategories).forEach(([key, category]) => {
            budgetData.categoryBudgets[key] = {
                allocated: Math.round(budgetData.totalBudget * category.defaultPercentage / 100),
                spent: budgetData.categoryBudgets[key]?.spent || 0,
                percentage: category.defaultPercentage
            };
        });
        
        saveBudgetData();
        update();
        TripNotifications.showSuccess('Đã phân bổ ngân sách tự động!');
    }

    // Reset budget allocation
    function resetBudgetAllocation() {
        if (confirm('Bạn có chắc chắn muốn đặt lại phân bổ ngân sách?')) {
            initializeCategoryBudgets();
            update();
            TripNotifications.showSuccess('Đã đặt lại phân bổ ngân sách!');
        }
    }

    // Save budget template
    function saveBudgetTemplate() {
        const template = {
            name: `Mẫu ngân sách ${TripUtils.getCurrentDate()}`,
            categories: Object.entries(budgetData.categoryBudgets).map(([key, budget]) => ({
                key,
                percentage: budget.percentage
            })),
            createdAt: TripUtils.getCurrentDateTime()
        };
        
        const templates = JSON.parse(localStorage.getItem('budgetTemplates') || '[]');
        templates.push(template);
        localStorage.setItem('budgetTemplates', JSON.stringify(templates));
        
        TripNotifications.showSuccess('Đã lưu mẫu ngân sách!');
    }

    // Convert currency
    function convertCurrency() {
        const amount = parseFloat(TripUtils.getElement('currencyAmount')?.value);
        const fromCurrency = TripUtils.getElement('fromCurrency')?.value;
        const toCurrency = TripUtils.getElement('toCurrency')?.value;
        
        if (!amount || amount <= 0) {
            TripNotifications.showWarning('Vui lòng nhập số tiền hợp lệ!');
            return;
        }
        
        // Simple conversion rates (should be fetched from API in real implementation)
        const rates = {
            'VND': { 'USD': 0.000041, 'EUR': 0.000038 },
            'USD': { 'VND': 24400, 'EUR': 0.92 },
            'EUR': { 'VND': 26500, 'USD': 1.09 }
        };
        
        let convertedAmount = amount;
        if (fromCurrency !== toCurrency && rates[fromCurrency] && rates[fromCurrency][toCurrency]) {
            convertedAmount = amount * rates[fromCurrency][toCurrency];
        }
        
        const resultElement = TripUtils.getElement('conversionResult');
        if (resultElement) {
            resultElement.innerHTML = `
                <div class="conversion-result">
                    <strong>${amount.toLocaleString()} ${fromCurrency} = ${convertedAmount.toLocaleString()} ${toCurrency}</strong>
                </div>
            `;
        }
    }

    // Forecast budget
    function forecastBudget() {
        const stats = calculateBudgetStats();
        const tripInfo = TripCore.getTripInfo();
        
        if (!tripInfo.startDate || !tripInfo.endDate) {
            TripNotifications.showWarning('Cần thiết lập ngày bắt đầu và kết thúc chuyến đi!');
            return;
        }
        
        const today = new Date();
        const endDate = new Date(tripInfo.endDate);
        const daysRemaining = Math.max(0, Math.ceil((endDate - today) / (1000 * 60 * 60 * 24)));
        
        const projectedSpending = stats.totalSpent + (stats.averageDaily * daysRemaining);
        const overBudget = projectedSpending - budgetData.totalBudget;
        
        const resultElement = TripUtils.getElement('forecastResult');
        if (resultElement) {
            resultElement.innerHTML = `
                <div class="forecast-result">
                    <h5>Dự Báo Chi Tiêu</h5>
                    <p><strong>Chi tiêu dự kiến:</strong> ${TripUtils.formatMoney(projectedSpending)}</p>
                    <p><strong>So với ngân sách:</strong> 
                        <span class="${overBudget > 0 ? 'negative' : 'positive'}">
                            ${overBudget > 0 ? '+' : ''}${TripUtils.formatMoney(overBudget)}
                        </span>
                    </p>
                    <p><strong>Khuyến nghị:</strong> ${getForecastRecommendation(overBudget, stats.averageDaily)}</p>
                </div>
            `;
        }
    }

    // Get forecast recommendation
    function getForecastRecommendation(overBudget, averageDaily) {
        if (overBudget > 0) {
            const reductionNeeded = overBudget / Math.max(1, Math.ceil((new Date(TripCore.getTripInfo().endDate) - new Date()) / (1000 * 60 * 60 * 24)));
            return `Cần giảm chi tiêu ${TripUtils.formatMoney(reductionNeeded)}/ngày để không vượt ngân sách.`;
        } else if (overBudget < -budgetData.totalBudget * 0.1) {
            return 'Bạn đang chi tiêu tiết kiệm. Có thể tăng chi cho trải nghiệm tốt hơn.';
        } else {
            return 'Chi tiêu đang trong tầm kiểm soát.';
        }
    }

    // Export budget report
    function exportBudgetReport() {
        const stats = calculateBudgetStats();
        const reportData = {
            summary: {
                totalBudget: budgetData.totalBudget,
                totalSpent: stats.totalSpent,
                remaining: stats.remaining,
                usagePercentage: stats.usagePercentage
            },
            categories: Object.entries(budgetData.categoryBudgets).map(([key, budget]) => ({
                name: budgetCategories[key].name,
                allocated: budget.allocated,
                spent: budget.spent,
                remaining: budget.allocated - budget.spent,
                percentage: budget.percentage
            })),
            insights: generateBudgetInsights(),
            exportDate: TripUtils.getCurrentDateTime()
        };
        
        const csvContent = convertBudgetToCSV(reportData);
        const filename = `bao_cao_ngan_sach_${TripUtils.getCurrentDate()}.csv`;
        
        TripUtils.downloadFile(csvContent, filename, 'text/csv');
        TripNotifications.showSuccess('Đã xuất báo cáo ngân sách!');
    }

    // Convert budget data to CSV
    function convertBudgetToCSV(data) {
        let csv = 'Báo Cáo Ngân Sách\n\n';
        
        // Summary
        csv += 'Tổng Quan\n';
        csv += 'Mục,Giá Trị\n';
        csv += `Tổng ngân sách,${data.summary.totalBudget}\n`;
        csv += `Đã chi tiêu,${data.summary.totalSpent}\n`;
        csv += `Còn lại,${data.summary.remaining}\n`;
        csv += `Tỷ lệ sử dụng,${data.summary.usagePercentage.toFixed(1)}%\n\n`;
        
        // Categories
        csv += 'Chi Tiết Theo Danh Mục\n';
        csv += 'Danh Mục,Phân Bổ,Đã Chi,Còn Lại,Tỷ Lệ (%)\n';
        data.categories.forEach(cat => {
            csv += `${cat.name},${cat.allocated},${cat.spent},${cat.remaining},${cat.percentage}\n`;
        });
        
        csv += `\nXuất ngày: ${data.exportDate}\n`;
        
        return '\ufeff' + csv; // Add BOM for Vietnamese characters
    }

    // Get budget color based on usage
    function getBudgetColor(percentage) {
        if (percentage >= 100) return '#e74c3c';
        if (percentage >= 90) return '#e67e22';
        if (percentage >= 75) return '#f39c12';
        return '#27ae60';
    }

    // Update category allocations
    function updateCategoryAllocations() {
        Object.keys(budgetData.categoryBudgets).forEach(key => {
            const budget = budgetData.categoryBudgets[key];
            budget.allocated = Math.round(budgetData.totalBudget * budget.percentage / 100);
        });
        
        // Calculate daily budget
        const tripInfo = TripCore.getTripInfo();
        if (tripInfo.totalDays > 0) {
            budgetData.dailyBudget = budgetData.totalBudget / tripInfo.totalDays;
        }
        
        saveBudgetData();
    }

    // Check budget alerts
    function checkBudgetAlerts() {
        if (!budgetAlerts.enabled) return;
        
        const stats = calculateBudgetStats();
        
        budgetAlerts.thresholds.forEach(threshold => {
            if (stats.usagePercentage >= threshold && 
                (!budgetAlerts.lastAlerts[threshold] || 
                 Date.now() - budgetAlerts.lastAlerts[threshold] > 3600000)) { // 1 hour cooldown
                
                const message = getBudgetAlertMessage(threshold, stats);
                TripNotifications.show(message, TripNotifications.TYPES.BUDGET, 5000, {
                    persistent: threshold >= 100,
                    priority: threshold >= 90 ? 'high' : 'normal'
                });
                
                budgetAlerts.lastAlerts[threshold] = Date.now();
            }
        });
    }

    // Get budget alert message
    function getBudgetAlertMessage(threshold, stats) {
        if (threshold >= 100) {
            return `🚨 Đã vượt ngân sách! Chi tiêu: ${TripUtils.formatMoney(stats.totalSpent)}`;
        } else {
            return `⚠️ Đã sử dụng ${threshold}% ngân sách. Còn lại: ${TripUtils.formatMoney(stats.remaining)}`;
        }
    }

    // Save budget data
    function saveBudgetData() {
        try {
            localStorage.setItem('tripBudgetData', JSON.stringify(budgetData));
            localStorage.setItem('tripBudgetAlerts', JSON.stringify(budgetAlerts));
        } catch (error) {
            console.error('Error saving budget data:', error);
        }
    }

    // Load saved budget data
    function loadSavedBudgetData() {
        try {
            const saved = localStorage.getItem('tripBudgetData');
            if (saved) {
                const parsed = JSON.parse(saved);
                budgetData = { ...budgetData, ...parsed };
            }
            
            const savedAlerts = localStorage.getItem('tripBudgetAlerts');
            if (savedAlerts) {
                const parsedAlerts = JSON.parse(savedAlerts);
                budgetAlerts = { ...budgetAlerts, ...parsedAlerts };
            }
        } catch (error) {
            console.error('Error loading budget data:', error);
        }
    }

    // Setup event listeners
    function setupEventListeners() {
        // Listen to data changes
        TripCore.on('dataChanged', () => {
            if (TripTabs.getCurrentTab() === 'budget') {
                update();
            }
        });

        TripCore.on('expenseAdded', () => {
            update();
            checkBudgetAlerts();
        });

        // Load saved data on init
        loadSavedBudgetData();
    }

    // Public API
    return {
        // Initialization
        init,
        render,
        update,

        // Budget management
        editTotalBudget,
        updateCategoryPercentage,
        autoAllocateBudget,
        resetBudgetAllocation,
        saveBudgetTemplate,

        // Tools
        convertCurrency,
        forecastBudget,
        exportBudgetReport,

        // Data
        budgetData,
        budgetCategories,
        calculateBudgetStats,
        checkBudgetAlerts
    };
})();