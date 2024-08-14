// public/js/loadingMask.js

// 創建並插入 loadingMask
function createLoadingMask() {
    const loadingMask = document.createElement('dialog');
    loadingMask.id = 'loadingMask';
    
    const loadingCircle = document.createElement('div');
    loadingCircle.id = 'loadingCircle';
    
    loadingMask.appendChild(loadingCircle);
    document.body.appendChild(loadingMask);

    // 創建並插入 CSS 樣式
    const style = document.createElement('style');
    style.textContent = `
        #loadingMask {
            border: none;
            background: transparent;
            padding: 0;
            overflow: hidden;
        }
        #loadingMask::backdrop {
            background-color: rgba(0, 0, 0, 0.5);
        }
        #loadingCircle {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: loadingAnimation 2s linear infinite;
        }
        @keyframes loadingAnimation {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);

    return loadingMask;
}

const loadingMask = createLoadingMask();

// 顯示遮罩層的函數
window.showLoadingMask = function() {
    loadingMask.showModal();
}

// 隱藏遮罩層的函數
window.hideLoadingMask = function() {
    loadingMask.close();
}