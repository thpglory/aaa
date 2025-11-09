/**
 * Trip Manager - Suggestions Management
 * Version: 1.0.0
 * Handles smart suggestions, recommendations, and travel insights
 */

window.TripSuggestions = (function() {
    'use strict';

    // Suggestion types
    const SUGGESTION_TYPES = {
        DESTINATION: 'destination',
        ACTIVITY: 'activity',
        RESTAURANT: 'restaurant',
        ACCOMMODATION: 'accommodation',
        TRANSPORT: 'transport',
        BUDGET: 'budget',
        SCHEDULE: 'schedule',
        SAFETY: 'safety',
        WEATHER: 'weather',
        CULTURAL: 'cultural'
    };

    // Suggestion priorities
    const SUGGESTION_PRIORITIES = {
        LOW: 'low',
        MEDIUM: 'medium',
        HIGH: 'high',
        URGENT: 'urgent'
    };

    // Suggestion sources
    const SUGGESTION_SOURCES = {
        AI: 'ai',
        USER_BEHAVIOR: 'user_behavior',
        WEATHER: 'weather',
        BUDGET_ANALYSIS: 'budget_analysis',
        SCHEDULE_OPTIMIZATION: 'schedule_optimization',
        LOCATION_BASED: 'location_based',
        SEASONAL: 'seasonal',
        POPULAR: 'popular'
    };

    // User preferences
    let userPreferences = {
        interests: [],
        budgetLevel: 'medium',
        travelStyle: 'balanced',
        groupSize: 1,
        preferences: {
            adventure: 50,
            culture: 50,
            relaxation: 50,
            food: 50,
            shopping: 50,
            nature: 50
        }
    };

    // Cached suggestions
    let suggestionsCache = {
        destinations: [],
        activities: [],
        restaurants: [],
        accommodations: [],
        lastUpdated: null
    };

    // Suggestion filters
    let suggestionFilters = {
        type: 'all',
        priority: 'all',
        applied: 'all',
        source: 'all'
    };

    function init() {
        console.log('TripSuggestions: Initializing...');
        
        loadUserPreferences();
        render();
        generateSmartSuggestions();
        setupEventListeners();
        
        console.log('TripSuggestions: Initialized successfully');
    }

    // Render suggestions tab
    function render() {
        renderSuggestionsOverview();
        renderSmartSuggestions();
        renderPreferencesPanel();
        renderSuggestionTools();
    }

    // Update suggestions display
    function update() {
        generateSmartSuggestions();
        renderSmartSuggestions();
    }

    // Render suggestions overview
    function renderSuggestionsOverview() {
        const container = TripUtils.getElement('suggestionsContainer');
        if (!container) return;

        const stats = calculateSuggestionStats();
        const tripInfo = TripCore.getTripInfo();
        
        container.innerHTML = `
            <div class="suggestions-overview">
                <div class="suggestions-header">
                    <h3>💡 Gợi Ý Thông Minh</h3>
                    <p>Các gợi ý được cá nhân hóa dựa trên sở thích và kế hoạch của bạn</p>
                </div>

                <div class="suggestion-stats">
                    <div class="stat-card">
                        <div class="stat-icon">🎯</div>
                        <div class="stat-content">
                            <div class="stat-number">${stats.totalSuggestions}</div>
                            <div class="stat-label">Gợi ý mới</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">✅</div>
                        <div class="stat-content">
                            <div class="stat-number">${stats.appliedSuggestions}</div>
                            <div class="stat-label">Đã áp dụng</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">⭐</div>
                        <div class="stat-content">
                            <div class="stat-number">${stats.highPrioritySuggestions}</div>
                            <div class="stat-label">Quan trọng</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">🤖</div>
                        <div class="stat-content">
                            <div class="stat-number">${stats.aiSuggestions}</div>
                            <div class="stat-label">AI gợi ý</div>
                        </div>
                    </div>
                </div>

                <div class="suggestion-filters">
                    <div class="filter-row">
                        <select class="form-control" onchange="TripSuggestions.updateFilter('type', this.value)">
                            <option value="all" ${suggestionFilters.type === 'all' ? 'selected' : ''}>Tất cả loại</option>
                            <option value="destination" ${suggestionFilters.type === 'destination' ? 'selected' : ''}>🏝️ Điểm đến</option>
                            <option value="activity" ${suggestionFilters.type === 'activity' ? 'selected' : ''}>🎡 Hoạt động</option>
                            <option value="restaurant" ${suggestionFilters.type === 'restaurant' ? 'selected' : ''}>🍽️ Nhà hàng</option>
                            <option value="accommodation" ${suggestionFilters.type === 'accommodation' ? 'selected' : ''}>🏨 Lưu trú</option>
                            <option value="budget" ${suggestionFilters.type === 'budget' ? 'selected' : ''}>💰 Ngân sách</option>
                            <option value="schedule" ${suggestionFilters.type === 'schedule' ? 'selected' : ''}>📅 Lịch trình</option>
                        </select>

                        <select class="form-control" onchange="TripSuggestions.updateFilter('priority', this.value)">
                            <option value="all" ${suggestionFilters.priority === 'all' ? 'selected' : ''}>Tất cả mức độ</option>
                            <option value="urgent" ${suggestionFilters.priority === 'urgent' ? 'selected' : ''}>🚨 Khẩn cấp</option>
                            <option value="high" ${suggestionFilters.priority === 'high' ? 'selected' : ''}>🔴 Cao</option>
                            <option value="medium" ${suggestionFilters.priority === 'medium' ? 'selected' : ''}>🟡 Trung bình</option>
                            <option value="low" ${suggestionFilters.priority === 'low' ? 'selected' : ''}>🟢 Thấp</option>
                        </select>

                        <select class="form-control" onchange="TripSuggestions.updateFilter('applied', this.value)">
                            <option value="all" ${suggestionFilters.applied === 'all' ? 'selected' : ''}>Tất cả</option>
                            <option value="new" ${suggestionFilters.applied === 'new' ? 'selected' : ''}>Chưa xem</option>
                            <option value="viewed" ${suggestionFilters.applied === 'viewed' ? 'selected' : ''}>Đã xem</option>
                            <option value="applied" ${suggestionFilters.applied === 'applied' ? 'selected' : ''}>Đã áp dụng</option>
                            <option value="dismissed" ${suggestionFilters.applied === 'dismissed' ? 'selected' : ''}>Đã từ chối</option>
                        </select>

                        <button class="btn btn-small btn-secondary" onclick="TripSuggestions.clearFilters()">
                            🔄 Xóa bộ lọc
                        </button>
                    </div>
                </div>

                <div class="suggestion-actions">
                    <button class="btn" onclick="TripSuggestions.refreshSuggestions()">
                        🔄 Tạo gợi ý mới
                    </button>
                    <button class="btn btn-secondary" onclick="TripSuggestions.updatePreferences()">
                        ⚙️ Cập nhật sở thích
                    </button>
                    <button class="btn btn-secondary" onclick="TripSuggestions.exportSuggestions()">
                        📤 Xuất gợi ý
                    </button>
                </div>
            </div>
        `;
    }

    // Render smart suggestions
    function renderSmartSuggestions() {
        const container = TripUtils.getElement('suggestionsContainer');
        if (!container) return;

        const suggestions = getFilteredSuggestions();
        const groupedSuggestions = groupSuggestionsByType(suggestions);

        const suggestionsSection = `
            <div class="smart-suggestions">
                <h3>🤖 Gợi Ý Được Cá Nhân Hóa</h3>
                
                ${Object.keys(groupedSuggestions).length > 0 ? `
                    <div class="suggestions-grid">
                        ${Object.entries(groupedSuggestions).map(([type, typeSuggestions]) => 
                            renderSuggestionGroup(type, typeSuggestions)
                        ).join('')}
                    </div>
                ` : `
                    <div class="empty-suggestions">
                        <div class="empty-content">
                            <h4>🎯 Chưa có gợi ý mới</h4>
                            <p>Hãy cập nhật thông tin chuyến đi để nhận được gợi ý phù hợp</p>
                            <button class="btn" onclick="TripSuggestions.refreshSuggestions()">
                                🔄 Tạo gợi ý ngay
                            </button>
                        </div>
                    </div>
                `}
            </div>
        `;

        container.innerHTML += suggestionsSection;
    }

    // Render suggestion group
    function renderSuggestionGroup(type, suggestions) {
        const typeInfo = getSuggestionTypeInfo(type);
        
        return `
            <div class="suggestion-group" data-type="${type}">
                <div class="group-header">
                    <h4>${typeInfo.icon} ${typeInfo.name}</h4>
                    <span class="suggestion-count">${suggestions.length} gợi ý</span>
                </div>
                
                <div class="suggestion-cards">
                    ${suggestions.map(suggestion => renderSuggestionCard(suggestion)).join('')}
                </div>
            </div>
        `;
    }

    // Render suggestion card
    function renderSuggestionCard(suggestion) {
        const priorityClass = `priority-${suggestion.priority}`;
        const typeInfo = getSuggestionTypeInfo(suggestion.type);
        const sourceInfo = getSuggestionSourceInfo(suggestion.source);

        return `
            <div class="suggestion-card ${suggestion.applied ? 'applied' : ''} ${suggestion.dismissed ? 'dismissed' : ''} ${priorityClass}" 
                 data-suggestion-id="${suggestion.id}">
                
                <div class="suggestion-header">
                    <div class="suggestion-type">
                        <span class="type-icon">${typeInfo.icon}</span>
                        <span class="priority-indicator ${priorityClass}">
                            ${getPriorityIcon(suggestion.priority)}
                        </span>
                    </div>
                    <div class="suggestion-source" title="Nguồn: ${sourceInfo.name}">
                        ${sourceInfo.icon}
                    </div>
                </div>

                <div class="suggestion-content">
                    <h4 class="suggestion-title">${suggestion.title}</h4>
                    <p class="suggestion-description">${suggestion.description}</p>
                    
                    ${suggestion.details ? `
                        <div class="suggestion-details">
                            ${Object.entries(suggestion.details).map(([key, value]) => `
                                <div class="detail-item">
                                    <span class="detail-label">${formatDetailLabel(key)}:</span>
                                    <span class="detail-value">${formatDetailValue(key, value)}</span>
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}

                    ${suggestion.tags && suggestion.tags.length > 0 ? `
                        <div class="suggestion-tags">
                            ${suggestion.tags.map(tag => `<span class="suggestion-tag">${tag}</span>`).join('')}
                        </div>
                    ` : ''}

                    ${suggestion.rating ? `
                        <div class="suggestion-rating">
                            <span class="rating-stars">${generateStars(suggestion.rating)}</span>
                            <span class="rating-text">${suggestion.rating}/5</span>
                        </div>
                    ` : ''}
                </div>

                <div class="suggestion-actions">
                    ${!suggestion.applied && !suggestion.dismissed ? `
                        <button class="btn btn-small suggestion-apply" onclick="TripSuggestions.applySuggestion('${suggestion.id}')">
                            ✅ Áp dụng
                        </button>
                        <button class="btn btn-small btn-secondary" onclick="TripSuggestions.dismissSuggestion('${suggestion.id}')">
                            ❌ Bỏ qua
                        </button>
                    ` : ''}
                    
                    <button class="btn btn-small" onclick="TripSuggestions.viewSuggestionDetails('${suggestion.id}')">
                        👁️ Chi tiết
                    </button>
                    
                    ${suggestion.bookingUrl ? `
                        <button class="btn btn-small" onclick="window.open('${suggestion.bookingUrl}', '_blank')">
                            🔗 Đặt ngay
                        </button>
                    ` : ''}
                </div>

                ${suggestion.applied ? `
                    <div class="suggestion-status applied">
                        ✅ Đã áp dụng lúc ${TripUtils.formatDateTime(suggestion.appliedAt)}
                    </div>
                ` : suggestion.dismissed ? `
                    <div class="suggestion-status dismissed">
                        ❌ Đã bỏ qua lúc ${TripUtils.formatDateTime(suggestion.dismissedAt)}
                    </div>
                ` : ''}
            </div>
        `;
    }

    // Render preferences panel
    function renderPreferencesPanel() {
        const container = TripUtils.getElement('suggestionsContainer');
        if (!container) return;

        const preferencesSection = `
            <div class="preferences-panel">
                <h3>⚙️ Tùy Chỉnh Sở Thích</h3>
                
                <div class="preferences-content">
                    <div class="preference-category">
                        <h4>🎯 Sở thích du lịch</h4>
                        <div class="preference-sliders">
                            ${Object.entries(userPreferences.preferences).map(([key, value]) => `
                                <div class="preference-item">
                                    <label>${getPreferenceLabel(key)}</label>
                                    <div class="preference-slider">
                                        <input type="range" 
                                               min="0" 
                                               max="100" 
                                               value="${value}" 
                                               onchange="TripSuggestions.updatePreference('${key}', this.value)">
                                        <span class="preference-value">${value}%</span>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>

                    <div class="preference-category">
                        <h4>💰 Mức ngân sách</h4>
                        <div class="budget-options">
                            ${['low', 'medium', 'high', 'luxury'].map(level => `
                                <label class="budget-option ${userPreferences.budgetLevel === level ? 'selected' : ''}">
                                    <input type="radio" 
                                           name="budgetLevel" 
                                           value="${level}" 
                                           ${userPreferences.budgetLevel === level ? 'checked' : ''}
                                           onchange="TripSuggestions.updateBudgetLevel(this.value)">
                                    <span>${getBudgetLevelLabel(level)}</span>
                                </label>
                            `).join('')}
                        </div>
                    </div>

                    <div class="preference-category">
                        <h4>🎭 Phong cách du lịch</h4>
                        <div class="travel-style-options">
                            ${['backpacker', 'budget', 'balanced', 'comfort', 'luxury'].map(style => `
                                <label class="travel-style-option ${userPreferences.travelStyle === style ? 'selected' : ''}">
                                    <input type="radio" 
                                           name="travelStyle" 
                                           value="${style}" 
                                           ${userPreferences.travelStyle === style ? 'checked' : ''}
                                           onchange="TripSuggestions.updateTravelStyle(this.value)">
                                    <span>${getTravelStyleLabel(style)}</span>
                                </label>
                            `).join('')}
                        </div>
                    </div>

                    <div class="preference-actions">
                        <button class="btn" onclick="TripSuggestions.savePreferences()">
                            💾 Lưu sở thích
                        </button>
                        <button class="btn btn-secondary" onclick="TripSuggestions.resetPreferences()">
                            🔄 Đặt lại mặc định
                        </button>
                    </div>
                </div>
            </div>
        `;

        container.innerHTML += preferencesSection;
    }

    // Render suggestion tools
    function renderSuggestionTools() {
        const container = TripUtils.getElement('suggestionsContainer');
        if (!container) return;

        const toolsSection = `
            <div class="suggestion-tools">
                <h3>🛠️ Công Cụ Gợi Ý</h3>
                
                <div class="tools-grid">
                    <div class="tool-card">
                        <h4>🎯 Gợi Ý Địa Điểm</h4>
                        <p>Tìm điểm đến phù hợp với sở thích</p>
                        <button class="btn" onclick="TripSuggestions.suggestDestinations()">Tìm điểm đến</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>🍽️ Gợi Ý Nhà Hàng</h4>
                        <p>Khám phá ẩm thực địa phương</p>
                        <button class="btn" onclick="TripSuggestions.suggestRestaurants()">Tìm nhà hàng</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>🎡 Gợi Ý Hoạt Động</h4>
                        <p>Các hoạt động thú vị theo sở thích</p>
                        <button class="btn" onclick="TripSuggestions.suggestActivities()">Tìm hoạt động</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>💰 Tối Ưu Ngân Sách</h4>
                        <p>Gợi ý để tiết kiệm chi phí</p>
                        <button class="btn" onclick="TripSuggestions.optimizeBudget()">Tối ưu hóa</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>📅 Tối Ưu Lịch Trình</h4>
                        <p>Sắp xếp lịch trình hiệu quả</p>
                        <button class="btn" onclick="TripSuggestions.optimizeSchedule()">Sắp xếp lại</button>
                    </div>
                    
                    <div class="tool-card">
                        <h4>🌤️ Gợi Ý Thời Tiết</h4>
                        <p>Hoạt động phù hợp với thời tiết</p>
                        <button class="btn" onclick="TripSuggestions.weatherBasedSuggestions()">Xem gợi ý</button>
                    </div>
                </div>
            </div>
        `;

        container.innerHTML += toolsSection;
    }

    // Generate smart suggestions
    function generateSmartSuggestions() {
        const suggestions = [];
        const tripData = TripCore.getData();
        const tripInfo = TripCore.getTripInfo();
        const stats = TripCore.getStatistics();

        // Budget-based suggestions
        suggestions.push(...generateBudgetSuggestions(stats, tripInfo));

        // Schedule optimization suggestions
        suggestions.push(...generateScheduleSuggestions(tripData));

        // Destination suggestions
        suggestions.push(...generateDestinationSuggestions(tripData, userPreferences));

        // Activity suggestions
        suggestions.push(...generateActivitySuggestions(tripData, userPreferences));

        // Weather-based suggestions
        suggestions.push(...generateWeatherSuggestions(tripData));

        // Safety and cultural suggestions
        suggestions.push(...generateSafetyAndCulturalSuggestions(tripData));

        // Store suggestions
        const existingSuggestions = getSavedSuggestions();
        const newSuggestions = suggestions.filter(newSugg => 
            !existingSuggestions.find(existing => existing.id === newSugg.id)
        );

        const allSuggestions = [...existingSuggestions, ...newSuggestions];
        saveSuggestions(allSuggestions);

        console.log(`Generated ${newSuggestions.length} new suggestions`);
    }

    // Generate budget suggestions
    function generateBudgetSuggestions(stats, tripInfo) {
        const suggestions = [];

        if (stats.budgetUsed > 90) {
            suggestions.push({
                id: 'budget_overspend_' + Date.now(),
                type: SUGGESTION_TYPES.BUDGET,
                priority: SUGGESTION_PRIORITIES.URGENT,
                source: SUGGESTION_SOURCES.BUDGET_ANALYSIS,
                title: 'Ngân sách sắp vượt mức',
                description: 'Bạn đã sử dụng hơn 90% ngân sách. Hãy xem xét các biện pháp tiết kiệm.',
                details: {
                    currentUsage: `${stats.budgetUsed.toFixed(1)}%`,
                    remaining: TripUtils.formatMoney(stats.budgetRemaining)
                },
                tags: ['ngân sách', 'tiết kiệm', 'khẩn cấp'],
                createdAt: TripUtils.getCurrentDateTime()
            });
        }

        if (stats.averageDailySpending > 0 && tripInfo.totalDays > 0) {
            const dailyBudget = tripInfo.plannedBudget / tripInfo.totalDays;
            if (stats.averageDailySpending > dailyBudget * 1.2) {
                suggestions.push({
                    id: 'daily_overspend_' + Date.now(),
                    type: SUGGESTION_TYPES.BUDGET,
                    priority: SUGGESTION_PRIORITIES.HIGH,
                    source: SUGGESTION_SOURCES.BUDGET_ANALYSIS,
                    title: 'Chi tiêu hàng ngày cao',
                    description: 'Chi tiêu trung bình mỗi ngày cao hơn kế hoạch 20%.',
                    details: {
                        averageDaily: TripUtils.formatMoney(stats.averageDailySpending),
                        plannedDaily: TripUtils.formatMoney(dailyBudget)
                    },
                    tags: ['ngân sách', 'chi tiêu hàng ngày'],
                    createdAt: TripUtils.getCurrentDateTime()
                });
            }
        }

        return suggestions;
    }

    // Generate schedule suggestions
    function generateScheduleSuggestions(tripData) {
        const suggestions = [];
        const schedule = tripData.schedule || [];

        // Check for schedule gaps
        const groupedByDate = {};
        schedule.forEach(activity => {
            if (!groupedByDate[activity.date]) {
                groupedByDate[activity.date] = [];
            }
            groupedByDate[activity.date].push(activity);
        });

        Object.entries(groupedByDate).forEach(([date, activities]) => {
            if (activities.length < 3) {
                suggestions.push({
                    id: 'schedule_gap_' + date,
                    type: SUGGESTION_TYPES.SCHEDULE,
                    priority: SUGGESTION_PRIORITIES.MEDIUM,
                    source: SUGGESTION_SOURCES.SCHEDULE_OPTIMIZATION,
                    title: `Lịch trình ${TripUtils.formatDate(date)} còn trống`,
                    description: 'Có thể thêm hoạt động để tận dụng thời gian.',
                    details: {
                        currentActivities: activities.length,
                        date: TripUtils.formatDate(date)
                    },
                    tags: ['lịch trình', 'hoạt động'],
                    createdAt: TripUtils.getCurrentDateTime()
                });
            }
        });

        return suggestions;
    }

    // Generate destination suggestions
    function generateDestinationSuggestions(tripData, preferences) {
        const suggestions = [];
        const destinations = tripData.destinations || [];

        // Suggest nearby destinations
        if (destinations.length > 0) {
            const lastDestination = destinations[destinations.length - 1];
            const nearbyPlaces = getNearbyPlaces(lastDestination);

            nearbyPlaces.forEach(place => {
                suggestions.push({
                    id: 'nearby_' + place.id,
                    type: SUGGESTION_TYPES.DESTINATION,
                    priority: SUGGESTION_PRIORITIES.MEDIUM,
                    source: SUGGESTION_SOURCES.LOCATION_BASED,
                    title: `Ghé thăm ${place.name}`,
                    description: `Chỉ cách ${lastDestination.name} ${place.distance}km`,
                    details: {
                        distance: `${place.distance}km`,
                        estimatedTime: place.travelTime,
                        type: place.type
                    },
                    tags: [place.type, 'gần đây'],
                    rating: place.rating,
                    createdAt: TripUtils.getCurrentDateTime()
                });
            });
        }

        return suggestions;
    }

    // Generate activity suggestions
    function generateActivitySuggestions(tripData, preferences) {
        const suggestions = [];
        const destinations = tripData.destinations || [];

        destinations.forEach(destination => {
            if (!destination.checkedIn) return;

            const activities = getRecommendedActivities(destination, preferences);
            activities.forEach(activity => {
                suggestions.push({
                    id: 'activity_' + destination.id + '_' + activity.id,
                    type: SUGGESTION_TYPES.ACTIVITY,
                    priority: SUGGESTION_PRIORITIES.MEDIUM,
                    source: SUGGESTION_SOURCES.AI,
                    title: activity.name,
                    description: `Hoạt động thú vị tại ${destination.name}`,
                    details: {
                        location: destination.name,
                        duration: activity.duration,
                        price: activity.price ? TripUtils.formatMoney(activity.price) : 'Miễn phí'
                    },
                    tags: activity.tags,
                    rating: activity.rating,
                    bookingUrl: activity.bookingUrl,
                    createdAt: TripUtils.getCurrentDateTime()
                });
            });
        });

        return suggestions;
    }

    // Generate weather suggestions
    function generateWeatherSuggestions(tripData) {
        const suggestions = [];
        
        // This would integrate with weather API in real implementation
        // For now, return sample weather-based suggestions
        
        suggestions.push({
            id: 'weather_rain_' + Date.now(),
            type: SUGGESTION_TYPES.WEATHER,
            priority: SUGGESTION_PRIORITIES.HIGH,
            source: SUGGESTION_SOURCES.WEATHER,
            title: 'Dự báo có mưa',
            description: 'Thời tiết có thể có mưa. Chuẩn bị áo mưa và hoạt động trong nhà.',
            details: {
                weather: 'Mưa rào',
                temperature: '25-28°C',
                humidity: '85%'
            },
            tags: ['thời tiết', 'mưa', 'chuẩn bị'],
            createdAt: TripUtils.getCurrentDateTime()
        });

        return suggestions;
    }

    // Generate safety and cultural suggestions
    function generateSafetyAndCulturalSuggestions(tripData) {
        const suggestions = [];
        
        suggestions.push({
            id: 'cultural_tips_' + Date.now(),
            type: SUGGESTION_TYPES.CULTURAL,
            priority: SUGGESTION_PRIORITIES.MEDIUM,
            source: SUGGESTION_SOURCES.AI,
            title: 'Tìm hiểu văn hóa địa phương',
            description: 'Một số điều cần biết về văn hóa và phong tục tại điểm đến.',
            details: {
                tips: 'Chào hỏi bằng cách cúi đầu, tránh chỉ tay vào người',
                dress: 'Ăn mặc lịch sự khi vào chùa',
                language: 'Học vài câu chào cơ bản'
            },
            tags: ['văn hóa', 'phong tục', 'giao tiếp'],
            createdAt: TripUtils.getCurrentDateTime()
        });

        return suggestions;
    }

    // Get filtered suggestions
    function getFilteredSuggestions() {
        const allSuggestions = getSavedSuggestions();
        
        return allSuggestions.filter(suggestion => {
            // Type filter
            if (suggestionFilters.type !== 'all' && suggestion.type !== suggestionFilters.type) {
                return false;
            }
            
            // Priority filter
            if (suggestionFilters.priority !== 'all' && suggestion.priority !== suggestionFilters.priority) {
                return false;
            }
            
            // Applied status filter
            if (suggestionFilters.applied === 'new' && (suggestion.viewed || suggestion.applied || suggestion.dismissed)) {
                return false;
            }
            if (suggestionFilters.applied === 'viewed' && !suggestion.viewed) {
                return false;
            }
            if (suggestionFilters.applied === 'applied' && !suggestion.applied) {
                return false;
            }
            if (suggestionFilters.applied === 'dismissed' && !suggestion.dismissed) {
                return false;
            }
            
            return true;
        }).sort((a, b) => {
            // Sort by priority then by creation date
            const priorityOrder = { urgent: 4, high: 3, medium: 2, low: 1 };
            const aPriority = priorityOrder[a.priority] || 2;
            const bPriority = priorityOrder[b.priority] || 2;
            
            if (aPriority !== bPriority) {
                return bPriority - aPriority;
            }
            
            return new Date(b.createdAt) - new Date(a.createdAt);
        });
    }

    // Group suggestions by type
    function groupSuggestionsByType(suggestions) {
        const grouped = {};
        
        suggestions.forEach(suggestion => {
            if (!grouped[suggestion.type]) {
                grouped[suggestion.type] = [];
            }
            grouped[suggestion.type].push(suggestion);
        });
        
        return grouped;
    }

    // Apply suggestion
    function applySuggestion(suggestionId) {
        const suggestions = getSavedSuggestions();
        const suggestion = suggestions.find(s => s.id === suggestionId);
        
        if (!suggestion) return;
        
        suggestion.applied = true;
        suggestion.appliedAt = TripUtils.getCurrentDateTime();
        suggestion.viewed = true;
        
        // Apply the suggestion based on its type
        applySuggestionByType(suggestion);
        
        saveSuggestions(suggestions);
        update();
        
        TripNotifications.showSuccess(`Đã áp dụng: ${suggestion.title}`);
    }

    // Apply suggestion by type
    function applySuggestionByType(suggestion) {
        switch (suggestion.type) {
            case SUGGESTION_TYPES.DESTINATION:
                // Add to destinations if not exists
                const tripData = TripCore.getData();
                const existingDest = tripData.destinations.find(d => d.name === suggestion.title);
                if (!existingDest) {
                    // TripModals.openModal('destinationModal', { name: suggestion.title });
                }
                break;
                
            case SUGGESTION_TYPES.ACTIVITY:
                // Add to schedule
                // TripModals.openModal('scheduleModal', { title: suggestion.title });
                break;
                
            case SUGGESTION_TYPES.BUDGET:
                // Navigate to budget tab
                TripTabs.switchTab('budget');
                break;
                
            case SUGGESTION_TYPES.SCHEDULE:
                // Navigate to schedule tab
                TripTabs.switchTab('schedule');
                break;
        }
    }

    // Dismiss suggestion
    function dismissSuggestion(suggestionId) {
        const suggestions = getSavedSuggestions();
        const suggestion = suggestions.find(s => s.id === suggestionId);
        
        if (!suggestion) return;
        
        suggestion.dismissed = true;
        suggestion.dismissedAt = TripUtils.getCurrentDateTime();
        suggestion.viewed = true;
        
        saveSuggestions(suggestions);
        update();
        
        TripNotifications.showInfo(`Đã bỏ qua: ${suggestion.title}`);
    }

    // View suggestion details
    function viewSuggestionDetails(suggestionId) {
        const suggestions = getSavedSuggestions();
        const suggestion = suggestions.find(s => s.id === suggestionId);
        
        if (!suggestion) return;
        
        // Mark as viewed
        suggestion.viewed = true;
        saveSuggestions(suggestions);
        
        // Show detailed information
        const details = `
            Loại: ${getSuggestionTypeInfo(suggestion.type).name}
            Mức độ: ${getPriorityText(suggestion.priority)}
            Nguồn: ${getSuggestionSourceInfo(suggestion.source).name}
            
            ${suggestion.description}
            
            ${suggestion.details ? Object.entries(suggestion.details).map(([key, value]) => 
                `${formatDetailLabel(key)}: ${formatDetailValue(key, value)}`
            ).join('\n') : ''}
        `;
        
        alert(details);
    }

    // Update filters
    function updateFilter(filterType, value) {
        suggestionFilters[filterType] = value;
        renderSmartSuggestions();
    }

    // Clear filters
    function clearFilters() {
        suggestionFilters = {
            type: 'all',
            priority: 'all',
            applied: 'all',
            source: 'all'
        };
        renderSmartSuggestions();
    }

    // Refresh suggestions
    function refreshSuggestions() {
        generateSmartSuggestions();
        update();
        TripNotifications.showSuccess('Đã tạo gợi ý mới!');
    }

    // Update preferences
    function updatePreference(key, value) {
        userPreferences.preferences[key] = parseInt(value);
        saveUserPreferences();
        
        // Regenerate suggestions after preference change
        setTimeout(() => {
            generateSmartSuggestions();
            renderSmartSuggestions();
        }, 500);
    }

    // Update budget level
    function updateBudgetLevel(level) {
        userPreferences.budgetLevel = level;
        saveUserPreferences();
        document.querySelectorAll('.budget-option').forEach(option => {
            option.classList.toggle('selected', option.querySelector('input').value === level);
        });
    }

    // Update travel style
    function updateTravelStyle(style) {
        userPreferences.travelStyle = style;
        saveUserPreferences();
        document.querySelectorAll('.travel-style-option').forEach(option => {
            option.classList.toggle('selected', option.querySelector('input').value === style);
        });
    }

    // Save preferences
    function savePreferences() {
        saveUserPreferences();
        generateSmartSuggestions();
        update();
        TripNotifications.showSuccess('Đã lưu sở thích!');
    }

    // Reset preferences
    function resetPreferences() {
        if (confirm('Đặt lại tất cả sở thích về mặc định?')) {
            userPreferences = {
                interests: [],
                budgetLevel: 'medium',
                travelStyle: 'balanced',
                groupSize: 1,
                preferences: {
                    adventure: 50,
                    culture: 50,
                    relaxation: 50,
                    food: 50,
                    shopping: 50,
                    nature: 50
                }
            };
            saveUserPreferences();
            renderPreferencesPanel();
            TripNotifications.showSuccess('Đã đặt lại sở thích!');
        }
    }

    // Calculate suggestion statistics
    function calculateSuggestionStats() {
        const suggestions = getSavedSuggestions();
        
        return {
            totalSuggestions: suggestions.length,
            appliedSuggestions: suggestions.filter(s => s.applied).length,
            highPrioritySuggestions: suggestions.filter(s => s.priority === 'high' || s.priority === 'urgent').length,
            aiSuggestions: suggestions.filter(s => s.source === SUGGESTION_SOURCES.AI).length
        };
    }

    // Get suggestion type info
    function getSuggestionTypeInfo(type) {
        const typeInfos = {
            [SUGGESTION_TYPES.DESTINATION]: { name: 'Điểm đến', icon: '🏝️' },
            [SUGGESTION_TYPES.ACTIVITY]: { name: 'Hoạt động', icon: '🎡' },
            [SUGGESTION_TYPES.RESTAURANT]: { name: 'Nhà hàng', icon: '🍽️' },
            [SUGGESTION_TYPES.ACCOMMODATION]: { name: 'Lưu trú', icon: '🏨' },
            [SUGGESTION_TYPES.TRANSPORT]: { name: 'Di chuyển', icon: '🚗' },
            [SUGGESTION_TYPES.BUDGET]: { name: 'Ngân sách', icon: '💰' },
            [SUGGESTION_TYPES.SCHEDULE]: { name: 'Lịch trình', icon: '📅' },
            [SUGGESTION_TYPES.SAFETY]: { name: 'An toàn', icon: '🛡️' },
            [SUGGESTION_TYPES.WEATHER]: { name: 'Thời tiết', icon: '🌤️' },
            [SUGGESTION_TYPES.CULTURAL]: { name: 'Văn hóa', icon: '🎭' }
        };
        return typeInfos[type] || { name: 'Khác', icon: '💡' };
    }

    // Get suggestion source info
    function getSuggestionSourceInfo(source) {
        const sourceInfos = {
            [SUGGESTION_SOURCES.AI]: { name: 'AI', icon: '🤖' },
            [SUGGESTION_SOURCES.USER_BEHAVIOR]: { name: 'Hành vi người dùng', icon: '👤' },
            [SUGGESTION_SOURCES.WEATHER]: { name: 'Thời tiết', icon: '🌤️' },
            [SUGGESTION_SOURCES.BUDGET_ANALYSIS]: { name: 'Phân tích ngân sách', icon: '💰' },
            [SUGGESTION_SOURCES.SCHEDULE_OPTIMIZATION]: { name: 'Tối ưu lịch trình', icon: '📅' },
            [SUGGESTION_SOURCES.LOCATION_BASED]: { name: 'Dựa trên vị trí', icon: '📍' },
            [SUGGESTION_SOURCES.SEASONAL]: { name: 'Theo mùa', icon: '🍂' },
            [SUGGESTION_SOURCES.POPULAR]: { name: 'Phổ biến', icon: '⭐' }
        };
        return sourceInfos[source] || { name: 'Khác', icon: '💡' };
    }

    // Helper functions
    function getPriorityIcon(priority) {
        const icons = {
            urgent: '🚨',
            high: '🔴',
            medium: '🟡',
            low: '🟢'
        };
        return icons[priority] || '🟡';
    }

    function getPriorityText(priority) {
        const texts = {
            urgent: 'Khẩn cấp',
            high: 'Cao',
            medium: 'Trung bình',
            low: 'Thấp'
        };
        return texts[priority] || 'Trung bình';
    }

    function getPreferenceLabel(key) {
        const labels = {
            adventure: '🏔️ Phiêu lưu',
            culture: '🎭 Văn hóa',
            relaxation: '🧘 Thư giãn',
            food: '🍽️ Ẩm thực',
            shopping: '🛍️ Mua sắm',
            nature: '🌳 Thiên nhiên'
        };
        return labels[key] || key;
    }

    function getBudgetLevelLabel(level) {
        const labels = {
            low: '💰 Tiết kiệm',
            medium: '💳 Trung bình',
            high: '💎 Cao cấp',
            luxury: '👑 Sang trọng'
        };
        return labels[level] || level;
    }

    function getTravelStyleLabel(style) {
        const labels = {
            backpacker: '🎒 Phượt',
            budget: '💰 Tiết kiệm',
            balanced: '⚖️ Cân bằng',
            comfort: '🛋️ Thoải mái',
            luxury: '👑 Sang trọng'
        };
        return labels[style] || style;
    }

    function formatDetailLabel(key) {
        const labels = {
            currentUsage: 'Đã sử dụng',
            remaining: 'Còn lại',
            averageDaily: 'Chi tiêu TB/ngày',
            plannedDaily: 'Kế hoạch/ngày',
            distance: 'Khoảng cách',
            estimatedTime: 'Thời gian di chuyển',
            duration: 'Thời lượng',
            price: 'Giá',
            weather: 'Thời tiết',
            temperature: 'Nhiệt độ',
            humidity: 'Độ ẩm'
        };
        return labels[key] || key;
    }

    function formatDetailValue(key, value) {
        if (key.includes('price') || key.includes('cost')) {
            return typeof value === 'number' ? TripUtils.formatMoney(value) : value;
        }
        return value;
    }

    function generateStars(rating) {
        const fullStars = Math.floor(rating);
        const hasHalfStar = rating % 1 >= 0.5;
        const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
        
        return '★'.repeat(fullStars) + (hasHalfStar ? '☆' : '') + '☆'.repeat(emptyStars);
    }

    // Mock data functions (replace with real APIs)
    function getNearbyPlaces(destination) {
        return [
            { id: 1, name: 'Chùa Jade Emperor', distance: 5, travelTime: '15 phút', type: 'văn hóa', rating: 4.5 },
            { id: 2, name: 'Chợ Ben Thanh', distance: 3, travelTime: '10 phút', type: 'mua sắm', rating: 4.2 }
        ];
    }

    function getRecommendedActivities(destination, preferences) {
        return [
            { 
                id: 1, 
                name: 'Tour ẩm thực đường phố', 
                duration: '3 giờ', 
                price: 500000, 
                tags: ['ẩm thực', 'văn hóa'], 
                rating: 4.8,
                bookingUrl: 'https://example.com/booking/1'
            }
        ];
    }

    // Data persistence
    function getSavedSuggestions() {
        try {
            const saved = localStorage.getItem('tripSuggestions');
            return saved ? JSON.parse(saved) : [];
        } catch (error) {
            console.error('Error loading suggestions:', error);
            return [];
        }
    }

    function saveSuggestions(suggestions) {
        try {
            localStorage.setItem('tripSuggestions', JSON.stringify(suggestions));
        } catch (error) {
            console.error('Error saving suggestions:', error);
        }
    }

    function loadUserPreferences() {
        try {
            const saved = localStorage.getItem('tripUserPreferences');
            if (saved) {
                userPreferences = { ...userPreferences, ...JSON.parse(saved) };
            }
        } catch (error) {
            console.error('Error loading user preferences:', error);
        }
    }

    function saveUserPreferences() {
        try {
            localStorage.setItem('tripUserPreferences', JSON.stringify(userPreferences));
        } catch (error) {
            console.error('Error saving user preferences:', error);
        }
    }

    // Tool functions (placeholders)
    function suggestDestinations() {
        TripNotifications.showInfo('Tính năng gợi ý điểm đến sẽ được phát triển!');
    }

    function suggestRestaurants() {
        TripNotifications.showInfo('Tính năng gợi ý nhà hàng sẽ được phát triển!');
    }

    function suggestActivities() {
        TripNotifications.showInfo('Tính năng gợi ý hoạt động sẽ được phát triển!');
    }

    function optimizeBudget() {
        TripNotifications.showInfo('Tính năng tối ưu ngân sách sẽ được phát triển!');
    }

    function optimizeSchedule() {
        TripNotifications.showInfo('Tính năng tối ưu lịch trình sẽ được phát triển!');
    }

    function weatherBasedSuggestions() {
        TripNotifications.showInfo('Tính năng gợi ý theo thời tiết sẽ được phát triển!');
    }

    function exportSuggestions() {
        const suggestions = getSavedSuggestions();
        const csvContent = convertSuggestionsToCSV(suggestions);
        const filename = `goi_y_${TripUtils.getCurrentDate()}.csv`;
        
        TripUtils.downloadFile(csvContent, filename, 'text/csv');
        TripNotifications.showSuccess('Đã xuất danh sách gợi ý!');
    }

    function convertSuggestionsToCSV(suggestions) {
        const headers = ['Loại', 'Tiêu đề', 'Mô tả', 'Mức độ', 'Trạng thái', 'Ngày tạo'];
        const rows = suggestions.map(suggestion => [
            getSuggestionTypeInfo(suggestion.type).name,
            suggestion.title,
            suggestion.description,
            getPriorityText(suggestion.priority),
            suggestion.applied ? 'Đã áp dụng' : suggestion.dismissed ? 'Đã bỏ qua' : 'Chưa xử lý',
            TripUtils.formatDateTime(suggestion.createdAt)
        ]);

        const csvContent = [headers, ...rows]
            .map(row => row.map(field => `"${field}"`).join(','))
            .join('\n');

        return '\ufeff' + csvContent;
    }

    // Setup event listeners
    function setupEventListeners() {
        // Listen to data changes
        TripCore.on('dataChanged', () => {
            if (TripTabs.getCurrentTab() === 'suggestions') {
                generateSmartSuggestions();
                renderSmartSuggestions();
            }
        });

        TripCore.on('expenseAdded', generateSmartSuggestions);
        TripCore.on('destinationAdded', generateSmartSuggestions);
        TripCore.on('bookingAdded', generateSmartSuggestions);
    }

    // Public API
    return {
        // Initialization
        init,
        render,
        update,

        // Suggestion management
        applySuggestion,
        dismissSuggestion,
        viewSuggestionDetails,
        refreshSuggestions,

        // Filtering
        updateFilter,
        clearFilters,

        // Preferences
        updatePreference,
        updateBudgetLevel,
        updateTravelStyle,
        updatePreferences: savePreferences,
        savePreferences,
        resetPreferences,

        // Tools
        suggestDestinations,
        suggestRestaurants,
        suggestActivities,
        optimizeBudget,
        optimizeSchedule,
        weatherBasedSuggestions,
        exportSuggestions,

        // Data
        SUGGESTION_TYPES,
        SUGGESTION_PRIORITIES,
        userPreferences,
        calculateSuggestionStats
    };
})();