/**
 * Trip Manager - Destination Management
 * Version: 1.0.0
 * Handles destination planning, categorization, and management
 */

window.TripDestinations = (function() {
    'use strict';

    // Destination filters and sorting
    let currentFilter = {
        category: '',
        status: '',
        sortBy: 'date',
        sortOrder: 'asc'
    };

    // Map integration
    let mapInstance = null;
    let markers = [];

    function init() {
        console.log('TripDestinations: Initializing...');
        
        render();
        setupEventListeners();
        
        console.log('TripDestinations: Initialized successfully');
    }

    // Render destinations tab
    function render() {
        renderDestinationForm();
        renderDestinationList();
        renderDestinationMap();
        renderDestinationStats();
    }

    // Update destinations display
    function update() {
        renderDestinationList();
        renderDestinationStats();
        updateMap();
    }

    // Render destination form
    function renderDestinationForm() {
        const container = TripUtils.getElement('destinationForm');
        if (!container) return;

        const categories = TripCore.getDestinationCategories();
        
        container.innerHTML = `
            <div class="form-grid">
                <div class="form-group">
                    <label>Tên điểm đến <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="destinationName" placeholder="VD: Bangkok, Thái Lan" required>
                </div>
                <div class="form-group">
                    <label>Loại điểm đến <span style="color: red;">*</span></label>
                    <select class="form-control" id="destinationCategory" required>
                        <option value="">Chọn loại điểm đến...</option>
                        ${Object.entries(categories).map(([key, cat]) => 
                            `<option value="${key}">${cat.name}</option>`
                        ).join('')}
                    </select>
                </div>
                <div class="form-group">
                    <label>Ngày đến <span style="color: red;">*</span></label>
                    <input type="date" class="form-control" id="destinationDate" required>
                </div>
                <div class="form-group">
                    <label>Số ngày ở lại</label>
                    <input type="number" class="form-control" id="destinationDays" placeholder="3" min="1" value="1">
                </div>
                <div class="form-group">
                    <label>Ngân sách dự kiến (VNĐ)</label>
                    <input type="number" class="form-control" id="destinationBudget" placeholder="0" min="0" step="100000">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" id="destinationAddress" placeholder="Địa chỉ chi tiết">
                </div>
                <div class="form-group">
                    <label>Tọa độ GPS</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="number" class="form-control" id="destinationLat" placeholder="Vĩ độ" step="0.000001">
                        <input type="number" class="form-control" id="destinationLng" placeholder="Kinh độ" step="0.000001">
                    </div>
                    <button type="button" class="btn btn-secondary btn-small" style="margin-top: 5px;" onclick="TripDestinations.getCurrentLocation()">
                        📍 Lấy vị trí hiện tại
                    </button>
                </div>
                <div class="form-group" style="grid-column: 1/-1;">
                    <label>Ghi chú</label>
                    <textarea class="form-control" id="destinationNotes" placeholder="Thông tin thêm, hoạt động dự kiến..." rows="3"></textarea>
                </div>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button class="btn" onclick="TripDestinations.addDestination()">📍 Thêm Điểm Đến</button>
                <button class="btn btn-secondary" onclick="TripDestinations.clearForm()">🔄 Xóa Form</button>
                <button class="btn btn-secondary" onclick="TripDestinations.suggestNearby()">💡 Gợi Ý Gần Đây</button>
            </div>
        `;
    }

    // Render destination list
    function renderDestinationList() {
        const container = TripUtils.getElement('destinationList');
        if (!container) return;

        const tripData = TripCore.getData();
        let destinations = [...tripData.destinations];

        // Apply filters
        destinations = applyFilters(destinations);

        // Apply sorting
        destinations = applySorting(destinations);

        container.innerHTML = `
            ${renderDestinationFilters()}
            <div class="destinations-grid">
                ${destinations.length > 0 ? 
                    destinations.map(destination => renderDestinationCard(destination)).join('') :
                    '<p style="text-align: center; color: #6c757d; padding: 40px; grid-column: 1/-1;">Chưa có điểm đến nào.</p>'
                }
            </div>
        `;
    }

    // Render destination filters
    function renderDestinationFilters() {
        const categories = TripCore.getDestinationCategories();
        
        return `
            <div class="destination-filters" style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                <h4>Bộ Lọc Điểm Đến</h4>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Loại điểm đến</label>
                        <select class="form-control" onchange="TripDestinations.updateFilter('category', this.value)">
                            <option value="">Tất cả</option>
                            ${Object.entries(categories).map(([key, cat]) => 
                                `<option value="${key}" ${currentFilter.category === key ? 'selected' : ''}>${cat.name}</option>`
                            ).join('')}
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control" onchange="TripDestinations.updateFilter('status', this.value)">
                            <option value="">Tất cả</option>
                            <option value="upcoming" ${currentFilter.status === 'upcoming' ? 'selected' : ''}>Sắp tới</option>
                            <option value="current" ${currentFilter.status === 'current' ? 'selected' : ''}>Hiện tại</option>
                            <option value="completed" ${currentFilter.status === 'completed' ? 'selected' : ''}>Đã đi</option>
                            <option value="checkedin" ${currentFilter.status === 'checkedin' ? 'selected' : ''}>Đã check-in</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sắp xếp</label>
                        <select class="form-control" onchange="TripDestinations.updateSort(this.value)">
                            <option value="date_asc" ${currentFilter.sortBy === 'date' && currentFilter.sortOrder === 'asc' ? 'selected' : ''}>Ngày đến (sớm nhất)</option>
                            <option value="date_desc" ${currentFilter.sortBy === 'date' && currentFilter.sortOrder === 'desc' ? 'selected' : ''}>Ngày đến (muộn nhất)</option>
                            <option value="name_asc" ${currentFilter.sortBy === 'name' && currentFilter.sortOrder === 'asc' ? 'selected' : ''}>Tên A-Z</option>
                            <option value="name_desc" ${currentFilter.sortBy === 'name' && currentFilter.sortOrder === 'desc' ? 'selected' : ''}>Tên Z-A</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-secondary btn-small" onclick="TripDestinations.clearFilters()">🔄 Xóa Bộ Lọc</button>
                    </div>
                </div>
            </div>
        `;
    }

    // Render destination card
    function renderDestinationCard(destination) {
        const categories = TripCore.getDestinationCategories();
        const category = categories[destination.category] || { name: '📍 Khác', icon: '📍', color: '#607d8b' };
        const status = getDestinationStatus(destination);
        const statusInfo = getStatusInfo(status, destination);

        return `
            <div class="destination-card" style="border-left-color: ${category.color};" data-destination-id="${destination.id}">
                <div class="destination-header">
                    <div class="destination-category" style="color: ${category.color};">
                        ${category.icon} ${category.name.replace(category.icon + ' ', '')}
                    </div>
                    <div class="destination-status">
                        <span class="status-badge status-${destination.checkedIn ? 'checkedin' : status}">
                            ${statusInfo.text}
                        </span>
                    </div>
                </div>
                
                <h3 class="destination-name">${destination.name}</h3>
                
                <div class="destination-info">
                    <p><strong>📅 Ngày đến:</strong> ${TripUtils.formatDate(destination.date)}</p>
                    <p><strong>⏰ Thời gian:</strong> ${destination.days} ngày (${TripUtils.formatDate(destination.date)} - ${TripUtils.formatDate(TripUtils.addDays(destination.date, destination.days - 1))})</p>
                    ${destination.budget ? `<p><strong>💰 Ngân sách:</strong> ${TripUtils.formatMoney(destination.budget)}</p>` : ''}
                    ${destination.address ? `<p><strong>📍 Địa chỉ:</strong> ${destination.address}</p>` : ''}
                    ${destination.notes ? `<p><strong>📝 Ghi chú:</strong> ${destination.notes}</p>` : ''}
                    ${destination.checkedIn ? `<p><strong>✅ Check-in:</strong> ${TripUtils.formatDateTime(destination.checkedIn)}</p>` : ''}
                    ${destination.checkedOut ? `<p><strong>🚪 Check-out:</strong> ${TripUtils.formatDateTime(destination.checkedOut)}</p>` : ''}
                </div>

                <div class="destination-actions">
                    ${getDestinationActionButtons(destination, status)}
                    <button class="btn btn-small" onclick="TripDestinations.editDestination('${destination.id}')">✏️ Sửa</button>
                    <button class="btn btn-small btn-danger" onclick="TripDestinations.removeDestination('${destination.id}')">🗑️ Xóa</button>
                </div>
                
                ${destination.coordinates ? `
                    <div class="destination-map-preview">
                        <button class="btn btn-small" onclick="TripDestinations.showOnMap('${destination.id}')">
                            🗺️ Xem trên bản đồ
                        </button>
                    </div>
                ` : ''}
            </div>
        `;
    }

    // Render destination statistics
    function renderDestinationStats() {
        const tripData = TripCore.getData();
        const destinations = tripData.destinations;
        
        const totalDestinations = destinations.length;
        const completedDestinations = destinations.filter(d => d.checkedOut).length;
        const checkedInDestinations = destinations.filter(d => d.checkedIn && !d.checkedOut).length;
        const upcomingDestinations = destinations.filter(d => getDestinationStatus(d) === 'upcoming').length;
        const totalBudget = destinations.reduce((sum, d) => sum + (d.budget || 0), 0);

        // Could display this in a stats widget
        console.log('Destination Stats:', {
            totalDestinations,
            completedDestinations,
            checkedInDestinations,
            upcomingDestinations,
            totalBudget
        });
    }

    // Render destination map
    function renderDestinationMap() {
        // Placeholder for map integration
        // Could integrate with Google Maps, OpenStreetMap, etc.
        console.log('Rendering destination map...');
    }

    // Add destination
    function addDestination() {
        const name = TripUtils.getElement('destinationName')?.value;
        const category = TripUtils.getElement('destinationCategory')?.value;
        const date = TripUtils.getElement('destinationDate')?.value;
        const days = parseInt(TripUtils.getElement('destinationDays')?.value) || 1;
        const budget = parseFloat(TripUtils.getElement('destinationBudget')?.value) || 0;
        const address = TripUtils.getElement('destinationAddress')?.value;
        const notes = TripUtils.getElement('destinationNotes')?.value;
        const lat = parseFloat(TripUtils.getElement('destinationLat')?.value);
        const lng = parseFloat(TripUtils.getElement('destinationLng')?.value);

        if (!name || !category || !date) {
            TripNotifications.showWarning('Vui lòng nhập đầy đủ thông tin bắt buộc!');
            return false;
        }

        const destination = {
            id: TripUtils.generateId(),
            name: name,
            category: category,
            date: date,
            days: days,
            budget: budget,
            address: address || '',
            notes: notes || '',
            coordinates: (lat && lng) ? { lat, lng } : null,
            status: getDestinationStatus({ date }),
            createdAt: TripUtils.getCurrentDateTime()
        };

        // Add to trip data
        const tripData = TripCore.getData();
        tripData.destinations.push(destination);
        
        // Sort destinations by date
        tripData.destinations.sort((a, b) => new Date(a.date) - new Date(b.date));
        
        TripCore.saveData();

        // Clear form
        clearForm();

        // Update display
        update();

        // Emit event
        TripCore.emit('destinationAdded', destination);

        TripNotifications.showSuccess(`Đã thêm điểm đến: ${destination.name}!`);
        return true;
    }

    // Edit destination
    function editDestination(destinationId) {
        const tripData = TripCore.getData();
        const destination = tripData.destinations.find(dest => dest.id === destinationId);
        
        if (!destination) {
            TripNotifications.showError('Không tìm thấy điểm đến!');
            return;
        }

        // Populate form with destination data
        populateForm(destination);
    }

    // Remove destination
    function removeDestination(destinationId) {
        if (!confirm('Bạn có chắc chắn muốn xóa điểm đến này?')) {
            return;
        }

        const tripData = TripCore.getData();
        const destinationIndex = tripData.destinations.findIndex(dest => dest.id === destinationId);
        
        if (destinationIndex === -1) {
            TripNotifications.showError('Không tìm thấy điểm đến!');
            return;
        }

        const destination = tripData.destinations[destinationIndex];
        tripData.destinations.splice(destinationIndex, 1);
        TripCore.saveData();

        update();
        TripNotifications.showSuccess(`Đã xóa điểm đến: ${destination.name}!`);
    }

    // Clear form
    function clearForm() {
        const fields = [
            'destinationName', 'destinationCategory', 'destinationDate', 'destinationDays',
            'destinationBudget', 'destinationAddress', 'destinationNotes',
            'destinationLat', 'destinationLng'
        ];
        
        fields.forEach(fieldId => {
            const field = TripUtils.getElement(fieldId);
            if (field) {
                if (field.type === 'number' && fieldId === 'destinationDays') {
                    field.value = '1';
                } else {
                    field.value = '';
                }
            }
        });
    }

    // Populate form with destination data
    function populateForm(destination) {
        const fieldMapping = {
            'destinationName': destination.name,
            'destinationCategory': destination.category,
            'destinationDate': destination.date,
            'destinationDays': destination.days,
            'destinationBudget': destination.budget,
            'destinationAddress': destination.address,
            'destinationNotes': destination.notes,
            'destinationLat': destination.coordinates?.lat,
            'destinationLng': destination.coordinates?.lng
        };

        Object.entries(fieldMapping).forEach(([fieldId, value]) => {
            const field = TripUtils.getElement(fieldId);
            if (field && value !== undefined) {
                field.value = value;
            }
        });
    }

    // Get current location
    function getCurrentLocation() {
        if (!navigator.geolocation) {
            TripNotifications.showError('Trình duyệt không hỗ trợ GPS!');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                TripUtils.getElement('destinationLat').value = lat.toFixed(6);
                TripUtils.getElement('destinationLng').value = lng.toFixed(6);
                
                TripNotifications.showSuccess('Đã lấy vị trí hiện tại!');
            },
            (error) => {
                TripNotifications.showError('Không thể lấy vị trí: ' + error.message);
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 300000
            }
        );
    }

    // Suggest nearby places
    function suggestNearby() {
        TripNotifications.showInfo('Tính năng gợi ý điểm đến gần đây sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Show destination on map
    function showOnMap(destinationId) {
        const tripData = TripCore.getData();
        const destination = tripData.destinations.find(dest => dest.id === destinationId);
        
        if (!destination || !destination.coordinates) {
            TripNotifications.showWarning('Điểm đến chưa có tọa độ GPS!');
            return;
        }

        // Open Google Maps or other map service
        const url = `https://www.google.com/maps?q=${destination.coordinates.lat},${destination.coordinates.lng}`;
        window.open(url, '_blank');
    }

    // Get destination status
    function getDestinationStatus(destination) {
        if (!destination.date) return 'upcoming';
        
        try {
            const today = new Date();
            const destDate = new Date(destination.date);
            
            if (isNaN(destDate.getTime())) return 'upcoming';
            
            const daysDiff = Math.ceil((destDate - today) / (1000 * 60 * 60 * 24));
            
            if (daysDiff < 0) return 'completed';
            if (daysDiff === 0) return 'current';
            return 'upcoming';
        } catch (error) {
            console.error('Error in getDestinationStatus:', error);
            return 'upcoming';
        }
    }

    // Get status info
    function getStatusInfo(status, destination) {
        if (destination.checkedIn && !destination.checkedOut) {
            return { text: 'Đang ở đây', color: '#28a745' };
        } else if (destination.checkedOut) {
            return { text: 'Đã hoàn thành', color: '#6c757d' };
        }

        switch (status) {
            case 'upcoming':
                return { text: 'Sắp tới', color: '#ffc107' };
            case 'current':
                return { text: 'Hôm nay', color: '#28a745' };
            case 'completed':
                return { text: 'Đã qua', color: '#6c757d' };
            default:
                return { text: 'Không xác định', color: '#6c757d' };
        }
    }

    // Get destination action buttons
    function getDestinationActionButtons(destination, status) {
        const today = new Date();
        const destDate = new Date(destination.date);
        
        let buttons = '';

        // Check-in button
        if (!destination.checkedIn && destDate <= today) {
            buttons += `<button class="btn btn-small checkin-btn" onclick="TripTimeline.checkInDestination('${destination.id}')">📍 Check-in</button>`;
        }

        // Check-out button
        if (destination.checkedIn && !destination.checkedOut) {
            buttons += `<button class="btn btn-small checkout-btn" onclick="TripTimeline.checkOutDestination('${destination.id}')">🚪 Check-out</button>`;
        }

        // Add expense button for current location
        if (destination.checkedIn && !destination.checkedOut) {
            buttons += `<button class="btn btn-small" onclick="TripDestinations.addLocationExpense('${destination.id}')">💳 Chi tiêu</button>`;
        }

        return buttons;
    }

    // Add expense for location
    function addLocationExpense(destinationId) {
        const tripData = TripCore.getData();
        const destination = tripData.destinations.find(dest => dest.id === destinationId);
        
        if (destination) {
            TripModals.openModal('quickExpenseModal', { location: destination.name });
        }
    }

    // Apply filters
    function applyFilters(destinations) {
        let filtered = [...destinations];

        // Category filter
        if (currentFilter.category) {
            filtered = filtered.filter(dest => dest.category === currentFilter.category);
        }

        // Status filter
        if (currentFilter.status) {
            if (currentFilter.status === 'checkedin') {
                filtered = filtered.filter(dest => dest.checkedIn && !dest.checkedOut);
            } else {
                filtered = filtered.filter(dest => getDestinationStatus(dest) === currentFilter.status);
            }
        }

        return filtered;
    }

    // Apply sorting
    function applySorting(destinations) {
        return destinations.sort((a, b) => {
            let valueA, valueB;
            
            switch (currentFilter.sortBy) {
                case 'name':
                    valueA = a.name.toLowerCase();
                    valueB = b.name.toLowerCase();
                    break;
                case 'date':
                default:
                    valueA = new Date(a.date);
                    valueB = new Date(b.date);
            }

            if (currentFilter.sortOrder === 'asc') {
                return valueA > valueB ? 1 : valueA < valueB ? -1 : 0;
            } else {
                return valueA < valueB ? 1 : valueA > valueB ? -1 : 0;
            }
        });
    }

    // Update filter
    function updateFilter(filterType, value) {
        currentFilter[filterType] = value;
        update();
    }

    // Update sort
    function updateSort(sortValue) {
        const [sortBy, sortOrder] = sortValue.split('_');
        currentFilter.sortBy = sortBy;
        currentFilter.sortOrder = sortOrder;
        update();
    }

    // Clear filters
    function clearFilters() {
        currentFilter = {
            category: '',
            status: '',
            sortBy: 'date',
            sortOrder: 'asc'
        };
        update();
    }

    // Update map
    function updateMap() {
        // Placeholder for map update functionality
        console.log('Updating destination map...');
    }

    // Setup event listeners
    function setupEventListeners() {
        // Listen to data changes
        TripCore.on('dataChanged', () => {
            if (TripTabs.getCurrentTab() === 'destinations') {
                update();
            }
        });
    }

    // Add destination styles
    function addDestinationStyles() {
        if (document.getElementById('destination-styles')) return;

        const style = document.createElement('style');
        style.id = 'destination-styles';
        style.textContent = `
            .destinations-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 20px;
            }

            .destination-card {
                background: white;
                border-radius: 15px;
                padding: 20px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
                border-left: 5px solid #667eea;
                transition: all 0.3s ease;
                position: relative;
            }

            .destination-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            }

            .destination-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
            }

            .destination-category {
                font-size: 14px;
                font-weight: 600;
            }

            .destination-status {
                font-size: 12px;
            }

            .destination-name {
                font-size: 18px;
                font-weight: 600;
                color: #333;
                margin-bottom: 15px;
            }

            .destination-info {
                margin-bottom: 20px;
            }

            .destination-info p {
                margin-bottom: 8px;
                font-size: 14px;
                color: #6c757d;
            }

            .destination-actions {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
                margin-bottom: 15px;
            }

            .destination-map-preview {
                border-top: 1px solid #f1f3f4;
                padding-top: 15px;
            }

            .checkin-btn {
                background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
                color: white;
            }

            .checkout-btn {
                background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
                color: white;
            }

            @media (max-width: 768px) {
                .destinations-grid {
                    grid-template-columns: 1fr;
                }
                
                .destination-actions {
                    justify-content: center;
                }
            }
        `;

        document.head.appendChild(style);
    }

    // Initialize styles
    addDestinationStyles();

    // Public API
    return {
        // Initialization
        init,
        render,
        update,

        // Destination management
        addDestination,
        editDestination,
        removeDestination,
        clearForm,

        // Location services
        getCurrentLocation,
        suggestNearby,
        showOnMap,
        addLocationExpense,

        // Filtering and sorting
        updateFilter,
        updateSort,
        clearFilters,

        // Utilities
        getDestinationStatus,
        getStatusInfo
    };
})();