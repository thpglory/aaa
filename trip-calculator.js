/**
 * Trip Manager - Calculator Management
 * Version: 1.0.0
 * Handles expense calculations, currency conversion, and tip calculator
 */

window.TripCalculator = (function() {
    'use strict';

    // Calculator state
    let calculatorState = {
        display: '0',
        previousValue: null,
        operation: null,
        waitingForOperand: false,
        history: [],
        memory: 0
    };

    // Calculator functions
    const operations = {
        '+': (a, b) => a + b,
        '-': (a, b) => a - b,
        '*': (a, b) => a * b,
        '/': (a, b) => b !== 0 ? a / b : 0,
        '%': (a, b) => a * b / 100,
        '=': (a, b) => b
    };

    // Currency rates (mock data - in real app would fetch from API)
    const currencyRates = {
        'VND': 1,
        'USD': 24400,
        'EUR': 26500,
        'JPY': 164,
        'THB': 700,
        'SGD': 18200
    };

    // Calculator buttons configuration
    const buttonLayout = [
        ['C', 'CE', '⌫', '/'],
        ['7', '8', '9', '*'],
        ['4', '5', '6', '-'],
        ['1', '2', '3', '+'],
        ['±', '0', '.', '='],
        ['MC', 'MR', 'MS', 'M+'],
        ['%', '√', '¹∕x', 'Tip']
    ];

    function init() {
        console.log('TripCalculator: Initializing...');
        
        render();
        setupEventListeners();
        loadCalculatorState();
        
        console.log('TripCalculator: Initialized successfully');
    }

    // Render calculator
    function render() {
        renderCalculatorButtons();
        updateDisplay();
    }

    // Render calculator buttons
    function renderCalculatorButtons() {
        const container = TripUtils.getElement('calcButtons');
        if (!container) return;

        container.innerHTML = buttonLayout.map(row => 
            row.map(button => createButton(button)).join('')
        ).join('');
    }

    // Create calculator button
    function createButton(label) {
        const className = getButtonClass(label);
        const onclick = `TripCalculator.handleButton('${label}')`;
        
        return `
            <button class="calc-btn ${className}" onclick="${onclick}">
                ${label}
            </button>
        `;
    }

    // Get button CSS class
    function getButtonClass(label) {
        if (['+', '-', '*', '/', '=', '%'].includes(label)) {
            return 'operator';
        }
        if (['C', 'CE', '⌫', '±', '√', '¹∕x'].includes(label)) {
            return 'function';
        }
        if (['MC', 'MR', 'MS', 'M+'].includes(label)) {
            return 'memory';
        }
        if (label === 'Tip') {
            return 'special';
        }
        return 'number';
    }

    // Handle button press
    function handleButton(label) {
        try {
            switch (label) {
                case 'C':
                    clearAll();
                    break;
                case 'CE':
                    clearEntry();
                    break;
                case '⌫':
                    backspace();
                    break;
                case '±':
                    toggleSign();
                    break;
                case '.':
                    inputDecimal();
                    break;
                case '=':
                    calculate();
                    break;
                case '%':
                    percentage();
                    break;
                case '√':
                    squareRoot();
                    break;
                case '¹∕x':
                    reciprocal();
                    break;
                case 'MC':
                    memoryClear();
                    break;
                case 'MR':
                    memoryRecall();
                    break;
                case 'MS':
                    memoryStore();
                    break;
                case 'M+':
                    memoryAdd();
                    break;
                case 'Tip':
                    openTipCalculator();
                    break;
                case '+':
                case '-':
                case '*':
                case '/':
                    inputOperation(label);
                    break;
                default:
                    if (!isNaN(label)) {
                        inputNumber(label);
                    }
            }
            
            updateDisplay();
            saveCalculatorState();
            
        } catch (error) {
            console.error('Calculator error:', error);
            displayError();
        }
    }

    // Input number
    function inputNumber(num) {
        if (calculatorState.waitingForOperand) {
            calculatorState.display = num;
            calculatorState.waitingForOperand = false;
        } else {
            calculatorState.display = calculatorState.display === '0' ? num : calculatorState.display + num;
        }
    }

    // Input decimal point
    function inputDecimal() {
        if (calculatorState.waitingForOperand) {
            calculatorState.display = '0.';
            calculatorState.waitingForOperand = false;
        } else if (calculatorState.display.indexOf('.') === -1) {
            calculatorState.display += '.';
        }
    }

    // Input operation
    function inputOperation(nextOperation) {
        const inputValue = parseFloat(calculatorState.display);

        if (calculatorState.previousValue === null) {
            calculatorState.previousValue = inputValue;
        } else if (calculatorState.operation) {
            const currentValue = calculatorState.previousValue || 0;
            const newValue = operations[calculatorState.operation](currentValue, inputValue);

            calculatorState.display = String(newValue);
            calculatorState.previousValue = newValue;
            
            // Add to history
            addToHistory(`${currentValue} ${calculatorState.operation} ${inputValue} = ${newValue}`);
        }

        calculatorState.waitingForOperand = true;
        calculatorState.operation = nextOperation;
    }

    // Calculate result
    function calculate() {
        const inputValue = parseFloat(calculatorState.display);

        if (calculatorState.previousValue !== null && calculatorState.operation) {
            const newValue = operations[calculatorState.operation](calculatorState.previousValue, inputValue);
            
            calculatorState.display = String(newValue);
            calculatorState.previousValue = null;
            calculatorState.operation = null;
            calculatorState.waitingForOperand = true;
            
            // Add to history
            addToHistory(`${calculatorState.previousValue || 0} ${calculatorState.operation || '='} ${inputValue} = ${newValue}`);
        }
    }

    // Clear all
    function clearAll() {
        calculatorState.display = '0';
        calculatorState.previousValue = null;
        calculatorState.operation = null;
        calculatorState.waitingForOperand = false;
    }

    // Clear entry
    function clearEntry() {
        calculatorState.display = '0';
        calculatorState.waitingForOperand = false;
    }

    // Backspace
    function backspace() {
        if (calculatorState.display.length > 1) {
            calculatorState.display = calculatorState.display.slice(0, -1);
        } else {
            calculatorState.display = '0';
        }
    }

    // Toggle sign
    function toggleSign() {
        if (calculatorState.display !== '0') {
            calculatorState.display = calculatorState.display.startsWith('-') 
                ? calculatorState.display.slice(1)
                : '-' + calculatorState.display;
        }
    }

    // Percentage
    function percentage() {
        const value = parseFloat(calculatorState.display);
        calculatorState.display = String(value / 100);
        calculatorState.waitingForOperand = true;
    }

    // Square root
    function squareRoot() {
        const value = parseFloat(calculatorState.display);
        if (value >= 0) {
            calculatorState.display = String(Math.sqrt(value));
            calculatorState.waitingForOperand = true;
            addToHistory(`√${value} = ${calculatorState.display}`);
        } else {
            displayError('Không thể tính căn bậc hai của số âm');
        }
    }

    // Reciprocal
    function reciprocal() {
        const value = parseFloat(calculatorState.display);
        if (value !== 0) {
            calculatorState.display = String(1 / value);
            calculatorState.waitingForOperand = true;
            addToHistory(`1/${value} = ${calculatorState.display}`);
        } else {
            displayError('Không thể chia cho 0');
        }
    }

    // Memory functions
    function memoryClear() {
        calculatorState.memory = 0;
        showMemoryStatus('Memory Cleared');
    }

    function memoryRecall() {
        calculatorState.display = String(calculatorState.memory);
        calculatorState.waitingForOperand = true;
        showMemoryStatus('Memory Recalled');
    }

    function memoryStore() {
        calculatorState.memory = parseFloat(calculatorState.display);
        showMemoryStatus('Memory Stored');
    }

    function memoryAdd() {
        calculatorState.memory += parseFloat(calculatorState.display);
        showMemoryStatus('Added to Memory');
    }

    // Show memory status
    function showMemoryStatus(message) {
        TripNotifications.showInfo(`💾 ${message}: ${TripUtils.formatMoney(calculatorState.memory)}`);
    }

    // Update display
    function updateDisplay() {
        const displayElement = TripUtils.getElement('calcDisplay');
        if (displayElement) {
            const value = parseFloat(calculatorState.display);
            if (!isNaN(value)) {
                // Format large numbers with commas
                displayElement.textContent = formatDisplayNumber(value);
            } else {
                displayElement.textContent = calculatorState.display;
            }
        }
    }

    // Format display number
    function formatDisplayNumber(num) {
        if (num === 0) return '0';
        
        const absoluteNum = Math.abs(num);
        const sign = num < 0 ? '-' : '';
        
        // For very large or very small numbers, use scientific notation
        if (absoluteNum >= 1e15 || (absoluteNum < 1e-6 && absoluteNum !== 0)) {
            return sign + absoluteNum.toExponential(6);
        }
        
        // For normal numbers, format with commas
        if (Number.isInteger(num)) {
            return sign + absoluteNum.toLocaleString('vi-VN');
        } else {
            return sign + absoluteNum.toLocaleString('vi-VN', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 8
            });
        }
    }

    // Display error
    function displayError(message = 'Lỗi') {
        calculatorState.display = 'Error';
        TripNotifications.showError(message);
        setTimeout(() => {
            clearAll();
            updateDisplay();
        }, 2000);
    }

    // Add to history
    function addToHistory(calculation) {
        calculatorState.history.unshift({
            calculation: calculation,
            timestamp: TripUtils.getCurrentDateTime(),
            result: calculatorState.display
        });
        
        // Keep only last 50 calculations
        if (calculatorState.history.length > 50) {
            calculatorState.history = calculatorState.history.slice(0, 50);
        }
    }

    // Open tip calculator
    function openTipCalculator() {
        const billAmount = parseFloat(calculatorState.display) || 0;
        
        const tipPercentages = [10, 15, 18, 20, 25];
        const tipOptions = tipPercentages.map(percent => {
            const tipAmount = billAmount * percent / 100;
            const total = billAmount + tipAmount;
            return `${percent}%: ${TripUtils.formatMoney(tipAmount)} (Tổng: ${TripUtils.formatMoney(total)})`;
        }).join('\n');
        
        const customTip = prompt(`💡 Tính Tip\n\nHóa đơn: ${TripUtils.formatMoney(billAmount)}\n\n${tipOptions}\n\nNhập % tip tùy chỉnh (hoặc Enter để chọn 15%):`);
        
        if (customTip !== null) {
            const tipPercent = parseFloat(customTip) || 15;
            const tipAmount = billAmount * tipPercent / 100;
            const total = billAmount + tipAmount;
            
            calculatorState.display = String(total);
            updateDisplay();
            
            TripNotifications.showSuccess(`💰 Tip ${tipPercent}%: ${TripUtils.formatMoney(tipAmount)}\nTổng cộng: ${TripUtils.formatMoney(total)}`);
            addToHistory(`Tip ${tipPercent}% of ${TripUtils.formatMoney(billAmount)} = ${TripUtils.formatMoney(total)}`);
        }
    }

    // Currency converter
    function convertCurrency(amount, fromCurrency, toCurrency) {
        if (fromCurrency === toCurrency) return amount;
        
        const fromRate = currencyRates[fromCurrency] || 1;
        const toRate = currencyRates[toCurrency] || 1;
        
        // Convert to VND first, then to target currency
        const vndAmount = amount * fromRate;
        const convertedAmount = vndAmount / toRate;
        
        return convertedAmount;
    }

    // Show currency converter
    function showCurrencyConverter() {
        const amount = parseFloat(calculatorState.display) || 0;
        const currencies = Object.keys(currencyRates);
        
        let converterHtml = `
            <div style="padding: 20px;">
                <h4>💱 Quy Đổi Tiền Tệ</h4>
                <p>Số tiền: <strong>${amount.toLocaleString()}</strong></p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
        `;
        
        currencies.forEach(currency => {
            if (currency !== 'VND') {
                const converted = convertCurrency(amount, 'VND', currency);
                converterHtml += `
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; text-align: center;">
                        <div style="font-weight: bold; color: #667eea;">${currency}</div>
                        <div style="font-size: 18px; margin-top: 5px;">${converted.toLocaleString()}</div>
                    </div>
                `;
            }
        });
        
        converterHtml += '</div></div>';
        
        // Show in modal or notification
        TripNotifications.show(converterHtml, TripNotifications.TYPES.INFO, 10000, {
            persistent: true,
            actions: [{
                label: 'Đóng',
                handler: 'TripNotifications.dismissAll()'
            }]
        });
    }

    // Split bill calculator
    function calculateSplitBill() {
        const totalAmount = parseFloat(calculatorState.display) || 0;
        const numberOfPeople = parseInt(prompt('Chia hóa đơn cho bao nhiêu người?', '2')) || 2;
        
        if (numberOfPeople > 0) {
            const amountPerPerson = totalAmount / numberOfPeople;
            
            calculatorState.display = String(amountPerPerson);
            updateDisplay();
            
            TripNotifications.showSuccess(
                `🧾 Chia ${TripUtils.formatMoney(totalAmount)} cho ${numberOfPeople} người\n` +
                `💰 Mỗi người: ${TripUtils.formatMoney(amountPerPerson)}`
            );
            
            addToHistory(`Split ${TripUtils.formatMoney(totalAmount)} ÷ ${numberOfPeople} = ${TripUtils.formatMoney(amountPerPerson)} per person`);
        }
    }

    // Add calculated expense
    function addCalculatedExpense() {
        const amount = parseFloat(calculatorState.display);
        
        if (!amount || amount <= 0) {
            TripNotifications.showWarning('Vui lòng nhập số tiền hợp lệ!');
            return;
        }

        // Open quick expense modal with pre-filled amount
        TripModals.openModal('quickExpenseModal', { amount: amount });
        
        // Add to history
        addToHistory(`Added expense: ${TripUtils.formatMoney(amount)}`);
        
        TripNotifications.showInfo(`💳 Đã mở form thêm chi tiêu với số tiền ${TripUtils.formatMoney(amount)}`);
    }

    // Show calculator history
    function showHistory() {
        if (calculatorState.history.length === 0) {
            TripNotifications.showInfo('Chưa có lịch sử tính toán nào');
            return;
        }

        const historyHtml = `
            <div style="padding: 20px; max-height: 400px; overflow-y: auto;">
                <h4>📜 Lịch Sử Tính Toán</h4>
                ${calculatorState.history.map((item, index) => `
                    <div style="padding: 10px; border-bottom: 1px solid #eee; ${index === 0 ? 'background: #f0f8ff;' : ''}">
                        <div style="font-family: monospace; font-size: 14px;">${item.calculation}</div>
                        <div style="font-size: 12px; color: #666; margin-top: 5px;">${TripUtils.formatDateTime(item.timestamp)}</div>
                    </div>
                `).join('')}
            </div>
        `;

        TripNotifications.show(historyHtml, TripNotifications.TYPES.INFO, 0, {
            persistent: true,
            actions: [
                {
                    label: 'Xóa lịch sử',
                    handler: 'TripCalculator.clearHistory()'
                },
                {
                    label: 'Đóng',
                    handler: 'TripNotifications.dismissAll()'
                }
            ]
        });
    }

    // Clear history
    function clearHistory() {
        calculatorState.history = [];
        saveCalculatorState();
        TripNotifications.dismissAll();
        TripNotifications.showSuccess('Đã xóa lịch sử tính toán');
    }

    // Save calculator state
    function saveCalculatorState() {
        try {
            localStorage.setItem('tripCalculatorState', JSON.stringify(calculatorState));
        } catch (error) {
            console.warn('Could not save calculator state:', error);
        }
    }

    // Load calculator state
    function loadCalculatorState() {
        try {
            const saved = localStorage.getItem('tripCalculatorState');
            if (saved) {
                const savedState = JSON.parse(saved);
                calculatorState = { ...calculatorState, ...savedState };
                updateDisplay();
            }
        } catch (error) {
            console.warn('Could not load calculator state:', error);
        }
    }

    // Setup event listeners
    function setupEventListeners() {
        // Keyboard support
        document.addEventListener('keydown', handleKeyboard);
        
        // Tab change listener
        TripCore.on('tabChanged', (event) => {
            if (event.to === 'calculator') {
                updateDisplay();
            }
        });
    }

    // Handle keyboard input
    function handleKeyboard(event) {
        // Only handle if calculator tab is active
        if (TripTabs.getCurrentTab() !== 'calculator') return;
        
        // Prevent default for calculator keys
        const key = event.key;
        
        if ('0123456789'.includes(key)) {
            event.preventDefault();
            handleButton(key);
        } else if ('+-*/'.includes(key)) {
            event.preventDefault();
            handleButton(key);
        } else if (key === 'Enter' || key === '=') {
            event.preventDefault();
            handleButton('=');
        } else if (key === 'Escape' || key === 'c' || key === 'C') {
            event.preventDefault();
            handleButton('C');
        } else if (key === 'Backspace') {
            event.preventDefault();
            handleButton('⌫');
        } else if (key === '.') {
            event.preventDefault();
            handleButton('.');
        } else if (key === '%') {
            event.preventDefault();
            handleButton('%');
        }
    }

    // Public API
    return {
        // Initialization
        init,
        render,

        // Calculator operations
        handleButton,
        addCalculatedExpense,
        
        // Utility functions
        convertCurrency,
        showCurrencyConverter,
        calculateSplitBill,
        
        // History management
        showHistory,
        clearHistory,
        
        // State management
        getState: () => ({ ...calculatorState }),
        setState: (newState) => {
            calculatorState = { ...calculatorState, ...newState };
            updateDisplay();
            saveCalculatorState();
        }
    };
})();