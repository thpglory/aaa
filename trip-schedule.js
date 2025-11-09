/**
 * Trip Manager - Schedule Management
 * Version: 1.0.0
 * Handles detailed day-by-day scheduling and time management
 */

window.TripSchedule = (function() {
    'use strict';

    // Schedule view modes
    const VIEW_MODES = {
        TIMELINE: 'timeline',
        CALENDAR: 'calendar',
        LIST: 'list',
        DAY: 'day'
    };

    // Activity categories
    const activityCategories = {
        sightseeing: { name: '🏛️ Tham quan', icon: '🏛️', color: '#f39c12' },
        dining: { name: '🍽️ Ăn uống', icon: '🍽️', color: '#e67e22' },
        shopping: { name: '🛍️ Mua sắm', icon: '🛍️', color: '#e91e63' },
        entertainment: { name: '🎭 Giải trí', icon: '🎭', color: '#9b59b6' },
        transport: { name: '🚗 Di chuyển', icon: '🚗', color: '#3498db' },
        accommodation: { name: '🏨 Lưu trú', icon: '🏨', color: '#2ecc71' },
        meeting: { name: '👥 Họp mặt', icon: '👥', color: '#34495e' },
        rest: { name: '😴 Nghỉ ngơi', icon: '😴', color: '#95a5a6' },
        other: { name: '📝 Khác', icon: '📝', color: '#607d8b' }
    };

    // Current view state
    let currentView = VIEW_MODES.TIMELINE;
    let selectedDate = TripUtils.getCurrentDate();
    let scheduleFilter = {
        category: '',
        location: '',
        completed: 'all'
    };

    // Drag and drop state
    let dragState = {
        isDragging: false,
        draggedItem: null,
        dropTargets: []
    };

    function init() {
        console.log('TripSchedule: Initializing...');
        
        render();
        setupEventListeners();
        
        console.log('TripSchedule: Initialized successfully');
    }

    // Render schedule tab
    function render() {
        renderScheduleHeader();
        renderScheduleContent();
        renderScheduleTools();
    }

    // Update schedule display
    function update() {
        renderScheduleContent();
        updateConflictWarnings();
    }

    // Render schedule header
    function renderScheduleHeader() {
        const container = TripUtils.getElement('scheduleContainer');
        if (!container) return;

        const tripInfo = TripCore.getTripInfo();
        const stats = calculateScheduleStats();

        container.innerHTML = `
            <div class="schedule-header">
                <div class="schedule-overview">
                    <h3>📅 Lịch Trình Chi Tiết</h3>
                    <div class="schedule-summary">
                        <div class="summary-item">
                            <span class="summary-number">${stats.totalActivities}</span>
                            <span class="summary-label">Hoạt động</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-number">${stats.scheduledDays}</span>
                            <span class="summary-label">Ngày có lịch</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-number">${stats.conflicts}</span>
                            <span class="summary-label">Xung đột</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-number">${TripUtils.formatMoney(stats.totalBudget)}</span>
                            <span class="summary-label">Ngân sách</span>
                        </div>
                    </div>
                </div>

                <div class="schedule-controls">
                    <div class="view-switcher">
                        <button class="view-btn ${currentView === VIEW_MODES.TIMELINE ? 'active' : ''}" 
                                onclick="TripSchedule.switchView('${VIEW_MODES.TIMELINE}')">
                            📊 Timeline
                        </button>
                        <button class="view-btn ${currentView === VIEW_MODES.CALENDAR ? 'active' : ''}" 
                                onclick="TripSchedule.switchView('${VIEW_MODES.CALENDAR}')">
                            📅 Calendar
                        </button>
                        <button class="view-btn ${currentView === VIEW_MODES.LIST ? 'active' : ''}" 
                                onclick="TripSchedule.switchView('${VIEW_MODES.LIST}')">
                            📋 Danh sách
                        </button>
                        <button class="view-btn ${currentView === VIEW_MODES.DAY ? 'active' : ''}" 
                                onclick="TripSchedule.switchView('${VIEW_MODES.DAY}')">
                            📆 Theo ngày
                        </button>
                    </div>

                    <div class="schedule-actions">
                        <button class="btn btn-small" onclick="TripSchedule.addActivity()">
                            ➕ Thêm hoạt động
                        </button>
                        <button class="btn btn-small btn-secondary" onclick="TripSchedule.optimizeSchedule()">
                            🎯 Tối ưu hóa
                        </button>
                        <button class="btn btn-small btn-secondary" onclick="TripSchedule.exportSchedule()">
                            📤 Xuất lịch
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    // Render schedule content based on current view
    function renderScheduleContent() {
        const container = TripUtils.getElement('scheduleContainer');
        if (!container) return;

        let contentHtml = '';

        switch (currentView) {
            case VIEW_MODES.TIMELINE:
                contentHtml = renderTimelineView();
                break;
            case VIEW_MODES.CALENDAR:
                contentHtml = renderCalendarView();
                break;
            case VIEW_MODES.LIST:
                contentHtml = renderListView();
                break;
            case VIEW_MODES.DAY:
                contentHtml = renderDayView();
                break;
        }

        // Append content to existing header
        const existingHeader = container.querySelector('.schedule-header');
        const contentContainer = document.createElement('div');
        contentContainer.className = 'schedule-content';
        contentContainer.innerHTML = contentHtml;

        // Remove existing content
        const existingContent = container.querySelector('.schedule-content');
        if (existingContent) {
            existingContent.remove();
        }

        container.appendChild(contentContainer);

        // Setup drag and drop
        setupDragAndDrop();
    }

    // Render timeline view
    function renderTimelineView() {
        const schedule = getGroupedSchedule();
        
        return `
            <div class="timeline-schedule">
                ${renderScheduleFilters()}
                <div class="timeline-days">
                    ${Object.entries(schedule).map(([date, activities]) => 
                        renderTimelineDay(date, activities)
                    ).join('')}
                </div>
                ${Object.keys(schedule).length === 0 ? 
                    '<div class="empty-schedule">Chưa có hoạt động nào được lên lịch</div>' : ''
                }
            </div>
        `;
    }

    // Render timeline day
    function renderTimelineDay(date, activities) {
        const dayName = new Date(date).toLocaleDateString('vi-VN', { weekday: 'long' });
        const formattedDate = TripUtils.formatDate(date);
        const dayStats = calculateDayStats(activities);
        
        return `
            <div class="timeline-day" data-date="${date}">
                <div class="day-header">
                    <div class="day-info">
                        <h4>${dayName}</h4>
                        <p>${formattedDate}</p>
                    </div>
                    <div class="day-stats">
                        <span class="activity-count">${activities.length} hoạt động</span>
                        <span class="day-duration">${dayStats.totalDuration}h</span>
                        <span class="day-budget">${TripUtils.formatMoney(dayStats.totalBudget)}</span>
                    </div>
                    <div class="day-actions">
                        <button class="btn btn-small" onclick="TripSchedule.addActivityToDay('${date}')">
                            ➕ Thêm
                        </button>
                    </div>
                </div>
                
                <div class="day-timeline">
                    <div class="timeline-hours">
                        ${generateTimelineHours()}
                    </div>
                    <div class="timeline-activities" data-date="${date}">
                        ${activities.map(activity => renderTimelineActivity(activity)).join('')}
                    </div>
                </div>
                
                ${dayStats.conflicts.length > 0 ? renderDayConflicts(dayStats.conflicts) : ''}
            </div>
        `;
    }

    // Render calendar view
    function renderCalendarView() {
        const today = new Date();
        const currentMonth = today.getMonth();
        const currentYear = today.getFullYear();
        
        return `
            <div class="calendar-schedule">
                ${renderScheduleFilters()}
                <div class="calendar-header">
                    <button class="btn btn-small" onclick="TripSchedule.previousMonth()">‹</button>
                    <h3>${getMonthName(currentMonth)} ${currentYear}</h3>
                    <button class="btn btn-small" onclick="TripSchedule.nextMonth()">›</button>
                </div>
                <div class="calendar-grid">
                    ${renderCalendarGrid(currentYear, currentMonth)}
                </div>
            </div>
        `;
    }

    // Render list view
    function renderListView() {
        const tripData = TripCore.getData();
        const activities = tripData.schedule || [];
        const filteredActivities = applyScheduleFilters(activities);
        
        return `
            <div class="list-schedule">
                ${renderScheduleFilters()}
                <div class="activities-list">
                    ${filteredActivities.length > 0 ? 
                        filteredActivities.map(activity => renderListActivity(activity)).join('') :
                        '<div class="empty-schedule">Không có hoạt động nào phù hợp với bộ lọc</div>'
                    }
                </div>
            </div>
        `;
    }

    // Render day view
    function renderDayView() {
        const dayActivities = getDayActivities(selectedDate);
        const dayStats = calculateDayStats(dayActivities);
        
        return `
            <div class="day-schedule">
                <div class="day-selector">
                    <button class="btn btn-small" onclick="TripSchedule.previousDay()">‹ Hôm trước</button>
                    <input type="date" 
                           class="form-control day-picker" 
                           value="${selectedDate}" 
                           onchange="TripSchedule.selectDate(this.value)">
                    <button class="btn btn-small" onclick="TripSchedule.nextDay()">Hôm sau ›</button>
                </div>
                
                <div class="day-overview">
                    <h3>${TripUtils.formatDate(selectedDate)}</h3>
                    <div class="day-summary">
                        <span>${dayActivities.length} hoạt động</span>
                        <span>${dayStats.totalDuration}h</span>
                        <span>${TripUtils.formatMoney(dayStats.totalBudget)}</span>
                    </div>
                </div>
                
                <div class="day-detail">
                    ${renderDaySchedule(selectedDate, dayActivities)}
                </div>
                
                <div class="day-tools">
                    <button class="btn" onclick="TripSchedule.addActivityToDay('${selectedDate}')">
                        ➕ Thêm hoạt động
                    </button>
                    <button class="btn btn-secondary" onclick="TripSchedule.duplicateDay('${selectedDate}')">
                        📋 Sao chép ngày
                    </button>
                </div>
            </div>
        `;
    }

    // Render schedule filters
    function renderScheduleFilters() {
        return `
            <div class="schedule-filters">
                <div class="filter-group">
                    <select class="form-control" onchange="TripSchedule.updateFilter('category', this.value)">
                        <option value="">Tất cả danh mục</option>
                        ${Object.entries(activityCategories).map(([key, cat]) => 
                            `<option value="${key}" ${scheduleFilter.category === key ? 'selected' : ''}>${cat.name}</option>`
                        ).join('')}
                    </select>
                </div>
                <div class="filter-group">
                    <input type="text" 
                           class="form-control" 
                           placeholder="Tìm theo địa điểm..." 
                           value="${scheduleFilter.location}"
                           oninput="TripSchedule.updateFilter('location', this.value)">
                </div>
                <div class="filter-group">
                    <select class="form-control" onchange="TripSchedule.updateFilter('completed', this.value)">
                        <option value="all" ${scheduleFilter.completed === 'all' ? 'selected' : ''}>Tất cả</option>
                        <option value="pending" ${scheduleFilter.completed === 'pending' ? 'selected' : ''}>Chưa hoàn thành</option>
                        <option value="completed" ${scheduleFilter.completed === 'completed' ? 'selected' : ''}>Đã hoàn thành</option>
                    </select>
                </div>
                <button class="btn btn-small btn-secondary" onclick="TripSchedule.clearFilters()">
                    🔄 Xóa bộ lọc
                </button>
            </div>
        `;
    }

    // Render schedule tools
    function renderScheduleTools() {
        // Tools are rendered in the header
    }

    // Add new activity
    function addActivity() {
        TripModals.openModal('scheduleModal');
    }

    // Add activity to specific day
    function addActivityToDay(date) {
        TripModals.openModal('scheduleModal', { date: date });
    }

    // Add schedule item (from modal)
    function addScheduleItem(data) {
        const activity = {
            id: TripUtils.generateId(),
            title: data.title,
            date: data.date,
            startTime: data.startTime,
            endTime: data.endTime,
            category: data.category,
            location: data.location || '',
            budget: parseFloat(data.budget) || 0,
            notes: data.notes || '',
            completed: false,
            createdAt: TripUtils.getCurrentDateTime()
        };

        // Validate time conflict
        if (hasTimeConflict(activity)) {
            const confirm = window.confirm('Hoạt động này có xung đột thời gian với hoạt động khác. Bạn có muốn tiếp tục?');
            if (!confirm) return false;
        }

        // Add to trip data
        const tripData = TripCore.getData();
        if (!tripData.schedule) {
            tripData.schedule = [];
        }
        tripData.schedule.push(activity);
        
        // Sort by date and time
        tripData.schedule.sort((a, b) => {
            const dateCompare = new Date(a.date) - new Date(b.date);
            if (dateCompare !== 0) return dateCompare;
            return (a.startTime || '').localeCompare(b.startTime || '');
        });
        
        TripCore.saveData();
        update();
        
        TripNotifications.showSuccess(`Đã thêm hoạt động: ${activity.title}!`);
        return true;
    }

    // Edit activity
    function editActivity(activityId) {
        const tripData = TripCore.getData();
        const activity = tripData.schedule?.find(act => act.id === activityId);
        
        if (!activity) {
            TripNotifications.showError('Không tìm thấy hoạt động!');
            return;
        }

        TripModals.openModal('scheduleModal', activity);
    }

    // Remove activity
    function removeActivity(activityId) {
        if (!confirm('Bạn có chắc chắn muốn xóa hoạt động này?')) {
            return;
        }

        const tripData = TripCore.getData();
        if (!tripData.schedule) return;
        
        const activityIndex = tripData.schedule.findIndex(act => act.id === activityId);
        if (activityIndex === -1) {
            TripNotifications.showError('Không tìm thấy hoạt động!');
            return;
        }

        const activity = tripData.schedule[activityIndex];
        tripData.schedule.splice(activityIndex, 1);
        TripCore.saveData();

        update();
        TripNotifications.showSuccess(`Đã xóa hoạt động: ${activity.title}!`);
    }

    // Toggle activity completion
    function toggleActivityCompletion(activityId) {
        const tripData = TripCore.getData();
        const activity = tripData.schedule?.find(act => act.id === activityId);
        
        if (!activity) return;

        activity.completed = !activity.completed;
        activity.completedAt = activity.completed ? TripUtils.getCurrentDateTime() : null;
        
        TripCore.saveData();
        update();
        
        const message = activity.completed ? 
            `Đã hoàn thành: ${activity.title}` : 
            `Đã hủy hoàn thành: ${activity.title}`;
        TripNotifications.showSuccess(message);
    }

    // Switch view mode
    function switchView(viewMode) {
        if (Object.values(VIEW_MODES).includes(viewMode)) {
            currentView = viewMode;
            render();
        }
    }

    // Update filter
    function updateFilter(filterType, value) {
        scheduleFilter[filterType] = value;
        update();
    }

    // Clear filters
    function clearFilters() {
        scheduleFilter = {
            category: '',
            location: '',
            completed: 'all'
        };
        update();
    }

    // Select date for day view
    function selectDate(date) {
        selectedDate = date;
        if (currentView === VIEW_MODES.DAY) {
            update();
        }
    }

    // Navigate days
    function previousDay() {
        const date = new Date(selectedDate);
        date.setDate(date.getDate() - 1);
        selectDate(date.toISOString().split('T')[0]);
    }

    function nextDay() {
        const date = new Date(selectedDate);
        date.setDate(date.getDate() + 1);
        selectDate(date.toISOString().split('T')[0]);
    }

    // Get grouped schedule by date
    function getGroupedSchedule() {
        const tripData = TripCore.getData();
        const activities = tripData.schedule || [];
        const filteredActivities = applyScheduleFilters(activities);
        
        const grouped = {};
        filteredActivities.forEach(activity => {
            if (!grouped[activity.date]) {
                grouped[activity.date] = [];
            }
            grouped[activity.date].push(activity);
        });
        
        // Sort dates
        const sortedDates = Object.keys(grouped).sort();
        const sortedGrouped = {};
        sortedDates.forEach(date => {
            sortedGrouped[date] = grouped[date].sort((a, b) => 
                (a.startTime || '').localeCompare(b.startTime || '')
            );
        });
        
        return sortedGrouped;
    }

    // Get activities for specific day
    function getDayActivities(date) {
        const tripData = TripCore.getData();
        const activities = tripData.schedule || [];
        
        return activities
            .filter(activity => activity.date === date)
            .sort((a, b) => (a.startTime || '').localeCompare(b.startTime || ''));
    }

    // Apply schedule filters
    function applyScheduleFilters(activities) {
        return activities.filter(activity => {
            // Category filter
            if (scheduleFilter.category && activity.category !== scheduleFilter.category) {
                return false;
            }
            
            // Location filter
            if (scheduleFilter.location && 
                !activity.location.toLowerCase().includes(scheduleFilter.location.toLowerCase())) {
                return false;
            }
            
            // Completion filter
            if (scheduleFilter.completed === 'completed' && !activity.completed) {
                return false;
            }
            if (scheduleFilter.completed === 'pending' && activity.completed) {
                return false;
            }
            
            return true;
        });
    }

    // Calculate schedule statistics
    function calculateScheduleStats() {
        const tripData = TripCore.getData();
        const activities = tripData.schedule || [];
        
        const totalActivities = activities.length;
        const scheduledDays = new Set(activities.map(act => act.date)).size;
        const totalBudget = activities.reduce((sum, act) => sum + (act.budget || 0), 0);
        const conflicts = findTimeConflicts(activities).length;
        
        return {
            totalActivities,
            scheduledDays,
            totalBudget,
            conflicts
        };
    }

    // Calculate day statistics
    function calculateDayStats(activities) {
        const totalBudget = activities.reduce((sum, act) => sum + (act.budget || 0), 0);
        
        let totalDuration = 0;
        activities.forEach(activity => {
            if (activity.startTime && activity.endTime) {
                const start = parseTime(activity.startTime);
                const end = parseTime(activity.endTime);
                if (end > start) {
                    totalDuration += (end - start) / 60; // Convert to hours
                }
            }
        });
        
        const conflicts = findTimeConflicts(activities);
        
        return {
            totalBudget,
            totalDuration: totalDuration.toFixed(1),
            conflicts
        };
    }

    // Check for time conflicts
    function hasTimeConflict(newActivity) {
        const tripData = TripCore.getData();
        const dayActivities = (tripData.schedule || [])
            .filter(act => act.date === newActivity.date && act.id !== newActivity.id);
        
        if (!newActivity.startTime || !newActivity.endTime) return false;
        
        const newStart = parseTime(newActivity.startTime);
        const newEnd = parseTime(newActivity.endTime);
        
        return dayActivities.some(activity => {
            if (!activity.startTime || !activity.endTime) return false;
            
            const actStart = parseTime(activity.startTime);
            const actEnd = parseTime(activity.endTime);
            
            return (newStart < actEnd && newEnd > actStart);
        });
    }

    // Find time conflicts
    function findTimeConflicts(activities) {
        const conflicts = [];
        const dayGroups = {};
        
        // Group by date
        activities.forEach(activity => {
            if (!dayGroups[activity.date]) {
                dayGroups[activity.date] = [];
            }
            dayGroups[activity.date].push(activity);
        });
        
        // Check conflicts within each day
        Object.values(dayGroups).forEach(dayActivities => {
            for (let i = 0; i < dayActivities.length; i++) {
                for (let j = i + 1; j < dayActivities.length; j++) {
                    const act1 = dayActivities[i];
                    const act2 = dayActivities[j];
                    
                    if (!act1.startTime || !act1.endTime || !act2.startTime || !act2.endTime) continue;
                    
                    const start1 = parseTime(act1.startTime);
                    const end1 = parseTime(act1.endTime);
                    const start2 = parseTime(act2.startTime);
                    const end2 = parseTime(act2.endTime);
                    
                    if (start1 < end2 && end1 > start2) {
                        conflicts.push({ activity1: act1, activity2: act2 });
                    }
                }
            }
        });
        
        return conflicts;
    }

    // Parse time string to minutes
    function parseTime(timeString) {
        const [hours, minutes] = timeString.split(':').map(Number);
        return hours * 60 + minutes;
    }

    // Format time from minutes
    function formatTime(minutes) {
        const hours = Math.floor(minutes / 60);
        const mins = minutes % 60;
        return `${hours.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}`;
    }

    // Render timeline activity
    function renderTimelineActivity(activity) {
        const category = activityCategories[activity.category] || activityCategories.other;
        const duration = calculateActivityDuration(activity);
        
        return `
            <div class="timeline-activity ${activity.completed ? 'completed' : ''}" 
                 data-activity-id="${activity.id}"
                 draggable="true">
                <div class="activity-time">
                    ${activity.startTime || ''}${activity.endTime ? ` - ${activity.endTime}` : ''}
                    ${duration ? ` (${duration}h)` : ''}
                </div>
                <div class="activity-content">
                    <div class="activity-header">
                        <span class="activity-category" style="color: ${category.color};">
                            ${category.icon}
                        </span>
                        <span class="activity-title">${activity.title}</span>
                        <div class="activity-actions">
                            <button class="btn btn-small" onclick="TripSchedule.toggleActivityCompletion('${activity.id}')">
                                ${activity.completed ? '✅' : '⭕'}
                            </button>
                            <button class="btn btn-small" onclick="TripSchedule.editActivity('${activity.id}')">✏️</button>
                            <button class="btn btn-small btn-danger" onclick="TripSchedule.removeActivity('${activity.id}')">🗑️</button>
                        </div>
                    </div>
                    ${activity.location ? `<div class="activity-location">📍 ${activity.location}</div>` : ''}
                    ${activity.budget ? `<div class="activity-budget">💰 ${TripUtils.formatMoney(activity.budget)}</div>` : ''}
                    ${activity.notes ? `<div class="activity-notes">${activity.notes}</div>` : ''}
                </div>
            </div>
        `;
    }

    // Calculate activity duration
    function calculateActivityDuration(activity) {
        if (!activity.startTime || !activity.endTime) return null;
        
        const start = parseTime(activity.startTime);
        const end = parseTime(activity.endTime);
        
        if (end > start) {
            return ((end - start) / 60).toFixed(1);
        }
        
        return null;
    }

    // Generate timeline hours
    function generateTimelineHours() {
        let hours = '';
        for (let h = 6; h <= 23; h++) {
            hours += `<div class="timeline-hour">${h.toString().padStart(2, '0')}:00</div>`;
        }
        return hours;
    }

    // Render list activity
    function renderListActivity(activity) {
        const category = activityCategories[activity.category] || activityCategories.other;
        
        return `
            <div class="list-activity-item ${activity.completed ? 'completed' : ''}" data-activity-id="${activity.id}">
                <div class="activity-info">
                    <h4>
                        <span class="activity-category" style="color: ${category.color};">${category.icon}</span>
                        ${activity.title}
                    </h4>
                    <p>📅 ${TripUtils.formatDate(activity.date)} ${activity.startTime ? `• ⏰ ${activity.startTime}` : ''}${activity.endTime ? ` - ${activity.endTime}` : ''}</p>
                    ${activity.location ? `<p>📍 ${activity.location}</p>` : ''}
                    ${activity.notes ? `<p><em>${activity.notes}</em></p>` : ''}
                </div>
                <div class="activity-actions">
                    ${activity.budget ? `<div class="activity-budget">${TripUtils.formatMoney(activity.budget)}</div>` : ''}
                    <button class="btn btn-small" onclick="TripSchedule.toggleActivityCompletion('${activity.id}')">
                        ${activity.completed ? '✅' : '⭕'}
                    </button>
                    <button class="btn btn-small" onclick="TripSchedule.editActivity('${activity.id}')">✏️</button>
                    <button class="btn btn-small btn-danger" onclick="TripSchedule.removeActivity('${activity.id}')">🗑️</button>
                </div>
            </div>
        `;
    }

    // Optimize schedule
    function optimizeSchedule() {
        TripNotifications.showInfo('Tính năng tối ưu hóa lịch trình sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Export schedule
    function exportSchedule() {
        const tripData = TripCore.getData();
        const activities = tripData.schedule || [];
        
        const csvContent = convertScheduleToCSV(activities);
        const filename = `lich_trinh_${TripUtils.getCurrentDate()}.csv`;
        
        TripUtils.downloadFile(csvContent, filename, 'text/csv');
        TripNotifications.showSuccess('Đã xuất lịch trình!');
    }

    // Convert schedule to CSV
    function convertScheduleToCSV(activities) {
        const headers = ['Ngày', 'Giờ bắt đầu', 'Giờ kết thúc', 'Hoạt động', 'Danh mục', 'Địa điểm', 'Ngân sách', 'Ghi chú', 'Trạng thái'];
        const rows = activities.map(activity => [
            TripUtils.formatDate(activity.date),
            activity.startTime || '',
            activity.endTime || '',
            activity.title,
            activityCategories[activity.category]?.name.replace(/^.+ /, '') || activity.category,
            activity.location || '',
            activity.budget || 0,
            activity.notes || '',
            activity.completed ? 'Hoàn thành' : 'Chưa hoàn thành'
        ]);

        const csvContent = [headers, ...rows]
            .map(row => row.map(field => `"${field}"`).join(','))
            .join('\n');

        return '\ufeff' + csvContent;
    }

    // Setup drag and drop
    function setupDragAndDrop() {
        const draggableItems = document.querySelectorAll('[draggable="true"]');
        const dropZones = document.querySelectorAll('[data-date]');

        draggableItems.forEach(item => {
            item.addEventListener('dragstart', handleDragStart);
            item.addEventListener('dragend', handleDragEnd);
        });

        dropZones.forEach(zone => {
            zone.addEventListener('dragover', handleDragOver);
            zone.addEventListener('drop', handleDrop);
        });
    }

    // Drag and drop handlers
    function handleDragStart(e) {
        dragState.isDragging = true;
        dragState.draggedItem = e.target.dataset.activityId;
        e.target.style.opacity = '0.5';
    }

    function handleDragEnd(e) {
        dragState.isDragging = false;
        dragState.draggedItem = null;
        e.target.style.opacity = '1';
    }

    function handleDragOver(e) {
        e.preventDefault();
    }

    function handleDrop(e) {
        e.preventDefault();
        
        if (!dragState.draggedItem) return;
        
        const newDate = e.currentTarget.dataset.date;
        if (!newDate) return;
        
        moveActivityToDate(dragState.draggedItem, newDate);
    }

    // Move activity to new date
    function moveActivityToDate(activityId, newDate) {
        const tripData = TripCore.getData();
        const activity = tripData.schedule?.find(act => act.id === activityId);
        
        if (!activity) return;
        
        const oldDate = activity.date;
        activity.date = newDate;
        
        TripCore.saveData();
        update();
        
        TripNotifications.showSuccess(`Đã chuyển "${activity.title}" từ ${TripUtils.formatDate(oldDate)} sang ${TripUtils.formatDate(newDate)}`);
    }

    // Setup event listeners
    function setupEventListeners() {
        // Listen to data changes
        TripCore.on('dataChanged', () => {
            if (TripTabs.getCurrentTab() === 'schedule') {
                update();
            }
        });
    }

    // Helper functions
    function getMonthName(month) {
        const months = [
            'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
            'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
        ];
        return months[month];
    }

    function renderCalendarGrid(year, month) {
        // Calendar implementation would go here
        return '<div class="calendar-placeholder">Calendar view sẽ được implement</div>';
    }

    function renderDaySchedule(date, activities) {
        return activities.map(activity => renderTimelineActivity(activity)).join('');
    }

    function renderDayConflicts(conflicts) {
        return `
            <div class="day-conflicts">
                <h5>⚠️ Xung đột thời gian:</h5>
                ${conflicts.map(conflict => `
                    <div class="conflict-item">
                        "${conflict.activity1.title}" và "${conflict.activity2.title}"
                    </div>
                `).join('')}
            </div>
        `;
    }

    function updateConflictWarnings() {
        // Update conflict warnings in UI
        const tripData = TripCore.getData();
        const conflicts = findTimeConflicts(tripData.schedule || []);
        
        if (conflicts.length > 0) {
            console.log('Schedule conflicts detected:', conflicts);
        }
    }

    // Public API
    return {
        // Initialization
        init,
        render,
        update,

        // Activity management
        addActivity,
        addActivityToDay,
        addScheduleItem,
        editActivity,
        removeActivity,
        toggleActivityCompletion,

        // View management
        switchView,
        selectDate,
        previousDay,
        nextDay,

        // Filtering
        updateFilter,
        clearFilters,

        // Tools
        optimizeSchedule,
        exportSchedule,

        // Data
        activityCategories,
        VIEW_MODES,
        calculateScheduleStats
    };
})();