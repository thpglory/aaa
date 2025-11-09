/**
 * Trip Manager - Core Data Management
 * Version: 1.0.0
 * Handles data storage, trip data structure, and core functionality
 */

window.TripCore = (function() {
    'use strict';

    // Default trip data structure
    const defaultTripData = {
        name: 'Du lịch Đông Nam Á 2024',
        startDate: '',
        endDate: '',
        plannedBudget: 0,
        destinations: [],
        expenses: [],
        bookings: [],
        checklist: {
            packing: [],
            todo: [],
            documents: []
        },
        schedule: [],
        settings: {
            currency: 'VND',
            timezone: 'Asia/Ho_Chi_Minh',
            language: 'vi-VN',
            notifications: true,
            autoBackup: true
        },
        currentLocation: null,
        metadata: {
            version: '1.0.0',
            createdAt: '',
            updatedAt: '',
            lastBackup: ''
        }
    };

    // Current trip data
    let tripData = TripUtils.deepClone(defaultTripData);

    // Expense categories configuration
    const expenseCategories = {
        flight: { name: '✈️ Vé máy bay', icon: '✈️', color: '#e74c3c' },
        train: { name: '🚄 Vé tàu', icon: '🚄', color: '#3498db' },
        bus: { name: '🚌 Vé xe buýt', icon: '🚌', color: '#9b59b6' },
        taxi: { name: '🚕 Taxi/Grab', icon: '🚕', color: '#f39c12' },
        hotel: { name: '🏨 Khách sạn', icon: '🏨', color: '#2ecc71' },
        food: { name: '🍽️ Ăn uống', icon: '🍽️', color: '#e67e22' },
        shopping: { name: '🛍️ Mua sắm', icon: '🛍️', color: '#e91e63' },
        attraction: { name: '🎡 Vé tham quan', icon: '🎡', color: '#673ab7' },
        entertainment: { name: '🎭 Giải trí', icon: '🎭', color: '#ff5722' },
        medical: { name: '💊 Y tế', icon: '💊', color: '#4caf50' },
        communication: { name: '📱 Liên lạc', icon: '📱', color: '#607d8b' },
        insurance: { name: '🛡️ Bảo hiểm', icon: '🛡️', color: '#795548' },
        other: { name: '📝 Chi phí khác', icon: '📝', color: '#607d8b' }
    };

    // Booking types configuration
    const bookingTypes = {
        flight: { name: '✈️ Chuyến bay', icon: '✈️', color: '#e74c3c' },
        hotel: { name: '🏨 Khách sạn', icon: '🏨', color: '#2ecc71' },
        train: { name: '🚄 Tàu hỏa', icon: '🚄', color: '#3498db' },
        bus: { name: '🚌 Xe buýt', icon: '🚌', color: '#9b59b6' },
        car: { name: '🚗 Thuê xe', icon: '🚗', color: '#f39c12' },
        tour: { name: '🗺️ Tour', icon: '🗺️', color: '#16a085' },
        event: { name: '🎫 Sự kiện', icon: '🎫', color: '#8e44ad' },
        restaurant: { name: '🍽️ Nhà hàng', icon: '🍽️', color: '#e67e22' },
        activity: { name: '🎡 Hoạt động', icon: '🎡', color: '#673ab7' },
        other: { name: '📋 Khác', icon: '📋', color: '#34495e' }
    };

    // Destination categories
    const destinationCategories = {
        city: { name: '🏙️ Thành phố', icon: '🏙️', color: '#3498db' },
        beach: { name: '🏖️ Bãi biển', icon: '🏖️', color: '#1abc9c' },
        mountain: { name: '⛰️ Núi', icon: '⛰️', color: '#27ae60' },
        cultural: { name: '🏛️ Di tích', icon: '🏛️', color: '#f39c12' },
        nature: { name: '🌳 Thiên nhiên', icon: '🌳', color: '#2ecc71' },
        adventure: { name: '🧗 Phiêu lưu', icon: '🧗', color: '#e74c3c' },
        relaxation: { name: '🧘 Nghỉ dưỡng', icon: '🧘', color: '#9b59b6' },
        shopping: { name: '🛍️ Mua sắm', icon: '🛍️', color: '#e91e63' },
        nightlife: { name: '🌃 Đêm thành phố', icon: '🌃', color: '#8e44ad' },
        food: { name: '🍜 Ẩm thực', icon: '🍜', color: '#e67e22' }
    };

    // Events and observers
    const eventListeners = {
        dataChanged: [],
        tripUpdated: [],
        expenseAdded: [],
        destinationAdded: [],
        bookingAdded: []
    };

    // Storage keys
    const STORAGE_KEYS = {
        TRIP_DATA: 'tripData_v1',
        SETTINGS: 'tripSettings_v1',
        BACKUP: 'tripBackup_v1'
    };

    // Initialize core
    function init() {
        console.log('TripCore: Initializing...');
        
        loadData();
        setupAutoSave();
        
        // Set creation date if not exists
        if (!tripData.metadata.createdAt) {
            tripData.metadata.createdAt = TripUtils.getCurrentDateTime();
            saveData();
        }
        
        console.log('TripCore: Initialized successfully');
    }

    // Data Management
    function loadData() {
        try {
            const saved = localStorage.getItem(STORAGE_KEYS.TRIP_DATA);
            if (saved) {
                const parsed = JSON.parse(saved);
                tripData = { ...defaultTripData, ...parsed };
                
                // Ensure all required properties exist
                tripData.checklist = { ...defaultTripData.checklist, ...tripData.checklist };
                tripData.settings = { ...defaultTripData.settings, ...tripData.settings };
                tripData.metadata = { ...defaultTripData.metadata, ...tripData.metadata };
                
                // Migrate old data if necessary
                migrateData();
                
                console.log('TripCore: Data loaded successfully');
                emit('dataChanged', tripData);
            } else {
                console.log('TripCore: No saved data found, using defaults');
            }
        } catch (error) {
            console.error('TripCore: Error loading data:', error);
            tripData = TripUtils.deepClone(defaultTripData);
        }
    }

    function saveData() {
        try {
            tripData.metadata.updatedAt = TripUtils.getCurrentDateTime();
            localStorage.setItem(STORAGE_KEYS.TRIP_DATA, JSON.stringify(tripData));
            
            // Auto backup every save
            if (tripData.settings.autoBackup) {
                createBackup();
            }
            
            emit('dataChanged', tripData);
            console.log('TripCore: Data saved successfully');
        } catch (error) {
            console.error('TripCore: Error saving data:', error);
        }
    }

    function resetData() {
        if (confirm('Bạn có chắc chắn muốn xóa tất cả dữ liệu? Hành động này không thể hoàn tác.')) {
            localStorage.removeItem(STORAGE_KEYS.TRIP_DATA);
            localStorage.removeItem(STORAGE_KEYS.BACKUP);
            tripData = TripUtils.deepClone(defaultTripData);
            tripData.metadata.createdAt = TripUtils.getCurrentDateTime();
            saveData();
            
            // Reload page to reset UI
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    }

    function exportData() {
        try {
            const exportData = {
                ...tripData,
                exportedAt: TripUtils.getCurrentDateTime(),
                exportVersion: '1.0.0'
            };
            
            const dataStr = JSON.stringify(exportData, null, 2);
            const filename = `du_lich_${TripUtils.slugify(tripData.name)}_${TripUtils.getCurrentDate()}.json`;
            
            TripUtils.downloadFile(dataStr, filename, 'application/json');
            
            console.log('TripCore: Data exported successfully');
            return true;
        } catch (error) {
            console.error('TripCore: Error exporting data:', error);
            return false;
        }
    }

    function importData(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                try {
                    const importedData = JSON.parse(e.target.result);
                    
                    // Validate imported data
                    if (!importedData.name || !importedData.metadata) {
                        throw new Error('Invalid data format');
                    }
                    
                    // Merge with current data
                    tripData = { ...defaultTripData, ...importedData };
                    tripData.metadata.updatedAt = TripUtils.getCurrentDateTime();
                    
                    saveData();
                    
                    console.log('TripCore: Data imported successfully');
                    resolve(tripData);
                } catch (error) {
                    console.error('TripCore: Error importing data:', error);
                    reject(error);
                }
            };
            
            reader.onerror = reject;
            reader.readAsText(file);
        });
    }

    function createBackup() {
        try {
            const backup = {
                data: tripData,
                timestamp: TripUtils.getCurrentDateTime(),
                version: '1.0.0'
            };
            
            localStorage.setItem(STORAGE_KEYS.BACKUP, JSON.stringify(backup));
            tripData.metadata.lastBackup = backup.timestamp;
            
            console.log('TripCore: Backup created successfully');
        } catch (error) {
            console.error('TripCore: Error creating backup:', error);
        }
    }

    function restoreBackup() {
        try {
            const backup = localStorage.getItem(STORAGE_KEYS.BACKUP);
            if (!backup) {
                throw new Error('No backup found');
            }
            
            const parsed = JSON.parse(backup);
            tripData = { ...defaultTripData, ...parsed.data };
            saveData();
            
            console.log('TripCore: Backup restored successfully');
            return true;
        } catch (error) {
            console.error('TripCore: Error restoring backup:', error);
            return false;
        }
    }

    // Data migration for backward compatibility
    function migrateData() {
        let migrated = false;
        
        // Add missing properties that might not exist in older versions
        if (!tripData.checklist) {
            tripData.checklist = defaultTripData.checklist;
            migrated = true;
        }
        
        if (!tripData.schedule) {
            tripData.schedule = [];
            migrated = true;
        }
        
        if (!tripData.bookings) {
            tripData.bookings = [];
            migrated = true;
        }
        
        if (migrated) {
            console.log('TripCore: Data migrated to new version');
            saveData();
        }
    }

    // Auto-save setup
    function setupAutoSave() {
        // Save data every 5 minutes
        setInterval(() => {
            if (tripData.settings.autoBackup) {
                createBackup();
            }
        }, 5 * 60 * 1000);
        
        // Save on page unload
        window.addEventListener('beforeunload', () => {
            saveData();
        });
    }

    // Trip Information Management
    function getTripInfo() {
        return {
            name: tripData.name,
            startDate: tripData.startDate,
            endDate: tripData.endDate,
            plannedBudget: tripData.plannedBudget,
            currency: tripData.settings.currency,
            totalDays: calculateTotalDays(),
            currentLocation: tripData.currentLocation
        };
    }

    function updateTripInfo(info) {
        const oldData = TripUtils.deepClone(tripData);
        
        Object.keys(info).forEach(key => {
            if (key in tripData) {
                tripData[key] = info[key];
            }
        });
        
        saveData();
        emit('tripUpdated', { oldData, newData: tripData });
    }

    function calculateTotalDays() {
        if (tripData.startDate && tripData.endDate) {
            return TripUtils.daysBetween(tripData.startDate, tripData.endDate);
        }
        return 0;
    }

    // Statistics and Calculations
    function getStatistics() {
        const totalSpent = getTotalSpent();
        const budgetUsed = tripData.plannedBudget > 0 ? (totalSpent / tripData.plannedBudget * 100) : 0;
        const destinationsCount = tripData.destinations.length;
        const completedDestinations = tripData.destinations.filter(d => d.status === 'completed').length;
        const checkedInDestinations = tripData.destinations.filter(d => d.checkedIn).length;
        
        return {
            totalSpent,
            budgetUsed,
            budgetRemaining: Math.max(0, tripData.plannedBudget - totalSpent),
            destinationsCount,
            completedDestinations,
            checkedInDestinations,
            progressPercentage: destinationsCount > 0 ? (completedDestinations / destinationsCount * 100) : 0,
            expensesCount: tripData.expenses.length,
            bookingsCount: tripData.bookings.length,
            averageDailySpending: calculateAverageDailySpending(),
            topExpenseCategory: getTopExpenseCategory(),
            upcomingBookings: getUpcomingBookings()
        };
    }

    function getTotalSpent() {
        return tripData.expenses.reduce((sum, expense) => sum + expense.amount, 0);
    }

    function getSpentByCategory() {
        const categoryTotals = {};
        
        tripData.expenses.forEach(expense => {
            if (!categoryTotals[expense.category]) {
                categoryTotals[expense.category] = 0;
            }
            categoryTotals[expense.category] += expense.amount;
        });
        
        return categoryTotals;
    }

    function calculateAverageDailySpending() {
        if (!tripData.startDate || tripData.expenses.length === 0) return 0;
        
        const startDate = new Date(tripData.startDate);
        const today = new Date();
        const daysPassed = Math.max(1, Math.ceil((today - startDate) / (1000 * 60 * 60 * 24)));
        
        return getTotalSpent() / daysPassed;
    }

    function getTopExpenseCategory() {
        const categoryTotals = getSpentByCategory();
        let topCategory = null;
        let maxAmount = 0;
        
        Object.entries(categoryTotals).forEach(([category, amount]) => {
            if (amount > maxAmount) {
                maxAmount = amount;
                topCategory = category;
            }
        });
        
        return topCategory ? {
            category: topCategory,
            amount: maxAmount,
            percentage: getTotalSpent() > 0 ? (maxAmount / getTotalSpent() * 100) : 0
        } : null;
    }

    function getUpcomingBookings() {
        const today = new Date();
        return tripData.bookings.filter(booking => {
            return booking.date && new Date(booking.date) >= today;
        }).sort((a, b) => new Date(a.date) - new Date(b.date));
    }

    // Event System
    function on(event, callback) {
        if (eventListeners[event]) {
            eventListeners[event].push(callback);
        }
    }

    function off(event, callback) {
        if (eventListeners[event]) {
            const index = eventListeners[event].indexOf(callback);
            if (index > -1) {
                eventListeners[event].splice(index, 1);
            }
        }
    }

    function emit(event, data) {
        if (eventListeners[event]) {
            eventListeners[event].forEach(callback => {
                try {
                    callback(data);
                } catch (error) {
                    console.error(`Error in event listener for ${event}:`, error);
                }
            });
        }
    }

    // Data getters
    function getData() {
        return TripUtils.deepClone(tripData);
    }

    function getExpenseCategories() {
        return expenseCategories;
    }

    function getBookingTypes() {
        return bookingTypes;
    }

    function getDestinationCategories() {
        return destinationCategories;
    }

    // Settings management
    function getSettings() {
        return TripUtils.deepClone(tripData.settings);
    }

    function updateSettings(newSettings) {
        tripData.settings = { ...tripData.settings, ...newSettings };
        saveData();
    }

    // Public API
    return {
        // Initialization
        init,
        
        // Data Management
        getData,
        loadData,
        saveData,
        resetData,
        exportData,
        importData,
        createBackup,
        restoreBackup,
        
        // Trip Information
        getTripInfo,
        updateTripInfo,
        calculateTotalDays,
        
        // Statistics
        getStatistics,
        getTotalSpent,
        getSpentByCategory,
        calculateAverageDailySpending,
        getTopExpenseCategory,
        getUpcomingBookings,
        
        // Configuration
        getExpenseCategories,
        getBookingTypes,
        getDestinationCategories,
        
        // Settings
        getSettings,
        updateSettings,
        
        // Events
        on,
        off,
        emit
    };
})();