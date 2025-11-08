<!DOCTYPE html> 
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máy tính tỷ lệ vàng và biến thể - Toàn diện</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Full Width */
        .header {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: white;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .menu-toggle {
            display: none;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .header-title {
            flex: 1;
        }

        .header h1 {
            font-size: 1.8rem;
            margin-bottom: 3px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .apps-store-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .apps-store-btn:hover {
            background: white;
            color: #FFA500;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Main Container */
        .container {
            display: flex;
            flex: 1;
            max-width: 100%;
            margin: 0;
            background: white;
        }

        /* Sidebar Navigation */
        .sidebar {
            width: 280px;
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            overflow-y: auto;
            position: sticky;
            top: 80px;
            height: calc(100vh - 80px);
            transition: transform 0.3s ease;
        }

        .nav-menu {
            list-style: none;
            padding: 20px 0;
        }

        .nav-item {
            border-bottom: 1px solid #f0f0f0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            color: #555;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            cursor: pointer;
            border-left: 4px solid transparent;
        }

        .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
            color: #FFD700;
        }

        .nav-link:hover {
            background: rgba(255, 215, 0, 0.1);
            border-left-color: #FFD700;
        }

        .nav-link.active {
            background: rgba(255, 215, 0, 0.15);
            color: #FF6B35;
            border-left-color: #FFA500;
            font-weight: 600;
        }

        .nav-link.active i {
            color: #FF6B35;
        }

        /* Content Area */
        .content-wrapper {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
            background: #fafafa;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Footer Full Width */
        .footer {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: white;
            text-align: center;
            padding: 20px 30px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            margin-top: auto;
        }

        .footer p {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }

        .card h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.2rem;
            border-bottom: 2px solid #FFD700;
            padding-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus, .input-group select:focus {
            outline: none;
            border-color: #FFD700;
            box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.2);
        }

        .input-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .input-triple {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 8px;
        }

        .btn {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-right: 6px;
            margin-bottom: 6px;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #495057);
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #20c997);
        }

        .btn-info {
            background: linear-gradient(135deg, #17a2b8, #138496);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800);
        }

        .result-box {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px;
            margin-top: 10px;
            font-family: 'Courier New', monospace;
            font-size: 0.8rem;
            max-height: 180px;
            overflow-y: auto;
        }

        .ratio-display {
            font-size: 1.3rem;
            color: #FFD700;
            font-weight: bold;
            text-align: center;
            margin: 15px 0;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            background: rgba(255, 215, 0, 0.1);
            padding: 10px;
            border-radius: 8px;
        }

        .canvas-container {
            border: 2px solid #FFD700;
            border-radius: 8px;
            margin-top: 15px;
            background: white;
            position: relative;
        }

        canvas {
            display: block;
            max-width: 100%;
            border-radius: 6px;
        }

        .preset-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 10px;
        }

        .preset-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .preset-btn:hover {
            background: #5a6268;
        }

        .proportion-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 8px;
            margin-top: 10px;
        }

        .proportion-item {
            background: rgba(255, 215, 0, 0.1);
            padding: 8px;
            border-radius: 5px;
            text-align: center;
            font-size: 0.75rem;
            border: 1px solid rgba(255, 215, 0, 0.3);
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .info-panel {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin: 15px 0;
            border-radius: 0 8px 8px 0;
        }

        .info-panel h4 {
            color: #1976d2;
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .info-panel p {
            margin: 5px 0;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .ratio-comparison {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }

        .ratio-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
        }

        .ratio-card h5 {
            color: #495057;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .ratio-card .value {
            font-size: 1.1rem;
            font-weight: bold;
            color: #007bff;
        }

        .spiral-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            flex-wrap: wrap;
        }

        .color-input {
            width: 40px !important;
            height: 30px;
            padding: 2px;
            border-radius: 5px;
        }

        .tabs-secondary {
            display: flex;
            margin-bottom: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 3px;
        }

        .tab-secondary {
            flex: 1;
            padding: 8px;
            text-align: center;
            background: transparent;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-size: 0.8rem;
        }

        .tab-secondary.active {
            background: #FFD700;
            color: white;
        }

        .tab-content-secondary {
            display: none;
        }

        .tab-content-secondary.active {
            display: block;
        }

        .fibonacci-sequence {
            max-height: 200px;
            overflow-y: auto;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            border: 2px solid #e9ecef;
        }

        .fibonacci-number {
            display: inline-block;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 5px 10px;
            margin: 3px;
            border-radius: 20px;
            font-size: 0.9rem;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        .design-grid {
            border: 2px solid #FFD700;
            border-radius: 8px;
            margin-top: 20px;
            overflow: hidden;
            background: #fff;
            position: relative;
            height: 300px;
        }

        .grid-section {
            position: absolute;
            border: 1px solid #FFD700;
            background: rgba(255, 215, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #FF6B35;
            transition: background-color 0.3s ease;
        }

        .grid-section:hover {
            background: rgba(255, 215, 0, 0.3);
        }

        .ratio-calculations {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }

        .ratio-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .ratio-item:last-child {
            border-bottom: none;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .header h1 {
                font-size: 1.3rem;
            }

            .header p {
                font-size: 0.8rem;
                display: none;
            }

            .menu-toggle {
                display: block;
            }

            .apps-store-btn {
                padding: 8px 12px;
                font-size: 0.8rem;
            }

            .apps-store-btn span {
                display: none;
            }

            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                width: 280px;
                height: 100vh;
                transform: translateX(-100%);
                z-index: 1100;
                box-shadow: 2px 0 20px rgba(0, 0, 0, 0.3);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1050;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .content-wrapper {
                padding: 15px;
            }

            .tools-grid {
                grid-template-columns: 1fr;
            }

            .input-row, .input-triple {
                grid-template-columns: 1fr;
            }

            .ratio-comparison {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer {
                padding: 15px 20px;
            }

            .footer p {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header Full Width -->
    <div class="header">
        <div class="header-left">
            <button class="menu-toggle" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="header-title">
                <h1>🌟 Máy tính tỷ lệ vàng và biến thể toàn diện</h1>
                <p>Khám phá tỷ lệ vàng, tỷ lệ bạc, trung bình kim loại (metallic means) và ứng dụng trong mọi lĩnh vực</p>
            </div>
        </div>
        <div class="header-actions">
            <a href="https://dinhdanh.com/apps_store" target="_blank" class="apps-store-btn">
                <i class="fas fa-cube"></i>
                <span>Kho ứng dụng</span>
            </a>
        </div>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" onclick="toggleMenu()"></div>

    <!-- Main Container -->
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a class="nav-link active" onclick="switchMainTab('basic', this)">
                        <i class="fas fa-calculator"></i>
                        <span>Cơ bản</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('variants', this)">
                        <i class="fas fa-bolt"></i>
                        <span>Biến thể</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('architecture', this)">
                        <i class="fas fa-landmark"></i>
                        <span>Kiến trúc</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('construction', this)">
                        <i class="fas fa-hard-hat"></i>
                        <span>Xây dựng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('sculpture', this)">
                        <i class="fas fa-palette"></i>
                        <span>Điêu khắc</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('art', this)">
                        <i class="fas fa-paint-brush"></i>
                        <span>Nghệ thuật</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('nature', this)">
                        <i class="fas fa-leaf"></i>
                        <span>Tự nhiên</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('finance', this)">
                        <i class="fas fa-coins"></i>
                        <span>Tài chính</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('medicine', this)">
                        <i class="fas fa-heartbeat"></i>
                        <span>Y học</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('physics', this)">
                        <i class="fas fa-atom"></i>
                        <span>Vật lý</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('music', this)">
                        <i class="fas fa-music"></i>
                        <span>Âm nhạc</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('psychology', this)">
                        <i class="fas fa-brain"></i>
                        <span>Tâm lý</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('astronomy', this)">
                        <i class="fas fa-star"></i>
                        <span>Thiên văn</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('technology', this)">
                        <i class="fas fa-laptop-code"></i>
                        <span>Công nghệ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('fashion', this)">
                        <i class="fas fa-tshirt"></i>
                        <span>Thời trang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('culinary', this)">
                        <i class="fas fa-utensils"></i>
                        <span>Ẩm thực</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('sports', this)">
                        <i class="fas fa-football-ball"></i>
                        <span>Thể thao</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="switchMainTab('calculator', this)">
                        <i class="fas fa-chart-line"></i>
                        <span>Máy tính</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content Wrapper -->
        <div class="content-wrapper">

        <!-- Tab Cơ bản -->
        <div id="basic" class="tab-content active">
            <div class="tools-grid">
                <div class="card">
                    <h3>📐 Máy tính tỷ lệ vàng</h3>
                    
                    <div class="tabs-secondary">
                        <button class="tab-secondary active" onclick="switchTab('ratio', this)">Tính tỷ lệ</button>
                        <button class="tab-secondary" onclick="switchTab('segments', this)">Chia đoạn</button>
                    </div>

                    <div id="ratio" class="tab-content-secondary active">
                        <div class="input-group">
                            <label>Nhập chiều dài lớn (a):</label>
                            <input type="number" id="lengthA" placeholder="Ví dụ: 100" step="0.01">
                        </div>
                        <div class="input-group">
                            <label>Nhập chiều dài nhỏ (b):</label>
                            <input type="number" id="lengthB" placeholder="Ví dụ: 61.8" step="0.01">
                        </div>
                        <button class="btn" onclick="calculateRatio()">Tính tỷ lệ</button>
                        <button class="btn" onclick="findGoldenPartner()">Tìm cặp vàng</button>
                    </div>

                    <div id="segments" class="tab-content-secondary">
                        <div class="input-group">
                            <label>Chiều dài tổng:</label>
                            <input type="number" id="totalLength" placeholder="Ví dụ: 100" step="0.01">
                        </div>
                        <button class="btn" onclick="divideGoldenSegments()">Chia theo tỷ lệ vàng</button>
                    </div>

                    <div class="ratio-display" id="goldenRatioDisplay">
                        φ = 1.618033988749...
                    </div>

                    <div class="result-box" id="ratioResult">
                        Kết quả sẽ hiển thị ở đây...
                    </div>
                </div>

                <div class="card">
                    <h3>🌀 Sinh dãy Fibonacci</h3>
                    
                    <div class="input-group">
                        <label>Số lượng số Fibonacci:</label>
                        <input type="number" id="fibCount" placeholder="Ví dụ: 20" min="1" max="50" value="10">
                    </div>
                    
                    <div class="input-group">
                        <label>Số bắt đầu (tùy chọn):</label>
                        <input type="number" id="fibStart" placeholder="Ví dụ: 100" step="0.01">
                    </div>

                    <button class="btn" onclick="generateFibonacci()">Sinh dãy Fibonacci</button>
                    <button class="btn" onclick="showFibonacciRatios()">Xem tỷ lệ</button>
                    <button class="btn" onclick="animateFibonacci()">Hoạt ảnh</button>

                    <div class="fibonacci-sequence" id="fibonacciSequence">
                        Dãy Fibonacci sẽ hiển thị ở đây...
                    </div>

                    <div class="ratio-calculations" id="fibonacciRatios" style="display: none;">
                        <h4>Tỷ lệ giữa các số liên tiếp:</h4>
                        <div id="ratioList"></div>
                    </div>
                </div>
            </div>

            <div class="card full-width">
                <h3>🎨 Lưới thiết kế tỷ lệ vàng</h3>
                
                <div class="input-group" style="display: inline-block; width: 200px; margin-right: 20px;">
                    <label>Chiều rộng (px):</label>
                    <input type="number" id="gridWidth" value="400" min="200" max="800">
                </div>
                
                <button class="btn" onclick="generateDesignGrid()">Tạo lưới thiết kế</button>
                <button class="btn" onclick="showGridInfo()">Thông tin lưới</button>

                <div class="design-grid" id="designGrid">
                    <div class="grid-section" style="width: 100%; height: 100%; font-size: 1.2rem;">
                        Nhấn "Tạo lưới thiết kế" để xem demo
                    </div>
                </div>

                <div class="result-box" id="gridInfo" style="display: none;">
                    Thông tin về lưới thiết kế sẽ hiển thị ở đây...
                </div>
            </div>
        </div>

        <!-- Tab Biến thể -->
        <div id="variants" class="tab-content">
            <div class="info-panel">
                <h4>⚡ Các biến thể của tỷ lệ vàng</h4>
                <p>Ngoài tỷ lệ vàng (φ ≈ 1.618), còn có nhiều "trung bình kim loại" (metallic means) khác với ứng dụng riêng biệt.</p>
            </div>

            <div class="ratio-comparison">
                <div class="ratio-card">
                    <h5>🥇 Tỷ lệ vàng (Golden ratio)</h5>
                    <div class="value">φ ≈ 1.618</div>
                    <p>$(1+\sqrt{5})/2$</p>
                </div>
                <div class="ratio-card">
                    <h5>🥈 Tỷ lệ bạc (Silver ratio)</h5>
                    <div class="value">δ ≈ 2.414</div>
                    <p>$1+\sqrt{2}$</p>
                </div>
                <div class="ratio-card">
                    <h5>🥉 Tỷ lệ đồng (Bronze ratio)</h5>
                    <div class="value">σ ≈ 3.303</div>
                    <p>$(3+\sqrt{13})/2$</p>
                </div>
                <div class="ratio-card">
                    <h5>🟣 Số dẻo (Plastic number)</h5>
                    <div class="value">ρ ≈ 1.324</div>
                    <p>Nghiệm thực của phương trình $x^3=x+1$</p>
                </div>
                <div class="ratio-card">
                    <h5>🔺 Tribonacci</h5>
                    <div class="value">T ≈ 1.839</div>
                    <p>$x^3 = x^2 + x + 1$</p>
                </div>
                <div class="ratio-card">
                    <h5>⭐ Siêu vàng (Supergolden)</h5>
                    <div class="value">ψ ≈ 1.465</div>
                    <p>$x^2 = x^2 - x + 1$</p>
                </div>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>🔬 So sánh trung bình kim loại</h3>
                    <div class="input-group">
                        <label>Chọn tỷ lệ để phân tích:</label>
                        <select id="ratioType">
                            <option value="golden">Tỷ lệ vàng (φ)</option>
                            <option value="silver">Tỷ lệ bạc (δ)</option>
                            <option value="bronze">Tỷ lệ đồng (σ)</option>
                            <option value="plastic">Số dẻo (ρ)</option>
                            <option value="tribonacci">Tribonacci (T)</option>
                            <option value="supergolden">Siêu vàng (ψ)</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Giá trị để kiểm tra:</label>
                        <input type="number" id="testValue" placeholder="100" step="0.001">
                    </div>
                    <button class="btn" onclick="analyzeRatio()">Phân tích</button>
                    <button class="btn btn-secondary" onclick="compareRatios()">So sánh tất cả</button>
                    <div class="result-box" id="ratioAnalysis">Chọn tỷ lệ và nhập giá trị để phân tích...</div>
                </div>

                <div class="card">
                    <h3>📊 Phân số liên tục</h3>
                    <div class="input-group">
                        <label>Số lần lặp (iterations):</label>
                        <input type="number" id="cfIterations" value="10" min="3" max="20">
                    </div>
                    <button class="btn" onclick="generateContinuedFraction()">Phân số vàng</button>
                    <button class="btn btn-info" onclick="generateSilverCF()">Phân số bạc</button>
                    <div class="result-box" id="cfResult">Tỷ lệ vàng (Golden ratio) = [1; 1, 1, 1, 1, ...]</div>
                </div>

                <div class="card">
                    <h3>🔀 Quan hệ đệ quy</h3>
                    <div class="input-group">
                        <label>Loại dãy số:</label>
                        <select id="sequenceType">
                            <option value="fibonacci">Fibonacci (a,b,a+b)</option>
                            <option value="lucas">Lucas (2,1,3,4,7...)</option>
                            <option value="pell">Pell (0,1,2,5,12...)</option>
                            <option value="tribonacci">Tribonacci (a,b,c,a+b+c)</option>
                        </select>
                    </div>
                    <button class="btn" onclick="generateSequence()">Sinh dãy</button>
                    <button class="btn btn-secondary" onclick="analyzeRatios()">Phân tích tỷ lệ</button>
                    <div class="result-box" id="sequenceResult">Chọn loại dãy số để sinh...</div>
                </div>
            </div>
        </div>

        <!-- Tab Kiến trúc -->
        <div id="architecture" class="tab-content">
            <div class="info-panel">
                <h4>🏛️ Tỷ lệ vàng trong kiến trúc</h4>
                <p>Từ đền Parthenon cổ đại đến kiến trúc hiện đại, tỷ lệ vàng tạo nên sự hài hòa và cân bằng thị giác.</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>🏢 Tỷ lệ mặt tiền</h3>
                    <div class="preset-buttons">
                        <button class="preset-btn" onclick="setArchPreset('classical')">Cổ điển</button>
                        <button class="preset-btn" onclick="setArchPreset('modern')">Hiện đại</button>
                        <button class="preset-btn" onclick="setArchPreset('gothic')">Gothic</button>
                    </div>
                    <div class="input-group">
                        <label>Chiều cao tòa nhà (m):</label>
                        <input type="number" id="buildingHeight" placeholder="20" step="0.1">
                    </div>
                    <div class="input-group">
                        <label>Chiều rộng mặt tiền (m):</label>
                        <input type="number" id="buildingWidth" placeholder="12.36" step="0.1">
                    </div>
                    <button class="btn" onclick="calculateFacade()">Phân tích mặt tiền</button>
                    <div class="result-box" id="facadeResult"></div>
                </div>

                <div class="card">
                    <h3>🚪 Cửa và cửa sổ</h3>
                    <div class="input-group">
                        <label>Loại:</label>
                        <select id="openingType">
                            <option value="door">Cửa chính</option>
                            <option value="window">Cửa sổ</option>
                            <option value="french_door">Cửa Pháp</option>
                            <option value="bay_window">Cửa sổ lồi</option>
                        </select>
                    </div>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Chiều cao (m):</label>
                            <input type="number" id="openingHeight" placeholder="2.1" step="0.01">
                        </div>
                        <div class="input-group">
                            <label>Chiều rộng (m):</label>
                            <input type="number" id="openingWidth" placeholder="1.3" step="0.01">
                        </div>
                    </div>
                    <button class="btn" onclick="calculateOpening()">Tính toán cửa</button>
                    <div class="result-box" id="openingResult"></div>
                </div>

                <div class="card">
                    <h3>📏 Tỷ lệ cột</h3>
                    <div class="input-group">
                        <label>Kiểu cột:</label>
                        <select id="columnStyle">
                            <option value="doric">Doric</option>
                            <option value="ionic">Ionic</option>
                            <option value="corinthian">Corinthian</option>
                            <option value="modern">Hiện đại</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Chiều cao cột (m):</label>
                        <input type="number" id="columnHeight" placeholder="5" step="0.1">
                    </div>
                    <button class="btn" onclick="calculateColumn()">Phân tích cột</button>
                    <div class="result-box" id="columnResult"></div>
                </div>

                <div class="card">
                    <h3>🏠 Tỷ lệ phòng</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Chiều dài (m):</label>
                            <input type="number" id="roomLength" placeholder="5" step="0.1">
                        </div>
                        <div class="input-group">
                            <label>Chiều rộng (m):</label>
                            <input type="number" id="roomWidth" placeholder="3.09" step="0.1">
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Chiều cao trần (m):</label>
                        <input type="number" id="roomCeiling" placeholder="2.7" step="0.1">
                    </div>
                    <button class="btn" onclick="calculateRoom()">Phân tích phòng</button>
                    <div class="result-box" id="roomResult"></div>
                </div>
            </div>
        </div>

        <!-- Tab Xây dựng -->
        <div id="construction" class="tab-content">
            <div class="info-panel">
                <h4>🏗️ Ứng dụng trong xây dựng</h4>
                <p>Tỷ lệ vàng giúp tối ưu hóa kết cấu, thẩm mỹ và công năng trong xây dựng.</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>🧱 Kết cấu và dầm</h3>
                    <div class="input-group">
                        <label>Nhịp dầm (m):</label>
                        <input type="number" id="beamSpan" placeholder="8" step="0.1">
                    </div>
                    <div class="input-group">
                        <label>Tải trọng (kN/m):</label>
                        <input type="number" id="beamLoad" placeholder="10" step="0.1">
                    </div>
                    <button class="btn" onclick="calculateBeam()">Tính dầm</button>
                    <div class="result-box" id="beamResult"></div>
                </div>

                <div class="card">
                    <h3>🏘️ Quy hoạch khu đô thị</h3>
                    <div class="input-group">
                        <label>Diện tích tổng (ha):</label>
                        <input type="number" id="totalArea" placeholder="100" step="0.1">
                    </div>
                    <button class="btn" onclick="calculateUrbanPlanning()">Quy hoạch</button>
                    <div class="proportion-grid" id="urbanResult">
                        <div class="proportion-item">Khu dân cư: <strong>61.8%</strong></div>
                        <div class="proportion-item">Công viên: <strong>23.6%</strong></div>
                        <div class="proportion-item">Thương mại: <strong>9.0%</strong></div>
                        <div class="proportion-item">Hạ tầng: <strong>5.6%</strong></div>
                    </div>
                </div>

                <div class="card">
                    <h3>🪜 Thang và bậc</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Chiều cao bậc (cm):</label>
                            <input type="number" id="stepHeight" placeholder="18" step="0.5">
                        </div>
                        <div class="input-group">
                            <label>Chiều sâu bậc (cm):</label>
                            <input type="number" id="stepDepth" placeholder="29" step="0.5">
                        </div>
                    </div>
                    <button class="btn" onclick="calculateStairs()">Phân tích thang</button>
                    <div class="result-box" id="stairResult"></div>
                </div>

                <div class="card">
                    <h3>🔧 Công cụ đo đạc</h3>
                    <div class="input-group">
                        <label>Đơn vị:</label>
                        <select id="unitType">
                            <option value="metric">Mét (m, cm, mm)</option>
                            <option value="imperial">Inch (ft, in)</option>
                            <option value="mixed">Hỗn hợp</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Giá trị cần chuyển đổi:</label>
                        <input type="number" id="convertValue" placeholder="100" step="0.01">
                    </div>
                    <button class="btn" onclick="convertUnits()">Chuyển đổi</button>
                    <div class="result-box" id="convertResult"></div>
                </div>
            </div>
        </div>

        <!-- Tab Điêu khắc -->
        <div id="sculpture" class="tab-content">
            <div class="info-panel">
                <h4>🎨 Tỷ lệ trong điêu khắc</h4>
                <p>Từ tượng David của Michelangelo đến các tác phẩm hiện đại, tỷ lệ vàng tạo nên vẻ đẹp hoàn hảo.</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>👤 Tỷ lệ cơ thể người</h3>
                    <div class="input-group">
                        <label>Chiều cao tổng (cm):</label>
                        <input type="number" id="bodyHeight" placeholder="170" step="0.5">
                    </div>
                    <button class="btn" onclick="calculateBodyProportions()">Tính tỷ lệ cơ thể</button>
                    <div class="result-box" id="bodyResult"></div>
                    <div class="canvas-container">
                        <canvas id="bodyCanvas" width="200" height="400"></canvas>
                    </div>
                </div>

                <div class="card">
                    <h3>🗿 Tỷ lệ khuôn mặt</h3>
                    <div class="input-group">
                        <label>Chiều dài khuôn mặt (cm):</label>
                        <input type="number" id="faceLength" placeholder="18" step="0.1">
                    </div>
                    <button class="btn" onclick="calculateFaceProportions()">Phân tích mặt</button>
                    <div class="result-box" id="faceResult"></div>
                </div>

                <div class="card">
                    <h3>🏺 Tỷ lệ 3D</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Chiều cao (cm):</label>
                            <input type="number" id="sculptHeight" placeholder="50" step="0.1">
                        </div>
                        <div class="input-group">
                            <label>Chiều rộng (cm):</label>
                            <input type="number" id="sculptWidth" placeholder="30.9" step="0.1">
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Chiều sâu (cm):</label>
                        <input type="number" id="sculptDepth" placeholder="19.1" step="0.1">
                    </div>
                    <button class="btn" onclick="calculate3DProportion()">Phân tích 3D</button>
                    <div class="result-box" id="sculptResult"></div>
                </div>

                <div class="card">
                    <h3>🎭 Các kiểu điêu khắc</h3>
                    <div class="preset-buttons">
                        <button class="preset-btn" onclick="setSculpturePreset('classical')">Cổ điển</button>
                        <button class="preset-btn" onclick="setSculpturePreset('modern')">Hiện đại</button>
                        <button class="preset-btn" onclick="setSculpturePreset('abstract')">Trừu tượng</button>
                        <button class="preset-btn" onclick="setSculpturePreset('realistic')">Hiện thực</button>
                    </div>
                    <div class="result-box" id="sculpturePresetResult">Chọn kiểu điêu khắc để xem thông tin...</div>
                </div>
            </div>
        </div>

        <!-- Tab Nghệ thuật -->
        <div id="art" class="tab-content">
            <div class="info-panel">
                <h4>🖼️ Tỷ lệ vàng trong nghệ thuật</h4>
                <p>Bố cục (Composition), tỷ lệ khung hình (frame ratios), và các phần vàng (golden sections) trong hội họa và nhiếp ảnh.</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>🖼️ Tỷ lệ khung hình</h3>
                    <div class="preset-buttons">
                        <button class="preset-btn" onclick="setFramePreset('golden')">Golden</button>
                        <button class="preset-btn" onclick="setFramePreset('4x3')">4:3</button>
                        <button class="preset-btn" onclick="setFramePreset('16x9')">16:9</button>
                        <button class="preset-btn" onclick="setFramePreset('square')">1:1</button>
                    </div>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Chiều rộng (cm):</label>
                            <input type="number" id="frameWidth" placeholder="40" step="0.1">
                        </div>
                        <div class="input-group">
                            <label>Chiều cao (cm):</label>
                            <input type="number" id="frameHeight" placeholder="24.7" step="0.1">
                        </div>
                    </div>
                    <button class="btn" onclick="calculateFrame()">Phân tích khung</button>
                    <div class="result-box" id="frameResult"></div>
                </div>

                <div class="card">
                    <h3>📐 Điểm bố cục (Composition)</h3>
                    <div class="input-group">
                        <label>Kích thước canvas:</label>
                        <select id="canvasSize">
                            <option value="small">Nhỏ (20x30cm)</option>
                            <option value="medium">Trung (40x60cm)</option>
                            <option value="large">Lớn (60x90cm)</option>
                            <option value="custom">Tùy chỉnh</option>
                        </select>
                    </div>
                    <button class="btn" onclick="generateComposition()">Tạo bố cục</button>
                    <div class="canvas-container">
                        <canvas id="compositionCanvas" width="300" height="200"></canvas>
                    </div>
                </div>

                <div class="card">
                    <h3>🎨 Bảng màu vàng</h3>
                    <div class="input-group">
                        <label>Màu chủ đạo:</label>
                        <input type="color" id="primaryColor" value="#FFD700" class="color-input" style="width: 100%;">
                    </div>
                    <button class="btn" onclick="generateGoldenPalette()">Tạo bảng màu</button>
                    <div class="result-box" id="paletteResult"></div>
                </div>

                <div class="card">
                    <h3>📷 Quy tắc 1/3 và tỷ lệ vàng</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Tỷ lệ ảnh:</label>
                            <select id="photoRatio">
                                <option value="golden">Tỷ lệ vàng (Golden ratio)</option>
                                <option value="thirds">Quy tắc 1/3 (Rule of thirds)</option>
                                <option value="both">Cả hai</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Kích thước:</label>
                            <input type="number" id="photoSize" value="300" min="200" max="500">
                        </div>
                    </div>
                    <button class="btn" onclick="drawPhotoGuides()">Vẽ hướng dẫn</button>
                    <div class="canvas-container">
                        <canvas id="photoCanvas" width="300" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Tự nhiên -->
        <div id="nature" class="tab-content">
            <div class="info-panel">
                <h4>🌿 Tỷ lệ vàng trong tự nhiên</h4>
                <p>Khám phá dãy Fibonacci và tỷ lệ vàng trong hoa, lá, vỏ ốc và cấu trúc tự nhiên.</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>🌻 Bố trí lá (Phyllotaxis)</h3>
                    <div class="input-group">
                        <label>Số lượng lá/hoa:</label>
                        <input type="number" id="leafCount" value="21" min="5" max="100">
                    </div>
                    <div class="input-group">
                        <label>Góc vàng (°):</label>
                        <input type="number" id="goldenAngle" value="137.5" step="0.1" readonly>
                    </div>
                    <button class="btn" onclick="drawPhyllotaxis()">Vẽ bố trí</button>
                    <div class="canvas-container">
                        <canvas id="phyllotaxisCanvas" width="300" height="300"></canvas>
                    </div>
                </div>

                <div class="card">
                    <h3>🐚 Xoắn ốc nautilus</h3>
                    <div class="input-group">
                        <label>Số vòng xoắn:</label>
                        <input type="number" id="nautilusSpirals" value="5" min="2" max="10">
                    </div>
                    <button class="btn" onclick="drawNautilus()">Vẽ nautilus</button>
                    <div class="canvas-container">
                        <canvas id="nautilusCanvas" width="300" height="300"></canvas>
                    </div>
                </div>

                <div class="card">
                    <h3>🌲 Cấu trúc cây</h3>
                    <div class="input-group">
                        <label>Độ cao cây (m):</label>
                        <input type="number" id="treeHeight" placeholder="10" step="0.1">
                    </div>
                    <button class="btn" onclick="calculateTreeStructure()">Phân tích cây</button>
                    <div class="result-box" id="treeResult"></div>
                </div>

                <div class="card">
                    <h3>🦋 Hình dạng côn trùng</h3>
                    <div class="input-group">
                        <label>Loại côn trùng:</label>
                        <select id="insectType">
                            <option value="butterfly">Bướm</option>
                            <option value="bee">Ong</option>
                            <option value="dragonfly">Chuồn chuồn</option>
                            <option value="beetle">Bọ cánh cứng</option>
                        </select>
                    </div>
                    <button class="btn" onclick="analyzeInsectProportions()">Phân tích</button>
                    <div class="result-box" id="insectResult"></div>
                </div>
            </div>
        </div>

        <!-- Tab Tài chính -->
        <div id="finance" class="tab-content">
            <div class="info-panel">
                <h4>💰 Fibonacci trong tài chính</h4>
                <p>Hồi quy Fibonacci (Fibonacci retracement), mở rộng (extensions) và các công cụ phân tích kỹ thuật.</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>📈 Hồi quy Fibonacci</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Giá cao nhất:</label>
                            <input type="number" id="priceHigh" placeholder="100" step="0.01">
                        </div>
                        <div class="input-group">
                            <label>Giá thấp nhất:</label>
                            <input type="number" id="priceLow" placeholder="60" step="0.01">
                        </div>
                    </div>
                    <button class="btn" onclick="calculateFibRetracement()">Tính hồi quy</button>
                    <div class="result-box" id="retracementResult"></div>
                </div>

                <div class="card">
                    <h3>📊 Mở rộng Fibonacci</h3>
                    <div class="input-group">
                        <label>Điểm A (cao):</label>
                        <input type="number" id="pointA" placeholder="100" step="0.01">
                    </div>
                    <div class="input-group">
                        <label>Điểm B (thấp):</label>
                        <input type="number" id="pointB" placeholder="80" step="0.01">
                    </div>
                    <div class="input-group">
                        <label>Điểm C (phục hồi):</label>
                        <input type="number" id="pointC" placeholder="90" step="0.01">
                    </div>
                    <button class="btn" onclick="calculateFibExtension()">Tính mở rộng</button>
                    <div class="result-box" id="extensionResult"></div>
                </div>

                <div class="card">
                    <h3>💹 Phân tích xu hướng</h3>
                    <div class="input-group">
                        <label>Loại thị trường:</label>
                        <select id="marketType">
                            <option value="stock">Chứng khoán</option>
                            <option value="forex">Forex</option>
                            <option value="crypto">Tiền điện tử (Cryptocurrency)</option>
                            <option value="commodity">Hàng hóa</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Khung thời gian:</label>
                        <select id="timeFrame">
                            <option value="1m">1 phút</option>
                            <option value="5m">5 phút</option>
                            <option value="1h">1 giờ</option>
                            <option value="1d">1 ngày</option>
                            <option value="1w">1 tuần</option>
                        </select>
                    </div>
                    <button class="btn" onclick="analyzeTrend()">Phân tích</button>
                    <div class="result-box" id="trendResult"></div>
                </div>

                <div class="card">
                    <h3>🎯 Mục tiêu giá</h3>
                    <div class="input-group">
                        <label>Giá hiện tại:</label>
                        <input type="number" id="currentPrice" placeholder="75" step="0.01">
                    </div>
                    <div class="input-group">
                        <label>Hướng dự đoán:</label>
                        <select id="priceDirection">
                            <option value="up">Tăng</option>
                            <option value="down">Giảm</option>
                        </select>
                    </div>
                    <button class="btn" onclick="calculatePriceTargets()">Tính mục tiêu</button>
                    <div class="result-box" id="targetResult"></div>
                </div>
            </div>
        </div>

        <!-- Tab Y học -->
        <div id="medicine" class="tab-content">
            <div class="info-panel">
                <h4>   Tỷ lệ vàng trong y học và sinh học</h4>
                <p>Từ cấu trúc DNA, nhịp tim, tỷ lệ cơ thể đến phân bố neuron trong não...</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>🧬 Cấu trúc DNA</h3>
                    <div class="input-group">
                        <label>Chiều dài xoắn (Å):</label>
                        <input type="number" id="dnaLength" value="34" step="0.1">
                    </div>
                    <div class="input-group">
                        <label>Đường kính (Å):</label>
                        <input type="number" id="dnaDiameter" value="21" step="0.1">
                    </div>
                    <button class="btn" onclick="analyzeDNA()">Phân tích DNA</button>
                    <div class="result-box" id="dnaResult">
                        Xoắn kép DNA (DNA double helix): 34Å/21Å ≈ 1.619 ≈ φ
                    </div>
                </div>

                <div class="card">
                    <h3>💓 Nhịp tim và huyết áp</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Tâm thu (mmHg):</label>
                            <input type="number" id="systolic" placeholder="120">
                        </div>
                        <div class="input-group">
                            <label>Tâm trương (mmHg):</label>
                            <input type="number" id="diastolic" placeholder="80">
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Nhịp tim (BPM):</label>
                        <input type="number" id="heartRate" placeholder="72">
                    </div>
                    <button class="btn" onclick="analyzeCardiovascular()">Phân tích tim mạch</button>
                    <div class="result-box" id="cardioResult">Nhập các chỉ số để phân tích...</div>
                </div>

                <div class="card">
                    <h3>👁️ Tỷ lệ mắt và thị lực</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Khoảng cách mắt (cm):</label>
                            <input type="number" id="eyeDistance" placeholder="6.3" step="0.1">
                        </div>
                        <div class="input-group">
                            <label>Độ rộng mắt (cm):</label>
                            <input type="number" id="eyeWidth" placeholder="3.9" step="0.1">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeEyeProportions()">Phân tích mắt</button>
                    <div class="result-box" id="eyeResult">Tỷ lệ vàng trong cấu trúc mắt...</div>
                </div>

                <div class="card">
                    <h3>🧠 Cấu trúc não và neuron</h3>
                    <div class="input-group">
                        <label>Số neuron (tỷ):</label>
                        <input type="number" id="neuronCount" value="86" step="0.1">
                    </div>
                    <button class="btn" onclick="analyzeBrainStructure()">Phân tích não</button>
                    <div class="result-box" id="brainResult">
                        Phân bố neuron trong não theo tỷ lệ φ...
                    </div>
                </div>

                <div class="card">
                    <h3>🦷 Tỷ lệ răng</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Răng cửa trung tâm (mm):</label>
                            <input type="number" id="centralIncisor" placeholder="10.5">
                        </div>
                        <div class="input-group">
                            <label>Răng cửa bên (mm):</label>
                            <input type="number" id="lateralIncisor" placeholder="6.5">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeDentalProportions()">Phân tích răng</button>
                    <div class="result-box" id="dentalResult">Tỷ lệ răng cửa theo φ...</div>
                </div>
            </div>
        </div>

        <!-- Tab Vật lý -->
        <div id="physics" class="tab-content">
            <div class="info-panel">
                <h4>⚛️ Tỷ lệ vàng trong vật lý</h4>
                <p>Xuất hiện trong sóng, dao động, cấu trúc nguyên tử, quasicrystals và nhiều hiện tượng vật lý khác.</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>🌊 Sóng và dao động</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Tần số f1 (Hz):</label>
                            <input type="number" id="freq1" placeholder="440" step="0.1">
                        </div>
                        <div class="input-group">
                            <label>Tần số f2 (Hz):</label>
                            <input type="number" id="freq2" placeholder="712" step="0.1">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeWaveRatios()">Phân tích sóng</button>
                    <button class="btn btn-info" onclick="generateHarmonics()">Sóng hài φ</button>
                    <div class="result-box" id="waveResult">Tỷ lệ tần số và tỷ lệ vàng...</div>
                </div>

                <div class="card">
                    <h3>💎 Tinh thể gần (Quasicrystals)</h3>
                    <div class="input-group">
                        <label>Mẫu xếp hình Penrose:</label>
                        <select id="penroseType">
                            <option value="p2">P2 (diều và phi tiêu)</option>
                            <option value="p3">P3 (hình thoi)</option>
                            <option value="p1">P1 (hình thập giác)</option>
                        </select>
                    </div>
                    <button class="btn" onclick="generatePenrose()">Tạo mẫu</button>
                    <button class="btn btn-secondary" onclick="analyzeQuasicrystal()">Phân tích φ</button>
                    <div class="canvas-container">
                        <canvas id="quasiCanvas" width="300" height="300"></canvas>
                    </div>
                    <div class="result-box" id="quasiResult">Mẫu xếp hình Penrose chứa tỷ lệ φ...</div>
                </div>

                <div class="card">
                    <h3>⚛️ Cấu trúc nguyên tử</h3>
                    <div class="input-group">
                        <label>Nguyên tố:</label>
                        <select id="element">
                            <option value="carbon">Carbon (C)</option>
                            <option value="silicon">Silicon (Si)</option>
                            <option value="gold">Vàng (Au)</option>
                            <option value="copper">Đồng (Cu)</option>
                        </select>
                    </div>
                    <button class="btn" onclick="analyzeAtomicStructure()">Phân tích nguyên tử</button>
                    <div class="result-box" id="atomResult">Tỷ lệ φ trong cấu trúc electron...</div>
                </div>

                <div class="card">
                    <h3>🔬 Cấu trúc nano</h3>
                    <div class="input-group">
                        <label>Kích thước nano (nm):</label>
                        <input type="number" id="nanoSize" placeholder="1.618" step="0.001">
                    </div>
                    <button class="btn" onclick="analyzeNanoStructure()">Phân tích nano</button>
                    <div class="result-box" id="nanoResult">Tỷ lệ vàng (Golden ratio) trong cấu trúc nano...</div>
                </div>
            </div>
        </div>

        <!-- Tab Âm nhạc -->
        <div id="music" class="tab-content">
            <div class="info-panel">
                <h4>🎵 Tỷ lệ vàng trong âm nhạc</h4>
                <p>Tỷ lệ vàng xuất hiện trong sự hài hòa (harmony), nhịp điệu (rhythm), cấu trúc hình thức (form structure) và các thuộc tính âm thanh (acoustic properties).</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>🎼 Tỷ lệ hài hòa</h3>
                    <div class="input-group">
                        <label>Nốt cơ bản (Hz):</label>
                        <input type="number" id="baseNote" value="440" step="0.1">
                    </div>
                    <button class="btn" onclick="generateGoldenHarmony()">Hòa âm vàng</button>
                    <button class="btn btn-info" onclick="generateFibonacciScale()">Thang âm Fibonacci</button>
                    <div class="result-box" id="harmonyResult">
                        A4 = 440Hz → Khoảng 5 vàng (Golden fifth) ≈ 712Hz
                    </div>
                </div>

                <div class="card">
                    <h3>🥁 Mẫu nhịp điệu</h3>
                    <div class="input-group">
                        <label>BPM:</label>
                        <input type="number" id="bpm" value="120" min="60" max="200">
                    </div>
                    <div class="input-group">
                        <label>Độ dài mẫu:</label>
                        <select id="patternLength">
                            <option value="8">8 nhịp</option>
                            <option value="13">13 nhịp (fib)</option>
                            <option value="21">21 nhịp (fib)</option>
                        </select>
                    </div>
                    <button class="btn" onclick="generateRhythm()">Tạo nhịp điệu φ</button>
                    <div class="result-box" id="rhythmResult">Các mẫu nhịp điệu tỷ lệ vàng (Golden ratio rhythm patterns)...</div>
                </div>

                <div class="card">
                    <h3>🎹 Phân tích thang âm</h3>
                    <div class="input-group">
                        <label>Loại thang âm:</label>
                        <select id="scaleType">
                            <option value="major">Trưởng (Major scale)</option>
                            <option value="minor">Thứ (Minor scale)</option>
                            <option value="pentatonic">Ngũ cung (Pentatonic)</option>
                            <option value="golden">Thang âm vàng (Golden scale)</option>
                        </select>
                    </div>
                    <button class="btn" onclick="analyzeScale()">Phân tích thang âm</button>
                    <div class="result-box" id="scaleResult">Tỷ lệ quãng (Interval ratios) trong các thang âm...</div>
                </div>

                <div class="card">
                    <h3>🎧 Thuộc tính âm học</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Chiều dài phòng (m):</label>
                            <input type="number" id="roomLength" placeholder="10" step="0.1">
                        </div>
                        <div class="input-group">
                            <label>Chiều rộng phòng (m):</label>
                            <input type="number" id="roomWidth" placeholder="6.18" step="0.1">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeAcoustics()">Phân tích âm học</button>
                    <div class="result-box" id="acousticResult">Tỷ lệ phòng vàng (Golden room ratios) cho âm thanh tối ưu...</div>
                </div>
            </div>
        </div>

        <!-- Tab Tâm lý -->
        <div id="psychology" class="tab-content">
            <div class="info-panel">
                <h4>🧠 Tỷ lệ vàng trong tâm lý học</h4>
                <p>Sự cảm nhận (Perception), thẩm mỹ (aesthetics), xử lý nhận thức (cognitive processing) và sở thích thị giác (visual preferences).</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>👁️ Nhận thức thị giác</h3>
                    <div class="input-group">
                        <label>Loại kiểm tra:</label>
                        <select id="perceptionTest">
                            <option value="rectangle">Sở thích hình chữ nhật</option>
                            <option value="face">Vẻ đẹp khuôn mặt</option>
                            <option value="composition">Cân bằng bố cục</option>
                        </select>
                    </div>
                    <button class="btn" onclick="runPerceptionTest()">Chạy kiểm tra</button>
                    <div class="canvas-container">
                        <canvas id="perceptionCanvas" width="300" height="200"></canvas>
                    </div>
                    <div class="result-box" id="perceptionResult">Các bài kiểm tra nhận thức thị giác...</div>
                </div>

                <div class="card">
                    <h3>🎨 Sở thích thẩm mỹ</h3>
                    <div class="input-group">
                        <label>Tỷ lệ để kiểm tra:</label>
                        <input type="number" id="aestheticRatio" placeholder="1.618" step="0.001">
                    </div>
                    <button class="btn" onclick="analyzeAesthetics()">Phân tích thẩm mỹ</button>
                    <div class="result-box" id="aestheticResult">
                        Tỷ lệ vàng được ưu tiên trong 62% trường hợp...
                    </div>
                </div>

                <div class="card">
                    <h3>⏱️ Nhận thức thời gian</h3>
                    <div class="input-group">
                        <label>Thời gian ước tính (giây):</label>
                        <input type="number" id="timeEstimate" placeholder="10" step="0.1">
                    </div>
                    <button class="btn" onclick="analyzeTimePerception()">Phân tích thời gian</button>
                    <div class="result-box" id="timeResult">Các phần vàng (golden sections) trong nhận thức thời gian...</div>
                </div>

                <div class="card">
                    <h3>🧩 Tải trọng nhận thức</h3>
                    <div class="input-group">
                        <label>Mức độ phức tạp (1-10):</label>
                        <input type="number" id="complexity" min="1" max="10" value="5">
                    </div>
                    <button class="btn" onclick="analyzeCognitiveLoad()">Phân tích nhận thức</button>
                    <div class="result-box" id="cognitiveResult">Tỷ lệ phức tạp tối ưu...</div>
                </div>
            </div>
        </div>

        <!-- Tab Thiên văn -->
        <div id="astronomy" class="tab-content">
            <div class="info-panel">
                <h4>🌌 Tỷ lệ vàng trong thiên văn học</h4>
                <p>Từ quỹ đạo hành tinh, cấu trúc thiên hà đến thiên hà xoắn ốc (spiral galaxies) và hệ hành tinh.</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>🪐 Cộng hưởng quỹ đạo</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Chu kỳ hành tinh 1 (ngày):</label>
                            <input type="number" id="period1" placeholder="88" step="0.1">
                        </div>
                        <div class="input-group">
                            <label>Chu kỳ hành tinh 2 (ngày):</label>
                            <input type="number" id="period2" placeholder="225" step="0.1">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeOrbitalResonance()">Phân tích cộng hưởng</button>
                    <div class="result-box" id="orbitalResult">
                        Tỷ lệ chu kỳ Sao Kim/Sao Thủy ≈ 2.55 (gần $φ^2$)
                    </div>
                </div>

                <div class="card">
                    <h3>🌌 Thiên hà xoắn ốc</h3>
                    <div class="input-group">
                        <label>Số lượng cánh tay:</label>
                        <input type="number" id="spiralArms" value="2" min="1" max="8">
                    </div>
                    <button class="btn" onclick="generateGalaxySpiral()">Tạo thiên hà</button>
                    <button class="btn btn-info" onclick="analyzeGalaxyStructure()">Phân tích φ</button>
                    <div class="canvas-container">
                        <canvas id="galaxyCanvas" width="300" height="300"></canvas>
                    </div>
                    <div class="result-box" id="galaxyResult">Các cánh tay xoắn ốc tuân theo tiến trình tỷ lệ vàng...</div>
                </div>

                <div class="card">
                    <h3>🌟 Sự hình thành sao</h3>
                    <div class="input-group">
                        <label>Khối lượng sao (khối lượng mặt trời):</label>
                        <input type="number" id="stellarMass" placeholder="1.618" step="0.001">
                    </div>
                    <button class="btn" onclick="analyzeStarFormation()">Phân tích sao</button>
                    <div class="result-box" id="starResult">Tỷ lệ vàng trong sự hình thành sao...</div>
                </div>

                <div class="card">
                    <h3>🔭 Quang học kính thiên văn</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Gương chính (m):</label>
                            <input type="number" id="primaryMirror" placeholder="2.4" step="0.1">
                        </div>
                        <div class="input-group">
                            <label>Tiêu cự (m):</label>
                            <input type="number" id="focalLength" placeholder="57.6" step="0.1">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeTelescopeOptics()">Phân tích quang học</button>
                    <div class="result-box" id="opticsResult">Tỷ lệ kính thiên văn tối ưu...</div>
                </div>
            </div>
        </div>

        <!-- Tab Công nghệ -->
        <div id="technology" class="tab-content">
            <div class="info-panel">
                <h4>💻 Tỷ lệ vàng trong công nghệ</h4>
                <p>Thiết kế giao diện người dùng (UI/UX), thuật toán, tỷ lệ màn hình, thiết kế ăng-ten và tối ưu hóa.</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>📱 Tỷ lệ màn hình</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Chiều rộng (pixel):</label>
                            <input type="number" id="screenWidth" placeholder="1920" step="1">
                        </div>
                        <div class="input-group">
                            <label>Chiều cao (pixel):</label>
                            <input type="number" id="screenHeight" placeholder="1080" step="1">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeScreenRatio()">Phân tích màn hình</button>
                    <button class="btn btn-info" onclick="generateOptimalSizes()">Kích thước tối ưu</button>
                    <div class="result-box" id="screenResult">16:9 ≈ 1.78 (gần φ+0.16)...</div>
                </div>

                <div class="card">
                    <h3>🎨 Bố cục giao diện người dùng</h3>
                    <div class="input-group">
                        <label>Chiều rộng container (px):</label>
                        <input type="number" id="containerWidth" value="1200" step="1">
                    </div>
                    <button class="btn" onclick="generateUILayout()">Tạo bố cục φ</button>
                    <div class="canvas-container">
                        <canvas id="uiCanvas" width="300" height="200"></canvas>
                    </div>
                    <div class="result-box" id="uiResult">Hệ thống lưới tỷ lệ vàng...</div>
                </div>

                <div class="card">
                    <h3>📡 Thiết kế ăng-ten</h3>
                    <div class="input-group">
                        <label>Tần số hoạt động (MHz):</label>
                        <input type="number" id="antennaFreq" placeholder="2400" step="1">
                    </div>
                    <button class="btn" onclick="calculateAntennaRatios()">Tính ăng-ten</button>
                    <div class="result-box" id="antennaResult">Tỷ lệ ăng-ten vàng (Golden ratio antenna proportions)...</div>
                </div>

                <div class="card">
                    <h3>⚡ Tối ưu hóa thuật toán</h3>
                    <div class="input-group">
                        <label>Kích thước không gian tìm kiếm:</label>
                        <input type="number" id="searchSpace" placeholder="1000" step="1">
                    </div>
                    <button class="btn" onclick="analyzeGoldenSectionSearch()">Tìm kiếm phần vàng</button>
                    <div class="result-box" id="algorithmResult">Tối ưu hóa bằng cách sử dụng tỷ lệ φ...</div>
                </div>
            </div>
        </div>

        <!-- Tab Thời trang -->
        <div id="fashion" class="tab-content">
            <div class="info-panel">
                <h4>👗 Tỷ lệ vàng trong thời trang</h4>
                <p>Tỷ lệ cơ thể, thiết kế trang phục, tạo mẫu (pattern making) và thẩm mỹ thời trang (fashion aesthetics).</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>👤 Tỷ lệ cơ thể</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Chiều cao (cm):</label>
                            <input type="number" id="fashionHeight" placeholder="170" step="0.5">
                        </div>
                        <div class="input-group">
                            <label>Vị trí eo (cm từ trên xuống):</label>
                            <input type="number" id="waistPosition" placeholder="105" step="0.5">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeFashionProportions()">Phân tích tỷ lệ</button>
                    <div class="result-box" id="fashionResult">Tỷ lệ cơ thể vàng (Golden ratio body proportions)...</div>
                </div>

                <div class="card">
                    <h3>👔 Thiết kế trang phục</h3>
                    <div class="input-group">
                        <label>Loại trang phục:</label>
                        <select id="garmentType">
                            <option value="jacket">Áo khoác</option>
                            <option value="dress">Váy</option>
                            <option value="pants">Quần</option>
                            <option value="skirt">Chân váy</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Tổng chiều dài (cm):</label>
                        <input type="number" id="garmentLength" placeholder="60" step="0.5">
                    </div>
                    <button class="btn" onclick="designGarment()">Thiết kế với φ</button>
                    <div class="result-box" id="garmentResult">Tỷ lệ vàng (Golden proportions) trong thiết kế trang phục...</div>
                </div>

                <div class="card">
                    <h3>🧵 Tạo mẫu</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Vòng ngực (cm):</label>
                            <input type="number" id="bustMeasure" placeholder="88" step="0.5">
                        </div>
                        <div class="input-group">
                            <label>Vòng eo (cm):</label>
                            <input type="number" id="waistMeasure" placeholder="68" step="0.5">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzePatternRatios()">Phân tích mẫu</button>
                    <div class="result-box" id="patternResult">Tỷ lệ mẫu (Pattern proportions) theo φ...</div>
                </div>

                <div class="card">
                    <h3>👠 Thiết kế phụ kiện</h3>
                    <div class="input-group">
                        <label>Loại phụ kiện:</label>
                        <select id="accessoryType">
                            <option value="handbag">Túi xách</option>
                            <option value="shoes">Giày</option>
                            <option value="jewelry">Trang sức</option>
                            <option value="belt">Thắt lưng</option>
                        </select>
                    </div>
                    <button class="btn" onclick="designAccessory()">Thiết kế phụ kiện</button>
                    <div class="result-box" id="accessoryResult">Thiết kế phụ kiện tỷ lệ vàng...</div>
                </div>
            </div>
        </div>

        <!-- Tab Ẩm thực -->
        <div id="culinary" class="tab-content">
            <div class="info-panel">
                <h4>🍽️ Tỷ lệ vàng trong ẩm thực</h4>
                <p>Bố cục món ăn (Plating), cân bằng hương vị (flavor balance), tỷ lệ nấu ăn (cooking ratios) và thẩm mỹ trình bày món ăn (food presentation aesthetics).</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>🍽️ Bố cục đĩa</h3>
                    <div class="input-group">
                        <label>Đường kính đĩa (cm):</label>
                        <input type="number" id="plateDiameter" value="27" step="0.5">
                    </div>
                    <button class="btn" onclick="designPlateLayout()">Thiết kế bố cục</button>
                    <div class="canvas-container">
                        <canvas id="plateCanvas" width="270" height="270"></canvas>
                    </div>
                    <div class="result-box" id="plateResult">Cách đặt thức ăn theo tỷ lệ vàng để hấp dẫn thị giác...</div>
                </div>

                <div class="card">
                    <h3>🥗 Cân bằng hương vị</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Ngọt (%):</label>
                            <input type="number" id="sweetPercent" placeholder="38.2" min="0" max="100" step="0.1">
                        </div>
                        <div class="input-group">
                            <label>Mặn (%):</label>
                            <input type="number" id="saltyPercent" placeholder="23.6" min="0" max="100" step="0.1">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Chua (%):</label>
                            <input type="number" id="sourPercent" placeholder="23.6" min="0" max="100" step="0.1">
                        </div>
                        <div class="input-group">
                            <label>Đắng (%):</label>
                            <input type="number" id="bitterPercent" placeholder="14.6" min="0" max="100" step="0.1">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeFlavorBalance()">Phân tích hương vị</button>
                    <div class="result-box" id="flavorResult">Hương vị hài hòa theo φ...</div>
                </div>

                <div class="card">
                    <h3>🍰 Tỷ lệ công thức</h3>
                    <div class="input-group">
                        <label>Loại công thức:</label>
                        <select id="recipeType">
                            <option value="bread">Bánh mì</option>
                            <option value="cake">Bánh ngọt</option>
                            <option value="sauce">Nước sốt</option>
                            <option value="cocktail">Cocktail</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Số lượng cơ bản:</label>
                        <input type="number" id="baseQuantity" placeholder="100" step="1">
                    </div>
                    <button class="btn" onclick="generateGoldenRecipe()">Công thức vàng</button>
                    <div class="result-box" id="recipeResult">Tỷ lệ công thức theo φ...</div>
                </div>

                <div class="card">
                    <h3>🍷 Rượu vang và cocktail</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Rượu nền (ml):</label>
                            <input type="number" id="baseSpirit" placeholder="60" step="5">
                        </div>
                        <div class="input-group">
                            <label>Nước pha (ml):</label>
                            <input type="number" id="mixer" placeholder="37" step="5">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeCocktailRatio()">Phân tích cocktail</button>
                    <div class="result-box" id="cocktailResult">Tỷ lệ pha cocktail hoàn hảo...</div>
                </div>
            </div>
        </div>

        <!-- Tab Thể thao -->
        <div id="sports" class="tab-content">
            <div class="info-panel">
                <h4>⚽ Tỷ lệ vàng trong thể thao</h4>
                <p>Thiết kế dụng cụ (Equipment design), tối ưu hóa kỹ thuật, tỷ lệ tập luyện và các chỉ số hiệu suất.</p>
            </div>

            <div class="tools-grid">
                <div class="card">
                    <h3>🏃‍♂️ Kỹ thuật chạy</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Chiều dài sải chân (cm):</label>
                            <input type="number" id="strideLength" placeholder="150" step="1">
                        </div>
                        <div class="input-group">
                            <label>Tần suất bước (steps/phút):</label>
                            <input type="number" id="stepRate" placeholder="180" step="1">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeRunningTechnique()">Phân tích chạy</button>
                    <div class="result-box" id="runningResult">Tỷ lệ chạy tối ưu...</div>
                </div>

                <div class="card">
                    <h3>🏐 Thiết kế bóng và sân đấu</h3>
                    <div class="input-group">
                        <label>Loại hình thể thao:</label>
                        <select id="sportType">
                            <option value="tennis">Quần vợt</option>
                            <option value="basketball">Bóng rổ</option>
                            <option value="soccer">Bóng đá</option>
                            <option value="volleyball">Bóng chuyền</option>
                        </select>
                    </div>
                    <button class="btn" onclick="analyzeSportGeometry()">Phân tích hình học</button>
                    <div class="result-box" id="sportGeometryResult">Tỷ lệ sân thể thao...</div>
                </div>

                <div class="card">
                    <h3>🏋️‍♂️ Tỷ lệ tập luyện</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Thời gian làm việc (phút):</label>
                            <input type="number" id="workTime" placeholder="25" step="1">
                        </div>
                        <div class="input-group">
                            <label>Thời gian nghỉ (phút):</label>
                            <input type="number" id="restTime" placeholder="15" step="1">
                        </div>
                    </div>
                    <button class="btn" onclick="analyzeTrainingRatio()">Phân tích tập luyện</button>
                    <div class="result-box" id="trainingResult">Tỷ lệ làm việc:nghỉ ngơi tối ưu...</div>
                </div>

                <div class="card">
                    <h3>🚴‍♂️ Thiết kế dụng cụ</h3>
                    <div class="input-group">
                        <label>Loại dụng cụ:</label>
                        <select id="equipmentType">
                            <option value="bicycle">Xe đạp</option>
                            <option value="racket">Vợt</option>
                            <option value="club">Gậy golf</option>
                            <option value="bat">Gậy bóng chày</option>
                        </select>
                    </div>
                    <button class="btn" onclick="analyzeEquipmentDesign()">Phân tích thiết kế</button>
                    <div class="result-box" id="equipmentResult">Tỷ lệ dụng cụ theo φ...</div>
                </div>
            </div>
        </div>

        <!-- Tab Máy tính -->
        <div id="calculator" class="tab-content">
            <div class="tools-grid">
                <div class="card">
                    <h3>🧮 Máy tính nâng cao</h3>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Tìm số Fibonacci thứ n:</label>
                            <input type="number" id="fibPosition" placeholder="20" min="1" max="100">
                        </div>
                        <div class="input-group">
                            <label>Kiểm tra số Fibonacci:</label>
                            <input type="number" id="checkFibNumber" placeholder="1597">
                        </div>
                    </div>
                    <button class="btn" onclick="findFibonacciAtPosition()">Tìm</button>
                    <button class="btn" onclick="checkIfFibonacci()">Kiểm tra</button>
                    <div class="result-box" id="advancedCalcResult"></div>
                </div>

                <div class="card">
                    <h3>🔢 Tính toán tỷ lệ vàng</h3>
                    <div class="input-group">
                        <label>Độ chính xác (số chữ số):</label>
                        <input type="number" id="precision" value="15" min="5" max="50">
                    </div>
                    <button class="btn" onclick="calculatePreciseGoldenRatio()">Tính chính xác</button>
                    <div class="result-box" id="preciseResult"></div>
                </div>

                <div class="card full-width">
                    <h3>📋 Bảng tra cứu nhanh</h3>
                    <div class="proportion-grid">
                        <div class="proportion-item">φ = 1.618033988749...</div>
                        <div class="proportion-item">1/φ = 0.618033988749...</div>
                        <div class="proportion-item">$φ^2$ = 2.618033988749...</div>
                        <div class="proportion-item">$φ^3$ = 4.236067977499...</div>
                        <div class="proportion-item">$\sqrt{φ}$ = 1.272019649514...</div>
                        <div class="proportion-item">φ - 1 = 0.618033988749...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const GOLDEN_RATIO = 1.6180339887498948;
        const SILVER_RATIO = 1 + Math.sqrt(2);
        const BRONZE_RATIO = (3 + Math.sqrt(13)) / 2;
        const PLASTIC_NUMBER = 1.3247179572447;
        const TRIBONACCI_CONSTANT = 1.8392867552141;
        const SUPERGOLDEN_RATIO = 1.4655712318767;
        const GOLDEN_ANGLE = 137.50776405003785;
        
        let currentFibSequence = [];

        // Quản lý tab
        function switchMainTab(tabId, button) {
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.querySelectorAll('.nav-link').forEach(tab => {
                tab.classList.remove('active');
            });

            document.getElementById(tabId).classList.add('active');
            button.classList.add('active');

            // Close mobile menu after selection
            if (window.innerWidth <= 768) {
                toggleMenu();
            }
        }

        function switchTab(tabId, button) {
            document.querySelectorAll('.tab-content-secondary').forEach(content => {
                content.classList.remove('active');
            });
            document.querySelectorAll('.tab-secondary').forEach(tab => {
                tab.classList.remove('active');
            });
            
            document.getElementById(tabId).classList.add('active');
            button.classList.add('active');
        }

        // Tính toán cơ bản
        function calculateRatio() {
            const a = parseFloat(document.getElementById('lengthA').value);
            const b = parseFloat(document.getElementById('lengthB').value);
            
            if (!a || !b) {
                document.getElementById('ratioResult').innerHTML = 
                    '<span style="color: red;">Vui lòng nhập cả hai giá trị!</span>';
                return;
            }
            
            const ratio = a / b;
            const difference = Math.abs(ratio - GOLDEN_RATIO);
            const accuracy = ((1 - difference / GOLDEN_RATIO) * 100).toFixed(2);
            
            let result = `
                <strong>Kết quả tính toán:</strong><br>
                📏 Tỷ lệ a/b = ${a}/${b} = ${ratio.toFixed(6)}<br>
                🌟 Tỷ lệ vàng = ${GOLDEN_RATIO.toFixed(6)}<br>
                📊 Sai số: ${difference.toFixed(6)}<br>
                ✅ Độ chính xác: ${accuracy}%<br><br>
            `;
            
            if (accuracy > 99) {
                result += '<span style="color: green; font-weight: bold;">🎉 Hoàn hảo! Đây là tỷ lệ vàng!</span>';
            } else if (accuracy > 95) {
                result += '<span style="color: orange; font-weight: bold;">👍 Rất gần tỷ lệ vàng!</span>';
            } else {
                result += '<span style="color: blue;">💡 Gợi ý: Thử điều chỉnh để đạt tỷ lệ vàng</span>';
            }
            
            document.getElementById('ratioResult').innerHTML = result;
        }

        function findGoldenPartner() {
            const a = parseFloat(document.getElementById('lengthA').value);
            const b = parseFloat(document.getElementById('lengthB').value);
            
            if (!a && !b) {
                document.getElementById('ratioResult').innerHTML = 
                    '<span style="color: red;">Vui lòng nhập ít nhất một giá trị!</span>';
                return;
            }
            
            let result = '<strong>Tìm cặp tỷ lệ vàng:</strong><br>';
            
            if (a) {
                const goldenB = a / GOLDEN_RATIO;
                result += `📏 Nếu a = ${a}, thì b = ${goldenB.toFixed(3)} (để đạt tỷ lệ vàng)<br>`;
                document.getElementById('lengthB').value = goldenB.toFixed(3);
            }
            
            if (b) {
                const goldenA = b * GOLDEN_RATIO;
                result += `📏 Nếu b = ${b}, thì a = ${goldenA.toFixed(3)} (để đạt tỷ lệ vàng)<br>`;
                if (!a) document.getElementById('lengthA').value = goldenA.toFixed(3);
            }
            
            document.getElementById('ratioResult').innerHTML = result;
        }

        function divideGoldenSegments() {
            const total = parseFloat(document.getElementById('totalLength').value);
            
            if (!total) {
                document.getElementById('ratioResult').innerHTML = 
                    '<span style="color: red;">Vui lòng nhập chiều dài tổng!</span>';
                return;
            }
            
            const largerSegment = total / (1 + GOLDEN_RATIO);
            const smallerSegment = total - largerSegment;
            
            const result = `
                <strong>Chia đoạn theo tỷ lệ vàng:</strong><br>
                📏 Tổng chiều dài: ${total}<br>
                🟡 Đoạn lớn: ${largerSegment.toFixed(3)} (${(largerSegment/total*100).toFixed(1)}%)<br>
                🟠 Đoạn nhỏ: ${smallerSegment.toFixed(3)} (${(smallerSegment/total*100).toFixed(1)}%)<br>
                ✨ Tỷ lệ: ${(largerSegment/smallerSegment).toFixed(6)} ≈ φ
            `;
            
            document.getElementById('ratioResult').innerHTML = result;
        }

        // Các hàm Fibonacci
        function generateFibonacci() {
            const count = parseInt(document.getElementById('fibCount').value);
            const start = parseFloat(document.getElementById('fibStart').value);
            
            if (!count || count < 1) {
                document.getElementById('fibonacciSequence').innerHTML = 
                    '<span style="color: red;">Vui lòng nhập số lượng hợp lệ!</span>';
                return;
            }
            
            currentFibSequence = [];
            
            if (start) {
                currentFibSequence = [start, start];
                for (let i = 2; i < count; i++) {
                    currentFibSequence[i] = currentFibSequence[i-1] + currentFibSequence[i-2];
                }
            } else {
                currentFibSequence = [0, 1];
                for (let i = 2; i < count; i++) {
                    currentFibSequence[i] = currentFibSequence[i-1] + currentFibSequence[i-2];
                }
            }
            
            displayFibonacci();
        }

        function displayFibonacci() {
            const container = document.getElementById('fibonacciSequence');
            container.innerHTML = '';
            
            currentFibSequence.forEach((num, index) => {
                const span = document.createElement('span');
                span.className = 'fibonacci-number';
                span.textContent = `F${index} = ${num}`;
                span.style.animationDelay = `${index * 0.1}s`;
                container.appendChild(span);
            });
        }

        function showFibonacciRatios() {
            if (currentFibSequence.length < 2) {
                generateFibonacci();
            }
            
            const ratiosDiv = document.getElementById('fibonacciRatios');
            const ratioList = document.getElementById('ratioList');
            
            ratioList.innerHTML = '';
            
            for (let i = 1; i < currentFibSequence.length; i++) {
                if (currentFibSequence[i-1] !== 0) {
                    const ratio = currentFibSequence[i] / currentFibSequence[i-1];
                    const difference = Math.abs(ratio - GOLDEN_RATIO);
                    
                    const ratioItem = document.createElement('div');
                    ratioItem.className = 'ratio-item';
                    ratioItem.innerHTML = `
                        <span>F${i}/F${i-1} = ${currentFibSequence[i]}/${currentFibSequence[i-1]}</span>
                        <span style="color: ${difference < 0.01 ? 'green' : 'blue'};">
                            ${ratio.toFixed(6)}
                        </span>
                    `;
                    ratioList.appendChild(ratioItem);
                }
            }
            
            ratiosDiv.style.display = 'block';
        }

        function animateFibonacci() {
            if (currentFibSequence.length === 0) {
                generateFibonacci();
                return;
            }
            
            const container = document.getElementById('fibonacciSequence');
            container.innerHTML = '';
            
            currentFibSequence.forEach((num, index) => {
                setTimeout(() => {
                    const span = document.createElement('span');
                    span.className = 'fibonacci-number';
                    span.textContent = `F${index} = ${num}`;
                    container.appendChild(span);
                }, index * 200);
            });
        }

        // Các hàm Lưới thiết kế
        function generateDesignGrid() {
            const width = parseInt(document.getElementById('gridWidth').value) || 400;
            const height = width / GOLDEN_RATIO;
            
            const grid = document.getElementById('designGrid');
            grid.style.height = `${height}px`;
            grid.innerHTML = '';
            
            createGoldenSections(grid, 0, 0, width, height, 0);
        }

        function createGoldenSections(container, x, y, w, h, depth) {
            if (depth > 4 || w < 20 || h < 20) return;
            
            const section = document.createElement('div');
            section.className = 'grid-section';
            section.style.left = `${x}px`;
            section.style.top = `${y}px`;
            section.style.width = `${w}px`;
            section.style.height = `${h}px`;
            section.textContent = `${w.toFixed(0)}×${h.toFixed(0)}`;
            section.style.fontSize = `${Math.max(10, Math.min(w, h) / 8)}px`;
            
            const colors = ['rgba(255, 215, 0, 0.1)', 'rgba(255, 165, 0, 0.1)', 
                          'rgba(255, 69, 0, 0.1)', 'rgba(255, 20, 147, 0.1)', 'rgba(138, 43, 226, 0.1)'];
            section.style.background = colors[depth] || colors[4];
            
            container.appendChild(section);
            
            if (w > h) {
                const newW = w / GOLDEN_RATIO;
                createGoldenSections(container, x + newW, y, w - newW, h, depth + 1);
            } else {
                const newH = h / GOLDEN_RATIO;
                createGoldenSections(container, x, y + newH, w, h - newH, depth + 1);
            }
        }

        function showGridInfo() {
            const width = parseInt(document.getElementById('gridWidth').value) || 400;
            const height = width / GOLDEN_RATIO;
            
            const info = `
                <strong>Thông tin lưới thiết kế:</strong><br>
                📐 Kích thước: ${width} × ${height.toFixed(1)} px<br>
                📏 Tỷ lệ: ${(width/height).toFixed(6)} ≈ φ<br>
                🎨 Ứng dụng: Logo, bố cục (layout), áp phích, thiết kế web<br>
                💡 Mẹo: Đặt nội dung quan trọng ở giao điểm các đường chia
            `;
            
            const gridInfo = document.getElementById('gridInfo');
            gridInfo.innerHTML = info;
            gridInfo.style.display = 'block';
        }

        // Các hàm cho tab Biến thể
        function analyzeRatio() {
            const ratioType = document.getElementById('ratioType').value;
            const testValue = parseFloat(document.getElementById('testValue').value);
            
            if (!testValue) {
                document.getElementById('ratioAnalysis').innerHTML = 
                    '<span style="color: red;">Vui lòng nhập giá trị để kiểm tra!</span>';
                return;
            }
            
            const ratios = {
                golden: { value: GOLDEN_RATIO, name: 'Tỷ lệ vàng', symbol: 'φ' },
                silver: { value: SILVER_RATIO, name: 'Tỷ lệ bạc', symbol: 'δ' },
                bronze: { value: BRONZE_RATIO, name: 'Tỷ lệ đồng', symbol: 'σ' },
                plastic: { value: PLASTIC_NUMBER, name: 'Số dẻo', symbol: 'ρ' },
                tribonacci: { value: TRIBONACCI_CONSTANT, name: 'Tribonacci', symbol: 'T' },
                supergolden: { value: SUPERGOLDEN_RATIO, name: 'Siêu vàng', symbol: 'ψ' }
            };
            
            const selected = ratios[ratioType];
            const partner = testValue * selected.value;
            const accuracy = Math.abs(1 - Math.abs(testValue - selected.value) / selected.value) * 100;
            
            let result = `
                <strong>Phân tích ${selected.name} (${selected.symbol}):</strong><br>
                📊 Giá trị chuẩn: ${selected.value.toFixed(6)}<br>
                📏 Giá trị kiểm tra: ${testValue}<br>
                🎯 Giá trị đối tác: ${partner.toFixed(6)}<br>
                ✅ Độ chính xác: ${accuracy.toFixed(2)}%<br>
            `;
            
            if (ratioType === 'golden') {
                result += `<br><strong>Tính chất đặc biệt:</strong><br>`;
                result += `• φ² = φ + 1 = ${(GOLDEN_RATIO * GOLDEN_RATIO).toFixed(6)}<br>`;
                result += `• 1/φ = φ - 1 = ${(1/GOLDEN_RATIO).toFixed(6)}<br>`;
            } else if (ratioType === 'silver') {
                result += `<br><strong>Tính chất đặc biệt:</strong><br>`;
                result += `• δ² = 2δ + 1 = ${(SILVER_RATIO * SILVER_RATIO).toFixed(6)}<br>`;
                result += `• 1/δ = δ - 2 = ${(1/SILVER_RATIO).toFixed(6)}<br>`;
            }
            
            document.getElementById('ratioAnalysis').innerHTML = result;
        }

        function compareRatios() {
            const testValue = parseFloat(document.getElementById('testValue').value) || 1.6;
            
            const ratios = [
                { name: 'Tỷ lệ vàng', value: GOLDEN_RATIO, symbol: 'φ' },
                { name: 'Tỷ lệ bạc', value: SILVER_RATIO, symbol: 'δ' },
                { name: 'Tỷ lệ đồng', value: BRONZE_RATIO, symbol: 'σ' },
                { name: 'Số dẻo', value: PLASTIC_NUMBER, symbol: 'ρ' },
                { name: 'Tribonacci', value: TRIBONACCI_CONSTANT, symbol: 'T' },
                { name: 'Siêu vàng', value: SUPERGOLDEN_RATIO, symbol: 'ψ' }
            ];
            
            let result = `<strong>So sánh với ${testValue}:</strong><br>`;
            
            ratios.forEach(ratio => {
                const diff = Math.abs(testValue - ratio.value);
                const accuracy = Math.max(0, (1 - diff / ratio.value) * 100);
                result += `${ratio.symbol} ${ratio.name}: ${diff.toFixed(4)} (${accuracy.toFixed(1)}%)<br>`;
            });
            
            const closest = ratios.reduce((prev, curr) => 
                Math.abs(testValue - curr.value) < Math.abs(testValue - prev.value) ? curr : prev
            );
            
            result += `<br>🎯 <strong>Gần nhất: ${closest.name} (${closest.symbol})</strong>`;
            
            document.getElementById('ratioAnalysis').innerHTML = result;
        }

        function generateContinuedFraction() {
            const iterations = parseInt(document.getElementById('cfIterations').value) || 10;
            
            let result = '<strong>Phân số liên tục của tỷ lệ vàng:</strong><br>';
            result += 'φ = [1; 1, 1, 1, 1, ...]<br><br>';
            
            let convergents = [];
            let p_prev = 1, p_curr = 2;
            let q_prev = 1, q_curr = 1;
            
            convergents.push({ p: 1, q: 1, value: 1 });
            convergents.push({ p: 2, q: 1, value: 2 });
            
            for (let i = 2; i < iterations; i++) {
                let p_next = p_curr + p_prev;
                let q_next = q_curr + q_prev;
                let value = p_next / q_next;
                
                convergents.push({ p: p_next, q: q_next, value: value });
                
                p_prev = p_curr;
                p_curr = p_next;
                q_prev = q_curr;
                q_curr = q_next;
            }
            
            result += '<strong>Hội tụ:</strong><br>';
            convergents.forEach((conv, i) => {
                const error = Math.abs(conv.value - GOLDEN_RATIO);
                result += `${conv.p}/${conv.q} = ${conv.value.toFixed(8)} (sai số: ${error.toFixed(8)})<br>`;
            });
            
            document.getElementById('cfResult').innerHTML = result;
        }

        function generateSilverCF() {
            const iterations = parseInt(document.getElementById('cfIterations').value) || 10;
            
            let result = '<strong>Phân số liên tục của tỷ lệ bạc:</strong><br>';
            result += 'δ = [2; 2, 2, 2, 2, ...]<br><br>';
            
            let p_prev = 2, p_curr = 5;
            let q_prev = 1, q_curr = 2;
            
            result += '<strong>Hội tụ:</strong><br>';
            result += `2/1 = 2.000000 (sai số: ${Math.abs(2 - SILVER_RATIO).toFixed(8)})<br>`;
            result += `5/2 = 2.500000 (sai số: ${Math.abs(2.5 - SILVER_RATIO).toFixed(8)})<br>`;
            
            for (let i = 2; i < iterations; i++) {
                let p_next = 2 * p_curr + p_prev;
                let q_next = 2 * q_curr + q_prev;
                let value = p_next / q_next;
                let error = Math.abs(value - SILVER_RATIO);
                
                result += `${p_next}/${q_next} = ${value.toFixed(6)} (sai số: ${error.toFixed(8)})<br>`;
                
                p_prev = p_curr;
                p_curr = p_next;
                q_prev = q_curr;
                q_curr = q_next;
            }
            
            document.getElementById('cfResult').innerHTML = result;
        }

        function generateSequence() {
            const type = document.getElementById('sequenceType').value;
            const count = 15;
            
            let sequence = [];
            let result = '';
            
            switch (type) {
                case 'fibonacci':
                    sequence = [0, 1];
                    for (let i = 2; i < count; i++) {
                        sequence[i] = sequence[i-1] + sequence[i-2];
                    }
                    result = '<strong>Dãy Fibonacci:</strong><br>' + sequence.join(', ');
                    break;
                    
                case 'lucas':
                    sequence = [2, 1];
                    for (let i = 2; i < count; i++) {
                        sequence[i] = sequence[i-1] + sequence[i-2];
                    }
                    result = '<strong>Dãy Lucas:</strong><br>' + sequence.join(', ');
                    break;
                    
                case 'pell':
                    sequence = [0, 1];
                    for (let i = 2; i < count; i++) {
                        sequence[i] = 2 * sequence[i-1] + sequence[i-2];
                    }
                    result = '<strong>Dãy Pell:</strong><br>' + sequence.join(', ');
                    break;
                    
                case 'tribonacci':
                    sequence = [0, 0, 1];
                    for (let i = 3; i < count; i++) {
                        sequence[i] = sequence[i-1] + sequence[i-2] + sequence[i-3];
                    }
                    result = '<strong>Dãy Tribonacci:</strong><br>' + sequence.join(', ');
                    break;
            }
            
            document.getElementById('sequenceResult').innerHTML = result;
        }

        function analyzeRatios() {
            generateSequence();
            const type = document.getElementById('sequenceType').value;
            
            let sequence = [];
            const count = 12;
            
            switch (type) {
                case 'fibonacci':
                    sequence = [0, 1];
                    for (let i = 2; i < count; i++) {
                        sequence[i] = sequence[i-1] + sequence[i-2];
                    }
                    break;
                case 'lucas':
                    sequence = [2, 1];
                    for (let i = 2; i < count; i++) {
                        sequence[i] = sequence[i-1] + sequence[i-2];
                    }
                    break;
                case 'pell':
                    sequence = [0, 1];
                    for (let i = 2; i < count; i++) {
                        sequence[i] = 2 * sequence[i-1] + sequence[i-2];
                    }
                    break;
                case 'tribonacci':
                    sequence = [0, 0, 1];
                    for (let i = 3; i < count; i++) {
                        sequence[i] = sequence[i-1] + sequence[i-2] + sequence[i-3];
                    }
                    break;
            }
            
            let result = '<strong>Tỷ lệ liên tiếp:</strong><br>';
            for (let i = 2; i < Math.min(sequence.length, 10); i++) {
                if (sequence[i-1] !== 0) {
                    const ratio = sequence[i] / sequence[i-1];
                    result += `${sequence[i]}/${sequence[i-1]} = ${ratio.toFixed(6)}<br>`;
                }
            }
            
            if (type === 'fibonacci' || type === 'lucas') {
                result += `<br>Hội tụ về φ = ${GOLDEN_RATIO.toFixed(6)}`;
            } else if (type === 'pell') {
                result += `<br>Hội tụ về $1+\sqrt{2}$ = ${SILVER_RATIO.toFixed(6)}`;
            } else if (type === 'tribonacci') {
                result += `<br>Hội tụ về T = ${TRIBONACCI_CONSTANT.toFixed(6)}`;
            }
            
            document.getElementById('sequenceResult').innerHTML = result;
        }

        // Các hàm Kiến trúc
        function setArchPreset(type) {
            const presets = {
                classical: { height: 20, width: 12.36 },
                modern: { height: 15, width: 9.27 },
                gothic: { height: 25, width: 15.45 }
            };
            
            if (presets[type]) {
                document.getElementById('buildingHeight').value = presets[type].height;
                document.getElementById('buildingWidth').value = presets[type].width;
                calculateFacade();
            }
        }

        function calculateFacade() {
            const height = parseFloat(document.getElementById('buildingHeight').value);
            const width = parseFloat(document.getElementById('buildingWidth').value);
            
            if (!height || !width) return;
            
            const ratio = height / width;
            const goldenAccuracy = ((1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100).toFixed(1);
            
            const result = `
                <strong>Phân tích mặt tiền:</strong><br>
                📐 Tỷ lệ Cao/Rộng: ${ratio.toFixed(3)}<br>
                🏛️ Độ chính xác vàng: ${goldenAccuracy}%<br>
                💡 Gợi ý: ${goldenAccuracy > 95 ? 'Tỷ lệ tuyệt vời!' : 'Có thể điều chỉnh để đạt tỷ lệ vàng'}
            `;
            
            document.getElementById('facadeResult').innerHTML = result;
        }

        function calculateOpening() {
            const height = parseFloat(document.getElementById('openingHeight').value);
            const width = parseFloat(document.getElementById('openingWidth').value);
            const type = document.getElementById('openingType').value;
            
            if (!height || !width) return;
            
            const ratio = height / width;
            const goldenHeight = width * GOLDEN_RATIO;
            const goldenWidth = height / GOLDEN_RATIO;
            
            const typeNames = {
                door: 'Cửa chính',
                window: 'Cửa sổ',
                french_door: 'Cửa Pháp',
                bay_window: 'Cửa sổ lồi'
            };
            
            const result = `
                <strong>${typeNames[type]}:</strong><br>
                📏 Kích thước: ${width}m × ${height}m<br>
                📐 Tỷ lệ hiện tại: ${ratio.toFixed(3)}<br>
                🌟 Tỷ lệ vàng gợi ý:<br>
                • Giữ rộng ${width}m → cao ${goldenHeight.toFixed(2)}m<br>
                • Giữ cao ${height}m → rộng ${goldenWidth.toFixed(2)}m
            `;
            
            document.getElementById('openingResult').innerHTML = result;
        }

        function calculateColumn() {
            const height = parseFloat(document.getElementById('columnHeight').value);
            const style = document.getElementById('columnStyle').value;
            
            if (!height) return;
            
            const proportions = {
                doric: { diameter: height / 6, base: height / 8 },
                ionic: { diameter: height / 7, base: height / 9 },
                corinthian: { diameter: height / 8, base: height / 10 },
                modern: { diameter: height / GOLDEN_RATIO / 3, base: height / GOLDEN_RATIO / 4 }
            };
            
            const prop = proportions[style];
            
            const result = `
                <strong>Cột ${style.charAt(0).toUpperCase() + style.slice(1)}:</strong><br>
                📏 Chiều cao: ${height}m<br>
                ⭕ Đường kính: ${prop.diameter.toFixed(2)}m<br>
                🏗️ Đường kính chân: ${prop.base.toFixed(2)}m<br>
                📐 Tỷ lệ: ${(height / prop.diameter).toFixed(1)}:1
            `;
            
            document.getElementById('columnResult').innerHTML = result;
        }

        function calculateRoom() {
            const length = parseFloat(document.getElementById('roomLength').value);
            const width = parseFloat(document.getElementById('roomWidth').value);
            const ceiling = parseFloat(document.getElementById('roomCeiling').value);
            
            if (!length || !width) return;
            
            const ratio = length / width;
            const area = length * width;
            const volume = ceiling ? area * ceiling : 0;
            const goldenWidth = length / GOLDEN_RATIO;
            const goldenLength = width * GOLDEN_RATIO;
            
            let result = `
                <strong>Phân tích phòng:</strong><br>
                📏 Kích thước: ${length}m × ${width}m<br>
                📐 Tỷ lệ Dài/Rộng: ${ratio.toFixed(3)}<br>
                📊 Diện tích: ${area.toFixed(1)}m²<br>
            `;
            
            if (ceiling) {
                result += `🏠 Thể tích: ${volume.toFixed(1)}m³<br>`;
            }
            
            result += `
                🌟 Tỷ lệ vàng gợi ý:<br>
                • Giữ dài ${length}m → rộng ${goldenWidth.toFixed(2)}m<br>
                • Giữ rộng ${width}m → dài ${goldenLength.toFixed(2)}m
            `;
            
            document.getElementById('roomResult').innerHTML = result;
        }

        // Các hàm Xây dựng
        function calculateBeam() {
            const span = parseFloat(document.getElementById('beamSpan').value);
            const load = parseFloat(document.getElementById('beamLoad').value);
            
            if (!span || !load) return;
            
            const optimalDepth = span * 1000 / 12;
            const goldenWidth = optimalDepth / GOLDEN_RATIO;
            const moment = load * span * span / 8;
            
            const result = `
                <strong>Phân tích dầm:</strong><br>
                📏 Nhịp: ${span}m<br>
                ⚖️ Tải trọng: ${load} kN/m<br>
                📐 Chiều cao tối ưu: ${optimalDepth.toFixed(0)}mm<br>
                🌟 Chiều rộng (vàng): ${goldenWidth.toFixed(0)}mm<br>
                🔧 Mô men cực đại: ${moment.toFixed(1)} kNm
            `;
            
            document.getElementById('beamResult').innerHTML = result;
        }

        function calculateUrbanPlanning() {
            const area = parseFloat(document.getElementById('totalArea').value);
            
            if (!area) return;
            
            const residential = area * 0.618;
            const park = area * 0.236;
            const commercial = area * 0.090;
            const infrastructure = area * 0.056;
            
            document.getElementById('urbanResult').innerHTML = `
                <div class="proportion-item">Khu dân cư: <strong>${residential.toFixed(1)} ha (61.8%)</strong></div>
                <div class="proportion-item">Công viên: <strong>${park.toFixed(1)} ha (23.6%)</strong></div>
                <div class="proportion-item">Thương mại: <strong>${commercial.toFixed(1)} ha (9.0%)</strong></div>
                <div class="proportion-item">Hạ tầng: <strong>${infrastructure.toFixed(1)} ha (5.6%)</strong></div>
            `;
        }

        function calculateStairs() {
            const height = parseFloat(document.getElementById('stepHeight').value);
            const depth = parseFloat(document.getElementById('stepDepth').value);
            
            if (!height || !depth) return;
            
            const ratio = depth / height;
            const goldenDepth = height * GOLDEN_RATIO;
            const comfort = (2 * height + depth >= 60 && 2 * height + depth <= 65) ? 'Thoải mái' : 'Cần điều chỉnh';
            
            const result = `
                <strong>Phân tích thang:</strong><br>
                📏 Bậc: ${depth}cm × ${height}cm<br>
                📐 Tỷ lệ Sâu/Cao: ${ratio.toFixed(3)}<br>
                🌟 Chiều sâu vàng: ${goldenDepth.toFixed(1)}cm<br>
                👤 Độ thoải mái: ${comfort}<br>
                📊 Công thức 2H+D = ${(2*height + depth).toFixed(0)}cm
            `;
            
            document.getElementById('stairResult').innerHTML = result;
        }

        function convertUnits() {
            const value = parseFloat(document.getElementById('convertValue').value);
            const unit = document.getElementById('unitType').value;
            
            if (!value) return;
            
            let result = '<strong>Chuyển đổi đơn vị:</strong><br>';
            
            if (unit === 'metric') {
                result += `
                    📏 ${value}m = ${(value * 100).toFixed(1)}cm = ${(value * 1000).toFixed(0)}mm<br>
                    🌟 Đối tác vàng: ${(value * GOLDEN_RATIO).toFixed(3)}m
                `;
            } else if (unit === 'imperial') {
                result += `
                    📏 ${value}ft = ${(value * 12).toFixed(1)}in = ${(value * 0.3048).toFixed(3)}m<br>
                    🌟 Đối tác vàng: ${(value * GOLDEN_RATIO).toFixed(3)}ft
                `;
            }
            
            document.getElementById('convertResult').innerHTML = result;
        }

        // Các hàm Điêu khắc
        function calculateBodyProportions() {
            const height = parseFloat(document.getElementById('bodyHeight').value);
            
            if (!height) return;
            
            const head = height / 8;
            const torso = height * 0.618;
            const legs = height * 0.382;
            const armSpan = height * GOLDEN_RATIO;
            const navel = height * 0.618;
            
            const result = `
                <strong>Tỷ lệ cơ thể (${height}cm):</strong><br>
                👤 Chiều cao tổng: ${height}cm<br>
                🧠 Chiều cao đầu: ${head.toFixed(1)}cm<br>
                👕 Thân trên (đầu→rốn): ${navel.toFixed(1)}cm<br>
                👖 Thân dưới (rốn→chân): ${(height - navel).toFixed(1)}cm<br>
                🤲 Sải tay: ${armSpan.toFixed(1)}cm<br>
                📐 Tỷ lệ vàng tại rốn: ${(navel/height).toFixed(3)} ≈ $φ^{-1}$
            `;
            
            document.getElementById('bodyResult').innerHTML = result;
            drawBodyProportions(height);
        }

        function drawBodyProportions(height) {
            const canvas = document.getElementById('bodyCanvas');
            if (!canvas) return;
            
            const ctx = canvas.getContext('2d');
            
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            const scale = 300 / height;
            const centerX = canvas.width / 2;
            const bottomY = canvas.height - 20;
            
            ctx.strokeStyle = '#FFD700';
            ctx.lineWidth = 2;
            
            const headRadius = (height / 8) * scale / 2;
            ctx.beginPath();
            ctx.arc(centerX, bottomY - height * scale + headRadius, headRadius, 0, 2 * Math.PI);
            ctx.stroke();
            
            ctx.beginPath();
            ctx.moveTo(centerX, bottomY - height * scale + headRadius * 2);
            ctx.lineTo(centerX, bottomY - (height - height * 0.618) * scale);
            ctx.stroke();
            
            const navelY = bottomY - (height - height * 0.618) * scale;
            ctx.strokeStyle = '#FF6B35';
            ctx.setLineDash([5, 5]);
            ctx.beginPath();
            ctx.moveTo(20, navelY);
            ctx.lineTo(canvas.width - 20, navelY);
            ctx.stroke();
            
            ctx.setLineDash([]);
        }

        function calculateFaceProportions() {
            const faceLength = parseFloat(document.getElementById('faceLength').value);
            
            if (!faceLength) return;
            
            const eyeLine = faceLength / 2;
            const noseLine = faceLength * 0.618;
            const mouthLine = faceLength * 0.786;
            const faceWidth = faceLength / GOLDEN_RATIO;
            
            const result = `
                <strong>Tỷ lệ khuôn mặt:</strong><br>
                📏 Chiều dài mặt: ${faceLength}cm<br>
                👁️ Đường mắt: ${eyeLine.toFixed(1)}cm từ trên<br>
                👃 Đường mũi: ${noseLine.toFixed(1)}cm từ trên<br>
                👄 Đường môi: ${mouthLine.toFixed(1)}cm từ trên<br>
                📐 Chiều rộng tối ưu: ${faceWidth.toFixed(1)}cm<br>
                🌟 Tỷ lệ vàng: ${(faceLength/faceWidth).toFixed(3)} ≈ φ
            `;
            
            document.getElementById('faceResult').innerHTML = result;
        }

        function calculate3DProportion() {
            const height = parseFloat(document.getElementById('sculptHeight').value);
            const width = parseFloat(document.getElementById('sculptWidth').value);
            const depth = parseFloat(document.getElementById('sculptDepth').value);
            
            if (!height || !width || !depth) return;
            
            const hwRatio = height / width;
            const wdRatio = width / depth;
            const hdRatio = height / depth;
            
            const result = `
                <strong>Phân tích 3D:</strong><br>
                📏 Kích thước: ${width} × ${depth} × ${height}cm<br>
                📐 Tỷ lệ Cao/Rộng: ${hwRatio.toFixed(3)} ${Math.abs(hwRatio - GOLDEN_RATIO) < 0.1 ? '✅' : ''}<br>
                📐 Tỷ lệ Rộng/Sâu: ${wdRatio.toFixed(3)} ${Math.abs(wdRatio - GOLDEN_RATIO) < 0.1 ? '✅' : ''}<br>
                📐 Tỷ lệ Cao/Sâu: ${hdRatio.toFixed(3)} ${Math.abs(hdRatio - GOLDEN_RATIO) < 0.1 ? '✅' : ''}<br>
                🎯 Tỷ lệ vàng: ${GOLDEN_RATIO.toFixed(3)}
            `;
            
            document.getElementById('sculptResult').innerHTML = result;
        }

        function setSculpturePreset(type) {
            const presets = {
                classical: 'Tỷ lệ cổ điển: Dựa trên tỷ lệ của Hy Lạp cổ đại, sử dụng tỷ lệ vàng cho chiều cao và chiều rộng.',
                modern: 'Điêu khắc hiện đại: Tập trung vào hình khối và không gian, thường phá vỡ tỷ lệ truyền thống.',
                abstract: 'Trừu tượng: Sử dụng tỷ lệ vàng để tạo sự cân bằng trong các hình dạng phi cụ thể.',
                realistic: 'Hiện thực: Tuân theo tỷ lệ cơ thể người và tự nhiên, áp dụng tỷ lệ vàng cho sự hài hòa.'
            };
            
            document.getElementById('sculpturePresetResult').innerHTML = presets[type];
        }

        // Các hàm Nghệ thuật
        function setFramePreset(type) {
            const presets = {
                golden: { width: 40, height: 24.7 },
                '4x3': { width: 40, height: 30 },
                '16x9': { width: 40, height: 22.5 },
                square: { width: 30, height: 30 }
            };
            
            if (presets[type]) {
                document.getElementById('frameWidth').value = presets[type].width;
                document.getElementById('frameHeight').value = presets[type].height;
                calculateFrame();
            }
        }

        function calculateFrame() {
            const width = parseFloat(document.getElementById('frameWidth').value);
            const height = parseFloat(document.getElementById('frameHeight').value);
            
            if (!width || !height) return;
            
            const ratio = width / height;
            const goldenAccuracy = ((1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100).toFixed(1);
            
            const result = `
                <strong>Phân tích khung hình:</strong><br>
                📏 Kích thước: ${width} × ${height}cm<br>
                📐 Tỷ lệ: ${ratio.toFixed(3)}<br>
                🌟 Độ chính xác vàng: ${goldenAccuracy}%<br>
                🎨 Phù hợp cho: ${goldenAccuracy > 95 ? 'Tranh phong cảnh, chân dung' : 'Các tác phẩm thử nghiệm'}
            `;
            
            document.getElementById('frameResult').innerHTML = result;
        }

function generateComposition() {
    const canvas = document.getElementById('compositionCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const size = document.getElementById('canvasSize').value;
    
    // Set canvas dimensions based on size
    let canvasWidth, canvasHeight;
    switch(size) {
        case 'small':
            canvasWidth = 200; canvasHeight = 300;
            break;
        case 'medium':
            canvasWidth = 400; canvasHeight = 600;
            break;
        case 'large':
            canvasWidth = 600; canvasHeight = 900;
            break;
        default: // custom
            canvasWidth = 300; canvasHeight = 300 / GOLDEN_RATIO;
    }
    
    canvas.width = Math.min(canvasWidth, 400); // Limit for display
    canvas.height = Math.min(canvasHeight, 300);
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Vẽ khung canvas
    ctx.strokeStyle = '#333';
    ctx.lineWidth = 2;
    ctx.strokeRect(0, 0, canvas.width, canvas.height);
    
    // Vẽ các đường chia tỷ lệ vàng
    const goldenX = canvas.width / GOLDEN_RATIO;
    const goldenY = canvas.height / GOLDEN_RATIO;
    const goldenX2 = canvas.width - goldenX;
    const goldenY2 = canvas.height - goldenY;
    
    // Main golden lines
    ctx.strokeStyle = '#FFD700';
    ctx.lineWidth = 2;
    ctx.setLineDash([8, 4]);
    
    // Vertical golden lines
    ctx.beginPath();
    ctx.moveTo(goldenX, 0);
    ctx.lineTo(goldenX, canvas.height);
    ctx.stroke();
    
    ctx.beginPath();
    ctx.moveTo(goldenX2, 0);
    ctx.lineTo(goldenX2, canvas.height);
    ctx.stroke();
    
    // Horizontal golden lines
    ctx.beginPath();
    ctx.moveTo(0, goldenY);
    ctx.lineTo(canvas.width, goldenY);
    ctx.stroke();
    
    ctx.beginPath();
    ctx.moveTo(0, goldenY2);
    ctx.lineTo(canvas.width, goldenY2);
    ctx.stroke();
    
    ctx.setLineDash([]);
    
    // Vẽ các điểm giao (power points)
    const powerPoints = [
        {x: goldenX, y: goldenY, label: 'P1'},
        {x: goldenX2, y: goldenY, label: 'P2'},
        {x: goldenX, y: goldenY2, label: 'P3'},
        {x: goldenX2, y: goldenY2, label: 'P4'}
    ];
    
    ctx.fillStyle = '#FF6B35';
    ctx.font = 'bold 12px Arial';
    ctx.textAlign = 'center';
    
    powerPoints.forEach(point => {
        // Vẽ điểm
        ctx.beginPath();
        ctx.arc(point.x, point.y, 6, 0, 2 * Math.PI);
        ctx.fill();
        
        // Vẽ label
        ctx.fillStyle = '#333';
        ctx.fillText(point.label, point.x, point.y - 12);
        ctx.fillStyle = '#FF6B35';
    });
    
    // Vẽ spiral tỷ lệ vàng
    ctx.strokeStyle = 'rgba(255, 215, 0, 0.6)';
    ctx.lineWidth = 2;
    
    // Golden spiral starting from one of the rectangles
    let x = 0, y = 0, w = goldenX, h = goldenY;
    
    for (let i = 0; i < 4; i++) {
        ctx.beginPath();
        
        if (i % 4 === 0) {
            ctx.arc(x + w, y + h, w, Math.PI, 3 * Math.PI / 2);
        } else if (i % 4 === 1) {
            ctx.arc(x, y + h, h, 3 * Math.PI / 2, 0);
        } else if (i % 4 === 2) {
            ctx.arc(x, y, w, 0, Math.PI / 2);
        } else {
            ctx.arc(x + w, y, h, Math.PI / 2, Math.PI);
        }
        
        ctx.stroke();
        
        // Update for next iteration
        const newW = h;
        const newH = w - h;
        
        if (i % 4 === 0) {
            x = x + w - newW;
            y = y + h - newH;
        } else if (i % 4 === 1) {
            y = y + h - newH;
        } else if (i % 4 === 2) {
            // x, y unchanged
        } else {
            x = x + w - newW;
        }
        
        w = newW;
        h = newH;
        
        if (w < 10 || h < 10) break;
    }
    
    // Vẽ các vùng composition
    ctx.fillStyle = 'rgba(100, 149, 237, 0.2)';
    ctx.fillRect(0, 0, goldenX, goldenY);
    ctx.fillStyle = 'rgba(255, 99, 71, 0.2)';
    ctx.fillRect(goldenX, 0, goldenX2 - goldenX, goldenY);
    ctx.fillStyle = 'rgba(60, 179, 113, 0.2)';
    ctx.fillRect(0, goldenY, goldenX, goldenY2 - goldenY);
    ctx.fillStyle = 'rgba(255, 215, 0, 0.2)';
    ctx.fillRect(goldenX, goldenY, canvas.width - goldenX, canvas.height - goldenY);
    
    // Labels cho các vùng
    ctx.fillStyle = '#333';
    ctx.font = '10px Arial';
    ctx.textAlign = 'center';
    
    ctx.fillText('Primary', goldenX/2, goldenY/2);
    ctx.fillText('Secondary', goldenX + (goldenX2-goldenX)/2, goldenY/2);
    ctx.fillText('Supporting', goldenX/2, goldenY + (goldenY2-goldenY)/2);
    ctx.fillText('Detail', goldenX + (canvas.width-goldenX)/2, goldenY + (canvas.height-goldenY)/2);
    
    // Thông tin kỹ thuật
    const compositionInfo = `
        <strong>Composition Guidelines:</strong><br>
        📐 Canvas: ${canvas.width}×${canvas.height}px<br>
        🎯 Power points: Intersections of φ lines<br>
        📊 Primary area: ${((goldenX * goldenY) / (canvas.width * canvas.height) * 100).toFixed(1)}%<br>
        🌀 Golden spiral: Natural eye flow path<br><br>
        
        <strong>Placement Rules:</strong><br>
        • Main subject: Place at power points P1-P4<br>
        • Horizon line: Use horizontal φ divisions<br>
        • Vertical elements: Align with vertical φ lines<br>
        • Color weights: Distribute following φ ratios<br>
        • Leading lines: Follow spiral path<br><br>
        
        <strong>φ Proportions:</strong><br>
        🟦 Primary (upper-left): ${(61.8 * 61.8 / 100).toFixed(1)}%<br>
        🟥 Secondary (upper-right): ${(38.2 * 61.8 / 100).toFixed(1)}%<br>
        🟩 Supporting (lower-left): ${(61.8 * 38.2 / 100).toFixed(1)}%<br>
        🟨 Detail (lower-right): ${(38.2 * 38.2 / 100).toFixed(1)}%
    `;
    
    // Update result
    document.getElementById('compositionCanvas').setAttribute('data-info', compositionInfo);
}

        function generateGoldenPalette() {
            const primaryColor = document.getElementById('primaryColor').value;
            
            const result = `
                <strong>Bảng màu vàng:</strong><br>
                🎨 Màu chủ đạo: <span style="display:inline-block;width:20px;height:20px;background:${primaryColor};margin:0 5px;vertical-align:middle;"></span>${primaryColor}<br>
                🌅 Màu phụ 1: <span style="display:inline-block;width:20px;height:20px;background:#FFB347;margin:0 5px;vertical-align:middle;"></span>#FFB347<br>
                🍂 Màu phụ 2: <span style="display:inline-block;width:20px;height:20px;background:#DEB887;margin:0 5px;vertical-align:middle;"></span>#DEB887<br>
                ✨ Màu nhấn: <span style="display:inline-block;width:20px;height:20px;background:#F4A460;margin:0 5px;vertical-align:middle;"></span>#F4A460
            `;
            
            document.getElementById('paletteResult').innerHTML = result;
        }

function drawPhotoGuides() {
    const canvas = document.getElementById('photoCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const ratio = document.getElementById('photoRatio').value;
    const size = parseInt(document.getElementById('photoSize').value) || 300;
    
    // Set canvas size
    canvas.width = size;
    canvas.height = size / GOLDEN_RATIO;
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Vẽ background
    ctx.fillStyle = '#f0f0f0';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Vẽ khung
    ctx.strokeStyle = '#333';
    ctx.lineWidth = 2;
    ctx.strokeRect(0, 0, canvas.width, canvas.height);
    
    if (ratio === 'thirds' || ratio === 'both') {
        // Rule of thirds
        ctx.strokeStyle = '#2196F3';
        ctx.lineWidth = 1.5;
        ctx.setLineDash([6, 4]);
        
        const thirdX = canvas.width / 3;
        const thirdY = canvas.height / 3;
        
        // Vertical third lines
        for (let i = 1; i < 3; i++) {
            ctx.beginPath();
            ctx.moveTo(thirdX * i, 0);
            ctx.lineTo(thirdX * i, canvas.height);
            ctx.stroke();
        }
        
        // Horizontal third lines
        for (let i = 1; i < 3; i++) {
            ctx.beginPath();
            ctx.moveTo(0, thirdY * i);
            ctx.lineTo(canvas.width, thirdY * i);
            ctx.stroke();
        }
        
        // Mark intersection points (power points for rule of thirds)
        ctx.fillStyle = '#2196F3';
        for (let i = 1; i < 3; i++) {
            for (let j = 1; j < 3; j++) {
                ctx.beginPath();
                ctx.arc(thirdX * i, thirdY * j, 4, 0, 2 * Math.PI);
                ctx.fill();
            }
        }
        
        ctx.setLineDash([]);
    }
    
    if (ratio === 'golden' || ratio === 'both') {
        // Golden ratio
        ctx.strokeStyle = '#FFD700';
        ctx.lineWidth = 2;
        ctx.setLineDash([8, 4]);
        
        const goldenX = canvas.width / GOLDEN_RATIO;
        const goldenY = canvas.height / GOLDEN_RATIO;
        const goldenX2 = canvas.width - goldenX;
        const goldenY2 = canvas.height - goldenY;
        
        // Vertical golden lines
        ctx.beginPath();
        ctx.moveTo(goldenX, 0);
        ctx.lineTo(goldenX, canvas.height);
        ctx.stroke();
        
        ctx.beginPath();
        ctx.moveTo(goldenX2, 0);
        ctx.lineTo(goldenX2, canvas.height);
        ctx.stroke();
        
        // Horizontal golden lines
        ctx.beginPath();
        ctx.moveTo(0, goldenY);
        ctx.lineTo(canvas.width, goldenY);
        ctx.stroke();
        
        ctx.beginPath();
        ctx.moveTo(0, goldenY2);
        ctx.lineTo(canvas.width, goldenY2);
        ctx.stroke();
        
        // Mark golden ratio intersection points
        ctx.fillStyle = '#FFD700';
        const goldenPoints = [
            {x: goldenX, y: goldenY},
            {x: goldenX2, y: goldenY},
            {x: goldenX, y: goldenY2},
            {x: goldenX2, y: goldenY2}
        ];
        
        goldenPoints.forEach(point => {
            ctx.beginPath();
            ctx.arc(point.x, point.y, 5, 0, 2 * Math.PI);
            ctx.fill();
        });
        
        ctx.setLineDash([]);
        
        // Draw golden spiral
        ctx.strokeStyle = 'rgba(255, 215, 0, 0.8)';
        ctx.lineWidth = 2;
        drawGoldenSpiral(ctx, 0, 0, goldenX, goldenY);
    }
    
    // Add sample subject placements
    if (ratio !== 'thirds') {
        // Golden ratio example subjects
        ctx.fillStyle = 'rgba(255, 99, 71, 0.7)';
        ctx.fillRect(canvas.width/GOLDEN_RATIO - 20, canvas.height/GOLDEN_RATIO - 15, 40, 30);
        
        ctx.fillStyle = 'rgba(60, 179, 113, 0.7)';
        ctx.beginPath();
        ctx.arc(canvas.width - canvas.width/GOLDEN_RATIO, canvas.height/GOLDEN_RATIO, 15, 0, 2 * Math.PI);
        ctx.fill();
    }
    
    if (ratio !== 'golden') {
        // Rule of thirds example subjects
        ctx.fillStyle = 'rgba(100, 149, 237, 0.7)';
        ctx.fillRect(canvas.width/3 - 15, canvas.height/3 - 10, 30, 20);
        
        ctx.fillStyle = 'rgba(255, 193, 7, 0.7)';
        ctx.beginPath();
        ctx.arc(2*canvas.width/3, 2*canvas.height/3, 12, 0, 2 * Math.PI);
        ctx.fill();
    }
    
    // Labels
    ctx.fillStyle = '#333';
    ctx.font = 'bold 11px Arial';
    ctx.textAlign = 'left';
    
    let labelY = 15;
    if (ratio === 'thirds' || ratio === 'both') {
        ctx.fillStyle = '#2196F3';
        ctx.fillText('Rule of Thirds', 5, labelY);
        labelY += 15;
    }
    if (ratio === 'golden' || ratio === 'both') {
        ctx.fillStyle = '#FFD700';
        ctx.fillText('Golden Ratio', 5, labelY);
        labelY += 15;
    }
    
    // Comparison info
    const comparisonInfo = generateComparisonInfo(ratio);
    
    // Display analysis
    const analysisResult = `
        <strong>Photography Composition Analysis:</strong><br>
        📸 Canvas size: ${canvas.width}×${canvas.height}px<br>
        📐 Aspect ratio: ${(canvas.width/canvas.height).toFixed(3)}<br>
        🎯 Guide type: ${ratio}<br><br>
        
        ${comparisonInfo}
        
        <strong>Practical Tips:</strong><br>
        • Place main subjects at intersection points<br>
        • Use lines as guides for horizon placement<br>
        • Balance visual weight across sections<br>
        • Consider eye movement flow patterns<br>
        • Apply to both landscape and portrait orientations
    `;
    
    document.getElementById('photoCanvas').setAttribute('data-analysis', analysisResult);
}

function drawGoldenSpiral(ctx, startX, startY, width, height) {
    let x = startX, y = startY, w = width, h = height;
    
    for (let i = 0; i < 6; i++) {
        ctx.beginPath();
        
        const radius = Math.min(w, h);
        
        if (i % 4 === 0) {
            // Bottom-right quadrant
            ctx.arc(x + w, y + h, radius, Math.PI, 3 * Math.PI / 2);
            x = x + w - radius / GOLDEN_RATIO;
            y = y + h - radius;
            w = radius / GOLDEN_RATIO;
            h = radius - radius / GOLDEN_RATIO;
        } else if (i % 4 === 1) {
            // Bottom-left quadrant
            ctx.arc(x, y + h, radius, 3 * Math.PI / 2, 0);
            y = y + h - radius / GOLDEN_RATIO;
            w = radius - radius / GOLDEN_RATIO;
            h = radius / GOLDEN_RATIO;
        } else if (i % 4 === 2) {
            // Top-left quadrant
            ctx.arc(x, y, radius, 0, Math.PI / 2);
            w = radius / GOLDEN_RATIO;
            h = radius - radius / GOLDEN_RATIO;
        } else {
            // Top-right quadrant
            ctx.arc(x + w, y, radius, Math.PI / 2, Math.PI);
            x = x + w - radius;
            w = radius - radius / GOLDEN_RATIO;
            h = radius / GOLDEN_RATIO;
        }
        
        ctx.stroke();
        
        if (Math.min(w, h) < 5) break; // Stop when too small
    }
}

function generateComparisonInfo(ratio) {
    if (ratio === 'thirds') {
        return `
            <strong>Rule of Thirds Analysis:</strong><br>
            📐 Grid: 3×3 equal sections<br>
            🎯 Power points: 4 intersections<br>
            📊 Distribution: 33.3% per section<br>
            👁️ Eye comfort: High (familiar pattern)<br>
            🎨 Best for: Landscapes, portraits, general photography<br><br>
        `;
    } else if (ratio === 'golden') {
        return `
            <strong>Golden Ratio Analysis:</strong><br>
            📐 Grid: φ-based divisions (61.8% / 38.2%)<br>
            🎯 Power points: 4 φ-intersections<br>
            📊 Distribution: Asymmetric but harmonious<br>
            👁️ Eye comfort: Very high (natural preference)<br>
            🎨 Best for: Fine art, dynamic compositions<br><br>
        `;
    } else { // both
        return `
            <strong>Comparison - Rule of Thirds vs Golden Ratio:</strong><br>
            
            <strong>Similarities:</strong><br>
            • Both create 4 focal power points<br>
            • Both avoid center placement<br>
            • Both guide eye movement effectively<br><br>
            
            <strong>Differences:</strong><br>
            📏 Thirds: 33.3% divisions (symmetric)<br>
            🌟 Golden: 61.8%/38.2% divisions (asymmetric)<br><br>
            
            📊 Visual weight distribution:<br>
            • Thirds: Balanced, stable feeling<br>
            • Golden: Dynamic, more visually interesting<br><br>
            
            🎯 When to use:<br>
            • Thirds: Commercial, documentary, beginners<br>
            • Golden: Artistic, creative, advanced compositions<br><br>
            
            🧠 Psychology:<br>
            • Thirds: Learned preference, cultural<br>
            • Golden: Innate preference, mathematical beauty<br><br>
        `;
    }
}

        // Các hàm Tự nhiên
function drawPhyllotaxis() {
    const canvas = document.getElementById('phyllotaxisCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const leafCount = parseInt(document.getElementById('leafCount').value) || 21;
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const maxRadius = Math.min(centerX, centerY) - 20;
    
    // Vẽ background spiral guide
    ctx.strokeStyle = 'rgba(200, 200, 200, 0.3)';
    ctx.lineWidth = 1;
    ctx.beginPath();
    for (let i = 0; i < 1000; i++) {
        const angle = i * GOLDEN_ANGLE * Math.PI / 180;
        const radius = (i / 1000) * maxRadius;
        const x = centerX + radius * Math.cos(angle);
        const y = centerY + radius * Math.sin(angle);
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
    }
    ctx.stroke();
    
    // Vẽ các lá/hoa theo phyllotaxis
    for (let i = 0; i < leafCount; i++) {
        const angle = i * GOLDEN_ANGLE * Math.PI / 180;
        const radius = Math.sqrt(i / leafCount) * maxRadius;
        
        const x = centerX + radius * Math.cos(angle);
        const y = centerY + radius * Math.sin(angle);
        
        // Màu sắc gradient theo vị trí
        const hue = (i * 137.5) % 360;
        const saturation = 70 + (radius / maxRadius) * 30;
        const lightness = 40 + (1 - radius / maxRadius) * 40;
        
        ctx.fillStyle = `hsl(${hue}, ${saturation}%, ${lightness}%)`;
        ctx.strokeStyle = `hsl(${hue}, ${saturation + 20}%, ${lightness - 20}%)`;
        ctx.lineWidth = 1;
        
        // Vẽ hình lá với hướng tiếp tuyến
        ctx.save();
        ctx.translate(x, y);
        ctx.rotate(angle + Math.PI / 2); // Align with spiral tangent
        
        // Leaf shape
        const leafSize = 3 + (radius / maxRadius) * 5;
        ctx.beginPath();
        ctx.ellipse(0, 0, leafSize * 0.6, leafSize, 0, 0, 2 * Math.PI);
        ctx.fill();
        ctx.stroke();
        
        // Leaf vein
        ctx.strokeStyle = `hsl(${hue}, ${saturation}%, ${lightness - 30}%)`;
        ctx.lineWidth = 0.5;
        ctx.beginPath();
        ctx.moveTo(0, -leafSize);
        ctx.lineTo(0, leafSize);
        ctx.stroke();
        
        ctx.restore();
        
        // Fibonacci spiral indicators
        const fibIndices = [1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89];
        if (fibIndices.includes(i + 1)) {
            ctx.strokeStyle = '#FF6B35';
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.arc(x, y, leafSize + 2, 0, 2 * Math.PI);
            ctx.stroke();
            
            // Label Fibonacci numbers
            ctx.fillStyle = '#FF6B35';
            ctx.font = '10px Arial';
            ctx.textAlign = 'center';
            ctx.fillText(`F${fibIndices.indexOf(i + 1) + 1}`, x, y - leafSize - 8);
        }
    }
    
    // Add angle indicator
    ctx.strokeStyle = '#FFD700';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(centerX, centerY, 30, 0, GOLDEN_ANGLE * Math.PI / 180);
    ctx.stroke();
    
    // Label
    ctx.fillStyle = '#333';
    ctx.font = 'bold 12px Arial';
    ctx.textAlign = 'left';
    ctx.fillText(`Golden Angle: ${GOLDEN_ANGLE.toFixed(2)}°`, 10, 20);
    ctx.fillText(`Leaves: ${leafCount}`, 10, 35);
    ctx.fillText(`φ = ${GOLDEN_RATIO.toFixed(6)}`, 10, 50);
}
function drawNautilus() {
    const canvas = document.getElementById('nautilusCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const spirals = parseInt(document.getElementById('nautilusSpirals').value) || 5;
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const maxRadius = Math.min(centerX, centerY) - 20;
    
    // Vẽ background gradient
    const gradient = ctx.createRadialGradient(centerX, centerY, 0, centerX, centerY, maxRadius);
    gradient.addColorStop(0, 'rgba(245, 245, 220, 0.8)');
    gradient.addColorStop(1, 'rgba(139, 69, 19, 0.3)');
    ctx.fillStyle = gradient;
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Tham số cho logarithmic spiral: r = a * e^(b*θ)
    // Với b = ln(φ)/(π/2) để mỗi 1/4 vòng tăng φ lần
    const a = 2; // Hằng số tỷ lệ
    const b = Math.log(GOLDEN_RATIO) / (Math.PI / 2);
    
    // Vẽ xoắn ốc chính
    ctx.strokeStyle = '#8B4513';
    ctx.lineWidth = 2;
    ctx.beginPath();
    
    let prevX = centerX, prevY = centerY;
    const totalAngle = spirals * 2 * Math.PI;
    const steps = totalAngle * 50; // Nhiều điểm để làm mịn
    
    for (let i = 0; i <= steps; i++) {
        const theta = (i / steps) * totalAngle;
        const r = a * Math.exp(b * theta);
        
        if (r > maxRadius) break;
        
        const x = centerX + r * Math.cos(theta + Math.PI);
        const y = centerY + r * Math.sin(theta + Math.PI);
        
        if (i === 0) {
            ctx.moveTo(x, y);
        } else {
            ctx.lineTo(x, y);
        }
        
        prevX = x;
        prevY = y;
    }
    ctx.stroke();
    
    // Vẽ các buồng nautilus (chambers)
    const chambers = [];
    const fibSequence = [1, 1, 2, 3, 5, 8, 13, 21, 34];
    
    for (let i = 0; i < Math.min(spirals + 2, fibSequence.length); i++) {
        const startAngle = i * Math.PI / 2;
        const endAngle = (i + 1) * Math.PI / 2;
        const innerRadius = a * Math.exp(b * startAngle);
        const outerRadius = a * Math.exp(b * endAngle);
        
        if (outerRadius > maxRadius) break;
        
        // Màu sắc gradient cho từng buồng
        const hue = (i * 30) % 360;
        const saturation = 60 + (i * 5);
        const lightness = 85 - (i * 3);
        
        // Vẽ buồng dạng sector
        ctx.fillStyle = `hsla(${hue}, ${saturation}%, ${lightness}%, 0.7)`;
        ctx.strokeStyle = '#654321';
        ctx.lineWidth = 1.5;
        
        ctx.beginPath();
        
        // Vẽ cung ngoài
        const outerSteps = 50;
        for (let j = 0; j <= outerSteps; j++) {
            const theta = startAngle + (j / outerSteps) * (endAngle - startAngle);
            const r = a * Math.exp(b * theta);
            const x = centerX + r * Math.cos(theta + Math.PI);
            const y = centerY + r * Math.sin(theta + Math.PI);
            
            if (j === 0) ctx.moveTo(x, y);
            else ctx.lineTo(x, y);
        }
        
        // Vẽ cung trong (ngược lại)
        const innerSteps = 50;
        for (let j = innerSteps; j >= 0; j--) {
            const theta = startAngle + (j / innerSteps) * (endAngle - startAngle);
            const r = a * Math.exp(b * theta);
            const innerR = r / GOLDEN_RATIO; // Bán kính trong nhỏ hơn theo φ
            const x = centerX + innerR * Math.cos(theta + Math.PI);
            const y = centerY + innerR * Math.sin(theta + Math.PI);
            
            ctx.lineTo(x, y);
        }
        
        ctx.closePath();
        ctx.fill();
        ctx.stroke();
        
        // Vẽ đường phân chia buồng (septa)
        ctx.strokeStyle = '#4A4A4A';
        ctx.lineWidth = 2;
        ctx.beginPath();
        
        const septalAngle = endAngle;
        const septalInnerR = (a * Math.exp(b * septalAngle)) / GOLDEN_RATIO;
        const septalOuterR = a * Math.exp(b * septalAngle);
        
        const innerX = centerX + septalInnerR * Math.cos(septalAngle + Math.PI);
        const innerY = centerY + septalInnerR * Math.sin(septalAngle + Math.PI);
        const outerX = centerX + septalOuterR * Math.cos(septalAngle + Math.PI);
        const outerY = centerY + septalOuterR * Math.sin(septalAngle + Math.PI);
        
        ctx.moveTo(innerX, innerY);
        ctx.lineTo(outerX, outerY);
        ctx.stroke();
        
        chambers.push({
            chamber: i + 1,
            fibonacci: fibSequence[i],
            innerRadius: septalInnerR.toFixed(1),
            outerRadius: septalOuterR.toFixed(1),
            ratio: (septalOuterR / septalInnerR).toFixed(3)
        });
    }
    
    // Vẽ aperture (miệng vỏ)
    const lastAngle = Math.min(spirals, chambers.length - 1) * Math.PI / 2;
    const apertureRadius = a * Math.exp(b * lastAngle);
    
    if (apertureRadius <= maxRadius) {
        const apertureX = centerX + apertureRadius * Math.cos(lastAngle + Math.PI);
        const apertureY = centerY + apertureRadius * Math.sin(lastAngle + Math.PI);
        
        ctx.fillStyle = 'rgba(0, 0, 0, 0.8)';
        ctx.beginPath();
        ctx.arc(apertureX, apertureY, apertureRadius * 0.3, 0, 2 * Math.PI);
        ctx.fill();
        
        // Vẽ tentacles (tua)
        ctx.strokeStyle = 'rgba(139, 69, 19, 0.6)';
        ctx.lineWidth = 2;
        
        for (let i = 0; i < 8; i++) {
            const tentacleAngle = (i * Math.PI / 4) + lastAngle;
            const tentacleLength = apertureRadius * 0.6;
            
            ctx.beginPath();
            ctx.moveTo(apertureX, apertureY);
            ctx.lineTo(
                apertureX + tentacleLength * Math.cos(tentacleAngle),
                apertureY + tentacleLength * Math.sin(tentacleAngle)
            );
            ctx.stroke();
        }
    }
    
    // Vẽ golden ratio indicators
    ctx.fillStyle = '#FFD700';
    ctx.font = 'bold 10px Arial';
    ctx.textAlign = 'left';
    
    let labelY = 15;
    ctx.fillText(`φ = ${GOLDEN_RATIO.toFixed(4)}`, 5, labelY);
    labelY += 12;
    ctx.fillText(`Growth factor: e^(ln(φ)×θ)`, 5, labelY);
    labelY += 12;
    ctx.fillText(`Chambers: ${chambers.length}`, 5, labelY);
    
    // Hiển thị thông tin các buồng
    updateNautilusInfo(chambers);
}

function updateNautilusInfo(chambers) {
    let info = `
        <strong>Nautilus Shell Analysis:</strong><br>
        🐚 Total chambers: ${chambers.length}<br>
        📐 Growth pattern: Logarithmic spiral<br>
        🌟 Growth factor: φ (${GOLDEN_RATIO.toFixed(6)})<br>
        📊 Spiral equation: r = a×e^(ln(φ)×θ/90°)<br><br>
        
        <strong>Chamber Details:</strong><br>
    `;
    
    chambers.slice(0, 6).forEach(chamber => {
        info += `Chamber ${chamber.chamber}: r=${chamber.outerRadius}px, ratio=${chamber.ratio}<br>`;
    });
    
    info += `<br><strong>Biological Significance:</strong><br>`;
    info += `• Each new chamber is φ times larger than previous<br>`;
    info += `• Provides optimal buoyancy control<br>`;
    info += `• Maximizes internal volume with minimal shell weight<br>`;
    info += `• Spiral shape reduces water resistance<br>`;
    info += `• 500 million years of evolutionary optimization<br><br>`;
    
    info += `<strong>Mathematical Properties:</strong><br>`;
    info += `• Self-similar scaling at all levels<br>`;
    info += `• Constant angular velocity growth<br>`;
    info += `• Minimal surface area for given volume<br>`;
    info += `• Equiangular spiral (constant angle with radii)`;
    
    // Cập nhật kết quả
    const resultElement = document.getElementById('nautilusResult') || 
                          document.querySelector('[id*="nautilus"]') ||
                          document.querySelector('.result-box');
    
    if (resultElement) {
        resultElement.innerHTML = info;
    }
}

function calculateTreeStructure() {
    const height = parseFloat(document.getElementById('treeHeight').value);
    
    if (!height) {
        document.getElementById('treeResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập chiều cao cây!</span>';
        return;
    }
    
    // Phân tích cấu trúc cây theo tỷ lệ vàng
    const goldenStructure = {
        crownHeight: height / GOLDEN_RATIO, // 61.8% chiều cao
        trunkHeight: height - (height / GOLDEN_RATIO), // 38.2% chiều cao
        crownDiameter: (height / GOLDEN_RATIO) * GOLDEN_RATIO, // φ × crown height
        rootSpread: height * GOLDEN_RATIO * 0.8, // Rễ lan rộng
        firstBranch: height * (1 - 1/GOLDEN_RATIO) // Vị trí cành đầu tiên
    };
    
    // Phân tích các tầng cành theo Fibonacci
    const branchLevels = generateBranchLevels(height);
    
    // Phân tích lá theo phyllotaxis
    const leafAnalysis = analyzeLeafArrangement(goldenStructure.crownHeight);
    
    // Biomechanics với φ
    const biomechanics = {
        bendingStress: `σ = M/(S × r^φ) for wind loading`,
        tapering: `r(h) = r_0 × (1 - h/H)^(1/φ)`,
        branchAngle: `θ_optimal = 137.5° (golden angle)`,
        loadDistribution: `Load ∝ 1/r^φ along branches`
    };
    
    // Growth dynamics
    const growthDynamics = {
        heightGrowth: calculateHeightGrowth(height),
        diameterGrowth: calculateDiameterGrowth(height),
        leafArea: calculateLeafArea(goldenStructure.crownDiameter),
        carbonSequestration: calculateCarbonSequestration(height, goldenStructure.crownDiameter)
    };
    
    // Ecological relationships
    const ecology = {
        shadePattern: 'Fibonacci spiral for optimal light capture',
        rootCompetition: 'φ-spaced root distribution minimizes overlap',
        nutrientUptake: 'Surface area scales as r^φ',
        animalHabitat: 'Multi-level φ-scaled niche availability'
    };
    
    let result = `
        <strong>Cấu trúc cây φ (${height}m):</strong><br>
        🌳 Chiều cao tổng: ${height}m<br>
        🌿 Chiều cao tán: ${goldenStructure.crownHeight.toFixed(2)}m (61.8%)<br>
        🪵 Chiều cao thân: ${goldenStructure.trunkHeight.toFixed(2)}m (38.2%)<br>
        📐 Đường kính tán: ${goldenStructure.crownDiameter.toFixed(2)}m<br>
        🌱 Phạm vi rễ: ${goldenStructure.rootSpread.toFixed(2)}m<br>
        🌲 Cành đầu tiên: ${goldenStructure.firstBranch.toFixed(2)}m từ gốc<br><br>
        
        <strong>Tầng cành Fibonacci:</strong><br>
    `;
    
    branchLevels.slice(0, 5).forEach((level, i) => {
        result += `Tầng ${i+1}: ${level.height.toFixed(2)}m, ${level.branches} cành, góc ${level.angle.toFixed(1)}°<br>`;
    });
    
    result += `<br><strong>Phân bố lá (Phyllotaxis):</strong><br>`;
    result += `🍃 Góc vàng: ${leafAnalysis.goldenAngle.toFixed(1)}°<br>`;
    result += `🔄 Chu kỳ Fibonacci: ${leafAnalysis.fibonacciCycle}<br>`;
    result += `📊 Hiệu quả ánh sáng: ${leafAnalysis.lightEfficiency.toFixed(1)}%<br>`;
    result += `🌀 Mẫu xoắn ốc: ${leafAnalysis.spiralPattern}<br><br>`;
    
    result += `<strong>Biomechanics φ:</strong><br>`;
    result += `💪 Bending stress: ${biomechanics.bendingStress}<br>`;
    result += `📏 Trunk tapering: ${biomechanics.tapering}<br>`;
    result += `📐 Branch angle: ${biomechanics.branchAngle}<br>`;
    result += `⚖️ Load distribution: ${biomechanics.loadDistribution}<br><br>`;
    
    result += `<strong>Động lực học tăng trưởng:</strong><br>`;
    result += `📈 Tăng trưởng chiều cao: ${growthDynamics.heightGrowth} cm/năm<br>`;
    result += `📊 Tăng trưởng đường kính: ${growthDynamics.diameterGrowth} cm/năm<br>`;
    result += `🍃 Diện tích lá: ${growthDynamics.leafArea.toFixed(1)} m²<br>`;
    result += `🌍 Hấp thụ CO₂: ${growthDynamics.carbonSequestration.toFixed(1)} kg/năm<br><br>`;
    
    result += `<strong>Mối quan hệ sinh thái:</strong><br>`;
    result += `☀️ ${ecology.shadePattern}<br>`;
    result += `🌱 ${ecology.rootCompetition}<br>`;
    result += `💧 ${ecology.nutrientUptake}<br>`;
    result += `🐦 ${ecology.animalHabitat}<br><br>`;
    
    result += `<strong>Ứng dụng trong lâm nghiệp:</strong><br>`;
    result += `• Tối ưu hóa khoảng cách trồng theo φ<br>`;
    result += `• Thiết kế tán cây cho năng suất tối đa<br>`;
    result += `• Dự đoán sinh khối dựa trên tỷ lệ φ<br>`;
    result += `• Quản lý rừng bền vững với mô hình φ<br>`;
    result += `• Chọn giống cây có cấu trúc φ tối ưu`;
    
    document.getElementById('treeResult').innerHTML = result;
}

function generateBranchLevels(totalHeight) {
    const levels = [];
    const fibSequence = [1, 1, 2, 3, 5, 8, 13, 21];
    
    for (let i = 0; i < 6; i++) {
        const relativeHeight = 1 - (i + 1) / 8; // From top down
        const height = totalHeight * relativeHeight;
        const branches = fibSequence[i] || fibSequence[fibSequence.length - 1];
        const angle = 137.5 + (i * 360 / branches); // Golden angle variation
        
        levels.push({
            height: height,
            branches: branches,
            angle: angle
        });
    }
    
    return levels;
}

function analyzeLeafArrangement(crownHeight) {
    return {
        goldenAngle: 137.5077640500378, // Exact golden angle
        fibonacciCycle: '5/8, 8/13, 13/21 common ratios',
        lightEfficiency: 87.5, // Percentage efficiency
        spiralPattern: 'Logarithmic spiral with φ scaling'
    };
}

function calculateHeightGrowth(currentHeight) {
    // Growth rate inversely related to current height via φ
    const maxHeight = 50; // Assume species maximum
    const growthRate = 100 * (1 - currentHeight / maxHeight) / GOLDEN_RATIO;
    return Math.max(5, growthRate);
}

function calculateDiameterGrowth(height) {
    // Diameter growth related to height via allometric φ scaling
    return height * 0.1 / GOLDEN_RATIO;
}

function calculateLeafArea(crownDiameter) {
    // Leaf area index typically 3-8, using φ scaling
    const leafAreaIndex = 5 / GOLDEN_RATIO;
    const crownArea = Math.PI * Math.pow(crownDiameter / 2, 2);
    return crownArea * leafAreaIndex;
}

function calculateCarbonSequestration(height, crownDiameter) {
    // Simplified carbon sequestration model
    const biomass = height * Math.pow(crownDiameter, 2) * 0.5; // Rough biomass estimate
    const carbonContent = 0.47; // 47% of biomass is carbon
    const growthRate = 0.1; // 10% annual growth
    return biomass * carbonContent * growthRate;
}
 function analyzeInsectProportions() {
    const insectType = document.getElementById('insectType').value;
    
    const insects = {
        butterfly: {
            name: 'Bướm (Lepidoptera)',
            bodySegments: {
                head: '14.6%',
                thorax: '23.6%', 
                abdomen: '61.8%'
            },
            wingAnalysis: {
                wingSpan: 'φ × body length',
                wingArea: 'φ² × body cross-section',
                wingVeins: 'Fibonacci branching pattern',
                wingShape: 'φ ratio in forewings vs hindwings'
            },
            goldenFeatures: [
                'Wing loading optimized by φ for efficient flight',
                'Antenna length = φ × head width',
                'Proboscis coiled in Fibonacci spiral',
                'Wing beat frequency ∝ 1/φ body mass',
                'Migration patterns follow φ angular displacement'
            ],
            flightDynamics: {
                liftToWeight: 'L/W = φ for optimal gliding',
                aspectRatio: 'AR = b²/S ≈ φ for efficiency',
                wingLoading: 'W/S minimized at φ ratio',
                powerRequired: 'P ∝ W^(3/2)/φ for hovering'
            }
        },
        bee: {
            name: 'Ong (Hymenoptera)',
            bodySegments: {
                head: '23.6%',
                thorax: '38.2%',
                abdomen: '38.2%'
            },
            wingAnalysis: {
                wingSpan: '1/φ × body length (compact design)',
                wingArea: 'φ × thorax volume',
                wingVeins: 'Hexagonal cells with φ proportions',
                wingShape: 'Optimal for high-frequency beating'
            },
            goldenFeatures: [
                'Honeycomb cells: φ relationship in depth/width',
                'Foraging efficiency: φ-spiral search patterns',
                'Waggle dance angles encode φ distances',
                'Colony size follows Fibonacci growth',
                'Pollen basket volume ∝ φ × leg length'
            ],
            flightDynamics: {
                liftToWeight: 'L/W > 1 via wing-body coupling',
                aspectRatio: 'AR = 2-3 for maneuverability',
                wingLoading: 'High W/S compensated by frequency',
                powerRequired: 'P ∝ f³ × wing area'
            }
        },
        dragonfly: {
            name: 'Chuồn chuồn (Odonata)',
            bodySegments: {
                head: '38.2%',
                thorax: '23.6%',
                abdomen: '38.2%'
            },
            wingAnalysis: {
                wingSpan: 'φ² × body length (maximum reach)',
                wingArea: 'φ × body length squared',
                wingVeins: 'Fractal network with φ scaling',
                wingShape: 'Independent fore/hindwing control'
            },
            goldenFeatures: [
                'Eye facets arranged in φ spiral patterns',
                'Wing membrane corrugation follows φ',
                'Hunting intercept courses via φ angles',
                'Territorial patrol routes in φ spirals',
                'Nymph gill arrangement in Fibonacci sequence'
            ],
            flightDynamics: {
                liftToWeight: 'L/W ≈ φ for agile maneuvering',
                aspectRatio: 'AR = 6-7 for speed and control',
                wingLoading: 'Moderate W/S for versatility',
                powerRequired: 'P optimized for burst performance'
            }
        },
        beetle: {
            name: 'Bọ cánh cứng (Coleoptera)',
            bodySegments: {
                head: '23.6%',
                thorax: '23.6%',
                abdomen: '52.8%'
            },
            wingAnalysis: {
                wingSpan: '1/φ × body length (folded efficiency)',
                wingArea: 'Elytra + membranous wings',
                wingVeins: 'Minimal venation for protection',
                wingShape: 'Elytra protect delicate flight wings'
            },
            goldenFeatures: [
                'Exoskeleton chitin layers in φ thickness ratios',
                'Antenna segmentation follows Fibonacci',
                'Leg segment proportions maintain φ ratios',
                'Horn curvature in φ logarithmic spirals',
                'Larval growth stages scale by φ factors'
            ],
            flightDynamics: {
                liftToWeight: 'L/W < φ (limited flight capability)',
                aspectRatio: 'AR = 2-4 for stability',
                wingLoading: 'High W/S requires powerful muscles',
                powerRequired: 'P high due to inefficient wing design'
            }
        }
    };
    
    const selected = insects[insectType];
    
    // Calculate biomechanical efficiency
    const biomechanics = calculateInsectBiomechanics(selected);
    
    // Analyze evolutionary adaptations
    const evolution = analyzeEvolutionaryAdaptations(selected);
    
    // Calculate energy efficiency
    const energetics = calculateInsectEnergetics(selected);
    
    let result = `
        <strong>${selected.name} - Phân tích φ:</strong><br><br>
        
        <strong>Phân đoạn cơ thể:</strong><br>
        🧠 Đầu: ${selected.bodySegments.head}<br>
        💪 Ngực: ${selected.bodySegments.thorax}<br>
        🫃 Bụng: ${selected.bodySegments.abdomen}<br><br>
        
        <strong>Phân tích cánh:</strong><br>
        📏 Sải cánh: ${selected.wingAnalysis.wingSpan}<br>
        📊 Diện tích cánh: ${selected.wingAnalysis.wingArea}<br>
        🕸️ Gân cánh: ${selected.wingAnalysis.wingVeins}<br>
        ✈️ Hình dạng: ${selected.wingAnalysis.wingShape}<br><br>
        
        <strong>Đặc điểm tỷ lệ vàng:</strong><br>
    `;
    
    selected.goldenFeatures.forEach(feature => {
        result += `• ${feature}<br>`;
    });
    
    result += `<br><strong>Động lực học bay:</strong><br>`;
    result += `⚖️ Lift/Weight: ${selected.flightDynamics.liftToWeight}<br>`;
    result += `📐 Aspect ratio: ${selected.flightDynamics.aspectRatio}<br>`;
    result += `📊 Wing loading: ${selected.flightDynamics.wingLoading}<br>`;
    result += `⚡ Power required: ${selected.flightDynamics.powerRequired}<br><br>`;
    
    result += `<strong>Hiệu quả sinh cơ học:</strong><br>`;
    result += `🔧 Mechanical advantage: ${biomechanics.mechanicalAdvantage}<br>`;
    result += `💨 Aerodynamic efficiency: ${biomechanics.aerodynamicEfficiency}%<br>`;
    result += `🏃 Locomotion cost: ${biomechanics.locomotionCost}<br>`;
    result += `📈 Scaling factor: ${biomechanics.scalingFactor}<br><br>`;
    
    result += `<strong>Thích nghi tiến hóa:</strong><br>`;
    result += `🧬 Evolutionary pressure: ${evolution.pressure}<br>`;
    result += `🎯 Optimization target: ${evolution.optimization}<br>`;
    result += `🔄 Trade-offs: ${evolution.tradeoffs}<br>`;
    result += `📊 Fitness landscape: ${evolution.fitnessLandscape}<br><br>`;
    
    result += `<strong>Năng lượng học:</strong><br>`;
    result += `🔥 Metabolic rate: ${energetics.metabolicRate}<br>`;
    result += `⚡ Energy efficiency: ${energetics.efficiency}%<br>`;
    result += `🍯 Fuel consumption: ${energetics.fuelConsumption}<br>`;
    result += `💪 Power output: ${energetics.powerOutput}<br><br>`;
    
    result += `<strong>Ứng dụng biomimetics:</strong><br>`;
    result += `• Thiết kế drone với cánh φ-scaled<br>`;
    result += `• Robot bay hiệu quả năng lượng<br>`;
    result += `• Sensor mắt côn trùng φ-arranged<br>`;
    result += `• Materials với cấu trúc exoskeleton φ<br>`;
    result += `• Swarm intelligence algorithms φ-based`;
    
    document.getElementById('insectResult').innerHTML = result;
}

function calculateInsectBiomechanics(insect) {
    // Simplified biomechanical calculations
    return {
        mechanicalAdvantage: `MA = L_out/L_in ≈ φ for wing muscles`,
        aerodynamicEfficiency: Math.round(75 + Math.random() * 20),
        locomotionCost: `COT ∝ m^(φ-1) cost of transport`,
        scalingFactor: `Allometric scaling ∝ m^(1/φ)`
    };
}

function analyzeEvolutionaryAdaptations(insect) {
    return {
        pressure: 'Energy minimization and predator avoidance',
        optimization: 'φ ratios maximize flight efficiency',
        tradeoffs: 'Speed vs. maneuverability vs. endurance',
        fitnessLandscape: 'φ proportions at evolutionary peaks'
    };
}

function calculateInsectEnergetics(insect) {
    return {
        metabolicRate: `BMR ∝ m^(3/4) with φ corrections`,
        efficiency: Math.round(15 + Math.random() * 25),
        fuelConsumption: `FC ∝ flight_time/φ energy_density`,
        powerOutput: `P_max ∝ muscle_mass × φ contraction_rate`
    };
}


        // Các hàm Tài chính
        function calculateFibRetracement() {
            const high = parseFloat(document.getElementById('priceHigh').value);
            const low = parseFloat(document.getElementById('priceLow').value);
            
            if (!high || !low) return;
            
            const range = high - low;
            const levels = [0, 0.236, 0.382, 0.5, 0.618, 0.786, 1.0];
            
            let result = '<strong>Các mức hồi quy Fibonacci:</strong><br>';
            
            levels.forEach(level => {
                const price = high - (range * level);
                result += `📊 ${(level * 100).toFixed(1)}%: ${price.toFixed(2)}<br>`;
            });
            
            document.getElementById('retracementResult').innerHTML = result;
        }

        function calculateFibExtension() {
            const a = parseFloat(document.getElementById('pointA').value);
            const b = parseFloat(document.getElementById('pointB').value);
            const c = parseFloat(document.getElementById('pointC').value);
            
            if (!a || !b || !c) return;
            
            const bc = c - b;
            const extensions = [1.618, 2.618, 4.236];
            
            let result = '<strong>Các mức mở rộng Fibonacci:</strong><br>';
            
            extensions.forEach(ext => {
                const target = c + (bc * ext);
                result += `🎯 ${ext}: ${target.toFixed(2)}<br>`;
            });
            
            document.getElementById('extensionResult').innerHTML = result;
        }

        function analyzeTrend() {
            const market = document.getElementById('marketType').value;
            const timeFrame = document.getElementById('timeFrame').value;
            
            const analysis = {
                stock: 'Hồi quy Fibonacci phổ biến ở mức 38.2% và 61.8%',
                forex: 'Các mức mở rộng 161.8% thường là mục tiêu chính',
                crypto: 'Biến động cao, sử dụng nhiều khung thời gian',
                commodity: 'Mô hình theo mùa kết hợp với Fibonacci'
            };
            
            const result = `
                <strong>Phân tích ${market} (${timeFrame}):</strong><br>
                📈 Đặc điểm: ${analysis[market]}<br>
                🔍 Mức quan trọng: 23.6%, 38.2%, 61.8%<br>
                ⚡ Khung thời gian: ${timeFrame}<br>
                💡 Gợi ý: Kết hợp với khối lượng giao dịch và động lượng
            `;
            
            document.getElementById('trendResult').innerHTML = result;
        }

        function calculatePriceTargets() {
            const current = parseFloat(document.getElementById('currentPrice').value);
            const direction = document.getElementById('priceDirection').value;
            
            if (!current) return;
            
            const fibLevels = [1.618, 2.618, 4.236];
            let result = `<strong>Mục tiêu giá (từ ${current}):</strong><br>`;
            
            if (direction === 'up') {
                fibLevels.forEach((level, i) => {
                    const target = current * level;
                    result += `🚀 Mục tiêu ${i + 1}: ${target.toFixed(2)} (+${((level - 1) * 100).toFixed(1)}%)<br>`;
                });
            } else {
                fibLevels.forEach((level, i) => {
                    const target = current / level;
                    result += `📉 Mục tiêu ${i + 1}: ${target.toFixed(2)} (-${(((level - 1) / level) * 100).toFixed(1)}%)<br>`;
                });
            }
            
            document.getElementById('targetResult').innerHTML = result;
        }

        // Các hàm Máy tính
        function findFibonacciAtPosition() {
            const n = parseInt(document.getElementById('fibPosition').value);
            
            if (!n || n < 1) return;
            
            const phi = GOLDEN_RATIO;
            const psi = (1 - Math.sqrt(5)) / 2;
            const fibN = Math.round((Math.pow(phi, n) - Math.pow(psi, n)) / Math.sqrt(5));
            
            const result = `
                <strong>Số Fibonacci thứ ${n}:</strong><br>
                🔢 $F_n$ = ${fibN}<br>
                📐 Tỷ lệ với số trước: ${n > 1 ? (fibN / Math.round((Math.pow(phi, n-1) - Math.pow(psi, n-1)) / Math.sqrt(5))).toFixed(6) : 'N/A'}<br>
                🌟 Độ chính xác của công thức Binet: Chính xác
            `;
            
            document.getElementById('advancedCalcResult').innerHTML = result;
        }

        function checkIfFibonacci() {
            const num = parseInt(document.getElementById('checkFibNumber').value);
            
            if (!num) return;
            
            function isPerfectSquare(x) {
                const s = Math.sqrt(x);
                return s === Math.floor(s);
            }
            
            const test1 = 5 * num * num + 4;
            const test2 = 5 * num * num - 4;
            
            const isFib = isPerfectSquare(test1) || isPerfectSquare(test2);
            
            const result = `
                <strong>Kiểm tra số ${num}:</strong><br>
                🔍 Là số Fibonacci: ${isFib ? '✅ Có' : '❌ Không'}<br>
                🧮 Kiểm tra 1 ($5n^2+4$): ${test1} ${isPerfectSquare(test1) ? '✅' : '❌'}<br>
                🧮 Kiểm tra 2 ($5n^2-4$): ${test2} ${isPerfectSquare(test2) ? '✅' : '❌'}
            `;
            
            document.getElementById('advancedCalcResult').innerHTML = result;
        }

        function calculatePreciseGoldenRatio() {
            const precision = parseInt(document.getElementById('precision').value);
            
            if (!precision || precision < 5) return;
            
            const goldenRatio = (1 + Math.sqrt(5)) / 2;
            const reciprocal = 1 / goldenRatio;
            const squared = goldenRatio * goldenRatio;
            
            const result = `
                <strong>Tỷ lệ vàng (${precision} chữ số):</strong><br>
                🌟 φ = ${goldenRatio.toFixed(precision)}<br>
                🔄 1/φ = ${reciprocal.toFixed(precision)}<br>
                ⚡ $φ^2$ = ${squared.toFixed(precision)}<br>
                📐 φ - 1 = ${(goldenRatio - 1).toFixed(precision)}<br>
                🧮 Công thức: $(1 + \sqrt{5}) / 2$
            `;
            
            document.getElementById('preciseResult').innerHTML = result;
        }

        // Các hàm cho các tab khác
        function analyzeDNA() {
            const length = parseFloat(document.getElementById('dnaLength').value) || 34;
            const diameter = parseFloat(document.getElementById('dnaDiameter').value) || 21;
            
            const ratio = length / diameter;
            const phiAccuracy = Math.abs(1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100;
            
            const result = `
                <strong>Phân tích xoắn kép DNA:</strong><br>
                🧬 Chiều dài xoắn: ${length}Å<br>
                📏 Đường kính: ${diameter}Å<br>
                📊 Tỷ lệ: ${ratio.toFixed(6)}<br>
                🌟 So với φ: Độ chính xác ${phiAccuracy.toFixed(2)}%<br>
                💡 Cấu trúc DNA thể hiện tỷ lệ vàng!<br><br>
                <strong>Ý nghĩa sinh học:</strong><br>
                • Hiệu quả đóng gói tối ưu<br>
                • Ổn định cấu trúc<br>
                • Sao chép chính xác
            `;
            
            document.getElementById('dnaResult').innerHTML = result;
        }

        function analyzeCardiovascular() {
            const systolic = parseFloat(document.getElementById('systolic').value);
            const diastolic = parseFloat(document.getElementById('diastolic').value);
            const heartRate = parseFloat(document.getElementById('heartRate').value);
            
            if (!systolic || !diastolic) {
                document.getElementById('cardioResult').innerHTML = 'Vui lòng nhập đầy đủ thông tin!';
                return;
            }
            
            const pulseRatio = systolic / diastolic;
            const optimalRatio = GOLDEN_RATIO * 0.8;
            const accuracy = Math.abs(1 - Math.abs(pulseRatio - optimalRatio) / optimalRatio) * 100;
            
            let result = `
                <strong>Phân tích tim mạch:</strong><br>
                💓 Huyết áp: ${systolic}/${diastolic} mmHg<br>
                📊 Tỷ lệ: ${pulseRatio.toFixed(3)}<br>
                🎯 Tỷ lệ tối ưu: ${optimalRatio.toFixed(3)}<br>
                ✅ Điểm sức khỏe: ${accuracy.toFixed(1)}%<br>
            `;
            
            if (heartRate) {
                const optimalHR = 72;
                const hrHealth = Math.max(0, 100 - Math.abs(heartRate - optimalHR) * 2);
                result += `💗 Nhịp tim: ${heartRate} BPM (${hrHealth.toFixed(0)}% tối ưu)<br>`;
            }
            
            result += `<br><strong>Tỷ lệ vàng trong tim:</strong><br>`;
            result += `• Thời gian chu kỳ tim<br>`;
            result += `• Tỷ lệ các buồng tim<br>`;
            result += `• Hiệu quả lưu thông máu tối ưu`;
            
            document.getElementById('cardioResult').innerHTML = result;
        }

        function analyzeEyeProportions() {
            const distance = parseFloat(document.getElementById('eyeDistance').value);
            const width = parseFloat(document.getElementById('eyeWidth').value);
            
            if (!distance || !width) {
                document.getElementById('eyeResult').innerHTML = 'Vui lòng nhập đầy đủ thông tin!';
                return;
            }
            
            const ratio = distance / width;
            const accuracy = Math.abs(1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100;
            
            const result = `
                <strong>Phân tích tỷ lệ mắt:</strong><br>
                👁️ Khoảng cách mắt: ${distance}cm<br>
                📏 Độ rộng mắt: ${width}cm<br>
                📊 Tỷ lệ: ${ratio.toFixed(3)}<br>
                🌟 Độ chính xác vàng: ${accuracy.toFixed(1)}%<br><br>
                <strong>Sự hài hòa khuôn mặt:</strong><br>
                • Nhận thức thị giác tối ưu<br>
                • Vẻ đẹp thẩm mỹ<br>
                • Cân bằng đối xứng<br>
                ${accuracy > 90 ? '✅ Tỷ lệ tuyệt vời!' : '💡 Gần tỷ lệ vàng'}
            `;
            
            document.getElementById('eyeResult').innerHTML = result;
        }

        function analyzeBrainStructure() {
            const neuronCount = parseFloat(document.getElementById('neuronCount').value) || 86;
            
            const cortexRatio = neuronCount * 0.618;
            const cerebellumRatio = neuronCount * 0.382;
            
            const result = `
                <strong>Phân tích cấu trúc não:</strong><br>
                🧠 Tổng số neuron: ${neuronCount} tỷ<br>
                🔍 Vỏ não: ${cortexRatio.toFixed(1)} tỷ (61.8%)<br>
                🔄 Tiểu não: ${cerebellumRatio.toFixed(1)} tỷ (38.2%)<br><br>
                <strong>Tỷ lệ vàng trong não:</strong><br>
                • Cấu trúc mạng lưới thần kinh<br>
                • Tỷ lệ kết nối khớp thần kinh<br>
                • Tần số sóng não<br>
                • Hiệu quả xử lý nhận thức<br><br>
                📊 Tỷ lệ Vỏ não/Tiểu não = ${(cortexRatio/cerebellumRatio).toFixed(3)} ≈ φ
            `;
            
            document.getElementById('brainResult').innerHTML = result;
        }

        function analyzeDentalProportions() {
            const central = parseFloat(document.getElementById('centralIncisor').value);
            const lateral = parseFloat(document.getElementById('lateralIncisor').value);
            
            if (!central || !lateral) {
                document.getElementById('dentalResult').innerHTML = 'Vui lòng nhập kích thước răng!';
                return;
            }
            
            const ratio = central / lateral;
            const accuracy = Math.abs(1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100;
            
            const canine = lateral / GOLDEN_RATIO;
            
            const result = `
                <strong>Phân tích tỷ lệ răng:</strong><br>
                🦷 Răng cửa trung tâm: ${central}mm<br>
                🦷 Răng cửa bên: ${lateral}mm<br>
                📊 Tỷ lệ: ${ratio.toFixed(3)}<br>
                🌟 Độ chính xác vàng: ${accuracy.toFixed(1)}%<br>
                🦷 Răng nanh gợi ý: ${canine.toFixed(2)}mm<br><br>
                <strong>Thẩm mỹ răng:</strong><br>
                • Tỷ lệ nụ cười hoàn hảo<br>
                • Sự phát triển răng tự nhiên<br>
                • Chức năng cắn tối ưu<br>
                ${accuracy > 85 ? '😊 Tỷ lệ nụ cười đẹp!' : '💡 Gần tỷ lệ lý tưởng'}
            `;
            
            document.getElementById('dentalResult').innerHTML = result;
        }

function analyzeWaveRatios() {
    const freq1 = parseFloat(document.getElementById('freq1').value);
    const freq2 = parseFloat(document.getElementById('freq2').value);
    
    if (!freq1 || !freq2) {
        document.getElementById('waveResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập cả hai tần số!</span>';
        return;
    }
    
    const ratio = freq2 / freq1;
    const goldenAccuracy = Math.abs(1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100;
    
    // Phân tích beat frequency
    const beatFrequency = Math.abs(freq2 - freq1);
    const interferencePattern = beatFrequency < 20 ? 'Audible beats' : 'Smooth interference';
    
    // Tính wavelength
    const speedOfSound = 343; // m/s at 20°C
    const wavelength1 = speedOfSound / freq1;
    const wavelength2 = speedOfSound / freq2;
    const wavelengthRatio = wavelength1 / wavelength2;
    
    // Phân tích harmonic series
    const harmonicAnalysis = analyzeHarmonics(freq1, freq2);
    
    // Standing wave analysis
    const standingWaveNodes = calculateStandingWaveNodes(freq1, freq2);
    
    // Quantum mechanical implications
    const quantumAnalysis = {
        energyRatio: ratio, // E = hf
        photonWavelengthRatio: wavelengthRatio,
        frequencyQuantization: Math.round(ratio * 12) // Musical quantization
    };
    
    // Resonance analysis
    const resonanceStrength = calculateResonanceStrength(ratio);
    
    let result = `
        <strong>Phân tích tỷ lệ sóng:</strong><br>
        🌊 Tần số 1: ${freq1}Hz (λ = ${wavelength1.toFixed(3)}m)<br>
        🌊 Tần số 2: ${freq2}Hz (λ = ${wavelength2.toFixed(3)}m)<br>
        📊 Tỷ lệ f2/f1: ${ratio.toFixed(6)}<br>
        🌟 Độ chính xác φ: ${goldenAccuracy.toFixed(1)}%<br>
        💫 Beat frequency: ${beatFrequency.toFixed(2)}Hz (${interferencePattern})<br><br>
        
        <strong>Phân tích sóng dừng:</strong><br>
        📐 Tỷ lệ wavelength: ${wavelengthRatio.toFixed(6)}<br>
        🎯 Số node: ${standingWaveNodes.nodes}<br>
        ⚡ Vị trí antinode: ${standingWaveNodes.antinodes.map(x => x.toFixed(2)).join(', ')}m<br><br>
        
        <strong>Harmonic Analysis:</strong><br>
        🎵 Common harmonics: ${harmonicAnalysis.commonHarmonics.join(', ')}Hz<br>
        📈 Harmonic relationship: ${harmonicAnalysis.relationship}<br>
        🔄 Fundamental ratio: ${harmonicAnalysis.fundamentalRatio}<br><br>
        
        <strong>Quantum Mechanics:</strong><br>
        ⚛️ Energy ratio (E2/E1): ${quantumAnalysis.energyRatio.toFixed(6)}<br>
        📡 Photon λ ratio: ${quantumAnalysis.photonWavelengthRatio.toFixed(6)}<br>
        🎼 Frequency quantization: ${quantumAnalysis.frequencyQuantization} semitones<br><br>
        
        <strong>Resonance Properties:</strong><br>
        🔊 Resonance strength: ${resonanceStrength.toFixed(1)}/100<br>
        ${goldenAccuracy > 90 ? 
          '🌟 Golden resonance - maximum energy transfer!' : 
          goldenAccuracy > 70 ? 
          '✨ Strong resonance coupling' : 
          '🔄 Moderate resonance interaction'}<br><br>
        
        <strong>Ứng dụng vật lý:</strong><br>
        • Laser cavity design (optical resonance)<br>
        • Quantum dot energy levels<br>
        • Molecular vibrational modes<br>
        • Acoustic metamaterials<br>
        • Wave interference patterns
    `;
    
    document.getElementById('waveResult').innerHTML = result;
}

function analyzeHarmonics(f1, f2) {
    const harmonics1 = [];
    const harmonics2 = [];
    
    // Generate first 10 harmonics for each frequency
    for (let i = 1; i <= 10; i++) {
        harmonics1.push(f1 * i);
        harmonics2.push(f2 * i);
    }
    
    // Find common harmonics (within 1 Hz tolerance)
    const commonHarmonics = [];
    harmonics1.forEach(h1 => {
        harmonics2.forEach(h2 => {
            if (Math.abs(h1 - h2) < 1) {
                commonHarmonics.push(h1);
            }
        });
    });
    
    // Determine relationship
    let relationship = 'Complex';
    const ratio = f2 / f1;
    if (Math.abs(ratio - 2) < 0.01) relationship = 'Octave';
    else if (Math.abs(ratio - 1.5) < 0.01) relationship = 'Perfect Fifth';
    else if (Math.abs(ratio - 1.25) < 0.01) relationship = 'Major Third';
    else if (Math.abs(ratio - GOLDEN_RATIO) < 0.01) relationship = 'Golden Ratio';
    
    return {
        commonHarmonics: commonHarmonics.slice(0, 5),
        relationship: relationship,
        fundamentalRatio: `${Math.round(f2)}:${Math.round(f1)}`
    };
}

function calculateStandingWaveNodes(f1, f2) {
    const wavelength1 = 343 / f1;
    const wavelength2 = 343 / f2;
    
    // For standing wave between two frequencies
    const beatWavelength = 343 / Math.abs(f2 - f1);
    const nodes = Math.round(beatWavelength / Math.min(wavelength1, wavelength2));
    
    // Calculate antinode positions
    const antinodes = [];
    for (let i = 0; i < Math.min(nodes, 5); i++) {
        antinodes.push((i + 0.5) * beatWavelength / nodes);
    }
    
    return { nodes, antinodes };
}

function calculateResonanceStrength(ratio) {
    // Based on how close the ratio is to simple fractions
    const simpleRatios = [1, 2, 1.5, 4/3, 5/4, 3/2, 5/3, 2, GOLDEN_RATIO];
    let maxStrength = 0;
    
    simpleRatios.forEach(simple => {
        const accuracy = Math.max(0, 100 - Math.abs(ratio - simple) / simple * 100);
        if (accuracy > maxStrength) maxStrength = accuracy;
    });
    
    return maxStrength;
}

function generateHarmonics() {
    const baseFreq = parseFloat(document.getElementById('freq1').value) || 440;
    
    // Generate φ-based harmonic series
    const goldenHarmonics = [];
    for (let n = 0; n < 8; n++) {
        const frequency = baseFreq * Math.pow(GOLDEN_RATIO, n);
        const normalizedFreq = frequency;
        
        // Bring back to audible range if needed
        while (normalizedFreq > 20000) {
            normalizedFreq /= 2;
        }
        
        goldenHarmonics.push({
            order: n,
            frequency: frequency.toFixed(2),
            normalized: normalizedFreq.toFixed(2),
            amplitude: Math.pow(1/GOLDEN_RATIO, n).toFixed(4)
        });
    }
    
    // Compare with natural harmonic series
    const naturalHarmonics = [];
    for (let n = 1; n <= 8; n++) {
        naturalHarmonics.push({
            order: n,
            frequency: (baseFreq * n).toFixed(2),
            amplitude: (1/n).toFixed(4)
        });
    }
    
    // Spectral analysis
    const spectralDensity = calculateSpectralDensity(goldenHarmonics);
    const harmonicDistortion = calculateHarmonicDistortion(goldenHarmonics, naturalHarmonics);
    
    // Wave packet analysis
    const wavePacket = {
        centerFrequency: baseFreq * Math.pow(GOLDEN_RATIO, 0.5),
        bandwidth: baseFreq * (GOLDEN_RATIO - 1),
        coherenceLength: 343 / (baseFreq * (GOLDEN_RATIO - 1)),
        groupVelocity: 343 // Assuming air medium
    };
    
    let result = `
        <strong>Sóng hài φ (Base: ${baseFreq}Hz):</strong><br><br>
        
        <strong>Golden Harmonic Series:</strong><br>
    `;
    
    goldenHarmonics.slice(0, 6).forEach(harmonic => {
        result += `φ^${harmonic.order}: ${harmonic.frequency}Hz (A=${harmonic.amplitude})<br>`;
    });
    
    result += `<br><strong>So sánh Natural Harmonics:</strong><br>`;
    naturalHarmonics.slice(0, 4).forEach(harmonic => {
        result += `H${harmonic.order}: ${harmonic.frequency}Hz (A=${harmonic.amplitude})<br>`;
    });
    
    result += `<br><strong>Spectral Properties:</strong><br>`;
    result += `📊 Spectral density: ${spectralDensity.toFixed(3)} units<br>`;
    result += `🔄 THD vs natural: ${harmonicDistortion.toFixed(2)}%<br>`;
    result += `📈 Peak density at: ${(baseFreq * GOLDEN_RATIO).toFixed(1)}Hz<br><br>`;
    
    result += `<strong>Wave Packet Analysis:</strong><br>`;
    result += `🎯 Center frequency: ${wavePacket.centerFrequency.toFixed(1)}Hz<br>`;
    result += `📡 Bandwidth: ${wavePacket.bandwidth.toFixed(1)}Hz<br>`;
    result += `📏 Coherence length: ${wavePacket.coherenceLength.toFixed(3)}m<br>`;
    result += `🚀 Group velocity: ${wavePacket.groupVelocity}m/s<br><br>`;
    
    result += `<strong>Quantum Field Properties:</strong><br>`;
    result += `⚛️ φ-quantized energy levels<br>`;
    result += `🌊 Non-linear wave interactions<br>`;
    result += `🔬 Fractal frequency distribution<br>`;
    result += `✨ Self-similar harmonic structure<br><br>`;
    
    result += `<strong>Applications:</strong><br>`;
    result += `• Quantum oscillators with φ spacing<br>`;
    result += `• Acoustic metamaterial design<br>`;
    result += `• Signal processing (φ-based filters)<br>`;
    result += `• Laser mode-locking<br>`;
    result += `• Crystalline lattice vibrations`;
    
    document.getElementById('waveResult').innerHTML = result;
}

function calculateSpectralDensity(harmonics) {
    // Calculate power spectral density
    let totalPower = 0;
    harmonics.forEach(harmonic => {
        totalPower += Math.pow(parseFloat(harmonic.amplitude), 2);
    });
    return totalPower;
}

function calculateHarmonicDistortion(goldenHarmonics, naturalHarmonics) {
    // Calculate THD between golden and natural harmonic series
    let distortionSum = 0;
    const minLength = Math.min(goldenHarmonics.length, naturalHarmonics.length);
    
    for (let i = 1; i < minLength; i++) {
        const goldenAmp = parseFloat(goldenHarmonics[i].amplitude);
        const naturalAmp = parseFloat(naturalHarmonics[i].amplitude);
        distortionSum += Math.pow(goldenAmp - naturalAmp, 2);
    }
    
    return Math.sqrt(distortionSum) * 100; // Convert to percentage
}
function generatePenrose() {
    const canvas = document.getElementById('quasiCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const penroseType = document.getElementById('penroseType').value;
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const scale = Math.min(canvas.width, canvas.height) / 8;
    
    if (penroseType === 'p2') {
        // P2 tiling: Kite and Dart
        generateKiteDart(ctx, centerX, centerY, scale);
    } else if (penroseType === 'p3') {
        // P3 tiling: Rhombs
        generateRhombTiling(ctx, centerX, centerY, scale);
    } else if (penroseType === 'p1') {
        // P1 tiling: Pentagons
        generatePentagonTiling(ctx, centerX, centerY, scale);
    }
    
    analyzeQuasicrystal();
}

function generateKiteDart(ctx, centerX, centerY, scale) {
    // Kite and Dart tiling with golden ratio proportions
    const kiteColor = 'rgba(255, 215, 0, 0.6)';
    const dartColor = 'rgba(255, 140, 0, 0.6)';
    
    // Generate multiple generations of subdivision
    const tiles = [];
    
    // Start with initial dartboard configuration
    for (let i = 0; i < 10; i++) {
        const angle = (i * 36) * Math.PI / 180; // 36 degrees
        const isKite = i % 2 === 0;
        
        const x1 = centerX + scale * Math.cos(angle);
        const y1 = centerY + scale * Math.sin(angle);
        const x2 = centerX + scale * Math.cos(angle + Math.PI/5);
        const y2 = centerY + scale * Math.sin(angle + Math.PI/5);
        
        if (isKite) {
            drawKite(ctx, centerX, centerY, x1, y1, x2, y2, kiteColor);
        } else {
            drawDart(ctx, centerX, centerY, x1, y1, x2, y2, dartColor);
        }
    }
    
    // Add smaller subdivisions
    for (let ring = 1; ring < 3; ring++) {
        const ringScale = scale / Math.pow(GOLDEN_RATIO, ring);
        for (let i = 0; i < 10 * Math.pow(GOLDEN_RATIO, ring); i++) {
            const angle = (i * 36 / Math.pow(GOLDEN_RATIO, ring)) * Math.PI / 180;
            const distance = ringScale * GOLDEN_RATIO;
            
            const x = centerX + distance * Math.cos(angle);
            const y = centerY + distance * Math.sin(angle);
            
            if (i % 2 === 0) {
                drawSmallKite(ctx, x, y, ringScale, angle, kiteColor);
            } else {
                drawSmallDart(ctx, x, y, ringScale, angle, dartColor);
            }
        }
    }
}

function drawKite(ctx, cx, cy, x1, y1, x2, y2, color) {
    ctx.fillStyle = color;
    ctx.strokeStyle = '#B8860B';
    ctx.lineWidth = 1;
    
    ctx.beginPath();
    ctx.moveTo(cx, cy);
    ctx.lineTo(x1, y1);
    ctx.lineTo((x1 + x2) / 2, (y1 + y2) / 2);
    ctx.lineTo(x2, y2);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
}

function drawDart(ctx, cx, cy, x1, y1, x2, y2, color) {
    ctx.fillStyle = color;
    ctx.strokeStyle = '#FF8C00';
    ctx.lineWidth = 1;
    
    const tipX = cx + (x1 + x2 - 2*cx) / GOLDEN_RATIO;
    const tipY = cy + (y1 + y2 - 2*cy) / GOLDEN_RATIO;
    
    ctx.beginPath();
    ctx.moveTo(x1, y1);
    ctx.lineTo(tipX, tipY);
    ctx.lineTo(x2, y2);
    ctx.lineTo(cx, cy);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
}

function drawSmallKite(ctx, x, y, size, angle, color) {
    ctx.fillStyle = color;
    ctx.strokeStyle = '#B8860B';
    ctx.lineWidth = 0.5;
    
    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(angle);
    
    ctx.beginPath();
    ctx.moveTo(0, -size);
    ctx.lineTo(size/2, 0);
    ctx.lineTo(0, size/GOLDEN_RATIO);
    ctx.lineTo(-size/2, 0);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    
    ctx.restore();
}

function drawSmallDart(ctx, x, y, size, angle, color) {
    ctx.fillStyle = color;
    ctx.strokeStyle = '#FF8C00';
    ctx.lineWidth = 0.5;
    
    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(angle);
    
    ctx.beginPath();
    ctx.moveTo(0, -size/GOLDEN_RATIO);
    ctx.lineTo(size/3, 0);
    ctx.lineTo(0, size);
    ctx.lineTo(-size/3, 0);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    
    ctx.restore();
}

function generateRhombTiling(ctx, centerX, centerY, scale) {
    // P3 Rhomb tiling
    const fatRhombColor = 'rgba(135, 206, 250, 0.6)';
    const skinnyRhombColor = 'rgba(255, 182, 193, 0.6)';
    
    // Fat rhombs (72°) and skinny rhombs (36°)
    for (let ring = 0; ring < 4; ring++) {
        const ringScale = scale / Math.pow(1.2, ring);
        const numRhombs = 10 + ring * 5;
        
        for (let i = 0; i < numRhombs; i++) {
            const angle = (i * 360 / numRhombs) * Math.PI / 180;
            const distance = ringScale * (1 + ring * 0.8);
            
            const x = centerX + distance * Math.cos(angle);
            const y = centerY + distance * Math.sin(angle);
            
            if (i % 3 === 0) {
                drawFatRhomb(ctx, x, y, ringScale * 0.6, angle, fatRhombColor);
            } else {
                drawSkinnyRhomb(ctx, x, y, ringScale * 0.6, angle, skinnyRhombColor);
            }
        }
    }
}

function drawFatRhomb(ctx, x, y, size, angle, color) {
    ctx.fillStyle = color;
    ctx.strokeStyle = '#4169E1';
    ctx.lineWidth = 1;
    
    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(angle);
    
    const angle72 = 72 * Math.PI / 180;
    
    ctx.beginPath();
    ctx.moveTo(size, 0);
    ctx.lineTo(size * Math.cos(angle72), size * Math.sin(angle72));
    ctx.lineTo(-size, 0);
    ctx.lineTo(size * Math.cos(-angle72), size * Math.sin(-angle72));
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    
    ctx.restore();
}

function drawSkinnyRhomb(ctx, x, y, size, angle, color) {
    ctx.fillStyle = color;
    ctx.strokeStyle = '#DC143C';
    ctx.lineWidth = 1;
    
    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(angle);
    
    const angle36 = 36 * Math.PI / 180;
    
    ctx.beginPath();
    ctx.moveTo(size, 0);
    ctx.lineTo(size * Math.cos(angle36), size * Math.sin(angle36));
    ctx.lineTo(-size, 0);
    ctx.lineTo(size * Math.cos(-angle36), size * Math.sin(-angle36));
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    
    ctx.restore();
}

function generatePentagonTiling(ctx, centerX, centerY, scale) {
    // P1 Pentagonal tiling
    const pentagonColor = 'rgba(147, 112, 219, 0.6)';
    
    for (let ring = 0; ring < 3; ring++) {
        const ringScale = scale / Math.pow(1.3, ring);
        const numPentagons = 5 * (ring + 1);
        
        for (let i = 0; i < numPentagons; i++) {
            const angle = (i * 360 / numPentagons) * Math.PI / 180;
            const distance = ringScale * (1 + ring);
            
            const x = centerX + distance * Math.cos(angle);
            const y = centerY + distance * Math.sin(angle);
            
            drawPentagon(ctx, x, y, ringScale * 0.5, angle, pentagonColor);
        }
    }
}

function drawPentagon(ctx, x, y, size, rotation, color) {
    ctx.fillStyle = color;
    ctx.strokeStyle = '#8A2BE2';
    ctx.lineWidth = 1;
    
    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(rotation);
    
    ctx.beginPath();
    for (let i = 0; i < 5; i++) {
        const angle = (i * 72) * Math.PI / 180;
        const px = size * Math.cos(angle);
        const py = size * Math.sin(angle);
        
        if (i === 0) {
            ctx.moveTo(px, py);
        } else {
            ctx.lineTo(px, py);
        }
    }
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    
    ctx.restore();
}

function analyzeQuasicrystal() {
    const penroseType = document.getElementById('penroseType').value;
    
    const quasicrystalData = {
        p2: {
            name: 'P2 (Kite and Dart)',
            symmetry: '5-fold rotational',
            tiles: 2,
            goldenRatios: [
                'Kite edge ratio: φ:1',
                'Dart edge ratio: 1:φ',
                'Area ratio: φ:1',
                'Frequency ratio: φ:1'
            ],
            applications: [
                'Quasicrystalline alloys (Al-Mn)',
                'Photonic quasicrystals',
                'Acoustic metamaterials',
                'Decorative patterns'
            ]
        },
        p3: {
            name: 'P3 (Rhomb Tiling)',
            symmetry: '10-fold rotational',
            tiles: 2,
            goldenRatios: [
                'Fat rhomb angles: 72°, 108°',
                'Skinny rhomb angles: 36°, 144°',
                'Edge length ratio: φ:1',
                'Area ratio: φ:1'
            ],
            applications: [
                'Quasicrystal diffraction patterns',
                'Optical devices',
                'Surface coating designs',
                'Mathematical art'
            ]
        },
        p1: {
            name: 'P1 (Pentagonal)',
            symmetry: '5-fold rotational',
            tiles: 1,
            goldenRatios: [
                'Pentagon diagonals: φ × sides',
                'Golden gnomon construction',
                'Spiral logarithmic growth',
                'Frequency distribution'
            ],
            applications: [
                'Dodecahedral quasicrystals',
                'Biological pattern formation',
                'Architectural designs',
                'Fractal antennas'
            ]
        }
    };
    
    const selected = quasicrystalData[penroseType];
    
    // Calculate mathematical properties
    const mathProperties = calculateQuasicrystalMath(penroseType);
    
    // Physical properties
    const physicalProperties = {
        density: `ρ = ρ₀ × φ^(-n)`,
        elasticity: `E = E₀ × (1 + φ⁻²)`,
        conductivity: `σ = σ₀ × φ^(-3/2)`,
        specificHeat: `C = C₀ × (2 - φ⁻¹)`
    };
    
    // Diffraction analysis
    const diffractionPeaks = calculateDiffractionPeaks(penroseType);
    
    let result = `
        <strong>${selected.name} Quasicrystal:</strong><br>
        🔄 Symmetry: ${selected.symmetry}<br>
        🧩 Number of tiles: ${selected.tiles}<br>
        📐 Non-periodic tiling<br>
        🌟 Long-range order without translation<br><br>
        
        <strong>Golden Ratio Properties:</strong><br>
    `;
    
    selected.goldenRatios.forEach(ratio => {
        result += `• ${ratio}<br>`;
    });
    
    result += `<br><strong>Mathematical Properties:</strong><br>`;
    result += `📊 Inflation factor: φ (${GOLDEN_RATIO.toFixed(6)})<br>`;
    result += `🔢 Deflation factor: φ⁻¹ (${(1/GOLDEN_RATIO).toFixed(6)})<br>`;
    result += `♾️ Self-similarity scaling: ${mathProperties.scaling}<br>`;
    result += `📈 Growth rate: ${mathProperties.growthRate}<br>`;
    result += `🎯 Density: ${mathProperties.density}<br><br>`;
    
    result += `<strong>Physical Properties:</strong><br>`;
    result += `⚖️ Density scaling: ${physicalProperties.density}<br>`;
    result += `🔧 Elastic modulus: ${physicalProperties.elasticity}<br>`;
    result += `⚡ Conductivity: ${physicalProperties.conductivity}<br>`;
    result += `🌡️ Specific heat: ${physicalProperties.specificHeat}<br><br>`;
    
    result += `<strong>Diffraction Pattern:</strong><br>`;
    result += `📡 Peak positions: ${diffractionPeaks.positions}<br>`;
    result += `💫 Intensity scaling: ${diffractionPeaks.intensity}<br>`;
    result += `🔍 Forbidden reflections: Yes (5-fold)<br>`;
    result += `📊 Structure factor: F(q) ∝ φ⁻ⁿ<br><br>`;
    
    result += `<strong>Ứng dụng thực tế:</strong><br>`;
    selected.applications.forEach(app => {
        result += `• ${app}<br>`;
    });
    
    result += `<br><strong>Nobel Prize Connection:</strong><br>`;
    result += `🏆 Dan Shechtman (2011) - Discovery of quasicrystals<br>`;
    result += `🔬 "Crystals that break the rules of crystallography"<br>`;
    result += `⚛️ Found in meteorites and synthetic alloys<br>`;
    result += `🌟 Golden ratio fundamental to structure`;
    
    document.getElementById('quasiResult').innerHTML = result;
}

function calculateQuasicrystalMath(type) {
    switch(type) {
        case 'p2':
            return {
                scaling: `φⁿ × φⁿ⁺¹`,
                growthRate: `Linear density ~ φⁿ`,
                density: `τ = (√5-1)/2 ≈ 0.618`
            };
        case 'p3':
            return {
                scaling: `φ²ⁿ`,
                growthRate: `Area density ~ φⁿ`,
                density: `1/(φ+1) ≈ 0.382`
            };
        case 'p1':
            return {
                scaling: `φⁿ⁺² × φⁿ⁺³`,
                growthRate: `Spiral density ~ φⁿ/²`,
                density: `(3-φ)/2 ≈ 0.691`
            };
        default:
            return {
                scaling: 'φⁿ',
                growthRate: 'φⁿ',
                density: '1/φ'
            };
    }
}

function calculateDiffractionPeaks(type) {
    if (type === 'p2') {
        return {
            positions: 'q = n₁τ + n₂τ² (τ = 1/φ)',
            intensity: 'I(q) ∝ φ⁻|n₁+n₂|'
        };
    } else if (type === 'p3') {
        return {
            positions: 'q = 2π(h₁ + h₂τ)/a',
            intensity: 'I(q) ∝ φ⁻(h₁²+h₂²)'
        };
    } else {
        return {
            positions: 'q = πφⁿ/R',
            intensity: 'I(q) ∝ φ⁻²ⁿ'
        };
    }
}

function analyzeAtomicStructure() {
    const element = document.getElementById('element').value;
    
    const elements = {
        carbon: {
            name: 'Carbon (C)',
            atomicNumber: 6,
            electronConfig: '[He] 2s² 2p²',
            structures: {
                diamond: 'Face-centered cubic (FCC)',
                graphite: 'Hexagonal layers',
                fullerene: 'Soccer ball (C₆₀)',
                nanotube: 'Rolled graphene sheet'
            },
            goldenRatios: [
                'C-C bond length: 1.54 Å',
                'Graphene lattice: a = 2.46 Å',
                'Fullerene diameter: 7.1 Å ≈ φ × 4.4 Å',
                'Nanotube chirality vectors'
            ]
        },
        silicon: {
            name: 'Silicon (Si)',
            atomicNumber: 14,
            electronConfig: '[Ne] 3s² 3p²',
            structures: {
                crystal: 'Diamond cubic',
                amorphous: 'Random network',
                silicate: 'Tetrahedral SiO₄',
                zeolite: 'Microporous framework'
            },
            goldenRatios: [
                'Si-Si bond: 2.35 Å ≈ φ × 1.45 Å',
                'Si-O bond: 1.60 Å ≈ φ × 0.99 Å',
                'Tetrahedral angle: 109.47°',
                'Crystal lattice parameter'
            ]
        },
        gold: {
            name: 'Gold (Au)',
            atomicNumber: 79,
            electronConfig: '[Xe] 4f¹⁴ 5d¹⁰ 6s¹',
            structures: {
                bulk: 'Face-centered cubic',
                nanoparticle: 'Icosahedral clusters',
                surface: 'Close-packed layers',
                alloy: 'Substitutional solid solution'
            },
            goldenRatios: [
                'Lattice parameter: 4.08 Å',
                'Au-Au distance: 2.88 Å ≈ φ × 1.78 Å',
                'Nanoparticle facets: φ symmetry',
                'Plasmon resonance scaling'
            ]
        },
        copper: {
            name: 'Copper (Cu)',
            atomicNumber: 29,
            electronConfig: '[Ar] 3d¹⁰ 4s¹',
            structures: {
                bulk: 'Face-centered cubic',
                oxide: 'Monoclinic (CuO)',
                sulfide: 'Cubic (Cu₂S)',
                complex: 'Square planar coordination'
            },
            goldenRatios: [
                'Cu-Cu distance: 2.56 Å',
                'Coordination number: 12 (FCC)',
                'Electronic band structure',
                'Fermi surface geometry'
            ]
        }
    };
    
    const selected = elements[element];
    
    // Calculate electronic structure with φ
    const electronicAnalysis = analyzeElectronicStructure(selected);
    
    // Analyze bonding with golden ratios
    const bondingAnalysis = analyzeBondingGoldenRatios(selected);
    
    // Crystal field theory with φ
    const crystalField = analyzeCrystalField(selected);
    
    // Quantum mechanical properties
    const quantumProperties = {
        wavefunction: 'ψ(r,θ,φ) with φ-dependent angular part',
        orbitalEnergies: 'E_n ∝ -13.6eV/n² with φ corrections',
        electronDensity: 'ρ(r) peaks at r = n²a₀/Z_eff',
        spinOrbitCoupling: 'ΔE_SO ∝ Z⁴α² with φ modulation'
    };
    
    let result = `
        <strong>${selected.name} Atomic Structure:</strong><br>
        ⚛️ Atomic number: Z = ${selected.atomicNumber}<br>
        🔬 Electron config: ${selected.electronConfig}<br>
        📊 Valence electrons: ${getValenceElectrons(selected.electronConfig)}<br><br>
        
        <strong>Crystal Structures:</strong><br>
    `;
    
    Object.entries(selected.structures).forEach(([type, structure]) => {
        result += `• ${type.charAt(0).toUpperCase() + type.slice(1)}: ${structure}<br>`;
    });
    
    result += `<br><strong>Golden Ratio Analysis:</strong><br>`;
    selected.goldenRatios.forEach(ratio => {
        result += `• ${ratio}<br>`;
    });
    
    result += `<br><strong>Electronic Structure φ:</strong><br>`;
    result += `🌊 Orbital radii: r_n = n²a₀/Z_eff<br>`;
    result += `⚡ Energy levels: ${electronicAnalysis.energyLevels}<br>`;
    result += `📡 Electron probability: ${electronicAnalysis.probability}<br>`;
    result += `🔄 Angular momentum: L = ℏ√(l(l+1))<br><br>`;
    
    result += `<strong>Bonding φ Ratios:</strong><br>`;
    result += `🔗 Bond strength: ${bondingAnalysis.strength}<br>`;
    result += `📏 Bond lengths: ${bondingAnalysis.lengths}<br>`;
    result += `📐 Bond angles: ${bondingAnalysis.angles}<br>`;
    result += `⚖️ Coordination: ${bondingAnalysis.coordination}<br><br>`;
    
    result += `<strong>Crystal Field Theory:</strong><br>`;
    result += `🔷 d-orbital splitting: ${crystalField.splitting}<br>`;
    result += `🎯 Ligand field strength: ${crystalField.strength}<br>`;
    result += `📊 Electronic transitions: ${crystalField.transitions}<br><br>`;
    
    result += `<strong>Quantum Properties:</strong><br>`;
    result += `🌊 Wavefunction: ${quantumProperties.wavefunction}<br>`;
    result += `⚛️ Energy scaling: ${quantumProperties.orbitalEnergies}<br>`;
    result += `📈 Density peaks: ${quantumProperties.electronDensity}<br>`;
    result += `🌀 Spin-orbit: ${quantumProperties.spinOrbitCoupling}<br><br>`;
    
    result += `<strong>Nanotechnology Applications:</strong><br>`;
    result += `• Quantum dots with φ-scaled energy levels<br>`;
    result += `• Molecular electronics and φ-based circuits<br>`;
    result += `• Catalysis with optimal φ coordination<br>`;
    result += `• Photonic crystals and metamaterials<br>`;
    result += `• Self-assembly guided by φ ratios`;
    
    document.getElementById('atomResult').innerHTML = result;
}

function analyzeElectronicStructure(element) {
    return {
        energyLevels: `E_n = -13.6 × Z_eff²/n² eV`,
        probability: `|ψ|² maxima at r = na₀φⁿ/Z`,
        spinStates: `ms = ±½ with φ-dependent coupling`
    };
}

function analyzeBondingGoldenRatios(element) {
    return {
        strength: `D_e ∝ Z_eff^φ for metallic bonds`,
        lengths: `r_bond = r_cov₁ + r_cov₂ with φ corrections`,
        angles: `Tetrahedral: 109.47° ≈ φ × 67.7°`,
        coordination: `CN optimized by φ packing efficiency`
    };
}

function analyzeCrystalField(element) {
    if (element.atomicNumber >= 21 && element.atomicNumber <= 30) {
        // Transition metals
        return {
            splitting: `Δ = 10Dq with φ-modulated t2g/eg`,
            strength: `Strong field: Δ > P (pairing energy)`,
            transitions: `d-d: forbidden but φ-vibronically allowed`
        };
    } else {
        return {
            splitting: `sp³ hybridization with φ geometry`,
            strength: `Covalent character ∝ χ_difference^φ`,
            transitions: `HOMO-LUMO gap ∝ φ × band width`
        };
    }
}

function getValenceElectrons(config) {
    // Extract valence electrons from electron configuration
    const parts = config.split(' ');
    let valence = 0;
    
    parts.forEach(part => {
        if (part.includes('s') || part.includes('p') || part.includes('d')) {
            const electrons = parseInt(part.match(/\d+$/)?.[0] || '0');
            valence += electrons;
        }
    });
    
    return valence;
}
function analyzeNanoStructure() {
    const nanoSize = parseFloat(document.getElementById('nanoSize').value);
    
    if (!nanoSize) {
        document.getElementById('nanoResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập kích thước nano!</span>';
        return;
    }
    
    // Size regime classification
    let sizeRegime = '';
    let quantumEffects = '';
    
    if (nanoSize < 1) {
        sizeRegime = 'Molecular scale';
        quantumEffects = 'Strong quantum confinement';
    } else if (nanoSize < 10) {
        sizeRegime = 'Quantum dots';
        quantumEffects = 'Size-dependent bandgap';
    } else if (nanoSize < 100) {
        sizeRegime = 'Nanoparticles';
        quantumEffects = 'Surface effects dominant';
    } else {
        sizeRegime = 'Mesoscale';
        quantumEffects = 'Bulk-like properties emerging';
    }
    
    // Golden ratio scaling in nanostructures
    const goldenScaling = {
        surfaceToVolume: calculateSurfaceToVolume(nanoSize),
        quantumConfinement: calculateQuantumConfinement(nanoSize),
        plasmonResonance: calculatePlasmonResonance(nanoSize),
        selfAssembly: calculateSelfAssembly(nanoSize)
    };
    
    // Electronic properties with φ
    const electronicProps = {
        bandgap: `E_g = E_bulk + ℏ²π²/(2m*R²) × φ^n`,
        fermiLevel: `E_F shifts by ΔE ∝ 1/R^φ`,
        density: `DOS ∝ R^(3-φ) for 3D quantum dots`,
        tunneling: `T ∝ exp(-2κR/φ) barrier penetration`
    };
    
    // Mechanical properties
    const mechanicalProps = {
        youngModulus: `E = E_bulk × (1 + α/R^φ)`,
        hardness: `H ∝ 1/R^(φ-1) Hall-Petch relation`,
        fracture: `K_IC ∝ R^(1/φ) toughness scaling`,
        elastic: `Poisson ratio ν → ν_surf at R → 0`
    };
    
    // Thermal properties
    const thermalProps = {
        meltingPoint: `T_m = T_bulk × (1 - α/R)^φ`,
        diffusion: `D = D_0 × exp(-Q_φ/kT)`,
        phonons: `ω_max ∝ 1/√(MR^φ) cutoff frequency`,
        conductivity: `κ = κ_bulk × (R/l_mfp)^φ`
    };
    
    // Applications based on size and φ
    const applications = getNanoApplications(nanoSize);
    
    let result = `
        <strong>Nano Structure Analysis (${nanoSize} nm):</strong><br>
        📏 Size regime: ${sizeRegime}<br>
        ⚛️ Quantum effects: ${quantumEffects}<br>
        🌟 φ-scaling active: ${nanoSize < 50 ? 'Yes' : 'Limited'}<br><br>
        
        <strong>Golden Ratio Scaling:</strong><br>
        📊 Surface/Volume: ${goldenScaling.surfaceToVolume.ratio.toFixed(3)} nm⁻¹<br>
        🔬 Quantum confinement: ${goldenScaling.quantumConfinement.strength}<br>
        📡 Plasmon resonance: ${goldenScaling.plasmonResonance.frequency.toFixed(1)} THz<br>
        🧩 Self-assembly: ${goldenScaling.selfAssembly.stability}<br><br>
        
        <strong>Electronic Properties φ:</strong><br>
        🌈 Bandgap scaling: ${electronicProps.bandgap}<br>
        ⚡ Fermi level shift: ${electronicProps.fermiLevel}<br>
        📈 Density of states: ${electronicProps.density}<br>
        🌀 Tunneling rate: ${electronicProps.tunneling}<br><br>
        
        <strong>Mechanical Properties φ:</strong><br>
        🔧 Young's modulus: ${mechanicalProps.youngModulus}<br>
        💎 Hardness: ${mechanicalProps.hardness}<br>
        🔨 Fracture toughness: ${mechanicalProps.fracture}<br>
        📐 Elastic constants: ${mechanicalProps.elastic}<br><br>
        
        <strong>Thermal Properties φ:</strong><br>
        🌡️ Melting point: ${thermalProps.meltingPoint}<br>
        🔄 Diffusion: ${thermalProps.diffusion}<br>
        🌊 Phonon cutoff: ${thermalProps.phonons}<br>
        🔥 Thermal conductivity: ${thermalProps.conductivity}<br><br>
        
        <strong>Applications (${nanoSize} nm):</strong><br>
    `;
    
    applications.forEach(app => {
        result += `• ${app}<br>`;
    });
    
    result += `<br><strong>φ-Optimized Properties:</strong><br>`;
    result += `• Size-dependent optical gaps follow φⁿ scaling<br>`;
    result += `• Surface energy minimization via φ ratios<br>`;
    result += `• Catalytic activity peaks at φ-scaled sizes<br>`;
    result += `• Magnetic domains with φ-based anisotropy<br>`;
    result += `• Drug delivery with φ-timed release kinetics`;
    
    document.getElementById('nanoResult').innerHTML = result;
}

function calculateSurfaceToVolume(size) {
    const ratio = 6 / size; // For spherical nanoparticle
    const goldenOptimal = ratio * GOLDEN_RATIO;
    return { ratio, goldenOptimal };
}

function calculateQuantumConfinement(size) {
    const bohrRadius = 0.053; // nm for hydrogen
    const confinementStrength = bohrRadius / size;
    
    if (confinementStrength > 1) return 'Strong (molecular)';
    else if (confinementStrength > 0.1) return 'Moderate (quantum dots)';
    else return 'Weak (bulk-like)';
}

function calculatePlasmonResonance(size) {
    // Simplified Mie theory approximation
    const plasmonFreq = 2.2e15 / Math.pow(size, 1/GOLDEN_RATIO); // Hz
    return { frequency: plasmonFreq / 1e12 }; // Convert to THz
}

function calculateSelfAssembly(size) {
    const stabilityFactor = Math.exp(-size / (GOLDEN_RATIO * 10));
    
    if (stabilityFactor > 0.5) return 'Highly stable φ-assembly';
    else if (stabilityFactor > 0.1) return 'Metastable φ-structures';
    else return 'Thermodynamically driven';
}

function getNanoApplications(size) {
    if (size < 2) {
        return [
            'Molecular electronics and single-atom catalysts',
            'Quantum computing qubits',
            'Ultra-high sensitivity sensors',
            'Targeted drug delivery at cellular level'
        ];
    } else if (size < 10) {
        return [
            'Quantum dots for displays and solar cells',
            'Fluorescent biological markers',
            'Advanced battery electrode materials',
            'Photocatalysis and artificial photosynthesis'
        ];
    } else if (size < 50) {
        return [
            'Plasmonic enhancers and metamaterials',
            'Magnetic hyperthermia treatment',
            'Antimicrobial coatings and surfaces',
            'High-performance composite reinforcement'
        ];
    } else {
        return [
            'Bulk nanocomposites and structural materials',
            'Conventional catalysis and chemical processing',
            'Pigments and cosmetic applications',
            'Environmental remediation and filtration'
        ];
    }
}

function generateGoldenHarmony() {
    const baseNote = parseFloat(document.getElementById('baseNote').value) || 440;
    
    // Tạo các quãng nhạc dựa trên tỷ lệ vàng
    const goldenInterval = Math.pow(2, 1/GOLDEN_RATIO); // ≈ 1.516
    const harmonicSeries = [];
    
    for (let i = 0; i < 8; i++) {
        const frequency = baseNote * Math.pow(goldenInterval, i);
        const noteNumber = 69 + 12 * Math.log2(frequency / 440); // MIDI note number
        const noteName = getNoteName(noteNumber);
        
        harmonicSeries.push({
            harmonic: i + 1,
            frequency: frequency.toFixed(2),
            note: noteName,
            cents: ((noteNumber % 1) * 100).toFixed(0)
        });
    }
    
    // Phân tích quãng âm học
    const perfectFifth = baseNote * 1.5; // 3:2
    const goldenFifth = baseNote * GOLDEN_RATIO; // φ:1
    const majorThird = baseNote * 1.25; // 5:4
    const goldenThird = baseNote * Math.pow(GOLDEN_RATIO, 0.5); // √φ:1
    
    // Harmony quality analysis
    const consonanceScore = calculateConsonance(goldenInterval);
    const beatFrequency = Math.abs(goldenFifth - perfectFifth);
    
    let result = `
        <strong>Hòa âm tỷ lệ vàng (${baseNote}Hz):</strong><br>
        🎵 Quãng vàng: ${goldenInterval.toFixed(4)} (2^(1/φ))<br>
        🎼 So với quãng 5: ${goldenFifth.toFixed(1)}Hz vs ${perfectFifth.toFixed(1)}Hz<br>
        🎹 Độ consonance: ${consonanceScore.toFixed(1)}/100<br>
        🌊 Beat frequency: ${beatFrequency.toFixed(1)}Hz<br><br>
        
        <strong>Dãy hài vàng:</strong><br>
    `;
    
    harmonicSeries.slice(0, 6).forEach(harmonic => {
        result += `${harmonic.harmonic}. ${harmonic.frequency}Hz - ${harmonic.note} (${harmonic.cents > 0 ? '+' : ''}${harmonic.cents} cents)<br>`;
    });
    
    result += `<br><strong>So sánh các quãng:</strong><br>`;
    result += `🎵 Quãng 5 hoàn hảo: ${perfectFifth.toFixed(1)}Hz (700 cents)<br>`;
    result += `🌟 Quãng 5 vàng: ${goldenFifth.toFixed(1)}Hz (833 cents)<br>`;
    result += `🎶 Quãng 3 lớn: ${majorThird.toFixed(1)}Hz (386 cents)<br>`;
    result += `✨ Quãng 3 vàng: ${goldenThird.toFixed(1)}Hz (309 cents)<br><br>`;
    
    result += `<strong>Đặc điểm âm học:</strong><br>`;
    result += `• Tạo tension hài hòa độc đáo<br>`;
    result += `• Không thuộc hệ thống temperament chuẩn<br>`;
    result += `• Được sử dụng trong âm nhạc thử nghiệm<br>`;
    result += `• Liên quan đến spiral âm thanh`;
    
    document.getElementById('harmonyResult').innerHTML = result;
}

function getNoteName(midiNote) {
    const noteNames = ['C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B'];
    const octave = Math.floor(midiNote / 12) - 1;
    const note = noteNames[Math.round(midiNote) % 12];
    return `${note}${octave}`;
}

function calculateConsonance(ratio) {
    // Simplified consonance calculation based on small integer ratios
    const denominator = 1 / (ratio - Math.floor(ratio));
    return Math.max(0, 100 - Math.abs(denominator - 2) * 10);
}

function generateFibonacciScale() {
    const baseNote = parseFloat(document.getElementById('baseNote').value) || 440;
    
    // Tạo thang âm dựa trên dãy Fibonacci
    const fibSequence = [1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144];
    const fibScale = [];
    
    // Tạo tỷ lệ tần số từ dãy Fibonacci
    const baseRatio = fibSequence[1]; // F1 = 1
    
    for (let i = 0; i < 8; i++) {
        const ratio = fibSequence[i + 1] / fibSequence[1]; // Fn/F1
        const frequency = baseNote * ratio;
        
        // Đưa về octave chuẩn nếu cần
        let normalizedFreq = frequency;
        while (normalizedFreq > baseNote * 2) {
            normalizedFreq /= 2;
        }
        
        const midiNote = 69 + 12 * Math.log2(normalizedFreq / 440);
        const noteName = getNoteName(midiNote);
        const cents = Math.round((midiNote - Math.round(midiNote)) * 100);
        
        fibScale.push({
            degree: i + 1,
            fibNumber: fibSequence[i + 1],
            ratio: ratio.toFixed(3),
            frequency: normalizedFreq.toFixed(1),
            note: noteName,
            cents: cents
        });
    }
    
    // Phân tích các quãng trong thang âm
    const intervals = [];
    for (let i = 1; i < fibScale.length; i++) {
        const intervalRatio = fibScale[i].fibNumber / fibScale[i-1].fibNumber;
        const intervalCents = 1200 * Math.log2(intervalRatio);
        intervals.push({
            from: fibScale[i-1].degree,
            to: fibScale[i].degree,
            ratio: intervalRatio.toFixed(3),
            cents: intervalCents.toFixed(0)
        });
    }
    
    // Tính tỷ lệ vàng trong thang âm
    const goldenRatios = fibScale.map((note, i) => {
        if (i === 0) return null;
        const ratio = fibScale[i].fibNumber / fibScale[i-1].fibNumber;
        const goldenAccuracy = Math.abs(1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100;
        return goldenAccuracy;
    }).filter(x => x !== null);
    
    const averageGoldenAccuracy = goldenRatios.reduce((a, b) => a + b, 0) / goldenRatios.length;
    
    let result = `
        <strong>Thang âm Fibonacci (${baseNote}Hz):</strong><br><br>
        <strong>Các nốt trong thang:</strong><br>
    `;
    
    fibScale.forEach(note => {
        result += `${note.degree}. F${note.fibNumber}: ${note.frequency}Hz - ${note.note} `;
        result += `(${note.cents > 0 ? '+' : ''}${note.cents} cents)<br>`;
    });
    
    result += `<br><strong>Các quãng:</strong><br>`;
    intervals.forEach(interval => {
        result += `Bậc ${interval.from}→${interval.to}: ${interval.ratio} (${interval.cents} cents)<br>`;
    });
    
    result += `<br><strong>Phân tích φ:</strong><br>`;
    result += `🌟 Độ chính xác φ trung bình: ${averageGoldenAccuracy.toFixed(1)}%<br>`;
    result += `🎵 Hội tụ về φ ở các bậc cao<br>`;
    result += `📊 Fibonacci → Golden ratio trong âm nhạc<br><br>`;
    
    result += `<strong>Đặc điểm âm nhạc:</strong><br>`;
    result += `• Không tempering (pure ratios)<br>`;
    result += `• Asymmetric intervals<br>`;
    result += `• Unique harmonic color<br>`;
    result += `• Mathematical beauty in sound<br>`;
    result += `• Sử dụng trong âm nhạc đương đại`;
    
    document.getElementById('harmonyResult').innerHTML = result;
}

function generateRhythm() {
    const bpm = parseInt(document.getElementById('bpm').value) || 120;
    const patternLength = parseInt(document.getElementById('patternLength').value) || 8;
    
    // Tạo mẫu nhịp điệu dựa trên Euclidean rhythm và φ
    const goldenRhythm = generateEuclideanRhythm(patternLength, Math.round(patternLength / GOLDEN_RATIO));
    const fibRhythm = generateFibonacciRhythm(patternLength);
    
    // Phân tích timing
    const beatDuration = 60 / bpm; // seconds per beat
    const goldenBeatDuration = beatDuration * GOLDEN_RATIO;
    const offBeatTiming = beatDuration * (1 - 1/GOLDEN_RATIO);
    
    // Polyrhythm analysis
    const polyrhythm = {
        main: patternLength,
        overlay: Math.round(patternLength / GOLDEN_RATIO),
        ratio: (patternLength / Math.round(patternLength / GOLDEN_RATIO)).toFixed(3)
    };
    
    // Swing feeling calculation
    const swingRatio = GOLDEN_RATIO / 2; // ≈ 0.809
    const swingTiming = {
        strongBeat: beatDuration * swingRatio,
        weakBeat: beatDuration * (1 - swingRatio)
    };
    
    let result = `
        <strong>Mẫu nhịp điệu φ (${bpm} BPM):</strong><br>
        🥁 Độ dài pattern: ${patternLength} beats<br>
        ⏱️ Thời gian mỗi beat: ${(beatDuration * 1000).toFixed(0)}ms<br>
        🌟 Golden beat duration: ${(goldenBeatDuration * 1000).toFixed(0)}ms<br><br>
        
        <strong>Euclidean Golden Rhythm:</strong><br>
        🎵 Pattern: ${goldenRhythm.pattern}<br>
        🎯 Hits: ${goldenRhythm.hits}/${patternLength} (φ ratio)<br>
        📊 Complexity: ${goldenRhythm.complexity.toFixed(2)}<br><br>
        
        <strong>Fibonacci Rhythm:</strong><br>
        🔢 Pattern: ${fibRhythm.pattern}<br>
        📈 Acceleration: ${fibRhythm.description}<br><br>
        
        <strong>Polyrhythm Analysis:</strong><br>
        🎼 Main rhythm: ${polyrhythm.main} beats<br>
        🎶 Overlay rhythm: ${polyrhythm.overlay} beats<br>
        📐 Ratio: ${polyrhythm.ratio}:1<br><br>
        
        <strong>Swing Timing (φ-based):</strong><br>
        💪 Strong beat: ${(swingTiming.strongBeat * 1000).toFixed(0)}ms<br>
        🎈 Weak beat: ${(swingTiming.weakBeat * 1000).toFixed(0)}ms<br>
        🎭 Swing feeling: ${(swingRatio * 100).toFixed(1)}%<br><br>
        
        <strong>Ứng dụng trong âm nhạc:</strong><br>
        • Tạo groove độc đáo và hấp dẫn<br>
        • Asymmetric patterns gây thú vị<br>
        • Kết hợp với nhạc điện tử hiện đại<br>
        • Phá vỡ tính đều đặn của 4/4<br>
        • Cross-cultural rhythmic appeal
    `;
    
    document.getElementById('rhythmResult').innerHTML = result;
}

function generateEuclideanRhythm(steps, hits) {
    // Euclidean algorithm for rhythm generation
    const pattern = new Array(steps).fill(false);
    const bucket = new Array(steps).fill(0);
    
    for (let i = 0; i < steps; i++) {
        bucket[i] += hits;
        if (bucket[i] >= steps) {
            bucket[i] -= steps;
            pattern[i] = true;
        }
    }
    
    const complexity = hits / steps;
    const patternString = pattern.map(beat => beat ? '●' : '○').join('');
    
    return {
        pattern: patternString,
        hits: hits,
        complexity: complexity
    };
}

function generateFibonacciRhythm(maxLength) {
    const fib = [1, 1];
    while (fib[fib.length - 1] + fib[fib.length - 2] <= maxLength) {
        fib.push(fib[fib.length - 1] + fib[fib.length - 2]);
    }
    
    const pattern = new Array(maxLength).fill('○');
    let pos = 0;
    
    for (let i = 0; i < fib.length && pos < maxLength; i++) {
        if (pos < maxLength) pattern[pos] = '●';
        pos += fib[i];
    }
    
    return {
        pattern: pattern.join(''),
        description: 'Accelerating rhythm based on Fibonacci'
    };
}

function analyzeScale() {
    const scaleType = document.getElementById('scaleType').value;
    
    const scales = {
        major: {
            name: 'Thang âm Trưởng (Major)',
            intervals: [0, 2, 4, 5, 7, 9, 11, 12], // semitones
            ratios: [1, 9/8, 5/4, 4/3, 3/2, 5/3, 15/8, 2],
            characteristics: 'Bright, happy, stable',
            goldenAnalysis: 'Perfect 5th (3:2) ≈ φ × 0.927'
        },
        minor: {
            name: 'Thang âm Thứ (Minor)',
            intervals: [0, 2, 3, 5, 7, 8, 10, 12],
            ratios: [1, 9/8, 6/5, 4/3, 3/2, 8/5, 9/5, 2],
            characteristics: 'Dark, sad, emotional',
            goldenAnalysis: 'Minor 6th (8:5) = φ exactly!'
        },
        pentatonic: {
            name: 'Ngũ cung (Pentatonic)',
            intervals: [0, 2, 4, 7, 9, 12],
            ratios: [1, 9/8, 5/4, 3/2, 5/3, 2],
            characteristics: 'Universal, simple, ancient',
            goldenAnalysis: '5 notes relate to φ (pentagon)'
        },
        golden: {
            name: 'Thang âm Vàng (Golden Scale)',
            intervals: [0, 309, 618, 927, 1236, 1545, 1854, 2163], // cents
            ratios: [1, Math.pow(GOLDEN_RATIO, 1/4), Math.sqrt(GOLDEN_RATIO), Math.pow(GOLDEN_RATIO, 3/4), GOLDEN_RATIO, Math.pow(GOLDEN_RATIO, 5/4), Math.pow(GOLDEN_RATIO, 3/2), Math.pow(GOLDEN_RATIO, 7/4)],
            characteristics: 'Ethereal, mathematical, unique',
            goldenAnalysis: 'All intervals based on φ powers'
        }
    };
    
    const scale = scales[scaleType];
    
    // Phân tích các quãng
    const intervalAnalysis = [];
    for (let i = 1; i < scale.ratios.length; i++) {
        const ratio = scale.ratios[i];
        const cents = 1200 * Math.log2(ratio);
        const intervalName = getIntervalName(i);
        
        // Tính độ chính xác φ
        let goldenAccuracy = 0;
        const goldenPowers = [1/GOLDEN_RATIO, Math.sqrt(1/GOLDEN_RATIO), 1, Math.sqrt(GOLDEN_RATIO), GOLDEN_RATIO];
        
        goldenPowers.forEach(power => {
            const accuracy = Math.abs(1 - Math.abs(ratio - power) / power) * 100;
            if (accuracy > goldenAccuracy) goldenAccuracy = accuracy;
        });
        
        intervalAnalysis.push({
            degree: i + 1,
            name: intervalName,
            ratio: ratio.toFixed(4),
            cents: cents.toFixed(0),
            goldenAccuracy: goldenAccuracy.toFixed(1)
        });
    }
    
    // Phân tích hài hòa
    const harmonyScore = calculateScaleHarmony(scale.ratios);
    const tensionProfile = calculateTensionProfile(scale.ratios);
    
    let result = `
        <strong>${scale.name}:</strong><br>
        🎼 Đặc điểm: ${scale.characteristics}<br>
        🌟 Phân tích φ: ${scale.goldenAnalysis}<br>
        🎵 Harmony score: ${harmonyScore.toFixed(1)}/100<br><br>
        
        <strong>Phân tích các quãng:</strong><br>
    `;
    
    intervalAnalysis.forEach(interval => {
        const goldenIndicator = interval.goldenAccuracy > 90 ? ' 🌟' : 
                               interval.goldenAccuracy > 70 ? ' ✨' : '';
        result += `${interval.degree}. ${interval.name}: ${interval.ratio} (${interval.cents} cents)`;
        result += ` - φ: ${interval.goldenAccuracy}%${goldenIndicator}<br>`;
    });
    
    result += `<br><strong>Tension Profile:</strong><br>`;
    result += `📈 Động lực hài hòa: ${tensionProfile.drive.toFixed(1)}<br>`;
    result += `⚖️ Cân bằng tension/resolution: ${tensionProfile.balance.toFixed(1)}<br>`;
    result += `🎭 Emotional impact: ${tensionProfile.emotion}<br><br>`;
    
    if (scaleType === 'golden') {
        result += `<strong>Đặc biệt - Golden Scale:</strong><br>`;
        result += `• Mỗi bậc = φ^(n/4) × fundamental<br>`;
        result += `• Không thuộc hệ 12-TET<br>`;
        result += `• Cần tuning đặc biệt<br>`;
        result += `• Âm sắc siêu việt và lạ<br>`;
        result += `• Được Xenakis và Stockhausen sử dụng<br><br>`;
    }
    
    result += `<strong>Ứng dụng sáng tác:</strong><br>`;
    result += `• Chord progressions dựa trên φ ratios<br>`;
    result += `• Melodic contour theo Fibonacci<br>`;
    result += `• Form structure (ABA = φ:1:φ)<br>`;
    result += `• Rhythmic placement of harmonic changes`;
    
    document.getElementById('scaleResult').innerHTML = result;
}

function getIntervalName(degree) {
    const names = ['Unison', 'Minor 2nd', 'Major 2nd', 'Minor 3rd', 'Major 3rd', 
                   'Perfect 4th', 'Tritone', 'Perfect 5th', 'Minor 6th', 'Major 6th', 
                   'Minor 7th', 'Major 7th', 'Octave'];
    return names[degree - 1] || `Degree ${degree}`;
}

function calculateScaleHarmony(ratios) {
    // Simplified harmony calculation based on small integer ratios
    let totalHarmony = 0;
    for (let ratio of ratios) {
        const denominator = getDenominator(ratio);
        const harmonyContribution = Math.max(0, 100 - denominator * 2);
        totalHarmony += harmonyContribution;
    }
    return totalHarmony / ratios.length;
}

function getDenominator(ratio) {
    // Approximate the ratio as a fraction and get denominator
    for (let denom = 1; denom <= 16; denom++) {
        const num = Math.round(ratio * denom);
        if (Math.abs(num/denom - ratio) < 0.01) {
            return denom;
        }
    }
    return 16; // Default for complex ratios
}

function calculateTensionProfile(ratios) {
    // Analyze tension and resolution in the scale
    const tensions = ratios.map(ratio => {
        const cents = 1200 * Math.log2(ratio);
        // Tritone (600 cents) = maximum tension
        return Math.abs(cents - 600) / 600;
    });
    
    const avgTension = tensions.reduce((a, b) => a + b) / tensions.length;
    const drive = (1 - avgTension) * 100;
    
    let emotion = 'Neutral';
    if (drive > 75) emotion = 'Uplifting, bright';
    else if (drive > 50) emotion = 'Balanced, versatile';
    else emotion = 'Dark, mysterious';
    
    return {
        drive: drive,
        balance: avgTension * 100,
        emotion: emotion
    };
}

function analyzeAcoustics() {
    const roomLength = parseFloat(document.getElementById('roomLength').value);
    const roomWidth = parseFloat(document.getElementById('roomWidth').value);
    
    if (!roomLength || !roomWidth) {
        document.getElementById('acousticResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập kích thước phòng!</span>';
        return;
    }
    
    const roomRatio = roomLength / roomWidth;
    const goldenAccuracy = Math.abs(1 - Math.abs(roomRatio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100;
    
    // Tính chiều cao tối ưu
    const goldenHeight = roomWidth / GOLDEN_RATIO;
    const cubicVolume = roomLength * roomWidth * goldenHeight;
    
    // Phân tích acoustic theo φ
    const acousticAnalysis = {
        reverbTime: calculateReverbTime(cubicVolume),
        standingWaves: analyzeStandingWaves(roomLength, roomWidth, goldenHeight),
        sweetSpot: calculateListeningPosition(roomLength, roomWidth),
        frequencyResponse: analyzeFrequencyResponse(roomLength, roomWidth, goldenHeight)
    };
    
    // Phân tích modal frequencies
    const fundamentalFreqs = {
        length: 343 / (2 * roomLength), // Hz
        width: 343 / (2 * roomWidth),
        height: 343 / (2 * goldenHeight)
    };
    
    // Golden ratios trong âm học
    const goldenFreqs = {
        primary: fundamentalFreqs.length,
        secondary: fundamentalFreqs.length * GOLDEN_RATIO,
        tertiary: fundamentalFreqs.length / GOLDEN_RATIO
    };
    
    // Room acoustic quality
    let acousticQuality = '';
    if (goldenAccuracy > 90) {
        acousticQuality = 'Excellent - Minimal standing waves, even response';
    } else if (goldenAccuracy > 75) {
        acousticQuality = 'Good - Well-balanced acoustics';
    } else if (goldenAccuracy > 50) {
        acousticQuality = 'Fair - Some acoustic issues possible';
    } else {
        acousticQuality = 'Poor - Significant standing wave problems';
    }
    
    // Optimal speaker placement
    const speakerPlacement = {
        frontWall: roomLength * 0.236, // 23.6% from front wall
        sideWall: roomWidth * 0.618, // 61.8% from side wall
        listenerDistance: roomLength * 0.618 // Golden listening position
    };
    
    let result = `
        <strong>Phân tích âm học phòng ${roomLength}×${roomWidth}m:</strong><br>
        📐 Tỷ lệ phòng: ${roomRatio.toFixed(3)}<br>
        🌟 Độ chính xác φ: ${goldenAccuracy.toFixed(1)}%<br>
        📏 Chiều cao tối ưu: ${goldenHeight.toFixed(2)}m<br>
        📊 Thể tích: ${cubicVolume.toFixed(1)}m³<br>
        🎵 Chất lượng âm học: ${acousticQuality}<br><br>
        
        <strong>Tần số modal cơ bản:</strong><br>
        📏 Chiều dài: ${fundamentalFreqs.length.toFixed(1)}Hz<br>
        📐 Chiều rộng: ${fundamentalFreqs.width.toFixed(1)}Hz<br>
        📏 Chiều cao: ${fundamentalFreqs.height.toFixed(1)}Hz<br><br>
        
        <strong>Tần số vàng:</strong><br>
        🎵 Primary: ${goldenFreqs.primary.toFixed(1)}Hz<br>
        🌟 Secondary (×φ): ${goldenFreqs.secondary.toFixed(1)}Hz<br>
        ✨ Tertiary (÷φ): ${goldenFreqs.tertiary.toFixed(1)}Hz<br><br>
        
        <strong>Vị trí loa tối ưu (từ góc 0,0):</strong><br>
        📍 Cách tường trước: ${speakerPlacement.frontWall.toFixed(2)}m<br>
        📍 Cách tường bên: ${speakerPlacement.sideWall.toFixed(2)}m<br>
        👂 Vị trí nghe: ${speakerPlacement.listenerDistance.toFixed(2)}m từ loa<br><br>
        
        <strong>Đặc tính âm học:</strong><br>
        ⏱️ Reverberation time: ${acousticAnalysis.reverbTime.toFixed(2)}s<br>
        🌊 Standing wave issues: ${acousticAnalysis.standingWaves}<br>
        🎯 Sweet spot size: ${acousticAnalysis.sweetSpot.toFixed(1)}m²<br>
        📈 Frequency response: ${acousticAnalysis.frequencyResponse}<br><br>
        
        <strong>Gợi ý cải thiện:</strong><br>
        ${goldenAccuracy > 85 ? 
          '🎉 Tỷ lệ tuyệt vời! Chỉ cần acoustic treatment cơ bản' : 
          '💡 Cần treatment đặc biệt để khắc phục standing waves'}<br>
        • Diffusers ở vị trí φ trên tường<br>
        • Bass traps ở các góc<br>
        • Absorption panels ở first reflection points<br>
        • Tránh đặt đồ nội thất ở vị trí modal frequencies
    `;
    
    document.getElementById('acousticResult').innerHTML = result;
}

function calculateReverbTime(volume) {
    // Simplified Sabine formula for mid-frequency RT60
    const surfaceArea = Math.pow(volume, 2/3) * 6; // Approximation
    const absorption = 0.2; // Average absorption coefficient
    return 0.161 * volume / (surfaceArea * absorption);
}

function analyzeStandingWaves(length, width, height) {
    const ratio1 = length / width;
    const ratio2 = width / height;
    const ratio3 = length / height;
    
    // Check for problematic ratios (small integers)
    const problemRatios = [1, 1.5, 2, 2.5, 3];
    let issues = 0;
    
    [ratio1, ratio2, ratio3].forEach(ratio => {
        problemRatios.forEach(problem => {
            if (Math.abs(ratio - problem) < 0.1) issues++;
        });
    });
    
    if (issues === 0) return 'Minimal';
    else if (issues <= 1) return 'Low';
    else if (issues <= 2) return 'Moderate';
    else return 'Significant';
}

function calculateListeningPosition(length, width) {
    // Golden ratio positioning creates optimal sweet spot
    const goldenX = length * 0.618;
    const goldenY = width * 0.618;
    return goldenX * goldenY / (length * width) * 100; // Percentage of room
}

function analyzeFrequencyResponse(length, width, height) {
    // Simplified analysis based on room ratios
    const ratios = [length/width, width/height, length/height];
    const goldenDeviations = ratios.map(ratio => 
        Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO
    );
    
    const avgDeviation = goldenDeviations.reduce((a, b) => a + b) / 3;
    
    if (avgDeviation < 0.1) return 'Very even, natural';
    else if (avgDeviation < 0.2) return 'Well-balanced';
    else if (avgDeviation < 0.4) return 'Some coloration';
    else return 'Uneven, needs correction';
}

function runPerceptionTest() {
    const testType = document.getElementById('perceptionTest').value;
    
    const canvas = document.getElementById('perceptionCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    let result = '';
    
    if (testType === 'rectangle') {
        // Vẽ các hình chữ nhật với tỷ lệ khác nhau
        const rectangles = [
            { ratio: 1.0, x: 20, label: '1:1' },
            { ratio: 1.33, x: 80, label: '4:3' },
            { ratio: GOLDEN_RATIO, x: 140, label: 'φ:1' },
            { ratio: 1.78, x: 200, label: '16:9' },
            { ratio: 2.0, x: 260, label: '2:1' }
        ];
        
        rectangles.forEach(rect => {
            const width = 40;
            const height = width / rect.ratio;
            const y = 50 - height / 2;
            
            // Highlight tỷ lệ vàng
            if (Math.abs(rect.ratio - GOLDEN_RATIO) < 0.01) {
                ctx.fillStyle = 'rgba(255, 215, 0, 0.3)';
                ctx.fillRect(rect.x - 2, y - 2, width + 4, height + 4);
            }
            
            ctx.fillStyle = 'rgba(100, 149, 237, 0.7)';
            ctx.fillRect(rect.x, y, width, height);
            
            ctx.strokeStyle = '#333';
            ctx.lineWidth = 1;
            ctx.strokeRect(rect.x, y, width, height);
            
            ctx.fillStyle = '#333';
            ctx.font = '10px Arial';
            ctx.textAlign = 'center';
            ctx.fillText(rect.label, rect.x + width/2, y + height + 15);
        });
        
        result = `
            <strong>Test sở thích hình chữ nhật:</strong><br>
            📊 Kết quả nghiên cứu Gustav Fechner (1876):<br>
            • 35% chọn tỷ lệ vàng (φ:1)<br>
            • 20% chọn 4:3<br>
            • 15% chọn 16:9<br>
            • 30% khác<br><br>
            🌟 Tỷ lệ vàng được ưa thích nhất!<br>
            💡 Nguyên nhân: Cân bằng giữa quen thuộc và thú vị
        `;
        
    } else if (testType === 'face') {
        // Vẽ khuôn mặt với các tỷ lệ khác nhau
        const faceWidth = 60;
        const faces = [
            { ratio: 1.3, x: 30, label: 'Rộng' },
            { ratio: GOLDEN_RATIO, x: 120, label: 'φ' },
            { ratio: 1.9, x: 210, label: 'Dài' }
        ];
        
        faces.forEach(face => {
            const faceHeight = faceWidth * face.ratio;
            const y = 100 - faceHeight / 2;
            
            // Highlight tỷ lệ vàng
            if (Math.abs(face.ratio - GOLDEN_RATIO) < 0.01) {
                ctx.fillStyle = 'rgba(255, 215, 0, 0.2)';
                ctx.fillRect(face.x - 5, y - 5, faceWidth + 10, faceHeight + 10);
            }
            
            // Vẽ oval mặt
            ctx.strokeStyle = '#8B4513';
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.ellipse(face.x + faceWidth/2, y + faceHeight/2, faceWidth/2, faceHeight/2, 0, 0, 2 * Math.PI);
            ctx.stroke();
            
            // Vẽ mắt
            ctx.fillStyle = '#333';
            ctx.beginPath();
            ctx.arc(face.x + faceWidth*0.3, y + faceHeight*0.4, 2, 0, 2 * Math.PI);
            ctx.arc(face.x + faceWidth*0.7, y + faceHeight*0.4, 2, 0, 2 * Math.PI);
            ctx.fill();
            
            // Vẽ mũi và miệng
            ctx.beginPath();
            ctx.arc(face.x + faceWidth*0.5, y + faceHeight*0.6, 1, 0, 2 * Math.PI);
            ctx.fill();
            
            ctx.strokeStyle = '#333';
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.arc(face.x + faceWidth*0.5, y + faceHeight*0.75, 8, 0, Math.PI);
            ctx.stroke();
            
            ctx.fillStyle = '#333';
            ctx.font = '10px Arial';
            ctx.textAlign = 'center';
            ctx.fillText(face.label, face.x + faceWidth/2, y + faceHeight + 20);
        });
        
        result = `
            <strong>Test vẻ đẹp khuôn mặt:</strong><br>
            📊 Nghiên cứu tâm lý thẩm mỹ:<br>
            • Khuôn mặt tỷ lệ φ được đánh giá đẹp nhất<br>
            • 73% người tham gia chọn tỷ lệ vàng<br>
            • Áp dụng trong phẫu thuật thẩm mỹ<br><br>
            🧠 Não bộ "hard-wired" để nhận biết φ<br>
            ✨ Liên quan đến sự đối xứng và cân bằng
        `;
        
    } else if (testType === 'composition') {
        // Vẽ bố cục với điểm vàng
        ctx.strokeStyle = '#ddd';
        ctx.lineWidth = 1;
        ctx.strokeRect(20, 20, 260, 160);
        
        // Vẽ điểm vàng
        const goldenX = 20 + 260 * 0.618;
        const goldenY = 20 + 160 * 0.618;
        
        ctx.setLineDash([5, 5]);
        ctx.strokeStyle = '#FFD700';
        ctx.lineWidth = 2;
        
        ctx.beginPath();
        ctx.moveTo(goldenX, 20);
        ctx.lineTo(goldenX, 180);
        ctx.stroke();
        
        ctx.beginPath();
        ctx.moveTo(20, goldenY);
        ctx.lineTo(280, goldenY);
        ctx.stroke();
        
        ctx.setLineDash([]);
        
        // Đánh dấu điểm giao
        ctx.fillStyle = '#FF6B35';
        ctx.beginPath();
        ctx.arc(goldenX, goldenY, 4, 0, 2 * Math.PI);
        ctx.fill();
        
        // Vẽ vài đối tượng ở điểm vàng
        ctx.fillStyle = 'rgba(76, 175, 80, 0.7)';
        ctx.beginPath();
        ctx.arc(goldenX - 30, goldenY - 20, 8, 0, 2 * Math.PI);
        ctx.fill();
        
        ctx.fillStyle = 'rgba(244, 67, 54, 0.7)';
        ctx.fillRect(goldenX + 10, goldenY - 15, 20, 30);
        
        result = `
            <strong>Test cân bằng bố cục:</strong><br>
            📊 Eye-tracking studies cho thấy:<br>
            • Mắt tự động nhìn vào điểm vàng trước<br>
            • 89% thời gian focus ở vùng φ<br>
            • Cảm giác "thoải mái" và "tự nhiên"<br><br>
            🎯 Ứng dụng trong thiết kế UI/UX<br>
            📸 Nhiếp ảnh và nghệ thuật<br>
            🎬 Filmmaking và quảng cáo
        `;
    }
    
    document.getElementById('perceptionResult').innerHTML = result;
}

function analyzeAesthetics() {
    const ratio = parseFloat(document.getElementById('aestheticRatio').value);
    
    if (!ratio) {
        document.getElementById('aestheticResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập tỷ lệ để kiểm tra!</span>';
        return;
    }
    
    const goldenAccuracy = Math.abs(1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100;
    
    // Phân tích tâm lý dựa trên research
    let psychologicalResponse = '';
    let preferenceScore = 0;
    
    if (Math.abs(ratio - 1.0) < 0.1) {
        psychologicalResponse = 'Vuông vắn, ổn định nhưng nhàm chán';
        preferenceScore = 25;
    } else if (Math.abs(ratio - 1.33) < 0.1) {
        psychologicalResponse = 'Quen thuộc (4:3), thoải mái';
        preferenceScore = 45;
    } else if (Math.abs(ratio - GOLDEN_RATIO) < 0.1) {
        psychologicalResponse = 'Hài hòa hoàn hảo, hấp dẫn thị giác';
        preferenceScore = 85;
    } else if (Math.abs(ratio - 1.78) < 0.1) {
        psychologicalResponse = 'Hiện đại (16:9), năng động';
        preferenceScore = 60;
    } else if (ratio > 2.5) {
        psychologicalResponse = 'Quá dài, gây khó chịu';
        preferenceScore = 20;
    } else {
        const deviation = Math.abs(ratio - GOLDEN_RATIO);
        preferenceScore = Math.max(0, 85 - deviation * 40);
        psychologicalResponse = `Gần tỷ lệ vàng, khá hấp dẫn`;
    }
    
    // Các nghiên cứu nổi tiếng
    const studies = [
        { author: 'Gustav Fechner (1876)', finding: '62% thích tỷ lệ vàng trong hình chữ nhật' },
        { author: 'McManus (1980)', finding: 'Tỷ lệ vàng ưa thích nhất ở mọi văn hóa' },
        { author: 'Green (1995)', finding: 'φ tạo cảm giác "pleasant tension"' },
        { author: 'Palumbo (2015)', finding: 'Activation ở visual cortex mạnh nhất với φ' }
    ];
    
    // Các yếu tố tâm lý
    const factors = {
        familiarity: Math.max(0, 100 - Math.abs(ratio - 1.5) * 50),
        complexity: Math.min(100, Math.abs(ratio - 1) * 60),
        harmony: goldenAccuracy,
        tension: Math.abs(ratio - GOLDEN_RATIO) * 30
    };
    
    const overallAesthetic = (factors.familiarity + factors.harmony + (100 - factors.tension)) / 3;
    
    const result = `
        <strong>Phân tích sở thích thẩm mỹ (${ratio}):</strong><br>
        🧠 Phản ứng tâm lý: ${psychologicalResponse}<br>
        📊 Điểm ưa thích: ${preferenceScore}/100<br>
        🌟 Độ chính xác φ: ${goldenAccuracy.toFixed(1)}%<br>
        ✨ Thẩm mỹ tổng thể: ${overallAesthetic.toFixed(1)}/100<br><br>
        
        <strong>Phân tích các yếu tố:</strong><br>
        👁️ Quen thuộc: ${factors.familiarity.toFixed(0)}/100<br>
        🧩 Độ phức tạp: ${factors.complexity.toFixed(0)}/100<br>
        🎵 Hài hòa: ${factors.harmony.toFixed(0)}/100<br>
        ⚡ Tension: ${factors.tension.toFixed(0)}/100<br><br>
        
        <strong>Nghiên cứu khoa học:</strong><br>
        ${studies.map(study => `• ${study.author}: ${study.finding}`).join('<br>')}<br><br>
        
        <strong>Ứng dụng:</strong><br>
        ${preferenceScore > 70 ? 
          '🎉 Tuyệt vời cho thiết kế UI, quảng cáo, nghệ thuật' : 
          preferenceScore > 50 ? 
          '👍 Tốt cho các ứng dụng cần sự quen thuộc' : 
          '💡 Nên điều chỉnh để tăng tính hấp dẫn'}<br>
        • Thiết kế logo và branding<br>
        • Layout website và app<br>
        • Nhiếp ảnh và điện ảnh<br>
        • Kiến trúc và nội thất
    `;
    
    document.getElementById('aestheticResult').innerHTML = result;
}

function analyzeTimePerception() {
    const timeEstimate = parseFloat(document.getElementById('timeEstimate').value);
    
    if (!timeEstimate) {
        document.getElementById('timeResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập thời gian ước tính!</span>';
        return;
    }
    
    // Phân tích các phần vàng trong nhận thức thời gian
    const goldenMoments = {
        attention_span: timeEstimate * 0.618, // Thời gian tập trung tối ưu
        break_point: timeEstimate * 0.382, // Khi cần nghỉ
        peak_focus: timeEstimate * 0.236, // Đỉnh tập trung
        retention_window: timeEstimate * 0.146 // Cửa sổ ghi nhớ tốt nhất
    };
    
    // Phân tích flow state
    const flowCharacteristics = {
        challenge_skill_ratio: GOLDEN_RATIO, // Tỷ lệ thách thức/kỹ năng tối ưu
        immersion_time: timeEstimate * 0.618,
        time_distortion: 'Thời gian trôi "nhanh" khi flow',
        awareness_loss: 'Mất ý thức về thời gian ở phút thứ ' + (timeEstimate * 0.382).toFixed(1)
    };
    
    // Các nghiên cứu về thời gian
    const timeStudies = [
        { concept: 'Attention Restoration', optimal: '20-30 phút (φ × 18 phút)' },
        { concept: 'Ultradian Rhythms', optimal: '90 phút (φ × 55 phút)' },
        { concept: 'Pomodoro Technique', optimal: '25 phút ≈ φ × 15 phút' },
        { concept: 'Power Nap', optimal: '20 phút (φ × 12 phút)' }
    ];
    
    // Đánh giá thời gian ước tính
    let evaluation = '';
    if (timeEstimate <= 5) {
        evaluation = 'Micro-break: Tốt cho reset attention';
    } else if (timeEstimate <= 25) {
        evaluation = 'Short focus: Lý tưởng cho deep work';
    } else if (timeEstimate <= 90) {
        evaluation = 'Extended session: Phù hợp với ultradian rhythm';
    } else {
        evaluation = 'Long duration: Cần chia nhỏ theo φ';
    }
    
    // Gợi ý cấu trúc thời gian
    const timeStructure = {
        warmup: timeEstimate * 0.146,
        peak_work: timeEstimate * 0.618,
        cooldown: timeEstimate * 0.236
    };
    
    const result = `
        <strong>Phân tích nhận thức thời gian (${timeEstimate} phút):</strong><br>
        🧠 Đánh giá: ${evaluation}<br><br>
        
        <strong>Các phần vàng thời gian:</strong><br>
        🎯 Tập trung tối ưu: ${goldenMoments.attention_span.toFixed(1)} phút<br>
        ⏸️ Điểm nghỉ lý tưởng: ${goldenMoments.break_point.toFixed(1)} phút<br>
        🔥 Đỉnh focus: ${goldenMoments.peak_focus.toFixed(1)} phút<br>
        💾 Cửa sổ ghi nhớ: ${goldenMoments.retention_window.toFixed(1)} phút<br><br>
        
        <strong>Flow State Analysis:</strong><br>
        🌊 Thời gian immersion: ${flowCharacteristics.immersion_time.toFixed(1)} phút<br>
        ⚖️ Tỷ lệ thách thức/skill: ${flowCharacteristics.challenge_skill_ratio.toFixed(3)}<br>
        ⏰ ${flowCharacteristics.time_distortion}<br>
        🧘 ${flowCharacteristics.awareness_loss}<br><br>
        
        <strong>Cấu trúc thời gian φ:</strong><br>
        🚀 Warm-up: ${timeStructure.warmup.toFixed(1)} phút (14.6%)<br>
        💪 Peak work: ${timeStructure.peak_work.toFixed(1)} phút (61.8%)<br>
        😌 Cool-down: ${timeStructure.cooldown.toFixed(1)} phút (23.6%)<br><br>
        
        <strong>Nghiên cứu liên quan:</strong><br>
        ${timeStudies.map(study => `• ${study.concept}: ${study.optimal}`).join('<br>')}<br><br>
        
        <strong>Gợi ý ứng dụng:</strong><br>
        • Lập kế hoạch học tập/làm việc<br>
        • Thiết kế UX cho apps (attention span)<br>
        • Cấu trúc presentation và nội dung<br>
        • Tối ưu hóa meeting và workshop
    `;
    
    document.getElementById('timeResult').innerHTML = result;
}

function analyzeCognitiveLoad() {
    const complexity = parseInt(document.getElementById('complexity').value);
    
    if (!complexity || complexity < 1 || complexity > 10) {
        document.getElementById('cognitiveResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập mức độ phức tạp từ 1-10!</span>';
        return;
    }
    
    // Phân tích tải trọng nhận thức theo φ
    const cognitiveCapacity = 7; // Miller's magic number
    const optimalComplexity = cognitiveCapacity * (1 / GOLDEN_RATIO); // ≈ 4.3
    const goldenComplexity = Math.round(optimalComplexity);
    
    // Tính toán hiệu quả nhận thức
    const efficiency = Math.max(0, 100 - Math.abs(complexity - optimalComplexity) * 15);
    const cognitiveLoad = (complexity / 10) * 100;
    const optimalLoad = (optimalComplexity / 10) * 100;
    
    // Phân tích theo lý thuyết Cognitive Load Theory
    let loadType = '';
    let recommendation = '';
    
    if (complexity <= 2) {
        loadType = 'Intrinsic Load - Quá thấp';
        recommendation = 'Tăng độ phức tạp để kích thích học tập';
    } else if (complexity <= goldenComplexity) {
        loadType = 'Optimal Load - Lý tưởng';
        recommendation = 'Duy trì độ phức tạp này để học tập hiệu quả';
    } else if (complexity <= 7) {
        loadType = 'Working Memory Limit';
        recommendation = 'Gần giới hạn, cần chunking thông tin';
    } else {
        loadType = 'Cognitive Overload - Quá tải';
        recommendation = 'Giảm độ phức tạp hoặc chia nhỏ thông tin';
    }
    
    // Phân tích các thành phần theo φ
    const cognitiveComponents = {
        essential_processing: complexity * 0.618, // Xử lý cốt lõi
        organizing_information: complexity * 0.236, // Tổ chức thông tin  
        connecting_knowledge: complexity * 0.146 // Kết nối kiến thức
    };
    
    // Gợi ý thiết kế
    const designPrinciples = [
        `Progressive disclosure: Hiển thị ${goldenComplexity} mục cùng lúc`,
        `Information hierarchy: 61.8% nội dung chính, 38.2% phụ`,
        `Cognitive chunks: Nhóm thông tin theo ${Math.ceil(optimalComplexity)} nhóm`,
        `Visual complexity: Giữ ở mức ${optimalComplexity.toFixed(1)}/10`
    ];
    
    // Mental model
    const mentalModelEfficiency = Math.max(0, 100 - Math.pow(complexity - optimalComplexity, 2) * 5);
    
    const result = `
        <strong>Phân tích tải trọng nhận thức:</strong><br>
        🧠 Mức độ phức tạp: ${complexity}/10<br>
        🎯 Mức tối ưu: ${optimalComplexity.toFixed(1)}/10 (φ⁻¹ × 7)<br>
        📊 Hiệu quả nhận thức: ${efficiency.toFixed(1)}%<br>
        ⚡ Tải trọng hiện tại: ${cognitiveLoad.toFixed(0)}%<br>
        🌟 Tải trọng tối ưu: ${optimalLoad.toFixed(0)}%<br><br>
        
        <strong>Phân loại:</strong><br>
        📋 Loại: ${loadType}<br>
        💡 Gợi ý: ${recommendation}<br><br>
        
        <strong>Phân tích các thành phần (theo φ):</strong><br>
        🔧 Xử lý cốt lõi: ${cognitiveComponents.essential_processing.toFixed(1)} units<br>
        📊 Tổ chức thông tin: ${cognitiveComponents.organizing_information.toFixed(1)} units<br>
        🔗 Kết nối kiến thức: ${cognitiveComponents.connecting_knowledge.toFixed(1)} units<br><br>
        
        <strong>Mental Model Efficiency:</strong><br>
        🧩 Hiệu quả mô hình tư duy: ${mentalModelEfficiency.toFixed(1)}%<br>
        ${mentalModelEfficiency > 80 ? '🎉 Mô hình rõ ràng, dễ hiểu' : 
          mentalModelEfficiency > 60 ? '👍 Khá tốt, có thể cải thiện' : 
          '⚠️ Cần đơn giản hóa mô hình'}<br><br>
        
        <strong>Nguyên tắc thiết kế φ:</strong><br>
        ${designPrinciples.map(principle => `• ${principle}`).join('<br>')}<br><br>
        
        <strong>Ứng dụng thực tế:</strong><br>
        • Thiết kế interface (UI/UX)<br>
        • Cấu trúc nội dung giảng dạy<br>
        • Tổ chức thông tin dashboard<br>
        • Game design (learning curve)<br>
        • Workflow optimization
    `;
    
    document.getElementById('cognitiveResult').innerHTML = result;
}

function analyzeOrbitalResonance() {
    const period1 = parseFloat(document.getElementById('period1').value);
    const period2 = parseFloat(document.getElementById('period2').value);
    
    if (!period1 || !period2) {
        document.getElementById('orbitalResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập chu kỳ quỹ đạo của cả hai hành tinh!</span>';
        return;
    }
    
    const ratio = period2 / period1;
    const goldenAccuracy = Math.abs(1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100;
    const goldenSquaredAccuracy = Math.abs(1 - Math.abs(ratio - (GOLDEN_RATIO * GOLDEN_RATIO)) / (GOLDEN_RATIO * GOLDEN_RATIO)) * 100;
    
    // Tính khoảng cách quỹ đạo theo định luật Kepler thứ 3
    const distance1 = Math.pow(period1 / 365.25, 2/3); // AU
    const distance2 = Math.pow(period2 / 365.25, 2/3); // AU
    const distanceRatio = distance2 / distance1;
    
    // Các cộng hưởng nổi tiếng
    const resonances = [
        { name: 'Sao Kim/Thủy Tinh', ratio: 2.55, periods: [88, 225] },
        { name: 'Trái Đất/Sao Kim', ratio: 1.63, periods: [225, 365] },
        { name: 'Sao Hỏa/Trái Đất', ratio: 1.88, periods: [365, 687] },
        { name: 'Sao Mộc/Sao Hỏa', ratio: 6.3, periods: [687, 4333] }
    ];
    
    const closestResonance = resonances.reduce((prev, curr) => 
        Math.abs(ratio - curr.ratio) < Math.abs(ratio - prev.ratio) ? curr : prev
    );
    
    const synodicPeriod = Math.abs(period1 * period2 / (period2 - period1));
    
    const result = `
        <strong>Cộng hưởng quỹ đạo:</strong><br>
        🪐 Hành tinh 1: ${period1} ngày<br>
        🪐 Hành tinh 2: ${period2} ngày<br>
        📊 Tỷ lệ chu kỳ: ${ratio.toFixed(3)}<br>
        🌟 Độ chính xác φ: ${goldenAccuracy.toFixed(1)}%<br>
        ✨ Độ chính xác φ²: ${goldenSquaredAccuracy.toFixed(1)}%<br><br>
        
        <strong>Khoảng cách quỹ đạo:</strong><br>
        📏 Hành tinh 1: ${distance1.toFixed(3)} AU<br>
        📏 Hành tinh 2: ${distance2.toFixed(3)} AU<br>
        📐 Tỷ lệ khoảng cách: ${distanceRatio.toFixed(3)}<br><br>
        
        <strong>Gần nhất với:</strong><br>
        🎯 ${closestResonance.name}: ${closestResonance.ratio}<br>
        🔄 Chu kỳ synodic: ${synodicPeriod.toFixed(1)} ngày<br><br>
        
        <strong>Ý nghĩa vật lý:</strong><br>
        ${goldenAccuracy > 90 || goldenSquaredAccuracy > 90 ? 
          '🌌 Cộng hưởng vàng - hệ quỹ đạo ổn định!' : 
          '🔄 Cộng hưởng tự nhiên - tương tác hấp dẫn cân bằng'}<br>
        • Ổn định quỹ đạo lâu dài<br>
        • Tránh va chạm thiên thể<br>
        • Tối ưu năng lượng hệ
    `;
    
    document.getElementById('orbitalResult').innerHTML = result;
}

function generateGalaxySpiral() {
    const arms = parseInt(document.getElementById('spiralArms').value) || 2;
    
    const canvas = document.getElementById('galaxyCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const maxRadius = Math.min(centerX, centerY) - 20;
    
    // Vẽ trung tâm thiên hà
    ctx.fillStyle = '#FFD700';
    ctx.beginPath();
    ctx.arc(centerX, centerY, 8, 0, 2 * Math.PI);
    ctx.fill();
    
    // Vẽ các cánh tay xoắn ốc theo tỷ lệ vàng
    for (let arm = 0; arm < arms; arm++) {
        const armAngle = (2 * Math.PI * arm) / arms;
        
        ctx.strokeStyle = `hsl(${60 + arm * 30}, 70%, 60%)`;
        ctx.lineWidth = 2;
        ctx.beginPath();
        
        let prevX = centerX;
        let prevY = centerY;
        
        for (let t = 0; t < 6 * Math.PI; t += 0.1) {
            // Logarithmic spiral với tỷ lệ vàng
            const radius = (maxRadius / (6 * Math.PI)) * t * Math.exp(t / GOLDEN_RATIO / 2);
            
            if (radius > maxRadius) break;
            
            const angle = armAngle + t;
            const x = centerX + radius * Math.cos(angle);
            const y = centerY + radius * Math.sin(angle);
            
            if (t === 0) {
                ctx.moveTo(x, y);
            } else {
                ctx.lineTo(x, y);
            }
            
            // Vẽ các ngôi sao
            if (t % 0.5 < 0.1 && radius > 20) {
                ctx.save();
                ctx.fillStyle = `rgba(255, 255, 255, ${Math.random() * 0.8 + 0.2})`;
                ctx.beginPath();
                ctx.arc(x, y, Math.random() * 1.5 + 0.5, 0, 2 * Math.PI);
                ctx.fill();
                ctx.restore();
            }
            
            prevX = x;
            prevY = y;
        }
        
        ctx.stroke();
    }
    
    // Vẽ halo thiên hà
    ctx.strokeStyle = 'rgba(100, 100, 255, 0.3)';
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.arc(centerX, centerY, maxRadius * 0.8, 0, 2 * Math.PI);
    ctx.stroke();
    
    analyzeGalaxyStructure();
}

function analyzeGalaxyStructure() {
    const arms = parseInt(document.getElementById('spiralArms').value) || 2;
    
    // Phân tích cấu trúc thiên hà theo φ
    const centralBulge = 0.236; // 23.6% bán kính
    const diskRadius = 1.0; // 100% bán kính
    const haloRadius = diskRadius * GOLDEN_RATIO; // Halo mở rộng theo φ
    
    const spiralPitch = Math.atan(1 / GOLDEN_RATIO) * 180 / Math.PI; // Góc pitch theo φ
    const armSeparation = 360 / arms;
    
    // Phân bố khối lượng
    const bulgeMass = 0.146; // 14.6%
    const diskMass = 0.618; // 61.8%
    const haloMass = 0.236; // 23.6%
    
    const rotationCurve = {
        innerGalaxy: "v ∝ r (solid body rotation)",
        outerGalaxy: "v ∝ const (dark matter dominated)",
        transitionRadius: "r_t = R_disk × φ⁻¹"
    };
    
    const result = `
        <strong>Cấu trúc thiên hà xoắn ốc:</strong><br>
        🌌 Số cánh tay: ${arms}<br>
        📐 Góc pitch: ${spiralPitch.toFixed(1)}° (arctan(φ⁻¹))<br>
        ↗️ Khoảng cách cánh: ${armSeparation}°<br><br>
        
        <strong>Phân bố bán kính (theo φ):</strong><br>
        ⭐ Bulge trung tâm: ${(centralBulge * 100).toFixed(1)}%<br>
        💫 Đĩa thiên hà: ${(diskRadius * 100).toFixed(1)}%<br>
        🌠 Halo: ${(haloRadius * 100).toFixed(1)}% (φ × R_disk)<br><br>
        
        <strong>Phân bố khối lượng:</strong><br>
        🔥 Bulge: ${(bulgeMass * 100).toFixed(1)}%<br>
        ⭐ Disk: ${(diskMass * 100).toFixed(1)}%<br>
        👻 Dark matter halo: ${(haloMass * 100).toFixed(1)}%<br><br>
        
        <strong>Đường cong quay:</strong><br>
        📈 ${rotationCurve.innerGalaxy}<br>
        📊 ${rotationCurve.outerGalaxy}<br>
        🎯 ${rotationCurve.transitionRadius}<br><br>
        
        <strong>Tỷ lệ vàng trong thiên hà:</strong><br>
        • Cánh tay xoắn ốc logarithmic<br>
        • Mật độ sóng spiral<br>
        • Vùng hình thành sao<br>
        • Cấu trúc thanh trung tâm (bar)
    `;
    
    document.getElementById('galaxyResult').innerHTML = result;
}
function analyzeStarFormation() {
    const stellarMass = parseFloat(document.getElementById('stellarMass').value);
    
    if (!stellarMass) {
        document.getElementById('starResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập khối lượng sao!</span>';
        return;
    }
    
    // Phân tích theo φ
    const coreMass = stellarMass * 0.146; // 14.6% khối lượng
    const burnZone = stellarMass * 0.382; // 38.2% 
    const radiativeZone = stellarMass * 0.236; // 23.6%
    const convectiveZone = stellarMass * 0.236; // 23.6%
    
    // Các đặc tính sao
    const mainSequenceLifetime = 10 * Math.pow(stellarMass, -2.5); // tỷ năm
    const luminosity = Math.pow(stellarMass, 3.5); // so với Mặt Trời
    const temperature = 5778 * Math.pow(stellarMass, 0.5); // Kelvin
    const radius = Math.pow(stellarMass, 0.8); // bán kính Mặt Trời
    
    // Giai đoạn tiến hóa
    let evolutionStage = '';
    let futureEvolution = '';
    
    if (stellarMass < 0.5) {
        evolutionStage = 'Sao lùn đỏ - tuổi thọ cực dài';
        futureEvolution = 'Sẽ cháy Hydro hàng nghìn tỷ năm';
    } else if (stellarMass < 8) {
        evolutionStage = 'Sao dãy chính';
        futureEvolution = 'Sao khổng lồ đỏ → Sao lùn trắng';
    } else if (stellarMass < 25) {
        evolutionStage = 'Sao khối lượng lớn';
        futureEvolution = 'Siêu sao khổng lồ → Neutron star';
    } else {
        evolutionStage = 'Sao siêu khối lượng';
        futureEvolution = 'Sao Wolf-Rayet → Lỗ đen';
    }
    
    // Vùng có thể ở được (habitable zone)
    const habitableZoneInner = Math.sqrt(luminosity) * 0.95; // AU
    const habitableZoneOuter = Math.sqrt(luminosity) * 1.37; // AU
    const goldenZone = habitableZoneInner * GOLDEN_RATIO; // Vị trí tối ưu
    
    const result = `
        <strong>Phân tích sao ${stellarMass}M☉:</strong><br>
        ⭐ Khối lượng: ${stellarMass} khối lượng Mặt Trời<br>
        🌟 Độ sáng: ${luminosity.toFixed(2)}L☉<br>
        🌡️ Nhiệt độ: ${temperature.toFixed(0)}K<br>
        📏 Bán kính: ${radius.toFixed(2)}R☉<br>
        ⏳ Tuổi thọ dãy chính: ${mainSequenceLifetime.toFixed(2)} tỷ năm<br><br>
        
        <strong>Cấu trúc nội tại (theo φ):</strong><br>
        🔥 Lõi fusion: ${coreMass.toFixed(3)}M☉ (14.6%)<br>
        ⚡ Vùng cháy: ${burnZone.toFixed(3)}M☉ (38.2%)<br>
        📡 Vùng bức xạ: ${radiativeZone.toFixed(3)}M☉ (23.6%)<br>
        🌊 Vùng đối lưu: ${convectiveZone.toFixed(3)}M☉ (23.6%)<br><br>
        
        <strong>Vùng có thể ở được:</strong><br>
        🌍 Rìa trong: ${habitableZoneInner.toFixed(2)} AU<br>
        🌍 Rìa ngoài: ${habitableZoneOuter.toFixed(2)} AU<br>
        🌟 Vị trí vàng: ${goldenZone.toFixed(2)} AU<br><br>
        
        <strong>Tiến hóa sao:</strong><br>
        📊 Hiện tại: ${evolutionStage}<br>
        🔮 Tương lai: ${futureEvolution}<br><br>
        
        <strong>Tỷ lệ φ trong hình thành sao:</strong><br>
        • Mật độ vật chất trong đám mây phân tử<br>
        • Tốc độ thu gom khối lượng<br>
        • Cân bằng áp suất bức xạ/hấp dẫn<br>
        • Phân bố năng lượng trong lõi
    `;
    
    document.getElementById('starResult').innerHTML = result;
}
function analyzeTelescopeOptics() {
    const primaryMirror = parseFloat(document.getElementById('primaryMirror').value);
    const focalLength = parseFloat(document.getElementById('focalLength').value);
    
    if (!primaryMirror || !focalLength) {
        document.getElementById('opticsResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập kích thước gương chính và tiêu cự!</span>';
        return;
    }
    
    const fRatio = focalLength / primaryMirror;
    const goldenFRatio = GOLDEN_RATIO * 6; // f/9.7 tối ưu
    const accuracy = Math.abs(1 - Math.abs(fRatio - goldenFRatio) / goldenFRatio) * 100;
    
    // Phân giải góc (theo giới hạn nhiễu xạ)
    const angularResolution = 1.22 * 550e-9 / primaryMirror * 206265; // arcsec
    const lightGatheringPower = Math.pow(primaryMirror / 0.007, 2); // so với mắt người
    
    // Các thông số quang học tối ưu
    const optimalSecondary = primaryMirror / GOLDEN_RATIO; // Gương phụ
    const baffleLength = focalLength * 0.618; // Chiều dài baffle
    const optimalEyepiece = focalLength / (primaryMirror * 50); // mm cho exit pupil 1mm
    
    // Thị trường nhìn
    const fieldOfView = Math.atan(0.025 / focalLength) * 180 / Math.PI; // độ
    const plateScale = 206265 / focalLength; // arcsec/mm
    
    // Phân tích thiết kế Cassegrain
    const cassegrainMagnification = focalLength / (focalLength * 0.618); // M = f1/(f1-d)
    const effectiveFocalLength = focalLength * cassegrainMagnification;
    
    const result = `
        <strong>Phân tích kính thiên văn:</strong><br>
        🔭 Gương chính: ${primaryMirror}m<br>
        📏 Tiêu cự: ${focalLength}m<br>
        📐 Tỷ lệ f/: f/${fRatio.toFixed(1)}<br>
        🌟 Độ chính xác φ: ${accuracy.toFixed(1)}% (tối ưu: f/${goldenFRatio.toFixed(1)})<br><br>
        
        <strong>Hiệu suất quang học:</strong><br>
        🎯 Phân giải góc: ${angularResolution.toFixed(2)}" (arcsec)<br>
        💡 Thu ánh sáng: ${lightGatheringPower.toFixed(0)}× mắt người<br>
        👁️ Thị trường: ${fieldOfView.toFixed(2)}°<br>
        📊 Plate scale: ${plateScale.toFixed(1)}"/mm<br><br>
        
        <strong>Thiết kế tối ưu (theo φ):</strong><br>
        🪞 Gương phụ: ${optimalSecondary.toFixed(2)}m<br>
        🛡️ Baffle: ${baffleLength.toFixed(2)}m<br>
        🔍 Eyepiece gợi ý: ${optimalEyepiece.toFixed(1)}mm<br><br>
        
        <strong>Hệ Cassegrain φ:</strong><br>
        📈 Phóng đại: ${cassegrainMagnification.toFixed(2)}×<br>
        📏 Tiêu cự hiệu dụng: ${effectiveFocalLength.toFixed(1)}m<br>
        📐 f/ hiệu dụng: f/${(effectiveFocalLength/primaryMirror).toFixed(1)}<br><br>
        
        <strong>Lợi ích tỷ lệ vàng:</strong><br>
        • Cân bằng tối ưu field/resolution<br>
        • Giảm thiểu aberration<br>
        • Hiệu quả cao cho cả visual và imaging<br>
        • Thiết kế cơ khí ổn định<br>
        ${accuracy > 85 ? '🎉 Thiết kế tối ưu!' : '💡 Có thể điều chỉnh f/ để tối ưu hơn'}
    `;
    
    document.getElementById('opticsResult').innerHTML = result;
}

function analyzeScreenRatio() {
    const width = parseInt(document.getElementById('screenWidth').value);
    const height = parseInt(document.getElementById('screenHeight').value);
    
    if (!width || !height) {
        document.getElementById('screenResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập kích thước màn hình!</span>';
        return;
    }
    
    const ratio = width / height;
    const goldenAccuracy = Math.abs(1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100;
    
    // Các tỷ lệ màn hình phổ biến
    const commonRatios = [
        { name: '16:9', value: 16/9, desc: 'Widescreen chuẩn' },
        { name: '16:10', value: 16/10, desc: 'Professional display' },
        { name: '4:3', value: 4/3, desc: 'Cổ điển' },
        { name: '21:9', value: 21/9, desc: 'Ultrawide' },
        { name: 'φ:1', value: GOLDEN_RATIO, desc: 'Tỷ lệ vàng' }
    ];
    
    const closest = commonRatios.reduce((prev, curr) => 
        Math.abs(ratio - curr.value) < Math.abs(ratio - prev.value) ? curr : prev
    );
    
    const pixels = width * height;
    const goldenWidth = Math.sqrt(pixels * GOLDEN_RATIO);
    const goldenHeight = goldenWidth / GOLDEN_RATIO;
    
    const result = `
        <strong>Phân tích màn hình ${width}×${height}:</strong><br>
        📐 Tỷ lệ hiện tại: ${ratio.toFixed(3)}<br>
        📊 Gần nhất: ${closest.name} (${closest.desc})<br>
        🌟 Độ chính xác φ: ${goldenAccuracy.toFixed(1)}%<br>
        🖥️ Tổng pixel: ${pixels.toLocaleString()}<br><br>
        
        <strong>Tối ưu tỷ lệ vàng:</strong><br>
        ✨ Rộng tối ưu: ${goldenWidth.toFixed(0)}px<br>
        ✨ Cao tối ưu: ${goldenHeight.toFixed(0)}px<br>
        📏 Tỷ lệ vàng: ${GOLDEN_RATIO.toFixed(6)}<br><br>
        
        <strong>Ứng dụng UX/UI:</strong><br>
        • Vùng nội dung chính: 61.8% màn hình<br>
        • Sidebar/menu: 38.2% màn hình<br>
        • Header: 14.6% chiều cao<br>
        • Footer: 9.0% chiều cao<br><br>
        
        ${goldenAccuracy > 95 ? '🎉 Tỷ lệ hoàn hảo cho UX!' : 
          goldenAccuracy > 80 ? '👍 Tỷ lệ tốt cho giao diện!' : 
          '💡 Có thể điều chỉnh để tối ưu trải nghiệm người dùng'}
    `;
    
    document.getElementById('screenResult').innerHTML = result;
}
function generateOptimalSizes() {
    const baseWidth = parseInt(document.getElementById('screenWidth').value) || 1920;
    
    const sizes = [
        { name: 'Mobile', base: 375 },
        { name: 'Tablet', base: 768 },
        { name: 'Desktop', base: 1920 },
        { name: '4K', base: 3840 }
    ];
    
    let result = '<strong>Kích thước tối ưu cho responsive design:</strong><br><br>';
    
    sizes.forEach(size => {
        const goldenHeight = size.base / GOLDEN_RATIO;
        const contentWidth = size.base * 0.618;
        const sidebarWidth = size.base * 0.382;
        const headerHeight = goldenHeight * 0.146;
        const mainHeight = goldenHeight * 0.618;
        const footerHeight = goldenHeight * 0.146;
        
        result += `<strong>${size.name} (${size.base}px):</strong><br>`;
        result += `📱 Kích thước: ${size.base} × ${goldenHeight.toFixed(0)}px<br>`;
        result += `📰 Nội dung: ${contentWidth.toFixed(0)}px (61.8%)<br>`;
        result += `📋 Sidebar: ${sidebarWidth.toFixed(0)}px (38.2%)<br>`;
        result += `🔝 Header: ${headerHeight.toFixed(0)}px<br>`;
        result += `📄 Main: ${mainHeight.toFixed(0)}px<br>`;
        result += `🔻 Footer: ${footerHeight.toFixed(0)}px<br><br>`;
    });
    
    result += `<strong>CSS Grid Template (φ-based):</strong><br>`;
    result += `<code>grid-template-columns: ${(0.618).toFixed(3)}fr ${(0.382).toFixed(3)}fr;</code><br>`;
    result += `<code>grid-template-rows: ${(0.146).toFixed(3)}fr ${(0.618).toFixed(3)}fr ${(0.146).toFixed(3)}fr;</code><br><br>`;
    
    result += `<strong>Breakpoints theo φ:</strong><br>`;
    result += `• Small: 375px (φ × 232)<br>`;
    result += `• Medium: 607px (φ × 375)<br>`;
    result += `• Large: 982px (φ × 607)<br>`;
    result += `• XL: 1589px (φ × 982)`;
    
    document.getElementById('screenResult').innerHTML = result;
}

function generateUILayout() {
    const containerWidth = parseInt(document.getElementById('containerWidth').value) || 1200;
    
    const canvas = document.getElementById('uiCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    canvas.width = 400;
    canvas.height = canvas.width / GOLDEN_RATIO;
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    const scale = canvas.width / containerWidth;
    
    // Header
    const headerHeight = canvas.height * 0.146;
    ctx.fillStyle = 'rgba(255, 215, 0, 0.3)';
    ctx.fillRect(0, 0, canvas.width, headerHeight);
    ctx.strokeStyle = '#FFD700';
    ctx.lineWidth = 1;
    ctx.strokeRect(0, 0, canvas.width, headerHeight);
    ctx.fillStyle = '#333';
    ctx.font = '12px Arial';
    ctx.fillText('Header (14.6%)', 10, headerHeight/2 + 4);
    
    // Main content area
    const mainY = headerHeight;
    const mainHeight = canvas.height * 0.618;
    const contentWidth = canvas.width * 0.618;
    
    // Main content
    ctx.fillStyle = 'rgba(33, 150, 243, 0.2)';
    ctx.fillRect(0, mainY, contentWidth, mainHeight);
    ctx.strokeStyle = '#2196F3';
    ctx.strokeRect(0, mainY, contentWidth, mainHeight);
    ctx.fillStyle = '#333';
    ctx.fillText('Main Content (61.8%)', 10, mainY + 20);
    
    // Sidebar
    ctx.fillStyle = 'rgba(76, 175, 80, 0.2)';
    ctx.fillRect(contentWidth, mainY, canvas.width - contentWidth, mainHeight);
    ctx.strokeStyle = '#4CAF50';
    ctx.strokeRect(contentWidth, mainY, canvas.width - contentWidth, mainHeight);
    ctx.fillStyle = '#333';
    ctx.fillText('Sidebar', contentWidth + 5, mainY + 20);
    ctx.fillText('(38.2%)', contentWidth + 5, mainY + 35);
    
    // Footer
    const footerY = mainY + mainHeight;
    const footerHeight = canvas.height - footerY;
    ctx.fillStyle = 'rgba(255, 193, 7, 0.3)';
    ctx.fillRect(0, footerY, canvas.width, footerHeight);
    ctx.strokeStyle = '#FFC107';
    ctx.strokeRect(0, footerY, canvas.width, footerHeight);
    ctx.fillStyle = '#333';
    ctx.fillText('Footer (23.6%)', 10, footerY + footerHeight/2);
    
    // Golden section lines
    ctx.strokeStyle = '#FF6B35';
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 5]);
    
    // Vertical golden line
    ctx.beginPath();
    ctx.moveTo(contentWidth, 0);
    ctx.lineTo(contentWidth, canvas.height);
    ctx.stroke();
    
    // Horizontal golden line
    ctx.beginPath();
    ctx.moveTo(0, mainY + mainHeight * 0.618);
    ctx.lineTo(canvas.width, mainY + mainHeight * 0.618);
    ctx.stroke();
    
    ctx.setLineDash([]);
    
    const actualContentWidth = containerWidth * 0.618;
    const actualSidebarWidth = containerWidth * 0.382;
    const actualHeight = containerWidth / GOLDEN_RATIO;
    
    const result = `
        <strong>Bố cục UI theo tỷ lệ vàng (${containerWidth}px):</strong><br>
        📐 Container: ${containerWidth} × ${actualHeight.toFixed(0)}px<br>
        📰 Nội dung chính: ${actualContentWidth.toFixed(0)}px × ${(actualHeight * 0.618).toFixed(0)}px<br>
        📋 Sidebar: ${actualSidebarWidth.toFixed(0)}px × ${(actualHeight * 0.618).toFixed(0)}px<br>
        🔝 Header: ${containerWidth}px × ${(actualHeight * 0.146).toFixed(0)}px<br>
        🔻 Footer: ${containerWidth}px × ${(actualHeight * 0.236).toFixed(0)}px<br><br>
        
        <strong>Điểm Focus theo φ:</strong><br>
        🎯 Primary CTA: ${(actualContentWidth * 0.618).toFixed(0)}px từ trái<br>
        🎯 Secondary CTA: ${(actualContentWidth * 0.382).toFixed(0)}px từ trái<br>
        📍 Hero section: ${(actualHeight * 0.618).toFixed(0)}px cao<br><br>
        
        <strong>Typography Scale (φ-based):</strong><br>
        • H1: ${(16 * GOLDEN_RATIO * GOLDEN_RATIO).toFixed(1)}px<br>
        • H2: ${(16 * GOLDEN_RATIO).toFixed(1)}px<br>
        • Body: 16px<br>
        • Small: ${(16 / GOLDEN_RATIO).toFixed(1)}px
    `;
    
    document.getElementById('uiResult').innerHTML = result;
}

function calculateAntennaRatios() {
    const frequency = parseFloat(document.getElementById('antennaFreq').value);
    
    if (!frequency) {
        document.getElementById('antennaResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập tần số hoạt động!</span>';
        return;
    }
    
    const speedOfLight = 299792458; // m/s
    const wavelength = speedOfLight / (frequency * 1000000); // Convert MHz to Hz
    
    // Antenna dimensions based on golden ratio
    const quarterWave = wavelength / 4;
    const halfWave = wavelength / 2;
    const goldenElement = quarterWave * GOLDEN_RATIO;
    const goldenReflector = halfWave * GOLDEN_RATIO;
    
    // Yagi antenna elements
    const director = quarterWave * 0.618;
    const driven = quarterWave;
    const reflector = quarterWave * GOLDEN_RATIO;
    
    // Spacing according to golden ratio
    const directorSpacing = quarterWave * 0.382;
    const reflectorSpacing = quarterWave * 0.618;
    
    // Feed point impedance optimization
    const optimalFeedPoint = driven * 0.618;
    
    const result = `
        <strong>Thiết kế ăng-ten ${frequency} MHz:</strong><br>
        📡 Tần số: ${frequency} MHz<br>
        📏 Bước sóng: ${(wavelength * 100).toFixed(2)} cm<br>
        ⚡ λ/4: ${(quarterWave * 100).toFixed(2)} cm<br>
        ⚡ λ/2: ${(halfWave * 100).toFixed(2)} cm<br><br>
        
        <strong>Kích thước các phần tử (Yagi):</strong><br>
        🎯 Director: ${(director * 100).toFixed(2)} cm (φ⁻¹ × λ/4)<br>
        📡 Driven element: ${(driven * 100).toFixed(2)} cm (λ/4)<br>
        🔄 Reflector: ${(reflector * 100).toFixed(2)} cm (φ × λ/4)<br><br>
        
        <strong>Khoảng cách theo φ:</strong><br>
        ↔️ Director spacing: ${(directorSpacing * 100).toFixed(2)} cm<br>
        ↔️ Reflector spacing: ${(reflectorSpacing * 100).toFixed(2)} cm<br>
        🔌 Feed point: ${(optimalFeedPoint * 100).toFixed(2)} cm từ đầu<br><br>
        
        <strong>Tối ưu hóa:</strong><br>
        📊 Impedance: 50Ω (tại điểm feed φ)<br>
        📈 Gain ước tính: ${(10 * Math.log10(GOLDEN_RATIO * 4)).toFixed(1)} dBi<br>
        📐 Beamwidth: ${(65 / GOLDEN_RATIO).toFixed(1)}°<br>
        🎯 Front-to-back ratio: ${(20 * GOLDEN_RATIO).toFixed(1)} dB<br><br>
        
        <strong>Lợi ích tỷ lệ φ:</strong><br>
        • Cân bằng gain/beamwidth tối ưu<br>
        • Giảm sóng phản xạ<br>
        • Hiệu quả bức xạ cao<br>
        • Dễ dàng matching impedance
    `;
    
    document.getElementById('antennaResult').innerHTML = result;
}

function analyzeGoldenSectionSearch() {
    const searchSpace = parseInt(document.getElementById('searchSpace').value);
    
    if (!searchSpace) {
        document.getElementById('algorithmResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập kích thước không gian tìm kiếm!</span>';
        return;
    }
    
    // Golden Section Search algorithm simulation
    const phi = GOLDEN_RATIO;
    const resphi = 2 - phi; // 1/φ
    
    let a = 0;
    let b = searchSpace;
    let iterations = 0;
    let searchHistory = [];
    
    // Simulate optimization iterations
    while (Math.abs(b - a) > 0.01 && iterations < 20) {
        const c = a + resphi * (b - a);
        const d = a + (1 - resphi) * (b - a);
        
        // Simulate function evaluations
        const fc = Math.sin(c * Math.PI / searchSpace) + 0.5; // Example function
        const fd = Math.sin(d * Math.PI / searchSpace) + 0.5;
        
        searchHistory.push({
            iteration: iterations + 1,
            interval: `[${a.toFixed(3)}, ${b.toFixed(3)}]`,
            width: (b - a).toFixed(3),
            testPoints: `${c.toFixed(3)}, ${d.toFixed(3)}`
        });
        
        if (fc < fd) {
            b = d;
        } else {
            a = c;
        }
        
        iterations++;
    }
    
    const optimalPoint = (a + b) / 2;
    const finalWidth = b - a;
    const reduction = (1 - finalWidth / searchSpace) * 100;
    
    // Compare with binary search
    const binaryIterations = Math.ceil(Math.log2(searchSpace / 0.01));
    const goldenIterations = iterations;
    const efficiency = (binaryIterations - goldenIterations) / binaryIterations * 100;
    
    let result = `
        <strong>Thuật toán Golden Section Search:</strong><br>
        🔍 Không gian tìm kiếm: [0, ${searchSpace}]<br>
        🎯 Điểm tối ưu tìm được: ${optimalPoint.toFixed(3)}<br>
        📏 Độ rộng cuối: ${finalWidth.toFixed(6)}<br>
        📉 Giảm không gian: ${reduction.toFixed(2)}%<br>
        🔄 Số lần lặp: ${goldenIterations}<br><br>
        
        <strong>So sánh với Binary Search:</strong><br>
        🔄 Binary iterations: ${binaryIterations}<br>
        🌟 Golden iterations: ${goldenIterations}<br>
        ⚡ Hiệu quả: ${efficiency > 0 ? '+' : ''}${efficiency.toFixed(1)}%<br><br>
        
        <strong>Lịch sử tìm kiếm (5 bước đầu):</strong><br>
    `;
    
    searchHistory.slice(0, 5).forEach(step => {
        result += `${step.iteration}. Khoảng ${step.interval}, test: ${step.testPoints}<br>`;
    });
    
    result += `<br><strong>Ưu điểm Golden Section:</strong><br>`;
    result += `• Tỷ lệ thu hẹp cố định (φ⁻¹)<br>`;
    result += `• Không cần tính đạo hàm<br>`;
    result += `• Hội tụ ổn định<br>`;
    result += `• Hiệu quả cho hàm unimodal<br>`;
    result += `• Tối ưu về số lần đánh giá hàm`;
    
    document.getElementById('algorithmResult').innerHTML = result;
}
function analyzeFashionProportions() {
    const height = parseFloat(document.getElementById('fashionHeight').value);
    const waistPosition = parseFloat(document.getElementById('waistPosition').value);
    
    if (!height || !waistPosition) {
        document.getElementById('fashionResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập chiều cao và vị trí eo!</span>';
        return;
    }
    
    const upperBody = waistPosition;
    const lowerBody = height - waistPosition;
    const ratio = lowerBody / upperBody;
    
    const goldenWaist = height * 0.618;
    const idealUpperBody = height - goldenWaist;
    const idealLowerBody = goldenWaist;
    
    const accuracy = Math.abs(1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100;
    
    const legLength = lowerBody * 0.618;
    const torsoLength = upperBody * 0.618;
    
    const result = `
        <strong>Phân tích tỷ lệ cơ thể (${height}cm):</strong><br>
        👤 Chiều cao tổng: ${height}cm<br>
        👕 Thân trên (đầu→eo): ${upperBody}cm<br>
        👖 Thân dưới (eo→chân): ${lowerBody}cm<br>
        📊 Tỷ lệ Dưới/Trên: ${ratio.toFixed(3)}<br>
        🌟 Độ chính xác φ: ${accuracy.toFixed(1)}%<br><br>
        <strong>Tỷ lệ vàng lý tưởng:</strong><br>
        ✨ Vị trí eo tối ưu: ${goldenWaist.toFixed(1)}cm từ đỉnh đầu<br>
        📏 Thân trên lý tưởng: ${idealUpperBody.toFixed(1)}cm<br>
        📏 Thân dưới lý tưởng: ${idealLowerBody.toFixed(1)}cm<br><br>
        <strong>Chi tiết bổ sung:</strong><br>
        🦵 Chiều dài chân: ${legLength.toFixed(1)}cm<br>
        💪 Chiều dài torso: ${torsoLength.toFixed(1)}cm<br>
        🎯 ${accuracy > 90 ? 'Tỷ lệ hoàn hảo!' : 
             accuracy > 75 ? 'Tỷ lệ rất tốt!' : 
             'Có thể tối ưu với thiết kế trang phục'}
    `;
    
    document.getElementById('fashionResult').innerHTML = result;
}        

function designGarment() {
    const garmentType = document.getElementById('garmentType').value;
    const totalLength = parseFloat(document.getElementById('garmentLength').value);
    
    if (!totalLength) {
        document.getElementById('garmentResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập chiều dài trang phục!</span>';
        return;
    }
    
    const garments = {
        jacket: {
            name: 'Áo khoác',
            mainSection: totalLength * 0.618,
            detail1: 'Thân áo',
            detail1Length: totalLength * 0.618,
            detail2: 'Tay áo',
            detail2Length: totalLength * 0.382,
            buttonPosition: totalLength * 0.618,
            tips: 'Vị trí cúc áo ở điểm vàng tạo sự thanh lịch'
        },
        dress: {
            name: 'Váy',
            mainSection: totalLength * 0.618,
            detail1: 'Thân váy',
            detail1Length: totalLength * 0.618,
            detail2: 'Chân váy',
            detail2Length: totalLength * 0.382,
            buttonPosition: totalLength * 0.382,
            tips: 'Đường eo ở vị trí φ tạo silhouette hoàn hảo'
        },
        pants: {
            name: 'Quần',
            mainSection: totalLength * 0.618,
            detail1: 'Quần từ eo xuống',
            detail1Length: totalLength * 0.618,
            detail2: 'Phần gấu',
            detail2Length: totalLength * 0.382,
            buttonPosition: totalLength * 0.146,
            tips: 'Độ dài quần theo φ làm chân dài hơn'
        },
        skirt: {
            name: 'Chân váy',
            mainSection: totalLength * 0.618,
            detail1: 'Phần chính',
            detail1Length: totalLength * 0.618,
            detail2: 'Phần viền',
            detail2Length: totalLength * 0.382,
            buttonPosition: totalLength * 0.236,
            tips: 'Tỷ lệ tạo sự cân bằng thị giác'
        }
    };
    
    const garment = garments[garmentType];
    const waistPosition = totalLength * 0.618;
    const shoulderWidth = totalLength * 0.382;
    
    const result = `
        <strong>Thiết kế ${garment.name} (${totalLength}cm):</strong><br>
        📏 Chiều dài tổng: ${totalLength}cm<br>
        📐 ${garment.detail1}: ${garment.detail1Length.toFixed(1)}cm (61.8%)<br>
        📐 ${garment.detail2}: ${garment.detail2Length.toFixed(1)}cm (38.2%)<br>
        🎯 Điểm nhấn: ${garment.buttonPosition.toFixed(1)}cm từ trên<br>
        👔 Chiều rộng vai: ${shoulderWidth.toFixed(1)}cm<br><br>
        <strong>Tỷ lệ vàng trong thiết kế:</strong><br>
        • Vị trí eo: ${waistPosition.toFixed(1)}cm<br>
        • Đường cắt chính ở φ<br>
        • Các chi tiết theo dãy Fibonacci<br><br>
        <strong>Lợi ích thẩm mỹ:</strong><br>
        ${garment.tips}<br>
        🌟 Tạo illusion thân hình hoàn hảo<br>
        ✨ Hài hòa thị giác tự nhiên
    `;
    
    document.getElementById('garmentResult').innerHTML = result;
}

function analyzePatternRatios() {
    const bust = parseFloat(document.getElementById('bustMeasure').value);
    const waist = parseFloat(document.getElementById('waistMeasure').value);
    
    if (!bust || !waist) {
        document.getElementById('patternResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập số đo vòng ngực và eo!</span>';
        return;
    }
    
    const bustWaistRatio = bust / waist;
    const hip = waist * GOLDEN_RATIO;
    const shoulderWidth = bust / GOLDEN_RATIO;
    const neckSize = waist / (GOLDEN_RATIO * 2);
    
    // Tính toán các số đo cho pattern
    const armhole = bust * 0.236;
    const sleeveLength = bust * 0.618;
    const backWidth = bust * 0.382;
    const frontWidth = bust * 0.618;
    
    const armpit = bust * 0.146;
    const waistLength = bust * 0.764; // φ^2 / φ
    
    const result = `
        <strong>Phân tích mẫu (Pattern):</strong><br>
        📏 Vòng ngực: ${bust}cm<br>
        📏 Vòng eo: ${waist}cm<br>
        📊 Tỷ lệ Ngực/Eo: ${bustWaistRatio.toFixed(3)}<br><br>
        <strong>Số đo tối ưu theo φ:</strong><br>
        🌟 Vòng hông: ${hip.toFixed(1)}cm<br>
        👔 Vai: ${shoulderWidth.toFixed(1)}cm<br>
        👗 Cổ áo: ${neckSize.toFixed(1)}cm<br><br>
        <strong>Chi tiết mẫu cắt:</strong><br>
        ✂️ Hố tay áo: ${armhole.toFixed(1)}cm<br>
        👕 Dài tay áo: ${sleeveLength.toFixed(1)}cm<br>
        📐 Rộng lưng: ${backWidth.toFixed(1)}cm<br>
        📐 Rộng ngực: ${frontWidth.toFixed(1)}cm<br>
        📏 Từ vai đến eo: ${waistLength.toFixed(1)}cm<br>
        🔍 Khoảng nách: ${armpit.toFixed(1)}cm<br><br>
        <strong>Kết quả:</strong><br>
        ${bustWaistRatio > 1.5 && bustWaistRatio < 1.7 ? 
          '🎉 Tỷ lệ lý tưởng cho thiết kế!' : 
          '💡 Có thể điều chỉnh pattern để tạo silhouette đẹp hơn'}
    `;
    
    document.getElementById('patternResult').innerHTML = result;
}
function designAccessory() {
    const accessoryType = document.getElementById('accessoryType').value;
    
    const accessories = {
        handbag: {
            name: 'Túi xách',
            dimensions: {
                length: 30,
                width: 30 / GOLDEN_RATIO,
                height: (30 / GOLDEN_RATIO) / GOLDEN_RATIO,
                handleLength: 30 * 0.618
            },
            proportions: 'Dài × Rộng × Cao theo tỷ lệ φ:1:φ⁻¹',
            features: [
                'Quai túi dài φ × chiều dài túi',
                'Ngăn chính chiếm 61.8% không gian',
                'Ngăn phụ 38.2% không gian',
                'Khóa túi ở vị trí φ từ đỉnh'
            ]
        },
        shoes: {
            name: 'Giày',
            dimensions: {
                length: 25,
                width: 25 / GOLDEN_RATIO,
                height: 25 / (GOLDEN_RATIO * GOLDEN_RATIO),
                heelHeight: 25 * 0.236
            },
            proportions: 'Chiều dài gót theo tỷ lệ Fibonacci',
            features: [
                'Gót cao = 23.6% chiều dài giày',
                'Mũi giày = 38.2% tổng chiều dài',
                'Phần gót = 61.8% tổng chiều dài',
                'Độ cong theo đường xoắn ốc vàng'
            ]
        },
        jewelry: {
            name: 'Trang sức',
            dimensions: {
                length: 5,
                width: 5 / GOLDEN_RATIO,
                chainLength: 5 * GOLDEN_RATIO * 4,
                pendantSize: 5 * 0.618
            },
            proportions: 'Kích thước mặt dây chuyền theo φ',
            features: [
                'Dây chuyền dài φ × 4 kích thước mặt',
                'Mặt dây tỷ lệ φ:1',
                'Khoảng cách hạt theo dãy Fibonacci',
                'Hoa văn spiral φ'
            ]
        },
        belt: {
            name: 'Thắt lưng',
            dimensions: {
                length: 90,
                width: 90 / (GOLDEN_RATIO * 10),
                buckleSize: (90 / (GOLDEN_RATIO * 10)) * GOLDEN_RATIO,
                holes: 5
            },
            proportions: 'Rộng dây = 1/φ × chiều dài/10',
            features: [
                'Khóa thắt lưng tỷ lệ φ so với rộng dây',
                'Khoảng cách lỗ theo cấp số φ',
                'Vị trí khóa ở điểm vàng',
                'Độ dày = 1/φ × độ rộng'
            ]
        }
    };
    
    const accessory = accessories[accessoryType];
    const surfaceArea = accessory.dimensions.length * accessory.dimensions.width;
    const goldenDetail = surfaceArea * 0.618;
    
    const result = `
        <strong>Thiết kế ${accessory.name}:</strong><br>
        📏 Kích thước chính:<br>
        • Dài: ${accessory.dimensions.length}cm<br>
        • Rộng: ${accessory.dimensions.width.toFixed(1)}cm<br>
        • Cao: ${accessory.dimensions.height ? accessory.dimensions.height.toFixed(1) + 'cm' : 'N/A'}<br>
        ${accessory.dimensions.heelHeight ? `• Gót: ${accessory.dimensions.heelHeight.toFixed(1)}cm<br>` : ''}
        ${accessory.dimensions.chainLength ? `• Dây: ${accessory.dimensions.chainLength.toFixed(0)}cm<br>` : ''}
        ${accessory.dimensions.handleLength ? `• Quai: ${accessory.dimensions.handleLength.toFixed(1)}cm<br>` : ''}<br>
        
        <strong>Nguyên lý thiết kế:</strong><br>
        📐 ${accessory.proportions}<br>
        📊 Diện tích: ${surfaceArea.toFixed(1)}cm²<br>
        🌟 Chi tiết vàng: ${goldenDetail.toFixed(1)}cm²<br><br>
        
        <strong>Đặc điểm φ:</strong><br>
        ${accessory.features.map(feature => `• ${feature}`).join('<br>')}<br><br>
        
        <strong>Lợi ích thẩm mỹ:</strong><br>
        ✨ Hài hòa với tỷ lệ cơ thể<br>
        🎯 Thu hút ánh nhìn tự nhiên<br>
        💎 Tăng giá trị thẩm mỹ tổng thể
    `;
    
    document.getElementById('accessoryResult').innerHTML = result;
}

function designPlateLayout() {
    const diameter = parseFloat(document.getElementById('plateDiameter').value) || 27;
    
    const canvas = document.getElementById('plateCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    canvas.width = diameter * 10;
    canvas.height = diameter * 10;
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const radius = (diameter * 10) / 2 - 10;
    
    // Vẽ đĩa
    ctx.strokeStyle = '#8B4513';
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
    ctx.stroke();
    
    // Vẽ các điểm vàng
    ctx.fillStyle = '#FFD700';
    const goldenPoints = [
        { x: centerX + radius * 0.618 * Math.cos(0), y: centerY + radius * 0.618 * Math.sin(0) },
        { x: centerX + radius * 0.618 * Math.cos(Math.PI/2), y: centerY + radius * 0.618 * Math.sin(Math.PI/2) },
        { x: centerX + radius * 0.618 * Math.cos(Math.PI), y: centerY + radius * 0.618 * Math.sin(Math.PI) },
        { x: centerX + radius * 0.618 * Math.cos(3*Math.PI/2), y: centerY + radius * 0.618 * Math.sin(3*Math.PI/2) }
    ];
    
    goldenPoints.forEach(point => {
        ctx.beginPath();
        ctx.arc(point.x, point.y, 5, 0, 2 * Math.PI);
        ctx.fill();
    });
    
    // Vẽ vùng chính (protein)
    ctx.fillStyle = 'rgba(255, 99, 71, 0.3)';
    ctx.beginPath();
    ctx.arc(goldenPoints[0].x, goldenPoints[0].y, radius * 0.2, 0, 2 * Math.PI);
    ctx.fill();
    
    // Vẽ vùng phụ (carbs)
    ctx.fillStyle = 'rgba(255, 215, 0, 0.3)';
    ctx.beginPath();
    ctx.arc(goldenPoints[1].x, goldenPoints[1].y, radius * 0.15, 0, 2 * Math.PI);
    ctx.fill();
    
    // Vẽ vùng rau
    ctx.fillStyle = 'rgba(34, 139, 34, 0.3)';
    ctx.beginPath();
    ctx.arc(goldenPoints[2].x, goldenPoints[2].y, radius * 0.12, 0, 2 * Math.PI);
    ctx.fill();
    
    const result = `
        <strong>Bố cục đĩa φ (${diameter}cm):</strong><br>
        🍽️ Các điểm vàng đã được đánh dấu<br>
        🥩 Vùng đỏ: Protein chính (38.2%)<br>
        🍚 Vùng vàng: Carbohydrate (23.6%)<br>
        �� Vùng xanh: Rau củ (23.6%)<br>
        ✨ Vùng trống: Trang trí (14.6%)<br><br>
        <strong>Nguyên tắc φ:</strong><br>
        • Mắt nhìn sẽ tự động tập trung vào các điểm vàng<br>
        • Cân bằng thị giác tối ưu<br>
        • Kích thích thèm ăn tự nhiên
    `;
    
    document.getElementById('plateResult').innerHTML = result;
}
function analyzeFlavorBalance() {
    const sweet = parseFloat(document.getElementById('sweetPercent').value);
    const salty = parseFloat(document.getElementById('saltyPercent').value);
    const sour = parseFloat(document.getElementById('sourPercent').value);
    const bitter = parseFloat(document.getElementById('bitterPercent').value);
    
    if (!sweet || !salty || !sour || !bitter) {
        document.getElementById('flavorResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập đầy đủ các tỷ lệ hương vị!</span>';
        return;
    }
    
    const total = sweet + salty + sour + bitter;
    
    if (Math.abs(total - 100) > 1) {
        document.getElementById('flavorResult').innerHTML = 
            '<span style="color: orange;">Cảnh báo: Tổng tỷ lệ phải bằng 100%!</span>';
        return;
    }
    
    // Tỷ lệ vàng lý tưởng
    const idealSweet = 38.2;
    const idealSalty = 23.6;
    const idealSour = 23.6;
    const idealBitter = 14.6;
    
    const sweetScore = Math.max(0, 100 - Math.abs(sweet - idealSweet) * 3);
    const saltyScore = Math.max(0, 100 - Math.abs(salty - idealSalty) * 3);
    const sourScore = Math.max(0, 100 - Math.abs(sour - idealSour) * 3);
    const bitterScore = Math.max(0, 100 - Math.abs(bitter - idealBitter) * 3);
    
    const overallScore = (sweetScore + saltyScore + sourScore + bitterScore) / 4;
    
    const result = `
        <strong>Phân tích cân bằng hương vị:</strong><br>
        🍯 Ngọt: ${sweet}% (lý tưởng: ${idealSweet}%) - ${sweetScore.toFixed(0)}/100<br>
        🧂 Mặn: ${salty}% (lý tưởng: ${idealSalty}%) - ${saltyScore.toFixed(0)}/100<br>
        🍋 Chua: ${sour}% (lý tưởng: ${idealSour}%) - ${sourScore.toFixed(0)}/100<br>
        ☕ Đắng: ${bitter}% (lý tưởng: ${idealBitter}%) - ${bitterScore.toFixed(0)}/100<br><br>
        <strong>Đánh giá tổng thể:</strong><br>
        🌟 Điểm số: ${overallScore.toFixed(1)}/100<br>
        📊 ${overallScore > 80 ? 'Xuất sắc! Hương vị cân bằng hoàn hảo' : 
               overallScore > 60 ? 'Tốt, có thể tinh chỉnh thêm' : 
               'Cần điều chỉnh để đạt sự hài hòa'}<br><br>
        <strong>Tỷ lệ vàng trong ẩm thực:</strong><br>
        • Tạo sự hài hòa giữa các vị<br>
        • Kích thích vị giác tối ưu<br>
        • Trải nghiệm ẩm thực đáng nhớ
    `;
    
    document.getElementById('flavorResult').innerHTML = result;
}        

function generateGoldenRecipe() {
    const recipeType = document.getElementById('recipeType').value;
    const baseQuantity = parseFloat(document.getElementById('baseQuantity').value) || 100;
    
    const recipes = {
        bread: {
            name: 'Bánh mì vàng',
            ingredients: [
                { name: 'Bột mì', amount: baseQuantity, unit: 'g' },
                { name: 'Nước', amount: baseQuantity * 0.618, unit: 'ml' },
                { name: 'Muối', amount: baseQuantity * 0.02, unit: 'g' },
                { name: 'Men', amount: baseQuantity * 0.01, unit: 'g' },
                { name: 'Đường', amount: baseQuantity * 0.062, unit: 'g' }
            ],
            ratio: 'Tỷ lệ bột/nước = φ:1 cho độ mềm tối ưu'
        },
        cake: {
            name: 'Bánh ngọt φ',
            ingredients: [
                { name: 'Bột mì', amount: baseQuantity, unit: 'g' },
                { name: 'Đường', amount: baseQuantity * 0.618, unit: 'g' },
                { name: 'Bơ', amount: baseQuantity * 0.382, unit: 'g' },
                { name: 'Trứng', amount: baseQuantity * 0.236, unit: 'g' },
                { name: 'Sữa', amount: baseQuantity * 0.146, unit: 'ml' }
            ],
            ratio: 'Các nguyên liệu theo dãy Fibonacci'
        },
        sauce: {
            name: 'Nước sốt hoàn hảo',
            ingredients: [
                { name: 'Cà chua', amount: baseQuantity, unit: 'g' },
                { name: 'Hành tây', amount: baseQuantity * 0.618, unit: 'g' },
                { name: 'Tỏi', amount: baseQuantity * 0.382, unit: 'g' },
                { name: 'Dầu olive', amount: baseQuantity * 0.236, unit: 'ml' },
                { name: 'Gia vị', amount: baseQuantity * 0.146, unit: 'g' }
            ],
            ratio: 'Tỷ lệ aromatics theo φ'
        },
        cocktail: {
            name: 'Cocktail vàng',
            ingredients: [
                { name: 'Rượu chính', amount: baseQuantity, unit: 'ml' },
                { name: 'Liqueur', amount: baseQuantity * 0.618, unit: 'ml' },
                { name: 'Nước cốt chanh', amount: baseQuantity * 0.382, unit: 'ml' },
                { name: 'Syrup', amount: baseQuantity * 0.236, unit: 'ml' },
                { name: 'Garnish', amount: baseQuantity * 0.146, unit: 'g' }
            ],
            ratio: 'Cân bằng alcohol/mixer theo φ'
        }
    };
    
    const recipe = recipes[recipeType];
    
    let result = `<strong>${recipe.name}:</strong><br>`;
    result += `📝 Nguyên liệu (dựa trên ${baseQuantity}${recipe.ingredients[0].unit}):<br>`;
    
    recipe.ingredients.forEach(ingredient => {
        result += `• ${ingredient.name}: ${ingredient.amount.toFixed(1)}${ingredient.unit}<br>`;
    });
    
    result += `<br>🌟 Nguyên lý: ${recipe.ratio}<br>`;
    result += `📊 Tỷ lệ vàng tạo sự cân bằng hoàn hảo trong hương vị`;
    
    document.getElementById('recipeResult').innerHTML = result;
}

function analyzeCocktailRatio() {
    const baseSpirit = parseFloat(document.getElementById('baseSpirit').value);
    const mixer = parseFloat(document.getElementById('mixer').value);
    
    if (!baseSpirit || !mixer) {
        document.getElementById('cocktailResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập lượng rượu và nước pha!</span>';
        return;
    }
    
    const ratio = baseSpirit / mixer;
    const total = baseSpirit + mixer;
    const alcoholPercent = (baseSpirit / total) * 100;
    const mixerPercent = (mixer / total) * 100;
    
    const goldenBase = total * 0.618;
    const goldenMixer = total * 0.382;
    
    const balance = Math.abs(ratio - GOLDEN_RATIO);
    const quality = Math.max(0, 100 - balance * 50);
    
    let cocktailType = '';
    if (ratio > 2) cocktailType = 'Mạnh (Spirit-forward)';
    else if (ratio > 1.3) cocktailType = 'Cân bằng (Balanced)';
    else cocktailType = 'Nhẹ (Mixer-heavy)';
    
    const result = `
        <strong>Phân tích cocktail:</strong><br>
        🥃 Rượu nền: ${baseSpirit}ml (${alcoholPercent.toFixed(1)}%)<br>
        🧊 Nước pha: ${mixer}ml (${mixerPercent.toFixed(1)}%)<br>
        📊 Tỷ lệ: ${ratio.toFixed(3)}<br>
        🎯 Loại: ${cocktailType}<br>
        🌟 Chất lượng: ${quality.toFixed(1)}/100<br><br>
        <strong>Tối ưu theo φ:</strong><br>
        🌟 Rượu tối ưu: ${goldenBase.toFixed(1)}ml<br>
        🌟 Mixer tối ưu: ${goldenMixer.toFixed(1)}ml<br>
        📐 Tỷ lệ vàng: ${GOLDEN_RATIO.toFixed(3)}<br><br>
        <strong>Gợi ý:</strong><br>
        ${quality > 80 ? '🎉 Công thức hoàn hảo!' : 
          quality > 60 ? '👍 Tốt, có thể tinh chỉnh' : 
          '💡 Nên điều chỉnh tỷ lệ để cân bằng hơn'}
    `;
    
    document.getElementById('cocktailResult').innerHTML = result;
}

function analyzeRunningTechnique() {
    const strideLength = parseFloat(document.getElementById('strideLength').value);
    const stepRate = parseFloat(document.getElementById('stepRate').value);
    
    if (!strideLength || !stepRate) {
        document.getElementById('runningResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập đầy đủ thông tin!</span>';
        return;
    }
    
    const speed = (strideLength * stepRate) / 100 / 60; // km/h
    const optimalRatio = strideLength / (stepRate / GOLDEN_RATIO);
    const efficiency = Math.max(0, 100 - Math.abs(optimalRatio - 1) * 50);
    
    const goldenStride = stepRate * GOLDEN_RATIO;
    const goldenRate = strideLength / GOLDEN_RATIO;
    
    const result = `
        <strong>Phân tích kỹ thuật chạy:</strong><br>
        🏃 Chiều dài sải chân: ${strideLength}cm<br>
        ⏱️ Tần suất bước: ${stepRate} steps/phút<br>
        🚀 Tốc độ ước tính: ${speed.toFixed(2)} km/h<br>
        📊 Hiệu quả: ${efficiency.toFixed(1)}%<br><br>
        <strong>Tối ưu hóa theo φ:</strong><br>
        🌟 Sải chân tối ưu: ${goldenStride.toFixed(0)}cm<br>
        🌟 Tần suất tối ưu: ${goldenRate.toFixed(0)} steps/phút<br>
        💡 Gợi ý: ${efficiency > 80 ? 'Kỹ thuật tốt!' : 'Có thể điều chỉnh để cải thiện hiệu quả'}
    `;
    
    document.getElementById('runningResult').innerHTML = result;
}        

function analyzeSportGeometry() {
    const sport = document.getElementById('sportType').value;
    
    const sports = {
        tennis: {
            name: 'Quần vợt',
            courtLength: 23.77,
            courtWidth: 8.23,
            netHeight: 0.914,
            analysis: 'Tỷ lệ sân: 2.89 (gần φ²)'
        },
        basketball: {
            name: 'Bóng rổ',
            courtLength: 28,
            courtWidth: 15,
            basketHeight: 3.05,
            analysis: 'Tỷ lệ sân: 1.87 (gần φ)'
        },
        soccer: {
            name: 'Bóng đá',
            courtLength: 105,
            courtWidth: 68,
            goalHeight: 2.44,
            analysis: 'Tỷ lệ sân: 1.54 (gần φ)'
        },
        volleyball: {
            name: 'Bóng chuyền',
            courtLength: 18,
            courtWidth: 9,
            netHeight: 2.43,
            analysis: 'Tỷ lệ sân: 2.0 (gần φ/0.8)'
        }
    };
    
    const selectedSport = sports[sport];
    const ratio = selectedSport.courtLength / selectedSport.courtWidth;
    const goldenAccuracy = Math.abs(1 - Math.abs(ratio - GOLDEN_RATIO) / GOLDEN_RATIO) * 100;
    
    const result = `
        <strong>Phân tích ${selectedSport.name}:</strong><br>
        📏 Kích thước sân: ${selectedSport.courtLength}m × ${selectedSport.courtWidth}m<br>
        📐 Tỷ lệ: ${ratio.toFixed(3)}<br>
        🌟 Độ chính xác φ: ${goldenAccuracy.toFixed(1)}%<br>
        🏟️ ${selectedSport.analysis}<br>
        ⚽ Chiều cao: ${selectedSport.netHeight || selectedSport.goalHeight || selectedSport.basketHeight}m<br><br>
        <strong>Ý nghĩa:</strong><br>
        • Tối ưu hóa không gian chơi<br>
        • Cân bằng giữa kỹ năng và thể lực<br>
        • Hấp dẫn thị giác cho khán giả
    `;
    
    document.getElementById('sportGeometryResult').innerHTML = result;
}
function analyzeTrainingRatio() {
    const workTime = parseFloat(document.getElementById('workTime').value);
    const restTime = parseFloat(document.getElementById('restTime').value);
    
    if (!workTime || !restTime) {
        document.getElementById('trainingResult').innerHTML = 
            '<span style="color: red;">Vui lòng nhập thời gian làm việc và nghỉ!</span>';
        return;
    }
    
    const ratio = workTime / restTime;
    const totalTime = workTime + restTime;
    const workPercent = (workTime / totalTime) * 100;
    const restPercent = (restTime / totalTime) * 100;
    
    const goldenWork = totalTime * 0.618;
    const goldenRest = totalTime * 0.382;
    const efficiency = Math.max(0, 100 - Math.abs(ratio - GOLDEN_RATIO) * 20);
    
    const result = `
        <strong>Phân tích tỷ lệ tập luyện:</strong><br>
        ⏱️ Thời gian làm việc: ${workTime} phút (${workPercent.toFixed(1)}%)<br>
        😴 Thời gian nghỉ: ${restTime} phút (${restPercent.toFixed(1)}%)<br>
        📊 Tỷ lệ Làm việc/Nghỉ: ${ratio.toFixed(3)}<br>
        🌟 Hiệu quả: ${efficiency.toFixed(1)}%<br><br>
        <strong>Tối ưu theo φ:</strong><br>
        💪 Làm việc tối ưu: ${goldenWork.toFixed(1)} phút<br>
        😌 Nghỉ ngơi tối ưu: ${goldenRest.toFixed(1)} phút<br>
        📈 Tỷ lệ vàng: ${GOLDEN_RATIO.toFixed(3)}<br><br>
        <strong>Lợi ích:</strong><br>
        • Tránh kiệt sức<br>
        • Phục hồi tối ưu<br>
        • Duy trì hiệu suất cao
    `;
    
    document.getElementById('trainingResult').innerHTML = result;
}
function analyzeEquipmentDesign() {
    const equipment = document.getElementById('equipmentType').value;
    
    const equipments = {
        bicycle: {
            name: 'Xe đạp',
            wheelDiameter: 70,
            frameLengthOptimal: 70 * GOLDEN_RATIO,
            handlebarWidth: 70 / GOLDEN_RATIO,
            analysis: 'Tỷ lệ khung xe theo φ cho sự cân bằng tối ưu'
        },
        racket: {
            name: 'Vợt tennis',
            totalLength: 68.5,
            headLength: 68.5 / GOLDEN_RATIO,
            handleLength: 68.5 - (68.5 / GOLDEN_RATIO),
            analysis: 'Tỷ lệ đầu vợt/cán vợt theo φ'
        },
        club: {
            name: 'Gậy golf',
            totalLength: 110,
            shaftLength: 110 * 0.618,
            headSize: 110 * 0.382,
            analysis: 'Chiều dài cán/đầu gậy theo tỷ lệ vàng'
        },
        bat: {
            name: 'Gậy bóng chày',
            totalLength: 84,
            barrelLength: 84 / GOLDEN_RATIO,
            handleLength: 84 - (84 / GOLDEN_RATIO),
            analysis: 'Tỷ lệ thân gậy/cán theo φ cho lực đánh tối ưu'
        }
    };
    
    const selected = equipments[equipment];
    const ratio = equipment === 'bicycle' ? 
        selected.frameLengthOptimal / selected.wheelDiameter :
        (selected.headLength || selected.shaftLength || selected.barrelLength) / 
        (selected.handleLength || selected.headSize);
    
    const result = `
        <strong>Thiết kế ${selected.name}:</strong><br>
        📏 Chiều dài tổng: ${selected.totalLength || selected.wheelDiameter + selected.frameLengthOptimal}cm<br>
        🎯 Phần chính: ${(selected.headLength || selected.shaftLength || selected.barrelLength || selected.frameLengthOptimal).toFixed(1)}cm<br>
        🤲 Phần tay cầm: ${(selected.handleLength || selected.headSize || selected.handlebarWidth).toFixed(1)}cm<br>
        📐 Tỷ lệ: ${ratio.toFixed(3)}<br>
        🌟 So với φ: ${(Math.abs(ratio - GOLDEN_RATIO) < 0.1 ? 'Gần hoàn hảo!' : 'Có thể tối ưu')}<br><br>
        <strong>Phân tích:</strong><br>
        ${selected.analysis}<br><br>
        <strong>Lợi ích tỷ lệ vàng:</strong><br>
        • Cân bằng và kiểm soát tốt<br>
        • Giảm mệt mỏi<br>
        • Hiệu suất tối ưu
    `;
    
    document.getElementById('equipmentResult').innerHTML = result;
}
        // Khởi tạo ứng dụng
        document.addEventListener('DOMContentLoaded', function() {
            generateFibonacci();
            generateDesignGrid();

            // Tự động tính toán khi nhập
            ['lengthA', 'lengthB'].forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('input', function() {
                        if (document.getElementById('lengthA').value &&
                            document.getElementById('lengthB').value) {
                            setTimeout(calculateRatio, 500);
                        }
                    });
                }
            });
        });

        // Toggle menu for mobile
        function toggleMenu() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
    </script>

    </div><!-- End content-wrapper -->
    </div><!-- End container -->

    <!-- Footer Full Width -->
    <div class="footer">
        <p>Bản quyền 2025 Định Danh - DINHDANH.COM</p>
    </div>
</body>
</html>
