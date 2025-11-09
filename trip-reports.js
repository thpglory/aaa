/**
 * Trip Manager - Reports Management
 * Version: 1.0.0
 * Handles trip reporting, analysis, and data visualization
 */

window.TripReports = (function() {
    'use strict';

    // Report types
    const REPORT_TYPES = {
        SUMMARY: 'summary',
        EXPENSES: 'expenses',
        TIMELINE: 'timeline',
        DESTINATIONS: 'destinations',
        BUDGET: 'budget',
        ACTIVITIES: 'activities',
        PHOTOS: 'photos'
    };

    // Chart types
    const CHART_TYPES = {
        PIE: 'pie',
        BAR: 'bar',
        LINE: 'line',
        AREA: 'area'
    };

    // Export formats
    const EXPORT_FORMATS = {
        PDF: 'pdf',
        CSV: 'csv',
        EXCEL: 'excel',
        JSON: 'json'
    };

    // Current report settings
    let currentReport = {
        type: REPORT_TYPES.SUMMARY,
        dateRange: 'all',
        format: 'detailed',
        includeCharts: true,
        includePhotos: false
    };

    function init() {
        console.log('TripReports: Initializing...');
        
        render();
        setupEventListeners();
        
        console.log('TripReports: Initialized successfully');
    }

    // Render reports tab
    function render() {
        renderReportsOverview();
        renderReportGenerator();
        renderReportPreview();
        renderReportTools();
    }

    // Update reports display
    function update() {
        renderReportsOverview();
        renderReportPreview();
    }

    // Render reports overview
    function renderReportsOverview() {
        const container = TripUtils.getElement('reportsContainer');
        if (!container) return;

        const tripInfo = TripCore.getTripInfo();
        const stats = generateReportStatistics();
        const tripStatus = getTripStatus(tripInfo);

        container.innerHTML = `
            <div class="reports-overview">
                <div class="reports-header">
                    <h3>📈 Báo Cáo Tổng Kết</h3>
                    <div class="trip-status ${tripStatus.class}">
                        ${tripStatus.icon} ${tripStatus.text}
                    </div>
                </div>

                <div class="trip-summary-cards">
                    <div class="summary-card">
                        <div class="card-icon">🌍</div>
                        <div class="card-content">
                            <h4>${tripInfo.name}</h4>
                            <p>${tripInfo.totalDays} ngày • ${stats.destinations} điểm đến</p>
                        </div>
                    </div>

                    <div class="summary-card">
                        <div class="card-icon">💰</div>
                        <div class="card-content">
                            <h4>Tổng Chi Phí</h4>
                            <p>${TripUtils.formatMoney(stats.totalSpent)} / ${TripUtils.formatMoney(tripInfo.plannedBudget)}</p>
                            <div class="progress-mini">
                                <div class="progress-bar" style="width: ${Math.min(stats.budgetUsed, 100)}%; background: ${getBudgetColor(stats.budgetUsed)};"></div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-card">
                        <div class="card-icon">📊</div>
                        <div class="card-content">
                            <h4>Hoạt Động</h4>
                            <p>${stats.activities} hoạt động • ${stats.completedActivities} hoàn thành</p>
                        </div>
                    </div>

                    <div class="summary-card">
                        <div class="card-icon">📝</div>
                        <div class="card-content">
                            <h4>Giao Dịch</h4>
                            <p>${stats.transactions} giao dịch • ${TripUtils.formatMoney(stats.averageTransaction)} TB</p>
                        </div>
                    </div>
                </div>

                <div class="quick-reports">
                    <h4>📋 Báo Cáo Nhanh</h4>
                    <div class="quick-report-buttons">
                        <button class="btn quick-report-btn" onclick="TripReports.generateQuickReport('summary')">
                            📄 Tổng quan
                        </button>
                        <button class="btn quick-report-btn" onclick="TripReports.generateQuickReport('expenses')">
                            💳 Chi tiêu
                        </button>
                        <button class="btn quick-report-btn" onclick="TripReports.generateQuickReport('timeline')">
                            ⏱️ Timeline
                        </button>
                        <button class="btn quick-report-btn" onclick="TripReports.generateQuickReport('destinations')">
                            📍 Điểm đến
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    // Render report generator
    function renderReportGenerator() {
        const container = TripUtils.getElement('reportsContainer');
        if (!container) return;

        const generatorSection = `
            <div class="report-generator">
                <h3>🛠️ Tạo Báo Cáo Tùy Chỉnh</h3>
                
                <div class="generator-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Loại báo cáo</label>
                            <select class="form-control" onchange="TripReports.updateReportSetting('type', this.value)">
                                <option value="summary" ${currentReport.type === 'summary' ? 'selected' : ''}>📄 Tổng quan chuyến đi</option>
                                <option value="expenses" ${currentReport.type === 'expenses' ? 'selected' : ''}>💳 Phân tích chi tiêu</option>
                                <option value="timeline" ${currentReport.type === 'timeline' ? 'selected' : ''}>⏱️ Timeline chi tiết</option>
                                <option value="destinations" ${currentReport.type === 'destinations' ? 'selected' : ''}>📍 Báo cáo điểm đến</option>
                                <option value="budget" ${currentReport.type === 'budget' ? 'selected' : ''}>💰 Phân tích ngân sách</option>
                                <option value="activities" ${currentReport.type === 'activities' ? 'selected' : ''}>🎡 Hoạt động</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Khoảng thời gian</label>
                            <select class="form-control" onchange="TripReports.updateReportSetting('dateRange', this.value)">
                                <option value="all" ${currentReport.dateRange === 'all' ? 'selected' : ''}>Toàn bộ chuyến đi</option>
                                <option value="week1" ${currentReport.dateRange === 'week1' ? 'selected' : ''}>Tuần đầu</option>
                                <option value="week2" ${currentReport.dateRange === 'week2' ? 'selected' : ''}>Tuần thứ 2</option>
                                <option value="custom" ${currentReport.dateRange === 'custom' ? 'selected' : ''}>Tùy chỉnh</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Định dạng</label>
                            <select class="form-control" onchange="TripReports.updateReportSetting('format', this.value)">
                                <option value="detailed" ${currentReport.format === 'detailed' ? 'selected' : ''}>Chi tiết</option>
                                <option value="summary" ${currentReport.format === 'summary' ? 'selected' : ''}>Tóm tắt</option>
                                <option value="infographic" ${currentReport.format === 'infographic' ? 'selected' : ''}>Infographic</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" 
                                       ${currentReport.includeCharts ? 'checked' : ''}
                                       onchange="TripReports.updateReportSetting('includeCharts', this.checked)">
                                Bao gồm biểu đồ
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" 
                                       ${currentReport.includePhotos ? 'checked' : ''}
                                       onchange="TripReports.updateReportSetting('includePhotos', this.checked)">
                                Bao gồm hình ảnh
                            </label>
                        </div>
                    </div>

                    <div class="generator-actions">
                        <button class="btn" onclick="TripReports.generateCustomReport()">
                            📊 Tạo báo cáo
                        </button>
                        <button class="btn btn-secondary" onclick="TripReports.previewReport()">
                            👁️ Xem trước
                        </button>
                        <button class="btn btn-secondary" onclick="TripReports.saveReportTemplate()">
                            💾 Lưu mẫu
                        </button>
                    </div>
                </div>
            </div>
        `;

        container.innerHTML += generatorSection;
    }

    // Render report preview
    function renderReportPreview() {
        const container = TripUtils.getElement('reportsContainer');
        if (!container) return;

        const reportContent = generateReportContent(currentReport.type);

        const previewSection = `
            <div class="report-preview">
                <div class="preview-header">
                    <h3>👁️ Xem Trước Báo Cáo</h3>
                    <div class="preview-actions">
                        <button class="btn btn-small" onclick="TripReports.exportReport('pdf')">
                            📄 Xuất PDF
                        </button>
                        <button class="btn btn-small" onclick="TripReports.exportReport('excel')">
                            📊 Xuất Excel
                        </button>
                        <button class="btn btn-small" onclick="TripReports.printReport()">
                            🖨️ In
                        </button>
                        <button class="btn btn-small" onclick="TripReports.shareReport()">
                            📤 Chia sẻ
                        </button>
                    </div>
                </div>

                <div class="report-content">
                    ${reportContent}
                </div>
            </div>
        `;

        container.innerHTML += previewSection;
    }

    // Render report tools
    function renderReportTools() {
        const container = TripUtils.getElement('reportsContainer');
        if (!container) return;

        const toolsSection = `
            <div class="report-tools">
                <h3>🛠️ Công Cụ Báo Cáo</h3>
                
                <div class="tools-grid">
                    <div class="tool-card">
                        <h4>📊 Biểu Đồ Tương Tác</h4>
                        <p>Tạo biểu đồ tương tác để phân tích dữ liệu</p>
                        <button class="btn" onclick="TripReports.createInteractiveChart()">Tạo biểu đồ</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>📈 So Sánh Chuyến Đi</h4>
                        <p>So sánh với các chuyến đi trước đó</p>
                        <button class="btn" onclick="TripReports.compareTrips()">So sánh</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>🎯 Phân Tích Xu Hướng</h4>
                        <p>Phân tích xu hướng chi tiêu và hoạt động</p>
                        <button class="btn" onclick="TripReports.analyzeTrends()">Phân tích</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>📱 Báo Cáo Di Động</h4>
                        <p>Tạo báo cáo tối ưu cho di động</p>
                        <button class="btn" onclick="TripReports.createMobileReport()">Tạo</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>🌐 Báo Cáo Web</h4>
                        <p>Tạo báo cáo web có thể chia sẻ</p>
                        <button class="btn" onclick="TripReports.createWebReport()">Tạo</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>📧 Gửi Báo Cáo</h4>
                        <p>Gửi báo cáo qua email tự động</p>
                        <button class="btn" onclick="TripReports.scheduleReport()">Lập lịch</button>
                    </div>
                </div>
            </div>
        `;

        container.innerHTML += toolsSection;
    }

    // Generate report content based on type
    function generateReportContent(reportType) {
        switch (reportType) {
            case REPORT_TYPES.SUMMARY:
                return generateSummaryReport();
            case REPORT_TYPES.EXPENSES:
                return generateExpensesReport();
            case REPORT_TYPES.TIMELINE:
                return generateTimelineReport();
            case REPORT_TYPES.DESTINATIONS:
                return generateDestinationsReport();
            case REPORT_TYPES.BUDGET:
                return generateBudgetReport();
            case REPORT_TYPES.ACTIVITIES:
                return generateActivitiesReport();
            default:
                return generateSummaryReport();
        }
    }

    // Generate summary report
    function generateSummaryReport() {
        const tripInfo = TripCore.getTripInfo();
        const stats = TripCore.getStatistics();
        const destinations = TripCore.getData().destinations || [];
        const expenses = TripCore.getData().expenses || [];

        return `
            <div class="report-section">
                <h2>📋 Tổng Quan Chuyến Đi</h2>
                
                <div class="trip-overview">
                    <div class="overview-item">
                        <strong>Tên chuyến đi:</strong> ${tripInfo.name}
                    </div>
                    <div class="overview-item">
                        <strong>Thời gian:</strong> ${TripUtils.formatDate(tripInfo.startDate)} - ${TripUtils.formatDate(tripInfo.endDate)}
                    </div>
                    <div class="overview-item">
                        <strong>Tổng số ngày:</strong> ${tripInfo.totalDays} ngày
                    </div>
                    <div class="overview-item">
                        <strong>Số điểm đến:</strong> ${destinations.length} điểm
                    </div>
                </div>

                <div class="financial-summary">
                    <h3>💰 Tóm Tắt Tài Chính</h3>
                    <div class="financial-grid">
                        <div class="financial-item">
                            <span class="label">Ngân sách dự trù:</span>
                            <span class="value">${TripUtils.formatMoney(tripInfo.plannedBudget)}</span>
                        </div>
                        <div class="financial-item">
                            <span class="label">Tổng chi tiêu:</span>
                            <span class="value">${TripUtils.formatMoney(stats.totalSpent)}</span>
                        </div>
                        <div class="financial-item">
                            <span class="label">Còn lại:</span>
                            <span class="value ${stats.budgetRemaining < 0 ? 'negative' : 'positive'}">
                                ${TripUtils.formatMoney(stats.budgetRemaining)}
                            </span>
                        </div>
                        <div class="financial-item">
                            <span class="label">Chi tiêu TB/ngày:</span>
                            <span class="value">${TripUtils.formatMoney(stats.averageDailySpending)}</span>
                        </div>
                    </div>
                </div>

                ${currentReport.includeCharts ? generateExpenseChart() : ''}

                <div class="destinations-summary">
                    <h3>📍 Điểm Đến</h3>
                    <div class="destinations-list">
                        ${destinations.map((dest, index) => `
                            <div class="destination-item">
                                <span class="destination-number">${index + 1}</span>
                                <div class="destination-info">
                                    <strong>${dest.name}</strong>
                                    <div class="destination-details">
                                        ${TripUtils.formatDate(dest.date)} • ${dest.days} ngày
                                        ${dest.checkedIn ? ' • ✅ Đã check-in' : ''}
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>

                <div class="highlights">
                    <h3>⭐ Điểm Nổi Bật</h3>
                    ${generateTripHighlights()}
                </div>
            </div>
        `;
    }

    // Generate expenses report
    function generateExpensesReport() {
        const expenses = TripCore.getData().expenses || [];
        const categories = TripCore.getExpenseCategories();
        const categoryTotals = TripCore.getSpentByCategory();

        return `
            <div class="report-section">
                <h2>💳 Báo Cáo Chi Tiêu</h2>
                
                <div class="expense-overview">
                    <div class="expense-stats">
                        <div class="stat">
                            <span class="stat-label">Tổng giao dịch:</span>
                            <span class="stat-value">${expenses.length}</span>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Tổng chi tiêu:</span>
                            <span class="stat-value">${TripUtils.formatMoney(TripCore.getStatistics().totalSpent)}</span>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Giao dịch lớn nhất:</span>
                            <span class="stat-value">${TripUtils.formatMoney(Math.max(...expenses.map(e => e.amount)))}</span>
                        </div>
                    </div>
                </div>

                <div class="category-breakdown">
                    <h3>📊 Chi Tiêu Theo Danh Mục</h3>
                    <div class="category-list">
                        ${Object.entries(categoryTotals).map(([categoryKey, amount]) => {
                            const category = categories[categoryKey];
                            const percentage = (amount / TripCore.getStatistics().totalSpent * 100);
                            return `
                                <div class="category-row">
                                    <div class="category-info">
                                        <span class="category-icon">${category?.icon || '📝'}</span>
                                        <span class="category-name">${category?.name || categoryKey}</span>
                                    </div>
                                    <div class="category-amount">
                                        <span class="amount">${TripUtils.formatMoney(amount)}</span>
                                        <span class="percentage">(${percentage.toFixed(1)}%)</span>
                                    </div>
                                    <div class="category-bar">
                                        <div class="bar-fill" style="width: ${percentage}%; background: ${category?.color || '#ccc'};"></div>
                                    </div>
                                </div>
                            `;
                        }).join('')}
                    </div>
                </div>

                ${currentReport.includeCharts ? generateExpenseChart() : ''}

                <div class="expense-timeline">
                    <h3>📅 Chi Tiêu Theo Thời Gian</h3>
                    ${generateExpenseTimeline(expenses)}
                </div>

                <div class="expense-details">
                    <h3>📋 Chi Tiết Giao Dịch</h3>
                    <div class="expense-table">
                        <div class="table-header">
                            <span>Ngày</span>
                            <span>Danh mục</span>
                            <span>Mô tả</span>
                            <span>Số tiền</span>
                        </div>
                        ${expenses.slice(0, 20).map(expense => `
                            <div class="table-row">
                                <span>${TripUtils.formatDate(expense.date)}</span>
                                <span>${categories[expense.category]?.name || expense.category}</span>
                                <span>${expense.note || expense.location || 'Không có mô tả'}</span>
                                <span>${TripUtils.formatMoney(expense.amount)}</span>
                            </div>
                        `).join('')}
                        ${expenses.length > 20 ? `<div class="table-more">Và ${expenses.length - 20} giao dịch khác...</div>` : ''}
                    </div>
                </div>
            </div>
        `;
    }

    // Generate timeline report
    function generateTimelineReport() {
        const destinations = TripCore.getData().destinations || [];
        const schedule = TripCore.getData().schedule || [];

        return `
            <div class="report-section">
                <h2>⏱️ Báo Cáo Timeline</h2>
                
                <div class="timeline-overview">
                    <div class="timeline-stats">
                        <div class="stat">
                            <span class="stat-label">Điểm đến:</span>
                            <span class="stat-value">${destinations.length}</span>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Đã check-in:</span>
                            <span class="stat-value">${destinations.filter(d => d.checkedIn).length}</span>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Hoàn thành:</span>
                            <span class="stat-value">${destinations.filter(d => d.checkedOut).length}</span>
                        </div>
                    </div>
                </div>

                <div class="timeline-progress">
                    <h3>📊 Tiến Độ Chuyến Đi</h3>
                    ${generateTimelineProgress()}
                </div>

                <div class="timeline-details">
                    <h3>📅 Chi Tiết Timeline</h3>
                    <div class="timeline-list">
                        ${destinations.map((dest, index) => `
                            <div class="timeline-item ${dest.checkedOut ? 'completed' : dest.checkedIn ? 'current' : 'upcoming'}">
                                <div class="timeline-marker">${dest.checkedIn ? '✓' : index + 1}</div>
                                <div class="timeline-content">
                                    <h4>${dest.name}</h4>
                                    <div class="timeline-meta">
                                        <span>📅 ${TripUtils.formatDate(dest.date)}</span>
                                        <span>⏰ ${dest.days} ngày</span>
                                        ${dest.checkedIn ? `<span>✅ Check-in: ${TripUtils.formatDateTime(dest.checkedIn)}</span>` : ''}
                                        ${dest.checkedOut ? `<span>🚪 Check-out: ${TripUtils.formatDateTime(dest.checkedOut)}</span>` : ''}
                                    </div>
                                    ${dest.notes ? `<p>${dest.notes}</p>` : ''}
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>
        `;
    }

    // Generate destinations report
    function generateDestinationsReport() {
        const destinations = TripCore.getData().destinations || [];
        const expenses = TripCore.getData().expenses || [];

        return `
            <div class="report-section">
                <h2>📍 Báo Cáo Điểm Đến</h2>
                
                <div class="destinations-overview">
                    <div class="overview-stats">
                        <div class="stat">
                            <span class="stat-label">Tổng điểm đến:</span>
                            <span class="stat-value">${destinations.length}</span>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Đã ghé thăm:</span>
                            <span class="stat-value">${destinations.filter(d => d.checkedIn).length}</span>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Tổng số ngày:</span>
                            <span class="stat-value">${destinations.reduce((sum, d) => sum + d.days, 0)}</span>
                        </div>
                    </div>
                </div>

                <div class="destinations-details">
                    ${destinations.map(dest => `
                        <div class="destination-detail">
                            <h3>${dest.name}</h3>
                            <div class="destination-info">
                                <div class="info-grid">
                                    <div class="info-item">
                                        <span class="info-label">Ngày đến:</span>
                                        <span class="info-value">${TripUtils.formatDate(dest.date)}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Thời gian:</span>
                                        <span class="info-value">${dest.days} ngày</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Trạng thái:</span>
                                        <span class="info-value ${dest.checkedOut ? 'completed' : dest.checkedIn ? 'current' : 'upcoming'}">
                                            ${dest.checkedOut ? 'Hoàn thành' : dest.checkedIn ? 'Đang ở' : 'Sắp tới'}
                                        </span>
                                    </div>
                                    ${dest.budget ? `
                                        <div class="info-item">
                                            <span class="info-label">Ngân sách:</span>
                                            <span class="info-value">${TripUtils.formatMoney(dest.budget)}</span>
                                        </div>
                                    ` : ''}
                                </div>
                                
                                ${dest.notes ? `
                                    <div class="destination-notes">
                                        <strong>Ghi chú:</strong> ${dest.notes}
                                    </div>
                                ` : ''}

                                ${getDestinationExpenses(dest, expenses).length > 0 ? `
                                    <div class="destination-expenses">
                                        <strong>Chi tiêu tại đây:</strong>
                                        <ul>
                                            ${getDestinationExpenses(dest, expenses).map(expense => `
                                                <li>${TripUtils.formatMoney(expense.amount)} - ${expense.note || 'Không có mô tả'}</li>
                                            `).join('')}
                                        </ul>
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
    }

    // Generate budget report
    function generateBudgetReport() {
        const tripInfo = TripCore.getTripInfo();
        const stats = TripCore.getStatistics();

        return `
            <div class="report-section">
                <h2>💰 Báo Cáo Ngân Sách</h2>
                
                <div class="budget-overview">
                    <div class="budget-summary">
                        <div class="budget-item total">
                            <span class="budget-label">Ngân sách dự trù:</span>
                            <span class="budget-value">${TripUtils.formatMoney(tripInfo.plannedBudget)}</span>
                        </div>
                        <div class="budget-item spent">
                            <span class="budget-label">Đã chi tiêu:</span>
                            <span class="budget-value">${TripUtils.formatMoney(stats.totalSpent)}</span>
                        </div>
                        <div class="budget-item remaining ${stats.budgetRemaining < 0 ? 'negative' : 'positive'}">
                            <span class="budget-label">Còn lại:</span>
                            <span class="budget-value">${TripUtils.formatMoney(stats.budgetRemaining)}</span>
                        </div>
                        <div class="budget-item percentage">
                            <span class="budget-label">Tỷ lệ sử dụng:</span>
                            <span class="budget-value">${stats.budgetUsed.toFixed(1)}%</span>
                        </div>
                    </div>

                    <div class="budget-progress-bar">
                        <div class="progress-fill" style="width: ${Math.min(stats.budgetUsed, 100)}%; background: ${getBudgetColor(stats.budgetUsed)};"></div>
                    </div>
                </div>

                ${currentReport.includeCharts ? generateBudgetChart() : ''}

                <div class="budget-analysis">
                    <h3>📊 Phân Tích Ngân Sách</h3>
                    ${generateBudgetAnalysis(stats, tripInfo)}
                </div>

                <div class="budget-recommendations">
                    <h3>💡 Khuyến Nghị</h3>
                    ${generateBudgetRecommendations(stats, tripInfo)}
                </div>
            </div>
        `;
    }

    // Generate activities report
    function generateActivitiesReport() {
        const schedule = TripCore.getData().schedule || [];
        const activityStats = calculateActivityStats(schedule);

        return `
            <div class="report-section">
                <h2>🎡 Báo Cáo Hoạt Động</h2>
                
                <div class="activities-overview">
                    <div class="activity-stats">
                        <div class="stat">
                            <span class="stat-label">Tổng hoạt động:</span>
                            <span class="stat-value">${schedule.length}</span>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Đã hoàn thành:</span>
                            <span class="stat-value">${schedule.filter(a => a.completed).length}</span>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Tỷ lệ hoàn thành:</span>
                            <span class="stat-value">${activityStats.completionRate.toFixed(1)}%</span>
                        </div>
                    </div>
                </div>

                <div class="activity-categories">
                    <h3>📊 Hoạt Động Theo Danh Mục</h3>
                    ${generateActivityCategoryBreakdown(schedule)}
                </div>

                <div class="activity-timeline">
                    <h3>📅 Lịch Trình Hoạt Động</h3>
                    ${generateActivityTimeline(schedule)}
                </div>
            </div>
        `;
    }

    // Helper functions for report generation
    function generateReportStatistics() {
        const tripData = TripCore.getData();
        const stats = TripCore.getStatistics();
        
        return {
            destinations: tripData.destinations?.length || 0,
            activities: tripData.schedule?.length || 0,
            completedActivities: tripData.schedule?.filter(a => a.completed).length || 0,
            transactions: tripData.expenses?.length || 0,
            averageTransaction: stats.totalSpent / Math.max(1, tripData.expenses?.length || 1),
            totalSpent: stats.totalSpent,
            budgetUsed: stats.budgetUsed
        };
    }

    function getTripStatus(tripInfo) {
        if (!tripInfo.startDate || !tripInfo.endDate) {
            return { text: 'Chưa lên lịch', icon: '📅', class: 'planning' };
        }

        const now = new Date();
        const start = new Date(tripInfo.startDate);
        const end = new Date(tripInfo.endDate);

        if (now < start) {
            return { text: 'Sắp bắt đầu', icon: '⏳', class: 'upcoming' };
        } else if (now > end) {
            return { text: 'Đã hoàn thành', icon: '✅', class: 'completed' };
        } else {
            return { text: 'Đang diễn ra', icon: '🚀', class: 'ongoing' };
        }
    }

    function getBudgetColor(percentage) {
        if (percentage >= 100) return '#e74c3c';
        if (percentage >= 90) return '#e67e22';
        if (percentage >= 75) return '#f39c12';
        return '#27ae60';
    }

    function generateTripHighlights() {
        const tripData = TripCore.getData();
        const stats = TripCore.getStatistics();
        const highlights = [];

        // Most expensive transaction
        if (tripData.expenses && tripData.expenses.length > 0) {
            const maxExpense = tripData.expenses.reduce((max, exp) => exp.amount > max.amount ? exp : max);
            highlights.push(`💳 Chi tiêu lớn nhất: ${TripUtils.formatMoney(maxExpense.amount)} cho ${maxExpense.note || maxExpense.location}`);
        }

        // Top expense category
        if (stats.topExpenseCategory) {
            const categories = TripCore.getExpenseCategories();
            const categoryName = categories[stats.topExpenseCategory.category]?.name || stats.topExpenseCategory.category;
            highlights.push(`📊 Danh mục chi nhiều nhất: ${categoryName} (${stats.topExpenseCategory.percentage.toFixed(1)}%)`);
        }

        // Budget status
        if (stats.budgetUsed > 100) {
            highlights.push(`⚠️ Vượt ngân sách ${(stats.budgetUsed - 100).toFixed(1)}%`);
        } else if (stats.budgetUsed < 80) {
            highlights.push(`💰 Tiết kiệm được ${(100 - stats.budgetUsed).toFixed(1)}% ngân sách`);
        }

        return highlights.length > 0 ? 
            `<ul>${highlights.map(h => `<li>${h}</li>`).join('')}</ul>` :
            '<p>Chưa có đủ dữ liệu để tạo điểm nổi bật.</p>';
    }

    function generateExpenseChart() {
        // Placeholder for chart generation
        return `
            <div class="chart-container">
                <h4>📊 Biểu Đồ Chi Tiêu</h4>
                <div class="chart-placeholder">
                    <canvas id="expenseChart" width="400" height="200"></canvas>
                    <p style="text-align: center; color: #666; margin-top: 20px;">
                        Biểu đồ chi tiêu sẽ được hiển thị ở đây
                    </p>
                </div>
            </div>
        `;
    }

    function generateBudgetChart() {
        return `
            <div class="chart-container">
                <h4>💰 Biểu Đồ Ngân Sách</h4>
                <div class="chart-placeholder">
                    <canvas id="budgetChart" width="400" height="200"></canvas>
                    <p style="text-align: center; color: #666; margin-top: 20px;">
                        Biểu đồ phân tích ngân sách sẽ được hiển thị ở đây
                    </p>
                </div>
            </div>
        `;
    }

    function generateExpenseTimeline(expenses) {
        const dailyExpenses = {};
        
        expenses.forEach(expense => {
            const date = expense.date.split('T')[0];
            if (!dailyExpenses[date]) {
                dailyExpenses[date] = 0;
            }
            dailyExpenses[date] += expense.amount;
        });

        const sortedDates = Object.keys(dailyExpenses).sort();

        return `
            <div class="expense-timeline-chart">
                ${sortedDates.map(date => `
                    <div class="timeline-day">
                        <div class="timeline-date">${TripUtils.formatDate(date)}</div>
                        <div class="timeline-amount">${TripUtils.formatMoney(dailyExpenses[date])}</div>
                        <div class="timeline-bar">
                            <div class="bar-fill" style="width: ${(dailyExpenses[date] / Math.max(...Object.values(dailyExpenses))) * 100}%;"></div>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
    }

    function generateTimelineProgress() {
        const destinations = TripCore.getData().destinations || [];
        const completed = destinations.filter(d => d.checkedOut).length;
        const total = destinations.length;
        const percentage = total > 0 ? (completed / total * 100) : 0;

        return `
            <div class="progress-overview">
                <div class="progress-stats">
                    <span>Hoàn thành: ${completed}/${total} điểm đến</span>
                    <span>${percentage.toFixed(1)}%</span>
                </div>
                <div class="progress-bar-large">
                    <div class="progress-fill" style="width: ${percentage}%;"></div>
                </div>
            </div>
        `;
    }

    function getDestinationExpenses(destination, expenses) {
        return expenses.filter(expense => 
            expense.location && expense.location.toLowerCase().includes(destination.name.toLowerCase())
        );
    }

    function generateBudgetAnalysis(stats, tripInfo) {
        const analysis = [];

        if (stats.budgetUsed > 100) {
            analysis.push(`⚠️ Bạn đã vượt ngân sách ${(stats.budgetUsed - 100).toFixed(1)}%`);
        }

        if (stats.averageDailySpending > 0 && tripInfo.totalDays > 0) {
            const dailyBudget = tripInfo.plannedBudget / tripInfo.totalDays;
            if (stats.averageDailySpending > dailyBudget) {
                analysis.push(`📈 Chi tiêu hàng ngày cao hơn kế hoạch ${((stats.averageDailySpending / dailyBudget - 1) * 100).toFixed(1)}%`);
            }
        }

        if (stats.topExpenseCategory) {
            analysis.push(`📊 Danh mục chi nhiều nhất chiếm ${stats.topExpenseCategory.percentage.toFixed(1)}% tổng chi phí`);
        }

        return analysis.length > 0 ? 
            `<ul>${analysis.map(a => `<li>${a}</li>`).join('')}</ul>` :
            '<p>Ngân sách được quản lý tốt.</p>';
    }

    function generateBudgetRecommendations(stats, tripInfo) {
        const recommendations = [];

        if (stats.budgetUsed > 90) {
            recommendations.push('💡 Cân nhắc giảm chi tiêu cho các hoạt động không thiết yếu');
        }

        if (stats.averageDailySpending > 0) {
            const dailyBudget = tripInfo.plannedBudget / tripInfo.totalDays;
            if (stats.averageDailySpending > dailyBudget * 1.2) {
                recommendations.push('💰 Thiết lập ngân sách hàng ngày chặt chẽ hơn');
            }
        }

        if (stats.budgetUsed < 70) {
            recommendations.push('🎉 Bạn có thể tăng chi cho trải nghiệm tốt hơn');
        }

        return recommendations.length > 0 ? 
            `<ul>${recommendations.map(r => `<li>${r}</li>`).join('')}</ul>` :
            '<p>Không có khuyến nghị đặc biệt.</p>';
    }

    function calculateActivityStats(schedule) {
        const total = schedule.length;
        const completed = schedule.filter(a => a.completed).length;
        const completionRate = total > 0 ? (completed / total * 100) : 0;

        return { total, completed, completionRate };
    }

    function generateActivityCategoryBreakdown(schedule) {
        const categories = {};
        
        schedule.forEach(activity => {
            if (!categories[activity.category]) {
                categories[activity.category] = 0;
            }
            categories[activity.category]++;
        });

        return `
            <div class="category-breakdown">
                ${Object.entries(categories).map(([category, count]) => `
                    <div class="category-item">
                        <span class="category-name">${category}</span>
                        <span class="category-count">${count}</span>
                        <div class="category-bar">
                            <div class="bar-fill" style="width: ${(count / schedule.length) * 100}%;"></div>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
    }

    function generateActivityTimeline(schedule) {
        const groupedByDate = {};
        
        schedule.forEach(activity => {
            if (!groupedByDate[activity.date]) {
                groupedByDate[activity.date] = [];
            }
            groupedByDate[activity.date].push(activity);
        });

        return `
            <div class="activity-timeline">
                ${Object.entries(groupedByDate).map(([date, activities]) => `
                    <div class="timeline-day">
                        <h4>${TripUtils.formatDate(date)}</h4>
                        <div class="day-activities">
                            ${activities.map(activity => `
                                <div class="activity-item ${activity.completed ? 'completed' : ''}">
                                    <span class="activity-time">${activity.startTime || ''}</span>
                                    <span class="activity-title">${activity.title}</span>
                                    <span class="activity-status">${activity.completed ? '✅' : '⏳'}</span>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
    }

    // Report management functions
    function generateQuickReport(type) {
        currentReport.type = type;
        renderReportPreview();
        TripNotifications.showSuccess(`Đã tạo báo cáo ${type}!`);
    }

    function generateCustomReport() {
        renderReportPreview();
        TripNotifications.showSuccess('Đã tạo báo cáo tùy chỉnh!');
    }

    function updateReportSetting(key, value) {
        currentReport[key] = value;
        console.log('Updated report setting:', key, value);
    }

    function previewReport() {
        renderReportPreview();
    }

    function saveReportTemplate() {
        const template = {
            name: `Mẫu báo cáo ${currentReport.type}`,
            settings: { ...currentReport },
            createdAt: TripUtils.getCurrentDateTime()
        };
        
        const templates = JSON.parse(localStorage.getItem('reportTemplates') || '[]');
        templates.push(template);
        localStorage.setItem('reportTemplates', JSON.stringify(templates));
        
        TripNotifications.showSuccess('Đã lưu mẫu báo cáo!');
    }

    // Export functions
    function exportReport(format) {
        const reportContent = generateReportContent(currentReport.type);
        const tripInfo = TripCore.getTripInfo();
        const filename = `bao_cao_${currentReport.type}_${TripUtils.slugify(tripInfo.name)}_${TripUtils.getCurrentDate()}`;
        
        switch (format) {
            case 'pdf':
                exportToPDF(reportContent, filename);
                break;
            case 'excel':
                exportToExcel(filename);
                break;
            case 'csv':
                exportToCSV(filename);
                break;
            default:
                TripNotifications.showWarning('Định dạng không được hỗ trợ!');
        }
    }

    function exportToPDF(content, filename) {
        // Placeholder for PDF export
        TripNotifications.showInfo('Tính năng xuất PDF sẽ được phát triển trong phiên bản tiếp theo!');
    }

    function exportToExcel(filename) {
        // Create Excel-compatible CSV
        const csvContent = generateExcelReport();
        TripUtils.downloadFile(csvContent, filename + '.csv', 'text/csv');
        TripNotifications.showSuccess('Đã xuất báo cáo Excel!');
    }

    function exportToCSV(filename) {
        const csvContent = generateCSVReport();
        TripUtils.downloadFile(csvContent, filename + '.csv', 'text/csv');
        TripNotifications.showSuccess('Đã xuất báo cáo CSV!');
    }

    function generateExcelReport() {
        const tripData = TripCore.getData();
        const stats = TripCore.getStatistics();
        
        let csv = 'Báo Cáo Chuyến Đi\n\n';
        
        // Trip summary
        csv += 'Tổng Quan\n';
        csv += 'Mục,Giá Trị\n';
        csv += `Tên chuyến đi,"${TripCore.getTripInfo().name}"\n`;
        csv += `Tổng ngân sách,${TripCore.getTripInfo().plannedBudget}\n`;
        csv += `Đã chi tiêu,${stats.totalSpent}\n`;
        csv += `Số điểm đến,${tripData.destinations?.length || 0}\n\n`;
        
        // Expenses
        if (tripData.expenses) {
            csv += 'Chi Tiêu\n';
            csv += 'Ngày,Danh mục,Số tiền,Địa điểm,Ghi chú\n';
            tripData.expenses.forEach(expense => {
                csv += `${TripUtils.formatDate(expense.date)},"${expense.category}",${expense.amount},"${expense.location || ''}","${expense.note || ''}"\n`;
            });
        }
        
        return '\ufeff' + csv;
    }

    function generateCSVReport() {
        return generateExcelReport(); // Same format for now
    }

    function printReport() {
        window.print();
    }

    function shareReport() {
        TripNotifications.showInfo('Tính năng chia sẻ báo cáo sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Tool functions (placeholders)
    function createInteractiveChart() {
        TripNotifications.showInfo('Tính năng biểu đồ tương tác sẽ được phát triển!');
    }

    function compareTrips() {
        TripNotifications.showInfo('Tính năng so sánh chuyến đi sẽ được phát triển!');
    }

    function analyzeTrends() {
        TripNotifications.showInfo('Tính năng phân tích xu hướng sẽ được phát triển!');
    }

    function createMobileReport() {
        TripNotifications.showInfo('Tính năng báo cáo di động sẽ được phát triển!');
    }

    function createWebReport() {
        TripNotifications.showInfo('Tính năng báo cáo web sẽ được phát triển!');
    }

    function scheduleReport() {
        TripNotifications.showInfo('Tính năng lập lịch báo cáo sẽ được phát triển!');
    }

    // Setup event listeners
    function setupEventListeners() {
        // Listen to data changes
        TripCore.on('dataChanged', () => {
            if (TripTabs.getCurrentTab() === 'reports') {
                update();
            }
        });
    }

    // Public API
    return {
        // Initialization
        init,
        render,
        update,

        // Report generation
        generateQuickReport,
        generateCustomReport,
        updateReportSetting,
        previewReport,
        saveReportTemplate,

        // Export functions
        exportReport,
        printReport,
        shareReport,

        // Tools
        createInteractiveChart,
        compareTrips,
        analyzeTrends,
        createMobileReport,
        createWebReport,
        scheduleReport,

        // Data
        REPORT_TYPES,
        currentReport,
        generateReportStatistics
    };
})();