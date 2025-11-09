/**
 * Trip Manager - Modal Management
 * Version: 1.0.0
 * Handles modal dialogs and popup forms
 */

window.TripModals = (function() {
    'use strict';

    // Modal configurations
    const modalConfigs = {
        quickExpenseModal: {
            title: '💳 Thêm Chi Tiêu Nhanh',
            size: 'medium',
            fields: [
                { name: 'category', type: 'select', label: 'Loại chi tiêu', required: true },
                { name: 'amount', type: 'number', label: 'Số tiền (VNĐ)', required: true },
                { name: 'location', type: 'text', label: 'Địa điểm' },
                { name: 'note', type: 'text', label: 'Ghi chú' }
            ],
            submitHandler: 'TripExpenses.addQuickExpense'
        },
        expenseModal: {
            title: '💰 Thêm Chi Tiêu Chi Tiết',
            size: 'large',
            fields: [
                { name: 'category', type: 'select', label: 'Loại chi tiêu', required: true },
                { name: 'amount', type: 'number', label: 'Số tiền (VNĐ)', required: true },
                { name: 'location', type: 'text', label: 'Địa điểm' },
                { name: 'note', type: 'textarea', label: 'Ghi chú chi tiết' },
                { name: 'date', type: 'datetime-local', label: 'Thời gian', defaultValue: 'now' }
            ],
            submitHandler: 'TripExpenses.addExpense'
        },
        destinationModal: {
            title: '📍 Thêm Điểm Đến',
            size: 'large',
            fields: [
                { name: 'name', type: 'text', label: 'Tên điểm đến', required: true },
                { name: 'category', type: 'select', label: 'Loại điểm đến', required: true },
                { name: 'date', type: 'date', label: 'Ngày đến', required: true },
                { name: 'days', type: 'number', label: 'Số ngày ở lại', defaultValue: 1, min: 1 },
                { name: 'budget', type: 'number', label: 'Ngân sách dự kiến (VNĐ)' },
                { name: 'notes', type: 'textarea', label: 'Ghi chú' },
                { name: 'address', type: 'text', label: 'Địa chỉ' }
            ],
            submitHandler: 'TripDestinations.addDestination'
        },
        bookingModal: {
            title: '🎫 Thêm Vé & Đặt Chỗ',
            size: 'large',
            fields: [
                { name: 'type', type: 'select', label: 'Loại booking', required: true },
                { name: 'title', type: 'text', label: 'Tiêu đề', required: true },
                { name: 'date', type: 'datetime-local', label: 'Ngày giờ', required: true },
                { name: 'location', type: 'text', label: 'Địa điểm' },
                { name: 'confirmationCode', type: 'text', label: 'Mã xác nhận' },
                { name: 'amount', type: 'number', label: 'Giá tiền (VNĐ)' },
                { name: 'notes', type: 'textarea', label: 'Ghi chú' }
            ],
            submitHandler: 'TripBookings.addBooking'
        },
        scheduleModal: {
            title: '📅 Thêm Lịch Trình',
            size: 'large',
            fields: [
                { name: 'title', type: 'text', label: 'Tiêu đề hoạt động', required: true },
                { name: 'date', type: 'date', label: 'Ngày', required: true },
                { name: 'startTime', type: 'time', label: 'Giờ bắt đầu', required: true },
                { name: 'endTime', type: 'time', label: 'Giờ kết thúc' },
                { name: 'location', type: 'text', label: 'Địa điểm' },
                { name: 'category', type: 'select', label: 'Loại hoạt động', required: true },
                { name: 'budget', type: 'number', label: 'Chi phí dự kiến (VNĐ)' },
                { name: 'notes', type: 'textarea', label: 'Ghi chú' }
            ],
            submitHandler: 'TripSchedule.addScheduleItem'
        }
    };

    // Active modals
    let activeModals = new Map();

    function init() {
        console.log('TripModals: Initializing...');
        
        createModalContainer();
        setupEventListeners();
        
        console.log('TripModals: Initialized successfully');
    }

    // Create modal container
    function createModalContainer() {
        let container = document.getElementById('modalsContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'modalsContainer';
            document.body.appendChild(container);
        }
        return container;
    }

    // Open modal
    function openModal(modalId, data = {}) {
        const config = modalConfigs[modalId];
        if (!config) {
            console.error(`Modal configuration not found: ${modalId}`);
            return;
        }

        // Close existing modal if open
        if (activeModals.has(modalId)) {
            closeModal(modalId);
        }

        const modal = createModalElement(modalId, config, data);
        const container = document.getElementById('modalsContainer');
        
        container.appendChild(modal);
        activeModals.set(modalId, modal);

        // Show modal with animation
        setTimeout(() => {
            modal.style.display = 'flex';
            modal.classList.add('fade-in');
        }, 10);

        // Focus first input
        const firstInput = modal.querySelector('.form-control');
        if (firstInput) {
            setTimeout(() => firstInput.focus(), 300);
        }

        // Populate data if provided
        if (Object.keys(data).length > 0) {
            populateModalData(modalId, data);
        }
    }

    // Close modal
    function closeModal(modalId) {
        const modal = activeModals.get(modalId);
        if (!modal) return;

        modal.classList.add('fade-out');
        setTimeout(() => {
            modal.remove();
            activeModals.delete(modalId);
        }, 300);
    }

    // Close all modals
    function closeAllModals() {
        activeModals.forEach((modal, modalId) => {
            closeModal(modalId);
        });
    }

    // Create modal element
    function createModalElement(modalId, config, data) {
        const modal = document.createElement('div');
        modal.className = `modal modal-${config.size || 'medium'}`;
        modal.setAttribute('data-modal-id', modalId);

        const formFields = createFormFields(config.fields, modalId);
        const submitButtonText = getSubmitButtonText(config.title);

        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">${config.title}</h3>
                    <button class="close-btn" onclick="TripModals.closeModal('${modalId}')">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="${modalId}Form" onsubmit="TripModals.handleSubmit(event, '${modalId}')">
                        ${formFields}
                        <div class="modal-actions">
                            <button type="button" class="btn btn-secondary" onclick="TripModals.closeModal('${modalId}')">
                                Hủy
                            </button>
                            <button type="submit" class="btn">
                                ${submitButtonText}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        `;

        return modal;
    }

    // Create form fields
    function createFormFields(fields, modalId) {
        return fields.map(field => {
            const fieldId = `${modalId}_${field.name}`;
            let fieldHtml = '';

            switch (field.type) {
                case 'select':
                    fieldHtml = createSelectField(field, fieldId);
                    break;
                case 'textarea':
                    fieldHtml = createTextareaField(field, fieldId);
                    break;
                case 'datetime-local':
                    fieldHtml = createDateTimeField(field, fieldId);
                    break;
                default:
                    fieldHtml = createInputField(field, fieldId);
            }

            return `
                <div class="form-group">
                    <label for="${fieldId}">
                        ${field.label}
                        ${field.required ? '<span style="color: red;">*</span>' : ''}
                    </label>
                    ${fieldHtml}
                </div>
            `;
        }).join('');
    }

    // Create select field
    function createSelectField(field, fieldId) {
        let options = '';

        if (field.name === 'category') {
            // Determine which categories to use based on modal context
            let categories;
            if (field.label.includes('chi tiêu')) {
                categories = TripCore.getExpenseCategories();
            } else if (field.label.includes('điểm đến')) {
                categories = TripCore.getDestinationCategories();
            } else if (field.label.includes('booking')) {
                categories = TripCore.getBookingTypes();
            } else if (field.label.includes('hoạt động')) {
                categories = getActivityCategories();
            }

            if (categories) {
                options = Object.entries(categories).map(([key, cat]) => 
                    `<option value="${key}">${cat.name}</option>`
                ).join('');
            }
        }

        return `
            <select class="form-control" id="${fieldId}" name="${field.name}" ${field.required ? 'required' : ''}>
                <option value="">Chọn ${field.label.toLowerCase()}...</option>
                ${options}
            </select>
        `;
    }

    // Create textarea field
    function createTextareaField(field, fieldId) {
        return `
            <textarea 
                class="form-control" 
                id="${fieldId}" 
                name="${field.name}" 
                placeholder="${field.placeholder || ''}"
                rows="3"
                ${field.required ? 'required' : ''}
            ></textarea>
        `;
    }

    // Create datetime field
    function createDateTimeField(field, fieldId) {
        let defaultValue = '';
        if (field.defaultValue === 'now') {
            const now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            defaultValue = now.toISOString().slice(0, 16);
        }

        return `
            <input 
                type="datetime-local" 
                class="form-control" 
                id="${fieldId}" 
                name="${field.name}"
                value="${defaultValue}"
                ${field.required ? 'required' : ''}
            />
        `;
    }

    // Create input field
    function createInputField(field, fieldId) {
        const defaultValue = field.defaultValue || '';
        const placeholder = field.placeholder || '';
        
        return `
            <input 
                type="${field.type}" 
                class="form-control" 
                id="${fieldId}" 
                name="${field.name}"
                placeholder="${placeholder}"
                value="${defaultValue}"
                ${field.min ? `min="${field.min}"` : ''}
                ${field.max ? `max="${field.max}"` : ''}
                ${field.required ? 'required' : ''}
            />
        `;
    }

    // Get activity categories
    function getActivityCategories() {
        return {
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
    }

    // Get submit button text
    function getSubmitButtonText(title) {
        if (title.includes('Thêm')) return '✅ Thêm';
        if (title.includes('Sửa')) return '💾 Lưu';
        if (title.includes('Xóa')) return '🗑️ Xóa';
        return '✅ Xác Nhận';
    }

    // Handle form submission
    function handleSubmit(event, modalId) {
        event.preventDefault();
        
        const config = modalConfigs[modalId];
        const form = event.target;
        const formData = new FormData(form);
        
        // Validate form
        if (!validateForm(form, config.fields)) {
            return;
        }

        // Convert form data to object
        const data = {};
        for (let [key, value] of formData.entries()) {
            data[key] = value;
        }

        // Process data
        const processedData = processFormData(data, config.fields);

        // Call submit handler
        try {
            const handlerPath = config.submitHandler.split('.');
            let handler = window;
            
            for (const part of handlerPath) {
                handler = handler[part];
            }

            if (typeof handler === 'function') {
                const result = handler(processedData);
                
                // Close modal on successful submission
                if (result !== false) {
                    closeModal(modalId);
                }
            } else {
                console.error(`Submit handler not found: ${config.submitHandler}`);
            }
        } catch (error) {
            console.error('Error calling submit handler:', error);
            TripNotifications.showError('Có lỗi xảy ra khi xử lý dữ liệu!');
        }
    }

    // Validate form
    function validateForm(form, fields) {
        let isValid = true;
        
        // Clear previous validation
        form.querySelectorAll('.form-control').forEach(input => {
            input.classList.remove('is-invalid');
        });

        // Validate each field
        fields.forEach(field => {
            if (field.required) {
                const input = form.querySelector(`[name="${field.name}"]`);
                if (!input || !input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                }
            }

            // Custom validations
            if (field.type === 'number') {
                const input = form.querySelector(`[name="${field.name}"]`);
                if (input && input.value && parseFloat(input.value) <= 0) {
                    input.classList.add('is-invalid');
                    isValid = false;
                }
            }

            if (field.type === 'email') {
                const input = form.querySelector(`[name="${field.name}"]`);
                if (input && input.value && !TripUtils.isValidEmail(input.value)) {
                    input.classList.add('is-invalid');
                    isValid = false;
                }
            }
        });

        if (!isValid) {
            TripNotifications.showWarning('Vui lòng kiểm tra lại các trường bắt buộc!');
        }

        return isValid;
    }

    // Process form data
    function processFormData(data, fields) {
        const processed = { ...data };

        fields.forEach(field => {
            const value = processed[field.name];

            // Convert numbers
            if (field.type === 'number' && value) {
                processed[field.name] = parseFloat(value) || 0;
            }

            // Process datetime
            if (field.type === 'datetime-local' && value) {
                processed[field.name] = new Date(value).toISOString();
            }

            // Process date
            if (field.type === 'date' && value) {
                processed[field.name] = value;
            }

            // Trim strings
            if (typeof value === 'string') {
                processed[field.name] = value.trim();
            }
        });

        // Add metadata
        processed.id = TripUtils.generateId();
        processed.createdAt = TripUtils.getCurrentDateTime();

        return processed;
    }

    // Populate modal with data
    function populateModalData(modalId, data) {
        const modal = activeModals.get(modalId);
        if (!modal) return;

        Object.entries(data).forEach(([key, value]) => {
            const input = modal.querySelector(`[name="${key}"]`);
            if (input) {
                if (input.type === 'datetime-local' && value) {
                    const date = new Date(value);
                    date.setMinutes(date.getMinutes() - date.getTimezoneOffset());
                    input.value = date.toISOString().slice(0, 16);
                } else {
                    input.value = value || '';
                }
            }
        });
    }

    // Setup event listeners
    function setupEventListeners() {
        // Close modal on outside click
        document.addEventListener('click', (event) => {
            if (event.target.classList.contains('modal')) {
                const modalId = event.target.getAttribute('data-modal-id');
                if (modalId) {
                    closeModal(modalId);
                }
            }
        });

        // Close modal on ESC key
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                const openModal = Array.from(activeModals.keys())[0];
                if (openModal) {
                    closeModal(openModal);
                }
            }
        });

        // Handle form input validation
        document.addEventListener('input', (event) => {
            if (event.target.classList.contains('form-control')) {
                event.target.classList.remove('is-invalid');
            }
        });
    }

    // Add modal styles
    function addModalStyles() {
        if (document.getElementById('modal-styles')) return;

        const style = document.createElement('style');
        style.id = 'modal-styles';
        style.textContent = `
            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.6);
                z-index: 2000;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .modal.fade-in {
                opacity: 1;
            }

            .modal.fade-out {
                opacity: 0;
            }

            .modal-content {
                background: white;
                border-radius: 20px;
                max-width: 90vw;
                max-height: 90vh;
                overflow-y: auto;
                position: relative;
                transform: scale(0.9);
                transition: transform 0.3s ease;
            }

            .modal.fade-in .modal-content {
                transform: scale(1);
            }

            .modal.fade-out .modal-content {
                transform: scale(0.9);
            }

            .modal-medium .modal-content {
                width: 600px;
            }

            .modal-large .modal-content {
                width: 800px;
            }

            .modal-small .modal-content {
                width: 400px;
            }

            .modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 25px 30px 15px 30px;
                border-bottom: 2px solid #f8f9fa;
            }

            .modal-title {
                font-size: 20px;
                font-weight: 600;
                color: #333;
                margin: 0;
            }

            .close-btn {
                background: none;
                border: none;
                font-size: 24px;
                cursor: pointer;
                color: #6c757d;
                padding: 5px;
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                transition: all 0.3s ease;
            }

            .close-btn:hover {
                background: #f8f9fa;
                color: #333;
            }

            .modal-body {
                padding: 25px 30px 30px 30px;
            }

            .modal-actions {
                display: flex;
                gap: 15px;
                justify-content: flex-end;
                margin-top: 25px;
                padding-top: 20px;
                border-top: 1px solid #f1f3f4;
            }

            .modal-actions .btn {
                width: auto;
                min-width: 120px;
            }

            .form-control.is-invalid {
                border-color: #dc3545;
                box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
            }

            .form-control.is-invalid:focus {
                border-color: #dc3545;
                box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2);
            }

            @media (max-width: 768px) {
                .modal-content {
                    width: 95vw !important;
                    margin: 20px;
                }

                .modal-header,
                .modal-body {
                    padding-left: 20px;
                    padding-right: 20px;
                }

                .modal-actions {
                    flex-direction: column;
                }

                .modal-actions .btn {
                    width: 100%;
                }
            }
        `;

        document.head.appendChild(style);
    }

    // Initialize styles
    addModalStyles();

    // Public API
    return {
        // Initialization
        init,

        // Modal management
        openModal,
        closeModal,
        closeAllModals,

        // Form handling
        handleSubmit,
        populateModalData,

        // Utilities
        modalConfigs
    };
})();