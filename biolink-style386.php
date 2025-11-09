<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ứng dụng quản lý chuyến đi thông minh - Dinhdanh.com</title>
    <meta name="description" content="Ứng dụng quản lý chuyến đi thông minh giúp bạn lập kế hoạch, theo dõi chi phí, quản lý lịch trình và tối ưu hóa ngân sách du lịch một cách hiệu quả.">
    <meta name="keywords" content="quản lý chuyến đi, du lịch, ngân sách, lịch trình, chi phí, ứng dụng du lịch">
    <link rel="canonical" href="https://dinhdanh.com/trip-manager">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "Ứng dụng quản lý chuyến đi thông minh",
        "description": "Ứng dụng quản lý chuyến đi toàn diện giúp lập kế hoạch, theo dõi chi phí và quản lý lịch trình du lịch",
        "applicationCategory": "TravelApplication",
        "operatingSystem": "Web Browser",
        "author": {
            "@type": "Organization",
            "name": "Định Danh",
            "url": "https://dinhdanh.com"
        },
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "VND"
        }
    }
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            color: #1a202c;
            line-height: 1.6;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: white;
        }

        .header-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-stats {
            display: flex;
            gap: 1.5rem;
        }

        .stat-item {
            text-align: center;
            background: rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            backdrop-filter: blur(10px);
        }

        .stat-number {
            display: block;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .stat-label {
            font-size: 0.75rem;
            opacity: 0.9;
            margin-top: 0.25rem;
        }

        .apps-store-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .apps-store-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-1px);
        }

        /* Main Layout */
        .main-container {
            display: flex;
            min-height: calc(100vh - 140px);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: white;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            position: relative;
            z-index: 100;
        }

        .sidebar.mobile-hidden {
            transform: translateX(-100%);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
        }

        /* Tabs Navigation */
        .tabs-nav {
            background: white;
            padding: 1.5rem 0;
        }

        .tab-button {
            background: none;
            border: none;
            padding: 1rem 1.5rem;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 500;
            color: #4a5568;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
            text-align: left;
        }

        .tab-button:hover {
            background: #f7fafc;
            color: #667eea;
            border-left-color: #667eea;
        }

        .tab-button.active {
            color: #667eea;
            border-left-color: #667eea;
            background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
            font-weight: 600;
        }

        .tab-button i {
            width: 20px;
            text-align: left;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            background: #f8fafc;
        }

        /* Tab Content */
        .tab-content {
            display: none;
            padding: 2rem;
            min-height: 600px;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Dashboard Tab */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .dashboard-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.1rem;
            color: #1a202c;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-icon {
            font-size: 1.25rem;
            color: #667eea;
        }

        .card-value {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .card-subtitle {
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .progress-container {
            background: #f1f5f9;
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: width 0.5s ease;
            border-radius: 4px;
        }

        .progress-text {
            font-size: 0.8rem;
            color: #718096;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .quick-action-btn {
            background: white;
            color: #4a5568;
            border: 2px solid #e2e8f0;
            padding: 1.5rem;
            border-radius: 12px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            text-align: center;
        }

        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            border-color: #667eea;
            color: #667eea;
        }

        .quick-action-icon {
            font-size: 2rem;
            color: #667eea;
        }

        /* Forms */
        .form-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
        }

        .form-section h3 {
            color: #1a202c;
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
            border-bottom: 2px solid #667eea;
            padding-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #374151;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.25);
        }

        .btn-secondary {
            background: #6b7280;
        }

        .btn-secondary:hover {
            background: #4b5563;
            box-shadow: 0 8px 25px rgba(107, 114, 128, 0.25);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .btn-danger:hover {
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.25);
        }

        .btn-small {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            width: auto;
        }

        /* Lists */
        .list-container {
            max-height: 400px;
            overflow-y: auto;
        }

        .list-item {
            background: #f8fafc;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            border-left: 4px solid #667eea;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .list-item:hover {
            background: #f1f5f9;
            transform: translateX(4px);
        }

        .item-info h4 {
            color: #1a202c;
            margin-bottom: 0.25rem;
            font-size: 1rem;
            font-weight: 600;
        }

        .item-info p {
            color: #718096;
            font-size: 0.85rem;
            margin-bottom: 0.25rem;
        }

        .item-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .item-amount {
            font-size: 1.1rem;
            font-weight: bold;
            color: #667eea;
        }

        /* Expense Categories */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .category-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid #e2e8f0;
        }

        .category-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .category-icon {
            font-size: 2.25rem;
            margin-bottom: 1rem;
            color: #667eea;
        }

        .category-name {
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 0.75rem;
        }

        .category-amount {
            font-size: 1.25rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 1rem;
        }

        /* Calculator */
        .calculator {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            max-width: 400px;
            margin: 0 auto;
        }

        .calc-display {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            font-size: 1.5rem;
            text-align: right;
            margin-bottom: 1rem;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            font-family: monospace;
        }

        .calc-buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.75rem;
        }

        .calc-btn {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .calc-btn:hover {
            background: #f1f5f9;
            border-color: #cbd5e0;
        }

        .calc-btn.operator {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .calc-btn.operator:hover {
            background: #5a67d8;
        }

        .calc-btn.equals {
            background: #10b981;
            color: white;
            border-color: #10b981;
        }

        .calc-btn.equals:hover {
            background: #059669;
        }

        /* Modal */
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
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1a202c;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #718096;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            color: #1a202c;
            background: #f7fafc;
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50%;
            width: 56px;
            height: 56px;
            font-size: 1.25rem;
            cursor: pointer;
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .fab:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.4);
        }

        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fed7aa;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        /* Timeline Styles */
        .timeline-container {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .timeline-line {
            position: absolute;
            left: 30px;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #e2e8f0;
            border-radius: 2px;
        }

        .timeline-progress {
            position: absolute;
            left: 30px;
            top: 0;
            width: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
            transition: height 0.5s ease;
        }

        .timeline-item {
            position: relative;
            padding: 20px 0 20px 80px;
            margin-bottom: 30px;
        }

        .timeline-marker {
            position: absolute;
            left: 15px;
            top: 25px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: white;
            border: 4px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .timeline-marker.completed {
            border-color: #10b981;
            background: #10b981;
            color: white;
        }

        .timeline-marker.current {
            border-color: #667eea;
            background: #667eea;
            color: white;
            animation: pulse 2s infinite;
        }

        .timeline-marker.checkedin {
            border-color: #10b981;
            background: #10b981;
            color: white;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
            100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
        }

        .timeline-content {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .timeline-content:hover {
            transform: translateX(10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .timeline-content.completed {
            border-left-color: #10b981;
            opacity: 0.8;
        }

        .timeline-content.current {
            border-left-color: #667eea;
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.2);
        }

        .timeline-content.checkedin {
            border-left-color: #10b981;
            background: linear-gradient(135deg, #f0fff4 0%, #dcfce7 100%);
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .timeline-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a202c;
        }

        .timeline-date {
            color: #718096;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .timeline-info {
            margin-bottom: 1rem;
        }

        .timeline-info p {
            margin-bottom: 0.5rem;
            color: #718096;
            font-size: 0.9rem;
        }

        .timeline-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .checkin-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .checkin-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .checkin-btn:disabled {
            background: #6b7280;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .checkout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .checkout-btn:hover {
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        /* Progress Summary */
        .progress-summary {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .progress-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .progress-stat {
            text-align: center;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
        }

        .progress-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.25rem;
        }

        .progress-label {
            font-size: 0.75rem;
            color: #718096;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Current location indicator */
        .current-location {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 600;
        }

        .location-icon {
            font-size: 1.25rem;
            margin-right: 0.5rem;
        }

        /* Footer */
        .footer {
            background: #1a202c;
            color: #a0aec0;
            padding: 3rem 0 1.5rem;
            margin-top: auto;
        }

        .footer-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            color: white;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .footer-section p,
        .footer-section ul {
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            color: #a0aec0;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #667eea;
        }

        .footer-bottom {
            border-top: 1px solid #2d3748;
            padding-top: 1.5rem;
            text-align: center;
        }

        .footer-copyright {
            font-size: 0.85rem;
        }

        /* Data Management */
        .data-management {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            margin-bottom: 1.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block;
            }

            .header-stats {
                display: none;
            }

            .header-title {
                font-size: 1rem;
            }

            .main-container {
                position: relative;
            }

            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 1001;
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .content-area {
                width: 100%;
            }

            .tab-content {
                padding: 1rem;
            }

            .dashboard-grid,
            .form-grid,
            .category-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .fab {
                bottom: 1rem;
                right: 1rem;
                width: 48px;
                height: 48px;
            }
        }

        @media (max-width: 480px) {
            .header-container {
                padding: 0 1rem;
            }

            .tab-content {
                padding: 0.75rem;
            }

            .modal-content {
                margin: 1rem;
                width: calc(100% - 2rem);
                padding: 1.5rem;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="#" class="logo">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Trip Manager</span>
                </a>
                <h1 class="header-title">Quản lý chuyến đi thông minh</h1>
            </div>
            <div class="header-right">
                <div class="header-stats">
                    <div class="stat-item">
                        <span class="stat-number" id="headerBudget">0₫</span>
                        <div class="stat-label">Ngân sách</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" id="headerSpent">0₫</span>
                        <div class="stat-label">Đã chi</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" id="headerDays">0</span>
                        <div class="stat-label">Ngày</div>
                    </div>
                </div>
                <a href="https://dinhdanh.com/apps_store" class="apps-store-btn" target="_blank">
                    <i class="fas fa-cube"></i>
                    Kho ứng dụng
                </a>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" onclick="toggleMobileMenu()"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Tabs Navigation -->
            <div class="tabs-nav">
                <button class="tab-button active" onclick="TripTabs.switchTab('dashboard')">
                    <i class="fas fa-tachometer-alt"></i> Tổng quan
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('schedule')">
                    <i class="fas fa-calendar-alt"></i> Lịch trình
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('timeline')">
                    <i class="fas fa-clock"></i> Timeline
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('destinations')">
                    <i class="fas fa-map-marker-alt"></i> Điểm đến
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('budget')">
                    <i class="fas fa-wallet"></i> Ngân sách
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('expenses')">
                    <i class="fas fa-receipt"></i> Chi tiêu
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('bookings')">
                    <i class="fas fa-ticket-alt"></i> Vé & đặt chỗ
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('checklist')">
                    <i class="fas fa-tasks"></i> Checklist
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('suggestions')">
                    <i class="fas fa-lightbulb"></i> Gợi ý
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('reports')">
                    <i class="fas fa-chart-line"></i> Báo cáo
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('setup')">
                    <i class="fas fa-cog"></i> Thiết lập
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('calculator')">
                    <i class="fas fa-calculator"></i> Tính toán
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('guide')">
                    <i class="fas fa-question-circle"></i> Hướng dẫn
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('faq')">
                    <i class="fas fa-info-circle"></i> FAQ
                </button>
                <button class="tab-button" onclick="TripTabs.switchTab('data')">
                    <i class="fas fa-database"></i> Quản lý dữ liệu
                </button>
            </div>
        </aside>

        <!-- Content Area -->
        <main class="content-area">
            <!-- Dashboard Tab -->
            <div class="tab-content active" id="dashboard">
                <div class="dashboard-grid" id="dashboardGrid">
                    <!-- Dashboard cards will be populated by JavaScript -->
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions" id="quickActions">
                    <!-- Quick action buttons will be populated by JavaScript -->
                </div>

                <!-- Chi tiêu theo danh mục -->
                <div class="form-section" style="margin-top: 30px;">
                    <h3><i class="fas fa-chart-pie"></i> Chi tiêu theo danh mục</h3>
                    <div class="category-grid" id="categoryGrid"></div>
                </div>
            </div>

            <!-- Schedule Tab -->
            <div class="tab-content" id="schedule">
                <div class="current-location" id="currentLocationBanner">
                    <span class="location-icon"><i class="fas fa-map-marker-alt"></i></span>
                    <span id="currentLocationText">Chưa bắt đầu chuyến đi</span>
                </div>

                <div class="form-section">
                    <h3><i class="fas fa-calendar-plus"></i> Lập lịch trình chi tiết</h3>
                    <div id="scheduleContainer">
                        <!-- Schedule content will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Timeline Tab -->
            <div class="tab-content" id="timeline">
                <div class="current-location" id="timelineCurrentLocation">
                    <span class="location-icon"><i class="fas fa-map-marker-alt"></i></span>
                    <span id="timelineCurrentLocationText">Chưa bắt đầu chuyến đi</span>
                </div>

                <div class="progress-summary">
                    <h3 style="margin-bottom: 20px; color: #333;"><i class="fas fa-chart-bar"></i> Tiến độ chuyến đi</h3>
                    <div class="progress-stats" id="timelineProgressStats">
                        <!-- Progress stats will be populated by JavaScript -->
                    </div>
                </div>

                <div class="form-section">
                    <h3><i class="fas fa-route"></i> Lịch trình theo thời gian</h3>
                    <div class="timeline-container" id="timelineContainer">
                        <div class="timeline-line"></div>
                        <div class="timeline-progress" id="timelineProgressLine"></div>
                        <div id="timelineItems"></div>
                    </div>
                </div>
            </div>

            <!-- Destinations Tab -->
            <div class="tab-content" id="destinations">
                <div class="form-section">
                    <h3><i class="fas fa-plus-circle"></i> Thêm điểm đến mới</h3>
                    <div id="destinationForm">
                        <!-- Destination form will be populated by JavaScript -->
                    </div>
                </div>

                <div class="form-section">
                    <h3><i class="fas fa-list"></i> Danh sách điểm đến</h3>
                    <div class="list-container" id="destinationList"></div>
                </div>
            </div>

            <!-- Budget Tab -->
            <div class="tab-content" id="budget">
                <div class="form-section">
                    <h3><i class="fas fa-money-check-alt"></i> Quản lý ngân sách</h3>
                    <div id="budgetContainer">
                        <!-- Budget content will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Expenses Tab -->
            <div class="tab-content" id="expenses">
                <div class="form-section">
                    <h3><i class="fas fa-plus-circle"></i> Thêm chi tiêu mới</h3>
                    <div id="expenseForm">
                        <!-- Expense form will be populated by JavaScript -->
                    </div>
                </div>

                <div class="form-section">
                    <h3><i class="fas fa-history"></i> Lịch sử chi tiêu</h3>
                    <div class="list-container" id="expenseHistory"></div>
                </div>
            </div>

            <!-- Bookings Tab -->
            <div class="tab-content" id="bookings">
                <div class="form-section">
                    <h3><i class="fas fa-clipboard-list"></i> Quản lý vé & đặt chỗ</h3>
                    <div id="bookingsContainer">
                        <!-- Bookings content will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Checklist Tab -->
            <div class="tab-content" id="checklist">
                <div class="form-section">
                    <h3><i class="fas fa-check-square"></i> Danh sách cần làm</h3>
                    <div class="checklist-container" id="checklistContainer">
                        <!-- Checklist content will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Suggestions Tab -->
            <div class="tab-content" id="suggestions">
                <div class="form-section">
                    <h3><i class="fas fa-magic"></i> Gợi ý thông minh</h3>
                    <div id="suggestionsContainer">
                        <!-- Suggestions content will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Reports Tab -->
            <div class="tab-content" id="reports">
                <div class="form-section">
                    <h3><i class="fas fa-chart-bar"></i> Báo cáo tổng kết</h3>
                    <div id="reportsContainer">
                        <!-- Reports content will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Setup Tab -->
            <div class="tab-content" id="setup">
                <div class="form-section">
                    <h3><i class="fas fa-edit"></i> Thông tin chuyến đi</h3>
                    <div id="setupForm">
                        <!-- Setup form will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Calculator Tab -->
            <div class="tab-content" id="calculator">
                <div class="calculator">
                    <h3 style="text-align: center; margin-bottom: 20px;"><i class="fas fa-calculator"></i> Máy tính chi tiêu</h3>
                    <div class="calc-display" id="calcDisplay">0</div>
                    <div class="calc-buttons" id="calcButtons">
                        <!-- Calculator buttons will be populated by JavaScript -->
                    </div>
                    
                    <button class="btn" onclick="TripCalculator.addCalculatedExpense()" style="margin-top: 20px;">
                        <i class="fas fa-plus"></i> Thêm kết quả vào chi tiêu
                    </button>
                </div>
            </div>

            <!-- Guide Tab -->
            <div class="tab-content" id="guide">
                <div class="form-section">
                    <h3><i class="fas fa-info"></i> Giới thiệu ứng dụng</h3>
                    <p>Ứng dụng quản lý chuyến đi thông minh là công cụ toàn diện giúp bạn:</p>
                    <ul style="margin: 1rem 0; padding-left: 2rem;">
                        <li>Lập kế hoạch chi tiết cho chuyến đi</li>
                        <li>Theo dõi và quản lý ngân sách một cách hiệu quả</li>
                        <li>Ghi chép và phân loại chi tiêu theo danh mục</li>
                        <li>Quản lý lịch trình và timeline thời gian thực</li>
                        <li>Theo dõi vé máy bay, khách sạn và các đặt chỗ</li>
                        <li>Tạo checklist công việc cần làm</li>
                        <li>Nhận gợi ý thông minh để tối ưu chi phí</li>
                        <li>Tạo báo cáo tổng kết sau chuyến đi</li>
                    </ul>
                </div>

                <div class="form-section">
                    <h3><i class="fas fa-road"></i> Hướng dẫn từng bước</h3>
                    
                    <div style="background: white; border-radius: 8px; padding: 1.5rem; margin-bottom: 1rem; border-left: 4px solid #667eea; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                        <div style="background: #667eea; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem; margin-bottom: 1rem;">1</div>
                        <h3 style="color: #1a202c; margin-bottom: 0.75rem; font-size: 1.1rem;">Thiết lập thông tin chuyến đi</h3>
                        <p style="color: #718096; line-height: 1.6;">Bắt đầu bằng cách vào tab "Thiết lập" để nhập thông tin cơ bản về chuyến đi như tên, ngày bắt đầu, kết thúc và ngân sách tổng.</p>
                    </div>

                    <div style="background: white; border-radius: 8px; padding: 1.5rem; margin-bottom: 1rem; border-left: 4px solid #667eea; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                        <div style="background: #667eea; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem; margin-bottom: 1rem;">2</div>
                        <h3 style="color: #1a202c; margin-bottom: 0.75rem; font-size: 1.1rem;">Thêm điểm đến</h3>
                        <p style="color: #718096; line-height: 1.6;">Trong tab "Điểm đến", thêm các địa điểm bạn muốn ghé thăm. Mỗi điểm đến có thể có thời gian dự kiến và ghi chú riêng.</p>
                    </div>

                    <div style="background: white; border-radius: 8px; padding: 1.5rem; margin-bottom: 1rem; border-left: 4px solid #667eea; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                        <div style="background: #667eea; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem; margin-bottom: 1rem;">3</div>
                        <h3 style="color: #1a202c; margin-bottom: 0.75rem; font-size: 1.1rem;">Lập lịch trình chi tiết</h3>
                        <p style="color: #718096; line-height: 1.6;">Sử dụng tab "Lịch trình" để tạo kế hoạch hàng ngày. Bạn có thể thêm hoạt động, thời gian và địa điểm cụ thể.</p>
                    </div>

                    <div style="background: white; border-radius: 8px; padding: 1.5rem; margin-bottom: 1rem; border-left: 4px solid #667eea; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                        <div style="background: #667eea; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem; margin-bottom: 1rem;">4</div>
                        <h3 style="color: #1a202c; margin-bottom: 0.75rem; font-size: 1.1rem;">Quản lý ngân sách</h3>
                        <p style="color: #718096; line-height: 1.6;">Phân bổ ngân sách theo từng danh mục trong tab "Ngân sách". Thiết lập giới hạn chi tiêu cho từng loại như ăn uống, di chuyển, mua sắm.</p>
                    </div>

                    <div style="background: white; border-radius: 8px; padding: 1.5rem; margin-bottom: 1rem; border-left: 4px solid #667eea; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                        <div style="background: #667eea; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem; margin-bottom: 1rem;">5</div>
                        <h3 style="color: #1a202c; margin-bottom: 0.75rem; font-size: 1.1rem;">Ghi chép chi tiêu</h3>
                        <p style="color: #718096; line-height: 1.6;">Trong suốt chuyến đi, sử dụng tab "Chi tiêu" hoặc nút floating để nhanh chóng ghi lại các khoản chi. Phân loại theo danh mục để dễ theo dõi.</p>
                    </div>
                </div>

                <div class="form-section">
                    <h3><i class="fas fa-graduation-cap"></i> Kiến thức tổng quát về quản lý chuyến đi</h3>
                    
                    <h4>Tầm quan trọng của việc lập kế hoạch</h4>
                    <p>Việc lập kế hoạch chi tiết trước chuyến đi giúp:</p>
                    <ul style="margin: 1rem 0; padding-left: 2rem;">
                        <li>Tiết kiệm 20-30% chi phí so với đi không có kế hoạch</li>
                        <li>Tránh bỏ lỡ những điểm đến quan trọng</li>
                        <li>Tối ưu hóa thời gian và di chuyển</li>
                        <li>Giảm stress trong quá trình du lịch</li>
                    </ul>

                    <h4>Nguyên tắc 50/30/20 cho ngân sách du lịch</h4>
                    <ul style="margin: 1rem 0; padding-left: 2rem;">
                        <li><strong>50%</strong> cho chi phí cơ bản (vé, khách sạn, ăn uống chính)</li>
                        <li><strong>30%</strong> cho hoạt động và giải trí</li>
                        <li><strong>20%</strong> dự phòng cho tình huống khẩn cấp</li>
                    </ul>

                    <h4>Mẹo tiết kiệm chi phí</h4>
                    <ul style="margin: 1rem 0; padding-left: 2rem;">
                        <li>Đặt vé và khách sạn sớm để có giá tốt</li>
                        <li>Chọn ngày đi vào thời điểm thấp điểm</li>
                        <li>Sử dụng thẻ tín dụng có cashback du lịch</li>
                        <li>Tìm hiểu về giao thông công cộng tại địa điểm đến</li>
                    </ul>
                </div>
            </div>

            <!-- FAQ Tab -->
            <div class="tab-content" id="faq">
                <div class="form-section">
                    <div style="border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 0.75rem; overflow: hidden;">
                        <div style="background: #f8fafc; padding: 1rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 500; transition: all 0.3s ease;" onclick="toggleFAQ(this)">
                            <span>Dữ liệu của tôi có được lưu trữ an toàn không?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div style="padding: 1rem; background: white; display: none; color: #718096; line-height: 1.6;">
                            Tất cả dữ liệu được lưu trữ cục bộ trên thiết bị của bạn thông qua Local Storage của trình duyệt. Chúng tôi không thu thập hay lưu trữ bất kỳ thông tin cá nhân nào trên server. Bạn có thể xuất dữ liệu để sao lưu tự quản.
                        </div>
                    </div>

                    <div style="border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 0.75rem; overflow: hidden;">
                        <div style="background: #f8fafc; padding: 1rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 500; transition: all 0.3s ease;" onclick="toggleFAQ(this)">
                            <span>Tôi có thể sử dụng ứng dụng trên nhiều thiết bị không?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div style="padding: 1rem; background: white; display: none; color: #718096; line-height: 1.6;">
                            Hiện tại ứng dụng lưu dữ liệu cục bộ trên từng thiết bị. Để đồng bộ giữa các thiết bị, bạn có thể sử dụng tính năng xuất/nhập dữ liệu trong tab "Quản lý dữ liệu".
                        </div>
                    </div>

                    <div style="border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 0.75rem; overflow: hidden;">
                        <div style="background: #f8fafc; padding: 1rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 500; transition: all 0.3s ease;" onclick="toggleFAQ(this)">
                            <span>Làm thế nào để tạo ngân sách hợp lý?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div style="padding: 1rem; background: white; display: none; color: #718096; line-height: 1.6;">
                            Hãy bắt đầu bằng cách ước tính tổng chi phí, sau đó áp dụng nguyên tắc 50/30/20: 50% cho chi phí cơ bản, 30% cho giải trí, 20% dự phòng. Ứng dụng sẽ giúp bạn theo dõi và cảnh báo khi vượt ngân sách.
                        </div>
                    </div>

                    <div style="border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 0.75rem; overflow: hidden;">
                        <div style="background: #f8fafc; padding: 1rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 500; transition: all 0.3s ease;" onclick="toggleFAQ(this)">
                            <span>Có thể sử dụng offline không?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div style="padding: 1rem; background: white; display: none; color: #718096; line-height: 1.6;">
                            Có, ứng dụng hoạt động hoàn toàn offline sau khi tải trang lần đầu. Tất cả dữ liệu được lưu trữ cục bộ và không cần kết nối internet để sử dụng.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Management Tab -->
            <div class="tab-content" id="data">
                <div class="data-management">
                    <h3><i class="fas fa-download"></i> Xuất dữ liệu</h3>
                    <p style="margin-bottom: 1rem;">Xuất tất cả dữ liệu chuyến đi của bạn thành file JSON để sao lưu hoặc chuyển sang thiết bị khác.</p>
                    <button class="btn btn-secondary" onclick="DataManager.exportData()">
                        <i class="fas fa-download"></i> Xuất dữ liệu
                    </button>
                </div>

                <div class="data-management">
                    <h3><i class="fas fa-upload"></i> Nhập dữ liệu</h3>
                    <p style="margin-bottom: 1rem;">Khôi phục dữ liệu từ file sao lưu đã xuất trước đó.</p>
                    <div class="form-group">
                        <input type="file" id="importFile" class="form-control" accept=".json">
                    </div>
                    <button class="btn btn-secondary" onclick="DataManager.importData()">
                        <i class="fas fa-upload"></i> Nhập dữ liệu
                    </button>
                </div>

                <div class="data-management">
                    <h3><i class="fas fa-seedling"></i> Tạo dữ liệu mẫu</h3>
                    <p style="margin-bottom: 1rem;">Tạo dữ liệu mẫu để trải nghiệm các tính năng của ứng dụng.</p>
                    <button class="btn" onclick="DataManager.generateSampleData()">
                        <i class="fas fa-magic"></i> Tạo dữ liệu mẫu
                    </button>
                </div>

                <div class="data-management">
                    <h3><i class="fas fa-trash"></i> Xóa dữ liệu</h3>
                    <p style="margin-bottom: 1rem;">Xóa toàn bộ dữ liệu ứng dụng. <strong>Thao tác này không thể hoàn tác!</strong></p>
                    <button class="btn btn-danger" onclick="DataManager.clearAllData()">
                        <i class="fas fa-exclamation-triangle"></i> Xóa tất cả dữ liệu
                    </button>
                </div>

                <div class="data-management">
                    <h3><i class="fas fa-info-circle"></i> Thông tin lưu trữ</h3>
                    <div id="storageInfo">
                        <p><strong>Dung lượng đã sử dụng:</strong> <span id="storageUsed">Đang tính toán...</span></p>
                        <p><strong>Số lượng chuyến đi:</strong> <span id="tripCount">0</span></p>
                        <p><strong>Số lượng chi tiêu:</strong> <span id="expenseCount">0</span></p>
                        <p><strong>Lần cập nhật cuối:</strong> <span id="lastUpdate">Chưa có dữ liệu</span></p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Về ứng dụng</h3>
                    <p>Ứng dụng quản lý chuyến đi thông minh giúp bạn tổ chức và theo dõi mọi khía cạnh của chuyến du lịch một cách hiệu quả và tiện lợi.</p>
                </div>
                
                <div class="footer-section">
                    <h3>Tính năng chính</h3>
                    <ul>
                        <li><a href="#" onclick="TripTabs.switchTab('budget')">Quản lý ngân sách</a></li>
                        <li><a href="#" onclick="TripTabs.switchTab('schedule')">Lập lịch trình</a></li>
                        <li><a href="#" onclick="TripTabs.switchTab('expenses')">Theo dõi chi tiêu</a></li>
                        <li><a href="#" onclick="TripTabs.switchTab('reports')">Báo cáo tổng kết</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Hỗ trợ</h3>
                    <ul>
                        <li><a href="#" onclick="TripTabs.switchTab('guide')">Hướng dẫn sử dụng</a></li>
                        <li><a href="#" onclick="TripTabs.switchTab('faq')">Câu hỏi thường gặp</a></li>
                        <li><a href="https://dinhdanh.com/apps_store" target="_blank">Kho ứng dụng</a></li>
                        <li><a href="https://dinhdanh.com" target="_blank">Website chính</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Liên hệ</h3>
                    <ul>
                        <li><a href="mailto:contact@dinhdanh.com">Email hỗ trợ</a></li>
                        <li><a href="https://dinhdanh.com" target="_blank">DINHDANH.COM</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p class="footer-copyright">
                    <i class="fas fa-copyright"></i>
                    Bản quyền 2025 Định Danh - DINHDANH.COM. Tất cả quyền được bảo lưu.
                </p>
            </div>
        </div>
    </footer>

    <!-- Floating Action Button -->
    <button class="fab" onclick="TripModals.openModal('quickExpenseModal')">
        <i class="fas fa-plus"></i>
    </button>

    <!-- Modals Container -->
    <div id="modalsContainer">
        <!-- Modals will be populated by JavaScript -->
    </div>

    <!-- JavaScript Modules -->
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('show');
        }

        // FAQ toggle
        function toggleFAQ(element) {
            const answer = element.nextElementSibling;
            const icon = element.querySelector('i');
            
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
            icon.style.transform = answer.style.display === 'block' ? 'rotate(180deg)' : 'rotate(0deg)';
        }

        // Data Manager object for localStorage operations
        const DataManager = {
            exportData() {
                try {
                    const allData = {};
                    for (let i = 0; i < localStorage.length; i++) {
                        const key = localStorage.key(i);
                        if (key && key.startsWith('trip_')) {
                            allData[key] = localStorage.getItem(key);
                        }
                    }
                    const dataStr = JSON.stringify(allData, null, 2);
                    const dataBlob = new Blob([dataStr], { type: 'application/json' });
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(dataBlob);
                    link.download = `trip-data-backup-${new Date().toISOString().split('T')[0]}.json`;
                    link.click();
                    alert('Xuất dữ liệu thành công!');
                } catch (error) {
                    console.error('Export error:', error);
                    alert('Lỗi khi xuất dữ liệu!');
                }
            },

            importData() {
                const fileInput = document.getElementById('importFile');
                const file = fileInput.files[0];
                if (!file) {
                    alert('Vui lòng chọn file để nhập!');
                    return;
                }
                const reader = new FileReader();
                reader.onload = (e) => {
                    try {
                        const data = JSON.parse(e.target.result);
                        if (confirm('Việc nhập dữ liệu sẽ ghi đè lên dữ liệu hiện tại. Bạn có chắc chắn muốn tiếp tục?')) {
                            for (let i = localStorage.length - 1; i >= 0; i--) {
                                const key = localStorage.key(i);
                                if (key && key.startsWith('trip_')) {
                                    localStorage.removeItem(key);
                                }
                            }
                            for (const [key, value] of Object.entries(data)) {
                                localStorage.setItem(key, value);
                            }
                            alert('Nhập dữ liệu thành công!');
                            setTimeout(() => location.reload(), 1000);
                        }
                    } catch (error) {
                        alert('File không hợp lệ!');
                    }
                };
                reader.readAsText(file);
            },

            generateSampleData() {
                if (confirm('Việc tạo dữ liệu mẫu sẽ ghi đè lên dữ liệu hiện tại. Bạn có chắc chắn?')) {
                    const sampleTrip = {
                        name: 'Chuyến đi Đà Lạt - Mẫu',
                        startDate: '2025-01-15',
                        endDate: '2025-01-18',
                        budget: 5000000,
                        description: 'Chuyến đi nghỉ dưỡng 4 ngày 3 đêm tại Đà Lạt'
                    };
                    localStorage.setItem('trip_info', JSON.stringify(sampleTrip));
                    localStorage.setItem('trip_last_update', new Date().toISOString());
                    alert('Tạo dữ liệu mẫu thành công!');
                    setTimeout(() => location.reload(), 1000);
                }
            },

            clearAllData() {
                if (confirm('Bạn có chắc chắn muốn xóa TẤT CẢ dữ liệu? Hành động này KHÔNG THỂ hoàn tác!')) {
                    if (confirm('Xác nhận lần cuối: Tất cả dữ liệu chuyến đi sẽ bị xóa vĩnh viễn!')) {
                        for (let i = localStorage.length - 1; i >= 0; i--) {
                            const key = localStorage.key(i);
                            if (key && key.startsWith('trip_')) {
                                localStorage.removeItem(key);
                            }
                        }
                        alert('Đã xóa tất cả dữ liệu!');
                        setTimeout(() => location.reload(), 1000);
                    }
                }
            }
        };

        // Load JavaScript modules dynamically - GIỮ NGUYÊN LOGIC GỐC
        const scripts = [
            '<?= ASSETS_FULL_URL ?>trip/trip-utils.js?v=<?= TRIP_VERSION ?>v1_0_0_utils',
            '<?= ASSETS_FULL_URL ?>trip/trip-core.js?v=<?= TRIP_VERSION ?>v1_0_0_core',
            '<?= ASSETS_FULL_URL ?>trip/trip-notifications.js?v=<?= TRIP_VERSION ?>v1_0_0_notifications',
            '<?= ASSETS_FULL_URL ?>trip/trip-modals.js?v=<?= TRIP_VERSION ?>v1_0_0_modals',
            '<?= ASSETS_FULL_URL ?>trip/trip-tabs.js?v=<?= TRIP_VERSION ?>v1_0_0_tabs',
            '<?= ASSETS_FULL_URL ?>trip/trip-dashboard.js?v=<?= TRIP_VERSION ?>v1_0_0_dashboard',
            '<?= ASSETS_FULL_URL ?>trip/trip-schedule.js?v=<?= TRIP_VERSION ?>v1_0_0_schedule',
            '<?= ASSETS_FULL_URL ?>trip/trip-destinations.js?v=<?= TRIP_VERSION ?>v1_0_0_destinations',
            '<?= ASSETS_FULL_URL ?>trip/trip-budget.js?v=<?= TRIP_VERSION ?>v1_0_0_budget',
            '<?= ASSETS_FULL_URL ?>trip/trip-expenses.js?v=<?= TRIP_VERSION ?>v1_0_0_expenses',
            '<?= ASSETS_FULL_URL ?>trip/trip-bookings.js?v=<?= TRIP_VERSION ?>v1_0_0_bookings',
            '<?= ASSETS_FULL_URL ?>trip/trip-checklist.js?v=<?= TRIP_VERSION ?>v1_0_0_checklist',
            '<?= ASSETS_FULL_URL ?>trip/trip-suggestions.js?v=<?= TRIP_VERSION ?>v1_0_0_suggestions',
            '<?= ASSETS_FULL_URL ?>trip/trip-timeline.js?v=<?= TRIP_VERSION ?>v1_0_0_timeline',
            '<?= ASSETS_FULL_URL ?>trip/trip-reports.js?v=<?= TRIP_VERSION ?>v1_0_0_reports',
            '<?= ASSETS_FULL_URL ?>trip/trip-calculator.js?v=<?= TRIP_VERSION ?>v1_0_0_calculdwedweator',
            '<?= ASSETS_FULL_URL ?>trip/trip-main.js?v=<?= TRIP_VERSION ?>v1_0_0_madwddwdxsdin'
        ];

        // Load scripts sequentially - GIỮ NGUYÊN LOGIC GỐC
        let loadedScripts = 0;
        
        function loadScript(src) {
            return new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.src = src;
                script.onload = resolve;
                script.onerror = reject;
                document.head.appendChild(script);
            });
        }

        async function loadAllScripts() {
            try {
                for (const src of scripts) {
                    await loadScript(src);
                    loadedScripts++;
                    console.log(`Loaded ${loadedScripts}/${scripts.length}: ${src.split('/').pop()}`);
                }
                
                console.log('All scripts loaded successfully!');
                
                // Initialize the application - GIỮ NGUYÊN
                if (typeof TripMain !== 'undefined' && TripMain.init) {
                    TripMain.init();
                } else {
                    console.error('TripMain not found or init method missing');
                }
            } catch (error) {
                console.error('Error loading scripts:', error);
                
                // Fallback: show error message - GIỮ NGUYÊN
                document.body.innerHTML = `
                    <div style="display: flex; align-items: center; justify-content: center; height: 100vh; background: #f8f9fa;">
                        <div style="text-align: center; padding: 40px; background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                            <h2 style="color: #e74c3c; margin-bottom: 20px;"><i class="fas fa-exclamation-triangle"></i> Lỗi tải ứng dụng</h2>
                            <p style="color: #6c757d; margin-bottom: 20px;">Không thể tải các module JavaScript. Vui lòng kiểm tra kết nối mạng và thử lại.</p>
                            <button onclick="location.reload()" style="background: #667eea; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-redo"></i> Tải lại trang
                            </button>
                        </div>
                    </div>
                `;
            }
        }

        // Start loading scripts when DOM is ready - GIỮ NGUYÊN LOGIC GỐC
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', loadAllScripts);
        } else {
            loadAllScripts();
        }

        // Handle modal clicks - GIỮ NGUYÊN
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        };
    </script>
</body>
</html>