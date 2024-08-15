// public/js/loadingMask.js

function createLoadingMask() {
    const loadingMask = document.createElement('dialog');
    loadingMask.id = 'loadingMask';
    
    const loadingCircle = document.createElement('div');
    loadingCircle.id = 'loadingCircle';
    
    loadingMask.style.cssText = `
        border: none;
        background: transparent;
        padding: 0;
        overflow: hidden;
        outline: none; // 添加這行來移除 focus 時的邊框
    `;

    loadingCircle.style.cssText = `
        border: 5px solid #f3f3f3;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: loadingAnimation 2s linear infinite;
    `;

    loadingMask.appendChild(loadingCircle);
    document.body.appendChild(loadingMask);

    const style = document.createElement('style');
    style.textContent = `
        #loadingMask {
            border: none !important;
            box-shadow: none !important;
        }
        #loadingMask::backdrop {
            background-color: rgba(0, 0, 0, 0.5);
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

// 顯示
window.showLoadingMask = function() {
    loadingMask.showModal();
}

// 隱藏
window.hideLoadingMask = function() {
    loadingMask.close();
}