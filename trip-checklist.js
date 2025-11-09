/**
 * Trip Manager - Checklist Management
 * Version: 1.0.0
 * Handles packing lists, to-do items, and travel preparations
 */

window.TripChecklist = (function() {
    'use strict';

    // Checklist categories
    const CHECKLIST_CATEGORIES = {
        PACKING: 'packing',
        TODO: 'todo',
        DOCUMENTS: 'documents',
        HEALTH: 'health',
        TECH: 'tech',
        FINANCE: 'finance'
    };

    // Priority levels
    const PRIORITY_LEVELS = {
        LOW: 'low',
        MEDIUM: 'medium',
        HIGH: 'high',
        URGENT: 'urgent'
    };

    // Pre-defined checklist templates
    const checklistTemplates = {
        [CHECKLIST_CATEGORIES.PACKING]: {
            name: '🎒 Hành Lý',
            icon: '🎒',
            color: '#e67e22',
            items: [
                { text: 'Quần áo theo thời tiết', priority: 'high' },
                { text: 'Đồ lót và tất', priority: 'high' },
                { text: 'Giày dép phù hợp', priority: 'high' },
                { text: 'Đồ ngủ', priority: 'medium' },
                { text: 'Áo khoác/áo mưa', priority: 'medium' },
                { text: 'Mũ và kính mát', priority: 'medium' },
                { text: 'Đồ bơi (nếu cần)', priority: 'low' },
                { text: 'Phụ kiện thời trang', priority: 'low' }
            ]
        },
        [CHECKLIST_CATEGORIES.TODO]: {
            name: '📝 Việc Cần Làm',
            icon: '📝',
            color: '#3498db',
            items: [
                { text: 'Đặt vé máy bay/tàu', priority: 'urgent' },
                { text: 'Đặt phòng khách sạn', priority: 'urgent' },
                { text: 'Xin phép nghỉ làm', priority: 'high' },
                { text: 'Kiểm tra thời tiết điểm đến', priority: 'medium' },
                { text: 'Tìm hiểu văn hóa địa phương', priority: 'medium' },
                { text: 'Lên kế hoạch chi tiết', priority: 'medium' },
                { text: 'Thông báo cho người thân', priority: 'low' }
            ]
        },
        [CHECKLIST_CATEGORIES.DOCUMENTS]: {
            name: '📄 Giấy Tờ',
            icon: '📄',
            color: '#f39c12',
            items: [
                { text: 'Hộ chiếu (còn hạn 6 tháng)', priority: 'urgent' },
                { text: 'Visa (nếu cần)', priority: 'urgent' },
                { text: 'Vé máy bay in sẵn', priority: 'high' },
                { text: 'Booking khách sạn in sẵn', priority: 'high' },
                { text: 'Bảo hiểm du lịch', priority: 'high' },
                { text: 'Bằng lái xe quốc tế', priority: 'medium' },
                { text: 'Sao chép giấy tờ quan trọng', priority: 'medium' },
                { text: 'Ảnh 4x6 dự phòng', priority: 'low' }
            ]
        },
        [CHECKLIST_CATEGORIES.HEALTH]: {
            name: '💊 Sức Khỏe',
            icon: '💊',
            color: '#e74c3c',
            items: [
                { text: 'Thuốc cá nhân (nếu có)', priority: 'urgent' },
                { text: 'Thuốc cảm cúm, đau đầu', priority: 'high' },
                { text: 'Thuốc chống say xe', priority: 'high' },
                { text: 'Kem chống nắng', priority: 'medium' },
                { text: 'Thuốc đau bụng, tiêu hóa', priority: 'medium' },
                { text: 'Băng cá nhân, cồn sát trùng', priority: 'medium' },
                { text: 'Tiêm phòng (nếu cần)', priority: 'low' },
                { text: 'Khẩu trang y tế', priority: 'low' }
            ]
        },
        [CHECKLIST_CATEGORIES.TECH]: {
            name: '📱 Công Nghệ',
            icon: '📱',
            color: '#9b59b6',
            items: [
                { text: 'Điện thoại và sạc', priority: 'urgent' },
                { text: 'Adapter điện phù hợp', priority: 'high' },
                { text: 'Power bank dự phòng', priority: 'high' },
                { text: 'Máy ảnh (nếu có)', priority: 'medium' },
                { text: 'Tai nghe', priority: 'medium' },
                { text: 'Cáp USB dự phòng', priority: 'medium' },
                { text: 'Thẻ nhớ dự phòng', priority: 'low' },
                { text: 'Laptop/tablet (nếu cần)', priority: 'low' }
            ]
        },
        [CHECKLIST_CATEGORIES.FINANCE]: {
            name: '💳 Tài Chính',
            icon: '💳',
            color: '#27ae60',
            items: [
                { text: 'Tiền mặt địa phương', priority: 'urgent' },
                { text: 'Thẻ ATM/Credit card', priority: 'urgent' },
                { text: 'Thông báo ngân hàng về chuyến đi', priority: 'high' },
                { text: 'Sao chép thông tin thẻ', priority: 'high' },
                { text: 'Ứng dụng ngân hàng trên điện thoại', priority: 'medium' },
                { text: 'Bảo hiểm thẻ tín dụng', priority: 'medium' },
                { text: 'Số điện thoại ngân hàng khẩn cấp', priority: 'low' }
            ]
        }
    };

    // Current view and filters
    let currentCategory = 'all';
    let currentFilter = {
        completed: 'all',
        priority: 'all',
        assignedTo: 'all'
    };

    // Group assignments
    let groupMembers = [];

    function init() {
        console.log('TripChecklist: Initializing...');
        
        loadGroupMembers();
        render();
        setupEventListeners();
        
        console.log('TripChecklist: Initialized successfully');
    }

    // Render checklist tab
    function render() {
        renderChecklistOverview();
        renderChecklistCategories();
        renderChecklistTools();
    }

    // Update checklist display
    function update() {
        renderChecklistOverview();
        renderChecklistCategories();
        updateProgress();
    }

    // Render checklist overview
    function renderChecklistOverview() {
        const container = TripUtils.getElement('checklistContainer');
        if (!container) return;

        const stats = calculateChecklistStats();
        const tripInfo = TripCore.getTripInfo();
        const daysUntilTrip = tripInfo.startDate ? 
            TripUtils.daysBetween(TripUtils.getCurrentDate(), tripInfo.startDate) : null;

        container.innerHTML = `
            <div class="checklist-overview">
                <div class="checklist-header">
                    <h3>✅ Danh Sách Chuẩn Bị</h3>
                    ${daysUntilTrip !== null ? `
                        <div class="days-until-trip ${daysUntilTrip <= 7 ? 'urgent' : daysUntilTrip <= 14 ? 'warning' : ''}">
                            ${daysUntilTrip > 0 ? 
                                `⏰ Còn ${daysUntilTrip} ngày` : 
                                daysUntilTrip === 0 ? '🎉 Hôm nay khởi hành!' : '✈️ Đã bắt đầu chuyến đi'
                            }
                        </div>
                    ` : ''}
                </div>

                <div class="checklist-stats">
                    <div class="stat-card">
                        <div class="stat-icon">📋</div>
                        <div class="stat-content">
                            <div class="stat-number">${stats.totalItems}</div>
                            <div class="stat-label">Tổng việc</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">✅</div>
                        <div class="stat-content">
                            <div class="stat-number">${stats.completedItems}</div>
                            <div class="stat-label">Hoàn thành</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">⚠️</div>
                        <div class="stat-content">
                            <div class="stat-number">${stats.urgentItems}</div>
                            <div class="stat-label">Khẩn cấp</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">👥</div>
                        <div class="stat-content">
                            <div class="stat-number">${groupMembers.length || 1}</div>
                            <div class="stat-label">Thành viên</div>
                        </div>
                    </div>
                </div>

                <div class="overall-progress">
                    <div class="progress-info">
                        <span>Tiến độ tổng thể</span>
                        <span>${stats.completionPercentage.toFixed(1)}%</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: ${stats.completionPercentage}%; background: ${getProgressColor(stats.completionPercentage)};"></div>
                    </div>
                </div>

                <div class="checklist-filters">
                    <div class="filter-tabs">
                        <button class="filter-tab ${currentCategory === 'all' ? 'active' : ''}" 
                                onclick="TripChecklist.switchCategory('all')">
                            📋 Tất cả
                        </button>
                        ${Object.entries(checklistTemplates).map(([key, template]) => `
                            <button class="filter-tab ${currentCategory === key ? 'active' : ''}" 
                                    onclick="TripChecklist.switchCategory('${key}')">
                                ${template.icon} ${template.name.replace(template.icon + ' ', '')}
                            </button>
                        `).join('')}
                    </div>

                    <div class="filter-controls">
                        <select class="form-control" onchange="TripChecklist.updateFilter('completed', this.value)">
                            <option value="all" ${currentFilter.completed === 'all' ? 'selected' : ''}>Tất cả</option>
                            <option value="pending" ${currentFilter.completed === 'pending' ? 'selected' : ''}>Chưa hoàn thành</option>
                            <option value="completed" ${currentFilter.completed === 'completed' ? 'selected' : ''}>Đã hoàn thành</option>
                        </select>

                        <select class="form-control" onchange="TripChecklist.updateFilter('priority', this.value)">
                            <option value="all" ${currentFilter.priority === 'all' ? 'selected' : ''}>Tất cả mức độ</option>
                            <option value="urgent" ${currentFilter.priority === 'urgent' ? 'selected' : ''}>Khẩn cấp</option>
                            <option value="high" ${currentFilter.priority === 'high' ? 'selected' : ''}>Cao</option>
                            <option value="medium" ${currentFilter.priority === 'medium' ? 'selected' : ''}>Trung bình</option>
                            <option value="low" ${currentFilter.priority === 'low' ? 'selected' : ''}>Thấp</option>
                        </select>

                        ${groupMembers.length > 0 ? `
                            <select class="form-control" onchange="TripChecklist.updateFilter('assignedTo', this.value)">
                                <option value="all" ${currentFilter.assignedTo === 'all' ? 'selected' : ''}>Tất cả người</option>
                                ${groupMembers.map(member => `
                                    <option value="${member.id}" ${currentFilter.assignedTo === member.id ? 'selected' : ''}>${member.name}</option>
                                `).join('')}
                            </select>
                        ` : ''}
                    </div>
                </div>
            </div>
        `;
    }

    // Render checklist categories
    function renderChecklistCategories() {
        const container = TripUtils.getElement('checklistContainer');
        if (!container) return;

        const tripData = TripCore.getData();
        const checklist = tripData.checklist || {};
        
        // Initialize checklist if empty
        if (Object.keys(checklist).length === 0) {
            initializeDefaultChecklist();
            return render();
        }

        const categoriesHtml = Object.entries(checklistTemplates).map(([categoryKey, template]) => {
            if (currentCategory !== 'all' && currentCategory !== categoryKey) {
                return '';
            }

            const categoryItems = checklist[categoryKey] || [];
            const filteredItems = applyFilters(categoryItems);
            const categoryStats = calculateCategoryStats(categoryItems);
            
            return renderChecklistCategory(categoryKey, template, filteredItems, categoryStats);
        }).join('');

        const categoriesSection = `
            <div class="checklist-categories">
                ${categoriesHtml}
                ${currentCategory === 'all' || !checklistTemplates[currentCategory] ? '' : `
                    <div class="category-actions">
                        <button class="btn" onclick="TripChecklist.addCustomItem('${currentCategory}')">
                            ➕ Thêm việc mới
                        </button>
                        <button class="btn btn-secondary" onclick="TripChecklist.resetCategory('${currentCategory}')">
                            🔄 Đặt lại mặc định
                        </button>
                    </div>
                `}
            </div>
        `;

        container.innerHTML += categoriesSection;
    }

    // Render checklist category
    function renderChecklistCategory(categoryKey, template, items, stats) {
        return `
            <div class="checklist-category" data-category="${categoryKey}">
                <div class="category-header">
                    <div class="category-info">
                        <h4 style="color: ${template.color};">
                            ${template.icon} ${template.name.replace(template.icon + ' ', '')}
                        </h4>
                        <div class="category-stats">
                            <span>${stats.completed}/${stats.total}</span>
                            <span class="category-percentage">${stats.percentage.toFixed(0)}%</span>
                        </div>
                    </div>
                    <div class="category-progress">
                        <div class="progress-container">
                            <div class="progress-bar" 
                                 style="width: ${stats.percentage}%; background: ${template.color};"></div>
                        </div>
                    </div>
                </div>

                <div class="checklist-items">
                    ${items.length > 0 ? 
                        items.map(item => renderChecklistItem(item, categoryKey)).join('') :
                        '<div class="empty-category">Không có việc nào phù hợp với bộ lọc</div>'
                    }
                </div>

                ${currentCategory === categoryKey ? `
                    <div class="category-footer">
                        <button class="btn btn-small" onclick="TripChecklist.addCustomItem('${categoryKey}')">
                            ➕ Thêm việc
                        </button>
                        <button class="btn btn-small btn-secondary" onclick="TripChecklist.shareCategory('${categoryKey}')">
                            📤 Chia sẻ
                        </button>
                    </div>
                ` : ''}
            </div>
        `;
    }

    // Render checklist item
    function renderChecklistItem(item, categoryKey) {
        const priorityClass = `priority-${item.priority || 'medium'}`;
        const assignedMember = groupMembers.find(m => m.id === item.assignedTo);
        
        return `
            <div class="checklist-item ${item.completed ? 'completed' : ''} ${priorityClass}" 
                 data-item-id="${item.id}">
                <div class="item-checkbox" onclick="TripChecklist.toggleItem('${categoryKey}', '${item.id}')">
                    <div class="checkbox ${item.completed ? 'checked' : ''}">
                        ${item.completed ? '✓' : ''}
                    </div>
                </div>

                <div class="item-content">
                    <div class="item-text ${item.completed ? 'completed' : ''}">${item.text}</div>
                    
                    <div class="item-meta">
                        <span class="item-priority ${priorityClass}">
                            ${getPriorityIcon(item.priority)} ${getPriorityText(item.priority)}
                        </span>
                        
                        ${assignedMember ? `
                            <span class="item-assigned">
                                👤 ${assignedMember.name}
                            </span>
                        ` : ''}
                        
                        ${item.notes ? `
                            <span class="item-notes" title="${item.notes}">
                                📝 Có ghi chú
                            </span>
                        ` : ''}
                        
                        ${item.completedAt ? `
                            <span class="item-completed-time">
                                ✅ ${TripUtils.formatDate(item.completedAt)}
                            </span>
                        ` : ''}
                    </div>
                </div>

                <div class="item-actions">
                    <button class="btn btn-small" onclick="TripChecklist.editItem('${categoryKey}', '${item.id}')">
                        ✏️
                    </button>
                    
                    ${groupMembers.length > 0 ? `
                        <button class="btn btn-small" onclick="TripChecklist.assignItem('${categoryKey}', '${item.id}')">
                            👤
                        </button>
                    ` : ''}
                    
                    <button class="btn btn-small btn-danger" onclick="TripChecklist.removeItem('${categoryKey}', '${item.id}')">
                        🗑️
                    </button>
                </div>
            </div>
        `;
    }

    // Render checklist tools
    function renderChecklistTools() {
        const container = TripUtils.getElement('checklistContainer');
        if (!container) return;

        const toolsSection = `
            <div class="checklist-tools">
                <h3>🛠️ Công Cụ Hỗ Trợ</h3>
                
                <div class="tools-grid">
                    <div class="tool-card">
                        <h4>👥 Nhóm Du Lịch</h4>
                        <p>Quản lý thành viên và phân công việc</p>
                        <button class="btn" onclick="TripChecklist.manageGroup()">Quản lý nhóm</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>📋 Mẫu Checklist</h4>
                        <p>Sử dụng mẫu có sẵn hoặc tạo mẫu riêng</p>
                        <button class="btn" onclick="TripChecklist.manageTemplates()">Quản lý mẫu</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>📤 Xuất & Chia Sẻ</h4>
                        <p>Xuất checklist hoặc chia sẻ với nhóm</p>
                        <button class="btn" onclick="TripChecklist.exportChecklist()">Xuất checklist</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>🔔 Nhắc Nhở</h4>
                        <p>Thiết lập nhắc nhở cho các việc quan trọng</p>
                        <button class="btn" onclick="TripChecklist.setupReminders()">Thiết lập</button>
                    </div>
                </div>
                
                <div class="bulk-actions">
                    <h4>Thao Tác Hàng Loạt</h4>
                    <div class="bulk-buttons">
                        <button class="btn btn-secondary" onclick="TripChecklist.markAllCompleted()">
                            ✅ Đánh dấu tất cả hoàn thành
                        </button>
                        <button class="btn btn-secondary" onclick="TripChecklist.markAllPending()">
                            ⭕ Bỏ đánh dấu tất cả
                        </button>
                        <button class="btn btn-secondary" onclick="TripChecklist.resetAllChecklists()">
                            🔄 Đặt lại tất cả
                        </button>
                    </div>
                </div>
            </div>
        `;

        container.innerHTML += toolsSection;
    }

    // Initialize default checklist
    function initializeDefaultChecklist() {
        const tripData = TripCore.getData();
        tripData.checklist = {};
        
        Object.entries(checklistTemplates).forEach(([categoryKey, template]) => {
            tripData.checklist[categoryKey] = template.items.map(item => ({
                id: TripUtils.generateId(),
                text: item.text,
                completed: false,
                priority: item.priority || 'medium',
                createdAt: TripUtils.getCurrentDateTime(),
                assignedTo: null,
                notes: '',
                completedAt: null
            }));
        });
        
        TripCore.saveData();
    }

    // Switch category
    function switchCategory(category) {
        currentCategory = category;
        update();
    }

    // Update filter
    function updateFilter(filterType, value) {
        currentFilter[filterType] = value;
        update();
    }

    // Apply filters
    function applyFilters(items) {
        return items.filter(item => {
            // Completion filter
            if (currentFilter.completed === 'completed' && !item.completed) return false;
            if (currentFilter.completed === 'pending' && item.completed) return false;
            
            // Priority filter
            if (currentFilter.priority !== 'all' && item.priority !== currentFilter.priority) return false;
            
            // Assignment filter
            if (currentFilter.assignedTo !== 'all' && item.assignedTo !== currentFilter.assignedTo) return false;
            
            return true;
        });
    }

    // Toggle item completion
    function toggleItem(categoryKey, itemId) {
        const tripData = TripCore.getData();
        const item = tripData.checklist[categoryKey]?.find(i => i.id === itemId);
        
        if (!item) return;
        
        item.completed = !item.completed;
        item.completedAt = item.completed ? TripUtils.getCurrentDateTime() : null;
        
        TripCore.saveData();
        update();
        
        const message = item.completed ? 
            `✅ Hoàn thành: ${item.text}` : 
            `⭕ Bỏ hoàn thành: ${item.text}`;
        TripNotifications.showSuccess(message);
    }

    // Add custom item
    function addCustomItem(categoryKey) {
        const text = prompt('Nhập nội dung việc cần làm:');
        if (!text || !text.trim()) return;
        
        const priority = prompt('Mức độ ưu tiên (low/medium/high/urgent):', 'medium');
        const validPriorities = ['low', 'medium', 'high', 'urgent'];
        const finalPriority = validPriorities.includes(priority) ? priority : 'medium';
        
        const item = {
            id: TripUtils.generateId(),
            text: text.trim(),
            completed: false,
            priority: finalPriority,
            createdAt: TripUtils.getCurrentDateTime(),
            assignedTo: null,
            notes: '',
            completedAt: null
        };
        
        const tripData = TripCore.getData();
        if (!tripData.checklist[categoryKey]) {
            tripData.checklist[categoryKey] = [];
        }
        
        tripData.checklist[categoryKey].push(item);
        TripCore.saveData();
        update();
        
        TripNotifications.showSuccess(`Đã thêm: ${item.text}`);
    }

    // Edit item
    function editItem(categoryKey, itemId) {
        const tripData = TripCore.getData();
        const item = tripData.checklist[categoryKey]?.find(i => i.id === itemId);
        
        if (!item) return;
        
        const newText = prompt('Sửa nội dung:', item.text);
        if (newText !== null && newText.trim()) {
            item.text = newText.trim();
            TripCore.saveData();
            update();
            TripNotifications.showSuccess('Đã cập nhật!');
        }
    }

    // Remove item
    function removeItem(categoryKey, itemId) {
        if (!confirm('Bạn có chắc chắn muốn xóa việc này?')) return;
        
        const tripData = TripCore.getData();
        if (!tripData.checklist[categoryKey]) return;
        
        const itemIndex = tripData.checklist[categoryKey].findIndex(i => i.id === itemId);
        if (itemIndex === -1) return;
        
        const item = tripData.checklist[categoryKey][itemIndex];
        tripData.checklist[categoryKey].splice(itemIndex, 1);
        TripCore.saveData();
        update();
        
        TripNotifications.showSuccess(`Đã xóa: ${item.text}`);
    }

    // Assign item to group member
    function assignItem(categoryKey, itemId) {
        if (groupMembers.length === 0) {
            TripNotifications.showWarning('Chưa có thành viên nào trong nhóm!');
            return;
        }
        
        const tripData = TripCore.getData();
        const item = tripData.checklist[categoryKey]?.find(i => i.id === itemId);
        if (!item) return;
        
        const memberOptions = groupMembers.map((member, index) => 
            `${index + 1}. ${member.name}`
        ).join('\n');
        
        const selection = prompt(`Phân công cho ai?\n${memberOptions}\n\nNhập số thứ tự:`);
        const memberIndex = parseInt(selection) - 1;
        
        if (memberIndex >= 0 && memberIndex < groupMembers.length) {
            item.assignedTo = groupMembers[memberIndex].id;
            TripCore.saveData();
            update();
            TripNotifications.showSuccess(`Đã phân công cho ${groupMembers[memberIndex].name}`);
        }
    }

    // Calculate checklist statistics
    function calculateChecklistStats() {
        const tripData = TripCore.getData();
        const checklist = tripData.checklist || {};
        
        let totalItems = 0;
        let completedItems = 0;
        let urgentItems = 0;
        
        Object.values(checklist).forEach(categoryItems => {
            categoryItems.forEach(item => {
                totalItems++;
                if (item.completed) completedItems++;
                if (item.priority === 'urgent') urgentItems++;
            });
        });
        
        const completionPercentage = totalItems > 0 ? (completedItems / totalItems * 100) : 0;
        
        return {
            totalItems,
            completedItems,
            urgentItems,
            completionPercentage
        };
    }

    // Calculate category statistics
    function calculateCategoryStats(categoryItems) {
        const total = categoryItems.length;
        const completed = categoryItems.filter(item => item.completed).length;
        const percentage = total > 0 ? (completed / total * 100) : 0;
        
        return { total, completed, percentage };
    }

    // Get priority icon
    function getPriorityIcon(priority) {
        const icons = {
            urgent: '🚨',
            high: '🔴',
            medium: '🟡',
            low: '🟢'
        };
        return icons[priority] || '🟡';
    }

    // Get priority text
    function getPriorityText(priority) {
        const texts = {
            urgent: 'Khẩn cấp',
            high: 'Cao',
            medium: 'Trung bình',
            low: 'Thấp'
        };
        return texts[priority] || 'Trung bình';
    }

    // Get progress color
    function getProgressColor(percentage) {
        if (percentage >= 80) return '#27ae60';
        if (percentage >= 60) return '#f39c12';
        if (percentage >= 40) return '#e67e22';
        return '#e74c3c';
    }

    // Load group members
    function loadGroupMembers() {
        try {
            const saved = localStorage.getItem('tripGroupMembers');
            if (saved) {
                groupMembers = JSON.parse(saved);
            }
        } catch (error) {
            console.error('Error loading group members:', error);
            groupMembers = [];
        }
    }

    // Save group members
    function saveGroupMembers() {
        try {
            localStorage.setItem('tripGroupMembers', JSON.stringify(groupMembers));
        } catch (error) {
            console.error('Error saving group members:', error);
        }
    }

    // Reset category to default
    function resetCategory(categoryKey) {
        if (!confirm('Bạn có chắc chắn muốn đặt lại danh mục này về mặc định?')) return;
        
        const tripData = TripCore.getData();
        const template = checklistTemplates[categoryKey];
        
        if (template) {
            tripData.checklist[categoryKey] = template.items.map(item => ({
                id: TripUtils.generateId(),
                text: item.text,
                completed: false,
                priority: item.priority || 'medium',
                createdAt: TripUtils.getCurrentDateTime(),
                assignedTo: null,
                notes: '',
                completedAt: null
            }));
            
            TripCore.saveData();
            update();
            TripNotifications.showSuccess('Đã đặt lại danh mục!');
        }
    }

    // Manage group
    function manageGroup() {
        TripNotifications.showInfo('Tính năng quản lý nhóm sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Manage templates
    function manageTemplates() {
        TripNotifications.showInfo('Tính năng quản lý mẫu sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Export checklist
    function exportChecklist() {
        const tripData = TripCore.getData();
        const checklist = tripData.checklist || {};
        
        const csvContent = convertChecklistToCSV(checklist);
        const filename = `checklist_${TripUtils.getCurrentDate()}.csv`;
        
        TripUtils.downloadFile(csvContent, filename, 'text/csv');
        TripNotifications.showSuccess('Đã xuất checklist!');
    }

    // Convert checklist to CSV
    function convertChecklistToCSV(checklist) {
        const headers = ['Danh mục', 'Việc cần làm', 'Mức độ', 'Trạng thái', 'Người phụ trách', 'Hoàn thành lúc'];
        const rows = [];
        
        Object.entries(checklist).forEach(([categoryKey, items]) => {
            const categoryName = checklistTemplates[categoryKey]?.name || categoryKey;
            
            items.forEach(item => {
                const assignedMember = groupMembers.find(m => m.id === item.assignedTo);
                rows.push([
                    categoryName.replace(/^.+ /, ''),
                    item.text,
                    getPriorityText(item.priority),
                    item.completed ? 'Hoàn thành' : 'Chưa hoàn thành',
                    assignedMember ? assignedMember.name : '',
                    item.completedAt ? TripUtils.formatDateTime(item.completedAt) : ''
                ]);
            });
        });

        const csvContent = [headers, ...rows]
            .map(row => row.map(field => `"${field}"`).join(','))
            .join('\n');

        return '\ufeff' + csvContent;
    }

    // Setup reminders
    function setupReminders() {
        TripNotifications.showInfo('Tính năng nhắc nhở sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Share category
    function shareCategory(categoryKey) {
        TripNotifications.showInfo('Tính năng chia sẻ sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Bulk actions
    function markAllCompleted() {
        if (!confirm('Đánh dấu tất cả việc đã hoàn thành?')) return;
        
        const tripData = TripCore.getData();
        const checklist = tripData.checklist || {};
        
        Object.values(checklist).forEach(categoryItems => {
            categoryItems.forEach(item => {
                if (!item.completed) {
                    item.completed = true;
                    item.completedAt = TripUtils.getCurrentDateTime();
                }
            });
        });
        
        TripCore.saveData();
        update();
        TripNotifications.showSuccess('Đã đánh dấu tất cả hoàn thành!');
    }

    function markAllPending() {
        if (!confirm('Bỏ đánh dấu hoàn thành cho tất cả việc?')) return;
        
        const tripData = TripCore.getData();
        const checklist = tripData.checklist || {};
        
        Object.values(checklist).forEach(categoryItems => {
            categoryItems.forEach(item => {
                item.completed = false;
                item.completedAt = null;
            });
        });
        
        TripCore.saveData();
        update();
        TripNotifications.showSuccess('Đã bỏ đánh dấu tất cả!');
    }

    function resetAllChecklists() {
        if (!confirm('Đặt lại tất cả checklist về mặc định? Điều này sẽ xóa tất cả tiến độ hiện tại.')) return;
        
        initializeDefaultChecklist();
        update();
        TripNotifications.showSuccess('Đã đặt lại tất cả checklist!');
    }

    // Update progress
    function updateProgress() {
        const stats = calculateChecklistStats();
        
        // Update progress indicators
        const progressElements = document.querySelectorAll('.overall-progress .progress-bar');
        progressElements.forEach(bar => {
            bar.style.width = `${stats.completionPercentage}%`;
            bar.style.background = getProgressColor(stats.completionPercentage);
        });
    }

    // Setup event listeners
    function setupEventListeners() {
        // Listen to data changes
        TripCore.on('dataChanged', () => {
            if (TripTabs.getCurrentTab() === 'checklist') {
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

        // Category management
        switchCategory,
        resetCategory,

        // Item management
        toggleItem,
        addCustomItem,
        editItem,
        removeItem,
        assignItem,

        // Filtering
        updateFilter,

        // Tools
        manageGroup,
        manageTemplates,
        exportChecklist,
        setupReminders,
        shareCategory,

        // Bulk actions
        markAllCompleted,
        markAllPending,
        resetAllChecklists,

        // Data
        checklistTemplates,
        CHECKLIST_CATEGORIES,
        PRIORITY_LEVELS,
        calculateChecklistStats
    };
})();