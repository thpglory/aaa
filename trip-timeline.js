/**
 * Trip Manager - Timeline Management
 * Version: 1.0.0
 * Handles timeline visualization and check-in/check-out functionality
 */

window.TripTimeline = (function() {
    'use strict';

    // Timeline settings
    let timelineSettings = {
        autoScroll: true,
        showProgress: true,
        animateProgress: true,
        groupByDay: false
    };

    // Animation state
    let progressAnimation = null;

    function init() {
        console.log('TripTimeline: Initializing...');
        
        render();
        setupEventListeners();
        
        console.log('TripTimeline: Initialized successfully');
    }

    // Render timeline tab
    function render() {
        renderCurrentLocation();
        renderProgressSummary();
        renderTimelineContainer();
        renderTimelineSettings();
    }

    // Update timeline display
    function update() {
        renderCurrentLocation();
        renderProgressSummary();
        renderTimelineItems();
        updateTimelineProgress();
    }

    // Render current location banner
    function renderCurrentLocation() {
        const banner = TripUtils.getElement('timelineCurrentLocation');
        if (!banner) return;

        const tripData = TripCore.getData();
        const currentDest = tripData.destinations.find(dest => dest.checkedIn && !dest.checkedOut);
        
        let locationText = 'Chưa bắt đầu chuyến đi';
        let locationIcon = '📍';

        if (currentDest) {
            locationText = `Đang ở: ${currentDest.name}`;
            locationIcon = '🌟';
        } else if (tripData.currentLocation) {
            locationText = tripData.currentLocation;
        } else {
            // Check if trip has started based on dates
            const tripInfo = TripCore.getTripInfo();
            if (tripInfo.startDate) {
                const today = new Date();
                const startDate = new Date(tripInfo.startDate);
                const endDate = new Date(tripInfo.endDate);
                
                if (today >= startDate && today <= endDate) {
                    locationText = 'Đang trong chuyến đi';
                    locationIcon = '🚀';
                } else if (today > endDate) {
                    locationText = 'Đã hoàn thành chuyến đi';
                    locationIcon = '🎉';
                }
            }
        }

        const locationTextElement = TripUtils.getElement('timelineCurrentLocationText');
        if (locationTextElement) {
            locationTextElement.innerHTML = `${locationIcon} ${locationText}`;
        }
    }

    // Render progress summary
    function renderProgressSummary() {
        const container = TripUtils.getElement('timelineProgressStats');
        if (!container) return;

        const stats = calculateTimelineStats();
        
        container.innerHTML = `
            <div class="progress-stat">
                <div class="progress-number">${stats.progressPercentage}%</div>
                <div class="progress-label">Hoàn thành</div>
            </div>
            <div class="progress-stat">
                <div class="progress-number">${stats.checkedInCount}</div>
                <div class="progress-label">Đã Check-in</div>
            </div>
            <div class="progress-stat">
                <div class="progress-number">${stats.daysElapsed}</div>
                <div class="progress-label">Ngày đã đi</div>
            </div>
            <div class="progress-stat">
                <div class="progress-number">${stats.daysRemaining}</div>
                <div class="progress-label">Ngày còn lại</div>
            </div>
            <div class="progress-stat">
                <div class="progress-number">${TripUtils.formatMoney(stats.totalSpent)}</div>
                <div class="progress-label">Đã chi tiêu</div>
            </div>
        `;
    }

    // Render timeline container
    function renderTimelineContainer() {
        const container = TripUtils.getElement('timelineItems');
        if (!container) return;

        renderTimelineItems();
        updateTimelineProgress();
    }

    // Render timeline items
    function renderTimelineItems() {
        const container = TripUtils.getElement('timelineItems');
        if (!container) return;

        const tripData = TripCore.getData();
        let destinations = [...tripData.destinations];

        // Sort destinations by date
        destinations.sort((a, b) => new Date(a.date) - new Date(b.date));

        if (destinations.length === 0) {
            container.innerHTML = '<p style="text-align: center; color: #6c757d; padding: 40px;">Chưa có điểm đến nào trong lịch trình.</p>';
            return;
        }

        container.innerHTML = destinations.map((dest, index) => 
            renderTimelineItem(dest, index)
        ).join('');

        // Animate progress line
        if (timelineSettings.animateProgress) {
            setTimeout(() => updateTimelineProgress(), 500);
        }
    }

    // Render timeline item
    function renderTimelineItem(destination, index) {
        const markerClass = getTimelineMarkerClass(destination);
        const contentClass = getTimelineContentClass(destination);
        const timelineActions = getTimelineActionButtons(destination);
        const duration = getDestinationDuration(destination);
        
        return `
            <div class="timeline-item fade-in" data-destination-id="${destination.id}">
                <div class="timeline-marker ${markerClass}">
                    ${getTimelineMarkerContent(destination, index)}
                </div>
                <div class="timeline-content ${contentClass}">
                    <div class="timeline-header">
                        <div class="timeline-title">${destination.name}</div>
                        <div class="timeline-date">${TripUtils.formatDate(destination.date)}</div>
                    </div>
                    <div class="timeline-info">
                        <p>📅 <strong>Kế hoạch:</strong> ${destination.days} ngày (${TripUtils.formatDate(destination.date)} - ${TripUtils.formatDate(TripUtils.addDays(destination.date, destination.days - 1))})</p>
                        ${destination.address ? `<p>📍 <strong>Địa chỉ:</strong> ${destination.address}</p>` : ''}
                        ${destination.budget ? `<p>💰 <strong>Ngân sách:</strong> ${TripUtils.formatMoney(destination.budget)}</p>` : ''}
                        ${destination.notes ? `<p>📝 <strong>Ghi chú:</strong> ${destination.notes}</p>` : ''}
                        ${destination.checkedIn ? `<p>✅ <strong>Check-in:</strong> ${TripUtils.formatDateTime(destination.checkedIn)}</p>` : ''}
                        ${destination.checkedOut ? `<p>🚪 <strong>Check-out:</strong> ${TripUtils.formatDateTime(destination.checkedOut)}</p>` : ''}
                        ${duration}
                        ${getExpensesSummary(destination)}
                    </div>
                    <div class="timeline-actions">
                        ${timelineActions}
                    </div>
                </div>
            </div>
        `;
    }

    // Get timeline marker class
    function getTimelineMarkerClass(destination) {
        if (destination.checkedIn && destination.checkedOut) {
            return 'completed';
        } else if (destination.checkedIn && !destination.checkedOut) {
            return 'checkedin current';
        } else {
            const status = TripDestinations.getDestinationStatus(destination);
            if (status === 'current') {
                return 'current';
            } else if (status === 'completed') {
                return 'completed';
            }
        }
        return '';
    }

    // Get timeline content class
    function getTimelineContentClass(destination) {
        if (destination.checkedIn && destination.checkedOut) {
            return 'completed';
        } else if (destination.checkedIn && !destination.checkedOut) {
            return 'checkedin current';
        } else {
            const status = TripDestinations.getDestinationStatus(destination);
            return status;
        }
    }

    // Get timeline marker content
    function getTimelineMarkerContent(destination, index) {
        if (destination.checkedIn) {
            return '✓';
        }
        return index + 1;
    }

    // Get timeline action buttons
    function getTimelineActionButtons(destination) {
        try {
            const today = new Date();
            const destDate = new Date(destination.date);
            
            if (isNaN(destDate.getTime())) return '';
            
            const canCheckIn = !destination.checkedIn && destDate <= today;
            const canCheckOut = destination.checkedIn && !destination.checkedOut;
            
            let buttons = '';
            
            if (canCheckIn) {
                buttons += `<button class="checkin-btn" onclick="TripTimeline.checkInDestination('${destination.id}')">📍 Check-in</button>`;
            }
            
            if (canCheckOut) {
                buttons += `<button class="checkin-btn checkout-btn" onclick="TripTimeline.checkOutDestination('${destination.id}')">🚪 Check-out</button>`;
            }
            
            if (destination.checkedIn && !destination.checkedOut) {
                buttons += `<button class="btn btn-small" onclick="TripTimeline.addLocationExpense('${destination.id}')">💳 Chi tiêu tại đây</button>`;
            }

            // Add notes button
            buttons += `<button class="btn btn-small" onclick="TripTimeline.addNotes('${destination.id}')">📝 Ghi chú</button>`;
            
            return buttons;
        } catch (error) {
            console.error('Error in getTimelineActionButtons:', error);
            return '';
        }
    }

    // Get destination duration
    function getDestinationDuration(destination) {
        if (!destination.checkedIn) return '';
        
        try {
            const checkedInTime = new Date(destination.checkedIn);
            const checkedOutTime = destination.checkedOut ? new Date(destination.checkedOut) : new Date();
            
            if (isNaN(checkedInTime.getTime()) || isNaN(checkedOutTime.getTime())) {
                return '<p>⏱️ <strong>Thời gian thực tế:</strong> Không xác định</p>';
            }
            
            const durationMs = checkedOutTime - checkedInTime;
            const durationDays = Math.ceil(durationMs / (1000 * 60 * 60 * 24));
            const plannedDays = destination.days || 1;
            const actualDays = Math.max(1, durationDays);
            
            let durationText = `<p>⏱️ <strong>Thời gian thực tế:</strong> ${actualDays} ngày`;
            
            if (destination.checkedOut) {
                if (actualDays === plannedDays) {
                    durationText += ` <span style="color: #28a745;">(✓ Đúng kế hoạch)</span>`;
                } else if (actualDays > plannedDays) {
                    durationText += ` <span style="color: #ffc107;">(+${actualDays - plannedDays} ngày dài hơn)</span>`;
                } else {
                    durationText += ` <span style="color: #17a2b8;">(-${plannedDays - actualDays} ngày ngắn hơn)</span>`;
                }
            } else {
                durationText += ` <span style="color: #667eea;">(Đang ở đây)</span>`;
            }
            
            durationText += '</p>';
            return durationText;
        } catch (error) {
            console.error('Error in getDestinationDuration:', error);
            return '<p>⏱️ <strong>Thời gian thực tế:</strong> Có lỗi xảy ra</p>';
        }
    }

    // Get expenses summary for destination
    function getExpensesSummary(destination) {
        const tripData = TripCore.getData();
        const locationExpenses = tripData.expenses.filter(expense => 
            expense.location && expense.location.toLowerCase().includes(destination.name.toLowerCase())
        );

        if (locationExpenses.length === 0) return '';

        const totalExpenses = locationExpenses.reduce((sum, expense) => sum + expense.amount, 0);
        
        return `
            <p>💳 <strong>Chi tiêu tại đây:</strong> ${TripUtils.formatMoney(totalExpenses)} (${locationExpenses.length} giao dịch)</p>
        `;
    }

    // Calculate timeline statistics
    function calculateTimelineStats() {
        const tripData = TripCore.getData();
        const tripInfo = TripCore.getTripInfo();
        const stats = TripCore.getStatistics();
        
        const totalDestinations = tripData.destinations.length;
        const checkedInCount = tripData.destinations.filter(dest => dest.checkedIn).length;
        const completedCount = tripData.destinations.filter(dest => dest.checkedOut).length;
        
        const progressPercentage = totalDestinations > 0 ? Math.round((completedCount / totalDestinations) * 100) : 0;
        
        let daysElapsed = 0;
        let daysRemaining = 0;
        
        if (tripInfo.startDate && tripInfo.endDate) {
            const today = new Date();
            const startDate = new Date(tripInfo.startDate);
            const endDate = new Date(tripInfo.endDate);
            
            if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
                const totalDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
                daysElapsed = Math.max(0, Math.min(totalDays, Math.ceil((today - startDate) / (1000 * 60 * 60 * 24))));
                daysRemaining = Math.max(0, Math.ceil((endDate - today) / (1000 * 60 * 60 * 24)));
            }
        }
        
        return {
            progressPercentage,
            checkedInCount,
            completedCount,
            daysElapsed,
            daysRemaining,
            totalSpent: stats.totalSpent
        };
    }

    // Update timeline progress line
    function updateTimelineProgress() {
        const progressLine = TripUtils.getElement('timelineProgressLine');
        if (!progressLine) return;

        const tripData = TripCore.getData();
        const totalDestinations = tripData.destinations.length;
        const completedCount = tripData.destinations.filter(dest => dest.checkedOut).length;
        
        if (totalDestinations === 0) {
            progressLine.style.height = '0px';
            return;
        }
        
        const progressPercentage = completedCount / totalDestinations;
        const timelineItems = document.querySelectorAll('.timeline-item');
        
        if (timelineItems.length > 0) {
            const itemHeight = 120; // Approximate height per timeline item
            const totalHeight = timelineItems.length * itemHeight;
            const progressHeight = Math.max(0, progressPercentage * totalHeight);
            
            if (timelineSettings.animateProgress) {
                // Animate progress line
                if (progressAnimation) {
                    progressAnimation.cancel();
                }
                
                progressAnimation = progressLine.animate([
                    { height: '0px' },
                    { height: `${progressHeight}px` }
                ], {
                    duration: 1000,
                    easing: 'ease-out',
                    fill: 'forwards'
                });
            } else {
                progressLine.style.height = `${progressHeight}px`;
            }
        }
    }

    // Check in to destination
    function checkInDestination(destinationId) {
        const tripData = TripCore.getData();
        const destination = tripData.destinations.find(dest => dest.id === destinationId);
        
        if (!destination) {
            TripNotifications.showError('Không tìm thấy điểm đến!');
            return;
        }
        
        if (destination.checkedIn) {
            TripNotifications.showWarning('Bạn đã check-in tại điểm này rồi!');
            return;
        }
        
        try {
            // Check-out previous location if exists
            const currentCheckedIn = tripData.destinations.find(dest => dest.checkedIn && !dest.checkedOut);
            if (currentCheckedIn) {
                currentCheckedIn.checkedOut = TripUtils.getCurrentDateTime();
                TripNotifications.showInfo(`Đã tự động check-out khỏi ${currentCheckedIn.name}`);
            }
            
            destination.checkedIn = TripUtils.getCurrentDateTime();
            destination.status = 'current';
            tripData.currentLocation = destination.name;
            
            TripCore.saveData();
            update();
            
            // Update other components
            if (typeof TripDashboard !== 'undefined') TripDashboard.update();
            if (typeof TripDestinations !== 'undefined') TripDestinations.update();
            
            TripNotifications.showSuccess(`Đã check-in tại ${destination.name}! 🎉`);
            
            // Send browser notification if supported
            TripNotifications.sendBrowserNotification(
                `Check-in thành công!`,
                { body: `Bạn đã check-in tại ${destination.name}` }
            );
            
        } catch (error) {
            console.error('Error in checkInDestination:', error);
            TripNotifications.showError('Có lỗi xảy ra khi check-in!');
        }
    }

    // Check out from destination
    function checkOutDestination(destinationId) {
        const tripData = TripCore.getData();
        const destination = tripData.destinations.find(dest => dest.id === destinationId);
        
        if (!destination) {
            TripNotifications.showError('Không tìm thấy điểm đến!');
            return;
        }
        
        if (!destination.checkedIn) {
            TripNotifications.showWarning('Bạn chưa check-in tại điểm này!');
            return;
        }
        
        if (destination.checkedOut) {
            TripNotifications.showWarning('Bạn đã check-out khỏi điểm này rồi!');
            return;
        }
        
        try {
            destination.checkedOut = TripUtils.getCurrentDateTime();
            destination.status = 'completed';
            
            // Update current location
            const nextDestination = tripData.destinations
                .filter(dest => dest.date && new Date(dest.date) > new Date(destination.date) && !dest.checkedIn)
                .sort((a, b) => new Date(a.date) - new Date(b.date))[0];
            
            if (nextDestination) {
                tripData.currentLocation = `Đang di chuyển đến ${nextDestination.name}`;
            } else {
                tripData.currentLocation = 'Hoàn thành chuyến đi';
            }
            
            TripCore.saveData();
            update();
            
            // Update other components
            if (typeof TripDashboard !== 'undefined') TripDashboard.update();
            if (typeof TripDestinations !== 'undefined') TripDestinations.update();
            
            TripNotifications.showSuccess(`Đã check-out khỏi ${destination.name}! 👋`);
            
        } catch (error) {
            console.error('Error in checkOutDestination:', error);
            TripNotifications.showError('Có lỗi xảy ra khi check-out!');
        }
    }

    // Add location expense
    function addLocationExpense(destinationId) {
        const tripData = TripCore.getData();
        const destination = tripData.destinations.find(dest => dest.id === destinationId);
        
        if (destination) {
            TripModals.openModal('quickExpenseModal', { location: destination.name });
        }
    }

    // Add notes to destination
    function addNotes(destinationId) {
        const tripData = TripCore.getData();
        const destination = tripData.destinations.find(dest => dest.id === destinationId);
        
        if (!destination) return;
        
        const currentNotes = destination.notes || '';
        const newNotes = prompt('Thêm ghi chú cho điểm đến này:', currentNotes);
        
        if (newNotes !== null && newNotes !== currentNotes) {
            destination.notes = newNotes;
            TripCore.saveData();
            update();
            TripNotifications.showSuccess('Đã cập nhật ghi chú!');
        }
    }

    // Render timeline settings
    function renderTimelineSettings() {
        // Could add settings panel for timeline customization
        console.log('Timeline settings:', timelineSettings);
    }

    // Auto-scroll to current destination
    function scrollToCurrentDestination() {
        const currentItem = document.querySelector('.timeline-item .timeline-marker.current');
        if (currentItem && timelineSettings.autoScroll) {
            currentItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    // Setup event listeners
    function setupEventListeners() {
        // Listen to data changes
        TripCore.on('dataChanged', () => {
            if (TripTabs.getCurrentTab() === 'timeline') {
                update();
            }
        });

        // Listen to tab changes
        TripCore.on('tabChanged', (event) => {
            if (event.to === 'timeline') {
                update();
                setTimeout(() => scrollToCurrentDestination(), 500);
            }
        });

        // Update destination statuses periodically
        setInterval(() => {
            if (TripTabs.getCurrentTab() === 'timeline') {
                const tripData = TripCore.getData();
                let hasChanges = false;
                
                tripData.destinations.forEach(dest => {
                    if (!dest.checkedIn) {
                        const newStatus = TripDestinations.getDestinationStatus(dest);
                        if (dest.status !== newStatus) {
                            dest.status = newStatus;
                            hasChanges = true;
                        }
                    }
                });
                
                if (hasChanges) {
                    TripCore.saveData();
                    update();
                }
            }
        }, 60000); // Check every minute
    }

    // Export timeline data
    function exportTimeline() {
        const tripData = TripCore.getData();
        const timelineData = {
            tripName: tripData.name,
            destinations: tripData.destinations.map(dest => ({
                name: dest.name,
                date: dest.date,
                checkedIn: dest.checkedIn,
                checkedOut: dest.checkedOut,
                notes: dest.notes
            })),
            stats: calculateTimelineStats(),
            exportDate: TripUtils.getCurrentDateTime()
        };
        
        const jsonData = JSON.stringify(timelineData, null, 2);
        const filename = `timeline_${TripUtils.slugify(tripData.name)}_${TripUtils.getCurrentDate()}.json`;
        
        TripUtils.downloadFile(jsonData, filename, 'application/json');
        TripNotifications.showSuccess('Đã xuất dữ liệu timeline!');
    }

    // Public API
    return {
        // Initialization
        init,
        render,
        update,

        // Check-in/Check-out
        checkInDestination,
        checkOutDestination,

        // Actions
        addLocationExpense,
        addNotes,
        scrollToCurrentDestination,

        // Utilities
        calculateTimelineStats,
        updateTimelineProgress,
        exportTimeline,

        // Settings
        timelineSettings
    };
})();