/**
 * Trip Manager - Utility Functions
 * Version: 1.0.0
 * Contains common utility functions used across the application
 */

window.TripUtils = (function() {
    'use strict';

    // Currency formatting
    function formatMoney(amount, currency = 'VND') {
        try {
            if (typeof amount !== 'number' || isNaN(amount)) {
                return '0₫';
            }

            switch (currency) {
                case 'VND':
                    return new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(amount);
                case 'USD':
                    return new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'USD'
                    }).format(amount);
                case 'EUR':
                    return new Intl.NumberFormat('de-DE', {
                        style: 'currency',
                        currency: 'EUR'
                    }).format(amount);
                default:
                    return `${amount.toLocaleString()} ${currency}`;
            }
        } catch (error) {
            console.error('Error formatting money:', error);
            return `${amount || 0}₫`;
        }
    }

    // Date formatting
    function formatDate(dateString, options = {}) {
        try {
            if (!dateString) return 'Không xác định';
            
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return 'Ngày không hợp lệ';
            
            const defaultOptions = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                ...options
            };
            
            return date.toLocaleDateString('vi-VN', defaultOptions);
        } catch (error) {
            console.error('Error formatting date:', error);
            return 'Lỗi hiển thị ngày';
        }
    }

    // Date time formatting
    function formatDateTime(dateTimeString, options = {}) {
        try {
            if (!dateTimeString) return 'Không xác định';
            
            const date = new Date(dateTimeString);
            if (isNaN(date.getTime())) return 'Ngày không hợp lệ';
            
            const defaultOptions = {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                ...options
            };
            
            return date.toLocaleString('vi-VN', defaultOptions);
        } catch (error) {
            console.error('Error formatting datetime:', error);
            return 'Lỗi hiển thị ngày';
        }
    }

    // Time formatting
    function formatTime(dateTimeString) {
        try {
            if (!dateTimeString) return 'Không xác định';
            
            const date = new Date(dateTimeString);
            if (isNaN(date.getTime())) return 'Giờ không hợp lệ';
            
            return date.toLocaleTimeString('vi-VN', {
                hour: '2-digit',
                minute: '2-digit'
            });
        } catch (error) {
            console.error('Error formatting time:', error);
            return 'Lỗi hiển thị giờ';
        }
    }

    // Add days to date
    function addDays(dateString, days) {
        try {
            if (!dateString || !days) return dateString;
            
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return dateString;
            
            date.setDate(date.getDate() + parseInt(days));
            return date.toISOString().split('T')[0];
        } catch (error) {
            console.error('Error adding days:', error);
            return dateString;
        }
    }

    // Calculate days between dates
    function daysBetween(date1, date2) {
        try {
            const d1 = new Date(date1);
            const d2 = new Date(date2);
            
            if (isNaN(d1.getTime()) || isNaN(d2.getTime())) return 0;
            
            const diffTime = Math.abs(d2 - d1);
            return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        } catch (error) {
            console.error('Error calculating days between:', error);
            return 0;
        }
    }

    // Get current date in ISO format
    function getCurrentDate() {
        return new Date().toISOString().split('T')[0];
    }

    // Get current datetime in ISO format
    function getCurrentDateTime() {
        return new Date().toISOString();
    }

    // Validate email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Validate phone number (Vietnamese format)
    function isValidPhone(phone) {
        const phoneRegex = /^(\+84|84|0)(3|5|7|8|9)[0-9]{8}$/;
        return phoneRegex.test(phone.replace(/\s/g, ''));
    }

    // Generate unique ID
    function generateId() {
        return Date.now() + Math.random().toString(36).substr(2, 9);
    }

    // Deep clone object
    function deepClone(obj) {
        try {
            return JSON.parse(JSON.stringify(obj));
        } catch (error) {
            console.error('Error deep cloning:', error);
            return obj;
        }
    }

    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Throttle function
    function throttle(func, limit) {
        let inThrottle;
        return function(...args) {
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    // Format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Escape HTML
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    // Create element with attributes
    function createElement(tag, attributes = {}, content = '') {
        const element = document.createElement(tag);
        
        Object.keys(attributes).forEach(key => {
            if (key === 'className') {
                element.className = attributes[key];
            } else if (key === 'innerHTML') {
                element.innerHTML = attributes[key];
            } else {
                element.setAttribute(key, attributes[key]);
            }
        });
        
        if (content) {
            element.textContent = content;
        }
        
        return element;
    }

    // Get element by ID safely
    function getElement(id) {
        const element = document.getElementById(id);
        if (!element) {
            console.warn(`Element with ID '${id}' not found`);
        }
        return element;
    }

    // Show/hide element
    function toggleElement(element, show) {
        if (!element) return;
        element.style.display = show ? 'block' : 'none';
    }

    // Add class if not exists
    function addClass(element, className) {
        if (element && !element.classList.contains(className)) {
            element.classList.add(className);
        }
    }

    // Remove class if exists
    function removeClass(element, className) {
        if (element && element.classList.contains(className)) {
            element.classList.remove(className);
        }
    }

    // Toggle class
    function toggleClass(element, className) {
        if (element) {
            element.classList.toggle(className);
        }
    }

    // Wait for element to exist
    function waitForElement(selector, timeout = 5000) {
        return new Promise((resolve, reject) => {
            const element = document.querySelector(selector);
            if (element) {
                resolve(element);
                return;
            }

            const observer = new MutationObserver((mutations, obs) => {
                const element = document.querySelector(selector);
                if (element) {
                    obs.disconnect();
                    resolve(element);
                }
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });

            setTimeout(() => {
                observer.disconnect();
                reject(new Error(`Element ${selector} not found within ${timeout}ms`));
            }, timeout);
        });
    }

    // Convert string to slug
    function slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    // Random number between min and max
    function randomBetween(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    // Check if object is empty
    function isEmpty(obj) {
        if (obj === null || obj === undefined) return true;
        if (Array.isArray(obj) || typeof obj === 'string') return obj.length === 0;
        if (typeof obj === 'object') return Object.keys(obj).length === 0;
        return false;
    }

    // Capitalize first letter
    function capitalize(text) {
        if (!text) return '';
        return text.charAt(0).toUpperCase() + text.slice(1);
    }

    // Truncate text
    function truncate(text, length = 100, suffix = '...') {
        if (!text || text.length <= length) return text;
        return text.substring(0, length) + suffix;
    }

    // Parse number safely
    function parseNumber(value, defaultValue = 0) {
        const parsed = parseFloat(value);
        return isNaN(parsed) ? defaultValue : parsed;
    }

    // Parse integer safely
    function parseInt(value, defaultValue = 0) {
        const parsed = window.parseInt(value, 10);
        return isNaN(parsed) ? defaultValue : parsed;
    }

    // Get query parameter
    function getQueryParam(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Set query parameter
    function setQueryParam(name, value) {
        const url = new URL(window.location);
        url.searchParams.set(name, value);
        window.history.pushState({}, '', url);
    }

    // Copy to clipboard
    async function copyToClipboard(text) {
        try {
            await navigator.clipboard.writeText(text);
            return true;
        } catch (error) {
            console.error('Failed to copy to clipboard:', error);
            return false;
        }
    }

    // Download file
    function downloadFile(content, filename, contentType = 'application/json') {
        const blob = new Blob([content], { type: contentType });
        const url = URL.createObjectURL(blob);
        
        const link = document.createElement('a');
        link.href = url;
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        URL.revokeObjectURL(url);
    }

    // Load image
    function loadImage(src) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.onload = () => resolve(img);
            img.onerror = reject;
            img.src = src;
        });
    }

    // Detect mobile device
    function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

    // Get browser info
    function getBrowserInfo() {
        const ua = navigator.userAgent;
        let browser = 'Unknown';
        
        if (ua.includes('Chrome')) browser = 'Chrome';
        else if (ua.includes('Firefox')) browser = 'Firefox';
        else if (ua.includes('Safari')) browser = 'Safari';
        else if (ua.includes('Edge')) browser = 'Edge';
        else if (ua.includes('Opera')) browser = 'Opera';
        
        return {
            browser,
            userAgent: ua,
            isMobile: isMobile()
        };
    }

    // Public API
    return {
        // Date & Time
        formatMoney,
        formatDate,
        formatDateTime,
        formatTime,
        addDays,
        daysBetween,
        getCurrentDate,
        getCurrentDateTime,
        
        // Validation
        isValidEmail,
        isValidPhone,
        
        // Utilities
        generateId,
        deepClone,
        debounce,
        throttle,
        formatFileSize,
        escapeHtml,
        
        // DOM Utilities
        createElement,
        getElement,
        toggleElement,
        addClass,
        removeClass,
        toggleClass,
        waitForElement,
        
        // String Utilities
        slugify,
        capitalize,
        truncate,
        
        // Number Utilities
        randomBetween,
        parseNumber,
        parseInt,
        
        // Object Utilities
        isEmpty,
        
        // URL Utilities
        getQueryParam,
        setQueryParam,
        
        // File Utilities
        copyToClipboard,
        downloadFile,
        loadImage,
        
        // Device Detection
        isMobile,
        getBrowserInfo
    };
})();