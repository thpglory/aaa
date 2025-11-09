/**
 * Trip Manager - Expense Management
 * Version: 1.0.0
 * Handles expense tracking, categorization, and analysis
 */

window.TripExpenses = (function() {
    'use strict';

    // Expense filters and sorting
    let currentFilter = {
        category: '',
        dateRange: '',
        amountRange: '',
        location: '',
        sortBy: 'date',
        sortOrder: 'desc'
    };

    // Pagination
    let currentPage = 1;
    const itemsPerPage = 20;

    // Split bill functionality
    let splitBillData = {
        active: false,
        participants: [],
        expenses: []
    };

    function init() {
        console.log('TripExpenses: Initializing...');
        
        render();
        setupEventListeners();
        
        console.log('TripExpenses: Initialized successfully');
    }

    // Render expenses tab
    function render() {
        renderExpenseForm();
        renderExpenseHistory();
        renderExpenseAnalytics();
        renderSplitBillSection();
    }

    // Update expenses display
    function update() {
        renderExpenseHistory();
        renderExpenseAnalytics();
    }

    // Render expense form
    function renderExpenseForm() {
        const container = TripUtils.getElement('expenseForm');
        if (!container) return;

        const categories = TripCore.getExpenseCategories();
        
        container.innerHTML = `
            <div class="form-grid">
                <div class="form-group">
                    <label>Loại chi tiêu <span style="color: red;">*</span></label>
                    <select class="form-control" id="expenseCategory" required>
                        <option value="">Chọn loại chi tiêu...</option>
                        ${Object.entries(categories).map(([key, cat]) => 
                            `<option value="${key}">${cat.name}</option>`
                        ).join('')}
                    </select>
                </div>
                <div class="form-group">
                    <label>Số tiền (VNĐ) <span style="color: red;">*</span></label>
                    <input type="number" class="form-control" id="expenseAmount" placeholder="0" min="0" step="1000" required>
                </div>
                <div class="form-group">
                    <label>Địa điểm</label>
                    <input type="text" class="form-control" id="expenseLocation" placeholder="Nơi chi tiêu" list="locationSuggestions">
                    <datalist id="locationSuggestions">
                        ${getLocationSuggestions().map(loc => `<option value="${loc}"></option>`).join('')}
                    </datalist>
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <input type="text" class="form-control" id="expenseNote" placeholder="Mô tả chi tiết...">
                </div>
                <div class="form-group">
                    <label>Ngày giờ</label>
                    <input type="datetime-local" class="form-control" id="expenseDateTime" value="${getCurrentDateTime()}">
                </div>
                <div class="form-group">
                    <label>Chia tiền nhóm</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" id="enableSplitBill"> 
                        <label for="enableSplitBill" style="margin: 0;">Chia cho nhiều người</label>
                    </div>
                </div>
            </div>
            
            <div id="splitBillSection" style="display: none; margin-top: 20px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                <h4>Chia tiền nhóm</h4>
                <div id="splitBillParticipants"></div>
                <button type="button" class="btn btn-secondary" onclick="TripExpenses.addParticipant()">+ Thêm người</button>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button class="btn" onclick="TripExpenses.addExpense()">💳 Thêm Chi Tiêu</button>
                <button class="btn btn-secondary" onclick="TripExpenses.clearForm()">🔄 Xóa Form</button>
                <button class="btn btn-secondary" onclick="TripExpenses.scanReceipt()">📸 Quét Hóa Đơn</button>
            </div>
        `;

        // Setup split bill toggle
        const splitBillCheckbox = TripUtils.getElement('enableSplitBill');
        if (splitBillCheckbox) {
            splitBillCheckbox.addEventListener('change', toggleSplitBill);
        }
    }

    // Render expense history
    function renderExpenseHistory() {
        const container = TripUtils.getElement('expenseHistory');
        if (!container) return;

        const tripData = TripCore.getData();
        let expenses = [...tripData.expenses];

        // Apply filters
        expenses = applyFilters(expenses);

        // Apply sorting
        expenses = applySorting(expenses);

        // Apply pagination
        const totalPages = Math.ceil(expenses.length / itemsPerPage);
        const startIndex = (currentPage - 1) * itemsPerPage;
        const paginatedExpenses = expenses.slice(startIndex, startIndex + itemsPerPage);

        container.innerHTML = `
            ${renderExpenseFilters()}
            ${renderExpenseStats(expenses)}
            <div class="expense-list">
                ${paginatedExpenses.length > 0 ? 
                    paginatedExpenses.map(expense => renderExpenseItem(expense)).join('') :
                    '<p style="text-align: center; color: #6c757d; padding: 40px;">Chưa có chi tiêu nào.</p>'
                }
            </div>
            ${renderPagination(totalPages)}
        `;
    }

    // Render expense filters
    function renderExpenseFilters() {
        const categories = TripCore.getExpenseCategories();
        
        return `
            <div class="expense-filters" style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                <h4>Bộ Lọc & Tìm Kiếm</h4>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Loại chi tiêu</label>
                        <select class="form-control" id="filterCategory" onchange="TripExpenses.updateFilter('category', this.value)">
                            <option value="">Tất cả</option>
                            ${Object.entries(categories).map(([key, cat]) => 
                                `<option value="${key}" ${currentFilter.category === key ? 'selected' : ''}>${cat.name}</option>`
                            ).join('')}
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Khoảng thời gian</label>
                        <select class="form-control" id="filterDateRange" onchange="TripExpenses.updateFilter('dateRange', this.value)">
                            <option value="">Tất cả</option>
                            <option value="today" ${currentFilter.dateRange === 'today' ? 'selected' : ''}>Hôm nay</option>
                            <option value="yesterday" ${currentFilter.dateRange === 'yesterday' ? 'selected' : ''}>Hôm qua</option>
                            <option value="week" ${currentFilter.dateRange === 'week' ? 'selected' : ''}>Tuần này</option>
                            <option value="month" ${currentFilter.dateRange === 'month' ? 'selected' : ''}>Tháng này</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sắp xếp</label>
                        <select class="form-control" id="filterSort" onchange="TripExpenses.updateSort(this.value)">
                            <option value="date_desc" ${currentFilter.sortBy === 'date' && currentFilter.sortOrder === 'desc' ? 'selected' : ''}>Mới nhất</option>
                            <option value="date_asc" ${currentFilter.sortBy === 'date' && currentFilter.sortOrder === 'asc' ? 'selected' : ''}>Cũ nhất</option>
                            <option value="amount_desc" ${currentFilter.sortBy === 'amount' && currentFilter.sortOrder === 'desc' ? 'selected' : ''}>Số tiền cao</option>
                            <option value="amount_asc" ${currentFilter.sortBy === 'amount' && currentFilter.sortOrder === 'asc' ? 'selected' : ''}>Số tiền thấp</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Địa điểm</label>
                        <input type="text" class="form-control" id="filterLocation" placeholder="Tìm theo địa điểm..." 
                               value="${currentFilter.location}" oninput="TripUtils.debounce(() => TripExpenses.updateFilter('location', this.value), 500)()">
                    </div>
                </div>
                <div style="margin-top: 15px;">
                    <button class="btn btn-secondary btn-small" onclick="TripExpenses.clearFilters()">🔄 Xóa Bộ Lọc</button>
                    <button class="btn btn-secondary btn-small" onclick="TripExpenses.exportExpenses()">📊 Xuất Excel</button>
                </div>
            </div>
        `;
    }

    // Render expense statistics
    function renderExpenseStats(expenses) {
        const total = expenses.reduce((sum, exp) => sum + exp.amount, 0);
        const avgAmount = expenses.length > 0 ? total / expenses.length : 0;
        const maxExpense = expenses.length > 0 ? Math.max(...expenses.map(exp => exp.amount)) : 0;
        const uniqueLocations = new Set(expenses.map(exp => exp.location || 'Không xác định')).size;

        return `
            <div class="expense-stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; margin-bottom: 20px;">
                <div class="stat-card">
                    <div class="stat-number">${expenses.length}</div>
                    <div class="stat-label">Giao dịch</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${TripUtils.formatMoney(total)}</div>
                    <div class="stat-label">Tổng chi</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${TripUtils.formatMoney(avgAmount)}</div>
                    <div class="stat-label">Trung bình</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${uniqueLocations}</div>
                    <div class="stat-label">Địa điểm</div>
                </div>
            </div>
        `;
    }

    // Render expense item
    function renderExpenseItem(expense) {
        const categories = TripCore.getExpenseCategories();
        const category = categories[expense.category] || { name: '📝 Khác', icon: '📝', color: '#607d8b' };
        
        return `
            <div class="list-item fade-in" data-expense-id="${expense.id}">
                <div class="item-info">
                    <h4>${category.name}</h4>
                    <p>📍 ${expense.location || 'Không xác định'} • ${TripUtils.formatDateTime(expense.date)}</p>
                    ${expense.note ? `<p><em>${expense.note}</em></p>` : ''}
                    ${expense.splitBill ? renderSplitBillInfo(expense.splitBill) : ''}
                </div>
                <div class="item-actions">
                    <div class="item-amount">${TripUtils.formatMoney(expense.amount)}</div>
                    <button class="btn btn-small" onclick="TripExpenses.editExpense('${expense.id}')">✏️</button>
                    <button class="btn btn-small btn-danger" onclick="TripExpenses.removeExpense('${expense.id}')">🗑️</button>
                </div>
            </div>
        `;
    }

    // Render split bill info
    function renderSplitBillInfo(splitBill) {
        const participants = splitBill.participants || [];
        return `
            <div style="margin-top: 8px; padding: 8px; background: #e3f2fd; border-radius: 6px; font-size: 12px;">
                <strong>Chia cho ${participants.length} người:</strong> 
                ${participants.map(p => `${p.name} (${TripUtils.formatMoney(p.amount)})`).join(', ')}
            </div>
        `;
    }

    // Render pagination
    function renderPagination(totalPages) {
        if (totalPages <= 1) return '';

        let paginationHtml = '<div class="pagination" style="text-align: center; margin-top: 20px;">';
        
        if (currentPage > 1) {
            paginationHtml += `<button class="btn btn-small" onclick="TripExpenses.goToPage(${currentPage - 1})">‹ Trước</button>`;
        }
        
        paginationHtml += `<span style="margin: 0 15px;">Trang ${currentPage} / ${totalPages}</span>`;
        
        if (currentPage < totalPages) {
            paginationHtml += `<button class="btn btn-small" onclick="TripExpenses.goToPage(${currentPage + 1})">Sau ›</button>`;
        }
        
        paginationHtml += '</div>';
        return paginationHtml;
    }

    // Render expense analytics
    function renderExpenseAnalytics() {
        // This could be a chart or detailed breakdown
        console.log('Rendering expense analytics...');
    }

    // Render split bill section
    function renderSplitBillSection() {
        const container = TripUtils.getElement('splitBillSection');
        if (!container) return;

        // This is handled in the form rendering
    }

    // Add expense
    function addExpense() {
        const category = TripUtils.getElement('expenseCategory')?.value;
        const amount = parseFloat(TripUtils.getElement('expenseAmount')?.value);
        const location = TripUtils.getElement('expenseLocation')?.value;
        const note = TripUtils.getElement('expenseNote')?.value;
        const dateTime = TripUtils.getElement('expenseDateTime')?.value;
        const enableSplitBill = TripUtils.getElement('enableSplitBill')?.checked;

        if (!category || !amount || amount <= 0) {
            TripNotifications.showWarning('Vui lòng nhập đầy đủ thông tin bắt buộc!');
            return false;
        }

        const expense = {
            id: TripUtils.generateId(),
            category: category,
            amount: amount,
            location: location || 'Không xác định',
            note: note || '',
            date: dateTime ? new Date(dateTime).toISOString() : TripUtils.getCurrentDateTime(),
            createdAt: TripUtils.getCurrentDateTime()
        };

        // Handle split bill
        if (enableSplitBill && splitBillData.participants.length > 0) {
            expense.splitBill = {
                participants: [...splitBillData.participants],
                totalAmount: amount,
                splitType: 'custom' // or 'equal'
            };
        }

        // Add to trip data
        const tripData = TripCore.getData();
        tripData.expenses.push(expense);
        TripCore.saveData();

        // Clear form
        clearForm();

        // Update display
        update();

        // Emit event
        TripCore.emit('expenseAdded', expense);

        TripNotifications.showSuccess(`Đã thêm chi tiêu ${TripUtils.formatMoney(amount)}!`);
        return true;
    }

    // Add quick expense (from modal)
    function addQuickExpense(data) {
        const expense = {
            id: TripUtils.generateId(),
            category: data.category,
            amount: parseFloat(data.amount),
            location: data.location || 'Thêm nhanh',
            note: data.note || '',
            date: TripUtils.getCurrentDateTime(),
            createdAt: TripUtils.getCurrentDateTime()
        };

        // Add to trip data
        const tripData = TripCore.getData();
        tripData.expenses.push(expense);
        TripCore.saveData();

        // Update display if on expenses tab
        if (TripTabs.getCurrentTab() === 'expenses') {
            update();
        }

        // Emit event
        TripCore.emit('expenseAdded', expense);

        TripNotifications.showSuccess(`Đã thêm chi tiêu ${TripUtils.formatMoney(expense.amount)}!`);
        return true;
    }

    // Edit expense
    function editExpense(expenseId) {
        const tripData = TripCore.getData();
        const expense = tripData.expenses.find(exp => exp.id === expenseId);
        
        if (!expense) {
            TripNotifications.showError('Không tìm thấy chi tiêu!');
            return;
        }

        // Open modal with expense data
        TripModals.openModal('expenseModal', expense);
    }

    // Remove expense
    function removeExpense(expenseId) {
        if (!confirm('Bạn có chắc chắn muốn xóa chi tiêu này?')) {
            return;
        }

        const tripData = TripCore.getData();
        const expenseIndex = tripData.expenses.findIndex(exp => exp.id === expenseId);
        
        if (expenseIndex === -1) {
            TripNotifications.showError('Không tìm thấy chi tiêu!');
            return;
        }

        tripData.expenses.splice(expenseIndex, 1);
        TripCore.saveData();

        update();
        TripNotifications.showSuccess('Đã xóa chi tiêu!');
    }

    // Clear form
    function clearForm() {
        const fields = ['expenseCategory', 'expenseAmount', 'expenseLocation', 'expenseNote'];
        fields.forEach(fieldId => {
            const field = TripUtils.getElement(fieldId);
            if (field) field.value = '';
        });

        const dateTimeField = TripUtils.getElement('expenseDateTime');
        if (dateTimeField) {
            dateTimeField.value = getCurrentDateTime();
        }

        const splitBillCheckbox = TripUtils.getElement('enableSplitBill');
        if (splitBillCheckbox) {
            splitBillCheckbox.checked = false;
            toggleSplitBill({ target: splitBillCheckbox });
        }
    }

    // Scan receipt (placeholder)
    function scanReceipt() {
        TripNotifications.showInfo('Tính năng quét hóa đơn sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Apply filters
    function applyFilters(expenses) {
        let filtered = [...expenses];

        // Category filter
        if (currentFilter.category) {
            filtered = filtered.filter(exp => exp.category === currentFilter.category);
        }

        // Date range filter
        if (currentFilter.dateRange) {
            const now = new Date();
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            
            filtered = filtered.filter(exp => {
                const expDate = new Date(exp.date);
                
                switch (currentFilter.dateRange) {
                    case 'today':
                        return expDate >= today;
                    case 'yesterday':
                        const yesterday = new Date(today);
                        yesterday.setDate(yesterday.getDate() - 1);
                        return expDate >= yesterday && expDate < today;
                    case 'week':
                        const weekStart = new Date(today);
                        weekStart.setDate(weekStart.getDate() - weekStart.getDay());
                        return expDate >= weekStart;
                    case 'month':
                        const monthStart = new Date(now.getFullYear(), now.getMonth(), 1);
                        return expDate >= monthStart;
                    default:
                        return true;
                }
            });
        }

        // Location filter
        if (currentFilter.location) {
            const locationLower = currentFilter.location.toLowerCase();
            filtered = filtered.filter(exp => 
                (exp.location || '').toLowerCase().includes(locationLower)
            );
        }

        return filtered;
    }

    // Apply sorting
    function applySorting(expenses) {
        return expenses.sort((a, b) => {
            let valueA, valueB;
            
            switch (currentFilter.sortBy) {
                case 'amount':
                    valueA = a.amount;
                    valueB = b.amount;
                    break;
                case 'date':
                default:
                    valueA = new Date(a.date);
                    valueB = new Date(b.date);
            }

            if (currentFilter.sortOrder === 'asc') {
                return valueA - valueB;
            } else {
                return valueB - valueA;
            }
        });
    }

    // Update filter
    function updateFilter(filterType, value) {
        currentFilter[filterType] = value;
        currentPage = 1; // Reset to first page
        update();
    }

    // Update sort
    function updateSort(sortValue) {
        const [sortBy, sortOrder] = sortValue.split('_');
        currentFilter.sortBy = sortBy;
        currentFilter.sortOrder = sortOrder;
        currentPage = 1;
        update();
    }

    // Clear filters
    function clearFilters() {
        currentFilter = {
            category: '',
            dateRange: '',
            amountRange: '',
            location: '',
            sortBy: 'date',
            sortOrder: 'desc'
        };
        currentPage = 1;
        update();
    }

    // Go to page
    function goToPage(page) {
        currentPage = page;
        update();
    }

    // Export expenses
    function exportExpenses() {
        const tripData = TripCore.getData();
        let expenses = applyFilters(tripData.expenses);
        expenses = applySorting(expenses);

        const csvData = convertToCSV(expenses);
        const filename = `chi_tieu_${TripUtils.getCurrentDate()}.csv`;
        
        TripUtils.downloadFile(csvData, filename, 'text/csv');
        TripNotifications.showSuccess('Đã xuất dữ liệu chi tiêu!');
    }

    // Convert expenses to CSV
    function convertToCSV(expenses) {
        const headers = ['Ngày', 'Loại', 'Số tiền', 'Địa điểm', 'Ghi chú'];
        const rows = expenses.map(exp => [
            TripUtils.formatDateTime(exp.date),
            TripCore.getExpenseCategories()[exp.category]?.name || exp.category,
            exp.amount,
            exp.location || '',
            exp.note || ''
        ]);

        const csvContent = [headers, ...rows]
            .map(row => row.map(field => `"${field}"`).join(','))
            .join('\n');

        return '\ufeff' + csvContent; // Add BOM for Vietnamese characters
    }

    // Split bill functions
    function toggleSplitBill(event) {
        const isEnabled = event.target.checked;
        const section = TripUtils.getElement('splitBillSection');
        
        if (section) {
            section.style.display = isEnabled ? 'block' : 'none';
        }

        splitBillData.active = isEnabled;
        
        if (isEnabled && splitBillData.participants.length === 0) {
            addParticipant();
        }
    }

    function addParticipant() {
        const participant = {
            id: TripUtils.generateId(),
            name: '',
            amount: 0
        };
        
        splitBillData.participants.push(participant);
        renderParticipants();
    }

    function removeParticipant(participantId) {
        splitBillData.participants = splitBillData.participants.filter(p => p.id !== participantId);
        renderParticipants();
    }

    function renderParticipants() {
        const container = TripUtils.getElement('splitBillParticipants');
        if (!container) return;

        container.innerHTML = splitBillData.participants.map(participant => `
            <div class="participant-row" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: center;">
                <input type="text" class="form-control" placeholder="Tên người" 
                       value="${participant.name}" 
                       onchange="TripExpenses.updateParticipant('${participant.id}', 'name', this.value)">
                <input type="number" class="form-control" placeholder="Số tiền" 
                       value="${participant.amount}" 
                       onchange="TripExpenses.updateParticipant('${participant.id}', 'amount', this.value)">
                <button type="button" class="btn btn-small btn-danger" 
                        onclick="TripExpenses.removeParticipant('${participant.id}')">×</button>
            </div>
        `).join('');
    }

    function updateParticipant(participantId, field, value) {
        const participant = splitBillData.participants.find(p => p.id === participantId);
        if (participant) {
            if (field === 'amount') {
                participant[field] = parseFloat(value) || 0;
            } else {
                participant[field] = value;
            }
        }
    }

    // Helper functions
    function getCurrentDateTime() {
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        return now.toISOString().slice(0, 16);
    }

    function getLocationSuggestions() {
        const tripData = TripCore.getData();
        const locations = new Set();
        
        // Add locations from expenses
        tripData.expenses.forEach(exp => {
            if (exp.location && exp.location !== 'Không xác định') {
                locations.add(exp.location);
            }
        });
        
        // Add locations from destinations
        tripData.destinations.forEach(dest => {
            if (dest.name) {
                locations.add(dest.name);
            }
        });
        
        return Array.from(locations).slice(0, 10);
    }

    // Setup event listeners
    function setupEventListeners() {
        // Listen to data changes
        TripCore.on('dataChanged', () => {
            if (TripTabs.getCurrentTab() === 'expenses') {
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

        // Expense management
        addExpense,
        addQuickExpense,
        editExpense,
        removeExpense,
        clearForm,
        scanReceipt,

        // Filtering and sorting
        updateFilter,
        updateSort,
        clearFilters,
        goToPage,

        // Export
        exportExpenses,

        // Split bill
        toggleSplitBill,
        addParticipant,
        removeParticipant,
        updateParticipant
    };
})();