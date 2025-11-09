/**
 * Trip Manager - Bookings Management
 * Version: 1.0.0
 * Handles bookings, reservations, and travel documents
 */

window.TripBookings = (function() {
    'use strict';

    // Booking status types
    const BOOKING_STATUS = {
        CONFIRMED: 'confirmed',
        PENDING: 'pending',
        CANCELLED: 'cancelled',
        COMPLETED: 'completed',
        EXPIRED: 'expired'
    };

    // Document types
    const DOCUMENT_TYPES = {
        BOOKING: 'booking',
        TICKET: 'ticket',
        PASSPORT: 'passport',
        VISA: 'visa',
        INSURANCE: 'insurance',
        VACCINATION: 'vaccination',
        OTHER: 'other'
    };

    // Booking filters
    let bookingFilter = {
        type: '',
        status: '',
        dateRange: '',
        sortBy: 'date',
        sortOrder: 'asc'
    };

    // File upload state
    let uploadedFiles = [];

    function init() {
        console.log('TripBookings: Initializing...');
        
        render();
        setupEventListeners();
        setupFileUpload();
        
        console.log('TripBookings: Initialized successfully');
    }

    // Render bookings tab
    function render() {
        renderBookingsOverview();
        renderBookingsList();
        renderDocumentsSection();
        renderBookingTools();
    }

    // Update bookings display
    function update() {
        renderBookingsOverview();
        renderBookingsList();
        renderDocumentsSection();
        checkUpcomingBookings();
    }

    // Render bookings overview
    function renderBookingsOverview() {
        const container = TripUtils.getElement('bookingsContainer');
        if (!container) return;

        const stats = calculateBookingStats();
        const upcomingBookings = getUpcomingBookings(3);
        
        container.innerHTML = `
            <div class="bookings-overview">
                <div class="booking-stats">
                    <div class="stat-card">
                        <div class="stat-icon">🎫</div>
                        <div class="stat-content">
                            <div class="stat-number">${stats.totalBookings}</div>
                            <div class="stat-label">Tổng booking</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">✅</div>
                        <div class="stat-content">
                            <div class="stat-number">${stats.confirmedBookings}</div>
                            <div class="stat-label">Đã xác nhận</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">⏰</div>
                        <div class="stat-content">
                            <div class="stat-number">${stats.upcomingBookings}</div>
                            <div class="stat-label">Sắp tới</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">💰</div>
                        <div class="stat-content">
                            <div class="stat-number">${TripUtils.formatMoney(stats.totalAmount)}</div>
                            <div class="stat-label">Tổng chi phí</div>
                        </div>
                    </div>
                </div>

                ${upcomingBookings.length > 0 ? `
                    <div class="upcoming-bookings">
                        <h4>⏰ Booking Sắp Tới</h4>
                        <div class="upcoming-list">
                            ${upcomingBookings.map(booking => renderUpcomingBooking(booking)).join('')}
                        </div>
                    </div>
                ` : ''}

                <div class="booking-actions">
                    <button class="btn" onclick="TripBookings.addBooking()">
                        ➕ Thêm Booking
                    </button>
                    <button class="btn btn-secondary" onclick="TripBookings.importFromEmail()">
                        📧 Import từ Email
                    </button>
                    <button class="btn btn-secondary" onclick="TripBookings.scanQRCode()">
                        📱 Quét QR Code
                    </button>
                </div>
            </div>
        `;
    }

    // Render bookings list
    function renderBookingsList() {
        const container = TripUtils.getElement('bookingsContainer');
        if (!container) return;

        const tripData = TripCore.getData();
        let bookings = [...(tripData.bookings || [])];
        
        // Apply filters
        bookings = applyBookingFilters(bookings);

        const bookingsSection = `
            <div class="bookings-section">
                <div class="section-header">
                    <h3>📋 Danh Sách Booking</h3>
                </div>

                ${renderBookingFilters()}

                <div class="bookings-list">
                    ${bookings.length > 0 ? 
                        bookings.map(booking => renderBookingCard(booking)).join('') :
                        '<div class="empty-bookings">Chưa có booking nào</div>'
                    }
                </div>
            </div>
        `;

        container.innerHTML += bookingsSection;
    }

    // Render booking filters
    function renderBookingFilters() {
        const bookingTypes = TripCore.getBookingTypes();
        
        return `
            <div class="booking-filters">
                <div class="filter-row">
                    <div class="filter-group">
                        <select class="form-control" onchange="TripBookings.updateFilter('type', this.value)">
                            <option value="">Tất cả loại</option>
                            ${Object.entries(bookingTypes).map(([key, type]) => 
                                `<option value="${key}" ${bookingFilter.type === key ? 'selected' : ''}>${type.name}</option>`
                            ).join('')}
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <select class="form-control" onchange="TripBookings.updateFilter('status', this.value)">
                            <option value="">Tất cả trạng thái</option>
                            <option value="confirmed" ${bookingFilter.status === 'confirmed' ? 'selected' : ''}>Đã xác nhận</option>
                            <option value="pending" ${bookingFilter.status === 'pending' ? 'selected' : ''}>Chờ xác nhận</option>
                            <option value="cancelled" ${bookingFilter.status === 'cancelled' ? 'selected' : ''}>Đã hủy</option>
                            <option value="completed" ${bookingFilter.status === 'completed' ? 'selected' : ''}>Hoàn thành</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <select class="form-control" onchange="TripBookings.updateFilter('dateRange', this.value)">
                            <option value="">Tất cả thời gian</option>
                            <option value="upcoming" ${bookingFilter.dateRange === 'upcoming' ? 'selected' : ''}>Sắp tới</option>
                            <option value="past" ${bookingFilter.dateRange === 'past' ? 'selected' : ''}>Đã qua</option>
                            <option value="today" ${bookingFilter.dateRange === 'today' ? 'selected' : ''}>Hôm nay</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <select class="form-control" onchange="TripBookings.updateSort(this.value)">
                            <option value="date_asc" ${bookingFilter.sortBy === 'date' && bookingFilter.sortOrder === 'asc' ? 'selected' : ''}>Ngày (sớm nhất)</option>
                            <option value="date_desc" ${bookingFilter.sortBy === 'date' && bookingFilter.sortOrder === 'desc' ? 'selected' : ''}>Ngày (muộn nhất)</option>
                            <option value="amount_desc" ${bookingFilter.sortBy === 'amount' && bookingFilter.sortOrder === 'desc' ? 'selected' : ''}>Giá tiền (cao)</option>
                            <option value="amount_asc" ${bookingFilter.sortBy === 'amount' && bookingFilter.sortOrder === 'asc' ? 'selected' : ''}>Giá tiền (thấp)</option>
                        </select>
                    </div>
                    
                    <button class="btn btn-small btn-secondary" onclick="TripBookings.clearFilters()">
                        🔄 Xóa bộ lọc
                    </button>
                </div>
            </div>
        `;
    }

    // Render booking card
    function renderBookingCard(booking) {
        const bookingTypes = TripCore.getBookingTypes();
        const type = bookingTypes[booking.type] || { name: 'Khác', icon: '📋', color: '#607d8b' };
        const status = getBookingStatus(booking);
        const timeInfo = getBookingTimeInfo(booking);
        
        return `
            <div class="booking-card ${status.class}" data-booking-id="${booking.id}">
                <div class="booking-header">
                    <div class="booking-type">
                        <span class="type-icon" style="color: ${type.color};">${type.icon}</span>
                        <span class="type-name">${type.name}</span>
                    </div>
                    <div class="booking-status">
                        <span class="status-badge status-${status.key}">${status.text}</span>
                    </div>
                </div>

                <div class="booking-content">
                    <h4 class="booking-title">${booking.title}</h4>
                    
                    <div class="booking-details">
                        <div class="detail-row">
                            <span class="detail-label">📅 Ngày giờ:</span>
                            <span class="detail-value">${TripUtils.formatDateTime(booking.date)}</span>
                        </div>
                        
                        ${booking.location ? `
                            <div class="detail-row">
                                <span class="detail-label">📍 Địa điểm:</span>
                                <span class="detail-value">${booking.location}</span>
                            </div>
                        ` : ''}
                        
                        ${booking.confirmationCode ? `
                            <div class="detail-row">
                                <span class="detail-label">🎫 Mã xác nhận:</span>
                                <span class="detail-value booking-code">${booking.confirmationCode}</span>
                                <button class="btn btn-small" onclick="TripBookings.copyCode('${booking.confirmationCode}')">📋</button>
                            </div>
                        ` : ''}
                        
                        ${booking.amount ? `
                            <div class="detail-row">
                                <span class="detail-label">💰 Giá tiền:</span>
                                <span class="detail-value">${TripUtils.formatMoney(booking.amount)}</span>
                            </div>
                        ` : ''}
                        
                        ${timeInfo ? `
                            <div class="detail-row time-info ${timeInfo.urgency}">
                                <span class="detail-label">⏰ Thời gian:</span>
                                <span class="detail-value">${timeInfo.text}</span>
                            </div>
                        ` : ''}
                        
                        ${booking.notes ? `
                            <div class="detail-row">
                                <span class="detail-label">📝 Ghi chú:</span>
                                <span class="detail-value">${booking.notes}</span>
                            </div>
                        ` : ''}
                    </div>

                    ${booking.documents && booking.documents.length > 0 ? `
                        <div class="booking-documents">
                            <span class="detail-label">📎 Tài liệu:</span>
                            <div class="document-list">
                                ${booking.documents.map(doc => `
                                    <a href="${doc.url}" target="_blank" class="document-link">
                                        ${getDocumentIcon(doc.type)} ${doc.name}
                                    </a>
                                `).join('')}
                            </div>
                        </div>
                    ` : ''}
                </div>

                <div class="booking-actions">
                    <button class="btn btn-small" onclick="TripBookings.editBooking('${booking.id}')">
                        ✏️ Sửa
                    </button>
                    <button class="btn btn-small" onclick="TripBookings.addDocument('${booking.id}')">
                        📎 Thêm tài liệu
                    </button>
                    ${status.key === 'confirmed' ? `
                        <button class="btn btn-small" onclick="TripBookings.setReminder('${booking.id}')">
                            ⏰ Nhắc nhở
                        </button>
                    ` : ''}
                    <button class="btn btn-small btn-danger" onclick="TripBookings.removeBooking('${booking.id}')">
                        🗑️ Xóa
                    </button>
                </div>
            </div>
        `;
    }

    // Render upcoming booking
    function renderUpcomingBooking(booking) {
        const bookingTypes = TripCore.getBookingTypes();
        const type = bookingTypes[booking.type] || { icon: '📋' };
        const timeUntil = getTimeUntilBooking(booking);
        
        return `
            <div class="upcoming-booking-item" onclick="TripBookings.viewBooking('${booking.id}')">
                <div class="upcoming-icon">${type.icon}</div>
                <div class="upcoming-content">
                    <div class="upcoming-title">${booking.title}</div>
                    <div class="upcoming-time">${timeUntil}</div>
                </div>
                <div class="upcoming-date">${TripUtils.formatDate(booking.date)}</div>
            </div>
        `;
    }

    // Render documents section
    function renderDocumentsSection() {
        const container = TripUtils.getElement('bookingsContainer');
        if (!container) return;

        const tripData = TripCore.getData();
        const documents = getAllDocuments();
        
        const documentsSection = `
            <div class="documents-section">
                <div class="section-header">
                    <h3>📁 Tài Liệu Chuyến Đi</h3>
                    <button class="btn btn-small" onclick="TripBookings.uploadDocument()">
                        📤 Upload tài liệu
                    </button>
                </div>

                <div class="document-categories">
                    ${Object.entries(DOCUMENT_TYPES).map(([key, type]) => 
                        renderDocumentCategory(key, type, documents.filter(doc => doc.type === key))
                    ).join('')}
                </div>

                ${documents.length === 0 ? `
                    <div class="empty-documents">
                        <p>Chưa có tài liệu nào</p>
                        <button class="btn" onclick="TripBookings.uploadDocument()">
                            📤 Upload tài liệu đầu tiên
                        </button>
                    </div>
                ` : ''}
            </div>
        `;

        container.innerHTML += documentsSection;
    }

    // Render document category
    function renderDocumentCategory(key, type, documents) {
        if (documents.length === 0) return '';
        
        const categoryNames = {
            booking: '🎫 Booking',
            ticket: '🎟️ Vé',
            passport: '📘 Hộ chiếu',
            visa: '📋 Visa',
            insurance: '🛡️ Bảo hiểm',
            vaccination: '💉 Chứng nhận tiêm chủng',
            other: '📄 Khác'
        };
        
        return `
            <div class="document-category">
                <h4>${categoryNames[key] || key}</h4>
                <div class="document-grid">
                    ${documents.map(doc => renderDocumentItem(doc)).join('')}
                </div>
            </div>
        `;
    }

    // Render document item
    function renderDocumentItem(document) {
        return `
            <div class="document-item" data-document-id="${document.id}">
                <div class="document-icon">${getDocumentIcon(document.type)}</div>
                <div class="document-info">
                    <div class="document-name">${document.name}</div>
                    <div class="document-meta">
                        ${document.size ? `${TripUtils.formatFileSize(document.size)} • ` : ''}
                        ${TripUtils.formatDate(document.uploadedAt)}
                    </div>
                </div>
                <div class="document-actions">
                    <button class="btn btn-small" onclick="TripBookings.viewDocument('${document.id}')">👁️</button>
                    <button class="btn btn-small" onclick="TripBookings.downloadDocument('${document.id}')">⬇️</button>
                    <button class="btn btn-small btn-danger" onclick="TripBookings.removeDocument('${document.id}')">🗑️</button>
                </div>
            </div>
        `;
    }

    // Render booking tools
    function renderBookingTools() {
        const container = TripUtils.getElement('bookingsContainer');
        if (!container) return;

        const toolsSection = `
            <div class="booking-tools">
                <h3>🛠️ Công Cụ Hỗ Trợ</h3>
                <div class="tools-grid">
                    <div class="tool-card">
                        <h4>📊 Báo Cáo Booking</h4>
                        <p>Xuất báo cáo tổng hợp các booking</p>
                        <button class="btn" onclick="TripBookings.exportBookings()">Xuất báo cáo</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>📅 Đồng Bộ Lịch</h4>
                        <p>Đồng bộ booking với Google Calendar</p>
                        <button class="btn" onclick="TripBookings.syncToCalendar()">Đồng bộ</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>📱 Tạo QR Code</h4>
                        <p>Tạo QR code cho các booking</p>
                        <button class="btn" onclick="TripBookings.generateQRCodes()">Tạo QR</button>
                    </div>
                </div>
            </div>
        `;

        container.innerHTML += toolsSection;
    }

    // Add booking
    function addBooking() {
        TripModals.openModal('bookingModal');
    }

    // Add booking from modal
    function addBooking(data) {
        const booking = {
            id: TripUtils.generateId(),
            type: data.type,
            title: data.title,
            date: data.date,
            location: data.location || '',
            confirmationCode: data.confirmationCode || '',
            amount: parseFloat(data.amount) || 0,
            notes: data.notes || '',
            status: BOOKING_STATUS.CONFIRMED,
            documents: [],
            reminders: [],
            createdAt: TripUtils.getCurrentDateTime()
        };

        // Add to trip data
        const tripData = TripCore.getData();
        if (!tripData.bookings) {
            tripData.bookings = [];
        }
        tripData.bookings.push(booking);
        
        // Sort by date
        tripData.bookings.sort((a, b) => new Date(a.date) - new Date(b.date));
        
        TripCore.saveData();
        update();
        
        // Emit event
        TripCore.emit('bookingAdded', booking);
        
        TripNotifications.showSuccess(`Đã thêm booking: ${booking.title}!`);
        return true;
    }

    // Edit booking
    function editBooking(bookingId) {
        const tripData = TripCore.getData();
        const booking = tripData.bookings?.find(b => b.id === bookingId);
        
        if (!booking) {
            TripNotifications.showError('Không tìm thấy booking!');
            return;
        }

        TripModals.openModal('bookingModal', booking);
    }

    // Remove booking
    function removeBooking(bookingId) {
        if (!confirm('Bạn có chắc chắn muốn xóa booking này?')) {
            return;
        }

        const tripData = TripCore.getData();
        if (!tripData.bookings) return;
        
        const bookingIndex = tripData.bookings.findIndex(b => b.id === bookingId);
        if (bookingIndex === -1) {
            TripNotifications.showError('Không tìm thấy booking!');
            return;
        }

        const booking = tripData.bookings[bookingIndex];
        tripData.bookings.splice(bookingIndex, 1);
        TripCore.saveData();

        update();
        TripNotifications.showSuccess(`Đã xóa booking: ${booking.title}!`);
    }

    // View booking details
    function viewBooking(bookingId) {
        const tripData = TripCore.getData();
        const booking = tripData.bookings?.find(b => b.id === bookingId);
        
        if (!booking) return;

        // Scroll to booking card
        const bookingCard = document.querySelector(`[data-booking-id="${bookingId}"]`);
        if (bookingCard) {
            bookingCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
            bookingCard.classList.add('highlight');
            setTimeout(() => bookingCard.classList.remove('highlight'), 2000);
        }
    }

    // Copy confirmation code
    function copyCode(code) {
        TripUtils.copyToClipboard(code).then(() => {
            TripNotifications.showSuccess('Đã copy mã xác nhận!');
        }).catch(() => {
            TripNotifications.showError('Không thể copy mã xác nhận!');
        });
    }

    // Add document to booking
    function addDocument(bookingId) {
        // Open file picker
        const input = document.createElement('input');
        input.type = 'file';
        input.multiple = true;
        input.accept = '.pdf,.jpg,.jpeg,.png,.doc,.docx';
        
        input.onchange = (e) => {
            const files = Array.from(e.target.files);
            uploadDocuments(files, bookingId);
        };
        
        input.click();
    }

    // Upload document
    function uploadDocument() {
        const input = document.createElement('input');
        input.type = 'file';
        input.multiple = true;
        input.accept = '.pdf,.jpg,.jpeg,.png,.doc,.docx';
        
        input.onchange = (e) => {
            const files = Array.from(e.target.files);
            uploadDocuments(files);
        };
        
        input.click();
    }

    // Upload documents
    function uploadDocuments(files, bookingId = null) {
        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const document = {
                    id: TripUtils.generateId(),
                    name: file.name,
                    type: detectDocumentType(file.name),
                    size: file.size,
                    content: e.target.result,
                    uploadedAt: TripUtils.getCurrentDateTime()
                };
                
                const tripData = TripCore.getData();
                
                if (bookingId) {
                    // Add to specific booking
                    const booking = tripData.bookings?.find(b => b.id === bookingId);
                    if (booking) {
                        if (!booking.documents) booking.documents = [];
                        booking.documents.push(document);
                    }
                } else {
                    // Add to general documents
                    if (!tripData.documents) tripData.documents = [];
                    tripData.documents.push(document);
                }
                
                TripCore.saveData();
                update();
                TripNotifications.showSuccess(`Đã upload: ${file.name}`);
            };
            reader.readAsDataURL(file);
        });
    }

    // Detect document type from filename
    function detectDocumentType(filename) {
        const lower = filename.toLowerCase();
        
        if (lower.includes('booking') || lower.includes('reservation')) {
            return DOCUMENT_TYPES.BOOKING;
        } else if (lower.includes('ticket') || lower.includes('ve')) {
            return DOCUMENT_TYPES.TICKET;
        } else if (lower.includes('passport') || lower.includes('ho_chieu')) {
            return DOCUMENT_TYPES.PASSPORT;
        } else if (lower.includes('visa')) {
            return DOCUMENT_TYPES.VISA;
        } else if (lower.includes('insurance') || lower.includes('bao_hiem')) {
            return DOCUMENT_TYPES.INSURANCE;
        } else if (lower.includes('vaccination') || lower.includes('vaccine')) {
            return DOCUMENT_TYPES.VACCINATION;
        }
        
        return DOCUMENT_TYPES.OTHER;
    }

    // Get all documents
    function getAllDocuments() {
        const tripData = TripCore.getData();
        const documents = [];
        
        // General documents
        if (tripData.documents) {
            documents.push(...tripData.documents);
        }
        
        // Documents from bookings
        if (tripData.bookings) {
            tripData.bookings.forEach(booking => {
                if (booking.documents) {
                    documents.push(...booking.documents);
                }
            });
        }
        
        return documents.sort((a, b) => new Date(b.uploadedAt) - new Date(a.uploadedAt));
    }

    // Get document icon
    function getDocumentIcon(type) {
        const icons = {
            [DOCUMENT_TYPES.BOOKING]: '🎫',
            [DOCUMENT_TYPES.TICKET]: '🎟️',
            [DOCUMENT_TYPES.PASSPORT]: '📘',
            [DOCUMENT_TYPES.VISA]: '📋',
            [DOCUMENT_TYPES.INSURANCE]: '🛡️',
            [DOCUMENT_TYPES.VACCINATION]: '💉',
            [DOCUMENT_TYPES.OTHER]: '📄'
        };
        return icons[type] || '📄';
    }

    // Calculate booking statistics
    function calculateBookingStats() {
        const tripData = TripCore.getData();
        const bookings = tripData.bookings || [];
        
        const totalBookings = bookings.length;
        const confirmedBookings = bookings.filter(b => b.status === BOOKING_STATUS.CONFIRMED).length;
        const upcomingBookings = getUpcomingBookings().length;
        const totalAmount = bookings.reduce((sum, b) => sum + (b.amount || 0), 0);
        
        return {
            totalBookings,
            confirmedBookings,
            upcomingBookings,
            totalAmount
        };
    }

    // Get upcoming bookings
    function getUpcomingBookings(limit = null) {
        const tripData = TripCore.getData();
        const bookings = tripData.bookings || [];
        const now = new Date();
        
        const upcoming = bookings
            .filter(booking => new Date(booking.date) > now)
            .sort((a, b) => new Date(a.date) - new Date(b.date));
        
        return limit ? upcoming.slice(0, limit) : upcoming;
    }

    // Get booking status
    function getBookingStatus(booking) {
        const now = new Date();
        const bookingDate = new Date(booking.date);
        
        if (booking.status === BOOKING_STATUS.CANCELLED) {
            return { key: 'cancelled', text: 'Đã hủy', class: 'cancelled' };
        }
        
        if (bookingDate < now) {
            return { key: 'completed', text: 'Hoàn thành', class: 'completed' };
        }
        
        const hoursUntil = (bookingDate - now) / (1000 * 60 * 60);
        
        if (hoursUntil <= 24) {
            return { key: 'urgent', text: 'Sắp tới', class: 'urgent' };
        }
        
        return { key: 'confirmed', text: 'Đã xác nhận', class: 'confirmed' };
    }

    // Get booking time info
    function getBookingTimeInfo(booking) {
        const now = new Date();
        const bookingDate = new Date(booking.date);
        const diff = bookingDate - now;
        
        if (diff < 0) {
            return { text: 'Đã qua', urgency: 'past' };
        }
        
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        
        if (days > 0) {
            return { 
                text: `Còn ${days} ngày${hours > 0 ? ` ${hours} giờ` : ''}`, 
                urgency: days <= 1 ? 'urgent' : 'normal' 
            };
        } else if (hours > 0) {
            return { text: `Còn ${hours} giờ`, urgency: 'urgent' };
        } else {
            return { text: 'Sắp diễn ra', urgency: 'urgent' };
        }
    }

    // Get time until booking
    function getTimeUntilBooking(booking) {
        const now = new Date();
        const bookingDate = new Date(booking.date);
        const diff = bookingDate - now;
        
        if (diff < 0) return 'Đã qua';
        
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        
        if (days > 0) {
            return `${days} ngày`;
        } else if (hours > 0) {
            return `${hours} giờ`;
        } else {
            return 'Sắp tới';
        }
    }

    // Apply booking filters
    function applyBookingFilters(bookings) {
        return bookings.filter(booking => {
            // Type filter
            if (bookingFilter.type && booking.type !== bookingFilter.type) {
                return false;
            }
            
            // Status filter
            if (bookingFilter.status) {
                const status = getBookingStatus(booking);
                if (status.key !== bookingFilter.status) {
                    return false;
                }
            }
            
            // Date range filter
            if (bookingFilter.dateRange) {
                const now = new Date();
                const bookingDate = new Date(booking.date);
                
                switch (bookingFilter.dateRange) {
                    case 'upcoming':
                        if (bookingDate <= now) return false;
                        break;
                    case 'past':
                        if (bookingDate > now) return false;
                        break;
                    case 'today':
                        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                        const tomorrow = new Date(today);
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        if (bookingDate < today || bookingDate >= tomorrow) return false;
                        break;
                }
            }
            
            return true;
        }).sort((a, b) => {
            let valueA, valueB;
            
            switch (bookingFilter.sortBy) {
                case 'amount':
                    valueA = a.amount || 0;
                    valueB = b.amount || 0;
                    break;
                case 'date':
                default:
                    valueA = new Date(a.date);
                    valueB = new Date(b.date);
            }
            
            if (bookingFilter.sortOrder === 'asc') {
                return valueA > valueB ? 1 : valueA < valueB ? -1 : 0;
            } else {
                return valueA < valueB ? 1 : valueA > valueB ? -1 : 0;
            }
        });
    }

    // Update filter
    function updateFilter(filterType, value) {
        bookingFilter[filterType] = value;
        update();
    }

    // Update sort
    function updateSort(sortValue) {
        const [sortBy, sortOrder] = sortValue.split('_');
        bookingFilter.sortBy = sortBy;
        bookingFilter.sortOrder = sortOrder;
        update();
    }

    // Clear filters
    function clearFilters() {
        bookingFilter = {
            type: '',
            status: '',
            dateRange: '',
            sortBy: 'date',
            sortOrder: 'asc'
        };
        update();
    }

    // Check upcoming bookings
    function checkUpcomingBookings() {
        const upcomingBookings = getUpcomingBookings();
        const now = new Date();
        
        upcomingBookings.forEach(booking => {
            const bookingDate = new Date(booking.date);
            const hoursUntil = (bookingDate - now) / (1000 * 60 * 60);
            
            // Send notification for bookings within 24 hours
            if (hoursUntil <= 24 && hoursUntil > 23) {
                TripNotifications.show(
                    `Nhắc nhở: ${booking.title} sẽ diễn ra trong 24 giờ nữa`,
                    TripNotifications.TYPES.BOOKING,
                    5000,
                    { persistent: true }
                );
            }
        });
    }

    // Import from email (placeholder)
    function importFromEmail() {
        TripNotifications.showInfo('Tính năng import từ email sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Scan QR code (placeholder)
    function scanQRCode() {
        TripNotifications.showInfo('Tính năng quét QR code sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Set reminder
    function setReminder(bookingId) {
        TripNotifications.showInfo('Tính năng nhắc nhở sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Export bookings
    function exportBookings() {
        const tripData = TripCore.getData();
        const bookings = tripData.bookings || [];
        
        const csvContent = convertBookingsToCSV(bookings);
        const filename = `bookings_${TripUtils.getCurrentDate()}.csv`;
        
        TripUtils.downloadFile(csvContent, filename, 'text/csv');
        TripNotifications.showSuccess('Đã xuất danh sách booking!');
    }

    // Convert bookings to CSV
    function convertBookingsToCSV(bookings) {
        const headers = ['Loại', 'Tiêu đề', 'Ngày giờ', 'Địa điểm', 'Mã xác nhận', 'Giá tiền', 'Trạng thái', 'Ghi chú'];
        const bookingTypes = TripCore.getBookingTypes();
        
        const rows = bookings.map(booking => [
            bookingTypes[booking.type]?.name || booking.type,
            booking.title,
            TripUtils.formatDateTime(booking.date),
            booking.location || '',
            booking.confirmationCode || '',
            booking.amount || 0,
            getBookingStatus(booking).text,
            booking.notes || ''
        ]);

        const csvContent = [headers, ...rows]
            .map(row => row.map(field => `"${field}"`).join(','))
            .join('\n');

        return '\ufeff' + csvContent;
    }

    // Sync to calendar (placeholder)
    function syncToCalendar() {
        TripNotifications.showInfo('Tính năng đồng bộ lịch sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Generate QR codes (placeholder)
    function generateQRCodes() {
        TripNotifications.showInfo('Tính năng tạo QR code sẽ được phát triển trong phiên bản tiếp theo!');
    }

    // Setup file upload
    function setupFileUpload() {
        // File upload functionality setup
    }

    // Setup event listeners
    function setupEventListeners() {
        // Listen to data changes
        TripCore.on('dataChanged', () => {
            if (TripTabs.getCurrentTab() === 'bookings') {
                update();
            }
        });

        // Check upcoming bookings periodically
        setInterval(checkUpcomingBookings, 300000); // Every 5 minutes
    }

    // Public API
    return {
        // Initialization
        init,
        render,
        update,

        // Booking management
        addBooking,
        editBooking,
        removeBooking,
        viewBooking,
        copyCode,

        // Document management
        addDocument,
        uploadDocument,
        viewDocument: (id) => console.log('View document:', id),
        downloadDocument: (id) => console.log('Download document:', id),
        removeDocument: (id) => console.log('Remove document:', id),

        // Filtering and sorting
        updateFilter,
        updateSort,
        clearFilters,

        // Tools
        importFromEmail,
        scanQRCode,
        setReminder,
        exportBookings,
        syncToCalendar,
        generateQRCodes,

        // Data
        BOOKING_STATUS,
        DOCUMENT_TYPES,
        calculateBookingStats,
        getUpcomingBookings
    };
})();