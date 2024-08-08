document.addEventListener('DOMContentLoaded', function() {
    const menu = document.getElementById('navLLMenu');
    const overlay = document.getElementById('navLLOverlay');
    const toggle = document.getElementById('navLLToggle');

    // 關閉彈出視窗
    function toggleMenu() {
        menu.classList.toggle('active');
        overlay.classList.toggle('active');
    }

    toggle.addEventListener('click', function(event) {
        event.stopPropagation();
        toggleMenu();
    });

    // 點擊遮罩層關閉彈出視窗
    overlay.addEventListener('click', toggleMenu);

    // 點擊彈出視窗外的地方關閉彈出視窗
    document.addEventListener('click', function(event) {
        if (menu.classList.contains('active') && 
            !menu.contains(event.target) && 
            !toggle.contains(event.target)) {
            toggleMenu();
        }
    });

    // 防止點擊彈出視窗內部時關閉彈出視窗
    menu.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});