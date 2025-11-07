<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleep optimizer pro - Ứng dụng tối ưu hóa giấc ngủ chuyên nghiệp</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #667eea 100%)!important;
            min-height: 100vh;
            color: #333;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        .top-header {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }

        .top-header .header-content {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .top-header .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .top-header .logo-section i {
            font-size: 2rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .top-header h1 {
            font-size: 1.5rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        .top-header .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .top-header .app-store-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .top-header .app-store-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .mobile-menu-btn {
            display: none;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        /* Main Layout */
        .main-wrapper {
            display: flex;
            flex: 1;
            width: 100%;
            max-width: 100%;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px 0;
            overflow-y: auto;
            position: sticky;
            top: 70px;
            height: calc(100vh - 70px - 60px);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu button {
            width: 100%;
            padding: 14px 20px;
            background: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 600;
            color: #4b5563;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 3px solid transparent;
        }

        .sidebar-menu button i {
            width: 20px;
            font-size: 1.1rem;
        }

        .sidebar-menu button:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border-left-color: #667eea;
        }

        .sidebar-menu button.active {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.15), transparent);
            color: #667eea;
            border-left-color: #667eea;
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
            max-width: 100%;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .content {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Footer Styles */
        .bottom-footer {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px);
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            text-align: center;
            width: 100%;
        }

        .bottom-footer p {
            margin: 0;
            color: #4b5563;
            font-size: 0.9rem;
        }

        .bottom-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .bottom-footer a:hover {
            text-decoration: underline;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }

        .section-header h2 {
            font-size: 2rem;
            color: #1e293b;
            font-weight: 700;
        }

        .section-header .icon {
            font-size: 1.8rem;
        }

        .info-btn {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .info-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
        }

        .info-box {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border-left: 5px solid #3b82f6;
            padding: 20px;
            margin: 15px 0;
            border-radius: 0 12px 12px 0;
            display: none;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        .info-box.show {
            display: block;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .info-box h4 {
            color: #1e40af;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .info-box p {
            color: #1d4ed8;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .info-box ul {
            color: #1d4ed8;
            margin-left: 20px;
            line-height: 1.6;
        }

        .grid {
            display: grid;
            gap: 25px;
        }

        .grid-2 { grid-template-columns: 1fr 1fr; }
        .grid-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-4 { grid-template-columns: repeat(4, 1fr); }

        @media (max-width: 1024px) {
            .grid-3, .grid-4 { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .nav-tabs { grid-template-columns: repeat(2, 1fr); }
            .content { padding: 25px; }
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .card h3 {
            color: #1e293b;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            background: white;
        }

        .form-group small {
            display: block;
            margin-top: 6px;
            color: #6b7280;
            font-size: 0.85rem;
            font-style: italic;
        }

        /* Checkbox and Radio Styles */
        .form-group input[type="checkbox"],
        .form-group input[type="radio"] {
            width: auto;
            min-width: 18px;
            height: 18px;
            margin: 0;
            cursor: pointer;
            flex-shrink: 0;
            accent-color: #667eea;
        }

        .form-group label input[type="checkbox"],
        .form-group label input[type="radio"] {
            margin-right: 8px;
            margin-top: 2px;
        }

        /* Label with checkbox/radio - flex layout */
        .form-group label {
            cursor: pointer;
            line-height: 1.5;
        }

        .form-group label[style*="display: flex"] {
            margin-bottom: 10px;
        }

        .form-group label[style*="display: flex"] input[type="checkbox"],
        .form-group label[style*="display: flex"] input[type="radio"] {
            margin-top: 3px;
        }

        /* Fix for inputs in flex containers */
        .form-group input[type="number"],
        .form-group input[type="text"] {
            min-width: 0;
        }

        /* Disabled checkbox style */
        .form-group input[type="checkbox"]:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Grid adjustments for form layouts */
        .grid .form-group {
            margin-bottom: 15px;
        }

        /* Ensure proper spacing in STOP-BANG and Checklist sections */
        .card .form-group label[style*="display: flex"] {
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .card .form-group label[style*="display: flex"]:last-child {
            border-bottom: none;
        }

        /* Fix for nested inputs in flex */
        .form-group > div[style*="display: flex"] {
            gap: 10px;
            align-items: center;
        }

        .form-group > div[style*="display: flex"] input[type="checkbox"] {
            flex-shrink: 0;
        }

        .btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-primary { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .btn-success { background: linear-gradient(135deg, #10b981, #059669); }
        .btn-warning { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .btn-danger { background: linear-gradient(135deg, #ef4444, #dc2626); }

        .cycle-result {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 18px;
            margin: 12px 0;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .cycle-result:hover {
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .cycle-result.recommended {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border-color: #10b981;
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.2);
        }

        .cycle-result.optimal {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-color: #f59e0b;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        .cycle-result .cycle-time {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .cycle-result .cycle-details {
            font-size: 0.9rem;
            color: #6b7280;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cycle-result .recommended-badge {
            background: #10b981;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .quality-score {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 20px auto;
            position: relative;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .quality-score::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            padding: 4px;
            background: conic-gradient(from 0deg, #10b981, #f59e0b, #ef4444, #10b981);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: xor;
        }

        .quality-score.excellent {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: #166534;
        }

        .quality-score.good {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
        }

        .quality-score.poor {
            background: linear-gradient(135deg, #fecaca, #fca5a5);
            color: #991b1b;
        }

        .factor-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 12px;
            margin-bottom: 10px;
            border-left: 4px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .factor-item:hover {
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .factor-item.good { border-left-color: #10b981; }
        .factor-item.fair { border-left-color: #f59e0b; }
        .factor-item.poor { border-left-color: #ef4444; }

        .factor-status {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .status-dot.good { background: #10b981; }
        .status-dot.fair { background: #f59e0b; }
        .status-dot.poor { background: #ef4444; }

        .rating-buttons {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .rating-btn {
            flex: 1;
            padding: 12px 8px;
            border: 2px solid #e5e7eb;
            background: #f9fafb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            text-align: center;
        }

        .rating-btn:hover {
            background: #e5e7eb;
            transform: translateY(-1px);
        }

        .rating-btn.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .recommendation-card {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border: 2px solid #bfdbfe;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .recommendation-card:hover {
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
            transform: translateY(-2px);
        }

        .recommendation-header {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }

        .category-badge {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            white-space: nowrap;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .recommendation-list {
            list-style: none;
            padding: 0;
        }

        .recommendation-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
            line-height: 1.6;
            padding: 8px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .recommendation-list li:hover {
            background: rgba(59, 130, 246, 0.05);
        }

        .recommendation-list li::before {
            content: "✓";
            color: #10b981;
            font-weight: bold;
            font-size: 1.1rem;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .nap-plan {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border: 2px solid #0ea5e9;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .nap-plan::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #0ea5e9, #0284c7, #0ea5e9);
        }

        .nap-plan.optimal {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border-color: #10b981;
        }

        .nap-plan.optimal::before {
            background: linear-gradient(90deg, #10b981, #059669, #10b981);
        }

        .nap-plan.warning {
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            border-color: #f59e0b;
        }

        .nap-plan.warning::before {
            background: linear-gradient(90deg, #f59e0b, #d97706, #f59e0b);
        }

        .nap-time {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin: 12px 0;
        }

        .nap-benefit, .nap-warning {
            padding: 16px;
            border-radius: 12px;
            margin: 16px 0;
        }

        .nap-benefit {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border-left: 4px solid #3b82f6;
        }

        .nap-warning {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-left: 4px solid #f59e0b;
        }

        .journal-entry {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
        }

        .journal-entry:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .journal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
        }

        .journal-date {
            font-weight: 700;
            color: #1f2937;
            font-size: 1.1rem;
        }

        .quality-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .quality-badge.excellent {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: #166534;
        }

        .quality-badge.good {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
        }

        .quality-badge.poor {
            background: linear-gradient(135deg, #fecaca, #fca5a5);
            color: #991b1b;
        }

        .journal-details {
            font-size: 0.95rem;
            color: #6b7280;
            line-height: 1.6;
        }

        .journal-details p {
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chronotype-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-top: 6px solid;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .chronotype-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            opacity: 0.1;
            font-size: 4rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chronotype-card.lion {
            border-color: #f59e0b;
        }

        .chronotype-card.lion::before {
            content: "🦁";
        }

        .chronotype-card.bear {
            border-color: #92400e;
        }

        .chronotype-card.bear::before {
            content: "🐻";
        }

        .chronotype-card.wolf {
            border-color: #1f2937;
        }

        .chronotype-card.wolf::before {
            content: "🐺";
        }

        .chronotype-card.dolphin {
            border-color: #0ea5e9;
        }

        .chronotype-card.dolphin::before {
            content: "🐬";
        }

        .chronotype-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .chronotype-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .chronotype-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1f2937;
        }

        .chronotype-percent {
            background: #f3f4f6;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 0.85rem;
            color: #6b7280;
            font-weight: 600;
        }

        .chronotype-details {
            font-size: 0.95rem;
            color: #6b7280;
            line-height: 1.6;
        }

        .chronotype-details p {
            margin-bottom: 10px;
        }

        .table-container {
            overflow-x: auto;
            margin: 24px 0;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 16px;
            overflow: hidden;
        }

        .comparison-table th {
            background: linear-gradient(135deg, #1e293b, #334155);
            padding: 18px;
            text-align: left;
            font-weight: 700;
            color: white;
            font-size: 0.95rem;
        }

        .comparison-table td {
            padding: 16px 18px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
            line-height: 1.6;
        }

        .comparison-table tr:last-child td {
            border-bottom: none;
        }

        .comparison-table tr:hover {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        }

        .tips-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            margin-top: 40px;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 20px;
        }

        .tips-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .tips-card:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .tips-card h4 {
            color: #fbbf24;
            margin-bottom: 12px;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .tips-card ul {
            list-style: none;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .tips-card li {
            margin-bottom: 8px;
            padding-left: 20px;
            position: relative;
        }

        .tips-card li::before {
            content: "▶";
            position: absolute;
            left: 0;
            color: #fbbf24;
            font-size: 0.8rem;
        }

        .warning-box {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border: 2px solid #f59e0b;
            border-radius: 16px;
            padding: 20px;
            margin-top: 30px;
            color: #92400e;
            box-shadow: 0 4px 16px rgba(245, 158, 11, 0.2);
        }

        .warning-box strong {
            color: #78350f;
            font-weight: 700;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            margin: 10px 0;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #10b981, #059669);
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin: 20px 0;
        }

        .stat-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
        }

        .breathing-guide {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border: 2px solid #10b981;
            border-radius: 16px;
            padding: 24px;
            margin: 20px 0;
            text-align: center;
        }

        .breathing-circle {
            width: 120px;
            height: 120px;
            border: 4px solid #10b981;
            border-radius: 50%;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            color: #059669;
            position: relative;
            transition: all 0.3s ease;
        }

        .breathing-circle.inhale {
            transform: scale(1.2);
            background: rgba(16, 185, 129, 0.1);
        }

        .breathing-circle.hold {
            background: rgba(16, 185, 129, 0.2);
        }

        .breathing-circle.exhale {
            transform: scale(0.8);
            background: rgba(16, 185, 129, 0.05);
        }

        .sleep-debt-meter {
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
        }

        .debt-meter {
            width: 100%;
            height: 20px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .debt-fill {
            height: 100%;
            border-radius: 10px;
            transition: all 0.5s ease;
        }

        .debt-fill.low {
            background: linear-gradient(90deg, #10b981, #059669);
        }

        .debt-fill.medium {
            background: linear-gradient(90deg, #f59e0b, #d97706);
        }

        .debt-fill.high {
            background: linear-gradient(90deg, #ef4444, #dc2626);
        }

        .hidden { display: none; }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        .slide-up {
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            backdrop-filter: blur(5px);
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease-out;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            margin: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #6b7280;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .accordion {
            margin: 20px 0;
        }

        .accordion-item {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 8px;
            overflow: hidden;
        }

        .accordion-header {
            background: #f8fafc;
            padding: 16px 20px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s ease;
        }

        .accordion-header:hover {
            background: #f1f5f9;
        }

        .accordion-content {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .accordion-content.show {
            padding: 16px 20px;
            max-height: 500px;
        }

        /* Accordion content with checkboxes */
        .accordion-content .form-group {
            margin-bottom: 12px;
        }

        .accordion-content .form-group label {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.6;
        }

        .accordion-content .form-group label input[type="checkbox"] {
            margin-top: 4px;
            flex-shrink: 0;
        }

        .accordion-content .form-group label span {
            flex: 1;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 28px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 28px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(22px);
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .sidebar {
                width: 250px;
            }

            .main-content {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .top-header h1 {
                font-size: 1.2rem;
            }

            .top-header .app-store-btn span {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .sidebar {
                position: fixed;
                left: -280px;
                top: 70px;
                width: 280px;
                height: calc(100vh - 70px);
                z-index: 999;
                transition: left 0.3s ease;
                box-shadow: 2px 0 15px rgba(0, 0, 0, 0.2);
            }

            .sidebar.active {
                left: 0;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 70px;
                left: 0;
                width: 100%;
                height: calc(100vh - 70px);
                background: rgba(0, 0, 0, 0.5);
                z-index: 998;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .main-content {
                padding: 15px;
                width: 100%;
            }

            .content {
                padding: 20px;
                border-radius: 16px;
            }
        }

        @media (max-width: 480px) {
            .top-header .header-content {
                padding: 0 15px;
            }

            .top-header h1 {
                font-size: 1rem;
            }

            .top-header .logo-section i {
                font-size: 1.5rem;
            }

            .main-content {
                padding: 10px;
            }

            .content {
                padding: 15px;
            }

            .grid-2, .grid-3, .grid-4 {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="top-header">
        <div class="header-content">
            <div class="logo-section">
                <button class="mobile-menu-btn" onclick="toggleMobileSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <i class="fas fa-moon"></i>
                <h1>Sleep optimizer pro</h1>
            </div>
            <div class="header-actions">
                <a href="https://dinhdanh.com/apps_store" class="app-store-btn" target="_blank">
                    <i class="fas fa-cube"></i>
                    <span>Kho ứng dụng</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleMobileSidebar()"></div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <ul class="sidebar-menu">
                <li>
                    <button class="active" onclick="switchTab('sleep-cycles')">
                        <i class="fas fa-clock"></i>
                        <span>Chu kỳ giấc ngủ</span>
                    </button>
                </li>
                <li>
                    <button onclick="switchTab('nap-optimizer')">
                        <i class="fas fa-sun"></i>
                        <span>Tối ưu ngủ trưa</span>
                    </button>
                </li>
                <li>
                    <button onclick="switchTab('sleep-quality')">
                        <i class="fas fa-chart-line"></i>
                        <span>Đánh giá chất lượng</span>
                    </button>
                </li>
                <li>
                    <button onclick="switchTab('sleep-environment')">
                        <i class="fas fa-home"></i>
                        <span>Môi trường ngủ</span>
                    </button>
                </li>
                <li>
                    <button onclick="switchTab('relaxation')">
                        <i class="fas fa-spa"></i>
                        <span>Kỹ thuật thư giãn</span>
                    </button>
                </li>
                <li>
                    <button onclick="switchTab('chronotype')">
                        <i class="fas fa-user-clock"></i>
                        <span>Chronotype</span>
                    </button>
                </li>
                <li>
                    <button onclick="switchTab('sleep-journal')">
                        <i class="fas fa-book"></i>
                        <span>Nhật ký giấc ngủ</span>
                    </button>
                </li>
                <li>
                    <button onclick="switchTab('sleep-disorders')">
                        <i class="fas fa-heartbeat"></i>
                        <span>Rối loạn giấc ngủ</span>
                    </button>
                </li>
                <li>
                    <button onclick="switchTab('recommendations')">
                        <i class="fas fa-lightbulb"></i>
                        <span>Khuyến nghị</span>
                    </button>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="container">
                <div class="content">
            <!-- Tab 1: Chu kỳ giấc ngủ -->
            <div id="sleep-cycles" class="tab-content active">
                <div class="section-header">
                    <span class="icon"><i class="fas fa-clock"></i></span>
                    <h2>Tính toán chu kỳ giấc ngủ khoa học</h2>
                    <button class="info-btn" onclick="toggleInfo('cycles-info')">i</button>
                </div>

                <div id="cycles-info" class="info-box">
                    <h4>Kiến trúc giấc ngủ và chu kỳ NREM-REM</h4>
                    <p>Giấc ngủ gồm 4-6 chu kỳ, mỗi chu kỳ 70-120 phút (trung bình 90 phút):</p>
                    <ul>
                        <li><strong>N1 (1-7 phút):</strong> Ru ngủ, chuyển tiếp từ thức sang ngủ</li>
                        <li><strong>N2 (45-55%):</strong> Ngủ nông, xuất hiện sleep spindles và K-complexes</li>
                        <li><strong>N3 (20-40 phút):</strong> Ngủ sâu, sóng Delta, phục hồi thể chất</li>
                        <li><strong>REM (25%):</strong> Ngủ mơ, củng cố trí nhớ và xử lý cảm xúc</li>
                    </ul>
                    <p>Ngủ sâu (N3) tập trung ở nửa đầu đêm, REM tăng dần về sáng. Thức dậy vào cuối chu kỳ giúp tránh quán tính giấc ngủ.</p>
                </div>

                <div class="grid grid-2">
                    <div class="card">
                        <h3><i class="fas fa-cog"></i> Cài đặt cá nhân</h3>
                        
                        <div class="form-group">
                            <label>Giờ đi ngủ dự định</label>
                            <input type="time" id="bedTime" value="22:30" onchange="calculateAdvancedCycles()">
                            <small>Thời điểm bạn nằm xuống giường và chuẩn bị ngủ</small>
                        </div>

                        <div class="form-group">
                            <label>Thời gian chìm vào giấc ngủ (phút)</label>
                            <input type="range" id="sleepLatency" min="5" max="60" value="15" onchange="updateLatencyValue(); calculateAdvancedCycles()">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <small>5 phút</small>
                                <span id="latencyValue" style="font-weight: 600; color: #667eea;">15 phút</span>
                                <small>60 phút</small>
                            </div>
                            <small>Thời gian từ lúc nằm xuống đến khi thực sự ngủ. <5 phút = có thể thiếu ngủ hoặc sleep efficiency tự nhiên cao, 10-20 phút = lý tưởng</small>
                        </div>

                        <div class="form-group">
                            <label>Độ dài chu kỳ cá nhân (phút)</label>
                            <input type="range" id="cycleLength" min="70" max="120" value="90" step="5" onchange="updateCycleValue(); calculateAdvancedCycles()">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <small>70 phút</small>
                                <span id="cycleValue" style="font-weight: 600; color: #667eea;">90 phút</span>
                                <small>120 phút</small>
                            </div>
                            <small>Chu kỳ cá nhân có thể khác nhau. Người trẻ thường ngắn hơn, người cao tuổi dài hơn</small>
                        </div>

                        <div class="form-group">
                            <label>Tuổi của bạn</label>
                            <select id="ageGroup" onchange="adjustCycleByAge(); calculateAdvancedCycles()">
                                <option value="young">18-25 tuổi</option>
                                <option value="adult" selected>26-64 tuổi</option>
                                <option value="senior">65+ tuổi</option>
                            </select>
                            <small>Chu kỳ giấc ngủ thay đổi theo tuổi</small>
                        </div>
                    </div>

                    <div class="card">
                        <h3><i class="fas fa-clock"></i> Thời gian thức dậy lý tưởng</h3>
                        <div id="cycleResults"></div>
                        
                        <div style="margin-top: 20px; padding: 16px; background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 12px;">
                            <h4 style="color: #1e40af; margin-bottom: 8px;"><i class="fas fa-lightbulb"></i> Gợi ý thông minh</h4>
                            <p id="cycleAdvice" style="color: #1d4ed8; font-size: 0.9rem; line-height: 1.5;"></p>
                        </div>
                    </div>
                </div>

                <!-- Tính ngược từ giờ thức dậy -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-bullseye"></i> Tính thời gian đi ngủ từ giờ thức dậy</h3>
                    <div class="grid grid-4" style="align-items: end; margin-top: 15px;">
                        <div class="form-group">
                            <label>Giờ cần thức dậy</label>
                            <input type="time" id="targetWakeTime" value="07:00" onchange="calculateOptimalBedTime()">
                        </div>
                        
                        <div class="form-group">
                            <label>Số chu kỳ mong muốn</label>
                            <select id="targetCycles" onchange="calculateOptimalBedTime()">
                                <option value="4">4 chu kỳ (~6h) - Tối thiểu</option>
                                <option value="5" selected>5 chu kỳ (~7.5h) - Khuyến nghị</option>
                                <option value="6">6 chu kỳ (~9h) - Lý tưởng</option>
                            </select>
                        </div>
                        
                        <div style="text-align: center;">
                            <p style="color: #6b7280; margin-bottom: 5px; font-weight: 600;">Nên đi ngủ lúc:</p>
                            <p id="calculatedBedTime" style="font-size: 2rem; font-weight: 700; color: #667eea;">23:15</p>
                        </div>
                        
                        <div style="text-align: center;">
                            <p style="color: #6b7280; margin-bottom: 5px; font-weight: 600;">Tổng thời gian ngủ:</p>
                            <p id="totalSleepTime" style="font-size: 1.3rem; font-weight: 600; color: #10b981;">7.5 giờ</p>
                        </div>
                    </div>
                </div>

                <!-- Sleep Debt Calculator -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-chart-line"></i> Máy tính nợ giấc ngủ</h3>
                    <div class="grid grid-2">
                        <div>
                            <div class="form-group">
                                <label>Nhu cầu ngủ hàng ngày (giờ)</label>
                                <input type="number" id="sleepNeed" value="8" min="6" max="10" step="0.5" onchange="calculateSleepDebt()">
                                <small>Người trưởng thành: 7-9 giờ</small>
                            </div>
                            
                            <div class="form-group">
                                <label>Thời gian ngủ thực tế 7 ngày qua (giờ/ngày)</label>
                                <input type="number" id="actualSleep" value="6.5" min="3" max="12" step="0.5" onchange="calculateSleepDebt()">
                            </div>
                        </div>
                        
                        <div>
                            <h4>Nợ giấc ngủ hiện tại</h4>
                            <div class="sleep-debt-meter">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span style="font-size: 0.9rem; color: #6b7280;">Không nợ</span>
                                    <span id="debtAmount" style="font-weight: 700; color: #ef4444;">10.5 giờ</span>
                                    <span style="font-size: 0.9rem; color: #6b7280;">Nợ nặng</span>
                                </div>
                                <div class="debt-meter">
                                    <div id="debtFill" class="debt-fill high" style="width: 75%;"></div>
                                </div>
                                <p id="debtAdvice" style="margin-top: 12px; font-size: 0.9rem; color: #6b7280; line-height: 1.5;"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Tối ưu ngủ trưa -->
            <div id="nap-optimizer" class="tab-content">
                <div class="section-header">
                    <span class="icon"><i class="fas fa-sun"></i></span>
                    <h2>Tối ưu hóa ngủ trưa khoa học</h2>
                    <button class="info-btn" onclick="toggleInfo('nap-info')">i</button>
                </div>

                <div id="nap-info" class="info-box">
                    <h4>Khoa học về ngủ trưa và áp lực ngủ (Sleep pressure)</h4>
                    <p>Ngủ trưa ảnh hưởng đến adenosine - chất tạo "áp lực ngủ". Lợi ích bao gồm:</p>
                    <ul>
                        <li><strong>Cải thiện nhận thức:</strong> Tăng 34% khả năng tập trung, 16% hiệu suất làm việc</li>
                        <li><strong>Tăng cường sáng tạo:</strong> REM nap giúp kết nối ý tưởng mới</li>
                        <li><strong>Hỗ trợ tim mạch:</strong> Giảm 37% nguy cơ bệnh tim ở người ngủ trưa đều đặn</li>
                        <li><strong>Điều hòa cảm xúc:</strong> Giảm cortisol, tăng serotonin</li>
                    </ul>
                    <p><strong>Lưu ý:</strong> Người mất ngủ nên tránh ngủ trưa để tích tụ áp lực ngủ cho đêm.</p>
                </div>

                <div class="grid grid-2">
                    <div class="card">
                        <h3><i class="fas fa-cog"></i> Thiết lập ngủ trưa</h3>
                        
                        <div class="form-group">
                            <label>Thời gian hiện tại</label>
                            <input type="time" id="currentTime" onchange="calculateSmartNap()">
                        </div>

                        <div class="form-group">
                            <label>Mục tiêu ngủ trưa</label>
                            <select id="napGoal" onchange="calculateSmartNap()">
                                <option value="energy">Tăng năng lượng nhanh</option>
                                <option value="memory">Củng cố trí nhớ</option>
                                <option value="creativity">Thúc đẩy sáng tạo</option>
                                <option value="recovery">Phục hồi toàn diện</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Thời gian từ bữa ăn cuối (giờ)</label>
                            <input type="range" id="lastMeal" min="0.5" max="6" value="1" step="0.5" onchange="updateMealValue(); calculateSmartNap()">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <small>30 phút</small>
                                <span id="mealValue" style="font-weight: 600; color: #667eea;">1 giờ</span>
                                <small>6 giờ</small>
                            </div>
                            <small>Nên đợi ít nhất 30-60 phút sau bữa ăn để tránh khó tiêu</small>
                        </div>

                        <div class="form-group">
                            <label>Chất lượng giấc ngủ đêm qua</label>
                            <div class="rating-buttons" id="lastNightQuality">
                                <button class="rating-btn" onclick="setRating('lastNightQuality', 1)">Rất tệ</button>
                                <button class="rating-btn" onclick="setRating('lastNightQuality', 2)">Tệ</button>
                                <button class="rating-btn active" onclick="setRating('lastNightQuality', 3)">Ổn</button>
                                <button class="rating-btn" onclick="setRating('lastNightQuality', 4)">Tốt</button>
                                <button class="rating-btn" onclick="setRating('lastNightQuality', 5)">Rất tốt</button>
                            </div>
                            <small>Ảnh hưởng đến khuyến nghị loại ngủ trưa</small>
                        </div>

                        <div class="form-group">
                            <label style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" id="hasInsomnia" onchange="calculateSmartNap()">
                                Tôi đang gặp vấn đề mất ngủ
                            </label>
                            <small>Người mất ngủ nên hạn chế ngủ trưa</small>
                        </div>
                    </div>

                    <div class="card">
                        <h3><i class="fas fa-clipboard-list"></i> Kế hoạch ngủ trưa thông minh</h3>
                        <div id="smartNapPlan"></div>
                        
                        <div id="napBenefits" style="margin-top: 20px;"></div>
                        
                        <div id="napWarnings" style="margin-top: 15px;"></div>
                    </div>
                </div>

                <!-- Bảng so sánh chi tiết -->
                <div class="table-container">
                    <h3 style="margin-bottom: 16px;">📊 So sánh chi tiết các loại ngủ trưa</h3>
                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th>Loại ngủ trưa</th>
                                <th>Thời lượng</th>
                                <th>Giai đoạn giấc ngủ</th>
                                <th>Lợi ích chính</th>
                                <th>Thời gian phục hồi</th>
                                <th>Phù hợp cho</th>
                                <th>Tránh khi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Nano Nap</strong></td>
                                <td>2-5 phút</td>
                                <td>N1 (ru ngủ)</td>
                                <td>Tăng tỉnh táo tức thì</td>
                                <td>Ngay lập tức</td>
                                <td>Lái xe đường dài, học tập</td>
                                <td>Khi có đủ thời gian ngủ dài hơn</td>
                            </tr>
                            <tr>
                                <td><strong>Micro Nap</strong></td>
                                <td>5-10 phút</td>
                                <td>N1-N2</td>
                                <td>Giảm mệt mỏi nhẹ</td>
                                <td>Ngay lập tức</td>
                                <td>Giờ nghỉ ngắn tại văn phòng</td>
                                <td>Sau 15:00</td>
                            </tr>
                            <tr>
                                <td><strong>Power Nap</strong></td>
                                <td>10-20 phút</td>
                                <td>N1-N2</td>
                                <td>Tăng năng suất, cải thiện tâm trạng</td>
                                <td>Ngay lập tức</td>
                                <td>Nhân viên văn phòng, học sinh</td>
                                <td>Khi bị mất ngủ mãn tính</td>
                            </tr>
                            <tr>
                                <td><strong>Recovery Nap</strong></td>
                                <td>30-60 phút</td>
                                <td>N1-N3</td>
                                <td>Củng cố trí nhớ, phục hồi nhận thức</td>
                                <td>15-30 phút</td>
                                <td>Sinh viên, nghiên cứu viên</td>
                                <td>Sau 14:00, khi không có thời gian phục hồi</td>
                            </tr>
                            <tr>
                                <td><strong>Prophylactic Nap</strong></td>
                                <td>90-120 phút</td>
                                <td>Full cycle với REM</td>
                                <td>Phòng ngừa mệt mỏi, tăng sáng tạo</td>
                                <td>0-15 phút</td>
                                <td>Ca đêm, công việc đòi hỏi sáng tạo</td>
                                <td>Khi ảnh hưởng đến giấc ngủ đêm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Circadian Timing -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-clock"></i> Thời điểm tối ưu theo nhịp sinh học</h3>
                    <div class="grid grid-3">
                        <div style="text-align: center; padding: 20px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 12px;">
                            <h4 style="color: #92400e; margin-bottom: 8px;"><i class="fas fa-sunrise"></i> Buổi sáng (6-9h)</h4>
                            <p style="color: #b45309; font-size: 0.9rem;">❌ Không khuyến nghị</p>
                            <small style="color: #78350f;">Cortisol cao tự nhiên</small>
                        </div>
                        
                        <div style="text-align: center; padding: 20px; background: linear-gradient(135deg, #dcfce7, #bbf7d0); border-radius: 12px;">
                            <h4 style="color: #166534; margin-bottom: 8px;"><i class="fas fa-sun"></i> Trưa (12-15h)</h4>
                            <p style="color: #047857; font-size: 0.9rem;">✅ Tối ưu nhất</p>
                            <small style="color: #064e3b;">Dip tự nhiên của circadian</small>
                        </div>
                        
                        <div style="text-align: center; padding: 20px; background: linear-gradient(135deg, #fecaca, #fca5a5); border-radius: 12px;">
                            <h4 style="color: #991b1b; margin-bottom: 8px;"><i class="fas fa-city"></i> Chiều (15-18h)</h4>
                            <p style="color: #b91c1c; font-size: 0.9rem;">⚠️ Có thể ảnh hưởng đêm</p>
                            <small style="color: #7f1d1d;">Chỉ nếu thực sự cần thiết</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 3: Đánh giá chất lượng giấc ngủ -->
            <div id="sleep-quality" class="tab-content">
                <div class="section-header">
                    <span class="icon"><i class="fas fa-chart-line"></i></span>
                    <h2>Đánh giá chất lượng giấc ngủ toàn diện</h2>
                    <button class="info-btn" onclick="toggleInfo('quality-info')">i</button>
                </div>

                <div id="quality-info" class="info-box">
                    <h4>Các chỉ số vàng đánh giá giấc ngủ chất lượng</h4>
                    <p>Đánh giá dựa trên tiêu chuẩn của American Academy of Sleep Medicine:</p>
                    <ul>
                        <li><strong>Độ trễ giấc ngủ:</strong> ≤20 phút (lý tưởng 10-15 phút)</li>
                        <li><strong>Hiệu suất giấc ngủ:</strong> ≥85% (thời gian ngủ thực/thời gian trên giường)</li>
                        <li><strong>Số lần thức giấc:</strong> ≤1 lần, có thể ngủ lại trong 20 phút</li>
                        <li><strong>Tổng thời gian thức giấc giữa đêm:</strong> ≤20 phút</li>
                        <li><strong>Cảm giác phục hồi:</strong> Tỉnh táo và năng lượng suốt ngày</li>
                    </ul>
                    <p>Giấc ngủ kém chất lượng liên quan đến tăng nguy cơ béo phì (+30%), tiểu đường type 2 (+28%), bệnh tim mạch (+48%).</p>
                </div>

                <div class="grid grid-2">
                    <div class="card">
                        <h3><i class="fas fa-edit"></i> Nhập dữ liệu giấc ngủ</h3>
                        
                        <div class="grid grid-2">
                            <div class="form-group">
                                <label>Độ trễ giấc ngủ (phút)</label>
                                <input type="number" id="qualitySleepLatency" value="20" min="0" max="180" onchange="evaluateAdvancedQuality()">
                                <small>Thời gian từ lúc tắt đèn đến khi ngủ</small>
                            </div>
                            
                            <div class="form-group">
                                <label>Số lần thức giấc trong đêm</label>
                                <input type="number" id="qualityNightWakings" value="1" min="0" max="10" onchange="evaluateAdvancedQuality()">
                                <small>Không tính lần thức dậy buổi sáng</small>
                            </div>
                        </div>

                        <div class="grid grid-2">
                            <div class="form-group">
                                <label>Tổng thời gian thức giấc giữa đêm (phút)</label>
                                <input type="number" id="qualityWakeTime" value="15" min="0" max="300" onchange="evaluateAdvancedQuality()">
                                <small>Tổng thời gian không ngủ được giữa đêm</small>
                            </div>
                            
                            <div class="form-group">
                                <label>Thời gian trên giường (giờ)</label>
                                <input type="number" id="qualityBedTime" value="8" min="4" max="12" step="0.25" onchange="evaluateAdvancedQuality()">
                                <small>Từ lúc lên giường đến lúc ra khỏi giường</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Thời gian ngủ thực tế (giờ)</label>
                            <input type="number" id="qualityActualSleep" value="7.5" min="3" max="12" step="0.25" onchange="evaluateAdvancedQuality()">
                            <small>Thời gian thực sự ngủ (trừ thời gian thức)</small>
                        </div>

                        <div class="form-group">
                            <label>Cảm giác khi thức dậy</label>
                            <div class="rating-buttons" id="morningFeeling">
                                <button class="rating-btn" onclick="setRating('morningFeeling', 1)">Rất mệt</button>
                                <button class="rating-btn" onclick="setRating('morningFeeling', 2)">Mệt</button>
                                <button class="rating-btn active" onclick="setRating('morningFeeling', 3)">Bình thường</button>
                                <button class="rating-btn" onclick="setRating('morningFeeling', 4)">Sảng khoái</button>
                                <button class="rating-btn" onclick="setRating('morningFeeling', 5)">Rất sảng khoái</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Mức độ tỉnh táo ban ngày</label>
                            <div class="rating-buttons" id="dayAlertness">
                                <button class="rating-btn" onclick="setRating('dayAlertness', 1)">Rất buồn ngủ</button>
                                <button class="rating-btn" onclick="setRating('dayAlertness', 2)">Buồn ngủ</button>
                                <button class="rating-btn active" onclick="setRating('dayAlertness', 3)">Bình thường</button>
                                <button class="rating-btn" onclick="setRating('dayAlertness', 4)">Tỉnh táo</button>
                                <button class="rating-btn" onclick="setRating('dayAlertness', 5)">Rất tỉnh táo</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Tần suất cần caffeine để tỉnh táo</label>
                            <select id="caffeineNeed" onchange="evaluateAdvancedQuality()">
                                <option value="0">Không cần</option>
                                <option value="1">1 cốc cà phê/ngày</option>
                                <option value="2">2-3 cốc cà phê/ngày</option>
                                <option value="3">Nhiều caffeine suốt ngày</option>
                            </select>
                        </div>
                    </div>

                    <div class="card">
                        <h3><i class="fas fa-chart-line"></i> Kết quả đánh giá chi tiết</h3>
                        <div id="qualityResultAdvanced" style="max-width: 700px; margin: 0 auto; padding: 20px 0;">
                            <canvas id="qualityChart"></canvas>
                        </div>

                        <div id="qualityFactors" style="margin-top: 20px;"></div>

                        <div id="qualityTrends" style="margin-top: 20px;"></div>
                    </div>
                </div>

                <!-- Pittsburgh Sleep Quality Index (PSQI) -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-hospital"></i> Bảng đánh giá PSQI (Pittsburgh sleep quality index)</h3>
                    <p style="color: #6b7280; margin-bottom: 20px;">Công cụ đánh giá được sử dụng rộng rãi trong y học. Điểm ≤5: giấc ngủ tốt, >5: cần cải thiện, >10: có thể cần tư vấn chuyên gia.</p>
                    
                    <div class="grid grid-2">
                        <div>
                            <div class="form-group">
                                <label>Trong tháng qua, tần suất bạn khó ngủ do:</label>
                                
                                <div style="margin: 10px 0;">
                                    <label style="font-weight: normal; display: block; margin-bottom: 8px;">Đau đớn thể chất:</label>
                                    <div class="rating-buttons" id="psqi-pain">
                                        <button class="rating-btn active" onclick="setRating('psqi-pain', 0)">Không bao giờ</button>
                                        <button class="rating-btn" onclick="setRating('psqi-pain', 1)">< 1 lần/tuần</button>
                                        <button class="rating-btn" onclick="setRating('psqi-pain', 2)">1-2 lần/tuần</button>
                                        <button class="rating-btn" onclick="setRating('psqi-pain', 3)">≥ 3 lần/tuần</button>
                                    </div>
                                </div>
                                
                                <div style="margin: 10px 0;">
                                    <label style="font-weight: normal; display: block; margin-bottom: 8px;">Lo lắng, căng thẳng:</label>
                                    <div class="rating-buttons" id="psqi-anxiety">
                                        <button class="rating-btn active" onclick="setRating('psqi-anxiety', 0)">Không bao giờ</button>
                                        <button class="rating-btn" onclick="setRating('psqi-anxiety', 1)">< 1 lần/tuần</button>
                                        <button class="rating-btn" onclick="setRating('psqi-anxiety', 2)">1-2 lần/tuần</button>
                                        <button class="rating-btn" onclick="setRating('psqi-anxiety', 3)">≥ 3 lần/tuần</button>
                                    </div>
                                </div>
                                
                                <div style="margin: 10px 0;">
                                    <label style="font-weight: normal; display: block; margin-bottom: 8px;">Tiếng ồn:</label>
                                    <div class="rating-buttons" id="psqi-noise">
                                        <button class="rating-btn active" onclick="setRating('psqi-noise', 0)">Không bao giờ</button>
                                        <button class="rating-btn" onclick="setRating('psqi-noise', 1)">< 1 lần/tuần</button>
                                        <button class="rating-btn" onclick="setRating('psqi-noise', 2)">1-2 lần/tuần</button>
                                        <button class="rating-btn" onclick="setRating('psqi-noise', 3)">≥ 3 lần/tuần</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="form-group">
                                <label>Thời lượng ngủ trung bình mỗi đêm trong tháng qua:</label>
                                <div class="rating-buttons" id="psqi-duration">
                                    <button class="rating-btn active" onclick="setRating('psqi-duration', 0)">≥ 7 giờ</button>
                                    <button class="rating-btn" onclick="setRating('psqi-duration', 1)">6-7 giờ</button>
                                    <button class="rating-btn" onclick="setRating('psqi-duration', 2)">5-6 giờ</button>
                                    <button class="rating-btn" onclick="setRating('psqi-duration', 3)">< 5 giờ</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Thời gian chìm vào giấc ngủ (sleep latency):</label>
                                <div class="rating-buttons" id="psqi-latency">
                                    <button class="rating-btn active" onclick="setRating('psqi-latency', 0)">≤ 15 phút</button>
                                    <button class="rating-btn" onclick="setRating('psqi-latency', 1)">16-30 phút</button>
                                    <button class="rating-btn" onclick="setRating('psqi-latency', 2)">31-60 phút</button>
                                    <button class="rating-btn" onclick="setRating('psqi-latency', 3)">> 60 phút</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Đánh giá tổng thể chất lượng giấc ngủ:</label>
                                <div class="rating-buttons" id="psqi-overall">
                                    <button class="rating-btn" onclick="setRating('psqi-overall', 0)">Rất tốt</button>
                                    <button class="rating-btn" onclick="setRating('psqi-overall', 1)">Tốt</button>
                                    <button class="rating-btn active" onclick="setRating('psqi-overall', 2)">Kém</button>
                                    <button class="rating-btn" onclick="setRating('psqi-overall', 3)">Rất kém</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tần suất cần dùng thuốc ngủ:</label>
                                <div class="rating-buttons" id="psqi-medication">
                                    <button class="rating-btn active" onclick="setRating('psqi-medication', 0)">Không bao giờ</button>
                                    <button class="rating-btn" onclick="setRating('psqi-medication', 1)">< 1 lần/tuần</button>
                                    <button class="rating-btn" onclick="setRating('psqi-medication', 2)">1-2 lần/tuần</button>
                                    <button class="rating-btn" onclick="setRating('psqi-medication', 3)">≥ 3 lần/tuần</button>
                                </div>
                            </div>

                            <button class="btn btn-primary" onclick="calculatePSQI()" style="margin-top: 15px;">
                                <i class="fas fa-calculator"></i> Tính điểm PSQI
                            </button>

                            <div id="psqiResult" style="margin-top: 20px; padding: 16px; background: linear-gradient(135deg, #f1f5f9, #e2e8f0); border-radius: 12px;">
                                <h4 style="color: #1e293b; margin-bottom: 8px;">Điểm PSQI: <span id="psqiScore">6</span>/21</h4>
                                <p id="psqiInterpretation" style="color: #475569; font-size: 0.9rem; line-height: 1.5;"></p>
                                <p style="color: #64748b; font-size: 0.85rem; margin-top: 8px;"><em>7 thành phần PSQI: Chất lượng chủ quan, Sleep latency, Sleep duration, Sleep disturbances, Sleep medication, Daytime dysfunction (tính từ các yếu tố khác)</em></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 4: Môi trường ngủ -->
            <div id="sleep-environment" class="tab-content">
                <div class="section-header">
                    <span class="icon"><i class="fas fa-home"></i></span>
                    <h2>Tối ưu hóa môi trường ngủ</h2>
                    <button class="info-btn" onclick="toggleInfo('environment-info')">i</button>
                </div>

                <div id="environment-info" class="info-box">
                    <h4>Nguyên tắc "Tối - Yên - Mát - Thoải mái" theo khoa học</h4>
                    <p>Môi trường ngủ lý tưởng dựa trên nghiên cứu về sinh lý học giấc ngủ:</p>
                    <ul>
                        <li><strong>Ánh sáng:</strong> <1 lux (tối hơn ánh trăng), ức chế melatonin ngay cả ánh sáng nhỏ</li>
                        <li><strong>Nhiệt độ:</strong> 15.5-19.4°C, giảm 1-2°C so với ban ngày để kích hoạt giấc ngủ</li>
                        <li><strong>Độ ẩm:</strong> 30-50%, quá khô gây khó thở, quá ẩm tạo vi khuẩn</li>
                        <li><strong>Tiếng ồn:</strong> <30 dB (tiếng thì thầm), âm thanh đột ngột >40 dB gây thức giấc</li>
                        <li><strong>Chất lượng không khí:</strong> CO2 <1000 ppm, thông gió tốt</li>
                    </ul>
                </div>

                <div class="grid grid-2">
                    <div class="card">
                        <h3><i class="fas fa-thermometer-half"></i> Kiểm tra môi trường hiện tại</h3>
                        
                        <div class="form-group">
                            <label>Nhiệt độ phòng ngủ (°C)</label>
                            <input type="range" id="roomTemp" min="15" max="28" value="22" onchange="updateTempValue(); evaluateEnvironment()">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <small>15°C</small>
                                <span id="tempValue" style="font-weight: 600; color: #667eea;">22°C</span>
                                <small>28°C</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Mức độ ánh sáng trong phòng</label>
                            <select id="lightLevel" onchange="evaluateEnvironment()">
                                <option value="dark">Hoàn toàn tối</option>
                                <option value="dim" selected>Hơi sáng (đèn LED thiết bị)</option>
                                <option value="moderate">Vừa phải (ánh sáng đường)</option>
                                <option value="bright">Sáng (đèn ngủ)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Mức độ tiếng ồn</label>
                            <select id="noiseLevel" onchange="evaluateEnvironment()">
                                <option value="silent">Yên tĩnh hoàn toàn</option>
                                <option value="quiet" selected>Tiếng ồn nhẹ (quạt, điều hòa)</option>
                                <option value="moderate">Vừa phải (giao thông xa)</option>
                                <option value="noisy">Ồn ào (giao thông gần, hàng xóm)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Độ thoải mái nệm và gối</label>
                            <div class="rating-buttons" id="bedComfort">
                                <button class="rating-btn" onclick="setRating('bedComfort', 1)">Rất cứng/mềm</button>
                                <button class="rating-btn" onclick="setRating('bedComfort', 2)">Không thoải mái</button>
                                <button class="rating-btn active" onclick="setRating('bedComfort', 3)">Ổn</button>
                                <button class="rating-btn" onclick="setRating('bedComfort', 4)">Thoải mái</button>
                                <button class="rating-btn" onclick="setRating('bedComfort', 5)">Rất thoải mái</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Thời gian sử dụng thiết bị có màn hình trước khi ngủ</label>
                            <select id="screenTime" onchange="evaluateEnvironment()">
                                <option value="none">Không sử dụng</option>
                                <option value="minimal">< 30 phút</option>
                                <option value="moderate" selected>30-60 phút</option>
                                <option value="excessive">> 60 phút</option>
                            </select>
                            <small>Ánh sáng xanh ức chế melatonin 1.5-3 giờ</small>
                        </div>
                    </div>

                    <div class="card">
                        <h3><i class="fas fa-chart-pie"></i> Đánh giá môi trường</h3>
                        <div id="environmentScore" style="max-width: 500px; margin: 0 auto; padding: 20px 0;">
                            <canvas id="environmentChart"></canvas>
                        </div>

                        <div id="environmentRecommendations" style="margin-top: 20px;"></div>
                    </div>
                </div>

                <!-- Hướng dẫn tối ưu cụ thể -->
                <div class="grid grid-3" style="margin-top: 25px;">
                    <div class="card">
                        <h3><i class="fas fa-thermometer-half"></i> Tối ưu nhiệt độ</h3>
                        <div class="accordion">
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Điều chỉnh nhiệt độ theo mùa
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <p><strong>Mùa hè:</strong> 16-18°C, sử dụng quạt trần tạo luồng khí</p>
                                    <p><strong>Mùa đông:</strong> 18-20°C, sử dụng chăn đệm thay vì tăng nhiệt</p>
                                    <p><strong>Mẹo:</strong> Tắm nước ấm trước ngủ giúp thân nhiệt giảm nhanh hơn</p>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Điều hòa không khí thông minh
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <p><strong>Chế độ Sleep:</strong> Tự động tăng 1-2°C sau 1-2 giờ ngủ</p>
                                    <p><strong>Hướng gió:</strong> Không thổi trực tiếp, sử dụng chế độ dao động</p>
                                    <p><strong>Độ ẩm:</strong> Sử dụng chế độ dry nếu quá ẩm (>60%)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3><i class="fas fa-lightbulb"></i> Quản lý ánh sáng</h3>
                        <div class="accordion">
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Light therapy schedule
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <p><strong>Buổi sáng (6-9h):</strong> 10,000 lux trong 15-30 phút</p>
                                    <p><strong>Ban ngày:</strong> Tối thiểu 1000 lux, lý tưởng ánh sáng tự nhiên</p>
                                    <p><strong>Buổi tối (2h trước ngủ):</strong> Dần giảm xuống <100 lux</p>
                                    <p><strong>Đêm:</strong> Đèn đỏ <1 lux nếu cần thiết</p>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Blue light blocking
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <p><strong>Kính lọc ánh sáng xanh:</strong> Đeo 2-3h trước ngủ</p>
                                    <p><strong>Night mode:</strong> Bật trên tất cả thiết bị sau 20:00</p>
                                    <p><strong>F.lux/Night Shift:</strong> Tự động điều chỉnh màu màn hình</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3><i class="fas fa-volume-mute"></i> Kiểm soát âm thanh</h3>
                        <div class="accordion">
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    White noise & masking
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <p><strong>White noise:</strong> 40-50 dB, che các âm thanh đột ngột</p>
                                    <p><strong>Pink noise:</strong> Tần số thấp hơn, tự nhiên hơn (mưa, sóng)</p>
                                    <p><strong>Brown noise:</strong> Sâu nhất, thích hợp cho giấc ngủ sâu</p>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Cách ly âm thanh
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <p><strong>Nút bịt tai:</strong> Giảm 25-30 dB, chọn loại mềm</p>
                                    <p><strong>Rèm dày:</strong> Hấp thụ âm thanh từ bên ngoài</p>
                                    <p><strong>Thảm:</strong> Giảm tiếng vọng trong phòng</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sleep Hygiene Checklist -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-check-circle"></i> Checklist vệ sinh giấc ngủ toàn diện</h3>
                    <div class="grid grid-2">
                        <div>
                            <h4 style="color: #1e293b; margin-bottom: 12px;"><i class="fas fa-home"></i> Môi trường phòng ngủ</h4>
                            <div class="form-group">
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="dark-room"> Phòng hoàn toàn tối hoặc có mặt nạ ngủ
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="cool-temp"> Nhiệt độ 16-19°C
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="quiet-room"> Yên tĩnh hoặc có white noise
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="comfortable-bed"> Nệm và gối thoải mái
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="no-electronics"> Không có thiết bị điện tử trong phòng
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="clean-air"> Không khí trong lành, thông gió tốt
                                </label>
                            </div>
                        </div>
                        
                        <div>
                            <h4 style="color: #1e293b; margin-bottom: 12px;"><i class="fas fa-clock"></i> Thói quen và lịch trình</h4>
                            <div class="form-group">
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="consistent-schedule"> Ngủ-thức đúng giờ mỗi ngày
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="no-caffeine-late"> Không caffeine sau 14:00
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="no-alcohol"> Không rượu 3h trước ngủ
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="bedtime-routine"> Có thói quen thư giãn trước ngủ
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="exercise-regularly"> Tập thể dục đều đặn (không gần giờ ngủ)
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="light-exposure"> Tiếp xúc ánh sáng mặt trời buổi sáng
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div id="hygieneScore" style="margin-top: 20px; text-align: center; max-width: 500px; margin: 20px auto 0; padding: 20px 0;">
                        <canvas id="hygieneChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tab 5: Kỹ thuật thư giãn -->
            <div id="relaxation" class="tab-content">
                <div class="section-header">
                    <span class="icon"><i class="fas fa-spa"></i></span>
                    <h2>Kỹ thuật thư giãn và thiền định</h2>
                    <button class="info-btn" onclick="toggleInfo('relaxation-info')">i</button>
                </div>

                <div id="relaxation-info" class="info-box">
                    <h4>Khoa học đằng sau kỹ thuật thư giãn</h4>
                    <p>Các kỹ thuật thư giãn kích hoạt hệ thần kinh phó giao cảm (parasympathetic), đối kháng với phản ứng stress:</p>
                    <ul>
                        <li><strong>Hô hấp sâu:</strong> Kích hoạt dây thần kinh phế vị, giảm cortisol 23%</li>
                        <li><strong>PMR:</strong> Giảm căng thẳng cơ, tăng GABA, giảm norepinephrine</li>
                        <li><strong>Thiền định:</strong> Tăng melatonin, giảm cytokine viêm, thay đổi cấu trúc não</li>
                        <li><strong>Guided imagery:</strong> Kích hoạt vùng não thị giác, chuyển hướng từ lo âu</li>
                    </ul>
                    <p>Hiệu quả tối ưu khi thực hành đều đặn 10-20 phút/ngày trong 2-8 tuần.</p>
                </div>

                <div class="grid grid-2">
                    <div class="card">
                        <h3><i class="fas fa-lungs"></i> Kỹ thuật hô hấp</h3>
                        
                        <div class="accordion">
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Thở 4-7-8 (Dr. Andrew Weil)
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <div class="breathing-guide">
                                        <h4 style="color: #059669; margin-bottom: 12px;">Hướng Dẫn Chi Tiết</h4>
                                        <ol style="text-align: left; color: #047857; line-height: 1.6;">
                                            <li>Đặt đầu lưỡi sau răng cửa trên</li>
                                            <li>Thở ra hoàn toàn qua miệng tạo âm "vù"</li>
                                            <li>Khép miệng, hít vào qua mũi đếm 4</li>
                                            <li>Nín thở đếm 7</li>
                                            <li>Thở ra qua miệng đếm 8 tạo âm "vù"</li>
                                            <li>Lặp lại 3-4 chu kỳ</li>
                                        </ol>
                                        <div class="breathing-circle" id="breathing478">
                                            <span id="breathingText">Bắt đầu</span>
                                        </div>
                                        <button class="btn btn-success" onclick="start478Breathing()">  <i class="fas fa-wind"></i> Bắt đầu luyện tập</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Box Breathing (Quân đội Mỹ)
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <div class="breathing-guide">
                                        <p style="color: #047857; margin-bottom: 15px;">Kỹ thuật được Navy SEALs sử dụng để kiểm soát stress và lo âu.</p>
                                        <ol style="text-align: left; color: #047857; line-height: 1.6;">
                                            <li>Hít vào qua mũi đếm 4</li>
                                            <li>Nín thở đếm 4</li>
                                            <li>Thở ra qua miệng đếm 4</li>
                                            <li>Nín thở đếm 4</li>
                                            <li>Lặp lại 5-10 chu kỳ</li>
                                        </ol>
                                        <button class="btn btn-primary" onclick="startBoxBreathing()">  <i class="fas fa-square"></i> Bắt đầu box breathing</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Thở Cơ Hoành (Diaphragmatic)
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <p style="color: #047857; line-height: 1.6;">
                                        <strong>Tư thế:</strong> Nằm ngửa, đầu gối hơi co, một tay lên ngực, một tay lên bụng.<br>
                                        <strong>Kỹ thuật:</strong> Hít vào sâu qua mũi, chỉ tay trên bụng nâng lên, tay trên ngực ít di chuyển.<br>
                                        <strong>Thở ra:</strong> Qua môi mím nhẹ, cảm nhận bụng hóp lại.<br>
                                        <strong>Thời gian:</strong> 5-10 phút, tập trung vào nhịp điệu chậm và đều.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3><i class="fas fa-hand-sparkles"></i> Progressive Muscle Relaxation (PMR)</h3>
                        
                        <div style="margin-bottom: 20px;">
                            <p style="color: #6b7280; line-height: 1.6;">Kỹ thuật căng và thả lỏng từng nhóm cơ một cách có hệ thống, được phát triển bởi Edmund Jacobson năm 1929.</p>
                        </div>
                        
                        <div class="accordion">
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    PMR Toàn Thân (20 phút)
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <h4 style="color: #667eea; margin-bottom: 12px;">Trình Tự Thực Hiện</h4>
                                    <ol style="color: #4b5563; line-height: 1.7;">
                                        <li><strong>Bàn chân phải:</strong> Căng 5 giây, thả lỏng 15 giây</li>
                                        <li><strong>Bắp chân phải:</strong> Căng cơ gastrocnemius</li>
                                        <li><strong>Đùi phải:</strong> Căng cơ tứ đầu đùi</li>
                                        <li><strong>Lặp lại với chân trái</strong></li>
                                        <li><strong>Mông:</strong> Siết chặt hai bên</li>
                                        <li><strong>Bụng:</strong> Căng cơ bụng như chuẩn bị đấm</li>
                                        <li><strong>Ngực:</strong> Hít sâu, giữ hơi</li>
                                        <li><strong>Tay phải:</strong> Nắm chặt, căng cánh tay</li>
                                        <li><strong>Lặp lại với tay trái</strong></li>
                                        <li><strong>Vai:</strong> Nhún vai lên tai</li>
                                        <li><strong>Cổ:</strong> Cúi đầu về phía trước</li>
                                        <li><strong>Mặt:</strong> Căng tất cả cơ mặt</li>
                                    </ol>
                                    <button class="btn btn-success" onclick="startPMR()">  <i class="fas fa-sync"></i> Bắt đầu PMR có hướng dẫn</button>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    PMR Nhanh (5 phút)
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <p style="color: #4b5563; line-height: 1.6;">
                                        <strong>1. Chân:</strong> Căng đồng thời cả hai chân 5 giây<br>
                                        <strong>2. Thân:</strong> Căng bụng, ngực, lưng 5 giây<br>
                                        <strong>3. Tay:</strong> Nắm chặt, căng cả hai tay 5 giây<br>
                                        <strong>4. Mặt:</strong> Căng tất cả cơ mặt 5 giây<br>
                                        <strong>5. Toàn thân:</strong> Căng toàn bộ cơ thể 5 giây, sau đó thả lỏng hoàn toàn
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thiền định và Mindfulness -->
                <div class="grid grid-2" style="margin-top: 25px;">
                    <div class="card">
                        <h3><i class="fas fa-spa"></i> Thiền định cho giấc ngủ</h3>
                        
                        <div class="accordion">
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Body Scan Meditation
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <p style="color: #4b5563; line-height: 1.6; margin-bottom: 15px;">
                                        Kỹ thuật quét cơ thể từ đầu đến chân, quan sát mà không phán xét. Được chứng minh giảm 58% thời gian chìm vào giấc ngủ.
                                    </p>
                                    <h4 style="color: #667eea; margin-bottom: 8px;">Hướng Dẫn Thực Hành</h4>
                                    <ol style="color: #4b5563; line-height: 1.6;">
                                        <li>Nằm thoải mái, mắt nhắm hoặc nhìn trần</li>
                                        <li>Bắt đầu từ đỉnh đầu, chú ý cảm giác</li>
                                        <li>Di chuyển từ từ xuống: trán, mắt, má, hàm</li>
                                        <li>Tiếp tục: cổ, vai, tay, ngực, bụng</li>
                                        <li>Kết thúc: lưng, mông, đùi, bắp chân, bàn chân</li>
                                        <li>Dành 30-60 giây cho mỗi vùng cơ thể</li>
                                    </ol>
                                    <button class="btn btn-primary" onclick="startBodyScan()">🔍 Body Scan 10 Phút</button>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Loving-Kindness Meditation
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <p style="color: #4b5563; line-height: 1.6;">
                                        Thiền từ bi giúp giảm căng thẳng và lo âu, tăng cảm xúc tích cực trước khi ngủ.
                                    </p>
                                    <h4 style="color: #667eea; margin-bottom: 8px;">Các Câu Mantra</h4>
                                    <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin: 10px 0;">
                                        <p style="color: #1e293b; font-style: italic; line-height: 1.8;">
                                            "Mong tôi được bình an và hạnh phúc"<br>
                                            "Mong tôi được khỏe mạnh và an toàn"<br>
                                            "Mong tôi được sống dễ dàng và tự do"<br>
                                            "Mong tôi được yêu thương và được yêu thương"
                                        </p>
                                    </div>
                                    <small style="color: #6b7280;">Lặp lại cho bản thân, người thân, bạn bè, kẻ thù, và tất cả chúng sinh</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3><i class="fas fa-music"></i> Âm thanh trị liệu</h3>
                        
                        <div class="form-group">
                            <label>Loại âm thanh thư giãn</label>
                            <select id="soundType" onchange="updateSoundInfo()">
                                <option value="nature">Âm thanh thiên nhiên</option>
                                <option value="binaural">Binaural beats</option>
                                <option value="white-noise">White/Pink/Brown noise</option>
                                <option value="classical">Nhạc cổ điển</option>
                                <option value="ambient">Ambient music</option>
                            </select>
                        </div>
                        
                        <div id="soundInfo"></div>
                        
                        <div class="accordion">
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Binaural Beats cho Giấc Ngủ
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <div style="background: #f0f9ff; padding: 15px; border-radius: 8px; margin: 10px 0;">
                                        <h4 style="color: #0c4a6e; margin-bottom: 8px;">Tần Số Sóng Não</h4>
                                        <p style="color: #075985; line-height: 1.6;">
                                            <strong>Delta (0.5-4 Hz):</strong> Giấc ngủ sâu, phục hồi<br>
                                            <strong>Theta (4-8 Hz):</strong> Ru ngủ, thiền sâu<br>
                                            <strong>Alpha (8-13 Hz):</strong> Thư giãn, chuẩn bị ngủ<br>
                                            <strong>Lưu ý:</strong> Cần tai nghe stereo, âm lượng nhỏ
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(this)">
                                    Âm thanh thiên nhiên
                                    <span>▼</span>
                                </div>
                                <div class="accordion-content">
                                    <p style="color: #4b5563; line-height: 1.6;">
                                        <strong>Mưa nhẹ:</strong> 1/f noise tự nhiên, che tiếng ồn<br>
                                        <strong>Sóng biển:</strong> Nhịp điệu chậm, kích hoạt parasympathetic<br>
                                        <strong>Rừng ban đêm:</strong> Tiếng côn trùng, không có âm thanh đột ngột<br>
                                        <strong>Tiếng quạt:</strong> Đơn điệu, ổn định, quen thuộc
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guided Sleep Stories -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-book-open"></i> Sleep Stories và Guided Imagery</h3>
                    <div class="grid grid-3">
                        <div style="text-align: center; padding: 20px; background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 12px;">
                            <h4 style="color: #1e40af; margin-bottom: 8px;">🏖️ Bãi Biển Hoàng Hôn</h4>
                            <p style="color: #1d4ed8; font-size: 0.9rem; margin-bottom: 12px;">Hình dung bản thân trên bãi biển yên tĩnh, sóng nhẹ nhàng, mặt trời lặn...</p>
                            <button class="btn btn-primary" onclick="startStory('beach')">🎧 Nghe (15 phút)</button>
                        </div>
                        
                        <div style="text-align: center; padding: 20px; background: linear-gradient(135deg, #ecfdf5, #d1fae5); border-radius: 12px;">
                            <h4 style="color: #166534; margin-bottom: 8px;">🌲 Rừng Thần Tiên</h4>
                            <p style="color: #047857; font-size: 0.9rem; margin-bottom: 12px;">Đi dạo trong khu rừng cổ tích, ánh sáng lấp lánh, âm thanh tự nhiên...</p>
                            <button class="btn btn-success" onclick="startStory('forest')">🎧 Nghe (20 phút)</button>
                        </div>
                        
                        <div style="text-align: center; padding: 20px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 12px;">
                            <h4 style="color: #92400e; margin-bottom: 8px;">🏔️ Núi Đầy Sao</h4>
                            <p style="color: #b45309; font-size: 0.9rem; margin-bottom: 12px;">Nằm trên đồng cỏ, ngắm bầu trời đầy sao, cảm nhận sự bao la...</p>
                            <button class="btn btn-warning" onclick="startStory('mountain')">🎧 Nghe (18 phút)</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 6: Chronotype -->
            <div id="chronotype" class="tab-content">
                <div class="section-header">
                    <span class="icon"><i class="fas fa-bullseye"></i></span>
                    <h2>Xác định và tối ưu chronotype</h2>
                    <button class="info-btn" onclick="toggleInfo('chronotype-info')">i</button>
                </div>

                <div id="chronotype-info" class="info-box">
                    <h4>Khoa học về chronotype và nhịp sinh học</h4>
                    <p>Chronotype được quyết định bởi đồng hồ sinh học bên trong (SCN - Suprachiasmatic Nucleus), ảnh hưởng bởi:</p>
                    <ul>
                        <li><strong>Gen CLOCK và PER:</strong> Quyết định 50% chronotype, di truyền từ cha mẹ</li>
                        <li><strong>Tuổi tác:</strong> Trẻ em thiên về sáng, thanh thiếu niên muộn, trưởng thành về sáng</li>
                        <li><strong>Giới tính:</strong> Nam giới thường muộn hơn nữ giới 30 phút</li>
                        <li><strong>Ánh sáng:</strong> Exposure sáng sớm đẩy về Lion, tối muộn về Wolf</li>
                    </ul>
                    <p>Sống đúng chronotype cải thiện 40% hiệu suất làm việc, giảm 25% nguy cơ trầm cảm.</p>
                </div>

                <!-- MEQ Test (Morningness-Eveningness Questionnaire) -->
                <div class="card">
                    <h3><i class="fas fa-clipboard-list"></i> Bài test MEQ (Morningness-eveningness questionnaire)</h3>
                    <p style="color: #6b7280; margin-bottom: 20px;">Bài test chuẩn quốc tế được phát triển bởi Horne & Östberg (1976), được sử dụng trong nghiên cứu khoa học.</p>
                    
                    <div id="meqQuestions">
                        <div class="form-group">
                            <label><strong>Câu 1:</strong> Nếu bạn hoàn toàn tự do chọn thời gian, bạn sẽ đi ngủ lúc nào?</label>
                            <div class="rating-buttons" id="meq-q1">
                                <button class="rating-btn" onclick="setMEQRating('meq-q1', 5)">20:00-21:00</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q1', 4)">21:00-22:15</button>
                                <button class="rating-btn active" onclick="setMEQRating('meq-q1', 3)">22:15-00:30</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q1', 2)">00:30-01:45</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q1', 1)">01:45-03:00</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><strong>Câu 2:</strong> Nếu bạn hoàn toàn tự do chọn thời gian, bạn sẽ thức dậy lúc nào?</label>
                            <div class="rating-buttons" id="meq-q2">
                                <button class="rating-btn" onclick="setMEQRating('meq-q2', 5)">05:00-06:30</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q2', 4)">06:30-07:45</button>
                                <button class="rating-btn active" onclick="setMEQRating('meq-q2', 3)">07:45-09:45</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q2', 2)">09:45-11:00</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q2', 1)">11:00-12:00</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><strong>Câu 3:</strong> Thông thường bạn cảm thấy thế nào trong 30 phút đầu sau khi thức dậy?</label>
                            <div class="rating-buttons" id="meq-q3">
                                <button class="rating-btn" onclick="setMEQRating('meq-q3', 4)">Rất tỉnh táo</button>
                                <button class="rating-btn active" onclick="setMEQRating('meq-q3', 3)">Khá tỉnh táo</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q3', 2)">Khá mệt</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q3', 1)">Rất mệt</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><strong>Câu 4:</strong> Lúc nào trong ngày bạn cảm thấy có năng lượng cao nhất?</label>
                            <div class="rating-buttons" id="meq-q4">
                                <button class="rating-btn" onclick="setMEQRating('meq-q4', 6)">05:00-08:00</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q4', 4)">08:00-10:00</button>
                                <button class="rating-btn active" onclick="setMEQRating('meq-q4', 2)">10:00-17:00</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q4', 0)">17:00-22:00</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><strong>Câu 5:</strong> Bạn là người "sáng" hay "tối"?</label>
                            <div class="rating-buttons" id="meq-q5">
                                <button class="rating-btn" onclick="setMEQRating('meq-q5', 6)">Hoàn toàn sáng</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q5', 4)">Thiên về sáng hơn</button>
                                <button class="rating-btn active" onclick="setMEQRating('meq-q5', 2)">Thiên về tối hơn</button>
                                <button class="rating-btn" onclick="setMEQRating('meq-q5', 0)">Hoàn toàn tối</button>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-success" onclick="calculateMEQResult()">📊 Tính Kết quả MEQ</button>
                    
                    <div id="meqResult" style="margin-top: 20px;"></div>
                </div>

                <!-- Mô tả chi tiết từng Chronotype -->
                <div class="grid grid-2" style="margin-top: 25px;">
                    <div class="chronotype-card lion">
                        <div class="chronotype-header">
                            <div class="chronotype-name">🦁 Sư Tử (Lion)</div>
                            <div class="chronotype-percent">25% dân số</div>
                        </div>
                        <div class="chronotype-details">
                            <p><strong>Lịch trình lý tưởng:</strong> Ngủ 21:30-22:00, thức 05:30-06:00</p>
                            <p><strong>Giờ vàng:</strong> 06:00-12:00 (năng suất cao nhất)</p>
                            <p><strong>Đặc điểm sinh lý:</strong> Cortisol cao sáng sớm, melatonin tăng từ 21:00</p>
                            <p><strong>Công việc phù hợp:</strong> CEO, bác sĩ phẫu thuật, giáo viên, quản lý</p>
                            <p><strong>Thách thức:</strong> Mệt sớm buổi tối, khó thích nghi ca đêm</p>
                            <p><strong>Lời khuyên dinh dưỡng:</strong> Bữa sáng giàu protein, tránh caffeine sau 13:00</p>
                        </div>
                    </div>

                    <div class="chronotype-card bear">
                        <div class="chronotype-header">
                            <div class="chronotype-name">🐻 Gấu (Bear)</div>
                            <div class="chronotype-percent">55% dân số</div>
                        </div>
                        <div class="chronotype-details">
                            <p><strong>Lịch trình lý tưởng:</strong> Ngủ 22:30-23:00, thức 06:30-07:30</p>
                            <p><strong>Giờ vàng:</strong> 09:00-13:00 và 15:00-18:00</p>
                            <p><strong>Đặc điểm sinh lý:</strong> Theo chu kỳ mặt trời, dip năng lượng 13:00-15:00</p>
                            <p><strong>Công việc phù hợp:</strong> Nhân viên văn phòng, quản lý dự án, kế toán</p>
                            <p><strong>Thách thức:</strong> Khó tập trung sau bữa trưa, cần nghỉ ngắn</p>
                            <p><strong>Lời khuyên:</strong> Power nap 10-20 phút lúc 13:30, tập thể dục buổi sáng</p>
                        </div>
                    </div>

                    <div class="chronotype-card wolf">
                        <div class="chronotype-header">
                            <div class="chronotype-name">🐺 Sói (Wolf)</div>
                            <div class="chronotype-percent">15% dân số</div>
                        </div>
                        <div class="chronotype-details">
                            <p><strong>Lịch trình lý tưởng:</strong> Ngủ 23:30-00:30, thức 07:30-09:00</p>
                            <p><strong>Giờ vàng:</strong> 17:00-24:00 (năng suất và sáng tạo cao nhất)</p>
                            <p><strong>Đặc điểm sinh lý:</strong> Cortisol chậm tăng, melatonin muộn</p>
                            <p><strong>Công việc phù hợp:</strong> Lập trình viên, nhà văn, nghệ sĩ, bartender</p>
                            <p><strong>Thách thức:</strong> Khó dậy sớm, xung đột với giờ làm việc thông thường</p>
                            <p><strong>Lời khuyên:</strong> Light box buổi sáng, tránh ánh sáng xanh tối muộn</p>
                        </div>
                    </div>

                    <div class="chronotype-card dolphin">
                        <div class="chronotype-header">
                            <div class="chronotype-name">🐬 Cá Heo (Dolphin)</div>
                            <div class="chronotype-percent">10% dân số</div>
                        </div>
                        <div class="chronotype-details">
                            <p><strong>Lịch trình linh hoạt:</strong> Ưu tiên chất lượng hơn số lượng</p>
                            <p><strong>Giờ vàng:</strong> 10:00-14:00 (sau khi hoàn toàn tỉnh táo)</p>
                            <p><strong>Đặc điểm sinh lý:</strong> Hệ thần kinh nhạy cảm, arousal cao</p>
                            <p><strong>Công việc phù hợp:</strong> Nghiên cứu viên, chuyên gia, luật sư</p>
                            <p><strong>Thách thức:</strong> Mất ngủ thường xuyên, lo âu cao</p>
                            <p><strong>Lời khuyên:</strong> Thiền định, môi trường ngủ hoàn hảo, tránh stress</p>
                        </div>
                    </div>
                </div>

                <!-- Chiến lược tối ưu theo Chronotype -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-bullseye"></i> Chiến lược tối ưu hóa theo chronotype</h3>
                    <div class="grid grid-2">
                        <div>
                            <h4 style="color: #1e293b; margin-bottom: 15px;">🌅 Nhóm Sáng (Lion & Bear)</h4>
                            <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); padding: 20px; border-radius: 12px;">
                                <h5 style="color: #92400e; margin-bottom: 10px;"><i class="fas fa-clock"></i> Lịch trình tối ưu</h5>
                                <ul style="color: #b45309; line-height: 1.7; margin-left: 20px;">
                                    <li>Công việc quan trọng: 8:00-12:00</li>
                                    <li>Tập thể dục: 6:00-8:00 hoặc 12:00-15:00</li>
                                    <li>Meeting quan trọng: 9:00-11:00</li>
                                    <li>Học tập: 8:00-12:00</li>
                                    <li>Thư giãn: 18:00-21:00</li>
                                </ul>
                                
                                <h5 style="color: #92400e; margin: 15px 0 10px;">🍽️ Dinh Dưỡng</h5>
                                <ul style="color: #b45309; line-height: 1.7; margin-left: 20px;">
                                    <li>Bữa sáng: Protein cao, carb phức tạp</li>
                                    <li>Caffeine: Trước 13:00-14:00</li>
                                    <li>Bữa tối: Nhẹ, trước 19:00</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div>
                            <h4 style="color: #1e293b; margin-bottom: 15px;">🌙 Nhóm Tối (Wolf & Dolphin)</h4>
                            <div style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe); padding: 20px; border-radius: 12px;">
                                <h5 style="color: #3730a3; margin-bottom: 10px;"><i class="fas fa-clock"></i> Lịch trình tối ưu</h5>
                                <ul style="color: #4338ca; line-height: 1.7; margin-left: 20px;">
                                    <li>Công việc quan trọng: 14:00-18:00, 19:00-22:00</li>
                                    <li>Tập thể dục: 18:00-20:00</li>
                                    <li>Meeting: 14:00-17:00</li>
                                    <li>Sáng tạo: 19:00-23:00</li>
                                    <li>Thư giãn: Sau 22:00</li>
                                </ul>
                                
                                <h5 style="color: #3730a3; margin: 15px 0 10px;">🍽️ Dinh Dưỡng</h5>
                                <ul style="color: #4338ca; line-height: 1.7; margin-left: 20px;">
                                    <li>Bữa sáng: Nhẹ hoặc intermittent fasting</li>
                                    <li>Caffeine: Có thể đến 15:00-16:00</li>
                                    <li>Bữa chính: Trưa và tối</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Jet Lag Calculator -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-plane"></i> Máy tính social jet lag</h3>
                    <p style="color: #6b7280; margin-bottom: 20px;">Social Jet Lag là sự chênh lệch giữa đồng hồ sinh học và lịch trình xã hội. >2 giờ có thể gây tác hại sức khỏe.</p>
                    
                    <div class="grid grid-2">
                        <div>
                            <div class="form-group">
                                <label>Giờ ngủ tự nhiên (cuối tuần)</label>
                                <input type="time" id="naturalBedtime" value="23:00" onchange="calculateSocialJetLag()">
                            </div>
                            
                            <div class="form-group">
                                <label>Giờ thức tự nhiên (cuối tuần)</label>
                                <input type="time" id="naturalWakeTime" value="08:00" onchange="calculateSocialJetLag()">
                            </div>
                        </div>
                        
                        <div>
                            <div class="form-group">
                                <label>Giờ ngủ thực tế (ngày thường)</label>
                                <input type="time" id="workBedtime" value="22:30" onchange="calculateSocialJetLag()">
                            </div>
                            
                            <div class="form-group">
                                <label>Giờ thức thực tế (ngày thường)</label>
                                <input type="time" id="workWakeTime" value="06:30" onchange="calculateSocialJetLag()">
                            </div>
                        </div>
                    </div>
                    
                    <div id="socialJetLagResult" style="margin-top: 20px;"></div>
                </div>
            </div>

            <!-- Tab 7: Nhật ký giấc ngủ -->
            <div id="sleep-journal" class="tab-content">
                <div class="section-header">
                    <span class="icon"><i class="fas fa-book"></i></span>
                    <h2>Nhật ký giấc ngủ khoa học</h2>
                    <button class="info-btn" onclick="toggleInfo('journal-info')">i</button>
                </div>

                <div id="journal-info" class="info-box">
                    <h4>Tầm quan trọng của sleep diary trong y học</h4>
                    <p>Nhật ký giấc ngủ là công cụ chẩn đoán chuẩn vàng được American Academy of Sleep Medicine khuyến nghị:</p>
                    <ul>
                        <li><strong>Chẩn đoán:</strong> Giúp phát hiện insomnia, circadian rhythm disorders</li>
                        <li><strong>Theo dõi điều trị:</strong> Đánh giá hiệu quả can thiệp</li>
                        <li><strong>Phát hiện patterns:</strong> Tìm mối tương quan ẩn</li>
                        <li><strong>Objective vs Subjective:</strong> So sánh cảm nhận với thực tế</li>
                    </ul>
                    <p>Ghi chép ít nhất 14 ngày liên tục để có dữ liệu đáng tin cậy. Studies cho thấy 85% người dùng nhật ký cải thiện giấc ngủ trong 4 tuần.</p>
                </div>

                <div class="grid grid-2">
                    <div class="card">
                        <h3><i class="fas fa-edit"></i> Nhập dữ liệu hôm nay</h3>
                        
                        <div class="form-group">
                            <label>Ngày</label>
                            <input type="date" id="journalDate">
                        </div>

                        <div class="grid grid-2">
                            <div class="form-group">
                                <label>Giờ lên giường</label>
                                <input type="time" id="journalBedTime">
                                <small>Thời điểm nằm xuống giường</small>
                            </div>
                            
                            <div class="form-group">
                                <label>Giờ tắt đèn/bắt đầu cố ngủ</label>
                                <input type="time" id="journalLightsOut">
                                <small>Thời điểm thực sự cố gắng ngủ</small>
                            </div>
                        </div>

                        <div class="grid grid-2">
                            <div class="form-group">
                                <label>Thời gian chìm vào giấc ngủ (phút)</label>
                                <input type="number" id="journalSleepLatency" min="0" max="300">
                            </div>
                            
                            <div class="form-group">
                                <label>Số lần thức giấc trong đêm</label>
                                <input type="number" id="journalNightWakings" min="0" max="20">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Thời gian thức giấc giữa đêm (phút)</label>
                            <input type="number" id="journalWakeTime" min="0" max="480">
                            <small>Tổng thời gian không ngủ được giữa đêm</small>
                        </div>

                        <div class="grid grid-2">
                            <div class="form-group">
                                <label>Giờ thức dậy cuối cùng</label>
                                <input type="time" id="journalFinalWake">
                            </div>
                            
                            <div class="form-group">
                                <label>Giờ ra khỏi giường</label>
                                <input type="time" id="journalOutOfBed">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Chất lượng giấc ngủ (1-5)</label>
                            <div class="rating-buttons" id="journalSleepQuality">
                                <button class="rating-btn" onclick="setRating('journalSleepQuality', 1)">Rất tệ</button>
                                <button class="rating-btn" onclick="setRating('journalSleepQuality', 2)">Tệ</button>
                                <button class="rating-btn active" onclick="setRating('journalSleepQuality', 3)">Ổn</button>
                                <button class="rating-btn" onclick="setRating('journalSleepQuality', 4)">Tốt</button>
                                <button class="rating-btn" onclick="setRating('journalSleepQuality', 5)">Rất tốt</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Cảm giác khi thức dậy (1-5)</label>
                            <div class="rating-buttons" id="journalMorningFeeling">
                                <button class="rating-btn" onclick="setRating('journalMorningFeeling', 1)">Rất mệt</button>
                                <button class="rating-btn" onclick="setRating('journalMorningFeeling', 2)">Mệt</button>
                                <button class="rating-btn active" onclick="setRating('journalMorningFeeling', 3)">Bình thường</button>
                                <button class="rating-btn" onclick="setRating('journalMorningFeeling', 4)">Sảng khoái</button>
                                <button class="rating-btn" onclick="setRating('journalMorningFeeling', 5)">Rất sảng khoái</button>
                            </div>
                        </div>

                        <!-- Lifestyle factors -->
                        <h4 style="margin: 20px 0 10px; color: #1e293b;">🍽️ Yếu Tố Lối Sống</h4>
                        
                        <div class="grid grid-2">
                            <div class="form-group">
                                <label>Caffeine</label>
                                <input type="text" id="journalCaffeine" placeholder="VD: 2 cốc cà phê, 14:30">
                            </div>
                            
                            <div class="form-group">
                                <label>Rượu bia</label>
                                <input type="text" id="journalAlcohol" placeholder="VD: 1 chai bia, 20:00">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Tập thể dục</label>
                            <input type="text" id="journalExercise" placeholder="VD: Chạy bộ 30 phút, 18:00">
                        </div>

                        <div class="form-group">
                            <label>Bữa ăn tối (thời gian và mức độ no)</label>
                            <input type="text" id="journalDinner" placeholder="VD: 19:00, ăn no">
                        </div>

                        <div class="form-group">
                            <label>Ngủ trưa</label>
                            <input type="text" id="journalNap" placeholder="VD: 13:30-14:00 (30 phút)">
                        </div>

                        <div class="form-group">
                            <label>Mức độ căng thẳng trong ngày (1-5)</label>
                            <div class="rating-buttons" id="journalStress">
                                <button class="rating-btn active" onclick="setRating('journalStress', 1)">Rất thấp</button>
                                <button class="rating-btn" onclick="setRating('journalStress', 2)">Thấp</button>
                                <button class="rating-btn" onclick="setRating('journalStress', 3)">Trung bình</button>
                                <button class="rating-btn" onclick="setRating('journalStress', 4)">Cao</button>
                                <button class="rating-btn" onclick="setRating('journalStress', 5)">Rất cao</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Thuốc men</label>
                            <input type="text" id="journalMedication" placeholder="Tên thuốc, liều lượng, thời gian">
                        </div>

                        <div class="form-group">
                            <label>Ghi chú khác</label>
                            <textarea id="journalNotes" rows="3" placeholder="Sự kiện đặc biệt, cảm xúc, triệu chứng bệnh..."></textarea>
                        </div>

                        <button class="btn btn-success" onclick="saveAdvancedJournalEntry()">
                            <i class="fas fa-save"></i> Lưu nhật ký
                        </button>
                    </div>

                    <div class="card">
                        <h3>📊 Lịch sử và phân tích</h3>
                        <div id="journalHistory" style="max-height: 500px; overflow-y: auto;"></div>
                        
                        <div id="journalStats" style="margin-top: 20px;"></div>
                    </div>
                </div>

                <!-- Advanced Analytics -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-chart-line"></i> Phân tích xu hướng và tương quan</h3>
                    <div id="journalAnalytics"></div>
                </div>

                <!-- Export/Import -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-save"></i> Xuất/nhập dữ liệu</h3>
                    <div class="grid grid-2">
                        <div>
                            <h4><i class="fas fa-file-export"></i> Xuất dữ liệu</h4>
                            <p style="color: #6b7280; margin-bottom: 15px;">Xuất nhật ký để chia sẻ với bác sĩ hoặc sao lưu</p>
                            <button class="btn btn-primary" onclick="exportJournal()">📋 Xuất CSV</button>
                            <button class="btn btn-primary" onclick="exportJournalPDF()">📄 Xuất PDF</button>
                        </div>
                        
                        <div>
                            <h4><i class="fas fa-file-import"></i> Nhập dữ liệu</h4>
                            <p style="color: #6b7280; margin-bottom: 15px;">Nhập dữ liệu từ file CSV đã xuất trước đó</p>
                            <input type="file" id="importFile" accept=".csv" style="margin-bottom: 10px;">
                            <button class="btn btn-warning" onclick="importJournal()">📁 Nhập CSV</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 8: Rối loạn giấc ngủ -->
            <div id="sleep-disorders" class="tab-content">
                <div class="section-header">
                    <span class="icon"><i class="fas fa-heartbeat"></i></span>
                    <h2>Rối loạn giấc ngủ và chẩn đoán</h2>
                    <button class="info-btn" onclick="toggleInfo('disorders-info')">i</button>
                </div>

                <div id="disorders-info" class="info-box">
                    <h4><i class="fas fa-exclamation-triangle"></i> Lưu ý quan trọng về chẩn đoán y khoa</h4>
                    <p><strong>Công cụ này chỉ mang tính tham khảo và giáo dục, không thể thay thế chẩn đoán y khoa chuyên nghiệp.</strong></p>
                    <p>Nếu bạn có triệu chứng kéo dài >1 tháng, ảnh hưởng nghiêm trọng đến cuộc sống, hãy tham khảo:</p>
                    <ul>
                        <li>Bác sĩ chuyên khoa Thần kinh</li>
                        <li>Bác sĩ chuyên khoa Tâm thần</li>
                        <li>Trung tâm Y học Giấc ngủ</li>
                        <li>Bác sĩ đa khoa có kinh nghiệm về giấc ngủ</li>
                    </ul>
                </div>

                <!-- Insomnia Assessment -->
                <div class="card">
                    <h3><i class="fas fa-bed"></i> Đánh giá mất ngủ (Insomnia severity index - ISI)</h3>
                    <p style="color: #6b7280; margin-bottom: 20px;">Công cụ đánh giá mức độ nghiêm trọng của chứng mất ngủ, được sử dụng rộng rãi trong lâm sàng.</p>
                    
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-header" onclick="toggleAccordion(this)">
                                Câu hỏi đánh giá ISI
                                <span>▼</span>
                            </div>
                            <div class="accordion-content">
                                <div class="form-group">
                                    <label><strong>1.</strong> Trong 2 tuần qua, mức độ khó khăn khi đi vào giấc ngủ:</label>
                                    <div class="rating-buttons" id="isi-q1">
                                        <button class="rating-btn active" onclick="setRating('isi-q1', 0)">Không</button>
                                        <button class="rating-btn" onclick="setRating('isi-q1', 1)">Nhẹ</button>
                                        <button class="rating-btn" onclick="setRating('isi-q1', 2)">Vừa</button>
                                        <button class="rating-btn" onclick="setRating('isi-q1', 3)">Nghiêm trọng</button>
                                        <button class="rating-btn" onclick="setRating('isi-q1', 4)">Rất nghiêm trọng</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><strong>2.</strong> Khó khăn duy trì giấc ngủ (thức giấc thường xuyên):</label>
                                    <div class="rating-buttons" id="isi-q2">
                                        <button class="rating-btn active" onclick="setRating('isi-q2', 0)">Không</button>
                                        <button class="rating-btn" onclick="setRating('isi-q2', 1)">Nhẹ</button>
                                        <button class="rating-btn" onclick="setRating('isi-q2', 2)">Vừa</button>
                                        <button class="rating-btn" onclick="setRating('isi-q2', 3)">Nghiêm trọng</button>
                                        <button class="rating-btn" onclick="setRating('isi-q2', 4)">Rất nghiêm trọng</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><strong>3.</strong> Thức dậy quá sớm và không ngủ lại được:</label>
                                    <div class="rating-buttons" id="isi-q3">
                                        <button class="rating-btn active" onclick="setRating('isi-q3', 0)">Không</button>
                                        <button class="rating-btn" onclick="setRating('isi-q3', 1)">Nhẹ</button>
                                        <button class="rating-btn" onclick="setRating('isi-q3', 2)">Vừa</button>
                                        <button class="rating-btn" onclick="setRating('isi-q3', 3)">Nghiêm trọng</button>
                                        <button class="rating-btn" onclick="setRating('isi-q3', 4)">Rất nghiêm trọng</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><strong>4.</strong> Mức độ hài lòng với giấc ngủ hiện tại:</label>
                                    <div class="rating-buttons" id="isi-q4">
                                        <button class="rating-btn" onclick="setRating('isi-q4', 0)">Rất hài lòng</button>
                                        <button class="rating-btn" onclick="setRating('isi-q4', 1)">Hài lòng</button>
                                        <button class="rating-btn active" onclick="setRating('isi-q4', 2)">Trung bình</button>
                                        <button class="rating-btn" onclick="setRating('isi-q4', 3)">Không hài lòng</button>
                                        <button class="rating-btn" onclick="setRating('isi-q4', 4)">Rất không hài lòng</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><strong>5.</strong> Mức độ ảnh hưởng đến hoạt động ban ngày:</label>
                                    <div class="rating-buttons" id="isi-q5">
                                        <button class="rating-btn active" onclick="setRating('isi-q5', 0)">Không ảnh hưởng</button>
                                        <button class="rating-btn" onclick="setRating('isi-q5', 1)">Ít ảnh hưởng</button>
                                        <button class="rating-btn" onclick="setRating('isi-q5', 2)">Vừa phải</button>
                                        <button class="rating-btn" onclick="setRating('isi-q5', 3)">Nhiều</button>
                                        <button class="rating-btn" onclick="setRating('isi-q5', 4)">Rất nhiều</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><strong>6.</strong> Mức độ lo lắng của người khác về giấc ngủ của bạn:</label>
                                    <div class="rating-buttons" id="isi-q6">
                                        <button class="rating-btn active" onclick="setRating('isi-q6', 0)">Không lo lắng</button>
                                        <button class="rating-btn" onclick="setRating('isi-q6', 1)">Ít lo lắng</button>
                                        <button class="rating-btn" onclick="setRating('isi-q6', 2)">Vừa phải</button>
                                        <button class="rating-btn" onclick="setRating('isi-q6', 3)">Nhiều</button>
                                        <button class="rating-btn" onclick="setRating('isi-q6', 4)">Rất nhiều</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><strong>7.</strong> Mức độ ảnh hưởng đến chất lượng cuộc sống:</label>
                                    <div class="rating-buttons" id="isi-q7">
                                        <button class="rating-btn active" onclick="setRating('isi-q7', 0)">Không ảnh hưởng</button>
                                        <button class="rating-btn" onclick="setRating('isi-q7', 1)">Ít ảnh hưởng</button>
                                        <button class="rating-btn" onclick="setRating('isi-q7', 2)">Vừa phải</button>
                                        <button class="rating-btn" onclick="setRating('isi-q7', 3)">Nhiều</button>
                                        <button class="rating-btn" onclick="setRating('isi-q7', 4)">Rất nhiều</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-primary" onclick="calculateISI()">📊 Tính Điểm ISI</button>
                    
                    <div id="isiResult" style="margin-top: 20px;"></div>
                </div>

                <!-- Sleep Apnea Screening -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-wind"></i> Sàng lọc ngưng thở khi ngủ (STOP-BANG)</h3>
                    <p style="color: #6b7280; margin-bottom: 20px;">Công cụ sàng lọc ngưng thở khi ngủ - rối loạn nghiêm trọng ảnh hưởng 4% nam và 2% nữ trưởng thành.</p>
                    
                    <div class="grid grid-2">
                        <div>
                            <div class="form-group">
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="stopbang-snoring"> <strong>S</strong>noring: Bạn có ngáy to không?
                                </label>
                                <small style="color: #6b7280;">Ngáy to đến mức làm phiền người khác</small>
                            </div>
                            
                            <div class="form-group">
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="stopbang-tired"> <strong>T</strong>ired: Bạn có thường xuyên cảm thấy mệt mỏi, buồn ngủ ban ngày không?
                                </label>
                            </div>
                            
                            <div class="form-group">
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="stopbang-observed"> <strong>O</strong>bserved: Có ai nhìn thấy bạn ngừng thở khi ngủ không?
                                </label>
                            </div>
                            
                            <div class="form-group">
                                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                    <input type="checkbox" id="stopbang-pressure"> <strong>P</strong>ressure: Bạn có bị tăng huyết áp không?
                                </label>
                            </div>
                        </div>
                        
                        <div>
                            <div class="form-group">
                                <label><strong>B</strong>MI: Chỉ số khối cơ thể của bạn</label>
                                <div style="display: flex; gap: 10px; align-items: center;">
                                    <input type="number" id="height" placeholder="Chiều cao (cm)" style="flex: 1;">
                                    <input type="number" id="weight" placeholder="Cân nặng (kg)" style="flex: 1;">
                                    <span id="bmiValue" style="font-weight: 600; color: #667eea;"></span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px; margin-top: 8px;">
                                    <input type="checkbox" id="stopbang-bmi" disabled> BMI > 35 kg/m²
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label><strong>A</strong>ge: Tuổi của bạn</label>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <input type="number" id="age" placeholder="Tuổi" style="width: 80px;" onchange="updateStopBang()">
                                    <input type="checkbox" id="stopbang-age" disabled> > 50 tuổi
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label><strong>N</strong>eck: Chu vi cổ</label>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <input type="number" id="neckCirc" placeholder="Chu vi cổ (cm)" onchange="updateStopBang()">
                                    <input type="checkbox" id="stopbang-neck" disabled> Nam >43cm, Nữ >41cm
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label><strong>G</strong>ender: Giới tính</label>
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <label style="display: flex; align-items: center; gap: 5px; font-weight: normal;">
                                        <input type="radio" name="gender" value="male" onchange="updateStopBang()"> Nam
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 5px; font-weight: normal;">
                                        <input type="radio" name="gender" value="female" onchange="updateStopBang()"> Nữ
                                    </label>
                                    <input type="checkbox" id="stopbang-gender" disabled> Nam giới
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-warning" onclick="calculateStopBang()"><i class="fas fa-exclamation-triangle"></i> Đánh giá nguy cơ</button>
                    
                    <div id="stopBangResult" style="margin-top: 20px;"></div>
                </div>

                <!-- Restless Legs Syndrome -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-walking"></i> Hội chứng chân không yên (Restless legs syndrome)</h3>
                    <p style="color: #6b7280; margin-bottom: 20px;">Rối loạn thần kinh ảnh hưởng 7-10% dân số, đặc trưng bởi cảm giác khó chịu ở chân và thôi thúc phải di chuyển.</p>
                    
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-header" onclick="toggleAccordion(this)">
                                4 tiêu chí chẩn đoán RLS
                                <span>▼</span>
                            </div>
                            <div class="accordion-content">
                                <div style="background: #f8fafc; padding: 20px; border-radius: 12px;">
                                    <div class="form-group">
                                        <label style="display: flex; align-items: flex-start; gap: 8px; font-weight: normal; line-height: 1.6;">
                                            <input type="checkbox" id="rls-urge" style="margin-top: 4px;">
                                            <span><strong>1. Thôi thúc di chuyển chân:</strong> Có cảm giác thôi thúc không thể cưỡng lại được phải di chuyển chân, thường kèm theo cảm giác khó chịu (ngứa, châm chích, bò, đau nhức)</span>
                                        </label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label style="display: flex; align-items: flex-start; gap: 8px; font-weight: normal; line-height: 1.6;">
                                            <input type="checkbox" id="rls-rest" style="margin-top: 4px;">
                                            <span><strong>2. Bắt đầu khi nghỉ ngơi:</strong> Triệu chứng bắt đầu hoặc trở nên tồi tệ hơn trong thời gian nghỉ ngơi, không hoạt động (ngồi, nằm)</span>
                                        </label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label style="display: flex; align-items: flex-start; gap: 8px; font-weight: normal; line-height: 1.6;">
                                            <input type="checkbox" id="rls-movement" style="margin-top: 4px;">
                                            <span><strong>3. Giảm bớt khi di chuyển:</strong> Triệu chứng được giảm bớt một phần hoặc hoàn toàn bằng cách di chuyển (đi bộ, kéo giãn, xoa bóp)</span>
                                        </label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label style="display: flex; align-items: flex-start; gap: 8px; font-weight: normal; line-height: 1.6;">
                                            <input type="checkbox" id="rls-evening" style="margin-top: 4px;">
                                            <span><strong>4. Tồi tệ hơn vào buổi tối:</strong> Triệu chứng tồi tệ hơn hoặc chỉ xuất hiện vào buổi tối/ban đêm so với ban ngày</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin-top: 15px;">
                        <label>Tần suất triệu chứng trong tuần qua:</label>
                        <select id="rlsFrequency">
                            <option value="0">Không có triệu chứng</option>
                            <option value="1">1 lần</option>
                            <option value="2">2-3 lần</option>
                            <option value="3">4-5 lần</option>
                            <option value="4">Hàng ngày</option>
                        </select>
                    </div>
                    
                    <button class="btn btn-primary" onclick="assessRLS()"><i class="fas fa-search"></i> Đánh giá RLS</button>
                    
                    <div id="rlsResult" style="margin-top: 20px;"></div>
                </div>

                <!-- Narcolepsy Screening -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-bed"></i> Sàng lọc chứng ngủ rũ (Narcolepsy) - Epworth sleepiness scale</h3>
                    <p style="color: #6b7280; margin-bottom: 20px;">ESS đánh giá xu hướng ngủ gật trong các tình huống hàng ngày. Điểm >10 cần được đánh giá thêm.</p>
                    
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-header" onclick="toggleAccordion(this)">
                                8 tình huống đánh giá ESS
                                <span>▼</span>
                            </div>
                            <div class="accordion-content">
                                <p style="color: #4b5563; margin-bottom: 15px;"><strong>Hướng dẫn:</strong> Đánh giá khả năng ngủ gật trong các tình huống sau (dù chưa từng gặp, hãy tưởng tượng phản ứng của bạn):</p>
                                <small style="color: #6b7280; margin-bottom: 15px; display: block;">0 = Không bao giờ ngủ gật | 1 = Ít khi ngủ gật | 2 = Có thể ngủ gật | 3 = Rất có khả năng ngủ gật</small>
                                
                                <div class="form-group">
                                    <label>1. Ngồi đọc sách/báo:</label>
                                    <div class="rating-buttons" id="ess-q1">
                                        <button class="rating-btn active" onclick="setRating('ess-q1', 0)">0</button>
                                        <button class="rating-btn" onclick="setRating('ess-q1', 1)">1</button>
                                        <button class="rating-btn" onclick="setRating('ess-q1', 2)">2</button>
                                        <button class="rating-btn" onclick="setRating('ess-q1', 3)">3</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>2. Xem TV:</label>
                                    <div class="rating-buttons" id="ess-q2">
                                        <button class="rating-btn active" onclick="setRating('ess-q2', 0)">0</button>
                                        <button class="rating-btn" onclick="setRating('ess-q2', 1)">1</button>
                                        <button class="rating-btn" onclick="setRating('ess-q2', 2)">2</button>
                                        <button class="rating-btn" onclick="setRating('ess-q2', 3)">3</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>3. Ngồi không hoạt động ở nơi công cộng (rạp, hội nghị):</label>
                                    <div class="rating-buttons" id="ess-q3">
                                        <button class="rating-btn active" onclick="setRating('ess-q3', 0)">0</button>
                                        <button class="rating-btn" onclick="setRating('ess-q3', 1)">1</button>
                                        <button class="rating-btn" onclick="setRating('ess-q3', 2)">2</button>
                                        <button class="rating-btn" onclick="setRating('ess-q3', 3)">3</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>4. Là hành khách trên xe hơi trong 1 giờ không nghỉ:</label>
                                    <div class="rating-buttons" id="ess-q4">
                                        <button class="rating-btn active" onclick="setRating('ess-q4', 0)">0</button>
                                        <button class="rating-btn" onclick="setRating('ess-q4', 1)">1</button>
                                        <button class="rating-btn" onclick="setRating('ess-q4', 2)">2</button>
                                        <button class="rating-btn" onclick="setRating('ess-q4', 3)">3</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>5. Nằm nghỉ vào buổi chiều khi có điều kiện:</label>
                                    <div class="rating-buttons" id="ess-q5">
                                        <button class="rating-btn active" onclick="setRating('ess-q5', 0)">0</button>
                                        <button class="rating-btn" onclick="setRating('ess-q5', 1)">1</button>
                                        <button class="rating-btn" onclick="setRating('ess-q5', 2)">2</button>
                                        <button class="rating-btn" onclick="setRating('ess-q5', 3)">3</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>6. Ngồi nói chuyện với người khác:</label>
                                    <div class="rating-buttons" id="ess-q6">
                                        <button class="rating-btn active" onclick="setRating('ess-q6', 0)">0</button>
                                        <button class="rating-btn" onclick="setRating('ess-q6', 1)">1</button>
                                        <button class="rating-btn" onclick="setRating('ess-q6', 2)">2</button>
                                        <button class="rating-btn" onclick="setRating('ess-q6', 3)">3</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>7. Ngồi yên lặng sau bữa trưa (không uống rượu):</label>
                                    <div class="rating-buttons" id="ess-q7">
                                        <button class="rating-btn active" onclick="setRating('ess-q7', 0)">0</button>
                                        <button class="rating-btn" onclick="setRating('ess-q7', 1)">1</button>
                                        <button class="rating-btn" onclick="setRating('ess-q7', 2)">2</button>
                                        <button class="rating-btn" onclick="setRating('ess-q7', 3)">3</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>8. Trong xe hơi khi dừng vài phút trong giao thông:</label>
                                    <div class="rating-buttons" id="ess-q8">
                                        <button class="rating-btn active" onclick="setRating('ess-q8', 0)">0</button>
                                        <button class="rating-btn" onclick="setRating('ess-q8', 1)">1</button>
                                        <button class="rating-btn" onclick="setRating('ess-q8', 2)">2</button>
                                        <button class="rating-btn" onclick="setRating('ess-q8', 3)">3</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-primary" onclick="calculateESS()">📊 Tính Điểm ESS</button>
                    
                    <div id="essResult" style="margin-top: 20px;"></div>
                </div>

                <!-- When to see a doctor -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-hospital"></i> Khi nào cần gặp chuyên gia</h3>
                    <div class="grid grid-2">
                        <div>
                            <h4 style="color: #dc2626; margin-bottom: 12px;">🚨 Cần Gặp Ngay</h4>
                            <ul style="color: #4b5563; line-height: 1.7; margin-left: 20px;">
                                <li>Ngưng thở khi ngủ được chứng kiến</li>
                                <li>Ngủ gật không kiểm soát khi lái xe</li>
                                <li>Ảo giác khi ngủ/thức</li>
                                <li>Liệt cơ đột ngột (cataplexy)</li>
                                <li>Hành vi bạo lực khi ngủ REM</li>
                                <li>Mất ngủ kèm tăng cân nhanh</li>
                            </ul>
                        </div>
                        
                        <div>
                            <h4 style="color: #f59e0b; margin-bottom: 12px;">⚠️ Cần Tư Vấn</h4>
                            <ul style="color: #4b5563; line-height: 1.7; margin-left: 20px;">
                                <li>Mất ngủ >3 tuần dù áp dụng sleep hygiene</li>
                                <li>Ngáy to + mệt mỏi ban ngày</li>
                                <li>Chân không yên >2 lần/tuần</li>
                                <li>Điểm ESS >10</li>
                                <li>Điểm ISI >14</li>
                                <li>Ảnh hưởng nghiêm trọng đến công việc/học tập</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #eff6ff, #dbeafe); padding: 20px; border-radius: 12px; margin-top: 20px;">
                        <h4 style="color: #1e40af; margin-bottom: 12px;">📋 Chuẩn Bị Khám Chuyên Khoa</h4>
                        <p style="color: #1d4ed8; line-height: 1.6;">
                            <strong>Mang theo:</strong> Nhật ký giấc ngủ 2 tuần, danh sách thuốc đang dùng, kết quả xét nghiệm gần đây<br>
                            <strong>Chuẩn bị:</strong> Mô tả chi tiết triệu chứng, thời gian bắt đầu, yếu tố làm tăng/giảm<br>
                            <strong>Có thể cần:</strong> Sleep study (đo đa ký giấc ngủ), xét nghiệm máu, đo huyết áp 24h
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tab 9: Khuyến nghị -->
            <div id="recommendations" class="tab-content">
                <div class="section-header">
                    <span class="icon"><i class="fas fa-lightbulb"></i></span>
                    <h2>Khuyến nghị cải thiện toàn diện</h2>
                </div>

                <div id="recommendationsList"></div>

                <!-- Evidence-based interventions -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-microscope"></i> Can thiệp dựa trên bằng chứng khoa học</h3>
                    <div class="grid grid-2">
                        <div>
                            <h4 style="color: #166534; margin-bottom: 12px;">✅ Hiệu Quả Cao (Level A Evidence)</h4>
                            <ul style="color: #047857; line-height: 1.7; margin-left: 20px;">
                                <li><strong>CBT-I:</strong> Cognitive Behavioral Therapy for Insomnia (75-80% hiệu quả)</li>
                                <li><strong>Sleep restriction:</strong> Hạn chế thời gian trên giường</li>
                                <li><strong>Stimulus control:</strong> Chỉ sử dụng giường để ngủ</li>
                                <li><strong>Progressive muscle relaxation:</strong> Thư giãn cơ tiến triển</li>
                                <li><strong>Sleep hygiene education:</strong> Giáo dục vệ sinh giấc ngủ</li>
                            </ul>
                        </div>
                        
                        <div>
                            <h4 style="color: #92400e; margin-bottom: 12px;">⚠️ Bằng Chứng Hạn Chế</h4>
                            <ul style="color: #b45309; line-height: 1.7; margin-left: 20px;">
                                <li><strong>Melatonin:</strong> Chỉ hiệu quả với jet lag, shift work</li>
                                <li><strong>Herbal supplements:</strong> Thiếu nghiên cứu chất lượng cao</li>
                                <li><strong>Blue light glasses:</strong> Hiệu quả nhỏ, cần nghiên cứu thêm</li>
                                <li><strong>Sleep apps:</strong> Tiện lợi nhưng chưa validate lâm sàng</li>
                                <li><strong>Weighted blankets:</strong> Có thể giúp lo âu nhưng không cải thiện giấc ngủ khách quan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Personalized recommendations engine -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-bullseye"></i> Khuyến nghị cá nhân hóa</h3>
                    <p style="color: #6b7280; margin-bottom: 20px;">Dựa trên dữ liệu bạn đã nhập, hệ thống sẽ đưa ra khuyến nghị ưu tiên theo mức độ quan trọng và khả thi.</p>
                    
                    <button class="btn btn-success" onclick="generatePersonalizedRecommendations()">
                        <i class="fas fa-sync"></i> Tạo khuyến nghị cá nhân
                    </button>
                    
                    <div id="personalizedRecommendations" style="margin-top: 20px;"></div>
                </div>

                <!-- Implementation guide -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-clipboard-list"></i> Hướng dẫn thực hiện 4 tuần</h3>
                    <p style="color: #6b7280; margin-bottom: 20px;">Lộ trình từng bước để tối ưu hóa giấc ngủ một cách bền vững và hiệu quả.</p>
                    
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-header" onclick="toggleAccordion(this)">
                                <i class="fas fa-search"></i> Tuần 1: Đánh giá và thiết lập nền tảng
                                <span>▼</span>
                            </div>
                            <div class="accordion-content">
                                <h4 style="color: #1e293b; margin-bottom: 12px;">Mục Tiêu:</h4>
                                <p style="color: #4b5563; margin-bottom: 15px;">Thu thập dữ liệu cơ bản và tạo môi trường ngủ lý tưởng</p>
                                
                                <h5 style="color: #667eea; margin-bottom: 8px;">Nhiệm Vụ Hàng Ngày:</h5>
                                <ul style="color: #4b5563; line-height: 1.7; margin-left: 20px; margin-bottom: 15px;">
                                    <li>Ghi nhật ký giấc ngủ chi tiết</li>
                                    <li>Đo nhiệt độ, ánh sáng, tiếng ồn phòng ngủ</li>
                                    <li>Không thay đổi thói quen hiện tại</li>
                                    <li>Quan sát mối liên hệ giữa hoạt động ban ngày và giấc ngủ</li>
                                </ul>
                                
                                <h5 style="color: #667eea; margin-bottom: 8px;">Cải thiện môi trường:</h5>
                                <ul style="color: #4b5563; line-height: 1.7; margin-left: 20px;">
                                    <li>Mua rèm cản sáng hoặc mặt nạ ngủ</li>
                                    <li>Điều chỉnh nhiệt độ phòng 16-19°C</li>
                                    <li>Loại bỏ thiết bị điện tử khỏi phòng ngủ</li>
                                    <li>Kiểm tra độ thoải mái nệm/gối</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <div class="accordion-header" onclick="toggleAccordion(this)">
                                <i class="fas fa-clock"></i> Tuần 2: Thiết lập lịch trình nhất quán
                                <span>▼</span>
                            </div>
                            <div class="accordion-content">
                                <h5 style="color: #667eea; margin-bottom: 8px;">Xác định giờ ngủ-thức tối ưu:</h5>
                                <ul style="color: #4b5563; line-height: 1.7; margin-left: 20px; margin-bottom: 15px;">
                                    <li>Dựa trên chronotype và nhu cầu ngủ cá nhân</li>
                                    <li>Tính toán theo chu kỳ 90 phút</li>
                                    <li>Tuân thủ nghiêm ngặt 7 ngày, kể cả cuối tuần</li>
                                    <li>Chấp nhận khó khăn ban đầu</li>
                                </ul>
                                
                                <h5 style="color: #667eea; margin-bottom: 8px;">Quản Lý Chất Kích Thích:</h5>
                                <ul style="color: #4b5563; line-height: 1.7; margin-left: 20px;">
                                    <li>Ngưng caffeine sau 14:00 (hoặc sớm hơn nếu nhạy cảm)</li>
                                    <li>Hạn chế rượu bia, đặc biệt 3h trước ngủ</li>
                                    <li>Tránh nicotine 4h trước ngủ</li>
                                    <li>Bữa ăn tối nhẹ, trước 19:00</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <div class="accordion-header" onclick="toggleAccordion(this)">
                                🧘 Tuần 3: Tích Hợp Thư Giãn và Vận Động
                                <span>▼</span>
                            </div>
                            <div class="accordion-content">
                                <h5 style="color: #667eea; margin-bottom: 8px;">Bedtime Routine (30-60 phút):</h5>
                                <ul style="color: #4b5563; line-height: 1.7; margin-left: 20px; margin-bottom: 15px;">
                                    <li>Tắt tất cả màn hình 1h trước ngủ</li>
                                    <li>Tắm nước ấm hoặc ngâm chân</li>
                                    <li>Đọc sách giấy hoặc nghe audiobook</li>
                                    <li>Thực hành kỹ thuật thở 4-7-8</li>
                                    <li>Viết nhật ký biết ơn hoặc lo lắng</li>
                                </ul>
                                
                                <h5 style="color: #667eea; margin-bottom: 8px;">Tối ưu vận động:</h5>
                                <ul style="color: #4b5563; line-height: 1.7; margin-left: 20px;">
                                    <li>30 phút vận động vừa phải mỗi ngày</li>
                                    <li>Tập buổi sáng nếu có thể</li>
                                    <li>Tránh tập cường độ cao 3h trước ngủ</li>
                                    <li>Yoga nhẹ hoặc stretching buổi tối</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <div class="accordion-header" onclick="toggleAccordion(this)">
                                🎯 Tuần 4: Tinh Chỉnh và Duy Trì
                                <span>▼</span>
                            </div>
                            <div class="accordion-content">
                                <h5 style="color: #667eea; margin-bottom: 8px;">Đánh giá và điều chỉnh:</h5>
                                <ul style="color: #4b5563; line-height: 1.7; margin-left: 20px; margin-bottom: 15px;">
                                    <li>So sánh nhật ký tuần 1 vs tuần 4</li>
                                    <li>Tính toán cải thiện các chỉ số chính</li>
                                    <li>Xác định yếu tố nào hiệu quả nhất</li>
                                    <li>Điều chỉnh giờ ngủ-thức nếu cần</li>
                                </ul>
                                
                                <h5 style="color: #667eea; margin-bottom: 8px;">Lập Kế Hoạch Dài Hạn:</h5>
                                <ul style="color: #4b5563; line-height: 1.7; margin-left: 20px;">
                                    <li>Xây dựng hệ thống nhắc nhở</li>
                                    <li>Chuẩn bị cho các tình huống đặc biệt</li>
                                    <li>Thiết lập check-in hàng tuần</li>
                                    <li>Xác định dấu hiệu cảnh báo sớm</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress tracking -->
                <div class="card" style="margin-top: 25px;">
                    <h3><i class="fas fa-chart-line"></i> Theo dõi tiến độ</h3>
                    <div class="grid grid-3">
                        <div class="stat-card">
                            <div class="stat-value" id="progressWeek">1</div>
                            <div class="stat-label">Tuần Hiện Tại</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-value" id="progressTasks">0/7</div>
                            <div class="stat-label">Nhiệm Vụ Hoàn Thành</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-value" id="progressImprovement">+0%</div>
                            <div class="stat-label">Cải Thiện Chất Lượng</div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <h4 style="color: #1e293b; margin-bottom: 12px;">Checklist Tuần Này</h4>
                        <div id="weeklyTasks"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="tips-section">
            <h3 style="text-align: center; margin-bottom: 20px;">💡 Mẹo Sử Dụng Ứng Dụng Hiệu Quả</h3>
            <div class="tips-grid">
                <div class="tips-card">
                    <h4><i class="fas fa-clock"></i> Chu kỳ giấc ngủ</h4>
                    <ul>
                        <li>Điều chỉnh thời gian chìm vào giấc ngủ theo thực tế của bạn (5-60 phút)</li>
                        <li>Chu kỳ cá nhân có thể dao động 70-120 phút, quan sát để tìm ra pattern</li>
                        <li>Ưu tiên 5-6 chu kỳ hoàn chỉnh hơn là ngủ lâu nhưng bị cắt giữa chu kỳ</li>
                        <li>Sử dụng tính năng sleep debt để theo dõi nợ giấc ngủ tích tụ</li>
                    </ul>
                </div>
                
                <div class="tips-card">
                    <h4><i class="fas fa-sun"></i> Ngủ trưa</h4>
                    <ul>
                        <li>Nên ngủ trước 15:00 để không ảnh hưởng giấc ngủ đêm</li>
                        <li>Chọn thời lượng phù hợp với mục đích: năng lượng (10-20p), trí nhớ (60p), phục hồi (90p)</li>
                        <li>Người mất ngủ nên tránh ngủ trưa để tích tụ "áp lực ngủ"</li>
                        <li>Kiểm tra điều kiện: đã đủ 30-60 phút sau bữa ăn chưa</li>
                    </ul>
                </div>
                
                <div class="tips-card">
                    <h4><i class="fas fa-chart-line"></i> Đánh giá chất lượng</h4>
                    <ul>
                        <li>Nhập dữ liệu trung thực để có kết quả chính xác</li>
                        <li>Theo dõi xu hướng theo thời gian thay vì ám ảnh con số hàng ngày</li>
                        <li>Sử dụng cả đánh giá khách quan và cảm nhận chủ quan</li>
                        <li>Thực hiện PSQI test định kỳ để có cái nhìn tổng quan</li>
                    </ul>
                </div>
                
                <div class="tips-card">
                    <h4><i class="fas fa-home"></i> Môi trường ngủ</h4>
                    <ul>
                        <li>Đầu tư vào rèm cản sáng chất lượng cao, tối hơn cả mặt nạ ngủ</li>
                        <li>Nhiệt độ 16-19°C là lý tưởng, có thể điều chỉnh theo mùa</li>
                        <li>White noise/pink noise hiệu quả hơn yên tĩnh hoàn toàn</li>
                        <li>Kiểm tra chất lượng không khí, thông gió phòng ngủ</li>
                    </ul>
                </div>
                
                <div class="tips-card">
                    <h4><i class="fas fa-spa"></i> Kỹ thuật thư giãn</h4>
                    <ul>
                        <li>Bắt đầu với 5-10 phút/ngày, tăng dần theo thời gian</li>
                        <li>Thực hành đều đặn quan trọng hơn thực hành lâu</li>
                        <li>Thử nhiều kỹ thuật khác nhau để tìm ra phù hợp nhất</li>
                        <li>Kết hợp với bedtime routine để tạo thành thói quen</li>
                    </ul>
                </div>
                
                <div class="tips-card">
                    <h4><i class="fas fa-bullseye"></i> Chronotype</h4>
                    <ul>
                        <li>Sử dụng kết quả để điều chỉnh lịch làm việc và nghỉ ngơi</li>
                        <li>Chronotype có thể thay đổi theo tuổi tác</li>
                        <li>Không cưỡng lại chronotype tự nhiên, hãy tận dụng nó</li>
                        <li>Tính social jet lag để hiểu mức độ xung đột với lịch trình xã hội</li>
                    </ul>
                </div>
                
                <div class="tips-card">
                    <h4><i class="fas fa-book"></i> Nhật ký giấc ngủ</h4>
                    <ul>
                        <li>Ghi chép ít nhất 14 ngày liên tục để có dữ liệu đáng tin cậy</li>
                        <li>Tìm kiếm các mối tương quan giữa hoạt động ban ngày và giấc ngủ</li>
                        <li>Đặc biệt chú ý đến caffeine, rượu, tập thể dục, stress</li>
                        <li>Xuất dữ liệu để chia sẻ với bác sĩ nếu cần tư vấn</li>
                    </ul>
                </div>
                
                <div class="tips-card">
                    <h4><i class="fas fa-heartbeat"></i> Rối loạn giấc ngủ</h4>
                    <ul>
                        <li>Các test sàng lọc chỉ mang tính tham khảo</li>
                        <li>Nếu có triệu chứng kéo dài >1 tháng, hãy gặp chuyên gia</li>
                        <li>Chuẩn bị nhật ký và danh sách triệu chứng trước khi khám</li>
                        <li>Không tự chẩn đoán, luôn cần xác nhận y khoa</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Warning Box -->
        <div class="warning-box">
            <strong>⚠️ Lưu ý y khoa quan trọng:</strong> 
            Ứng dụng này chỉ mang tính giáo dục và tham khảo. Nếu bạn gặp các triệu chứng: 
            mất ngủ kéo dài >1 tháng, ngáy to kèm ngưng thở, buồn ngủ quá mức ban ngày, 
            chân không yên thường xuyên, hoặc bất kỳ triệu chứng nào ảnh hưởng nghiêm trọng 
            đến cuộc sống, hãy tham khảo ý kiến bác sĩ chuyên khoa Thần kinh, Tâm thần 
            hoặc Trung tâm Y học Giấc ngủ.
        </div>
    </div>

    <!-- Modal for guided exercises -->
    <div id="exerciseModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Bài Tập Thư Giãn</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div id="modalBody"></div>
        </div>
    </div>

    <script>
        // Global variables
        let currentMorningFeeling = 3;
        let currentDayAlertness = 3;
        let currentJournalSleepQuality = 3;
        let currentJournalMorningFeeling = 3;
        let currentJournalStress = 1;
        let currentLastNightQuality = 3;

        // Load journal entries from localStorage
        let journalEntries = [];
        try {
            console.log('🔄 Đang tải dữ liệu nhật ký từ localStorage...');
            const savedEntries = localStorage.getItem('journalEntries');
            console.log('📦 Dữ liệu localStorage lấy được:', savedEntries ? savedEntries.substring(0, 200) + '...' : 'NULL/RỖNG');

            if (savedEntries) {
                journalEntries = JSON.parse(savedEntries);
                console.log('✅ ĐÃ TẢI THÀNH CÔNG:', journalEntries.length, 'entries từ localStorage');
                console.log('📋 Chi tiết entries:', journalEntries);
            } else {
                console.log('⚠️ Không có dữ liệu trong localStorage, khởi tạo mảng rỗng');
            }
        } catch (e) {
            console.error('❌ Lỗi khi tải dữ liệu nhật ký từ localStorage:', e);
            journalEntries = [];
        }

        let currentWeek = 1;
        let completedTasks = 0;
        
        // Rating storage
        let ratings = {
            'morningFeeling': 3,
            'dayAlertness': 3,
            'journalSleepQuality': 3,
            'journalMorningFeeling': 3,
            'journalStress': 1,
            'lastNightQuality': 3,
            'bedComfort': 3
        };

        // MEQ and other test scores
        let meqScores = {
            'meq-q1': 3, 'meq-q2': 3, 'meq-q3': 3, 'meq-q4': 2, 'meq-q5': 2
        };
        
        let isiScores = {
            'isi-q1': 0, 'isi-q2': 0, 'isi-q3': 0, 'isi-q4': 2, 'isi-q5': 0, 'isi-q6': 0, 'isi-q7': 0
        };
        
        let essScores = {
            'ess-q1': 0, 'ess-q2': 0, 'ess-q3': 0, 'ess-q4': 0,
            'ess-q5': 0, 'ess-q6': 0, 'ess-q7': 0, 'ess-q8': 0
        };
        
        let psqiScores = {
            'psqi-duration': 0, 'psqi-latency': 0, 'psqi-pain': 0,
            'psqi-anxiety': 0, 'psqi-noise': 0, 'psqi-overall': 2,
            'psqi-medication': 0
        };

        // Initialize app
        document.addEventListener('DOMContentLoaded', function() {
            // Set current time and date
            const now = new Date();
            document.getElementById('currentTime').value = now.toTimeString().slice(0, 5);
            document.getElementById('journalDate').value = now.toISOString().split('T')[0];
            
            // Calculate initial values
            calculateAdvancedCycles();
            calculateOptimalBedTime();
            calculateSmartNap();
            evaluateAdvancedQuality();
            calculateSleepDebt();
            evaluateEnvironment();
            updateHygieneScore();
            generateRecommendations();
            updateJournalHistory();
            updateJournalStats();
            updateJournalAnalytics();
            updateWeeklyTasks();
            calculateSocialJetLag();
            calculatePSQI();
            
            // Update UI values
            updateLatencyValue();
            updateCycleValue();
            updateTempValue();
            updateMealValue();
            updateSoundInfo();
        });

        // Tab switching with animation
        window.switchTab = function switchTab(tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });

            // Show selected tab with animation
            setTimeout(() => {
                document.getElementById(tabName).classList.add('active');
            }, 100);

            // Update nav buttons
            const navTabs = document.querySelectorAll('.nav-tab');
            navTabs.forEach(tab => tab.classList.remove('active'));
            if (event && event.target) {
                event.target.classList.add('active');
            }
        };

        // Info box toggle
        function toggleInfo(infoId) {
            const infoBox = document.getElementById(infoId);
            infoBox.classList.toggle('show');
        }

        // Accordion toggle
        function toggleAccordion(header) {
            const content = header.nextElementSibling;
            const icon = header.querySelector('span');
            
            content.classList.toggle('show');
            icon.textContent = content.classList.contains('show') ? '▲' : '▼';
        }

        // Value updaters
        function updateLatencyValue() {
            const value = document.getElementById('sleepLatency').value;
            document.getElementById('latencyValue').textContent = value + ' phút';
        }

        function updateCycleValue() {
            const value = document.getElementById('cycleLength').value;
            document.getElementById('cycleValue').textContent = value + ' phút';
        }

        function updateTempValue() {
            const value = document.getElementById('roomTemp').value;
            document.getElementById('tempValue').textContent = value + '°C';
        }

        function updateMealValue() {
            const value = document.getElementById('lastMeal').value;
            document.getElementById('mealValue').textContent = value + ' giờ';
        }

        // Age-based cycle adjustment
        function adjustCycleByAge() {
            const ageGroup = document.getElementById('ageGroup').value;
            const cycleInput = document.getElementById('cycleLength');

            // Người cao tuổi có chu kỳ NGẮN HƠN do giảm deep sleep
            switch(ageGroup) {
                case 'young':
                    cycleInput.value = 90;  // Người trẻ: chu kỳ trung bình
                    break;
                case 'adult':
                    cycleInput.value = 90;  // Người trưởng thành: chu kỳ trung bình
                    break;
                case 'senior':
                    cycleInput.value = 85;  // Người cao tuổi: chu kỳ ngắn hơn
                    break;
            }
            updateCycleValue();
        }

        // Advanced sleep cycle calculation
        function calculateAdvancedCycles() {
            const bedTime = document.getElementById('bedTime').value;
            const sleepLatency = parseInt(document.getElementById('sleepLatency').value);
            const cycleLength = parseInt(document.getElementById('cycleLength').value);
            
            const bedTimeObj = new Date(`2024-01-01T${bedTime}:00`);
            const sleepStart = new Date(bedTimeObj.getTime() + sleepLatency * 60000);
            
            let html = '';
            for (let i = 1; i <= 6; i++) {
                const wakeTime = new Date(sleepStart.getTime() + i * cycleLength * 60000);
                const totalSleep = (i * cycleLength) / 60;
                const isRecommended = i === 5 || i === 6;
                const isOptimal = i === 5;
                
                html += `
                    <div class="cycle-result ${isOptimal ? 'optimal' : isRecommended ? 'recommended' : ''}">
                        <div class="cycle-time">Chu kỳ ${i}: ${wakeTime.toTimeString().slice(0, 5)}</div>
                        <div class="cycle-details">
                            <span>${totalSleep.toFixed(1)}h ngủ</span>
                            ${isOptimal ? '<span class="recommended-badge">⭐ Tối ưu</span>' : 
                              isRecommended ? '<span class="recommended-badge">✓ Khuyến nghị</span>' : ''}
                        </div>
                    </div>
                `;
            }
            
            document.getElementById('cycleResults').innerHTML = html;
            
            // Generate cycle advice
            const advice = generateCycleAdvice(sleepLatency, cycleLength);
            document.getElementById('cycleAdvice').innerHTML = advice;
        }

        function generateCycleAdvice(latency, cycleLength) {
            let advice = '';

            if (latency < 5) {
                advice += '⚠️ Bạn ngủ rất nhanh (<5 phút). Có thể là dấu hiệu thiếu ngủ, hoặc là đặc điểm tự nhiên (sleep efficiency cao). Nếu kèm buồn ngủ ban ngày, cần đánh giá thêm. ';
            } else if (latency > 30) {
                advice += '⏰ Thời gian chìm vào giấc ngủ dài, hãy thử các kỹ thuật thư giãn. ';
            } else {
                advice += '✅ Thời gian chìm vào giấc ngủ trong tầm bình thường. ';
            }

            if (cycleLength < 80) {
                advice += 'Chu kỳ ngắn có thể do tuổi trẻ hoặc stress.';
            } else if (cycleLength > 100) {
                advice += 'Chu kỳ dài có thể do tuổi tác hoặc thuốc men.';
            } else {
                advice += 'Chu kỳ trong tầm trung bình khỏe mạnh.';
            }

            return advice;
        }

        // Calculate optimal bedtime
        function calculateOptimalBedTime() {
            const wakeTime = document.getElementById('targetWakeTime').value;
            const cycles = parseInt(document.getElementById('targetCycles').value);
            const sleepLatency = parseInt(document.getElementById('sleepLatency').value);
            const cycleLength = parseInt(document.getElementById('cycleLength').value);
            
            const wakeTimeObj = new Date(`2024-01-01T${wakeTime}:00`);
            const totalMinutes = cycles * cycleLength + sleepLatency;
            const bedTime = new Date(wakeTimeObj.getTime() - totalMinutes * 60000);
            
            document.getElementById('calculatedBedTime').textContent = bedTime.toTimeString().slice(0, 5);
            document.getElementById('totalSleepTime').textContent = (cycles * cycleLength / 60).toFixed(1) + ' giờ';
        }

        // Sleep debt calculator
        function calculateSleepDebt() {
            const sleepNeed = parseFloat(document.getElementById('sleepNeed').value);
            const actualSleep = parseFloat(document.getElementById('actualSleep').value);
            
            const weeklyDebt = (sleepNeed - actualSleep) * 7;
            const debtPercentage = Math.min(Math.abs(weeklyDebt) / (sleepNeed * 7) * 100, 100);
            
            document.getElementById('debtAmount').textContent = Math.abs(weeklyDebt).toFixed(1) + ' giờ';
            
            const debtFill = document.getElementById('debtFill');
            debtFill.style.width = debtPercentage + '%';
            
            let advice = '';
            let className = '';
            
            if (weeklyDebt <= 0) {
                advice = '✅ Bạn đang ngủ đủ hoặc thậm chí dư! Tiếp tục duy trì thói quen tốt này.';
                className = 'low';
            } else if (weeklyDebt <= 5) {
                advice = '⚠️ Nợ giấc ngủ nhẹ. Có thể bù đắp bằng 1-2 đêm ngủ sớm hơn.';
                className = 'medium';
            } else {
                advice = '🚨 Nợ giấc ngủ nghiêm trọng! Cần kế hoạch phục hồi từng bước, không nên ngủ bù quá nhiều một lúc.';
                className = 'high';
            }
            
            debtFill.className = `debt-fill ${className}`;
            document.getElementById('debtAdvice').innerHTML = advice;
        }

        // Smart nap calculation
        function calculateSmartNap() {
            const currentTime = document.getElementById('currentTime').value;
            const napGoal = document.getElementById('napGoal').value;
            const lastMeal = parseFloat(document.getElementById('lastMeal').value);
            const lastNightQuality = currentLastNightQuality;
            const hasInsomnia = document.getElementById('hasInsomnia').checked;
            
            // Nap type recommendations based on goal and conditions
            let recommendedNap = {};
            
            if (hasInsomnia) {
                recommendedNap = {
                    type: 'avoid',
                    duration: 0,
                    benefit: 'Người mất ngủ nên tránh ngủ trưa',
                    warning: 'Ngủ trưa sẽ giảm áp lực ngủ cho đêm'
                };
            } else {
                switch(napGoal) {
                    case 'energy':
                        recommendedNap = {
                            type: 'power',
                            duration: lastNightQuality >= 4 ? 15 : 20,
                            benefit: 'Tăng cường năng lượng và tỉnh táo tức thì',
                            warning: 'Không gây quán tính giấc ngủ'
                        };
                        break;
                    case 'memory':
                        recommendedNap = {
                            type: 'memory',
                            duration: 60,
                            benefit: 'Củng cố trí nhớ và cải thiện khả năng học',
                            warning: 'Có thể gây lờ đờ 15-30 phút sau khi thức'
                        };
                        break;
                    case 'creativity':
                        recommendedNap = {
                            type: 'rem',
                            duration: 90,
                            benefit: 'Kích thích sáng tạo và giải quyết vấn đề',
                            warning: 'Cần thời gian để hoàn toàn tỉnh táo'
                        };
                        break;
                    case 'recovery':
                        recommendedNap = {
                            type: 'recovery',
                            duration: lastNightQuality <= 2 ? 90 : 60,
                            benefit: 'Phục hồi toàn diện sau đêm ngủ kém',
                            warning: 'Chỉ nên thực hiện khi thực sự cần thiết'
                        };
                        break;
                }
            }
            
            const current = new Date(`2024-01-01T${currentTime}:00`);
            const napStart = new Date(current.getTime() + lastMeal * 60 * 60000);
            const napEnd = new Date(napStart.getTime() + recommendedNap.duration * 60000);
            
            const currentHour = parseInt(currentTime.split(':')[0]);
            const isOptimalTime = currentHour >= 12 && currentHour <= 15;
            const isLateTime = currentHour > 15;
            
            let planClass = 'nap-plan';
            if (hasInsomnia || isLateTime) {
                planClass += ' warning';
            } else if (isOptimalTime) {
                planClass += ' optimal';
            }
            
            let html = `<div class="${planClass}">`;
            
            if (recommendedNap.type === 'avoid') {
                html += `
                    <h4 style="color: #dc2626; margin-bottom: 15px;"><i class="fas fa-times-circle"></i> Không khuyến nghị ngủ trưa</h4>
                    <p style="color: #991b1b; font-size: 1.1rem; line-height: 1.6;">
                        Với tình trạng mất ngủ hiện tại, việc ngủ trưa sẽ làm giảm "áp lực ngủ" 
                        cần thiết cho giấc ngủ đêm. Hãy tập trung vào việc cải thiện giấc ngủ chính.
                    </p>
                `;
            } else {
                html += `
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="font-weight: 600;">Thời gian ngủ được khuyến nghị:</span>
                        <span class="nap-time">${napStart.toTimeString().slice(0, 5)}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="font-weight: 600;">Thời gian thức dậy:</span>
                        <span class="nap-time">${napEnd.toTimeString().slice(0, 5)}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="font-weight: 600;">Thời lượng:</span>
                        <span class="nap-time">${recommendedNap.duration} phút</span>
                    </div>
                `;
            }
            
            html += '</div>';
            
            if (recommendedNap.type !== 'avoid') {
                html += `
                    <div class="nap-benefit">
                        <h4 style="color: #1e40af; margin-bottom: 8px;">✨ Lợi Ích:</h4>
                        <p style="color: #1d4ed8; font-size: 0.95rem;">${recommendedNap.benefit}</p>
                    </div>
                    
                    <div class="nap-warning">
                        <h4 style="color: #92400e; margin-bottom: 8px;">⚠️ Lưu Ý:</h4>
                        <p style="color: #b45309; font-size: 0.95rem;">${recommendedNap.warning}</p>
                    </div>
                `;
            }
            
            if (isLateTime && !hasInsomnia) {
                html += `
                    <div style="background: #fef3c7; border: 2px solid #f59e0b; border-radius: 8px; padding: 12px; margin-top: 15px;">
                        <div style="display: flex; align-items: center; color: #92400e;">
                            <span style="margin-right: 8px;">⏰</span>
                            <p style="font-size: 0.9rem; margin: 0;">Đã qua 15:00 - ngủ trưa bây giờ có thể ảnh hưởng đến giấc ngủ đêm</p>
                        </div>
                    </div>
                `;
            }
            
            document.getElementById('smartNapPlan').innerHTML = html;
        }

        // Environment evaluation
        function evaluateEnvironment() {
            const temp = parseInt(document.getElementById('roomTemp').value);
            const light = document.getElementById('lightLevel').value;
            const noise = document.getElementById('noiseLevel').value;
            const comfort = ratings.bedComfort || 3;
            const screenTime = document.getElementById('screenTime').value;
            
            let score = 0;
            let recommendations = [];
            
            // Temperature scoring
            if (temp >= 16 && temp <= 19) {
                score += 25;
            } else if (temp >= 15 && temp <= 22) {
                score += 15;
                recommendations.push({
                    category: 'Nhiệt độ',
                    advice: temp < 16 ? 'Phòng hơi lạnh, hãy tăng nhiệt độ lên 16-19°C' : 'Phòng hơi nóng, hãy giảm nhiệt độ xuống 16-19°C'
                });
            } else {
                score += 5;
                recommendations.push({
                    category: 'Nhiệt độ',
                    advice: 'Nhiệt độ không lý tưởng. Điều chỉnh về khoảng 16-19°C cho giấc ngủ tối ưu'
                });
            }
            
            // Light scoring
            const lightScores = { dark: 25, dim: 15, moderate: 5, bright: 0 };
            score += lightScores[light];
            if (light !== 'dark') {
                recommendations.push({
                    category: 'Ánh sáng',
                    advice: 'Phòng ngủ nên hoàn toàn tối. Sử dụng rèm cản sáng hoặc mặt nạ ngủ'
                });
            }
            
            // Noise scoring
            const noiseScores = { silent: 25, quiet: 20, moderate: 10, noisy: 0 };
            score += noiseScores[noise];
            if (noise === 'noisy' || noise === 'moderate') {
                recommendations.push({
                    category: 'Tiếng ồn',
                    advice: 'Sử dụng nút bịt tai hoặc máy tạo white noise để che tiếng ồn'
                });
            }
            
            // Comfort scoring
            score += comfort * 5;
            if (comfort < 4) {
                recommendations.push({
                    category: 'Thoải mái',
                    advice: 'Cân nhắc thay đổi nệm/gối để có độ thoải mái tối ưu'
                });
            }
            
            // Screen time scoring
            const screenScores = { none: 25, minimal: 15, moderate: 5, excessive: 0 };
            score += screenScores[screenTime];
            if (screenTime !== 'none') {
                recommendations.push({
                    category: 'Ánh sáng xanh',
                    advice: 'Tránh màn hình điện tử ít nhất 1 giờ trước ngủ hoặc sử dụng kính lọc ánh sáng xanh'
                });
            }
            
            const scoreClass = score >= 80 ? 'excellent' : score >= 60 ? 'good' : 'poor';
            const scoreLabel = score >= 80 ? 'Tuyệt vời' : score >= 60 ? 'Ổn' : 'Cần cải thiện';

            // Create doughnut chart for environment score
            const container = document.getElementById('environmentScore');
            const canvas = document.getElementById('environmentChart');
            if (canvas && container) {
                // Clear previous content
                container.innerHTML = '<canvas id="environmentChart"></canvas>';
                const newCanvas = document.getElementById('environmentChart');

                // Destroy existing chart if any
                if (window.environmentChartInstance) {
                    window.environmentChartInstance.destroy();
                }

                const chartColor = score >= 80 ? '#10b981' : score >= 60 ? '#f59e0b' : '#ef4444';

                window.environmentChartInstance = new Chart(newCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['Điểm đạt được', 'Còn thiếu'],
                        datasets: [{
                            data: [score, 100 - score],
                            backgroundColor: [chartColor, '#e5e7eb'],
                            borderWidth: 0,
                            circumference: 180,
                            rotation: 270
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        cutout: '75%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.label + ': ' + context.parsed + '%';
                                    }
                                }
                            }
                        }
                    },
                    plugins: [{
                        id: 'centerText',
                        beforeDraw: function(chart) {
                            const width = chart.width;
                            const height = chart.height;
                            const ctx = chart.ctx;
                            ctx.restore();

                            ctx.font = 'bold 2.5rem Arial';
                            ctx.fillStyle = chartColor;
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            const centerX = width / 2;
                            const centerY = height / 2 + 20;
                            ctx.fillText(score, centerX, centerY);

                            ctx.font = '1rem Arial';
                            ctx.fillStyle = '#6b7280';
                            ctx.fillText(scoreLabel, centerX, centerY + 35);

                            ctx.save();
                        }
                    }]
                });
            }
            
            // Display recommendations
            let recHtml = '';
            if (recommendations.length > 0) {
                recHtml = '<h4 style="color: #1e293b; margin-bottom: 12px;"><i class="fas fa-wrench"></i> Khuyến nghị cải thiện:</h4>';
                recommendations.forEach(rec => {
                    recHtml += `
                        <div style="margin-bottom: 10px; padding: 10px; background: #f8fafc; border-radius: 8px; border-left: 4px solid #667eea;">
                            <strong>${rec.category}:</strong> ${rec.advice}
                        </div>
                    `;
                });
            } else {
                recHtml = '<p style="color: #059669; font-weight: 600;">✅ Môi trường ngủ của bạn đã rất tốt!</p>';
            }
            
            document.getElementById('environmentRecommendations').innerHTML = recHtml;
        }

        // Update hygiene score
        function updateHygieneScore() {
            const checkboxes = document.querySelectorAll('#sleep-environment input[type="checkbox"]');
            let completed = 0;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) completed++;
            });

            const total = checkboxes.length;
            const percentage = Math.round((completed / total) * 100);

            // Create doughnut chart for hygiene score
            const container = document.getElementById('hygieneScore');
            const canvas = document.getElementById('hygieneChart');
            if (canvas && container) {
                // Clear previous content
                container.innerHTML = '<canvas id="hygieneChart"></canvas>';
                const newCanvas = document.getElementById('hygieneChart');

                // Destroy existing chart if any
                if (window.hygieneChartInstance) {
                    window.hygieneChartInstance.destroy();
                }

                const chartColor = percentage >= 80 ? '#10b981' : percentage >= 60 ? '#f59e0b' : '#ef4444';

                window.hygieneChartInstance = new Chart(newCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['Hoàn thành', 'Chưa hoàn thành'],
                        datasets: [{
                            data: [completed, total - completed],
                            backgroundColor: [chartColor, '#e5e7eb'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.label + ': ' + context.parsed + ' tiêu chí';
                                    }
                                }
                            }
                        }
                    },
                    plugins: [{
                        id: 'centerText',
                        beforeDraw: function(chart) {
                            const width = chart.width;
                            const height = chart.height;
                            const ctx = chart.ctx;
                            ctx.restore();

                            ctx.font = 'bold 2.5rem Arial';
                            ctx.fillStyle = chartColor;
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            const centerX = width / 2;
                            const centerY = height / 2 - 10;
                            ctx.fillText(percentage + '%', centerX, centerY);

                            ctx.font = '0.9rem Arial';
                            ctx.fillStyle = '#6b7280';
                            ctx.fillText(completed + '/' + total + ' tiêu chí', centerX, centerY + 30);

                            ctx.save();
                        }
                    }]
                });
            }
        }

        // Add event listeners for hygiene checkboxes
        document.addEventListener('change', function(e) {
            if (e.target.type === 'checkbox' && e.target.closest('#sleep-environment')) {
                updateHygieneScore();
            }
        });

        // Rating system
        function setRating(groupId, value) {
            const group = document.getElementById(groupId);
            if (!group) return;

            const buttons = group.querySelectorAll('.rating-btn');

            buttons.forEach((btn, index) => {
                btn.classList.remove('active');
            });

            // Find and activate the correct button
            buttons.forEach(btn => {
                if (btn.onclick && btn.onclick.toString().includes(`'${groupId}', ${value}`)) {
                    btn.classList.add('active');
                }
            });

            // Update global variables
            if (groupId.startsWith('psqi-')) {
                psqiScores[groupId] = value;
            } else {
                ratings[groupId] = value;
            }

            // Trigger relevant calculations
            if (groupId === 'morningFeeling' || groupId === 'dayAlertness') {
                evaluateAdvancedQuality();
            }
            if (groupId === 'lastNightQuality') {
                currentLastNightQuality = value;
                calculateSmartNap();
            }
            if (groupId === 'bedComfort') {
                evaluateEnvironment();
            }
        }

        // MEQ rating system
        function setMEQRating(questionId, value) {
            const group = document.getElementById(questionId);
            const buttons = group.querySelectorAll('.rating-btn');
            
            buttons.forEach(btn => btn.classList.remove('active'));
            buttons[Array.from(buttons).findIndex(btn => btn.onclick.toString().includes(value))].classList.add('active');
            
            meqScores[questionId] = value;
        }

        // Advanced quality evaluation
        function evaluateAdvancedQuality() {
            const sleepLatency = parseInt(document.getElementById('qualitySleepLatency').value);
            const nightWakings = parseInt(document.getElementById('qualityNightWakings').value);
            const wakeTime = parseInt(document.getElementById('qualityWakeTime').value);
            const bedTime = parseFloat(document.getElementById('qualityBedTime').value);
            const actualSleep = parseFloat(document.getElementById('qualityActualSleep').value);
            const morningFeeling = ratings.morningFeeling || 3;
            const dayAlertness = ratings.dayAlertness || 3;
            const caffeineNeed = parseInt(document.getElementById('caffeineNeed').value);
            
            let score = 0;
            const factors = [];
            
            // Sleep latency (30 points)
            if (sleepLatency <= 15) {
                score += 30;
                factors.push({ factor: 'Độ trễ giấc ngủ', status: 'good', note: `Tuyệt vời (${sleepLatency} phút)` });
            } else if (sleepLatency <= 30) {
                score += 20;
                factors.push({ factor: 'Độ trễ giấc ngủ', status: 'fair', note: `Ổn (${sleepLatency} phút)` });
            } else {
                score += 5;
                factors.push({ factor: 'Độ trễ giấc ngủ', status: 'poor', note: `Cần cải thiện (${sleepLatency} phút)` });
            }
            
            // Night wakings (20 points)
            if (nightWakings <= 1) {
                score += 20;
                factors.push({ factor: 'Số lần thức giấc', status: 'good', note: `Tốt (${nightWakings} lần)` });
            } else if (nightWakings <= 2) {
                score += 12;
                factors.push({ factor: 'Số lần thức giấc', status: 'fair', note: `Ổn (${nightWakings} lần)` });
            } else {
                score += 3;
                factors.push({ factor: 'Số lần thức giấc', status: 'poor', note: `Nhiều (${nightWakings} lần)` });
            }
            
            // Wake time after sleep onset (15 points)
            if (wakeTime <= 20) {
                score += 15;
                factors.push({ factor: 'Thời gian thức giữa đêm', status: 'good', note: `Tốt (${wakeTime} phút)` });
            } else if (wakeTime <= 45) {
                score += 8;
                factors.push({ factor: 'Thời gian thức giữa đêm', status: 'fair', note: `Ổn (${wakeTime} phút)` });
            } else {
                score += 2;
                factors.push({ factor: 'Thời gian thức giữa đêm', status: 'poor', note: `Nhiều (${wakeTime} phút)` });
            }
            
            // Sleep efficiency (20 points)
            const efficiency = (actualSleep / bedTime) * 100;
            if (efficiency >= 90) {
                score += 20;
                factors.push({ factor: 'Hiệu suất giấc ngủ', status: 'good', note: `Xuất sắc (${efficiency.toFixed(1)}%)` });
            } else if (efficiency >= 85) {
                score += 15;
                factors.push({ factor: 'Hiệu suất giấc ngủ', status: 'good', note: `Tốt (${efficiency.toFixed(1)}%)` });
            } else if (efficiency >= 75) {
                score += 8;
                factors.push({ factor: 'Hiệu suất giấc ngủ', status: 'fair', note: `Ổn (${efficiency.toFixed(1)}%)` });
            } else {
                score += 2;
                factors.push({ factor: 'Hiệu suất giấc ngủ', status: 'poor', note: `Thấp (${efficiency.toFixed(1)}%)` });
            }
            
            // Subjective quality (10 points)
            score += morningFeeling * 2;
            factors.push({ 
                factor: 'Cảm giác buổi sáng', 
                status: morningFeeling >= 4 ? 'good' : morningFeeling >= 3 ? 'fair' : 'poor', 
                note: `${morningFeeling}/5` 
            });
            
            // Daytime alertness (5 points)
            score += dayAlertness;
            factors.push({ 
                factor: 'Tỉnh táo ban ngày', 
                status: dayAlertness >= 4 ? 'good' : dayAlertness >= 3 ? 'fair' : 'poor', 
                note: `${dayAlertness}/5` 
            });
            
            // Caffeine dependency (subtract points)
            score -= caffeineNeed * 3;
            if (caffeineNeed > 0) {
                factors.push({ 
                    factor: 'Phụ thuộc caffeine', 
                    status: caffeineNeed >= 3 ? 'poor' : 'fair', 
                    note: caffeineNeed >= 3 ? 'Cao' : 'Vừa phải' 
                });
            }
            
            score = Math.max(0, Math.min(100, score));

            const scoreClass = score >= 80 ? 'excellent' : score >= 60 ? 'good' : 'poor';
            const scoreLabel = score >= 80 ? 'Tuyệt vời' : score >= 60 ? 'Ổn' : 'Cần cải thiện';

            // Create radar chart for quality assessment
            const container = document.getElementById('qualityResultAdvanced');
            const canvas = document.getElementById('qualityChart');
            if (canvas && container) {
                // Clear previous content
                container.innerHTML = '<canvas id="qualityChart"></canvas>';
                const newCanvas = document.getElementById('qualityChart');

                // Destroy existing chart if any
                if (window.qualityChartInstance) {
                    window.qualityChartInstance.destroy();
                }

                // Prepare data for radar chart (convert to percentages)
                const chartData = {
                    latency: sleepLatency <= 15 ? 100 : sleepLatency <= 30 ? 67 : 17,
                    wakings: nightWakings <= 1 ? 100 : nightWakings <= 2 ? 60 : 15,
                    wakeTime: wakeTime <= 20 ? 100 : wakeTime <= 45 ? 53 : 13,
                    efficiency: efficiency >= 90 ? 100 : efficiency >= 85 ? 75 : efficiency >= 75 ? 40 : 10,
                    morningFeeling: (morningFeeling / 5) * 100,
                    dayAlertness: (dayAlertness / 5) * 100,
                    caffeine: caffeineNeed === 0 ? 100 : caffeineNeed === 1 ? 67 : caffeineNeed === 2 ? 33 : 0
                };

                window.qualityChartInstance = new Chart(newCanvas, {
                    type: 'radar',
                    data: {
                        labels: ['Độ trễ ngủ', 'Số lần thức', 'Thời gian thức', 'Hiệu suất ngủ', 'Cảm giác sáng', 'Tỉnh táo ngày', 'Không caffeine'],
                        datasets: [{
                            label: 'Chất lượng giấc ngủ',
                            data: [chartData.latency, chartData.wakings, chartData.wakeTime, chartData.efficiency, chartData.morningFeeling, chartData.dayAlertness, chartData.caffeine],
                            fill: true,
                            backgroundColor: 'rgba(102, 126, 234, 0.2)',
                            borderColor: 'rgba(102, 126, 234, 1)',
                            pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgba(102, 126, 234, 1)',
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            r: {
                                angleLines: {
                                    color: 'rgba(0, 0, 0, 0.1)'
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)'
                                },
                                pointLabels: {
                                    font: {
                                        size: 13,
                                        weight: '600'
                                    },
                                    color: '#1e293b',
                                    padding: 10
                                },
                                ticks: {
                                    display: false,
                                    stepSize: 20
                                },
                                suggestedMin: 0,
                                suggestedMax: 100
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.r.toFixed(0) + '%';
                                    }
                                }
                            }
                        }
                    }
                });

                // Add score badge below chart
                container.insertAdjacentHTML('beforeend', `
                    <div style="text-align: center; margin-top: 25px;">
                        <div style="display: inline-flex; align-items: center; gap: 15px; padding: 15px 30px; background: linear-gradient(135deg, ${score >= 80 ? '#ecfdf5, #d1fae5' : score >= 60 ? '#fef3c7, #fde68a' : '#fee2e2, #fecaca'}); border-radius: 50px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                            <div style="font-size: 2.5rem; font-weight: 700; color: ${score >= 80 ? '#059669' : score >= 60 ? '#d97706' : '#dc2626'};">${score}</div>
                            <div style="text-align: left;">
                                <div style="font-size: 0.85rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Điểm chất lượng</div>
                                <div style="font-size: 1.2rem; font-weight: 600; color: #1e293b;">${scoreLabel}</div>
                            </div>
                        </div>
                    </div>
                `);
            }
            
            // Display factors
            let factorsHtml = '<h4 style="color: #1e293b; margin-bottom: 12px;"><i class="fas fa-chart-line"></i> Phân tích chi tiết:</h4>';
            factors.forEach(factor => {
                factorsHtml += `
                    <div class="factor-item ${factor.status}">
                        <span style="font-weight: 500;">${factor.factor}</span>
                        <div class="factor-status">
                            <div class="status-dot ${factor.status}"></div>
                            <span style="font-size: 0.9rem;">${factor.note}</span>
                        </div>
                    </div>
                `;
            });
            
            document.getElementById('qualityFactors').innerHTML = factorsHtml;
            
            // Generate recommendations
            generateRecommendations();
        }

        // Generate recommendations
        function generateRecommendations() {
            const sleepLatency = parseInt(document.getElementById('qualitySleepLatency')?.value || 20);
            const nightWakings = parseInt(document.getElementById('qualityNightWakings')?.value || 1);
            const bedTime = parseFloat(document.getElementById('qualityBedTime')?.value || 8);
            const actualSleep = parseFloat(document.getElementById('qualityActualSleep')?.value || 7.5);
            const efficiency = (actualSleep / bedTime) * 100;
            const morningFeeling = ratings.morningFeeling || 3;
            
            const recommendations = [];
            
            if (sleepLatency > 30) {
                recommendations.push({
                    category: 'Thư giãn',
                    title: 'Cải thiện thời gian chìm vào giấc ngủ',
                    priority: 'high',
                    suggestions: [
                        'Thực hành kỹ thuật thở 4-7-8 mỗi tối trước khi ngủ',
                        'Tạo thói quen thư giãn cố định 30-60 phút trước ngủ',
                        'Tránh hoàn toàn màn hình điện tử 1-2 giờ trước ngủ',
                        'Kiểm tra lại việc tiêu thụ caffeine - ngừng sau 14:00',
                        'Thử progressive muscle relaxation để giải tỏa căng thẳng',
                        'Viết nhật ký lo lắng để "đặt xuống" suy nghĩ trước khi ngủ'
                    ]
                });
            }
            
            if (nightWakings > 2) {
                recommendations.push({
                    category: 'Môi trường',
                    title: 'Giảm số lần thức giấc trong đêm',
                    priority: 'high',
                    suggestions: [
                        'Kiểm tra và điều chỉnh nhiệt độ phòng xuống 16-19°C',
                        'Sử dụng rèm cản sáng hoặc mặt nạ ngủ để loại bỏ hoàn toàn ánh sáng',
                        'Đầu tư vào nút bịt tai chất lượng hoặc máy tạo white noise',
                        'Hạn chế uống nước 2-3 giờ trước ngủ để giảm đi vệ sinh đêm',
                        'Kiểm tra độ thoải mái của nệm - có thể cần thay mới',
                        'Đánh giá khả năng bị sleep apnea nếu ngáy to'
                    ]
                });
            }
            
            if (efficiency < 85) {
                recommendations.push({
                    category: 'Lịch trình',
                    title: 'Cải thiện hiệu suất giấc ngủ',
                    priority: 'medium',
                    suggestions: [
                        'Áp dụng nguyên tắc "chỉ sử dụng giường để ngủ và sex"',
                        'Nếu không ngủ được sau 20 phút, hãy rời giường và làm hoạt động yên tĩnh',
                        'Duy trì lịch ngủ-thức cố định 7 ngày/tuần',
                        'Cân nhắc sleep restriction therapy - giảm thời gian trên giường',
                        'Tránh ngủ trưa nếu đang bị mất ngủ mãn tính',
                        'Tăng cường tiếp xúc ánh sáng mặt trời buổi sáng'
                    ]
                });
            }
            
            if (morningFeeling < 3) {
                recommendations.push({
                    category: 'Chronotype',
                    title: 'Tối ưu theo nhịp sinh học cá nhân',
                    priority: 'medium',
                    suggestions: [
                        'Thực hiện bài test MEQ để xác định chronotype chính xác',
                        'Điều chỉnh lịch trình theo xu hướng tự nhiên của cơ thể',
                        'Sử dụng đèn bright light therapy vào buổi sáng (10,000 lux)',
                        'Tránh báo thức đánh thức trong giấc ngủ sâu bằng cách tính toán chu kỳ',
                        'Cân nhắc dùng đèn mô phỏng bình minh nếu phải dậy sớm',
                        'Đánh giá khả năng bị social jet lag'
                    ]
                });
            }
            
            // Add general recommendations
            recommendations.push({
                category: 'Tổng quát',
                title: 'Nguyên tắc vàng vệ sinh giấc ngủ',
                priority: 'low',
                suggestions: [
                    'Duy trì lịch ngủ-thức nhất quán cả cuối tuần',
                    'Tạo môi trường ngủ tối-yên-mát-thoải mái',
                    'Hạn chế caffeine sau 14:00 và rượu bia trước ngủ 3h',
                    'Tập thể dục đều đặn nhưng không gần giờ ngủ',
                    'Tiếp xúc ánh sáng tự nhiên vào buổi sáng',
                    'Tạo thói quen thư giãn trước khi ngủ'
                ]
            });
            
            let html = '';
            recommendations.forEach((rec, index) => {
                const priorityColor = rec.priority === 'high' ? '#dc2626' : rec.priority === 'medium' ? '#f59e0b' : '#10b981';
                const priorityLabel = rec.priority === 'high' ? 'Ưu tiên cao' : rec.priority === 'medium' ? 'Ưu tiên trung bình' : 'Duy trì';
                
                html += `
                    <div class="recommendation-card">
                        <div class="recommendation-header">
                            <span class="category-badge" style="background: ${priorityColor};">${rec.category}</span>
                            <h3 style="color: #1f2937; margin: 0; flex: 1;">${rec.title}</h3>
                            <small style="color: ${priorityColor}; font-weight: 600;">${priorityLabel}</small>
                        </div>
                        <ul class="recommendation-list">
                `;
                
                rec.suggestions.forEach(suggestion => {
                    html += `<li>${suggestion}</li>`;
                });
                
                html += `
                        </ul>
                    </div>
                `;
            });
            
            document.getElementById('recommendationsList').innerHTML = html;
        }

        // Sound information update
        function updateSoundInfo() {
            const soundType = document.getElementById('soundType').value;
            const info = {
                'nature': {
                    title: 'Âm thanh thiên nhiên',
                    description: 'Mưa nhẹ, sóng biển, rừng đêm tạo ra "1/f noise" tự nhiên giúp che tiếng ồn và thúc đẩy giấc ngủ sâu.',
                    benefits: ['Giảm cortisol', 'Che tiếng ồn đột ngột', 'Kích hoạt hệ phó giao cảm'],
                    volume: '30-40 dB'
                },
                'binaural': {
                    title: 'Binaural Beats',
                    description: 'Tần số khác nhau ở mỗi tai tạo ra "beat" ảo, có thể influence sóng não.',
                    benefits: ['Delta (0.5-4Hz): Giấc ngủ sâu', 'Theta (4-8Hz): Ru ngủ', 'Alpha (8-13Hz): Thư giãn'],
                    volume: 'Nhỏ, cần tai nghe stereo'
                },
                'white-noise': {
                    title: 'White/Pink/Brown Noise',
                    description: 'Âm thanh có tần số đều khắp dải nghe, che các tiếng ồn gây xao nhãng.',
                    benefits: ['White: Che tiếng ồn tốt nhất', 'Pink: Tự nhiên hơn', 'Brown: Sâu, thích hợp ngủ'],
                    volume: '40-50 dB'
                },
                'classical': {
                    title: 'Nhạc cổ điển',
                    description: 'Tempo chậm 60-80 BPM, không có lời, giúp giảm stress và anxiety.',
                    benefits: ['Giảm nhịp tim', 'Thúc đẩy thư giãn', 'Cải thiện chất lượng giấc ngủ'],
                    volume: 'Nhỏ, tránh crescendo đột ngột'
                },
                'ambient': {
                    title: 'Ambient Music',
                    description: 'Nhạc điện tử minimalist, drone, soundscape được thiết kế để thư giãn.',
                    benefits: ['Không có melody gây phân tâm', 'Âm thanh liên tục', 'Tạo không gian âm thanh'],
                    volume: 'Rất nhỏ, như background'
                }
            };
            
            const selectedInfo = info[soundType];
            const html = `
                <div style="background: #f0f9ff; padding: 16px; border-radius: 12px; border-left: 4px solid #0ea5e9;">
                    <h4 style="color: #0c4a6e; margin-bottom: 8px;">${selectedInfo.title}</h4>
                    <p style="color: #075985; margin-bottom: 12px; line-height: 1.5;">${selectedInfo.description}</p>
                    <div style="margin-bottom: 10px;">
                        <strong style="color: #0c4a6e;">Lợi ích:</strong>
                        <ul style="margin: 5px 0 0 20px; color: #075985;">
                            ${selectedInfo.benefits.map(benefit => `<li>${benefit}</li>`).join('')}
                        </ul>
                    </div>
                    <p style="color: #0369a1; font-size: 0.9rem;"><strong>Âm lượng:</strong> ${selectedInfo.volume}</p>
                </div>
            `;
            
            document.getElementById('soundInfo').innerHTML = html;
        }

        // Breathing exercises
        function start478Breathing() {
            const modal = document.getElementById('exerciseModal');
            const title = document.getElementById('modalTitle');
            const body = document.getElementById('modalBody');
            
            title.textContent = 'Kỹ thuật thở 4-7-8';
            body.innerHTML = `
                <div class="breathing-guide">
                    <div class="breathing-circle" id="breathingCircle">
                        <span id="breathingInstruction">Chuẩn bị</span>
                    </div>
                    <div style="text-align: center; margin-top: 20px;">
                        <button class="btn btn-primary" onclick="startBreathingCycle()">▶️ Bắt Đầu</button>
                        <button class="btn btn-warning" onclick="stopBreathing()">⏹️ Dừng</button>
                    </div>
                    <div style="margin-top: 20px; color: #4b5563; font-size: 0.9rem; line-height: 1.6;">
                        <p><strong>Hướng dẫn:</strong></p>
                        <ol>
                            <li>Thở ra hoàn toàn qua miệng</li>
                            <li>Hít vào qua mũi đếm 4</li>
                            <li>Nín thở đếm 7</li>
                            <li>Thở ra qua miệng đếm 8</li>
                            <li>Lặp lại 4 chu kỳ</li>
                        </ol>
                    </div>
                </div>
            `;
            
            modal.classList.add('show');
        }

        let breathingInterval;
        let breathingCycle = 0;
        
        function startBreathingCycle() {
            const circle = document.getElementById('breathingCircle');
            const instruction = document.getElementById('breathingInstruction');
            let phase = 0; // 0: inhale, 1: hold, 2: exhale, 3: hold
            let count = 0;
            const phases = [
                { name: 'Hít vào', duration: 4, class: 'inhale' },
                { name: 'Nín thở', duration: 7, class: 'hold' },
                { name: 'Thở ra', duration: 8, class: 'exhale' },
                { name: 'Nghỉ', duration: 2, class: '' }
            ];
            
            breathingInterval = setInterval(() => {
                const currentPhase = phases[phase];
                instruction.textContent = `${currentPhase.name} - ${currentPhase.duration - count}`;
                circle.className = `breathing-circle ${currentPhase.class}`;
                
                count++;
                
                if (count >= currentPhase.duration) {
                    count = 0;
                    phase = (phase + 1) % phases.length;
                    
                    if (phase === 0) {
                        breathingCycle++;
                        if (breathingCycle >= 4) {
                            stopBreathing();
                            instruction.textContent = 'Hoàn thành!';
                            return;
                        }
                    }
                }
            }, 1000);
        }
        
        function stopBreathing() {
            if (breathingInterval) {
                clearInterval(breathingInterval);
            }
            breathingCycle = 0;
            const circle = document.getElementById('breathingCircle');
            const instruction = document.getElementById('breathingInstruction');
            circle.className = 'breathing-circle';
            instruction.textContent = 'Sẵn sàng bắt đầu';
        }

        function startBoxBreathing() {
            // Similar implementation for box breathing
            start478Breathing(); // Reuse modal for now
        }

        function startPMRGuide() {
            const modal = document.getElementById('exerciseModal');
            const title = document.getElementById('modalTitle');
            const body = document.getElementById('modalBody');
            
            title.textContent = 'Progressive Muscle Relaxation';
            body.innerHTML = `
                <div style="text-align: center;">
                    <p style="color: #4b5563; margin-bottom: 20px;">Hướng dẫn thư giãn cơ từng bước trong 15 phút</p>
                    <div id="pmrInstruction" style="font-size: 1.2rem; font-weight: 600; color: #1e293b; margin: 20px 0;">
                        Chuẩn bị tư thế nằm thoải mái
                    </div>
                    <button class="btn btn-success" onclick="startPMR()">🧘 Bắt Đầu PMR</button>
                </div>
            `;
            
            modal.classList.add('show');
        }

        function startBodyScan() {
            const modal = document.getElementById('exerciseModal');
            const title = document.getElementById('modalTitle');
            const body = document.getElementById('modalBody');

            // ============================================
            // 🎵 BODY SCAN AUDIO URL - THAY THẾ Ở ĐÂY
            // ============================================
            const bodyScanAudioUrl = 'https://example.com/body-scan-meditation-10min.mp3'; // ← THAY URL mp3 Body Scan vào đây
            // ============================================

            const isPlaceholder = bodyScanAudioUrl.includes('example.com');

            title.textContent = 'Body Scan Meditation';
            body.innerHTML = `
                <div style="text-align: center;">
                    <p style="color: #4b5563; margin-bottom: 20px;">Thiền quét cơ thể trong 10 phút - Tập trung vào từng phần cơ thể từ đầu đến chân</p>

                    ${isPlaceholder ? `
                        <div style="background: #fef3c7; border: 2px solid #f59e0b; border-radius: 12px; padding: 20px; margin: 20px 0;">
                            <p style="color: #92400e; margin-bottom: 10px;"><strong>⚠️ Chưa có audio hướng dẫn</strong></p>
                            <p style="color: #b45309; font-size: 0.9rem; line-height: 1.6;">
                                Để thêm audio:<br>
                                1. Mở file biolink-style331.php<br>
                                2. Tìm function startBodyScan() (dòng ~4849)<br>
                                3. Thay URL trong bodyScanAudioUrl<br>
                                4. Lưu file và refresh lại trang
                            </p>
                        </div>
                        <div style="text-align: left; max-width: 500px; margin: 20px auto; padding: 20px; background: #f8fafc; border-radius: 12px;">
                            <h4 style="color: #1e293b; margin-bottom: 15px;">📝 Hướng dẫn tạm (không có audio):</h4>
                            <ol style="color: #475569; line-height: 1.8;">
                                <li>Nằm thoải mái, nhắm mắt nhẹ</li>
                                <li>Tập trung vào đầu, cảm nhận căng thẳng</li>
                                <li>Từ từ di chuyển xuống vai, cánh tay</li>
                                <li>Quét qua ngực, bụng, lưng</li>
                                <li>Đến hông, đùi, bắp chân, bàn chân</li>
                                <li>Thả lỏng từng vùng cơ thể</li>
                            </ol>
                        </div>
                    ` : `
                        <audio controls style="width: 100%; max-width: 500px; margin: 20px auto;">
                            <source src="${bodyScanAudioUrl}" type="audio/mpeg">
                            Trình duyệt của bạn không hỗ trợ phát audio.
                        </audio>
                        <p style="font-size: 0.85rem; color: #6b7280; margin-top: 15px;">
                            💡 Tip: Nằm ngửa, tay để hai bên, lòng bàn tay ngửa lên, chân hơi dang ra
                        </p>
                    `}
                </div>
            `;

            modal.classList.add('show');
        }

        function startBodyScanGuide() {
            // This function is called when user has audio
            // Just plays the audio from startBodyScan
            alert('Hãy nhấn Play trên audio player để bắt đầu!');
        }

        function startPMR() {
            const modal = document.getElementById('exerciseModal');
            const title = document.getElementById('modalTitle');
            const body = document.getElementById('modalBody');

            // ============================================
            // 🎵 PMR AUDIO URL - THAY THẾ Ở ĐÂY
            // ============================================
            const pmrAudioUrl = 'https://example.com/progressive-muscle-relaxation.mp3'; // ← THAY URL mp3 PMR vào đây
            // ============================================

            const isPlaceholder = pmrAudioUrl.includes('example.com');

            title.textContent = 'Progressive Muscle Relaxation (PMR)';
            body.innerHTML = `
                <div style="text-align: center;">
                    <p style="color: #4b5563; margin-bottom: 20px;">Thư giãn cơ bắp lũy tiến - Căng cơ 5 giây, sau đó thả lỏng 10 giây</p>

                    ${isPlaceholder ? `
                        <div style="background: #fef3c7; border: 2px solid #f59e0b; border-radius: 12px; padding: 20px; margin: 20px 0;">
                            <p style="color: #92400e; margin-bottom: 10px;"><strong>⚠️ Chưa có audio hướng dẫn</strong></p>
                            <p style="color: #b45309; font-size: 0.9rem; line-height: 1.6;">
                                Để thêm audio:<br>
                                1. Mở file biolink-style331.php<br>
                                2. Tìm function startPMR() (dòng ~4900)<br>
                                3. Thay URL trong pmrAudioUrl<br>
                                4. Lưu file và refresh lại trang
                            </p>
                        </div>
                        <div style="text-align: left; max-width: 500px; margin: 20px auto; padding: 20px; background: #f8fafc; border-radius: 12px;">
                            <h4 style="color: #1e293b; margin-bottom: 15px;">📝 Hướng dẫn tạm (không có audio):</h4>
                            <ol style="color: #475569; line-height: 1.8;">
                                <li><strong>Tay:</strong> Nắm chặt → thả lỏng (×2)</li>
                                <li><strong>Cánh tay:</strong> Căng cơ nhị đầu → thả</li>
                                <li><strong>Vai:</strong> Nhún vai lên tai → thả</li>
                                <li><strong>Mặt:</strong> Nhăn mặt → thả</li>
                                <li><strong>Bụng:</strong> Căng cơ bụng → thả</li>
                                <li><strong>Chân:</strong> Duỗi thẳng, gập ngón → thả</li>
                            </ol>
                            <p style="color: #6b7280; font-size: 0.9rem; margin-top: 15px;">
                                Mỗi nhóm cơ: căng 5 giây, thả 10 giây. Cảm nhận sự khác biệt.
                            </p>
                        </div>
                    ` : `
                        <audio controls style="width: 100%; max-width: 500px; margin: 20px auto;">
                            <source src="${pmrAudioUrl}" type="audio/mpeg">
                            Trình duyệt của bạn không hỗ trợ phát audio.
                        </audio>
                        <p style="font-size: 0.85rem; color: #6b7280; margin-top: 15px;">
                            💡 Tip: Ngồi hoặc nằm thoải mái, không gian yên tĩnh
                        </p>
                    `}
                </div>
            `;

            modal.classList.add('show');
        }

        function startStory(type) {
            const modal = document.getElementById('exerciseModal');
            const title = document.getElementById('modalTitle');
            const body = document.getElementById('modalBody');

            // ============================================
            // 🎵 AUDIO URLs - THAY THẾ URL MP3 Ở ĐÂY
            // ============================================
            // Copy/paste URL mp3 của bạn vào các biến bên dưới
            const audioUrls = {
                beach: 'https://example.com/beach-sunset.mp3',     // ← THAY URL mp3 bãi biển vào đây
                forest: 'https://example.com/fairy-forest.mp3',   // ← THAY URL mp3 rừng thần tiên vào đây
                mountain: 'https://example.com/mountain-stars.mp3' // ← THAY URL mp3 núi đầy sao vào đây
            };
            // ============================================

            const stories = {
                beach: 'Bãi Biển Hoàng Hôn',
                forest: 'Rừng Thần Tiên',
                mountain: 'Núi Đầy Sao'
            };

            const storyDescriptions = {
                beach: 'Hãy tưởng tượng bạn đang nằm trên bãi biển vào lúc hoàng hôn. Sóng biển nhẹ nhàng vỗ về bờ, gió mát lành thổi qua...',
                forest: 'Bạn đang đi dạo trong khu rừng cổ tích yên bình. Ánh sáng lấp lánh xuyên qua tán lá, tiếng chim hót líu lo...',
                mountain: 'Bạn nằm trên đồng cỏ mềm mại, ngắm bầu trời đầy sao. Không khí mát lạnh, trong lành, vũ trụ bao la...'
            };

            title.textContent = stories[type];

            // Check if URL is placeholder or real
            const audioUrl = audioUrls[type];
            const isPlaceholder = audioUrl.includes('example.com');

            body.innerHTML = `
                <div style="text-align: center;">
                    <p style="color: #4b5563; margin-bottom: 20px;">${storyDescriptions[type]}</p>

                    ${isPlaceholder ? `
                        <div style="background: #fef3c7; border: 2px solid #f59e0b; border-radius: 12px; padding: 20px; margin: 20px 0;">
                            <p style="color: #92400e; margin-bottom: 10px;"><strong>⚠️ Chưa có audio</strong></p>
                            <p style="color: #b45309; font-size: 0.9rem; line-height: 1.6;">
                                Để thêm audio, vui lòng:<br>
                                1. Mở file biolink-style331.php<br>
                                2. Tìm function startStory() (dòng ~4868)<br>
                                3. Thay URL trong audioUrls.${type}<br>
                                4. Lưu file và refresh lại trang
                            </p>
                        </div>
                        <div style="font-style: italic; color: #6b7280; margin: 20px 0;">
                            "Hãy thoải mái, nhắm mắt, và để tâm trí theo dõi câu chuyện..."
                        </div>
                    ` : `
                        <audio controls style="width: 100%; max-width: 500px; margin: 20px auto;">
                            <source src="${audioUrl}" type="audio/mpeg">
                            Trình duyệt của bạn không hỗ trợ phát audio.
                        </audio>
                        <p style="font-size: 0.85rem; color: #6b7280; margin-top: 15px;">
                            💡 Tip: Đeo tai nghe, nằm thoải mái, nhắm mắt và để tâm trí thả lỏng
                        </p>
                    `}
                </div>
            `;

            modal.classList.add('show');
        }

        // Modal controls
        function closeModal() {
            const modal = document.getElementById('exerciseModal');
            modal.classList.remove('show');
            
            // Stop any running exercises
            stopBreathing();
        }

        // Click outside modal to close
        document.getElementById('exerciseModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // MEQ calculation
        function calculateMEQResult() {
            const totalScore = Object.values(meqScores).reduce((sum, score) => sum + score, 0);

            let chronotype, description, schedule;

            // rMEQ (reduced MEQ) với 5 câu hỏi - thang điểm 4-25
            if (totalScore >= 18) {
                chronotype = 'Definitely Morning Type (Sư tử)';
                description = 'Bạn là người sáng điển hình, năng suất cao nhất vào buổi sáng sớm.';
                schedule = 'Ngủ: 21:00-22:00, Thức: 05:30-06:30';
            } else if (totalScore >= 12) {
                chronotype = 'Intermediate Type (Gấu)';
                description = 'Bạn không thiên về sáng hay tối rõ rệt, dễ thích nghi với các lịch trình khác nhau.';
                schedule = 'Ngủ: 22:30-23:30, Thức: 06:30-07:30';
            } else {
                chronotype = 'Definitely Evening Type (Sói)';
                description = 'Bạn là người tối điển hình, năng suất cao nhất vào buổi tối và đêm.';
                schedule = 'Ngủ: sau 00:00, Thức: sau 08:00';
            }

            document.getElementById('meqResult').innerHTML = `
                <div style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); padding: 20px; border-radius: 12px; border: 2px solid #0ea5e9;">
                    <h4 style="color: #0c4a6e; margin-bottom: 10px;">Kết quả rMEQ (Reduced Morningness-Eveningness Questionnaire): ${totalScore}/25 điểm</h4>
                    <h3 style="color: #0369a1; margin-bottom: 12px;">${chronotype}</h3>
                    <p style="color: #075985; margin-bottom: 10px; line-height: 1.6;">${description}</p>
                    <p style="color: #0c4a6e;"><strong>Lịch trình lý tưởng:</strong> ${schedule}</p>
                    <p style="color: #64748b; font-size: 0.85rem; margin-top: 10px;"><em>Thang điểm: 18-25 (Morning type), 12-17 (Intermediate), 4-11 (Evening type)</em></p>
                </div>
            `;
        }

        // Social Jet Lag calculation
        function calculateSocialJetLag() {
            const naturalBed = document.getElementById('naturalBedtime').value;
            const naturalWake = document.getElementById('naturalWakeTime').value;
            const workBed = document.getElementById('workBedtime').value;
            const workWake = document.getElementById('workWakeTime').value;
            
            // Calculate midpoints
            const naturalMidpoint = calculateMidpoint(naturalBed, naturalWake);
            const workMidpoint = calculateMidpoint(workBed, workWake);
            
            // Calculate difference in hours
            const difference = Math.abs(naturalMidpoint - workMidpoint);
            
            let severity, advice, color;
            
            if (difference <= 1) {
                severity = 'Thấp';
                advice = 'Đồng hồ sinh học và lịch trình xã hội của bạn khá phù hợp.';
                color = '#10b981';
            } else if (difference <= 2) {
                severity = 'Trung bình';
                advice = 'Có một chút xung đột giữa xu hướng tự nhiên và yêu cầu xã hội.';
                color = '#f59e0b';
            } else {
                severity = 'Cao';
                advice = 'Xung đột nghiêm trọng có thể ảnh hưởng đến sức khỏe. Cần điều chỉnh lịch trình.';
                color = '#ef4444';
            }
            
            document.getElementById('socialJetLagResult').innerHTML = `
                <div style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); padding: 20px; border-radius: 12px; border-left: 4px solid ${color};">
                    <h4 style="color: #1e293b; margin-bottom: 12px;">Social Jet Lag: ${difference.toFixed(1)} giờ</h4>
                    <p style="color: ${color}; font-weight: 600; margin-bottom: 8px;">Mức độ: ${severity}</p>
                    <p style="color: #4b5563; line-height: 1.6;">${advice}</p>
                    ${difference > 2 ? `
                        <div style="margin-top: 12px; padding: 12px; background: rgba(239, 68, 68, 0.1); border-radius: 8px;">
                            <p style="color: #991b1b; font-size: 0.9rem;">
                                <strong>Khuyến nghị:</strong> Dần dần điều chỉnh giờ ngủ-thức cuối tuần 
                                gần hơn với lịch trình ngày thường, hoặc thương lượng giờ làm việc linh hoạt.
                            </p>
                        </div>
                    ` : ''}
                </div>
            `;
        }

        function calculateMidpoint(bedtime, waketime) {
            const bed = new Date(`2024-01-01T${bedtime}:00`);
            let wake = new Date(`2024-01-01T${waketime}:00`);
            
            // If wake time is earlier than bed time, it's next day
            if (wake < bed) {
                wake.setDate(wake.getDate() + 1);
            }
            
            const midpoint = new Date((bed.getTime() + wake.getTime()) / 2);
            return midpoint.getHours() + midpoint.getMinutes() / 60;
        }

        // Journal functions
        function saveAdvancedJournalEntry() {
            console.log('=== BẮT ĐẦU LƯU NHẬT KÝ ===');

            // Validation
            const date = document.getElementById('journalDate').value;
            const bedTime = document.getElementById('journalBedTime').value;
            const finalWake = document.getElementById('journalFinalWake').value;
            const sleepLatency = parseInt(document.getElementById('journalSleepLatency').value);
            const nightWakings = parseInt(document.getElementById('journalNightWakings').value);
            const wakeTime = parseInt(document.getElementById('journalWakeTime').value);

            // Validate required fields
            if (!date) {
                alert('Vui lòng chọn ngày!');
                return;
            }

            // Validate date is not in the future
            const selectedDate = new Date(date);
            const today = new Date();
            today.setHours(23, 59, 59, 999); // End of today
            if (selectedDate > today) {
                alert('Ngày không được là tương lai!');
                return;
            }

            // Validate required times
            if (!bedTime || !finalWake) {
                alert('Vui lòng nhập giờ đi ngủ và giờ thức dậy!');
                return;
            }

            // Validate numeric fields are not negative
            if (sleepLatency < 0 || nightWakings < 0 || wakeTime < 0) {
                alert('Các giá trị số không được âm!');
                return;
            }

            // Validate sleep latency is reasonable (< 5 hours)
            if (sleepLatency > 300) {
                alert('Thời gian chìm vào giấc ngủ không hợp lý (>5 giờ). Vui lòng kiểm tra lại!');
                return;
            }

            const entry = {
                id: Date.now(),
                date: date,
                bedTime: bedTime,
                lightsOut: document.getElementById('journalLightsOut').value,
                sleepLatency: sleepLatency,
                nightWakings: nightWakings,
                wakeTime: wakeTime,
                finalWake: finalWake,
                outOfBed: document.getElementById('journalOutOfBed').value,
                sleepQuality: ratings.journalSleepQuality || 3,
                morningFeeling: ratings.journalMorningFeeling || 3,
                caffeine: document.getElementById('journalCaffeine').value,
                alcohol: document.getElementById('journalAlcohol').value,
                exercise: document.getElementById('journalExercise').value,
                dinner: document.getElementById('journalDinner').value,
                nap: document.getElementById('journalNap').value,
                stress: ratings.journalStress || 1,
                medication: document.getElementById('journalMedication').value,
                notes: document.getElementById('journalNotes').value
            };

            console.log('1. Entry mới được tạo:', entry);
            console.log('2. journalEntries TRƯỚC khi thêm:', journalEntries.length, 'entries');

            journalEntries.unshift(entry);

            console.log('3. journalEntries SAU khi thêm:', journalEntries.length, 'entries');
            console.log('4. Toàn bộ journalEntries:', journalEntries);

            // Save to localStorage
            try {
                console.log('5. Đang lưu vào localStorage...');
                localStorage.setItem('journalEntries', JSON.stringify(journalEntries));
                console.log('6. ĐÃ LƯU THÀNH CÔNG vào localStorage');

                // Verify what's in localStorage
                const saved = localStorage.getItem('journalEntries');
                console.log('7. Dữ liệu trong localStorage sau khi lưu:', saved ? JSON.parse(saved).length + ' entries' : 'RỖNG');
                console.log('8. Chi tiết dữ liệu localStorage:', saved);
            } catch (e) {
                console.error('❌ LỖI khi lưu vào localStorage:', e);
            }

            console.log('=== KẾT THÚC LƯU NHẬT KÝ ===');

            // Clear form
            const todayStr = new Date().toISOString().split('T')[0];
            document.getElementById('journalDate').value = todayStr;
            document.getElementById('journalBedTime').value = '';
            document.getElementById('journalLightsOut').value = '';
            document.getElementById('journalSleepLatency').value = '';
            document.getElementById('journalNightWakings').value = '';
            document.getElementById('journalWakeTime').value = '';
            document.getElementById('journalFinalWake').value = '';
            document.getElementById('journalOutOfBed').value = '';
            document.getElementById('journalCaffeine').value = '';
            document.getElementById('journalAlcohol').value = '';
            document.getElementById('journalExercise').value = '';
            document.getElementById('journalDinner').value = '';
            document.getElementById('journalNap').value = '';
            document.getElementById('journalMedication').value = '';
            document.getElementById('journalNotes').value = '';
            
            // Reset ratings
            setRating('journalSleepQuality', 3);
            setRating('journalMorningFeeling', 3);
            setRating('journalStress', 1);
            
            // Update displays
            updateJournalHistory();
            updateJournalStats();
            updateJournalAnalytics();

            alert('Đã lưu nhật ký thành công! 📝');
        }

        function updateJournalHistory() {
            const history = document.getElementById('journalHistory');
            
            if (journalEntries.length === 0) {
                history.innerHTML = '<p style="text-align: center; color: #6b7280; padding: 40px 0;">Chưa có dữ liệu. Hãy bắt đầu ghi chép!</p>';
                return;
            }
            
            let html = '';
            journalEntries.slice(0, 10).forEach(entry => {
                const qualityClass = entry.sleepQuality >= 4 ? 'excellent' : entry.sleepQuality >= 3 ? 'good' : 'poor';

                html += `
                    <div class="journal-entry">
                        <div class="journal-header">
                            <span class="journal-date">${entry.date}</span>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <span class="quality-badge ${qualityClass}">Chất lượng: ${entry.sleepQuality}/5</span>
                                <button onclick="editJournalEntry(${entry.id})" style="background: #3b82f6; color: white; border: none; padding: 4px 10px; border-radius: 6px; cursor: pointer; font-size: 0.85rem;">
                                    <i class="fas fa-edit"></i> Sửa
                                </button>
                                <button onclick="deleteJournalEntry(${entry.id})" style="background: #ef4444; color: white; border: none; padding: 4px 10px; border-radius: 6px; cursor: pointer; font-size: 0.85rem;">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </div>
                        </div>
                        <div class="journal-details">
                            <p>🛏️ ${entry.bedTime} → 🌅 ${entry.finalWake}</p>
                            ${entry.sleepLatency ? `<p>⏱️ Chìm vào giấc ngủ: ${entry.sleepLatency} phút</p>` : ''}
                            ${entry.nightWakings ? `<p>😴 Thức giấc: ${entry.nightWakings} lần</p>` : ''}
                            ${entry.caffeine ? `<p>☕ ${entry.caffeine}</p>` : ''}
                            ${entry.exercise ? `<p>🏃 ${entry.exercise}</p>` : ''}
                            ${entry.stress ? `<p>😰 Căng thẳng: ${entry.stress}/5</p>` : ''}
                            ${entry.notes ? `<p>📝 ${entry.notes}</p>` : ''}
                        </div>
                    </div>
                `;
            });

            history.innerHTML = html;
        }

        function updateJournalStats() {
            if (journalEntries.length === 0) {
                document.getElementById('journalStats').innerHTML = '';
                return;
            }
            
            const recent = journalEntries.slice(0, 7);
            const avgQuality = recent.reduce((sum, entry) => sum + entry.sleepQuality, 0) / recent.length;
            const avgMorningFeeling = recent.reduce((sum, entry) => sum + entry.morningFeeling, 0) / recent.length;
            const avgLatency = recent.filter(e => e.sleepLatency).reduce((sum, entry) => sum + parseInt(entry.sleepLatency), 0) / recent.filter(e => e.sleepLatency).length || 0;
            
            document.getElementById('journalStats').innerHTML = `
                <h4 style="color: #1e293b; margin-bottom: 12px;">📊 Thống kê 7 ngày gần nhất</h4>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">${avgQuality.toFixed(1)}</div>
                        <div class="stat-label">Chất lượng TB</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">${avgMorningFeeling.toFixed(1)}</div>
                        <div class="stat-label">Cảm giác sáng TB</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">${avgLatency.toFixed(0)}</div>
                        <div class="stat-label">Độ trễ TB (phút)</div>
                    </div>
                </div>
            `;
        }

        function updateJournalAnalytics() {
            const analyticsDiv = document.getElementById('journalAnalytics');

            if (journalEntries.length < 3) {
                analyticsDiv.innerHTML = '<p style="text-align: center; color: #6b7280; padding: 40px 0;">Cần ít nhất 3 ngày dữ liệu để phân tích xu hướng</p>';
                return;
            }

            // Get recent entries (up to 30 days)
            const recentEntries = journalEntries.slice(0, 30).reverse();

            // Prepare data for trend chart
            const dates = recentEntries.map(e => {
                const d = new Date(e.date);
                return `${d.getDate()}/${d.getMonth() + 1}`;
            });
            const sleepQuality = recentEntries.map(e => e.sleepQuality);
            const morningFeeling = recentEntries.map(e => e.morningFeeling);
            const stressLevels = recentEntries.map(e => e.stress);

            // Create analytics HTML
            analyticsDiv.innerHTML = `
                <div style="margin-bottom: 30px;">
                    <h4 style="color: #1e293b; margin-bottom: 15px;"><i class="fas fa-chart-line"></i> Xu hướng chất lượng giấc ngủ</h4>
                    <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <canvas id="trendChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>

                <div style="margin-bottom: 30px;">
                    <h4 style="color: #1e293b; margin-bottom: 15px;"><i class="fas fa-lightbulb"></i> Phân tích tương quan</h4>
                    <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                        ${analyzeCorrelation(recentEntries, 'caffeine', 'Caffeine')}
                        ${analyzeCorrelation(recentEntries, 'exercise', 'Tập thể dục')}
                        ${analyzeCorrelation(recentEntries, 'alcohol', 'Rượu/bia')}
                    </div>
                </div>

                <div>
                    <h4 style="color: #1e293b; margin-bottom: 15px;"><i class="fas fa-star"></i> Những ngày ngủ tốt nhất</h4>
                    ${getBestSleepDays(recentEntries)}
                </div>
            `;

            // Create trend chart
            const trendCanvas = document.getElementById('trendChart');
            if (trendCanvas) {
                if (window.trendChartInstance) {
                    window.trendChartInstance.destroy();
                }

                window.trendChartInstance = new Chart(trendCanvas, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [
                            {
                                label: 'Chất lượng giấc ngủ',
                                data: sleepQuality,
                                borderColor: '#667eea',
                                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                                tension: 0.3,
                                fill: true,
                                borderWidth: 3,
                                pointRadius: 4,
                                pointHoverRadius: 6
                            },
                            {
                                label: 'Cảm giác sáng',
                                data: morningFeeling,
                                borderColor: '#f093fb',
                                backgroundColor: 'rgba(240, 147, 251, 0.1)',
                                tension: 0.3,
                                fill: true,
                                borderWidth: 3,
                                pointRadius: 4,
                                pointHoverRadius: 6
                            },
                            {
                                label: 'Căng thẳng (đảo ngược)',
                                data: stressLevels.map(s => 6 - s), // Inverse stress (lower is better)
                                borderColor: '#ffa726',
                                backgroundColor: 'rgba(255, 167, 38, 0.1)',
                                tension: 0.3,
                                fill: false,
                                borderWidth: 2,
                                borderDash: [5, 5],
                                pointRadius: 3,
                                pointHoverRadius: 5
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 15
                                }
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 5,
                                ticks: {
                                    stepSize: 1
                                },
                                title: {
                                    display: true,
                                    text: 'Điểm đánh giá (1-5)'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Ngày'
                                }
                            }
                        }
                    }
                });
            }
        }

        function analyzeCorrelation(entries, factor, label) {
            const withFactor = entries.filter(e => e[factor] && e[factor].trim() !== '');
            const withoutFactor = entries.filter(e => !e[factor] || e[factor].trim() === '');

            if (withFactor.length === 0 && withoutFactor.length === 0) {
                return `
                    <div class="stat-card" style="background: #f8fafc;">
                        <div class="stat-label">${label}</div>
                        <div style="color: #94a3b8; font-size: 0.9rem;">Chưa có dữ liệu</div>
                    </div>
                `;
            }

            const avgWith = withFactor.length > 0
                ? withFactor.reduce((sum, e) => sum + e.sleepQuality, 0) / withFactor.length
                : 0;
            const avgWithout = withoutFactor.length > 0
                ? withoutFactor.reduce((sum, e) => sum + e.sleepQuality, 0) / withoutFactor.length
                : 0;

            const diff = avgWith - avgWithout;
            const impact = Math.abs(diff) > 0.3
                ? (diff > 0 ? 'Tích cực' : 'Tiêu cực')
                : 'Không rõ ràng';
            const icon = diff > 0.3 ? '📈' : diff < -0.3 ? '📉' : '➖';
            const color = diff > 0.3 ? '#10b981' : diff < -0.3 ? '#ef4444' : '#94a3b8';

            return `
                <div class="stat-card" style="background: linear-gradient(135deg, #ffffff, #f8fafc); border-left: 4px solid ${color};">
                    <div class="stat-label">${label}</div>
                    <div style="font-size: 1.5rem; margin: 8px 0;">${icon}</div>
                    <div style="color: ${color}; font-weight: 600; font-size: 0.95rem;">${impact}</div>
                    <div style="color: #64748b; font-size: 0.85rem; margin-top: 5px;">
                        Có: ${avgWith.toFixed(1)} | Không: ${avgWithout.toFixed(1)}
                    </div>
                </div>
            `;
        }

        function getBestSleepDays(entries) {
            const sorted = [...entries].sort((a, b) => b.sleepQuality - a.sleepQuality);
            const top3 = sorted.slice(0, 3);

            if (top3.length === 0) {
                return '<p style="color: #6b7280;">Chưa có dữ liệu</p>';
            }

            return `
                <div style="background: linear-gradient(135deg, #ecfdf5, #d1fae5); padding: 20px; border-radius: 12px; border-left: 5px solid #10b981;">
                    ${top3.map((entry, index) => `
                        <div style="display: flex; align-items: center; gap: 15px; padding: 10px 0; ${index < top3.length - 1 ? 'border-bottom: 1px solid #a7f3d0;' : ''}">
                            <div style="font-size: 2rem;">${index === 0 ? '🥇' : index === 1 ? '🥈' : '🥉'}</div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #065f46;">${entry.date}</div>
                                <div style="color: #047857; font-size: 0.9rem;">Chất lượng: ${entry.sleepQuality}/5 | Cảm giác sáng: ${entry.morningFeeling}/5</div>
                                ${entry.notes ? `<div style="color: #059669; font-size: 0.85rem; margin-top: 3px;">💡 ${entry.notes}</div>` : ''}
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;
        }

        function exportJournal() {
            if (journalEntries.length === 0) {
                alert('Không có dữ liệu để xuất!');
                return;
            }
            
            const headers = [
                'Ngày', 'Giờ đi ngủ', 'Giờ tắt đèn', 'Độ trễ giấc ngủ (phút)', 
                'Số lần thức giấc', 'Giờ thức cuối', 'Giờ ra giường',
                'Chất lượng giấc ngủ', 'Cảm giác sáng', 'Caffeine', 'Rượu bia',
                'Tập thể dục', 'Bữa tối', 'Ngủ trưa', 'Căng thẳng', 'Thuốc', 'Ghi chú'
            ];
            
            let csv = headers.join(',') + '\n';
            
            journalEntries.forEach(entry => {
                const row = [
                    entry.date, entry.bedTime, entry.lightsOut, entry.sleepLatency,
                    entry.nightWakings, entry.finalWake, entry.outOfBed,
                    entry.sleepQuality, entry.morningFeeling, entry.caffeine, entry.alcohol,
                    entry.exercise, entry.dinner, entry.nap, entry.stress, 
                    entry.medication, entry.notes
                ].map(field => `"${field || ''}"`);
                
                csv += row.join(',') + '\n';
            });
            
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `sleep-journal-${new Date().toISOString().split('T')[0]}.csv`;
            a.click();
            URL.revokeObjectURL(url);
        }

        function exportJournalPDF() {
            // PDF export requires external library (jsPDF)
            // For now, provide workaround
            alert('💡 Tính năng xuất PDF:\n\n' +
                  '1. Sử dụng nút "Xuất CSV" để xuất dữ liệu\n' +
                  '2. Mở file CSV bằng Excel/Google Sheets\n' +
                  '3. Sử dụng chức năng "In" hoặc "Xuất PDF" của Excel/Google Sheets\n\n' +
                  'Hoặc chụp màn hình nhật ký để chia sẻ với bác sĩ.');
        }

        function importJournal() {
            const fileInput = document.getElementById('importFile');
            const file = fileInput.files[0];

            if (!file) {
                alert('Vui lòng chọn file CSV để nhập!');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    const csv = e.target.result;
                    const lines = csv.split('\n');

                    // Skip header
                    const dataLines = lines.slice(1);

                    let importCount = 0;
                    dataLines.forEach(line => {
                        if (line.trim() === '') return;

                        const values = line.split(',').map(val => val.replace(/^"|"$/g, '').trim());

                        if (values.length < 17) return;

                        const entry = {
                            id: Date.now() + importCount,
                            date: values[0],
                            bedTime: values[1],
                            lightsOut: values[2],
                            sleepLatency: values[3],
                            nightWakings: values[4],
                            finalWake: values[5],
                            outOfBed: values[6],
                            sleepQuality: parseInt(values[7]) || 3,
                            morningFeeling: parseInt(values[8]) || 3,
                            caffeine: values[9],
                            alcohol: values[10],
                            exercise: values[11],
                            dinner: values[12],
                            nap: values[13],
                            stress: parseInt(values[14]) || 1,
                            medication: values[15],
                            notes: values[16]
                        };

                        journalEntries.push(entry);
                        importCount++;
                    });

                    // Save to localStorage
                    localStorage.setItem('journalEntries', JSON.stringify(journalEntries));

                    // Update displays
                    updateJournalHistory();
                    updateJournalStats();
                    updateJournalAnalytics();

                    alert(`✅ Đã nhập thành công ${importCount} bản ghi!`);
                    fileInput.value = '';

                } catch (error) {
                    console.error('Lỗi khi nhập file:', error);
                    alert('❌ Lỗi khi nhập file. Vui lòng kiểm tra định dạng file CSV!');
                }
            };

            reader.readAsText(file);
        }

        function deleteJournalEntry(entryId, skipConfirm = false) {
            if (!skipConfirm && !confirm('Bạn có chắc muốn xóa bản ghi này?')) {
                return;
            }

            // Remove entry from array
            journalEntries = journalEntries.filter(entry => entry.id !== entryId);

            // Save to localStorage
            localStorage.setItem('journalEntries', JSON.stringify(journalEntries));

            // Update displays
            updateJournalHistory();
            updateJournalStats();
            updateJournalAnalytics();

            if (!skipConfirm) {
                alert('✅ Đã xóa bản ghi!');
            }
        }

        function editJournalEntry(entryId) {
            // Find the entry
            const entry = journalEntries.find(e => e.id === entryId);
            if (!entry) {
                alert('Không tìm thấy bản ghi!');
                return;
            }

            // Scroll to form
            document.getElementById('sleep-journal').scrollIntoView({ behavior: 'smooth' });

            // Populate form with entry data
            document.getElementById('journalDate').value = entry.date;
            document.getElementById('journalBedTime').value = entry.bedTime;
            document.getElementById('journalLightsOut').value = entry.lightsOut || '';
            document.getElementById('journalSleepLatency').value = entry.sleepLatency || '';
            document.getElementById('journalNightWakings').value = entry.nightWakings || '';
            document.getElementById('journalWakeTime').value = entry.wakeTime || '';
            document.getElementById('journalFinalWake').value = entry.finalWake;
            document.getElementById('journalOutOfBed').value = entry.outOfBed || '';
            document.getElementById('journalCaffeine').value = entry.caffeine || '';
            document.getElementById('journalAlcohol').value = entry.alcohol || '';
            document.getElementById('journalExercise').value = entry.exercise || '';
            document.getElementById('journalDinner').value = entry.dinner || '';
            document.getElementById('journalNap').value = entry.nap || '';
            document.getElementById('journalMedication').value = entry.medication || '';
            document.getElementById('journalNotes').value = entry.notes || '';

            // Set ratings
            setRating('journalSleepQuality', entry.sleepQuality || 3);
            setRating('journalMorningFeeling', entry.morningFeeling || 3);
            setRating('journalStress', entry.stress || 1);

            // Delete old entry when saving (without confirmation)
            deleteJournalEntry(entryId, true);

            alert('📝 Dữ liệu đã được tải vào form. Chỉnh sửa và nhấn "Lưu nhật ký" để cập nhật.');
        }

        // Weekly tasks
        function updateWeeklyTasks() {
            const tasks = {
                1: [
                    'Ghi nhật ký giấc ngủ hàng ngày',
                    'Đo nhiệt độ phòng ngủ',
                    'Đánh giá ánh sáng trong phòng', 
                    'Kiểm tra tiếng ồn môi trường',
                    'Quan sát thói quen hiện tại',
                    'Mua rèm cản sáng nếu cần',
                    'Loại bỏ thiết bị điện tử khỏi phòng ngủ'
                ],
                2: [
                    'Xác định giờ ngủ-thức cố định',
                    'Tuân thủ lịch trình 7 ngày/tuần',
                    'Ngưng caffeine sau 14:00',
                    'Hạn chế rượu bia buổi tối',
                    'Điều chỉnh bữa ăn tối',
                    'Tiếp xúc ánh sáng mặt trời buổi sáng',
                    'Ghi chép phản ứng của cơ thể'
                ],
                3: [
                    'Tạo bedtime routine 30-60 phút',
                    'Thực hành kỹ thuật thở',
                    'Tắm nước ấm hoặc ngâm chân',
                    'Tập thể dục đều đặn ban ngày',
                    'Tránh tập cường độ cao tối muộn',
                    'Đọc sách giấy thay vì điện tử',
                    'Viết nhật ký lo lắng'
                ],
                4: [
                    'So sánh dữ liệu tuần 1 vs hiện tại',
                    'Đánh giá cải thiện các chỉ số',
                    'Xác định yếu tố hiệu quả nhất',
                    'Điều chỉnh lịch trình nếu cần',
                    'Lập kế hoạch duy trì dài hạn',
                    'Thiết lập hệ thống nhắc nhở',
                    'Chuẩn bị cho tình huống đặc biệt'
                ]
            };
            
            const weekTasks = tasks[currentWeek] || tasks[4];
            let html = '';
            
            weekTasks.forEach((task, index) => {
                html += `
                    <label style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; padding: 8px; background: #f8fafc; border-radius: 6px; cursor: pointer;">
                        <input type="checkbox" onchange="updateTaskProgress()">
                        <span style="flex: 1;">${task}</span>
                    </label>
                `;
            });
            
            document.getElementById('weeklyTasks').innerHTML = html;
        }

        function updateTaskProgress() {
            const checkboxes = document.querySelectorAll('#weeklyTasks input[type="checkbox"]');
            const completed = Array.from(checkboxes).filter(cb => cb.checked).length;
            const total = checkboxes.length;
            
            document.getElementById('progressTasks').textContent = `${completed}/${total}`;
            
            // Calculate improvement (mock calculation)
            const improvement = Math.min(completed * 2, 25);
            document.getElementById('progressImprovement').textContent = `+${improvement}%`;
        }

        // Disorder assessments
        function calculateISI() {
            const total = Object.values(isiScores).reduce((sum, score) => sum + score, 0);
            
            let severity, description, recommendation;
            
            if (total <= 7) {
                severity = 'Không mất ngủ lâm sàng';
                description = 'Giấc ngủ của bạn trong tầm bình thường.';
                recommendation = 'Tiếp tục duy trì thói quen ngủ tốt.';
            } else if (total <= 14) {
                severity = 'Mất ngủ ngưỡng dưới lâm sàng';
                description = 'Có dấu hiệu mất ngủ nhẹ.';
                recommendation = 'Áp dụng kỹ thuật vệ sinh giấc ngủ và theo dõi.';
            } else if (total <= 21) {
                severity = 'Mất ngủ mức độ vừa';
                description = 'Mất ngủ ảnh hưởng đến chất lượng cuộc sống.';
                recommendation = 'Nên tham khảo ý kiến chuyên gia và cân nhắc CBT-I.';
            } else {
                severity = 'Mất ngủ nghiêm trọng';
                description = 'Mất ngủ nghiêm trọng cần can thiệp chuyên nghiệp.';
                recommendation = 'Cần gặp bác sĩ chuyên khoa ngay để được tư vấn và điều trị.';
            }
            
            document.getElementById('isiResult').innerHTML = `
                <div style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); padding: 20px; border-radius: 12px; border-left: 4px solid ${total <= 7 ? '#10b981' : total <= 14 ? '#f59e0b' : '#ef4444'};">
                    <h4 style="color: #1e293b; margin-bottom: 12px;">Điểm ISI: ${total}/28</h4>
                    <h3 style="color: ${total <= 7 ? '#059669' : total <= 14 ? '#d97706' : '#dc2626'}; margin-bottom: 12px;">${severity}</h3>
                    <p style="color: #4b5563; margin-bottom: 12px; line-height: 1.6;">${description}</p>
                    <p style="color: #1e293b; font-weight: 600;">${recommendation}</p>
                    ${total > 14 ? `
                        <div style="margin-top: 15px; padding: 12px; background: rgba(239, 68, 68, 0.1); border-radius: 8px;">
                            <p style="color: #991b1b; font-size: 0.9rem;">
                                <strong>⚠️ Lưu ý:</strong> Kết quả này chỉ mang tính tham khảo. 
                                Hãy tham khảo ý kiến bác sĩ chuyên khoa để được chẩn đoán và điều trị chính xác.
                            </p>
                        </div>
                    ` : ''}
                </div>
            `;
        }

        function calculateStopBang() {
            let score = 0;
            
            // Count checked items
            const checkboxes = ['stopbang-snoring', 'stopbang-tired', 'stopbang-observed', 'stopbang-pressure', 'stopbang-bmi', 'stopbang-age', 'stopbang-neck', 'stopbang-gender'];
            
            checkboxes.forEach(id => {
                if (document.getElementById(id).checked) score++;
            });
            
            let risk, description, recommendation, color;
            
            if (score <= 2) {
                risk = 'Thấp';
                description = 'Nguy cơ ngưng thở khi ngủ thấp.';
                recommendation = 'Tiếp tục theo dõi các triệu chứng.';
                color = '#10b981';
            } else if (score <= 4) {
                risk = 'Trung bình';
                description = 'Có nguy cơ ngưng thở khi ngủ ở mức trung bình.';
                recommendation = 'Nên tham khảo ý kiến bác sĩ để đánh giá thêm.';
                color = '#f59e0b';
            } else {
                risk = 'Cao';
                description = 'Nguy cơ cao bị ngưng thở khi ngủ.';
                recommendation = 'Cần gặp bác sĩ chuyên khoa để thực hiện sleep study.';
                color = '#ef4444';
            }
            
            document.getElementById('stopBangResult').innerHTML = `
                <div style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); padding: 20px; border-radius: 12px; border-left: 4px solid ${color};">
                    <h4 style="color: #1e293b; margin-bottom: 12px;">Điểm STOP-BANG: ${score}/8</h4>
                    <h3 style="color: ${color}; margin-bottom: 12px;">Nguy cơ: ${risk}</h3>
                    <p style="color: #4b5563; margin-bottom: 12px; line-height: 1.6;">${description}</p>
                    <p style="color: #1e293b; font-weight: 600;">${recommendation}</p>
                    ${score > 4 ? `
                        <div style="margin-top: 15px; padding: 12px; background: rgba(239, 68, 68, 0.1); border-radius: 8px;">
                            <p style="color: #991b1b; font-size: 0.9rem;">
                                <strong>⚠️ Quan trọng:</strong> Sleep apnea không được điều trị có thể dẫn đến 
                                tăng huyết áp, bệnh tim, đột quỵ và tai nạn do buồn ngủ ban ngày.
                            </p>
                        </div>
                    ` : ''}
                </div>
            `;
        }

        function updateStopBang() {
            // Update BMI
            const height = parseFloat(document.getElementById('height').value);
            const weight = parseFloat(document.getElementById('weight').value);
            
            if (height && weight) {
                const bmi = weight / Math.pow(height / 100, 2);
                document.getElementById('bmiValue').textContent = bmi.toFixed(1);
                document.getElementById('stopbang-bmi').checked = bmi > 35;
            }
            
            // Update age
            const age = parseInt(document.getElementById('age').value);
            if (age) {
                document.getElementById('stopbang-age').checked = age > 50;
            }
            
            // Update neck circumference
            const neck = parseFloat(document.getElementById('neckCirc').value);
            const gender = document.querySelector('input[name="gender"]:checked')?.value;
            
            if (neck && gender) {
                const threshold = gender === 'male' ? 43 : 41;
                document.getElementById('stopbang-neck').checked = neck > threshold;
            }
            
            // Update gender
            document.getElementById('stopbang-gender').checked = gender === 'male';
        }

        function assessRLS() {
            const criteria = ['rls-urge', 'rls-rest', 'rls-movement', 'rls-evening'];
            const checkedCriteria = criteria.filter(id => document.getElementById(id).checked).length;
            const frequency = parseInt(document.getElementById('rlsFrequency').value);
            
            let diagnosis, description, recommendation;
            
            if (checkedCriteria === 4 && frequency >= 2) {
                diagnosis = 'Có khả năng mắc RLS';
                description = 'Bạn đáp ứng đủ 4 tiêu chí chẩn đoán RLS và có tần suất triệu chứng đáng lo ngại.';
                recommendation = 'Nên gặp bác sĩ thần kinh để được chẩn đoán chính xác và điều trị.';
            } else if (checkedCriteria >= 3) {
                diagnosis = 'Có dấu hiệu RLS';
                description = 'Bạn có một số dấu hiệu của RLS nhưng chưa đáp ứng đủ tiêu chí.';
                recommendation = 'Theo dõi triệu chứng và tham khảo ý kiến bác sĩ nếu tình trạng trở nên tồi tệ.';
            } else {
                diagnosis = 'Không có dấu hiệu RLS';
                description = 'Các triệu chứng của bạn không phù hợp với hội chứng chân không yên.';
                recommendation = 'Nếu vẫn có khó chịu ở chân, có thể do nguyên nhân khác.';
            }
            
            const color = checkedCriteria === 4 && frequency >= 2 ? '#ef4444' : checkedCriteria >= 3 ? '#f59e0b' : '#10b981';
            
            document.getElementById('rlsResult').innerHTML = `
                <div style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); padding: 20px; border-radius: 12px; border-left: 4px solid ${color};">
                    <h4 style="color: #1e293b; margin-bottom: 12px;">Tiêu chí đáp ứng: ${checkedCriteria}/4</h4>
                    <h3 style="color: ${color}; margin-bottom: 12px;">${diagnosis}</h3>
                    <p style="color: #4b5563; margin-bottom: 12px; line-height: 1.6;">${description}</p>
                    <p style="color: #1e293b; font-weight: 600;">${recommendation}</p>
                    ${checkedCriteria === 4 && frequency >= 2 ? `
                        <div style="margin-top: 15px; padding: 12px; background: rgba(16, 185, 129, 0.1); border-radius: 8px;">
                            <p style="color: #047857; font-size: 0.9rem;">
                                <strong>💡 Thông tin:</strong> RLS có thể được cải thiện bằng cách bổ sung sắt, 
                                magnesium, tránh caffeine, và thực hiện massage chân nhẹ nhàng.
                            </p>
                        </div>
                    ` : ''}
                </div>
            `;
        }

        function calculateESS() {
            const total = Object.values(essScores).reduce((sum, score) => sum + score, 0);
            
            let interpretation, description, recommendation;
            
            if (total <= 10) {
                interpretation = 'Bình thường';
                description = 'Mức độ buồn ngủ ban ngày trong tầm bình thường.';
                recommendation = 'Không có dấu hiệu rối loạn giấc ngủ liên quan đến buồn ngủ quá mức.';
            } else if (total <= 15) {
                interpretation = 'Buồn ngủ nhẹ đến trung bình';
                description = 'Có dấu hiệu buồn ngủ ban ngày cao hơn bình thường.';
                recommendation = 'Nên đánh giá chất lượng giấc ngủ và xem xét tham khảo ý kiến chuyên gia.';
            } else if (total <= 20) {
                interpretation = 'Buồn ngủ mức độ cao';
                description = 'Buồn ngủ ban ngày nghiêm trọng, có thể ảnh hưởng đến an toàn.';
                recommendation = 'Cần gặp bác sĩ chuyên khoa giấc ngủ để đánh giá các rối loạn như sleep apnea hoặc narcolepsy.';
            } else {
                interpretation = 'Buồn ngủ rất nghiêm trọng';
                description = 'Mức độ buồn ngủ cực kỳ nguy hiểm.';
                recommendation = 'Cần gặp bác sĩ ngay lập tức và tránh lái xe cho đến khi được điều trị.';
            }
            
            const color = total <= 10 ? '#10b981' : total <= 15 ? '#f59e0b' : '#ef4444';
            
            document.getElementById('essResult').innerHTML = `
                <div style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); padding: 20px; border-radius: 12px; border-left: 4px solid ${color};">
                    <h4 style="color: #1e293b; margin-bottom: 12px;">Điểm ESS: ${total}/24</h4>
                    <h3 style="color: ${color}; margin-bottom: 12px;">${interpretation}</h3>
                    <p style="color: #4b5563; margin-bottom: 12px; line-height: 1.6;">${description}</p>
                    <p style="color: #1e293b; font-weight: 600;">${recommendation}</p>
                    ${total > 15 ? `
                        <div style="margin-top: 15px; padding: 12px; background: rgba(239, 68, 68, 0.1); border-radius: 8px;">
                            <p style="color: #991b1b; font-size: 0.9rem;">
                                <strong>⚠️ Cảnh báo an toàn:</strong> Với mức độ buồn ngủ này, 
                                hãy tránh lái xe hoặc vận hành máy móc nguy hiểm cho đến khi được điều trị.
                            </p>
                        </div>
                    ` : ''}
                </div>
            `;
        }

        function calculatePSQI() {
            const total = Object.values(psqiScores).reduce((sum, score) => sum + score, 0);

            // Update displayed score
            document.getElementById('psqiScore').textContent = total;

            let interpretation, recommendation;

            if (total <= 5) {
                interpretation = 'Chất lượng giấc ngủ tốt';
                recommendation = 'Giấc ngủ của bạn có chất lượng tốt. Hãy tiếp tục duy trì thói quen hiện tại.';
            } else if (total <= 10) {
                interpretation = 'Chất lượng giấc ngủ kém';
                recommendation = 'Nên áp dụng các biện pháp cải thiện vệ sinh giấc ngủ và theo dõi thêm.';
            } else {
                interpretation = 'Chất lượng giấc ngủ rất kém';
                recommendation = 'Cần được đánh giá bởi chuyên gia về các rối loạn giấc ngủ.';
            }

            document.getElementById('psqiInterpretation').innerHTML = `
                <strong>${interpretation}.</strong> ${recommendation}
            `;
        }

        function generatePersonalizedRecommendations() {
            // Collect all assessment data
            const sleepLatency = parseInt(document.getElementById('qualitySleepLatency')?.value || 20);
            const isiTotal = Object.values(isiScores).reduce((sum, score) => sum + score, 0);
            const essTotal = Object.values(essScores).reduce((sum, score) => sum + score, 0);
            const meqTotal = Object.values(meqScores).reduce((sum, score) => sum + score, 0);
            
            const personalizedRecs = [];
            
            // Priority 1: Immediate safety concerns
            if (essTotal > 15) {
                personalizedRecs.push({
                    priority: 1,
                    title: '<i class="fas fa-exclamation-circle"></i> Vấn đề an toàn cấp thiết',
                    actions: [
                        'Ngừng lái xe cho đến khi giải quyết được vấn đề buồn ngủ',
                        'Gặp bác sĩ chuyên khoa giấc ngủ trong tuần này',
                        'Xin nghỉ làm hoặc điều chỉnh công việc nếu cần thiết',
                        'Thông báo cho gia đình về tình trạng để được hỗ trợ'
                    ],
                    timeframe: 'Ngay lập tức'
                });
            }
            
            // Priority 2: Medical evaluation needed
            if (isiTotal > 14 || essTotal > 10) {
                personalizedRecs.push({
                    priority: 2,
                    title: '⚕️ Cần đánh giá y khoa',
                    actions: [
                        'Đặt lịch khám với bác sĩ chuyên khoa thần kinh hoặc tâm thần',
                        'Chuẩn bị nhật ký giấc ngủ 2 tuần để mang theo',
                        'Liệt kê tất cả thuốc đang sử dụng',
                        'Cân nhắc sleep study nếu bác sĩ khuyến nghị'
                    ],
                    timeframe: '1-2 tuần'
                });
            }
            
            // Priority 3: Lifestyle interventions
            if (sleepLatency > 30) {
                personalizedRecs.push({
                    priority: 3,
                    title: '<i class="fas fa-spa"></i> Can thiệp thư giãn',
                    actions: [
                        'Thực hành CBT-I (Cognitive Behavioral Therapy for Insomnia)',
                        'Bắt đầu với kỹ thuật thở 4-7-8 mỗi tối',
                        'Tạo thói quen thư giãn 60 phút trước ngủ',
                        'Cân nhắc ứng dụng thiền định như Headspace hoặc Calm'
                    ],
                    timeframe: '2-4 tuần'
                });
            }
            
            // Priority 4: Circadian optimization
            if (meqTotal < 42 || meqTotal > 58) {
                const isEvening = meqTotal < 42;
                personalizedRecs.push({
                    priority: 4,
                    title: '<i class="fas fa-clock"></i> Tối ưu nhịp sinh học',
                    actions: isEvening ? [
                        'Sử dụng bright light therapy 10,000 lux buổi sáng',
                        'Tránh ánh sáng xanh 2-3 giờ trước ngủ',
                        'Cân nhắc melatonin 0.5-1mg, 30 phút trước giờ ngủ mục tiêu',
                        'Thương lượng giờ làm việc linh hoạt nếu có thể'
                    ] : [
                        'Tối đa hóa ánh sáng buổi sáng sớm',
                        'Tránh caffeine sau 12:00',
                        'Tạo môi trường tối hoàn toàn từ 20:00',
                        'Cân nhắc công việc phù hợp với chronotype'
                    ],
                    timeframe: '4-8 tuần'
                });
            }
            
            // Priority 5: General optimization
            personalizedRecs.push({
                priority: 5,
                title: '<i class="fas fa-bolt"></i> Tối ưu tổng thể',
                actions: [
                    'Duy trì lịch ngủ-thức cố định 7 ngày/tuần',
                    'Kiểm soát nhiệt độ phòng ngủ 16-19°C',
                    'Đầu tư vào rèm cản sáng chất lượng cao',
                    'Thiết lập không gian ngủ chỉ để ngủ và quan hệ tình dục'
                ],
                timeframe: 'Duy trì dài hạn'
            });
            
            // Render recommendations
            let html = '<h4 style="color: #1e293b; margin-bottom: 20px;"><i class="fas fa-bullseye"></i> Kế hoạch hành động cá nhân</h4>';
            
            personalizedRecs.forEach(rec => {
                const priorityColors = ['#dc2626', '#f59e0b', '#3b82f6', '#8b5cf6', '#10b981'];
                const priorityLabels = ['Khẩn cấp', 'Cao', 'Trung bình', 'Thấp', 'Duy trì'];
                
                html += `
                    <div style="margin-bottom: 20px; padding: 20px; background: linear-gradient(135deg, #f8fafc, #f1f5f9); border-radius: 12px; border-left: 4px solid ${priorityColors[rec.priority - 1]};">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <h3 style="color: #1e293b; margin: 0;">${rec.title}</h3>
                            <div style="display: flex; flex-direction: column; align-items: end;">
                                <span style="background: ${priorityColors[rec.priority - 1]}; color: white; padding: 4px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 600;">
                                    Ưu tiên ${priorityLabels[rec.priority - 1]}
                                </span>
                                <small style="color: #6b7280; margin-top: 4px;">${rec.timeframe}</small>
                            </div>
                        </div>
                        <ul style="list-style: none; padding: 0;">
                `;
                
                rec.actions.forEach((action, index) => {
                    html += `
                        <li style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 8px; padding: 8px; background: rgba(255, 255, 255, 0.7); border-radius: 6px;">
                            <span style="color: ${priorityColors[rec.priority - 1]}; font-weight: bold; margin-top: 2px;">${index + 1}.</span>
                            <span style="flex: 1; line-height: 1.5;">${action}</span>
                        </li>
                    `;
                });
                
                html += `
                        </ul>
                    </div>
                `;
            });
            
            document.getElementById('personalizedRecommendations').innerHTML = html;
        }

        // Add event listeners for weight/height inputs
        document.getElementById('height')?.addEventListener('input', updateStopBang);
        document.getElementById('weight')?.addEventListener('input', updateStopBang);

        // Update progress on page load
        document.getElementById('progressWeek').textContent = currentWeek;

        console.log('Sleep Optimizer Pro loaded successfully! 🌙✨');

        // Mobile menu toggle
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Update switchTab function to handle sidebar active state
        const originalSwitchTab = window.switchTab;
        window.switchTab = function(tabId) {
            // Call original function
            originalSwitchTab(tabId);

            // Update sidebar active state
            const sidebarButtons = document.querySelectorAll('.sidebar-menu button');
            sidebarButtons.forEach(btn => {
                const btnOnclick = btn.getAttribute('onclick');
                if (btnOnclick && btnOnclick.includes(tabId)) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });

            // Close mobile menu after selection
            if (window.innerWidth <= 768) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                if (sidebar) sidebar.classList.remove('active');
                if (overlay) overlay.classList.remove('active');
            }
        };
    </script>
                </div><!-- .content -->
            </div><!-- .container -->
        </main><!-- .main-content -->
    </div><!-- .main-wrapper -->

    <!-- Footer -->
    <footer class="bottom-footer">
        <p>Bản quyền 2025 Định Danh - <a href="https://dinhdanh.com" target="_blank">DINHDANH.COM</a></p>
    </footer>
</body>
</html>