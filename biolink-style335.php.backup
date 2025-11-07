<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Học Chứng Khoán Toàn Diện</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            line-height: 1.6;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            padding: 1rem 2rem;
            box-shadow: 0 4px 30px rgba(0,0,0,0.1);
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .header h1 {
            color: #2c3e50;
            text-align: center;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #3498db, #e74c3c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header .subtitle {
            text-align: center;
            color: #7f8c8d;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .main-nav {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .nav-btn {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.9rem;
            position: relative;
            overflow: hidden;
        }

        .nav-btn:hover, .nav-btn.active {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        .nav-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .nav-btn:hover::before {
            left: 100%;
        }

        .sub-nav {
            display: none;
            justify-content: center;
            gap: 0.3rem;
            flex-wrap: wrap;
            margin-top: 0.5rem;
        }

        .sub-nav.active {
            display: flex;
        }

        .sub-nav-btn {
            background: rgba(52, 152, 219, 0.8);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.8rem;
        }

        .sub-nav-btn:hover, .sub-nav-btn.active {
            background: rgba(231, 76, 60, 0.9);
            transform: scale(1.05);
        }

        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .content-section {
            display: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .content-section.active {
            display: block;
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        .section-title {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid #3498db;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 60px;
            height: 3px;
            background: #e74c3c;
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .content-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            border-left: 5px solid #3498db;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .content-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #e74c3c);
        }

        .content-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .card-title {
            color: #2c3e50;
            font-size: 1.4rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-icon {
            font-size: 1.5rem;
        }

        .highlight-box {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-left: 4px solid #28a745;
            padding: 1.5rem;
            margin: 1rem 0;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .warning-box {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border-left: 4px solid #ffc107;
            padding: 1.5rem;
            margin: 1rem 0;
            border-radius: 8px;
        }

        .danger-box {
            background: linear-gradient(135deg, #f8d7da, #fdcae1);
            border-left: 4px solid #dc3545;
            padding: 1.5rem;
            margin: 1rem 0;
            border-radius: 8px;
        }

        .formula-box {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 1.5rem;
            margin: 1rem 0;
            font-family: 'Courier New', monospace;
            text-align: center;
            font-size: 1.1rem;
        }

        .candlestick-canvas {
            border: 3px solid #ddd;
            border-radius: 15px;
            margin: 1rem 0;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .interactive-demo {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 1.5rem 0;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .demo-controls {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }

        .demo-controls label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        .demo-controls input, .demo-controls select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .demo-controls input:focus, .demo-controls select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .btn {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 0.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .btn:hover {
            background: linear-gradient(45deg, #2980b9, #1f639a);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        .btn-success {
            background: linear-gradient(45deg, #27ae60, #219a52);
        }

        .btn-danger {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
        }

        .btn-warning {
            background: linear-gradient(45deg, #f39c12, #e67e22);
        }

        .quiz-container {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 1.5rem 0;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .question {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #3498db;
        }

        .question h4 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .options {
            display: grid;
            gap: 0.8rem;
        }

        .option {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .option:hover {
            background: #e3f2fd;
            border-color: #3498db;
            transform: translateX(5px);
        }

        .option.selected {
            background: #3498db;
            color: white;
            border-color: #2980b9;
        }

        .option.correct {
            background: #27ae60;
            color: white;
            border-color: #219a52;
        }

        .option.incorrect {
            background: #e74c3c;
            color: white;
            border-color: #c0392b;
        }

        .score-display {
            background: linear-gradient(45deg, #27ae60, #219a52);
            color: white;
            padding: 1.5rem;
            border-radius: 15px;
            text-align: center;
            margin: 1.5rem 0;
            font-size: 1.3rem;
            font-weight: bold;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .reference-table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .reference-table th, .reference-table td {
            padding: 1.2rem;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        .reference-table th {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        .reference-table tr:hover {
            background: #f8f9fa;
        }

        .pattern-showcase {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .pattern-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .pattern-card:hover {
            transform: scale(1.05);
            border-color: #3498db;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .pattern-card h4 {
            margin: 1rem 0;
            color: #2c3e50;
        }

        .calculator-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .calculator {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            border-top: 4px solid #3498db;
        }

        .calculator h3 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .result {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-left: 4px solid #28a745;
            border-radius: 10px;
            padding: 1.5rem;
            margin: 1rem 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .tab {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 10px 10px 0 0;
            padding: 0.8rem 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .tab.active {
            background: #3498db;
            color: white;
            border-color: #2980b9;
        }

        .tab-content {
            display: none;
            background: white;
            border-radius: 0 15px 15px 15px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .tab-content.active {
            display: block;
        }

        .learning-path {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .learning-path h3 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .learning-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .learning-step {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .learning-step:hover {
            transform: translateY(-5px);
        }

        .step-number {
            background: white;
            color: #667eea;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 auto 1rem;
        }

        .progress-bar {
            background: #e9ecef;
            border-radius: 10px;
            height: 10px;
            overflow: hidden;
            margin: 1rem 0;
        }

        .progress-fill {
            background: linear-gradient(90deg, #28a745, #20c997);
            height: 100%;
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }
            
            .header h1 {
                font-size: 1.8rem;
            }
            
            .main-nav, .sub-nav {
                gap: 0.3rem;
            }
            
            .nav-btn, .sub-nav-btn {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
            }
            
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .calculator-grid {
                grid-template-columns: 1fr;
            }
            
            .demo-controls {
                grid-template-columns: 1fr;
            }
        }

        /* Dark mode toggle */
        .dark-mode-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            cursor: pointer;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .dark-mode-toggle:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <button class="dark-mode-toggle" onclick="toggleDarkMode()">🌙</button>
    
    <header class="header">
        <h1>🏛️ Hệ Thống Học Chứng Khoán Toàn Diện</h1>
        <p class="subtitle">Từ Cơ Bản Đến Chuyên Nghiệp - Dựa Trên Nghiên Cứu Chuyên Sâu</p>
        
        <nav class="main-nav">
            <button class="nav-btn active" onclick="showMainSection('overview')">🎯 Tổng Quan</button>
            <button class="nav-btn" onclick="showMainSection('fundamental')">📊 Phân Tích Cơ Bản</button>
            <button class="nav-btn" onclick="showMainSection('technical')">📈 Phân Tích Kỹ Thuật</button>
            <button class="nav-btn" onclick="showMainSection('candlestick')">🕯️ Biểu Đồ Nến</button>
            <button class="nav-btn" onclick="showMainSection('strategies')">🎯 Chiến Lược</button>
            <button class="nav-btn" onclick="showMainSection('tools')">🛠️ Công Cụ</button>
            <button class="nav-btn" onclick="showMainSection('quiz')">📝 Kiểm Tra</button>
            <button class="nav-btn" onclick="showMainSection('resources')">📚 Tài Nguyên</button>
        </nav>

        <!-- Sub Navigation -->
        <div id="overview-subnav" class="sub-nav active">
            <button class="sub-nav-btn active" onclick="showSubSection('overview', 'intro')">Giới Thiệu</button>
            <button class="sub-nav-btn" onclick="showSubSection('overview', 'comparison')">So Sánh FA vs TA</button>
            <button class="sub-nav-btn" onclick="showSubSection('overview', 'integration')">Tích Hợp</button>
        </div>

        <div id="fundamental-subnav" class="sub-nav">
            <button class="sub-nav-btn active" onclick="showSubSection('fundamental', 'buffett')">Warren Buffett</button>
            <button class="sub-nav-btn" onclick="showSubSection('fundamental', 'lynch')">Peter Lynch</button>
            <button class="sub-nav-btn" onclick="showSubSection('fundamental', 'valuation')">Định Giá</button>
            <button class="sub-nav-btn" onclick="showSubSection('fundamental', 'ratios')">Chỉ Số Tài Chính</button>
        </div>

        <div id="technical-subnav" class="sub-nav">
            <button class="sub-nav-btn active" onclick="showSubSection('technical', 'basics')">Cơ Bản</button>
            <button class="sub-nav-btn" onclick="showSubSection('technical', 'indicators')">Chỉ Báo</button>
            <button class="sub-nav-btn" onclick="showSubSection('technical', 'support-resistance')">Hỗ Trợ/Kháng Cự</button>
            <button class="sub-nav-btn" onclick="showSubSection('technical', 'volume')">Khối Lượng</button>
        </div>

        <div id="candlestick-subnav" class="sub-nav">
            <button class="sub-nav-btn active" onclick="showSubSection('candlestick', 'basics')">Cơ Bản</button>
            <button class="sub-nav-btn" onclick="showSubSection('candlestick', 'single')">Nến Đơn</button>
            <button class="sub-nav-btn" onclick="showSubSection('candlestick', 'double')">Nến Đôi</button>
            <button class="sub-nav-btn" onclick="showSubSection('candlestick', 'triple')">Nến Ba</button>
            <button class="sub-nav-btn" onclick="showSubSection('candlestick', 'advanced')">Nâng Cao</button>
        </div>

        <div id="strategies-subnav" class="sub-nav">
            <button class="sub-nav-btn active" onclick="showSubSection('strategies', 'sepa')">SEPA Method</button>
            <button class="sub-nav-btn" onclick="showSubSection('strategies', 'integrated')">Tích Hợp</button>
            <button class="sub-nav-btn" onclick="showSubSection('strategies', 'timing')">Market Timing</button>
            <button class="sub-nav-btn" onclick="showSubSection('strategies', 'risk')">Quản Trị Rủi Ro</button>
        </div>

        <div id="tools-subnav" class="sub-nav">
            <button class="sub-nav-btn active" onclick="showSubSection('tools', 'calculators')">Máy Tính</button>
            <button class="sub-nav-btn" onclick="showSubSection('tools', 'analyzers')">Phân Tích</button>
            <button class="sub-nav-btn" onclick="showSubSection('tools', 'simulators')">Mô Phỏng</button>
        </div>

        <div id="quiz-subnav" class="sub-nav">
            <button class="sub-nav-btn active" onclick="showSubSection('quiz', 'basic')">Cơ Bản</button>
            <button class="sub-nav-btn" onclick="showSubSection('quiz', 'advanced')">Nâng Cao</button>
            <button class="sub-nav-btn" onclick="showSubSection('quiz', 'comprehensive')">Tổng Hợp</button>
        </div>

        <div id="resources-subnav" class="sub-nav">
            <button class="sub-nav-btn active" onclick="showSubSection('resources', 'books')">Sách</button>
            <button class="sub-nav-btn" onclick="showSubSection('resources', 'websites')">Website</button>
            <button class="sub-nav-btn" onclick="showSubSection('resources', 'reference')">Tra Cứu</button>
        </div>
    </header>

    <div class="container">
        <!-- TỔNG QUAN -->
        <div id="overview" class="content-section active">
            <!-- Giới thiệu -->
            <div id="overview-intro" class="tab-content active">
                <h2 class="section-title">🎯 Giới Thiệu Hệ Thống</h2>
                
                <div class="learning-path">
                    <h3>🚀 Lộ Trình Học Tập Toàn Diện</h3>
                    <div class="learning-steps">
                        <div class="learning-step">
                            <div class="step-number">1</div>
                            <h4>Nền Tảng Tư Duy</h4>
                            <p>Hiểu rõ bản chất thị trường và hai trường phái phân tích chính</p>
                        </div>
                        <div class="learning-step">
                            <div class="step-number">2</div>
                            <h4>Phân Tích Cơ Bản</h4>
                            <p>Học các phương pháp định giá và triết lý đầu tư của các bậc thầy</p>
                        </div>
                        <div class="learning-step">
                            <div class="step-number">3</div>
                            <h4>Phân Tích Kỹ Thuật</h4>
                            <p>Làm chủ các chỉ báo, mẫu hình và công cụ phân tích biểu đồ</p>
                        </div>
                        <div class="learning-step">
                            <div class="step-number">4</div>
                            <h4>Biểu Đồ Nến Nhật</h4>
                            <p>Đọc và diễn giải tâm lý thị trường qua nghệ thuật nến Nhật</p>
                        </div>
                        <div class="learning-step">
                            <div class="step-number">5</div>
                            <h4>Chiến Lược Tích Hợp</h4>
                            <p>Kết hợp FA và TA để xây dựng hệ thống đầu tư hoàn chỉnh</p>
                        </div>
                        <div class="learning-step">
                            <div class="step-number">6</div>
                            <h4>Thực Hành</h4>
                            <p>Áp dụng kiến thức vào phân tích thực tế thị trường Việt Nam</p>
                        </div>
                    </div>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            Mục Tiêu Học Tập
                        </h3>
                        <ul>
                            <li><strong>Hiểu bản chất:</strong> Nắm vững nguyên lý hoạt động của thị trường chứng khoán</li>
                            <li><strong>Phân tích đa chiều:</strong> Kết hợp FA và TA một cách hiệu quả</li>
                            <li><strong>Quản trị rủi ro:</strong> Xây dựng hệ thống quản lý vốn và rủi ro</li>
                            <li><strong>Tư duy độc lập:</strong> Phát triển khả năng phân tích và ra quyết định</li>
                            <li><strong>Ứng dụng thực tế:</strong> Áp dụng vào thị trường Việt Nam</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📋</span>
                            Nội Dung Chương Trình
                        </h3>
                        <ul>
                            <li><strong>200+ khái niệm:</strong> Từ cơ bản đến chuyên sâu</li>
                            <li><strong>50+ mô hình nến:</strong> Với minh họa trực quan</li>
                            <li><strong>30+ chỉ báo kỹ thuật:</strong> Công thức và cách sử dụng</li>
                            <li><strong>100+ câu hỏi:</strong> Trắc nghiệm đa cấp độ</li>
                            <li><strong>20+ công cụ:</strong> Máy tính và phân tích tự động</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🏆</span>
                            Điểm Nổi Bật
                        </h3>
                        <ul>
                            <li><strong>Dựa trên nghiên cứu:</strong> Tổng hợp từ hai báo cáo chuyên sâu</li>
                            <li><strong>Tương tác cao:</strong> Biểu đồ, công cụ, mô phỏng</li>
                            <li><strong>Cập nhật liên tục:</strong> Theo xu hướng thị trường</li>
                            <li><strong>Phù hợp mọi trình độ:</strong> Từ mới bắt đầu đến chuyên nghiệp</li>
                            <li><strong>Thực tế Việt Nam:</strong> Ví dụ cụ thể về VN-Index</li>
                        </ul>
                    </div>
                </div>

                <div class="highlight-box">
                    <h4>💡 Triết Lý Học Tập</h4>
                    <p>Đầu tư thành công không phải là may mắn mà là kết quả của kiến thức, kỷ luật và kinh nghiệm. Hệ thống này sẽ trang bị cho bạn những công cụ cần thiết để trở thành một nhà đầu tư có hệ thống và chuyên nghiệp.</p>
                </div>
            </div>

            <!-- So sánh FA vs TA -->
            <div id="overview-comparison" class="tab-content">
                <h2 class="section-title">⚖️ So Sánh Phân Tích Cơ Bản vs Kỹ Thuật</h2>
                
                <div class="highlight-box">
                    <h4>🔑 Điểm Quan Trọng</h4>
                    <p>FA và TA không phải là hai phương pháp đối lập mà là hai lăng kính bổ trợ nhau. FA giúp trả lời <strong>"NÊN MUA GÌ?"</strong> còn TA giúp trả lời <strong>"KHI NÀO NÊN MUA?"</strong></p>
                </div>

                <table class="reference-table">
                    <thead>
                        <tr>
                            <th>Tiêu Chí</th>
                            <th>Phân Tích Cơ Bản (FA)</th>
                            <th>Phân Tích Kỹ Thuật (TA)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Mục tiêu</strong></td>
                            <td>Xác định giá trị nội tại, trả lời "Nên mua cái gì?"</td>
                            <td>Xác định xu hướng và thời điểm, trả lời "Khi nào nên mua/bán?"</td>
                        </tr>
                        <tr>
                            <td><strong>Đối tượng</strong></td>
                            <td>Nhà đầu tư dài hạn</td>
                            <td>Nhà đầu tư ngắn hạn, trader</td>
                        </tr>
                        <tr>
                            <td><strong>Dữ liệu</strong></td>
                            <td>Báo cáo tài chính, kinh tế vĩ mô, phân tích ngành</td>
                            <td>Dữ liệu giá, khối lượng, chỉ báo kỹ thuật</td>
                        </tr>
                        <tr>
                            <td><strong>Công cụ</strong></td>
                            <td>P/E, P/B, DCF, ROE, ROIC</td>
                            <td>MA, RSI, MACD, Bollinger Bands, Fibonacci</td>
                        </tr>
                        <tr>
                            <td><strong>Triết lý</strong></td>
                            <td>Giá thị trường sẽ hội tụ về giá trị nội tại theo thời gian</td>
                            <td>Lịch sử có xu hướng lặp lại, tâm lý đám đông tạo mẫu hình</td>
                        </tr>
                        <tr>
                            <td><strong>Khung thời gian</strong></td>
                            <td>Tháng, quý, năm</td>
                            <td>Phút, giờ, ngày, tuần</td>
                        </tr>
                        <tr>
                            <td><strong>Ưu điểm</strong></td>
                            <td>Hiểu sâu DN, phù hợp vốn lớn, ít căng thẳng</td>
                            <td>Nhanh chóng, xác định điểm vào/ra, áp dụng nhiều tài sản</td>
                        </tr>
                        <tr>
                            <td><strong>Nhược điểm</strong></td>
                            <td>Tốn thời gian, bỏ qua tâm lý thị trường</td>
                            <td>Có thể bị "nhiễu", tín hiệu giả, cần kỷ luật cao</td>
                        </tr>
                    </tbody>
                </table>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📊</span>
                            Phân Tích Cơ Bản (FA)
                        </h3>
                        <h4>🎯 Nguyên tắc cốt lõi:</h4>
                        <ul>
                            <li><strong>Giá trị nội tại:</strong> Mọi cổ phiếu đều có một giá trị thực</li>
                            <li><strong>Hiệu quả thị trường:</strong> Giá sẽ hội tụ về giá trị thực theo thời gian</li>
                            <li><strong>Biên an toàn:</strong> Mua với giá thấp hơn giá trị thực</li>
                        </ul>
                        
                        <h4>🔍 Quy trình phân tích:</h4>
                        <ol>
                            <li>Phân tích kinh tế vĩ mô</li>
                            <li>Phân tích ngành</li>
                            <li>Phân tích doanh nghiệp</li>
                            <li>Định giá và so sánh với giá thị trường</li>
                        </ol>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📈</span>
                            Phân Tích Kỹ Thuật (TA)
                        </h3>
                        <h4>🎯 Nguyên tắc cốt lõi:</h4>
                        <ul>
                            <li><strong>Giá phản ánh tất cả:</strong> Mọi thông tin đã có trong giá</li>
                            <li><strong>Giá có xu hướng:</strong> Di chuyển theo các xu hướng rõ ràng</li>
                            <li><strong>Lịch sử lặp lại:</strong> Các mẫu hình có xu hướng lặp lại</li>
                        </ul>
                        
                        <h4>🔍 Quy trình phân tích:</h4>
                        <ol>
                            <li>Xác định xu hướng chính</li>
                            <li>Tìm ngưỡng hỗ trợ/kháng cự</li>
                            <li>Phân tích mẫu hình giá</li>
                            <li>Xác nhận bằng chỉ báo và khối lượng</li>
                        </ol>
                    </div>
                </div>

                <div class="warning-box">
                    <h4>⚠️ Sai Lầm Thường Gặp</h4>
                    <ul>
                        <li><strong>Chỉ dùng một phương pháp:</strong> Bỏ qua sức mạnh của việc kết hợp</li>
                        <li><strong>Quá tin vào một tín hiệu:</strong> Không xác nhận bằng nhiều nguồn</li>
                        <li><strong>Bỏ qua quản trị rủi ro:</strong> Tập trung quá nhiều vào lợi nhuận</li>
                        <li><strong>Thiếu kiên nhẫn:</strong> Muốn kiếm tiền nhanh chóng</li>
                    </ul>
                </div>
            </div>

            <!-- Tích hợp -->
            <div id="overview-integration" class="tab-content">
                <h2 class="section-title">🔄 Tích Hợp FA và TA</h2>
                
                <div class="highlight-box">
                    <h4>🎯 Quy Trình Đầu Tư Tích Hợp 4 Bước</h4>
                    <p>Một phương pháp tiếp cận hiệu quả là đi từ vĩ mô đến vi mô, từ cơ bản đến kỹ thuật.</p>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🌍</span>
                            Bước 1: Phân Tích Vĩ Mô & Ngành (FA)
                        </h3>
                        <h4>🔍 Đánh giá bức tranh toàn cảnh:</h4>
                        <ul>
                            <li><strong>Kinh tế vĩ mô:</strong> GDP, lạm phát, lãi suất, chính sách</li>
                            <li><strong>Phân tích ngành:</strong> Chu kỳ, tiềm năng tăng trưởng</li>
                            <li><strong>Yếu tố địa chính trị:</strong> Chính sách, quy định mới</li>
                        </ul>
                        
                        <div class="formula-box">
                            <strong>Mục tiêu:</strong> Xác định các ngành "màu mỡ" nhất
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🏢</span>
                            Bước 2: Sàng Lọc Doanh Nghiệp (FA)
                        </h3>
                        <h4>🎯 Tìm "quán quân" trong ngành:</h4>
                        <ul>
                            <li><strong>Chỉ số Buffett:</strong> ROE cao, D/E thấp, "con hào kinh tế"</li>
                            <li><strong>Tiêu chí Minervini:</strong> Tăng trưởng doanh thu và lợi nhuận</li>
                            <li><strong>Phân tích Lynch:</strong> Doanh nghiệp bạn hiểu rõ</li>
                        </ul>
                        
                        <div class="formula-box">
                            <strong>Kết quả:</strong> Danh sách theo dõi (Watchlist)
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📈</span>
                            Bước 3: Phân Tích Xu Hướng (TA)
                        </h3>
                        <h4>📊 Đánh giá xu hướng cổ phiếu:</h4>
                        <ul>
                            <li><strong>Giai đoạn 2:</strong> Cổ phiếu trong xu hướng tăng mạnh</li>
                            <li><strong>Vị trí MA:</strong> Giá trên MA20, MA50, MA200</li>
                            <li><strong>Sắp xếp MA:</strong> MA20 > MA50 > MA200</li>
                        </ul>
                        
                        <div class="formula-box">
                            <strong>Loại bỏ:</strong> Cổ phiếu trong xu hướng giảm/đi ngang
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">⏰</span>
                            Bước 4: Xác Định Thời Điểm (TA)
                        </h3>
                        <h4>🎯 Tìm điểm vào tối ưu:</h4>
                        <ul>
                            <li><strong>Mẫu hình VCP:</strong> Volatility Contraction Pattern</li>
                            <li><strong>Khối lượng cạn:</strong> Trong nền giá tích lũy</li>
                            <li><strong>Điểm Pivot:</strong> Phá vỡ với khối lượng lớn</li>
                        </ul>
                        
                        <div class="formula-box">
                            <strong>Hành động:</strong> Vào lệnh với Stop-loss chặt chẽ
                        </div>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🧮 Ví Dụ Thực Tế: Cổ Phiếu BSI (2022-2023)</h3>
                    
                    <div class="tabs">
                        <div class="tab active" onclick="showTab('bsi-step1')">Bước 1: Vĩ Mô</div>
                        <div class="tab" onclick="showTab('bsi-step2')">Bước 2: Doanh Nghiệp</div>
                        <div class="tab" onclick="showTab('bsi-step3')">Bước 3: Xu Hướng</div>
                        <div class="tab" onclick="showTab('bsi-step4')">Bước 4: Thời Điểm</div>
                    </div>

                    <div id="bsi-step1" class="tab-content active">
                        <h4>🌍 Phân Tích Vĩ Mô & Ngành (Cuối 2022)</h4>
                        <ul>
                            <li><strong>Bối cảnh:</strong> Thị trường chứng khoán VN bắt đầu có dấu hiệu hồi phục</li>
                            <li><strong>Lãi suất:</strong> Có xu hướng hạ nhiệt</li>
                            <li><strong>Thanh khoản:</strong> Kỳ vọng thị trường sôi động trở lại</li>
                            <li><strong>Ngành chứng khoán:</strong> Hưởng lợi trực tiếp từ thanh khoản tăng</li>
                        </ul>
                        <div class="result">
                            <strong>Kết luận:</strong> Ngành chứng khoán có tiềm năng phục hồi tốt
                        </div>
                    </div>

                    <div id="bsi-step2" class="tab-content">
                        <h4>🏢 Phân Tích BSI</h4>
                        <ul>
                            <li><strong>Thị phần:</strong> Công ty chứng khoán có thị phần tốt</li>
                            <li><strong>Hiệu quả:</strong> Kết quả kinh doanh có tăng trưởng</li>
                            <li><strong>Mô hình:</strong> Hưởng lợi trực tiếp từ thanh khoản thị trường</li>
                            <li><strong>Quản trị:</strong> Đội ngũ quản lý có kinh nghiệm</li>
                        </ul>
                        <div class="result">
                            <strong>Kết luận:</strong> BSI đủ tiêu chuẩn đưa vào watchlist
                        </div>
                    </div>

                    <div id="bsi-step3" class="tab-content">
                        <h4>📈 Phân Tích Xu Hướng BSI</h4>
                        <ul>
                            <li><strong>Tạo đáy:</strong> Sau giai đoạn giảm với thị trường chung</li>
                            <li><strong>Giai đoạn 2:</strong> Bước vào xu hướng tăng mạnh</li>
                            <li><strong>Vị trí MA:</strong> Giá vượt MA50, MA150, MA200</li>
                            <li><strong>Sắp xếp MA:</strong> Các đường MA bắt đầu dốc lên đúng thứ tự</li>
                        </ul>
                        <div class="result">
                            <strong>Kết luận:</strong> BSI trong xu hướng tăng bền vững
                        </div>
                    </div>

                    <div id="bsi-step4" class="tab-content">
                        <h4>⏰ Xác Định Thời Điểm Mua BSI</h4>
                        <ul>
                            <li><strong>Mẫu hình VCP:</strong> Các đợt điều chỉnh có biên độ thu hẹp</li>
                            <li><strong>Khối lượng:</strong> Giảm sút trong các đợt điều chỉnh</li>
                            <li><strong>Điểm Pivot:</strong> Phá vỡ nền giá với khối lượng tăng vọt</li>
                            <li><strong>Xác nhận:</strong> Dòng tiền lớn tham gia</li>
                        </ul>
                        <div class="result">
                            <strong>Kết quả:</strong> Tín hiệu mua mạnh → Con sóng tăng giá tiếp theo
                        </div>
                    </div>
                </div>

                <div class="danger-box">
                    <h4>🚨 Lưu Ý Quan Trọng</h4>
                    <ul>
                        <li><strong>Không bao giờ 100%:</strong> Luôn có rủi ro trong đầu tư</li>
                        <li><strong>Quản trị rủi ro:</strong> Stop-loss luôn được đặt trước</li>
                        <li><strong>Kỷ luật giao dịch:</strong> Tuân thủ kế hoạch đã đặt ra</li>
                        <li><strong>Học hỏi liên tục:</strong> Rút kinh nghiệm từ mỗi giao dịch</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- PHÂN TÍCH CỞ BẢN -->
        <div id="fundamental" class="content-section">
            <!-- Warren Buffett -->
            <div id="fundamental-buffett" class="tab-content active">
                <h2 class="section-title">🏆 Triết Lý Warren Buffett</h2>
                
                <div class="highlight-box">
                    <h4>💡 Triết Lý Cốt Lõi</h4>
                    <p><em>"Mua doanh nghiệp, không phải cổ phiếu"</em> - Warren Buffett không quan tâm đến biến động giá ngắn hạn mà tập trung vào tiềm năng phát triển bền vững của công ty trong nhiều năm tới.</p>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            Vòng Tròn Năng Lực
                        </h3>
                        <p><strong>Nguyên tắc:</strong> Chỉ đầu tư vào những doanh nghiệp mà bạn thực sự hiểu rõ mô hình kinh doanh.</p>
                        
                        <h4>🔍 Cách áp dụng:</h4>
                        <ul>
                            <li><strong>Ngành quen thuộc:</strong> Đầu tư vào ngành bạn làm việc</li>
                            <li><strong>Sản phẩm hiểu rõ:</strong> Công ty có sản phẩm bạn sử dụng</li>
                            <li><strong>Mô hình đơn giản:</strong> Tránh những DN quá phức tạp</li>
                            <li><strong>Tương lai dự đoán được:</strong> Ngành ít thay đổi đột ngột</li>
                        </ul>
                        
                        <div class="warning-box">
                            <strong>⚠️ Tránh:</strong> Công nghệ phức tạp, ngành mới nổi không hiểu rõ
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🏰</span>
                            Con Hào Kinh Tế (Economic Moat)
                        </h3>
                        <p><strong>Định nghĩa:</strong> Lợi thế cạnh tranh bền vững giúp bảo vệ lợi nhuận và thị phần.</p>
                        
                        <h4>🛡️ Các loại "hào" chính:</h4>
                        <ul>
                            <li><strong>Tài sản vô hình:</strong> Thương hiệu mạnh (Coca-Cola), bằng sáng chế</li>
                            <li><strong>Chi phí chuyển đổi cao:</strong> Khó chuyển sang đối thủ (Microsoft Windows)</li>
                            <li><strong>Hiệu ứng mạng lưới:</strong> Giá trị tăng theo số người dùng (Facebook)</li>
                            <li><strong>Lợi thế chi phí:</strong> Sản xuất rẻ hơn đối thủ đáng kể</li>
                            <li><strong>Quy mô kinh tế:</strong> Càng lớn càng hiệu quả</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Kiểm tra:</strong> Công ty có thể tăng giá mà không mất khách hàng?
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">💎</span>
                            Giá Trị Nội Tại
                        </h3>
                        <p><strong>Khái niệm:</strong> Tổng giá trị các dòng tiền mà doanh nghiệp có thể tạo ra trong suốt vòng đời, được chiết khấu về hiện tại.</p>
                        
                        <div class="formula-box">
                            Giá trị Nội tại = Σ (Dòng tiền năm n / (1 + r)^n)
                            <br><small>r = Tỷ suất chiết khấu phù hợp</small>
                        </div>
                        
                        <h4>🔢 Các phương pháp tính:</h4>
                        <ul>
                            <li><strong>DCF (Discounted Cash Flow):</strong> Chiết khấu dòng tiền tự do</li>
                            <li><strong>P/E Ratio:</strong> So sánh với các công ty tương tự</li>
                            <li><strong>P/B Ratio:</strong> Giá trị sổ sách điều chỉnh</li>
                            <li><strong>Dividend Discount Model:</strong> Chiết khấu cổ tức</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🛡️</span>
                            Biên An Toàn (Margin of Safety)
                        </h3>
                        <p><strong>Nguyên tắc:</strong> Chỉ mua khi giá thị trường thấp hơn đáng kể so với giá trị nội tại.</p>
                        
                        <div class="formula-box">
                            Biên An toàn = (Giá trị Nội tại - Giá Thị trường) / Giá trị Nội tại
                            <br><small>Tối thiểu: 20-30%, Lý tưởng: 40-50%</small>
                        </div>
                        
                        <h4>🎯 Lợi ích:</h4>
                        <ul>
                            <li><strong>Bảo vệ rủi ro:</strong> Đệm cho sai lầm trong phân tích</li>
                            <li><strong>Tâm lý vững vàng:</strong> Ít lo lắng khi giá biến động</li>
                            <li><strong>Lợi nhuận cao:</strong> Mua rẻ, bán đúng giá</li>
                            <li><strong>Thời gian làm việc:</strong> Càng giữ lâu càng có lợi</li>
                        </ul>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🧮 Máy Tính Đánh Giá Theo Buffett</h3>
                    <div class="demo-controls">
                        <div>
                            <label>ROE (%)</label>
                            <input type="number" id="buffett-roe" placeholder="Tỷ suất sinh lợi trên vốn CSH">
                        </div>
                        <div>
                            <label>Tỷ lệ Nợ/Vốn CSH</label>
                            <input type="number" id="buffett-debt" placeholder="Debt to Equity Ratio">
                        </div>
                        <div>
                            <label>Tăng trưởng Lợi nhuận (%)</label>
                            <input type="number" id="buffett-growth" placeholder="Tốc độ tăng trưởng hàng năm">
                        </div>
                        <div>
                            <label>P/E Ratio</label>
                            <input type="number" id="buffett-pe" placeholder="Price to Earnings">
                        </div>
                    </div>
                    <button class="btn" onclick="evaluateBuffettStyle()">Đánh Giá Theo Buffett</button>
                    <div id="buffett-result" class="result" style="display: none;"></div>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📊</span>
                            Chỉ Số Tài Chính Ưa Thích
                        </h3>
                        
                        <h4>🎯 ROE (Return on Equity):</h4>
                        <div class="formula-box">
                            ROE = Lợi nhuận ròng / Vốn chủ sở hữu × 100%
                        </div>
                        <ul>
                            <li><strong>Buffett yêu thích:</strong> ROE > 15% ổn định qua nhiều năm</li>
                            <li><strong>Ý nghĩa:</strong> Hiệu quả sử dụng vốn của cổ đông</li>
                        </ul>
                        
                        <h4>🎯 Tỷ lệ Nợ/Vốn CSH:</h4>
                        <div class="formula-box">
                            D/E = Tổng nợ / Vốn chủ sở hữu
                        </div>
                        <ul>
                            <li><strong>Buffett ưa thích:</strong> D/E < 0.5 (trừ ngân hàng)</li>
                            <li><strong>Ý nghĩa:</strong> Công ty ít phụ thuộc vào nợ vay</li>
                        </ul>
                        
                        <h4>🎯 Biên Lợi nhuận:</h4>
                        <div class="formula-box">
                            Net Margin = Lợi nhuận ròng / Doanh thu × 100%
                        </div>
                        <ul>
                            <li><strong>Buffett tìm kiếm:</strong> Biên lợi nhuận ổn định và tăng dần</li>
                            <li><strong>Ý nghĩa:</strong> Khả năng kiểm soát chi phí và định giá</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">⚠️</span>
                            Những Điều Buffett Tránh
                        </h3>
                        
                        <h4>🚫 Loại công ty tránh:</h4>
                        <ul>
                            <li><strong>Công nghệ thay đổi nhanh:</strong> Khó dự đoán tương lai</li>
                            <li><strong>Ngành chu kỳ mạnh:</strong> Lợi nhuận không ổn định</li>
                            <li><strong>Nợ nần quá nhiều:</strong> Rủi ro tài chính cao</li>
                            <li><strong>Quản lý kém:</strong> Thiếu minh bạch, đạo đức</li>
                        </ul>
                        
                        <h4>🚫 Sai lầm về tâm lý:</h4>
                        <ul>
                            <li><strong>Theo đám đông:</strong> Mua khi giá cao do hype</li>
                            <li><strong>Bán hoảng loạn:</strong> Bán khi thị trường sụp đổ</li>
                            <li><strong>Thiếu kiên nhẫn:</strong> Muốn kiếm tiền nhanh</li>
                            <li><strong>Quá đa dạng hóa:</strong> Pha loãng lợi nhuận từ ý tưởng tốt</li>
                        </ul>
                    </div>
                </div>

                <div class="highlight-box">
                    <h4>🎓 Bài Học Từ Buffett</h4>
                    <ul>
                        <li><strong>"Hãy sợ hãi khi người khác tham lam, và tham lam khi người khác sợ hãi"</strong></li>
                        <li><strong>"Thời gian là bạn của doanh nghiệp tuyệt vời và là kẻ thù của doanh nghiệp tầm thường"</strong></li>
                        <li><strong>"Tốt hơn là mua một công ty tuyệt vời với giá hợp lý hơn là mua một công ty hợp lý với giá tuyệt vời"</strong></li>
                        <li><strong>"Đầu tư thành công cần thời gian, kỷ luật và kiên nhẫn"</strong></li>
                    </ul>
                </div>
            </div>

            <!-- Peter Lynch -->
            <div id="fundamental-lynch" class="tab-content">
                <h2 class="section-title">🎯 Triết Lý Peter Lynch</h2>
                
                <div class="highlight-box">
                    <h4>💡 Nguyên Tắc Cốt Lõi</h4>
                    <p><em>"Đầu tư vào những gì bạn biết"</em> - Peter Lynch tin rằng các nhà đầu tư cá nhân có lợi thế lớn nhờ kiến thức và kinh nghiệm từ cuộc sống hàng ngày.</p>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🧠</span>
                            Lợi Thế Của Nhà Đầu Tư Cá Nhân
                        </h3>
                        
                        <h4>🎯 Kiến thức từ cuộc sống:</h4>
                        <ul>
                            <li><strong>Công việc:</strong> Hiểu rõ ngành nghề mình làm</li>
                            <li><strong>Tiêu dùng:</strong> Nhận ra sản phẩm/dịch vụ tốt</li>
                            <li><strong>Quan sát:</strong> Phát hiện xu hướng từ sớm</li>
                            <li><strong>Địa phương:</strong> Biết công ty trong khu vực</li>
                        </ul>
                        
                        <h4>🔍 Cách phát hiện cơ hội:</h4>
                        <ul>
                            <li><strong>Cửa hàng đông khách:</strong> Doanh thu tăng mạnh</li>
                            <li><strong>Sản phẩm mới hay:</strong> Tiềm năng bùng nổ</li>
                            <li><strong>Công ty mở rộng:</strong> Tăng trưởng bền vững</li>
                            <li><strong>Ngành "nhàm chán":</strong> Ít cạnh tranh, ổn định</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Ví dụ:</strong> Lynch phát hiện Dunkin' Donuts từ việc thấy cửa hàng luôn đông khách
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📚</span>
                            Nghiên Cứu Kỹ Lưỡng
                        </h3>
                        
                        <p><strong>Quan trọng:</strong> "Đầu tư vào những gì bạn biết" không có nghĩa là mua ngay mà phải nghiên cứu sâu.</p>
                        
                        <h4>📋 Checklist nghiên cứu:</h4>
                        <ol>
                            <li><strong>Đọc báo cáo thường niên:</strong> Hiểu mô hình kinh doanh</li>
                            <li><strong>Phân tích tài chính:</strong> Doanh thu, lợi nhuận, nợ</li>
                            <li><strong>So sánh đối thủ:</strong> Vị thế cạnh tranh</li>
                            <li><strong>Triển vọng ngành:</strong> Tăng trưởng dài hạn</li>
                            <li><strong>Quản lý:</strong> Năng lực và uy tín</li>
                        </ol>
                        
                        <div class="warning-box">
                            <strong>⚠️ Cảnh báo:</strong> Thích sản phẩm ≠ Đầu tư ngay lập tức
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📈</span>
                            Phân Loại Cổ Phiếu Lynch
                        </h3>
                        
                        <h4>🚀 Slow Growers (Tăng trưởng chậm):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Công ty lớn, tăng trưởng 2-4%/năm</li>
                            <li><strong>Ưu điểm:</strong> Ổn định, cổ tức cao</li>
                            <li><strong>Nhược điểm:</strong> Lợi nhuận thấp</li>
                            <li><strong>Ví dụ:</strong> Utilities, telecommunications</li>
                        </ul>
                        
                        <h4>🏃 Stalwarts (Ổn định):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Tăng trưởng 10-12%/năm</li>
                            <li><strong>Ưu điểm:</strong> Cân bằng tăng trưởng và ổn định</li>
                            <li><strong>Chiến lược:</strong> Mua khi P/E thấp, bán khi cao</li>
                            <li><strong>Ví dụ:</strong> Coca-Cola, Procter & Gamble</li>
                        </ul>
                        
                        <h4>💎 Fast Growers (Tăng trưởng nhanh):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Tăng trưởng 20-25%/năm</li>
                            <li><strong>Tiềm năng:</strong> Lợi nhuận cực cao</li>
                            <li><strong>Rủi ro:</strong> Biến động mạnh</li>
                            <li><strong>Lưu ý:</strong> Theo dõi kỹ để bán khi tăng trưởng chậm lại</li>
                        </ul>
                        
                        <h4>🔄 Cyclicals (Chu kỳ):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Phụ thuộc chu kỳ kinh tế</li>
                            <li><strong>Chiến lược:</strong> Mua đáy chu kỳ, bán đỉnh chu kỳ</li>
                            <li><strong>Khó khăn:</strong> Timing rất quan trọng</li>
                            <li><strong>Ví dụ:</strong> Ô tô, thép, bất động sản</li>
                        </ul>
                        
                        <h4>🔄 Turnarounds (Xoay chuyển):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Công ty khó khăn đang phục hồi</li>
                            <li><strong>Tiềm năng:</strong> Lợi nhuận rất cao nếu thành công</li>
                            <li><strong>Rủi ro:</strong> Có thể phá sản</li>
                            <li><strong>Chỉ dành cho:</strong> Nhà đầu tư có kinh nghiệm</li>
                        </ul>
                        
                        <h4>💰 Asset Plays (Tài sản):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Có tài sản có giá trị cao</li>
                            <li><strong>Ví dụ:</strong> Đất đai, tài nguyên khoáng sản</li>
                            <li><strong>Lưu ý:</strong> Cần định giá chính xác tài sản</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            Chiến Lược Đầu Tư
                        </h3>
                        
                        <h4>📊 Tỷ lệ PEG (Price/Earnings to Growth):</h4>
                        <div class="formula-box">
                            PEG = P/E Ratio / Tốc độ tăng trưởng lợi nhuận
                        </div>
                        <ul>
                            <li><strong>PEG < 1:</strong> Có thể là cơ hội tốt</li>
                            <li><strong>PEG = 1:</strong> Định giá hợp lý</li>
                            <li><strong>PEG > 1:</strong> Có thể đắt, cần thận trọng</li>
                        </ul>
                        
                        <h4>🔍 Dấu hiệu tích cực:</h4>
                        <ul>
                            <li><strong>Quỹ đầu tư bán:</strong> Tạo áp lực bán không hợp lý</li>
                            <li><strong>Ngành "nhàm chán":</strong> Ít được chú ý</li>
                            <li><strong>Mở rộng cửa hàng:</strong> Tăng trưởng thực tế</li>
                            <li><strong>Mua lại cổ phiếu:</strong> Quản lý tin tưởng vào công ty</li>
                        </ul>
                        
                        <h4>🚩 Dấu hiệu cảnh báo:</h4>
                        <ul>
                            <li><strong>Đa dạng hóa vào ngành khác:</strong> Mất tập trung</li>
                            <li><strong>P/E quá cao:</strong> Kỳ vọng phi thực tế</li>
                            <li><strong>Tăng trưởng chậm lại:</strong> Đối với Fast Growers</li>
                            <li><strong>Quản lý thay đổi thường xuyên:</strong> Thiếu ổn định</li>
                        </ul>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🧮 Máy Tính PEG Ratio</h3>
                    <div class="demo-controls">
                        <div>
                            <label>P/E Ratio</label>
                            <input type="number" id="lynch-pe" placeholder="Price to Earnings">
                        </div>
                        <div>
                            <label>Tốc độ tăng trưởng (%)</label>
                            <input type="number" id="lynch-growth" placeholder="Tăng trưởng lợi nhuận hàng năm">
                        </div>
                        <div>
                            <label>Loại cổ phiếu</label>
                            <select id="lynch-type">
                                <option value="slow">Slow Growers</option>
                                <option value="stalwart">Stalwarts</option>
                                <option value="fast">Fast Growers</option>
                                <option value="cyclical">Cyclicals</option>
                                <option value="turnaround">Turnarounds</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn" onclick="calculatePEG()">Tính PEG & Đánh Giá</button>
                    <div id="peg-result" class="result" style="display: none;"></div>
                </div>

                <div class="highlight-box">
                    <h4>🎓 21 Nguyên Tắc Vàng của Lynch</h4>
                    <ol>
                        <li><strong>Đầu tư vào những gì bạn biết</strong> - và chỉ khi bạn thực sự hiểu</li>
                        <li><strong>Nghiên cứu trước khi đầu tư</strong> - không bao giờ mua theo cảm tính</li>
                        <li><strong>Không dự đoán thị trường</strong> - tập trung vào công ty cụ thể</li>
                        <li><strong>Thời gian đứng về phía bạn</strong> - đối với công ty tốt</li>
                        <li><strong>Tìm công ty trong ngành nhàm chán</strong> - ít cạnh tranh hơn</li>
                    </ol>
                    <p><em>... và 16 nguyên tắc khác được Lynch đúc kết từ hơn 40 năm kinh nghiệm!</em></p>
                </div>
            </div>

            <!-- Định giá -->
            <div id="fundamental-valuation" class="tab-content">
                <h2 class="section-title">💰 Phương Pháp Định Giá Doanh Nghiệp</h2>
                
                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">💸</span>
                            DCF - Chiết Khấu Dòng Tiền
                        </h3>
                        
                        <p><strong>Nguyên lý:</strong> Giá trị doanh nghiệp = Tổng hiện giá các dòng tiền tương lai</p>
                        
                        <div class="formula-box">
                            DCF = CF₁/(1+r)¹ + CF₂/(1+r)² + ... + TV/(1+r)ⁿ
                            <br><small>CF = Cash Flow, r = Discount Rate, TV = Terminal Value</small>
                        </div>
                        
                        <h4>📋 Các bước thực hiện:</h4>
                        <ol>
                            <li><strong>Dự báo FCF:</strong> Free Cash Flow 5-10 năm tới</li>
                            <li><strong>Tính tỷ suất chiết khấu:</strong> WACC hoặc Cost of Equity</li>
                            <li><strong>Giá trị cuối kỳ:</strong> Terminal Value (Gordon Growth Model)</li>
                            <li><strong>Tính hiện giá:</strong> Chiết khấu tất cả về hiện tại</li>
                            <li><strong>Giá trị mỗi cổ phiếu:</strong> Chia cho số cổ phiếu lưu hành</li>
                        </ol>
                        
                        <h4>⚖️ Ưu nhược điểm:</h4>
                        <ul>
                            <li><strong>✅ Ưu điểm:</strong> Cơ sở lý thuyết vững chắc, tính đến tương lai</li>
                            <li><strong>❌ Nhược điểm:</strong> Phụ thuộc nhiều vào dự báo, nhạy cảm với giả định</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔢</span>
                            P/E - Price to Earnings
                        </h3>
                        
                        <div class="formula-box">
                            P/E = Giá cổ phiếu / EPS (Earnings Per Share)
                        </div>
                        
                        <h4>📊 Các loại P/E:</h4>
                        <ul>
                            <li><strong>Trailing P/E:</strong> Dựa trên EPS 12 tháng qua</li>
                            <li><strong>Forward P/E:</strong> Dựa trên EPS dự báo 12 tháng tới</li>
                            <li><strong>Adjusted P/E:</strong> Loại bỏ các khoản bất thường</li>
                        </ul>
                        
                        <h4>🎯 Cách sử dụng:</h4>
                        <ul>
                            <li><strong>So sánh ngành:</strong> P/E so với trung bình ngành</li>
                            <li><strong>So sánh lịch sử:</strong> P/E hiện tại vs quá khứ</li>
                            <li><strong>PEG Ratio:</strong> P/E điều chỉnh theo tăng trưởng</li>
                        </ul>
                        
                        <div class="warning-box">
                            <strong>⚠️ Hạn chế:</strong> Không phù hợp với công ty lỗ, không tính đến nợ
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📚</span>
                            P/B - Price to Book
                        </h3>
                        
                        <div class="formula-box">
                            P/B = Giá cổ phiếu / BVPS (Book Value Per Share)
                        </div>
                        
                        <h4>💡 Ý nghĩa:</h4>
                        <ul>
                            <li><strong>P/B < 1:</strong> Có thể định giá thấp hoặc có vấn đề</li>
                            <li><strong>P/B = 1:</strong> Giá bằng giá trị sổ sách</li>
                            <li><strong>P/B > 1:</strong> Thị trường đánh giá cao hơn sổ sách</li>
                        </ul>
                        
                        <h4>🎯 Phù hợp với:</h4>
                        <ul>
                            <li><strong>Ngân hàng:</strong> Tài sản chủ yếu là tiền mặt</li>
                            <li><strong>Bất động sản:</strong> Tài sản hữu hình lớn</li>
                            <li><strong>Value investing:</strong> Tìm cổ phiếu định giá thấp</li>
                        </ul>
                        
                        <h4>🚫 Hạn chế:</h4>
                        <ul>
                            <li><strong>Không phù hợp:</strong> Công ty công nghệ, dịch vụ</li>
                            <li><strong>Giá trị sổ sách:</strong> Có thể không phản ánh giá trị thực</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">💹</span>
                            EV/EBITDA
                        </h3>
                        
                        <div class="formula-box">
                            EV/EBITDA = Enterprise Value / EBITDA
                            <br><small>EV = Market Cap + Net Debt</small>
                        </div>
                        
                        <h4>🔍 Ưu điểm:</h4>
                        <ul>
                            <li><strong>Loại bỏ ảnh hưởng:</strong> Cấu trúc tài chính, khấu hao</li>
                            <li><strong>So sánh tốt:</strong> Giữa các công ty có cấu trúc vốn khác nhau</li>
                            <li><strong>Phù hợp:</strong> M&A, công ty có nhiều nợ</li>
                        </ul>
                        
                        <h4>📊 Diễn giải:</h4>
                        <ul>
                            <li><strong>EV/EBITDA thấp:</strong> Có thể là cơ hội</li>
                            <li><strong>So sánh ngành:</strong> Cần đối chiếu với đối thủ</li>
                            <li><strong>Xu hướng:</strong> Xem có cải thiện theo thời gian không</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Lưu ý:</strong> EBITDA không phải là dòng tiền thực tế
                        </div>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🧮 Máy Tính Định Giá Toàn Diện</h3>
                    
                    <div class="tabs">
                        <div class="tab active" onclick="showTab('dcf-calc')">DCF Calculator</div>
                        <div class="tab" onclick="showTab('ratio-calc')">Ratio Analysis</div>
                        <div class="tab" onclick="showTab('comparison')">So Sánh Phương Pháp</div>
                    </div>

                    <div id="dcf-calc" class="tab-content active">
                        <h4>💸 Tính Toán DCF Đơn Giản</h4>
                        <div class="demo-controls">
                            <div>
                                <label>FCF hiện tại (tỷ VND)</label>
                                <input type="number" id="dcf-fcf" placeholder="Free Cash Flow năm gần nhất">
                            </div>
                            <div>
                                <label>Tăng trưởng năm 1-5 (%)</label>
                                <input type="number" id="dcf-growth1" placeholder="Tốc độ tăng trưởng giai đoạn 1">
                            </div>
                            <div>
                                <label>Tăng trưởng vĩnh viễn (%)</label>
                                <input type="number" id="dcf-growth2" placeholder="Tăng trưởng dài hạn (2-4%)">
                            </div>
                            <div>
                                <label>Tỷ suất chiết khấu (%)</label>
                                <input type="number" id="dcf-discount" placeholder="WACC hoặc Cost of Equity">
                            </div>
                            <div>
                                <label>Số cổ phiếu (triệu)</label>
                                <input type="number" id="dcf-shares" placeholder="Số cổ phiếu lưu hành">
                            </div>
                        </div>
                        <button class="btn" onclick="calculateDCF()">Tính Giá Trị DCF</button>
                        <div id="dcf-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="ratio-calc" class="tab-content">
                        <h4>🔢 Phân Tích Các Chỉ Số</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Giá cổ phiếu (VND)</label>
                                <input type="number" id="ratio-price" placeholder="Giá thị trường hiện tại">
                            </div>
                            <div>
                                <label>EPS (VND)</label>
                                <input type="number" id="ratio-eps" placeholder="Earnings Per Share">
                            </div>
                            <div>
                                <label>Book Value/Share (VND)</label>
                                <input type="number" id="ratio-bvps" placeholder="Giá trị sổ sách/cổ phiếu">
                            </div>
                            <div>
                                <label>EBITDA (tỷ VND)</label>
                                <input type="number" id="ratio-ebitda" placeholder="Earnings Before Interest, Tax...">
                            </div>
                            <div>
                                <label>Market Cap (tỷ VND)</label>
                                <input type="number" id="ratio-mcap" placeholder="Vốn hóa thị trường">
                            </div>
                            <div>
                                <label>Net Debt (tỷ VND)</label>
                                <input type="number" id="ratio-debt" placeholder="Nợ ròng">
                            </div>
                        </div>
                        <button class="btn" onclick="calculateRatios()">Tính Các Chỉ Số</button>
                        <div id="ratios-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="comparison" class="tab-content">
                        <h4>⚖️ So Sánh Phương Pháp Định Giá</h4>
                        <table class="reference-table">
                            <thead>
                                <tr>
                                    <th>Phương Pháp</th>
                                    <th>Phù Hợp</th>
                                    <th>Ưu Điểm</th>
                                    <th>Nhược Điểm</th>
                                    <th>Khi Nào Dùng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>DCF</strong></td>
                                    <td>Mọi loại công ty có FCF dương</td>
                                    <td>Cơ sở lý thuyết vững, tính đến tương lai</td>
                                    <td>Phụ thuộc dự báo, nhạy cảm giả định</td>
                                    <td>Phân tích sâu, đầu tư dài hạn</td>
                                </tr>
                                <tr>
                                    <td><strong>P/E</strong></td>
                                    <td>Công ty có lợi nhuận ổn định</td>
                                    <td>Đơn giản, dễ so sánh</td>
                                    <td>Không phù hợp công ty lỗ</td>
                                    <td>Sàng lọc nhanh, so sánh ngành</td>
                                </tr>
                                <tr>
                                    <td><strong>P/B</strong></td>
                                    <td>Ngân hàng, BĐS, tài sản nặng</td>
                                    <td>Phù hợp value investing</td>
                                    <td>Không phù hợp công ty công nghệ</td>
                                    <td>Tìm cổ phiếu định giá thấp</td>
                                </tr>
                                <tr>
                                    <td><strong>EV/EBITDA</strong></td>
                                    <td>So sánh M&A, công ty nhiều nợ</td>
                                    <td>Loại bỏ ảnh hưởng cấu trúc vốn</td>
                                    <td>EBITDA không phải cash flow</td>
                                    <td>M&A, so sánh đa quốc gia</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Chỉ số tài chính -->
            <div id="fundamental-ratios" class="tab-content">
                <h2 class="section-title">📊 Chỉ Số Tài Chính Quan Trọng</h2>
                
                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">💪</span>
                            Chỉ Số Khả Năng Sinh Lời
                        </h3>
                        
                        <h4>🎯 ROE (Return on Equity):</h4>
                        <div class="formula-box">
                            ROE = Lợi nhuận ròng / Vốn chủ sở hữu × 100%
                        </div>
                        <ul>
                            <li><strong>Tốt:</strong> ROE > 15% và ổn định</li>
                            <li><strong>Ý nghĩa:</strong> Hiệu quả sử dụng vốn của cổ đông</li>
                        </ul>
                        
                        <h4>🎯 ROA (Return on Assets):</h4>
                        <div class="formula-box">
                            ROA = Lợi nhuận ròng / Tổng tài sản × 100%
                        </div>
                        <ul>
                            <li><strong>Tốt:</strong> ROA > 5% (tùy ngành)</li>
                            <li><strong>Ý nghĩa:</strong> Hiệu quả sử dụng tài sản</li>
                        </ul>
                        
                        <h4>🎯 ROIC (Return on Invested Capital):</h4>
                        <div class="formula-box">
                            ROIC = NOPAT / Invested Capital × 100%
                        </div>
                        <ul>
                            <li><strong>Tốt:</strong> ROIC > WACC</li>
                            <li><strong>Ý nghĩa:</strong> Tạo giá trị cho cổ đông</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔒</span>
                            Chỉ Số Khả Năng Thanh Toán
                        </h3>
                        
                        <h4>💧 Current Ratio:</h4>
                        <div class="formula-box">
                            Current Ratio = Tài sản ngắn hạn / Nợ ngắn hạn
                        </div>
                        <ul>
                            <li><strong>Tốt:</strong> 1.5 - 3.0 (tùy ngành)</li>
                            <li><strong>Ý nghĩa:</strong> Khả năng trả nợ ngắn hạn</li>
                        </ul>
                        
                        <h4>⚡ Quick Ratio:</h4>
                        <div class="formula-box">
                            Quick Ratio = (Tài sản ngắn hạn - Hàng tồn kho) / Nợ ngắn hạn
                        </div>
                        <ul>
                            <li><strong>Tốt:</strong> > 1.0</li>
                            <li><strong>Ý nghĩa:</strong> Thanh khoản tức thời</li>
                        </ul>
                        
                        <h4>🏦 Debt to Equity:</h4>
                        <div class="formula-box">
                            D/E = Tổng nợ / Vốn chủ sở hữu
                        </div>
                        <ul>
                            <li><strong>Tốt:</strong> < 0.5 (trừ ngân hàng)</li>
                            <li><strong>Ý nghĩa:</strong> Mức độ sử dụng đòn bẩy</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔄</span>
                            Chỉ Số Hiệu Quả Hoạt Động
                        </h3>
                        
                        <h4>📦 Inventory Turnover:</h4>
                        <div class="formula-box">
                            Vòng quay HTK = Giá vốn hàng bán / HTK trung bình
                        </div>
                        <ul>
                            <li><strong>Càng cao càng tốt:</strong> Hàng tồn kho ít, quay vòng nhanh</li>
                            <li><strong>So sánh:</strong> Với đối thủ cùng ngành</li>
                        </ul>
                        
                        <h4>💰 Receivables Turnover:</h4>
                        <div class="formula-box">
                            Vòng quay công nợ = Doanh thu / Công nợ phải thu TB
                        </div>
                        <ul>
                            <li><strong>Cao:</strong> Thu tiền khách hàng nhanh</li>
                            <li><strong>Thấp:</strong> Khách hàng chậm trả tiền</li>
                        </ul>
                        
                        <h4>🔄 Asset Turnover:</h4>
                        <div class="formula-box">
                            Vòng quay TS = Doanh thu / Tổng tài sản trung bình
                        </div>
                        <ul>
                            <li><strong>Ý nghĩa:</strong> Hiệu quả sử dụng tài sản tạo doanh thu</li>
                            <li><strong>Biến động:</strong> Theo đặc thù ngành</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📈</span>
                            Chỉ Số Tăng Trưởng
                        </h3>
                        
                        <h4>📊 Revenue Growth:</h4>
                        <div class="formula-box">
                            Tăng trưởng DT = (DT năm nay - DT năm trước) / DT năm trước × 100%
                        </div>
                        <ul>
                            <li><strong>Tốt:</strong> Tăng trưởng ổn định và bền vững</li>
                            <li><strong>Cảnh báo:</strong> Tăng trưởng quá nhanh có thể không bền</li>
                        </ul>
                        
                        <h4>💎 Earnings Growth:</h4>
                        <div class="formula-box">
                            Tăng trưởng LN = (LN năm nay - LN năm trước) / LN năm trước × 100%
                        </div>
                        <ul>
                            <li><strong>Lý tưởng:</strong> Lợi nhuận tăng nhanh hơn doanh thu</li>
                            <li><strong>Theo dõi:</strong> Xu hướng 3-5 năm</li>
                        </ul>
                        
                        <h4>📚 Book Value Growth:</h4>
                        <div class="formula-box">
                            Tăng trưởng GTSS = (VCSH năm nay - VCSH năm trước) / VCSH năm trước × 100%
                        </div>
                        <ul>
                            <li><strong>Buffett thích:</strong> Tăng trưởng đều đặn qua các năm</li>
                            <li><strong>Nguyên nhân:</strong> Lợi nhuận giữ lại để tái đầu tư</li>
                        </ul>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🧮 Máy Tính Phân Tích Tài Chính Toàn Diện</h3>
                    <div class="demo-controls">
                        <div>
                            <label>Lợi nhuận ròng (tỷ VND)</label>
                            <input type="number" id="fin-netincome" placeholder="Net Income">
                        </div>
                        <div>
                            <label>Vốn chủ sở hữu (tỷ VND)</label>
                            <input type="number" id="fin-equity" placeholder="Shareholders' Equity">
                        </div>
                        <div>
                            <label>Tổng tài sản (tỷ VND)</label>
                            <input type="number" id="fin-assets" placeholder="Total Assets">
                        </div>
                        <div>
                            <label>Doanh thu (tỷ VND)</label>
                            <input type="number" id="fin-revenue" placeholder="Revenue">
                        </div>
                        <div>
                            <label>Tài sản ngắn hạn (tỷ VND)</label>
                            <input type="number" id="fin-current-assets" placeholder="Current Assets">
                        </div>
                        <div>
                            <label>Nợ ngắn hạn (tỷ VND)</label>
                            <input type="number" id="fin-current-liab" placeholder="Current Liabilities">
                        </div>
                        <div>
                            <label>Tổng nợ (tỷ VND)</label>
                            <input type="number" id="fin-debt" placeholder="Total Debt">
                        </div>
                        <div>
                            <label>Hàng tồn kho (tỷ VND)</label>
                            <input type="number" id="fin-inventory" placeholder="Inventory">
                        </div>
                    </div>
                    <button class="btn" onclick="calculateFinancialRatios()">Phân Tích Toàn Diện</button>
                    <div id="financial-ratios-result" class="result" style="display: none;"></div>
                </div>

                <div class="highlight-box">
                    <h4>📋 Mẫu Phân Tích Dupont</h4>
                    <p><strong>Công thức Dupont:</strong> ROE = Net Margin × Asset Turnover × Equity Multiplier</p>
                    <div class="formula-box">
                        ROE = (Net Income/Revenue) × (Revenue/Total Assets) × (Total Assets/Equity)
                    </div>
                    <p>Giúp phân tích xem ROE cao đến từ đâu: hiệu quả lợi nhuận, hiệu quả tài sản, hay đòn bẩy tài chính.</p>
                </div>
            </div>
        </div>

        <!-- PHÂN TÍCH KỸ THUẬT -->
        <div id="technical" class="content-section">
            <!-- Cơ bản -->
            <div id="technical-basics" class="tab-content active">
                <h2 class="section-title">📈 Nguyên Tắc Cơ Bản Phân Tích Kỹ Thuật</h2>
                
                <div class="highlight-box">
                    <h4>🎯 Ba Nguyên Lý Cốt Lõi</h4>
                    <ol>
                        <li><strong>Giá phản ánh tất cả:</strong> Mọi thông tin đã được phản ánh vào giá</li>
                        <li><strong>Giá di chuyển theo xu hướng:</strong> Có các xu hướng rõ ràng và kéo dài</li>
                        <li><strong>Lịch sử có xu hướng lặp lại:</strong> Tâm lý con người không đổi</li>
                    </ol>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📊</span>
                            Các Loại Biểu Đồ
                        </h3>
                        
                        <h4>📈 Line Chart (Biểu đồ đường):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Nối các giá đóng cửa</li>
                            <li><strong>Ưu điểm:</strong> Đơn giản, dễ nhìn xu hướng chung</li>
                            <li><strong>Nhược điểm:</strong> Thiếu thông tin chi tiết</li>
                        </ul>
                        
                        <h4>📊 Bar Chart (Biểu đồ cột):</h4>
                        <ul>
                            <li><strong>Thông tin:</strong> Open, High, Low, Close (OHLC)</li>
                            <li><strong>Ưu điểm:</strong> Đầy đủ thông tin giá</li>
                            <li><strong>Nhược điểm:</strong> Khó đọc hơn nến Nhật</li>
                        </ul>
                        
                        <h4>🕯️ Candlestick Chart (Nến Nhật):</h4>
                        <ul>
                            <li><strong>Ưu điểm:</strong> Trực quan, dễ đọc tâm lý</li>
                            <li><strong>Thông tin:</strong> OHLC + các mẫu hình</li>
                            <li><strong>Phổ biến nhất:</strong> Được sử dụng rộng rãi nhất</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            Khung Thời Gian
                        </h3>
                        
                        <h4>⚡ Ngắn hạn (Scalping/Day Trading):</h4>
                        <ul>
                            <li><strong>1-5 phút:</strong> Scalping, giao dịch tần số cao</li>
                            <li><strong>15-30 phút:</strong> Day trading</li>
                            <li><strong>1 giờ:</strong> Intraday trading</li>
                        </ul>
                        
                        <h4>🎯 Trung hạn (Swing Trading):</h4>
                        <ul>
                            <li><strong>4 giờ:</strong> Xu hướng ngắn hạn</li>
                            <li><strong>1 ngày:</strong> Phân tích chính</li>
                            <li><strong>1 tuần:</strong> Xu hướng trung hạn</li>
                        </ul>
                        
                        <h4>📈 Dài hạn (Position Trading):</h4>
                        <ul>
                            <li><strong>1 tháng:</strong> Xu hướng dài hạn</li>
                            <li><strong>1 quý:</strong> Phân tích cơ bản kết hợp</li>
                            <li><strong>1 năm:</strong> Chu kỳ kinh tế</li>
                        </ul>
                        
                        <div class="warning-box">
                            <strong>⚠️ Quy tắc:</strong> Luôn phân tích từ khung thời gian lớn xuống nhỏ (Top-down approach)
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔍</span>
                            Xu Hướng Thị Trường
                        </h3>
                        
                        <h4>📈 Uptrend (Xu hướng tăng):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Đỉnh sau cao hơn đỉnh trước, đáy sau cao hơn đáy trước</li>
                            <li><strong>Chiến lược:</strong> Mua trong các đợt điều chỉnh</li>
                            <li><strong>Tín hiệu:</strong> Giá trên các đường MA</li>
                        </ul>
                        
                        <h4>📉 Downtrend (Xu hướng giảm):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Đỉnh sau thấp hơn đỉnh trước, đáy sau thấp hơn đáy trước</li>
                            <li><strong>Chiến lược:</strong> Bán trong các đợt hồi phục</li>
                            <li><strong>Tín hiệu:</strong> Giá dưới các đường MA</li>
                        </ul>
                        
                        <h4>↔️ Sideways (Đi ngang):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Giá dao động trong một khoảng</li>
                            <li><strong>Chiến lược:</strong> Mua ở hỗ trợ, bán ở kháng cự</li>
                            <li><strong>Lưu ý:</strong> Chờ đợi breakout để xác định xu hướng mới</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🧭</span>
                            Tâm Lý Thị Trường
                        </h3>
                        
                        <h4>🐂 Bulls (Phe mua):</h4>
                        <ul>
                            <li><strong>Tâm lý:</strong> Lạc quan, tin giá sẽ tăng</li>
                            <li><strong>Hành động:</strong> Mua vào, nâng giá lên</li>
                            <li><strong>Dấu hiệu:</strong> Khối lượng tăng khi giá tăng</li>
                        </ul>
                        
                        <h4>🐻 Bears (Phe bán):</h4>
                        <ul>
                            <li><strong>Tâm lý:</strong> Bi quan, tin giá sẽ giảm</li>
                            <li><strong>Hành động:</strong> Bán ra, đẩy giá xuống</li>
                            <li><strong>Dấu hiệu:</strong> Khối lượng tăng khi giá giảm</li>
                        </ul>
                        
                        <h4>⚖️ Cân bằng:</h4>
                        <ul>
                            <li><strong>Tình trạng:</strong> Không phe nào áp đảo</li>
                            <li><strong>Biểu hiện:</strong> Giá đi ngang, biến động thấp</li>
                            <li><strong>Cơ hội:</strong> Trước những đột phá lớn</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Nguyên tắc:</strong> "Trend is your friend" - Đi theo xu hướng chính
                        </div>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>📊 Trình Mô Phỏng Xu Hướng</h3>
                    <canvas id="trend-demo" class="candlestick-canvas" width="800" height="400"></canvas>
                    <div class="demo-controls">
                        <button class="btn" onclick="drawTrendDemo('uptrend')">Xu Hướng Tăng</button>
                        <button class="btn" onclick="drawTrendDemo('downtrend')">Xu Hướng Giảm</button>
                        <button class="btn" onclick="drawTrendDemo('sideways')">Đi Ngang</button>
                        <button class="btn btn-warning" onclick="clearTrendDemo()">Xóa</button>
                    </div>
                    <div id="trend-analysis" class="result" style="display: none;"></div>
                </div>
            </div>

            <!-- Chỉ báo -->
            <div id="technical-indicators" class="tab-content">
                <h2 class="section-title">🔢 Chỉ Báo Kỹ Thuật Quan Trọng</h2>
                
                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📈</span>
                            Moving Average (MA)
                        </h3>
                        
                        <h4>📊 Simple Moving Average (SMA):</h4>
                        <div class="formula-box">
                            SMA = (P₁ + P₂ + ... + Pₙ) / n
                            <br><small>P = Giá, n = Số kỳ</small>
                        </div>
                        
                        <h4>📈 Exponential Moving Average (EMA):</h4>
                        <div class="formula-box">
                            EMA = (Giá hôm nay × 2/(n+1)) + (EMA hôm qua × (1-2/(n+1)))
                        </div>
                        
                        <h4>🎯 Cách sử dụng:</h4>
                        <ul>
                            <li><strong>MA20:</strong> Xu hướng ngắn hạn</li>
                            <li><strong>MA50:</strong> Xu hướng trung hạn</li>
                            <li><strong>MA200:</strong> Xu hướng dài hạn</li>
                            <li><strong>Golden Cross:</strong> MA50 cắt lên MA200 - Tín hiệu tăng mạnh</li>
                            <li><strong>Death Cross:</strong> MA50 cắt xuống MA200 - Tín hiệu giảm mạnh</li>
                        </ul>
                        
                        <h4>💡 Nguyên tắc:</h4>
                        <ul>
                            <li><strong>Giá > MA:</strong> Xu hướng tăng</li>
                            <li><strong>Giá < MA:</strong> Xu hướng giảm</li>
                            <li><strong>MA làm hỗ trợ/kháng cự:</strong> Trong xu hướng rõ ràng</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">⚡</span>
                            RSI (Relative Strength Index)
                        </h3>
                        
                        <div class="formula-box">
                            RSI = 100 - (100 / (1 + RS))
                            <br><small>RS = Average Gain / Average Loss</small>
                        </div>
                        
                        <h4>🎯 Cách đọc:</h4>
                        <ul>
                            <li><strong>RSI > 70:</strong> Vùng quá mua (Overbought)</li>
                            <li><strong>RSI < 30:</strong> Vùng quá bán (Oversold)</li>
                            <li><strong>RSI 30-70:</strong> Vùng trung tính</li>
                        </ul>
                        
                        <h4>🔍 Tín hiệu nâng cao:</h4>
                        <ul>
                            <li><strong>Bullish Divergence:</strong> Giá giảm nhưng RSI tăng</li>
                            <li><strong>Bearish Divergence:</strong> Giá tăng nhưng RSI giảm</li>
                            <li><strong>Failure Swing:</strong> RSI không thể vượt đỉnh/đáy trước</li>
                        </ul>
                        
                        <div class="warning-box">
                            <strong>⚠️ Lưu ý:</strong> Trong xu hướng mạnh, RSI có thể ở vùng cực trị lâu
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🌊</span>
                            MACD (Moving Average Convergence Divergence)
                        </h3>
                        
                        <div class="formula-box">
                            MACD Line = EMA(12) - EMA(26)
                            <br>Signal Line = EMA(9) của MACD Line
                            <br>Histogram = MACD Line - Signal Line
                        </div>
                        
                        <h4>🎯 Tín hiệu chính:</h4>
                        <ul>
                            <li><strong>MACD cắt lên Signal:</strong> Tín hiệu mua</li>
                            <li><strong>MACD cắt xuống Signal:</strong> Tín hiệu bán</li>
                            <li><strong>MACD cắt lên Zero:</strong> Xác nhận xu hướng tăng</li>
                            <li><strong>MACD cắt xuống Zero:</strong> Xác nhận xu hướng giảm</li>
                        </ul>
                        
                        <h4>📊 Histogram:</h4>
                        <ul>
                            <li><strong>Histogram tăng:</strong> Momentum tăng</li>
                            <li><strong>Histogram giảm:</strong> Momentum yếu đi</li>
                            <li><strong>Histogram đổi màu:</strong> Tín hiệu sớm hơn crossover</li>
                        </ul>
                        
                        <h4>🔍 Divergence:</h4>
                        <ul>
                            <li><strong>Bullish:</strong> Giá tạo đáy thấp hơn, MACD tạo đáy cao hơn</li>
                            <li><strong>Bearish:</strong> Giá tạo đỉnh cao hơn, MACD tạo đỉnh thấp hơn</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            Bollinger Bands
                        </h3>
                        
                        <div class="formula-box">
                            Upper Band = SMA(20) + (2 × Standard Deviation)
                            <br>Middle Band = SMA(20)
                            <br>Lower Band = SMA(20) - (2 × Standard Deviation)
                        </div>
                        
                        <h4>🎯 Cách sử dụng:</h4>
                        <ul>
                            <li><strong>Giá chạm Upper Band:</strong> Có thể quá mua</li>
                            <li><strong>Giá chạm Lower Band:</strong> Có thể quá bán</li>
                            <li><strong>Squeeze:</strong> Bands co lại - báo hiệu breakout</li>
                            <li><strong>Expansion:</strong> Bands mở rộng - biến động tăng</li>
                        </ul>
                        
                        <h4>💡 Chiến lược:</h4>
                        <ul>
                            <li><strong>Mean Reversion:</strong> Mua ở Lower, bán ở Upper (thị trường đi ngang)</li>
                            <li><strong>Breakout:</strong> Giá vượt band với volume lớn (xu hướng mạnh)</li>
                            <li><strong>%B Indicator:</strong> Vị trí giá trong bands</li>
                        </ul>
                        
                        <div class="result">
                            <strong>%B = (Price - Lower Band) / (Upper Band - Lower Band)</strong>
                        </div>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🧮 Máy Tính Chỉ Báo Kỹ Thuật</h3>
                    
                    <div class="tabs">
                        <div class="tab active" onclick="showTab('ma-calc')">MA Calculator</div>
                        <div class="tab" onclick="showTab('rsi-calc')">RSI Calculator</div>
                        <div class="tab" onclick="showTab('macd-calc')">MACD Calculator</div>
                        <div class="tab" onclick="showTab('bb-calc')">Bollinger Bands</div>
                    </div>

                    <div id="ma-calc" class="tab-content active">
                        <h4>📈 Tính Moving Average</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Chuỗi giá (phân cách bằng dấu phẩy)</label>
                                <input type="text" id="ma-prices" placeholder="100,102,98,105,107,103,99,101,104,106">
                            </div>
                            <div>
                                <label>Chu kỳ MA</label>
                                <select id="ma-period">
                                    <option value="5">5 kỳ</option>
                                    <option value="10">10 kỳ</option>
                                    <option value="20">20 kỳ</option>
                                    <option value="50">50 kỳ</option>
                                </select>
                            </div>
                            <div>
                                <label>Loại MA</label>
                                <select id="ma-type">
                                    <option value="sma">Simple MA</option>
                                    <option value="ema">Exponential MA</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn" onclick="calculateMA()">Tính MA</button>
                        <div id="ma-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="rsi-calc" class="tab-content">
                        <h4>⚡ Tính RSI</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Chuỗi giá đóng cửa</label>
                                <input type="text" id="rsi-prices-detailed" placeholder="50,52,48,55,57,53,49,51,54,56,52,48,50,53">
                            </div>
                            <div>
                                <label>Chu kỳ RSI</label>
                                <select id="rsi-period-detailed">
                                    <option value="14">14 kỳ</option>
                                    <option value="7">7 kỳ</option>
                                    <option value="21">21 kỳ</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn" onclick="calculateDetailedRSI()">Tính RSI Chi Tiết</button>
                        <div id="detailed-rsi-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="macd-calc" class="tab-content">
                        <h4>🌊 Tính MACD</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Chuỗi giá (tối thiểu 26 giá)</label>
                                <input type="text" id="macd-prices" placeholder="45,46,47,46,47,48,49,48,49,50,51,50,51,52,53,52,53,54,55,54,55,56,57,56,57,58,59">
                            </div>
                            <div>
                                <label>Fast EMA</label>
                                <input type="number" id="macd-fast" value="12" min="1" max="50">
                            </div>
                            <div>
                                <label>Slow EMA</label>
                                <input type="number" id="macd-slow" value="26" min="1" max="100">
                            </div>
                            <div>
                                <label>Signal EMA</label>
                                <input type="number" id="macd-signal" value="9" min="1" max="50">
                            </div>
                        </div>
                        <button class="btn" onclick="calculateMACD()">Tính MACD</button>
                        <div id="macd-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="bb-calc" class="tab-content">
                        <h4>🎯 Tính Bollinger Bands</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Chuỗi giá (tối thiểu 20 giá)</label>
                                <input type="text" id="bb-prices" placeholder="98,99,100,101,100,99,98,99,100,101,102,101,100,99,98,99,100,101,102,103">
                            </div>
                            <div>
                                <label>Chu kỳ SMA</label>
                                <input type="number" id="bb-period" value="20" min="5" max="50">
                            </div>
                            <div>
                                <label>Độ lệch chuẩn</label>
                                <input type="number" id="bb-std" value="2" min="1" max="3" step="0.1">
                            </div>
                        </div>
                        <button class="btn" onclick="calculateBollingerBands()">Tính Bollinger Bands</button>
                        <div id="bb-result" class="result" style="display: none;"></div>
                    </div>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔄</span>
                            Stochastic Oscillator
                        </h3>
                        
                        <div class="formula-box">
                            %K = ((C - L14) / (H14 - L14)) × 100
                            <br>%D = SMA(3) của %K
                            <br><small>C=Close, L14=Low 14 kỳ, H14=High 14 kỳ</small>
                        </div>
                        
                        <h4>🎯 Tín hiệu:</h4>
                        <ul>
                            <li><strong>%K > 80:</strong> Vùng quá mua</li>
                            <li><strong>%K < 20:</strong> Vùng quá bán</li>
                            <li><strong>%K cắt lên %D:</strong> Tín hiệu mua</li>
                            <li><strong>%K cắt xuống %D:</strong> Tín hiệu bán</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">💰</span>
                            Williams %R
                        </h3>
                        
                        <div class="formula-box">
                            %R = ((H14 - C) / (H14 - L14)) × (-100)
                        </div>
                        
                        <h4>🎯 Đặc điểm:</h4>
                        <ul>
                            <li><strong>Dao động:</strong> Từ 0 đến -100</li>
                            <li><strong>%R > -20:</strong> Quá mua</li>
                            <li><strong>%R < -80:</strong> Quá bán</li>
                            <li><strong>Tương tự Stochastic:</strong> Nhưng ngược chiều</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📊</span>
                            Commodity Channel Index (CCI)
                        </h3>
                        
                        <div class="formula-box">
                            CCI = (TP - SMA(TP)) / (0.015 × Mean Deviation)
                            <br><small>TP = (H + L + C) / 3</small>
                        </div>
                        
                        <h4>🎯 Cách đọc:</h4>
                        <ul>
                            <li><strong>CCI > +100:</strong> Xu hướng tăng mạnh</li>
                            <li><strong>CCI < -100:</strong> Xu hướng giảm mạnh</li>
                            <li><strong>-100 đến +100:</strong> Thị trường đi ngang</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">⚡</span>
                            Average True Range (ATR)
                        </h3>
                        
                        <div class="formula-box">
                            TR = MAX(H-L, |H-C₋₁|, |L-C₋₁|)
                            <br>ATR = MA(TR, 14)
                        </div>
                        
                        <h4>🎯 Ứng dụng:</h4>
                        <ul>
                            <li><strong>Đo volatility:</strong> ATR cao = biến động lớn</li>
                            <li><strong>Stop Loss:</strong> Đặt SL = n × ATR</li>
                            <li><strong>Position Sizing:</strong> Điều chỉnh khối lượng theo ATR</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Hỗ trợ/Kháng cự -->
            <div id="technical-support-resistance" class="tab-content">
                <h2 class="section-title">🎯 Ngưỡng Hỗ Trợ và Kháng Cự</h2>
                
                <div class="highlight-box">
                    <h4>💡 Bản Chất Tâm Lý</h4>
                    <p>Hỗ trợ và kháng cự được hình thành bởi tâm lý và ký ức của đám đông. Những nhà đầu tư đã bỏ lỡ cơ hội mua ở đáy sẽ đặt lệnh mua khi giá quay lại, tạo thành ngưỡng hỗ trợ.</p>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🛡️</span>
                            Ngưỡng Hỗ Trợ (Support)
                        </h3>
                        
                        <h4>📍 Định nghĩa:</h4>
                        <p>Vùng giá mà tại đó lực mua được kỳ vọng sẽ đủ mạnh để ngăn chặn đà giảm tiếp của giá.</p>
                        
                        <h4>🔍 Cách xác định:</h4>
                        <ul>
                            <li><strong>Đáy lịch sử:</strong> Các mức đáy trong quá khứ</li>
                            <li><strong>Đường xu hướng tăng:</strong> Nối các đáy tăng dần</li>
                            <li><strong>Moving Average:</strong> MA20, MA50, MA200</li>
                            <li><strong>Fibonacci Retracement:</strong> 38.2%, 50%, 61.8%</li>
                            <li><strong>Số tròn:</strong> 1000, 1100, 1200 điểm</li>
                        </ul>
                        
                        <h4>💪 Độ mạnh của hỗ trợ:</h4>
                        <ul>
                            <li><strong>Số lần test:</strong> Càng nhiều lần càng mạnh</li>
                            <li><strong>Khối lượng:</strong> Hỗ trợ với volume cao mạnh hơn</li>
                            <li><strong>Thời gian:</strong> Hỗ trợ từ lâu có ý nghĩa hơn</li>
                            <li><strong>Mức độ quan trọng:</strong> Đáy năm, đáy thập kỷ</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Quy tắc:</strong> Hỗ trợ bị phá vỡ sẽ trở thành kháng cự mới
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🚧</span>
                            Ngưỡng Kháng Cự (Resistance)
                        </h3>
                        
                        <h4>📍 Định nghĩa:</h4>
                        <p>Vùng giá mà tại đó lực bán được kỳ vọng sẽ đủ mạnh để ngăn chặn đà tăng tiếp của giá.</p>
                        
                        <h4>🔍 Cách xác định:</h4>
                        <ul>
                            <li><strong>Đỉnh lịch sử:</strong> Các mức đỉnh trong quá khứ</li>
                            <li><strong>Đường xu hướng giảm:</strong> Nối các đỉnh giảm dần</li>
                            <li><strong>Moving Average:</strong> Trong xu hướng giảm</li>
                            <li><strong>Gap giá:</strong> Vùng trống trong quá khứ</li>
                            <li><strong>Mức tâm lý:</strong> ATH (All Time High)</li>
                        </ul>
                        
                        <h4>🎯 Chiến lược giao dịch:</h4>
                        <ul>
                            <li><strong>Mua ở hỗ trợ:</strong> Khi giá bounce từ support</li>
                            <li><strong>Bán ở kháng cự:</strong> Khi giá reject từ resistance</li>
                            <li><strong>Breakout trading:</strong> Giá phá vỡ với volume lớn</li>
                            <li><strong>False breakout:</strong> Phá vỡ giả, quay lại ngay</li>
                        </ul>
                        
                        <div class="warning-box">
                            <strong>⚠️ Lưu ý:</strong> Không phải lúc nào support/resistance cũng giữ được
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📏</span>
                            Đường Xu Hướng (Trendlines)
                        </h3>
                        
                        <h4>📈 Trendline tăng:</h4>
                        <ul>
                            <li><strong>Cách vẽ:</strong> Nối 2 đáy tăng dần trở lên</li>
                            <li><strong>Vai trò:</strong> Đóng vai trò hỗ trợ động</li>
                            <li><strong>Tín hiệu:</strong> Giá phá vỡ xuống dưới = đảo chiều</li>
                        </ul>
                        
                        <h4>📉 Trendline giảm:</h4>
                        <ul>
                            <li><strong>Cách vẽ:</strong> Nối 2 đỉnh giảm dần trở lên</li>
                            <li><strong>Vai trò:</strong> Đóng vai trò kháng cự động</li>
                            <li><strong>Tín hiệu:</strong> Giá phá vỡ lên trên = đảo chiều</li>
                        </ul>
                        
                        <h4>📐 Nguyên tắc vẽ:</h4>
                        <ul>
                            <li><strong>Tối thiểu 2 điểm:</strong> Để tạo thành đường thẳng</li>
                            <li><strong>Điểm thứ 3:</strong> Xác nhận độ tin cậy</li>
                            <li><strong>Không ép buộc:</strong> Đường xu hướng phải tự nhiên</li>
                            <li><strong>Điều chỉnh:</strong> Có thể vẽ lại khi có thêm dữ liệu</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📊</span>
                            Channels (Kênh Giá)
                        </h3>
                        
                        <h4>📈 Ascending Channel:</h4>
                        <ul>
                            <li><strong>Cấu tạo:</strong> 2 đường song song dốc lên</li>
                            <li><strong>Chiến lược:</strong> Mua ở đường dưới, bán ở đường trên</li>
                            <li><strong>Breakout:</strong> Vượt lên trên = tăng mạnh tiếp</li>
                        </ul>
                        
                        <h4>📉 Descending Channel:</h4>
                        <ul>
                            <li><strong>Cấu tạo:</strong> 2 đường song song dốc xuống</li>
                            <li><strong>Chiến lược:</strong> Bán ở đường trên, mua ở đường dưới</li>
                            <li><strong>Breakout:</strong> Vượt xuống dưới = giảm mạnh tiếp</li>
                        </ul>
                        
                        <h4>↔️ Horizontal Channel:</h4>
                        <ul>
                            <li><strong>Cấu tạo:</strong> 2 đường ngang song song</li>
                            <li><strong>Đặc điểm:</strong> Thị trường đi ngang</li>
                            <li><strong>Breakout:</strong> Quyết định xu hướng tiếp theo</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Channel Width:</strong> Đo độ biến động bình thường của cổ phiếu
                        </div>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🎯 Công Cụ Vẽ Support/Resistance</h3>
                    <canvas id="sr-canvas" class="candlestick-canvas" width="800" height="500"></canvas>
                    <div class="demo-controls">
                        <button class="btn" onclick="drawSRDemo('support')">Vẽ Hỗ Trợ</button>
                        <button class="btn" onclick="drawSRDemo('resistance')">Vẽ Kháng Cự</button>
                        <button class="btn" onclick="drawSRDemo('trendline')">Đường Xu Hướng</button>
                        <button class="btn" onclick="drawSRDemo('channel')">Kênh Giá</button>
                        <button class="btn btn-warning" onclick="clearSRDemo()">Xóa</button>
                    </div>
                    <div id="sr-analysis" class="result" style="display: none;"></div>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔢</span>
                            Fibonacci Retracement
                        </h3>
                        
                        <h4>📏 Các mức quan trọng:</h4>
                        <ul>
                            <li><strong>23.6%:</strong> Retracement nông</li>
                            <li><strong>38.2%:</strong> Hỗ trợ/kháng cự nhẹ</li>
                            <li><strong>50.0%:</strong> Mức tâm lý quan trọng</li>
                            <li><strong>61.8%:</strong> Fibonacci vàng - mạnh nhất</li>
                            <li><strong>78.6%:</strong> Retracement sâu</li>
                        </ul>
                        
                        <h4>🎯 Cách sử dụng:</h4>
                        <ul>
                            <li><strong>Xu hướng tăng:</strong> Kẻ từ đáy lên đỉnh gần nhất</li>
                            <li><strong>Xu hướng giảm:</strong> Kẻ từ đỉnh xuống đáy gần nhất</li>
                            <li><strong>Mua vào:</strong> Khi giá bounce từ mức Fib</li>
                            <li><strong>Stop loss:</strong> Phía dưới mức Fib quan trọng</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔄</span>
                            Pivot Points
                        </h3>
                        
                        <div class="formula-box">
                            PP = (High + Low + Close) / 3
                            <br>R1 = (2 × PP) - Low
                            <br>S1 = (2 × PP) - High
                            <br>R2 = PP + (High - Low)
                            <br>S2 = PP - (High - Low)
                        </div>
                        
                        <h4>🎯 Ứng dụng:</h4>
                        <ul>
                            <li><strong>Day Trading:</strong> Xác định vùng hỗ trợ/kháng cự trong ngày</li>
                            <li><strong>Target:</strong> R1, R2 là mục tiêu chốt lời</li>
                            <li><strong>Support:</strong> S1, S2 là vùng mua vào</li>
                            <li><strong>PP:</strong> Xác định bias bullish/bearish</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Khối lượng -->
            <div id="technical-volume" class="tab-content">
                <h2 class="section-title">📊 Phân Tích Khối Lượng Giao Dịch</h2>
                
                <div class="highlight-box">
                    <h4>💡 Nguyên Tắc Cơ Bản</h4>
                    <p><em>"Volume precedes price"</em> - Khối lượng dẫn trước giá. Nếu giá cho chúng ta biết thị trường đang đi đâu, thì khối lượng cho chúng ta biết có bao nhiều "nhiên liệu" đằng sau sự di chuyển đó.</p>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📈</span>
                            Volume trong Xu Hướng Tăng
                        </h3>
                        
                        <h4>✅ Dấu hiệu tích cực:</h4>
                        <ul>
                            <li><strong>Volume tăng khi giá tăng:</strong> Xác nhận xu hướng mạnh</li>
                            <li><strong>Volume giảm khi giá giảm:</strong> Điều chỉnh lành mạnh</li>
                            <li><strong>Accumulation:</strong> Volume cao liên tục ở vùng đáy</li>
                            <li><strong>Breakout volume:</strong> Phá đỉnh với volume đột biến</li>
                        </ul>
                        
                        <h4>⚠️ Dấu hiệu cảnh báo:</h4>
                        <ul>
                            <li><strong>Volume giảm khi giá tăng:</strong> Xu hướng yếu đi</li>
                            <li><strong>Volume tăng khi giá giảm:</strong> Áp lực bán gia tăng</li>
                            <li><strong>Climax volume:</strong> Volume cực lớn có thể là đỉnh</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Lý tưởng:</strong> Volume và giá cùng tăng trong xu hướng tăng
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📉</span>
                            Volume trong Xu Hướng Giảm
                        </h3>
                        
                        <h4>⚠️ Dấu hiệu tiêu cực:</h4>
                        <ul>
                            <li><strong>Volume tăng khi giá giảm:</strong> Xác nhận áp lực bán</li>
                            <li><strong>Distribution:</strong> Volume cao ở vùng đỉnh</li>
                            <li><strong>Panic selling:</strong> Volume đột biến khi giá sụp</li>
                            <li><strong>Breakdown volume:</strong> Phá đáy với volume lớn</li>
                        </ul>
                        
                        <h4>✅ Dấu hiệu tích cực:</h4>
                        <ul>
                            <li><strong>Volume giảm khi giá giảm:</strong> Lực bán cạn kiệt</li>
                            <li><strong>Volume tăng khi giá tăng:</strong> Hồi phục có chất lượng</li>
                            <li><strong>Selling climax:</strong> Volume cực lớn có thể là đáy</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Cảnh báo đáy:</strong> Volume giảm dần trong xu hướng giảm
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">⚡</span>
                            Volume Breakout
                        </h3>
                        
                        <h4>🚀 Breakout hợp lệ:</h4>
                        <ul>
                            <li><strong>Volume spike:</strong> Tăng 50-200% so với TB</li>
                            <li><strong>Sustained volume:</strong> Volume duy trì cao sau breakout</li>
                            <li><strong>Follow-through:</strong> Giá tiếp tục theo hướng breakout</li>
                            <li><strong>No return:</strong> Không quay lại vùng cũ</li>
                        </ul>
                        
                        <h4>❌ False breakout:</h4>
                        <ul>
                            <li><strong>Volume thấp:</strong> Thiếu sự tham gia của dòng tiền lớn</li>
                            <li><strong>Quick reversal:</strong> Nhanh chóng quay lại vùng cũ</li>
                            <li><strong>Low participation:</strong> Chỉ nhóm nhỏ tham gia</li>
                        </ul>
                        
                        <div class="formula-box">
                            Volume Rate = Volume hôm nay / Volume TB 20 ngày
                            <br><small>VR > 2.0 = Volume cao bất thường</small>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔍</span>
                            Các Chỉ Báo Volume
                        </h3>
                        
                        <h4>📊 On-Balance Volume (OBV):</h4>
                        <div class="formula-box">
                            Nếu Close > Close₋₁: OBV = OBV₋₁ + Volume
                            <br>Nếu Close < Close₋₁: OBV = OBV₋₁ - Volume
                        </div>
                        <ul>
                            <li><strong>OBV tăng:</strong> Dòng tiền chảy vào</li>
                            <li><strong>OBV giảm:</strong> Dòng tiền chảy ra</li>
                            <li><strong>Divergence:</strong> OBV và giá đi ngược chiều</li>
                        </ul>
                        
                        <h4>💰 Money Flow Index (MFI):</h4>
                        <div class="formula-box">
                            MFI = 100 - (100 / (1 + MF Ratio))
                            <br><small>MF Ratio = Positive MF / Negative MF</small>
                        </div>
                        <ul>
                            <li><strong>MFI > 80:</strong> Quá mua với volume</li>
                            <li><strong>MFI < 20:</strong> Quá bán với volume</li>
                            <li><strong>Divergence:</strong> Tín hiệu đảo chiều mạnh</li>
                        </ul>
                        
                        <h4>🌊 Volume Price Trend (VPT):</h4>
                        <div class="formula-box">
                            VPT = VPT₋₁ + (Volume × (Close - Close₋₁) / Close₋₁)
                        </div>
                        <ul>
                            <li><strong>VPT xu hướng tăng:</strong> Mua vào áp đảo</li>
                            <li><strong>VPT xu hướng giảm:</strong> Bán ra áp đảo</li>
                        </ul>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>📊 Máy Tính Phân Tích Volume</h3>
                    
                    <div class="tabs">
                        <div class="tab active" onclick="showTab('volume-basic')">Volume Analysis</div>
                        <div class="tab" onclick="showTab('obv-calc')">OBV Calculator</div>
                        <div class="tab" onclick="showTab('mfi-calc')">MFI Calculator</div>
                        <div class="tab" onclick="showTab('volume-profile')">Volume Profile</div>
                    </div>

                    <div id="volume-basic" class="tab-content active">
                        <h4>📊 Phân Tích Volume Cơ Bản</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Volume hôm nay</label>
                                <input type="number" id="vol-today" placeholder="Khối lượng giao dịch hôm nay">
                            </div>
                            <div>
                                <label>Volume trung bình 20 ngày</label>
                                <input type="number" id="vol-avg" placeholder="Volume TB 20 phiên">
                            </div>
                            <div>
                                <label>Hướng giá</label>
                                <select id="price-direction">
                                    <option value="up">Tăng</option>
                                    <option value="down">Giảm</option>
                                    <option value="flat">Đi ngang</option>
                                </select>
                            </div>
                            <div>
                                <label>% Thay đổi giá</label>
                                <input type="number" id="price-change" placeholder="% thay đổi so với hôm qua">
                            </div>
                        </div>
                        <button class="btn" onclick="analyzeVolume()">Phân Tích Volume</button>
                        <div id="volume-analysis-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="obv-calc" class="tab-content">
                        <h4>📈 Tính On-Balance Volume</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Chuỗi giá đóng cửa</label>
                                <input type="text" id="obv-prices" placeholder="100,102,98,105,107,103,99,101">
                            </div>
                            <div>
                                <label>Chuỗi khối lượng tương ứng</label>
                                <input type="text" id="obv-volumes" placeholder="1000,1200,800,1500,1300,900,700,1100">
                            </div>
                            <div>
                                <label>OBV khởi đầu</label>
                                <input type="number" id="obv-start" value="0" placeholder="Giá trị OBV ban đầu">
                            </div>
                        </div>
                        <button class="btn" onclick="calculateOBV()">Tính OBV</button>
                        <div id="obv-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="mfi-calc" class="tab-content">
                        <h4>💰 Tính Money Flow Index</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Chuỗi High (phân cách dấu phẩy)</label>
                                <input type="text" id="mfi-high" placeholder="105,107,103,110,112,108,104,106">
                            </div>
                            <div>
                                <label>Chuỗi Low</label>
                                <input type="text" id="mfi-low" placeholder="98,100,96,103,105,101,97,99">
                            </div>
                            <div>
                                <label>Chuỗi Close</label>
                                <input type="text" id="mfi-close" placeholder="102,104,100,107,109,105,101,103">
                            </div>
                            <div>
                                <label>Chuỗi Volume</label>
                                <input type="text" id="mfi-volume" placeholder="1000,1200,800,1500,1300,900,700,1100">
                            </div>
                            <div>
                                <label>Chu kỳ MFI</label>
                                <select id="mfi-period">
                                    <option value="14">14 kỳ</option>
                                    <option value="7">7 kỳ</option>
                                    <option value="21">21 kỳ</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn" onclick="calculateMFI()">Tính MFI</button>
                        <div id="mfi-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="volume-profile" class="tab-content">
                        <h4>📊 Volume Profile Analysis</h4>
                        <p><strong>Volume Profile</strong> cho biết khối lượng giao dịch tại từng mức giá, giúp xác định:</p>
                        <ul>
                            <li><strong>VPOC (Volume Point of Control):</strong> Mức giá có volume cao nhất</li>
                            <li><strong>High Volume Nodes:</strong> Vùng hỗ trợ/kháng cự mạnh</li>
                            <li><strong>Low Volume Nodes:</strong> Vùng giá có thể di chuyển nhanh</li>
                            <li><strong>Value Area:</strong> Vùng chứa 70% khối lượng giao dịch</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Ứng dụng:</strong> Xác định vùng giá công bằng và điểm vào/ra lệnh tối ưu
                        </div>
                    </div>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            Volume Spread Analysis (VSA)
                        </h3>
                        
                        <h4>📊 Các mẫu hình VSA quan trọng:</h4>
                        <ul>
                            <li><strong>High Volume + Small Spread:</strong> Absorption (hấp thụ)</li>
                            <li><strong>High Volume + Wide Spread:</strong> Distribution/Accumulation</li>
                            <li><strong>Low Volume + Wide Spread:</strong> Không có quan tâm</li>
                            <li><strong>Low Volume + Small Spread:</strong> Cân bằng</li>
                        </ul>
                        
                        <h4>🔍 Phân tích Smart Money:</h4>
                        <ul>
                            <li><strong>Effort vs Result:</strong> So sánh volume (effort) với price movement (result)</li>
                            <li><strong>Background volume:</strong> Volume bình thường, không có hoạt động đặc biệt</li>
                            <li><strong>Climactic volume:</strong> Volume cực cao, thường đánh dấu đỉnh/đáy</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">⏰</span>
                            Intraday Volume Patterns
                        </h3>
                        
                        <h4>🕘 U-Shape Pattern (Bình thường):</h4>
                        <ul>
                            <li><strong>Mở cửa:</strong> Volume cao do overnight news</li>
                            <li><strong>Giữa ngày:</strong> Volume thấp, giao dịch ít</li>
                            <li><strong>Đóng cửa:</strong> Volume tăng, chốt vị thế</li>
                        </ul>
                        
                        <h4>⚡ High Volume Events:</h4>
                        <ul>
                            <li><strong>Earnings release:</strong> Sau giờ đóng cửa</li>
                            <li><strong>News announcement:</strong> Volume đột biến</li>
                            <li><strong>Index rebalancing:</strong> Cuối quý</li>
                            <li><strong>Options expiry:</strong> Thứ 6 tuần thứ 3 hàng tháng</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- BIỂU ĐỒ NẾN -->
        <div id="candlestick" class="content-section">
            <!-- Cơ bản -->
            <div id="candlestick-basics" class="tab-content active">
                <h2 class="section-title">🕯️ Nghệ Thuật Đọc Biểu Đồ Nến Nhật</h2>
                
                <div class="highlight-box">
                    <h4>🎌 Lịch Sử Hình Thành</h4>
                    <p>Biểu đồ nến Nhật được phát triển bởi Munehisa Homma vào thế kỷ 18 để phân tích giá gạo. Steve Nison đã giới thiệu kỹ thuật này ra thế giới phương Tây, biến nó thành công cụ phân tích không thể thiếu.</p>
                </div>

                <div class="interactive-demo">
                    <h3>🏗️ Cấu Tạo Cây Nến</h3>
                    <canvas id="candle-structure" class="candlestick-canvas" width="800" height="400"></canvas>
                    <div class="demo-controls">
                        <button class="btn" onclick="drawCandleStructure('bullish')">Nến Tăng</button>
                        <button class="btn" onclick="drawCandleStructure('bearish')">Nến Giảm</button>
                        <button class="btn" onclick="drawCandleStructure('doji')">Doji</button>
                        <button class="btn" onclick="drawCandleStructure('all')">Tất Cả</button>
                    </div>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔧</span>
                            Thành Phần Cây Nến
                        </h3>
                        
                        <h4>🎯 Thân nến (Real Body):</h4>
                        <ul>
                            <li><strong>Định nghĩa:</strong> Khoảng cách giữa giá mở cửa và đóng cửa</li>
                            <li><strong>Thân dài:</strong> Sự áp đảo mạnh mẽ của một phe</li>
                            <li><strong>Thân ngắn:</strong> Cân bằng lực, do dự</li>
                            <li><strong>Màu sắc:</strong> Xanh (tăng), Đỏ (giảm)</li>
                        </ul>
                        
                        <h4>📏 Bóng nến (Shadow/Wick):</h4>
                        <ul>
                            <li><strong>Bóng trên:</strong> Từ thân nến đến giá cao nhất</li>
                            <li><strong>Bóng dưới:</strong> Từ thân nến đến giá thấp nhất</li>
                            <li><strong>Ý nghĩa:</strong> Cuộc chiến giữa hai phe trong phiên</li>
                            <li><strong>Bóng dài:</strong> Áp lực mạnh từ phe đối lập</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Quy tắc vàng:</strong> Thân nến = Kết quả, Bóng nến = Quá trình
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🧠</span>
                            Tâm Lý Đằng Sau Nến
                        </h3>
                        
                        <h4>🐂 Nến Tăng (Bullish Candle):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Giá đóng cửa > Giá mở cửa</li>
                            <li><strong>Tâm lý:</strong> Phe mua chiếm ưu thế</li>
                            <li><strong>Thân dài:</strong> Sự kiểm soát áp đảo</li>
                            <li><strong>Bóng ngắn:</strong> Ít gặp áp lực</li>
                        </ul>
                        
                        <h4>🐻 Nến Giảm (Bearish Candle):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Giá đóng cửa < Giá mở cửa</li>
                            <li><strong>Tâm lý:</strong> Phe bán chiếm ưu thế</li>
                            <li><strong>Thân dài:</strong> Áp lực bán mạnh</li>
                            <li><strong>Bóng ngắn:</strong> Ít được hỗ trợ</li>
                        </ul>
                        
                        <h4>⚖️ Doji (Cân bằng):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Giá mở ≈ Giá đóng</li>
                            <li><strong>Tâm lý:</strong> Do dự, không phe nào thắng</li>
                            <li><strong>Tín hiệu:</strong> Cảnh báo đảo chiều tiềm năng</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📐</span>
                            Phân Loại Theo Hình Dạng
                        </h3>
                        
                        <h4>🔥 Marubozu (Cường lực):</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Không có hoặc có rất ít bóng nến</li>
                            <li><strong>Ý nghĩa:</strong> Một phe áp đảo hoàn toàn</li>
                            <li><strong>Tín hiệu:</strong> Tiếp diễn xu hướng mạnh mẽ</li>
                        </ul>
                        
                        <h4>🌟 Doji Family:</h4>
                        <ul>
                            <li><strong>Standard Doji:</strong> Bóng trên và dưới bằng nhau</li>
                            <li><strong>Long-legged Doji:</strong> Bóng rất dài ở cả hai phía</li>
                            <li><strong>Dragonfly Doji:</strong> Chỉ có bóng dưới (chữ T)</li>
                            <li><strong>Gravestone Doji:</strong> Chỉ có bóng trên (chữ T ngược)</li>
                        </ul>
                        
                        <h4>⚖️ Spinning Tops:</h4>
                        <ul>
                            <li><strong>Đặc điểm:</strong> Thân nhỏ, bóng dài cả hai phía</li>
                            <li><strong>Ý nghĩa:</strong> Do dự, thiếu quyết đoán</li>
                            <li><strong>Bối cảnh:</strong> Quan trọng hơn hình dạng</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            Nguyên Tắc Đọc Nến
                        </h3>
                        
                        <h4>📍 Nguyên tắc cốt lõi:</h4>
                        <ol>
                            <li><strong>Bối cảnh là vua:</strong> Vị trí trong xu hướng quyết định ý nghĩa</li>
                            <li><strong>Xác nhận cần thiết:</strong> Chờ nến tiếp theo xác nhận</li>
                            <li><strong>Kết hợp đa yếu tố:</strong> Volume, S/R, chỉ báo khác</li>
                            <li><strong>Quản trị rủi ro:</strong> Luôn có stop-loss</li>
                        </ol>
                        
                        <h4>🔍 Các yếu tố cần xem xét:</h4>
                        <ul>
                            <li><strong>Vị trí xu hướng:</strong> Đỉnh, đáy, giữa xu hướng</li>
                            <li><strong>Khối lượng giao dịch:</strong> Xác nhận sức mạnh</li>
                            <li><strong>Ngưỡng S/R:</strong> Tăng độ tin cậy</li>
                            <li><strong>Chỉ báo khác:</strong> RSI, MACD confirmation</li>
                        </ul>
                        
                        <div class="warning-box">
                            <strong>⚠️ Sai lầm thường gặp:</strong> Chỉ dựa vào hình dạng nến mà bỏ qua bối cảnh
                        </div>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🧮 Công Cụ Phân Tích Nến Tương Tác</h3>
                    <div class="demo-controls">
                        <div>
                            <label>Giá mở cửa</label>
                            <input type="number" id="interactive-open" value="100" min="1">
                        </div>
                        <div>
                            <label>Giá cao nhất</label>
                            <input type="number" id="interactive-high" value="110" min="1">
                        </div>
                        <div>
                            <label>Giá thấp nhất</label>
                            <input type="number" id="interactive-low" value="95" min="1">
                        </div>
                        <div>
                            <label>Giá đóng cửa</label>
                            <input type="number" id="interactive-close" value="105" min="1">
                        </div>
                        <div>
                            <label>Xu hướng trước đó</label>
                            <select id="trend-context">
                                <option value="uptrend">Xu hướng tăng</option>
                                <option value="downtrend">Xu hướng giảm</option>
                                <option value="sideways">Đi ngang</option>
                            </select>
                        </div>
                        <div>
                            <label>Vị trí trong xu hướng</label>
                            <select id="trend-position-context">
                                <option value="beginning">Đầu xu hướng</option>
                                <option value="middle">Giữa xu hướng</option>
                                <option value="end">Cuối xu hướng</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeCandle()">Phân Tích Nến</button>
                    <canvas id="interactive-candle" class="candlestick-canvas" width="400" height="300"></canvas>
                    <div id="candle-analysis-result" class="result" style="display: none;"></div>
                </div>
            </div>

            <!-- Nến đơn -->
            <div id="candlestick-single" class="tab-content">
                <h2 class="section-title">🕯️ Các Mô Hình Nến Đơn</h2>
                
                <div class="pattern-showcase">
                    <div class="pattern-card" onclick="showPatternDetail('hammer')">
                        <canvas id="pattern-hammer" width="120" height="150"></canvas>
                        <h4>🔨 Hammer</h4>
                        <p>Đảo chiều tăng ở đáy</p>
                        <span class="reliability">Độ tin cậy: Cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('hanging-man')">
                        <canvas id="pattern-hanging-man" width="120" height="150"></canvas>
                        <h4>🪝 Hanging Man</h4>
                        <p>Cảnh báo giảm ở đỉnh</p>
                        <span class="reliability">Độ tin cậy: Trung bình</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('inverted-hammer')">
                        <canvas id="pattern-inverted-hammer" width="120" height="150"></canvas>
                        <h4>🔨 Inverted Hammer</h4>
                        <p>Đảo chiều tăng tiềm năng</p>
                        <span class="reliability">Độ tin cậy: Trung bình</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('shooting-star')">
                        <canvas id="pattern-shooting-star" width="120" height="150"></canvas>
                        <h4>🌠 Shooting Star</h4>
                        <p>Đảo chiều giảm ở đỉnh</p>
                        <span class="reliability">Độ tin cậy: Cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('doji-standard')">
                        <canvas id="pattern-doji-standard" width="120" height="150"></canvas>
                        <h4>➕ Standard Doji</h4>
                        <p>Do dự, cảnh báo đảo chiều</p>
                        <span class="reliability">Độ tin cậy: Thấp</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('dragonfly-doji')">
                        <canvas id="pattern-dragonfly-doji" width="120" height="150"></canvas>
                        <h4>🐲 Dragonfly Doji</h4>
                        <p>Đảo chiều tăng mạnh</p>
                        <span class="reliability">Độ tin cậy: Cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('gravestone-doji')">
                        <canvas id="pattern-gravestone-doji" width="120" height="150"></canvas>
                        <h4>🪦 Gravestone Doji</h4>
                        <p>Đảo chiều giảm mạnh</p>
                        <span class="reliability">Độ tin cậy: Cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('marubozu-bullish')">
                        <canvas id="pattern-marubozu-bullish" width="120" height="150"></canvas>
                        <h4>🟢 Bullish Marubozu</h4>
                        <p>Tiếp diễn xu hướng tăng</p>
                        <span class="reliability">Độ tin cậy: Rất cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('marubozu-bearish')">
                        <canvas id="pattern-marubozu-bearish" width="120" height="150"></canvas>
                        <h4>🔴 Bearish Marubozu</h4>
                        <p>Tiếp diễn xu hướng giảm</p>
                        <span class="reliability">Độ tin cậy: Rất cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('spinning-top')">
                        <canvas id="pattern-spinning-top" width="120" height="150"></canvas>
                        <h4>🌪️ Spinning Top</h4>
                        <p>Do dự, thiếu quyết đoán</p>
                        <span class="reliability">Độ tin cậy: Thấp</span>
                    </div>
                </div>

                <div id="pattern-detail" class="interactive-demo" style="display: none;">
                    <h3 id="pattern-detail-title">Chi Tiết Mô Hình</h3>
                    <div id="pattern-detail-content"></div>
                    <button class="btn btn-warning" onclick="hidePatternDetail()">Đóng</button>
                </div>
            </div>

            <!-- Nến đôi -->
            <div id="candlestick-double" class="tab-content">
                <h2 class="section-title">🕯️🕯️ Các Mô Hình Nến Đôi</h2>
                
                <div class="pattern-showcase">
                    <div class="pattern-card" onclick="showPatternDetail('bullish-engulfing')">
                        <canvas id="pattern-bullish-engulfing" width="160" height="150"></canvas>
                        <h4>📈 Bullish Engulfing</h4>
                        <p>Nhấn chìm tăng</p>
                        <span class="reliability">Độ tin cậy: Rất cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('bearish-engulfing')">
                        <canvas id="pattern-bearish-engulfing" width="160" height="150"></canvas>
                        <h4>📉 Bearish Engulfing</h4>
                        <p>Nhấn chìm giảm</p>
                        <span class="reliability">Độ tin cậy: Rất cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('bullish-harami')">
                        <canvas id="pattern-bullish-harami" width="160" height="150"></canvas>
                        <h4>🤰 Bullish Harami</h4>
                        <p>Mẹ bồng con tăng</p>
                        <span class="reliability">Độ tin cậy: Trung bình</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('bearish-harami')">
                        <canvas id="pattern-bearish-harami" width="160" height="150"></canvas>
                        <h4>🤱 Bearish Harami</h4>
                        <p>Mẹ bồng con giảm</p>
                        <span class="reliability">Độ tin cậy: Trung bình</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('piercing-line')">
                        <canvas id="pattern-piercing-line" width="160" height="150"></canvas>
                        <h4>⚡ Piercing Line</h4>
                        <p>Đường xuyên thủng</p>
                        <span class="reliability">Độ tin cậy: Cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('dark-cloud-cover')">
                        <canvas id="pattern-dark-cloud-cover" width="160" height="150"></canvas>
                        <h4>☁️ Dark Cloud Cover</h4>
                        <p>Mây đen che phủ</p>
                        <span class="reliability">Độ tin cậy: Cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('tweezer-top')">
                        <canvas id="pattern-tweezer-top" width="160" height="150"></canvas>
                        <h4>📌 Tweezer Top</h4>
                        <p>Đỉnh nhíp</p>
                        <span class="reliability">Độ tin cậy: Trung bình</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('tweezer-bottom')">
                        <canvas id="pattern-tweezer-bottom" width="160" height="150"></canvas>
                        <h4>📌 Tweezer Bottom</h4>
                        <p>Đáy nhíp</p>
                        <span class="reliability">Độ tin cậy: Trung bình</span>
                    </div>
                </div>
            </div>

            <!-- Nến ba -->
            <div id="candlestick-triple" class="tab-content">
                <h2 class="section-title">🕯️🕯️🕯️ Các Mô Hình Ba Nến</h2>
                
                <div class="pattern-showcase">
                    <div class="pattern-card" onclick="showPatternDetail('morning-star')">
                        <canvas id="pattern-morning-star" width="200" height="150"></canvas>
                        <h4>🌅 Morning Star</h4>
                        <p>Sao mai - Đảo chiều tăng</p>
                        <span class="reliability">Độ tin cậy: Rất cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('evening-star')">
                        <canvas id="pattern-evening-star" width="200" height="150"></canvas>
                        <h4>🌆 Evening Star</h4>
                        <p>Sao hôm - Đảo chiều giảm</p>
                        <span class="reliability">Độ tin cậy: Rất cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('three-white-soldiers')">
                        <canvas id="pattern-three-white-soldiers" width="200" height="150"></canvas>
                        <h4>⚪⚪⚪ Three White Soldiers</h4>
                        <p>Ba chàng lính trắng</p>
                        <span class="reliability">Độ tin cậy: Rất cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('three-black-crows')">
                        <canvas id="pattern-three-black-crows" width="200" height="150"></canvas>
                        <h4>⚫⚫⚫ Three Black Crows</h4>
                        <p>Ba con quạ đen</p>
                        <span class="reliability">Độ tin cậy: Rất cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('abandoned-baby-bullish')">
                        <canvas id="pattern-abandoned-baby-bullish" width="200" height="150"></canvas>
                        <h4>👶 Abandoned Baby (Bull)</h4>
                        <p>Em bé bị bỏ rơi tăng</p>
                        <span class="reliability">Độ tin cậy: Rất cao</span>
                    </div>

                    <div class="pattern-card" onclick="showPatternDetail('abandoned-baby-bearish')">
                        <canvas id="pattern-abandoned-baby-bearish" width="200" height="150"></canvas>
                        <h4>👶 Abandoned Baby (Bear)</h4>
                        <p>Em bé bị bỏ rơi giảm</p>
                        <span class="reliability">Độ tin cậy: Rất cao</span>
                    </div>
                </div>
            </div>

            <!-- Nâng cao -->
            <div id="candlestick-advanced" class="tab-content">
                <h2 class="section-title">🎓 Kỹ Thuật Nến Nâng Cao</h2>
                
                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔍</span>
                            Kết Hợp với Volume
                        </h3>
                        
                        <h4>📊 Xác nhận bằng khối lượng:</h4>
                        <ul>
                            <li><strong>Mô hình đảo chiều tăng:</strong> Cần volume tăng ở nến xác nhận</li>
                            <li><strong>Mô hình đảo chiều giảm:</strong> Volume cao làm tăng độ tin cậy</li>
                            <li><strong>Breakout patterns:</strong> Volume đột biến xác nhận phá vỡ</li>
                            <li><strong>False signals:</strong> Volume thấp thường báo hiệu tín hiệu giả</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Quy tắc:</strong> Volume xác nhận, không có volume = không tin tưởng
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            Nến tại S/R
                        </h3>
                        
                        <h4>🛡️ Tại ngưỡng hỗ trợ:</h4>
                        <ul>
                            <li><strong>Hammer, Dragonfly Doji:</strong> Tín hiệu mạnh mẽ</li>
                            <li><strong>Bullish Engulfing:</strong> Xác nhận hỗ trợ giữ vững</li>
                            <li><strong>Morning Star:</strong> Đảo chiều từ support quan trọng</li>
                        </ul>
                        
                        <h4>🚧 Tại ngưỡng kháng cự:</h4>
                        <ul>
                            <li><strong>Shooting Star, Gravestone:</strong> Từ chối mức cao</li>
                            <li><strong>Bearish Engulfing:</strong> Kháng cự giữ vững</li>
                            <li><strong>Evening Star:</strong> Đảo chiều từ resistance</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📈</span>
                            Multiple Timeframe Analysis
                        </h3>
                        
                        <h4>🔍 Phân tích đa khung thời gian:</h4>
                        <ul>
                            <li><strong>Weekly chart:</strong> Xác định xu hướng chính</li>
                            <li><strong>Daily chart:</strong> Tìm mô hình nến chính</li>
                            <li><strong>4H chart:</strong> Xác nhận và timing</li>
                            <li><strong>1H chart:</strong> Điểm vào cụ thể</li>
                        </ul>
                        
                        <h4>⚖️ Sự đồng thuận:</h4>
                        <ul>
                            <li><strong>Cùng hướng:</strong> Tăng độ tin cậy</li>
                            <li><strong>Mâu thuẫn:</strong> Cần thận trọng</li>
                            <li><strong>Prioritize:</strong> Khung lớn quan trọng hơn</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🧮</span>
                            Đo lường Target
                        </h3>
                        
                        <h4>📏 Calculated moves:</h4>
                        <ul>
                            <li><strong>Pattern height:</strong> Đo chiều cao mô hình</li>
                            <li><strong>Projection:</strong> Chiếu từ điểm breakout</li>
                            <li><strong>Fibonacci extension:</strong> 127.2%, 161.8%</li>
                            <li><strong>Previous S/R:</strong> Mục tiêu logic</li>
                        </ul>
                        
                        <div class="formula-box">
                            Target = Breakout Point ± Pattern Height
                        </div>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🧪 Mô Phỏng Giao Dịch Nến</h3>
                    <canvas id="trading-simulation" class="candlestick-canvas" width="800" height="500"></canvas>
                    <div class="demo-controls">
                        <button class="btn" onclick="startTradingSimulation()">Bắt Đầu Mô Phỏng</button>
                        <button class="btn btn-success" onclick="placeBuyOrder()">Lệnh Mua</button>
                        <button class="btn btn-danger" onclick="placeSellOrder()">Lệnh Bán</button>
                        <button class="btn btn-warning" onclick="closePosition()">Đóng Vị Thế</button>
                    </div>
                    <div id="trading-stats" class="result">
                        <h4>📊 Thống Kê Giao Dịch</h4>
                        <p>Vốn hiện tại: <span id="current-capital">100,000</span> VND</p>
                        <p>Số giao dịch: <span id="trade-count">0</span></p>
                        <p>Tỷ lệ thắng: <span id="win-rate">0%</span></p>
                        <p>P&L: <span id="total-pnl">0</span> VND</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CHIẾN LƯỢC -->
        <div id="strategies" class="content-section">
            <!-- SEPA Method -->
            <div id="strategies-sepa" class="tab-content active">
                <h2 class="section-title">🎯 Phương Pháp SEPA của Mark Minervini</h2>
                
                <div class="highlight-box">
                    <h4>🏆 Về Mark Minervini</h4>
                    <p>Mark Minervini là nhà giao dịch huyền thoại, từng đạt tỷ suất sinh lợi 33,500% trong 5 năm. Phương pháp SEPA của ông kết hợp chặt chẽ phân tích cơ bản và kỹ thuật, tập trung vào "siêu cổ phiếu".</p>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📈</span>
                            S - Specific Entry Point Analysis
                        </h3>
                        
                        <h4>🎯 5 Yếu tố cốt lõi:</h4>
                        <ol>
                            <li><strong>Trend (Xu hướng):</strong> Cổ phiếu ở Giai đoạn 2</li>
                            <li><strong>Fundamentals (Nền tảng):</strong> Tăng trưởng mạnh</li>
                            <li><strong>Catalyst (Chất xúc tác):</strong> Yếu tố thúc đẩy</li>
                            <li><strong>Entry (Điểm vào):</strong> Điểm Pivot hợp lý</li>
                            <li><strong>Exit (Điểm thoát):</strong> Quản trị rủi ro chặt chẽ</li>
                        </ol>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📊</span>
                            Giai Đoạn 2 - Stage 2
                        </h3>
                        
                        <h4>🔍 Đặc điểm nhận dạng:</h4>
                        <ul>
                            <li><strong>Giá trên MA:</strong> Price > MA50 > MA150 > MA200</li>
                            <li><strong>MA dốc lên:</strong> Tất cả đường MA đều hướng lên</li>
                            <li><strong>RS Line tăng:</strong> Outperform thị trường chung</li>
                            <li><strong>Volume tăng:</strong> Khi giá tăng</li>
                        </ul>
                        
                        <h4>📈 Tại sao Stage 2?</h4>
                        <ul>
                            <li><strong>Stage 1:</strong> Tích lũy - sideway</li>
                            <li><strong>Stage 2:</strong> Tăng giá - xu hướng tăng mạnh</li>
                            <li><strong>Stage 3:</strong> Phân phối - sideway ở đỉnh</li>
                            <li><strong>Stage 4:</strong> Suy giảm - xu hướng giảm</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Mục tiêu:</strong> Chỉ giao dịch cổ phiếu Stage 2
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">💪</span>
                            Nền Tảng Cơ Bản Mạnh
                        </h3>
                        
                        <h4>📊 Tăng trưởng đột phá:</h4>
                        <ul>
                            <li><strong>EPS growth:</strong> Tăng 25%+ quarterly</li>
                            <li><strong>Sales growth:</strong> Tăng trưởng doanh thu mạnh</li>
                            <li><strong>ROE improvement:</strong> Hiệu quả vốn tăng</li>
                            <li><strong>Margin expansion:</strong> Biên lợi nhuận mở rộng</li>
                        </ul>
                        
                        <h4>🏆 Tiêu chí chọn lọc:</h4>
                        <ul>
                            <li><strong>Industry leader:</strong> Dẫn đầu trong ngành</li>
                            <li><strong>Innovation:</strong> Sản phẩm/dịch vụ mới</li>
                            <li><strong>Management:</strong> Đội ngũ quản lý giỏi</li>
                            <li><strong>Market share:</strong> Thị phần tăng</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">⚡</span>
                            Chất Xúc Tác (Catalyst)
                        </h3>
                        
                        <h4>🚀 Các loại catalyst:</h4>
                        <ul>
                            <li><strong>New product launch:</strong> Sản phẩm mới đột phá</li>
                            <li><strong>Major contract:</strong> Hợp đồng lớn</li>
                            <li><strong>New CEO:</strong> CEO tài năng mới</li>
                            <li><strong>Technology breakthrough:</strong> Đột phá công nghệ</li>
                            <li><strong>Market expansion:</strong> Mở rộng thị trường mới</li>
                        </ul>
                        
                        <h4>💡 Ví dụ thực tế:</h4>
                        <ul>
                            <li><strong>Apple:</strong> iPhone ra mắt (2007)</li>
                            <li><strong>Tesla:</strong> Model S và Gigafactory</li>
                            <li><strong>Netflix:</strong> Chuyển sang streaming</li>
                        </ul>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🧮 SEPA Stock Screener</h3>
                    <div class="demo-controls">
                        <div>
                            <label>Giá hiện tại</label>
                            <input type="number" id="sepa-price" placeholder="Current price">
                        </div>
                        <div>
                            <label>MA50</label>
                            <input type="number" id="sepa-ma50" placeholder="50-day MA">
                        </div>
                        <div>
                            <label>MA150</label>
                            <input type="number" id="sepa-ma150" placeholder="150-day MA">
                        </div>
                        <div>
                            <label>MA200</label>
                            <input type="number" id="sepa-ma200" placeholder="200-day MA">
                        </div>
                        <div>
                            <label>EPS Growth (%)</label>
                            <input type="number" id="sepa-eps-growth" placeholder="Quarterly EPS growth">
                        </div>
                        <div>
                            <label>Sales Growth (%)</label>
                            <input type="number" id="sepa-sales-growth" placeholder="Revenue growth">
                        </div>
                        <div>
                            <label>ROE (%)</label>
                            <input type="number" id="sepa-roe" placeholder="Return on Equity">
                        </div>
                        <div>
                            <label>RS Rating (1-99)</label>
                            <input type="number" id="sepa-rs" min="1" max="99" placeholder="Relative Strength vs market">
                        </div>
                    </div>
                    <button class="btn" onclick="evaluateSEPA()">Đánh Giá SEPA</button>
                    <div id="sepa-result" class="result" style="display: none;"></div>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            VCP - Volatility Contraction Pattern
                        </h3>
                        
                        <h4>📈 Đặc điểm VCP:</h4>
                        <ul>
                            <li><strong>Các đợt pullback:</strong> Biên độ giảm dần</li>
                            <li><strong>Volume contraction:</strong> Khối lượng cạn dần</li>
                            <li><strong>Tight price action:</strong> Biến động thu hẹp</li>
                            <li><strong>3-4 pullbacks:</strong> Thường có 3-4 đợt điều chỉnh</li>
                        </ul>
                        
                        <div class="formula-box">
                            Pullback sequence: 15-20% → 10-15% → 5-10% → 3-5%
                        </div>
                        
                        <h4>🎯 Điểm mua (Pivot Point):</h4>
                        <ul>
                            <li><strong>Breakout:</strong> Vượt đỉnh của base</li>
                            <li><strong>Volume spike:</strong> Khối lượng tăng đột biến</li>
                            <li><strong>Strong close:</strong> Đóng cửa gần high của ngày</li>
                            <li><strong>Follow through:</strong> Tiếp tục tăng những ngày sau</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🛡️</span>
                            Quản Trị Rủi Ro
                        </h3>
                        
                        <h4>📍 Stop Loss Rules:</h4>
                        <ul>
                            <li><strong>Initial stop:</strong> 7-8% dưới điểm mua</li>
                            <li><strong>Never average down:</strong> Không bao giờ mua thêm khi lỗ</li>
                            <li><strong>Cut losses quickly:</strong> Cắt lỗ nhanh, để lợi nhuận chạy</li>
                            <li><strong>Position sizing:</strong> Không quá 10% một vị thế</li>
                        </ul>
                        
                        <h4>💰 Take Profit Strategy:</h4>
                        <ul>
                            <li><strong>Partial profits:</strong> Chốt 25% khi lãi 20-25%</li>
                            <li><strong>Trail stop:</strong> Trailing stop theo MA10 weekly</li>
                            <li><strong>Distribution signs:</strong> Bán khi thấy dấu hiệu phân phối</li>
                        </ul>
                        
                        <div class="warning-box">
                            <strong>⚠️ Quy tắc vàng:</strong> Bảo vệ vốn là ưu tiên số 1
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tích hợp -->
            <div id="strategies-integrated" class="tab-content">
                <h2 class="section-title">🔄 Chiến Lược Tích Hợp FA + TA</h2>
                
                <div class="learning-path">
                    <h3>🎯 Quy Trình Đầu Tư Tích Hợp 6 Bước</h3>
                    <div class="learning-steps">
                        <div class="learning-step">
                            <div class="step-number">1</div>
                            <h4>Macro Analysis</h4>
                            <p>Phân tích kinh tế vĩ mô và chọn ngành</p>
                        </div>
                        <div class="learning-step">
                            <div class="step-number">2</div>
                            <h4>Stock Screening</h4>
                            <p>Sàng lọc cổ phiếu theo tiêu chí FA</p>
                        </div>
                        <div class="learning-step">
                            <div class="step-number">3</div>
                            <h4>Technical Filter</h4>
                            <p>Lọc theo xu hướng và stage</p>
                        </div>
                        <div class="learning-step">
                            <div class="step-number">4</div>
                            <h4>Entry Setup</h4>
                            <p>Tìm điểm vào với risk/reward tốt</p>
                        </div>
                        <div class="learning-step">
                            <div class="step-number">5</div>
                            <h4>Risk Management</h4>
                            <p>Đặt stop loss và position size</p>
                        </div>
                        <div class="learning-step">
                            <div class="step-number">6</div>
                            <h4>Exit Strategy</h4>
                            <p>Quản lý vị thế và chốt lời</p>
                        </div>
                    </div>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🌍</span>
                            Bước 1: Macro & Sector Analysis
                        </h3>
                        
                        <h4>📊 Economic Indicators:</h4>
                        <ul>
                            <li><strong>GDP Growth:</strong> Tăng trưởng kinh tế tổng thể</li>
                            <li><strong>Interest Rates:</strong> Lãi suất ảnh hưởng định giá</li>
                            <li><strong>Inflation:</strong> Lạm phát tác động chi phí</li>
                            <li><strong>Currency:</strong> Tỷ giá với các ngành xuất/nhập khẩu</li>
                        </ul>
                        
                        <h4>🏭 Sector Rotation:</h4>
                        <ul>
                            <li><strong>Early Cycle:</strong> Technology, Consumer Discretionary</li>
                            <li><strong>Mid Cycle:</strong> Industrials, Materials</li>
                            <li><strong>Late Cycle:</strong> Energy, Financials</li>
                            <li><strong>Recession:</strong> Utilities, Consumer Staples</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔍</span>
                            Bước 2: Fundamental Screening
                        </h3>
                        
                        <h4>💪 Growth Criteria:</h4>
                        <ul>
                            <li><strong>Revenue Growth:</strong> >15% annually</li>
                            <li><strong>EPS Growth:</strong> >20% annually</li>
                            <li><strong>ROE:</strong> >15% consistently</li>
                            <li><strong>Debt/Equity:</strong> <0.5 (trừ tài chính)</li>
                        </ul>
                        
                        <h4>💎 Quality Indicators:</h4>
                        <ul>
                            <li><strong>Market Leadership:</strong> Top 3 in industry</li>
                            <li><strong>Competitive Moat:</strong> Sustainable advantage</li>
                            <li><strong>Management Quality:</strong> Track record & integrity</li>
                            <li><strong>Future Catalysts:</strong> Growth drivers</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📈</span>
                            Bước 3: Technical Filter
                        </h3>
                        
                        <h4>🎯 Stage 2 Confirmation:</h4>
                        <ul>
                            <li><strong>Price > MA:</strong> Above 50, 150, 200 day MA</li>
                            <li><strong>MA Alignment:</strong> 50 > 150 > 200, all rising</li>
                            <li><strong>Relative Strength:</strong> Outperforming market</li>
                            <li><strong>Volume Pattern:</strong> Higher on up days</li>
                        </ul>
                        
                        <h4>⚡ Momentum Indicators:</h4>
                        <ul>
                            <li><strong>RSI:</strong> Between 40-80 (not oversold/overbought)</li>
                            <li><strong>MACD:</strong> Above zero line and rising</li>
                            <li><strong>Price Pattern:</strong> Higher highs, higher lows</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            Bước 4: Entry Setup
                        </h3>
                        
                        <h4>📊 Base Patterns:</h4>
                        <ul>
                            <li><strong>Cup with Handle:</strong> 7+ weeks base</li>
                            <li><strong>VCP:</strong> Volatility contraction</li>
                            <li><strong>Flag/Pennant:</strong> Short consolidation</li>
                            <li><strong>Flat Base:</strong> Tight sideways action</li>
                        </ul>
                        
                        <h4>🎯 Buy Points:</h4>
                        <ul>
                            <li><strong>Breakout:</strong> Above resistance with volume</li>
                            <li><strong>Pullback:</strong> To 10-day MA in uptrend</li>
                            <li><strong>Follow-through:</strong> After market confirmation</li>
                        </ul>
                        
                        <div class="formula-box">
                            Ideal Buy Point = Pivot High + $0.10
                        </div>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🧮 Integrated Strategy Calculator</h3>
                    
                    <div class="tabs">
                        <div class="tab active" onclick="showTab('integrated-screen')">Stock Screener</div>
                        <div class="tab" onclick="showTab('integrated-timing')">Entry Timing</div>
                        <div class="tab" onclick="showTab('integrated-risk')">Risk Management</div>
                    </div>

                    <div id="integrated-screen" class="tab-content active">
                        <h4>🔍 Fundamental + Technical Screening</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Revenue Growth (%)</label>
                                <input type="number" id="int-revenue-growth" placeholder="Annual revenue growth">
                            </div>
                            <div>
                                <label>EPS Growth (%)</label>
                                <input type="number" id="int-eps-growth" placeholder="Annual EPS growth">
                            </div>
                            <div>
                                <label>ROE (%)</label>
                                <input type="number" id="int-roe" placeholder="Return on Equity">
                            </div>
                            <div>
                                <label>Price vs MA50</label>
                                <select id="int-ma50">
                                    <option value="above">Above MA50</option>
                                    <option value="below">Below MA50</option>
                                </select>
                            </div>
                            <div>
                                <label>Relative Strength (1-99)</label>
                                <input type="number" id="int-rs" min="1" max="99" placeholder="RS Rating">
                            </div>
                            <div>
                                <label>Volume Trend</label>
                                <select id="int-volume">
                                    <option value="increasing">Increasing</option>
                                    <option value="decreasing">Decreasing</option>
                                    <option value="neutral">Neutral</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn" onclick="screenIntegratedStock()">Screen Stock</button>
                        <div id="integrated-screen-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="integrated-timing" class="tab-content">
                        <h4>⏰ Entry Timing Analysis</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Base Pattern</label>
                                <select id="base-pattern">
                                    <option value="cup-handle">Cup with Handle</option>
                                    <option value="vcp">VCP</option>
                                    <option value="flag">Flag/Pennant</option>
                                    <option value="flat-base">Flat Base</option>
                                </select>
                            </div>
                            <div>
                                <label>Weeks in Base</label>
                                <input type="number" id="weeks-base" min="1" placeholder="Duration of base">
                            </div>
                            <div>
                                <label>Breakout Volume (%)</label>
                                <input type="number" id="breakout-volume" placeholder="% above average volume">
                            </div>
                            <div>
                                <label>Distance from Pivot (%)</label>
                                <input type="number" id="pivot-distance" placeholder="% above buy point">
                            </div>
                        </div>
                        <button class="btn" onclick="analyzeEntryTiming()">Analyze Timing</button>
                        <div id="timing-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="integrated-risk" class="tab-content">
                        <h4>🛡️ Risk Management Calculator</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Account Size (VND)</label>
                                <input type="number" id="account-size" placeholder="Total account value">
                            </div>
                            <div>
                                <label>Risk per Trade (%)</label>
                                <input type="number" id="risk-per-trade" value="2" min="0.5" max="5" step="0.5">
                            </div>
                            <div>
                                <label>Entry Price (VND)</label>
                                <input type="number" id="entry-price" placeholder="Buy price">
                            </div>
                            <div>
                                <label>Stop Loss Price (VND)</label>
                                <input type="number" id="stop-price" placeholder="Stop loss price">
                            </div>
                            <div>
                                <label>Target Price (VND)</label>
                                <input type="number" id="target-price" placeholder="Take profit target">
                            </div>
                        </div>
                        <button class="btn" onclick="calculateRiskManagement()">Calculate Position</button>
                        <div id="risk-result" class="result" style="display: none;"></div>
                    </div>
                </div>
            </div>

            <!-- Market Timing -->
            <div id="strategies-timing" class="tab-content">
                <h2 class="section-title">⏰ Market Timing Strategies</h2>
                
                <div class="warning-box">
                    <h4>⚠️ Cảnh Báo Quan Trọng</h4>
                    <p>Market timing là một trong những chiến lược khó nhất trong đầu tư. Ngay cả các chuyên gia cũng thường thất bại. Chỉ nên áp dụng với một phần nhỏ vốn và có kinh nghiệm sâu.</p>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📊</span>
                            Market Cycle Analysis
                        </h3>
                        
                        <h4>🔄 4 Giai đoạn của Market Cycle:</h4>
                        <ul>
                            <li><strong>Accumulation:</strong> Smart money mua, sideways</li>
                            <li><strong>Mark-up:</strong> Xu hướng tăng, public tham gia</li>
                            <li><strong>Distribution:</strong> Smart money bán, volatile</li>
                            <li><strong>Mark-down:</strong> Xu hướng giảm, panic selling</li>
                        </ul>
                        
                        <h4>📈 Indicators theo từng giai đoạn:</h4>
                        <ul>
                            <li><strong>Volume:</strong> Tăng trong markup/markdown</li>
                            <li><strong>Breadth:</strong> % cổ phiếu tăng vs giảm</li>
                            <li><strong>Sentiment:</strong> VIX, Put/Call ratio</li>
                            <li><strong>Technical:</strong> MA crossovers, breakouts</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            Trend Following
                        </h3>
                        
                        <h4>📊 Moving Average Systems:</h4>
                        <ul>
                            <li><strong>Golden Cross:</strong> MA50 cross above MA200</li>
                            <li><strong>Death Cross:</strong> MA50 cross below MA200</li>
                            <li><strong>Price vs MA:</strong> Above/below for trend direction</li>
                            <li><strong>Multiple MA:</strong> 10, 20, 50, 200 alignment</li>
                        </ul>
                        
                        <h4>⚡ Momentum Indicators:</h4>
                        <ul>
                            <li><strong>MACD:</strong> Signal line crossovers</li>
                            <li><strong>RSI:</strong> Trend strength (not overbought/oversold)</li>
                            <li><strong>ADX:</strong> Trend strength measurement</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Ưu điểm:</strong> Bắt được xu hướng lớn, giảm rủi ro
                            <br><strong>Nhược điểm:</strong> Nhiều whipsaws, lag signals
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🔄</span>
                            Mean Reversion
                        </h3>
                        
                        <h4>📉 Contrarian Approach:</h4>
                        <ul>
                            <li><strong>Oversold bounces:</strong> RSI < 30, về MA</li>
                            <li><strong>Support tests:</strong> Mua tại support cũ</li>
                            <li><strong>Bollinger Bands:</strong> Từ lower band về middle</li>
                            <li><strong>VIX spikes:</strong> Fear extreme → reversal</li>
                        </ul>
                        
                        <h4>🎯 Best Markets for Mean Reversion:</h4>
                        <ul>
                            <li><strong>Range-bound markets:</strong> Sideway markets</li>
                            <li><strong>Short-term timeframes:</strong> Intraday, swing</li>
                            <li><strong>High volatility periods:</strong> Earnings, news</li>
                        </ul>
                        
                        <div class="warning-box">
                            <strong>⚠️ Risk:</strong> "Trend is your friend" - không fight xu hướng mạnh
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🌊</span>
                            Elliott Wave Theory
                        </h3>
                        
                        <h4>📊 5-3 Wave Pattern:</h4>
                        <ul>
                            <li><strong>Impulse Waves (1-2-3-4-5):</strong> Theo xu hướng chính</li>
                            <li><strong>Corrective Waves (A-B-C):</strong> Điều chỉnh ngược xu hướng</li>
                            <li><strong>Wave 3:</strong> Thường mạnh và dài nhất</li>
                            <li><strong>Wave 2 & 4:</strong> Thường có tính alternation</li>
                        </ul>
                        
                        <h4>📏 Fibonacci Relationships:</h4>
                        <ul>
                            <li><strong>Wave 2:</strong> Thường retrace 50-61.8% của Wave 1</li>
                            <li><strong>Wave 3:</strong> Thường = 161.8% của Wave 1</li>
                            <li><strong>Wave 4:</strong> Thường retrace 38.2% của Wave 3</li>
                            <li><strong>Wave 5:</strong> Thường = Wave 1 hoặc 61.8% của Wave 1+3</li>
                        </ul>
                        
                        <div class="result">
                            <strong>Ứng dụng:</strong> Dự báo target và reversal points
                        </div>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>📊 Market Timing Dashboard</h3>
                    
                    <div class="tabs">
                        <div class="tab active" onclick="showTab('timing-signals')">Timing Signals</div>
                        <div class="tab" onclick="showTab('sentiment-gauge')">Sentiment Gauge</div>
                        <div class="tab" onclick="showTab('cycle-analysis')">Cycle Analysis</div>
                    </div>

                    <div id="timing-signals" class="tab-content active">
                        <h4>📊 Current Market Signals</h4>
                        <div class="demo-controls">
                            <div>
                                <label>VN-Index vs MA200</label>
                                <select id="index-ma200">
                                    <option value="above">Above MA200</option>
                                    <option value="below">Below MA200</option>
                                </select>
                            </div>
                            <div>
                                <label>Golden Cross Status</label>
                                <select id="golden-cross">
                                    <option value="bullish">MA50 > MA200</option>
                                    <option value="bearish">MA50 < MA200</option>
                                </select>
                            </div>
                            <div>
                                <label>Market Breadth (%)</label>
                                <input type="number" id="market-breadth" min="0" max="100" placeholder="% stocks above MA50">
                            </div>
                            <div>
                                <label>VIX Level</label>
                                <select id="vix-level">
                                    <option value="low">Low (<15) - Complacency</option>
                                    <option value="normal">Normal (15-25)</option>
                                    <option value="high">High (25-35) - Fear</option>
                                    <option value="extreme">Extreme (>35) - Panic</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn" onclick="analyzeMarketTiming()">Analyze Market</button>
                        <div id="timing-signals-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="sentiment-gauge" class="tab-content">
                        <h4>😱 Market Sentiment Analysis</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Put/Call Ratio</label>
                                <input type="number" id="put-call-ratio" step="0.01" placeholder="Put volume / Call volume">
                            </div>
                            <div>
                                <label>Margin Debt (Trend)</label>
                                <select id="margin-debt">
                                    <option value="increasing">Increasing (Bullish)</option>
                                    <option value="decreasing">Decreasing (Bearish)</option>
                                </select>
                            </div>
                            <div>
                                <label>Insider Trading</label>
                                <select id="insider-trading">
                                    <option value="buying">Net Insider Buying</option>
                                    <option value="selling">Net Insider Selling</option>
                                </select>
                            </div>
                            <div>
                                <label>News Sentiment</label>
                                <select id="news-sentiment">
                                    <option value="very-bullish">Very Bullish</option>
                                    <option value="bullish">Bullish</option>
                                    <option value="neutral">Neutral</option>
                                    <option value="bearish">Bearish</option>
                                    <option value="very-bearish">Very Bearish</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn" onclick="analyzeSentiment()">Analyze Sentiment</button>
                        <div id="sentiment-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="cycle-analysis" class="tab-content">
                        <h4>🔄 Market Cycle Position</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Time in Current Trend (months)</label>
                                <input type="number" id="trend-duration" min="1" placeholder="Months in current direction">
                            </div>
                            <div>
                                <label>Magnitude of Move (%)</label>
                                <input type="number" id="move-magnitude" placeholder="% from last major low/high">
                            </div>
                            <div>
                                <label>Volume Characteristics</label>
                                <select id="volume-char">
                                    <option value="distribution">High volume on down days</option>
                                    <option value="accumulation">High volume on up days</option>
                                    <option value="neutral">Balanced volume</option>
                                </select>
                            </div>
                            <div>
                                <label>Smart Money Activity</label>
                                <select id="smart-money">
                                    <option value="accumulating">Accumulating</option>
                                    <option value="distributing">Distributing</option>
                                    <option value="neutral">Neutral</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn" onclick="analyzeCycle()">Analyze Cycle</button>
                        <div id="cycle-result" class="result" style="display: none;"></div>
                    </div>
                </div>
            </div>

            <!-- Quản trị rủi ro -->
            <div id="strategies-risk" class="tab-content">
                <h2 class="section-title">🛡️ Quản Trị Rủi Ro Chuyên Nghiệp</h2>
                
                <div class="highlight-box">
                    <h4>💡 Nguyên Tắc Cốt Lõi</h4>
                    <p><em>"Quy tắc số 1: Không bao giờ để mất tiền. Quy tắc số 2: Không bao giờ quên quy tắc số 1."</em> - Warren Buffett</p>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">⚖️</span>
                            Position Sizing
                        </h3>
                        
                        <h4>📊 Fixed Percentage Method:</h4>
                        <div class="formula-box">
                            Position Size = (Account Size × Risk%) / (Entry Price - Stop Loss Price)
                        </div>
                        
                        <h4>🎯 Kelly Criterion:</h4>
                        <div class="formula-box">
                            Kelly % = (Win Rate × Avg Win - Loss Rate × Avg Loss) / Avg Win
                        </div>
                        
                        <h4>💰 Typical Risk Levels:</h4>
                        <ul>
                            <li><strong>Conservative:</strong> 1-2% per trade</li>
                            <li><strong>Moderate:</strong> 2-3% per trade</li>
                            <li><strong>Aggressive:</strong> 3-5% per trade</li>
                            <li><strong>Never exceed:</strong> 10% in single position</li>
                        </ul>
                        
                        <div class="warning-box">
                            <strong>⚠️ Lưu ý:</strong> Risk% là % vốn có thể mất, không phải % đầu tư
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🛑</span>
                            Stop Loss Strategies
                        </h3>
                        
                        <h4>📍 Types of Stop Loss:</h4>
                        <ul>
                            <li><strong>Percentage Stop:</strong> 7-8% dưới entry price</li>
                            <li><strong>Technical Stop:</strong> Dưới support, pattern</li>
                            <li><strong>Volatility Stop:</strong> Dựa trên ATR</li>
                            <li><strong>Time Stop:</strong> Đóng sau X ngày không di chuyển</li>
                        </ul>
                        
                        <h4>🔄 Trailing Stop Methods:</h4>
                        <ul>
                            <li><strong>Moving Average Trail:</strong> Theo MA10, MA20</li>
                            <li><strong>Percentage Trail:</strong> 10-15% từ highest high</li>
                            <li><strong>ATR Trail:</strong> 2-3 × ATR từ high</li>
                            <li><strong>Chandelier Exit:</strong> Highest high - 3×ATR</li>
                        </ul>
                        
                        <div class="formula-box">
                            ATR Trailing Stop = Highest High - (ATR × Multiplier)
                        </div>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🎯</span>
                            Risk/Reward Ratios
                        </h3>
                        
                        <h4>⚖️ Minimum R:R Ratios:</h4>
                        <ul>
                            <li><strong>Day Trading:</strong> 1:1.5 (win rate >60%)</li>
                            <li><strong>Swing Trading:</strong> 1:2 (win rate >50%)</li>
                            <li><strong>Position Trading:</strong> 1:3 (win rate >40%)</li>
                            <li><strong>Ideal Setups:</strong> 1:4+ với high probability</li>
                        </ul>
                        
                        <h4>🧮 Expected Value Calculation:</h4>
                        <div class="formula-box">
                            EV = (Win Rate × Avg Win) - (Loss Rate × Avg Loss)
                        </div>
                        
                        <h4>📊 Example Analysis:</h4>
                        <ul>
                            <li><strong>Win Rate:</strong> 45%</li>
                            <li><strong>Avg Win:</strong> 6R</li>
                            <li><strong>Avg Loss:</strong> 1R</li>
                            <li><strong>EV:</strong> (0.45×6) - (0.55×1) = 2.15R positive</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📊</span>
                            Portfolio Diversification
                        </h3>
                        
                        <h4>🎯 Diversification Rules:</h4>
                        <ul>
                            <li><strong>Sector Limits:</strong> Max 20-25% per sector</li>
                            <li><strong>Position Limits:</strong> Max 10% per stock</li>
                            <li><strong>Correlation:</strong> Avoid highly correlated positions</li>
                            <li><strong>Geographic:</strong> Mix domestic and international</li>
                        </ul>
                        
                        <h4>⚖️ Asset Allocation:</h4>
                        <ul>
                            <li><strong>Growth Stocks:</strong> 30-50%</li>
                            <li><strong>Value Stocks:</strong> 20-30%</li>
                            <li><strong>Cash/Bonds:</strong> 10-20%</li>
                            <li><strong>Alternatives:</strong> 5-15% (REITs, commodities)</li>
                        </ul>
                        
                        <h4>🔄 Rebalancing:</h4>
                        <ul>
                            <li><strong>Time-based:</strong> Quarterly or semi-annually</li>
                            <li><strong>Threshold-based:</strong> When allocation deviates >5%</li>
                            <li><strong>Opportunistic:</strong> During major market moves</li>
                        </ul>
                    </div>
                </div>

                <div class="interactive-demo">
                    <h3>🧮 Risk Management Calculator Suite</h3>
                    
                    <div class="tabs">
                        <div class="tab active" onclick="showTab('position-sizing')">Position Sizing</div>
                        <div class="tab" onclick="showTab('risk-reward')">Risk/Reward</div>
                        <div class="tab" onclick="showTab('portfolio-risk')">Portfolio Risk</div>
                        <div class="tab" onclick="showTab('drawdown-calc')">Drawdown Analysis</div>
                    </div>

                    <div id="position-sizing" class="tab-content active">
                        <h4>⚖️ Position Size Calculator</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Total Account Value (VND)</label>
                                <input type="number" id="ps-account-size" placeholder="Total portfolio value">
                            </div>
                            <div>
                                <label>Risk per Trade (%)</label>
                                <input type="number" id="ps-risk-percent" value="2" min="0.5" max="10" step="0.5">
                            </div>
                            <div>
                                <label>Entry Price (VND)</label>
                                <input type="number" id="ps-entry-price" placeholder="Buy price">
                            </div>
                            <div>
                                <label>Stop Loss Price (VND)</label>
                                <input type="number" id="ps-stop-price" placeholder="Stop loss price">
                            </div>
                            <div>
                                <label>Commission (%)</label>
                                <input type="number" id="ps-commission" value="0.15" step="0.01" placeholder="Brokerage commission">
                            </div>
                        </div>
                        <button class="btn" onclick="calculatePositionSize()">Calculate Position Size</button>
                        <div id="position-size-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="risk-reward" class="tab-content">
                        <h4>🎯 Risk/Reward Analysis</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Entry Price (VND)</label>
                                <input type="number" id="rr-entry" placeholder="Entry price">
                            </div>
                            <div>
                                <label>Stop Loss Price (VND)</label>
                                <input type="number" id="rr-stop" placeholder="Stop loss price">
                            </div>
                            <div>
                                <label>Target Price 1 (VND)</label>
                                <input type="number" id="rr-target1" placeholder="First target">
                            </div>
                            <div>
                                <label>Target Price 2 (VND)</label>
                                <input type="number" id="rr-target2" placeholder="Second target">
                            </div>
                            <div>
                                <label>Win Rate (%)</label>
                                <input type="number" id="rr-winrate" min="0" max="100" placeholder="Historical win rate">
                            </div>
                        </div>
                        <button class="btn" onclick="analyzeRiskReward()">Analyze R:R</button>
                        <div id="risk-reward-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="portfolio-risk" class="tab-content">
                        <h4>📊 Portfolio Risk Assessment</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Number of Positions</label>
                                <input type="number" id="pr-positions" min="1" max="20" placeholder="Current positions">
                            </div>
                            <div>
                                <label>Largest Position (%)</label>
                                <input type="number" id="pr-largest" min="1" max="50" placeholder="% of largest position">
                            </div>
                            <div>
                                <label>Top 5 Positions (%)</label>
                                <input type="number" id="pr-top5" min="10" max="100" placeholder="% in top 5 positions">
                            </div>
                            <div>
                                <label>Cash Position (%)</label>
                                <input type="number" id="pr-cash" min="0" max="50" placeholder="Cash percentage">
                            </div>
                            <div>
                                <label>Correlation Level</label>
                                <select id="pr-correlation">
                                    <option value="low">Low (<0.3)</option>
                                    <option value="medium">Medium (0.3-0.7)</option>
                                    <option value="high">High (>0.7)</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn" onclick="assessPortfolioRisk()">Assess Portfolio Risk</button>
                        <div id="portfolio-risk-result" class="result" style="display: none;"></div>
                    </div>

                    <div id="drawdown-calc" class="tab-content">
                        <h4>📉 Drawdown Analysis</h4>
                        <div class="demo-controls">
                            <div>
                                <label>Starting Capital (VND)</label>
                                <input type="number" id="dd-start-capital" placeholder="Initial capital">
                            </div>
                            <div>
                                <label>Peak Value (VND)</label>
                                <input type="number" id="dd-peak" placeholder="Highest portfolio value">
                            </div>
                            <div>
                                <label>Current Value (VND)</label>
                                <input type="number" id="dd-current" placeholder="Current portfolio value">
                            </div>
                            <div>
                                <label>Monthly Return (%)</label>
                                <input type="number" id="dd-monthly-return" placeholder="Expected monthly return">
                            </div>
                            <div>
                                <label>Monthly Volatility (%)</label>
                                <input type="number" id="dd-volatility" placeholder="Monthly volatility">
                            </div>
                        </div>
                        <button class="btn" onclick="analyzeDrawdown()">Analyze Drawdown</button>
                        <div id="drawdown-result" class="result" style="display: none;"></div>
                    </div>
                </div>

                <div class="content-grid">
                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">🧠</span>
                            Psychological Risk Management
                        </h3>
                        
                        <h4>😰 Common Emotional Mistakes:</h4>
                        <ul>
                            <li><strong>Fear of Missing Out (FOMO):</strong> Mua ở đỉnh</li>
                            <li><strong>Loss Aversion:</strong> Không cắt lỗ kịp thời</li>
                            <li><strong>Confirmation Bias:</strong> Chỉ tìm thông tin ủng hộ</li>
                            <li><strong>Overconfidence:</strong> Position size quá lớn sau thắng</li>
                        </ul>
                        
                        <h4>🧘 Emotional Control Techniques:</h4>
                        <ul>
                            <li><strong>Pre-defined Rules:</strong> Kế hoạch trước khi vào lệnh</li>
                            <li><strong>Position Journaling:</strong> Ghi lại lý do và cảm xúc</li>
                            <li><strong>Meditation/Breaks:</strong> Nghỉ ngơi khi căng thẳng</li>
                            <li><strong>Support Network:</strong> Thảo luận với nhóm đầu tư</li>
                        </ul>
                    </div>

                    <div class="content-card">
                        <h3 class="card-title">
                            <span class="card-icon">📋</span>
                            Risk Management Checklist
                        </h3>
                        
                        <h4>✅ Before Every Trade:</h4>
                        <ul>
                            <li><strong>Define stop loss:</strong> Xác định điểm cắt lỗ</li>
                            <li><strong>Calculate position size:</strong> Theo % risk</li>
                            <li><strong>Identify targets:</strong> Mục tiêu chốt lời</li>
                            <li><strong>Check correlation:</strong> Với positions khác</li>
                            <li><strong>Review setup:</strong> Confluence of factors</li>
                        </ul>
                        
                        <h4>📊 Weekly Review:</h4>
                        <ul>
                            <li><strong>P&L Analysis:</strong> Winners vs losers</li>
                            <li><strong>Risk Exposure:</strong> Total portfolio risk</li>
                            <li><strong>Sector Allocation:</strong> Diversification check</li>
                            <li><strong>Performance vs Benchmark:</strong> Relative performance</li>
                        </ul>
                        
                        <h4>📈 Monthly Assessment:</h4>
                        <ul>
                            <li><strong>Sharpe Ratio:</strong> Risk-adjusted returns</li>
                            <li><strong>Maximum Drawdown:</strong> Worst losing streak</li>
                            <li><strong>Win Rate & R:R:</strong> Success metrics</li>
                            <li><strong>Strategy Effectiveness:</strong> What's working</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

<!-- KIỂM TRA -->
<div id="quiz" class="content-section">
    <!-- Kiểm tra cơ bản -->
    <div id="quiz-basic" class="tab-content active">
        <h2 class="section-title">📝 Kiểm Tra Kiến Thức Cơ Bản</h2>
        
        <div class="quiz-container">
            <div id="basic-quiz-content">
                <!-- Quiz content will be loaded by JavaScript -->
            </div>
            <button class="btn" onclick="startBasicQuiz()">Bắt Đầu Kiểm Tra</button>
            <div id="basic-quiz-result" class="score-display" style="display: none;"></div>
        </div>
    </div>

    <!-- Kiểm tra nâng cao -->
    <div id="quiz-advanced" class="tab-content">
        <h2 class="section-title">🎓 Kiểm Tra Kiến Thức Nâng Cao</h2>
        
        <div class="quiz-container">
            <div id="advanced-quiz-content">
                <!-- Quiz content will be loaded by JavaScript -->
            </div>
            <button class="btn" onclick="startAdvancedQuiz()">Bắt Đầu Kiểm Tra</button>
            <div id="advanced-quiz-result" class="score-display" style="display: none;"></div>
        </div>
    </div>

    <!-- Kiểm tra tổng hợp -->
    <div id="quiz-comprehensive" class="tab-content">
        <h2 class="section-title">🏆 Kiểm Tra Tổng Hợp</h2>
        
        <div class="quiz-container">
            <div id="comprehensive-quiz-content">
                <!-- Quiz content will be loaded by JavaScript -->
            </div>
            <button class="btn" onclick="startComprehensiveQuiz()">Bắt Đầu Kiểm Tra</button>
            <div id="comprehensive-quiz-result" class="score-display" style="display: none;"></div>
        </div>
    </div>
</div>

<!-- TÀI NGUYÊN -->
<div id="resources" class="content-section">
    <!-- Sách -->
    <div id="resources-books" class="tab-content active">
        <h2 class="section-title">📚 Sách Đầu Tư Kinh Điển</h2>
        
        <div class="content-grid">
            <div class="content-card">
                <h3 class="card-title">
                    <span class="card-icon">📖</span>
                    Phân Tích Cơ Bản
                </h3>
                <ul>
                    <li><strong>The Intelligent Investor</strong> - Benjamin Graham</li>
                    <li><strong>Security Analysis</strong> - Benjamin Graham & David Dodd</li>
                    <li><strong>One Up On Wall Street</strong> - Peter Lynch</li>
                    <li><strong>Common Stocks and Uncommon Profits</strong> - Philip Fisher</li>
                </ul>
            </div>

            <div class="content-card">
                <h3 class="card-title">
                    <span class="card-icon">📈</span>
                    Phân Tích Kỹ Thuật
                </h3>
                <ul>
                    <li><strong>Technical Analysis of the Financial Markets</strong> - John Murphy</li>
                    <li><strong>Japanese Candlestick Charting Techniques</strong> - Steve Nison</li>
                    <li><strong>How to Make Money in Stocks</strong> - William O'Neil</li>
                    <li><strong>Trade Like a Stock Market Wizard</strong> - Mark Minervini</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Website -->
    <div id="resources-websites" class="tab-content">
        <h2 class="section-title">🌐 Website Hữu Ích</h2>
        
        <div class="content-grid">
            <div class="content-card">
                <h3 class="card-title">
                    <span class="card-icon">🇻🇳</span>
                    Tài Nguyên Việt Nam
                </h3>
                <ul>
                    <li><strong>VietstockFinance:</strong> Dữ liệu tài chính, báo cáo phân tích</li>
                    <li><strong>CafeF:</strong> Tin tức, dữ liệu thị trường</li>
                    <li><strong>SSI, HSC, VNDirect:</strong> Báo cáo phân tích từ các CTCK</li>
                    <li><strong>HNX, HOSE:</strong> Website sàn giao dịch chính thức</li>
                </ul>
            </div>

            <div class="content-card">
                <h3 class="card-title">
                    <span class="card-icon">🌍</span>
                    Tài Nguyên Quốc Tế
                </h3>
                <ul>
                    <li><strong>TradingView:</strong> Biểu đồ và phân tích kỹ thuật</li>
                    <li><strong>Investing.com:</strong> Dữ liệu thị trường toàn cầu</li>
                    <li><strong>Finviz:</strong> Screener và heat map</li>
                    <li><strong>StockCharts:</strong> Công cụ phân tích kỹ thuật</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Tra cứu -->
    <div id="resources-reference" class="tab-content">
        <h2 class="section-title">🔍 Bảng Tra Cứu Nhanh</h2>
        
        <table class="reference-table">
            <thead>
                <tr>
                    <th>Chỉ Số</th>
                    <th>Công Thức</th>
                    <th>Ý Nghĩa</th>
                    <th>Tiêu Chuẩn Tốt</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>P/E</strong></td>
                    <td>Giá / EPS</td>
                    <td>Định giá so với lợi nhuận</td>
                    <td>10-20 (tùy ngành)</td>
                </tr>
                <tr>
                    <td><strong>P/B</strong></td>
                    <td>Giá / BVPS</td>
                    <td>Định giá so với tài sản</td>
                    <td><2 (value stocks)</td>
                </tr>
                <tr>
                    <td><strong>ROE</strong></td>
                    <td>Lợi nhuận / VCSH</td>
                    <td>Hiệu quả sử dụng vốn</td>
                    <td>>15%</td>
                </tr>
                <tr>
                    <td><strong>Debt/Equity</strong></td>
                    <td>Nợ / VCSH</td>
                    <td>Đòn bẩy tài chính</td>
                    <td><0.5</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

        <!-- CÔNG CỤ -->
        <div id="tools" class="content-section">
<!-- Analyzers -->
<div id="tools-analyzers" class="tab-content">
    <h2 class="section-title">🔍 Công Cụ Phân Tích</h2>
    
    <div class="calculator-grid">
        <div class="calculator">
            <h3>📊 Stock Screener</h3>
            <div class="demo-controls">
                <div>
                    <label>P/E Max</label>
                    <input type="number" id="screener-pe" placeholder="P/E tối đa">
                </div>
                <div>
                    <label>ROE Min (%)</label>
                    <input type="number" id="screener-roe" placeholder="ROE tối thiểu">
                </div>
                <div>
                    <label>Market Cap (tỷ VND)</label>
                    <input type="number" id="screener-mcap" placeholder="Vốn hóa tối thiểu">
                </div>
            </div>
            <button class="btn" onclick="runScreener()">Lọc Cổ Phiếu</button>
            <div id="screener-result" class="result" style="display: none;"></div>
        </div>

        <div class="calculator">
            <h3>🎯 Pattern Scanner</h3>
            <div class="demo-controls">
                <div>
                    <label>Mã cổ phiếu</label>
                    <input type="text" id="pattern-symbol" placeholder="VNM, VIC, HPG...">
                </div>
                <div>
                    <label>Loại pattern</label>
                    <select id="pattern-type">
                        <option value="all">Tất cả</option>
                        <option value="reversal">Đảo chiều</option>
                        <option value="continuation">Tiếp diễn</option>
                    </select>
                </div>
            </div>
            <button class="btn" onclick="scanPattern()">Quét Pattern</button>
            <div id="pattern-result" class="result" style="display: none;"></div>
        </div>
    </div>
</div>

<!-- Simulators -->
<div id="tools-simulators" class="tab-content">
    <h2 class="section-title">🎮 Mô Phỏng Giao Dịch</h2>
    
    <div class="interactive-demo">
        <h3>📈 Trading Simulator</h3>
        <canvas id="simulator-chart" class="candlestick-canvas" width="800" height="400"></canvas>
        
        <div class="demo-controls">
            <div>
                <label>Vốn ban đầu (VND)</label>
                <input type="number" id="sim-capital" value="100000000">
            </div>
            <div>
                <label>Risk per trade (%)</label>
                <input type="number" id="sim-risk" value="2" min="1" max="5">
            </div>
            <div>
                <label>Chiến lược</label>
                <select id="sim-strategy">
                    <option value="trend">Trend Following</option>
                    <option value="breakout">Breakout</option>
                    <option value="reversal">Mean Reversion</option>
                </select>
            </div>
        </div>
        
        <div class="demo-controls">
            <button class="btn btn-success" onclick="startSimulation()">Bắt Đầu</button>
            <button class="btn" onclick="pauseSimulation()">Tạm Dừng</button>
            <button class="btn btn-warning" onclick="resetSimulation()">Reset</button>
        </div>
        
        <div id="simulation-stats" class="result">
            <h4>📊 Thống Kê</h4>
            <p>Vốn hiện tại: <span id="sim-current-capital">100,000,000</span> VND</p>
            <p>Số giao dịch: <span id="sim-trades">0</span></p>
            <p>Win Rate: <span id="sim-winrate">0%</span></p>
            <p>Lợi nhuận: <span id="sim-profit">0</span> VND</p>
        </div>
    </div>
</div>
            <div id="tools-calculators" class="tab-content active">
                <h2 class="section-title">🧮 Bộ Công Cụ Tính Toán Toàn Diện</h2>
                
                <div class="calculator-grid">
                    <div class="calculator">
                        <h3>📊 Tính RSI Chi Tiết</h3>
                        <div class="demo-controls">
                            <div>
                                <label>Chuỗi giá đóng cửa (phân cách dấu phẩy)</label>
                                <input type="text" id="rsi-detailed-prices" placeholder="100,102,98,105,107,103,99,101,104,106,102,98,100,103,105">
                            </div>
                            <div>
                                <label>Chu kỳ RSI</label>
                                <select id="rsi-detailed-period">
                                    <option value="14">14 kỳ</option>
                                    <option value="9">9 kỳ</option>
                                    <option value="21">21 kỳ</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn" onclick="calculateRSIDetailed()">Tính RSI</button>
                        <div id="rsi-detailed-result" class="result" style="display: none;"></div>
                    </div>

                    <div class="calculator">
                        <h3>📈 Tính MACD Đầy Đủ</h3>
                        <div class="demo-controls">
                            <div>
                                <label>Chuỗi giá (tối thiểu 26 giá trị)</label>
                                <input type="text" id="macd-detailed-prices" placeholder="45,46,47,46,47,48,49,48,49,50,51,50,51,52,53,52,53,54,55,54,55,56,57,56,57,58,59,60,61,62">
                            </div>
                            <div>
                                <label>EMA Nhanh</label>
                                <input type="number" id="macd-detailed-fast" value="12" min="1" max="50">
                            </div>
                            <div>
                                <label>EMA Chậm</label>
                                <input type="number" id="macd-detailed-slow" value="26" min="1" max="100">
                            </div>
                            <div>
                                <label>Signal Line</label>
                                <input type="number" id="macd-detailed-signal" value="9" min="1" max="50">
                            </div>
                        </div>
                        <button class="btn" onclick="calculateMACDDetailed()">Tính MACD</button>
                        <div id="macd-detailed-result" class="result" style="display: none;"></div>
                    </div>
                </div>

                <script>
                // Biến toàn cục
                let currentModule = 'overview';
                let currentSubSection = 'intro';
                let quizData = [];
                let userAnswers = [];
                let currentScore = 0;

                // Navigation functions
 function showMainSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.content-section').forEach(section => {
        section.classList.remove('active');
    });
    
    // Hide all sub-navs
    document.querySelectorAll('.sub-nav').forEach(nav => {
        nav.classList.remove('active');
    });
    
    // Show selected section and sub-nav
    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.classList.add('active');
    }
    
    const subNav = document.getElementById(sectionId + '-subnav');
    if (subNav) {
        subNav.classList.add('active');
    }
    
    // Update main nav buttons
    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    if (event && event.target) {
        event.target.classList.add('active');
    }
    
    // Show first sub-section
    const firstSubBtn = subNav?.querySelector('.sub-nav-btn');
    if (firstSubBtn) {
        // Simulate click without event
        const firstSubSection = firstSubBtn.getAttribute('onclick').match(/'([^']+)'/g)[1].replace(/'/g, '');
        showSubSection(sectionId, firstSubSection);
        firstSubBtn.classList.add('active');
    }
    
    currentModule = sectionId;
    
    // Initialize specific modules
    if (sectionId === 'candlestick') {
        setTimeout(initializeCandlestickModule, 100);
    } else if (sectionId === 'quiz') {
        initializeQuizSection();
    } else if (sectionId === 'resources') {
        initializeResourcesSection();
    }
}
function showSubSection(module, subSection) {
    // Hide all tab contents in the module
    const moduleElement = document.getElementById(module);
    if (!moduleElement) return;
    
    moduleElement.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
    });
    
    // Show selected sub-section
    const targetContent = document.getElementById(module + '-' + subSection);
    if (targetContent) {
        targetContent.classList.add('active');
    }
    
    // Update sub-nav buttons if called from button click
    const subNav = document.getElementById(module + '-subnav');
    if (subNav && event && event.target) {
        subNav.querySelectorAll('.sub-nav-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.classList.add('active');
    }
    
    currentSubSection = subSection;
    
    // Initialize specific sub-sections
    if (module === 'candlestick' && subSection === 'basics') {
        setTimeout(() => drawCandleStructure('all'), 100);
    } else if (module === 'candlestick' && subSection === 'single') {
        setTimeout(drawAllPatterns, 100);
    }
}
                function showTab(tabId) {
                    // Hide all tab contents
                    document.querySelectorAll('.tab-content').forEach(content => {
                        content.classList.remove('active');
                    });
                    
                    // Show selected tab
                    document.getElementById(tabId).classList.add('active');
                    
                    // Update tab buttons
                    document.querySelectorAll('.tab').forEach(tab => {
                        tab.classList.remove('active');
                    });
                    event.target.classList.add('active');
                }

                // Candlestick drawing functions
                function initializeCandlestickModule() {
                    drawCandleStructure('all');
                    drawAllPatterns();
                }

                function drawCandleStructure(type = 'all') {
                    const canvas = document.getElementById('candle-structure');
                    if (!canvas) return;
                    
                    const ctx = canvas.getContext('2d');
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    
                    if (type === 'bullish' || type === 'all') {
                        drawSingleCandle(ctx, 150, 100, 130, 160, 90, 'bullish', 'Nến Tăng');
                    }
                    
                    if (type === 'bearish' || type === 'all') {
                        drawSingleCandle(ctx, 350, 90, 160, 130, 100, 'bearish', 'Nến Giảm');
                    }
                    
                    if (type === 'doji' || type === 'all') {
                        drawSingleCandle(ctx, 550, 100, 150, 150, 90, 'doji', 'Doji');
                    }
                    
                    // Add labels
                    ctx.fillStyle = '#2c3e50';
                    ctx.font = '14px Arial';
                    ctx.textAlign = 'center';
                    ctx.fillText('Các loại nến cơ bản', 400, 30);
                    
                    // Add component labels
                    ctx.font = '12px Arial';
                    ctx.fillStyle = '#7f8c8d';
                    ctx.fillText('Bóng nến trên', 150, 70);
                    ctx.fillText('Thân nến', 150, 200);
                    ctx.fillText('Bóng nến dưới', 150, 250);
                }

function drawSingleCandle(ctx, x, high, open, close, low, type, label) {
    // Chuẩn hóa để vẽ đúng tỷ lệ
    const canvasHeight = 150;
    const marginTop = 20;
    const marginBottom = 40;
    const drawHeight = canvasHeight - marginTop - marginBottom;
    
    // Tìm min/max để scale
    const priceMin = Math.min(high, open, close, low);
    const priceMax = Math.max(high, open, close, low);
    const priceRange = priceMax - priceMin || 10;
    
    // Scale prices to canvas coordinates
    const scaleY = (price) => {
        return marginTop + (1 - (price - priceMin) / priceRange) * drawHeight;
    };
    
    const h = scaleY(high);
    const o = scaleY(open);
    const c = scaleY(close);
    const l = scaleY(low);
    
    // Draw shadow (wick)
    ctx.strokeStyle = '#333';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(x, h);
    ctx.lineTo(x, l);
    ctx.stroke();
    
    // Draw body
    const bodyTop = Math.min(o, c);
    const bodyHeight = Math.abs(c - o) || 2;
    const bodyWidth = 30;
    
    // Set color based on type
    if (type === 'bullish') {
        ctx.fillStyle = '#4CAF50';
    } else if (type === 'bearish') {
        ctx.fillStyle = '#F44336';
    } else if (type === 'doji') {
        ctx.fillStyle = '#9E9E9E';
    }
    
    // Fill body
    ctx.fillRect(x - bodyWidth/2, bodyTop, bodyWidth, bodyHeight);
    
    // Body border
    ctx.strokeStyle = '#333';
    ctx.lineWidth = 1;
    ctx.strokeRect(x - bodyWidth/2, bodyTop, bodyWidth, bodyHeight);
    
    // Label
    if (label) {
        ctx.fillStyle = '#2c3e50';
        ctx.font = '12px Arial';
        ctx.textAlign = 'center';
        ctx.fillText(label, x, canvasHeight - 10);
    }
}
                function drawAllPatterns() {
                    drawPatternCandle('pattern-hammer', 'hammer');
                    drawPatternCandle('pattern-hanging-man', 'hanging-man');
                    drawPatternCandle('pattern-inverted-hammer', 'inverted-hammer');
                    drawPatternCandle('pattern-shooting-star', 'shooting-star');
                    drawPatternCandle('pattern-doji-standard', 'doji-standard');
                    drawPatternCandle('pattern-dragonfly-doji', 'dragonfly-doji');
                    drawPatternCandle('pattern-gravestone-doji', 'gravestone-doji');
                    drawPatternCandle('pattern-marubozu-bullish', 'marubozu-bullish');
                    drawPatternCandle('pattern-marubozu-bearish', 'marubozu-bearish');
                    drawPatternCandle('pattern-spinning-top', 'spinning-top');
                    
                    // Double patterns
                    drawPatternCandle('pattern-bullish-engulfing', 'bullish-engulfing');
                    drawPatternCandle('pattern-bearish-engulfing', 'bearish-engulfing');
                    drawPatternCandle('pattern-bullish-harami', 'bullish-harami');
                    drawPatternCandle('pattern-bearish-harami', 'bearish-harami');
                    drawPatternCandle('pattern-piercing-line', 'piercing-line');
                    drawPatternCandle('pattern-dark-cloud-cover', 'dark-cloud-cover');
                    drawPatternCandle('pattern-tweezer-top', 'tweezer-top');
                    drawPatternCandle('pattern-tweezer-bottom', 'tweezer-bottom');
                    
                    // Triple patterns
                    drawPatternCandle('pattern-morning-star', 'morning-star');
                    drawPatternCandle('pattern-evening-star', 'evening-star');
                    drawPatternCandle('pattern-three-white-soldiers', 'three-white-soldiers');
                    drawPatternCandle('pattern-three-black-crows', 'three-black-crows');
                    drawPatternCandle('pattern-abandoned-baby-bullish', 'abandoned-baby-bullish');
                    drawPatternCandle('pattern-abandoned-baby-bearish', 'abandoned-baby-bearish');
                }

                function drawPatternCandle(canvasId, pattern) {
                    const canvas = document.getElementById(canvasId);
                    if (!canvas) return;
                    
                    const ctx = canvas.getContext('2d');
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    
                    const centerX = canvas.width / 2;
                    const centerY = canvas.height / 2;
                    
                    switch (pattern) {
                        case 'hammer':
                            drawSingleCandle(ctx, centerX, 40, 80, 90, 20, 'bullish');
                            break;
                        case 'hanging-man':
                            drawSingleCandle(ctx, centerX, 90, 80, 70, 30, 'bearish');
                            break;
                        case 'inverted-hammer':
                            drawSingleCandle(ctx, centerX, 90, 40, 50, 30, 'bullish');
                            break;
                        case 'shooting-star':
                            drawSingleCandle(ctx, centerX, 90, 50, 40, 30, 'bearish');
                            break;
                        case 'doji-standard':
                            drawSingleCandle(ctx, centerX, 80, 60, 60, 40, 'doji');
                            break;
                        case 'dragonfly-doji':
                            drawSingleCandle(ctx, centerX, 60, 60, 60, 20, 'doji');
                            break;
                        case 'gravestone-doji':
                            drawSingleCandle(ctx, centerX, 90, 50, 50, 50, 'doji');
                            break;
                        case 'marubozu-bullish':
                            drawSingleCandle(ctx, centerX, 90, 30, 90, 30, 'bullish');
                            break;
                        case 'marubozu-bearish':
                            drawSingleCandle(ctx, centerX, 90, 90, 30, 30, 'bearish');
                            break;
                        case 'spinning-top':
                            drawSingleCandle(ctx, centerX, 80, 55, 65, 40, 'bullish');
                            break;
                        case 'bullish-engulfing':
                            drawSingleCandle(ctx, centerX - 25, 70, 60, 40, 35, 'bearish');
                            drawSingleCandle(ctx, centerX + 25, 80, 35, 75, 30, 'bullish');
                            break;
                        case 'bearish-engulfing':
                            drawSingleCandle(ctx, centerX - 25, 75, 40, 70, 35, 'bullish');
                            drawSingleCandle(ctx, centerX + 25, 80, 75, 30, 25, 'bearish');
                            break;
                        case 'bullish-harami':
                            drawSingleCandle(ctx, centerX - 25, 80, 70, 30, 25, 'bearish');
                            drawSingleCandle(ctx, centerX + 25, 65, 45, 55, 40, 'bullish');
                            break;
                        case 'bearish-harami':
                            drawSingleCandle(ctx, centerX - 25, 80, 30, 75, 25, 'bullish');
                            drawSingleCandle(ctx, centerX + 25, 65, 55, 45, 40, 'bearish');
                            break;
                        case 'piercing-line':
                            drawSingleCandle(ctx, centerX - 25, 75, 70, 35, 30, 'bearish');
                            drawSingleCandle(ctx, centerX + 25, 80, 25, 70, 20, 'bullish');
                            break;
                        case 'dark-cloud-cover':
                            drawSingleCandle(ctx, centerX - 25, 75, 35, 70, 30, 'bullish');
                            drawSingleCandle(ctx, centerX + 25, 85, 80, 40, 35, 'bearish');
                            break;
                        case 'tweezer-top':
                            drawSingleCandle(ctx, centerX - 25, 80, 50, 75, 45, 'bullish');
                            drawSingleCandle(ctx, centerX + 25, 80, 75, 55, 50, 'bearish');
                            break;
                        case 'tweezer-bottom':
                            drawSingleCandle(ctx, centerX - 25, 70, 55, 50, 30, 'bearish');
                            drawSingleCandle(ctx, centerX + 25, 75, 30, 55, 30, 'bullish');
                            break;
                        case 'morning-star':
                            drawSingleCandle(ctx, centerX - 40, 75, 70, 35, 30, 'bearish');
                            drawSingleCandle(ctx, centerX, 50, 40, 45, 25, 'doji');
                            drawSingleCandle(ctx, centerX + 40, 80, 35, 75, 30, 'bullish');
                            break;
                        case 'evening-star':
                            drawSingleCandle(ctx, centerX - 40, 75, 35, 70, 30, 'bullish');
                            drawSingleCandle(ctx, centerX, 85, 80, 75, 70, 'doji');
                            drawSingleCandle(ctx, centerX + 40, 80, 75, 40, 35, 'bearish');
                            break;
                        case 'three-white-soldiers':
                            drawSingleCandle(ctx, centerX - 40, 65, 45, 60, 40, 'bullish');
                            drawSingleCandle(ctx, centerX, 75, 55, 70, 50, 'bullish');
                            drawSingleCandle(ctx, centerX + 40, 85, 65, 80, 60, 'bullish');
                            break;
                        case 'three-black-crows':
                            drawSingleCandle(ctx, centerX - 40, 75, 60, 45, 40, 'bearish');
                            drawSingleCandle(ctx, centerX, 60, 50, 35, 30, 'bearish');
                            drawSingleCandle(ctx, centerX + 40, 45, 40, 25, 20, 'bearish');
                            break;
                        case 'abandoned-baby-bullish':
                            drawSingleCandle(ctx, centerX - 40, 70, 65, 35, 30, 'bearish');
                            drawSingleCandle(ctx, centerX, 45, 25, 25, 20, 'doji');
                            drawSingleCandle(ctx, centerX + 40, 75, 45, 70, 40, 'bullish');
                            break;
                        case 'abandoned-baby-bearish':
                            drawSingleCandle(ctx, centerX - 40, 70, 40, 65, 35, 'bullish');
                            drawSingleCandle(ctx, centerX, 85, 80, 80, 75, 'doji');
                            drawSingleCandle(ctx, centerX + 40, 65, 60, 35, 30, 'bearish');
                            break;
                    }
                }

                function showPatternDetail(patternName) {
                    const detailDiv = document.getElementById('pattern-detail');
                    const titleDiv = document.getElementById('pattern-detail-title');
                    const contentDiv = document.getElementById('pattern-detail-content');
                    
                    const patterns = {
                        'hammer': {
                            title: '🔨 Hammer (Búa)',
                            content: `
                                <h4>📍 Bối cảnh</h4>
                                <p>Xuất hiện ở đáy xu hướng giảm</p>
                                
                                <h4>🔍 Đặc điểm nhận dạng</h4>
                                <ul>
                                    <li>Thân nến nhỏ nằm ở phía trên của cây nến</li>
                                    <li>Bóng nến dưới rất dài (gấp 2-3 lần thân nến)</li>
                                    <li>Không có hoặc có rất ít bóng nến trên</li>
                                    <li>Màu của thân nến có thể xanh hoặc đỏ</li>
                                </ul>
                                
                                <h4>🧠 Tâm lý thị trường</h4>
                                <p>Trong phiên, phe bán đã cố gắng đẩy giá xuống thấp, nhưng phe mua đã xuất hiện mạnh mẽ ở vùng đáy và đẩy giá lên trở lại gần mức mở cửa. Điều này cho thấy lực bán đang cạn kiệt và phe mua bắt đầu kiểm soát.</p>
                                
                                <h4>📈 Tín hiệu giao dịch</h4>
                                <p><strong>Loại:</strong> Đảo chiều tăng</p>
                                <p><strong>Độ tin cậy:</strong> Cao (đặc biệt khi có xác nhận)</p>
                                
                                <h4>✅ Xác nhận cần thiết</h4>
                                <ul>
                                    <li>Nến xác nhận: Cây nến tăng mạnh ở phiên tiếp theo</li>
                                    <li>Khối lượng: Volume tăng cao trong ngày xuất hiện hammer</li>
                                    <li>Vị trí: Tại ngưỡng hỗ trợ quan trọng</li>
                                </ul>
                            `
                        },
                        'shooting-star': {
                            title: '🌠 Shooting Star (Sao Băng)',
                            content: `
                                <h4>📍 Bối cảnh</h4>
                                <p>Xuất hiện ở đỉnh xu hướng tăng</p>
                                
                                <h4>🔍 Đặc điểm nhận dạng</h4>
                                <ul>
                                    <li>Thân nến nhỏ nằm ở phía dưới của cây nến</li>
                                    <li>Bóng nến trên rất dài (gấp 2-3 lần thân nến)</li>
                                    <li>Không có hoặc có rất ít bóng nến dưới</li>
                                    <li>Thường có màu đỏ nhưng có thể là xanh</li>
                                </ul>
                                
                                <h4>🧠 Tâm lý thị trường</h4>
                                <p>Phe mua cố gắng đẩy giá lên cao hơn nhưng gặp phải áp lực bán mạnh. Lực bán đã áp đảo và đẩy giá xuống gần mức mở cửa, cho thấy phe mua đang mất quyền kiểm soát.</p>
                                
                                <h4>📉 Tín hiệu giao dịch</h4>
                                <p><strong>Loại:</strong> Đảo chiều giảm</p>
                                <p><strong>Độ tin cậy:</strong> Cao</p>
                                
                                <h4>✅ Xác nhận cần thiết</h4>
                                <ul>
                                    <li>Nến xác nhận: Cây nến giảm ở phiên tiếp theo</li>
                                    <li>Khối lượng: Volume cao khi shooting star hình thành</li>
                                    <li>Vị trí: Tại ngưỡng kháng cự quan trọng</li>
                                </ul>
                            `
                        },
                        'bullish-engulfing': {
                            title: '📈 Bullish Engulfing (Nhấn Chìm Tăng)',
                            content: `
                                <h4>📍 Bối cảnh</h4>
                                <p>Xuất hiện ở đáy xu hướng giảm</p>
                                
                                <h4>🔍 Đặc điểm nhận dạng</h4>
                                <ul>
                                    <li>Gồm 2 cây nến có màu đối lập</li>
                                    <li>Nến 1: Nến giảm (đỏ) với thân tương đối nhỏ</li>
                                    <li>Nến 2: Nến tăng (xanh) với thân lớn bao trùm hoàn toàn nến 1</li>
                                    <li>Thân nến 2 phải mở cửa thấp hơn và đóng cửa cao hơn nến 1</li>
                                </ul>
                                
                                <h4>🧠 Tâm lý thị trường</h4>
                                <p>Xu hướng giảm đang yếu dần (nến 1 nhỏ). Ở phiên tiếp theo, phe mua bất ngờ phản công với sức mạnh áp đảo, không chỉ phủ nhận đà giảm mà còn đẩy giá lên cao, thể hiện sự chuyển đổi tâm lý mạnh mẽ.</p>
                                
                                <h4>📈 Tín hiệu giao dịch</h4>
                                <p><strong>Loại:</strong> Đảo chiều tăng</p>
                                <p><strong>Độ tin cậy:</strong> Rất cao</p>
                                
                                <h4>✅ Điều kiện tối ưu</h4>
                                <ul>
                                    <li>Nến 2 có khối lượng giao dịch cao bất thường</li>
                                    <li>Xuất hiện tại ngưỡng hỗ trợ quan trọng</li>
                                    <li>RSI trong vùng quá bán khi pattern hình thành</li>
                                </ul>
                            `
                        },
                        'morning-star': {
                            title: '🌅 Morning Star (Sao Mai)',
                            content: `
                                <h4>📍 Bối cảnh</h4>
                                <p>Xuất hiện ở đáy xu hướng giảm</p>
                                
                                <h4>🔍 Đặc điểm nhận dạng</h4>
                                <ul>
                                    <li>Gồm 3 cây nến</li>
                                    <li>Nến 1: Nến giảm dài (đỏ)</li>
                                    <li>Nến 2: Nến thân nhỏ (có thể Doji), thường có gap down</li>
                                    <li>Nến 3: Nến tăng dài (xanh), đóng cửa trên 50% thân nến 1</li>
                                </ul>
                                
                                <h4>🧠 Tâm lý thị trường</h4>
                                <p>Quá trình chuyển giao quyền lực qua 3 giai đoạn: Bi quan tột độ (nến 1) → Do dự và cân bằng (nến 2) → Lạc quan trở lại mạnh mẽ (nến 3). "Bình minh" xuất hiện sau "đêm dài".</p>
                                
                                <h4>📈 Tín hiệu giao dịch</h4>
                                <p><strong>Loại:</strong> Đảo chiều tăng</p>
                                <p><strong>Độ tin cậy:</strong> Rất cao</p>
                                
                                <h4>✅ Yếu tố tăng cường</h4>
                                <ul>
                                    <li>Gap giữa các nến (đặc biệt nến 2)</li>
                                    <li>Volume tăng đột biến ở nến 3</li>
                                    <li>Nến 3 đóng cửa càng cao càng mạnh</li>
                                    <li>Xuất hiện tại support quan trọng</li>
                                </ul>
                            `
                        }
                    };
                    
                    const pattern = patterns[patternName];
                    if (pattern) {
                        titleDiv.textContent = pattern.title;
                        contentDiv.innerHTML = pattern.content;
                        detailDiv.style.display = 'block';
                        detailDiv.scrollIntoView({ behavior: 'smooth' });
                    }
                }

                function hidePatternDetail() {
                    document.getElementById('pattern-detail').style.display = 'none';
                }

                // Calculator functions
                function calculateRSIDetailed() {
                    const pricesStr = document.getElementById('rsi-detailed-prices').value;
                    const period = parseInt(document.getElementById('rsi-detailed-period').value);
                    
                    if (!pricesStr) {
                        alert('Vui lòng nhập chuỗi giá!');
                        return;
                    }
                    
                    const prices = pricesStr.split(',').map(p => parseFloat(p.trim()));
                    
                    if (prices.length < period + 1) {
                        alert(`Cần ít nhất ${period + 1} giá để tính RSI ${period} kỳ!`);
                        return;
                    }
                    
                    const rsiValues = calculateRSIValues(prices, period);
                    const currentRSI = rsiValues[rsiValues.length - 1];
                    
                    let interpretation = '';
                    if (currentRSI > 70) {
                        interpretation = '🔴 Vùng quá mua - Cảnh báo điều chỉnh giảm';
                    } else if (currentRSI < 30) {
                        interpretation = '🟢 Vùng quá bán - Tiềm năng hồi phục';
                    } else if (currentRSI > 50) {
                        interpretation = '📈 Vùng tích cực - Xu hướng tăng';
                    } else {
                        interpretation = '📉 Vùng tiêu cực - Xu hướng giảm';
                    }
                    
                    const resultDiv = document.getElementById('rsi-detailed-result');
                    resultDiv.innerHTML = `
                        <h4>📊 Kết Quả RSI Chi Tiết</h4>
                        <p><strong>RSI hiện tại:</strong> ${currentRSI.toFixed(2)}</p>
                        <p><strong>Diễn giải:</strong> ${interpretation}</p>
                        <p><strong>RSI 3 phiên gần nhất:</strong> ${rsiValues.slice(-3).map(v => v.toFixed(2)).join(', ')}</p>
                        <p><strong>Xu hướng RSI:</strong> ${rsiValues[rsiValues.length-1] > rsiValues[rsiValues.length-2] ? '📈 Tăng' : '📉 Giảm'}</p>
                        
                        <h5>💡 Phân tích nâng cao:</h5>
                        <ul>
                            <li>Mức cao nhất RSI gần đây: ${Math.max(...rsiValues.slice(-10)).toFixed(2)}</li>
                            <li>Mức thấp nhất RSI gần đây: ${Math.min(...rsiValues.slice(-10)).toFixed(2)}</li>
                            <li>Số lần RSI > 70 (10 phiên): ${rsiValues.slice(-10).filter(v => v > 70).length}</li>
                            <li>Số lần RSI < 30 (10 phiên): ${rsiValues.slice(-10).filter(v => v < 30).length}</li>
                        </ul>
                    `;
                    resultDiv.style.display = 'block';
                }

                function calculateRSIValues(prices, period) {
                    const rsiValues = [];
                    let gains = [];
                    let losses = [];
                    
                    // Calculate initial gains and losses
                    for (let i = 1; i <= period; i++) {
                        const change = prices[i] - prices[i - 1];
                        if (change > 0) {
                            gains.push(change);
                            losses.push(0);
                        } else {
                            gains.push(0);
                            losses.push(-change);
                        }
                    }
                    
                    let avgGain = gains.reduce((a, b) => a + b) / period;
                    let avgLoss = losses.reduce((a, b) => a + b) / period;
                    
                    let rs = avgGain / avgLoss;
                    let rsi = 100 - (100 / (1 + rs));
                    rsiValues.push(rsi);
                    
                    // Calculate subsequent RSI values
                    for (let i = period + 1; i < prices.length; i++) {
                        const change = prices[i] - prices[i - 1];
                        const gain = change > 0 ? change : 0;
                        const loss = change < 0 ? -change : 0;
                        
                        avgGain = (avgGain * (period - 1) + gain) / period;
                        avgLoss = (avgLoss * (period - 1) + loss) / period;
                        
                        rs = avgGain / avgLoss;
                        rsi = 100 - (100 / (1 + rs));
                        rsiValues.push(rsi);
                    }
                    
                    return rsiValues;
                }

                function calculateMACDDetailed() {
                    const pricesStr = document.getElementById('macd-detailed-prices').value;
                    const fastPeriod = parseInt(document.getElementById('macd-detailed-fast').value);
                    const slowPeriod = parseInt(document.getElementById('macd-detailed-slow').value);
                    const signalPeriod = parseInt(document.getElementById('macd-detailed-signal').value);
                    
                    if (!pricesStr) {
                        alert('Vui lòng nhập chuỗi giá!');
                        return;
                    }
                    
                    const prices = pricesStr.split(',').map(p => parseFloat(p.trim()));
                    
                    if (prices.length < slowPeriod + signalPeriod) {
                        alert(`Cần ít nhất ${slowPeriod + signalPeriod} giá để tính MACD!`);
                        return;
                    }
                    
                    const macdData = calculateMACDValues(prices, fastPeriod, slowPeriod, signalPeriod);
                    const current = macdData[macdData.length - 1];
                    const previous = macdData[macdData.length - 2];
                    
                    let signal = '';
                    if (current.macd > current.signal && previous.macd <= previous.signal) {
                        signal = '🟢 MACD cắt lên Signal - Tín hiệu MUA';
                    } else if (current.macd < current.signal && previous.macd >= previous.signal) {
                        signal = '🔴 MACD cắt xuống Signal - Tín hiệu BÁN';
                    } else if (current.macd > 0) {
                        signal = '📈 MACD trên Zero line - Xu hướng tăng';
                    } else {
                        signal = '📉 MACD dưới Zero line - Xu hướng giảm';
                    }
                    
                    const resultDiv = document.getElementById('macd-detailed-result');
                    resultDiv.innerHTML = `
                        <h4>🌊 Kết Quả MACD Chi Tiết</h4>
                        <p><strong>MACD Line:</strong> ${current.macd.toFixed(4)}</p>
                        <p><strong>Signal Line:</strong> ${current.signal.toFixed(4)}</p>
                        <p><strong>Histogram:</strong> ${current.histogram.toFixed(4)}</p>
                        <p><strong>Tín hiệu chính:</strong> ${signal}</p>
                        
                        <h5>📊 Phân tích xu hướng:</h5>
                        <ul>
                            <li>MACD vs Signal: ${current.macd > current.signal ? 'MACD trên Signal' : 'MACD dưới Signal'}</li>
                            <li>Histogram trend: ${current.histogram > previous.histogram ? '📈 Tăng' : '📉 Giảm'}</li>
                            <li>Vị trí vs Zero: ${current.macd > 0 ? 'Trên Zero (Bullish)' : 'Dưới Zero (Bearish)'}</li>
                        </ul>
                        
                        <h5>💡 Khuyến nghị:</h5>
                        <p>${getMAGDRecommendation(current, previous)}</p>
                    `;
                    resultDiv.style.display = 'block';
                }

                function calculateMACDValues(prices, fastPeriod, slowPeriod, signalPeriod) {
                    const fastEMA = calculateEMA(prices, fastPeriod);
                    const slowEMA = calculateEMA(prices, slowPeriod);
                    
                    const macdLine = [];
                    for (let i = slowPeriod - 1; i < prices.length; i++) {
                        macdLine.push(fastEMA[i] - slowEMA[i - slowPeriod + fastPeriod]);
                    }
                    
                    const signalLine = calculateEMA(macdLine, signalPeriod);
                    
                    const result = [];
                    for (let i = signalPeriod - 1; i < macdLine.length; i++) {
                        result.push({
                            macd: macdLine[i],
                            signal: signalLine[i - signalPeriod + 1],
                            histogram: macdLine[i] - signalLine[i - signalPeriod + 1]
                        });
                    }
                    
                    return result;
                }

                function calculateEMA(prices, period) {
                    const k = 2 / (period + 1);
                    const emaArray = [prices[0]];
                    
                    for (let i = 1; i < prices.length; i++) {
                        emaArray.push(prices[i] * k + emaArray[i - 1] * (1 - k));
                    }
                    
                    return emaArray;
                }

                function getMAGDRecommendation(current, previous) {
                    if (current.macd > current.signal && current.macd > 0) {
                        return 'Tín hiệu tích cực mạnh. Có thể tìm cơ hội mua trong các đợt pullback.';
                    } else if (current.macd < current.signal && current.macd < 0) {
                        return 'Tín hiệu tiêu cực mạnh. Nên thận trọng hoặc tìm cơ hội bán.';
                    } else if (current.histogram > previous.histogram) {
                        return 'Momentum đang cải thiện. Theo dõi thêm để xác nhận xu hướng.';
                    } else {
                        return 'Momentum đang yếu đi. Cần quan sát thêm các tín hiệu xác nhận.';
                    }
                }

                // SEPA Evaluation
                function evaluateSEPA() {
                    const price = parseFloat(document.getElementById('sepa-price').value);
                    const ma50 = parseFloat(document.getElementById('sepa-ma50').value);
                    const ma150 = parseFloat(document.getElementById('sepa-ma150').value);
                    const ma200 = parseFloat(document.getElementById('sepa-ma200').value);
                    const epsGrowth = parseFloat(document.getElementById('sepa-eps-growth').value);
                    const salesGrowth = parseFloat(document.getElementById('sepa-sales-growth').value);
                    const roe = parseFloat(document.getElementById('sepa-roe').value);
                    const rs = parseFloat(document.getElementById('sepa-rs').value);
                    
                    if (!price || !ma50 || !ma150 || !ma200 || !epsGrowth || !salesGrowth || !roe || !rs) {
                        alert('Vui lòng nhập đầy đủ thông tin!');
                        return;
                    }
                    
                    let score = 0;
                    let details = [];
                    
                    // Stage 2 Analysis
                    if (price > ma50 && ma50 > ma150 && ma150 > ma200) {
                        score += 25;
                        details.push('✅ Stage 2: Giá trên tất cả MA và MA sắp xếp đúng thứ tự');
                    } else {
                        details.push('❌ Không ở Stage 2: Không đáp ứng tiêu chí MA');
                    }
                    
                    // Fundamental Analysis
                    if (epsGrowth >= 25) {
                        score += 20;
                        details.push('✅ EPS Growth xuất sắc (≥25%)');
                    } else if (epsGrowth >= 15) {
                        score += 10;
                        details.push('⚠️ EPS Growth khá tốt (15-24%)');
                    } else {
                        details.push('❌ EPS Growth thấp (<15%)');
                    }
                    
                    if (salesGrowth >= 20) {
                        score += 15;
                        details.push('✅ Sales Growth mạnh (≥20%)');
                    } else if (salesGrowth >= 10) {
                        score += 8;
                        details.push('⚠️ Sales Growth ổn (10-19%)');
                    } else {
                        details.push('❌ Sales Growth yếu (<10%)');
                    }
                    
                    if (roe >= 17) {
                        score += 15;
                        details.push('✅ ROE xuất sắc (≥17%)');
                    } else if (roe >= 12) {
                        score += 8;
                        details.push('⚠️ ROE khá tốt (12-16%)');
                    } else {
                        details.push('❌ ROE thấp (<12%)');
                    }
                    
                    // Relative Strength
                    if (rs >= 80) {
                        score += 25;
                        details.push('✅ RS Rating xuất sắc (≥80)');
                    } else if (rs >= 70) {
                        score += 15;
                        details.push('⚠️ RS Rating tốt (70-79)');
                    } else {
                        details.push('❌ RS Rating yếu (<70)');
                    }
                    
                    let rating = '';
                    let recommendation = '';
                    
                    if (score >= 80) {
                        rating = '🏆 XUẤT SẮC';
                        recommendation = 'Đây là ứng viên siêu cổ phiếu! Chờ điểm vào tối ưu.';
                    } else if (score >= 60) {
                        rating = '👍 TỐT';
                        recommendation = 'Cổ phiếu có tiềm năng, cần theo dõi thêm.';
                    } else if (score >= 40) {
                        rating = '⚠️ TRUNG BÌNH';
                        recommendation = 'Chưa đáp ứng tiêu chí SEPA, cần cải thiện.';
                    } else {
                        rating = '❌ YẾU';
                        recommendation = 'Không phù hợp với phương pháp SEPA.';
                    }
                    
                    const resultDiv = document.getElementById('sepa-result');
                    resultDiv.innerHTML = `
                        <h4>🎯 Kết Quả Đánh Giá SEPA</h4>
                        <p><strong>Điểm số:</strong> ${score}/100</p>
                        <p><strong>Xếp hạng:</strong> ${rating}</p>
                        <p><strong>Khuyến nghị:</strong> ${recommendation}</p>
                        
                        <h5>📋 Chi tiết đánh giá:</h5>
                        <ul>
                            ${details.map(detail => `<li>${detail}</li>`).join('')}
                        </ul>
                    `;
                    resultDiv.style.display = 'block';
                }

                // Buffett Style Evaluation
                function evaluateBuffettStyle() {
                    const roe = parseFloat(document.getElementById('buffett-roe').value);
                    const debt = parseFloat(document.getElementById('buffett-debt').value);
                    const growth = parseFloat(document.getElementById('buffett-growth').value);
                    const pe = parseFloat(document.getElementById('buffett-pe').value);
                    
                    if (!roe || !debt || !growth || !pe) {
                        alert('Vui lòng nhập đầy đủ thông tin!');
                        return;
                    }
                    
                    let score = 0;
                    let details = [];
                    
                    // ROE Analysis
                    if (roe >= 20) {
                        score += 30;
                        details.push('✅ ROE xuất sắc (≥20%) - Hiệu quả sử dụng vốn rất cao');
                    } else if (roe >= 15) {
                        score += 20;
                        details.push('✅ ROE tốt (15-19%) - Hiệu quả sử dụng vốn khá cao');
                    } else if (roe >= 10) {
                        score += 10;
                        details.push('⚠️ ROE trung bình (10-14%) - Cần cải thiện');
                    } else {
                        details.push('❌ ROE thấp (<10%) - Hiệu quả kém');
                    }
                    
                    // Debt/Equity Analysis
                    if (debt <= 0.3) {
                        score += 25;
                        details.push('✅ Tỷ lệ nợ rất thấp (≤0.3) - Tài chính vững mạnh');
                    } else if (debt <= 0.5) {
                        score += 15;
                        details.push('✅ Tỷ lệ nợ thấp (0.3-0.5) - Tài chính khá ổn');
                    } else if (debt <= 1.0) {
                        score += 5;
                        details.push('⚠️ Tỷ lệ nợ trung bình (0.5-1.0) - Cần theo dõi');
                    } else {
                        details.push('❌ Tỷ lệ nợ cao (>1.0) - Rủi ro tài chính');
                    }
                    
                    // Growth Analysis
                    if (growth >= 15) {
                        score += 25;
                        details.push('✅ Tăng trưởng mạnh (≥15%) - Tiềm năng cao');
                    } else if (growth >= 10) {
                        score += 15;
                        details.push('✅ Tăng trưởng tốt (10-14%) - Phát triển ổn định');
                    } else if (growth >= 5) {
                        score += 8;
                        details.push('⚠️ Tăng trưởng chậm (5-9%) - Cần xem xét');
                    } else {
                        details.push('❌ Tăng trưởng thấp (<5%) - Thiếu động lực');
                    }
                    
                    // P/E Analysis
                    if (pe <= 15) {
                        score += 20;
                        details.push('✅ P/E hợp lý (≤15) - Định giá hấp dẫn');
                    } else if (pe <= 25) {
                        score += 10;
                        details.push('⚠️ P/E trung bình (15-25) - Định giá công bằng');
                    } else {
                        details.push('❌ P/E cao (>25) - Có thể định giá đắt');
                    }
                    
                    let rating = '';
                    let recommendation = '';
                    
                    if (score >= 80) {
                        rating = '🏆 BUFFETT WOULD LOVE IT!';
                        recommendation = 'Đây là loại công ty Buffett sẽ rất quan tâm. Hãy tìm hiểu sâu hơn về "con hào kinh tế" và đội ngũ quản lý.';
                    } else if (score >= 60) {
                        rating = '👍 QUALITY COMPANY';
                        recommendation = 'Công ty chất lượng tốt, phù hợp đầu tư dài hạn nếu có biên an toàn.';
                    } else if (score >= 40) {
                        rating = '⚠️ NEEDS IMPROVEMENT';
                        recommendation = 'Công ty cần cải thiện một số chỉ số tài chính trước khi đầu tư.';
                    } else {
                        rating = '❌ NOT BUFFETT STYLE';
                        recommendation = 'Không phù hợp với tiêu chí đầu tư của Buffett.';
                    }
                    
                    const resultDiv = document.getElementById('buffett-result');
                    resultDiv.innerHTML = `
                        <h4>🏆 Đánh Giá Theo Phong Cách Buffett</h4>
                        <p><strong>Điểm số:</strong> ${score}/100</p>
                        <p><strong>Xếp hạng:</strong> ${rating}</p>
                        <p><strong>Khuyến nghị:</strong> ${recommendation}</p>
                        
                        <h5>📋 Chi tiết phân tích:</h5>
                        <ul>
                            ${details.map(detail => `<li>${detail}</li>`).join('')}
                        </ul>
                        
                        <h5>💡 Lời khuyên từ Buffett:</h5>
                        <p><em>"Tốt hơn là mua một công ty tuyệt vời với giá hợp lý hơn là mua một công ty hợp lý với giá tuyệt vời."</em></p>
                    `;
                    resultDiv.style.display = 'block';
                }

                // Initialize app
                document.addEventListener('DOMContentLoaded', function() {
                    // Draw initial candlestick patterns
                    setTimeout(initializeCandlestickModule, 500);
                    
                    // Initialize quiz data
                    initializeQuizData();
                });

                function initializeQuizData() {
                    quizData = [
                        {
                            question: "Theo Warren Buffett, 'Con hào kinh tế' là gì?",
                            options: [
                                "Khoản nợ của công ty",
                                "Lợi nhuận cao",
                                "Lợi thế cạnh tranh bền vững",
                                "Giá cổ phiếu thấp"
                            ],
                            correct: 2,
                            explanation: "Con hào kinh tế là lợi thế cạnh tranh bền vững giúp bảo vệ lợi nhuận và thị phần của công ty."
                        },
                        {
                            question: "Mô hình nến Hammer xuất hiện ở đâu để có tín hiệu mạnh nhất?",
                            options: [
                                "Đỉnh xu hướng tăng",
                                "Đáy xu hướng giảm", 
                                "Giữa xu hướng tăng",
                                "Thị trường đi ngang"
                            ],
                            correct: 1,
                            explanation: "Hammer xuất hiện ở đáy xu hướng giảm là tín hiệu đảo chiều tăng mạnh mẽ."
                        },
                        {
                            question: "RSI trên 70 thường báo hiệu điều gì?",
                            options: [
                                "Thị trường quá bán",
                                "Thị trường quá mua",
                                "Xu hướng mạnh",
                                "Không có ý nghĩa"
                            ],
                            correct: 1,
                            explanation: "RSI > 70 cho thấy thị trường có thể đang quá mua và sắp có điều chỉnh giảm."
                        },
                        {
                            question: "Phương pháp SEPA của Mark Minervini có bao nhiều yếu tố cốt lõi?",
                            options: [
                                "3 yếu tố",
                                "4 yếu tố", 
                                "5 yếu tố",
                                "6 yếu tố"
                            ],
                            correct: 2,
                            explanation: "SEPA gồm 5 yếu tố: Trend, Fundamentals, Catalyst, Entry Point, Exit Point."
                        },
                        {
                            question: "Trong phân tích cơ bản, ROE đo lường điều gì?",
                            options: [
                                "Tỷ lệ nợ trên vốn",
                                "Hiệu quả sử dụng vốn chủ sở hữu",
                                "Tốc độ tăng trưởng",
                                "Giá trị sổ sách"
                            ],
                            correct: 1,
                            explanation: "ROE (Return on Equity) đo lường hiệu quả sử dụng vốn của cổ đông để tạo ra lợi nhuận."
                        }
                    ];
                }
// === THÊM CÁC HÀM VẼ TREND ===
function drawTrendDemo(type) {
    const canvas = document.getElementById('trend-demo');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Vẽ nền
    ctx.fillStyle = '#f8f9fa';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Vẽ grid
    ctx.strokeStyle = '#e0e0e0';
    ctx.lineWidth = 1;
    for (let i = 50; i < canvas.height; i += 50) {
        ctx.beginPath();
        ctx.moveTo(0, i);
        ctx.lineTo(canvas.width, i);
        ctx.stroke();
    }
    
    ctx.strokeStyle = '#333';
    ctx.lineWidth = 2;
    
    switch(type) {
        case 'uptrend':
            // Vẽ xu hướng tăng
            ctx.beginPath();
            ctx.moveTo(50, 350);
            ctx.lineTo(150, 280);
            ctx.lineTo(250, 320);
            ctx.lineTo(350, 200);
            ctx.lineTo(450, 250);
            ctx.lineTo(550, 150);
            ctx.lineTo(650, 180);
            ctx.lineTo(750, 100);
            ctx.stroke();
            
            // Vẽ support line
            ctx.strokeStyle = '#4CAF50';
            ctx.setLineDash([5, 5]);
            ctx.beginPath();
            ctx.moveTo(50, 350);
            ctx.lineTo(750, 200);
            ctx.stroke();
            ctx.setLineDash([]);
            
            // Label
            ctx.fillStyle = '#4CAF50';
            ctx.font = 'bold 16px Arial';
            ctx.fillText('Xu Hướng Tăng', 350, 30);
            break;
            
        case 'downtrend':
            // Vẽ xu hướng giảm
            ctx.beginPath();
            ctx.moveTo(50, 100);
            ctx.lineTo(150, 170);
            ctx.lineTo(250, 130);
            ctx.lineTo(350, 250);
            ctx.lineTo(450, 200);
            ctx.lineTo(550, 300);
            ctx.lineTo(650, 270);
            ctx.lineTo(750, 350);
            ctx.stroke();
            
            // Vẽ resistance line
            ctx.strokeStyle = '#f44336';
            ctx.setLineDash([5, 5]);
            ctx.beginPath();
            ctx.moveTo(50, 100);
            ctx.lineTo(750, 250);
            ctx.stroke();
            ctx.setLineDash([]);
            
            // Label
            ctx.fillStyle = '#f44336';
            ctx.font = 'bold 16px Arial';
            ctx.fillText('Xu Hướng Giảm', 350, 30);
            break;
            
        case 'sideways':
            // Vẽ đi ngang
            ctx.beginPath();
            ctx.moveTo(50, 200);
            ctx.lineTo(150, 180);
            ctx.lineTo(250, 220);
            ctx.lineTo(350, 190);
            ctx.lineTo(450, 210);
            ctx.lineTo(550, 185);
            ctx.lineTo(650, 215);
            ctx.lineTo(750, 195);
            ctx.stroke();
            
            // Vẽ support & resistance
            ctx.strokeStyle = '#FF9800';
            ctx.setLineDash([5, 5]);
            ctx.beginPath();
            ctx.moveTo(0, 170);
            ctx.lineTo(800, 170);
            ctx.moveTo(0, 230);
            ctx.lineTo(800, 230);
            ctx.stroke();
            ctx.setLineDash([]);
            
            // Label
            ctx.fillStyle = '#FF9800';
            ctx.font = 'bold 16px Arial';
            ctx.fillText('Thị Trường Đi Ngang', 330, 30);
            break;
    }
    
    // Hiển thị phân tích
    const analysisDiv = document.getElementById('trend-analysis');
    if (analysisDiv) {
        let analysis = '';
        switch(type) {
            case 'uptrend':
                analysis = '<h4>📈 Đặc điểm Xu Hướng Tăng:</h4><ul><li>Đỉnh sau cao hơn đỉnh trước</li><li>Đáy sau cao hơn đáy trước</li><li>Đường hỗ trợ dốc lên</li><li>Chiến lược: Mua trong các đợt điều chỉnh về support</li></ul>';
                break;
            case 'downtrend':
                analysis = '<h4>📉 Đặc điểm Xu Hướng Giảm:</h4><ul><li>Đỉnh sau thấp hơn đỉnh trước</li><li>Đáy sau thấp hơn đáy trước</li><li>Đường kháng cự dốc xuống</li><li>Chiến lược: Bán trong các đợt hồi phục về resistance</li></ul>';
                break;
            case 'sideways':
                analysis = '<h4>↔️ Đặc điểm Thị Trường Đi Ngang:</h4><ul><li>Giá dao động trong khoảng</li><li>Không có xu hướng rõ ràng</li><li>Support và Resistance nằm ngang</li><li>Chiến lược: Mua ở support, bán ở resistance</li></ul>';
                break;
        }
        analysisDiv.innerHTML = analysis;
        analysisDiv.style.display = 'block';
    }
}

function clearTrendDemo() {
    const canvas = document.getElementById('trend-demo');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
    const analysisDiv = document.getElementById('trend-analysis');
    if (analysisDiv) {
        analysisDiv.style.display = 'none';
    }
}

// === THÊM HÀM ANALYZE CANDLE ===
function analyzeCandle() {
    const open = parseFloat(document.getElementById('interactive-open').value);
    const high = parseFloat(document.getElementById('interactive-high').value);
    const low = parseFloat(document.getElementById('interactive-low').value);
    const close = parseFloat(document.getElementById('interactive-close').value);
    const trend = document.getElementById('trend-context').value;
    const position = document.getElementById('trend-position-context').value;
    
    if (!open || !high || !low || !close) {
        alert('Vui lòng nhập đầy đủ giá OHLC!');
        return;
    }
    
    // Validate OHLC
    if (high < Math.max(open, close) || low > Math.min(open, close)) {
        alert('Giá không hợp lệ! High phải ≥ Max(Open,Close) và Low phải ≤ Min(Open,Close)');
        return;
    }
    
    // Vẽ nến
    const canvas = document.getElementById('interactive-candle');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Vẽ background
        ctx.fillStyle = '#f8f9fa';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Chuẩn hóa giá để vẽ
        const priceRange = high - low;
        const scale = 200 / priceRange;
        const centerX = canvas.width / 2;
        const topMargin = 50;
        
        // Vẽ nến
        const candleType = close >= open ? 'bullish' : 'bearish';
        const bodyTop = topMargin + (high - Math.max(open, close)) * scale;
        const bodyHeight = Math.abs(close - open) * scale;
        const shadowTop = topMargin;
        const shadowBottom = topMargin + (high - low) * scale;
        
        // Vẽ bóng
        ctx.strokeStyle = '#333';
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(centerX, shadowTop);
        ctx.lineTo(centerX, shadowBottom);
        ctx.stroke();
        
        // Vẽ thân
        ctx.fillStyle = candleType === 'bullish' ? '#4CAF50' : '#f44336';
        ctx.fillRect(centerX - 30, bodyTop, 60, bodyHeight || 2);
        ctx.strokeRect(centerX - 30, bodyTop, 60, bodyHeight || 2);
        
        // Labels
        ctx.fillStyle = '#333';
        ctx.font = '12px Arial';
        ctx.textAlign = 'left';
        ctx.fillText(`H: ${high}`, 10, 20);
        ctx.fillText(`O: ${open}`, 10, 35);
        ctx.fillText(`C: ${close}`, 10, 50);
        ctx.fillText(`L: ${low}`, 10, 65);
    }
    
    // Phân tích pattern
    const resultDiv = document.getElementById('candle-analysis-result');
    let pattern = identifyCandlePattern(open, high, low, close);
    let interpretation = interpretPattern(pattern, trend, position);
    
    resultDiv.innerHTML = `
        <h4>📊 Kết Quả Phân Tích</h4>
        <p><strong>Loại nến:</strong> ${close >= open ? '🟢 Nến Tăng' : '🔴 Nến Giảm'}</p>
        <p><strong>Pattern nhận dạng:</strong> ${pattern}</p>
        <p><strong>Bối cảnh:</strong> ${trend === 'uptrend' ? 'Xu hướng tăng' : trend === 'downtrend' ? 'Xu hướng giảm' : 'Đi ngang'} - ${position === 'beginning' ? 'Đầu xu hướng' : position === 'middle' ? 'Giữa xu hướng' : 'Cuối xu hướng'}</p>
        <p><strong>Diễn giải:</strong> ${interpretation}</p>
    `;
    resultDiv.style.display = 'block';
}

function identifyCandlePattern(open, high, low, close) {
    const body = Math.abs(close - open);
    const upperShadow = high - Math.max(open, close);
    const lowerShadow = Math.min(open, close) - low;
    const range = high - low;
    
    // Doji
    if (body / range < 0.1) {
        if (lowerShadow > upperShadow * 2) return 'Dragonfly Doji';
        if (upperShadow > lowerShadow * 2) return 'Gravestone Doji';
        return 'Doji';
    }
    
    // Hammer/Hanging Man
    if (lowerShadow > body * 2 && upperShadow < body * 0.3) {
        return close > open ? 'Hammer' : 'Hanging Man';
    }
    
    // Inverted Hammer/Shooting Star
    if (upperShadow > body * 2 && lowerShadow < body * 0.3) {
        return close > open ? 'Inverted Hammer' : 'Shooting Star';
    }
    
    // Marubozu
    if (upperShadow < range * 0.05 && lowerShadow < range * 0.05) {
        return close > open ? 'Bullish Marubozu' : 'Bearish Marubozu';
    }
    
    // Spinning Top
    if (body < range * 0.3 && upperShadow > body && lowerShadow > body) {
        return 'Spinning Top';
    }
    
    return close > open ? 'Bullish Candle' : 'Bearish Candle';
}

function interpretPattern(pattern, trend, position) {
    const interpretations = {
        'Hammer': {
            'downtrend': {
                'end': '🟢 Tín hiệu đảo chiều tăng mạnh! Phe mua đang kiểm soát.',
                'middle': '⚠️ Có thể là tín hiệu đảo chiều, cần xác nhận.',
                'beginning': 'Chưa có ý nghĩa rõ ràng trong xu hướng mới.'
            }
        },
        'Shooting Star': {
            'uptrend': {
                'end': '🔴 Tín hiệu đảo chiều giảm mạnh! Áp lực bán tăng.',
                'middle': '⚠️ Cảnh báo điều chỉnh, theo dõi thêm.',
                'beginning': 'Có thể chỉ là profit taking nhẹ.'
            }
        },
        'Doji': {
            'default': '⚖️ Thị trường đang do dự, có thể đảo chiều.'
        }
    };
    
    if (interpretations[pattern] && interpretations[pattern][trend] && interpretations[pattern][trend][position]) {
        return interpretations[pattern][trend][position];
    }
    
    return interpretations[pattern]?.default || 'Cần thêm dữ liệu để phân tích chính xác.';
}

// === THÊM HÀM VẼ SUPPORT/RESISTANCE ===
function drawSRDemo(type) {
    const canvas = document.getElementById('sr-canvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Background
    ctx.fillStyle = '#f8f9fa';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Vẽ price action giả định
    ctx.strokeStyle = '#333';
    ctx.lineWidth = 2;
    ctx.beginPath();
    
    // Price movement
    const prices = [250, 240, 260, 255, 270, 265, 280, 275, 290, 285, 300, 295, 310, 305, 320];
    const xStep = canvas.width / prices.length;
    
    prices.forEach((price, i) => {
        const x = i * xStep + 50;
        const y = canvas.height - price;
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
    });
    ctx.stroke();
    
    switch(type) {
        case 'support':
            // Vẽ support lines
            ctx.strokeStyle = '#4CAF50';
            ctx.lineWidth = 3;
            ctx.setLineDash([10, 5]);
            
            // Support 1
            ctx.beginPath();
            ctx.moveTo(0, canvas.height - 240);
            ctx.lineTo(canvas.width, canvas.height - 240);
            ctx.stroke();
            
            // Support 2
            ctx.beginPath();
            ctx.moveTo(0, canvas.height - 265);
            ctx.lineTo(canvas.width, canvas.height - 265);
            ctx.stroke();
            
            // Labels
            ctx.fillStyle = '#4CAF50';
            ctx.font = 'bold 14px Arial';
            ctx.fillText('Hỗ trợ 1', 10, canvas.height - 245);
            ctx.fillText('Hỗ trợ 2', 10, canvas.height - 270);
            break;
            
        case 'resistance':
            // Vẽ resistance lines
            ctx.strokeStyle = '#f44336';
            ctx.lineWidth = 3;
            ctx.setLineDash([10, 5]);
            
            // Resistance 1
            ctx.beginPath();
            ctx.moveTo(0, canvas.height - 295);
            ctx.lineTo(canvas.width, canvas.height - 295);
            ctx.stroke();
            
            // Resistance 2
            ctx.beginPath();
            ctx.moveTo(0, canvas.height - 320);
            ctx.lineTo(canvas.width, canvas.height - 320);
            ctx.stroke();
            
            // Labels
            ctx.fillStyle = '#f44336';
            ctx.font = 'bold 14px Arial';
            ctx.fillText('Kháng cự 1', 10, canvas.height - 300);
            ctx.fillText('Kháng cự 2', 10, canvas.height - 325);
            break;
            
        case 'trendline':
            // Vẽ trendlines
            ctx.strokeStyle = '#2196F3';
            ctx.lineWidth = 3;
            
            // Uptrend line
            ctx.beginPath();
            ctx.moveTo(50, canvas.height - 240);
            ctx.lineTo(750, canvas.height - 310);
            ctx.stroke();
            
            // Label
            ctx.fillStyle = '#2196F3';
            ctx.font = 'bold 14px Arial';
            ctx.fillText('Đường xu hướng tăng', 300, canvas.height - 290);
            break;
            
        case 'channel':
            // Vẽ channel
            ctx.strokeStyle = '#9C27B0';
            ctx.lineWidth = 3;
            
            // Upper channel
            ctx.beginPath();
            ctx.moveTo(50, canvas.height - 260);
            ctx.lineTo(750, canvas.height - 330);
            ctx.stroke();
            
            // Lower channel
            ctx.beginPath();
            ctx.moveTo(50, canvas.height - 220);
            ctx.lineTo(750, canvas.height - 290);
            ctx.stroke();
            
            // Label
            ctx.fillStyle = '#9C27B0';
            ctx.font = 'bold 14px Arial';
            ctx.fillText('Kênh giá tăng', 350, 30);
            break;
    }
    
    // Analysis
    const analysisDiv = document.getElementById('sr-analysis');
    if (analysisDiv) {
        let analysis = '';
        switch(type) {
            case 'support':
                analysis = '<h4>🛡️ Ngưỡng Hỗ Trợ</h4><p>Vùng giá mà lực mua mạnh, ngăn giá giảm tiếp. Chiến lược: Mua khi giá test support.</p>';
                break;
            case 'resistance':
                analysis = '<h4>🚧 Ngưỡng Kháng Cự</h4><p>Vùng giá mà lực bán mạnh, ngăn giá tăng tiếp. Chiến lược: Bán khi giá test resistance.</p>';
                break;
            case 'trendline':
                analysis = '<h4>📈 Đường Xu Hướng</h4><p>Nối các đáy tăng dần tạo support động. Phá vỡ = đảo chiều xu hướng.</p>';
                break;
            case 'channel':
                analysis = '<h4>📊 Kênh Giá</h4><p>Hai đường song song tạo kênh. Mua ở đường dưới, bán ở đường trên.</p>';
                break;
        }
        analysisDiv.innerHTML = analysis;
        analysisDiv.style.display = 'block';
    }
}

function clearSRDemo() {
    const canvas = document.getElementById('sr-canvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
    const analysisDiv = document.getElementById('sr-analysis');
    if (analysisDiv) {
        analysisDiv.style.display = 'none';
    }
}
// === QUIZ FUNCTIONS ===
function initializeQuizSection() {
    // Initialize quiz when section is shown
    console.log('Quiz section initialized');
}
function startBasicQuiz() {
    const questions = [
        {
            question: "P/E ratio là gì?",
            options: ["Price to Earnings", "Profit to Equity", "Price to Equity", "Profit to Earnings"],
            correct: 0
        },
        {
            question: "RSI > 70 báo hiệu gì?",
            options: ["Quá bán", "Quá mua", "Trung tính", "Xu hướng giảm"],
            correct: 1
        },
        // Thêm câu hỏi khác...
    ];

    displayQuiz(questions, 'basic-quiz-content', 'basic-quiz-result');
}
function startAdvancedQuiz() {
    const questions = [
        {
            question: "VCP pattern có bao nhiêu giai đoạn contraction?",
            options: ["2-3", "3-4", "4-5", "5-6"],
            correct: 1
        },
        // Thêm câu hỏi khác...
    ];

    displayQuiz(questions, 'advanced-quiz-content', 'advanced-quiz-result');
}
function displayQuiz(questions, contentId, resultId) {
    const contentDiv = document.getElementById(contentId);
    let html = '';
    
    questions.forEach((q, index) => {
        html += `
            <div class="question">
                <h4>Câu ${index + 1}: ${q.question}</h4>
                <div class="options">
                    ${q.options.map((opt, i) => `
                        <div class="option" onclick="selectOption(${index}, ${i})">
                            ${opt}
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
    });
    
    html += '<button class="btn btn-success" onclick="submitQuiz()">Nộp Bài</button>';
    contentDiv.innerHTML = html;
}

function selectOption(questionIndex, optionIndex) {
    // Implementation for selecting quiz options
}
// === RESOURCES FUNCTIONS ===
function initializeResourcesSection() {
    console.log('Resources section initialized');
}
// === TOOLS FUNCTIONS ===
function runScreener() {
    const pe = parseFloat(document.getElementById('screener-pe').value);
    const roe = parseFloat(document.getElementById('screener-roe').value);
    const mcap = parseFloat(document.getElementById('screener-mcap').value);
    
    const resultDiv = document.getElementById('screener-result');
    resultDiv.innerHTML = `
        <h4>Kết quả lọc:</h4>
        <p>Tìm thấy 5 cổ phiếu phù hợp:</p>
        <ul>
            <li>VNM - P/E: 18, ROE: 35%</li>
            <li>FPT - P/E: 16, ROE: 22%</li>
            <li>MWG - P/E: 14, ROE: 25%</li>
        </ul>
    `;
    resultDiv.style.display = 'block';
}
function scanPattern() {
    const symbol = document.getElementById('pattern-symbol').value;
    const type = document.getElementById('pattern-type').value;
    
    const resultDiv = document.getElementById('pattern-result');
    resultDiv.innerHTML = `
        <h4>Kết quả quét ${symbol}:</h4>
        <p>Phát hiện mẫu hình:</p>
        <ul>
            <li>Bullish Flag - Độ tin cậy: 85%</li>
            <li>Cup with Handle forming - 70% hoàn thành</li>
        </ul>
    `;
    resultDiv.style.display = 'block';
}

// === TRADING SIMULATION FUNCTIONS ===
let simulationData = {
    isRunning: false,
    currentPrice: 100,
    prices: [],
    capital: 100000000,
    position: null,
    trades: [],
    currentBar: 0
};

function startSimulation() {
    const capital = parseFloat(document.getElementById('sim-capital').value);
    const risk = parseFloat(document.getElementById('sim-risk').value);
    const strategy = document.getElementById('sim-strategy').value;
    
    // Initialize simulation
    simulationData = {
        isRunning: true,
        currentPrice: 100,
        prices: generatePriceData(200), // Generate 200 bars
        capital: capital,
        initialCapital: capital,
        position: null,
        trades: [],
        currentBar: 0,
        risk: risk,
        strategy: strategy
    };
    
    // Start animation
    animateSimulation();
}

function generatePriceData(bars) {
    const prices = [];
    let price = 100;
    
    for (let i = 0; i < bars; i++) {
        const change = (Math.random() - 0.48) * 2; // Slight upward bias
        price = price * (1 + change / 100);
        
        const high = price * (1 + Math.random() * 0.02);
        const low = price * (1 - Math.random() * 0.02);
        const open = price * (1 + (Math.random() - 0.5) * 0.01);
        const close = price * (1 + (Math.random() - 0.5) * 0.01);
        
        prices.push({
            open: open,
            high: Math.max(high, open, close),
            low: Math.min(low, open, close),
            close: close,
            volume: Math.floor(Math.random() * 1000000) + 500000
        });
    }
    
    return prices;
}

function animateSimulation() {
    if (!simulationData.isRunning || simulationData.currentBar >= simulationData.prices.length - 1) {
        simulationData.isRunning = false;
        showSimulationResults();
        return;
    }
    
    // Draw current chart
    drawSimulationChart();
    
    // Apply strategy
    applyTradingStrategy();
    
    // Update stats
    updateSimulationStats();
    
    // Next bar
    simulationData.currentBar++;
    
    // Continue animation
    setTimeout(animateSimulation, 100); // 100ms per bar
}

function drawSimulationChart() {
    const canvas = document.getElementById('simulator-chart');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Background
    ctx.fillStyle = '#f8f9fa';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Draw candles
    const barsToShow = 50;
    const startBar = Math.max(0, simulationData.currentBar - barsToShow + 1);
    const endBar = simulationData.currentBar + 1;
    const barWidth = canvas.width / barsToShow;
    
    for (let i = startBar; i < endBar && i < simulationData.prices.length; i++) {
        const bar = simulationData.prices[i];
        const x = (i - startBar) * barWidth + barWidth / 2;
        
        // Find price range for scaling
        const visibleBars = simulationData.prices.slice(startBar, endBar);
        const highPrice = Math.max(...visibleBars.map(b => b.high));
        const lowPrice = Math.min(...visibleBars.map(b => b.low));
        const priceRange = highPrice - lowPrice;
        
        const scaleY = (price) => {
            return canvas.height - 50 - ((price - lowPrice) / priceRange) * (canvas.height - 100);
        };
        
        // Draw candle
        const color = bar.close >= bar.open ? '#4CAF50' : '#F44336';
        
        // Shadow
        ctx.strokeStyle = '#333';
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(x, scaleY(bar.high));
        ctx.lineTo(x, scaleY(bar.low));
        ctx.stroke();
        
        // Body
        ctx.fillStyle = color;
        const bodyTop = scaleY(Math.max(bar.open, bar.close));
        const bodyHeight = Math.abs(scaleY(bar.close) - scaleY(bar.open)) || 1;
        ctx.fillRect(x - barWidth * 0.3, bodyTop, barWidth * 0.6, bodyHeight);
    }
    
    // Draw position marker if any
    if (simulationData.position) {
        ctx.strokeStyle = simulationData.position.type === 'long' ? '#4CAF50' : '#F44336';
        ctx.lineWidth = 2;
        ctx.setLineDash([5, 5]);
        
        const entryY = scaleY(simulationData.position.entryPrice);
        ctx.beginPath();
        ctx.moveTo(0, entryY);
        ctx.lineTo(canvas.width, entryY);
        ctx.stroke();
        ctx.setLineDash([]);
        
        // Entry label
        ctx.fillStyle = simulationData.position.type === 'long' ? '#4CAF50' : '#F44336';
        ctx.fillText(`Entry: ${simulationData.position.entryPrice.toFixed(2)}`, 10, entryY - 5);
    }
}

function applyTradingStrategy() {
    const currentBar = simulationData.prices[simulationData.currentBar];
    const prevBars = simulationData.prices.slice(Math.max(0, simulationData.currentBar - 20), simulationData.currentBar);
    
    if (prevBars.length < 20) return; // Need enough data
    
    switch (simulationData.strategy) {
        case 'trend':
            applyTrendFollowing(currentBar, prevBars);
            break;
        case 'breakout':
            applyBreakoutStrategy(currentBar, prevBars);
            break;
        case 'reversal':
            applyMeanReversion(currentBar, prevBars);
            break;
    }
}

function applyTrendFollowing(currentBar, prevBars) {
    // Calculate simple moving averages
    const ma10 = prevBars.slice(-10).reduce((sum, bar) => sum + bar.close, 0) / 10;
    const ma20 = prevBars.reduce((sum, bar) => sum + bar.close, 0) / 20;
    
    if (!simulationData.position) {
        // Entry logic
        if (currentBar.close > ma10 && ma10 > ma20) {
            enterPosition('long', currentBar.close);
        }
    } else {
        // Exit logic
        if (currentBar.close < ma10) {
            exitPosition(currentBar.close);
        }
        // Stop loss
        if (currentBar.close < simulationData.position.stopLoss) {
            exitPosition(simulationData.position.stopLoss);
        }
    }
}

function applyBreakoutStrategy(currentBar, prevBars) {
    // Find recent high/low
    const recentHigh = Math.max(...prevBars.map(b => b.high));
    const recentLow = Math.min(...prevBars.map(b => b.low));
    
    if (!simulationData.position) {
        // Breakout entry
        if (currentBar.close > recentHigh) {
            enterPosition('long', currentBar.close);
        }
    } else {
        // Exit on momentum loss
        const entryBar = simulationData.position.entryBar;
        const barsSinceEntry = simulationData.currentBar - entryBar;
        
        if (barsSinceEntry > 5 && currentBar.close < prevBars[prevBars.length - 1].close) {
            exitPosition(currentBar.close);
        }
        // Stop loss
        if (currentBar.close < simulationData.position.stopLoss) {
            exitPosition(simulationData.position.stopLoss);
        }
    }
}

function applyMeanReversion(currentBar, prevBars) {
    // Calculate Bollinger Bands
    const ma20 = prevBars.reduce((sum, bar) => sum + bar.close, 0) / 20;
    const stdDev = Math.sqrt(prevBars.reduce((sum, bar) => sum + Math.pow(bar.close - ma20, 2), 0) / 20);
    const upperBand = ma20 + 2 * stdDev;
    const lowerBand = ma20 - 2 * stdDev;
    
    if (!simulationData.position) {
        // Entry at extremes
        if (currentBar.close < lowerBand) {
            enterPosition('long', currentBar.close);
        }
    } else {
        // Exit at mean or opposite band
        if (currentBar.close > ma20 || currentBar.close > upperBand) {
            exitPosition(currentBar.close);
        }
        // Stop loss
        if (currentBar.close < simulationData.position.stopLoss) {
            exitPosition(simulationData.position.stopLoss);
        }
    }
}

function enterPosition(type, price) {
    const riskAmount = simulationData.capital * (simulationData.risk / 100);
    const stopDistance = price * 0.05; // 5% stop loss
    const shares = Math.floor(riskAmount / stopDistance);
    const positionSize = shares * price;
    
    if (positionSize > simulationData.capital) {
        return; // Not enough capital
    }
    
    simulationData.position = {
        type: type,
        entryPrice: price,
        shares: shares,
        stopLoss: type === 'long' ? price * 0.95 : price * 1.05,
        entryBar: simulationData.currentBar
    };
    
    simulationData.capital -= positionSize;
}

function exitPosition(price) {
    if (!simulationData.position) return;
    
    const position = simulationData.position;
    const exitValue = position.shares * price;
    const entryValue = position.shares * position.entryPrice;
    const profit = position.type === 'long' ? 
        exitValue - entryValue : 
        entryValue - exitValue;
    
    simulationData.capital += exitValue;
    
    simulationData.trades.push({
        type: position.type,
        entryPrice: position.entryPrice,
        exitPrice: price,
        shares: position.shares,
        profit: profit,
        profitPercent: (profit / entryValue) * 100
    });
    
    simulationData.position = null;
}

function updateSimulationStats() {
    const wins = simulationData.trades.filter(t => t.profit > 0).length;
    const losses = simulationData.trades.filter(t => t.profit <= 0).length;
    const totalTrades = wins + losses;
    const winRate = totalTrades > 0 ? (wins / totalTrades * 100).toFixed(1) : 0;
    
    const totalProfit = simulationData.capital - simulationData.initialCapital;
    const profitPercent = (totalProfit / simulationData.initialCapital * 100).toFixed(2);
    
    document.getElementById('sim-current-capital').textContent = formatNumber(simulationData.capital);
    document.getElementById('sim-trades').textContent = totalTrades;
    document.getElementById('sim-winrate').textContent = winRate + '%';
    document.getElementById('sim-profit').textContent = formatNumber(totalProfit) + ` (${profitPercent}%)`;
}

function pauseSimulation() {
    simulationData.isRunning = false;
}

function resetSimulation() {
    simulationData.isRunning = false;
    simulationData.currentBar = 0;
    simulationData.trades = [];
    simulationData.position = null;
    
    const canvas = document.getElementById('simulator-chart');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
    
    // Reset stats display
    document.getElementById('sim-current-capital').textContent = formatNumber(simulationData.initialCapital);
    document.getElementById('sim-trades').textContent = '0';
    document.getElementById('sim-winrate').textContent = '0%';
    document.getElementById('sim-profit').textContent = '0';
}

function showSimulationResults() {
    const results = analyzeSimulationResults();
    alert(`
Kết quả mô phỏng:
- Tổng giao dịch: ${results.totalTrades}
- Tỷ lệ thắng: ${results.winRate}%
- Lợi nhuận: ${results.profitPercent}%
- Lãi/lỗ lớn nhất: ${results.maxWin}% / ${results.maxLoss}%
- Sharpe Ratio: ${results.sharpe}
    `);
}

function analyzeSimulationResults() {
    const wins = simulationData.trades.filter(t => t.profit > 0);
    const losses = simulationData.trades.filter(t => t.profit <= 0);
    
    return {
        totalTrades: simulationData.trades.length,
        winRate: (wins.length / simulationData.trades.length * 100).toFixed(1),
        profitPercent: ((simulationData.capital - simulationData.initialCapital) / simulationData.initialCapital * 100).toFixed(2),
        maxWin: wins.length > 0 ? Math.max(...wins.map(t => t.profitPercent)).toFixed(2) : 0,
        maxLoss: losses.length > 0 ? Math.min(...losses.map(t => t.profitPercent)).toFixed(2) : 0,
        sharpe: calculateSharpeRatio()
    };
}

function calculateSharpeRatio() {
    if (simulationData.trades.length < 2) return 0;
    
    const returns = simulationData.trades.map(t => t.profitPercent);
    const avgReturn = returns.reduce((a, b) => a + b) / returns.length;
    const stdDev = Math.sqrt(returns.reduce((sum, r) => sum + Math.pow(r - avgReturn, 2), 0) / returns.length);
    
    return stdDev > 0 ? (avgReturn / stdDev).toFixed(2) : 0;
}

function formatNumber(num) {
    return new Intl.NumberFormat('vi-VN').format(Math.round(num));
}
                // Dark mode toggle
                function toggleDarkMode() {
                    document.body.classList.toggle('dark-mode');
                    const isDark = document.body.classList.contains('dark-mode');
                    document.querySelector('.dark-mode-toggle').textContent = isDark ? '☀️' : '🌙';
                }

                // Additional utility functions would go here...
                </script>
            </div>
        </div>
    </div>
</body>
</html>